<?php

namespace App\Controllers;

use App\Services\AdminAuthService;
use App\Requests\AdminRequest;

/**
 * Class AdminAuthController
 * 
 * مسؤول عن معالجة تسجيل المستخدم وتسجيل الدخول والخروج.
 */
class AdminAuthController
{

    private AdminAuthService $auth;

    /**
     * منشئ الكائن
     *
     * @param \PDO $pdo اتصال قاعدة البيانات
     */
    public function __construct($pdo)
    {
        $this->auth = new AdminAuthService($pdo);
    }
    /**
     * تسجيل دخول المستخدم
     *
     * @param array $data بيانات الدخول ['email' => string, 'password' => string]
     * @return array قائمة الأخطاء (فارغة إذا نجح الدخول)
     */
    public function login(array $data)
    {
        $errors = AdminRequest::validate($data);
        if (!empty($errors)) {
            return $errors;
        }

        $user = $this->auth->login($data['name'], $data['password']);
        if ($user) {
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            return [];
        }

        return ['بيانات الدخول غير صحيحة.'];
    }

    /**
     * تسجيل خروج المستخدم
     *
     * @return void
     */
    public function logout()
    {
        session_unset();
        session_destroy();
    }
}
