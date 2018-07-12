<?php
session_start();
?>
<!DOCTYPE html>
<HTML>
	<header>
		<link rel="stylesheet" type="text/css" href="style/index.css">
		<meta charset="UTF-8">
		<title>SIGNUP</title>
	</header>
	<body>
		<?php include('template/header.php') ?>
		<?php include('template/footer.php') ?>
		<div id="signup">
			<div class="title">SIGNUP</div>
			<div id="box">
				<form method="post" style="position: relative;" action="controller/signup.php">
					<label>Email: </label>
					<input id="mail" name="email" placeholder="email" type="mail">
					<label>Username: </label>
					<input id="name" name="username" placeholder="username" type="text">
					<label>First Name: </label>
					<input id='fname' name='fname' placeholder='First Name' type='text'>
					<label>Last Name: </label>
					<input id='lname' name='lname' placeholder='Last Name' type='text'>
					<label>Password: </label>
					<input id="password" name="password" placeholder="password" type="password">
					<input name="submit" type="submit" value=" SIGNUP ">
				</form>
			</div>
		</div>
		<?php
			echo $_SESSION['error'];
			$_SESSION['error'] = null;
			if (isset($_SESSION['signup_success'])) {
				echo "Signup success please check your mail box";
				$_SESSION['signup_success'] = null;
			}
		?>
	</body>
</HTML>
