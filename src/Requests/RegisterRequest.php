<?php

namespace App\Requests;

/**
 * Class RegisterRequest
 * 
 * مسؤول عن التحقق من صحة بيانات التسجيل.
 */
class RegisterRequest
{
    /**
     * يتحقق من صحة بيانات التسجيل.
     *
     * @param array $data مصفوفة تحتوي على بيانات الإدخال مثل 'username', 'email', 'password', و 'password_confirm'.
     * @return array قائمة الأخطاء الناتجة عن التحقق، فارغة إذا كانت البيانات صحيحة.
     */
    public static function validate(array $data): array
    {
        $errors = [];

        $username = trim($data['username'] ?? '');
        $email = trim($data['email'] ?? '');
        $password = $data['password'] ?? '';
        $password_confirm = $data['password_confirm'] ?? '';

        if (mb_strlen($username) < 3) {
            $errors[] = "اسم المستخدم يجب أن يكون 3 أحرف على الأقل.";
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "بريد إلكتروني غير صالح.";
        }

        if (mb_strlen($password) < 6) {
            $errors[] = "كلمة المرور يجب أن تكون 6 أحرف على الأقل.";
        }

        if ($password !== $password_confirm) {
            $errors[] = "تأكيد كلمة المرور غير مطابق.";
        }

        return $errors;
    }
}
