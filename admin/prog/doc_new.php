<font size="2" face="Tahoma"><b>Tài liệu <img src="images/bl3.gif" border="0" /> Thêm tài liệu</b></font>
<hr size="1" color="#cadadd" />
<?php
	include "templates/doc.php";
	if (empty($func)) $func = "";
	
	$txt_gia = '0';
?>
<center>
<?php
	$max_file_size	=	2048000;
	$up_dir			=	"../uploads/doc/";

	$OK = false;
	
	if ($func == "new")
	{
		if (empty($txt_ten))
			$error = "Vui lòng nhập tên tài liệu.";
		else if (empty($txt_chu_thich))
			$error = "Vui lòng nhập sơ lược về tài liệu.";
		else
		{
			// kiểm tra file uploads.
			$file_type = $HTTP_POST_FILES['txt_file']['type'];
			$file_name = $HTTP_POST_FILES['txt_file']['name'];
			$file_size = $HTTP_POST_FILES['txt_file']['size'];
			
			$allowedTypes = array(
				'application/msword'			=>	'doc',
				'application/excel'				=>	'xls',
				'application/vnd.ms-powerpoint'	=>	'ppt',

				'application/vnd.openxmlformats-officedocument.wordprocessingml.document'	=>	'docx',
				'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'			=>	'xlsx',
				'application/vnd.openxmlformats-officedocument.presentationml.presentation'	=>	'pptx',
				
				'application/download'			=>	'zip',
				'application/x-zip-compressed'	=>	'zip',
				'application/zip'				=>	'zip',
				'application/x-rar-compressed'	=>	'rar',
				'application/pdf'				=>	'pdf',
				
			);
			
			if (array_key_exists($file_type, $allowedTypes) && strtolower(lg_file::getExt($file_name)) == $allowedTypes[$file_type])
			{
				$file_type = $allowedTypes[$file_type];
			}
			else
			{
				$file_type = 'unk';
			}
			
			
			
			$file_full_name = "tmp_".time().".".$file_type;
			
			$file = false;
			
			if ( ($file_size > 0) && ($file_size <= $max_file_size) )
			{
				if ($file_type != "unk")
				{
						if ( @move_uploaded_file($HTTP_POST_FILES['txt_file']['tmp_name'],$up_dir.$file_full_name) )
						{
							$OK = true;
							$file = true;
						}
						else
							$error = "Không thể upload tài liệu.";
				}
				else
				{
					$error = "Sai định dạng file - Không thể upload tài liệu.";
				}
			}
			else
			{
				if ($file_size == 0)
				{
					$OK		= true;
					$file	= false;
				}
				else
				{
					$error = "File của bạn chọn vượt quá kích thước cho phép.";
				}
			}
			// Process xong
			if ($OK)
			{
				$id = $db->insert("tgp_doc","id,cat,ten,chu_thich,noi_dung,gia,hien_thi,noi_bat,time,user,file_size","0,'".($txt_cat+0)."','".$db->escape($txt_ten)."','".$txt_chu_thich."','".$txt_noi_dung."','".$txt_gia."','".($txt_hien_thi+0)."','".($txt_noi_bat+0)."','".time()."','".$thanh_vien["id"]."', '".$file_size."'");
				
				if ($file)
				{
					$txt_file_2	= $id.".".$file_type;
					@rename($up_dir.$file_full_name,$up_dir.$txt_file_2);
					//img_resize($up_dir.$file_full_name,$up_dir.$txt_file_2,"w=640");
					$db->update("tgp_doc","file",$txt_file_2,"id = '".$id."'");
				}
				
				admin_load("Đã thêm Tài liệu vào CSDL","?act=doc_list&id=".($txt_cat+0));
			}
		}
	}
	else
	{
		$txt_ten		= "";
		$txt_chu_thich	= "";
		$txt_file_note	= "";
		$txt_noi_dung	= "";
		$txt_gia		= 0;
		$txt_hien_thi	= 1;
		$txt_noi_bat	= 0;
	}
	
	if (!$OK)
		template_edit("?act=doc_new", "new", 0 , $txt_cat,$txt_ten,$txt_chu_thich,$txt_file,$txt_noi_dung,$txt_gia,$txt_hien_thi,$txt_noi_bat,$error)
?>
</center>