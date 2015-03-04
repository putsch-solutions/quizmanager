<?php
/*
 * Program: Quizmanager
 * File: view/addquestion.php
 * Author: Sami Metoui samimetoui@gmail.com
 * Description: display add question page view
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
  <form enctype="multipart/form-data" method="POST" action="main.php?page=addquestion&quiz_num=<?php echo $quiz_num; ?>">
   <div>
    <h1>Ajouter une question</h1>
   </div>
   <div>
    <label>Numéro: </label><input type="text" size="20" disabled="true" value="Auto"><br><br>
    <label>Illustration: </label><input type="file" name="image_file"><br><br>

    <label>Intitulé de la question: </label><input type="text" size="50" name="question_statement"> ?
    <br><br>
    <label>Type de question:</label><br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="radio" name="question_type" value="yn" checked 
           onClick="showDiv('yes_no', 'multiple_choice')"> Oui/Non<br>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="radio" name="question_type" value="mc"
           onClick="showDiv('multiple_choice', 'yes_no')"> Choix multiples
    <div id='yes_no'>
     <br>
     <lable>Réponses à la question</lable>
     <br><br><input disabled type="text" value="Vrai" name="answer_1">
     <input type="radio" value="true" name="correct_answer">Correcte
     <br><br><input disabled type="text" value="Faux" name="answer_2">
     <input type="radio" value="false" name="correct_answer">Correcte
    </div>
    <div id='multiple_choice' style="display:none;">
     <br>
     <lable>Réponses à la question</lable>
     <br><br><lable>Réponse1 :</lable><input type="text" size="50" name="Q[0]">
     <input type="radio" value="answer0" name="correct_answer">Correcte
     <br><br><lable>Réponse2 :</lable><input type="text" size="50" name="Q[1]">
     <input type="radio" value="answer1" name="correct_answer">Correcte
     <br><br><lable>Réponse3 :</lable><input type="text" size="50" name="Q[2]">
     <input type="radio" value="answer2" name="correct_answer">Correcte
     <br><br><lable>Réponse4 :</lable><input type="text" size="50" name="Q[3]">
     <input type="radio" value="answer3" name="correct_answer">Correcte
    </div>
   </div>

   <div><br>
    <input type="submit" value="Continuer" name="add_question">
    <br><br>
    <a href="main.php?page=editquiz&quiz_num=<?php echo $quiz_num; ?>">Retour</a>
   </div>
  </form>
  <script>
   function showDiv(el1, el2) {
    document.getElementById(el1).style.display = 'block';
    document.getElementById(el2).style.display = 'none';
   }
  </script>
  <script src="js/jquery-1.11.1.js"></script>
 </body>
 <?php
 include 'views/footer.php';
 ?>
</html>
