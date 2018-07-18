<?php
session_start();

require $_SERVER["DOCUMENT_ROOT"]."/functions/account.php";

// retreive values
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$npassword = $_POST['npassword'];
$lname = $_POST['lname'];
$fname = $_POST['fname'];
$notif = $_POST['notif'];
$uppercase = preg_match('@[A-Z]@', $npassword);
$lowercase = preg_match('@[a-z]@', $npassword);
$number    = preg_match('@[0-9]@', $npassword);

$_SESSION['error'] = null;
$userinfo = get_userinfo($_SESSION['id']);
if ($password == "" || $password == null)
{
	$_SESSION['error'] = "You need to fill your current password to change your informations";
	header("Location: ../account.php");
	return;
}

if (hash("whirlpool", $password) != $userinfo['password'])
{
	$_SESSION['error'] = "Wrong password";
	header("Location: ../account.php");
	return ;
}

//CHANGE EMAIL
if(($email != null || $email != "") && !filter_var($email, FILTER_VALIDATE_EMAIL))
{
	$_SESSION['error'] = "You need to enter a valid email";
	header("Location: ../account.php");
	return;
}
else if ($email != null || $email != "")
{
	if (email_taken($email))
	{
		$_SESSION['error'] = "Email already taken";
		header("Location: ../account.php");
		return;
	}
	$userinfo['email'] = $email;
}

//CHANGE USERNAME
if (($username != null || $username != "") && (strlen($username) < 4 || strlen($username) > 50))
{
	$_SESSION['error'] = "Username should be beetween 4 and 50 characters";
	header("Location: ../account.php");
	return;
}
else if ($username != null || $username != "")
{
	if ($username == $userinfo['username'])
	{
		$_SESSION['error'] = "You can't use the same username";
		header("Location: ../account.php");
		return;
	}
	$userinfo['username'] = $username;
}

//CHANGE FIRST NAME
if (($fname != null || $fname != "") && (strlen($fname) < 1 || strlen($fname) > 40))
{
	$_SESSION['error'] = "First name should be beetween 1 and 40 characters";
	header("Location: ../account.php");
	return;
}
else if ($fname != null || $fname != "")
{
	if ($fname == $userinfo['fname'])
	{
		$_SESSION['error'] = "You can't use the same first name";
		header("Location: ../account.php");
		return;
	}
	$userinfo['fname'] = $fname;
}

// CHANGE LAST NAME
if (($lname != null || $lname != "") && (strlen($lname) < 1 || strlen($lname) > 40))
{
	$_SESSION['error'] = "Last name should be beetween 1 and 40 characters";
	header("Location: ../account.php");
	return;
}
else if ($lname != null || $lname != "")
{
	if ($lname == $userinfo['lname'])
	{
		$_SESSION['error'] = "You can't use the same last name";
		header("Location: ../account.php");
		return;
	}
	$userinfo['lname'] = $lname;
}

// CHANGE PASSWORD
if (($npassword != null || $npassword != "") && (!$uppercase || !$lowercase || !$number || strlen($npassword) < 6 || strlen($npassword) > 40))
{
  $_SESSION['error'] = "Password should be beetween 8 and 40 characters and <br> contain at least 1 number, 1 uppercase and 1 lowercase.";
	header("Location: ../account.php");
	return;
}
else if ($npassword != null || $npassword != "")
{
	if ($npassword == $password)
	{
		$_SESSION['error'] = "You can't use the same password";
		header("Location: ../account.php");
		return;
	}
	$userinfo['password'] = hash("whirlpool", $npassword);
}

// CHANGE NOTIF PREFERENCE
if ($notif != null || $notif != "") {
	$userinfo['notif'] = $notif;
}

update_account($userinfo);
$_SESSION['error'] = "Your account has been updated";
header("Location: ../account.php");
?>