<font size="2" face="Tahoma"><b>Tin tức <img src="images/bl3.gif" border="0" /> Thêm bài viết</b></font>
<hr size="1" color="#cadadd" />
<?php
	include "templates/cms.php";
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
			$error = "Vui lòng nhập tên bài viết.";
		else if (empty($txt_chu_thich))
			$error = "Vui lòng nhập sơ lược bài viết.";
		else if (empty($txt_noi_dung))
			$error = "Vui lòng nhập nội dung bài viết.";
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
				$time = time($txt_date);
			
				$id = $db->insert("tgp_cms","id,cat,ten,chu_thich,hinh_note,noi_dung,hien_thi,noi_bat,time,user","0,'".($txt_cat+0)."','".str_replace("\\","",$db->escape($txt_ten))."','".$txt_chu_thich."','".$db->escape($txt_hinh_note)."','".$txt_noi_dung."','".($txt_hien_thi+0)."','".($txt_noi_bat+0)."','".$time."','".$thanh_vien["id"]."'");
				
				if ($hinh)
				{
					$txt_hinh_1	= "tt_".$id.".".$file_type;
					$txt_hinh_4	= "sp_".$id.".".$file_type;
					$txt_hinh_5	= "duan_".$id.".".$file_type;
					$txt_hinh_6	= "khachhang_".$id.".".$file_type;
					$txt_hinh_2	= $id.".".$file_type;
			
					img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_6,"h=80");
					img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_5,"h=100&w=120&zc=1");
					img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_4,"h=105&w=180&zc=1");
							img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_1,"h=80&w=115&zc=1");
					img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_2,"w=500&h=400&zc=1");
					
					$db->update("tgp_cms","hinh",$txt_hinh_2,"id = '".$id."'");
				}
				
				admin_load("Đã thêm Bài viết vào CSDL","?act=cms_list&id=".($txt_cat+0));
			}
		}
	}
	else
	{
		$txt_ten		= "";
		$txt_chu_thich	= "";
		$txt_hinh_note	= "";
		$txt_noi_dung	= "";
		$txt_hien_thi	= 1;
		$txt_date		= lg_date::vn_other(time(),"d/m/Y");
	}
	
	if (!$OK)
		template_edit("?act=cms_new", "new", 0 , $txt_cat,$txt_ten,$txt_chu_thich,$txt_hinh,$txt_hinh_note,$txt_noi_dung,$txt_hien_thi,$txt_noi_bat,$txt_date,$error)
?>
</center>