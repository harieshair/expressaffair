<div class="form-group margin">
  <label class="col-sm-3 control-label"><span class="text-error">*</span>Attachment Type</label>
  <div class="col-sm-8" >
    <select id="file_type_<?php  echo !empty($attachment)?$attachment['id']:''; ?>" name="file_type" class="form-control">
     <?php
     foreach ($typeList as $key=>$value) {
      ?>            
      <option value="<?php echo $key ;?>"><?php echo $value ;?></option>
      <?php }
      
      ?>
    </select>
  </div>
</div>
<div class="form-group margin">
  <label class="col-sm-3 control-label"><span class="text-error">*</span>Attach File</label>
  <div class="col-sm-8" >

    <input type="file" name="attachment_<?php  echo !empty($attachment)?$attachment['id']:''; ?>" id="attachment_<?php  echo !empty($attachment)?$attachment['id']:''; ?>" 
    onchange="uploadfiles('<?php  echo !empty($attachment)?$attachment['id']:''; ?>');" >
    <input type="hidden" value="<?php  echo !empty($attachment)?$attachment['file_name']:''; ?>" name="file_name" id="file_name_<?php  echo !empty($attachment)?$attachment['id']:''; ?>"><br>            
    <div id="divexistingfile_<?php  echo !empty($attachment)?$attachment['id']:''; ?>"  class="fileclass"> <?php
      if(!empty($attachment)){ ?>
      <a style="cursor:pointer;color:#0000CC;"><?php print $attachment['file_name'] ;?></a>
      <a  style="cursor: pointer" class="fa fa-times" 
      onclick="removefilefromattachment('divexistingfile_<?php  echo !empty($attachment)?$attachment['id']:''; ?>,'oldattachment_<?php  echo !empty($attachment)?$attachment['id']:''; ?>')" 
      title="Remove file"></a>|
      <a onclick="showfilecontent('<?php  print '/'.$attachment['file_path']; ?>');" title="View file" ><i class ="fa fa-eye"></i></a>|
      <a href="attachments/downloadfiles.php?filelocation=<?php  print '/'.$attachment['file_path']; ?>"><i class ="fa fa-download"></i></a>
      <?php
    }

    ?></div>
  </div>
</div>