<?php

function log_user($userEmail, $password) {
	require $_SERVER["DOCUMENT_ROOT"]."/config/database.php";
	try {
			$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query= $dbh->prepare("SELECT `user_id`, username, fname, lname FROM user WHERE email=:email AND password=:password AND verified='Y'");
			$userMail = strtolower($userEmail);
			$password = hash("whirlpool", $password);
			$query->execute(array(':email' => $userEmail, ':password' => $password));

			$val = $query->fetch();
			if ($val == null) {
					$query->closeCursor();
					return (-1);
			}
			$query->closeCursor();
			return ($val);
		} catch (PDOException $e) {
			return ($e->getMessage());
		}
}

?>
