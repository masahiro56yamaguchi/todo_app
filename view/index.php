<?php

session_start();

require_once dirname(__DIR__) . '/logic/db_connection.php';
require_once dirname(__DIR__) . '/logic/read_task.php';
require_once dirname(__DIR__) . '/logic/check.php';

// サーバ側に保存しているセッションファイルから、「name」の値を取り出す
$username = $_SESSION['name'];

if (isset($_SESSION['id'])) { // サーバ側に保存しているセッションファイルに、「id」の値があればログイン状態
    $msg = 'ようこそ！' . $username . 'さん';
} else { // サーバ側に保存しているセッションファイルに、「id」の値がなければ非ログイン状態
    header('Location:./login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ホーム</title>

    <link rel="stylesheet" href="../assets/global.css">
    <link rel="stylesheet" href="../assets/home.css">
</head>

<body>
    <div class="container">
        <div class="home-main">
            <h1><?php echo htmlspecialchars($msg, ENT_QUOTES, 'UTF-8'); ?></h1>
            <h1 class="title">todoアプリ</h1>
            <form action="../logic/add_task.php" method="post">
                <input class="input-form" type="text" name="task" required>
                <input class="submit-btn" type="submit" value="todoの追加">
            </form>
            <h2>todoの一覧</h2>
                <?php foreach($tasks as $task) { ?>
                    <?php if ($task['user_id'] === $_SESSION['id']) : ?>
                    <div class="lists-wrapper">
                        <form action="../logic/check.php" method="POST">
                            <input class="checkbox" type="checkbox" name="check" required 
                            <?php if ($task['bool_data'] === '1' ) {
                                        echo 'checked'; /* bool_dataが1の時表示 */
                                    } ?> >
                            <input class="check-btn" type="submit" value="完了">
                            <!-- ユーザーのブラウザには表示されないボタン -->
                            <input type="hidden" style="display: none;" name="taskId" value="<?php echo $task['id'] ?>">
                        </form>
                        <table>
                            <tbody>
                                <tr>
                                    <th>todo</th>
                                    <td><?php echo htmlspecialchars($task['task'], ENT_QUOTES, 'UTF-8'); ?></td>
                                </tr>
                                <tr>
                                    <th>作成時間</th>
                                    <td><p><?php echo htmlspecialchars($task['created_at'], ENT_QUOTES, 'UTF-8'); ?></p></td>
                                </tr>
                                <tr>
                                    <th>更新時間</th>
                                    <td><p><?php echo htmlspecialchars($task['updated_at'], ENT_QUOTES, 'UTF-8'); ?></p></td>
                                </tr>
                            </tbody>
                        </table>
                        <form action="../logic/delete_task.php" method="POST">
                            <input class="delete-btn" type="submit" value="削除">
                            <!-- ユーザーのブラウザには表示されないボタン -->
                            <input type="hidden" style="display: none;" name="taskId" value="<?php echo $task['id'] ?>">
                        </form>
                    </div>
                    <div class="update-items">
                        <form action="../logic/update_task.php" method="POST">
                            <input class="update-form" type="text" name="updateTask" required >
                            <input class="update-btn" type="submit" value="更新">
                            <!-- ユーザーのブラウザには表示されないボタン -->
                            <input type="hidden" style="display: none;" name="taskId" value="<?php echo $task['id'] ?>">
                        </form>
                    </div>
                    <?php endif ?>
                <?php } ?>
            <a href="logout.php">ログアウト</a>
        </div>
    </div>
</body>