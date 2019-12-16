<font size="2" face="Tahoma"><b>Khách hàng <img src="images/bl3.gif" border="0" /> Thêm khách hàng</b></font>
<hr size="1" color="#cadadd" />
<?php
	include "templates/cus.php";
	if (empty($func)) $func = "";
?>
<center>
<?php
	$max_file_size	=	2048000;
	$up_dir			=	"../uploads/cus/";

	$OK = false;
	
	if ($func == "new")
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
				$id = $db->insert("tgp_customers","id,cat,ten,dia_chi,gioi_thieu,hien_thi,noi_bat,thu_tu","0,'".($txt_cat+0)."','".$db->escape($txt_ten)."','".$db->escape($txt_dia_chi)."','".$txt_gioi_thieu."','".($txt_hien_thi+0)."','".($txt_noi_bat+0)."','0'");
				
				if ($hinh)
				{
					$txt_hinh_2	= $id.".".$file_type;
					// img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_2,"w=220&h=160");
					unlink($up_dir.$txt_hinh_2);
					rename($up_dir.$file_full_name,$up_dir.$txt_hinh_2);
					$db->update("tgp_customers","hinh",$txt_hinh_2,"id = '".$id."'");
				}
				
				admin_load("Đã thêm Khách hàng vào CSDL","?act=cus_manager");
			}
		}
	}
	else
	{
		$txt_ten		= "";
		$txt_dia_chi	= "";
		$txt_gioi_thieu	= "";
		$txt_hien_thi	= 1;
	}
	
	if (!$OK)
		template_edit("?act=cus_new", "new", 0 , $txt_cat,$txt_ten,$txt_hinh,$txt_dia_chi,$txt_gioi_thieu,$txt_hien_thi,$txt_noi_bat,$error)
?>
</center>