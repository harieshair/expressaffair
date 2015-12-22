<?php

include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
include_once(CLASSFOLDER."/enums/commonenums.php");
set_time_limit(0);

$response=array();
$minSize=1024*1024;
$type=$_GET['filetype'];
$fileElementName=$_GET['elementId'];	
$path = UPLOADFOLDER."/";
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
			$response['Exception'] = "The uploaded file exceeds the upload_max_filesize directive ";
			break;
			case '2':
			$response['Exception'] = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the form ";
			break;
			case '3':
			$response['Exception'] = "The uploaded file was only partially uploaded ";
			break;
			case '4':
			$response['Exception'] = "No file was uploaded. ";
			break;
			case '6':
			$response['Exception'] = "Missing a temporary folder ";
			break;
			case '7':
			$response['Exception'] = 'Failed to write file to disk';
			break;
			case '8':
			$response['Exception'] = "File upload stopped by extension ";
			break;
			case '999':
			default:
			$response['Exception'] = "No error code avaiable ";
		}
	}
	
	else if(in_array($ext,$valid_formats))	{
		try{
			$name = $_FILES[$fileElementName]['name'];
			if(strlen($name))
			{
				if($_FILES[$fileElementName]['size'] <$maxsize)
				{
					$filename= str_replace(".".$ext, "", $name).date('d_m_Y_h_i').'.'.$newext;
					$newname = $path.$filename;
					move_uploaded_file($_FILES[$fileElementName]['tmp_name'],$newname);
					$response['filename']=$name;
					$response['newfilename']=$filename;					
				}
				else $response['Exception']="File exceeds maximum size ".$maxsize/$minSize." MB";
			}
		}
		catch(Exception $ex)
		{
			$response['Exception']= $ex->getMessage();
		}
	}
	else $response['Exception']="Attachments supports ".implode(",",$valid_formats)." Files only";
	
	echo json_encode($response);


	/*--------------------------------------------------------------------------------*/	
	function getvalidformats($type)
	{
		$extensionformat=array();
		switch($type)
		{
			case 1:
			$extensionformat = array(".mp3",".mp4");
			break;
			case 4:
			$extensionformat = array(".mp4");
			break;

			case 5:
			$extensionformat = array(".ico");
			break;

			case 0:
			$extensionformat=array("png","gif","jpeg","jpg","JPG");
			break;

			case 2:
			$extensionformat=array("doc","docx","pdf","txt","ppt","pptx");
			break;

			case 3:
			$extensionformat=array("xls","xlsx","csv");
			break;

		}
		return $extensionformat;
	}
	/*--------------------------------------------------------------------------------*/	
	function getMaxSize($type)
	{
		$minSize=1024*1024;
		$maxsize=0;
		switch($type)
		{

			case 0:
			$maxsize=$minSize*10;
			break;

			case 5:
			$maxsize=$minSize*3;
			break;
			case 1:
			$maxsize=$minSize*20;
			break;
			case 2:
			$maxsize=$minSize*3;
			break;
			case 3:
			$maxsize=$minSize*3;
			break;
		}
		return $maxsize;
	}
	?>

