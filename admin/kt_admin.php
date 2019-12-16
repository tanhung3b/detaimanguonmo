<?php
$da_dang_nhap		=	true;
$thanh_vien["id"]	=	0;

if (empty($login_admin_user))
{
	$da_dang_nhap	=	false;
	$error_text		=	"Vui lòng đăng nhập vào hệ thống !";
}
else {
	if ( !kt_admin($login_admin_user,$login_admin_pass) )
	{
		$da_dang_nhap	=	false;
		$error_text		=	"<b>Tên đăng nhập</b> hoặc <b>Mật khẩu</b> không đúng !";
	}
}

if ($da_dang_nhap)
{
	$r = $db->select("tgp_user","username = '".$db->escape($login_admin_user)."'");
	while ($row = $db->fetch($r))
		$thanh_vien	=	$row;
}
	
function	kt_admin($user , $pass)
{
	global $db;
	
	$r	=	$db->select("tgp_user","username = '".$db->escape($user)."' and password = '".md5($pass.$user)."' and trang_thai = 1 and level = 0");
	if ($db->num_rows($r) == 0)
		return	false;
	else
		return	true;
}
?>