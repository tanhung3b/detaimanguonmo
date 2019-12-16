<?php
if ($logout == "OK")
{
	$_SESSION["login_admin_user"] = "";
	$_SESSION["login_admin_pass"] = "";
}

// session

if (empty($_SESSION["login_admin_user"]))
	$login_admin_user	=	"";
else
	$login_admin_user	=	$_SESSION["login_admin_user"];

if (empty($_SESSION["login_admin_pass"]))
	$login_admin_pass	=	"";
else
	$login_admin_pass	=	$_SESSION["login_admin_pass"];

// post

if (!empty($_POST["log_admin_user"]))
{
	$login_admin_user				=	$_POST["log_admin_user"];
	$_SESSION["login_admin_user"]	=	$login_admin_user;
}
if (!empty($_POST["log_admin_pass"]))
{
	$login_admin_pass				=	$_POST["log_admin_pass"];
	$_SESSION["login_admin_pass"]	=	$login_admin_pass;
}
?>