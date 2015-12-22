<?php //var_dump($Services) ?>

<section>
    <div class="row">
        <div class="category-tab"><!--category-tab-->
            <div class="col-sm-12">
                <ul class="nav nav-tabs" id="navbar-events">
                    <?php
                    $serviceSeq = 1;
                    foreach ($Services as $service) {
                        if ($serviceSeq == 1) {
                            $customerService->searchObj->serviceId = $service['id'];
                            $serviceName = $service['catalog_value'];
                            ?>	
                            <li>
                                <a href="home"><i class="fa fa-home"></i></a>
                            </li>		
                            <li class="active" id="<?php echo $service['id']; ?>" >
                                <a href="javascript:void()" 
                                   onclick="getservicevendors('<?php echo $service['id']; ?>', 'servicelist');changenavstatus('navbar-events', '<?php echo $service['id']; ?>')">
                                       <?php echo $service['catalog_value']; ?>
                                </a>
                            </li>
                        <?php } else {
                            ?>
                            <li id="<?php echo $service['id']; ?>" >
                                <a href="javascript:void()" id="<?php echo $service['id']; ?>" 
                                   onclick="getservicevendors('<?php echo $service['id']; ?>', 'servicelist');changenavstatus('navbar-events', '<?php echo $service['id']; ?>')">
                                       <?php echo $service['catalog_value']; ?>
                                </a>
                            </li>
                        <?php
                        }
                        $serviceSeq++;
                    }
                    ?>
                </ul>
            </div>
        </div><!--/category-tab-->
    </div>
</section>
