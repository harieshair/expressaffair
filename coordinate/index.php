<?php
if (session_status() != PHP_SESSION_ACTIVE)
    session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . "/eventconfig.php");
if (isset($_SESSION['COORDINATORID'])) {
    ?>
    <script>location.href = 'home';</script>
<?php
} else {
    include 'signin.php';
}            