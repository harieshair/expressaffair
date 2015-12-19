function saverole(){
	var rolename=$('#rolename').val();
	if(!rolename || rolename=='' || rolename.length<=1){
		notifyDanger('Please specify rolename')	;
	}
	else{

		var POSTDATA="action=saverole&rolename="+encodeURIComponent(rolename);
		callservicebyajax(POSTDATA,"../service/roleserver.php",function(){savedataresponse(refreshRoleGrid)});
	}
}

function refreshRoleGrid(){	
	getcontents('pages/configs/roles/role.php','content');
}
function refreshEventGrid(){	
	getcontents('pages/events/eventlists.php','content');
}
function refreshRitualGrid(){	
	getcontents('pages/events/rituals.php','content');
}
function refreshCommunityGrid(){	
	getcontents('pages/events/communities.php','content');
}
function saveuserform()
{
	userDetails = $("#update-userform").serialize();
	var POSTDATA="action=saveuser&userdetails="+encodeURIComponent(userDetails);
	callservicebyajax(POSTDATA,"../service/userserver.php",function(){savedataresponse()});
}
function saveeventdetails(){
	eventdetails = $("#update-eventdetails").serialize();
	selectedritual=getCheckBoxValueIsideContainer('ritualtablebody');
	selectedservice=getCheckBoxValueIsideContainer('servicetablebody');
	var POSTDATA="action=saveevents&eventdetails="+encodeURIComponent(eventdetails)+"&ritualids="+encodeURIComponent(selectedritual)+"&serviceids="+encodeURIComponent(selectedservice);
	callservicebyajax(POSTDATA,"../service/eventserver.php",function(){savedataresponse(refreshEventGrid)});	
}
function savecommunitydetails(){	
	selectedevents=getCheckBoxValueIsideContainer('eventtablebody');
	communitydetails = $("#update-communitydetails").serialize();
	var POSTDATA="action=savecommunity&communitydetails="+encodeURIComponent(communitydetails)+"&eventids="+encodeURIComponent(selectedevents);
	callservicebyajax(POSTDATA,"../service/communityserver.php",function(){savedataresponse(refreshCommunityGrid)});	
}
function saveRitualDetails(){
	ritualdetails = $("#update-ritualdetails").serialize();
	selectedservice=getCheckBoxValueIsideContainer('servicetablebody');
	var POSTDATA="action=saveritual&ritualdetails="+encodeURIComponent(ritualdetails)+"&serviceids="+encodeURIComponent(selectedservice);
	callservicebyajax(POSTDATA,"../service/ritualserver.php",function(){savedataresponse(refreshRitualGrid)});	
}
function savevendorbasicdetails(nexturl){
	vendordetails = $("#update-vendorbasics").serialize();
	var POSTDATA="action=savevendorbasics&vendordetails="+encodeURIComponent(vendordetails);
	callservicebyajax(POSTDATA,"../service/vendorserver.php",function(){wizardnext(nexturl)});	
}
function savevendorcontactdetails(contactid,IsNew,nextwizardurl,appendurl){
	contactdetails = $("#"+contactid+"-form").serialize();
	var POSTDATA="action=savevendorcontacts&contactdetails="+encodeURIComponent(contactdetails);
	callservicebyajax(POSTDATA,"../service/vendorserver.php",function(){wizardnext(nextwizardurl,IsNew,appendurl)});	
}
function savevendorportfoliodetails(portfolioid,IsNew,nextwizardurl,appendurl){
	portfoliodetails = $("#"+portfolioid+"-form").serialize();
	var POSTDATA="action=savevendorportfolios&portfoliodetails="+encodeURIComponent(portfoliodetails);
	callservicebyajax(POSTDATA,"../service/vendorserver.php",function(){wizardnext(nextwizardurl,IsNew,appendurl)});	
}
function savevendorservices(serviceid,IsNew,nextwizardurl,appendurl){
	servicedetails = $("#"+serviceid+"-form").serialize();
	var POSTDATA="action=savevendorservices&servicedetails="+encodeURIComponent(servicedetails);
	callservicebyajax(POSTDATA,"../service/vendorserver.php",function(){wizardnext(nextwizardurl,IsNew,appendurl)});	
}
function savevendorattachments(attachmentid,IsNew,appendurl){
	attachmentdetails = $("#"+attachmentid+"-form").serialize();
	var POSTDATA="action=savevendorattachments&attachmentdetails="+encodeURIComponent(attachmentdetails);
	callservicebyajax(POSTDATA,"../service/vendorserver.php",function(){wizardnext("",IsNew,appendurl)});	
}

