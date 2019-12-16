<font size="2" face="Tahoma"><b>Thêm thành viên</b></font>
<hr size="1" color="#cadadd" />
<?
	include "templates/member.php";
	if (empty($func)) $func = "";
?>
<center>
<?
	$OK = false;

	if ($func == "new")
	{
		// kiểm tra user tồn tại
		$r = $db->select("tgp_user","username = '".$db->escape($txt_username)."'");
		if ($db->num_rows($r) != 0)
			$error = "Username này đã tồn tại. Vui lòng thử lại tên khác.";
		// kiểm tra username
		else if (empty($txt_username))
			$error = "Vui lòng nhập Tên Đăng nhập.";
		// kiểm tra chuẩn username
		else if (kt_user_dung($txt_username))
			$error = "Tên đăng nhập không Chuẩn (Chỉ bao gồm các ký tự a-z và 0-9, các dấu -, _)";
		// xác thực về mật khẩu
		else if (empty($txt_password))
			$error = "Vui lòng nhập mật khẩu.";
		else if ($txt_password != $txt_password2)
			$error = "Mật khẩu không khớp.";
		// kiểm tra email
		else if (kt_email_dung($txt_email))
			$error = "Email của bạn không hợp lệ";
		// kiểm tra tên thành viên
		else if (empty($txt_ten))
			$error = "Vui lòng nhập Tên Thành viên.";
		// kiểm tra số điện thoại
		else if (empty($txt_dien_thoai))
			$error = "Vui lòng nhập Số điện thoại.";
		// kiểm tra địa chỉ
		else if (empty($txt_dia_chi))
			$error = "Vui lòng nhập Địa chỉ.";
		// OK all
		else
		{
			$db->insert("tgp_user","id,username,password,ten,email,dien_thoai,dia_chi,level,trang_thai,time","0,'".$db->escape($txt_username)."','".md5($txt_password.$txt_username)."','".$db->escape($txt_ten)."','".$db->escape($txt_email)."','".$db->escape($dien_thoai)."','".$db->escape($txt_dia_chi)."','".($txt_level+0)."','".($txt_trang_thai+0)."','".time()."'");
			$OK = true;
			admin_load("Đã thêm User vào CSDL","?act=member_list");
		}
	}
	else
	{
		$txt_username	=	"";
		$txt_email		=	"";
		$txt_ten 		=	"";
		$txt_dien_thoai =	"";
		$txt_dia_chi	=	"";
		$txt_level		=	0;
		$txt_trang_thai	=	1;
		$error			=	"";
	}
	
	if (!$OK)
		template_edit("?act=member_new", "new", 0 , $txt_username , $txt_email , $txt_ten , $txt_dien_thoai , $txt_dia_chi , $txt_level , $txt_trang_thai , $error);
?>
</center>