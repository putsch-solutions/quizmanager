<?php

/*
 * Program: Quizmanager
 * File: controller/newquiz.php
 * Author: Sami Metoui samimetoui@gmail.com
 * Description: new quiz creation controller
 * License: GPL 3 (http://www.gnu.org/licenses/gpl.html)
 */

//On inclut le modèle
include(dirname(__FILE__) . '/../models/newquiz.php');

/* On effectue ici diverses actions, comme supprimer des news, par exemple. ;)
  Il n'y en aura aucune dans ce tutoriel pour rester simple, mais libre à vous d'en rajouter. */

if (isset($continue)) {

 $sql = $pdo->prepare("INSERT INTO quizzes (quiz_title) VALUES(:quiz_title)");
 $t_pdo = array(':quiz_title' => $quiz_title);
 try {
  $sql->execute($t_pdo);
 } catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage();
 }

 $sql = $pdo->prepare("SELECT quiz_num FROM quizzes ORDER BY quiz_num DESC LIMIT 1");
 try {
  $sql->execute($t_pdo);
 } catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage();
 }
 $row = $sql->fetch();
 $quiz_num = $row['quiz_num'];

 header("location: main.php?page=addquestion&quiz_num=$quiz_num");
}

//On inclut la vue
include(dirname(__FILE__) . '/../views/newquiz.php');

