<?php

session_start();

require_once dirname(__DIR__) . '/logic/db_connection.php';

// フォームから渡されたデータを変数に代入
$task = $_POST['task'];

// 未入力のバリデーション
if (empty($task)) {
    echo 'todoを入力してください！';
    exit();
}

// tasksテーブルに新規todoを追加
$userId = $_SESSION['id'];

$sql = "INSERT INTO tasks(user_id, task) VALUES (:user_id, :task)";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':user_id', $userId);
$stmt->bindValue(':task', $task);
$stmt->execute();

$error = $stmt->errorInfo();

if ($error[2]) {
    echo $error[2];
} else {
    header('Location:../view/index.php');
}