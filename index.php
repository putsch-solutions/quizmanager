<?php

/*
 * Program: Quizmanager
 * File: index.php
 * Author: Sami Metoui samimetoui@gmail.com,
 * Description: index page, include requested controller page
 * License: GPL 3 (http://www.gnu.org/licenses/gpl.html)
 */

session_start();

extract($_GET);
extract($_POST);

include_once("_include/db.php");

if (!isset($_SESSION['logged'])) {
 $_SESSION['logged'] = FALSE;
}

if (!isset($_SESSION['logged']) || !$_SESSION['logged']) {
 include 'controllers/login.php';
} else {

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

}