<?php

namespace App\Models;

/**
 * Class Task
 * 
 * يمثل مهمة خاصة بمستخدم معين.
 */
class MyTasks
{
    /**
     * معرف المهمة (مفتاح رئيسي)
     * @var int|null
     */
    public $id;

    /**
     * معرف المستخدم الذي تابعة له المهمة
     * @var int
     */
    public $admin_id;

    /**
     * عنوان المهمة
     * @var string
     */
    public $title;

    /**
     * حالة المهمة (1 = مكتملة، 0 = غير مكتملة)
     * @var int
     */
    public $completed;

    /**
     * منشئ كائن المهمة
     *
     * @param int|null $id
     * @param int $admin_id
     * @param string $title
     * @param int|bool $completed
     */
    public function __construct($id, $admin_id, $title, $completed)
    {
        $this->id = $id;
        $this->admin_id = $admin_id;
        $this->title = $title;
        $this->completed = (int)$completed;
    }
}
