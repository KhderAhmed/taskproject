<?php
require __DIR__ . '/vendor/autoload.php';

use Seeders\AdminSeeder;


echo "🚀 بدء عملية Seeding...\n";


$seeders = [
    AdminSeeder::class,

];

foreach ($seeders as $seederClass) {
    $seeder = new $seederClass();
    $seeder->run();
}

echo "🎯 تم الانتهاء من عملية Seeding.\n";
