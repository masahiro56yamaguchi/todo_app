<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン</title>

    <link rel="stylesheet" href="../assets/global.css">

</head>

<body>
    <div class="container">
        <div class="main">
            <h1 class="title">todoアプリ</h1>
            <h2 class="title">ログイン</h2>
            <form action="../logic/login.php" method="POST">
                <input class="input-form" placeholder="メールアドレス" type="email" name="email" required>
                <input class="input-form" placeholder="パスワード" type="password" name="password" required>
                <input class="submit-btn" type="submit" value="ログイン">
            </form>
            <p>まだ登録していない方は<a href="signup.php">こちら</a></p>
        </div>
    </div>
</body>