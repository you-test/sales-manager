<?php

require_once 'common/config.php';
require_once 'common/Database.php';
require_once 'common/Utiles.php';
require_once 'control/Auth.php';
require_once 'control/Mail.php';

// ログインチェック
Auth::isLogin();

$pdo = Database::dbConnect();
$mailInstance = new Mail($pdo);

// メールアドレスの新規登録フォーム作成
$mailInstance->createMail();
// メールアドレスリストの登録
$mailInstance->registerMails();
// 登録済みメールアドレス情報の取得
$mails = $mailInstance->getMails();

$title = '日報送信メールアドレスリスト';
$links = [
    'トップ' => 'index.php',
    'ログアウト' => 'logout/index.php',
];
$content = 'views/t_mail.php';
include 'views/layout.php';
