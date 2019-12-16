<?
include "../config.php";
$db = new lg_mysql($host,$dbuser,$dbpass,$csdl);
include "kt_admin.php";
include "function.php";

$sql="insert into tgp_upload_tmp (time,tinh_trang) values ('".time()."','2')";
mysql_query($sql);	$tid	=	mysql_insert_id();

?>

<link href="/upload/uploadify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="/upload/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="/upload/swfobject.js"></script>
<script type="text/javascript" src="/upload/jquery.uploadify.v2.1.4.js"></script>
<script type="text/javascript" async="" src="ga.js"></script>

  <script type="text/javascript"> 
				$(function() {
				$('#file_upload').uploadify({

  'uploader'       : '/upload/uploadify.swf',

  'script'         : '/upload/uploadify.php?id=<?=$tid?>',

  'cancelImg'      : '/upload/cancel.png',

  'folder'         : 'uploads',

  'multi'          : true,

  'auto'           : true,

  'fileExt'        : '*.jpg;*.gif;*.png',

  'fileDesc'       : 'Image Files (.JPG, .GIF, .PNG)',

  'queueID'        : 'custom-queue',

  'queueSizeLimit' : 10,

  'simUploadLimit' : 1,

  'removeCompleted': false,

  'onSelectOnce'   : function(event,data) {

      $('#status-message').text(data.filesSelected + ' files have been added to the queue.');

    },

  'onAllComplete'  : function(event,data) {

      $('#status-message').text(data.filesUploaded + ' files uploaded, ' + data.errors + ' errors.');

    }

});				});
				</script> 


Upload Hình
<input value="<?=$tid?>" name="txt_idhinh" style="display:none" > 
 <div class="demo-box">
        <div id="status-message"></div>

<input id="file_upload" name="file_upload" type="file" />

 </div>
      </div>
      </div>
	  

	
 