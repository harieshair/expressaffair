<?php
if(!isset($_SESSION)){session_start();}
$activeMenu="home";
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");

    include "static/title.php";
?>
<body>
	<header id="header"><!--header-->
		<?php 
		include "default/myprofile.php" ;
		include "static/navbar.php" ;				
		?>
	</header><!--/header-->
	<?php	
	include "default/login.php" ;
	include "static/footer.php";
	?>
	<script src="js/affair-page-loader.js"></script>
	<?php
    include "scripts/login.php";
	?>

</body>
</html>