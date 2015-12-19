<?php
include_once($_SERVER['DOCUMENT_ROOT']."/eventconfig.php");
set_time_limit(0);
$req= $_GET['filelocation'];
$relativepath=str_replace("../","", $req);
$fullPath=ROOTFOLDER."/".$relativepath;
$filename=basename($fullPath);
if(file_exists($fullPath)) {
	
	//$filename=strtolower($basename);
	//$filename = preg_replace('/\s/', '_', $filename);
	$file_ext = preg_split("/\./",$filename);
	//$front_name = substr($file_ext[0], 0, 15);
	$extntname=end($file_ext);

	header('Content-Description: File Transfer');
	header('Content-type: '.getContenttype($extntname));
	header('Content-Disposition: attachment; filename='.$filename);
	header('Content-Transfer-Encoding: binary');
	header('Expires: 0');
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Pragma: public');
	header('Content-Length: ' . filesize($fullPath));
	ob_clean();
	flush();
	readfile($fullPath);
	exit;
 }
function getContenttype($ext){
$contenttype='';	
	switch($ext){
	case "*":$contenttype="application/octet-stream";	break;
	case "acx":	$contenttype="application/internet-property-stream";break;
	case "ai":$contenttype="application/postscript";break;
	case "aifc":
	case "aif":$contenttype="audio/x-aiff";	break;
	case "asf":
	case "asr":
	case "asx":$contenttype="video/x-ms-asf";	break;
	case "au":
	case "snd":$contenttype="audio/basic";break;
	case "avi":$contenttype="video/x-msvideo";break;
	case "axs":$contenttype="application/olescript";break;
	case "bcpio":$contenttype="application/x-bcpio";break;
	case "class":
	case "bin":
	case "dms":
	case "exe":
	case "lha":
	case "lzh":$contenttype="application/octet-stream";break;
	case "bmp":$contenttype="image/bmp";break;
	case "c":
	case "bas":
	case "txt":
	case "h":$contenttype="text/plain";break;
	case "cat":$contenttype="application/vnd.ms-pkiseccat";break;
	case "cdf":$contenttype="application/x-cdf";break;
	case "cdf":$contenttype="application/x-netcdf";break;
	case "cer":$contenttype="application/x-x509-ca-cert";break;
	case "clp":$contenttype="application/x-msclip";break;
	case "css":$contenttype="text/css";break;
	case "dll":$contenttype="application/x-msdownload";break;
	case "doc":
	case "docx":
	case "dot":$contenttype="application/msword";break;
	case "eps":$contenttype="application/postscript";break;
	case "evy":$contenttype="application/envoy";break;
	case "gif":$contenttype="image/gif";break;
	case "gtar":$contenttype="application/x-gtar";break;
	case "gz":$contenttype="application/x-gzip";break;
	case "hqx":$contenttype="application/mac-binhex40";break;
	case "htc":$contenttype="text/x-component";break;
	case "html":
	case "htm":$contenttype="text/html";break;
	case "ico":$contenttype="image/x-icon";break;
	case "iii":$contenttype="application/x-iphone";break;
	case "jfif":$contenttype="image/pipeg";break;
	case "jpeg":
	case "jpg":
	case "jpe":$contenttype="image/jpeg";break;
	case "js":$contenttype="application/x-javascript";break;
	case "mid":$contenttype="audio/mid";break;
	case "movie":$contenttype="video/x-sgi-movie";break;
	case "mp3":
	case "mpa":
	case "mpe":
	case "mpeg":
	case "mpg":
	case "mp2":$contenttype="video/mpeg";break;
	case "mpp":$contenttype="application/vnd.ms-project";break;
	case "pbm":$contenttype="image/x-portable-bitmap";break;
	case "pdf":$contenttype="application/pdf";break;
	case "pgm":$contenttype="image/x-portable-graymap";break;
	case "pnm":$contenttype="image/x-portable-anymap";break;
	case "ppm":$contenttype="image/x-portable-pixmap";break;
	case "pot":
	case "pps":
	case "ppt":$contenttype="application/vnd.ms-powerpoint";break;
	case "ps":$contenttype="application/postscript";break;
	case "pub":$contenttype="application/x-mspublisher";break;
	case "qt":$contenttype="video/quicktime";break;
	case "ra":
	case "ram":$contenttype="audio/x-pn-realaudio";break;
	case "ras":$contenttype="image/x-cmu-raster";break;
	case "rgb":$contenttype="image/x-rgb";break;
	case "rtf":$contenttype="application/rtf";break;
	case "rtx":$contenttype="text/richtext";break;
	case "src":$contenttype="application/x-wais-source";break;
	case "stm":$contenttype="text/html";break;
	case "svg":$contenttype="image/svg+xml";break;
	case "swf":$contenttype="application/x-shockwave-flash";break;
	case "tar":$contenttype="application/x-tar";break;
	case "tcl":$contenttype="application/x-tcl";break;
	case "tex":$contenttype="application/x-tex";break;
	case "texi":
	case "texinfo":$contenttype="application/x-texinfo";break;
	case "tgz":$contenttype="application/x-compressed";break;
	case "wcm":
	case "wdb":
	case "wks":
	case "wps":$contenttype="application/vnd.ms-works";break;
	case "wmf":$contenttype="application/x-msmetafile";break;
	case "wri":$contenttype="application/x-mswrite";break;
	case "xbm":$contenttype="image/x-xbitmap";break;
	case "xla":
	case "xlc":
	case "xlm":
	case "xls":
	case "xlt":
	case "xlw":$contenttype="application/vnd.ms-excel";break;
	case "zip":$contenttype="application/zip";break;
	}
}

?> 
