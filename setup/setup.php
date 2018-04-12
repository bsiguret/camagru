#!/usr/bin/php
<?php
include 'database.php';

// CREATE DATABASE
try {
        $dbh = new PDO($DB_DSN_LIGHT, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE `".$DB_NAME."`";
        $dbh->exec($sql);
        echo "Database created successfully\n";
    } catch (PDOException $element) {
        echo "ERROR CREATING DB: \n".$e->getMessage();
        exit(-1);
    }

// CREATE TABLE USER
try {
        // Connect to DATABASE previously created
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `User` (
            `user_id`    INT NOT NULL AUTO_INCREMENT ,
            `login`      VARCHAR(64) NOT NULL ,
            `password`   VARCHAR(64) NOT NULL ,
            `email`      VARCHAR(255) NOT NULL ,
            `first_name` VARCHAR(255) NOT NULL ,
            `last_name`  VARCHAR(255) NOT NULL ,
            `token`      VARCHAR(255) NOT NULL ,          
            PRIMARY KEY (`user_id`)
        )";
        $dbh->exec($sql);
        echo "Table User created successfully\n";
    } catch (PDOException $e) {
        echo "ERROR CREATING TABLE: ".$e->getMessage()."\nAborting process\n";
    }

    // CREATE TABLE COMMENT
try {
        // Connect to DATABASE previously created
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `Comment` (
            `id_preference` INT NOT NULL AUTO_INCREMENT ,
            `user_id`       INT NOT NULL ,
            `email_notif`   BIT NOT NULL ,
            PRIMARY KEY (`id_preference`, `user_id`),
            KEY `fkIdx_57` (`user_id`),
            CONSTRAINT `FK_57` FOREIGN KEY `fkIdx_57` (`user_id`) REFERENCES `User` (`user_id`)
        )";
        $dbh->exec($sql);
        echo "Table Comment created successfully\n";
    } catch (PDOException $e) {
        echo "ERROR CREATING TABLE: ".$e->getMessage()."\nAborting process\n";
    }

    // CREATE TABLE FILTER
try {
        // Connect to DATABASE previously created
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `Filter` (
            `filter_id` INT NOT NULL AUTO_INCREMENT ,
            `path`      VARCHAR(255) NOT NULL ,
            PRIMARY KEY (`filter_id`)
        )";
        $dbh->exec($sql);
        echo "Table Filter created successfully\n";
    } catch (PDOException $e) {
        echo "ERROR CREATING TABLE: ".$e->getMessage()."\nAborting process\n";
    }

    // CREATE TABLE HASHTAG
try {
        // Connect to DATABASE previously created
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `Hashtag` (
            `hashtag_id` INT NOT NULL AUTO_INCREMENT ,
            `name`       VARCHAR(255) NOT NULL ,

            PRIMARY KEY (`hashtag_id`)
        )";
        $dbh->exec($sql);
        echo "Table Hashtag created successfully\n";
    } catch (PDOException $e) {
        echo "ERROR CREATING TABLE: ".$e->getMessage()."\nAborting process\n";
    }

    // CREATE TABLE LIKE
try {
        // Connect to DATABASE previously created
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `Like` (
            `like_id`  INT NOT NULL AUTO_INCREMENT ,
            `user_id`  INT NOT NULL ,
            `image_id` INT NOT NULL ,
            `liked`    BIT NOT NULL ,
            PRIMARY KEY (`like_id`, `user_id`, `image_id`),
            KEY `fkIdx_38` (`user_id`),
            CONSTRAINT `FK_38` FOREIGN KEY `fkIdx_38` (`user_id`) REFERENCES `User` (`user_id`),
            KEY `fkIdx_47` (`image_id`),
            CONSTRAINT `FK_47` FOREIGN KEY `fkIdx_47` (`image_id`) REFERENCES `Image` (`image_id`)
        )";
        $dbh->exec($sql);
        echo "Table Like created successfully\n";
    } catch (PDOException $e) {
        echo "ERROR CREATING TABLE: ".$e->getMessage()."\nAborting process\n";
    }

    // CREATE TABLE PREFERENCE
try {
        // Connect to DATABASE previously created
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `Preference` (
            `id_preference` INT NOT NULL AUTO_INCREMENT ,
            `user_id`       INT NOT NULL ,
            `email_notif`   BIT NOT NULL ,

            PRIMARY KEY (`id_preference`, `user_id`),
            KEY `fkIdx_57` (`user_id`),
            CONSTRAINT `FK_57` FOREIGN KEY `fkIdx_57` (`user_id`) REFERENCES `User` (`user_id`)
        )";
        $dbh->exec($sql);
        echo "Table Preference created successfully\n";
    } catch (PDOException $e) {
        echo "ERROR CREATING TABLE: ".$e->getMessage()."\nAborting process\n";
    }

    // CREATE TABLE IMAGE
try {
        // Connect to DATABASE previously created
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `Image` (
            `image_id`      INT NOT NULL AUTO_INCREMENT ,
            `path`          VARCHAR(255) NOT NULL ,
            `description`   VARCHAR(150) NOT NULL ,
            `creation_date` DATE NOT NULL ,
            `nb_like`       INT NOT NULL ,
            PRIMARY KEY (`image_id`)
        )";
        $dbh->exec($sql);
        echo "Table Image created successfully\n";
    } catch (PDOException $e) {
        echo "ERROR CREATING TABLE: ".$e->getMessage()."\nAborting process\n";
    }

    // CREATE TABLE HASHTAG_IMAGE
try {
        // Connect to DATABASE previously created
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `hashtag_image` (
            `hashtag_image_id` INT NOT NULL AUTO_INCREMENT ,
            `image_id`         INT NOT NULL ,
            `hashtag_id`       INT NOT NULL ,
            PRIMARY KEY (`hashtag_image_id`, `image_id`, `hashtag_id`),
            KEY `fkIdx_79` (`image_id`),
            CONSTRAINT `FK_79` FOREIGN KEY `fkIdx_79` (`image_id`) REFERENCES `Image` (`image_id`),
            KEY `fkIdx_83` (`hashtag_id`),
            CONSTRAINT `FK_83` FOREIGN KEY `fkIdx_83` (`hashtag_id`) REFERENCES `hashtag` (`hashtag_id`)
        )";
        $dbh->exec($sql);
        echo "Table hashtag_image created successfully\n";
    } catch (PDOException $e) {
        echo "ERROR CREATING TABLE: ".$e->getMessage()."\nAborting process\n";
    }
?>