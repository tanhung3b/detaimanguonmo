<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
  alert('');
  
}(document, 'script', 'facebook-jssdk'));




</script>

<?
$r		=	$db->select("tgp_camnhan","  ten like'%".$noi_dung."%' ","order by id  ");
while ($r2 = $db->fetch($r))
{
	?>
    		<div class="item_khach_hang">
            	<div class="hinh_khach_hang"><a href="/uploads/khachhang/<?=$r2['hinh']?>" rel="prettyPhoto[gallery<?=$r2['id']?>]"   ><img src="/uploads/khachhang/th_<?=$r2['hinh']?>"  /></a></div>
                <div class="khung_nd_khachhang">
                	<div class="ten_khachhang"><?=$r2['ten']?></div>
                	<div class="phan_nd_kh">
                   			 <?=$r2['noi_dung']?>
                             
                             <div class="xem_tiep"><a onclick="binh_luan(<?=$r2['id']?>);">Bình luận</a></div>
                            <div class="phan_nhon"></div> 
                    </div>
                    <div class="khung_commen_fb" id="comen_fb_<?=$r2['id']?>">
                    	<?
							$link_fb='html://'.$_SERVER['HTTP_HOST'].'/khach-hang/'.$r2['id'].'/';
						 include("z_includes/comment_fb.php"); ?>
                    </div>
                </div>
                <div style="clear:both"></div>
            </div>
            
            <div style="display:none">
                    <?	$photos=$r2['photos'];	
						$note=$r2['note_photos'];	
					$file = explode(";",$photos);
					$file_note = explode(";",$note);
					
						foreach($file as $img)
						{ 
						if($img!="" ){
							$noidung=noidung_vitri_list($img,$photos,$note)
					 ?>
						<a href="/uploads/kh_photos/<?=$img?>" rel="prettyPhoto[gallery<?=$r2['id']?>]" title="<?=trim($noidung)?>"  ></a>
						<? }
						}
						?>
                    </div>
                    
                    
            
<? }?>


<script type="text/javascript" charset="utf-8">
			$(document).ready(function(){
				$("area[rel^='prettyPhoto']").prettyPhoto();
				
				$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'pp_default',slideshow:3000, autoplay_slideshow: false});
				$(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
		
				
			});
			</script>