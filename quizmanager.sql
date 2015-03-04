-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 04 Mars 2015 à 14:51
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `quizmanager`
--
CREATE DATABASE IF NOT EXISTS `quizmanager` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `quizmanager`;

-- --------------------------------------------------------

--
-- Structure de la table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `answer_num` bigint(20) NOT NULL AUTO_INCREMENT,
  `answer_statement` varchar(250) NOT NULL,
  `answer_correct` tinyint(1) NOT NULL,
  `answer_question_num` bigint(20) NOT NULL,
  PRIMARY KEY (`answer_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `question_num` bigint(20) NOT NULL AUTO_INCREMENT,
  `question_picture` blob NOT NULL,
  `question_statement` varchar(250) NOT NULL,
  `question_type` varchar(5) NOT NULL,
  `question_order` int(11) NOT NULL,
  `question_weight` int(11) NOT NULL,
  `question_quiz_num` bigint(20) NOT NULL,
  PRIMARY KEY (`question_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `quizzes`
--

CREATE TABLE IF NOT EXISTS `quizzes` (
  `quiz_num` bigint(20) NOT NULL AUTO_INCREMENT,
  `quiz_title` varchar(50) NOT NULL,
  `quiz_test_num` bigint(20) NOT NULL,
  PRIMARY KEY (`quiz_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `quiz_takers`
--

CREATE TABLE IF NOT EXISTS `quiz_takers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(250) NOT NULL,
  `percentage` varchar(25) NOT NULL,
  `date_time` date NOT NULL,
  `quiz_num` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_num` bigint(20) NOT NULL AUTO_INCREMENT COMMENT ' ',
  `user_login` varchar(50) NOT NULL,
  `user_passwd` varchar(100) NOT NULL,
  PRIMARY KEY (`user_num`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
