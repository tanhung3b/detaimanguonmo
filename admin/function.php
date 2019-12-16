<?php
function	get_user($id,$value)
{
	global $db;
	
	$r	=	$db->select("tgp_user","id = '".$id."'");
	while ($row = $db->fetch($r))
		return $row[$value];
}

function	kt_user_dung($txt_username)
{
	return (!ereg("(^[a-z]+([a-z\_0-9\-]*))$", $txt_username));
}

function	get_bien($id)
{
	global $db;
	
	$r	=	$db->select("tgp_bien","ten = '".$id."'");
	while ($row = $db->fetch($r))
		return $row["gia_tri"];
}

function	kt_email_dung($txt_email)
{
	return (!ereg("[A-Za-z0-9_-]+([\.]{1}[A-Za-z0-9_-]+)*@[A-Za-z0-9-]+([\.]{1}[A-Za-z0-9-]+)+", $txt_email));	
}
function	show_order($name,$sum,$pos,$width,$style=1)
{
?>
<select name="<?=$name?>" dir="rtl" size="1" class="inputbox" style="width:<?=$width?>;<?=$style==1?"font-weight:bold;color:red;":""?>">
<?php
	for ($i = 1; $i <= $sum; $i++)
	{
		echo "<option value=".$i;
		if ($pos == $i) echo " selected ";
		echo ">".$i."</option>";
	}
?>
</select>
<?php
}
// admin_load
function	admin_load($thong_bao,$url)
{
?>
<center>
	<b><font size="2"><?=$thong_bao?></font></b>
	<br /><img vspace="3" src="images/83.gif" />
	<br>Xin đợi vài giây hoặc bấm <b><a href="<?=$url?>">vào đây</a></b> để tiếp tục...
</center>
<head>
	<meta http-equiv="Refresh" content="1; URL=<?=$url?>">
</head>
<?php
	die();
}
// resize hình ảnh bất kỳ
function img_resize($src,$dis,$par)
{
 	require_once('../lib/phpthumb/phpthumb.class.php');
 	$phpThumb = new phpThumb();
 	$phpThumb->src = $src;
		$r = explode("&",$par);
		for ($i = 0; $i <= count($r); $i++)
		{
			if ($r[$i] != "")
			{
				$q = explode("=",$r[$i]);
				if ($q[0] == 'h') 
					$phpThumb->h = $q[1];
				if ($q[0] == 'w') 
					$phpThumb->w = $q[1];
					
				if ($q[0] == 'zc')
				{
					$phpThumb->zc = $q[1];
				}
				
				if ($q[0] == 'fltr[]')
				{
					$phpThumb->fltr[] = $q[1];
				}
			}
		}
	$phpThumb->q = 100;
	$phpThumb->config_output_format = 'jpeg';
	$phpThumb->config_error_die_on_error = true;
	if ($phpThumb->GenerateThumbnail())
	{
		$phpThumb->RenderToFile($dis);
  	}
  	else
	{
  	}
}
// resize hình ảnh bất kỳ
function img_png_resize($src,$dis,$par)
{
 	require_once('../lib/phpthumb/phpthumb.class.php');
 	$phpThumb = new phpThumb();
 	$phpThumb->src = $src;
		$r = explode("&",$par);
		for ($i = 0; $i <= count($r); $i++)
		{
			if ($r[$i] != "")
			{
				$q = explode("=",$r[$i]);
				if ($q[0] == 'h') 
					$phpThumb->h = $q[1];
				if ($q[0] == 'w') 
					$phpThumb->w = $q[1];
					
				if ($q[0] == 'zc')
				{
					$phpThumb->zc = $q[1];
				}
				
				if ($q[0] == 'fltr[]')
				{
					$phpThumb->fltr[] = $q[1];
				}
			}
		}
	$phpThumb->q = 100;
	$phpThumb->config_output_format = 'png';
	$phpThumb->config_error_die_on_error = true;
	if ($phpThumb->GenerateThumbnail())
	{
		$phpThumb->RenderToFile($dis);
  	}
  	else
	{
  	}
}


function	select_hinh_silde($id)
{


$r	=	mysql_query("select * from tgp_upload_tmp where id=".$id."");

	while ($row	=	mysql_fetch_array($r))
	{
		$listh= $row['list_hinh'];
	}

	$m = explode(";",$listh);
	$listhinh='';
	if(count($m)>0){
	for($i=0;$i<count($m);$i++)
	{ 
   if($m[$i]!=''){

	?>
	<table width="55" id="hinh_delete_<?=$i?>" border="0" style="float:left;margin-right:5px; "cellspacing="0" cellpadding="0">
  <tr>
    <td><div style="float:left;width:55px;">
	<img  style="float:left; border:solid 1px #abc6dd; padding:1px;" src="/uploads/bds/silde_icon_<?=$m[$i]?>"></a></div></td>
  </tr>
  <tr>
    <td><a onClick="delete_hinh('<?=$m[$i]?>','<?=$id?>','<?=$i?>');" style="cursor:pointer" ><div style="background:#f8fafa;border:solid 1px #abc6dd;margin-top:5px; width:50px; height:16px;text-align:center; padding-top:3px;" >Xóa</div></a></td>
  </tr>
</table>
<?
}
	
	}
	}
	


}

function so($text)
{
		$text	=	str_replace(",", "", $text);
	return $text;
}

function themdau($so) {
$str =$so;
$dodai=strlen($str);
$j= floor($dodai/3);

for($k=0;$k<$j;$k++){
 
$dodai=strlen($str);
$h=-1;
$h++;
$a=$dodai-(3*($k+1));
$a=$a-$k;
if($a>=1){
$str =substr($str, 0, $a) . "," . substr($str, $a, strlen($str));

 }
}
return $str;
}



function upload_url($Url,$filename)
{
	$Url='http://i2.ytimg.com/vi/'.$Url.'/0.jpg';
     define("URL_1",$Url);

     $UploadDir = "../uploads/cms/";

     $FileName = explode("/", $Url);

     $FileName = $FileName[count($FileName)-1];
     define("URL_2",$UploadDir.$filename.".jpg");
     $f1 = @fopen ( URL_1, "rb");

     $f2 = @fopen ( URL_2, "w");
     while ( $Buff = @fread( $f1, 1024 ) )

     {

     @fwrite($f2, $Buff);
		$kt='ok';
     }
 
     @fclose($f1);
     @fclose($f2);
	return $kt;
}
function	count_doitac()
{

$count=1;
$r	=	mysql_query("select count(id) as tong from tgp_doitac");

	while ($row	=	mysql_fetch_array($r))
	{
		$count= $row['tong'];
	}
return $count;	
}	


function kt_menu_user($id,$list){
$m = explode("|",$list);
	for($i=0;$i<count($m);$i++){
			if(($m[$i])==$id){
			return 'co';
			}
				
		}
	return 'ko';	
}

function noidung_vitri_list($hinh,$listhinh,$listnote){
$m = explode(";",$listhinh);

$m2 = explode(";",$listnote);


	for($i=0;$i<count($m);$i++){
			
			if(($m[$i])==$hinh){
			return $m2[$i];
			}
			
		}
	return '';	
}


function kt_vitri_list($hinh,$listhinh,$listnote,$note){
$m = explode(";",$listhinh);

$m2 = explode(";",$listnote);
$note =str_replace(";",",",$note);
$listnew='';

	for($i=0;$i<count($m);$i++){
			$m3=$m2[$i];
			if(($m[$i])==$hinh){
			$m3=$note;
			}
			$listnew.=$m3.';';	
		}
	return $listnew;	
}


function delete_vitri_note($hinh,$listhinh,$listnote){
$m = explode(";",$listhinh);

$m2 = explode(";",$listnote);

$listnew='';

	for($i=0;$i<count($m);$i++){
			
			if(($m[$i])==$hinh){
			//$m3=$note;
			}else if($m[$i]!=''){
				$m3=$m2[$i];
				$listnew.=$m3.';';	
				}
			
		}
	return $listnew;	
}
function delete_vitri_hinh($hinh,$listhinh,$listnote){
$m = explode(";",$listhinh);

$m2 = explode(";",$listnote);

$listnew='';

	for($i=0;$i<count($m);$i++){
			
			if(($m[$i])==$hinh){
			//$m3=$note;
			}else if($m[$i]!=''){
				$m3=$m[$i];
				$listnew.=$m3.';';	
				}
			
		}
	return $listnew;	
}

?>