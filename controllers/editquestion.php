<?php

/*
 * Program: Quizmanager
 * File: controller/editquestion.php
 * Author: Sami Metoui samimetoui@gmail.com
 * Description: edit question controller
 * License: GPL 3 (http://www.gnu.org/licenses/gpl.html)
 */

//On inclut le modèle
include(dirname(__FILE__) . '/../models/editquestion.php');

/* On effectue ici diverses actions, comme supprimer des news, par exemple. ;)
  Il n'y en aura aucune dans ce tutoriel pour rester simple, mais libre à vous d'en rajouter. */

if (isset($update_question)) {

// $sql = $pdo->prepare("INSERT INTO questions (question_statement,question_quiz_num) VALUES(:question_statement,:quiz_num)");
// $t_pdo = array(
//     ':question_statement' => $question_statement,
//     ':quiz_num' => $quiz_num
// );
// try {
//  $sql->execute($t_pdo);
// } catch (PDOException $e) {
//  echo 'Erreur : ' . $e->getMessage();
// }
// header("location: main.php?page=addquestion&quiz_num=$quiz_num");
}

$sql = $pdo->prepare("SELECT * FROM questions WHERE question_num=:question_num");
$t_pdo = array(':question_num' => $question_num);
try {
 $sql->execute($t_pdo);
} catch (PDOException $e) {
 echo 'Erreur : ' . $e->getMessage();
}
$row = $sql->fetch();

//On inclut la vue
include(dirname(__FILE__) . '/../views/editquestion.php');

