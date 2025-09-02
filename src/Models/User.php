<?php

namespace App\Models;

/**
 * Class User
 * 
 * يمثل مستخدم في النظام.
 */
class User
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
    public $username;

    /**
     * البريد الإلكتروني للمستخدم
     * @var string
     */
    public $email;

  public $created_at;
    /**
     * منشئ كائن المستخدم
     *
     * @param int|null $id
     * @param string $username
     * @param string $email
     */
    public function __construct($id, $username, $email, $created_at = null)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
         $this->created_at = $created_at;
    }
}
