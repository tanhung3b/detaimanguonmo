
<div style="margin-top:10px; float:left; width:480px;overflow:hidden ">
<?
 $sqltd=$db->select("tgp_cms","id=".$idp." and hien_thi=1  ","ORDER BY id LIMIT 1");
	 				 while($r2=$db->fetch($sqltd))
					  {
					  $cat=$r2['cat'];
					$count1=$r2["luot_xem"];
					  $db->update("tgp_cms","luot_xem",$count1+1,"id = '".$idp."'");
			
				?>
				<div class="title_tin_chitiet"><a> <?=$r2['ten']?></a></div>
				
				<div align="justify"><?=$r2['noi_dung']?></div>
				
				<? }?>
</div>

<div style="float:left; margin-top:10px; width:480px;">
<div class="tin_khac"><a><?=lg_string::u2v('Khách hàng khác')?></a></div>
<?
 $sqltd=$db->select("tgp_cms","id<>".$idp." and hien_thi=1 and cat=".$cat." ","ORDER BY id LIMIT 8");
	 				 while($r2=$db->fetch($sqltd))
					  {
?>
<div class="title_tinkhac"><a href="/du-an-khach-hang/<?=$r2['cat']?>/<?=$r2['id']?>/<?=lg_string::get_link($r2["ten"])?>"><?=lg_string::crop($r2["ten"],15);?></a></div>
<?
}
?>
</div>