<div class="khung_body_home">

<div class="khung_dich_vu">
	<div class="phan_dv">
<?
$dem=0;
$sql_view=$db->select("tgp_page","alias like 'dich_vu_%'  ".$dk."","ORDER BY id ASC LIMIT 3");
	 	while($r2=$db->fetch($sql_view))
		 {
			 $dem++;
?>	 
		<div class="khung_dichvu" style=" <?=$dem==3?"padding-right:0px;":""?>">
        	<div class="tieude_dv cufon_2"><a href="/view/dich-vu/<?=$r2['id']?>/<?=lg_string::get_link($r2["ten"])?>"><?=$r2['ten']?></a></div>
            <div class="hinh_dv"><a href="/view/dich-vu/<?=$r2['id']?>/<?=lg_string::get_link($r2["ten"])?>"><img width="317" src="/uploads/cms/h_<?=$r2['hinh']?>" ></a></div>
            <div class="phan_chuthich">
            	<div style="padding:14px; height:69px;"><?=lg_string::crop($r2["chu_thich"],35);?></div>
                <div class="xem_chi_tiet"><a href="/view/dich-vu/<?=$r2['id']?>/<?=lg_string::get_link($r2["ten"])?>">Xem chi tiết</a></div>
            </div>
        </div>

<? }?>
	</div>
</div>

<div style="padding-top:20px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top">
    <div class="khung_tin" style="padding-right:15px;">
    	<? $sql_view=$db->select("tgp_page","alias like 'gioi_thieu_%'  ".$dk."","ORDER BY id ASC LIMIT 1");
	 	while($r2=$db->fetch($sql_view))
		 {?>
         	<div class="tieude_home cufon_2" style="text-align:center"><a href="/view/gioi-thieu/<?=$link?>"><?=$r2['ten']?></a></div>
            <div style="padding-bottom:25px; padding-top:15px; text-align:center;">
            	<?=$r2['chu_thich']?>
            </div>
         	<div class="xem_tiep2"><a href="/view/gioi-thieu/<?=$link?>">Xem chi tiết</a></div>
         <? }?>
         <div class="cufon_2 loi_noi_home" style="font-size:15px; padding-top:25px; text-align:center;">
         	<?=get_page('loi_noi')?>
         </div>
         
    </div>
    </td>
    <td align="left" valign="top"> <div class="khung_tin" style="padding-right:15px;">
    <div class="tieude_home cufon_2" style="text-align:center; padding-bottom:15px;"><a href="/tin-tuc/<?=$link?>"><?=get_cat('tin_tuc')?></a></div>
    	<?
					$list_daotao=0;
				$sqltd=$db->select("tgp_cms_menu","hien_thi=1 and cat='tin_tuc' ","ORDER BY thu_tu");
				while($r2=$db->fetch($sqltd))
				  { $list_daotao=$list_daotao.','.$r2['id'];
				  }
				  $dem=0;
				  $q	=	$db->select("tgp_cms","cat in(".$list_daotao.")  and hien_thi=1","ORDER BY time DESC LIMIT 3");
					while($r2=$db->fetch($q))
				  {
					  $dem++;
				  ?>
                  	<div class="tin_tuc_home">
                    	<div class="td_tt_home"><a  href="/tin-tuc/<?=$r2['cat']?>/<?=$r2['id']?>/<?=lg_string::get_link($r2["ten"])?>" ><?=lg_string::crop($r2["ten"],10);?></a></div>
               		  <div class="ct_tt_home"><?=lg_string::crop($r2["chu_thich"],40);?></div>
                    </div>
                    <? if($dem!=3){?>
                    <div style="text-align:center; font-size:10px; width:138px; margin:auto; border-bottom:dotted 1px #fff; height:15px; margin-bottom:20px; "></div>
                  		<? }?>
            <? }?>
    	<div class="xem_tiep2"><a href="/tin-tuc/<?=$link?>">Tin tức khác</a></div>
    </div>
    </td>
    <td align="left" valign="top"><div class="khung_tin">
   <div class="fb-like-box" data-href="http://www.facebook.com/pages/Studio8vn/323249137751322?ref=hl" data-width="317" data-colorscheme="dark" data-show-faces="true" data-border-color="#141414" data-stream="false" data-header="true"></div>	
    </div></td>
  </tr>
</table>
</div>

</div>