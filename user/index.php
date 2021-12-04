<?php

require_once '../common/config.php';
require_once '../common/Database.php';
require_once '../common/Utiles.php';
require_once '../control/Users.php';

// データの取得
$pdo = Database::dbConnect();
$users = new Users($pdo);
$usersdata = $users->getUsersData();

// テンプレートの読み込み
$title = 'ユーザー一覧';
$links = [
    'トップ' => '../index.php',
    'ユーザー一覧' => 'index.php',
    'ログアウト' => 'logout.php',
];
$content = '../views/user/t_index.php';
include '../views/user/layout.php';
