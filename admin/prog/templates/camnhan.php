<?
function	template_edit($url,$func,$id,$txt_ten,$txt_hien_thi,$txt_noi_dung,$txt_chu_thich,$error)
{ global $photos,$note_photos;
?>
<?=$error!=""?"<div align=center style='color:#990000;'><strong>".$error."</strong></div>":""?>
<form name="frm_edit" id="frm_edit" action="<?=$url?>" enctype="multipart/form-data" method="post" style="margin:0px;" />
<input type="hidden" name="id" value="<?=$id?>" />
<input type="hidden" name="func" value="<?=$func?>" />
	<table border="0" cellpadding="2" cellspacing="2" width="700">
	  <tr>
        <td align="right">Tên: </td>
	    <td align="left"><input type="text" name="txt_ten" value="<?=$txt_ten?>" class="inputbox" style="width:90%" />
        </td>
      </tr>
	  <tr>
	    <td align="right">Hình ảnh :</td>
	    <td align="left"><input type="file" name="txt_hinh" class="inputbox" style="width:90%;" /></td>
      </tr>
	  <tr style="display:none">
	    <td align="right" valign="top">Chú thích :</td>
	    <td align="left"><textarea name="txt_chu_thich" class="inputbox" style="width:90%" rows="3"><?=$txt_chu_thich?>
        </textarea></td>
      </tr>
	<tr>
      <td width="31%" align="right">Nội dung:</td>
	  <td>&nbsp;</td>
	  </tr>
	<tr>
      <td align="left" colspan="2"><?php
			if ($txt_cat == 1 && $func == "new") $txt_noi_dung = '';
			include("../fckeditor.php");
			$sBasePath = $_SERVER['PHP_SELF'] ;
			$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "admin" ) ) ;
			
			$oFCKeditor = new FCKeditor('txt_noi_dung') ;
			$oFCKeditor->BasePath	= $sBasePath ;
			$oFCKeditor->Value		= $txt_noi_dung;
			$oFCKeditor->Height		= 300;
			$oFCKeditor->Create() ;
			?>      </td>
	  </tr>
      
      
	<tr>
		<td colspan="2" align="center" style="position:relative;">
        <style>
        .khung_note{ position:absolute; left:30%; top:0px; background:#CCC; border:solid 2px #999; padding:10px; text-align:left; display:none }
        </style>
			<div class="khung_note" id="khung_note">
            	
            </div>
    
		<?php
			$file = explode(";",$photos);
			$noto = explode(";",$note_photos);
			if ( $file[0] != "" )
			{
				foreach($file as $img)
				{
				if($img!=""){
					echo	'<span style="padding:5px; display:block; float:left"><a href="../uploads/kh_photos/'.$img.'" target="_blank"><img width="100" src="../uploads/kh_photos/thm_'.$img.'" border="0" style="border:1px #999999 solid;"></a><br><a onclick="them_note('.$id.',\''.$img.'\')"  >Note</a> <a href="?act=ks_img_del&id='.$id.'&file='.$img.'">delete</a></span>';
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
		<td colspan="2"  >
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
		'script': 'uploadify/uploadify_kh.php',
		'folder': '../uploads/kh_photos',
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
			<a  class="upload" href="javascript:$('#fileUploadname2').fileUploadStart();">Upload Files</a>

</center>

</td>
	</tr>	
<?php
}
?>

	<tr>
      <td align="right"> Hiển thị : </td>
	  <td align="left"><input name="txt_hien_thi" type="radio" value="0" <?=$txt_hien_thi==0?"checked":""?> />
	    Tắt
	    <input name="txt_hien_thi" type="radio" value="1" <?=$txt_hien_thi==1?"checked":""?> />
	    Mở * </td>
	  </tr>
	<tr>
		<td colspan="2" align="center">
		<input name="submit" type="submit" class="button" style="width:20%;" value="Lưu" />
		<input name="submit" type="reset" class="button" style="width:20%;" value="Làm lại" />
		<input type="button" value="Xem DS" class="button" style="width:20%;" onClick="Forward('?act=camnhan_list');">		</td>
	</tr>
	</table>
</form>
<?
}
?>