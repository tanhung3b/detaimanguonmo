
<?
$id=$_GET['idp']+0;

$dk='';
if($id!=0){
$dk ='and id='.$idp;
}
  $sql_view=$db->select("tgp_page","alias like 'thanh_tich_%'  ".$dk."","ORDER BY id ASC LIMIT 1");
	 				 while($r2=$db->fetch($sql_view))
					  {
					    get_page($r2['alias']);
						$ten_tieude=$r2['ten'];
						$id=$r2['id'];
						?>
					<div class="tieude_home cufon_2"><span><?=kiem_tra_chu($r2['ten'])?></span></div>
						
						<div class="khung_moi_dung_view">
						
					   <div class="noi_dung_xem" style="padding-top:10px; overflow:hidden; text-align:justify" ><?=$r2['noi_dung']?> </div>
					  </div> 
					  <?
					  }
					  ?>
				  
					  