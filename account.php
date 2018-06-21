<?php
session_start();

include_once("functions/montage.php");

$montages = get_all_montage();
?>
<!DOCTYPE html>
<HTML>
  <header>
    <link rel="stylesheet" type="text/css" href="style/montage.css">
    <meta charset="UTF-8">
    <title>CAMAGRU - montage</title>
  </header>
  <body>
    <?php include('template/header.php') ?>
      <div class="body">
        <?php if(isset($_SESSION['id'])) { ?>
        <?php } else { ?>
          You need to connect to access to your account page
        <?php } ?>
      </div>
    <?php include('template/footer.php') ?>
  </body>
  <?php if(isset($_SESSION['id'])) { ?>
  <?php } ?>
</HTML>
