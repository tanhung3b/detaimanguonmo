<?
if (empty($HTTP_X_FORWARDED_FOR))
	$IP_NUMBER = getenv("REMOTE_ADDR");
else
	$IP_NUMBER = $HTTP_X_FORWARDED_FOR;
/*
	Sử dụng - để - load - các phần mở rộng - của - PHP - không có - trong - hệ thống
	Nên - sử dụng - phương thức này - trước - các lớp - đặc biệt - để - giảm - lỗi - thiếu - thư viện
	
*/
function	ext_load($name)
{
	if (!extension_loaded($name))
	{
    	if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
		{
        	@dl('php_'.$name.'.dll');
    	}
		else
		{
        	dl($name.'.so');
    	}
	}
}
function	write($txt)
{
	print($txt);
}
function	writeln($txt)
{
	print($txt."<br />");
}
?>