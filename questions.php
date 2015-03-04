<?php

/*
 * Program: Quizmanager
 * File: questions.php
 * Author: Sami Metoui samimetoui@gmail.com,
 * Originally written by Isaac Price (c) 2012
 * Description: read requested question and answers and display them in a form
 * License: GPL 3 (http://www.gnu.org/licenses/gpl.html)
 */

session_start();
extract($_GET);
require_once("_include/db.php");

$arrCount = "";

if (isset($_GET['question'])) {
 $question = preg_replace('/[^0-9]/', "", $_GET['question']); //Récupère le numéro de la question
 $output = "";
 $answers = "";
 $q = "";

 $sql = $pdo->prepare("SELECT question_num FROM questions WHERE question_quiz_num=:quiz_num;");
 $t_pdo = array(
     ':quiz_num' => $quiz_num
 );
 try {
  $sql->execute($t_pdo);
 } catch (Exception $ex) {
  echo 'erreur: ' . $ex->getMessage();
  ;
 }

 $numQuestions = $sql->rowCount(); //Compte le nombre de questions
 if (!isset($_SESSION['answer_array']) || $_SESSION['answer_array'] < 1) { //Pas de réponses dans la table
  $currQuestion = "1";
 } else {
  $arrCount = count($_SESSION['answer_array']); //récupère le nombre de réponses dans la table
 }
 if ($arrCount > $numQuestions) { //Efface les réponses dans la table lorsqu'il y plus de question que prévu
  unset($_SESSION['answer_array']);
  header("location: main.php?page=quiz");
  exit();
 }
 if ($arrCount >= $numQuestions) { //arrête le quiz lorsqu'il y a autant de réponse que de question
  echo 'finished|<p>Il n\'y a plus de question, veuillez entrer votre nom et prénom et cliquer sur terminer</p>
				<form action="userAnswers.php" method="post">
				<input type="hidden" name="complete" value="true">
				<input type="text" name="username">				
    <input type="hidden" id="quiz_num" value="' . $quiz_num . '" name="quiz_num">
				<input type="submit" value="Terminer"></form>';
  exit();
 }

 $sql = $pdo->prepare("SELECT * FROM questions WHERE question_quiz_num=:quiz_num AND question_order=:question LIMIT 1;");
 $t_pdo = array(
     ':quiz_num' => $quiz_num,
     ':question' => $question
 );
 try {
  $sql->execute($t_pdo);
 } catch (Exception $ex) {
  echo 'erreur: ' . $ex->getMessage();
  ;
 }

// echo $quiz_num;

 $row = $sql->fetch();
 $id = $row['question_num'];
 $qorder = $row['question_order'];
 $thisQuestion = $row['question_statement'];
 $type = $row['question_type'];
 $q = '<h2>' . $thisQuestion . '?</h2>'; //affiche la question
 if (!empty($row['question_picture'])) {
  $img = '<img src="data:image/jpg;base64,' . base64_encode($row['question_picture']) . '">';
  // $img = '<img src="displayImage.php?image='.$row['question_picture'].'">';
 }

 $sql2 = $pdo->prepare("SELECT * FROM answers WHERE answer_question_num=:question_num ORDER BY rand();");
 $t_pdo2 = array(
     ':question_num' => $id
 );
 try {
  $sql2->execute($t_pdo2);
 } catch (Exception $ex) {
  echo 'erreur: ' . $ex->getMessage();
  ;
 }
 $nbr_item = $sql2->rowCount();

 for ($i = 0; $i < $nbr_item; $i++) { /* Affiche les réponses */
  $row2 = $sql2->fetch();
  $answer = $row2['answer_statement'];
  $correct = $row2['answer_correct'];
  $answers .= '<label style="cursor:pointer;"><input type="radio" name="rads" value="' . $correct . '">' . $answer . '</label><input type="hidden" id="qid" value="' . $qorder . '" name="qid"><br/><br/>';
 }
 $output = '' . $img . '|' . $q . '|' . $answers . '|<span id="btnSpan"><button onclick="post_answer()">Envoyer</button></span>';

 echo $output; // ---> affiche le formulaire avec la question et les réponses possibles
// }
}

//<input type="hidden" id="" value="' . $quiz_num . '" name="quiz_num">