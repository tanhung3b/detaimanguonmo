<font size="2" face="Tahoma"><b>Tài liệu <img src="images/bl3.gif" border="0" /> Thêm tài liệu</b></font>
<hr size="1" color="#cadadd" />
<?php
	include "templates/doc.php";
	if (empty($func)) $func = "";
?>
<center>
<?php
	//	Kiểm tra sự tồn tại của ID
	$id = $id + 0;
	$r	= $db->select("tgp_doc","id = '".$id."'");
	if ($db->num_rows($r) == 0)
		admin_load("Không tồn tại tài liệu này.","?act=doc_manager");
	
	$max_file_size	=	2048000;
	$up_dir			=	"../uploads/doc/";

	$OK = false;
	
	$txt_gia		= '0';
	
	if ($func == "update")
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
				if ($file_type != "unk")
						if ( @move_uploaded_file($HTTP_POST_FILES['txt_file']['tmp_name'],$up_dir.$file_full_name) )
						{
							$OK = true;
							$file = true;
						}
						else
							$error = "Không thể upload tài liệu.";
				else
				{
					$error = "Sai định dạng file - Không thể upload tài liệu.";
				}
			else
			{
				if ($file_size == 0)
				{
					$OK		= true;
					$file	= false;
				}
				else
					$error = "Hình của bạn chọn vượt quá kích thước cho phép.";
			}
			// Process xong
			if ($OK)
			{
				$db->query("update tgp_doc set cat = '".$db->escape($txt_cat)."', ten = '".$db->escape($txt_ten)."', chu_thich = '".$txt_chu_thich."', noi_dung = '".$txt_noi_dung."', gia = '".$txt_gia."' , hien_thi = '".($txt_hien_thi+0)."' , noi_bat = '".($txt_noi_bat+0)."' where id = '".$id."'");
				if ($file)
				{
					$txt_file_2	= $id.".".$file_type;
					//img_resize($up_dir.$file_full_name,$up_dir.$txt_file_2,"w=640");
					if (file_exists($up_dir.$txt_file_2))
					{
						@unlink($up_dir.$txt_file_2);
					}
					@rename($up_dir.$file_full_name,$up_dir.$txt_file_2);
					
					//$db->update("tgp_doc","file",$txt_file_2,"id = '".$id."'");
					$db->query('UPDATE tgp_doc SET file = "'.$txt_file_2.'", file_size = "'.$file_size.'"');
				}
				admin_load("Đã cập nhật thành công.","?act=doc_list&id=".($txt_cat+0));
			}			
		}
	}
	else
	{
		$r	= $db->select("tgp_doc","id = '".$id."'");
		while ($row = $db->fetch($r))
		{
			$txt_cat		= $row["cat"];
			$txt_ten		= $row["ten"];
			$txt_chu_thich	= $row["chu_thich"];
			$txt_file_note	= $row["hinh_note"];
			$txt_noi_dung	= $row["noi_dung"];
			//$txt_gia		= $row["gia"];
			$txt_gia		= '0';
			$txt_hien_thi	= $row["hien_thi"];
			$txt_noi_bat	= $row["noi_bat"];
		}
	}
	
	if (!$OK)
		template_edit("?act=doc_edit","update",$id,$txt_cat,$txt_ten,$txt_chu_thich,$txt_file,$txt_noi_dung,$txt_gia,$txt_hien_thi,$txt_noi_bat,$error)
?>
</center>