<?php
$allEvents = $customerService->GetAllEvents(1, 50, null);
$entityCounts = $customerService->getEntityCounts();
?>
<section id="slider">
    <div class="container">		
        <div class="row">
            <div class="home-slider">
                <?php if (count($allEvents) > 0) { ?>
                    <div class="col-sm-12">
                        <div id="slider-carousel" class="carousel slide" data-ride="carousel">

                            <ol class="carousel-indicators">			
                                <?php
                                for ($i = 0; $i < count($allEvents); $i++) {
                                    ?>			
                                    <li data-target="#slider-carousel" data-slide-to="<?php echo $i; ?>" class="active"></li>
                                    <?php
                                }
                                ?>
                            </ol>
                            <div class="carousel-inner">
                                <?php
                                $itemcount = 0;
                                foreach ($allEvents as $event) {
                                    $attachment = $customerService->GetProfileAttachnmentsByEntityId($event['id'],"Event");
                                    $itemcount++;
                                    ?>
                                    <div class="item <?php echo ($itemcount == 1) ? 'active' : ''; ?>" >
                                        <div class="col-sm-12">
                                            <div class="col-sm-3">
                                                <div class="home-slider-image-container">
                                                    <div class="slider-img-container">
                                                        <img src="<?php echo $attachment['file_path']; ?>"  alt="dw" height="190" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <h1><span><?php echo $event['name']; ?></span></h1>
                                                <?php //echo $customerService->closehtmltags(substr($event['description'],0,700));  ?>										
                                                <p><?php echo substr($event['description'], 0, 350); ?> ... </p>
                                                <a href="events=<?php echo $event['id']; ?>" class="btn btn-default get">Plan this event</a>
                                            </div>   
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                            <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                                <i class="fa fa-angle-left"></i>
                            </a>
                            <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                                <i class="fa fa-angle-right"></i>
                            </a>                        
                        </div>
                    </div>
                    <?php
                } else {
                    include_once("statichomeslider.php");
                }
                ?>
            </div>					
        </div>
        <div class="row">
            <?php include_once("lefthome.php"); ?>  

            <div class="col-sm-12 padding-right home-right-container" >
                <div id="entitylists">
                    <?php
                    $entity = "events";
                    include_once("lefthomecontainer.php");
                    ?>
                </div>
            </div>
        </div>

    </div>
</section>