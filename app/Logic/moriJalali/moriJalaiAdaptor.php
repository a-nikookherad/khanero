<?php


namespace App\Logic\moriJalali;


class moriJalaiAdaptor implements moriJalaliInterfaceAdapter
{

    /**
     * @var moriJalaiLogic
     */
    private $moriJalai;

    public function __construct(moriJalaiLogic $moriJalai)
    {

        $this->moriJalai = $moriJalai;
    }

    public function forge($value)
    {
      return  $this->moriJalai->forge($value);
    }

    public function createCarbonFromFormat($str,$value)
    {
        return $this->moriJalai->createDatetimeFromFormat($str,$value);
    }
}