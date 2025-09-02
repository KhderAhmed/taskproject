<?php

namespace App\Services;

use PDO;

/**
 * Class AuthService
 * 
 * مسؤول عن تسجيل الدخول والتسجيل للمستخدمين باستخدام قاعدة بيانات PDO.
 */
class AdminAuthService
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
     * تسجيل دخول المستخدم.
     *
     * يتحقق من البريد وكلمة المرور، ويرجع بيانات المستخدم عند النجاح.
     *
     * @param string $name 
     * @param string $password كلمة المرور العادية.
     * @return array|null مصفوفة تحتوي على 'id' و 'username' عند النجاح، أو null عند الفشل.
     */
    public function login(string $name, string $password): ?array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM admins WHERE name = :name");
        $stmt->execute([':name' => $name]);
        $user = $stmt->fetch();
        if ($user && password_verify($password, $user['password'])) {
            return ['id' => $user['id'], 'name' => $user['name']];
        }
        return null;
    }
}
