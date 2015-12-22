<?php
if (session_status() != PHP_SESSION_ACTIVE)
    session_start();
if (empty($customerService)) {
    include_once($_SERVER['DOCUMENT_ROOT'] . "/eventconfig.php");
    include_once(SERVERFOLDER . "/customer/services.php");
    $customerService = new customerservice($dbconnection->dbconnector);
    $customerService->GetAllQueryStrings();
    $serviceName = $customerService->getCatalogValueById($customerService->searchObj->serviceid);
    $Citys = $customerService->GetAllCatalogValuesByMasterNames('City');
}
include_once(CLASSFOLDER . "/searchservice.php");
$searchservice = new searchservices($dbconnection->dbconnector);
$vendorServices = $searchservice->getServicesBySearchOption($customerService->searchObj);
$vendorServices = $vendorServices["Items"];
?>
<div class="features_items" ><!--features_items-->
    <div id="features-items">
        <?php
        if (!empty($vendorServices)) {
            $canshowbooking = false;
            if ((!empty($customerService->searchObj->eventFrom) || !empty($customerService->searchObj->eventTo)) && !empty($customerService->searchObj->locationId))
                $canshowbooking = true;
            foreach ($vendorServices as $service) {
                ?>
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="<?php echo $service['filePath']; ?>" alt="" height="170" width="42" onclick="previewitem(<?php echo $service['id']; ?>,<?php echo $service['locationId']; ?>);"/>					
                                <span class="col-sm-12"><?php echo $service['title']; ?></span>				
                                <span class="col-sm-12"><?php echo $service['city']; ?></span> 
                                <div class="row">
                                    <span class="col-sm-6"><label class="rate"><i class="fa fa-rupee"></i><?php echo $service['price']; ?></label></span>
                                    <span class="col-sm-6"><a class="rating"><?php echo $customerService->getRatings($service['review']); ?></a></span>
                                </div>
                                <?php if ($canshowbooking) { ?>
                                    <span class="col-sm-6"><a href="#" class="btn btn-default get"  onclick="addtomycart('<?php echo $service['id']; ?>');"><i class="fa fa-bookmark"></i> Shortlist</a></span>
                                    <span class="col-sm-6"><a href="#" class="btn btn-default get"  onclick="bookthisitem('<?php echo $service['id']; ?>');"><i class="fa fa-bookmark"></i> Book Now!</a></span>
                                <?php } else {
                                    ?>
                                    <span class="col-sm-12"><a href="#" class="btn btn-default get"  onclick="addtomycart('<?php echo $service['id']; ?>');"><i class="fa fa-bookmark"></i> Shortlist</a></span>
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
        } else {
            ?>
            <div class="col-sm-12 pull-center">
                <h3 class="item-unavail">New items comings soon</h4>
            </div>
        <?php } ?>
    </div>
</div><!--features_items-->