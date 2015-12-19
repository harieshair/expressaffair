<?php
if (session_status() != PHP_SESSION_ACTIVE)
    session_start();
include_once($_SERVER['DOCUMENT_ROOT'] . "/eventconfig.php");
include_once(SERVERFOLDER . "/customer/services.php");
$customerService = new customerservice($dbconnection->dbconnector);
$vserviceid = isset($_POST['vserviceid']) ? $_POST['vserviceid'] : 0;
$locationId = isset($_POST['locationid']) ? $_POST['locationid'] : 0;
$serviceItem = $customerService->getServiceItemDetailsByvServiceId($vserviceid, $locationId);
?>
<section>
    <div class="row"><h4 class="header-horizontal-center"><?php echo $serviceItem['Details']['title']; ?><small>    <?php echo $serviceItem['Details']['vendorname']; ?></small></h4></div>
    <div class="row">
        <div class="col-sm-6">
            <div class="col-sm-10">
                <div class="carousel slide">
                    <div >
                        <?php
                        foreach ($serviceItem["Attachments"] as $item) {
                            ?>
                            <div class="active">								
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="<?php echo HTTPAPPLICATIONROOT . '/' . $item['file_path']; ?>" alt="" height="170" width="42" />
                                        </div>
                                    </div>
                                </div>													
                            </div>

    <?php break;
} ?>
                    </div>
                </div>
            </div>
            <div class="col-sm-10">
                <div class="recommended_items">
                    <div id="preview-item-carousel" class="carousel slide" data-ride="carousel">

                        <div class="carousel-inner">
                            <?php
                            $totalitem = 0;
                            foreach ($serviceItem["Attachments"] as $item) {
                                if (($totalitem % 3) == 0) {
                                    ?>
                                    <div class="item <?php echo empty($totalitem) ? 'active ' : ''; ?>">
                                    <?php }
                                    ?>								
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="<?php echo HTTPAPPLICATIONROOT . '/' . $item['file_path']; ?>" alt="" />
                                                </div>
                                            </div>
                                        </div>													
                                    </div>

                                    <?php
                                    $totalitem++;
                                    if (($totalitem % 3) == 0) {
                                        ?>
                                    </div>
                                <?php
                                }
                            }
                            if (($totalitem % 3) != 0) {
                                ?>
                            </div>
                        <?php }
                        ?>
                    </div>
                    <a class="left recommended-item-control" href="#preview-item-carousel" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a class="right recommended-item-control" href="#preview-item-carousel" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>			
    <div class="col-sm-6">
        <div class="row">
            <div class="form-group margin">
                <label class="col-sm-3 "><span class="pull-right">Service:</span></label>
                <label class="col-sm-9"><?php echo $serviceItem['Details']['service']; ?></label>         
            </div>
            <div class="form-group margin">
                <label class="col-sm-3"><span class="pull-right">Ratings:</span></label>
                <label class="col-sm-9">xxxxxxxx</label>
            </div>
            <div class="form-group margin">
                <label class="col-sm-3"><span class="pull-right">Price:</span></label>
                <label class="col-sm-9"><?php echo $serviceItem['Details']['price']; ?></label>
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <h4 >Specification</h4>
        <span><?php echo $serviceItem['Details']['description']; ?></span>
    </div>
</div>
</div>
</section>