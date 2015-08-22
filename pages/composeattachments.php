<div class="form-group margin">
  <label class="col-sm-3 control-label"><span class="text-error">*</span>Attachment Type</label>
  <div class="col-sm-8" >
    <select id="attachmenttype_<?php  echo !empty($attachment)?$attachment['id']:''; ?>" name="attachmenttype_<?php  echo !empty($attachment)?$attachment['id']:''; ?>" class="form-control">
     <?php
     foreach ($typeList as $type) {
      ?>            
      <option value="<?php echo $type ;?>"><?php echo $type ;?></option>
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
    <input type="hidden" value="<?php  echo !empty($attachment)?$attachment['file_name']:''; ?>" id="oldattachment_<?php  echo !empty($attachment)?$attachment['id']:''; ?>"><br>            
    <div id="divexistingfile_<?php  echo !empty($attachment)?$attachment['id']:''; ?>"  class="fileclass"> <?php
      if(!empty($attachment)){ ?>
      <a style="cursor:pointer;color:#0000CC;"><?php print $attachment['file_name'] ;?></a>
      <a  style="cursor: pointer" class="glyphicon  glyphicon-remove" 
      onclick="removefilefromattachment('divexistingfile_<?php  echo !empty($attachment)?$attachment['id']:''; ?>,'oldattachment_<?php  echo !empty($attachment)?$attachment['id']:''; ?>')" 
      title="Remove file"></a>
      <a onclick="showfilecontent('../customerpages/<?php  print $alias.'/'.$attachment['file_name']; ?>');" title="View file" >View</a>|
      <a href="attachments/downloadfiles.php?filelocation=<?php  print $alias.'/'.$attachment['file_name']; ?>">Download</a>
      <?php
    }

    ?></div>
  </div>
</div>