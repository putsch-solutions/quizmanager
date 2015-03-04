<?php

/*
 * Program: Quizmanager
 * File: controller/addquestion.php
 * Author: Sami Metoui samimetoui@gmail.com
 * Description: add question controller
 * License: GPL 3 (http://www.gnu.org/licenses/gpl.html)
 */

//On inclut le modèle
include(dirname(__FILE__) . '/../models/addquestion.php');

/* On effectue ici diverses actions, comme supprimer des news, par exemple. ;)
  Il n'y en aura aucune dans ce tutoriel pour rester simple, mais libre à vous d'en rajouter. */

if (isset($add_question)) {

 $sql = $pdo->prepare("SELECT question_num FROM questions WHERE question_quiz_num=:quiz_num");
 $t_pdo = array(
     ':quiz_num' => $quiz_num,
 );
 try {
  $sql->execute($t_pdo);
 } catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage();
 }
 $question_order = $sql->rowCount() + 1;

 $image_file = file_get_contents($_FILES['image_file']['tmp_name']);

 /* Enregistre la questions dans la table */
 $sql = $pdo->prepare("INSERT INTO questions (question_statement, question_picture, question_order, question_quiz_num, question_type) VALUES(:question_statement, :question_picture, :question_order, :quiz_num, :question_type)");
 $t_pdo = array(
     ':question_statement' => $question_statement,
     ':question_picture' => $image_file,
     ':question_order' => $question_order,
     ':quiz_num' => $quiz_num,
     ':question_type' => $question_type
 );
 try {
  $sql->execute($t_pdo);
 } catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage();
 }

 /* lit le numéro de la question qui vient d'être sauvegardée dans la table */
 $sql = $pdo->prepare("SELECT question_num FROM questions ORDER BY question_num DESC LIMIT 1");
 try {
  $sql->execute($t_pdo);
 } catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage();
 }
 $row = $sql->fetch();
 $question_num = $row['question_num'];

 /* Enregistre les réponses aux questions */
 if ($question_type == 'yn') { /* Question OUI/NON */

  if ($correct_answer == 'true') {
   $answer_1 = true;
   $answer_2 = false;
  } else {
   $answer_1 = false;
   $answer_2 = true;
  }

  /* save value of true answer */

  $sql = $pdo->prepare("INSERT INTO answers(answer_statement,answer_question_num,answer_correct) VALUES(:answer_statement,:answer_question_num,:answer_correct)");

  $t_pdo = array(
      ':answer_statement' => 'Vrai',
      ':answer_question_num' => $question_num,
      ':answer_correct' => $answer_1
  );

  try {
   $sql->execute($t_pdo);
  } catch (PDOException $e) {
   echo 'Erreur : ' . $e->getMessage();
  }

  /* save value of false answer */

  $t_pdo = array(
      ':answer_statement' => 'Faux',
      ':answer_question_num' => $question_num,
      ':answer_correct' => $answer_2
  );
  try {
   $sql->execute($t_pdo);
  } catch (PDOException $e) {
   echo 'Erreur : ' . $e->getMessage();
  }
 } else {

  for ($i = 0; $i < 4; $i++) {
   $sql = $pdo->prepare("INSERT INTO answers(answer_statement,answer_question_num,answer_correct) VALUES(:answer_statement,:answer_question_num,:answer_correct)");
   $answered = 'answer' . $i;
   if ($correct_answer == $answered) {
    $t_pdo = array(
        ':answer_statement' => $Q[$i],
        ':answer_question_num' => $question_num,
        ':answer_correct' => true
    );
   } else {
    $t_pdo = array(
        ':answer_statement' => $Q[$i],
        ':answer_question_num' => $question_num,
        ':answer_correct' => false
    );
   }
   try {
    $sql->execute($t_pdo);
   } catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
   }
  }
 }
}

//On inclut la vue
include(dirname(__FILE__) . '/../views/addquestion.php');
