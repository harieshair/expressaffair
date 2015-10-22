<?php
if(!isset($_SESSION)){session_start();}
$activeMenu="home";
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
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
	include "default/login.php" ;
	include "static/footer.php";
	?>
	<script type="text/javascript">

		(function($,W,D)
		{
			var JQUERY4U = {};

			JQUERY4U.UTIL =
			{
				setupFormValidation: function()
				{
            //form validation rules
            $("#login-form").validate({
            	rules: {
            		email: {
            			required: true,
            			email: true
            		},           
            		password: { 
            			required: true,
            			minlength: 8,
            			maxlength: 15,

            		} 
            	},
            	messages: {
            		email:"Please specify valid email",
            		password :"Valid password required (8-15 characters)"            	
            	}
            });
}
} 

    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {         
    	JQUERY4U.UTIL.setupFormValidation();     
    	$('#submitlogin').on('click', function(){ 
    		if($('#login-form').valid()){
    			getintoaccount("../service/customerserver.php","login-form");
    		}
    	});  
    });

})(jQuery, window, document);
</script>
</body>
</html>