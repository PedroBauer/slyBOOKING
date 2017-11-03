-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 26. Nov 2015 um 11:48
-- Server Version: 5.5.32
-- PHP-Version: 5.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `ipa_complete`
--
CREATE DATABASE IF NOT EXISTS `ipa_complete` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `ipa_complete`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `booking`
--

CREATE TABLE IF NOT EXISTS `booking` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `person_count` tinyint(3) unsigned DEFAULT NULL,
  `time_of_day` enum('Morning','Afternoon','WholeDay') DEFAULT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `room_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `user_id` (`user_id`),
  KEY `room_id` (`room_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Daten für Tabelle `booking`
--

INSERT INTO `booking` (`ID`, `date`, `person_count`, `time_of_day`, `user_id`, `room_id`) VALUES
(1, '2015-11-25', 50, 'Afternoon', 1, 1),
(4, '2015-11-30', 35, 'WholeDay', 1, 8);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `room`
--

CREATE TABLE IF NOT EXISTS `room` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(60) NOT NULL,
  `description` text NOT NULL,
  `price_morning` float NOT NULL,
  `price_afternoon` float NOT NULL,
  `price_wholeday` float NOT NULL,
  `person_min` smallint(5) unsigned NOT NULL,
  `person_max` smallint(5) unsigned NOT NULL,
  `squaremeters` varchar(60) NOT NULL,
  `booking_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `booking_id` (`booking_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Daten für Tabelle `room`
--

INSERT INTO `room` (`ID`, `name`, `description`, `price_morning`, `price_afternoon`, `price_wholeday`, `person_min`, `person_max`, `squaremeters`, `booking_id`) VALUES
(1, 'JonasHaus2', '', 250, 150, 250, 200, 5000, '130', NULL),
(7, 'test', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata', 150, 150, 150, 5, 100, '20', NULL),
(8, 'Kulthaus', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata', 150, 150, 300, 20, 150, '25', NULL),
(9, 'JonasHauerAufderMauer', '1597532846\r\nHANS', 250, 250, 1500, 20, 200, '13', NULL);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `room_image`
--

CREATE TABLE IF NOT EXISTS `room_image` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `image` varchar(255) NOT NULL,
  `room_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `room_id` (`room_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `morningHours` varchar(20) NOT NULL,
  `afternoonHours` varchar(20) NOT NULL,
  `wholedayHours` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `settings`
--

INSERT INTO `settings` (`ID`, `morningHours`, `afternoonHours`, `wholedayHours`, `email`) VALUES
(1, '07:00 - 12:00', '13:30 - 17:30', '07:00 - 17:30', 'hans.muster@hansmuster.ch');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(60) NOT NULL,
  `last_name` varchar(60) NOT NULL,
  `street` varchar(60) DEFAULT NULL,
  `city` varchar(60) DEFAULT NULL,
  `zip` varchar(15) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `booking_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `booking_id` (`booking_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`ID`, `first_name`, `last_name`, `street`, `city`, `zip`, `email`, `phone`, `booking_id`) VALUES
(1, 'Hans', 'Peter', NULL, NULL, NULL, 'hans.peter@hansmuster.ch', '12345789', NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
