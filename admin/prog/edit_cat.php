<?php
include "../kt_login.php";
include "../../config.php";
$db = new lg_mysql($host,$dbuser,$dbpass,$csdl);
include "../kt_admin.php";
include "../function.php";

	$ten = $_POST["ten"];
	$id = $_POST["id"];
	
	$tk=$db->update("tgp_cat","ten",$ten,"id = '".$id."'");
	if($tk==true){
	echo 'Edit thành công';
	}
?>