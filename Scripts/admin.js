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
	var POSTDATA='';
	if(postdata)
		POSTDATA+="postvalue="+encodeURIComponent(postdata);
	callservicebyajax(POSTDATA,urllocator,function(){getcontentresponse(responsearea)});
}
function appendpartialcontents(urllocator,beforelementclass,postdata)
{
	var POSTDATA='';
	if(postdata)
		POSTDATA+="postvalue="+encodeURIComponent(postdata);
	callservicebyajax(POSTDATA,urllocator,function(){appendpartialcontentresponse(beforelementclass)});
}
function getwizardcontents(urllocator,responsearea,postdata){
	var POSTDATA="";
	if(postdata && postdata>0)
		POSTDATA="postvalue="+encodeURIComponent(postdata);
	else if($('#entityid').val() && $('#entityid').val()!=0)
		POSTDATA="postvalue="+encodeURIComponent($('#entityid').val());
	if(POSTDATA!="")
		callservicebyajax(POSTDATA,urllocator,function(){getcontentresponse(responsearea)});
}

function getmodalcontents(urllocator,postdata){
	var POSTDATA='';
	if(postdata)
		POSTDATA+="postvalue="+encodeURIComponent(postdata);
	callservicebyajax(POSTDATA,urllocator,function(){getmodalcontentresponse()});
}

function getcontentresponse(responsearea){
	$('#'+responsearea).html(ajaxResponse);
	$('.nvtooltip').remove();
}
function appendpartialcontentresponse(beforelementclass){
	$(ajaxResponse).insertBefore('.'+beforelementclass);	
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

function getCheckBoxValueIsideContainer(checkboxid){
	var eventids = $("#"+checkboxid+" input:checkbox:checked").map(function(){
		return $(this).val();
	}).toArray();
	return eventids;	
}

function selectAllCheckboxchilds(parentname,childname){
	if($('input:checkbox[name='+parentname+']').is(':checked'))
		$('input:checkbox[name='+childname+']').prop('checked',true);	
	else 
		$('input:checkbox[name='+childname+']').prop('checked',false);	
}
function resetform(formid){
	$('#'+formid)[0].reset();
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
function wizardnext(nextwizardurl,isNew,appenddataurl){
	var response = JSON.parse(ajaxResponse);
	if(response){
		if(response.Exception){
			notifyDanger(response.Exception);
		}
		else{
			notifySuccess(response.Message);
			if(nextwizardurl && nextwizardurl!="")
				getwizardcontents(nextwizardurl,'wizardcontent',response.Id)		
			else if(isNew)
				appendnewli(response.Id,appenddataurl);
			else		
				hideeditli(response.Id,appenddataurl);


		}
	}
}
function hideeditli(listid,appenddataurl){
	$('#'+listid+'-edit').css("display","none");
	$('#'+listid+'-non-edit').css("display","block"); 
	getcontents(appenddataurl,listid+"-non-edit",listid);       
}
function appendnewli(listid,appenddataurl){
	appendpartialcontents(appenddataurl,"li-new",listid);
	$('.li-new').css("display","none");
	resetform('new-form');
}

function savemodalwindowresponse(callbackmethod){
	var response = JSON.parse(ajaxResponse);
	if(response){
		if(response.Exception){
			notifyDanger(response.Exception)	;
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

function removefilefromattachment(divid,inputid)
{
	$("#"+divid).html("");
	$("#"+inputid).val("");
}

/*--------------------------------------------------------------------------------------------*/
function uploadfiles(elementid)
{
	if($("#oldattachment_"+elementid).val()!="" && $("#oldattachment_"+elementid).val()!=undefined)
	{
		var isfilereplace=confirm("file is already exists,Do you want to replace.?");
		if(!isfilereplace)
			return;
	}
	if($('#attachment_'.elementid).val()!='')
		{
			type= $("#attachmenttype_"+elementid).val();
			fileElementId="attachmenttype_"+elementid;
			file='service/accessories/attachments.php?filetype='+type+'&elementId=attachment_'+elementid;

			$("#loading")
			.ajaxStart(function(){
			$(this).show();
			})
			.ajaxComplete(function(){
			$(this).hide();
			});
			$.ajaxFileUpload
			(
				{
				url:file,
				secureuri:true,
				fileElementId:fileElementId,
				dataType: 'json',
				success: function (data, status)
				{
					if(data!=0)
					 {
						alert("Attached Successfully");
						$('#'+resopnsefield).val(data);
						var div = $("<div>");
						$("<a/>").css({"cursor":"pointer","color":"#0000CC"}).html(data).appendTo(div);
						$("<a/>").css("cursor","pointer").attr({"onClick":"removefilefromattachment('"+divid+"','"+resopnsefield+"')","Title":"Remove file"})
						.addClass("glyphicon glyphicon-remove").appendTo(div);
						$("#"+divid).html(div);
					  }
					  else{
					  if(type == 'htm')
							notifyDanger("Error.. Upload format is .html/.htm/.php (Max 1 MB)");
						if(type == 'image')
							notifyDanger("Error.. Upload format is .jpg/ .png/ .gif/ .bmp/ .jpeg/ (Max 10 MB)");
						else if(type == 'css')
							notifyDanger("Error.. Upload format is .css file (Max 50KB)");
						else if(type == 'js')
							 notifyDanger("Error.. Upload format is .js file (Max 50KB)");
					 else if(type == 'excel')
							 notifyDanger("Error.. Upload format is .xls/.xlsx/.csv file (Max 3 MB)");

						}
					},
					error: function (data, status, e)
					{
						notifyDanger(e);
					}
				}
			)
		}
		else
		{ notifyDanger("Please Upload files");  }
		return false;
}
