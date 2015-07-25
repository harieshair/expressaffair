<div class="row">
<div class="well well-sm" id="catalogsearchdiv" style="display:none;">
<form name="catalogform" id="catalogform">
<table class="table" style="width:100%">
<tr><td width="10%" style="border:none;  text-align:right"><b>Id:</b></td><td width="15%" style="border:none;"><input  type="text" maxlength="8" class="input-medium" onkeypress="return searchwithvalidation(event,'catalog','Number');"  id="catalogmasterid" /></td>
<td width="10%" style="border:none;  text-align:right"><b>Catalog Name:</b></td><td width="12%" style="border:none;"><input  type="text" maxlength="55" class="input-medium" onkeypress="return searchwithvalidation(event,'catalog','Char');"  id="catalogmastername" /></td>
<td width="10%" style="border:none; text-align:right"><b>Description:</b></td><td width="12%" style="border:none;"><input type="text" name="email" onkeypress="return searchwithvalidation(event,'catalog','Char')" class="input-medium" id="description" maxlength="80" /></td>
<td width="10%" style="border:none; text-align:right"><b>Catalog Code:</b></td><td width="12%" style="border:none;"><input type="text" name="email" onkeypress="return searchwithvalidation(event,'catalog','Char')" class="input-medium" id="mastercode" maxlength="15" /></td></tr>
<tr>
<td width="15%" style="border:none;text-align:right" colspan="4">
<a href="javascript:void(0);" onclick="searchcatalogs(0)" class="btn btn-default btn-default-inverse btn-xs"><i class="glyphicon glyphicon-search white"></i> Search</a>
&nbsp;<a href="javascript:void(0)" onclick="clearform('catalogform');showmngcatalogpaging(0)" class="btn btn-default btn-default-inverse btn-xs"><i class="glyphicon glyphicon-remove white"></i> Clear</a></td></tr>
</table>
</form>
</div>
</div>