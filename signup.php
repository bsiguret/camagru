<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SIGNUP</title>
    <link rel="stylesheet" type="text/css" href="views/index.css">
</head>
<body>
    <?php include('template/header.php') ?>
    <?php include('template/footer.php') ?>
    <div id='signup'>
        <div class='title'>SIGNUP</div>
        <div id='box'>
            <form action="controller/signup.php" style='position: relative;' method="post">
                <label>Email: </label>
                <input id='mail' name='email' placeholder='Email' type='mail'>
                <label>Username: </label>
                <input id='username' name='username' placeholder='Username' type='text'>
                <label>First Name: </label>
                <input id='fname' name='fname' placeholder='First Name' type='text'>
                <label>Last Name: </label>
                <input id='lname' name='lname' placeholder='Last Name' type='text'>
                <label>Password: </label>
                <input id='password' name='password' placeholder='password' type='password'>
                <input name='submit' type='submit' value='signup'>
                <span>
                    <?php
                    echo $_SESSION['error'];
                    $_SESSION['error'] = null;
                    if (isset($_SESSION['signup_success'])) {
                        echo 'Signup success please check your email';
                        $_SESSION['signup_sucess'] = null;
                    }
                    ?>
                </span>
            </form>
        </div>
    </div>
</body>
</html>