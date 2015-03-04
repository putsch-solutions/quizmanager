<?php
/*
 * Program: Quizmanager
 * File: view/startquiz.php
 * Author: Sami Metoui samimetoui@gmail.com,
 * Originally written by Isaac Price (c) 2012
 * Description: display quiz start view
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
  include 'view/menu.php';
  ?>  
  <script>
   function startQuiz(url) {
    window.location = url;
   }
  </script>
  <?php
  echo $msg;
//  echo '</br>'.$quiz_num;
  ?>
  <h3>Clicquer ci-dessous lorsque vous êtes prêt à démarrer le quiz</h3>

  <button onClick="startQuiz('main.php?page=quiz&quiz_num=<?php echo $quiz_num; ?>&question=1')">Démarrer le quiz</button>
  <script src="js/jquery-1.11.1.js"></script>
 </body>
 <?php
 include 'view/footer.php';
 ?>
</html>