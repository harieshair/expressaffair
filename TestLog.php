<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
require_once CLASSFOLDER.'/KLogger.php';
$log = new KLogger ( "logFiles/log.log" , KLogger::DEBUG );
 
// Do database work that throws an exception
$log->LogError("An exception was thrown in ThisFunction()");
 
// Print out some information
$log->LogInfo("Internal Query Time:  milliseconds");
 
// Print out the value of some variables
//$log->LogDebug("User Count: $User_Count");
?>
