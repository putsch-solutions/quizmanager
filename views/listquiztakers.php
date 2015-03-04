<?php
/*
 * Program: Quizmanager
 * File: view/listquiztakers.php
 * Author: Sami Metoui samimetoui@gmail.com
 * Description: display quiz takers list page view
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
   <h1>Liste des évaluations</h1>
  </div>
  <table border='1'>
   <tr>
    <th>Numéro</th>
    <th>Numéro du quizz</th>  
    <th>Identification</th>
    <th>Résultat</th>
    <th>Date</th>
   </tr>
   <?php
   for ($i = 0; $i < $nb_item; $i++) {
    $row = $sql->fetch();
    ?>
    <tr>
     <td><?php echo $row['id']; ?></td>
     <td><?php echo $row['quiz_num']; ?></td>
     <td><?php echo $row['username']; ?></td>
     <td align='center'><?php echo $row['percentage']; ?></td>
     <td align='center'><?php echo $row['date_time']; ?></td>
    </tr>
    <?php
   }
   ?>
  </table>
  <div>
   <br>
   <a href="main.php?page=admin">Retour</a>
  </div>
  <script src="js/jquery-1.11.1.js"></script>
 </body>
 <?php
 include 'views/footer.php';
 ?>
</html>