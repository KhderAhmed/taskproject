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
    $title = trim($_POST['title'] ?? '');
    if ($title !== '') {
        $taskCtrl = new TaskController(Database::getConnection());
        $taskCtrl->add((int)$_SESSION['user_id'], $title);
    }
}

header('Location: /dashboard');
exit;

