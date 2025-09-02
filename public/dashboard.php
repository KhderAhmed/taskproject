<?php
require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/bootstrap.php';
require_once __DIR__ . '/../src/Helpers/lang.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// تعيين اللغة
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'ar';
}
if (isset($_GET['lang']) && in_array($_GET['lang'], ['ar','en'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

use App\Controllers\TaskController;
use App\Database\Database;

if (!isset($_SESSION['user_id'])) {
    header('Location: /login');
    exit;
}

$pdo = Database::getConnection();
$taskCtrl = new TaskController($pdo);
$tasks = $taskCtrl->list((int)$_SESSION['user_id']);

include __DIR__ . '/../src/Views/dashboard.php';
