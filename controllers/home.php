<?php

/*
 * Program: Quizzmanager
 * File: controller/home.php
 * Author: Sami Metoui samimetoui@gmail.com
 * Description: home page controller 
 * License: GPL 3 (http://www.gnu.org/licenses/gpl.html)
 */

//On inclut le modèle
include(dirname(__FILE__) . '/../models/home.php');

/* On effectue ici diverses actions, comme supprimer des news, par exemple. ;)
  Il n'y en aura aucune dans ce tutoriel pour rester simple, mais libre à vous d'en rajouter. */

//On inclut la vue
include(dirname(__FILE__) . '/../views/home.php');

