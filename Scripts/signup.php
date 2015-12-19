<script type="text/javascript">

  (function($,W,D)
  {
     var JQUERY4U = {};

     JQUERY4U.UTIL =
     {
        setupFormValidation: function()
        {
            //form validation rules
            $("#signup_form").validate({
            	rules: {
            		name: {
                        required:true,
                        minlength: 3
                    },
                    state:"required",
                    city:"required",
                    address:"required",
                    phone:{
                        required:true,
                        minlength:10
                    },
                    chkDeclaration:"required",
                    email: {
                     required: true,
                     email: true
                 },           
                 signuppassword: { 
                     required: true,
                     minlength: 8,
                     maxlength: 15,

                 } , 
                 cfmPassword: { 
                    required: true,
                    equalTo: "#signuppassword",
                    minlength: 8,
                    maxlength: 15
                }
            },
            messages: {
              email:"Please specify valid email",
              name:"Please specify your name",
              signuppassword :"Valid password required (8-15 characters)",
              cfmPassword :"Password does not matches",
              state:"please specify your current state",
              city:"please specify your current city",
              address:"please specify your communication address",
              phone:"please specify four contact details",
              chkDeclaration:"Agree to declaration",
          }
      });
}
} 

    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {         
    	JQUERY4U.UTIL.setupFormValidation();     
    	$('#submitsignup').on('click', function(){ 
    		if($('#signup_form').valid()){
    			savecustomersignupdetails("service/customerserver.php","signup_form",changetoreadonlymode);
    		}
    	});  
    });

})(jQuery, window, document);

changetoreadonlymode=function(){
		fun_edit_save_cancel();
                oncallservice("",'profileinfo/profilereadmode.php',function(){$('#dispprofile').html(ajaxResponse);});
	};
        fun_edit_save_cancel =function() {
            $("#dispprofile").toggle(); 
            $("#editprofile").toggle();       
};    
</script>