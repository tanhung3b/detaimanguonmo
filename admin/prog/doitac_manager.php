<font size="2" face="Tahoma"><b>Thông tin <img src="images/bl3.gif" border="0" /> Quản lý đối tác</b></font>
<hr size="1" color="#cadadd" />
<div class="function">
	<a href="?act=doitac_new"><img src="images/add_new.gif" align="absmiddle" border="0" /></a> <a href="?act=doitac_new">Đăng bài viết mới</a>
</div>
<?php
	$delete = $delete + 0;
	if ($delete != 0)
	{
	
		$db->delete("tgp_doitac","id = '".$delete."'");
		admin_load("Đã xóa thành công.","?act=doitac_manager");
	}
	if ($func == "sort")
	{
		$r	=	$db->select("tgp_doitac");
		while ($row = $db->fetch($r))
		{
			$id = $row["id"];
			$db->update("tgp_doitac","thu_tu",$order__[$id],"id = '".$id."'");
			
		}
		//admin_load("Đã sắp xếp thành công.","?act=doitac_manager");
	}
?>
<form action="?act=doitac_manager" method="post">
<input type="hidden" name="func" value="sort" />

<table class="tb_table" width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr class="tb_head">
    <td>Tên</td>
    <td>Loại</td>
    <td>Sắp xếp </td>
    <td>hình</td>
	<td>Hiển thị</td>
	<td>Sửa</td>
    <td>Xóa</td>
    </tr>
<?php
	$r2	=	$db->select("tgp_doitac","","order by thu_tu asc");
	while ($row2 = $db->fetch($r2))
	{
?>
  <tr class="tb_content">
    <td style="text-align:justify;padding-left:20px"> <?=$row2["ten"]?> </td>
    <td style="text-align:justify;padding-left:20px"><?=$row2["loai"]==1?"Tài trợ tiêu biểu":"Nhà tài trợ khác"?></td>
    <td ><?=show_order("order__[".$row2["id"]."]",$db->num_rows($r2),$row2["thu_tu"],"80%",0);?></td>
    <td align="center" style="text-align:center;"><img src="../uploads/doitac/doitac_<?=$row2["hinh"]?>" height="50" /></td>
	<td><?=$row2["hien_thi"]==1?"<img src=\"images/true.gif\" />":"<img src=\"images/false.gif\" />"?></td>
	<td><a href="?act=doitac_edit&id=<?=$row2["id"]?>">Sửa</a></td>
    <td><a href="?act=doitac_manager&delete=<?=$row2["id"]?>" onclick="return confirm('Tất cả bài viết sẽ bị mất hết\nBạn có chắc chắn không ?');">Xóa</a></td>
    </tr>
<?php
	}
?>
<tr>
	<td colspan="2">
	<div class="function">
		<a href="?act=doitac_new"><img src="images/add_new.gif" align="absmiddle" border="0" /></a> <a href="?act=doitac_new">Đăng bài viết mới</a>	</div>	</td>
	<td><input type="submit" value="Sắp xếp" class="button_2" style="width:80%;" /></td>
	<td>&nbsp;</td>
	<td style="text-align:right;">&nbsp;</td>
	<td></td>
	<td></td>
	</tr>
</table>
</form>