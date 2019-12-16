<?php
session_start();
@error_reporting(0);
@set_time_limit(0);

include "kt_login.php";
include "../config.php";
$db = new lg_mysql($host,$dbuser,$dbpass,$csdl);
include "kt_admin.php";
include "function.php";
if ($da_dang_nhap)
{
if (empty($act)) $act = "home";
include "tpl/skin/header.php";
	include "tpl/skin/menu.php";
	echo "<div id=\"main_frame\">";
	if (is_file("prog/".$act.".php"))
		include "prog/".$act.".php";
	else
		echo "<b>Chức năng này đã bị Khóa.</b>";
	echo "</div>";
	include "tpl/skin/copyright.php";
include "tpl/skin/footer.php";
}
else	include "login.php";
?>