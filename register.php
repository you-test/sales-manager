<?php

require_once 'Database.php';
$pdo = Database::dbConnect();

// テンプレート読み込み
$title = '売上データ新規登録';
$links = [
    'トップ' => 'index.php',
    '月間一覧' => 'list.php',
    'ログアウト' => 'logout.php',
];
$content = 'views/t_register.php';
include 'views/layout.php';
