<?php
include 'database.php';
// CREATE DATABASE
try {
        $dbh = new PDO($DB_DSN_LIGHT, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE DATABASE `".$DB_NAME."`";
        $dbh->exec($sql);
        echo "Database created successfully</br>";
    } catch (PDOException $element) {
        echo "ERROR CREATING DB: \n".$e->getMessage();
        exit(-1);
    }

    // CREATE TABLE FILTER
try {
        // Connect to DATABASE previously created
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `Filter`
                (
                `filter_id` INT NOT NULL AUTO_INCREMENT ,
                `path`      VARCHAR(255) NOT NULL ,

                PRIMARY KEY (`filter_id`)
                ) ENGINE=INNODB";
        $dbh->exec($sql);
        echo "Table Filter created successfully</br>";
    } catch (PDOException $e) {
        echo "ERROR CREATING TABLE (Filter): ".$e->getMessage()."\nAborting process\n";
    }

    // CREATE TABLE IMAGE
try {
        // Connect to DATABASE previously created
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `Image`
        (
                `image_id`      INT NOT NULL AUTO_INCREMENT ,
                `user_id`       INT NOT NULL ,
                `path`          VARCHAR(255) NOT NULL ,
                `creation_date` DATETIME DEFAULT CURRENT_TIMESTAMP ,
        
        PRIMARY KEY (`image_id`)
        ) ENGINE=INNODB;";
        $dbh->exec($sql);
        echo "Table Image created successfully</br>";
    } catch (PDOException $e) {
        echo "ERROR CREATING TABLE (image): ".$e->getMessage()."\nAborting process\n";
    }

// CREATE TABLE USER
try {
        // Connect to DATABASE previously created
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `User`
                (
                `user_id`    INT NOT NULL AUTO_INCREMENT ,
                `username`   VARCHAR(64) NOT NULL ,
                `password`   VARCHAR(255) NOT NULL ,
                `email`      VARCHAR(255) NOT NULL ,
                `fname`      VARCHAR(255) NOT NULL ,
                `lname`		 VARCHAR(255) NOT NULL ,
                `token`      VARCHAR(255) NOT NULL ,
                `verified`   VARCHAR(1) NOT NULL DEFAULT 'N' ,

                PRIMARY KEY (`user_id`)
                ) ENGINE=INNODB";
        $dbh->exec($sql);
        echo "Table User created successfully</br>";
    } catch (PDOException $e) {
        echo "ERROR CREATING TABLE (user): ".$e->getMessage()."\nAborting process\n";
    }

    // CREATE TABLE PREFERENCE
// try {
//         // Connect to DATABASE previously created
//         $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
//         $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//         $dbh->engine = 'InnoDB';
//         $sql = "CREATE TABLE `Preference`
//                 (
//                 `id_preference` INT NOT NULL AUTO_INCREMENT ,
//                 `user_id`       INT NOT NULL ,
//                 `email_notif`   BIT NOT NULL ,

//                 PRIMARY KEY (`id_preference`, `user_id`),
//                 KEY `fkIdx_57` (`user_id`),
//                 CONSTRAINT `FK_57` FOREIGN KEY `fkIdx_57` (`user_id`) REFERENCES `User` (`user_id`)
//                 ) ENGINE=INNODB";
//         $dbh->exec($sql);
//         echo "Table Preference created successfully</br>";
//     } catch (PDOException $e) {
//         echo "ERROR CREATING TABLE (preference): ".$e->getMessage()."\nAborting process\n";
//     }

    // CREATE TABLE LIKE
try {
        // Connect to DATABASE previously created
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `Like`
                (
                `like_id`  INT NOT NULL AUTO_INCREMENT ,
                `user_id`  INT NOT NULL ,
                `image_id` INT NOT NULL ,
                `liked`    INT NOT NULL ,

                PRIMARY KEY (`like_id`, `user_id`, `image_id`),
                KEY `fkIdx_38` (`user_id`),
                CONSTRAINT `FK_38` FOREIGN KEY `fkIdx_38` (`user_id`) REFERENCES `User` (`user_id`),
                KEY `fkIdx_47` (`image_id`),
                CONSTRAINT `FK_47` FOREIGN KEY `fkIdx_47` (`image_id`) REFERENCES `Image` (`image_id`)
                ) ENGINE=INNODB";
        $dbh->exec($sql);
        echo "Table Like created successfully</br>";
    } catch (PDOException $e) {
        echo "ERROR CREATING TABLE (like): ".$e->getMessage()."\nAborting process\n";
    }

    // CREATE TABLE COMMENT
try {
        // Connect to DATABASE previously created
        $dbh = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "CREATE TABLE `Comment`
                (
                `comment_id` INT NOT NULL AUTO_INCREMENT ,
                `user_id`    INT NOT NULL ,
                `image_id`   INT NOT NULL ,
                `text`       VARCHAR(150) NOT NULL ,

                PRIMARY KEY (`comment_id`, `user_id`, `image_id`),
                KEY `fkIdx_32` (`user_id`),
                CONSTRAINT `FK_32` FOREIGN KEY `fkIdx_32` (`user_id`) REFERENCES `User` (`user_id`),
                KEY `fkIdx_62` (`image_id`),
                CONSTRAINT `FK_62` FOREIGN KEY `fkIdx_62` (`image_id`) REFERENCES `Image` (`image_id`)
                ) ENGINE=INNODB";
        $dbh->exec($sql);
        echo "Table Comment created successfully</br>";
    } catch (PDOException $e) {
        echo "ERROR CREATING TABLE (comment): ".$e->getMessage()."\nAborting process\n";
    }
?>