<div style="width:899px; margin:auto">
<link rel="stylesheet" type="text/css" href="/js/jquery.ad-gallery/jquery.ad-gallery.css">
  <script type="text/javascript">
		$(document).ready(function() {
		

			$("a[rel=example_group]").fancybox({
				'transitionIn'	:	'elastic',
					'transitionOut'	:	'elastic',
					'speedIn'		:	600, 
					'speedOut'		:	200, 
				'titlePosition' 	: 'over',
				'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
				}
			});

		
		});
		function load_lai(){
		$("a[rel=example_group]").fancybox({
				'transitionIn'	:	'elastic',
					'transitionOut'	:	'elastic',
					'speedIn'		:	600, 
					'speedOut'		:	200, 
				'titlePosition' 	: 'over',
				'titleFormat'		: function(alt, currentArray, currentIndex, currentOpts) {
					return '<span id="fancybox-title-over">' + (alt.length ? ' &nbsp; ' + alt : '') + '</span>';
				}
			});
		}
	</script>


  <script type="text/javascript" src="/js/jquery.ad-gallery/jquery.ad-gallery.js"></script>
  <script type="text/javascript">
  $(function() {
    
    var galleries = $('.ad-gallery').adGallery();
    
        galleries[0].settings.effect = "fade";
       
	
    $('#toggle-slideshow').click(
      function() {
        galleries[0].slideshow.toggle();
        return false;
      }
    );
    $('#toggle-description').click(
      function() {
        if(!galleries[0].settings.description_wrapper) {
          galleries[0].settings.description_wrapper = $('#descriptions');
        } else {
          galleries[0].settings.description_wrapper = false;
        }
        return false;
      }
    );
  });
  </script>

  <style type="text/css">


  #descriptions {
    position: relative;
    height: 50px;
    background: #EEE;
    margin-top: 10px;
    width: 640px;
    padding: 10px;
    overflow: hidden;
  }
    #descriptions .ad-image-description {
      position: absolute;
    }
      #descriptions .ad-image-description .ad-description-title {
        display: block;
      }
  </style>
 <div id="container" style="margin-bottom:20px; position:relative; padding-top:10px;">

	
    <div id="gallery" class="ad-gallery">
      <div class="ad-image-wrapper">
      <div class="ad-next" style="height: 400px; "><div class="ad-next-image" style="opacity: 0.7;display:none  "></div></div>
      </div>

      <div class="ad-nav">
        <div class="ad-thumbs">
          <ul class="ad-thumb-list">
		  	<?php
			
			 $q	=	$db->select("tgp_gallery","hien_thi=1 and cat =".$r2['id']." ","ORDER BY time DESC  ");
	while($r3=$db->fetch($q))
			 {
				 $img=$r3['hinh'];
					echo	' <li><a rel="example_group"  href="/uploads/gal/'.$img.'" title="'.trim($r3['chu_thich']).'"> <img alt="'.trim($r3['chu_thich']).'"  width="150" longdesc="/uploads/gal/'.$img.'"  src="/uploads/gal/thm_'.$img.'" border="0" class="image'.$i.'" ></a></li>';
			
			}
		?>
		  
	
			
          </ul>
        </div>
      </div>
    </div>

	
   
  </div>
	
  
  </div>