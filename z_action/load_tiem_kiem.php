<?


				$q	=	$db->select("tgp_gallery_menu","cat ='thu_vien_hinh_anh'  and hien_thi=1 and ten like'%".$noi_dung."%' ","ORDER BY thu_tu DESC");
	
	 ?>


	<? 				 
	$dem=0;
	while($r2=$db->fetch($q))
					  {
					 $dem++;
					  $ttt=$ttt+1;
					  if($dem==5){
						  echo '<div class="phan_cach"></div>';
						  }
					  ?>
                      
					 <div class="khung_chua_thuvien" style=" <? if($ttt==4){ echo 'padding-right:0px;'; $ttt=0;}?> ">
							<div class="item_thuvien" >
							
							<div>
							
								<div class="hinh_tin_thuvien"><a id="act_click<?=$r2['id']?>"  href="/uploads/album/<?=$r2['hinh']?>" rel="prettyPhoto[gallery<?=$r2['id']?>]" title="<?=trim($r2['chu_thich'])?>" > <img src="/uploads/album/thm_<?=$r2['hinh']?>"  /></a></div>
								
								
								<div class="noi_dung_thuvien" <?=$r2['hinh']=='no.jpg'?"style=width:100%;height:auto":"" ?> > 
								<div class="tieude_thuvien "><a onclick="$('#act_click<?=$r2['id']?>').click(); "  ><?=$r2['ten']?></a></div>
							
									<div class="chu_thich_thuvien" <?=$r2['hinh']=='no.jpg'?"style=height:auto":"" ?> ><?=lg_string::crop($r2["chu_thich"],80);?></div>
									<div class="xem_tiep_thuvien" ><a  onclick="$('#act_click<?=$r2['id']?>').click(); ">Chi tiết</a></div>
								</div>
							</div>
							
							<div style="clear:both"></div>
						</div>
					</div>
					
					<div style="display:none">
                    <?	$q3	=	$db->select("tgp_gallery","cat ='".$r2['id']."'  and hien_thi=1","ORDER BY time ");
					while($r3=$db->fetch($q3))
									  {
					 ?>
						<a href="/uploads/gal/<?=$r3['hinh']?>" rel="prettyPhoto[gallery<?=$r2['id']?>]" title="<?=trim($r3['chu_thich'])?>"  ></a>
						<? }?>
                    </div>
					
			<? }?>
		<div style="clear:both"></div>			   
	
<script type="text/javascript" charset="utf-8">
			$(document).ready(function(){
				$("area[rel^='prettyPhoto']").prettyPhoto();
				
				$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'pp_default',slideshow:3000, autoplay_slideshow: false});
				$(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
		
				
			});
			</script>