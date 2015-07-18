// JavaScript Document
/*------------------------------------------------------------------------*/
function showcataloghierarchical(catalogmasterid){
	var POSTDATA="action=getallcatalogvalues&catalogmasterid="+encodeURIComponent(catalogmasterid);
	callservicebyajax(POSTDATA,"d2dservice/catalog/catalogserver.php",function(){showcataloghierarchicalresponse(catalogmasterid)});

}
/*------------------------------------------------------------------------*/
function showcataloghierarchicalresponse(catalogmasterid){
	$('#catalogvaluestr_'+catalogmasterid).toggle().html(ajaxResponse);
	$('#anchorcataloghierarchical_'+catalogmasterid).toggleClass('glyphicon-plus glyphicon-minus');
	 $("#anchorcataloghierarchical_"+catalogmasterid).attr("onClick","hidecatalogmasterhierarchical("+catalogmasterid+")");
}
/*------------------------------------------------------------------------*/
function hidecatalogmasterhierarchical(catalogmasterid)
{
	$('#anchorcataloghierarchical_'+catalogmasterid).toggleClass('glyphicon-plus glyphicon-minus');;
	 $('#anchorcataloghierarchical_'+catalogmasterid).attr("onClick","showcataloghierarchical("+catalogmasterid+")");
	$('#catalogvaluestr_'+catalogmasterid).toggle();
	$('#applicacatalogvaluestr_ntstr_'+catalogmasterid).html("");
}
/*------------------------------------------------------------------------*/
function showmngcatalogpaging(page){
	if(!page&& page!=0)
    	 page = parseInt($("#catalogmastertable").attr("page"));
	var searchObj = getcatalogsearchcriteria();
	getallcatalogmasters(page,searchObj);
}
/*----------------------------------------------------------------*/
function searchcatalogs(page)
{
	if(!page && page!=0)
    	 page = parseInt($("#catalogmastertable").attr("page"));
	var searchObj = getcatalogsearchcriteria();
	if(searchObj!=null)
		getallcatalogmasters(page,searchObj);
	else{
			$("#gridaction_response").removeClass().addClass("label label-important").html("Empty search is not allowed");
		setTimeout(function(){$("#gridaction_response").html("");}, 3000);
	}
	
}
/*----------------------------------------------------------------*/
function getallcatalogmasters(page,searchCriteria){
	
	var rows=$('#rows').val();
	if(rows=='' || rows==null)
		rows=20;
	searchobj=JSON.stringify(searchCriteria);
	var POSTDATA="action=showmngcatalogpaging&searchObj="+encodeURIComponent(searchobj)+"&page="+encodeURIComponent(page)+"&rows="+encodeURIComponent(rows);
	$('#loading').html("<img src=\"loader.gif\">");
	callservicebyajax(POSTDATA,"../d2dservice/catalog/catalogserver.php",function(){contentdivresponse()});
}
/*----------------------------------------------------------------*/
function getcatalogsearchcriteria()
{
	var searchCriteria={};
	var catalogmasterid= $("#catalogmasterid").val();
	var catalogmastername= $("#catalogmastername").val();
	var description= $("#description").val();
	var code= $("#mastercode").val();
	if(catalogmasterid && (catalogmasterid!="" && catalogmasterid!=null))
		searchCriteria.catalogmasterid=parseInt(trim(catalogmasterid));
	if(catalogmastername && (catalogmastername!="" && catalogmastername!=null))
		searchCriteria.catalogmastername=trim(catalogmastername);
	if(description && (description!="" && description!=null))
		searchCriteria.description=trim(description);
	if(code && (code!="" && code!=null))
		searchCriteria.code=trim(code);
	if(!$.isEmptyObject(searchCriteria))
		return searchCriteria;
	else
		return null;
}
/*------------------------------------------------------------------------*/
function SaveCatalogList(){
	catalogmasterid=$('#catalogmasterid').val();
	catalogmastername=$('#catalogmastername').val();
	description=$('#description').val();
	if((addedcatalogs.length>0 || removedcatalogs.length>0  || enabledcatalogs.length>0 || disabledcatalogs.length>0)&& catalogmastername ){
	var POSTDATA="action=savecatalogvalues&catalogmasterid="+encodeURIComponent(catalogmasterid)+"&catalogmastername="+encodeURIComponent(catalogmastername)
	+"&description="+encodeURIComponent(description);
	if(addedcatalogs.length>0) POSTDATA+="&addedcatalogs="+encodeURIComponent(JSON.stringify(addedcatalogs));
	if(removedcatalogs.length>0) POSTDATA+="&removedcatalogs="+encodeURIComponent(removedcatalogs);
	if(enabledcatalogs.length>0) POSTDATA+="&enabledcatalogs="+encodeURIComponent(enabledcatalogs);
	if(disabledcatalogs.length>0) POSTDATA+="&disabledcatalogs="+encodeURIComponent(disabledcatalogs);
	$('#loading').html("<img src=\"loader.gif\">");
	callservicebyajax(POSTDATA,"d2dservice/catalog/catalogserver.php",function(){
		masterid=$.trim(ajaxResponse);
		if(masterid>0) $("#response_div").removeClass("label-danger").addClass("label-success").html("List saved successfully");
		addedcatalogs=[];
		removedcatalogs=[];
		enabledcatalogs=[];
		disabledcatalogs=[];
		 setTimeout(function(){getpagecontent('catalogs/addupdatecatalogs.php',masterid);},4000);
	});
	}
	else{
		$("#response_div").removeClass("label-success").addClass("label-danger").html("Invalid Catalog MasterName/Changes is not valid to save");
		setTimeout(function(){$("#response_div").html("");},4000);
	}
}
/*------------------------------------------------------------------------*/
function loadcatalogchilds(){
	masterid=$('#catalogvalueparent').val();
	if(masterid){
	var POSTDATA="action=getallCatalogValuesNamesForDropDown&catalogmasterid="+encodeURIComponent(masterid);		
	callservicebyajax(POSTDATA,"../server/catalogserver.php",function(){
		$("#childcatalogs").html(ajaxResponse);
	});
	}
}
/*------------------------------------------------------------------------*/
var addedcatalogs=[];
var removedcatalogs=[];
var enabledcatalogs=[];
var disabledcatalogs=[];
var did=0;
function addcatalogtolist(){
	values=$('#catalogvalue').val();
	code=$('#catalogcode').val();
	parentname='';
	parent=$('#childcatalogs').val();
	if(parent) parentname=$("#childcatalogs :selected").text();
	if(values){
		valuearray=values.split(',');
		$.each(valuearray,function(i){
			if($('tr[catalogname="'+$.trim(valuearray[i])+'"]').length<=0){
				catalogvaluename=$.trim(valuearray[i]);
				dummy=++did;
			obj={};
			obj.catalogvaluename=catalogvaluename;  //persistent data
			obj.code= $.trim(code); //persistent data
			obj.parentid= $.trim(parent); //persistent data
			obj.trid="dummyid_"+dummy; // required to delete tr on client add
			addedcatalogs.push(obj);
			$('#catalogvaluelist tbody').append('<tr id="dummyid_'+ dummy +'" catalogname="'+catalogvaluename+'"><td><input type="checkbox" name="selectCatalogValue"  trid="dummyid_'+dummy+'"/></td><td>'+catalogvaluename+'</td><td>'+$.trim(code)+'</td><td>'
			+$.trim(parentname)+'</td><td><a href="#" onclick=removecatalogvalue("dummyid_'+dummy+'"); class="btn btn-sm btn-default-inverse"><i class="glyphicon  glyphicon-remove-sign white"></i>Delete</a></td></tr>');   
			}
		});
		$('#catalogvalue').html('');
		$("#response_div").removeClass("label-danger").addClass("label-success").html("List updated succssfully");
		setTimeout(function(){$("#response_div").html("");},3000);
	}
	else{
		$("#response_div").removeClass("label-success").addClass("label-danger").html("Empty catalogs can not be updated ");
		setTimeout(function(){$("#response_div").html("");},4000);
	}
}
/*------------------------------------------------------------------------*/
function removecatalogvalue(trid){
	catalogvalueid=$("#"+trid).attr("catalogvalueid")
	if(catalogvalueid)
		removedcatalogs.push(catalogvalueid);
	else{
		Cleanunsaveditem(trid,"trid");
	}
	$("#"+trid).remove();
}
function enableSelectedCatalogvalues(chkboxname){
	enabledcatalogs=[];
	pushselectedItemsToArray(enabledcatalogs,chkboxname);
	$('#catalogcountinformer').html(enabledcatalogs.length+ " Catalogs selected to Enable")
}

function disableSelectedCatalogvalues(chkboxname){
	disabledcatalogs=[];
		pushselectedItemsToArray(disabledcatalogs,chkboxname);
		$('#catalogcountinformer').html(disabledcatalogs.length+ " Catalogs selected to Disable")
}
function pushselectedItemsToArray(container, controlName){
	$('[name='+controlName+']:checked').each(function() {
	catalogid=$(this).attr('catalogvalueid');
	if(catalogid){
	   	container.push(catalogid);
	}
	});
}
/*------------------------------------------------------------------------*/
function Cleanunsaveditem(value,property) {
	len = addedcatalogs.length;
    for (var i = 0; i < len; i++){
        if (addedcatalogs[i][property] === value) {
			addedcatalogs.splice(i,1);
			return
		}
	}
}
function selectallcatalogvalues(parentname,chkboxname){
	selectchildcheckboxes(parentname,chkboxname);
}
function removeAllCatalogvalues(chkboxname){
	//Get All count to get user confirmation
	chackedvalues=pushcheckedvaluetoarray(chkboxname);
	if(chackedvalues && chackedvalues.length>0)
	var isfilereplace=confirm("Are you sure want to delete selected catalog values.?");
	if(!isfilereplace)
		return;
	//Select all checked checkbox and remove one by one
	$('[name='+chkboxname+']:checked').each(function() {
	catalogid=$(this).attr('catalogvalueid');
	trid='';
	//To remove existing catalog
	if(catalogid){
	   	removedcatalogs.push(catalogid);
		trid='dummy_'+catalogid;
	}
	//To remove newly added catalog
	else{
		trid=$(this).attr("trid");
		Cleanunsaveditem(trid,"trid");

	}
		$("#"+trid).remove();
	 });
	$('#catalogcountinformer').html(removedcatalogs.length+ " Catalogs selected to Delete")
}

/*------------------------------------------------------------------------*/