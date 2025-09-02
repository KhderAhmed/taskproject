<?php

namespace App\Controllers;

use App\Services\TaskService;

/**
 * Class TaskController
 * 
 * مسؤول عن إدارة المهام: عرض، إضافة، حذف، وتبديل حالة المهمة.
 */
class TaskController
{
    /**
     * @var TaskService خدمة المهام
     */
    private TaskService $service;

    /**
     * منشئ الكائن
     *
     * @param \PDO $pdo اتصال قاعدة البيانات
     */
    public function __construct($pdo)
    {
        $this->service = new TaskService($pdo);
    }

    /**
     * استرجاع قائمة المهام لمستخدم معين
     *
     * @param int $userId معرف المستخدم
     * @return array قائمة المهام
     */
    public function list(int $userId)
    {
        return $this->service->getTasksByUser($userId);
    }

    /**
     * إضافة مهمة جديدة لمستخدم
     *
     * @param int $userId معرف المستخدم
     * @param string $title عنوان المهمة
     * @return bool نجاح أو فشل الإضافة
     */
    public function add(int $userId, string $title)
    {
        if (trim($title) === '') return false;
        return $this->service->addTask($userId, $title);
    }

    /**
     * حذف مهمة معينة لمستخدم
     *
     * @param int $id معرف المهمة
     * @param int $userId معرف المستخدم
     * @return bool نجاح أو فشل الحذف
     */
    public function delete(int $id, int $userId)
    {
        return $this->service->deleteTask($id, $userId);
    }

    /**
     * تبديل حالة إكمال المهمة (مكتملة/غير مكتملة)
     *
     * @param int $id معرف المهمة
     * @param int $userId معرف المستخدم
     * @return bool نجاح أو فشل التبديل
     */
    public function toggle(int $id, int $userId)
    {
        return $this->service->toggleTask($id, $userId);
    }
}
