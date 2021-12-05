<?php

require_once '../common/config.php';
require_once '../common/Database.php';
require_once '../common/Utiles.php';
require_once '../control/Auth.php';

$pdo = Database::dbConnect();
$auth = new Auth($pdo);

$auth->login();

$title = 'ログイン';
$links = [];
$content = '../views/login/t_login.php';
include '../views/login/layout.php';
