<div class="phan_slide" style="height:288px;">
<style type="text/css">
#imageSlideshow {
	height:288px;
	}
#imageSlideshow div.slide {
	height:288px;
	}
<? 

			$list_hinhanhchay=0;
				$sqltd=$db->select("tgp_gallery_menu","hien_thi=1 and cat='slide_con' ","ORDER BY thu_tu");
				while($r2=$db->fetch($sqltd))
				  { $list_hinhanhchay=$list_hinhanhchay.','.$r2['id'];
				  }
				  

$sql=$db->select("tgp_gallery"," hien_thi=1 and cat in(".$list_hinhanhchay.") ","ORDER BY id DESC");
 while($r2=$db->fetch($sql))
  {
		  $slide=$slide+1;
		  ?>
#slide-<?=$slide?> {
background: url(/uploads/gal/<?=$r2['hinh']?>) no-repeat center ;
}
<?
	}
?>
</style>

			<script type="text/javascript" src="/js/jquery.cycle.min.js"></script> 
	<script type="text/javascript"> 
				$(function(){		 
					$('#imageSlideshow').cycle({   
						fx:    'fade', 
					
						timeout:5000,
						pause:	true,
						pager: '#nav_slide',
						after:	showInfoPane,						
						next:   '#next-slide', 
	   	 				prev:   '#prev-slide'  
					 });	
					 
					 function showInfoPane(){$(".slide-description-wrapper").fadeIn(100);}					 		
					 
					 $(".close-slide-description").click(function(){$(".slide-description-wrapper").fadeOut(1100);});	
					 
					 $(".close-slide-text").click(function(){
					 	$(".slide-text").fadeOut(1100);
						$(".more-info").attr('id', '');
					 });
					 
					 $(".close-slide-description").hover(function(e){
					 	$(this).append("<div id='small-tooltip'><img src='/images/tooltip-close.png' alt='' /></div>").fadeIn(400);
					 //	$("#small-tooltip").css("left", e.pageX +"px")
					 }, function(){
					 	$("#small-tooltip img").remove();
					 });					 	
					 
					 $(".more-info").hover(function(){
						if($(this).attr("id") !="active"){
					 		$(this).append("<div id='tooltip'><img src='/images/tooltip.png' alt='' /></div>").fadeIn(400);
						}
					 },function(){
					 	$("#tooltip img").remove();
					 });	
					 
					 $(".more-info").click(function(){
						$(this).attr('id', 'active');
					 	$(this).next(".slide-text").fadeIn(1100);
					 });	
					 
					 $('#imageSlideshow, .arrow').hover(function(){
					 	$('#imageSlideshow').cycle('pause');
					 	$(".arrow").fadeIn(100);
					 }, function(){
					 	$('#imageSlideshow').cycle('resume');
					 	$(".arrow").fadeOut(100);
					 });			  
	
				});
			</script> 
			





				
<div style="position:relative">
<div style="width:100%; position:absolute; z-index:1; top:250px; left:0px;">
	<div style="position:relative;width:960px; margin:auto; display:block"> 
		<div id="next-slide" ></div>
		<div id="prev-slide" ></div>
		<div style="clear:both"></div>
	 </div>
</div>

	<div style="width:100%; margin:auto; position:absolute; height:20px; z-index:999; bottom:2px;">		
    
    	
    
     </div>
    
			<div id="imageSlideshow">
				
			
				
	<? $sqltd=$db->select("tgp_gallery"," hien_thi=1 and cat in(".$list_hinhanhchay.")  ","ORDER BY id DESC");
		 while($r2=$db->fetch($sqltd))
		  {
		  $slide1=$slide1+1;
		  ?>
				<div id="slide-<?=$slide1?>" class="slide"> 
					<div class="slide-description-wrapper"> 
						<div class="slide-description"> 
							
							<div class="slide-meta"> 
									
                                  
                                
							</div>
							</div> 
						</div> 
					</div>
					
			<? }?>		
									
		
			</div>	
	
</div>


</div>