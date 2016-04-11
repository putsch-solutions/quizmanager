<?php
/*
 * Program: Quizmanager
 * File: view/newquiz.php
 * Author: Sami Metoui samimetoui@gmail.com
 * Description: display new quiz page view
 * License: GPL 3 (http://www.gnu.org/licenses/gpl.html)
 */
?>
<html>
 <head>
  <title>Quizmanager</title>
  <meta charset="utf-8">
 </head>
 <body>
  <?php
  include 'menu.php';
  ?>  
  <form method="POST" action="index.php?page=newquiz">
   <div>
    <h1>Nouveau quiz</h1>
   </div>
   <div>
    <label>Numéro: </label><input type="text" size="20" disabled="true" value="Auto"><br><br>
    <label>Intitulé du quiz: </label><input type="text" size="50" name="quiz_title">
   </div>
   <div>
    <br>
    <input type="submit" value="Continuer" name="continue">
   </div>
  </form>
  <script src="js/jquery-1.11.1.js"></script>
 </body>
 <?php
 include 'views/footer.php';
 ?>
</html>