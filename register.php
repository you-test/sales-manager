<?php

require_once 'common/config.php';
require_once 'common/Database.php';
require_once 'control/Sales.php';
require_once 'control/Auth.php';
require_once 'control/Mail.php';

// ログインチェック
Auth::isLogin();

$pdo = Database::dbConnect();
$sales = new Sales($pdo);

// バリデーション
var_dump($_SESSION['errors']);
// データの登録
$sales->register();

// 日報送信先メールアドレス取得, メール送信
$mailInstance = new Mail($pdo);
$mails = $mailInstance->getMails();
$sales->sendDailyReport($mails);

// テンプレート読み込み
$title = '売上データ新規登録';
$links = [
    'トップ' => 'index.php',
    '月間一覧' => 'list.php',
    'ログアウト' => 'logout/index.php',
];
$content = 'views/t_register.php';
include 'views/layout.php';
