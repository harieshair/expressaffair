<?php
if(!isset($_SESSION)){session_start();}
$activeMenu="home";
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(SERVERFOLDER."/customer/services.php");
$customerService=new customerservice($dbconnection->dbconnector);
$cityCatalogs=$customerService->GetCatalogValuesByMasterName('City');
$stateCatalogs=$customerService->GetCatalogValuesByMasterName('State');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>X Affair</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/prettyPhoto.css" rel="stylesheet">
	<link href="css/price-range.css" rel="stylesheet">
	<link href="css/animate.css" rel="stylesheet">	
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
	<link href="css/express.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->
<body>
	<header id="header"><!--header-->
		<?php 
		include "default/myprofile.php" ;
		include "static/navbar.php" ;				
		?>
	</header><!--/header-->
	<?php	
	include "default/signup.php" ;
	include "static/footer.php";
	?>
	<script src="js/jquery.js"></script>
	<script src="../plugins/jQuery/jQuery.validate.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/price-range.js"></script>
	<script src="js/jquery.prettyPhoto.js"></script>	
	<script src="js/main.js"></script>
	<script src="../scripts/admin.js"></script>
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
            		password: { 
            			required: true,
            			minlength: 8,
            			maxlength: 15,

            		} , 
            		cfmPassword: { 
                        required: true,
            			equalTo: "#password",
            			minlength: 8,
            			maxlength: 15
            		}
            	},
            	messages: {
            		email:"Please specify valid email",
            		name:"Please specify your name",
            		password :"Valid password required (8-15 characters)",
            		cfmPassword :"Confirm password must match to password",
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
    			savecustomersignupdetails("../service/config/customerserver.php","signup_form");
    		}
    	});  
    });

})(jQuery, window, document);
</script>
</body>
</html>