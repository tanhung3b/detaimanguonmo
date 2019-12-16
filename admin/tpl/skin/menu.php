<?php
$menu[0]		=	"Quản lý nội dung";
	$name[0][0]	=	"Quản lý Tin tức";					$link[0][0]	=	"?act=cms_manager";
	$name[0][1]	=	"Quản lý Hình ảnh";					$link[0][1]	=	"?act=gallery_manager";
	$name[0][2]	=	"Quản lý khách hàng";					$link[0][2]	=	"?act=camnhan_list";
	$name[0][3]	=	"Quản lý Trang nội dung";			$link[0][3]	=	"?act=page_list";

	$name[0][4]	=	"Thông tin khác";					$link[0][4]	=	"?act=other";
	$name[0][5]	=	"Quản lý đối tác";					$link[0][5]	=	"?act=doitac_manager";



		
$menu[1]		=	"Công cụ";
	$name[1][0]	=	"Sao lưu CSDL";			$link[1][0]	=	"?act=backup";

$menu[2]		=	"Quản trị hệ thống";
	$name[2][0]	=	"Quản lý Thành viên";	$link[2][0]	=	"?act=member_list";
?>
<div id="fw_menu">
	<ul id="menu_1">
		<li onclick="Forward('?act=home');">Trang chủ</li>
		<?
		for ($i = 0; $i < count($menu); $i++)
		{
		echo "<li>".$menu[$i];
		echo "<ul>";
			for ($j = 0; $j < count($name[$i]); $j++)
			{
				echo "<li onclick=\"Forward('".$link[$i][$j]."');\">".$name[$i][$j]."</li>";
			}
		echo "</ul>";
		echo "</li>";
		}
		?>
	</ul>
	<div id="tool">
		<a href="javascript:_postback();" onclick="Forward('?logout=OK');"><img border="0" src="images/logout.png" /></a>
	</div>
</div>
<div id="fw_menu_2"></div>