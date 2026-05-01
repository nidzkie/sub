<?php
$tests = [
    ['127.0.0.1', 'root', ''],
    ['localhost', 'root', ''],
    ['127.0.0.1', 'root', 'root'],
    ['localhost', 'root', 'root'],
];

foreach ($tests as [$host, $user, $password]) {
    try {
        new PDO(
            "mysql:host={$host};port=3306;dbname=campus_item__rental_system",
            $user,
            $password,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );

        $printedPassword = $password === '' ? '(empty)' : $password;
        echo "SUCCESS host={$host} pass={$printedPassword}" . PHP_EOL;
    } catch (Throwable $exception) {
        $printedPassword = $password === '' ? '(empty)' : $password;
        echo "FAIL host={$host} pass={$printedPassword} :: {$exception->getMessage()}" . PHP_EOL;
    }
}
