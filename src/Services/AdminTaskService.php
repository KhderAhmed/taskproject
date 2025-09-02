<?php

namespace App\Services;

use PDO;
use App\Models\MyTasks;

/**
 * Class TaskService
 * 
 * مسؤول عن إدارة مهام المستخدم (CRUD) في قاعدة البيانات.
 */
class AdminTaskService
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
     * @param int $admin_Id معرف المستخدم.
     * @return MyTasks[] مصفوفة من كائنات Task.
     */
    public function getTasksByAdmin(int $admin_Id): array
    {

        $stmt = $this->pdo->prepare("SELECT * FROM mytasks WHERE admin_id = :uid ORDER BY created_at DESC");
        $stmt->execute([':uid' => $admin_Id]);
        $rows = $stmt->fetchAll();
        $tasks = [];
        foreach ($rows as $r) {
            $tasks[] = new MyTasks($r['id'], $r['admin_id'], $r['title'], $r['completed']);
        }
        return $tasks;
    }

    /**
     * إضافة مهمة جديدة لمستخدم.
     *
     * @param int $admin_Id معرف المستخدم.
     * @param string $title عنوان المهمة.
     * @return bool نجاح الإضافة (true) أو فشل (false).
     */
    public function addTask(int $admin_Id, string $title): bool
    {
        $stmt = $this->pdo->prepare("INSERT INTO mytasks (admin_id, title) VALUES (:uid, :title)");
        return $stmt->execute([':uid' => $admin_Id, ':title' => $title]);
    }

    /**
     * حذف مهمة معينة لمستخدم.
     *
     * @param int $id معرف المهمة.
     * @param int $admin_Id معرف المستخدم.
     * @return bool نجاح الحذف (true) أو فشل (false).
     */
    public function deleteTask(int $id, int $admin_Id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM mytasks WHERE id = :id AND admin_id = :uid");
        return $stmt->execute([':id' => $id, ':uid' => $admin_Id]);
    }

    /**
     * تبديل حالة إنجاز المهمة (مكتملة/غير مكتملة).
     *
     * @param int $id معرف المهمة.
     * @param int $admin_Id معرف المستخدم.
     * @return bool نجاح التحديث (true) أو فشل (false).
     */
    public function toggleTask(int $id, int $admin_Id): bool
    {
        // تغيير قيمة completed إلى العكس (1 تصبح 0، و0 تصبح 1)
        $stmt = $this->pdo->prepare("UPDATE mytasks SET completed = NOT completed WHERE id = :id AND admin_id = :uid");
        return $stmt->execute([':id' => $id, ':uid' => $admin_Id]);
    }
}
