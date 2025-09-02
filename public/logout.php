<?php
require __DIR__ . '/../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

use App\Controllers\AuthController;
use App\Database\Database;

$ctrl = new AuthController(Database::getConnection());
$ctrl->logout();
header('Location: /login');
exit;
