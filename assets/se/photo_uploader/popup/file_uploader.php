<?php
// default redirection
$url = $_REQUEST["callback"].'?callback_func='.$_REQUEST["callback_func"];
$bSuccessUpload = is_uploaded_file($_FILES['Filedata']['tmp_name']);

// SUCCESSFUL
if(bSuccessUpload) {
	$tmp_name = $_FILES['Filedata']['tmp_name'];
	$name = $_FILES['Filedata']['name'];
	
	
	$filename_ext = strtolower(array_pop(explode('.',$name)));
	$allow_file = array("jpg", "png", "bmp", "gif");
	
	if(!in_array($filename_ext, $allow_file)) {
		$url .= '&errstr='.$name;
	} else {
		//$uploadDir = $_SESSION['up_dir'] == "" ? '../../../../upload/' : $_SESSION['up_dir'];
		$uploadDir = '../../../../upload/editor/';
		if(!is_dir($uploadDir)){
			mkdir($uploadDir, 0777);
		}
		$name = time().".".$filename_ext;
		//$newPath = $uploadDir.urlencode($_FILES['Filedata']['name']);
		$newPath = $uploadDir.urlencode($name);
		
		@move_uploaded_file($tmp_name, $newPath);
		
		$url .= "&bNewLine=true";
		$url .= "&sFileName=".urlencode(urlencode($name));
		$url .= "&sFileURL=/upload/editor/".urlencode(urlencode($name));
	}
}
// FAILED
else {
	$url .= '&errstr=error';
}
	
header('Location: '. $url);
?>