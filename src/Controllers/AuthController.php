<?php

namespace App\Controllers;

use App\Services\AuthService;
use App\Requests\RegisterRequest;
use App\Requests\LoginRequest;

/**
 * Class AuthController
 * 
 * مسؤول عن معالجة تسجيل المستخدم وتسجيل الدخول والخروج.
 */
class AuthController
{
    /**
     * @var AuthService خدمة المصادقة
     */
    private AuthService $auth;

    /**
     * منشئ الكائن
     *
     * @param \PDO $pdo اتصال قاعدة البيانات
     */
    public function __construct($pdo)
    {
        $this->auth = new AuthService($pdo);
    }

    /**
     * تسجيل مستخدم جديد
     *
     * @param array $data بيانات التسجيل ['username' => string, 'email' => string, 'password' => string]
     * @return array قائمة الأخطاء (فارغة إذا نجح التسجيل)
     */
    public function register(array $data)
    {
        $errors = RegisterRequest::validate($data);
        if (!empty($errors)) {
            return $errors;
        }

        $ok = $this->auth->register($data['username'], $data['email'], $data['password']);
        if (!$ok) {
            return ['حدث خطأ أو البريد مستخدم مسبقاً.'];
        }

        return [];
    }

    /**
     * تسجيل دخول المستخدم
     *
     * @param array $data بيانات الدخول ['email' => string, 'password' => string]
     * @return array قائمة الأخطاء (فارغة إذا نجح الدخول)
     */
    public function login(array $data)
    {
        $errors = LoginRequest::validate($data);
        if (!empty($errors)) {
            return $errors;
        }

        $user = $this->auth->login($data['email'], $data['password']);
        if ($user) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
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
