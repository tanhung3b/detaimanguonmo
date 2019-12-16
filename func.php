<?php
$link='';
//$link_web='http://nguoidepdanang.vn';
function showPageNavigation($currentPage, $maxPage, $path = '') {
	if ($maxPage <= 1)
	{
		return;
	}
	
	
	$suffix = '/';
	
	$nav = array(
		// bao nhiêu trang bên trái currentPage
		'left'	=>	3,
		// bao nhiêu trang bên phải currentPage
		'right'	=>	3,
	);
	
	// nếu maxPage < currentPage thì cho currentPage = maxPage
	if ($maxPage < $currentPage) {
		$currentPage = $maxPage;
	}
	
	// số trang hiển thị
	$max = $nav['left'] + $nav['right'];
	
	// phân tích cách hiển thị
	if ($max >= $maxPage) {
		$start = 1;
		$end = $maxPage;
	}
	elseif ($currentPage - $nav['left'] <= 0) {
		$start = 1;
		$end = $max + 1;
	}
	elseif (($right = $maxPage - ($currentPage + $nav['right'])) <= 0) {
		$start = $maxPage - $max;
		$end = $maxPage;
	}
	else {
		$start = $currentPage - $nav['left'];
		if ($start == 2) {
			$start = 1;
		}
		
		$end = $start + $max;
		if ($end == $maxPage - 1) {
			++$end;
		}
	}
	
	$navig = '<div class="navigation">';
	if ($currentPage >= 2) {
		if ($currentPage >= $nav['left']) {
			if ($currentPage - $nav['left'] > 2 && $max < $maxPage) {
				// thêm nút "First"
				$navig .= '<span class="page_item"><a href="'.$path.'1'.$suffix.'">1</a></span>';
				$navig .= '<span class="current_page_item"><b>...</b></span>';
			}
		}
		// thêm nút "«"
		$navig .= '<span class="page_item"><a href="'.$path.($currentPage - 1).$suffix.'">«</a></span>';
	}

	for ($i=$start;$i<=$end;$i++) {
		// trang hiện tại
		if ($i == $currentPage) {
			$navig .= '<span class="current_page_item">'.$i.'</span>';
		}
		// trang khác
		else {
			$pg_link = $path.$i;
			$navig .= '<span class="page_item"><a href="'.$pg_link.$suffix.'">'.$i.'</a></span>';
		}
	}
	
	if ($currentPage <= $maxPage - 1) {
		// thêm nút "»"
		$navig .= '<span class="page_item"><a href="'.$path.($currentPage + 1).$suffix.'">»</a></span>';
		
		if ($currentPage + $nav['right'] < $maxPage - 1 && $max + 1 < $maxPage) {
			// thêm nút "Last"
			$navig .= '<span class="current_page_item">...</span>';
			$navig .= '<span class="page_item"><a href="'.$path.$maxPage.$suffix.'">'.$maxPage.'</a></span>';
		}
	}
	$navig .= '</div>';
	
	// hiển thị kết quả
	echo $navig;
}




function get_sql($sql)
{
	global $db;
	$get_sql_query_statement = $db->query($sql);
	if ($result_get_sql_query = $db->fetch($get_sql_query_statement))
	{
		return $result_get_sql_query[0];
	}
	else
	{
		return "SQL_NULL";
	}
}

function	get_page($alias,$col = "noi_dung")
{
	global $db , $_fix;
	
	$alias = $db->escape($alias);
	
	$db->query("UPDATE tgp_page SET luot_xem = luot_xem + 1 WHERE alias = '".$alias."'");
	$r	=	$db->select("tgp_page","alias = '".$alias."'");
	while ($row = $db->fetch($r))
	{
		return $row[$col];
	}
	
	return "Unknown alias '".$alias."'";
}
function	get_bien($id)
{
	global $db;
	
	$r	=	$db->select("tgp_bien","ten = '".$id."'");
	while ($row = $db->fetch($r))
		return $row["gia_tri"];
}
function gui_mail($nguoigoi,$nguoinhan,$tieude,$noidung)
{
	global $conf;
	
	if (ereg("(.*)<(.*)>", $nguoigoi, $regs)) {
	   $nguoigoi = '=?UTF-8?B?'.base64_encode($regs[1]).'?=<'.$regs[2].'>';
	}
	
	$header = "From: ".$nguoigoi."\n";
	$header .= "MIME-Version: 1.0\r\n";
	$header .= "Content-Type: text/html; charset=UTF-8\r\n";
	$noidung =	str_replace("\n"	, "<br>"	, $noidung);
	$noidung =	str_replace("  "	, "&nbsp; "	, $noidung);
	$noidung =	str_replace("<script>","&lt;script&gt;", $noidung);

	//$noidung =  $noidung;
	
	
	return (@mail($nguoinhan, $tieude, $noidung, $header));
			
}
function 	get_seo($seo='')
{
	$txt = get_title();
	global $db, $act,$mod, $id,$idp;

		$query = '';
		if ($act == 'tin_tuc' && $idp!='0'){
			$query = "SELECT * FROM tgp_cms WHERE id = '".$idp."'";
			$q = $db->query($query);
			if ($r = $db->fetch($q))
			{
				if (trim($r[$seo]) != ''){
					$txt .= $r[$seo];
					}else if(trim($r['chu_thich']) != '') {
						$txt = $r['chu_thich'].' , '.$txt;
						} else
					$txt = get_title();
					
				
			}
			else
				$txt = get_title();
			
		}
		else if ($act == 'tin_tuc' && $idp=='0' && $id!='0' ){
			$query = "SELECT * FROM tgp_cms_menu WHERE id = '".$id."'";
			$q = $db->query($query);
			if ($r = $db->fetch($q))
			{
				if (trim($r[$seo]) != '') 
					$txt .= $r[$seo];
				else
					$txt = get_title();
			}
			else
				$txt = get_title();
				
		}
		else if ($act == 'tin_tuc' && $idp=='0' && $id=='0' ){
			$query = "SELECT * FROM tgp_cms_menu WHERE cat = 'tin_tuc' LIMIT 1";
			$q = $db->query($query);
			if ($r = $db->fetch($q))
			{
				if (trim($r[$seo]) != '') 
					$txt .= $r[$seo];
				else
					$txt = get_title();
			}
			else
				$txt = get_title();
		}
		else if ($mod == 'gioi-thieu'){
			$query = "SELECT * FROM tgp_page WHERE alias like 'gioi_thieu' ";
			$q = $db->query($query);
			if ($r = $db->fetch($q))
			{
				if (trim($r[$seo]) != ''){
					$txt .= $r[$seo];
					}else if(trim($r['chu_thich']) != '') {
						$txt = $r['chu_thich'].' , '.$txt;
						} else
					$txt = get_title();
					
				
			}
			else
				$txt = get_title();
				
		}
		else if ($act == 'tai_tro'){
			$query = "SELECT * FROM tgp_cms WHERE id = '".$idp."'";
			$q = $db->query($query);
			if ($r = $db->fetch($q))
			{
				if (trim($r[$seo]) != ''){
					$txt .= $r[$seo];
					}else if(trim($r['chu_thich']) != '') {
						$txt = $r['chu_thich'].' , '.$txt;
						} else
					$txt = get_title();
					
				
			}
			else
				$txt = get_title();
		}
		else if ($act == 'phuong_tien_xem'){
			$query = "SELECT * FROM tgp_train WHERE id = '".$id."'";
		}
		

	return $txt;
}

function	get_title()
{
	global $db, $act, $id,$idp,$mod;
	$idp=$_GET['idp'];
	$id=$id+0;
	$idp=$idp+0;
	$txt	=	get_bien("title");

	
	if ($act == "home")
	{
		$txt = "Trang chủ , ".$txt;
		
			
	}
	
	if ($act == "tin_tuc" && $id==0 && $idp==0)
	{
		$txt = "Tin tức - sự kiện , ".$txt ;
		$seo =	"Tin tức - sự kiện , ".$seo ;
	}
	if ($act == "thu_vien_hinh_anh" && $id==0 && $idp==0 )
	{
		$txt = "Thư viện hình ảnh , ".$txt ;
	}
	
	if ($act == "khach_hang")
	{
		$txt = "Khách hàng , ".$txt;
	}

	if ($act == "huong_dan")
	{
		$txt = "Hướng dẫn , ".$txt;
	}
	
		
	if ($mod == "gioi-thieu")
	{
			$dk='';
		if($id!=0){
		$dk ='and id='.$id;
		}
	$r = $db->select("tgp_page","alias like 'gioi_thieu_%' ".$dk." ","ORDER BY id ASC LIMIT 1");
			if ($rs = $db->fetch($r))
			{
				$txt_tin=$rs["ten"];
			}
		$txt = $txt_tin." , ".$txt ;
	}
	
	if ($mod == "dich-vu")
	{
			$dk='';
		if($id!=0){
		$dk ='and id='.$id;
		}
	$r = $db->select("tgp_page","alias like 'dich_vu_%' ".$dk." ","ORDER BY id ASC LIMIT 1");
			if ($rs = $db->fetch($r))
			{
				$txt_tin=$rs["ten"];
				$txt_tin3=$rs["chu_thich"];
			}
		$txt = $txt_tin." , ".$txt ;
		$seo=$txt_tin3." , ".$seo;
	}
	if ($mod == "giai-thuong")
	{
			$dk='';
		if($id!=0){
		$dk ='and id='.$id;
		}
	$r = $db->select("tgp_page","alias like 'giai_thuong' ".$dk." ","ORDER BY id ASC LIMIT 1");
			if ($rs = $db->fetch($r))
			{
				$txt_tin=$rs["ten"];
				$txt_tin3=$rs["chu_thich"];
			}
		$txt = $txt_tin." , ".$txt ;
		$seo=$txt_tin3." , ".$seo;
	}
	
	


	
	if ($act == "tin_tuc" ||  $act == "thu_vien_hinh_anh" ||  $act == "huong_dan" ||  $act == "thong_tin_ne_nep" ||  $act == "truyen_thong" ||  $act == "van_ban_phap_quy" ||  $act == "khuyen_hoc_hoc_bong" ||  $act == "tai_nguyen" ||  $act == "van_ban_chi_dao" ||  $act == "hoc_sinh"  ||  $act == "day_va_hoc" )  
	{
		$txt_tin='';
		
		if ($idp != 0)
		{
		$r = $db->select("tgp_cms","id = ".$idp."");
			if ($rs = $db->fetch($r))
			{
				$txt_tin .=$rs["ten"].' , ';
				$txt_tin3.=$rs["chu_thich"];
				
			}
		}
		
		if ($id != 0 )
		{
		$r = $db->select("tgp_cms_menu","id = ".$id."");
			if ($rs = $db->fetch($r))
			{
				$txt_tin .=$rs["ten"].' , ';
				$txt_tin3.=$rs["ten"].' , ';
			}
		}
		
		$seo=$txt_tin3." , ".$seo;
		$txt=$txt_tin.$txt;
		
	}
	
	
		
	
	if($loai=='seo'){
		return str_replace('"','',$seo);
	}else{
		return str_replace('"','',$txt);
		}
}


function hashString($string)
{
	return md5('qweasdzxc'.$string);
}



function duan_slide($hien_thi,$vitri)
{
global $db;
$ket='';
 $sqltd=$db->select("tgp_cms","cat=16 and hien_thi=1 and noi_bat=1","ORDER BY id DESC ");
					$num= $db->num_rows($sqltd);
  		
		 $trang= ceil($num/$hien_thi);
   
   if($trang>0){
   	for($i=1;$i<=$trang;$i++){
	$hinh='2.jpg';
	if($vitri==$i){
	$hinh='1.jpg';
	}
   $ket.='<span class="duan_san" ><a onclick="load_duan_trang('.$hien_thi.','.$i.');"><img  src="/images/'.$hinh.'" /></a></span>';
   	}
   
   }
     return $ket;      			
}

function get_cat($id){
global $db;
	
	$r	=	$db->select("tgp_cat","id = '".$id."'");
	while ($row = $db->fetch($r))
		return $row["ten"];
}


function get_date_tin($time){
$arr=array('Chủ nhật','Thứ hai','Thứ ba','Thứ tư','Thứ năm','Thứ sáu','Thứ bảy');
$today = getdate($time);
$ngay= $arr[$today['wday']].', '.date('d/m/Y - h:i A',$time);

return $ngay;
}
	
	
	
function xem_video_youtube($noidung,$w,$h){

	preg_match_all("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$noidung,$url);
		$noidung = $noidung;
		foreach ( $url as $link )
		{
			for($i=0;$i<=count($link);$i++)
			{
				$rlink = $link[$i];
				preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=[0-9]/)[^&\n]+|(?<=v=)[^&\n]+#", $rlink, $valid);

				if ( (strpos($rlink,"youtube.com") != false) && ($valid != NULL) )
				{
					$youtube = $valid[0];	
					$noidung = str_replace($rlink,'<object width="'.$w.'" height="'.$h.'" wmode="opaque" ><param name="movie" value="http://www.youtube.com/v/'.$youtube.'?version=3&amp;hl=vi_VN&amp;rel=0"></param>   <param name="wmode" value="opaque"> <param name="wmode" value="transparent"><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/'.$youtube.'?version=3&amp;hl=vi_VN&amp;rel=0" type="application/x-shockwave-flash" width="'.$w.'" height="'.$h.'" wmode="transparent" allowscriptaccess="always" allowfullscreen="true"></embed></object>',$noidung);
				}
				else
				{
					$rlink =	str_replace("http://","",$rlink);	
					$noidung = str_replace($rlink,"<a href='http://".$rlink."' target='_blank'>".lg_string::cut($rlink,50)."</a>",$noidung);
				}
			}
		}
return $noidung;
	
}


function demonline(){
$gia_tri = 0;
$rnk	=	mysql_query("select *  from tgp_online_daily   ");
//$hinh='<img src="/images/0.png" />';
	while ($row=mysql_fetch_array($rnk))
		$gia_tri += $row["bo_dem"];
		
		
		
		$gia_tri += 10;
		
		$x = 7 - strlen($gia_tri);
		
		for ($i = 1; $i <= $x; $i++)
		
		{
		$gia_tri = "0" . $gia_tri;
		}
		
		for ($i = 0; $i < strlen($gia_tri); $i++)
		{
		$hinh=$hinh.'<img src="/images/count/'.$gia_tri[$i].'.gif" />';	
		}
		
	echo $hinh;	
}

function get_thong_ke($id)
{
	$td=date('d/m/Y',time());
	$yt=date('d/m/Y',time()-3600*24);
	if($id=='td'){
	return get_sql("select bo_dem  from  tgp_online_daily where ngay='".$td."' ");
	}else{
	return get_sql("select bo_dem  from  tgp_online_daily where ngay='".$yt."' ");
	}
	
}

function get_hinh($id)
{

	return get_sql('select hinh  from  tgp_gallery where cat='.$id.' ORDER BY RAND()  LIMIT 1 ');
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
?>