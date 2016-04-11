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
 <a href="index.php?page=home">Accueil</a> - 
 <?php
 if ($_SESSION['logged'] == true) {
  ?>
  <a href="index.php?page=admin">Admin.</a> - <a href="index.php?page=logout">Logout</a><br/><br/>
  <?php
 } else {
  ?>
  <a href="index.php?page=login">Login</a><br/><br/>
  <?php
 }

 if ($_SESSION['logged'] == true) {
  ?>
  <a href="index.php?page=listquizzes">Liste des quizzes</a> - 
  <a href="index.php?page=newquiz">Nouveau quiz</a> - 
  <a href="index.php?page=listquiztakers">Liste des résultats</a> - 
  <?php
 }
 ?>
 <a href = "index.php?page=listallquizzes">Démarrer un quiz</a>
</div><br/><br/>