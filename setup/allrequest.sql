-- ****************** SqlDBM: MySQL ******************;
-- ***************************************************;


-- ************************************** `filter`

CREATE TABLE `Filter`
(
 `filter_id` INT NOT NULL AUTO_INCREMENT ,
 `path`      VARCHAR(255) NOT NULL ,

PRIMARY KEY (`filter_id`)
);





-- ************************************** `hashtag`

CREATE TABLE `Hashtag`
(
 `hashtag_id` INT NOT NULL AUTO_INCREMENT ,
 `name`       VARCHAR(255) NOT NULL ,

PRIMARY KEY (`hashtag_id`)
);





-- ************************************** `Image`

CREATE TABLE `Image`
(
 `image_id`      INT NOT NULL AUTO_INCREMENT ,
 `path`          VARCHAR(255) NOT NULL ,
 `description`   VARCHAR(150) NOT NULL ,
 `creation_date` DATE NOT NULL ,
 `nb_like`       INT NOT NULL ,

PRIMARY KEY (`image_id`)
);





-- ************************************** `User`

CREATE TABLE `User`
(
 `user_id`    INT NOT NULL AUTO_INCREMENT ,
 `login`      VARCHAR(64) NOT NULL ,
 `password`   VARCHAR(64) NOT NULL ,
 `email`      VARCHAR(255) NOT NULL ,
 `first_name` VARCHAR(255) NOT NULL ,
 `last_name`  VARCHAR(255) NOT NULL ,
 `token`      VARCHAR(255) NOT NULL ,

PRIMARY KEY (`user_id`)
);





-- ************************************** `hashtag_image`

CREATE TABLE `hashtag_image`
(
 `hashtag_image_id` INT NOT NULL AUTO_INCREMENT ,
 `image_id`         INT NOT NULL ,
 `hashtag_id`       INT NOT NULL ,

PRIMARY KEY (`hashtag_image_id`, `image_id`, `hashtag_id`),
KEY `fkIdx_79` (`image_id`),
CONSTRAINT `FK_79` FOREIGN KEY `fkIdx_79` (`image_id`) REFERENCES `Image` (`image_id`),
KEY `fkIdx_83` (`hashtag_id`),
CONSTRAINT `FK_83` FOREIGN KEY `fkIdx_83` (`hashtag_id`) REFERENCES `hashtag` (`hashtag_id`)
);





-- ************************************** `Preference`

CREATE TABLE `Preference`
(
 `id_preference` INT NOT NULL AUTO_INCREMENT ,
 `user_id`       INT NOT NULL ,
 `email_notif`   BIT NOT NULL ,

PRIMARY KEY (`id_preference`, `user_id`),
KEY `fkIdx_57` (`user_id`),
CONSTRAINT `FK_57` FOREIGN KEY `fkIdx_57` (`user_id`) REFERENCES `User` (`user_id`)
);





-- ************************************** `Like`

CREATE TABLE `Like`
(
 `like_id`  INT NOT NULL AUTO_INCREMENT ,
 `user_id`  INT NOT NULL ,
 `image_id` INT NOT NULL ,
 `liked`    BIT NOT NULL ,

PRIMARY KEY (`like_id`, `user_id`, `image_id`),
KEY `fkIdx_38` (`user_id`),
CONSTRAINT `FK_38` FOREIGN KEY `fkIdx_38` (`user_id`) REFERENCES `User` (`user_id`),
KEY `fkIdx_47` (`image_id`),
CONSTRAINT `FK_47` FOREIGN KEY `fkIdx_47` (`image_id`) REFERENCES `Image` (`image_id`)
);





-- ************************************** `Comment`

CREATE TABLE `Comment`
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
);