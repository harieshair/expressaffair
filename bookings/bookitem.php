	<?php
	$serviceItem=$customerService->getServiceItemDetailsByvServiceId($customerService->searchObj->vserviceId,$customerService->searchObj->locationId);
	$serviceDetail=$serviceItem['Details'];
	?>
	<section>
<div class="container">
		<div class="row"><h4 class="header-horizontal-center"><?php echo $serviceDetail['title'];?><small>    <?php echo $serviceDetail['vendorname'] ;?></small></h4></div>
		<div class="row">
			<div class="col-sm-9"><!-- start of product details -->
				<div class="col-sm-6">
					<div class="col-sm-10">
						<div class="carousel slide">
							<div >
								<?php 
								foreach ($serviceItem["Attachments"] as $item)
									{?>
								<div class="active">								
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="<?php echo HTTPAPPLICATIONROOT.'/'.$item['file_path'];?>" alt="" height="170" width="42" />
											</div>
										</div>
									</div>													
								</div>

								<?php break; } ?>
							</div>
						</div>
					</div>
					<div class="col-sm-10">
						<div class="recommended_items">
							<div id="preview-item-carousel" class="carousel slide" data-ride="carousel">

								<div class="carousel-inner">
									<?php 
									$totalitem=0;
									foreach ($serviceItem["Attachments"] as $item)
									{
										if(($totalitem%3)==0){ 
											?>
											<div class="item <?php echo empty($totalitem)?'active ':'';?>">
												<?php 	}
												?>								
												<div class="col-sm-4">
													<div class="product-image-wrapper">
														<div class="single-products">
															<div class="productinfo text-center">
																<img src="<?php echo HTTPAPPLICATIONROOT.'/'.$item['file_path'];?>" alt="" />
															</div>
														</div>
													</div>													
												</div>

												<?php
												$totalitem++;
												if(($totalitem%3)==0){
													?>
												</div>
												<?php }

											}
											if(($totalitem%3)!=0){
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
							<h4><a href=""><?php echo $serviceDetail['title'];?></a> <small><?php echo $customerService->customer->getCatalogValueById($customerService->searchObj->locationId);?></small></h4>
							<div class="col-sm-12">
									<div class="col-sm-6"><label>Service Provider:</label></div>
									<div class="col-sm-6"><span class="pull-left"><?php echo $customerService->customer->getVendorNameByVendorId($serviceDetail['vendor_id']);?></span> </div>        
								</div>		
								<div class="col-sm-12">
									<div class="col-sm-6"><label>Service:</label></div>
									<div class="col-sm-6"><span class="pull-left"><?php echo $serviceDetail['service'];?></span> </div>        
								</div>								
								<?php if(!empty($serviceDetail['service_category']))
								{?>
								<div class="col-sm-12">
									<span class="col-sm-6"><label >Category:</label></span>
									<span class="col-sm-6"><span class="pull-left"><?php echo $customerService->customer->getCatalogValueById($serviceDetail['service_category']);?></span></span>
								</div>
								<?php } ?>															
								<?php if(!empty($customerService->searchObj->eventId))
								{?>
								<div class="col-sm-12">
									<span class="col-sm-6"><label >Event</label></span>
									<span class="col-sm-6"><span class="pull-left"><?php echo $customerService->customer->getEventNameById($customerService->searchObj->eventId);?></span></span>
								</div>
								<?php } 
								if(!empty($customerService->searchObj->ritualId))
								{?>
								<div class="col-sm-12">
									<span class="col-sm-6"><label>Ritual:</label></span>
									<span class="col-sm-6"><span class="pull-left"><?php echo $customerService->customer->getRitualNameById($customerService->searchObj->ritualId);?></span></span>
								</div>
								<?php } ?>	
								<div class="col-sm-12">
									<span class="col-sm-6"><label>Event Date</label></span>
									<span class="col-sm-6"><span class="pull-left"><?php 
									echo $customerService->searchObj->eventFrom; 
									echo !empty($customerService->searchObj->eventTo)?' to '.$customerService->searchObj->eventTo:'';
									?></span>
								</div>
								
								<div class="col-sm-12">
									<span class="col-sm-4"><span class="pull-right"><i class="fa fa-rupee"></i><?php echo $serviceDetail['price'];?></span></span>
									<span class="col-sm-8"><span class="pull-left"><?php echo $customerService->getRatings($serviceDetail['review']);?></span></span>
								</div>	
											
							</div>
						</div>
					</div> <!-- end of product details -->
					<div class="col-sm-3"> <!-- start of customer details -->
					<div class="box box-primary">
					<h4 class="header-horizontal-center">Communication Details</h4>
						<form name="booking-form-customer" id="booking-form-customer">
							<label class="col-sm-12">Contact Number</label>
							<div class="input-group">		
								<input type="text" id="cust_contactnumber" name="cust_contactnumber" class="form-control" readonly
								value="<?php echo $customerData['contact_number']; ?>" maxlength="10" onkeypress="if ( isNaN( String.fromCharCode(event.keyCode) )) return false;" >
								<div class="input-group-addon edit-disabled">
								<span onclick="$('#cust_contactnumber').attr('readonly',false);">
									<i class="fa fa-pencil"></i>
									</span>
								</div>
							</div>							
							<label class="col-sm-12">Email</label>
							<input type="text" name="cust_email" class="form-control" value="<?php echo $customerData['email']; ?>">
							<label class="col-sm-12 edit-disabled">Address<span  class="pull-right" onclick="$('#cust_address').attr('readonly',false);" class="pull-right"><i class="fa fa-pencil"></i></span></label>
							<textarea name="cust_address" id="cust_address" style="height: 150px;" readonly><?php echo $customerData['address']; ?></textarea>
						</form>	
						</div>				
					</div> <!-- start of customer details -->
				</div>
				<div class="col-sm-12 pull-right">
				<span class="col-sm-9"><span id="errorHandler" class="label label-danger pull-right"></span></span>
				<span class="col-sm-3"><a class="btn btn-success pull-right form-control" href="javascript:void()" onclick="bookitemonmyaccount()">Confirm</a></span>
					</div>	
				<div class="row"> <!-- start of specification -->
					<div class="col-sm-12">
						<h4 >Specification</h4>
						<span><?php echo $serviceDetail['description'];?></span>
					</div>
				</div> <!-- end of specification -->
			</div>
			</div><!-- end of container -->
		</section>