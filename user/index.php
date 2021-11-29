<?php

// テンプレートの読み込み
$title = 'ユーザー一覧';
$links = [
    'トップ' => 'index.php',
    'ログアウト' => 'logout.php',
];
$content = 'user/t_index.php';
include '../views/layout.php';
