<?
//	script này dùng để gởi - 1 bức thư - để gởi đi
/*
	$email	=	new lg_mail();
	$email->from_name	=	"Phan Hoàng Huy";
	$email->from_email	=	"hoanghuydn@gmail.com";
	$email->to_email	=	"";
	$email->subject		=	"";
	$email->message		=	"";
	$email->file		=	array("","","");
*/
class	lg_mail
{
	var		$from_name		=	" ";
	var		$from_email		=	"hoanghuydn@gmail.com";
	var		$to_email		=	"hoanghuydn@gmail.com";
	var		$subject;
	var		$message;
	var		$file;
	
	public	function	__construct()
	{
	}
	public	function	__destruct()
	{
	}
	public	function	send($to_email = "")
	{
		$headers = "From: ".$from_name."<".$from_email.">";
		$semi_rand				=	md5(time());
		$mime_boundary	=	"==Multipart_Boundary_x{$semi_rand}x"; 
		
 		$message = "This is a multi-part message in MIME format.\n\n"
			."--{$mime_boundary}\n"
			."Content-Type:text/html; charset=\"utf-8\"\n"
			."Content-Transfer-Encoding: 7bit\n\n" . $this->message . "\n\n"; 
		
		// if (!empty(trim($to_email)))	$this->to_email = $to_email;
		return	@mail($this->to_email, $this->subject, $message, $headers);
	}
}
?>