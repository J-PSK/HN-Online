<?php
require_once '../vendor/autoload.php'; // path ของไฟล ืautoload.php ใน vendor
$dotenv = Dotenv\Dotenv::createImmutable('../'); //path ที่เก็บ ไฟล์ .env
$dotenv->load();

$host = $_ENV['PGDB_HOST'];
$user = $_ENV['PGDB_USERNAME'];
$password = $_ENV['PGDB_PASSWORD'];
$port = $_ENV['PGDB_PORT'];
$dbname = $_ENV['PGDB_DBNAME'];
$pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password;options='--client_encoding=UTF8'");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
