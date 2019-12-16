

<?	
$hien_thi=$_POST['hien_thi'];
$page=$_POST['page'];
$mod=$_POST['mod'];

if($mod=='duan'){

$min=0;
if($page==1){
$min=0;
}else{
$min=abs($page-1)*$hien_thi;

}



 $sqltd=$db->select("tgp_cms","cat=16 and hien_thi=1 and noi_bat=1 ","ORDER BY id DESC LIMIT ".($min).",".($hien_thi)."");
		 while($r2=$db->fetch($sqltd))
		  {
			?>
			<a><div class="itime_duan" style="position:relative"><img src="/uploads/cms/duan_<?=$r2['hinh']?>" />
		<div class="duan_noibat_title"><?=lg_string::crop($r2["ten"],4);?></div></div></a>
		<? }?>
<?		
}else if($mod=='page'){
echo duan_slide($hien_thi,$page);
}	
?>	