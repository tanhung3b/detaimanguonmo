<?
class	rar_file
{
	var		$src;
	public	function	__construct($file_name, $file_password = "")
	{
		//	Kiểm tra - và - load - thành phần - php_RAR.dll
		ext_load('rar');
		$this->src	=	rar_open($file_name, $file_password);
	}
	public	function	__destruct()
	{
		rar_close($src);
	}
}	
?>