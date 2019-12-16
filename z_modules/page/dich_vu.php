<?
$id=$_GET['idp']+0;
if($id==0){
?>

<?
$sql_view=$db->select("tgp_page","alias like 'dich_vu_%' ","ORDER BY id ASC ");
	 				 while($r2=$db->fetch($sql_view))
					  {
						    $ttt=$ttt+1;
?>
 <div class="khung_chua_tin_tuc" style="  <?=($ttt%2)==0?"padding-right:0px;padding-left:10px;border-right:none":""?> ">
							<div class="item_tin_tuc" >
							
							<div>
							<? if($r2['hinh']!='no.jpg'){?>	
								<div class="hinh_tin_1"><a  href="/view/dich-vu/<?=$r2['id']?>/<?=lg_string::get_link($r2["ten"])?>" > <img src="/uploads/cms/thp_<?=$r2['hinh']?>"  /></a></div>
								<? }?>
								<div class="noi_dung_ct_tin" <?=$r2['hinh']=='no.jpg'?"style=width:100%;height:auto":"" ?> > 
								<div class="tieude_tin_tuc "><a  href="/view/dich-vu/<?=$r2['id']?>/<?=lg_string::get_link($r2["ten"])?>" ><?=$r2['ten']?></a></div>
							<div class="date">Lượt xem: <?=$r2['luot_xem']?></div>
									<div class="chu_thich" <?=$r2['hinh']=='no.jpg'?"style=height:auto":"" ?> ><?=lg_string::crop($r2["chu_thich"],80);?></div>
									<div class="xem_tiep" ><a  href="/view/dich-vu/<?=$r2['id']?>/<?=lg_string::get_link($r2["ten"])?>" >Xem chi tiết &raquo;</a></div>
								</div>
							</div>
							
							<div style="clear:both"></div>
						</div>
					</div>
<? }?>



<? }else if($id!=0){?>
<div class="tieude_home cufon_2 nd_x"><span>Dịch vụ</span></div>
	<div class="khung_nd_home" style="padding-top:10px;">
<?


$dk='';
if($id!=0){
$dk ='and id='.$idp;
}
  $sql_view=$db->select("tgp_page","alias like 'dich_vu_%'  ".$dk."","ORDER BY id ASC LIMIT 1");
	 				 while($r2=$db->fetch($sql_view))
					  {
					  $idp=$r2['id'];
					    get_page($r2['alias']);
						$ten_tieude=$r2['ten'];
						?>
	<div class="tieude_view_ct"><?=$r2['ten']?></div>
    <div class="date">Lượt xem: <?=$r2['luot_xem']?></div>
<div style="margin-top:5px; padding-top:10px; ">
		
					   <div class="noi_dung_xem" style="overflow:hidden" ><?=$r2['noi_dung']?> </div>
					   
					   <? 
					 $sqltd=$db->select("tgp_page","id<>".$idp." and alias like 'dich_vu_%' ","ORDER BY time DESC LIMIT 8");
					$sum		=	$db->num_rows($sqltd);
					if($sum>0){
					 ?>
					<div style=" margin-top:20px; padding-bottom:20px;">
					<div class="tieude_home cufon_2">Dịch vụ khác</div>
					<div style="padding:10px; padding-top:5px; border-top: solid 1px #545454; margin-top:5px; ">
						<?
						
											 while($r2=$db->fetch($sqltd))
											  {
						?>
						<div class="tin_khac"><a href="/view/dich-vu/<?=$r2['id']?>/<?=lg_string::get_link($r2["ten"])?>">&raquo; <?=lg_string::crop($r2["ten"],15);?></a></div>
						<?
						}
						?>
						</div>
					</div>
					<? }?>					  
					
					
	   
					   
</div>					
					  <?
					  }
					  ?>
				  
					  
</div>
 <div style="position:relative;"> 
	<? $link_fb=$link_web.'/view/dich-vu/'.$idp.'/';
							include('z_includes/like_fb.php'); ?>	
                            
               <div ><? include('z_includes/comment_fb.php'); ?></div>	
               
      <? include('z_includes/shear.php'); ?>                                
 </div>  
					
  <? }?>        
  
  
            