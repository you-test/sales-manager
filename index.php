<?php

require_once 'control/Auth.php';

// ログインチェック
Auth::isLogin();

$title = 'トップ';
$links = ['ログアウト' => 'logout/index.php'];
$content = 'views/t_index.php';
include 'views/layout.php';
