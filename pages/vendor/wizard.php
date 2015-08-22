<?php 
if(!isset($_SESSION)){session_start();}
if(isset($_POST['postvalue']))
 $vendorid=$_POST['postvalue'];
?>
    <div class="row">
      <div class="col-lg-3"><?php include_once "wizardleftbar.php"; ?></div>
      <div class="col-lg-9" id="wizardcontent"><?php include_once "vendorbasics.php"; ?></div>
    </div>




