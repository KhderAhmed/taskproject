<?php
require __DIR__ . '/../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use App\Controllers\TaskController;
use App\Database\Database;

if (!isset($_SESSION['user_id'])) {
    header('Location: /login');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['id'] ?? 0);
    $taskCtrl = new TaskController(Database::getConnection());
    $taskCtrl->delete($id, (int)$_SESSION['user_id']);
}

header('Location: /dashboard');
exit;
