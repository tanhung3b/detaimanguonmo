<font size="2" face="Tahoma"><b>Danh sách Tour</b></font>
<hr size="1" color="#cadadd" />
<center>
<?php
if ($func == "update")
{
	$db->update("tgp_bien","gia_tri",$txt_tour_vn,"ten = 'tour_list_vn'");
	$db->update("tgp_bien","gia_tri",$txt_tour_ot,"ten = 'tour_list_ot'");
	admin_load("Đã cập nhật danh sách Tour.","?act=tour_list");
}
else
{
	
}
?>
<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="?act=tour_list" enctype="multipart/form-data" method="post" style="margin:0px;" />
	<input type="hidden" name="func" value="update" />
	<table border="0" cellpadding="2" cellspacing="2" width="640">
	<tr>
		<td width="35%" align="right" valign="top">Danh sách Tour trong nước : </td>
		<td width="65%" align="left">
			<textarea name="txt_tour_vn" class="inputbox" style="width:90%" rows="8"><?=get_bien("tour_list_vn")?></textarea>
		</td>
	</tr>
	<tr>
		<td width="35%" align="right" valign="top">Danh sách Tour trong nước : </td>
		<td width="65%" align="left">
			<textarea name="txt_tour_ot" class="inputbox" style="width:90%" rows="8"><?=get_bien("tour_list_ot")?></textarea>
		</td>
	</tr>
	<tr>
		<td colspan="2"></td>
	</tr>
	<tr>
		<td width="100%" colspan="2" align="center">
		<input name="submit" type="submit" class="button" style="width:20%;" value="Submit" />
		<input name="submit" type="reset" class="button" style="width:20%;" value="Làm lại" />
		</td>
	</tr>
	</table>
</form>
</center>