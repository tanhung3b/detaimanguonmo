<font size="2" face="Tahoma"><b>Tài liệu <img src="images/bl3.gif" border="0" /> Thêm tài liệu</b></font>
<hr size="1" color="#cadadd" />
<?
	include "templates/doc_menu.php";
	if (empty($func)) $func = "";
	$txt_cat = $db->escape($txt_cat);
	//	Kiểm tra sự tồn tại của ID
	$r	= $db->select("tgp_cat","id = '".$txt_cat."' and _doc = 1");
	if ($db->num_rows($r) == 0)
		admin_load("Không tồn tại Nhóm này.","?act=doc_manager");
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
			$db->insert("tgp_doc_menu","id,cat,ten,thu_tu,hien_thi","0,'".$db->escape($txt_cat)."','".$db->escape($txt_ten)."','".(cat_count($txt_cat)+1)."','".($txt_hien_thi+0)."'");
			admin_load("Đã thêm Mục đó vào CSDL","?act=doc_manager");
			$OK = true;
		}
	}
	else
	{
		$txt_ten		=	"";
		$txt_hien_thi	=	1;
	}
	
	if (!$OK)
		template_edit("?act=doc_menu_new","new",0,$txt_cat,$txt_ten,$txt_hien_thi,$error);
?>
</center>