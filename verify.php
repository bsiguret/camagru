<?php
session_start();
include_once './functions/verify.php';
?>
<!DOCTYPE html>
<HTML>
  <header>
    <link rel="stylesheet" type="text/css" href="style/index.css">
    <meta charset="UTF-8">
    <title>CAMAGRU - VERIFY</title>
  </header>
  <body>
    <?php include('template/header.php') ?>
    <?php include('template/footer.php') ?>
    <div id="login">
    <div class="title">VERIFY</div>
    <?php if (verify($_GET["token"]) == 0) { ?>
      <strong>
        Your account as been verified
      </strong>
    <?php } else { ?>
      <strong>
        Account not found
      </strong>
    <?php } ?>
    </div>
  </body>
</HTML>
