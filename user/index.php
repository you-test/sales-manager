<?php

require_once 'common/config.php';
require_once 'common/Database.php';
require_once 'common/Utiles.php';

// データの取得
$pdo = Database::dbConnect();
$users = new Users($pdo);
$users_data = $users->getUsersData();

// テンプレートの読み込み
$title = 'ユーザー一覧';
$links = [
    'トップ' => 'index.php',
    'ログアウト' => 'logout.php',
];
$content = 'user/t_index.php';
include '../views/layout.php';
