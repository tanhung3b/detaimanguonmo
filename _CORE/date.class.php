<?
/* -------- class lg_date ---------

public	vn_time($time [, $gmt = 7])				:	chuyển time() sang d/m/Y H:i:s của Việt Nam
public	vn_date($time [, $gmt = 7])				:	chuyển time() sang d/m/Y của Việt Nam
public	vn_other($time, $phare [, $gmt = 7])	:	chuyển time sang $phare của Việt Nam

public	time($time, $gmt)						:	chuyển time() sang d/m/Y H:i:s theo GMT
public	date($time, $gmt)						:	chuyển time() sang d/m/Y theo GMT

public	dmy2ymd($time)							:	chuyển chuỗi ngày/tháng/năm <-> năm/tháng/ngày & ngược lại

--------------------------------- */
class	lg_date
{
	public	function	vn_time($time, $gmt = 7)
	{
		return		self::time($time,$gmt);
	}
	public	function	vn_date($time, $gmt = 7)
	{
		return		self::date($time,$gmt);
	}
	public	function	vn_other($time,$phare, $gmt = 7)
	{
		$zone		=	3600*7;
		$out_date	=	gmdate($phare , $time + $zone);
		return		$out_date;
	}
	
	public	function	time($time, $gmt)
	{
		$zone		=	3600*$gmt;
		$out_date	=	gmdate("d/m/Y H:i:s", $time + $zone);
		return		$out_date;
	}
	public	function	date($time, $gmt)
	{
		$zone		=	3600*$gmt;
		$out_date	=	gmdate("d/m/Y" , $time + $zone);
		return		$out_date;
	}
	
	public	function	dmy2ymd($time)
	{
		$kq = $time;
		if (strpos($time,":") > 0)
		{
			$y = substr($time,-6);
			$time = substr($time,0,-6);
		}
		
		if (strpos($time,"/")	> 0)
		{
			$x	=	explode("/",$time);
			$kq = $x[2]."/".$x[1]."/".$x[0];
		}
		else if (strpos($time,"-")	> 0)
		{
			$x	=	explode("-",$time);
			$kq = $x[2]."/".$x[1]."/".$x[0];
		}
		return $kq.$y;
	}
	public	function	zone($string, $gmt = 7)
	{
		list($dd,$mm,$yy)	=	explode("/",$string);
		if (@checkdate($mm,$dd,$yy) == false)
		{
			return 0;
		}
		else
		{
			return gmmktime(0,0,0,($mm+0),($dd+0),($yy+0)) - ($zone*7);
		}
	}
}
?>