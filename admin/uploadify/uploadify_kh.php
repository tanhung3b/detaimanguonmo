<?php


include "../../config.php";
$db = new lg_mysql($host,$dbuser,$dbpass,$csdl);

function img_resize($src,$dis,$par)
{
 	require_once('../../lib/phpthumb/phpthumb.class.php');
 	$phpThumb = new phpThumb();
 	$phpThumb->src = $src;
		$r = explode("&",$par);
		for ($i = 0; $i <= count($r); $i++)
		{
			if ($r[$i] != "")
			{
				$q = explode("=",$r[$i]);
				if ($q[0] == 'h') 
					$phpThumb->h = $q[1];
				if ($q[0] == 'w') 
					$phpThumb->w = $q[1];
					
				if ($q[0] == 'zc')
				{
					$phpThumb->zc = $q[1];
				}
				
				if ($q[0] == 'fltr[]')
				{
					$phpThumb->fltr[] = $q[1];
				}
			}
		}
	$phpThumb->q = 100;
	$phpThumb->config_output_format = 'jpeg';
	$phpThumb->config_error_die_on_error = true;
	if ($phpThumb->GenerateThumbnail())
	{
		$phpThumb->RenderToFile($dis);
  	}
  	else
	{
  	}
}

if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';
	
	//$targetFile =  str_replace('//','/',$targetPath) . $_FILES['Filedata']['name'];
	
	$dinh_dang = strrchr($_FILES['Filedata']['name'],".");
	$time=time();
	
	$targetFile = str_replace('//','/',$targetPath).$_GET['id']."_".time().$dinh_dang;
	 
	  $md5_hash = md5(rand(0,999)); 
	$security_code = substr($md5_hash, 15, 5); 
	
	$filename = $_GET['id']."_".time().$security_code.$dinh_dang ;
	$thumb = "thm_".$filename ;

	
	// $fileTypes  = str_replace('*.','',$_REQUEST['fileext']);
	// $fileTypes  = str_replace(';','|',$fileTypes);
	// $typesArray = split('\|',$fileTypes);
	// $fileParts  = pathinfo($_FILES['Filedata']['name']);
	
	// if (in_array($fileParts['extension'],$typesArray)) {
		// Uncomment the following line if you want to make the directory if it doesn't exist
		// mkdir(str_replace('//','/',$targetPath), 0755, true);
		
		//move_uploaded_file($tempFile,$targetFile);
		
		
		
		
	
		img_resize($tempFile,$targetPath.$thumb,"w=110&h=90&zc=1");	
				
		img_resize($tempFile,$targetPath.$filename,"");
		
		echo $filename;	
		
	 
		$p = $db->select("tgp_camnhan","id = ".$_GET['id'],"LIMIT 1");
		$photo = $db->fetch($p);
		
		if ( $photo["photos"] == NULL ) $photos = $filename;
		else $photos = $photo["photos"].";".$filename;
		
		
		$db->update("tgp_camnhan","photos",$photos,"id = ".$_GET['id']);		
			
	// } else {
	// 	echo 'Invalid file type.';
	// }
}
?>