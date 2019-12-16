<div style="padding-bottom:10px; padding-top:10px;">
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
	</script>

<!--	slide hinh-->
<?
$max=0;
$photos=$r2['photos'];	
			$file = explode(";",$photos);
			if ( $file[0] != "" )
			{
				foreach($file as $img)
				{ 
				if($img!="" ){
				$max=$max+1;
							}
				}
			}	
?>	
<?
 if( $max>0){?>
		<div>
	<link href="/js/slide/amazon_scroller.css" rel="stylesheet" type="text/css"></link>
<script type="text/javascript" src="/js/slide/amazon_scroller.js"></script>	
 <script language="javascript" type="text/javascript">
<?
$max1=$max;
if($max>4){
$max1=4;
}
?>
            $(function() {
               
				$("#amazon_scroller3").amazon_scroller({
                    scroller_title_show: 'disable',
                    scroller_time_interval: '5000',
                    scroller_window_background_color: "none",
                    scroller_window_padding: '0',
                    scroller_border_size: '0',
                    scroller_border_color: 'none',
                    scroller_images_width: '110',
                    scroller_images_height: '92',
                    scroller_title_size: '11',
                    scroller_title_color: 'black',
                    scroller_show_count: '<?=$max1?>',
                    directory: 'images'
                });
            });
        </script>
		<div id="amazon_scroller3" class="amazon_scroller">
				<div class="amazon_scroller_mask">
	
				<ul>	
			<?php
				$photos=$r2['photos'];	
			$file = explode(";",$photos);
			if ( $file[0] != "" )
			{
				foreach($file as $img)
				{
				if($img!="" ){
					echo	' <li><a  rel="example_group" href="/uploads/cms_photos/'.$img.'" title=""> <img src="/uploads/cms_photos/thm_'.$img.'" border="0" style="border:1px #999999 solid;"></a></li>';
					}
				}
			}
		?>
                          </ul>
			</div>
			<? if($max>4){ ?>	
				<ul class="amazon_scroller_nav">
							<li><img  src="/js/slide/ad_scroll_back.png" /></li>
							<li><img  src="/js/slide/ad_scroll_forward.png" /></li>
						</ul>
			<? }?>			
				<div style="clear:both"></div>		
			</div>
	 </div>
<? }?>	 
</div>
	<!--end 	slide hinh-->