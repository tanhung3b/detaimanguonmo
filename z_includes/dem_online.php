<?php
$timexpired = 600;
$timeout = time() - $timexpired;
mysql_query("DELETE FROM `tgp_online` WHERE `time` < ".$timeout."");
mysql_query("OPTIMIZE TABLE `tgp_online`");

if (empty($HTTP_X_FORWARDED_FOR)) $IP_NUMBER = getenv("REMOTE_ADDR");
else $IP_NUMBER = $HTTP_X_FORWARDED_FOR;
$url	=	getenv("QUERY_STRING");

$result = mysql_query("SELECT * FROM tgp_online WHERE ip='$IP_NUMBER' and user=".$THANHVIEN["id"]);
$num_rows = mysql_num_rows($result);
if($num_rows != 0) mysql_query("UPDATE tgp_online SET time='".time()."', site='".$url."' WHERE `ip`='$IP_NUMBER' and user=".$THANHVIEN["id"]);
else
{
	$sql	=	"INSERT INTO tgp_online VALUES ('$IP_NUMBER','".time()."','".$url."','".getenv("HTTP_USER_AGENT")."',".$THANHVIEN["id"].")";
	mysql_query($sql);
	
		// Bat dau dem theo ngay 
		$result = mysql_query("SELECT * FROM tgp_online_daily WHERE ngay='".lg_date::vn_other(time(),"d/m/Y")."'");
		$num_rows = mysql_num_rows($result);
		if($num_rows != 0) mysql_query("UPDATE tgp_online_daily SET bo_dem = bo_dem+1 WHERE `ngay`='".lg_date::vn_other(time(),"d/m/Y")."'");
		else mysql_query("INSERT INTO tgp_online_daily VALUES ('".lg_date::vn_other(time(),"d/m/Y")."',1)");
		// Ket thuc
}
// Ket thuc
?>