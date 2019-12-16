<font size="2" face="Tahoma"><b>Trang nội dung <img src="images/bl3.gif" border="0" /> Sửa trang</b></font>
<hr size="1" color="#cadadd" />
<?php
	include "templates/page.php";
	if (empty($func)) $func = "";
?>
<center>
<?php
	//	Kiểm tra sự tồn tại của ID
	$id = $id + 0;
	$r	= $db->select("tgp_page","id = '".$id."'");
	if ($db->num_rows($r) == 0)
		admin_load("Không tồn tại trang này.","?act=page_list");


	$max_file_size	=	2048000;
	$up_dir			=	"../uploads/cms/";

	$OK = false;
	
	if ($func == "update")
	{
		if (empty($txt_ten))
			$error = "Vui lòng nhập tên trang.";
		else if (empty($txt_noi_dung))
			$error = "Vui lòng nhập nội dung.";
		else
		{		$file_type = $HTTP_POST_FILES['txt_hinh']['type'];
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
				if ($OK)
					{	
		$db->query("update tgp_page set alias = '".$db->escape($txt_alias)."', ten = '".$db->escape($txt_ten)."', noi_dung = '".$txt_noi_dung."', time = '".time()."',
		chu_thich='".$txt_chu_thich."',
		seo_desc = '".$txt_seo_desc."',
				seo_keyword = '".$txt_seo_keyword."', 
				seo_copyright = '".$txt_seo_copyright."',
				 tag = '".$txt_tag."',
				 seo_permalink = '".$txt_seo_permalink."'
		 where id = '".$id."'");
			if ($hinh)
				{
					$txt_hinh_1	= "h_".$id.".".$file_type;
					$txt_hinh_2	= $id.".".$file_type;
			
					
							img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_1,"h=166&w=318&zc=1");
							$txt_hinh_3	= "thp_".$id.".".$file_type;
							img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_3,"h=150&w=200&zc=1");
				
					
					$db->update("tgp_page","hinh",$txt_hinh_2,"id = '".$id."'");
				}
			admin_load("Đã cập nhật thành công.","?act=page_list");	
			}
		}
	}
	else
	{
		$r	= $db->select("tgp_page","id = '".$id."'");
		while ($row = $db->fetch($r))
		{
			$txt_alias		= $row["alias"];
			$txt_ten		= $row["ten"];
			$txt_noi_dung	= $row["noi_dung"];
			$txt_chu_thich	= $row["chu_thich"];
			$txt_seo_desc		= $row["seo_desc"];
			$txt_seo_keyword	= $row["seo_keyword"];
			$txt_seo_copyright	= $row["seo_copyright"];
			$txt_tag			= $row["tag"];
			$txt_seo_permalink	= $row['seo_permalink'];
		}
	}
	
	if (!$OK)
		template_edit("?act=page_edit","update",$id,$txt_alias,$txt_ten,$txt_noi_dung,$txt_chu_thich,$txt_hinh,$error);
?>
</center>