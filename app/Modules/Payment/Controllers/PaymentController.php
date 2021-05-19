<?php

namespace App\Modules\Payment\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Modules\Payment\Model\Payment;
use App\Modules\Payment\Model\InviteTransaction;
use App\Modules\Payment\Model\Wallet;
use App\Modules\Payment\Model\Account;
use App\Modules\Reserve\Model\Reserve;
use App\Modules\Host\Model\Host;
use App\Modules\Services\Model\Service;
use App\Modules\Offer\Model\Offer;
use App\Modules\Discount\Model\Discount;
use App\Modules\Sms\Controllers\SmsController;
use Illuminate\Support\Facades\DB;
use App\User;

class PaymentController extends Controller
{
    public function IndexPayment()
    {
//        return auth()->user()->id;
        $paymentModel = Payment::where('user_id', auth()->user()->id)->orderBy('id', 'DESC')->get();
        return view('Payment::indexPayment', compact('paymentModel'));
    }

    
    public function IndexChargeWallet() {
        return view('Payment::chargeWallet');
    }


    public function ChargeWallet(Request $request) {
        $MerchantID = '6f6e74ba-31d1-11e9-aa83-005056a205be'; //Required
        $Amount = $request->price; //Amount will be based on Toman - Required
        $Description = 'شارژ کیف پول'; //
        $Email = ''; // Optional
        $Mobile = ''; // Optional
        $CallbackURL = route('CallbackURLWallet'); // Required

        $client = new \SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

        $result = $client->PaymentRequest(
            [
                'MerchantID' => $MerchantID,
                'Amount' => $Amount,
                'Description' => $Description,
                'Email' => $Email,
                'Mobile' => $Mobile,
                'CallbackURL' => $CallbackURL,
            ]
        );
        //Redirect to URL You can do it also by creating a form
        if ($result->Status == 100) {
            $paymentModel = new Payment();
            $paymentModel->price = $Amount;
            $paymentModel->remaining_price = 0;
            $paymentModel->user_id = auth()->user()->id;
            $paymentModel->tracking_code = $result->Authority;
            $paymentModel->reserve_code = 'CHARGE-WALLET';
            $paymentModel->status = 0;
            $paymentModel->type = 2;
            if ($paymentModel->save()) {
                Header('Location: https://www.zarinpal.com/pg/StartPay/' . $result->Authority);
            }
        } else {
            return $result;
        }
    }


    public function DetailPaymentReserve($code) {
        $reserveModel = Reserve::where('group_code', $code)->get();
        $hostModel = Host::where('id', $reserveModel[0]->host_id)->first();
        $sitePercent = config('setting.SitePercent');
        $invitePercent = config('setting.InvitePercent');
        $totalPrice = 0; /** all price reserve */
        $prePrice = 0; /** pish pardakht reserve */
        $wage = 0; /** karmozd site */

        if($hostModel->cancel_rule_id == 1 || $hostModel->cancel_rule_id == 2) {
            foreach ($reserveModel as $key => $value) { /** all price */
                $totalPrice = $totalPrice + $value->final_price;
            }
            if(count($reserveModel) > 2) { /** pish pardakht bishtar az 2 roz */
                foreach ($reserveModel as $key => $value) {
                    if($key == 2) { /** 2 roze aval reserve */
                        break ;
                    }
                    $wage = $totalPrice*($sitePercent+$invitePercent)/100; // site percent
                    $totalPrice_ = $totalPrice - $wage;
                    $preTotal = $totalPrice_ / count($reserveModel); // for avg 2 days
                    $prePrice = $preTotal * 2; // calculate 2 days for pre price
                    $prePrice = round($prePrice/1000) * 1000;
//                    $prePrice = $prePrice + $value->final_price;
                }
                $wage = $totalPrice*($sitePercent+$invitePercent)/100; // site percent

            } else { /** pish pardakht 1 ya 2 roz */
                foreach ($reserveModel as $key => $value) {
                    if($key == 2) { /** 2 roze aval reserve */
                        break ;
                    }
                    $prePrice = 0;
                }
                $wage = $totalPrice*($sitePercent+$invitePercent)/100;
            }
        } elseif($hostModel->cancel_rule_id == 3) { /** sakhtgirane */
            foreach ($reserveModel as $key => $value) { /** all price */
                $totalPrice = $totalPrice + $value->final_price;
            }
            $wage = $totalPrice*($sitePercent+$invitePercent)/100;
        } else {
            return 'Error 0000000000889E5';
        }
        $arrayPrice = array(
            'code' => $code,
            'totalPrice' => $totalPrice,
            'prePrice' => $prePrice,
            'wage' => $wage
        );

        return array(
            '0' => response()->json(view('Reserve::Ajax.AjaxTypePayment', compact('arrayPrice'))->render()),
            '1' => response()->json(view('Reserve::Ajax.AjaxWalletPayment', compact('arrayPrice'))->render())
        );
    }




    /***************************************************
     ************* Payment Reserve Wallet **************
     ***************************************************/

    public function PaymentReserveWithWallet(Request $request)
    {
        $reserveModel = Reserve::where('group_code', $request->code)
            ->where('user_id', auth()->user()->id)->get();

        if(count($reserveModel) > 0) {
            if($reserveModel[0]->status == 1) {
                $final_price = 0;
                foreach ($reserveModel as $key => $value) {
                    $final_price = $final_price + $value->final_price;
                }
                if(auth()->user()->credit >= $final_price) {

                    $userModelCredit = User::where('id', auth()->user()->id)->first();

                    $userModelCredit->credit = auth()->user()->credit - $final_price;
                    if($userModelCredit->save()) {
                        $paymentModel = new Payment();
                        $paymentModel->price = $final_price;
                        $paymentModel->remaining_price = 0;
                        $paymentModel->user_id = auth()->user()->id;
                        $paymentModel->tracking_code = 'wallet';
                        $paymentModel->reserve_code = $request->code;
                        $paymentModel->status = 1;
                        $paymentModel->type = 2;
                        if ($paymentModel->save()) {
                            if(auth()->user()->parent_id != 0) { // calculate percent price for invite friend
                                // InviteTransaction
                                $totalPriceReserve = $paymentModel->price+$paymentModel->remaining_price;
                                $invitePercent = config('setting.InvitePercent');
                                $invitePercentPrice = $totalPriceReserve*$invitePercent/100;
                                $inviteTransactionModel = new InviteTransaction();
                                $inviteTransactionModel->user_id = auth()->user()->id;
                                $inviteTransactionModel->parent_user_id = auth()->user()->parent_id;
                                $inviteTransactionModel->price = $invitePercentPrice;
                                if($inviteTransactionModel->save()) {
                                    $parentUser = User::where('id', auth()->user()->parent_id)->first();
                                    if(!empty($parentUser)) {
                                        $creditUser = $parentUser->credit;
                                        $creditUser = $creditUser + $invitePercentPrice;
                                        $parentUser->credit = $creditUser;
                                        if($parentUser->save()) {
                                            /** Deposit into guest_user's wallet */
                                            $walletModel = new Wallet();
                                            $walletModel->user_id = $parentUser->id;
                                            $walletModel->reserve_code = $paymentModel->reserve_code;
                                            $walletModel->payment_id = $paymentModel->id;
                                            $walletModel->price = $invitePercentPrice;
                                            $walletModel->type = 1; // variz
                                            $walletModel->award = 1; // padash baraye davat az dostan
                                            $walletModel->description = 'واریز به کیف پول بابت دعوت از دوستان';
                                            $walletModel->save();
                                        }
                                    }
                                }
                            }
                            DB::table('reserves')
                                ->where('group_code', $paymentModel->reserve_code)
                                ->where('status', 1)
                                ->update(['status' => 2, 'step' => 3, 'type_payment' => 2]); // type_payment = 2 "payment with wallet"
                            $reserveModel = Reserve::with('getHost')->with('getHost.getUser')->where('group_code', $paymentModel->reserve_code)->where('status', 2)->first();
                            SmsController::SendSuccessSMS($reserveModel->getHost->getUser->mobile, $reserveModel->getUser->mobile, $final_price);
                            SmsController::SendSuccessSMS2($reserveModel->getUser->mobile, $reserveModel->getHost->getUser->mobile,$reserveModel->latitude,$reserveModel->longitude,$reserveModel->address);
                        }
                        PrintMessage('پرداخت از طریق کیف پول با موفقیت انجام شد.', 'success');
                        return redirect(route('IndexPayment'));
                    } else {
                        PrintMessage('خطا در برداشت وجه، لطفا مجددا تلاش نمایید.', 'danger');
                        return redirect(route('IndexPayment'));
                    }
                }
            } else {
                PrintMessage('خطا در ارسال اطلاعات، لطفا با واحد پشتیبانی تماس بگیرید.', 'danger');
                return redirect(route('IndexPayment'));
            }
        }
    }





    public function PaymentReserve(Request $request)
    {


        $reserveModel = Reserve::where('group_code', $request->code)->get();
        $hostModel = Host::where('id', $reserveModel[0]->host_id)->first();
        $sitePercent = config('setting.SitePercent');
        $invitePercent = config('setting.InvitePercent');
        $totalPrice = 0; /** all price reserve */
        $prePrice = 0; /** pish pardakht reserve */
        $wage = 0; /** karmozd site */

        if($hostModel->cancel_rule_id == 1 || $hostModel->cancel_rule_id == 2) {
            foreach ($reserveModel as $key => $value) { /** all price */
                $totalPrice = $totalPrice + $value->final_price;
            }
            if(count($reserveModel) > 2) { /** pish pardakht */
                foreach ($reserveModel as $key => $value) {
                    if($key == 2) { /** 2 roze aval reserve */
                        break 1;
                    }
                    $wage = $totalPrice*($sitePercent+$invitePercent)/100; // site percent
                    $totalPrice_ = $totalPrice - $wage;
                    $preTotal = $totalPrice_ / count($reserveModel); // for avg 2 days
                    $prePrice = $preTotal * 2; // calculate 2 days for pre price
                    $prePrice = round($prePrice/1000) * 1000;
                }
                $wage = $totalPrice*($sitePercent+$invitePercent)/100;
            }
        } elseif($hostModel->cancel_rule_id == 3) { /** sakhtgirane */
            foreach ($reserveModel as $key => $value) { /** all price */
                $totalPrice = $totalPrice + $value->final_price;
            }
        } else {
            return 'Error 0000000000889E5';
        }

        if($request->type == 1) { // all price reserve
            $pricePayment = $totalPrice;
            $remainingPricePayment = 0;
            $this->ReserveBankPortal($pricePayment, $remainingPricePayment, $request->code);
        } elseif($request->type == 2) { // pre payment reserve
            $pricePayment = $prePrice + $wage;
            $remainingPricePayment = $totalPrice - $pricePayment;
            $this->ReserveBankPortal($pricePayment, $remainingPricePayment, $request->code);
        } else {
            return 'Error 00000000000776T5';
        }

//        $reserveModel = Reserve::where('group_code', $request->code)->get();
//        $hostModel = Host::where('id', $reserveModel[0]->id)->first();
//
//        $totalPrice = 0;
//        foreach ($reserveModel as $key => $value) {
//            $totalPrice = $totalPrice + $value->final_price;
//        }
//
////        $cancelRule = config('setting.CancelReserveRule');
//
//
//        $this->ReserveBankPortal($totalPrice, $request->code);
    }

    /***************************************************
     *************** BANK PORTAL CHARGE ****************
     ***************************************************/

    public function ReserveBankPortal($price, $remainingPricePayment, $code)
    {
        $res = $this->BankPortal($price, $remainingPricePayment, $code);
        return $res;
    }

    public function CallbackURL(Request $request)
    {
        if ($request->Status == "OK") {
            $this->TransactionBank($request->Authority, $request->Status);
            // SEND TO VIEW //
            return redirect(route('IndexPayment'));
        } elseif ($request->Status == "NOK") {
            return redirect(route('IndexPayment'));
        } else {
            return redirect(route('IndexPayment'));
        }
    }

    public function CallbackURLWallet(Request $request)
    {
        if ($request->Status == "OK") {
            $this->TransactionChargeWallet($request->Authority, $request->Status);
            // SEND TO VIEW //
            return redirect(route('IndexPayment'));
        } elseif ($request->Status == "NOK") {
            return redirect(route('IndexPayment'));
        } else {
            return redirect(route('IndexPayment'));
        }
    }

    public function BankPortal($price, $remainingPricePayment, $code)
    {
        $MerchantID = '6f6e74ba-31d1-11e9-aa83-005056a205be'; //Required
        $Amount = $price; //Amount will be based on Toman - Required
        $Description = 'تسویه حساب برای رزرو اقامتگاه'; // Required
        $Email = ''; // Optional
        $Mobile = ''; // Optional
        $CallbackURL = route('CallbackURL'); // Required

        $client = new \SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

        $result = $client->PaymentRequest(
            [
                'MerchantID' => $MerchantID,
                'Amount' => $Amount,
                'Description' => $Description,
                'Email' => $Email,
                'Mobile' => $Mobile,
                'CallbackURL' => $CallbackURL,
            ]
        );
        //Redirect to URL You can do it also by creating a form
        if ($result->Status == 100) {
            $paymentModel = new Payment();
            $paymentModel->price = $price;
            $paymentModel->remaining_price = $remainingPricePayment;
            $paymentModel->user_id = auth()->user()->id;
            $paymentModel->tracking_code = $result->Authority;
            $paymentModel->reserve_code = $code;
            $paymentModel->status = 0;
            $paymentModel->type = 1;
            if ($paymentModel->save()) {
                Header('Location: https://www.zarinpal.com/pg/StartPay/' . $result->Authority);
            }
        } else {
            return $result;
        }
    }

    public function TransactionBank($authority, $status)
    {
        $paymentModel = Payment::where('tracking_code', $authority)->first();
        $MerchantID = '6f6e74ba-31d1-11e9-aa83-005056a205be';
        $Amount = $paymentModel->price; //Amount will be based on Toman
        $Authority = $authority;

        if ($status == 'OK') {
            $client = new \SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

            $result = $client->PaymentVerification(
                [
                    'MerchantID' => $MerchantID,
                    'Authority' => $Authority,
                    'Amount' => $Amount,
                ]
            );

            if ($result->Status == 100) {
                $paymentModel->ref_id = $result->RefID;
                $paymentModel->status = 1;
                if ($paymentModel->save()) {
                    if(auth()->user()->parent_id != 0) { // calculate percent price for invite friend
                        // InviteTransaction
                        $totalPriceReserve = $paymentModel->price+$paymentModel->remaining_price;
                        $invitePercent = config('setting.InvitePercent');
                        $invitePercentPrice = $totalPriceReserve*$invitePercent/100;
                        $inviteTransactionModel = new InviteTransaction();
                        $inviteTransactionModel->user_id = auth()->user()->id;
                        $inviteTransactionModel->parent_user_id = auth()->user()->parent_id;
                        $inviteTransactionModel->price = $invitePercentPrice;
                        if($inviteTransactionModel->save()) {
                            $parentUser = User::where('id', auth()->user()->parent_id)->first();
                            if(!empty($parentUser)) {
                                $creditUser = $parentUser->credit;
                                $creditUser = $creditUser + $invitePercentPrice;
                                $parentUser->credit = $creditUser;
                                if($parentUser->save()) {
                                    /** Deposit into guest_user's wallet */
                                    $walletModel = new Wallet();
                                    $walletModel->user_id = $parentUser->id;
                                    $walletModel->reserve_code = $paymentModel->reserve_code;
                                    $walletModel->payment_id = $paymentModel->id;
                                    $walletModel->price = $invitePercentPrice;
                                    $walletModel->type = 1; // variz
                                    $walletModel->award = 1; // padash baraye davat az dostan
                                    $walletModel->description = 'واریز به کیف پول بابت دعوت از دوستان';
                                    $walletModel->save();
                                }
                            }
                        }
                    }
                    DB::table('reserves')
                        ->where('group_code', $paymentModel->reserve_code)
                        ->where('status', 1)
                        ->update(['status' => 2, 'step' => 3]);
                    $reserveModel = Reserve::with('getHost')->with('getHost.getUser')->where('group_code', $paymentModel->reserve_code)->where('status', 2)->first();
                    $priceSms = $totalPriceReserve-$paymentModel->remaining_price;
                    SmsController::SendSuccessSMS($reserveModel->getHost->getUser->mobile, $reserveModel->getUser->mobile, $priceSms);
                    SmsController::SendSuccessSMS2($reserveModel->getUser->mobile, $reserveModel->getHost->getUser->mobile,$reserveModel->latitude,$reserveModel->longitude,$reserveModel->address);
                }
                return $result;
            } else {
                echo 'Transaction failed. Status:' . $result->Status;
            }
        } else {
            echo 'Transaction canceled by user';
        }
    }

    public function TransactionChargeWallet($authority, $status)
    {
        $paymentModel = Payment::where('tracking_code', $authority)->first();
        $MerchantID = '6f6e74ba-31d1-11e9-aa83-005056a205be';
        $Amount = $paymentModel->price; //Amount will be based on Toman
        $Authority = $authority;

        if ($status == 'OK') {
            $client = new \SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);

            $result = $client->PaymentVerification(
                [
                    'MerchantID' => $MerchantID,
                    'Authority' => $Authority,
                    'Amount' => $Amount,
                ]
            );

            if ($result->Status == 100) {
                $paymentModel->ref_id = $result->RefID;
                $paymentModel->status = 1;
                if ($paymentModel->save()) {
                    $userModel = User::where('id', $paymentModel->user_id)->first();
                    $credit = $userModel->credit;
                    $credit = $credit + $paymentModel->price;
                    $userModel->credit = $credit;
                    if($userModel->save()) {
                        PrintMessage('شارژ کیف پول با موفقیت انجام شد.', 'success');
                        return redirect(route('IndexPayment'));
                    } else {
                        PrintMessage('خطا در شارژ کیف پول، لطفا مجددا تلاش نمایید.', 'warning');
                        return redirect(route('IndexPayment'));
                    }
                } else {
                    PrintMessage('خطا در ثبت اطلاعات، لطفا مجددا تلاش نمایید.', 'warning');
                    return redirect(route('IndexPayment'));
                }
                return $result;
            } else {
                echo 'Transaction failed. Status:' . $result->Status;
            }
        } else {
            echo 'Transaction canceled by user';
        }
    }


    public function StoreAccount(Request $request) {
        $Message = [
            'full_name.required' => 'نام صاحب حساب نمیتواند خالی باشد .',
            'number_card.required' => 'شماره کارت نمیتواند خالی باشد .',
            'shaba.required' => 'شماره شبا نمیتواند خالی باشد .',
        ];
        $this->validate($request, [
            'full_name' => 'required',
            'number_card' => 'required',
            'shaba' => 'required',
        ], $Message);
        auth()->user()->account_name = $request->full_name;
        auth()->user()->card_bank_number = $request->number_card;
        auth()->user()->shaba_number = $request->shaba;
        if(auth()->user()->save()) {
            PrintMessage('ثبت حساب با موفقیت انجام شد.', 'success');
            return redirect(route('IndexPayment'));
        }
    }

    public function DeleteAccount($id) {
        $accountModel = Account::where('id', $id)->where('user_id', auth()->user()->id)->first();
        if(!empty($accountModel)) {
            $accountModel->delete();
            PrintMessage('حساب بانکی با موفقیت از سیستم حذف شد.', 'success');
            return back();
        } else {
            return back();
        }
    }

    public function StoreDescriptionPayment(Request $request) {
        $paymentModel = Payment::where('id', $request->payment_id)->first();
        $paymentModel->description = $request->description;
        if($paymentModel->save()) {
            PrintMessage('ثبت توضیحات موفقیت آمیز بود.', 'success');
            return back();
        }
    }
}
