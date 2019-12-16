<font size="2" face="Tahoma"><b>Sản phẩm <img src="images/bl3.gif" border="0" /> Sửa sản phẩm</b></font>
<hr size="1" color="#cadadd" />
<?php
	include "templates/product.php";
	if (empty($func)) $func = "";
?>
<center>
<?php
	//	Kiểm tra sự tồn tại của ID
	$id = $id + 0;
	$r	= $db->select("tgp_product","id = '".$id."'");
	if ($db->num_rows($r) == 0)
		admin_load("Không tồn tại Sản phẩm này.","?act=product_manager");
	
	$max_file_size	=	2048000;
	$up_dir			=	"../uploads/product/";

	$OK = false;

	if ($func == "update")
	{
		if (empty($txt_ten))
			$error = "Vui lòng nhập tên sản phẩm.";
		
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
				$db->query("update tgp_product set cat = '".$db->escape($txt_cat)."', ten = '".$db->escape($txt_ten)."', chu_thich = '".$txt_chu_thich."', noi_dung = '".$txt_noi_dung."', gia = '".$txt_gia."' , hien_thi = '".($txt_hien_thi+0)."' , noi_bat = '".($txt_noi_bat+0)."' where id = '".$id."'");
				if ($hinh)
				{
					$txt_hinh_4	= "sp_".$id.".".$file_type;
					
					img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_4,"h=224&w=165&zc=1");
				
					
					$txt_hinh_2	= $id.".".$file_type;
					img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_2,"w=640");
					$db->update("tgp_product","hinh",$txt_hinh_2,"id = '".$id."'");
				}
				admin_load("Đã cập nhật thành công.","?act=product_list&id=".($txt_cat+0));
			}			
		}
	}
	else
	{
		$r	= $db->select("tgp_product","id = '".$id."'");
		while ($row = $db->fetch($r))
		{
			$txt_cat		= $row["cat"];
			$txt_ten		= $row["ten"];
			$txt_chu_thich	= $row["chu_thich"];
			$txt_hinh_note	= $row["hinh_note"];
			$txt_noi_dung	= $row["noi_dung"];
			$txt_gia		= $row["gia"];
			$txt_hien_thi	= $row["hien_thi"];
			$txt_noi_bat	= $row["noi_bat"];
		}
	}
	
	if (!$OK)
		template_edit("?act=product_edit","update",$id,$txt_cat,$txt_ten,$txt_chu_thich,$txt_hinh,$txt_noi_dung,$txt_gia,$txt_hien_thi,$txt_noi_bat,$error)
?>
</center>