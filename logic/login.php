<?php

session_start();

require_once dirname(__DIR__) . '/logic/db_connection.php';

// フォームから渡されたデータを変数に代入
$email = $_POST['email'];
$password = $_POST['password'];

if (empty($email)) {
    echo 'メールアドレスを入力してください！';
    exit();
}

if (empty($password)) {
    echo 'パスワードを入力してください！';
    exit();
}

// メールアドレスを条件として、一致するレコードを取得する
$sql = "SELECT * FROM users WHERE email = :email";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':email', $email);
$stmt->execute();
$user = $stmt->fetch();

// 入力されたパスワードと、DBのハッシュ値が一致しているかチェック
if (password_verify($password, $user['password'])) {
    // サーバ側に保存するセッションファイルに、ユーザーの「id」を書き込む
    $_SESSION['id'] = $user['id'];
    // サーバ側に保存するセッションファイルに、ユーザーの「name」を書き込む
    $_SESSION['name'] = $user['name'];
    // トップページに遷移
    header('Location:../view/index.php');
} else {
    echo 'メールアドレスまたはパスワードが間違っています。';
}
