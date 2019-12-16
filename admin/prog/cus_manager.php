<font size="2" face="Tahoma"><b>Khách hàng <img src="images/bl3.gif" border="0" /> Quản lý khách hàng</b></font>
<hr size="1" color="#cadadd" />
<div class="function">
	<a href="?act=cus_new"><img src="images/add_new.gif" align="absmiddle" border="0" /></a> <a href="?act=cus_new">Thêm khách hàng mới</a>
</div>
<?php
	include "templates/cus.php";
	if (!empty($delete))
	{
		$db->delete("tgp_customers","id = '".$delete."'");
		admin_load("Đã xóa khách hàng đó ra khỏi CSDL.","?act=cus_manager");
	}
?>
<table class="tb_table" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr class="tb_head">
    <td>STT</td>
    <td>Hình ảnh</td>
    <td>Vị trí</td>
	<td>Liên kết</td>
	<td>Hiển thị</td>
	<td>Nổi bật</td>
    <td>Sửa</td>
    <td>Xóa</td>
  </tr>
<?php
$dem = 0;
$r	=	$db->select("tgp_customers","","order by cat asc");
while ($row = $db->fetch($r))
{
	$dem++;
?>
  <tr class="tb_content">
    <td><b>#<?=$dem?></b></td>
    <td><img alt="Xem phong to" border="0" src="../uploads/cus/<?=$row["hinh"]?>" width="100" height="50" vspace="2" style="cursor:hand"></td>
    <td><img src="images/left_arrow.gif" /><br /><?=get_cat($row["cat"],"ten")?></td>
	<td style="text-align:left;"><b><img src="images/bl3.gif" /> <?=$row["ten"]?></b><br /><?=$row["dia_chi"]?></td>
    <td><?=$row["hien_thi"]==1?"<img src=\"images/true.gif\" />":"<img src=\"images/false.gif\" />"?></td>
    <td><?=$row["noi_bat"]==1?"<img src=\"images/true.gif\" />":"<img src=\"images/false.gif\" />"?></td>
    <td><a href="?act=cus_edit&id=<?=$row["id"]?>">Sửa</a></td>
    <td><a href="?act=cus_manager&delete=<?=$row["id"]?>">Xóa</a></td>
  </tr>
<?php
}
?>
</table>
<div class="function">
	<a href="?act=cus_new"><img src="images/add_new.gif" align="absmiddle" border="0" /></a> <a href="?act=cus_new">Thêm khách hàng mới</a>
</div>