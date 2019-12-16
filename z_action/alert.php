<? include("z_includes/thong_baotop.php"); ?>

<?
if($mod=='sp'){
echo 'Đã thêm sản phẩm này vào shop của bạn!<br>Kích <a href="/myaccount/'.$THANHVIEN['username'].'/myproduct/" >vào đây</a> đễ quay về..';
}else if($mod=='up'){
echo 'Đã cập nhập sản phẩm này !<br>Kích <a href="/myaccount/'.$THANHVIEN['username'].'/myproduct/" >vào đây</a> đễ quay về..';

}else{
echo $msg;
}
?>

<? include("z_includes/thong_baobutton.php"); ?>