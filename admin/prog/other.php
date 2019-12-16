<font size="2" face="Tahoma"><b>Liên kết hữu ích</b></font>
<hr size="1" color="#cadadd" />
<center>
<?php

if ($func == "update")
{
	$db->update("tgp_bien","gia_tri",$txt_title,"ten = 'title'");
	$db->update("tgp_bien","gia_tri",$txt_email,"ten = 'email'");
	$db->update("tgp_bien","gia_tri",$txt_lien_ket,"ten = 'lien_ket'");
	admin_load("Đã cập nhật các thông tin khác.","?act=other");
}
else
{
	
}
?>
<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="?act=other" enctype="multipart/form-data" method="post" style="margin:0px;" />
	<input type="hidden" name="func" value="update" />
	<table border="0" cellpadding="2" cellspacing="2" width="640">
	<tr>
		<td width="35%" align="right" valign="top">Tiêu đề trang web: </td>
		<td width="65%" align="left">
        	<input type="text" name="txt_title" class="inputbox" style="width:90%" value="<?=get_bien("title")?>"></input>
		</td>
	</tr>
    <tr>
		<td width="35%" align="right" valign="top">Email liên hệ: </td>
		<td width="65%" align="left">
        	<input type="text" name="txt_email" class="inputbox" style="width:90%" value="<?=get_bien("email")?>"></input>
		</td>
	</tr>
    <tr>
        <td width="35%" align="right" valign="top">Liên kết: </td>
        <td width="65%" align="left">
            <textarea name="txt_lien_ket" class="inputbox" style="width:90%" rows="8"><?=get_bien("lien_ket")?></textarea>
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
