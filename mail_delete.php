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

$mailInstance->deleteMail();
