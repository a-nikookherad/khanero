<?php

namespace App\Modules\Report\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Host\Model\Host;
use App\Modules\Payment\Model\AdminPayment;
use App\Modules\Payment\Model\Payment;
use App\Modules\Payment\Model\Wallet;
use App\Modules\Reserve\Model\Reserve;
use App\Modules\Sms\Controllers\SmsController;
use App\User;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Melipayamak;
use Morilog\Jalali\Facades\jDate;
use Morilog\Jalali\Facades\jDateTime;

class ReportController extends Controller
{
    /***********************
     * Index Report Credit *
     **********************/
    public function IndexReportCredit()
    {
        $creditModel = User::where('credit', '>', 0)->orWhere('payment_wait', '>', 0)->get();
        return view('Report::IndexReportCredit', compact('creditModel'));
    }

    /************************
     * Clearing Credit User *
     ***********************/
    public function ClearingCreditUser($id, $status)
    {
        $userModel = User::where('id', $id)->first();

        if (empty($userModel)) {
            abort(404);
        }

        $credit = $userModel->credit;

        $payment_wait = $userModel->payment_wait; // waiting payment

        if ($status == 'cancel') {

            $new_payment_wait = $credit + $payment_wait;

            User::where('id', $id)->update(['payment_wait' => 0, 'credit' => $new_payment_wait]);

            PrintMessage('برگشت وجه به کیف پول با موفقیت انجام شد', 'success');

            return back();

        } elseif ($status == 'update' && $payment_wait == 0 && $credit > 0) {

            User::where('id', $id)->update(['payment_wait' => $credit, 'credit' => 0]);

            PrintMessage('به روز رسانی در پرداخت با موفقیت انجام شد', 'success');

            return back();

        } elseif ($status == 'update' && $payment_wait > 0 && $credit > 0) {

            $new_payment_wait = $credit + $payment_wait;

            User::where('id', $id)->update(['payment_wait' => $new_payment_wait, 'credit' => 0]);

            PrintMessage('به روز رسانی در پرداخت با موفقیت انجام شد', 'success');

            return back();

        } elseif ($status == 'confirm' && $payment_wait > 0) { // success

            DB::beginTransaction();
            try {

                /** create admin_payments */
                DB::table('admin_payments')->insert([
                    'user_id' => $id,
                    'bank_receipt_number' => '',
                    'price' => $payment_wait
                ]);


                /** create messages */
                DB::table('messages')->insert([
                    'sender_id' => 1,
                    'receiver_id' => $id,
                    'title' => 'واریز وجه به حساب',
                    'message' => 'با سلام و عرض احترام، مبلغ ' . $payment_wait . ' هزار تومان موجود در کیف پول شما به حساب شماره کارت ' . $userModel->card_bank_number . ' واریز شد',
                    'file' => '',
                    'view' => 0,
                    'sms' => 0,
                    'reply' => 0,
                    'parent_id' => 0,
                ]);


                /** create wallets */
                DB::table('wallets')->insert([
                    'user_id' => $id,
                    'reserve_code' => 1,
                    'payment_id' => 0,
                    'price' => $payment_wait,
                    'type' => 2, // bardasht
                    'award' => 0,
                    'description' => 'مبلغ ' . $payment_wait . ' هزار تومان از کیف پول شما به حساب شماره کارت ' . $userModel->card_bank_number . ' واریز شد',
                ]);


                /** update credit user */
                DB::table('users')
                    ->where('id', $id)
                    ->update(['payment_wait' => 0]);


                /** commit transaction */
                DB::commit();
                // all good


                /** send sms for user */


                PrintMessage(' پرداخت با موفقیت انجام شد', 'success');

                return back();


            } catch (\Exception $e) {

                DB::rollback();
                // something went wrong

                PrintMessage('خطا در به روز رسانی در پرداخت، لطفا مجددا تلاش نمایید', 'danger');

                return back();

            }

        } else {
            return 'Error 9GL000000043-E4932';
        }
    }


    public function IndexReportReserve()
    {

        $reserveModelCode_1 = Reserve::with('getHost')->with('getPayment')->whereHas('getPayment', function ($Q) {
            $Q->whereNotNull('reserve_code');
        })
            ->orderBy('id', 'DESC')
            ->where('status', 2)
            ->pluck('group_code');
        $array_code = [];
        foreach ($reserveModelCode_1 as $value) {
            $array_code[] = $value;
        }
        $reserveModelCode = array_unique($array_code);

        if (count($reserveModelCode) > 0) {
            foreach ($reserveModelCode as $key => $value) {
                $s = Reserve::where('group_code', $value)->get();
                $paymentModel = Payment::where('reserve_code', $value)
                    ->where('status', 1)->first();
                foreach ($s as $index => $item) {
                    $hostModel = Host::where('id', $item->host_id)->first();
                    $array_reserve[$value]['id'] = $item->id;
                    $array_reserve[$value]['host_detail'] = $hostModel;
                    $array_reserve[$value]['reserve_user'] = $item->getUser;
                    $array_reserve[$value]['date_reserve'][] = $item->reserve_date;
                    $array_reserve[$value]['week_id'][] = $item->week_id;
                    $array_reserve[$value]['day_price'][] = $item->day_price;
                    $array_reserve[$value]['special'][] = $item->special;
                    $array_reserve[$value]['special_price'][] = $item->special_price;
                    $array_reserve[$value]['percent'][] = $item->percent;
                    $array_reserve[$value]['final_price'][] = $item->final_price;
                    $array_reserve[$value]['submit_rate'] = $item->submit_rate;
                    $array_reserve[$value]['status'] = $item->status;
                    $array_reserve[$value]['step'] = $item->step;
                    $array_reserve[$value]['type_payment'] = $item->type_payment;
                    $array_reserve[$value]['level_reserve'] = $item->level_reserve;
                    $array_reserve[$value]['description'] = $item->description;
                    $array_reserve[$value]['payment'] = $paymentModel;
                }
            }
        } else {
            return 'empty code';
        }


        // -100 status

        $reserveModelCode_100 = Reserve::with('getHost', 'getPayment')->whereHas('getPayment', function ($Q) {
            $Q->whereNotNull('reserve_code');
        })
            ->where('status', -2)
            ->where('step', 3)
            ->orderBy('id', 'DESC')
            ->pluck('group_code');
        $array_code_100 = [];
//        return $reserveModelCode_100;
        foreach ($reserveModelCode_100 as $value) {
            $array_code_100[] = $value;
        }
        $reserveModelCode_100 = array_unique($array_code_100);

        if (count($reserveModelCode_100) > 0) {
            foreach ($reserveModelCode_100 as $key => $value) {
                $s_100 = Reserve::where('group_code', $value)->get();
                $paymentModel_100 = Payment::where('reserve_code', $value)
                    ->where('status', 1)->first();
                $wallet = Wallet::where('reserve_code', $value)->where('award', 0)->get();
                foreach ($s_100 as $index => $item) {
                    $hostModel = Host::where('id', $item->host_id)->first();
                    $array_reserve_100[$value]['id'] = $item->id;
                    $array_reserve_100[$value]['host_detail'] = $hostModel;
                    $array_reserve_100[$value]['reserve_user'] = $item->getUser;
                    $array_reserve_100[$value]['date_reserve'][] = $item->reserve_date;
                    $array_reserve_100[$value]['week_id'][] = $item->week_id;
                    $array_reserve_100[$value]['day_price'][] = $item->day_price;
                    $array_reserve_100[$value]['special'][] = $item->special;
                    $array_reserve_100[$value]['special_price'][] = $item->special_price;
                    $array_reserve_100[$value]['percent'][] = $item->percent;
                    $array_reserve_100[$value]['final_price'][] = $item->final_price;
                    $array_reserve_100[$value]['submit_rate'] = $item->submit_rate;
                    $array_reserve_100[$value]['status'] = $item->status;
                    $array_reserve_100[$value]['step'] = $item->step;
                    $array_reserve_100[$value]['type_payment'] = $item->type_payment;
                    $array_reserve_100[$value]['level_reserve'] = $item->level_reserve;
                    $array_reserve_100[$value]['description'] = $item->description;
                    $array_reserve_100[$value]['payment'] = $paymentModel_100;
                    $array_reserve_100[$value]['wallet'] = $wallet;
                }
            }
        } else {
            return 'empty code 100';
        }


        // 0 : در خواست 1 : در انتظار پرداخت 2 :پردات شده -1 : رد شده -2 : کنسل شده توسط کاربر -100:منقضی شده
//        dd($array_reserve_100);

        return view('Report::indexReportReserve', compact('array_reserve', 'array_reserve_100'));
    }


    public function IndexReportChart()
    {
        return view('Report::indexReportChart');
    }


    public function IndexAllCredit()
    {
        $countReserve = Reserve::where('status', 2)->where('step', 3)->count();
        $paymentBankTotal = Payment::where('status', 1)->where('type', 1)
            ->where('tracking_code', '!=', 'wallet')->sum('price'); // just bank
        $paymentWalletTotal = Payment::where('status', 1)->where('type', 2)
            ->where('reserve_code', 'CHARGE-WALLET')
            ->where('tracking_code', '!=', 'wallet')->sum('price'); // just wallet
        $paymentReserveModel = Reserve::with('getPayment')->whereHas('getPayment', function ($Q) {
            $Q->whereNotNull('reserve_code');
        })
            ->where('status', -2)
            ->where('step', 3)
            ->orderBy('id', 'DESC')
            ->pluck('group_code');
        $array_code_100 = [];
        foreach ($paymentReserveModel as $value) {
            $array_code_100[] = $value;
        }
        $reserveModelCode = array_unique($array_code_100);

        if (count($reserveModelCode) > 0) {
            foreach ($reserveModelCode as $key => $value) {
                $s_100 = Reserve::where('group_code', $value)->get();
                $wallet = Wallet::where('reserve_code', $value)->where('award', 0)->get();
                foreach ($s_100 as $index => $item) {
                    $array_reserve[$value]['wallet'] = $wallet;
                }
            }
            $totalPenaltyGuest = 0;
            $totalPenaltyHost = 0;
            foreach ($array_reserve as $key => $value) {
                $totalPenaltyGuest = $totalPenaltyGuest + $value['wallet'][0]->price;// واریز به کیف پول میزبان بابت انصراف از رزرو توسط میهمان
                $totalPenaltyHost = $totalPenaltyHost + $value['wallet'][1]->price; // واریز به کیف پول میهمان بابت انصراف از رزرو با احتساب جریمه
            }
        }

        $percentReserveModel = Payment::where('status', 1)->where('tracking_code', '!=', 'CHARGE-WALLET')->sum('price');
//        dd($percentReserveModel);


        return view('Report::indexAllCredit', compact('countReserve',
            'paymentBankTotal',
            'paymentWalletTotal',
            'totalPenaltyGuest',
            'totalPenaltyHost'));
    }
}