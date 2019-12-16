<?php

	$c = $db->select("tgp_thisinh","id =".$_GET["id"],"");
	$cms = $db->fetch($c);

	if (strpos($cms["photos"],$_GET["file"].";")!==false) $deleted = str_replace($_GET["file"].";","",$cms["photos"]);
	else if (strpos($cms["photos"],$_GET["file"].";")===false&&strpos($cms["photos"],";".$_GET["file"])===true)	$deleted = str_replace(";".$_GET["file"],"",$cms["photos"]);
	else 
	{
		$deleted = str_replace($_GET["file"],"",$cms["photos"]);
	}
	
	$db->update("tgp_thisinh","photos",$deleted,"id =".$_GET["id"]);
	admin_load("Đã xóa ảnh ".$_GET["file"]." !","?act=thisinh_edit&id=".$_GET["id"]);
?>