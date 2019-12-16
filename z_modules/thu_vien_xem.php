
<div>

		<?

$page		=	$page + 0;
						$perpage	=	8;
						$r_all		=	$db->select("tgp_cms","cat in(".$id.") and hien_thi=1","");
						$sum		=	$db->num_rows($r_all); 
						$pages		=	($sum-($sum%$perpage))/$perpage;
							if ($sum % $perpage <> 0 )
								{
									$pages = $pages + 1;
								}
						$page		=	($page==0)?1:(($page>$pages)?$pages:$page);
						$min 		= 	abs($page-1) * $perpage;
						$max 		= 	$perpage;
				$q	=	$db->select("tgp_cms","cat in(".$id.")  and hien_thi=1","ORDER BY time DESC LIMIT ".$min.", ".$max);
	
	if($sum>1){	 ?>


	<div class="tieude_home cufon_2 nd_x"><span><?=(get_sql('select ten from tgp_cms_menu where id='.$id.' '));?></span></div>
	<div class="khung_moi_dung_view" id="load_tiem_kiem" style="padding-top:10px;">	
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
							<? if($r2['hinh']!='no.jpg'){?>	
								<div class="hinh_tin_thuvien"><a  href="/<?=$link_click?>/<?=$r2['cat']?>/<?=$r2['id']?>/<?=lg_string::get_link($r2["ten"])?>" > <img src="/uploads/cms/thm_<?=$r2['hinh']?>"  /></a></div>
								<? }?>
								<div class="noi_dung_thuvien" <?=$r2['hinh']=='no.jpg'?"style=width:100%;height:auto":"" ?> > 
								<div class="tieude_thuvien "><a  href="/<?=$link_click?>/<?=$r2['cat']?>/<?=$r2['id']?>/<?=lg_string::get_link($r2["ten"])?>" ><?=$r2['ten']?></a></div>
							<div class="date">Lượt xem: <?=$r2['luot_xem']?></div>
									<div class="chu_thich_thuvien" <?=$r2['hinh']=='no.jpg'?"style=height:auto":"" ?> ><?=lg_string::crop($r2["chu_thich"],80);?></div>
									<div class="xem_tiep_thuvien" ><a  href="/<?=$link_click?>/<?=$r2['cat']?>/<?=$r2['id']?>/<?=lg_string::get_link($r2["ten"])?>" >Chi tiết</a></div>
								</div>
							</div>
							
							<div style="clear:both"></div>
						</div>
					</div>
					
			<? }?>
		<div style="clear:both"></div>			   
	</div>
	<?=showPageNavigation($page, $pages,'/'.$link_click.'/'.$id.'/page/') ?>

	<?				
		}else if($sum==1){
			while($r2=$db->fetch($q))
					 	 {
						 $idp=$r2['id'];
						 $id=$r2['cat'];
						 }
			include('z_modules/thu_vien_xem_chi_tiet.php');
	
			}else{?>
		<div class="tieude_home cufon_2 nd_x"><span><?=(get_sql('select ten from tgp_cms_menu where id='.$id.' '));?></span></div>
	<div class="khung_moi_dung_view">	
			<div style="text-align:center; font-weight:bold;"> Thông tin đang được cập nhật
Bạn có thể truy cập về<a href="/"> trang chủ </a> </div>
			</div>
			
			<? }?>
</div>			
	