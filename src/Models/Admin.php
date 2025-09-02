<?php

namespace App\Models;

/**
 * Class Admin
 * 
 * يمثل مستخدم في النظام.
 */
class Admin
{
    /**
     * معرف المستخدم (مفتاح رئيسي)
     * @var int|null
     */
    public $id;

    /**
     * اسم المستخدم
     * @var string
     */
    public $name;

    /**
     * البريد الإلكتروني للمستخدم
     * @var string
     */
    public $email;

    /**
     * منشئ كائن المستخدم
     *
     * @param int|null $id
     * @param string $name
     * @param string $email
     */
    public function __construct($id, $name, $email)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }
}
