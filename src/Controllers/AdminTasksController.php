<?php

namespace App\Controllers;

use App\Services\AdminTaskService;

/**
 * Class AdminTaskService
 * 
 * مسؤول عن إدارة المهام: عرض، إضافة، حذف، وتبديل حالة المهمة.
 */
class AdminTasksController
{
    /**
     * @var AdminTaskService خدمة المهام
     */
    private AdminTaskService $service;

    /**
     * منشئ الكائن
     *
     * @param \PDO $pdo اتصال قاعدة البيانات
     */
    public function __construct($pdo)
    {
        $this->service = new AdminTaskService($pdo);
    }

    /**
     * استرجاع قائمة المهام لمستخدم معين
     *
     * @param int $admin_Id معرف المستخدم
     * @return array قائمة المهام
     */
    public function list(int $admin_Id)
    {
        return $this->service->getTasksByAdmin($admin_Id);
    }
    /**
     * إضافة مهمة جديدة لمستخدم
     *
     * @param int $admin_Id معرف المستخدم
     * @param string $title عنوان المهمة
     * @return bool نجاح أو فشل الإضافة
     */
    public function add(int $admin_Id, string $title)
    {
        if (trim($title) === '') return false;
        return $this->service->addTask($admin_Id, $title);
    }

    /**
     * حذف مهمة معينة لمستخدم
     *
     * @param int $id معرف المهمة
     * @param int $admin_Id معرف المستخدم
     * @return bool نجاح أو فشل الحذف
     */
    public function delete(int $id, int $admin_Id)
    {
        return $this->service->deleteTask($id, $admin_Id);
    }

    /**
     * تبديل حالة إكمال المهمة (مكتملة/غير مكتملة)
     *
     * @param int $id معرف المهمة
     * @param int $admin_Id معرف المستخدم
     * @return bool نجاح أو فشل التبديل
     */
    public function toggle(int $id, int $admin_Id)
    {
        return $this->service->toggleTask($id, admin_Id: $admin_Id);
    }
}
