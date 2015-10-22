<?php 
$catalogmaster=$catalog->getCatalogMasterById($catalogmasterid); 
$catalogvalues=$catalog->getCatalogValuesByMasterId($catalogmasterid); ?>
<input type="hidden" id="catalogmasterid" name="catalogmasterid" value="<?php echo $catalogmasterid; ?>"  />
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Edit Catalog Values</h3>
    </div>  
    <div class="box-body">
        <div class="row">
            <div class="col-md-4">
                <label>Catalog MasterName</label>
                <input type="text" id="catalogmastername"  disabled="disabled" 
                value="<?php echo $catalogmaster['name'];?>" class="form-control"/>    
            </div>
            <div class="col-md-4">
                <label>Parent</label>
                <select name="catalogvalueparent" id="catalogvalueparent" onchange="loadcatalogchilds()" class="form-control">
                    <option value="">Select</option>
                    <?php 
                    $catalogmasternames=$catalog->getallCatalogMastaersNames();
                    foreach($catalogmasternames as $master) 
                     echo '<option value="'.$master['id'].'">'.$master['name'].'</option>'; 
                 unset($catalogmasternames);
                 ?>
             </select>
         </div>
         <div class="col-md-4">
            <label>Description</label>
            <input type="text" id="description"  placeholder="Description" value="<?php echo $catalogmaster['description'];?>" class="form-control"/>
        </div>
        <div class="col-md-4">
            <label>Catalog Value</label>
            <input type="text" id="catalogvalue"  placeholder="Catalog value" class="form-control"/>
        </div>
        <div class="col-md-4">
            <label>Code</label>
            <input type="text" id="catalogcode"  placeholder="Catalog code" class="form-control"/>
        </div>
        <div class="col-md-4">
            <label>Parent Catalog</label>
            <select  name="childcatalogs" id="childcatalogs" class="form-control"></select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-5"></div>
        <div class="col-md-3"><span id="response_div" class="label"></span></div>
        <div class="col-md-2"><a href="javascript:void(0);" onclick="addcatalogtolist();" class="btn btn-default btn-sm"><i class="glyphicon  glyphicon-list white"></i>Add Into Cataloag Vlues</a></div>
        <div class="col-md-2"><a href="javascript:void(0);" onclick="SaveCatalogList();" class="btn btn-default btn-sm"><i class="glyphicon  glyphicon-print white"></i>Apply All Changes</a></div>
    </div>
</div>
</div>

<br /><br />
<div class="box box-warning ">
    <div class="box-header">
        <h3 class="col-sm-6 box-title">Catalog Values</h3>
        <div class="col-sm-6 pull-right">
         <span class="label label-info" id="catalogcountinformer"></span>
         <a href="javascript:void(0);" onclick="enableSelectedCatalogvalues('selectCatalogValue');" class="btn btn-default btn-default-inverse btn-sm">
            <i class="glyphicon  glyphicon-ok-circle white"></i>Visible</a>
            <a href="javascript:void(0);" onclick="disableSelectedCatalogvalues('selectCatalogValue');" class="btn btn-default btn-default-inverse btn-sm">
                <i class="glyphicon  glyphicon-ban-circle white"></i>Disable</a>
                <a href="javascript:void(0);" onclick="removeAllCatalogvalues('selectCatalogValue');" class="btn btn-default btn-default-inverse btn-sm">
                    <i class="glyphicon  glyphicon-remove-circle white"></i>Remove</a>
                </div>
            </div>
            <div class="box-body">
                <div id="example2_wrapper" class="dataTables_wrapper form-inline" role="grid"> 
                    <div class="col-sm-12">
                        <table id="catalogvaluelist" class="table table-bordered table-hover dataTable " aria-describedby="example2_info">
                            <thead><tr ><td>
                                <input type="checkbox" name="selectAllCatalogValues"  onclick="selectAllCheckboxchilds('selectAllCatalogValues','selectCatalogValue')" /></td>
                                <td>Value</td>
                                <td>Parent</td>
                                <td>Delete</td>
                            </tr></thead>
                            <tbody>
                                <?php if(!empty($catalogvalues)){
                                  foreach($catalogvalues as $catalogvalue){?>
                                  <tr id="dummy_<?php echo $catalogvalue['id'];?>" catalogvalueid="<?php echo $catalogvalue['id'];?>" 
                                    catalogname="<?php echo $catalogvalue['catalog_value'];?>" >
                                    <td> <input type="checkbox" name="selectCatalogValue"  catalogvalueid="<?php echo $catalogvalue['id'];?>" 
                                     trid="dummy_<?php echo $catalogvalue['id'];?>" /></td>
                                     <td><?php echo $catalogvalue['catalog_value'];?></td>
                                     <td><?php echo (!empty($catalogvalue['catalogvalue_id']))?$catalog->getcatalogValueByValueId($catalogvalue['catalogvalue_id']):'';?></td>
                                     <td><a href="#" onclick="removecatalogvalue('dummy_<?php echo $catalogvalue['id'];?>' );" 
                                        class="btn btn-default btn-default-inverse btn-sm"><i class="glyphicon  glyphicon-remove-sign white"></i></a></td>       
                                    </tr>
                                    <?php 	}
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>




