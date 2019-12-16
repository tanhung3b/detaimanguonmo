
<font size="2" face="Tahoma"><b>Tin tức <img src="images/bl3.gif" border="0" /> Thêm bài viết</b></font>
<hr size="1" color="#cadadd" />
<?php
	include "templates/cms.php";
	if (empty($func)) $func = "";
?>
<center>
<?php
	$max_file_size	=	10000000;
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
				$time = strtotime(str_replace("/","-",$txt_date));
			
				$id = $db->insert("tgp_cms","id,cat,ten,chu_thich,hinh_note,noi_dung,photos,hien_thi,noi_bat,time,user,seo_desc, seo_keyword, seo_copyright, tag, seo_permalink","0,'".($txt_cat+0)."','".str_replace("\\","",$db->escape($txt_ten))."','".$txt_chu_thich."','".$db->escape($txt_hinh_note)."','".$txt_noi_dung."','','".($txt_hien_thi+0)."','".($txt_noi_bat+0)."','".$time."','".$thanh_vien["id"]."','".$txt_seo_desc."', '".$txt_seo_keyword."', '".$txt_seo_copyright."', '".$txt_tag."', '".$txt_seo_permalink."'");
				if ($hinh)
				{
				
					$txt_hinh_3	= "th_".$id.".".$file_type;
					img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_3,"h=150&w=200&zc=1");
					
					$txt_hinh_1	= "thm_".$id.".".$file_type;
					img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_1,"h=146&w=225&zc=1");
				
					$txt_hinh_2	= $id.".".$file_type;
				
					
					img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_2,"");
					
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
		$photos			= "";
		$txt_date		= lg_date::vn_other(time(),"d/m/Y");
			
		$r2	=	$db->select("tgp_cms_menu","id = '".$txt_cat."'","order by thu_tu asc");
		while ($row2 = $db->fetch($r2))
			{
				if($row2['cat']=='thu_vien_hinh_anh')
				{
					$error = "Chú ý: Bạn tạo mới Album sau đó edit để úp hình ảnh.";	
				}
			}

	}
	
	if (!$OK)
		template_edit("?act=cms_new", "new", 0 , $txt_cat,$txt_ten,$txt_chu_thich,$txt_hinh,$txt_hinh_note,$txt_noi_dung,$txt_hien_thi,$txt_noi_bat,$txt_date,$photos,$error)
?>
</center>