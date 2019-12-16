<div class="khung_menu">
	<div class="phan_menu">
    <div style="position:absolute; left:-200px;"> <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="417" height="174">
                                <param name="movie" value="/as.swf">
                                <param name="quality" value="high">
                                <param name="allowScriptAccess" value="always">
                                <param name="wmode" value="transparent">
                                <embed src="/as.swf" quality="high" type="application/x-shockwave-flash" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer" allowscriptaccess="always" width="417" height="174">
                            </object></div>
                            
    
    	<ul id="nav">
        	<li><div class="item_menu cufon_2 <?=$mod=='gioi-thieu'?"activ":""?>" ><a href="/view/gioi-thieu/<?=$link?>">GIỚI THIỆU</a></div>
             <? $sqltd=$db->select("tgp_page","alias like 'gioi_thieu_%' ","ORDER BY alias"); 
							$sum		=	$db->num_rows($sqltd); 
							if($sum>1){
						?>
							<ul >
							<?
							$me=0;
							while($r2=$db->fetch($sqltd))
							  { $me=$me+1; ?>
									<li  <?=$me==1?"style=border:none":""?> ><div class="m4"><a href="/view/gioi-thieu/<?=$r2['id']?>/<?=lg_string::get_link($r2["ten"])?>">&raquo; <?=$r2['ten']?></a></div> </li>
							<? }?>	
							</ul>
						<? }?>
            </li>
            <li><div class="item_menu cufon_2 <?=$act=='thu_vien_hinh_anh'?"activ":""?>" ><a href="/thu-vien-hinh-anh/<?=$link?>">THƯ VIỆN HÌNH ẢNH</a></div>
            	 <? $sqltd=$db->select("tgp_cms_menu","hien_thi=1 and cat='thu_vien_hinh_anh' ","ORDER BY thu_tu"); 
						$sum		=	$db->num_rows($sqltd); 
						if($sum>1){
					?>
						<ul >
						<?
						$me=0;
						while($r2=$db->fetch($sqltd))
						  { $me=$me+1; ?>
								<li  <?=$me==1?"style=border:none":""?> ><div class="m4"><a href="/thu-vien-hinh-anh/<?=$r2['id']?>/<?=lg_string::get_link($r2["ten"])?>">&raquo; <?=$r2['ten']?></a></div> </li>
						<? }?>
                        
						</ul>
					<? }?>
            </li>
            <li><div class="item_menu cufon_2 <?=$act=='khach_hang'?"activ":""?>" ><a href="/khach-hang/<?=$link?>">KHÁCH HÀNG</a></div></li>
             <li style="padding-top:10px;">
             	<div style="position:absolute; top:0px; left:0px; width:190px; height:140px; z-index:999;  cursor:pointer" onclick="Forward('/')" ></div>
             <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="190" height="140">
                                <param name="movie" value="/logo.swf">
                                <param name="quality" value="high">
                                <param name="allowScriptAccess" value="always">
                                <param name="wmode" value="transparent">
                                <embed src="/logo.swf" quality="high" type="application/x-shockwave-flash" wmode="transparent" pluginspage="http://www.macromedia.com/go/getflashplayer" allowscriptaccess="always" width="190" height="140">
                            </object></li>
            <li><div class="item_menu cufon_2 <?=$mod=='dich-vu'?"activ":""?>" ><a href="/view/dich-vu/<?=$link?>">DỊCH VỤ</a></div>
             <? $sqltd=$db->select("tgp_page","alias like 'dich_vu_%' ","ORDER BY alias"); 
							$sum		=	$db->num_rows($sqltd); 
							if($sum>1){
						?>
							<ul >
							<?
							$me=0;
							while($r2=$db->fetch($sqltd))
							  { $me=$me+1; ?>
									<li  <?=$me==1?"style=border:none":""?> ><div class="m4"><a href="/view/dich-vu/<?=$r2['id']?>/<?=lg_string::get_link($r2["ten"])?>">&raquo; <?=$r2['ten']?></a></div> </li>
							<? }?>	
							</ul>
						<? }?>
            </li>
            <li><div class="item_menu cufon_2 <?=$act=='tin_tuc'?"activ":""?>" ><a href="/tin-tuc/<?=$link?>">TIN TỨC - SỰ KIỆN</a></div>
            	 <? $sqltd=$db->select("tgp_cms_menu","hien_thi=1 and cat='tin_tuc' ","ORDER BY thu_tu"); 
						$sum		=	$db->num_rows($sqltd); 
						if($sum>1){
					?>
						<ul >
						<?
						$me=0;
						while($r2=$db->fetch($sqltd))
						  { $me=$me+1; ?>
								<li  <?=$me==1?"style=border:none":""?> ><div class="m4"><a href="/tin-tuc/<?=$r2['id']?>/<?=lg_string::get_link($r2["ten"])?>">&raquo; <?=$r2['ten']?></a></div> </li>
						<? }?>
                        
						</ul>
					<? }?>
            </li>
            <li><div class="item_menu cufon_2 <?=$mod=='lien-he'?"activ":""?>" ><a href="/view/lien-he/<?=$link?>">LIÊN HỆ</a></div></li>
           
        </ul>
        
        <div class="tiem_kiem">
				<form action="/tim-kiem/" method="get"  id="search" name="frmsearch">
					<div class="tim_1"><input  id="tim_kiem" class="tim" type="text" value="Tìm kiếm..." onClick="if(this.value=='Tìm kiếm...')this.value='';" onBlur="if(this.value=='')this.value='Tìm kiếm...';" name="q"  /></div>
					<div class="search_1"><input class="search" type="submit" value=""  style="cursor:pointer" /> </div>
					<input type="hidden" name="cx" value="005318581416524270332:pg9k_iy0nne" />
	<input type="hidden" name="cof" value="FORID:11" />
	<input type="hidden" name="ie" value="UTF-8" />
				</form>
				</div>
                
    </div>

</div>                                   
                                                                            
