<?php 

require_once dirname(__DIR__) . '/logic/db_connection.php';

// フォームから渡されたデータを変数に代入
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];

// バリデーション
if (empty($name)) { //名前未入力のバリデーション
    echo '名前を入力してください！';
    exit();
}

if (mb_strlen($name) > 20) { //名前文字数制限のバリデーション
    echo '名前は２０文字以内にしてください！';
    exit();
}

if (empty($email)) { //メールアドレス未入力のバリデーション
    echo 'メールアドレスを入力してください！';
    exit();
}

if (empty($password)) { //パスワード未入力のバリデーション
    echo 'パスワードを入力してください！';
    exit();
}

if (mb_strlen($password) < 8) { //パスワード文字数制限のバリデーション
    echo 'パスワードは８文字以上にしてください！';
    exit();
}

// パスワードのハッシュ化
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

// メールアドレス重複のチェック機能
$sql = "SELECT * FROM users WHERE email = :email";
$stmt = $dbh->prepare($sql);
$stmt->bindValue('email', $email);
$stmt->execute();
$user = $stmt->fetch();

if ($user['email'] === $email) {
    echo '同じメールアドレスが存在しています！';
    exit();
}

// ユーザー新規登録機能
$sql = "INSERT INTO users(name, email, password) VALUES (:name, :email, :password)";
$stmt = $dbh->prepare($sql);
$stmt->bindValue(':name', $name);
$stmt->bindValue(':email', $email);
$stmt->bindValue(':password', $password);
$stmt->execute();
$error = $stmt->errorInfo();

// エラー発生時の処理
if ($error[2]) {
    echo $error[2];
} else {
    // ログインページに遷移
    header('Location:../view/login.php');
}