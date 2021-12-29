<?php

require_once '../common/config.php';
require_once '../common/Database.php';
require_once '../common/Utiles.php';
require_once '../control/Auth.php';
require_once '../common/Validation.php';

$pdo = Database::dbConnect();
$auth = new Auth($pdo);

// リクエストがPOSTのとき
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $_SESSION['errors'] = [];

    // 空入力チェック
    Validation::emptyCheck($_SESSION['errors'], $mail, 'メールアドレスを入力してください。');
    Validation::emptyCheck($_SESSION['errors'], $password, 'パスワードを入力してください。');

    // 文字数チェック
    Validation::maxCheck($_SESSION['errors'], $mail, 'メールアドレスは255文字以内で入力してください。', 255);
    Validation::minCheck($_SESSION['errors'], $password, 'パスワードは8文字以上で入力してください。', 8);
    Validation::maxCheck($_SESSION['errors'], $password, 'パスワードは255文字以内で入力してください。', 255);

    if (!$_SESSION['errors']) {
        // メールアドレスチェック
        Validation::mailCheck($_SESSION['errors'], $mail, '正しいメールアドレスを入力してください。');

        // パスワードの半角英数字チェック
        Validation::halfAlphanumericalCheck($_SESSION['errors'], $password, 'パスワードは半角英数字で入力してください。');
    }

    if ($_SESSION['errors']) {
        header('Location: index.php');
        exit;
    }

    // ログイン処理
    $auth->login($mail, $password);
}


$title = 'ログイン';
$links = [];
$content = '../views/login/t_index.php';
include '../views/login/layout.php';
