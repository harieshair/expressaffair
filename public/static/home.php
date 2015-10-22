<?php   
$allEvents=$customerService->GetAllEvents(1,50,null); ?>
<section id="slider"><!--slider-->
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div id="slider-carousel" class="carousel slide" data-ride="carousel">
					<ol class="carousel-indicators">			
						<?php 									
						for($i=0;$i<count($allEvents);$i++){ 						?>			
						<li data-target="#slider-carousel" data-slide-to="<?php echo $i; ?>" class="active"></li>
							<? }?>
						</ol>

						<div class="carousel-inner">
							<?php 
							$itemcount=0;
							foreach($allEvents as $event){ 
								$attachments=$customerService->GetAllAttachnmentsByEntityId($event['id']);
								$itemcount++;
								?>
								<div class="item <?php echo ($itemcount==1)?'active':'' ;?>" >
									<div class="col-sm-6">
										<h1><span><?php echo $event['name']; ?></span></h1>

										<p> <?php echo $event['description']; ?></p>
										<a href="event=<?php echo $event['id'];?>" class="btn btn-default get">Customize it</a>
									</div>
									<div class="col-sm-6">
										<img src="../<?php echo $attachments[0]['file_path']; ?>" class="girl img-responsive" alt="dw" />
										<img src=""  class="pricing" alt="" />
									</div>
								</div>
								<?php } ?>
							</div>

							<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							</a>
							<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
								<i class="fa fa-angle-right"></i>
							</a>
						</div>

					</div>
				</div>
			</div>
		</section><!--/slider-->



<!--<section>
	<div class="container">
		<div class="row">			
			<div class="col-sm-12 padding-right">
				<?php
				
					if($columncount==0){ ?>
					<div class="row">
						<?php
					}
					$columncount++;
					?>

					<div class="col-sm-3 box-space">
						<div class="row">
							<div class="col-sm-8"><h3><?php  echo $event['name']; ?></h3></div>
							<div class="col-sm-4"><a href="events/<?php echo $event['id'];?>" class="btn btn-default get pull-right"><i class="fa fa-shopping-cart"></i>Customize it</a></div>
						</div>
						<div class="row">
							<div class="product-image-wrapper">
								<div class="single-products">
									<div class="productinfo text-center">
										<img src="../<?php echo $attachments[0]['file_path']; ?>" alt="" height="200" width="42"/>

									</div>
								</div>
								<div >
									<span><?php  echo $event['description'];?></span>
								</div>
							</div>
						</div>
					</div>

					<?php 
					if($columncount==3)
					{ 
						$columncount=0; 
						?>
					</div>
					<?php  
				}
			} ?>
		</div>
	</div>
</div>
</section> -->