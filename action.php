<?php
@session_start();

include("config.php");
$db		=	new	lg_mysql($host,$dbuser,$dbpass,$csdl);
include("func.php");

$THANHVIEN["id"] = 0;
include("z_includes/dem_online.php");

if (empty($act)) $act = "zzz";
if ( !in_array($act, array(
		'binh_chon','lien_he','load_tiem_kiem'
	) ) ) 
{
	die();
}
include "z_action/".$act.".php";
?>