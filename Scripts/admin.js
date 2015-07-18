// JavaScript Document
/*-------------------------------------------------------------------------------------------------*/
function callservicebyajax(POSTDATA,serverurl,callbackfunction){
	$.ajax({
	url: serverurl,       
	type: "POST",
	data: POSTDATA, 
	cache: false,         
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


var addedsizebrief=[];
var removesizederbrief=[];
var sdid=0;
function addsizebriefs(){
	var itemsize=$("#dd_size").val();
	var itemcolor=$("#dd_color").val();
	var pieces=$('#pieces').val();	
	if(itemsize && itemcolor && pieces) 
	{
		dummy=++sdid;
		obj={};
		obj.itemsize=itemsize;  
		obj.itemcolor=itemcolor;
		obj.pieces= $.trim(pieces); //persistent data
		obj.trid="dummyid_"+dummy; // required to delete tr on client add
		addedsizebrief.push(obj);
		$('#sizebriefs tbody').append('<tr id="dummyid_'+ dummy +'" size="'+itemsize+'"><td><td>'+itemsize+'</td><td>'+itemcolor+'</td><td>'+$.trim(pieces)+'</td><td><a href="#" onclick=removesizebriefvalue("dummyid_'+dummy+'"); class="btn btn-sm btn-default-inverse"><i class="glyphicon  glyphicon-remove-sign white"></i>Delete</a></td></tr>');   			
		$('#pieces').html('');		
		
	}
	else{
		$("#response_div").removeClass("label-success").addClass("label-danger").html("Please specify valid size");
		setTimeout(function(){$("#response_div").html("");},4000);
	}
}
/*------------------------------------------------------------------------*/
function removesizebriefvalue(trid){
	orderbriefid=$("#"+trid).attr("orderbriefid")
	if(orderbriefid)
		removeorderbrief.push(orderbriefid);
	else{
		Cleanunsaveditem(trid,"trid");
	}
	$("#"+trid).remove();
}


var addedyarnrief=[];
var removeyarnbrief=[];
var ydid=0;
function addyarnbriefs(){
	var itemcolor=$("#dd_color").val();
	var itemcount=$("#yarncount").val();
	var kgs=$('#yarnkgs').val();	
	if(kgs && itemcount && itemcolor) 
	{
		dummy=++ydid;
		obj={};
		obj.itemcount=itemcount;  
		obj.itemcolor=itemcolor;
		obj.kgs= $.trim(kgs); //persistent data
		obj.trid="dummyid_"+dummy; // required to delete tr on client add
		addedyarnrief.push(obj);
		$('#yarnrbriefs tbody').append('<tr id="dummyid_'+ dummy +'" count="'+itemcount+'"><td><td>'+itemcount+'</td><td>'+itemcolor+'</td><td>'+$.trim(kgs)+'</td><td><a href="#" onclick=removeyarnbriefvalue("dummyid_'+dummy+'"); class="btn btn-sm btn-default-inverse"><i class="glyphicon  glyphicon-remove-sign white"></i>Delete</a></td></tr>');   			
		$('#pieces').html('');		
		
	}
	else{
		$("#response_div").removeClass("label-success").addClass("label-danger").html("Please specify valid size");
		setTimeout(function(){$("#response_div").html("");},4000);
	}
}
/*------------------------------------------------------------------------*/
function removeyarnbriefvalue(trid){
	orderbriefid=$("#"+trid).attr("orderbriefid")
	if(orderbriefid)
		removeorderbrief.push(orderbriefid);
	else{
		Cleanunsaveditem(trid,"trid");
	}
	$("#"+trid).remove();
}
/*------------------------------------------------------------------------*/
function Cleanunsaveditem(value,property) {
	len = addedorderbrief.length;
    for (var i = 0; i < len; i++){
        if (addedorderbrief[i][property] === value) {
			addedorderbrief.splice(i,1);
			return
		}
	}
}