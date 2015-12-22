<?php if (session_status() != PHP_SESSION_ACTIVE) session_start();
include "static/title.php";
$activeMenu = "home";
include_once($_SERVER['DOCUMENT_ROOT'] . "/eventconfig.php");
include_once(SERVERFOLDER . "/customer/services.php");
$customerService = new customerservice($dbconnection->dbconnector);
if (isset($_SESSION['CUSTOMERID'])) {
    $CustomerId = $_SESSION['CUSTOMERID'];
    $LocationId = isset($_SESSION['LOCATION']) ? $_SESSION['LOCATION'] : 0;
    $customerData = $customerService->GetCustomerById($CustomerId);
}
?>
<body>	
    <?php
    include "static/header.php";
    include "static/home.php";
    include "static/footer.php";
    ?>	
    <script src="js/ajax-loader.js"></script>
    <script src="js/home-page-loader.js"></script>
</body>
</html>