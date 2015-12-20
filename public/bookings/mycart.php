	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
					<li class="active"><a href="home">Xpress Affair Cart</a></li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
                                            <tr class="cart_menu" style="border-style: dashed">
							<td class="image">Service</td>
							<td class="description">About Service</td>
							<td class="description">Provider</td>
							<td class="description">Description</td> 
							<td class="total">Price</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php 
						$resultRows= $customerService->geAlltMyCartItems($CustomerId);
						$myCartItems=$resultRows['Items'];
						if(!empty($myCartItems)){	
							foreach($myCartItems as $item){ ?>

							<tr>
								<td class="cart-img-td cart_product ">

									<img src="<?php echo $item['filePath'];?>" alt="" class="cart-image" >
								</td>
								<td class="cart_description">
									<h4><a href=""><?php echo $item['title'];?></a></h4>
									<p>Provider Location: <?php echo $item['city'];?></p>
									<p>Event From: 1089772</p>
									<p>Event To: 1089772</p>
								</td>
								<td class="cart_description">
									<h4><a href="">Xpress Affair</a></h4>								
								</td>
								<td class="cart_description">
									<h4><a href=""><?//php echo $item['description'];?></a></h4>
									<p>Event Location: <?//php echo $item['city'];?></p>
									<p>Event From: 1089772</p>
									<p>Event To: 1089772</p>
								</td>
								<td class="cart_price">
									<p><i class="fa fa-rupee"></i><?php echo $item['price'];?></p>
								</td>						
							</tr>	
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
				</tbody>
			</table>
		</div>
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