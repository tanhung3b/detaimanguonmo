<font size="2" face="Tahoma"><b>Trang RSS <img src="images/bl3.gif" border="0" /> Sửa</b></font>
<hr size="1" color="#cadadd" />
<?php
	include "templates/lienket.php";
	if (empty($func)) $func = "";
?>
<center>
<?php
	//	Kiểm tra sự tồn tại của ID
	$id = $id + 0;
	$r	= $db->select("tgp_lienket","id = '".$id."'");
	if ($db->num_rows($r) == 0)
		admin_load("Không tồn tại RSS này.","?act=lienket_list");

	if ($func == "update")
	{
		if (empty($txt_ten))
			$error = "Vui lòng nhập tên.";
		else if (empty($txt_link))
			$error = "Vui lòng nhập link.";
		else
		{
			$db->query("update tgp_lienket set ten = '".$txt_ten."', link = '".$txt_link."', hien_thi='".$trang_thai."' where id = '".$id."'");
			admin_load("Đã cập nhật thành công.","?act=lienket_list");	
		}
	}
	else
	{
		$r	= $db->select("tgp_lienket","id = '".$id."'");
		while ($row = $db->fetch($r))
		{
			$txt_ten		= $row["ten"];
			$txt_link		= $row["link"];
			$trang_thai		= $row["hien_thi"];
		}
	}
	
	if (!$OK)
		template_edit("?act=lienket_edit","update",$id,$txt_ten,$txt_link,$trang_thai,$time,$error);
?>
</center>