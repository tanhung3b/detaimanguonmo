<?php
// JQuery File Upload Plugin v1.6.2 by RonnieSan - (C)2009 Ronnie Garcia
// Sample by Travis Nickels
include("../../../../config.php");
if (!empty($_FILES)) {

	$file_name_1 = $HTTP_POST_FILES['Filedata']['name'];
	$file_name = str_replace(" ","_",lg_string::bo_dau($file_name_1));
	$ext = substr($file_name,strlen($file_name)-3,3);
	
	if ( in_array($ext, array(
		'mp3','mp4','flv','acc',
	) ) ) 
	{			
		$tempFile1 = $_FILES['Filedata']['tmp_name'];
		$tempFile	=	str_replace(" ","_",lg_string::bo_dau($tempFile1));
		$fileSize = $_FILES['Filedata']['size'];
		$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_GET['folder'] . '/';
		$newFileName1 = $_GET['name'].''.(($_GET['location'] != '')?$_GET['location'].'':'').$_FILES['Filedata']['name'];
		$time=rand(0,time());
		$newFileName = $time.str_replace(" ","_",lg_string::bo_dau($newFileName1));
		$targetFile =  str_replace('//','/',$targetPath) . $newFileName;
		
		if (file_exists($targetFile))
		{
			echo '1';
		}
		else
		{
			// Uncomment the following line if you want to make the directory if it doesn't exist
			// mkdir(str_replace('//','/',$targetPath), 0755, true);
			
			move_uploaded_file($tempFile,$targetFile);
			
			//img_resize_1($targetPath.$newFileName,$targetPath."thm_".$newFileName,"h=361&w=650&zc=1");
	
			if ($newFileName)
				echo $newFileName."|".(round($fileSize/1000));
			else // Required to trigger onComplete function on Mac OSX
				echo '1';
			}
	}
	else
	{
		echo "1";
	}
}
else
{
	echo '1';
}
?>