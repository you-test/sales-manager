<?php
require_once 'common/config.php';
require_once 'common/Database.php';
require_once 'common/Utiles.php';
require_once 'control/Sales.php';
require_once 'control/Auth.php';

// ログインチェック
Auth::isLogin();

$pdo = Database::dbConnect();
$id = $_POST['id'];
$sales = new Sales($pdo);
$sales->update();
