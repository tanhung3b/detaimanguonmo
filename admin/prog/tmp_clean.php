<font size="2" face="Tahoma"><b>Dọn dẹp file nháp </b></font>
<hr size="1" color="#cadadd" />
<?php
$typ[0]	=	"Hình ảnh";		$dir[0]	=	"../uploads/gal";

$sizes	=	0;
$count	=	0;
$sum	=	0;

for ($i = 0; $i < count($dir); $i++)
if (is_dir($dir[$i]))
{
	$files	=	scandir($dir[$i]);
	echo "<img src=\"images/bl3.gif\" border=\"0\" /><b><u>".$typ[$i]."</u></b><br><br>";

	for ($j = 0; $j < count($files); $j++)
	{
		$link = $dir[$i]."/".$files[$j];
		if (!is_dir($link))
		{
			$check = false;
			$sum++;
			
			if ($typ[$i] == "Tin tức")		$check = check_cms_file($files[$j]);
			if ($typ[$i] == "Sản phẩm")		$check = check_pro_file($files[$j]);
			if ($typ[$i] == "Khách hàng")	$check = check_cus_file($files[$j]);
			if ($typ[$i] == "Hình ảnh")		$check = check_gal_file($files[$j]);
			
			echo "#".$sum.". File \"<b>".$files[$j]."</b>\"";
			if (!$check)
			{
				$count += 1;
				$sizes += @filesize($link);
				@unlink($link);
				echo " : <font color=red>Deleted !!!</font>";
			}
			else			echo " : <font color=blue>Accepted.</font>";
			echo "<br>";
		}
	}
	
	echo "<br>";
}
?>
<hr size="1" color="#cadadd" />
Tổng dung lượng được dọn dẹp : <?=lg_number::money($sizes)?> bytes / <?=lg_number::money($count)?> files.
<?php
function	check_cms_file($file)
{
	global $db;
	$r = $db->select("tgp_cms","hinh = '".$file."'");
	if ($db->num_rows($r) == 0)
		return false;
	else return true;
}
function	check_pro_file($file)
{
	global $db;
	$r = $db->select("tgp_product","hinh = '".$file."'");
	if ($db->num_rows($r) == 0)
		return false;
	else return true;
}
function	check_cus_file($file)
{
	global $db;
	$r = $db->select("tgp_customers","hinh = '".$file."'");
	if ($db->num_rows($r) == 0)
		return false;
	else return true;
}
function	check_gal_file($file)
{
	global $db;
	
	if ( strpos($file,"thm_") == 0 )
	{
		$file = str_replace("thm_","",$file);
	}
	
	$r = $db->select("tgp_gallery","hinh = '".$file."'");
	if ($db->num_rows($r) == 0)
		return false;
	else return true;
}
?>