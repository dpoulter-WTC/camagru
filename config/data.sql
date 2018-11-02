DROP DATABASE if exists `camagru`;

CREATE DATABASE if not exists `camagru`
  DEFAULT CHARACTER SET utf8;

USE `camagru`;

CREATE TABLE if not exists `camagru`.`users` (
  `id` INT UNIQUE NOT NULL AUTO_INCREMENT,
  `login` VARCHAR(20) UNIQUE NOT NULL,
  `passwd` VARCHAR(200) NOT NULL,
  `email` VARCHAR(100) UNIQUE NOT NULL,
  `profile_pic` VARCHAR(100) NOT NULL DEFAULT 'resources/profile/profile.jpg',
  `token` VARCHAR(10) UNIQUE NOT NULL,
  `confirmed` BOOLEAN DEFAULT false,
  PRIMARY KEY (`id`, `login`)
);

CREATE TABLE if not exists `camagru`.`photos` (
  `id` INT UNIQUE NOT NULL AUTO_INCREMENT,
  `userid` INT NOT NULL,
  `url` VARCHAR(100) UNIQUE NOT NULL,
  `likes` INT NOT NULL,
  `creation_date` DATE NOT NULL,
  PRIMARY KEY (`id`)
);

CREATE TABLE if not exists `camagru`.`comments` (
  `userid` INT NOT NULL,
  `imgid` INT NOT NULL,
  `content` VARCHAR(140) NOT NULL
);
