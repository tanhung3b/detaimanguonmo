
<?
function	template_edit($url,$func,$id,$txt_cat,$txt_ten,$txt_chu_thich,$txt_hinh,$txt_hinh_note,$txt_noi_dung,$txt_hien_thi,$txt_noi_bat,$txt_date,$photos,$error)
{ global $txt_seo_permalink,$txt_seo_desc,$txt_seo_keyword,$txt_seo_copyright,$txt_tag;
?>
<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="<?=$url?>" enctype="multipart/form-data" method="post" style="margin:0px;" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="func" value="<?=$func?>" />
	<table border="0" cellpadding="2" cellspacing="2" width="700">
	<tr>
		<td width="35%" align="right">Tên bài viết : </td>
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
		<td align="right">Hinh note :</td>
		<td align="left">
			<input type="text" name="txt_hinh_note" value="<?=$txt_hinh_note?>" class="inputbox" style="width:90%" />
		</td>
	</tr>
	<tr>
		<td align="right" valign="top">Chú thích :</td>
		<td align="left"><textarea name="txt_chu_thich" class="inputbox" style="width:90%" rows="3"><?=$txt_chu_thich?></textarea></td>
	</tr>
	<tr>
		<td align="right">Giới thiệu :</td>
		<td>&nbsp;</td>
	<tr>
		<td align="left" colspan="2">
			<?php
			if ($txt_cat == 1 && $func == "new") $txt_noi_dung = '';
			include("../fckeditor.php");
			$sBasePath = $_SERVER['PHP_SELF'] ;
			$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "admin" ) ) ;
			
			$oFCKeditor = new FCKeditor('txt_noi_dung') ;
			$oFCKeditor->BasePath	= $sBasePath ;
			$oFCKeditor->Value		= $txt_noi_dung;
			$oFCKeditor->Height		= 300;
			$oFCKeditor->Create() ;
			?>
		</td>
	</tr>

	<tr>
		<td colspan="2" align="center">
	
		<?php
			$file = explode(";",$photos);
			if ( $file[0] != "" )
			{
				foreach($file as $img)
				{
				if($img!=""){
					echo	'<span style="padding:5px; display:block; float:left"><a href="../uploads/cms_photos/'.$img.'" target="_blank"><img width="60" src="../uploads/cms_photos/thm_'.$img.'" border="0" style="border:1px #999999 solid;"></a><br><a href="?act=cms_img_del&id='.$id.'&file='.$img.'">delete</a></span>';
					}
				}
			}
		?>
		</td>
	</tr>
	
<?php 
	if ($func == "update")
	{
?>
	<tr>
		<td colspan="2">
		<center>
<script type="text/javascript">
function startUpload(id, conditional)
{
	if(conditional.value.length != 0) {
		$('#'+id).fileUploadStart();
	} else
		alert("You must enter your name. Before uploading");
}
</script>		
<script type="text/javascript">
$(document).ready(function() {

	$("#fileUploadname2").fileUpload({
		'uploader': 'uploadify/uploader.swf',
		'cancelImg': 'uploadify/cancel.png',
		'script': 'uploadify/uploadify.php',
		'folder': '../uploads/cms_photos',
		'multi': true,
		'removeCompleted':false,
		'scriptData': {'id':'<?=$id?>'}, // If the value is known to php you can also enter it here ie < ?= $value ?> or < ?= $_RESULT['value'] ?>
		onComplete: function (evt, queueID, fileObj, response, data) {
			
		},
		onAllComplete: function () {
			
			window.location.reload();
		}
	});

});
</script>
				<style type="text/css">
				.fileUploadQueueItem {
				font: 11px Verdana, Geneva, sans-serif;
				background-color: #F5F5F5;
				border: 3px solid #E5E5E5;
				margin-top: 5px;
				padding: 10px;
				width: 300px;
				}
				.fileUploadQueueItem .cancel {
				float: right;
				}
				.fileUploadProgress {
				background-color: #FFFFFF;
				border-top: 1px solid #808080;
				border-left: 1px solid #808080;
				border-right: 1px solid #C5C5C5;
				border-bottom: 1px solid #C5C5C5;
				margin-top: 10px;
				width: 100%;
				}
				.fileUploadProgressBar {
				background-color: #0099FF;
				}
				.upload {
				display:block;
				color:#0099FF;
				line-height:30px;
				font-weight:bold;
				text-decoration:none;
				background:url(images/upload.jpg) no-repeat;
				width:120px;
				height:30px;
				margin-top:10px;
				}
							</style>

			<div id="fileUploadname2">You have a problem with your javascript</div>
			<a class="upload" href="javascript:$('#fileUploadname2').fileUploadStart();">Upload Files</a>

</center>

</td>
	</tr>	
<?php
}
?>
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
		<td align="right">Ngày đăng :</td>
		<td align="left">
			<input type="text" name="txt_date" value="<?=$txt_date?>" class="inputbox" style="width:30%" /> (dd/mm/YYYY)
		</td>
	</tr>

	<tr>
		<td width="100%" colspan="2" align="center">
		<input name="submit" type="submit" class="button" style="width:20%;" value="Submit" />
		<input name="submit" type="reset" class="button" style="width:20%;" value="Làm lại" />
		<input type="button" value="Xem DS" class="button" style="width:20%;" onclick="Forward('?act=cms_manager');">
		</td>
	</tr>
	</table>
</form>
<?
}
function	show_cat($name,$id)
{
	global $db;
	
$r2 = $db->select("tgp_cat","_cms = 1","order by thu_tu asc");
?>
<select name="<?=$name?>" class="inputbox" style="width:50%;">
<?php
while ($row2 = $db->fetch($r2))
{
	echo "<optgroup label='".$row2["ten"]."'>";
	$r	=	$db->select("tgp_cms_menu","cat = '".$row2["id"]."'","order by thu_tu asc");
	while ($row = $db->fetch($r))
	{
		echo "<option value='".$row["id"]."'";
		if ($id == $row["id"]) echo " selected ";
		echo ">".$row["ten"]."</option>";
	}
	echo "</optgroup>";
}
?>
</select>
<?php
}
?>