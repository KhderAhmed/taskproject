<?php

namespace App\Controllers;

use PDO;
use App\Models\User;
use App\Models\Task;

class AdminChartController
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * استرجاع المستخدمين لكل شهر كمصفوفة من الكائنات
     * @return array [month => User[]]
     */
    public function getUsersByMonth(): array
    {
        $stmt = $this->pdo->query("
            SELECT * FROM users ORDER BY created_at
        ");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $data = array_fill(1, 12, []); // تهيئة مصفوفة 12 شهر
        foreach ($rows as $r) {
            $month = (int)date('n', strtotime($r['created_at']));
            $data[$month][] = new User($r['id'], $r['username'], $r['email'], $r['created_at']);
        }
        return $data;
    }

    /**
     * استرجاع المهام لكل شهر كمصفوفة من الكائنات
     * @return array [month => Task[]]
     */
    public function getTasksByMonth(): array
    {
        $stmt = $this->pdo->query("
            SELECT * FROM mytasks ORDER BY created_at
        ");
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $data = array_fill(1, 12, []);
        foreach ($rows as $r) {
            $month = (int)date('n', strtotime($r['created_at']));
            $data[$month][] = new Task($r['id'], $r['title'], $r['completed'], $r['created_at']);
        }
        return $data;
    }

    /**
     * لتحويل عدد الكائنات لكل شهر إلى مصفوفة أرقام للـ Chart.js
     */
    public function getUsersCountByMonth(): array
    {
        $users = $this->getUsersByMonth();
        $counts = [];
        foreach ($users as $month => $list) {
            $counts[$month] = count($list);
        }
        return $counts;
    }

    public function getTasksCountByMonth(): array
    {
        $tasks = $this->getTasksByMonth();
        $counts = [];
        foreach ($tasks as $month => $list) {
            $counts[$month] = count($list);
        }
        return $counts;
    }
}
