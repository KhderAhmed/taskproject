<?php

namespace App\Controllers;

use App\Models\User;
use PDO;

class AdminUsersController
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
     * استرجاع قائمة المهام لمستخدم معين
     *
     * @param int $userId معرف المستخدم
     * @return array قائمة المهام
     */
    public function listUser(int $userId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :uid ORDER BY created_at DESC");
        $stmt->execute([':uid' => $userId]);
        $rows = $stmt->fetchAll();
        $users = [];
        foreach ($rows as $r) {
            $users[] = new User($r['id'], $r['username'], $r['email'],$r['created_at'] );
        }
        return $users;
    }
}
