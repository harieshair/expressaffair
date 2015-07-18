<div class="box-body">
<div class="row">
<div class="col-md-3"><label>Catalog MasterName</label><input type="text" id="catalogmastername"  placeholder="Catalog Master Name" 
	class="form-control"/><input type="hidden" id="catalogmasterid" name="catalogmasterid" value="0" /></div>
<div class="col-md-3"><label>Parent</label>
<select name="catalogvalueparent" id="catalogvalueparent" onchange="loadcatalogchilds()" class="form-control" ><option value="">Select</option>
<?php 
$catalogmasternames=$catalog->getallCatalogMastaersNames();
foreach($catalogmasternames as $master) 
	echo '<option value="'.$master['id'].'">'.$master['name'].'</option>'; 
unset($catalogmasternames);
?>
</select>
</div>
<div class="col-md-3"><label>Description</label><input type="text" id="description"  placeholder="Description" class="form-control"/></div>
</div>

<div class="row">
<div class="col-md-3"><label>Catalog Value</label><input type="text" id="catalogvalue"  placeholder="Catalog value" class="form-control"/></div>
<div class="col-md-3"><label>Parent Catalog</label><select  name="childcatalogs" id="childcatalogs" class="form-control"></select></div>
</div>


<div class="row">
<div class="col-md-2"></div>
<div class="col-md-3"><span id="response_div" class="label"></span></div>
<div class="col-md-2"><a href="javascript:void(0);" onclick="addcatalogtolist();" class="btn btn-default btn-default-inverse btn-sm">Update List</a></div>
<div class="col-md-2"><a href="javascript:void(0);" onclick="SaveCatalogList();" class="btn btn-default btn-default-inverse btn-sm">Save Changes</a></div>
</div>
<br /><br />

<div class="box box-success">
                <div class="box-header">
                  <h3 class="box-title">Catalog Values</h3>
              </div>                    
                    <table id="catalogvaluelist" width="100%">
                    <thead><tr class="gridHeader">
                    	<th width="20%">Value</th>
                    	 <th width="8%" >Code</th>
                    	 <th width="20%">Parent</th>
                    	 <th width="15%"></th>
                    	</tr></thead>
                    <tbody></tbody>
                    </table>
       </div>

</div>


