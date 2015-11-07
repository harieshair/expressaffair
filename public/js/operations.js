function addtomycart(vserviceid){
	if(validateitemtosave(vserviceid))
		additemtocart();
}
function bookthisitem(vserviceid){
	IsBooking=true;
	if(validateitemtosave(vserviceid))
		bookitemonmyaccount();
}	
function validateitemtosave(vserviceid){
	pendingactions.vsi=vserviceid;
	if(pendingactions.ef =="" && pendingactions.et==""){
		notifyDanger("Hey, Tell us your event date"); 
		return false;
	}
	if(pendingactions.l==0 || pendingactions.l==""){
		notifyDanger("Hey, Tell us your event location"); 
		return false;
	}
	if(!pendingactions.c || pendingactions.c==0){
		IsPopUpSignUp=true;
		getmodalcontents("loginorsignup.php","",getmodalresponse);
		return false;
	}
	return true;

}

function additemtocart(){
	POSTDATA="action=aditemtocart&itemdata="+encodeURIComponent(JSON.stringify(pendingactions));
	oncallservice(POSTDATA,"../service/cartserver.php",function(){
		if(ajaxResponse>0){
			notifySuccess("Item added to shortlisted list");           
		}
		else
			notifyDanger("Try after some time");  
	});
}
function bookitemonmyaccount(){
	POSTDATA="action=bookthisitem&itemdata="+encodeURIComponent(JSON.stringify(pendingactions));
	oncallservice(POSTDATA,"../service/cartserver.php",function(){
		if(ajaxResponse>0){
			notifySuccess("Item added to shortlisted list");           
		}
		else
			notifyDanger("Try after some time");  
	});
}

function searchonsliderchange(){
	var range = pricerangeslider.slider('getValue');
	if(range!=0 &&(pendingactions.prm!=range[0] || pendingactions.prmax!=range[1])){
		pendingactions.prm=range[0] ;pendingactions.prmax=range[1];
		refinesearch();
	}
}
function enabledisablelookinthisrange(obj){
	if(obj.checked){
		$("#pricerange").slider("enable");
		searchonsliderchange()
	}
	else{
		$("#pricerange").slider("disable");
		if((pendingactions.prm!=0 || pendingactions.prmax!=0)){
			pendingactions.prm=0;pendingactions.prmax=0;
			refinesearch();
		}
	}
}

function refinesearchonclick(){
	pendingactions.ef=$('#eventdatefrom').val();
	pendingactions.et=$('#eventdateto').val();
	pendingactions.l=$('#locationid').val();
	refinesearch();
}
function refinesearch(){	
	pendingactions.pac=getCheckBoxValueIsideContainer('package-list');
	/*$('#event-search-object').html(getFilterString());*/
	POSTDATA=JSON.stringify(pendingactions);
	calljsonservicebyajax(POSTDATA,"../service/searchservice.php",fillsearcheditems);	
}




function savecustomersignupdetails(serviceurl,formid,callbackfn){
	signupdetails = $("#"+formid).serialize();
	var POSTDATA="action=savecustomer&signupdetails="+encodeURIComponent(signupdetails);

	oncallservice(POSTDATA,serviceurl,function(){
		if(ajaxResponse>0){
			pendingactions.c=trim(ajaxResponse);
			if(IsPopUpSignUp){
				getcontents("default/myprofile.php" ,"myprofile-content");
				hideaffairmodal();
				completepopuppendingactions();
			}
			else if(callbackfn && $("#"+formid+" #entity_id").length>0)
				callbackfn();
			else
				window.location="home";
		}
	});
}

function changeLocationResponse(){
	if(ajaxResponse){
		var div='<div class="row"><label>Location</label><select id="eventlocation" name="eventlocation" >';				
		var catalogValues=JSON.parse(ajaxResponse);
		$.each(result, function (key, value) {
			div+='<option value="'+value.id+'">'+value.catalog_value+'</option>';
		});
		div+='</select></div>';
		ajaxResponse={};
		ajaxResponse.Body=div;
		showmodalwindow();
	}
}
function isemailexisits(value){	
	if(!value)
		return;
	var POSTDATA='action=isemailavailable&username='+encodeURIComponent(value);
	oncallservice(POSTDATA,'../service/customerserver.php',function(){
		if(ajaxResponse==0){
			$("#signup_form").find("input").each(function() {
				$(this).attr("disabled",false)
			});
			$("#signup_form").find("textarea").each(function() {
				$(this).attr("disabled",false)
			});
			$("#signup_form").find("select").each(function() {
				$(this).attr("disabled",false)
			});
			$("#signup_form").find("a").each(function() {
				$(this).attr("disabled",false)
			});
		}	
	});
}
function changeLocation(serviceName,catalogName){
	req={};
	req.mastername=catalogName;
	var postdata=JSON.stringify(req);
	callRestService(serviceName,postdata,changeLocationResponse);
}
function getintoaccount(serviceurl,formid){
	var logindetails = $("#"+formid).serialize();
	var POSTDATA="action=getintoaccount&logindetails="+encodeURIComponent(logindetails);
	oncallservice(POSTDATA,serviceurl,function(){
		if(ajaxResponse>0){
			pendingactions.c=trim(ajaxResponse);
			if(IsPopUpSignUp){
				getcontents("default/myprofile.php" ,"myprofile-content");
				hideaffairmodal();
				completepopuppendingactions();
			}
			else
				window.location="home";
		}
		else
			alert("please specify valid credentials");
	});
}

function getFilterString()
{
	var filterString="";
	if(pendingactions.e)
		filterString+="<span> What: </span>"+	$("#eventDD option:selected").text();
	if(pendingactions.l)
		filterString+="<span>   Where: </span> "+	$("#locationid option:selected").text();
	if(pendingactions.ef)
		filterString+="<span>   From: </span>"+	$('#eventdatefrom').val();
	if(pendingactions.et)
		filterString+="<span>   To: </span>"+$('#eventdateto').val();
	return filterString;
}
function redirecttonewevent(sel) {
	if(sel.value && sel.value!=0)
		window.location="events="+sel.value;
}
function switchtoritualdata(ritualid){
	pendingactions.r=ritualid;
	window.location="rituals="+javascriptObjectToQueryString(pendingactions);
}