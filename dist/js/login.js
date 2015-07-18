
$(document).ready(function(){
jQuery('ul.nav li.dropdown').hover(function() {
  jQuery(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn();
}, function() {
  jQuery(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut();
});
});
/*------------------------------------------------------*/
Array.prototype.contains = function(v) {
    for(var i = 0; i < this.length; i++) {
        if(this[i] === v) return true;
    }
    return false;
};
/*------------------------------------------------------*/
Array.prototype.unique = function() {
    var arr = [];
    for(var i = 0; i < this.length; i++) {
        if(!arr.contains(this[i])) {
            arr.push(this[i]);
        }
    }
    return arr; 
}
/*------------------------------------*/
function trim(s)
{
	if(s)
  	return s.replace(/^\s+|\s+$/, '');
}
/*------------------------------------------------------*/
function checkfields()
{
	$("#loginFrm").submit(function()
	{
		//remove all the class add the messagebox classes and start fading
		$("#msgbox").toggleClass('label-warning').html("Checking...").fadeIn(1000);
		//check the username exists or not from ajax
		$.post("dologin.php",{username:$('#loginFrm_username').val(),password:$('#loginFrm_password').val(),
		rand:Math.random()} 

,function(data)
        {
			//alert(data);
			if(trim(data)=='yes') //if correct login detail
			{
		  	$("#msgbox").fadeTo(200,0.1,function()  //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).removeClass('label-warning').addClass('label-success').html("Please wait...").fadeTo(1200,1,
              function()
			  { 
			  	 //redirect to secure page
				 window.location='home.php';
			  });
			  
			});
		  }
		  else 
		  {
		  	 $("#msgbox").fadeTo(200,0.1,function() //start fading the messagebox
			{ 
			  //add message and change the class of the box and start fading
			  $(this).removeClass('label-warning').addClass("label-danger").html(data).fadeTo(1200,1);
			});		
          }
				
        });
 		return false; //not to post the  form physically
	});
	//now call the ajax also focus move from 
	$("#password").blur(function()
	{
		$("#login_form").trigger('submit');
	});	
}
function forgetpassword(){
	emailid=$("#emailid").val();
	if(emailid){
	$.ajax({
	url: "../server/userserver.php",       
	type: "POST",
	data: "action=ForgetPassword&usermailid="+encodeURIComponent(emailid)+"&alias="+encodeURIComponent($('#alias').val()),
	cache: false,         
	success: function (response) { 
		if(response==1){
			$('#forgetpassword').css("display","none");
			$('#forgetpasswordrelogin').css("display","");
			$("#successmsgbox").addClass("label-success").html("A new password has been sent to your e-mail address").fadeTo(1200,1);
		}
		else{
			
				$("#msgbox").addClass("label-danger").html(response).fadeTo(1200,1);
				setTimeout(function(){ $("#msgbox").toggleClass("label-danger").html('').fadeIn(1200,1); }, 4000);
		}
	
		}
	});
	}
	else{
		$("#msgbox").addClass("label-danger").html("Invalid Email Id").fadeTo(1200,1);
		setTimeout(function(){ $("#msgbox").toggleClass("label-danger").html('').fadeIn(1200,1); }, 4000);
	}
}
/*------------------------------------------------------------*/
function pressadminloginOnEnter(e) {
if (!e) var e = window.event;
if (e.keyCode) code = e.keyCode;
else if (e.which) code = e.which;

if (code==13) {
checkfields();
}
}
/*------------------------------------------------------------*/
function getpagecontent(urllocator){
	$.ajax({
	url: urllocator,       
	type: "POST",
	cache: false,         
	success: function (response) { 
	$('#login-content').html(response);
	response='';
	}
	});
}

