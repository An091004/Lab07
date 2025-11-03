<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NoForbiddenWords implements Rule
{
    /**
     * Danh sách các từ bị cấm
     *
     * @var array<string>
     */
    protected $forbiddenWords = [
        'spam',
        'xxx',
        'hack',
    ];

    /**
     * Xác định xem giá trị đầu vào có hợp lệ hay không.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Chuyển giá trị về chuỗi và lowercase để kiểm tra
        $lower = mb_strtolower((string)$value, 'UTF-8');

        // Kiểm tra từng từ cấm
        foreach ($this->forbiddenWords as $word) {
            if (str_contains($lower, $word)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Lấy thông báo lỗi validation.
     *
     * @return string
     */
    public function message()
    {
        return 'Trường :attribute chứa từ không được phép sử dụng.';
    }
}
