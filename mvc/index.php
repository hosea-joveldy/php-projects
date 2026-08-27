<?php
define('BASE_PATH', __DIR__);

require_once BASE_PATH . '/controllers/HomeControl.php';

$controls = new homeController();
$controls->index();