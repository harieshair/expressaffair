	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
					<li><a href="home">Xpress Affair</a></li>
					<li class="active">Shortlisted Cart</li>
				</ol>
			</div>
			<div class="row">
				Lorem ipsum dolor sit amet, tincidunt purus fermentum pellentesque dignissim, phasellus tempus cursus est ut, senectus elit nulla posuere. Lectus lacus donec phasellus, amet dapibus consequat arcu. Pede gravida egestas porttitor in, aliquam sed magna quis nec, ligula elit ullamcorper non id. Odio sem tortor et sapien, tortor magna elit mollis, a nunc proin turpis, est dictum est fames.
			</div>
			<div class="cart_info">				
				<?php 
				$resultRows= $customerService->geAlltMyCartItems($CustomerId);
				$myCartItems=$resultRows['Items'];
				if(!empty($myCartItems)){	
					foreach($myCartItems as $item){ ?>
					<div class="box box-primary" id="div_<?php echo $item['cartId']; ?>">
						<div class="row"> 
							<span class="col-sm-1 pull-right">
								<a href="javascript:void(0)" class="btn btn-default pull-right" onclick="removecarteditem(<?php echo $item['cartId']; ?>,<?php echo $CustomerId; ?>)" ><i class="fa fa-times" ></i></a>
							</span>
							<span class=" col-sm-2 pull-right">
								<?php 
								$date = new DateTime($item['created_on']);
								echo $date->format('M').' '.$date->format('d').', '.$date->format('Y');?></span>

							</div>
							<div class="row" >
								<div class="col-sm-3">
									<img src="<?php echo $item['filePath'];?>" alt="" class="cart-image" >
								</div>
								<div class="col-sm-4">				
									<h4><a href=""><?php echo $item['title'];?></a></h4>
									<p>service provider:<a href=""><?php echo $customerService->customer->getVendorNameByVendorServiceId($item['v_service_id']); ?></a></p>
									<p>Service:<?php echo $item['service'];?></p>
									<p>Service Category:<?php echo $item['category'];?></p>
									<p><i class="fa fa-rupee"></i><?php echo $item['price'];?> <?php echo $customerService->getRatings($item['review']);?></p>
									<p>City:<?php echo $item['city'];?></p>															
								</div>	
								<div class="col-sm-5">
									<div class="row">
										<div class="col-sm-11">
											<span>Event: <?php echo $customerService->customer->getEventNameById($item['event_id']);?></span>											
											<?php if(!empty($item['ritual_id']))
											{?>
											<p>Ritual:<?php echo $customerService->customer->getRitualNameById($item['ritual_id']);?></p>			
											<?php } ?>						
											<?php if(!empty($item['event_from'])){ ?>
											<p>Event Date: 
												<?php
												echo $item['event_from']; 
												echo !empty($item['event_to'])?' to '.$item['event_to']:'';
												?> </p>
												<?php } ?>

											</div>

										</div>
										<div class="row cart-availabiity-form" >
											<form id="cartedform_<?php echo $item['cartId']; ?>" style="display:none"  name="cartedform_<?php echo $item['cartId']; ?>">
												<input type="hidden" name="vserviceid" value="<?php echo $item['v_service_id']; ?>">
												<input type="hidden" id="cart-item-properties_<?php echo $item['cartId']; ?>" 
												c="<?php echo $CustomerId ;?>" l="<?php echo $item['locationId'] ;?>" vsi="<?php echo $item['v_service_id'] ;?>"
												s="<?php echo $item['serviceId'] ;?>" e="<?php echo $item['event_id'] ;?>" r="<?php echo $item['ritual_id'] ;?>"
												ef="<?php echo $item['event_from'] ;?>" et="<?php echo $item['event_to'] ;?>">
												<div class="col-sm-6">	
													<label>From</label>
													<div class="input-group">		
														<input type="text" class="form-control pull-right" id="eventdatefrom_<?php echo $item['cartId']; ?>"  name="eventdatefrom" />
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
													</div>
												</div>
												<div class="col-sm-6" id="event-search-till">
													<label>To</label>
													<div class="input-group">
														<input type="text" class="form-control pull-right" id="eventdateto_<?php echo $item['cartId']; ?>" name="eventdateto" onchange="checkserviceavailability(<?php echo $item['cartId']; ?>)"  />
														<div class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</div>
													</div>	
												</div>
												
											</form>
										</div>
										<div class="row">
											<div class="col-sm-6 ">	
												<a class="btn btn-info form-control" href="javascript:void(0)" id="chkcartservice_<?php echo $item['cartId']; ?>" onclick="initializecarteddatepicker(<?php echo $item['cartId']; ?>,this.id)">Check Availability</a>
											</div>
											<div class="col-sm-6 pull-right">
												<?php 
												if(!empty($item['event_from']) || !empty($item['event_to'])){
													$cartDetails=array(
														'vserviceid'=>$item['v_service_id'],
														'eventdatefrom'=>$item['event_from'],
														'eventdateto'=>!empty($item['event_to'])?$item['event_to']:null
														);

													if(!$customerService->customer->IsAlreadyBookedCartedItem($cartDetails))	
														{?>
													<a class="btn btn-success form-control" href="javascript:void(0)" id="bookcartitem_<?php echo $item['cartId']; ?>"												
														onclick="bookCartedItem('<?php echo $item['cartId']; ?>')">Book Now</a>
														<?php 
													}
													else
														{ ?>
													<a class="btn btn-success form-control" href="javascript:void(0)" id="bookcartitem_<?php echo $item['cartId']; ?>"												
														style="display:none" onclick="bookCartedItem('<?php echo $item['cartId']; ?>')">Book Now</a>
														<?php
													}
												}
												else
													{ ?>
												<a class="btn btn-success form-control" href="javascript:void(0)" id="bookcartitem_<?php echo $item['cartId']; ?>"												
													style="display:none" onclick="bookCartedItem('<?php echo $item['cartId']; ?>')">Book Now</a>
												<?php
													}?>	
													<div class="col-sm-12">
													<span id="errorspan_<?php echo $item['cartId']; ?>" class="label label-danger control-label"></span>
												</div>					
												</div>
											</div>

										</div>	
									</div>
								</div>
								<?php 	
							}				
						}
						else{
							?>
							<td class="cart_product" colspan="5">
								No Items
							</td>
							<?php
						}		
						?>	
					</div>
				</section> <!--/#cart_items-->

				<section id="do_action">
					<div class="container">
						<div class="heading">
							<h3>What would you like to do next?</h3>
							<p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="chose_area">
									<ul class="user_option">
										<li>
											<input type="checkbox">
											<label>Use Coupon Code</label>
										</li>
										<li>
											<input type="checkbox">
											<label>Use Gift Voucher</label>
										</li>
										<li>
											<input type="checkbox">
											<label>Estimate Shipping & Taxes</label>
										</li>
									</ul>
									<ul class="user_info">
										<li class="single_field">
											<label>Country:</label>
											<select>
												<option>United States</option>
												<option>Bangladesh</option>
												<option>UK</option>
												<option>India</option>
												<option>Pakistan</option>
												<option>Ucrane</option>
												<option>Canada</option>
												<option>Dubai</option>
											</select>

										</li>
										<li class="single_field">
											<label>Region / State:</label>
											<select>
												<option>Select</option>
												<option>Dhaka</option>
												<option>London</option>
												<option>Dillih</option>
												<option>Lahore</option>
												<option>Alaska</option>
												<option>Canada</option>
												<option>Dubai</option>
											</select>

										</li>
										<li class="single_field zip-field">
											<label>Zip Code:</label>
											<input type="text">
										</li>
									</ul>
									<a class="btn btn-default update" href="">Get Quotes</a>
									<a class="btn btn-default check_out" href="">Continue</a>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="total_area">
									<ul>
										<li>Cart Sub Total <span>$59</span></li>
										<li>Eco Tax <span>$2</span></li>
										<li>Shipping Cost <span>Free</span></li>
										<li>Total <span>$61</span></li>
									</ul>
									<a class="btn btn-default update" href="">Update</a>
									<a class="btn btn-default check_out" href="">Check Out</a>
								</div>
							</div>
						</div>
					</div>
				</section>