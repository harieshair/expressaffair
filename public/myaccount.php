<?php
if(!isset($_SESSION)){session_start();}
$activeMenu="home";
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(SERVERFOLDER."/customer/services.php");
$customerService=new customerservice($dbconnection->dbconnector);
if(isset($_SESSION['CUSTOMERID']))
{
	$CustomerId=$_SESSION['CUSTOMERID']; 
	$customerData = $customerService->GetCustomerById($CustomerId); 
}else{
    header("location:home");
    exit();
}
$Citys=$customerService->GetCatalogValuesByMasterName('City');
$States = $customerService->GetCatalogValuesByMasterName('State');
/*$communityNames=$customerService->GetAllCommunityNames();
*/
include "static/title.php";
?>
<body>	
	<header id="header"><!--header-->
		<?php 
		include "default/myprofile.php" ;
		?>
	</header><!--/header-->
	<?php	
	include "profileinfo/profilenavbar.php" ;
	include "profileinfo/profile.php" ;
	include "static/footer.php";
	?>
	<script src="js/affair-page-loader.js"></script>
	<?php
    include "scripts/signup.php";
	?>	
        
        
</body>
</html>