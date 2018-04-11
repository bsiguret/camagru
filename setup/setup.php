#!/usr/bin/php
<?php
include 'database.php';

// CREATE DATABASE
    try {
        $dbh = new PDO($DB_DSN_LIGHT, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE `".$DB_NAME."`";
        $dbh->exec($sql);
        echo "Databse created successfully\n";
    } catch (PDOException $element) {
        echo "ERROR CREATING DB: \n".$e->getMessage();
        exit(-1);
    }
?>