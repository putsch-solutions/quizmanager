<?php

/*
 * Program: Quizmanager
 * File: main.php
 * Author: Sami Metoui samimetoui@gmail.com,
 * Description: main page, include requested controller page
 * License: GPL 3 (http://www.gnu.org/licenses/gpl.html)
 */

session_start();

extract($_GET);
extract($_POST);

//var_dump($_SESSION['logged']);
//if (empty($_GET['lang']) && empty($_SESSION['lang'])) {
// $language = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
// $language = $language{0} . $language{1};
// $_SESSION['lang'] = $language; //default browser language
//} else {
// if (!empty($_GET['lang']))
//  $_SESSION['lang'] = $_GET['lang'];
//}
//require_once("_include/set_lang.php"); //include_once 'inc/lang-fr.php';
include_once("_include/db.php");

if (!isset($_SESSION['logged'])) {
 $_SESSION['logged'] = FALSE;
}

if (!empty($_GET['page']) && is_file('controllers/' . $_GET['page'] . '.php')) {
 include 'controllers/' . $_GET['page'] . '.php';
} else {
 if (empty($_GET['page'])) {
  $page = "home";
  include 'controllers/home.php';
 } else {
  include 'views/404.php';
 }
}
