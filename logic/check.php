<?php 

require_once dirname(__DIR__) . '/logic/db_connection.php';

$taskId = $_POST['taskId'];

$check = $_POST['check'];

// bool_dataの更新
if (isset($check)) {
    $sql = "UPDATE tasks SET bool_data = 1 WHERE id = :id";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':id', $taskId);
    $stmt->execute();
    $tasks = $stmt->fetchAll();

    $error = $stmt->errorInfo();
    
    if ($error[2]) {
        echo $error[2];
    } else {
        header('Location:../view/index.php');
    }
}