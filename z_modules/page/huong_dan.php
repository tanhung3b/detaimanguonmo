
<div style="padding-top:10px;">
<?
$id=$_GET['idp']+0;

$dk='';
if($id!=0){
$dk ='and id='.$idp;
}
  $sql_view=$db->select("tgp_page","alias like 'huong_dan'  ".$dk."","ORDER BY id ASC LIMIT 1");
	 				 while($r2=$db->fetch($sql_view))
					  {
					  $idp=$r2['id'];
					    get_page($r2['alias']);
						$ten_tieude=$r2['ten'];
						?>



<div class="tieude_home cufon_2"><?=$r2['ten']?></div>
	
		
<div style="padding-top:10px; ">
<div  class="bg_lienhe">	


<div >

<table width="100%" border="0" cellpadding="0px" cellspacing="0px">
  <tr>
    <td align="left" valign="top">
<div style="width:560px; text-align:justify; padding-right:20px;">
	<?=$r2['noi_dung']?>
</div></td>
    <td align="left" valign="top"><form  method="post" onSubmit="return show_lienhe_sent(this)">	
	
		
  
	<table width="43%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="393" ><span class="input_lienhe" style="padding:0px;">
          <label style="padding:0px;" >Họ &amp; Tên: (*) </label>
        </span></td>
        </tr>
      <tr>
        <td ><span class="input_lienhe">
        <input name="name" type="text" maxlength="64" value="" id="name" />
        </span></td>
      </tr>
      <tr>
        <td ><span class="input_lienhe">
        <label for="ContactEmail">Email: (*)</label>
        </span></td>
      </tr>
      <tr>
        <td ><span class="input_lienhe">
        <input name="email" type="text" maxlength="64" value="" id="email" />
        </span></td>
      </tr>
      <tr>
        <td ><span class="input_lienhe">
        <label >Điện thoại </label>
        </span></td>
      </tr>
      <tr>
        <td ><span class="input_lienhe">
        <input name="dienthoai" type="text" maxlength="64" value="" id="dienthoai" />
        </span></td>
      </tr>
      <tr>
        <td ><span class="input_lienhe">
          <label > Tiêu đề(*) </label>
        </span></td>
      </tr>
      <tr>
        <td><span class="input_lienhe">
        <input name="tieude" type="text" maxlength="256" value="" id="tieude" />
        </span></td>
        </tr>
      <tr>
        <td><span class="input_lienhe">
          <label for="ContactContent">Nội dung: (*)</label>
        </span></td>
        </tr>
      <tr>
        <td><span class="input_lienhe">
          <textarea name="noidung" cols="30" rows="6" id="noidung"></textarea>
        </span></td>
        </tr>
    </table>
	<div style="text-align:left; margin-top:10px; " ><input type="submit" value=""  class="button_sen" > <input type="reset" value=""  style="margin-left:10px;" class="button_2" > </div>
	</form></td>
  
  </tr>
</table>


</div>
</div>
</div>




					  <?
					  }
					  ?>
				  
					  
</div>

					