<?php
if(!isset($_SESSION)){session_start();}
if(empty($customerService)){
	include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
	include_once(SERVERFOLDER."/customer/services.php");
	$customerService=new customerservice($dbconnection->dbconnector);
	$customerService->GetAllQueryStrings();
	$serviceName=$customerService->getCatalogValueById($customerService->searchObj->serviceid);
	$Citys=$customerService->GetAllCatalogValuesByMasterNames('City');
}
include_once(CLASSFOLDER."/searchservice.php");
$searchservice = new searchservices($dbconnection->dbconnector);
$vendorServices=$searchservice->getServicesBySearchOption($customerService->searchObj);
$vendorServices=$vendorServices["Items"];
?>
<div class="features_items" ><!--features_items-->
	<div id="features-items">
		<?php 
		if(!empty($vendorServices)){
			$canshowbooking=false;
			if((!empty($customerService->searchObj->eventFrom) || !empty($customerService->searchObj->eventTo)) 
				&& !empty($customerService->searchObj->locationId))
				$canshowbooking=true;
			foreach ($vendorServices as $service) {
				?>
				<div class="col-sm-4">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
								<img src="<?php echo $service['filePath']; ?>" alt="" height="170" width="42" onclick="previewitem(<?php echo $service['id'];?>);"/>					
								<span class="col-sm-12"><?php echo $service['title'];?></span>				
								<span class="col-sm-12"><?php echo $service['city'];?></span> 	
								<span class="col-sm-6"><label class="rate"><i class="fa fa-rupee"></i><?php echo $service['price']; ?></label></span>
								<span class="col-sm-6"><a class="rating"><?php echo getRatings($service['review']);?></a></span>
								
								<?php if($canshowbooking){ ?>
								<span class="col-sm-6"><a href="#" class="btn btn-default add-to-cart"  onclick="addtomycart('<?php echo $service['id']; ?>');"><i class="fa fa-bookmark"></i>Shortlist</a></span>
									<span class="col-sm-6"><a href="#" class="btn btn-default add-to-cart"  onclick="bookthisitem('<?php echo $service['id']; ?>');"><i class="fa fa-bookmark"></i>Book Now!</a></span>
									<?php }
									else{ ?>
										<span class="col-sm-12"><a href="#" class="btn btn-default add-to-cart"  onclick="addtomycart('<?php echo $service['id']; ?>');"><i class="fa fa-bookmark"></i>Shortlist</a></span>
										<?php } ?>
							</div>
						</div>
					</div>
					<div class="choose">
						<ul class="nav nav-pills nav-justified">
							<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
							<li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
						</ul>
					</div>
				</div>	
				<?php
			} 
		}
		else{ ?>
			<div class="col-sm-12 pull-center">
			<h3 class="item-unavail">New items comes soon</h4>
			</div>
		<?php }?>
	</div>
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
								<label class="rate"><i class="fa fa-rupee"></i>700000</label>
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
								<label class="rate"><i class="fa fa-rupee"></i>200000</label>
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
								<label class="rate"><i class="fa fa-rupee"></i>100000</label>
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
								<label class="rate"><i class="fa fa-rupee"></i>56000</label>
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

<?php
function getRatings($review){
	$rating="";
	switch($review){
		case 1:
		$rating.='<i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
		break;
		case 2:
		$rating.='<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
		break;
		case 3:
		$rating.='<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
		break;
		case 4:
		$rating.='<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star-o"></i>';
		break;
		case 5:
		$rating.='<i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>';
		break;
		default:
		$rating.='<i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i>';
		break;

	}
	return $rating;
}
?>