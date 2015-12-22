<div class="features_items" ><!--features_items-->
    <div id="features-items">
        <?php if (empty($resultSet['items'])) { ?>
            <div class="col-sm-12 pull-center">
                <h3 class="item-unavail">New activities comings soon</h4>
            </div>
        <?php
        } else {
            $Services=$customerService->GetAllCatalogValuesByMasterNames('Services');
            foreach ($resultSet['items'] as $service) {
                
                ?>           
                <div class="col-sm-4">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                               <span class="col-sm-12"><?php echo  $Services[$service['service_id']]; ?></span>
                                <span class="col-sm-6">Available Locations:</span> 
                                <span class="col-sm-6"><?php echo  $service['location']; ?></span>
                                <span class="col-sm-6">Available Partners:</span> 
                                <span class="col-sm-6"><?php echo  $service['vendors']; ?></span>
                            </div>
                        </div>
                    </div>
                </div>	
                <?php
            }
        }
        ?>
    </div>
</div>