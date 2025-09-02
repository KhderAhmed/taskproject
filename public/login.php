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
if (isset($_GET['lang']) && in_array($_GET['lang'], ['ar', 'en'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

use App\Controllers\AuthController;
use App\Database\Database;

$pdo = Database::getConnection();
$controller = new AuthController($pdo);
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = $controller->login($_POST);
    if (empty($errors)) {
        header('Location: /dashboard');
        exit;
    }
}

include __DIR__ . '/../src/Views/login.php';
