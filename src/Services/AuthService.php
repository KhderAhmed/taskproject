<?php

namespace App\Services;

use PDO;

/**
 * Class AuthService
 * 
 * مسؤول عن تسجيل الدخول والتسجيل للمستخدمين باستخدام قاعدة بيانات PDO.
 */
class AuthService
{
    private PDO $pdo;

    /**
     * إنشاء خدمة المصادقة.
     *
     * @param PDO $pdo اتصال قاعدة البيانات.
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * تسجيل مستخدم جديد.
     *
     * يقوم بتخزين اسم المستخدم، البريد، وكلمة المرور (مشفرة) في قاعدة البيانات.
     *
     * @param string $username اسم المستخدم.
     * @param string $email البريد الإلكتروني.
     * @param string $password كلمة المرور العادية.
     * @return bool نجاح العملية (true) أو فشل (false، مثلاً البريد مستخدم مسبقاً).
     */
    public function register(string $username, string $email, string $password): bool
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO users (username, email, password) VALUES (:username, :email, :password)");
        try {
            return $stmt->execute([
                ':username' => $username,
                ':email' => $email,
                ':password' => $hash,
            ]);
        } catch (\PDOException $e) {
            // احتمال وجود بريد مستخدم مسبقاً بسبب قيد UNIQUE
            return false;
        }
    }

    /**
     * تسجيل دخول المستخدم.
     *
     * يتحقق من البريد وكلمة المرور، ويرجع بيانات المستخدم عند النجاح.
     *
     * @param string $email البريد الإلكتروني.
     * @param string $password كلمة المرور العادية.
     * @return array|null مصفوفة تحتوي على 'id' و 'username' عند النجاح، أو null عند الفشل.
     */
    public function login(string $email, string $password): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE email = :email LIMIT 1");
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            return ['id' => $user['id'], 'username' => $user['username']];
        }
        return null;
    }
}
