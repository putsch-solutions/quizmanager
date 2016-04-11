<?php

/*
 * Program: Quizmanager
 * File: controller/quiz.php
 * Author: Sami Metoui samimetoui@gmail.com
 * Description: quiz controller
 * License: GPL 3 (http://www.gnu.org/licenses/gpl.html)
 */

//On inclut le modèle
include(dirname(__FILE__) . '/../models/quiz.php');

/* On effectue ici diverses actions, comme supprimer des news, par exemple. ;)
  Il n'y en aura aucune dans ce tutoriel pour rester simple, mais libre à vous d'en rajouter. */

/* Récupère le numéro de la question */
if (isset($_GET['question'])) {
 $question = preg_replace('/[^0-9]/', "", $_GET['question']);
 $next = $question + 1;
 $prev = $question - 1;

// echo $quiz_num . " ";
// echo $question;
 /* --> Vérifie que l'utilsateur n'entre pas manuellement le numéro de la question */
 if (!isset($_SESSION['qid_array']) && $question != 1) {
  $msg = "Désolé, pas de tricherie.";
  header("location: index.php?page=startquiz&quiz_num=$quiz_num&msg=$msg");
  exit();
 }
 if (isset($_SESSION['qid_array']) && in_array($question, $_SESSION['qid_array'])) {
  $msg = "Désolé, il n'est pas autorisé de tricher. Vous devez recommencer le quiz.";
  unset($_SESSION['answer_array']);
  unset($_SESSION['qid_array']);
//session_destroy();
  header("location: index.php?page=startquiz&quiz_num=$quiz_num&msg=$msg");
  exit();
 }

 if (isset($_SESSION['lastQuestion']) && $_SESSION['lastQuestion'] != $prev) {
  $msg = "Désolé, il n'est pas autorisé de tricher. Vous devez recommencer le quiz.";
  unset($_SESSION['answer_array']);
  unset($_SESSION['qid_array']);
  //session_destroy();
  header("location: index.php?page=startquiz&quiz_num=$quiz_num&msg=$msg");
  exit();
 }
}

//On inclut la vue
include(dirname(__FILE__) . '/../views/quiz.php');
