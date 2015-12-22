<div class="features_items" ><!--features_items-->
    <div id="features-items">
        <?php if (empty($resultSet['items'])) { ?>
            <div class="col-sm-12 pull-center">
                <h3 class="item-unavail">New events comings soon</h4>
            </div>
        <?php
        } else {
            foreach ($resultSet['items'] as $event) {
                $attachment = $customerService->GetProfileAttachnmentsByEntityId($event['id'],"Event");
                ?>           
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="<?php echo $attachment['file_path']; ?>" alt="" height="150" width="42" 
                                     onclick="previewentity('events',<?php echo $event['id']; ?>);"/>
                                <span class="col-sm-12"><?php echo  substr($event['description'], 0, 50); ?></span>
                                <span class="col-sm-12"><a class="btn btn-default get" href="events=<?php echo $event['id']; ?>"><?php echo $event['name']; ?></a></span>
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