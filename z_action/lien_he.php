
<? 
if($_POST['mod']=='new'){
?>
<div style="background:#FFFFFF; float:left;border:solid 2px #da251c;">
<div style="padding:5px;">
<div class="tin_tuc_2"><a><?=lg_string::u2v('Công ty TNHH MTV Công Nghệ Số Trương Hoàng Gia')?></a></div>
</div>
<div style="padding-left:10px; padding-right:10px; margin:auto">
		<div style="margin-top:7px;"><?=get_page('from_lien_he'); ?></div>
		<div style="color:#da251c; font-weight:bold; height:20px; line-height:10px;" id="ket_qua_lh"> </div>
		<div style="padding-left:20px">
	<form  method="post" onsubmit="return show_lienhe_sent(this)">	
		<div class="input_lienhe">
		  <label >T&ecirc;n quý khách: (*)</label>
		  <input name="name" type="text" maxlength="64" value="" id="name" />
		</div>
		<div class="input_lienhe">
		  <label >Số điện thoại </label>
		  <input name="dienthoai" type="text" maxlength="64" value="" id="dienthoai" />
		</div>
		
		<div  class="input_lienhe">
		  <label for="ContactEmail">Email: (*)</label>
		  <input name="email" type="text" maxlength="64" value="" id="email" />
		</div>
		<div  class="input_lienhe">
		  <label for="ContactTitle">Ti&ecirc;u &#273;&#7873;: (*)</label>
		  <input name="tieude" type="text" maxlength="256" value="" id="tieude" />
		</div>
		<div  class="input_lienhe">
		  <label for="ContactContent">N&#7897;i dung: (*)</label>
		  <textarea name="noidung" cols="30" rows="6" id="noidung"></textarea>
		</div>
		<div  class="input_button" id="bt_lienhe" >
	 <input name="submit"  class="bt_gui_lh"   id="btt" type="submit" value="" />
		</div>
		</form>
	</div>	
</div>
</div>
<?
}else
if($_POST['mod']=='sent'){

$r	=	$db->select("tgp_bien","ten = 'email'");
while ($row = $db->fetch($r))
	$emails = $row["gia_tri"];


$url="http://".$_SERVER['HTTP_HOST'];
$txt_email = $_POST["txt_email"];
$name = $_POST["txt_ten"];
$subject = $_POST["txtSubject"];
$tieude = $_POST["tieude"];
$txt_dienthoai=$_POST["dienthoai"];
$noi_dung = '<table width="100%" border="0" cellspacing="0" cellpadding="0" style="margin:0px; padding:0px; font-family:Palatino Linotype; font-size:14px; color:#000;">
	<tr><td><b>Thông tin liên hệ từ website <a href="'.$url.'" >'.get_bien("title").'</a></b>
	<tr><td><b>Họ và tên : </b>'.$name.'
	<tr><td><b>Điện thoại : </b>'.$txt_dienthoai.'
	<tr><td><b>Email : </b>'.$txt_email.'
	<tr><td><b>Tiêu đề : </b>'.$tieude.'
	<tr><td><b>Nội dung : </b>'.$subject.'</table>';

$emailFrom = $name."<".$txt_email.">";

$emailTo = $emails;




$OK = gui_mail($emailFrom,$emailTo,$subject,$noi_dung);



if ($OK == true ) $thongbao = 'Cảm ơn bạn đã liên hệ với chúng tôi';
else $thongbao = "Không thể gởi email của bạn vì có một vài lỗi từ phía máy chủ!";
echo $thongbao;




}
?>