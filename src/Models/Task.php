<?php

namespace App\Models;

/**
 * Class Task
 * 
 * يمثل مهمة خاصة بمستخدم معين.
 */
class Task
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
    public $user_id;

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
     * @param int $user_id
     * @param string $title
     * @param int|bool $completed
     */
    public function __construct($id, $user_id, $title, $completed)
    {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->title = $title;
        $this->completed = (int)$completed;
    }
}
