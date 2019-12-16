<font size="2" face="Tahoma"><b>Đối tác <img src="images/bl3.gif" border="0" /> Sửa thông tin</b></font>
<hr size="1" color="#cadadd" />
<?php
	include "templates/doitac.php";
	if (empty($func)) $func = "";
?>
<center>
<?php
$max_file_size	=	8048000;
	$up_dir			=	"../uploads/doitac/";

	$OK = false;
	
	//	Kiểm tra sự tồn tại của ID
	$id = $id + 0;
	$r	= $db->select("tgp_doitac","id = '".$id."'");
	if ($db->num_rows($r) == 0)
		admin_load("Không tồn tại trang này.","?act=doitac_manager");

	if ($func == "update")
	{
		if (empty($txt_ten))
			$error = "Vui lòng nhập tên thành phố.";
		else
		{
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
				
			if ($OK)
			{
			
			$db->query("update tgp_doitac set ten = '".$db->escape($txt_ten)."', hien_thi = '".($txt_hien_thi+0)."', link='".$txt_link."',time='".time()."',gioi_thieu='".$txt_gioi_thieu."',loai='".$txt_loai."' where id = '".$id."'");
			
			if ($hinh)
				{
				if($file_type=='png'){
						
						$txt_hinh_2	= "doitac_".$id.".".$file_type;
						img_png_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_2,"h=70&w=150&zc=1");
					}else{
						
						$txt_hinh_2	= "doitac_".$id.".".$file_type;
						img_resize($up_dir.$file_full_name,$up_dir.$txt_hinh_2,"h=70&w=150&zc=1");
					}
					
					
					$txt_hinh_2	= $id.".".$file_type;
					$db->update("tgp_doitac","hinh",$txt_hinh_2,"id = '".$id."'");
				}
				
				admin_load("Đã cập nhập thông vào CSDL","?act=doitac_manager");
			}	
		}
	}
	else
	{
		$r	= $db->select("tgp_doitac","id = '".$id."'");
		while ($row = $db->fetch($r))
		{
			$txt_ten		= $row["ten"];
			$txt_hien_thi 	= $row["hien_thi"];
			$txt_link		=$row["link"];
			$txt_hinh	=$row["hinh"];
			$txt_gioi_thieu =$row['gioi_thieu'];
			$txt_loai   =$row['loai'];
		}
	}
	
	if (!$OK)
		template_edit("?act=doitac_edit","update",$id,$txt_ten,$txt_hien_thi,$txt_link,$txt_hinh,$txt_gioi_thieu,$txt_loai,$error);
?>
</center>