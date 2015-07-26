// JavaScript Document
/*-------------------------------------------------------------------------------------------------*/
function callservicebyajax(POSTDATA,serverurl,callbackfunction){
	$.ajax({
		url: serverurl,       
		type: "POST",
		data: POSTDATA, 
		cache: false,  
		async: false,       
		success: function (response) { 
			ajaxResponse=response;
			callbackfunction();
			ajaxResponse='';
		}
	});
}
function getcontents(urllocator,responsearea,postdata)
{
	var POSTDATA=''//"alias="+encodeURIComponent(ClientAlias);
	if(postdata)
		POSTDATA+="postvalue="+encodeURIComponent(postdata);
	callservicebyajax(POSTDATA,urllocator,function(){getcontentresponse(responsearea)});
}

function getcontentresponse(responsearea){
	$('#'+responsearea).html(ajaxResponse);
	$('.nvtooltip').remove();
}
function showmodalwindow(){
	if(ajaxResponse){
		var modalWindowData = JSON.parse(ajaxResponse);
		if(modalWindowData.Header) $('#ModalWindowHeader').html(modalWindowData.Header);
		if(modalWindowData.Body) $('#ModalWindowBody').html(modalWindowData.Body);
		if(modalWindowData.Footer) $('#ModalWindowFooter').html(modalWindowData.Footer);
	}
	 $('#MicroModalwindow').attr('class', 'modal fade').attr('aria-labelledby','myModalLabel');
     $('.modal-dialog').attr('class','modal-dialog');
	$('#MicroModalwindow').modal('show');
}
function closemodalwindow(){
	$('#ModalWindowBody').html("");
	$('#ModalWindowFooter').html("");
	$('#ModalWindowHeader').html("");				
	$('#MicroModalwindow').hide("hide.bs.modal");
}


/*------------------------------------------------------------------------*/
function saverole(){
	var rolename=$('#rolename').val();
	if(!rolename || rolename=='' || rolename.length<=1){
		dangerAlert('Please specify rolename')	;
	}
	else{

		var POSTDATA="action=saverole&rolename="+encodeURIComponent(rolename);
		callservicebyajax(POSTDATA,"d2dservice/config/roleserver.php",function(){savedataresponse()});
	}
}


function saveuserform()
{
	userDetails = $("#update-userform").serialize();
			var POSTDATA="action=saveuser&userdetails="+encodeURIComponent(userDetails);
		callservicebyajax(POSTDATA,"d2dservice/config/userserver.php",function(){savedataresponse()});
}


function savedataresponse(){
	var response = JSON.parse(ajaxResponse);
	if(response){
		if(response.Exception){
			dangerAlert(response.Exception)	;
		}
		else{
			successAlert('role created successfully!');
		}
	}
}

function successAlert (message) {
	$("#alert-area").append($("<div class='alert-message success fade in' data-alert><p> " + message + " </p></div>"));
	$(".alert-message").delay(2000).fadeOut("slow", function () { $(this).remove(); });
}
function dangerAlert (message) {
	$("#alert-area").append($("<div class='alert-message danger fade in' data-alert><p> " + message + " </p></div>"));
	$(".alert-message").delay(2000).fadeOut("slow", function () { $(this).remove(); });
}
