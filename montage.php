<?php
session_start();

require $_SERVER["DOCUMENT_ROOT"]."/functions/montage.php";

$montages = get_all_montage($_SESSION['id']);
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
    <?php include('template/footer.php') ?>
      <div class="body">
        <?php if(isset($_SESSION['id'])) { ?>
        <div class="main">
    		  <div class="select">
      			<img class="thumbnail" src="img/cadre.png"></img>
      			<input id="cadre.png" type="radio" name="img" value="./img/cadre.png" onclick="onCheckBoxChecked(this)">
      			<img class="thumbnail" src="img/cigarette.png"></img>
      			<input id="cigarette.png" type="radio" name="img" value="./img/cigarette.png" onclick="onCheckBoxChecked(this)">
      			<img class="thumbnail" src="img/hat.png"></img>
      			<input id="hat.png" type="radio" name="img" value="./img/hat.png" onclick="onCheckBoxChecked(this)">
    		  </div>
          <div class="container">
            <video autoplay="true" id="webcam"></video>
            <div id="camera-not-available">CAMERA NOT AVAILABLE</div>
            <img id="hat" style="display:none;" src="img/hat.png"></img>
            <img id="cigarette" style="display:none;" src="img/cigarette.png"></img>
            <img id="cadre" style="display:none;" src="img/cadre.png"></img>
            <div class="capture" id="pickImage">
              <img class="camera" src="img/camera.png"></img>
            </div>
            <canvas id="canvas" style="display:none;" width="640" height="480"></canvas>
            <div class="captureFile" id="pickFile">
              <img class="camera" src="img/camera.png"></img>
              <input type="file" id="take-picture" style="display:none;" accept="image/*">
            </div>
          </div>
        </div>
        <div class="side">
			<div class="title">Montages</div>
      <div id="miniatures">
        <?php
          $montage = "";
          if ($montages != null) {
            for ($i = 0; $montages[$i] ; $i++) {
              $class = "icon";
              if ($montages[$i]['user_id'] === $_SESSION['id']) {
                $class .= " removable";
              }
              $montage .= "<img class=\"" . $class . "\" src=\"./montage/" . $montages[$i]['path'] . "\" data-user_id=\"" . $montages[$i]['user_id'] . "\"></img>";
            }
            echo $montage;
          }
        ?>
      </div>
		</div>
        <?php } else { ?>
          You need to connect to use the montage
        <?php } ?>
      </div>
  </body>
  <?php if(isset($_SESSION['id'])) { ?>
  <script type="text/javascript" src="js/webcam.js"></script>
  <script type="text/javascript" src="js/drop.js"></script>
  <script type="text/javascript" src="js/import.js"></script>
  <?php print_r($_SESSION['rmontage']); } ?>
</HTML>
