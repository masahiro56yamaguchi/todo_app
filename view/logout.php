<?php

// ログアウトする
session_start();
$_SESSION = array(); //セッションの中身を全て削除する
session_destroy(); //セッションを破壊する

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログアウト</title>

    <link rel="stylesheet" href="../assets/global.css">

</head>

<body>
    <div class="container">
        <div class="main">
            <h2>ログアウトしました！</h2>
            <a href="login.php">ログインページへ</a>
        </div>
    </div>
</body>