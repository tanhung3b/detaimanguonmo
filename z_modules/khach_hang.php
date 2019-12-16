<div style="position:relative">

<div style="position:absolute; color:#F15E27; font-size:18px; top:-3px; right:245px; " class="cufon_2">Tìm kiếm khách hàng :</div>
<div class="tiem_kiem" style="top:-7px;">
			<form action="/khach-hang/" onsubmit="load_tiem_kiem_kh(1); " method="post" >
					<div class="tim_1"><input  id="tim_kiem_album" class="tim" type="text" value="<?=$_POST['tim_kiem_album']?>"  name="tim_kiem_album"  /></div>
					<div class="search_1"><input class="search" type="submit"  value=""  style="cursor:pointer" /> </div>
			</form>	
				</div>

	<!--script src="js/jquery.lint.js" type="text/javascript" charset="utf-8"></script-->
		<link rel="stylesheet" href="/js/prettyPhoto/css/prettyPhoto.css" type="text/css" media="screen" title="prettyPhoto main stylesheet" charset="utf-8" />
		<script src="/js/prettyPhoto/js/jquery.prettyPhoto.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" charset="utf-8">
			$(document).ready(function(){
				$("area[rel^='prettyPhoto']").prettyPhoto();
				
				$(".gallery:first a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',theme:'pp_default',slideshow:3000, autoplay_slideshow: false});
				$(".gallery:gt(0) a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'fast',slideshow:10000, hideflash: true});
		
				
			});
			</script>

	<div class="tieude_home cufon_2 nd_x" ><span>Khách hàng</span></div>
	<div class="khung_nd_home gallery" id="load_tiem_kiem" style="padding-top:15px;">
    
    <?
    $page		=	$page + 0;
$perpage	=	7;
$r_all		=	$db->select("tgp_camnhan","","order by id ");
$sum		=	$db->num_rows($r_all);
$pages		=	($sum-($sum%$perpage))/$perpage;
if ($sum % $perpage <> 0 )	$pages = $pages+1;
$page		=	($page==0)?1:(($page>$pages)?$pages:$page);
$min 		= 	abs($page-1) * $perpage;
$max 		= 	$perpage;

$count	=	$min;
if($_POST['tim_kiem_album']==''){
$r		=	$db->select("tgp_camnhan","","order by id  limit $min, $max");
}else{
	$r		=	$db->select("tgp_camnhan","  ten like'%".$tim_kiem_album."%' ","order by id  ");
	}
while ($r2 = $db->fetch($r))
{
	?>
    		<div class="item_khach_hang">
            	<div class="hinh_khach_hang"><a href="/uploads/khachhang/<?=$r2['hinh']?>" rel="prettyPhoto[gallery<?=$r2['id']?>]"   ><img src="/uploads/khachhang/th_<?=$r2['hinh']?>"  /></a></div>
                <div class="khung_nd_khachhang">
                	<div class="ten_khachhang"><?=$r2['ten']?></div>
                	<div class="phan_nd_kh">
                   			 <?=$r2['noi_dung']?>
                             
                             <div class="xem_tiep"><a onclick="binh_luan(<?=$r2['id']?>)">Bình luận</a></div>
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
 <div style="clear:both"></div>           
    	<?=showPageNavigation($page, $pages,'/khach-hang/view/page/') ?>
    </div>
    
 </div>   