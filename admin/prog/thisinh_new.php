<font size="2" face="Tahoma"><b>Thí sinh<img src="images/bl3.gif" border="0" /> Thêm</b></font>
<hr size="1" color="#cadadd" />
<?php
	include "templates/thisinh.php";
	if (empty($func)) $func = "";
?>
<center>
<?php

$max_file_size	=	80000000;
	$up_dir			=	"../uploads/thisinh/";

	$OK = false;


	if ($func == "new")
	{
		if (empty($txt_ten))
			$error = "Vui lòng nhập tên.";
		
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
			if ($OK)
			{
	
			$id = $db->insert("tgp_thisinh","id,ten,so_bao_danh,thanh_pho, Lop_truong,ngay_sinh,chieu_cao, can_nang, so_do, noi_dung,hien_thi","0,'".$txt_ten."','".$txt_sobaodanh."','".$txt_thanhpho."','".$txt_lop_truong."','".$txt_ngay_sinh."','".$txt_chieu_cao."','".$txt_can_nang."','".$txt_so_do."','".$txt_noi_dung."','".$txt_hien_thi."'");
			
			if ($hinh)
				{
				
					$txt_hinh_3	= "th_".$id.".".$file_type;
					img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_3,"h=140&w=150&zc=1");
					
					$txt_hinh_1	= "thm_".$id.".".$file_type;
					img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_1,"w=320");
				
					$txt_hinh_2	= $id.".".$file_type;
				
					
					img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_2,"");
					
					$db->update("tgp_thisinh","hinh",$txt_hinh_2,"id = '".$id."'");
				}
				
				admin_load("Đã thêm Trang vào CSDL","?act=thisinh_list");
			
			}
			
			
			
			
		}
	}
	else
	{
		$id = 0;
		$txt_ten		= "";
		$txt_noi_dung	= "";
		$txt_hien_thi		= "1";
	}
	
	if (!$OK)
		template_edit("?act=thisinh_new","new",$id,$txt_ten,$txt_chieu_cao,$txt_can_nang,$txt_so_do,$txt_noi_dung,$txt_ngay_sinh,$txt_lop_truong,$txt_sobaodanh,$txt_hinh,$txt_thanhpho,$photos,$txt_hien_thi,$error)
?>
</center>