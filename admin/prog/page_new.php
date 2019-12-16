<font size="2" face="Tahoma"><b>Trang nội dung <img src="images/bl3.gif" border="0" /> Thêm trang</b></font>
<hr size="1" color="#cadadd" />
<?php
	include "templates/page.php";
	if (empty($func)) $func = "";
?>
<center>
<?php

	$max_file_size	=	8048000;
	$up_dir			=	"../uploads/cms/";
$OK = false;

	if ($func == "new")
	{
		if (empty($txt_ten))
			$error = "Vui lòng nhập tên trang.";
		else if (empty($txt_noi_dung))
			$error = "Vui lòng nhập nội dung.";
		else
		{ 	$file_type = $HTTP_POST_FILES['txt_hinh']['type'];
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
					
			$id = $db->insert("tgp_page","alias,ten,noi_dung,time,user,chu_thich,seo_desc, seo_keyword, seo_copyright, tag, seo_permalink","'".$db->escape($txt_alias)."','".$db->escape($txt_ten)."','".$txt_noi_dung."','".time()."','".$thanh_vien["id"]."','".$txt_chu_thich."','".$txt_seo_desc."', '".$txt_seo_keyword."', '".$txt_seo_copyright."', '".$txt_tag."', '".$txt_seo_permalink."'");
			
			//echo "tgp_page","id,alias,ten,noi_dung,time,user,chu_thich","0,'".$db->escape($txt_alias)."','".$db->escape($txt_ten)."','".$txt_noi_dung."','".time()."','".$thanh_vien["id"]."','".$txt_chu_thich."'";
			
			if ($hinh)
				{
					$txt_hinh_1	= "h_".$id.".".$file_type;
					$txt_hinh_2	= $id.".".$file_type;
					img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_1,"h=166&w=318&zc=1");
				
					$txt_hinh_3	= "thp_".$id.".".$file_type;
					img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_3,"h=150&w=200&zc=1");
					
					
					$db->update("tgp_page","hinh",$txt_hinh_2,"id = '".$id."'");
				}
				
			admin_load("Đã thêm Trang vào CSDL","?act=page_list");
				
			}
		}
	}
	else
	{
		$id = 0;
		$txt_alias		= "";
		$txt_ten		= "";
		$txt_noi_dung	= "";
	}
	
	if (!$OK)
		template_edit("?act=page_new","new",$id,$txt_alias,$txt_ten,$txt_noi_dung,$txt_chu_thich,$txt_hinh,$error)
?>
</center>