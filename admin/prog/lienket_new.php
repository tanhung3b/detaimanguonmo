<font size="2" face="Tahoma"><b>Trang RSS <img src="images/bl3.gif" border="0" /> Thêm link</b></font>
<hr size="1" color="#cadadd" />
<?php
	include "templates/lienket.php";
	if (empty($func)) $func = "";
?>
<center>
<?php
	if ($func == "new")
	{
		if (empty($txt_ten))
			$error = "Vui lòng nhập tên.";
		else if (empty($txt_link))
			$error = "Vui lòng nhập link.";
		else
		{
			$id = $db->insert("tgp_lienket","id,ten,link,hien_thi","0,'".$txt_ten."','".$txt_link."',".$trang_thai."");
			admin_load("Đã thêm Trang vào CSDL","?act=lienket_list");
		}
	}
	else
	{
		$id = 0;
		$txt_ten		= "";
		$txt_noi_dung	= "";
		$trang_thai		= "1";
	}
	
	if (!$OK)
		template_edit("?act=lienket_new","new",$id,$txt_ten,$txt_link,$trang_thai,$time,$error)
?>
</center>