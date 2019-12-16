
<div class="tieude_home cufon_2 nd_x"><span><?=(get_sql('select ten from tgp_cms_menu where id='.$id.' '));?></span></div>
	<div class="khung_nd_home">
	<div class="khung_moi_dung_view" >
			

<?
 $sqltd=$db->select("tgp_cms","id=".$idp." and hien_thi=1 and cat in(".$list_view.")   ","ORDER BY id LIMIT 1");
	 				 while($r2=$db->fetch($sqltd))
					  {
					  $cat=$r2['cat'];
					$count1=$r2["luot_xem"];
					  $db->update("tgp_cms","luot_xem",$count1+1,"id = '".$idp."'");
			
				?>
				<div class="tieude_view_ct" > <?=$r2['ten']?></div>
			<div class="date"><?=get_date_tin($r2['time'])?> - Lượt xem: <?=$r2['luot_xem']?></div>
				<div style="font-weight:bold; padding-bottom:10px; padding-top:5px; line-height:20px;" ><?=$r2['chu_thich']?></div>
				
				<div align="justify" style="line-height:20px;"><?=$r2['noi_dung']?></div>
				<? if($r2['photos']!=''){ include('z_includes/slide_hinh_chiitet.php');} ?>
				<div style="clear:both"></div>
				<? }?>

<? 
if($cat+0!=0){
 $sqltd=$db->select("tgp_cms","id<>".$idp." and hien_thi=1 and cat=".$cat." ","ORDER BY time DESC LIMIT 9");
$sum		=	$db->num_rows($sqltd);
if($sum>0){
 ?>
<div style=" margin-top:10px; padding-bottom:20px;">
<div class="tieude_home cufon_2"><span><?=('Các bài viết khác')?></span></div>
	<div style="padding:10px; padding-top:5px; border-top: solid 1px #545454; margin-top:5px; ">
	<?
	
		while($r2=$db->fetch($sqltd))
			{
			$ttk=$ttk+1;
	?>
	<div  class="tin_khac" ><a  href="/<?=$link_click?>/<?=$r2['cat']?>/<?=$r2['id']?>/<?=lg_string::get_link($r2["ten"])?>">&raquo; <?=lg_string::crop($r2["ten"],15);?>  </a> <span style="font-size:10px; color:#666666;">( <?=date('d/m/Y',$r2['time'])?> )</span> </div>
	<?
		}
		?>
	</div>
</div>
<? }
}else{
include('z_includes/no.php');
}
?>

</div>
</div>

 <div style="position:relative;"> 
	<? $link_fb=$link_web.'/tin-tuc/'.$id.'/'.$idp.'/';
							include('z_includes/like_fb.php'); ?>	
                            
               <div ><? include('z_includes/comment_fb.php'); ?></div>	 
                  <? include('z_includes/shear.php'); ?>                                
 </div>  
		            