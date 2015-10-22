	<section ><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-6">
					<span>Business Meetings
						Lorem ipsum dolor sit amet, ipsum est sociis dignissim, vitae tempor venenatis nam, scelerisque morbi ac urna, metus facilisis accumsan egestas at. Sapien cursus sit nunc, sit cras sem turpis, pulvinar dictumst elit integer rutrum. In metus pellentesque in, ipsum pede adipiscing urna, euismod et vel tincidunt, sagittis mauris sapien nibh felis. Eu lorem nisl wisi nonummy, commodo sed elit posuere eget, dolor semper vestibulum sed rutrum, condimentum lobortis lectus ipsa. Augue rhoncus dui qui, viverra neque cupidatat nam sed, sit nibh nam aliquam in. Ut sem molestie vel, eu pede a habitant, wisi nisl vestibulum blandit, montes lectus vel enim libero. Eget mauris arcu ut odio, nunc ligula felis ipsum, consectetuer suspendisse egestas porttitor. Aliquam vivamus sapien quam, sed eget morbi in mauris, harum amet vestibulum tortor, in metus fringilla urna magnis. Wisi expedita rhoncus tincidunt, ullamcorper magna luctus orci ultricies, libero nunc orci scelerisque maecenas.</span>
					</div>
					<div class="col-sm-6">
						<div class="signup-form"><!--sign up form-->
							<h2>New User Signup!</h2>
							<form id="signup_form" name="signup_form">
								<div class="col-sm-6"><input type="email" placeholder="Email Address" maxlength="80" id="email" name="email" onblur="isemailexisits(this.value)" /></div>
								<div class="col-sm-6"><input type="text" placeholder="Name" maxlength="30" disabled="true" id="name" name="name" />						</div>		
								<div class="col-sm-6"><input type="password"  placeholder="Password" id="password" name="password" maxlength="25"  disabled="true"/></div>
								<div class="col-sm-6"><input type="password" placeholder="Confirm Password" id="cfmPassword" name="cfmPassword" maxlength="25" disabled="true" /></div>
								<div class="col-sm-6"><input type="text" name="phone" placeholder="Contact Number" id="phone" name="contacts" maxlength="15" disabled="true" /></div>
								<div class="col-sm-6"><select name="state" disabled="true" id="state" name="state">
									<option value="">State</option>
									<?php
									foreach ($stateCatalogs as $state) 
										{ ?>
									<option value="<?php  echo $state['id']; ?>"><?php echo $state['catalog_value']; ?></option>
									<?php }
									?>

								</select></div>
								
								<div class="col-sm-6"><select  name="city" disabled="true" id="city" name="city" >
									<option value="">City</option>
									<?php
									foreach ($cityCatalogs as $city) 
										{ ?>
									<option value="<?php  echo $city['id']; ?>"><?php echo $city['catalog_value']; ?></option>
									<?php }
									?>
								</select></div>
								<div class="col-sm-6"><textarea  name="address" placeholder="Address for communication" id="address" name="address" disabled="true" ></textarea></div>
								<br/><div class="col-sm-12">
								<input type="checkbox" id="chkDeclaration" name="chkDeclaration" class="pull-left"> aggre to terms & condition
								<a href="javascript:void()" class="btn btn-default pull-right" disabled="true"  id="submitsignup">Submit</a>
							</div>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->