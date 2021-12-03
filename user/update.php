<?php

session_start();

require_once '../common/config.php';
require_once '../common/Database.php';
require_once '../common/Utiles.php';
require_once '../control/Users.php';

$pdo = Database::dbConnect();
$users = new Users($pdo);

// 一覧ページから送られるユーザーIDを取得して保持
if (!isset($_SESSION['id'])) {
    $_SESSION['id'] = $_POST['id'];
    $id = $_SESSION['id'];
}

var_dump($_POST['id']);
var_dump($_SESSION['id']);

// 更新画面にきたときに最初に入れておく値の取得
$userdata = $users->getUpdateUserData($id);

// データのアップデート処理
$users->updateUser();

// テンプレートの読み込み
$title = 'ユーザー情報編集';
$links = [
    'トップ' => '../index.php',
    'ユーザー一覧' => 'index.php',
    'ログアウト' => 'logout.php',
];
$content = 'user/t_update.php';
include '../views/layout.php';
