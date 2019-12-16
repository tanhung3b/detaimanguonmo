<?php
include("../config.php");
$db		=	new	lg_mysql($host,$dbuser,$dbpass,$csdl);

$label	=	array();
$data	=	array();
$y_min	=	0;
$y_max	=	0;

$sql	=	"ngay like '%/".lg_date::vn_other(time(),"m")."/".lg_date::vn_other(time(),"Y")."'";
$r		=	$db->select("tgp_online_daily",$sql,"order by ngay asc");
while ($row = $db->fetch($r))
{
	$label[]	=	str_replace("/".lg_date::vn_other(time(),"Y"),"", $row["ngay"]);
	$data[]		=	$row["bo_dem"];
	if ($y_max < $row["bo_dem"])	$y_max = $row["bo_dem"];
}

include_once( '../lib/ofc-library/open-flash-chart.php' );
$g = new graph();

$g->set_data( $data );
// $g->bar_glass( 55, '#5E83BF', '#424581' );

$g->set_x_labels( $label );
$g->set_x_label_style( 10, '#303030', 2 );

$g->y_min = 0;
$g->y_max = (round((($y_max)/10),0)+1)*10;
$g->y_steps = 2;
$g->title( ' ', '{font-size: 11px; }' );
echo $g->render();
?>