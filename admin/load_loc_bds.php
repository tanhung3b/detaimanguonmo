<?php
session_start();
@error_reporting(0);
@set_time_limit(0);

include "kt_login.php";
include "../config.php";
$db = new lg_mysql($host,$dbuser,$dbpass,$csdl);
include "kt_admin.php";
include "function.php";
if ($da_dang_nhap)
{


?>
<table border="0" cellpadding="0" cellspacing="0" class="tb_table" width="100%">

<?php

$page		=	$page + 0;
$perpage	=	20;
$r_all		=	$db->select("tgp_bds","");
$sum		=	$db->num_rows($r_all);
$pages		=	($sum-($sum%$perpage))/$perpage;
if ($sum % $perpage <> 0 )	$pages = $pages+1;
$page		=	($page==0)?1:(($page>$pages)?$pages:$page);
$min 		= 	abs($page-1) * $perpage;
$max 		= 	$perpage;

$count	=	$min;
$r		=	$db->select("tgp_bds","","order by id desc limit $min, $max");
while ($row = $db->fetch($r))
{
	$count++;
?>

<tr class="tb_content">
	<td style="width:30px;"><?=$count?></td>
	<td style="width:40px;"><?=select_hinh_avata($row["id_list_hinh"])!=""?"<img src=\"images/true.gif\" />":"<img src=\"images/false.gif\" />"?></td>
	<td><?=$row["ten"]?><? if($row["status"]==0){ echo "<b style='color:#F00'> ( Mới đăng)</b>";}else if($row["status"]==2){
	echo "<b style='color:#F00'> ( Mới cập nhập)</b>";
	}?></td>
	<td style="width:80px;"><?=$row["hien_thi"]==1?"<img src=\"images/true.gif\" />":"<img src=\"images/false.gif\" />"?></td>
	<? $cauhinh='Miễn phí'; if($row["cau_hinh"]==1){ $cauhinh='Đặc biệt';}
	else{ 
	if($row["cau_hinh"]==2){ $cauhinh='VIP'; }
	else{ 
	if($row["cau_hinh"]==3){ $cauhinh='Bình thường'; }
	}
	
	 }?>
	<td align="center" style="width:100px;"><?=$cauhinh?></td>
	<td align="center" style="width:120px;"><? if($row["time_exp"]< time()){echo '<b style="color:#F00">Hết hạn</b>';}else{ echo get_time_bds($row["time_exp"]); } ?></td>
	<td align="center" style="width:120px;"><?=lg_date::vn_time($row["time_bat_dau"])?></td>
	<td align="center" style="width:100px;"><?=get_user($row["user_id"],"username")?></td>
	<td align="center" style="width:60px;"><a href="?act=bds_edit&id=<?=$row["id"]?>&txt_cat=<?=$row["theloai_bds"] ?>">Sửa</a></td>
	<td align="center" style="width:40px"><input name="tik[]" type="checkbox" value="<?=$row["id"]?>" /></td>
<!--    <td><a href="?act=bds_gallery_list&id=<?=$row["id"]?>"><img src="images/go_right.gif" border="0" /></a></td>-->
</tr>
<?
}
?>

<tr class="tb_foot">
	<td colspan="9" style="text-align:left;">
		<strong>Trang : </strong>
		<?php
			if ($pages==0) echo ":1:";
    		for($i=1;$i<=$pages;$i++) {
    			if ($i==$page) echo "<b>[".$i."]</b>";
    			else {
					echo "<a href='?act=bds_list&id=".$id."&page=$i'>-$i-</a>";
				}
			}
    	?>	</td>
	<td><input type="submit" value="Xóa" class="button_2" style="width:80%;" /></td>
</tr>
</table>
<?
}
else	include "login.php";
?>