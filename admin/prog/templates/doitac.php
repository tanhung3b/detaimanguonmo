<?
function	template_edit($url,$func,$id,$txt_ten,$txt_hien_thi,$txt_link,$txt_hinh,$txt_gioi_thieu,$txt_loai,$error)
{
?>
<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="<?=$url?>" enctype="multipart/form-data" method="post" style="margin:0px;" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="func" value="<?=$func?>" />
	<table border="0" cellpadding="2" cellspacing="2" width="700">
	<tr>
		<td width="33%" align="right">Tên đối tác: </td>
		<td width="67%" align="left">
			<input type="text" name="txt_ten" value="<?=$txt_ten?>" class="inputbox" style="width:50%" />		</td>
	</tr>
    <tr>
      <td align="right">Hinh: </td>
      <td align="left"><input type="file"  name="txt_hinh" class="inputbox" style="width:50%" /></td>
    </tr>
    <tr>
      <td align="right">Link: </td>
      <td align="left"><input name="txt_link" type="text" class="inputbox" id="txt_link" style="width:50%" value="<?=$txt_link?>" /></td>
    </tr>
    <tr>
      <td align="right" valign="top">Giới thiệu:</td>
      <td align="left"><textarea name="txt_gioi_thieu" class="inputbox"  style="width:50%; height:150px" ><?=$txt_gioi_thieu?></textarea></td>
    </tr>
    <tr>
      <td align="right"> Hiển thị : </td>
      <td align="left"><input name="txt_hien_thi" type="radio" value="0" <?=$txt_hien_thi==0?"checked":""?> />
        Tắt
        <input name="txt_hien_thi" type="radio" value="1" <?=$txt_hien_thi==1?"checked":""?> />
        Mở * </td>
    </tr>
    <tr>
      <td align="right"> Loại : </td>
      <td align="left"><input name="txt_loai" type="radio" value="0" <?=$txt_loai==0?"checked":""?> />
        Nhà tài trợ khác
<input name="txt_loai" type="radio" value="1" <?=$txt_loai==1?"checked":""?> />
 Tài trợ tiêu biểu</td>
    </tr>	
    <tr>
		<td colspan="2" align="center">
		<input name="submit" type="submit" class="button" style="width:20%;" value="Submit" />
		<input name="submit" type="reset" class="button" style="width:20%;" value="Làm lại" />
		<input type="button" value="Xem DS" class="button" style="width:20%;" onClick="Forward('?act=doitac_manager');">		</td>
	</tr>
	</table>
</form>
<?
}
?>