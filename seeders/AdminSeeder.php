<?php

namespace Seeders;

use App\Database\Database;

class AdminSeeder
{
    public function run()
    {
        $pdo = Database::getConnection();

        $admins = [
            ['name' => 'admin', 'email' => 'admin@gmail.com', 'password' => password_hash('admin123', PASSWORD_DEFAULT)]
        ];

        $stmt = $pdo->prepare("INSERT INTO admins (name, email, password) VALUES (:name, :email, :password)");

        foreach ($admins as $admin) {
            $check = $pdo->prepare("SELECT id FROM admins WHERE email = :email");
            $check->execute(['email' => $admin['email']]);
            if (!$check->fetch()) {
                $stmt->execute($admin);
                echo "👑 أُضيف الأدمن: {$admin['name']}\n";
            } else {
                echo "⚠ الأدمن {$admin['name']} موجود مسبقاً\n";
            }
        }
    }
}
