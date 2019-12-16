<div class="khung_trong">


	<?
			$mod=$_GET['mod'];
			if($mod=='gioi-thieu'){
			 include("z_modules/page/gioi_thieu.php");
			 }else if($mod=='trang-thiet-bi'){
				include("z_modules/page/trang-thiet-bi.php"); 
			 }else if($mod=='lien-he'){
			 include("z_modules/page/lien_he.php"); 
			 }else if($mod=='dich-vu'){
			 include("z_modules/page/dich_vu.php"); 
			 }else if($mod=='huong-dan'){
			 include("z_modules/page/huong_dan.php"); 
			 }else if($mod=='thoi-khoa-bieu'){
			 include("z_modules/page/thoi_khoa_bieu.php"); 
			 }else if($mod=='thanh-tich'){
			 include("z_modules/page/thanh_tich.php"); 
			 }
		?>
</div>