<?php
/*
 * Program: Quizzmanager
 * File: view/editquiz.php
 * Author: Sami Metoui samimetoui@gmail.com
 * Description: display edit quiz page view
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
  include 'menu.php';

  $quiz_num = $_GET['quiz_num'];
  $sql = $pdo->prepare("SELECT * FROM quizzes WHERE quiz_num=:quiz_num");
  $t_pdo = array(':quiz_num' => $quiz_num);

  try {
   $sql->execute($t_pdo);
  } catch (PDOException $e) {
   echo 'Erreur : ' . $e->getMessage();
  }
  $row = $sql->fetch();
  ?>

  <div><h1>Edition d'un quiz</h1></div>
  <div>
   <label>Numéro: </label>
   <input type="text" size="20" disabled="true" value="<?php echo $row['quiz_num']; ?>"><br><br>
   <label>Intitulé du quiz: </label>
   <input type="text" size="50" disabled="true" value="<?php echo $row['quiz_title']; ?>">
  </div>
  <?php
  $sql = $pdo->prepare("SELECT * FROM questions WHERE question_quiz_num=:quiz_num ORDER BY question_order");
  $t_pdo = array(':quiz_num' => $quiz_num);

  try {
   $sql->execute($t_pdo);
  } catch (PDOException $e) {
   echo 'Erreur : ' . $e->getMessage();
  }
  $nb_item = $sql->rowCount();
  ?>

  <div>
   <h1>Liste des questions</h1>
  </div>
  <table border='1'>
   <tr>
    <th>Numéro</th>
    <th>Intitulé de la question</th>
    <th>Type</th>
    <th>Ordre</th> 
    <th>Delete</th>
    <th>Edit</th>
    <th>Change</th>
   </tr>
   <?php
   for ($i = 0; $i < $nb_item; $i++) {
    $row = $sql->fetch();
    ?>
    <tr>
     <td align='center'><?php echo $row['question_num']; ?></td>
     <td><?php echo $row['question_statement']; ?></td>
     <td align='center'><?php echo $row['question_type']; ?></td>
     <td align='center'><?php echo $row['question_order']; ?></td>
     <td align='center'>
      <a href="main.php?page=editquiz&quiz_num=<?php echo $quiz_num; ?>&action=delete&question_num=<?php echo $row['question_num']; ?>">X</a>
     </td>
     <td align='center'>
      <a href="main.php?page=editquestion&question_num=<?php echo $row['question_num']; ?>&quiz_num=<?php echo $quiz_num; ?>">E</a>
     </td>
     <td align='center'>
      <a href="main.php?page=editquiz&quiz_num=<?php echo $quiz_num; ?>&action=up&question_num=<?php echo $row['question_num']; ?>">Up</a>
      <!-- | <a href="main.php?page=editquiz&quiz_num=<?php echo $quiz_num; ?>&action=down&question_num=<?php echo $row['question_num']; ?>">Down</a>-->
     </td>


    </tr>
    <?php
   }
   ?>
  </table>
  <div>
   <br>
   <a href="main.php?page=addquestion&quiz_num=<?php echo $quiz_num; ?>">Ajouter une question</a>
   <br><br>
   <a href="main.php?page=listquizzes">Retour</a>
  </div>
  <script src="js/jquery-1.11.1.js"></script>
 </body>
 <?php
 include 'views/footer.php';
 ?>
</html>