<font size="2" face="Tahoma"><b>Tin tức <img src="images/bl3.gif" border="0" /> Quản lý tin tức</b></font>
<hr size="1" color="#cadadd" />
<div class="function">
<? $r	= $db->select("tgp_cms_menu","id = '".$id."'");
	while ($row = $db->fetch($r))
	{
	if($row['video']==1){
 ?>
	<a href="?act=video_new&txt_cat=<?=$id?>"><img src="images/add_new.gif" align="absmiddle" border="0" /></a> <a href="?act=video_new&txt_cat=<?=$id?>">Đăng bài viết mới</a>
<? 
	}else{ ?>
	<a href="?act=cms_new&txt_cat=<?=$id?>"><img src="images/add_new.gif" align="absmiddle" border="0" /></a> <a href="?act=cms_new&txt_cat=<?=$id?>">Đăng bài viết mới</a>
	<?
	}
}?>	
</div>
<?php
	//	Kiểm tra sự tồn tại của ID
	$id = $id + 0;
	$r	= $db->select("tgp_cms_menu","id = '".$id."'");
	if ($db->num_rows($r) == 0)
		admin_load("Không tồn tại Mục này.","?act=cms_manager");
		
	if ($func == "del")
	{
		for ($i = 0; $i < count($tik); $i++)
		{
			$db->delete("tgp_cms","id = '".$tik[$i]."'");
		}
		admin_load("Đã xóa các Bài viết đã chọn.","?act=cms_list&id=".$id);
		die();
	}
?>
<center>
<form action="?act=cms_list" method="post" onsubmit="return confirm('Bạn có chắc chắn không ?');">
<input type="hidden" name="func" value="del" />
<input type="hidden" name="id" value="<?=$id?>" />
<table class="tb_table" border="0" cellpadding="0" cellspacing="0" width="100%">
<tr class="tb_head">
	<td>STT</td>
	<td>PIC</td>
	<td>Tên bài viết</td>
	<td>Hiển thị</td>
	<td>Nổi bật</td>
	<td>Ngày đăng</td>
	<td>Người đăng</td>
	<td>Chỉnh sửa</td>
	<td>Xóa</td>
</tr>
<?php

$page		=	$page + 0;
$perpage	=	10;
$r_all		=	$db->select("tgp_cms","cat = '".$id."'");
$sum		=	$db->num_rows($r_all);
$pages		=	($sum-($sum%$perpage))/$perpage;
if ($sum % $perpage <> 0 )	$pages = $pages+1;
$page		=	($page==0)?1:(($page>$pages)?$pages:$page);
$min 		= 	abs($page-1) * $perpage;
$max 		= 	$perpage;

$count	=	$min;
$r		=	$db->select("tgp_cms","cat = '".$id."'","order by time desc limit $min, $max");
while ($row = $db->fetch($r))
{
	$count++;
?>
<tr class="tb_content">
	<td><?=$count?></td>
	<td><?=$row["hinh"]!="no.jpg"?"<img src=\"images/true.gif\" />":"<img src=\"images/false.gif\" />"?></td>
	<td><?=$row["ten"]?></td>
	<td><?=$row["hien_thi"]==1?"<img src=\"images/true.gif\" />":"<img src=\"images/false.gif\" />"?></td>
	<td><?=$row["noi_bat"]==1?"<img src=\"images/true.gif\" />":"<img src=\"images/false.gif\" />"?></td>
	<td><?=lg_date::vn_time($row["time"])?></td>
	<td><?=get_user($row["user"],"username")?></td>
	<?  $r2	= $db->select("tgp_cms_menu","id = '".$id."'");
	while ($row2 = $db->fetch($r2))
	{ 
		if($row2['video']==1){
	?>
	<td><a href="?act=video_edit&id=<?=$row["id"]?>">Sửa</a></td>
		<? }else{?>
	<td><a href="?act=cms_edit&id=<?=$row["id"]?>">Sửa</a></td>
	<?
		}
	 }?>
	<td><input name="tik[]" type="checkbox" value="<?=$row["id"]?>" /></td>
</tr>
<?
}
?>
<tr class="tb_foot">
	<td colspan="8" style="text-align:left;">
		<strong>Trang : </strong>
		<?php
			if ($pages==0) echo ":1:";
    		for($i=1;$i<=$pages;$i++) {
    			if ($i==$page) echo "<b>[".$i."]</b>";
    			else {
					echo "<a href='?act=cms_list&id=".$id."&page=$i'>-$i-</a>";
				}
			}
    	?>
	</td>
	<td><input type="submit" value="Xóa" class="button_2" style="width:80%;" /></td>
</tr>
</table>
</table>
</form>
</center>
<div class="function">
<? $r	= $db->select("tgp_cms_menu","id = '".$id."'");
	while ($row = $db->fetch($r))
	{
	if($row['video']==1){
 ?>
	<a href="?act=video_new&txt_cat=<?=$id?>"><img src="images/add_new.gif" align="absmiddle" border="0" /></a> <a href="?act=video_new&txt_cat=<?=$id?>">Đăng bài viết mới</a>
<? 
	}else{ ?>
	<a href="?act=cms_new&txt_cat=<?=$id?>"><img src="images/add_new.gif" align="absmiddle" border="0" /></a> <a href="?act=cms_new&txt_cat=<?=$id?>">Đăng bài viết mới</a>
	<?
	}
}?>	
</div>