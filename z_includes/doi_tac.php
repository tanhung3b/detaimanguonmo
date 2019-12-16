<div class="khung_doitac_con">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="85%">
    	<div class="tieude_home cufon_2">Đối tác :</div>
    </td>
   <td width="15%">
			<div style="padding-top:7px;">

<script type="text/javascript" src="/js/slide/jquery.jcarousellite.min.js"></script>

 <script language="javascript" type="text/javascript">
<?
$q	=	$db->select("tgp_doitac","hien_thi=1 ","ORDER BY thu_tu DESC  ");
				$num=$db->num_rows($q);
			
					  
$max1=$num;
if($num>5){
$max1=6;
}
?>
           
		   		$(function() {
					$(".slide_doitac").jCarouselLite({
						vertical: false,
						hoverPause:true,
						btnNext: ".next",
       					btnPrev: ".prev",
						visible: <?=$max1?>,
						auto:1000,
						speed:1000
					});
				});
				
		
        </script>
		<div >
				<div class="slide_doitac">
	
					<ul>	
			 <? while($r2=$db->fetch($q))
					  {	
					?>	<li ><a href="<?=$r2['link']?>" target="_blank" class="doitac" ><img width="140"  src="/uploads/doitac/doitac_<?=$r2['hinh']?>"></a> </li> 
	<?
			}
		?>
                      </ul>
				</div>
		
				<div style="clear:both"></div>		
			</div>
            
            
										
						</div>
	
            </td>
  </tr>
</table>
</div>