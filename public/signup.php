<?php
if(!isset($_SESSION)){session_start();}
$activeMenu="home";
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(SERVERFOLDER."/customer/services.php");
$customerService=new customerservice($dbconnection->dbconnector);
$cityCatalogs=$customerService->GetCatalogValuesByMasterName('City');
$stateCatalogs=$customerService->GetCatalogValuesByMasterName('State');
include "static/title.php" ;
?>
<body>
	<header id="header"><!--header-->
		<?php 
		include "default/myprofile.php" ;
		include "static/navbar.php" ;				
		?>
	</header><!--/header-->
	<?php	
	include "default/signup.php" ;
	include "static/footer.php";
	?>
	<script src="js/affair-page-loader.js"></script>
    <?php include "scripts/signup.php" ?>
</body>
</html>