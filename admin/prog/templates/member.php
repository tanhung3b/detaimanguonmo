<?
function	template_edit($url, $func, $id,$txt_username,$txt_email,$txt_ten,$txt_dien_thoai,$txt_dia_chi,$txt_level,$txt_trang_thai,$error)
{
?>
<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="<?=$url?>" enctype="multipart/form-data" method="post" style="margin:0px;" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="func" value="<?=$func?>" />
	<table border="0" cellpadding="2" cellspacing="2" width="700">
	<tr>
		<td width="35%" align="right">Tên đăng nhập : </td>
		<td width="65%" align="left"><input type="text" name="txt_username" <?=$func=="update"?"readonly=\"readonly\"":""?> value="<?=$txt_username?>" class="inputbox" style="width:90%" /></td>
	</tr>
	<tr>
		<td align="right">Mật khẩu mới : </td>
		<td align="left"><input type="password" name="txt_password" class="inputbox" style="width:90%" /></td>
	</tr>
	<tr>
		<td align="right">Xác nhận mật khẩu : </td>
		<td align="left"><input type="password" name="txt_password2" class="inputbox" style="width:90%" /></td>
	</tr>
	<tr>
		<td colspan="2"></td>
	</tr>
	<tr>
		<td align="right">Email : </td>
		<td align="left"><input type="text" name="txt_email" value="<?=$txt_email?>" class="inputbox" style="width:90%" /></td>
	</tr>
	<tr>
		<td align="right">Họ & Tên : </td>
		<td align="left"><input type="text" name="txt_ten" value="<?=$txt_ten?>" class="inputbox" style="width:90%" /></td>
	</tr>
	<tr>
		<td align="right">Điện thoại : </td>
		<td align="left"><input type="text" name="txt_dien_thoai" value="<?=$txt_dien_thoai?>" class="inputbox" style="width:90%" /></td>
	</tr>
	<tr>
		<td align="right">Địa chỉ : </td>
		<td align="left"><input type="text" name="txt_dia_chi" value="<?=$txt_dia_chi?>" class="inputbox" style="width:90%" /></td>
	</tr>
	<tr>
		<td colspan="2"></td>
	</tr>
	<tr>
		<td align="right">
			Quyền Admin :
		</td>
		<td align="left">
			<input name="txt_level" type="radio" value="0" <?=$txt_level==0?"checked":""?> /> Admin
			<input name="txt_level" type="radio" value="1" <?=$txt_level==1?"checked":""?> /> Mods
			<input name="txt_level" type="radio" value="2" <?=$txt_level==2?"checked":""?> /> Member
		</td>
	</tr>
	<tr>
		<td align="right">
			Active :
		</td>
		<td align="left">
			<input name="txt_trang_thai" type="radio" value="0" <?=$txt_trang_thai==0?"checked":""?> /> Tắt
			<input name="txt_trang_thai" type="radio" value="1" <?=$txt_trang_thai==1?"checked":""?> /> Mở *
		</td>
	</tr>
	<tr>
		<td colspan="2"></td>
	</tr>
	<tr>
		<td width="100%" colspan="2" align="center">
		<input name="submit" type="submit" class="button" style="width:20%;" value="Submit" />
		<input name="submit" type="reset" class="button" style="width:20%;" value="Làm lại" />
		<input type="button" value="Xem DS" class="button" style="width:20%;" onclick="Forward('?act=member_list');">
		</td>
	</tr>
	</table>
</form>
<?
}
?>