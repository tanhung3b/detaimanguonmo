<font size="2" face="Tahoma"><b>Thí sinh <img src="images/bl3.gif" border="0" /> Sửa</b></font>
<hr size="1" color="#cadadd" />
<?php
	include "templates/thisinh.php";
	if (empty($func)) $func = "";
?>
<center>
<?php
	//	Kiểm tra sự tồn tại của ID
	$id = $id + 0;
	$r	= $db->select("tgp_thisinh","id = '".$id."'");
	if ($db->num_rows($r) == 0)
		admin_load("Không tồn tại dự án này.","?act=thisinh_list");


$max_file_size	=	80000000;
	$up_dir			=	"../uploads/thisinh/";

	$OK = false;
	
	
	if ($func == "update")
	{
		if (empty($txt_ten))
			$error = "Vui lòng nhập tên.";
		
		else
		{
		$ten_bo_dau=strtolower(lg_string::bo_dau($txt_ten));	
		

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
				
			$db->query("update tgp_thisinh set 
			ten = '".$txt_ten."',
			chieu_cao='".$txt_chieu_cao."',
			can_nang='".$txt_can_nang."',
			so_do='".$txt_so_do."',
			noi_dung='".$txt_noi_dung."',
			ngay_sinh='".$txt_ngay_sinh."',
			lop_truong='".$txt_lop_truong."',
			so_bao_danh='".$txt_sobaodanh."',
			thanh_pho='".$txt_thanhpho."',
			hien_thi='".$txt_hien_thi."'
			where id = '".$id."'");
			
		
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
				
				
				
			admin_load("Đã cập nhật thành công.","?act=thisinh_list");	
			}
		}
	}
	else
	{
		$r	= $db->select("tgp_thisinh","id = '".$id."'");
		while ($row = $db->fetch($r))
		{
			$txt_ten			= $row["ten"];
			$txt_chieu_cao		= $row["chieu_cao"];
			$txt_can_nang		= $row["can_nang"];
			$txt_so_do			= $row["so_do"];
			$txt_noi_dung		= $row["noi_dung"];
			$txt_ngay_sinh		= $row["ngay_sinh"];
			$txt_lop_truong		= $row["lop_truong"];
			$txt_thanhpho		= $row["thanh_pho"];
			$txt_sobaodanh		= $row["so_bao_danh"];
			$photos				= $row["photos"];
			$txt_hien_thi = $row['hien_thi'];
			
		}
	}
	
	if (!$OK)
		template_edit("?act=thisinh_edit","update",$id,$txt_ten,$txt_chieu_cao,$txt_can_nang,$txt_so_do,$txt_noi_dung,$txt_ngay_sinh,$txt_lop_truong,$txt_sobaodanh,$txt_hinh,$txt_thanhpho,$photos,$txt_hien_thi,$error);
?>
</center>