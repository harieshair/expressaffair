<?php //var_dump($Services)   ?>

<section>
    <div class="row">
        <div class="category-tab"><!--category-tab-->
            <div class="col-sm-12">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" 
                            data-target=".affair-item-nav" aria-expanded="false" aria-controls=".home-left-sidebar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="home"><i class="fa fa-home"></i></a>
                </div>
                <div class="navbar-collapse collapse in affair-item-nav " aria-expanded="true">
                    <ul class="nav nav-tabs" id="navbar-events">
                        <?php
                        $serviceSeq = 1;
                        foreach ($Services as $service) {
                            if ($serviceSeq == 1) {
                                $customerService->searchObj->serviceId = $service['id'];
                                $serviceName = $service['catalog_value'];
                                ?>	
                                <li class="active" id="<?php echo $service['id']; ?>" >
                                    <a href="javascript:void(0)" 
                                       onclick="getservicevendors('<?php echo $service['id']; ?>', 'servicelist');changenavstatus('navbar-events', '<?php echo $service['id']; ?>')">
                                           <?php echo $service['catalog_value']; ?>
                                    </a>
                                </li>
                            <?php } else {
                                ?>
                                <li id="<?php echo $service['id']; ?>" >
                                    <a href="javascript:void(0)" id="<?php echo $service['id']; ?>" 
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
    </div>
</section>
