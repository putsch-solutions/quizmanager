<?php

/*
 * Program: Quizmanager
 * File: db.php
 * Author: Sami Metoui samimetoui@gmail.com
 * Description: Create database connection using pdo 
 * License: GPL 3 (http://www.gnu.org/licenses/gpl.html)
 */

// Infos de connexion à la base de données
$dbhost = "localhost";
$dbusername = "root";
$dbpasswd = "mysql3216";
$dbname = "Quizmanager";

/**
 * Suite à la deprecation de l'api mysql, la classe ci-dessous permet
 * de gérer un singleton avec une connexion via l'objet PDO.
 *
 * Dans la portée globale, cet objet PDO est disponible dans $pdo.
 * Sinon, on peut l'obtenir avec BDD::getInstance();
 */
class BDD {

 private static $pdo;

 private function __construct() {

  global $dbhost;
  global $dbusername;
  global $dbpasswd;
  global $dbname;

  try {
   self::$pdo = new PDO('mysql:host=' . $dbhost . ';dbname=' . $dbname . ';', $dbusername, $dbpasswd, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
   self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //ERRMODE_WARNING
  } catch (PDOException $e) {
   die('Erreur de connexion à la base de données.');
  }
 }

 public static function getInstance() {
  if (self::$pdo === null)
   new BDD();
  return self::$pdo;
 }

}

$pdo = BDD::getInstance();
?>