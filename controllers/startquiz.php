<?php

/*
 * Program: Quizzmanager
 * File: controller/startquiz.php
 * Author: Sami Metoui samimetoui@gmail.com
 * Description: start quiz controller
 * License: GPL 3 (http://www.gnu.org/licenses/gpl.html)
 */
//On inclut le modèle
include(dirname(__FILE__) . '/../models/startquiz.php');

/* On effectue ici diverses actions, comme supprimer des news, par exemple. ;)
  Il n'y en aura aucune dans ce tutoriel pour rester simple, mais libre à vous d'en rajouter. */

$msg = "";
if (isset($_GET['msg'])) {
 $msg = $_GET['msg'];
 $msg = strip_tags($msg);
 $msg = addslashes($msg);
}

unset($_SESSION['answer_array']);
unset($_SESSION['qid_array']);
unset($_SESSION['answer_array']);
unset($_SESSION['lastQuestion']);

//On inclut la vue
include(dirname(__FILE__) . '/../views/startquiz.php');

