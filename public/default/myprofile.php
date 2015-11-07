<?php
if(!isset($_SESSION)){session_start();}
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(SERVERFOLDER."/customer/services.php");
if(empty($customerService)){
	$customerService=new customerservice($dbconnection->dbconnector);
	if(isset($_SESSION['CUSTOMERID']) && empty($customerData))
	{
		$customerId=$_SESSION['CUSTOMERID']; 
		$customerData = $customerService->GetCustomerById($customerId);
		if(!isset($_SESSION['LOCATION']))
			$_SESSION['LOCATION']=$customerData['city'] ;
	}
}
?>
<div class="header_top"><!--header_top-->
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<div class="logo pull-left">
					<a href="index.html"><img src="images/home/partner2.png" alt="" /></a>
				</div>
			</div>
			<div class="col-sm-8 shop-menu">
				<div class="navbar-header pull-left">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".affair-header-nav">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="pull-right">
					<ul class="nav navbar-nav collapse navbar-collapse affair-header-nav">
						<?php if(empty($customerData)){ ?>
						<li><a href="signin"><i class="fa fa-lock"></i> Login</a></li>
						<li><a href="signup"><i class="fa fa-lock"></i> SignUp</a></li>
						<?php  } 
						else {
							?>
							<li><a href="home"><i class="fa fa-home"></i></a></li>
							<li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
							<li><a href="javascript:void()" onclick="changeLocation('getCatalogsByMaterName','City');"><i class="fa fa-crosshairs"></i>Change Location</a></li>
							<li><a href="cart"><i class="fa fa-shopping-cart"></i> Cart</a></li>
							<li><a href="myaccount"><i class="fa fa-user"></i>
								<?php echo $customerData['name'];?></a></li>
								<li><a href="logout"><i class="fa fa-lock"></i>Sign Out</a></li>
								<?php
							} ?>						
						</ul>
					</div>
				<!--<div class="shop-menu pull-right">
					<ul class="nav navbar-nav">
						
						<?php if(empty($customerData)){ ?>
						<li><a href="signin"><i class="fa fa-lock"></i> Login</a></li>
						<li><a href="signup"><i class="fa fa-lock"></i> SignUp</a></li>
						<?php  } 
						else {
							?>
							<li><a href="home"><i class="fa fa-home"></i></a></li>
							<li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
							<li><a href="javascript:void()" onclick="changeLocation('getCatalogsByMaterName','City');"><i class="fa fa-crosshairs"></i>Change Location</a></li>
							<li><a href="cart"><i class="fa fa-shopping-cart"></i> Cart</a></li>
							<li><a href="myaccount"><i class="fa fa-user"></i>
								<?php echo $customerData['name'];?></a></li>
								<li><a href="logout"><i class="fa fa-lock"></i>Sign Out</a></li>
								<?php
							} ?>
						</ul>
					</div>-->
				</div>
			</div>
		</div>
	</div><!--/header_top-->		