

var eventServices=[];
function selectEventServices()
{
	selectedservice=$('#btn_selectservice').attr('selectedservice');
	if(eventServices.length>0){
		eventServiceresponse(selectedservice);
	}
	else{
		var POSTDATA="action=getAllCatalogValues&masterName="+encodeURIComponent("Services");
		callservicebyajax(POSTDATA,"service/config/catalogserver.php",function(){eventServiceresponse(selectedservice)});
	}
}
function  eventServiceresponse(selectedservice){
	var selectedarray = selectedservice.split(",");
	if(ajaxResponse){
		eventServices=JSON.parse(ajaxResponse);
		ajaxResponse="";
	}	
	len=eventServices.length;
	msgBody="<div class='box box-success'><div class='box-header'><h3 class='box-title'>Event Services</h3></div><div class='box-body'>";
	for (var i = 0; i < len; i++){	
		msgBody+="<div class='form-group'><label><input type='checkbox' name='chk_eventservice' class='minimal' servicename='"+eventServices[i].catalog_value+"' value='"+eventServices[i].id+"'";
		if($.inArray(eventServices[i].id, selectedarray) > -1)
			msgBody+=" checked "	;
		msgBody+=" />"+eventServices[i].catalog_value+"</label></div>";       
	}
	msgBody+="</div></div>";
	$('#ModalWindowBody').html(msgBody);
	$('#ModalWindowFooter').html('<a href="javascript:void(0);" onclick="applyselectedservices();" data-dismiss="modal"  class="btn btn-primary">Apply</a>');	
	showmodalwindow();
}
function applyselectedservices(){
	var serviceArray=[];
	var serviceArrayName=[];
	$("input[name='chk_eventservice']").each(function() {
		if($(this).is(":checked")){
			serviceArray.push($(this).val());
			serviceArrayName.push($(this).attr("servicename"));
		}
	});
	$('#btn_selectservice').attr('selectedservice',serviceArray.toString());
	$('label[id=selectedservices]').html(serviceArrayName.toString());
	closemodalwindow();
}