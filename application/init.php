<?php
session_start();

require_once 'config.php';
require_once 'core/db.php';
require_once 'core/model.php';
require_once 'core/view.php';
require_once 'core/controller.php';
require_once 'core/route.php';

try {
    DB::instance();
}
catch(PDOException $ex){
    die("Нет соединения с базой данных. /application/config.php");
}

Route::start();