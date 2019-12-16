<font size="2" face="Tahoma"><b>Tin tức <img src="images/bl3.gif" border="0" /> Thêm mục</b></font>
<hr size="1" color="#cadadd" />
<?
	include "templates/cms_menu.php";
	if (empty($func)) $func = "";
	$txt_cat = $db->escape($txt_cat);
	//	Kiểm tra sự tồn tại của ID
	$r	= $db->select("tgp_cat","id = '".$txt_cat."' and _cms = 1");
	if ($db->num_rows($r) == 0)
		admin_load("Không tồn tại Nhóm này.","?act=cms_manager");
?>
<center>
<?php
	$OK = false;
	
	if ($func == "new")
	{
		if (empty($txt_ten))
			$error = "Vui lòng nhập Tên mục.";
		else
		{
			$db->insert("tgp_cms_menu","id,cat,ten,thu_tu,hien_thi,type,noi_bat,video,seo_desc, seo_keyword, seo_copyright, tag, seo_permalink","0,'".$db->escape($txt_cat)."','".$db->escape($txt_ten)."','".(cat_count($txt_cat)+1)."','".($txt_hien_thi+0)."','".($txt_type+0)."','".($txt_noi_bat+0)."','".$txt_video."','".$txt_seo_desc."', '".$txt_seo_keyword."', '".$txt_seo_copyright."', '".$txt_tag."', '".$txt_seo_permalink."'");
			admin_load("Đã thêm Mục đó vào CSDL","?act=cms_manager");
			$OK = true;
		}
	}
	else
	{
		$txt_ten		=	"";
		$txt_hien_thi	=	1;
	}
	
	if (!$OK)
		template_edit("?act=cms_menu_new","new",0,$txt_cat,$txt_ten,$txt_hien_thi,$txt_type,$txt_noi_bat,$txt_video,$error);
?>
</center>