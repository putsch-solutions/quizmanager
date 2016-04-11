<?php
/*
 * Program: Quizmanager
 * File: view/listallquizzes.php
 * Author: Sami Metoui samimetoui@gmail.com
 * Description: display error 404 list all quizzes page view
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
  include 'views/menu.php';
  ?> 
  <div>
   <h1>Liste des quizzes</h1>
  </div>
  <table border='1'>
   <tr>
    <th>Numéro</th>
    <th>Intitulé du quizz</th>
    <th>Démarrer</th>
   </tr>
   <?php
   for ($i = 0; $i < $nb_item; $i++) {
    $row = $sql->fetch();
    ?>
    <tr>
     <td><?php echo $row['quiz_num']; ?></td>
     <td><?php echo $row['quiz_title']; ?></td>
     <td align='center'><a href="index.php?page=startquiz&quiz_num=<?php echo $row['quiz_num']; ?>"> D </a></td>
    </tr>
    <?php
   }
   ?>
  </table>

  <div>
   <br>
   <a href="index.php?page=home">Retour</a>
  </div>
  <script src="js/jquery-1.11.1.js"></script>
 </body>
 <?php
 include 'views/footer.php';
 ?>
</html>

