<script type="text/javascript">
	(function($,W,D)
	{
		var JQUERY4U = {};
		JQUERY4U.UTIL =
		{
			setupFormValidation: function()
			{
				$("#booking-form-customer").validate({
					rules: {
						cust_email: {
							required: true,
							email: true
						},           
						cust_contactnumber: { 
							required: true,            			
							minlength: 10,
							maxlength: 14
						},
						cust_address:{
							required:true,
							minlength:10
						}
					},
					messages: {
						email:"Please specify valid email",
						cust_contactnumber :"Please specify valid contact number",
						cust_address:"Please specify valid address"
					}
				});
			}
		} 
    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {         
    	JQUERY4U.UTIL.setupFormValidation();
    });

})(jQuery, window, document);
var pendingactions={};
$(document).ready(function(){
	<?php if(!empty($customerService->searchObj)){ 
		include "requestparser.php";
	 } ?>
	});
</script>