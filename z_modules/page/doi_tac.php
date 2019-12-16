<div class="tieude_home cufon_2 nd_x"><span><?=kiem_tra_chu('Đối tác khách hàng')?></span></div>
<div class="nha_tai_tro_xem">
<? $q	=	$db->select("tgp_doitac","hien_thi=1 ","ORDER BY thu_tu DESC  "); 
			while($r2=$db->fetch($q))
							  {	
			?>
				<a href="<?=$r2['link']?>" target="_blank"><img src="/uploads/doitac/doitac_<?=$r2['hinh']?>"> </a>
			
			<? }?>
		<div style="clear:both"></div>	
</div>			