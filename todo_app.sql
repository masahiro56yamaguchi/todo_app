-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:3306
-- 生成日時: 2022-03-08 07:57:00
-- サーバのバージョン： 5.7.24
-- PHP のバージョン: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `todo_app`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL COMMENT 'ユーザーを識別するための外部キー',
  `task` text NOT NULL COMMENT 'タスク名',
  `bool_data` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'チェック機能',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '作成時間',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `task`, `bool_data`, `created_at`, `updated_at`) VALUES
(1, 1, '料理', 1, '2022-03-01 04:29:11', '2022-03-08 07:53:41'),
(2, 1, '掃除', 1, '2022-03-08 06:41:58', '2022-03-08 06:55:39');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL COMMENT 'ユーザー名',
  `email` varchar(255) NOT NULL COMMENT 'メールアドレス',
  `password` varchar(255) NOT NULL COMMENT 'パスワード',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '作成時間',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'test01', 'test01@test.com', '$2y$10$VE66Z021xcbIbD/GFEcz1.3sfp7gqbwsv2BpOVHOe3OKk7RvUonNK', '2022-02-27 08:38:24', '2022-02-27 08:38:44'),
(2, 'test02', 'test02@test.com', '$2y$10$f19BNlsvA7N3J0l5mqclauG9tMFFt3JvQ6hna/liq8ffiiAPduB5S', '2022-02-27 10:27:40', '2022-03-01 01:21:05');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_user_id_foreign` (`user_id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- テーブルの AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- ダンプしたテーブルの制約
--

--
-- テーブルの制約 `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
