
		<!--script src="js/jquery.lint.js" type="text/javascript" charset="utf-8"></script-->
		<link rel="stylesheet" href="/js/prettyPhoto/css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
		<script src="/js/prettyPhoto/js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>

<div style="position:relative">

<? 
$id=$_GET['id']+0;
if($id==0){?>
<div style="position:absolute; color:#F15E27; font-size:18px; top:-3px; right:235px; " class="cufon_2">Tìm kiếm album :</div>
<div class="tiem_kiem" style="top:-7px;">
			<form onsubmit="load_tiem_kiem(1); return false">
					<div class="tim_1"><input  id="tim_kiem_album" class="tim" type="text" value=""  name="tim_kiem_album"  /></div>
					<div class="search_1"><input class="search" type="submit"  value=""  style="cursor:pointer" /> </div>
			</form>	
				</div>
                
<? }?>

<?

$idp=$_GET['idp']+0;
$page=$_GET['page']+0;
$list_view=$list_daotao;
$link_click='thu-vien-hinh-anh';

if($id==0&&$idp==0){
?>




<div>

		<?

$page		=	$page + 0;
						$perpage	=	8;
						$r_all		=	$db->select("tgp_gallery_menu","cat ='thu_vien_hinh_anh' and hien_thi=1","");
						$sum		=	$db->num_rows($r_all); 
						$pages		=	($sum-($sum%$perpage))/$perpage;
							if ($sum % $perpage <> 0 )
								{
									$pages = $pages + 1;
								}
						$page		=	($page==0)?1:(($page>$pages)?$pages:$page);
						$min 		= 	abs($page-1) * $perpage;
						$max 		= 	$perpage;
				$q	=	$db->select("tgp_gallery_menu","cat ='thu_vien_hinh_anh'  and hien_thi=1","ORDER BY thu_tu  LIMIT ".$min.", ".$max);
	
 ?>

	<div class="tieude_home cufon_2 nd_x"><span><?=(get_cat('thu_vien_hinh_anh'))?></span></div>
	<div class="khung_nd_home" style="padding-top:10px;">
	
	<div class="gallery khung_moi_dung_view" id="load_tiem_kiem" >		
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
									<div class="date">Lượt xem: <?=$r2['luot_xem']?></div>
									<div class="chu_thich_thuvien" <?=$r2['hinh']=='no.jpg'?"style=height:auto":"" ?> ><?=lg_string::crop($r2["chu_thich"],80);?></div>
									<div class="xem_tiep_thuvien" ><a   href="/<?=$link_click?>/<?=$r2['id']?>/<?=lg_string::get_link($r2["ten"])?>" >Chi tiết</a></div>
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
	
	<?=showPageNavigation($page, $pages,'/'.$link_click.'/view/page/') ?>
	</div>
</div>
	<? if($sum==0){?>
	<div class="tieude_home cufon_2 nd_x"><span><?=(get_cat('thu_vien_hinh_anh'))?></span></div>
	<div class="khung_nd_home">
			<div class="khung_chua_noidung" >	
			<div style="text-align:center; font-weight:bold;"> Thông tin đang được cập nhật
Bạn có thể truy cập về<a href="/"> trang chủ </a> </div>
	</div>		
			
			</div>
			
			<? }?>
</div>			
	

<? }else if($id!=0){
include('z_modules/thu_vien_xem_chi_tiet.php');

}  else{?>
<div style="text-align:center; font-weight:bold;">Không tìm thấy đường dẫn này <br>Bạn có thể truy cập vào <a href="/">trang chủ</a></div>
<? }?>

</div>

<script type="text/javascript" charset="utf-8">
			$(document).ready(function(){
				$("area[rel^='prettyPhoto']").prettyPhoto();
				
				$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'pp_default',slideshow:3000, autoplay_slideshow: false});
				$(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
		
				
			});
			</script>