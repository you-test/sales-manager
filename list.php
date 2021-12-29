<?php

require_once 'common/config.php';
require_once 'common/Database.php';
require_once 'common/Utiles.php';
require_once 'control/Sales.php';
require_once 'control/Auth.php';

// ログインチェック
Auth::isLogin();

$pdo = Database::dbConnect();

// データ取得
$sales = new Sales($pdo);
$salesData = $sales->showSales();

// 累計表示
$totalSum = $sales->totalSalesShow($salesData);
// 原価率・人件費率
list($fRatio, $lRatio) = $sales->flRatio($totalSum);


$title = '月間一覧';
$links = [
    'トップ' => 'index.php',
    'ログアウト' => 'logout/index.php',
];
$content = 't_list.php';
include 'views/layout.php';
