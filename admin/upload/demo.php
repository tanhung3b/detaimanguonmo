<?
session_start();
$_SESSION['demo']='sadf';

?>

<link href="/uploadify/uploadify.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="swfobject.js"></script>
<script type="text/javascript" src="jquery.uploadify.v2.1.4.js"></script>
<script type="text/javascript" async="" src="ga.js"></script>

  <script type="text/javascript"> 
				$(function() {
				$('#file_upload').uploadify({

  'uploader'       : 'uploadify.swf',

  'script'         : 'uploadify.php?id=3',

  'cancelImg'      : 'cancel.png',

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




 <div class="demo-box">
        <div id="status-message">3 files uploaded, 0 errors.</div>
<div id="custom-queue" class="uploadifyQueue"></div>
<input id="file_upload" name="file_upload" type="file" />

 </div>
      </div>
      </div>
	  
	      <p>
	        <style type="text/css"> 
        #custom-demo .uploadifyQueueItem {

  background-color: #FFFFFF;

  border: none;

  border-bottom: 1px solid #E5E5E5;

  font: 11px Verdana, Geneva, sans-serif;

  height: 50px;

  margin-top: 0;

  padding: 10px;

  width: 350px;

}

#custom-demo .uploadifyError {

  background-color: #FDE5DD !important;

  border: none !important;

  border-bottom: 1px solid #FBCBBC !important;

}

#custom-demo .uploadifyQueueItem .cancel {

  float: right;

}

#custom-demo .uploadifyQueue .completed {

  color: #C5C5C5;

}

#custom-demo .uploadifyProgress {

  background-color: #E5E5E5;

  margin-top: 10px;

  width: 100%;

}

#custom-demo .uploadifyProgressBar {

  background-color: #0099FF;

  height: 3px;

  width: 1px;

}

#custom-demo #custom-queue {

  border: 1px solid #E5E5E5;

  height: 213px;

margin-bottom: 10px;

  width: 370px;

}				
	      </style>
</p>
	      <p>&nbsp;</p>
	      <p>&nbsp;          </p>
		  
		  <?
		  echo $_SESSION['file1'].'sa'.$_SESSION['demo'];
		  ?>
 