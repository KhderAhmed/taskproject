<?php
require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../src/Helpers/lang.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// لغة افتراضية
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'ar';
}
if (isset($_GET['lang']) && in_array($_GET['lang'], ['ar', 'en'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

// راوتر بسيط
$route = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

$isUserLoggedIn  = isset($_SESSION['user_id']);
$isAdminLoggedIn = isset($_SESSION['admin_id']);

// مصفوفة المسارات
$routes = [
    // مستخدم عادي
    ''            => 'welcome.php',
    'welcome'     => 'welcome.php',
    'login'       => 'login.php',
    'register'    => 'register.php',
    'dashboard'   => 'dashboard.php',
    'logout'      => 'logout.php',

    // لوحة الإدارة
    'loginadmin'  => 'loginadmin.php',
    'admin'       => 'admin.php',
    'tasks-admin' => 'tasksadmin.php',
    'users'       => 'users.php',
    'logoutadmin' => 'logoutadmin.php',
];

// دالة إعادة التوجيه
function redirect($path) {
    header("Location: /$path");
    exit;
}

// حماية المسارات حسب حالة تسجيل الدخول
// مستخدم عادي
if ($isUserLoggedIn && ($route === '' || $route === 'login')) {
    redirect('dashboard');
}
if (!$isUserLoggedIn && in_array($route, ['dashboard'])) {
    redirect('login');
}

// ادمن
if ($isAdminLoggedIn && $route === 'loginadmin') {
    redirect('admin');
}
if (!$isAdminLoggedIn && in_array($route, ['admin', 'tasks-admin', 'users', 'logoutadmin'])) {
    redirect('loginadmin');
}

// تحميل الصفحة المناسبة
if (array_key_exists($route, $routes)) {
    $file = __DIR__ . '/' . $routes[$route];
    if (file_exists($file)) {
        require $file;
    } else {
        http_response_code(404);
        require __DIR__ . '/404.php';
    }
}
