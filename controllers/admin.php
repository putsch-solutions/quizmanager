<?php
/*
 * Program: Quizzmanager
 * File: controller/admin.php
 * Author: Sami Metoui samimetoui@gmail.com
 * Description: admin controller
 * License: GPL 3 (http://www.gnu.org/licenses/gpl.html)
 */

//On inclut le modèle
include(dirname(__FILE__) . '/../models/admin.php');

/* On effectue ici diverses actions, comme supprimer des news, par exemple. ;)
  Il n'y en aura aucune dans ce tutoriel pour rester simple, mais libre à vous d'en rajouter. */
if ($_SESSION['logged'] != true) {
 ?><div><font color="red">Access denied</font></div><br/><?php
}
//On inclut la vue
include(dirname(__FILE__) . '/../views/admin.php');

