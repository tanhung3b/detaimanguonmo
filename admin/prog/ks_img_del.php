<?php

	$c = $db->select("tgp_camnhan","id =".$_GET["id"],"");
	$cms = $db->fetch($c);

	if (strpos($cms["photos"],$_GET["file"].";")!==false) $deleted = str_replace($_GET["file"].";","",$cms["photos"]);
	else if (strpos($cms["photos"],$_GET["file"].";")===false&&strpos($cms["photos"],";".$_GET["file"])===true)	$deleted = str_replace(";".$_GET["file"],"",$cms["photos"]);
	else 
	{
		$deleted = str_replace($_GET["file"],"",$cms["photos"]);
		
	}
	$note=delete_vitri_note($_GET["file"],$cms["photos"],$cms['note_photos']);
		$hinh_moi=delete_vitri_hinh($_GET["file"],$cms["photos"],$cms['note_photos']);
		echo $hinh_moi;
		
	$db->update("tgp_camnhan","photos",$hinh_moi,"id =".$_GET["id"]);
	$db->update("tgp_camnhan","note_photos",$note,"id =".$_GET["id"]);
	
	admin_load("Đã xóa ảnh ".$_GET["file"]." !","?act=camnhan_edit&id=".$_GET["id"]);
?>