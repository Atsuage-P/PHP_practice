<?php

session_start();

// ローカル環境
// define('DSN', 'mysql:host=db;dbname=myapp;charset=utf8mb4');
// define('DB_USER', 'myappuser');
// define('DB_PASS', 'myapppass');
// define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);

// 本番環境
define('DSN', 'mysql:host=us-cdbr-east-04.cleardb.com;dbname=heroku_18598fa8a1b2ba9;charset=utf8mb4');
define('DB_NAME', 'heroku_18598fa8a1b2ba9');
define('DB_HOST', 'us-cdbr-east-04.cleardb.com');
define('DB_USER', 'b298720dc1c0ee');
define('DB_PASS', '388b13ff');
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);

require_once(__DIR__ . '/Utils.php');
require_once(__DIR__ . '/Token.php');
require_once(__DIR__ . '/Database.php');
require_once(__DIR__ . '/Bbs.php');
require_once(__DIR__ . '/Pagenation.php');
?>
