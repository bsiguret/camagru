<?php

function verify($token) {
	require $_SERVER["DOCUMENT_ROOT"]."/setup/database.php";
	try {
			$dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
			$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$query= $dbh->prepare("SELECT `user_id` FROM user WHERE token=:token");
			$query->execute(array(':token' => $token));

			$val = $query->fetch();
			if ($val == null) {
					return (-1);
			}
			$query->closeCursor();

			$query= $dbh->prepare("UPDATE user SET verified='Y' WHERE `user_id`=:user_id");
			$query->execute(array('user_id' => $val['user_id']));
			$query->closeCursor();
			return (0);
		} catch (PDOException $e) {
			return (-2);
		}
}

?>
