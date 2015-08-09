// JavaScript Document
/*-------------------------------------------------------------------------------------------------*/
function callservicebyajax(POSTDATA,serverurl,callbackfunction){
	$.ajax({
		url: serverurl,       
		type: "POST",
		data: POSTDATA, 
		cache: false,  
		async: true,       
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

function getmodalcontents(urllocator,postdata){
var POSTDATA=''//"alias="+encodeURIComponent(ClientAlias);
if(postdata)
	POSTDATA+="postvalue="+encodeURIComponent(postdata);
callservicebyajax(POSTDATA,urllocator,function(){getmodalcontentresponse()});
}

function getcontentresponse(responsearea){
	$('#'+responsearea).html(ajaxResponse);
	$('.nvtooltip').remove();
}

function getmodalcontentresponse(){
	$('#MicroModalwindow').html(ajaxResponse);	
	$('#MicroModalwindow').attr('class', 'modal fade bs-example-modal-lg').attr('aria-labelledby','myModalLabel');
	$('.modal-dialog').attr('class','modal-dialog  modal-lg');
	$('#MicroModalwindow').modal('show');
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
	$('#MicroModalwindow').modal("hide");
}

function getCheckBoxValueIsideContainer(parentid,chkboxname){
	var chkboxvalue=[];
	$("#"+parentid).find("ul").each(function() {
		$("input[name='"+chkboxname+"']").each(function() {
			if($(this).is(":checked")){
				chkboxvalue.push($(this).val());			
			}
		});
	});
	return chkboxvalue;
	
}

function savedataresponse(callbackmethod){
	var response = JSON.parse(ajaxResponse);
	if(response){
		if(response.Exception){
			notifyDanger(response.Exception);
		}
		else{
			notifySuccess(response.Message);
			if(callbackmethod)
				setTimeout(function(){callbackmethod();}, 1000);			
		}
	}
}

function savemodalwindowresponse(callbackmethod){
	var response = JSON.parse(ajaxResponse);
	if(response){
		if(response.Exception){
			dangerAlert(response.Exception)	;
		}
		else{
			closemodalwindow();
			callbackmethod();
		}
	}

}
function notifySuccess(message){
	$.bootstrapGrowl(message,{type:'success'});                    
}
function notifyInfo(message){
	$.bootstrapGrowl(message,{type: 'info'});                    
}
function notifyDanger(message){
	$.bootstrapGrowl(message,{type: 'danger'});                    
}

