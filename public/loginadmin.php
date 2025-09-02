<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\AdminAuthController;
use App\Database\Database;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pdo = Database::getConnection();
$controller = new AdminAuthController($pdo);
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = $controller->login($_POST);
    if (empty($errors)) {
        header('Location: /admin');
        exit;
    }
}

include __DIR__ . '/../src/Views/admin/login.php';
