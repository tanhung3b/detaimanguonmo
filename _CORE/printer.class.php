<?
class	lg_printer
{
	var		$lg;
	public	function	__construct($printer_name)
	{
		$this->lg	=	printer_open($printer_name);
	}
	public	function	__destruct()
	{
		printer_close($this->lg);
	}
}
?>