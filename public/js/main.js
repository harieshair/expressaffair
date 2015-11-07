
var RGBChange = function() {
	$('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
};
function getcatalogname(){	
	req={};
	req.mastername="State";
	var postdata=JSON.stringify(req);
	
	oncallservice(postdata,"http://develop.expressaffair.com/affairservice/getCatalogsByMaterName",function(){getcontentresponse()});
}

function getservicevendors(serviceid){
	pendingactions.s=serviceid;
	$('#event-search-object').html(getFilterString());
	POSTDATA=JSON.stringify(pendingactions);
	calljsonservicebyajax(POSTDATA,"../service/searchservice.php",fillsearcheditems);	
}
function getpubliccontentresponse(responsearea){
	$('#'+responsearea).html(ajaxResponse);
	hidePageLoader();
	$('.nvtooltip').remove();	
}

function callRestService(serviceName,postdata,callback){
	oncallservice(postdata,"http://localhost/expressaffair/affairservice/"+serviceName,function(){callback()});
}

function completepopuppendingactions(){
	if(!pendingactions.ef && !pendingactions.et){
		notifyDanger("Hey, you missed event date");
		return false;
	}
	if(IsBooking)
		bookitemonmyaccount();
	else
		additemtocart();
}

function getmodalresponse(){
	$('#affair-modal-body').html(ajaxResponse);
	showaffairmodal("large");
}

function showaffairmodal(size){
	if(size=="small"){
		$('#affair-modal-dialog').addClass("modal-sm");
	}
	else if(size=="large"){
		$('#affair-modal-dialog').addClass("modal-lg");
	}
	$('#affair-modal').modal("show");	 
}
function hideaffairmodal(){
	$('#affair-modal').modal("hide");	 
}

function oncallservice(POSTDATA,serverurl,callbackfunction){
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
	return false;
}
function callservicebyajax(POSTDATA,serverurl,callbackfunction){
	//showPageLoader();
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
			//hidePageLoader();
		}
	});
	return false;
}
function calljsonservicebyajax(POSTDATA,serverurl,callbackfunction){
	showPageLoader();
	$.ajax({
		url: serverurl,       
		type: "POST",
		data: POSTDATA, 
		cache: false,  
		dataType: "json",
		async: true,       
		success: function (data, status) { 
			ajaxResponse=data;			
			callbackfunction();
			ajaxResponse='';
			hidePageLoader();
		},
		error: function (data, status, e)
		{
			notifyDanger(e);
		}
	});
	return false;
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

function getmodalcontents(urllocator,postdata,callback){
	var POSTDATA='';
	if(postdata)
		POSTDATA+="postvalue="+encodeURIComponent(postdata);
	callservicebyajax(POSTDATA,urllocator,callback);
}

function getcontentresponse(responsearea){
	$('#'+responsearea).html(ajaxResponse);
	$('.nvtooltip').remove();
}
function appendpartialcontentresponse(beforelementclass){
	$(ajaxResponse).insertBefore('.'+beforelementclass);	
}


function getCheckBoxValueIsideContainer(checkboxid){
	var checkedvalues = $("#"+checkboxid+" input:checkbox:checked").map(function(){
		return $(this).val();
	}).toArray();
	return checkedvalues;	
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
	$.bootstrapGrowl(message,{type:'success',align: 'center'});                    
}
function notifyInfo(message){
	$.bootstrapGrowl(message,{type: 'info',align: 'center'});                    
}
function notifyDanger(message){
	$.bootstrapGrowl(message,{type: 'danger',align: 'center'});                    
}

function removefilefromattachment(filename,hiddenfieldname)
{
	$("#view_"+filename).remove();
	$("#remove_"+filename).remove();
	var files=$('#'+hiddenfieldname).val();
	files=files.split(',');
	var index = files.indexOf(filename);
	if (index > -1) {
		files.splice(index, 1);
		$('#'+hiddenfieldname).val(files.join(','));
	}
}
function stringReplace(variable,searchstring,replacestring){
	return variable.replace(searchstring, replacestring);
}

/*--------------------------------------------------------------------------------------------*/
function uploadfiles(elementid)
{
	if($("#file_name_"+elementid).val()!="" && $("#file_name_"+elementid).val()!=undefined)
	{
		var isfilereplace=confirm("file is already exists,Do you want to replace.?");
		if(!isfilereplace)
			return;
	}
	if($('#attachment_'.elementid).val()!='')
	{
		type= $("#file_type_"+elementid).val();
		fileElementId="attachment_"+elementid;
		file='service/accessories/attachments.php?filetype='+type+'&elementId=attachment_'+elementid;

		$("#loading")
		.ajaxStart(function(){
			$(this).show();
		})
		.ajaxComplete(function(){
			$(this).hide();
		});
		$.ajaxFileUpload
		(	{
			url:file,
			secureuri:true,
			fileElementId:fileElementId,
			dataType: 'json',
			success: function (data, status)
			{
				var result=jQuery.parseJSON(data);
				if(!result.Exception || result.Exception=="")
				{					
					notifySuccess("Attached Successfully");
					$('#file_name_'+elementid).val(result.newfilename);
					var div = $("#divexistingfile_"+elementid);
					$("<a/>").css({"cursor":"pointer","color":"#0000CC"}).html(result.filename).attr({"href":"../downloadfiles.php?filelocation=../uploadfiles/"+result.newfilename,"Title":"Download","target":"_blank"}).appendTo(div);				
				}
				else
					notifyDanger(result.Exception);						 
			},
			error: function (data, status, e)
			{
				notifyDanger(e);
			}
		}	)
	}
	else
		{ notifyDanger("Please Upload files");  }
	return false;
}
function uploadmultiplefiles()
{
	if($("#file_name").val()!="" && $("#file_name").val()!=undefined)
	{
		var isfilereplace=confirm("file is already exists,Do you want to replace.?");
		if(!isfilereplace)
			return;
	}
	if($('#attachment').val()!='')
	{
		type= $("#file_type").val();
		fileElementId="attachment";
		file='service/accessories/multi_attachments.php?filetype='+type+'&elementId=attachment';

		$("#loading")
		.ajaxStart(function(){
			$(this).show();
		})
		.ajaxComplete(function(){
			$(this).hide();
		});
		$.ajaxFileUpload
		(	{
			url:file,
			secureuri:true,
			fileElementId:fileElementId,
			dataType: 'json',
			success: function (data, status)
			{
				var result=jQuery.parseJSON(data);
				if(!result.Exception || result.Exception=="")
				{			
					var files=[];	
					var div = $("#divexistingfile");	
					$.each(result, function (key, value) {
						if(key!="Exception"){
							files.push(value);
							$("<a/>").css({"cursor":"pointer","color":"#0000CC"}).html(key).attr({"href":"../downloadfiles.php?filelocation=../uploadfiles/"+key,"Title":"Download","target":"_blank"}).appendTo(div);				
						}

					});

					$('#file_name').val(files.join(','));

					notifySuccess("Attached Successfully");
				}
				else
					notifyDanger(result.Exception);						 
			},
			error: function (data, status, e)
			{
				notifyDanger(e);
			}
		});
	}
	else
		{ notifyDanger("Please Upload files");  }
	return false;
}
function changenavstatus(navbarid,selectedtab)
{
	$('#'+navbarid).each(function(){
		$(this).find('li').each(function(){
			$(this).removeClass("active");
		});
		$(this).find('li').each(function(){
			if($(this).attr('id')==selectedtab){
				$(this).addClass("active");
			}
		});
	});
}
function trim(s)
{	return $.trim(s);	
}
function jsonToQueryString(json) {
	return '?' + 
	Object.keys(json).map(function(key) {
		return encodeURIComponent(key) + '=' +
		encodeURIComponent(json[key]);
	}).join('&');
}
function javascriptObjectToQueryString( obj ) {
	return '?'+Object.keys(obj).reduce(function(a,k){a.push(k+'='+encodeURIComponent(obj[k]));return a},[]).join('&');
}
function getGeoLocationCityName(){
	$.get("http://ipinfo.io", function (response) {
		if(response){
			city=response.city; 
			if(city){ 
				$("#locationId").find("option:contains("+city+")").each(function(){
					if( $(this).text() == city ) {
						$(this).attr("selected","selected");
					}
				});
				
			}
		}  
	}, "jsonp");
}