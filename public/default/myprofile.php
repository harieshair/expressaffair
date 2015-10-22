<div class="header_top"><!--header_top-->
	<div class="container">
		<div class="row">
			<div class="col-sm-4">
				<div class="logo pull-left">
					<a href="index.html"><img src="images/home/partner2.png" alt="" /></a>
				</div>
			</div>
			<div class="col-sm-8">
				<div class="shop-menu pull-right">
					<ul class="nav navbar-nav">
						
						<?php if(empty($customerData)){ ?>
						<li><a href="signin"><i class="fa fa-lock"></i> Login</a></li>
						<li><a href="signup"><i class="fa fa-lock"></i> SignUp</a></li>
						<?php  } 
						else {
							?>
							<li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
						<li><a href="javascript:void()" onclick="changeLocation('getCatalogsByMaterName','City');"><i class="fa fa-crosshairs"></i>Change Location</a></li>
						<li><a href="cart"><i class="fa fa-shopping-cart"></i> Cart</a></li>
							<li><a href="myaccount"><i class="fa fa-user"></i>
								<?php echo $customerData['name'];?> Profile</a></li>
							<li><a href="logout"><i class="fa fa-lock"></i>Log Out</a></li>
								<?php
							} ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div><!--/header_top-->		