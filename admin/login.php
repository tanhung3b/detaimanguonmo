<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" media="screen, projection" href="tpl/login.css" />
<title>Administration Control Panel - Đăng nhập</title>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="js/pngfix.js"></script>
<!--[if lte IE 6]>
<style type="text/css">
.clearfix {height: 1%;}
</style>
<![endif]-->

<!--[if gte IE 7.0]>
<style type="text/css">
.clearfix {display: inline-block;}
</style>
<![endif]-->

</head>
<body>
<script language=JavaScript>
<!--

//Disable right mouse click Script

var message="Function Disabled!";

///////////////////////////////////
function clickIE4(){
if (event.button==2){
alert(message);
return false;
}
}

function clickNS4(e){
if (document.layers||document.getElementById&&!document.all){
if (e.which==2||e.which==3){
alert(message);
return false;
}
}
}

if (document.layers){
document.captureEvents(Event.MOUSEDOWN);
document.onmousedown=clickNS4;
}
else if (document.all&&!document.getElementById){
document.onmousedown=clickIE4;
}

document.oncontextmenu=new Function("return false")


function disableSelection(target){
if (typeof target.onselectstart!="undefined") //IE route
	target.onselectstart=function(){return false}
else if (typeof target.style.MozUserSelect!="undefined") //Firefox route
	target.style.MozUserSelect="none"
else //All other route (ie: Opera)
	target.onmousedown=function(){return false}
target.style.cursor = "default"
}
disableSelection(document.body);
// --> 
</script>
<div id="wrapper">
    <div class="tgp_container">
        <div class="logo"></div>
        <div class="div_1"></div>
        <div class="div_2">
            <div class="title"><span>Flatlock 2.0</span><br/><div>Hệ thống quản trị Website</div></div> <div class="icon"></div>
        </div>
        <div class="div_3">
            <div class="wrapper">
                <div class="form_login">
                <form method="post">
                    <table width="100%" border="0" cellspacing="0" cellpadding="5">
                      <tr>
                        <td width="30%" align="right">Tên người dùng :</td>
                        <td width="65%" align="right"><input class="inputbox" type="text" autocomplete="off" name="log_admin_user" value="<?=$_SESSION["login_admin_user"]?>" /></td>
                      </tr>
                      <tr>
                        <td align="right">Mật khẩu :</td>
                        <td align="right"><input class="inputbox"  type="password" name="log_admin_pass" /></td>
                      </tr>
                      <tr>
                        <td></td>
                        <td align="right"><input class="button" type="submit" value="Đăng nhập" /></td>
                      </tr>
                      <tr>
                        <td align="right" colspan="2"><font color="#990000"><?=$error_text?></font></td>
                        <input type="hidden" id="da_dang_nhap" value="<?=$da_dang_nhap?>" />
                      </tr>
                    </table>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
   $(document).pngFix();
   if (document.getElementsByName("log_admin_user").item(0).value != "")
   {
	   $(".div_3").fadeIn();
   }
});


$(".icon").toggle(
function()
{
	$(".div_3").fadeIn();
},
function()
{
	$(".div_3").fadeOut();
});
</script>

</body>
</html>
