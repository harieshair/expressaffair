<?php
if(!isset($_SESSION)){session_start();}
if(empty($serviceid))
$serviceid= isset($_POST['serviceid'])?$_POST['serviceid']:0;
if(empty($locationid))
$locationid= isset($_POST['locationid'])?$_POST['locationid']:0;
if(empty($customerService)){
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(SERVERFOLDER."/customer/services.php");
$customerService=new customerservice($dbconnection->dbconnector);
$serviceName=$customerService->getCatalogValueById($serviceid);
$Citys=$customerService->GetAllCatalogValuesByMasterNames('City');
}
$vendorServices=$customerService->GetAllVendorServices($serviceid,$locationid);
?>
<div class="features_items"><!--features_items-->
	<h2 class="title text-center"><?php echo !empty($serviceName)?$serviceName:"No Services"; ?></h2>
	<?php 
	if(!empty($vendorServices)){
	foreach ($vendorServices as $service) {
		?>
		<div class="col-sm-4">
		<div class="product-image-wrapper">
			<div class="single-products">
				<div class="productinfo text-center">
					<img src="<?php echo HTTPAPPLICATIONROOT.'/'.$service['file_path']; ?>" alt="" height="170" width="42" onclick="previewitem(<?php echo $service['id'];?>);"/>					
					<span class="col-sm-12"><?php echo $service['title'];?></span>				
					<span class="col-sm-12"><?php echo $Citys[$service['locations']];?></span> 	
					<span class="col-sm-6"><label class="rate"><i class="fa fa-rupee"></i><?php echo $service['price']; ?></label></span>
					<span class="col-sm-6"><img class="rating" src="images/product-details/rating.png"/></span>					
					<span class="col-sm-12"><a href="#" class="btn btn-default add-to-cart"  onclick="addtocart('<?php echo $service['id']; ?>');"><i class="fa fa-bookmark"></i>Shortlist to booking</a></span>
				</div>
			</div>
			<div class="choose">
				<ul class="nav nav-pills nav-justified">
					<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
					<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
				</ul>
			</div>
		</div>
	</div>
		<?php
	} 
	}
	else{
		echo "Service providers yet contracted ";
		}?>
	
</div><!--features_items-->



<div class="recommended_items"><!--recommended_items-->
	<h2 class="title text-center">recommended items</h2>
	
	<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<div class="item active">	
	<div class="col-sm-3">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
								<img src="images/home/default.jpg" alt="" height="120" width="32" />
								<h2>INR 700000</h2>
								<p>Platinum Pack</p>
								<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
							</div>
							
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
								<img src="images/home/default.jpg" alt=""  height="120" width="32"/>
								<h2>INR 200000</h2>
								<p>Diamond Pack</p>
								<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
							</div>
							
						</div>
					</div>
				</div>
						<div class="col-sm-3">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
								<img src="images/home/default.jpg" alt="" height="120" width="32"/>
								<h2>INR 100000</h2>
								<p>Golden Pack</p>
								<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
							</div>
							
						</div>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
								<img src="images/home/default.jpg" alt="" height="120" width="32" />
								<h2>INR 56000</h2>
								<p>Silver Pack</p>
								<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
			<i class="fa fa-angle-left"></i>
		</a>
		<a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
			<i class="fa fa-angle-right"></i>
		</a>			
	</div>
</div><!--/recommended_items-->