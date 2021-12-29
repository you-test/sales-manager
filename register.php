<?php

require_once 'common/config.php';
require_once 'common/Database.php';
require_once 'control/Sales.php';
require_once 'control/Auth.php';

// ログインチェック
Auth::isLogin();

$pdo = Database::dbConnect();
// データの登録
$sales = new Sales($pdo);
$message = $sales->register();
$sales->sendDailyReport();

// テンプレート読み込み
$title = '売上データ新規登録';
$links = [
    'トップ' => 'index.php',
    '月間一覧' => 'list.php',
    'ログアウト' => 'logout/index.php',
];
$content = 'views/t_register.php';
include 'views/layout.php';
