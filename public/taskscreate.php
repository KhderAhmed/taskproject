
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
    $title = trim($_POST['title'] ?? '');
    if ($title !== '') {
        $taskCtrl = new AdminTasksController(Database::getConnection());
        $taskCtrl->add((int)$_SESSION['admin_id'], $title);
    }
}

header('Location: /tasks-admin');
exit;
