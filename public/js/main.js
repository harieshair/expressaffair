/*price range*/

$('#sl2').slider();

var RGBChange = function() {
	$('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
};
function getcatalogname(){	
	req={};
	req.mastername="State";
	var postdata=JSON.stringify(req);
	
	oncallservice(postdata,"http://develop.expressaffair.com/affairservice/getCatalogsByMaterName",function(){getcontentresponse()});
}

/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
	    });
	});
});


function getservicevendors(serviceid,responsearea){
	showPageLoader();
	var POSTDATA='serviceid='+encodeURIComponent(serviceid);
	if(locationId!=0)
		POSTDATA+="&locationid="+encodeURIComponent(locationId);
	oncallservice(POSTDATA,'events/itemlist.php',function(){getpubliccontentresponse(responsearea)});
}
function getpubliccontentresponse(responsearea){
	$('#'+responsearea).html(ajaxResponse);
			hidePageLoader();
			$('.nvtooltip').remove();	
}

function callRestService(serviceName,postdata,callback){
	oncallservice(postdata,"http://localhost/expressaffair/affairservice/"+serviceName,function(){callback()});
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
		if(ajaxResponse==1){
			window.location="home";
		}
		else
			alert("please specify valid credentials");
	});
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
function savecustomersignupdetails(serviceurl,formid){
	signupdetails = $("#"+formid).serialize();
	var POSTDATA="action=savecustomer&signupdetails="+encodeURIComponent(signupdetails);
	oncallservice(POSTDATA,serviceurl,function(){
		if(ajaxResponse==1){
			window.location="../";
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