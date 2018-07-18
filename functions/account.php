<?php
function get_account($uid) {
	require $_SERVER["DOCUMENT_ROOT"]."/config/database.php";
	try {
		$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query= $dbh->prepare("SELECT `username`, `email`, `fname`, `lname`, `notif` FROM user WHERE user_id=:user_id");
		$query->execute(array(':user_id' => $uid));
		$val = $query->fetch();
		$query->closeCursor();

		return ($val);
	} catch (PDOException $e) {
		return ($e->getMessage());
	}
}

function get_userinfo($uid) {
	require $_SERVER["DOCUMENT_ROOT"]."/config/database.php";
	try {
		$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query= $dbh->prepare("SELECT * FROM user WHERE `user_id`=:user_id");
		$query->execute(array(':user_id' => $uid));

		$val = $query->fetch();
		$query->closeCursor();

		return ($val);
	} catch (PDOException $e) {
		return ($e->getMessage());
	}
}

function email_taken($email)
{
	require $_SERVER["DOCUMENT_ROOT"]."/config/database.php";
	try {
		$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$query= $dbh->prepare("SELECT `email` FROM user WHERE `email`=:email");
		$query->execute(array(':email' => $email));

		$val = $query->fetch();
		$query->closeCursor();
		if ($val['email'] != null || $val['email'] != "")
			return (1);
		return (0);
	} catch (PDOException $e) {
		return ($e->getMessage());
	}
}

function update_account($uinfo)
{
	require $_SERVER["DOCUMENT_ROOT"]."/config/database.php";
	try {
		$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	$query= $dbh->prepare("UPDATE user SET `email`=:email, `password`=:password, `username`=:username, `lname`=:lname, `fname`=:fname,
		`notif`=:notif WHERE `user_id`=:user_id");
		$query->execute(array(':user_id' => $uinfo['user_id'], ':email' => $uinfo['email'], ':password' => $uinfo['password'],
		':username' => $uinfo['username'], ':lname' => $uinfo['lname'], ':fname' => $uinfo['fname'], ':notif' => $uinfo['notif']));

		$val = $query->fetch();
		$query->closeCursor();

		return ($val);
	} catch (PDOException $e) {
		return ($e->getMessage());
	}
}
?>
