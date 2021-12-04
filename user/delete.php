<?php

require_once '../common/config.php';
require_once '../common/Database.php';
require_once '../common/Utiles.php';
require_once '../control/Users.php';

$pdo = Database::dbConnect();
$users = new Users($pdo);

$users->deleteUser();
