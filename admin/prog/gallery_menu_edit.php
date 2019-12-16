<font size="2" face="Tahoma"><b>Thư viện hình ảnh <img src="images/bl3.gif" border="0" /> Sửa mục</b></font>
<hr size="1" color="#cadadd" />
<?php
	include "templates/gallery_menu.php";
	if (empty($func)) $func = "";
	$id = $id+0;
	//	Kiểm tra sự tồn tại của ID
	$r	= $db->select("tgp_gallery_menu","id = '".$id."'");
	if ($db->num_rows($r) == 0)
		admin_load("Không tồn tại Mục này.","?act=gallery_manager");
?>
<center>
<?php
		$max_file_size	=	10000000;
	$up_dir			=	"../uploads/album/";

	$OK = false;
	
	
	if ($func == "update")
	{
		if (empty($txt_ten))
			$error = "Vui lòng nhập Tên mục.";
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
				case "image/png" 	: $file_type = "png"; break;
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
			
			$db->query("update tgp_gallery_menu set ten = '".$db->escape($txt_ten)."', cat = '".$db->escape($txt_cat)."', hien_thi = '".($txt_hien_thi+0)."',chu_thich='".$txt_chu_thich."',noi_dung='".$txt_noi_dung."' where id = '".$id."'");
				if ($hinh)
				{
						$txt_hinh_4	= "thm_".$id.".".$file_type;
						img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_4,"h=146&w=225&zc=1");
						
						$txt_hinh_3	= $id.".".$file_type;
						img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_3,"");
				
						$db->update("tgp_gallery_menu","hinh",$txt_hinh_3,"id = '".$id."'");
				}
			
			admin_load("Đã cập nhật thành công.","?act=gallery_manager");
			$OK = true;
		}
	}
	else
	{
		$r	= $db->select("tgp_gallery_menu","id = '".$id."'");
		while ($row = $db->fetch($r))
		{
			$txt_ten		=	$row["ten"];
			$txt_cat		=	$row["cat"];
			$txt_hien_thi	=	$row["hien_thi"];
			$txt_chu_thich	=	$row["chu_thich"];
			$txt_noi_dung	=	$row["noi_dung"];
		}
	}
	
	if (!$OK)
		template_edit("?act=gallery_menu_edit","update",$id,$txt_cat,$txt_ten,$txt_hien_thi,$error);
?>
</center>