<?php

namespace App\Services;

use PDO;
use App\Models\Task;

/**
 * Class TaskService
 * 
 * مسؤول عن إدارة مهام المستخدم (CRUD) في قاعدة البيانات.
 */
class TaskService
{
    private PDO $pdo;

    /**
     * إنشاء خدمة المهام.
     *
     * @param PDO $pdo اتصال قاعدة البيانات.
     */
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * جلب قائمة المهام لمستخدم معين.
     *
     * @param int $userId معرف المستخدم.
     * @return Task[] مصفوفة من كائنات Task.
     */
    public function getTasksByUser(int $userId): array
    {
        $stmt = $this->pdo->prepare("SELECT * FROM tasks WHERE user_id = :uid ORDER BY created_at DESC");
        $stmt->execute([':uid' => $userId]);
        $rows = $stmt->fetchAll();
        $tasks = [];
        foreach ($rows as $r) {
            $tasks[] = new Task($r['id'], $r['user_id'], $r['title'], $r['completed']);
        }
        return $tasks;
    }

    /**
     * إضافة مهمة جديدة لمستخدم.
     *
     * @param int $userId معرف المستخدم.
     * @param string $title عنوان المهمة.
     * @return bool نجاح الإضافة (true) أو فشل (false).
     */
    public function addTask(int $userId, string $title): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO tasks (user_id, title) VALUES (:uid, :title)");
        return $stmt->execute([':uid' => $userId, ':title' => $title]);
    }

    /**
     * حذف مهمة معينة لمستخدم.
     *
     * @param int $id معرف المهمة.
     * @param int $userId معرف المستخدم.
     * @return bool نجاح الحذف (true) أو فشل (false).
     */
    public function deleteTask(int $id, int $userId): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM tasks WHERE id = :id AND user_id = :uid");
        return $stmt->execute([':id' => $id, ':uid' => $userId]);
    }

    /**
     * تبديل حالة إنجاز المهمة (مكتملة/غير مكتملة).
     *
     * @param int $id معرف المهمة.
     * @param int $userId معرف المستخدم.
     * @return bool نجاح التحديث (true) أو فشل (false).
     */
    public function toggleTask(int $id, int $userId): bool
    {
        // تغيير قيمة completed إلى العكس (1 تصبح 0، و0 تصبح 1)
        $stmt = $this->pdo->prepare("UPDATE tasks SET completed = NOT completed WHERE id = :id AND user_id = :uid");
        return $stmt->execute([':id' => $id, ':uid' => $userId]);
    }
}
