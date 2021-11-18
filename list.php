<?php

// データベース接続
require_once 'common/config.php';
require_once 'common/Database.php';
require_once 'common/Utiles.php';
require_once 'control/Sales.php';

$pdo = Database::dbConnect();

$sales = new Sales($pdo);
$sales_data = $sales->showSales();
print_r($sales_data);

$title = '月間一覧';
$links = [
    'トップ' => 'index.php',
    'ログアウト' => 'logout.php',
];
$content = 't_list.php';
include 'views/layout.php';
