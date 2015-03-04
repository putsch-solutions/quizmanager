<?php

/*
 * Program: Quizmanager
 * File: userAnswers.php
 * Author: Sami Metoui samimetoui@gmail.com,
 * Originally written by Isaac Price (c) 2012
 * Description: get quiz takers answers and save their score
 * License: GPL 3 (http://www.gnu.org/licenses/gpl.html)
 */

session_start();
require_once("_include/db.php");

extract($_GET);
extract($_POST);

if (isset($_POST['radio']) && $_POST['radio'] != "") { //Récupère la réponse et la place dans answer_array
 $answer = preg_replace('/[^0-9]/', "", $_POST['radio']);
 if (!isset($_SESSION['answer_array']) || count($_SESSION['answer_array']) < 1) {
  $_SESSION['answer_array'] = array($answer);
 } else {
  array_push($_SESSION['answer_array'], $answer);
 }
}
if (isset($_POST['qid']) && $_POST['qid'] != "") { //Récupère le numéro d'ordre de la question dans qid_array
 $qid = preg_replace('/[^0-9]/', "", $_POST['qid']);
 if (!isset($_SESSION['qid_array']) || count($_SESSION['qid_array']) < 1) {
  $_SESSION['qid_array'] = array($qid); //nouveau quiz : vide qid_array
 } else {
  array_push($_SESSION['qid_array'], $qid); //ajoute la réponse dans qid_array
 }
 $_SESSION['lastQuestion'] = $qid; //mémorise la dernière question
}

$response = ""; //initialise la chaine réponse
if (!isset($_SESSION['answer_array']) || count($_SESSION['answer_array']) < 1) {
 $response = "You have not answered any questions yet";
 echo $response;
 exit();
} else { //Calcule la moyenne du participant 
 $sql = $pdo->prepare("SELECT question_num FROM questions WHERE question_quiz_num=:quiz_num");
 $t_pdo = array(
     ':quiz_num' => $quiz_num
 );

 try {
  $sql->execute($t_pdo);
 } catch (Exception $ex) {
  echo 'erreur: ' . $ex->getMessage();
 }

 $count = $sql->rowCount();
 //$count = count($_SESSION['qid_array']);
 $numCorrect = 0;
 foreach ($_SESSION['answer_array'] as $current) {
  if ($current == 1) {
   $numCorrect++;
  }
 }
 $percent = $numCorrect / $count * 100;
 $percent = intval($percent);
 if (isset($_POST['complete']) && $_POST['complete'] == "true") {
  if (!isset($_POST['username']) || $_POST['username'] == "") {
   echo "<meta charset=\"utf-8\">Désolé, Nous avons une erreur";
   echo '<br/><br/><a href="main.php?page=home">Terminer</a>';
   exit();
  }
  $username = $_POST['username'];
  $username = $pdo->quote($username);
  $username = strip_tags($username);
  if (!in_array("1", $_SESSION['answer_array'])) {
   $sql = $pdo->prepare("INSERT INTO quiz_takers(username, quiz_num, percentage, date_time) VALUES(:username, :quiz_num, :percentage, now());");
   $t_pdo = array(
       ':username' => $username,
       ':percentage' => $percent,
       ':quiz_num' => $quiz_num
   );

   try {
    $sql->execute($t_pdo);
   } catch (Exception $ex) {
    echo 'erreur: ' . $ex->getMessage();
   }

   echo "<meta charset=\"utf-8\">Avez-vous au moins lu les questions? Votre score est de seulement $percent% ";
   echo '<br/><br/><a href="main.php?page=home">Terminer</a>';
   unset($_SESSION['answer_array']);
   unset($_SESSION['qid_array']);
//session_destroy();
   exit();
  }
  $sql = $pdo->prepare("INSERT INTO quiz_takers(username, quiz_num, percentage, date_time) VALUES(:username, :quiz_num, :percentage, now())");
  $t_pdo = array(
      ':username' => $username,
      ':percentage' => $percent,
      ':quiz_num' => $quiz_num
  );

  try {
   $sql->execute($t_pdo);
  } catch (Exception $ex) {
   echo 'erreur: ' . $ex->getMessage();
  }

  echo "<meta charset=\"utf-8\">Merci d'avoir participé au quiz! Votre score est de $percent%";
  echo '<br/><br/><a href="main.php?page=home">Terminer</a>';
  unset($_SESSION['answer_array']);
  unset($_SESSION['qid_array']);
//session_destroy();
  exit();
 }
}
?>