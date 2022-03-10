<?php

require_once dirname(__DIR__) . '/logic/db_connection.php';

$sql = "SELECT tasks.id, tasks.user_id, tasks.task, tasks.bool_data, tasks.created_at, tasks.updated_at, users.name FROM tasks INNER JOIN users ON tasks.user_id = users.id";
$stmt = $dbh->prepare($sql);
$stmt->execute();
$tasks = $stmt->fetchAll();