<?php
include "../config.php";
$db = new lg_mysql($host,$dbuser,$dbpass,$csdl);
include "kt_admin.php";
include "function.php";

$id = $_GET['id']+0 ;
$r2 = $db->select("tgp_bds_quanhuyen","hien_thi = 1 AND id_tinhthanh='".$id."'","order by thu_tu asc");
?>
<select name="txt_quanhuyen" class="inputbox" style="width:150px;">
<?php
while ($row = $db->fetch($r2))
{
	echo "<option value='".$row["id"]."'";
	if ($id == $row["id"]) echo " selected ";
	echo ">".$row["ten"]."</option>";
}
?>
</select>