<?php

require_once dirname(__DIR__) . '/logic/db_connection.php';

$taskId = $_POST['taskId'];

// todoを削除する機能
$sql = "DELETE FROM tasks WHERE id = :id";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':id', $taskId);
$stmt->execute();

if ($error[2]) {
    echo $error[2];
} else {
    header('Location:../view/index.php');
}
