<?php
$users = [
    ['root', ''],
    ['root', 'root'],
    ['root', 'password'],
    ['laragon', 'laragon'],
    ['homestead', 'secret'],
    ['homestead', 'homestead'],
    ['admin', 'admin'],
];
$hosts = ['127.0.0.1','localhost'];
foreach ($hosts as $host) {
  foreach ($users as [$user,$password]) {
    try {
      new PDO("mysql:host={$host};port=3306;dbname=campus_item__rental_system",$user,$password,[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
      echo "SUCCESS host={$host} user={$user} pass=".($password===''?'(empty)':$password).PHP_EOL;
    } catch (Throwable $e) {
      echo "FAIL host={$host} user={$user} pass=".($password===''?'(empty)':$password).PHP_EOL;
    }
  }
}
