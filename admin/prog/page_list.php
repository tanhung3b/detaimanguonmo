<font size="2" face="Tahoma"><b>Trang nội dung <img src="images/bl3.gif" border="0" /> Quản lý</b></font>
<hr size="1" color="#cadadd" />
<div class="function">
	<a href="?act=page_new"><img src="images/add_new.gif" align="absmiddle" border="0" /></a> <a href="?act=page_new">Thêm trang mới</a>
</div>
<center>
<?php
	if ($func == "del")
	{
		for ($i = 0; $i < count($tik); $i++)
		{
			$db->delete("tgp_page","id = '".$tik[$i]."'");
		}
		admin_load("Đã xóa các Trang thông tin đã chọn.","?act=page_list");
		die();
	}
?>
<form action="?act=page_list" method="post" onsubmit="return confirm('Bạn có chắc chắn không ?');">
<input type="hidden" name="func" value="del" />
<input type="hidden" name="id" value="<?=$id?>" />
<table class="tb_table" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr class="tb_head">
	<td>STT</td>
	<td>Alias</td>
	<td>Tên bài viết</td>
	<td>Lượt xem</td>
	<td>Ngày cập nhật</td>
	<td>Người đăng</td>
	<td>Chỉnh sửa</td>
	<td>Xóa</td>
</tr>
<?php
$r		=	$db->select("tgp_page","","order by alias asc");
while ($row = $db->fetch($r))
{
	$count++;
?>
<tr class="tb_content">
	<td><?=$count?></td>
	<td><?=$row["alias"]?></td>
	<td><?=$row["ten"]?></td>
	<td style="text-align:right;"><?=$row["luot_xem"]?> views</td>
	<td><?=lg_date::vn_time($row["time"])?></td>
	<td><?=get_user($row["user"],"username")?></td>
	<td><a href="?act=page_edit&id=<?=$row["id"]?>">Sửa</a></td>
	<td><input name="tik[]" type="checkbox" value="<?=$row["id"]?>" /></td>
</tr>
<?
}
?>
<tr class="tb_foot">
	<td colspan="7" style="text-align:left;">&nbsp;</td>
	<td><input type="submit" value="Xóa" class="button_2" style="width:80%;" /></td>
</tr>
</table>
</table>
</form>
</center>
<div class="function">
	<a href="?act=page_new"><img src="images/add_new.gif" align="absmiddle" border="0" /></a> <a href="?act=page_new">Thêm trang mới</a>
</div>