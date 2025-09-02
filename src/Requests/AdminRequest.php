<?php

namespace App\Requests;


/**
 * Class AdminRequest
 * 
 * مسؤول عن التحقق من صحة بيانات تسجيل الدخول.
 */
class AdminRequest
{
    /**
     * يتحقق من صحة بيانات تسجيل الدخول.
     *
     * @param array $data مصفوفة تحتوي على بيانات الإدخال مثل 'email' و 'password'.
     * @return array قائمة الأخطاء الناتجة عن التحقق، فارغة إذا كانت البيانات صحيحة.
     */
    public static function validate(array $data): array
    {
        $errors = [];
        $name = trim($data['name'] ?? '');
        $password = $data['password'] ?? '';

        if (!filter_var($name)) {
            $errors[] = "بريد إلكتروني غير صالح.";
        }

        if ($password === '') {
            $errors[] = "كلمة المرور مطلوبة.";
        }

        return $errors;
    }
}
