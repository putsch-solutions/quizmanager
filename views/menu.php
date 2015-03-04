<?php
/*
 * Program: Quizmanager
 * File: view/menu.php
 * Author: Sami Metoui samimetoui@gmail.com
 * Description: display page menu view
 * License: GPL 3 (http://www.gnu.org/licenses/gpl.html)
 */
?>

<div>
 <a href="main.php?page=home">Accueil</a> - 
 <?php
 if ($_SESSION['logged'] == true) {
  ?>
  <a href="main.php?page=admin">Admin.</a> - <a href="main.php?page=logout">Logout</a><br/><br/>
  <?php
 } else {
  ?>
  <a href="main.php?page=login">Login</a><br/><br/>
  <?php
 }

 if ($_SESSION['logged'] == true) {
  ?>
  <a href="main.php?page=listquizzes">Liste des quizzes</a> - 
  <a href="main.php?page=newquiz">Nouveau quiz</a> - 
  <a href="main.php?page=listquiztakers">Liste des résultats</a> - 
  <?php
 }
 ?>
 <a href = "main.php?page=listallquizzes">Démarrer un quiz</a>
</div><br/><br/>