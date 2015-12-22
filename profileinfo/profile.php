<section>
  <div class="container">
    <div class="row">
    <div class="col-sm-4 profile-border-right">
    Lorem ipsum dolor sit amet, tincidunt purus fermentum pellentesque dignissim, phasellus tempus cursus est ut, senectus elit nulla posuere. Lectus lacus donec phasellus, amet dapibus consequat arcu. Pede gravida egestas porttitor in, aliquam sed magna quis nec, ligula elit ullamcorper non id. Odio sem tortor et sapien, tortor magna elit mollis, a nunc proin turpis, est dictum est fames.
      </div>
      <div class="col-sm-8 profile-border-left">
        <div  id="dispprofile">
          <?php include_once("profilereadmode.php"); ?>    
        </div>

        <div class="signup-form" id="editprofile" style="display: none">
          <form id="signup_form" name="signup_form">
            <input type="hidden" name="entity_id" id="entity_id" value="<?php echo $customerData["id"]; ?>"/>
            <div class="col-sm-6" >  
             <label> Name :  </label>
             <input type="text" name="name" id="name" value="<?php echo $customerData["name"]; ?>"/>
           </div>
           <div class="col-sm-6" > 
            <label>Email   : </label>
            <input type="text" name="email" id="email" value="<?php echo $customerData["email"]; ?>"/> 
          </div>
          <div class="col-sm-6" >  <label>Phone:</label> 
           <input type="text" name="phone" id="phone" value="<?php echo $customerData["contact_number"]; ?>"/> 
         </div> 
         <div class="col-sm-6" >   
           <label>Address :</label>
           <input type="text" name="address" id="address" value="<?php echo $customerData["address"]; ?>"/>
         </div> 
         <div class="col-sm-6" >
          <label>City:</label>
          <select name="city" id="city" >
            <?php 
            foreach($Citys as $city) { ?>
            <option value="<?php  echo $city["id"]; ?>"> <?php echo $city["catalog_value"]; ?></option> 
            <?php }?>  
          </select> 
        </div>
        <div class="col-sm-6" style="border-style: none; ">
          <label>State   :  </label>
          <select name="state" id="state" >
            <?php 
            foreach($States as $state) { ?>
            <option value="<?php  echo $state["id"]; ?>"> <?php echo $state["catalog_value"]; ?></option> 
            <?php }?>  
          </select>
        </div>
        <div class ="col-sm-12">
          <div class="signup-form pull-right">           
            <div class="col-sm-6">                   
              <a href="javascript:void(0)" class="btn btn-default pull-left"   id="submitsignup" >Save</a>          
            </div>        
            <div class="col-sm-6">                 
              <a href="javascript:void(0)" onclick="fun_edit_save_cancel();" class="btn btn-default pull-right"   id="btn_cancel">Cancel</a>   
            </div>
          </div>
        </div>
      </form>

    </div>
  </div>
</div>
</div>
</section>