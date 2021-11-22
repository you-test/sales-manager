<?php

require_once 'common/config.php';
require_once 'common/Database.php';
require_once 'common/Utiles.php';
require_once 'control/Sales.php';

$pdo = Database::dbConnect();

$sales = new Sales($pdo);
$sales->update();
$sales_daily = $sales->showUpdate();


$title = '売上データ更新';
$links = [
    'トップ' => 'index.php',
    '月間一覧' => 'list.php',
    'ログアウト' => 'logout.php',
];
$content = 'views/t_update.php';
include 'views/layout.php';
