<?php
session_start();

foreach ($_SESSION as $key => $value) {
    echo $_SESSION[$key] = null;
}

header("Location: ../index.php");

?>
