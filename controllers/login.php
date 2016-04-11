<?php
/*
 * Program: Quizmanager
 * File: controller/login.php
 * Author: Sami Metoui samimetoui@gmail.com
 * Description: login controller
 * License: GPL 3 (http://www.gnu.org/licenses/gpl.html)
 */

//On inclut le modèle
include(dirname(__FILE__) . '/../models/login.php');

/* On effectue ici diverses actions, comme supprimer des news, par exemple. ;)
  Il n'y en aura aucune dans ce tutoriel pour rester simple, mais libre à vous d'en rajouter. */

if (!empty($submit) && !empty($user_login)) {

 $sql = $pdo->prepare("SELECT * FROM users WHERE user_login=:user_login");
 $t_pdo = array(':user_login' => $user_login);
 try {
  $sql->execute($t_pdo);
 } catch (PDOException $e) {
  echo 'Erreur : ' . $e->getMessage();
 }
 $nb_items = $sql->rowCount();
 echo $nb_items;
 for ($i = 0; $i < $nb_items; $i++) {
  $row = $sql->fetch();
  //print_r($row);
  //echo $user_login . $user_passwd . $row['user_login'] . $row['user_passwd'];
  if (!empty($user_passwd) && $user_passwd == $row['user_passwd']) {
   $_SESSION['logged'] = 'TRUE';
   header('Location: index.php?page=admin');
   break 2;
   /* echo "<script type='text/javascript'>document.location.replace('index.php?page=admin');</script>"; */
  }
 }
 ?><div><font color="red">Nom ou mot de passe erroné</font></div><?php
}

//On inclut la vue
include(dirname(__FILE__) . '/../views/login.php');
?>
