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
/*------------------------------------------------------------------------*/
function saverole(){
	var rolename=$('#rolename').val();
	if(!rolename || rolename=='' || rolename.length<=1){
		notifyDanger('Please specify rolename')	;
	}
	else{

		var POSTDATA="action=saverole&rolename="+encodeURIComponent(rolename);
		callservicebyajax(POSTDATA,"service/config/roleserver.php",function(){savedataresponse(refreshRoleGrid)});
	}
}

function refreshRoleGrid(){	
	getcontents('pages/configs/roles/role.php','content');
}
function refreshEventGrid(){	
	getcontents('pages/events/eventlists.php','content');
}
function refreshCommunityGrid(){	
	getcontents('pages/events/communities.php','content');
}
function saveuserform()
{
	userDetails = $("#update-userform").serialize();
	var POSTDATA="action=saveuser&userdetails="+encodeURIComponent(userDetails);
	callservicebyajax(POSTDATA,"service/config/userserver.php",function(){savedataresponse()});
}
function saveeventdetails(){
	eventdetails = $("#update-eventdetails").serialize();
	var POSTDATA="action=saveevents&eventdetails="+encodeURIComponent(eventdetails);
	callservicebyajax(POSTDATA,"service/event/eventserver.php",function(){savedataresponse(refreshEventGrid)});	
}
function savecommunitydetails(){	
	selectedevents=getCheckBoxValueIsideContainer('eventtablebody');
	communitydetails = $("#update-communitydetails").serialize();
	var POSTDATA="action=savecommunity&communitydetails="+encodeURIComponent(communitydetails)+"&eventids="+encodeURIComponent(selectedevents);
	callservicebyajax(POSTDATA,"service/community/communityserver.php",function(){savedataresponse(refreshCommunityGrid)});	
}
function savevendorbasicdetails(nexturl){
	vendordetails = $("#update-vendorbasics").serialize();
	var POSTDATA="action=savevendorbasics&vendordetails="+encodeURIComponent(vendordetails);
	callservicebyajax(POSTDATA,"service/vendor/vendorserver.php",function(){wizardnext(nexturl)});	
}
function savevendorcontactdetails(contactid,IsNew,nextwizardurl,appendurl){
	contactdetails = $("#"+contactid+"-form").serialize();
	var POSTDATA="action=savevendorcontacts&contactdetails="+encodeURIComponent(contactdetails);
	callservicebyajax(POSTDATA,"service/vendor/vendorserver.php",function(){wizardnext(nextwizardurl,IsNew,appendurl)});	
}
function savevendorportfoliodetails(portfolioid,IsNew,nextwizardurl,appendurl){
	portfoliodetails = $("#"+portfolioid+"-form").serialize();
	var POSTDATA="action=savevendorportfolios&portfoliodetails="+encodeURIComponent(portfoliodetails);
	callservicebyajax(POSTDATA,"service/vendor/vendorserver.php",function(){wizardnext(nextwizardurl,IsNew,appendurl)});	
}
function savevendorservices(serviceid,IsNew,nextwizardurl,appendurl){
	servicedetails = $("#"+serviceid+"-form").serialize();
	var POSTDATA="action=savevendorservices&servicedetails="+encodeURIComponent(servicedetails);
	callservicebyajax(POSTDATA,"service/vendor/vendorserver.php",function(){wizardnext(nextwizardurl,IsNew,appendurl)});	
}
function savevendorattachments(attachmentid,IsNew,appendurl){
	attachmentdetails = $("#"+attachmentid+"-form").serialize();
	var POSTDATA="action=savevendorattachments&attachmentdetails="+encodeURIComponent(attachmentdetails);
	callservicebyajax(POSTDATA,"service/vendor/vendorserver.php",function(){wizardnext("",IsNew,appendurl)});	
}

