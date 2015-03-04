<?php

/*
 * Program: Quizmanager
 * File: controller/editquiz.php
 * Author: Sami Metoui samimetoui@gmail.com
 * Description: edit quiz controller
 * License: GPL 3 (http://www.gnu.org/licenses/gpl.html)
 */

//On inclut le modèle
include(dirname(__FILE__) . '/../models/editquiz.php');

/* On effectue ici diverses actions, comme supprimer des news, par exemple. ;)
  Il n'y en aura aucune dans ce tutoriel pour rester simple, mais libre à vous d'en rajouter. */

if (isset($action)) {
 if ($action == "delete") {

  /* Lit le numéro et le numéro d'ordre de la question à supprimer */
  $sql = $pdo->prepare("SELECT question_num, question_order FROM questions WHERE question_num=:question_num LIMIT 1");
  $t_pdo = array(
      ':question_num' => $question_num,
  );
  try {
   $sql->execute($t_pdo);
  } catch (PDOException $e) {
   echo 'Erreur1 : ' . $e->getMessage();
  }
  $row = $sql->fetch();
  $q_num = $row['question_num']; /* Récupère le numéro de la question à supprimmer */
  $q_order = $row['question_order']; /* Récupère le numéro d'ordre de la question à supprimmer */

  /* Supprime la question concernée */
  $sql = $pdo->prepare("DELETE FROM questions WHERE question_num=:question_num");
  $t_pdo = array(
      ":question_num" => $question_num
  );
  try {
   $sql->execute($t_pdo);
  } catch (PDOException $e) {
   echo 'Erreur2 : ' . $e->getMessage();
  }

  /* Lit les questions qui suivent celui supprimmé */
  $sql = $pdo->prepare("SELECT question_num FROM questions WHERE question_quiz_num=:quiz_num AND question_order>:q_order");
  $t_pdo = array(
      ':quiz_num' => $quiz_num,
      ':q_order' => $q_order
  );
  try {
   $sql->execute($t_pdo);
  } catch (PDOException $e) {
   echo 'Erreur3 : ' . $e->getMessage();
  }

  $nbr_question = $sql->rowCount();

  /* réorganise l'ordre des quesions */

  for ($i = 0; $i < $nbr_question; $i++) {
   $sql2 = $pdo->prepare("UPDATE questions SET question_order=:q_new_order WHERE question_quiz_num=:quiz_num AND question_order=:q_actual_order");
   $t_pdo = array(
       ':quiz_num' => $quiz_num,
       ':q_actual_order' => $q_order + $i + 1,
       ':q_new_order' => $q_order + $i
   );
   try {
    $sql2->execute($t_pdo);
   } catch (PDOException $e) {
    echo 'Erreur4 : ' . $e->getMessage();
   }
  }
 } elseif ($action == 'up') {
//  echo 'up';

  /* récupère le numéro d'ordre de la question à déplacer */
  $sql = $pdo->prepare("SELECT question_num,question_order FROM questions WHERE question_num=:question_num");
  $t_pdo = array(
      ':question_num' => $question_num
  );
  try {
   $sql->execute($t_pdo);
  } catch (PDOException $e) {
   echo 'Erreur5 : ' . $e->getMessage();
  }
  $row = $sql->fetch();

  if ($row['question_order'] > 1) {

   /* fait descendre la question qui précède la question à remonter */
   $sql = $pdo->prepare("UPDATE questions SET question_order=:order WHERE question_quiz_num=:quiz_num AND question_order=:prev_order");
   $t_pdo = array(
       ':order' => $row['question_order'],
       ':prev_order' => ($row['question_order'] - 1),
       ':quiz_num' => $quiz_num
   );
   try {
    $sql->execute($t_pdo);
   } catch (PDOException $e) {
    echo 'Erreur6 : ' . $e->getMessage();
   }

   /* faitremonter la question la question */
   $sql = $pdo->prepare("UPDATE questions SET question_order=:new_order WHERE question_num=:question_num");
   $t_pdo = array(
       ':question_num' => $question_num,
       ':new_order' => $row['question_order'] - 1
   );
   try {
    $sql->execute($t_pdo);
   } catch (PDOException $e) {
    echo 'Erreur7 : ' . $e->getMessage();
   }
  }
 } elseif ($action == 'down') {
  echo 'down';
 } else {
  echo 'no action';
 }
}

//On inclut la vue
include(dirname(__FILE__) . '/../views/editquiz.php');

