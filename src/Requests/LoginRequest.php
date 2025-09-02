<?php

namespace App\Requests;

/**
 * Class LoginRequest
 * 
 * مسؤول عن التحقق من صحة بيانات تسجيل الدخول.
 */
class LoginRequest
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
        $email = trim($data['email'] ?? '');
        $password = $data['password'] ?? '';

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "بريد إلكتروني غير صالح.";
        }

        if ($password === '') {
            $errors[] = "كلمة المرور مطلوبة.";
        }

        return $errors;
    }
}
