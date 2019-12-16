<?
function	template_edit($url,$func,$id,$txt_ten,$txt_link,$trang_thai,$time,$error)
{
?>
<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="<?=$url?>" enctype="multipart/form-data" method="post" style="margin:0px;" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="func" value="<?=$func?>" />
	<table border="0" cellpadding="2" cellspacing="2" width="700">
	<tr>
		<td width="35%" align="right">Tên : </td>
		<td width="65%" align="left">
			<input type="text" name="txt_ten" value="<?=$txt_ten?>" class="inputbox" style="width:90%" />
		</td>
	</tr>
	<tr>
		<td align="right">Link :</td>
		<td><input type="text" name="txt_link" value="<?=$txt_link?>" class="inputbox" style="width:90%" /></td>
	</tr>
	<tr>
		<td align="right" valign="top">Trạng thái:</td>
		<td align="left">
<input type="radio" name="trang_thai" <?=$trang_thai==0?"checked":""?> value="0" /> Tắt <input type="radio" name="trang_thai" <?=$trang_thai==1?"checked":""?> value="1" /> Mở *
		</td>
	</tr>
	<tr>
		<td width="100%" colspan="2" align="center">
		<input name="submit" type="submit" class="button" style="width:20%;" value="Submit" />
		<input name="submit" type="reset" class="button" style="width:20%;" value="Làm lại" />
		<input type="button" value="Xem DS" class="button" style="width:20%;" onClick="Forward('?act=rss_list');">
		</td>
	</tr>
	</table>
</form>
<?
}
?>