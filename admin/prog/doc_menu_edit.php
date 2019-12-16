<font size="2" face="Tahoma"><b>Tài liệu <img src="images/bl3.gif" border="0" /> Sửa tài liệu</b></font>
<hr size="1" color="#cadadd" />
<?php
	include "templates/doc_menu.php";
	if (empty($func)) $func = "";
	$id = $id+0;
	//	Kiểm tra sự tồn tại của ID
	$r	= $db->select("tgp_doc_menu","id = '".$id."'");
	if ($db->num_rows($r) == 0)
		admin_load("Không tồn tại Mục này.","?act=doc_manager");
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
			$db->query("update tgp_doc_menu set ten = '".$db->escape($txt_ten)."', cat = '".$db->escape($txt_cat)."', hien_thi = '".($txt_hien_thi+0)."' where id = '".$id."'");
			admin_load("Đã cập nhật thành công.","?act=doc_manager");
			$OK = true;
		}
	}
	else
	{
		$r	= $db->select("tgp_doc_menu","id = '".$id."'");
		while ($row = $db->fetch($r))
		{
			$txt_ten		=	$row["ten"];
			$txt_cat		=	$row["cat"];
			$txt_hien_thi	=	$row["hien_thi"];
		}
	}
	
	if (!$OK)
		template_edit("?act=doc_menu_edit","update",$id,$txt_cat,$txt_ten,$txt_hien_thi,$error);
?>
</center>