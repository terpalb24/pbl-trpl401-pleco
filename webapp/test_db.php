<?php

$host = '51.79.231.130';
$port = '28046';
$db   = 'pleco';
$user = 'admin';
$pass = '*O9%^u7w#8@10%*76c1L';

$ca = 'C:/Berkas Kuliah/Semester 4/PBL/Database/ca-cert.pem';
$cert = 'C:/Berkas Kuliah/Semester 4/PBL/Database/client-cert.pem';
$key = 'C:/Berkas Kuliah/Semester 4/PBL/Database/client-key.pem';

$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_SSL_CA       => $ca,
    PDO::MYSQL_ATTR_SSL_CERT     => $cert,
    PDO::MYSQL_ATTR_SSL_KEY      => $key,
    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => true,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "Connected successfully\n";
} catch (\PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
}
