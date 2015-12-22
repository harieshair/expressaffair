<div class="features_items" ><!--features_items-->
    <div id="features-items">
        <?php if (empty($resultSet['items'])) { ?>
            <div class="col-sm-12 pull-center">
                <h3 class="item-unavail">New activities comings soon</h4>
            </div>
        <?php
        } else {
            foreach ($resultSet['items'] as $activity) {
                $attachment = $customerService->GetProfileAttachnmentsByEntityId($activity['id'],"Ritual");
                ?>           
                <div class="col-sm-3">
                    <div class="product-image-wrapper">
                        <div class="single-products">
                            <div class="productinfo text-center">
                                <img src="<?php echo !empty($attachment['file_path'])?$attachment['file_path']:"images/404/404.png"; ?>" alt="" height="150" width="42" 
                                     onclick="previewentity('activity',<?php echo $activity['id']; ?>);"/>
                                <span class="col-sm-12"><?php echo  substr($activity['description'], 0, 50); ?></span>
                                <span class="col-sm-12"><a class="btn btn-default get" href="rituals=<?php echo $activity['id']; ?>"><?php echo $activity['title']; ?></a></span>
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