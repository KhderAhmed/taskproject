<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// تحديد اللغة الافتراضية
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'ar';
}

// إذا تم تغيير اللغة من الرابط
if (isset($_GET['lang']) && in_array($_GET['lang'], ['ar','en'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

// تحميل ملف اللغة
$langFile = __DIR__ . '/../../lang/' . $_SESSION['lang'] . '.php';
$GLOBALS['__LANG'] = file_exists($langFile) ? require $langFile : [];

// دالة الترجمة
if (!function_exists('__')) {
    function __($key) {
        return $GLOBALS['__LANG'][$key] ?? $key;
    }
}
