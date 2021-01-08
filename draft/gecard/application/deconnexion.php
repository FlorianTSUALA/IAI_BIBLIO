<?php

/**
 * @author     THITY ADZ
 * @copyright  2013
 * @date       3/9/2013
 */ 


session_start();

require_once(dirname(__FILE__).'/../config/global.php');
 
include(LOGS_DIR.'logs.php');

$user = $_SESSION['userLogs'];
$observation = "Deconnexion de la plate forme Administrateur";
$log = new Logs($user,$observation);
$pathDir = LOGS_DIR;
$log->addLog($pathDir);

session_unset();
session_destroy();

header('Location: ../index.php?con=1');
exit();

?> 