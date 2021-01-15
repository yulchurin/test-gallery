<?php
$db_host       = 'localhost';
$db_name       = 'winestyle';
$db_username   = 'winestyle';
$db_password   = 'winestyle';
$db_charset    = 'utf8';

$db = "mysql:host=$db_host; dbname=$db_name; charset=$db_charset";
$db_options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO ($db, $db_username, $db_password, $db_options);