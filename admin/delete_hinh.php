
<?
include "../config.php";
$db = new lg_mysql($host,$dbuser,$dbpass,$csdl);
include "kt_admin.php";
include "function.php";


$ten=$_GET['ten'];
$id=$_GET['id'];
$list='';
$r	=	mysql_query("SELECT * FROM tgp_upload_tmp where id=".$id." ORDER BY id ASC");
	while ($row	=	mysql_fetch_array($r))
	{
		$list= $row['list_hinh'];
	}
	$m = explode(";",$list);
	count($m);
	if(count($m)>1){
$text	=	str_replace($ten.';', "",$list);
	}
$sql="update tgp_upload_tmp set list_hinh='".$text."' where id =".$id." ";
mysql_query($sql);
echo 'Đã xóa thành công';
?>
