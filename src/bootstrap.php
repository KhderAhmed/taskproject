<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// تغيير اللغة من الرابط ?lang=ar أو ?lang=en
if (isset($_GET['lang'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

// اللغة الافتراضية
if (!isset($_SESSION['lang'])) {
    $_SESSION['lang'] = 'en';
}

// تحميل ملف الهيلبر للترجمة
require_once __DIR__ . '/Helpers/lang.php';
