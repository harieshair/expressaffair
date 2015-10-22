<?php 
if(!isset($_SESSION)){session_start();}
if(isset($_POST['postvalue']))
	$vendorid=$_POST['postvalue'];
?>
<div class="row">
	<div class="col-xs-12">
		<div class="col-lg-3 wizardleft"><?php include_once "wizardleftbar.php"; ?></div>
		<div class="col-lg-9 wizardright" id="wizardcontent"><?php include_once "vendorbasics.php"; ?></div>
	</div>
</div>



