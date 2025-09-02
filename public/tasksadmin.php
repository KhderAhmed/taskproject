<?php
require __DIR__ . '/../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['admin_id'])) {
    header('Location: /loginadmin');
    exit;
}

use App\Controllers\AdminTasksController;
use App\Database\Database;


$pdo = Database::getConnection();
$taskCtrl = new AdminTasksController($pdo);
$tasks = $taskCtrl->list((int)$_SESSION['admin_id']);

include __DIR__ . '/../src/Views/admin/tasks/index.php';
