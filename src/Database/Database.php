<?php

namespace App\Database;

use PDO;
use PDOException;

/**
 * Class Database
 * 
 * مسؤول عن إنشاء وإدارة اتصال قاعدة البيانات باستخدام PDO.
 */
class Database
{
    /**
     * كائن PDO ثابت لضمان وجود اتصال واحد فقط طوال فترة التطبيق
     * 
     * @var PDO|null
     */
    private static ?PDO $pdo = null;

    /**
     * إرجاع اتصال PDO مع قاعدة البيانات.
     * يتم إنشاء الاتصال مرة واحدة فقط (Singleton).
     * 
     * @return PDO كائن الاتصال بقاعدة البيانات
     */
    public static function getConnection(): PDO
    {
        if (self::$pdo === null) {
            // تحميل إعدادات الاتصال من ملف الإعدادات
            $config = require __DIR__ . '/../../config/config.php';
            $db = $config['db'];
            $dsn = "mysql:host={$db['host']};dbname={$db['dbname']};charset={$db['charset']}";

            try {
                self::$pdo = new PDO($dsn, $db['user'], $db['pass'], [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
            } catch (PDOException $e) {
                // في حال فشل الاتصال، إيقاف التطبيق مع رسالة الخطأ
                die("DB Connection failed: " . $e->getMessage());
            }
        }

        return self::$pdo;
    }
}
