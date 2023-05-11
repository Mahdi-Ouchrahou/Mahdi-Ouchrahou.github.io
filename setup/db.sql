
CREATE DATABASE `web-app-db`;
USE `web-app-db`;

CREATE TABLE `users` (
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `college` varchar(50) NOT NULL,
  `block` char(10) NOT NULL,
  `userid` int(30) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `email` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `calls` (
  `callid` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `data` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `author` int(30) NOT NULL,
  `picked_up_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`callid`),
  KEY `author` (`author`),
  CONSTRAINT `calls_ibfk_1` FOREIGN KEY (`author`) REFERENCES `users` (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;