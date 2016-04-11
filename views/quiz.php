<?php
/*
 * Program: Quizmanager
 * File: view/quiz.php
 * Author: Sami Metoui samimetoui@gmail.com,
 * Description: display quiz view
 * License: GPL 3 (http://www.gnu.org/licenses/gpl.html)
 */
?>
<html>
 <head>
  <meta charset="utf-8">
  <title>Quizmanager</title>
  <script type="text/javascript">
   function countDown(secs, elem) { //Chronometrage des questions et affichage
    var element = document.getElementById(elem);
    element.innerHTML = "Il vous reste " + secs + " secondes.";
    if (secs < 1) { //appelle userAnswers.php et arrete le timer après 10 sec
     var xhr = new XMLHttpRequest();
     var url = "userAnswers.php";
     var vars = "radio=0" + "&qid=" +<?php echo $question; ?>;
     xhr.open("POST", url, true);
     xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
     xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) { //arrete le timer après
       alert("Vous n'avez pas répondu à la question dans le temps imparti. Elle sera marquée comme erronée.");
       clearTimeout(timer);
      }
     }
     xhr.send(vars);
     document.getElementById('counter_status').innerHTML = "";
     document.getElementById('btnSpan').innerHTML = '<h2>Le temps est écoulé!</h2>';
     document.getElementById('btnSpan').innerHTML += '<a href="index.php?page=quiz&quiz_num=<?php echo $quiz_num; ?>&question=<?php echo $next; ?>">Cliquez ici maintenant</a>'; //affiche times up et le lien pour passer à la question suivante

    }
    secs--; //Décrémente d'une seconde
    var timer = setTimeout('countDown(' + secs + ',"' + elem + '")', 1000); //appelle timeout avec secs-- toute les secondes
   }
  </script>
  <script>
   function getQuestion() {//Récupère une question dans la table via la page questions.php
    var hr = new XMLHttpRequest();
    hr.onreadystatechange = function () {
     if (hr.readyState == 4 && hr.status == 200) {
      var response = hr.responseText.split("|");
      if (response[0] == "finished") {
       document.getElementById('status').innerHTML = response[1];
      }
      var nums = hr.responseText.split("|");
      document.getElementById('image').innerHTML = nums[0];
      document.getElementById('question').innerHTML = nums[1];
      document.getElementById('answers').innerHTML = nums[2];
      document.getElementById('answers').innerHTML += nums[3];
     }
    }
    hr.open("GET", "questions.php?quiz_num=" +<?php echo $quiz_num; ?> + "&question=" +<?php echo $question; ?>, true);
    hr.send();
   }
   function x() { //Récupère la réponse checké
    var rads = document.getElementsByName("rads");
    for (var i = 0; i < rads.length; i++) {
     if (rads[i].checked) {
      var val = rads[i].value;
      return val;
     }
    }
   }
   function post_answer() {
    var p = new XMLHttpRequest();
    var id = document.getElementById('qid').value;
//    var quiz_num = document.getElementById('quiz_num').value;
    var url = "userAnswers.php";
    var vars = "qid=" + id + "&radio=" + x(); //+ "&quiz_num=" + quiz_num
    p.open("POST", url, true);
    p.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    p.onreadystatechange = function () {
     if (p.readyState == 4 && p.status == 200) {
      document.getElementById("status").innerHTML = '';
//      alert("Thanks, Your answer was submitted" + p.responseText);
      var url = 'index.php?page=quiz&quiz_num=<?php echo $quiz_num; ?>&question=<?php echo $next; ?>';
      window.location = url;
     }
    }
    p.send(vars);
    document.getElementById("status").innerHTML = "processing...";
   }
  </script>
  <script>
   window.oncontextmenu = function () {
    return false;
   }
  </script>
 </head>
 <body onLoad="getQuestion()">
  <?php
  include 'menu.php';
  ?>  
  <div id="status">
   <div id="counter_status"></div>
   <div id="image"></div>
   <div id="question"></div>
   <div id="answers"></div>  
  </div>
  <script type="text/javascript">countDown(20, "counter_status");</script>
  <script src="js/jquery-1.11.1.js"></script>
 </body>
 <?php
 include 'views/footer.php';
 ?>
</html>
