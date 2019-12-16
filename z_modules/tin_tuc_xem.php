
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
	<div class="khung_moi_dung_view">	
	<? 				 while($r2=$db->fetch($q))
					  {
					 
					  $ttt=$ttt+1;
					  ?>
						 <div class="khung_chua_tin_tuc" style="  <?=($ttt%2)==0?"padding-right:0px;padding-left:10px;border-right:none":""?> ">
							<div class="item_tin_tuc" >
							
							<div>
							<? if($r2['hinh']!='no.jpg'){?>	
								<div class="hinh_tin_1"><a  href="/<?=$link_click?>/<?=$r2['cat']?>/<?=$r2['id']?>/<?=lg_string::get_link($r2["ten"])?>" > <img src="/uploads/cms/th_<?=$r2['hinh']?>"  /></a></div>
								<? }?>
								<div class="noi_dung_ct_tin" <?=$r2['hinh']=='no.jpg'?"style=width:100%;height:auto":"" ?> > 
								<div class="tieude_tin_tuc "><a  href="/<?=$link_click?>/<?=$r2['cat']?>/<?=$r2['id']?>/<?=lg_string::get_link($r2["ten"])?>" ><?=$r2['ten']?></a></div>
							<div class="date"><?=get_date_tin($r2['time'])?> - Lượt xem: <?=$r2['luot_xem']?></div>
									<div class="chu_thich" <?=$r2['hinh']=='no.jpg'?"style=height:auto":"" ?> ><?=lg_string::crop($r2["chu_thich"],80);?></div>
									<div class="xem_tiep" ><a  href="/<?=$link_click?>/<?=$r2['cat']?>/<?=$r2['id']?>/<?=lg_string::get_link($r2["ten"])?>" >Xem chi tiết &raquo;</a></div>
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
			include('z_modules/tin_tuc_xem_chi_tiet.php');
	
			}else{?>
		<div class="tieude_home cufon_2 nd_x"><span><?=(get_sql('select ten from tgp_cms_menu where id='.$id.' '));?></span></div>
	<div class="khung_moi_dung_view">	
			<div style="text-align:center; font-weight:bold;"> Thông tin đang được cập nhật
Bạn có thể truy cập về<a href="/"> trang chủ </a> </div>
			</div>
			
			<? }?>
</div>			
	