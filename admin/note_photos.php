<?php
include "../config.php";
$db = new lg_mysql($host,$dbuser,$dbpass,$csdl);
include "kt_admin.php";
include "function.php";

$id=$_POST['id'];
$hinh=$_POST['hinh'];
$mod=$_POST['mod'];


if($mod=='view'){
		$r	= $db->select("tgp_camnhan","id = '".$id."'");
		while ($row = $db->fetch($r))
		{
			$noidung=noidung_vitri_list($hinh,$row['photos'],$row['note_photos']);
		
?>

<div>
                	<div style="font-weight:bold"> Chú thích</div>
                    <div id="show_note"></div>
                    <table width="100" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td style="padding-right:5px;"><img width="100" src="../uploads/kh_photos/thm_<?=$hinh?>" border="0" style="border:1px #999999 solid;"></td>
                        <td><textarea name="chu_thich_photo" id="chu_thich_photo" class="inputbox" style="width:300px" rows="6"><?=$noidung?></textarea>	</td>
                      </tr>
                    </table>

                	
                </div>
                <div style="text-align:right">
              <input name="submit" type="button" onClick="luu_note(<?=$row['id']?>,'<?=$hinh?>')" class="button" style="width:60px; cursor:pointer" value="Lưu" />
              <input name="submit" type="button" onClick="$('#khung_note').hide()" class="button" style="width:60px;cursor:pointer" value="Đóng" />
              </div>
              
              <? }?>
 <? }else if($mod=='luu'){
	 
	 	$r	= $db->select("tgp_camnhan","id = '".$id."'");
		while ($row = $db->fetch($r))
		{
			$vitri=kt_vitri_list($hinh,$row['photos'],$row['note_photos'],$note);
			$db->query("update tgp_camnhan set note_photos='".$vitri."' where id = '".$id."'");
			echo 'Đã cập nhật thàng công';
		}
			
	 
	  }?>             