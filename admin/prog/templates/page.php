<?
function	template_edit($url,$func,$id,$txt_alias,$txt_ten,$txt_noi_dung,$txt_chu_thich,$txt_hinh,$error)
{global $txt_seo_permalink,$txt_seo_desc,$txt_seo_keyword,$txt_seo_copyright,$txt_tag;
?>
<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="<?=$url?>" enctype="multipart/form-data" method="post" style="margin:0px;" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="func" value="<?=$func?>" />
	<table border="0" cellpadding="2" cellspacing="2" width="700">
	<tr>
		<td align="right" valign="top">Alias :</td>
		<td align="left">
			<input type="text" name="txt_alias" value="<?=$txt_alias?>" class="inputbox" style="width:90%" />		</td>
	</tr>
	<tr>
		<td width="35%" align="right">Tên trang : </td>
		<td width="65%" align="left">
			<input type="text" name="txt_ten" value="<?=$txt_ten?>" class="inputbox" style="width:90%" />		</td>
	</tr>
	<tr>
		<td align="right">Hình ảnh :</td>
		<td align="left"><input type="file" name="txt_hinh" class="inputbox" style="width:90%;" /></td>
	</tr>
	<tr>
	  <td width="35%" align="right">Chú thích : </td>
	  <td align="left"><label>
	    <textarea class="inputbox" style="width:90%; height:50px;"  name="txt_chu_thich"><?=$txt_chu_thich?></textarea>
	  </label></td>
	  </tr>
	<tr>
		<td align="right">Nội dung :</td>
		<td>&nbsp;</td>
	<tr>
		<td align="left" colspan="2">
			<?php
			include("../fckeditor.php");
			$sBasePath = $_SERVER['PHP_SELF'] ;
			$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "admin" ) ) ;
			
			$oFCKeditor = new FCKeditor('txt_noi_dung') ;
			$oFCKeditor->BasePath	= $sBasePath ;
			$oFCKeditor->Value		= $txt_noi_dung;
			$oFCKeditor->Height		= 300;
			$oFCKeditor->Create() ;
			?>		</td>
	</tr>
    <tr>
	  <td align="right"><b>All in one SEO pack :</b></td>
	  <td align="left"> (Nếu bạn không nhập những thông tin bên dưới. Chúng tôi sẽ tự động sinh những thông tin này dựa theo bài viết) </td>
	  </tr>
	<tr>
	  <td align="right"> Permalink: </td>
	  <td align="left"><input type="text" name="txt_seo_permalink" value="<?=$txt_seo_permalink?>" class="inputbox" style="width:90%" /></td>
	  </tr>
	<tr>
	  <td align="right"> Description: </td>
	  <td align="left"><input type="text" name="txt_seo_desc" value="<?=$txt_seo_desc?>" class="inputbox" style="width:90%" /></td>
	  </tr>
	<tr>
	  <td align="right"> Keyword: </td>
	  <td align="left"><input type="text" name="txt_seo_keyword" value="<?=$txt_seo_keyword?>" class="inputbox" style="width:90%" /></td>
	  </tr>
	<tr>
	  <td align="right"> Copyright: </td>
	  <td align="left"><input type="text" name="txt_seo_copyright" value="<?=$txt_seo_copyright?>" class="inputbox" style="width:90%" /></td>
	  </tr>
	<tr>
	  <td align="right"> Tags: </td>
	  <td align="left"><input type="text" name="txt_tag" value="<?=$txt_tag?>" class="inputbox" style="width:90%" /></td>
	  </tr>
	<tr>
	<tr>
		<td colspan="2"></td>
	</tr>
    
	<tr>
		<td width="100%" colspan="2" align="center">
		<input name="submit" type="submit" class="button" style="width:20%;" value="Submit" />
		<input name="submit" type="reset" class="button" style="width:20%;" value="Làm lại" />
		<input type="button" value="Xem DS" class="button" style="width:20%;" onClick="Forward('?act=page_list');">		</td>
	</tr>
	</table>
</form>
<?
}
?>