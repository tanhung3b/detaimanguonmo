<font size="2" face="Tahoma"><b>Tin tức <img src="images/bl3.gif" border="0" /> Sửa mục</b></font>
<hr size="1" color="#cadadd" />
<?php
	include "templates/cms_menu.php";
	if (empty($func)) $func = "";
	$id = $id+0;
	//	Kiểm tra sự tồn tại của ID
	$r	= $db->select("tgp_cms_menu","id = '".$id."'");
	if ($db->num_rows($r) == 0)
		admin_load("Không tồn tại Mục này.","?act=cms_manager");
?>
<center>
<?php
	$OK = false;
	
	if ($func == "update")
	{
		if (empty($txt_ten))
			$error = "Vui lòng nhập Tên mục.";
		else
		{
			$db->query("update tgp_cms_menu set ten = '".$db->escape($txt_ten)."', cat = '".$db->escape($txt_cat)."', hien_thi = '".($txt_hien_thi+0)."', type = '".($txt_type+0)."', noi_bat = '".($txt_noi_bat+0)."',video='".$txt_video."',
				seo_desc = '".$txt_seo_desc."',
				seo_keyword = '".$txt_seo_keyword."', 
				seo_copyright = '".$txt_seo_copyright."',
				 tag = '".$txt_tag."',
				 seo_permalink = '".$txt_seo_permalink."'
			
			 where id = '".$id."'");
			admin_load("Đã cập nhật thành công.","?act=cms_manager");
			$OK = true;
		}
	}
	else
	{
		$r	= $db->select("tgp_cms_menu","id = '".$id."'");
		while ($row = $db->fetch($r))
		{
			$txt_ten		=	$row["ten"];
			$txt_cat		=	$row["cat"];
			$txt_hien_thi	=	$row["hien_thi"];
			$txt_type		=	$row["type"];
			$txt_noi_bat	=	$row["noi_bat"];
			$txt_video		=	$row["video"];
			
			$txt_seo_desc		= $row["seo_desc"];
			$txt_seo_keyword	= $row["seo_keyword"];
			$txt_seo_copyright	= $row["seo_copyright"];
			$txt_tag			= $row["tag"];
			$txt_seo_permalink	= $row['seo_permalink'];
		}
	}
	
	if (!$OK)
		template_edit("?act=cms_menu_edit","update",$id,$txt_cat,$txt_ten,$txt_hien_thi,$txt_type,$txt_noi_bat,$txt_video,$error);
?>
</center>