<?php
function	template_edit($url,$func,$id,$txt_cat,$txt_ten,$txt_hinh,$txt_dia_chi,$txt_gioi_thieu,$txt_hien_thi,$txt_noi_bat,$error)
{
?>
<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="<?=$url?>" enctype="multipart/form-data" method="post" style="margin:0px;" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="func" value="<?=$func?>" />
	<table border="0" cellpadding="2" cellspacing="2" width="700">
	<tr>
		<td width="35%" align="right">Tiêu đề : </td>
		<td width="65%" align="left">
			<input type="text" name="txt_ten" value="<?=$txt_ten?>" class="inputbox" style="width:90%" />
		</td>
	</tr>
	<tr>
		<td align="right">Nhóm :</td>
		<td align="left">
			<? show_cat("txt_cat",$txt_cat); ?>
		</td>
	</tr>
	<tr>
		<td align="right">Hình ảnh :</td>
		<td align="left"><input type="file" name="txt_hinh" class="inputbox" style="width:90%;" /></td>
	</tr>
	<tr>
		<td align="right" valign="top">Địa chỉ liên kết :</td>
		<td align="left">
			<input type="text" name="txt_dia_chi" value="<?=$txt_dia_chi?>" class="inputbox" style="width:90%" />
		</td>
	</tr>
	<tr>
		<td align="right" valign="top">Giới thiệu sơ lược :</td>
		<td align="left"><textarea name="txt_gioi_thieu" class="inputbox" style="width:90%" rows="6"><?=$txt_gioi_thieu?></textarea></td>
	</tr>
	<tr>
		<td align="right">
			Hiển thị :
		</td>
		<td align="left">
			<input name="txt_hien_thi" type="radio" value="0" <?=$txt_hien_thi==0?"checked":""?> /> Tắt
			<input name="txt_hien_thi" type="radio" value="1" <?=$txt_hien_thi==1?"checked":""?> /> Mở *
		</td>
	</tr>
	<tr>
		<td align="right">
			Nổi bật :
		</td>
		<td align="left">
			<input name="txt_noi_bat" type="radio" value="0" <?=$txt_noi_bat==0?"checked":""?> /> Tắt
			<input name="txt_noi_bat" type="radio" value="1" <?=$txt_noi_bat==1?"checked":""?> /> Mở *
		</td>
	</tr>
	<tr>
		<td colspan="2"></td>
	</tr>
	<tr>
		<td width="100%" colspan="2" align="center">
		<input name="submit" type="submit" class="button" style="width:20%;" value="Submit" />
		<input name="submit" type="reset" class="button" style="width:20%;" value="Làm lại" />
		<input type="button" value="Xem DS" class="button" style="width:20%;" onclick="Forward('?act=cus_manager');">
		</td>
	</tr>
	</table>
</form>
<?
}
function	show_cat($name,$id)
{
	global $db;
	
?>
<select name="<?=$name?>" class="inputbox" style="width:50%;">
<?php
	$r	=	$db->select("tgp_customers_cat","","order by thu_tu asc");
	while ($row = $db->fetch($r))
	{
		echo "<option value='".$row["id"]."'";
		if ($id == $row["id"]) echo " selected ";
		echo ">".$row["ten"]."</option>";
	}
?>
</select>
<?php
}
function	get_cat($id,$type)
{
	global $db;
	$r = $db->select("tgp_customers_cat","id = '".$id."'");
	while ($row = $db->fetch($r))
	{
		return $row[$type];
	}
	return "Unknown";
}
?>