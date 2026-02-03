<?php

use PHPUnit\Event\Runtime\PHP;

return [
    'public' => [
        'success' => 'درخواست با موفقیت انجام شد.',
        'error' => [
            'internal_server_error' => 'درخواست شما با خطا مواجه شد لطفا مجددا تلاش نمایید.',
            'validation' => 'داده ورودی نامعتبر است. لطفا با واحد پشتیبانی در تماس باشید.',
            'not_found' => 'اطلاعات یافت نشد.',
            'not_exist' => ':pattern یافت نشد.',
            'access_denied' => 'فاقد دسترسی لازم هستید.',
            'invalid_insert' => 'امکان درج :pattern وجود ندارد.',
            'invalid_delete' => 'امکان حذف :pattern وجود ندارد.',
            'invalid' => ':pattern معتبر نیست',
            'unique' => ':pattern نباید تکراری باشد',
            'required' => ':pattern اجباری است',
            'not_confirmed' => ':pattern تایید نشده است',
            'api' => 'عملیات با شکست مواجه شد. لطفا مجدد تلاس نمایید.',
        ],
    ],
    'user' => [
        'invalid_type' => 'نوع شخص انتخاب شده نامعتبر است',
        'invalid_code' => 'کد تایید نامعتبر است.',
        'not_registerd' => 'شما هنوز ثبت نام نکرده اید، برای ورود ابتدا یک حساب کاربری ایجاد کنید.',
        'send_code_message' => "کد ورود به زودکس"  . PHP_EOL . "code: :code" . PHP_EOL . "لغو 11",
        'wrong_username_or_password' => 'نام کاربری یا کلمه عبور اشتباه است'
    ],
    'wealth' => [
        'empty_price_wight' => 'مبلغ یا مقدار را وارد نمیید.',
        'fill_both_price_weight' => 'فقط یکی از فیلدهای مقدار یا مبلغ را وارد نمایید.'
    ]

];
