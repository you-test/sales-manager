<?php

require 'common/config.php';
require 'common/Database.php';
require_once 'common/Utiles.php';
require_once 'control/Sales.php';

$pdo = Database::dbConnect();
$sales = new Sales($pdo);
$id = $_POST['id'];
$sales->delete($id);
