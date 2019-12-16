<font size="2" face="Tahoma"><b>Cảm nhận<img src="images/bl3.gif" border="0" /> Quản lý</b></font>
<hr size="1" color="#cadadd" />
<div class="function">
	<a href="?act=camnhan_new"><img src="images/add_new.gif" align="absmiddle" border="0" /></a> <a href="?act=camnhan_new">Thêm Cảm nhận mới</a>
</div>
<center>
<?php
	if ($xoa == "Xóa")
	{
		for ($i = 0; $i < count($tik); $i++)
		{
			$db->delete("tgp_camnhan","id = '".$tik[$i]."'");
		}
		admin_load("Đã xóa các dự án đã chọn.","?act=camnhan_list");
		die();
	}


	
	
?>


<form action="?act=camnhan_list" method="post" onsubmit="return confirm('Bạn có chắc chắn không ?');">
<input type="hidden" name="func" value="del" />
<input type="hidden" name="id" value="<?=$id?>" />
<table class="tb_table" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr class="tb_head">
	<td width="13%" align="left">STT</td>
	<td width="45%" align="left" style="text-align:left;" >Nội dung </td>
	<td width="8%" align="left" style="text-align:left;" >Hiển thị </td>
	<td width="11%" align="left">Chỉnh sửa</td>
	<td width="14%" align="left">Xóa</td>
</tr>
<?php


$page		=	$page + 0;
$perpage	=	50;
$r_all		=	$db->select("tgp_camnhan","","order by id ");
$sum		=	$db->num_rows($r_all);
$pages		=	($sum-($sum%$perpage))/$perpage;
if ($sum % $perpage <> 0 )	$pages = $pages+1;
$page		=	($page==0)?1:(($page>$pages)?$pages:$page);
$min 		= 	abs($page-1) * $perpage;
$max 		= 	$perpage;

$count	=	$min;
$r		=	$db->select("tgp_camnhan","","order by id  limit $min, $max");
while ($row = $db->fetch($r))
{
	$count++;
?>
<tr class="tb_content">
	<td><?=$count?></td>
	<td align="center" style="text-align:left;"><?=$row["noi_dung"]?></td>
	<td align="center" style="text-align:left;"><?=$row["hien_thi"]==1?"<img src=\"images/true.gif\" />":"<img src=\"images/false.gif\" />"?></td>
	<td><a href="?act=camnhan_edit&id=<?=$row["id"]?>">Sửa</a></td>
	<td><input name="tik[]" type="checkbox" value="<?=$row["id"]?>" /></td>
</tr>
<?
}
?>
<tr class="tb_foot">
	<td colspan="2" style="text-align:left;">
		<strong>Trang : </strong>
		<?php
			if ($pages==0) echo ":1:";
    		for($i=1;$i<=$pages;$i++) {
    			if ($i==$page) echo "<b>[".$i."]</b>";
    			else {
					echo "<a href='?act=camnhan_list&page=$i'>-$i-</a>";
				}
			}
    	?>	</td>
	<td style="text-align:left;">&nbsp;</td>
	<td style="text-align:left;">&nbsp;</td>
	<td><input type="submit" value="Xóa" name="xoa" class="button_2" style="width:80%;" /></td>
</tr>
</table>
</form>
</center>
<div class="function">
	<a href="?act=camnhan_new"><img src="images/add_new.gif" align="absmiddle" border="0" /></a> <a href="?act=camnhan_new">Thêm Cảm nhận mới</a>
</div>
