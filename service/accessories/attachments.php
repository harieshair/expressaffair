<?php
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(CLASSFOLDER."/enums.php");
session_start();
	$type=$_GET['filetype'];
	$fileElementName=$_GET['elementId'];	
	$error = "";
	$msg = "";
	$path = UPLOADFOLDER."/";
	set_time_limit(0);
	$valid_formats = getvalidformats($type);
	$maxsize=getMaxSize($type);
	$filenameexploded= explode(".", $_FILES[$fileElementName]['name']);
	$ext=end($filenameexploded);
	$newext=($ext=='xls')?'xlsx':$ext; //becaues xlsx not reading xls file
	if(!empty($_FILES[$fileElementName]['error']))
	{
		switch($_FILES[$fileElementName]['error'])
		{
			case '1':
				$error = "The uploaded file exceeds the upload_max_filesize directive ";
				break;
			case '2':
				$error = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the form ";
				break;
			case '3':
				$error = "The uploaded file was only partially uploaded ";
				break;
			case '4':
				$error = "No file was uploaded. ";
				break;

			case '6':
				$error = "Missing a temporary folder ";
				break;
			case '7':
				$error = 'Failed to write file to disk';
				break;
			case '8':
				$error = "File upload stopped by extension ";
				break;
			case '999':
			default:
				$error = "No error code avaiable ";
		}
	}
	
	 else if(in_array($ext,$valid_formats))	{
		$name = $_FILES[$fileElementName]['name'];
		if(strlen($name))
		{
			if($_FILES[$fileElementName]['size'] <$maxsize)
			{
				$filename= str_replace(".".$ext, "", $name).date('d_m_Y_h_i').'.'.$newext;
				$newname = $path.$filename;
				move_uploaded_file($_FILES[$fileElementName]['tmp_name'],$newname);
				echo $filename;
			}
			else echo "0";
		}
		else echo "0";
	}
	else echo "0";
		
	/*--------------------------------------------------------------------------------*/	
		function getvalidformats($type)
		{
		$extensionformat=array();
			switch($type)
			{
				case VIDEO:
				$extensionformat = array(".mp3",".mp4");
				break;
				case AUDIO:
				$extensionformat = array(".mp4");
				break;
				
				case ICON:
				$extensionformat = array(".ico");
				break;
								
				case IMAGE:
				$extensionformat=array("png","gif","jpeg","jpg");
				break;
				
				case DOCUMENT:
				$extensionformat=array("doc","docx","pdf","txt","ppt","pptx");
				break;

				case EXCEL:
				$extensionformat=array("xls","xlsx","csv");
				break;

			}
		return $extensionformat;
		}
/*--------------------------------------------------------------------------------*/	
  function getMaxSize($type)
  {
  $maxsize=0;
	  switch($type)
	  {
						  
		  case IMAGE:
		  $maxsize=1024*1024*10;
		  break;
		  
		  case ICON:
		  $maxsize=1024*1024*3;
		  break;
		   case VIDEO:
		  $maxsize=1024*1024*20;
		  break;
		  case DOCUMENT:
		  $maxsize=1024*1024*3;
		break;
 		case EXCEL:
		  $maxsize=1024*1024*3;
		break;
	  }
  return $maxsize;
  }
?>

