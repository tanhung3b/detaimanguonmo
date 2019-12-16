<font size="2" face="Tahoma"><b>Tin tức <img src="images/bl3.gif" border="0" /> Thêm bài viết</b></font>
<hr size="1" color="#cadadd" />
<?php
	include "templates/video.php";
	if (empty($func)) $func = "";
?>
<center>
<?php
	$max_file_size	=	8048000;
	$up_dir			=	"../uploads/cms/";

	$OK = false;
	
	if ($func == "new")
	{
		if (empty($txt_ten))
			$error = "Vui lòng nhập tên bài viết.";
		else if (empty($txt_chu_thich))
			$error = "Vui lòng nhập sơ lược bài viết.";
		else if (empty($txt_noi_dung))
			$error = "Vui lòng nhập nội dung bài viết.";
		else
		{
			
			
				$time = time($txt_date);
			
				
				
				

preg_match_all("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$txt_hinh_note,$url);
	$noidung =$txt_hinh_note;
		foreach ( $url as $link )
		{
			for($i=0;$i<=count($link);$i++)
			{
				$rlink = $link[$i];
				preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=[0-9]/)[^&\n]+|(?<=v=)[^&\n]+#", $rlink, $valid);

				if ( (strpos($rlink,"youtube.com") != false) && ($valid != NULL) )
				{
					$youtube = $valid[0];	
					$md5_hash = md5(rand(0,999)); 
					$security_code = substr($md5_hash, 15, 5); 
					$filename = time().$security_code."" ;
	
					$kt=upload_url($youtube,$filename);
					if($kt=='ok')
						{
				
					$thumb = "thm_".$filename.'.jpg' ;
					$UploadDir = "../uploads/cms/".$filename.".jpg";
					 if (is_file($UploadDir)) 
					 		{
					$UploadDir2 ="../uploads/cms/".$thumb;
					img_resize($UploadDir,$UploadDir2,"h=122&w=200&zc=1");
					
$id = $db->insert("tgp_cms","id,cat,ten,chu_thich,hinh_note,noi_dung,hien_thi,noi_bat,time,user,hinh","0,'".($txt_cat+0)."','".str_replace("\\","",$db->escape($txt_ten))."','".$txt_chu_thich."','".$db->escape($txt_hinh_note)."','".$txt_noi_dung."','".($txt_hien_thi+0)."','".($txt_noi_bat+0)."','".$time."','".$thanh_vien["id"]."','".$filename.".jpg'");


			
				admin_load("Đã thêm Bài viết vào CSDL","?act=cms_list&id=".($txt_cat+0));
				
							}else{ $error= "Yêu cầu bị từ chối!";}
					
						}else{ $error="Yêu cầu bị từ chối!";}
				}else{ $error="Vui long nhập video bằng link youtube!";}
				
			}
		}
		
		
		
		
				
				
			
			
		}
	}
	else
	{
		$txt_ten		= "";
		$txt_chu_thich	= "";
		$txt_hinh_note	= "";
		$txt_noi_dung	= "";
		$txt_hien_thi	= 1;
		$txt_date		= lg_date::vn_other(time(),"d/m/Y");
	}
	
	if (!$OK)
		template_edit("?act=video_new", "new", 0 , $txt_cat,$txt_ten,$txt_chu_thich,$txt_hinh_note,$txt_noi_dung,$txt_hien_thi,$txt_noi_bat,$txt_date,$error)
?>
</center>