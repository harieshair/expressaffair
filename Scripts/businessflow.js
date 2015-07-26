var vendorServices=[];
function selectEventServices()
{
	selectedservice=$('#btn_selectservice').attr('selectedservice');
	if(vendorServices.length>0){
		eventServiceresponse(selectedservice);
	}
	else{
		var POSTDATA="action=getAllCatalogValues&masterName="+encodeURIComponent("Services");
		callservicebyajax(POSTDATA,"d2dservice/catalog/catalogserver.php",function(){eventServiceresponse(selectedservice)});
	}
}
function  eventServiceresponse(selectedservice){
	var selectedarray = selectedservice.split(",");
	vendorServices=JSON.parse(ajaxResponse);
	ajaxResponse="";
	showmodalwindow();
	len=vendorServices.length;
	msgBody='<div class="box box-success"><div class="box-header"><h3 class="box-title">Services</h3></div><div class="box-body">';
	for (var i = 0; i < len; i++){	
			msgBody+='<div class="form-group"><label><input type="checkbox" class="minimal" value="'+vendorServices[i].id;
			if($.inArray(vendorServices[i].id, selectedarray) > -1)
			msgBody+=' checked '	;
		msgBody+=' />'+vendorServices[i].catalog_value+'</label></div>';       
	}
	msgBody+='</div></div>';
	$('#ModalWindowBody').html(msgBody);
	$('#ModalWindowFooter').html('<a href="javascript:void(0);" onclick="applyselectedservices();"  class="btn btn-primary">Apply</a>');	
}
