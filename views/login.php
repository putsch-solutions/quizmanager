<?php
/*
 * Program: Quizzmanager
 * File: view/login.php
 * Author: Sami Metoui samimetoui@gmail.com
 * Description: display login page view
 * License: GPL 3 (http://www.gnu.org/licenses/gpl.html)
 */
?>
<html>
 <head>
  <title>quizzmanager</title>
  <meta charset="utf-8">
 </head>
 <body>
  <?php
  include 'views/menu.php';
  ?> 
  <div>
   <h1>Identification</h1>
  </div>
  <div>
   <form method="post" action="main.php?page=login">
    <label>Nom: </label><input type="text" name="user_login"/><br/><br/>
    <label>Mot de passe: </label><input type="password" name="user_passwd"/><br/><br/>
    <input type="submit" name="submit"/>
   </form>
  </div>
  <script src="js/jquery-1.11.1.js"></script>
 </body>
 <?php
 include 'views/footer.php';
 ?>
</html>
