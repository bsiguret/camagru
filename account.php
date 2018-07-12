<?php
session_start();

require $_SERVER["DOCUMENT_ROOT"]."/functions/account.php";

$account = get_account($_SESSION['id']);
?>
<!DOCTYPE html>
<HTML>
	<header>
		<link rel="stylesheet" type="text/css" href="style/index.css">
		<meta charset="UTF-8">
		<title>CAMAGRU - My account</title>
	</header>
	<body>
		<?php include('template/header.php') ?>
		<?php include('template/footer.php') ?>
		<div id="account">
			<div class="title">ACCOUNT</div>
			<div id="box">
				<?php if(isset($_SESSION['id'])) { ?>
					<form method="post" style="position: relative;" action="controller/account.php">
					<label>Username: </label>
					<input id="username" name="username" placeholder=<?php print_r(htmlspecialchars($account['username'])) ?>>
					<label>Email: </label>
					<input id="mail" name="email" placeholder=<?php print_r(htmlspecialchars($account['email'])) ?> type="mail">
					<label>First Name: </label>
					<input id="fname" name="fname" placeholder=<?php print_r(htmlspecialchars($account['fname'])) ?>>
					<label>Last Name: </label>
					<input id="lname" name="lname" placeholder=<?php print_r(htmlspecialchars($account['lname'])) ?>>
					<label> Notification comment: </label>
					<input type='hidden' name='notif' value="N" checked>
					<input type="checkbox" name="notif" value="Y" <?php if($account['notif'] == "Y") echo "checked" ?>>
					<label>Password: </label>
					<input id="password" name="password" placeholder="Current password" type="password">
					<label>New password: </label>
					<input id="npassword" name="npassword" placeholder="New password" type="password">
					<input name="submit" type="submit" value="MODIFY">
				<?php } else { ?>
					<span> You need to be connected to access your account. </span>
				</form>
				<?php } ?>
			</div>
		</div>
		<?php
		?>
		<?php
			if ($_SESSION['error']) {
				echo $_SESSION['error'];
			}
			$_SESSION['error'] = null;
		?>
	</body>
</HTML>
