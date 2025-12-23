<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MobileRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void {
        $value = $this->convert_number($value);
        $pattern = '/^(((98)|(\+98)|(0098)|0)(9){1}[0-9]{9})+$/';
        if(!preg_match($pattern, $value)) {
              $fail('شماره همراه صحیح نمی باشد.');
        }
    }

    public function convert_number($string) {
        $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
        $arabic = ['٩', '٨', '٧', '٦', '٥', '٤', '٣', '٢', '١', '٠'];

        $num = range(0, 9);
        $convertedPersianNums = str_replace($persian, $num, trim($string));
        $english_number = str_replace($arabic, $num, $convertedPersianNums);

        return $english_number;
    }
}
