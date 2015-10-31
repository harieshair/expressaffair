<?php
if(!isset($_SESSION)){session_start();}
$activeMenu="rituals";
$ritualid= $_GET['ritualid'];
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(SERVERFOLDER."/customer/services.php");
$customerService=new customerservice($dbconnection->dbconnector);
if(isset($_SESSION['CUSTOMERID']))
{
	$CustomerId=$_SESSION['CUSTOMERID']; 
	$LocationId=isset($_SESSION['LOCATION'])?$_SESSION['LOCATION']:0;
	$customerData = $customerService->GetCustomerById($CustomerId); 
}
$Services=$customerService->GetAllServicesByEventId($ritualid);
$Rituals=$customerService->GetAllRitualsByEventId($ritualid);
$Citys=$customerService->GetCatalogValuesByMasterName('City');
/*$communityNames=$customerService->GetAllCommunityNames();
*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>X Affair</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/prettyPhoto.css" rel="stylesheet">
	<link href="css/price-range.css" rel="stylesheet">
	<link href="css/animate.css" rel="stylesheet">
	<link href="../plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet">
	<link href="../plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
	<link href="css/express.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->
<body class="app-body">
	<header id="header"><!--header-->
		<?php 
		include "default/myprofile.php" ;
		include "static/navbar.php" ;				
		?>
	</header><!--/header-->
	<?php	
	include "events/showcase.php" ;
	include "static/footer.php";
	?>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/price-range.js"></script>
	<script src="js/jquery.prettyPhoto.js"></script>	
		<script src="../plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
	<script src="../plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
	<script src="js/main.js"></script>
	<script src="../scripts/admin.js"></script>
	<script src="js/ajax-loader.js"></script>
	<script type="text/javascript">
	var locationId=0;
      $(function () {
      	locationId=<?php echo isset($_SESSION['LOCATION'])?$_SESSION['LOCATION']:0; ?>;
         //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});           
      });
    </script>
</body>
</html>