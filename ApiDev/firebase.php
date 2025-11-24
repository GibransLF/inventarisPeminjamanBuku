<?php
require __DIR__ . '/vendor/autoload.php';

use Kreait\Firebase\Factory;

$factory = (new Factory)
    ->withServiceAccount(__DIR__ . '/buku-perpustakaan-a7500-firebase-adminsdk-fbsvc-3895d006c0.json')
    ->withDatabaseUri('https://buku-perpustakaan-a7500-default-rtdb.asia-southeast1.firebasedatabase.app/');

$database = $factory->createDatabase();
