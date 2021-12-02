<?php

require_once '../common/config.php';
require_once '../common/Database.php';
require_once '../common/Utiles.php';
require_once '../control/Users.php';

$pdo = Database::dbConnect();
$users = new Users($pdo);

// ユーザー登録処理
$users->userRegister();

// テンプレートの読み込み
$title = 'ユーザー登録';
$links = [
    'ユーザー一覧' => 'index.php',
    'ログアウト' => 'logout.php',
];
$content = 'user/t_register.php';
include '../views/layout.php';
