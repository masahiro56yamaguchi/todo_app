<?php

// DB接続情報
$dsn = "mysql:host=localhost; dbname=todo_app; charset=utf8;";
$db_username = "root";
$db_password = "root";

// DBに接続
try {
    $dbh = new PDO($dsn, $db_username, $db_password);
} catch (PDOException $err) {
    $msg = $err->getMessage();
    print('接続失敗:' . $msg);
    exit();
}
