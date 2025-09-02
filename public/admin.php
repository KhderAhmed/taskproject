<?php
require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/bootstrap.php';
require_once __DIR__ . '/../src/Helpers/lang.php';

use App\Database\Database;
use App\Controllers\AdminChartController;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// تعيين اللغة
if (!isset($_SESSION['lang'])) $_SESSION['lang'] = 'ar';
if (isset($_GET['lang']) && in_array($_GET['lang'], ['ar', 'en'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

// التحقق من تسجيل دخول الأدمن
if (!isset($_SESSION['admin_id'])) {
    header('Location: /loginadmin');
    exit;
}

// ====================
// 1. الاتصال بقاعدة البيانات
// ====================
$pdo = Database::getConnection();

// ====================
// 2. جلب بيانات الشارت
// ====================
$chartController = new AdminChartController($pdo);
$usersByMonth = $chartController->getUsersByMonth();
$tasksByMonth = $chartController->getTasksByMonth();

// تحويل البيانات إلى JSON
$usersJson = json_encode(array_values($usersByMonth));
$tasksJson = json_encode(array_values($tasksByMonth));

// ====================
// 3. تضمين الصفحة
// ====================
include __DIR__ . '/../src/Views/admin/admin.php';
