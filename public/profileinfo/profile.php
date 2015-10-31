<?php// var_dump($Citys);
 //var_dump($States);
?>
<div class="col-sm-1">hlas dfksdjf slkfjlks flksdfjlksd fsklfjs lkfjlsf ls<br/>
a flkfjlfk slkfjlsdfkls
</div>
<div class="col-sm-6" id="dispprofile" style="border-style: none; ">
<?php include_once("profilereadmode.php"); ?>
    
</div>

<div class="col-sm-6 signup-form" id="editprofile" style="border-style: none; display: none">
    <form id="signup_form" name="signup_form">
         <div class="col-sm-6" style="border-style: none; ">  <label> Name   :  </label> <input type="text" name="name" id="name" value="<?php echo $customerData["name"]; ?>"/></div>
         <div class="col-sm-6" style="border-style: none; ">  <label>Email   : </label> <input type="text" name="email" id="email" value="<?php echo $customerData["email"]; ?>"/> </div>
        <div class="col-sm-6" style="border-style: none; ">  <label>Phone   : </label> <input type="text" name="phone" id="phone" value="<?php echo $customerData["contact_number"]; ?>"/> </div> 
       <div class="col-sm-6" style="border-style: none; ">   <label>Address :</label> <input type="text" name="address" id="address" value="<?php echo $customerData["address"]; ?>"/> </div> 
        <div class="col-sm-6" style="border-style: none; ">  <label>City   :  </label><select name="city" id="city" >
                <?php 
            foreach($Citys as $city) { ?>
            <option value="<?php  echo $city["id"]; ?>"> <?php echo $city["catalog_value"]; ?></option> 
            <?php }?>  
            </select> </div>
          <div class="col-sm-6" style="border-style: none; ">  <label>State   :  </label><select name="state" id="state" >
                <?php 
            foreach($States as $state) { ?>
            <option value="<?php  echo $state["id"]; ?>"> <?php echo $state["catalog_value"]; ?></option> 
            <?php }?>  
            </select> </div>
       <div class="signup-form">
          <input type="hidden" name="entity_id" id="entity_id" value="<?php echo $customerData["id"]; ?>"/>
               <a href="javascript:void()" class="btn btn-default pull-left"   id="submitsignup" >Save</a>&nbsp;&nbsp;&nbsp;
      <a href="javascript:void()" onclick="fun_edit_save_cancel();" class="btn btn-default pull-left"   id="btn_cancel">Cancel</a>
       </div>
    </form>
      
</div>
<div class="col-sm-10" style="border-style: none;">
 &nbsp;&nbsp;&nbsp;
   
</div>

<div class="col-sm-1"></div>