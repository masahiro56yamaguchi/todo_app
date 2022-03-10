<?php

require_once dirname(__DIR__) . '/logic/db_connection.php';

$updateTask = $_POST['updateTask'];

$taskId = $_POST['taskId'];


// 未入力のバリデーション
if (empty($updateTask)) {
    echo 'todoを入力してください！';
    exit();
}

// todoの更新機能
$sql = "UPDATE tasks SET task = :task, bool_data = 0  WHERE id = :id";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':task', $updateTask);
$stmt->bindValue(':id', $taskId);
$stmt->execute();
$error = $stmt->errorInfo();

if ($error[2]) {
    echo $error[2];
} else {
    header('Location:../view/index.php');
}
