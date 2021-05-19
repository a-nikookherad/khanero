<?php
return [
    'SitePercent' => 4, // کارمزد
    'InvitePercent' => 1,//کارمزد دعوت
    'CancelReserveRule' => array(
        ///\\\/// سهلگیرانه \\\///\\\
        '1' => array(
            'id' => 1,
            'name' => 'سهلگیرانه',
            'time' => array(
                '1' => array(
                    'time' => 24, // hour
                    'penalty' => 10, // percent
                    'percent' => true,
                    'hour' => false,
                    'description' => 'در صورتی که رزرو 24 ساعت قبل از تاریخ ورود لغو گردد، پس از کسر کارمزد و 10 درصد (جریمه)، باقیمانده به مهمان بازپرداخت میشود',
                ),
                '2' => array(
                    'time' => 24, // hour
                    'penalty' => 48, // hour
                    'percent' => false,
                    'hour' => true,
                    'description' => 'در صورتی که رزرو کمتر از 24 ساعت مانده به تاریخ ورود لغو گردد، پس از کسر کارمزد و هزینه 2 شب اجاره (جریمه)، باقیمانده به مهمان بازپرداخت میشود'
                ),
                '3' => array(
                    'time' => 24, // hour
                    'penalty' => 48, // hour
                    'percent' => false,
                    'hour' => true,
                    'description' => 'در صورتی که رزرو از تاریخ ورود تا 24 ساعت بعد از تاریخ ورود لغو گردد (تصمیم به خروج زودتر از موعد)، پس از کسر کارمزد و 2 شب اجاره (جریمه)، باقیمانده به مهمان بازپرداخت میشود'
                )
            )
        ),
        ///\\\/// متعادل \\\///\\\
        '2' => array(
            'id' => 2,
            'name' => 'متعادل',
            'time' => array(
                '1' => array(
                    'time' => 72, // hour
                    'penalty' => 10, // percent
                    'percent' => true,
                    'hour' => false,
                    'description' => 'در صورتی که رزرو 72 ساعت قبل از تاریخ ورود لغو گردد، پس از کسر کارمزد و 10 درصد (جریمه)، باقیمانده به مهمان بازپرداخت میشود'
                ),
                '2' => array(
                    'time' => 72, // hour
                    'penalty' => 48, // hour
                    'percent' => false,
                    'hour' => true,
                    'description' => 'در صورتی که رزرو کمتر از 72 ساعت مانده به تاریخ ورود لغو گردد، پس از کسر کارمزد و هزینه 2 شب اجاره (جریمه)، باقیمانده به مهمان بازپرداخت میشود'
                ),
                '3' => array(
                    'time' => 24, // hour
                    'penalty' => 48, // hour
                    'percent' => false,
                    'hour' => true,
                    'description' => 'در صورتی که رزرو از تاریخ ورود تا 24 ساعت بعد از تاریخ ورود لغو گردد (تصمیم به خروج زودتر از موعد)، پس از کسر کارمزد و 2 شب اجاره (جریمه)، باقیمانده به مهمان بازپرداخت میشود'
                )
            )
        ),
        ///\\\/// سختگیرانه \\\///\\\
        '3' => array(
            'id' => 3,
            'name' => 'سختگیرانه',
            'time' => array(
                '1' => array(
                    'time' => 168, // hour
                    'penalty' => 50, // percent
                    'percent' => true,
                    'hour' => false,
                    'description' => 'در صورتی که رزرو 7 روز کامل قبل از تاریخ ورود لغو گردد، پس از کسر کارمزد و 50 درصد (جریمه)، باقیمانده به مهمان بازپرداخت میشود'
                ),
                '2' => array(
                    'time' => 168, // hour
                    'penalty' => 100, // percent
                    'percent' => true,
                    'hour' => false,
                    'description' => 'در صورتی که رزرو کمتر از 7 روز کامل مانده به تاریخ ورود لغو گردد، هیچ مبلغی بازپرداخت نخواهد شد'
                ),
                '3' => array(
                    'time' => 24, // hour
                    'penalty' => 100, // percent
                    'percent' => true,
                    'hour' => false,
                    'description' => 'در صورتی که رزرو از تاریخ ورود تا 24 ساعت بعد از تاریخ ورود لغو گردد (تصمیم به خروج زودتر از موعد)، هیچ مبلغی بازپرداخت نخواهد شد'
                )
            )
        ),
    )
];