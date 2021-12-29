<?php

require_once '../common/config.php';
require_once '../common/Database.php';
require_once '../common/Utiles.php';
require_once '../control/Auth.php';

$pdo = Database::dbConnect();
$auth = new Auth($pdo);

// ログアウト処理
$auth->logout();
