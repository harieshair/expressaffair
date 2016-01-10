<?php
if (session_status() != PHP_SESSION_ACTIVE)
    session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . "/eventconfig.php");
$Coordinator="";
if (isset($_SESSION['COORDINATORID'])) {
    $CoordinateId=$_SESSION['COORDINATORID'];
      include_once("service/helperservice.php");
    $coordinatorservice = new coordinatorservice($dbconnection->dbconnector);
    $Coordinator = $coordinatorservice->getCoordinatorById($CoordinateId);
}else{ ?>
    <script>location.href = '';</script>
<?php }

    include "header.php"; ?>
<section>
    <div class="container">
        <div class="row">
            <?php include "dashboard.php"; ?>
        </div>
        <?php include "footer.php";
        include "scripts/generalscripts.php";
        ?>
    </div>
</section>        
</body>
</html>