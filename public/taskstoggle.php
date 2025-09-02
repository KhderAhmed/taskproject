<?php
require __DIR__ . '/../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use App\Controllers\AdminTasksController;
use App\Database\Database;

if (!isset($_SESSION['admin_id'])) {
    header('Location: /loginadmin');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['id'] ?? 0);
    $taskCtrl = new AdminTasksController(Database::getConnection());
    $taskCtrl->toggle($id, (int)$_SESSION['admin_id']);
}

header('Location: /tasks-admin');
exit;


