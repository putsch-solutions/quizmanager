<?php

/*
 * Program: Quizzmanager
 * File: controller/listquizzes.php
 * Author: Sami Metoui samimetoui@gmail.com
 * Description: list quizzes controller
 * License: GPL 3 (http://www.gnu.org/licenses/gpl.html)
 */

//On inclut le modèle
include(dirname(__FILE__) . '/../models/listquizzes.php');

/* On effectue ici diverses actions, comme supprimer des news, par exemple. ;)
  Il n'y en aura aucune dans ce tutoriel pour rester simple, mais libre à vous d'en rajouter. */

if (isset($action) && $action = 'delete') {

 $sql = $pdo->prepare("DELETE FROM quizzes WHERE quiz_num=:quiz_num");
 $t_pdo = array(":quiz_num" => $quiz_num);
 try {
  $sql->execute($t_pdo);
 } catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage();
 }
}

$sql = $pdo->prepare("SELECT * FROM quizzes");
try {
 $sql->execute();
} catch (PDOException $e) {
 echo 'Erreur : ' . $e->getMessage();
}
$nb_item = $sql->rowCount();

//On inclut la vue
include(dirname(__FILE__) . '/../views/listquizzes.php');
?>
