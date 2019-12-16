<?php
@session_start();

include("config.php");
$db		=	new	lg_mysql($host,$dbuser,$dbpass,$csdl);
include("func.php");

$THANHVIEN["id"] = 0;
include("z_includes/dem_online.php");

if (empty($act)) $act = "home";
if ( !in_array($act, array(
		'home','thuc_don','tin_tuc','khach_hang','view','thu_vien_hinh_anh','page_xem','duan_khachhang','tim_kiem'
	) ) ) 
{
	$act = "home";
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include "z_includes/_html_head.php"; ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>
<div>
<?php include "z_includes/menu.php"; ?>



<?
	if($act=='home'){
		include "z_includes/slide.php"; 
		
		include "z_modules/home.php";
		}else{
			include "z_includes/slide_con.php"; 
			
			include "z_modules/home2.php";
			}
?>

<?php include "z_includes/doi_tac.php"; ?>
<!--copyright hoang gia-->
<div class="copyright">
	<div class="copyright_hg">
	<table width="100%" border="0"  cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top" width="470"><div class="hoang_gia">
		<div style="padding:1px;">
		<?= get_page('copyrgiht')?>
		
			
			</div>
		</div></td>
        <td align="left" valign="top"><div><?=demonline()?></div></td>
	  <td align="left" valign="top"><div style="float:right ;width:135px; ">
			<div>
				<div style="margin-right:2px; text-align:right">Powered (+) Designed</div>
				<div style="color:#FFFFFF; text-align:right"><strong><a href="http://tgp.vn" target="_blank" style="color:#fff; " >THE GIOI <span style="color:#ff6600;">PHANG</span> Ltd.</a></strong></div>
			</div>
		</div></td>
  </tr>
</table>
	</div>
	

</div>
<!--copyright hoang gia-->


</div>
<div id="loading_result"></div>

</body>
</html>