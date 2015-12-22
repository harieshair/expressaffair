<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start(); 
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
if (isset($_COOKIE[session_name()])) {
setcookie(session_name(),'',time()-42000,'/');
}
?><script>location.href = 'home';</script>