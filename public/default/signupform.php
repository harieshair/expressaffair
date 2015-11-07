<div class="signup-form"><!--sign up form-->
							
							<form id="signup_form" name="signup_form">
								<div class="col-sm-6"><input type="email" placeholder="Email Address" maxlength="80" id="email" name="email" onblur="isemailexisits(this.value)" /></div>
								<div class="col-sm-6"><input type="text" placeholder="Name" maxlength="30" disabled="true" id="name" name="name" />						</div>		
								<div class="col-sm-6"><input type="password"  placeholder="Password" id="signuppassword" name="signuppassword" maxlength="25"  disabled="true"/></div>
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