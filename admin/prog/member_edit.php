<font size="2" face="Tahoma"><b>Sửa chữa thành viên</b></font>
<hr size="1" color="#cadadd" />
<?
	include "templates/member.php";
	if (empty($func)) $func = "";
?>
<center>
<?
	$OK = false;

	$id =	$id+0;
	$r	=	$db->select("tgp_user","id = '".$id."'");
	if ($db->num_rows($r) == 0)
	{
		Admin_Load("Không tồn tại username này.","?act=member_list");
		$OK = true;
	}

	if ($func == "update")
	{
		// xác thực về mật khẩu
		if (empty($txt_password))
		{
			// kiểm tra email
			if (kt_email_dung($txt_email))
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
				$db->query("update tgp_user set ten = '".$db->escape($txt_ten)."', email = '".$db->escape($txt_email)."', dien_thoai = '".$db->escape($txt_dien_thoai)."', dia_chi = '".$db->escape($txt_dia_chi)."', level = '".($txt_level+0)."', trang_thai = '".($txt_trang_thai+0)."' where id = '".$id."'");
				$OK = true;
				admin_load("Đã cập nhật thông tin cho User đó.","?act=member_list");
			}
		}
		else
		{
			if ($txt_password != $txt_password2)
				$error = "Mật khẩu không khớp.";
			else
			{
				$db->query("update tgp_user set password = '".md5($txt_password.$txt_username)."' where id = '".$id."'");
				$OK = true;
				admin_load("Đã thay đổi mật khẩu cho User đó.","?act=member_list");
			}
		}
	}
	else
	{
		$r	=	$db->select("tgp_user","id = '".$id."'");
		while ($row = $db->fetch($r))
		{
			$txt_username	=	$row["username"];
			$txt_email		=	$row["email"];
			$txt_ten 		=	$row["ten"];
			$txt_dien_thoai =	$row["dien_thoai"];
			$txt_dia_chi	=	$row["dia_chi"];
			$txt_level		=	$row["level"];
			$txt_trang_thai	=	$row["trang_thai"];
		}
		$error			=	"";
	}
	
	if (!$OK)
		template_edit("?act=member_edit", "update", $id , $txt_username , $txt_email , $txt_ten , $txt_dien_thoai , $txt_dia_chi , $txt_level , $txt_trang_thai , $error);
?>
</center>