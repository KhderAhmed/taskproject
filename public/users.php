<?php
require __DIR__ . '/../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use App\Controllers\AdminUsersController;
use App\Database\Database;

if (!isset($_SESSION['admin_id'])) {
    header('Location: /loginadmin');
    exit;
}

$pdo = Database::getConnection();
$usersCtrl = new AdminUsersController($pdo);
$users = $usersCtrl->listUser((int)$_SESSION['admin_id']);

include __DIR__ . '/../src/Views/admin/users.php';
