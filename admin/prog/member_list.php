<font size="2" face="Tahoma"><b>Danh sách Thành viên</b></font>
<hr size="1" color="#cadadd" />
<div class="function">
	<a href="?act=member_new"><img src="images/add_new.gif" align="absmiddle" border="0" /></a> <a href="?act=member_new">Thêm mới</a>
</div>
<?
	if ($func == "del")
	{
		for ($i = 0; $i < count($tik); $i++)
		{
			$db->delete("tgp_user","id = '".$tik[$i]."'");
		}
		admin_load("Đã xóa các Username đã chọn.","?act=member_list");
		die();
	}
?>
<form action="?act=member_list" method="post" onsubmit="return confirm('Bạn có chắc chắn không ?');">
<input type="hidden" name="func" value="del" />
<table class="tb_table" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr class="tb_head">
	<td>STT</td>
	<td>Người dùng</td>
	<td>Họ tên</td>
	<td>Ngày lập</td>
	<td>Trạng thái</td>
	<td>Site Level</td>
	<td>Chỉnh sửa</td>
	<td>Xóa</td>
</tr>
<?
$level_arr	=	array("Administrator","Moderator","Member");

$count	=	0;
$r		=	$db->select("tgp_user","","order by username asc");
while ($row = $db->fetch($r))
{
	$dem++;
?>
<tr class="tb_content">
	<td><?=$dem?></td>
	<td><?=$row["username"]?></td>
	<td><?=$row["ten"]?></td>
	<td><?=lg_date::vn_time($row["time"])?></td>
	<td><?=$row["trang_thai"]==1?"<img src=\"images/true.gif\" />":"<img src=\"images/false.gif\" />"?></td>
	<td><?=$level_arr[$row["level"]]?></td>
	<td><a href="?act=member_edit&id=<?=$row["id"]?>">Sửa</a></td>
	<td><input name="tik[]" type="checkbox" value="<?=$row["id"]?>" /></td>
</tr>
<?
}
?>
<tr class="tb_foot">
	<td colspan="7">&nbsp;</td>
	<td><input type="submit" value="Xóa" class="button_2" style="width:80%;" /></td>
</tr>
</table>
</form>
<div class="function">
	<a href="?act=member_new"><img src="images/add_new.gif" align="absmiddle" border="0" /></a> <a href="?act=member_new">Thêm mới</a>
</div>