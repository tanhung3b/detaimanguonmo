<?php
include "../config.php";
$db = new lg_mysql($host,$dbuser,$dbpass,$csdl);

function img_resize($src,$dis,$par)
{
 	require_once('../lib/phpthumb/phpthumb.class.php');
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

/*
Uploadify v2.1.4
Release Date: November 8, 2010

Copyright (c) 2010 Ronnie Garcia, Travis Nickels

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/

if (!empty($_FILES)) {
	$id=$_GET['id'];
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = '../uploads/bds/';
     $vitri =strrpos($_FILES['Filedata']['name'],".");
     $type= substr($_FILES['Filedata']['name'], $vitri, strlen($_FILES['Filedata']['name']));
	 $name=md5($_FILES['Filedata']['name'].time()).'-'.$id.$type;
	//$targetFile =  'hinh/'.$name;
	
	
	move_uploaded_file($tempFile,$targetFile);
echo str_replace($_SERVER['DOCUMENT_ROOT'],'',$targetFile).'abc';
		
	//$tempFile = $_FILES['Filedata']['tmp_name'];
	
	//$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';
	
	//$dinh_dang = strrchr($_FILES['Filedata']['name'],".");
	//$time=rand(0,time());
	
	//$targetFile = str_replace('//','/',$targetPath)."2_".$time.$dinh_dang;
	 
//	$filename = "2_".$time.$dinh_dang;
	//$thumb = "thm_".$filename ;

	img_resize($tempFile,$targetPath.'home_'.$name,"w=286&h=140&zc=1");
	img_resize($tempFile,$targetPath.'silde_icon_'.$name,"w=50&h=50&zc=1");	
	img_resize($tempFile,$targetPath.'silde_view_'.$name,"w=600&h=200&zc=1");		
   	img_resize($tempFile,$targetPath.'sieuviet_'.$name,"");	
	
	//echo $filename;
	$r	=	mysql_query("SELECT * FROM tgp_upload_tmp where id=".$id." ORDER BY id ASC");
	while ($row	=	mysql_fetch_array($r))
	{
	if ( $row["list_hinh"] == NULL ) $hinh = $name.';';
	else $hinh = $row["list_hinh"].$name.';';
	}


$sql="update tgp_upload_tmp set list_hinh='".$hinh."' where id =".$id." ";
mysql_query($sql);		
	

}

?>