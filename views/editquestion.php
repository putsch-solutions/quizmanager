<?php
/*
 * Program: Quizzmanager
 * File: view/editquestion.php
 * Author: Sami Metoui samimetoui@gmail.com
 * Description: display edit question page view
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
  ?>  
  <form method="POST" action="main.php?page=editquestion&quiz_num=<?php echo $quiz_num; ?>">
   <div><h1>Editer une question</h1></div>
   <div>
    <label>Numéro: </label>
    <input type="text" size="20" disabled="true" name="question_num" value="<?php echo $row['question_num']; ?>">
    <br><br>
    <label>Illustration: </label><br>
    <!--<input type="file" name="image_file"><br/><br/>-->
    <?php
    if (!empty($row['question_picture'])) {
     $img = '<img src="data:image/jpg;base64,' . base64_encode($row['question_picture']) . '">';
     // $img = '<img src="displayImage.php?image='.$row['question_picture'].'">';

     echo $img;
    }
    ?><br/><br/>
    <label>Intitulé de la question: </label>
    <input disabled="true" type="text" size="50" name="question_statement" value="<?php echo $row['question_statement']; ?>"> ?
    <br><br>
    <label>Type de question:</label><br>
    <?php
    if ($row['question_type'] == 'yn') {
     ?><input disabled type="radio" checked name="question_type"> Oui/Non<br>
     <input disabled type="radio" name="question_type"> Choix multiples
     <?php
    } else {
     ?>
     <input disabled type="radio" name="question_type"> Oui/Non<br>
     <input disabled type="radio" checked name="question_type"> Choix multiples
     <?php
    }
    ?>
   </div>
   <?php
   $sql = $pdo->prepare("SELECT * FROM answers WHERE answer_question_num=:question_num");
   $t_pdo = array(':question_num' => $question_num);
   try {
    $sql->execute($t_pdo);
   } catch (PDOException $e) {
    echo 'Erreur : ' . $e->getMessage();
   }

   if ($row['question_type'] == 'yn') {
    $row = $sql->fetchAll();
    ?>
    <div id='yes_no'>
     <br><lable>Réponses à la question</lable>
     <br><br><input disabled type="text" value="<?php echo $row[0]['answer_statement']; ?>" name="answer_1">
     <input disabled type="radio" value="true" name="correct_answer" <?php if ($row[0]['answer_correct'] == true) echo 'checked'; ?>>Correcte
     <br><br><input disabled type="text" value="<?php echo $row[1]['answer_statement']; ?>" name="answer_2">
     <input disabled type="radio" value="false" name="correct_answer" <?php if ($row[1]['answer_correct'] == true) echo 'checked'; ?>>Correcte
    </div>
    <?php
   } else {
    $row = $sql->fetchAll();
    ?>
    <div id='multiple_choice'>
     <br><lable>Réponses à la question</lable>
     <br><br><lable>Réponse1 :</lable>
     <input disabled type="text" size="50" name="Q[0]" value="<?php echo $row[0]['answer_statement']; ?>">
     <input disabled type="radio" value="answer0" name="correct_answer" <?php if ($row[0]['answer_correct'] == true) echo 'checked'; ?>>Correcte
     <br><br><lable>Réponse2 :</lable>
     <input disabled type="text" size="50" name="Q[1]" value="<?php echo $row[1]['answer_statement']; ?>">
     <input disabled type="radio" value="answer1" name="correct_answer" <?php if ($row[1]['answer_correct'] == true) echo 'checked'; ?>>Correcte
     <br><br><lable>Réponse3 :</lable>
     <input disabled type="text" size="50" name="Q[2]" value="<?php echo $row[2]['answer_statement']; ?>">
     <input disabled type="radio" value="answer2" name="correct_answer" <?php if ($row[2]['answer_correct'] == true) echo 'checked'; ?>>Correcte
     <br><br><lable>Réponse4 :</lable>
     <input disabled type="text" size="50" name="Q[3]" value="<?php echo $row[3]['answer_statement']; ?>">
     <input disabled type="radio" value="answer3" name="correct_answer" <?php if ($row[3]['answer_correct'] == true) echo 'checked'; ?>>Correcte
    </div>
    <?php
   }
   ?>
   <div>
    <br>
    <!--<input type="submit" value="Modifier" name="update_question">-->
    <br><br>
    <a href="main.php?page=editquiz&quiz_num=<?php echo $quiz_num; ?>">Retour</a>
   </div>
  </form>
  <script src="js/jquery-1.11.1.js"></script>
 </body>
 <?php
 include 'footer.php';
 ?>
</html>