<font size="2" face="Tahoma"><b>Khách hàng <img src="images/bl3.gif" border="0" /> Sửa khách hàng</b></font>
<hr size="1" color="#cadadd" />
<?php
	include "templates/cus.php";
	if (empty($func)) $func = "";
?>
<center>
<?php
	//	Kiểm tra sự tồn tại của ID
	$id = $id + 0;
	$r	= $db->select("tgp_customers","id = '".$id."'");
	if ($db->num_rows($r) == 0)
		admin_load("Không tồn tại ID này.","?act=cus_manager");

	$max_file_size	=	2048000;
	$up_dir			=	"../uploads/cus/";

	$OK = false;
	
	if ($func == "update")
	{
		if (empty($txt_ten))
			$error = "Vui lòng nhập tiêu đề.";
		else if (empty($txt_dia_chi))
			$error = "Vui lòng nhập địa chỉ liên kết.";
		else
		{
			// kiểm tra file uploads.
			$file_type = $HTTP_POST_FILES['txt_hinh']['type'];
			$file_name = $HTTP_POST_FILES['txt_hinh']['name'];
			$file_size = $HTTP_POST_FILES['txt_hinh']['size'];
			switch ($file_type)
			{
				case "image/pjpeg"	: $file_type = "jpg"; break;
				case "image/jpeg"	: $file_type = "jpg"; break;
				case "image/gif" 	: $file_type = "gif"; break;
				case "image/x-png" 	: $file_type = "png"; break;
				default : $file_type = "unk"; break;
			}
			$file_full_name = "tmp_".time().".".$file_type;
			if ( ($file_size > 0) && ($file_size <= $max_file_size) )
				if ($file_type != "unk")
						if ( @move_uploaded_file($HTTP_POST_FILES['txt_hinh']['tmp_name'],$up_dir.$file_full_name) )
						{
							$OK = true;
							$hinh = true;
						}
						else
							$error = "Không thể upload hình ảnh.";
				else
				{
					$error = "Sai định dạng file - Không thể upload hình ảnh.";
				}
			else
			{
				if ($file_size == 0)
				{
					$OK		= true;
					$hinh	= false;
				}
				else
					$error = "Hình của bạn chọn vượt quá kích thước cho phép.";
			}
			// Process xong
			if ($OK)
			{
				$db->query("update tgp_customers set cat = '".($txt_cat+0)."', ten = '".$db->escape($txt_ten)."', dia_chi = '".$db->escape($txt_dia_chi)."', gioi_thieu = '".$txt_gioi_thieu."', hien_thi = '".($txt_hien_thi+0)."', noi_bat = '".($txt_noi_bat+0)."' where id = '".$id."'");
				
				if ($hinh)
				{
					$txt_hinh_2	= $id.".".$file_type;
					// img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_2,"w=220&h=160");
					unlink($up_dir.$txt_hinh_2);
					rename($up_dir.$file_full_name,$up_dir.$txt_hinh_2);
					$db->update("tgp_customers","hinh",$txt_hinh_2,"id = '".$id."'");
				}
				
				admin_load("Đã cập nhật thông tin.","?act=cus_manager");
			}
		}
	}
	else
	{
		$r	= $db->select("tgp_customers","id = '".$id."'");
		while ($row = $db->fetch($r))
		{
			$txt_cat		= $row["cat"];
			$txt_ten		= $row["ten"];
			$txt_dia_chi	= $row["dia_chi"];
			$txt_gioi_thieu	= $row["gioi_thieu"];
			$txt_hien_thi	= $row["hien_thi"];
			$txt_noi_bat	= $row["noi_bat"];
		}
	}
	
	if (!$OK)
		template_edit("?act=cus_edit", "update", $id , $txt_cat,$txt_ten,$txt_hinh,$txt_dia_chi,$txt_gioi_thieu,$txt_hien_thi,$txt_noi_bat,$error)
?>
</center>