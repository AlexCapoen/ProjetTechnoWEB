<!DOCTYPE html>


<html lang="fr" dir="ltr" class="html">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/e4339b56d6.js" crossorigin="anonymous"></script>
  <script src="look.js"></script>
  <title>Quizz.com</title>
</head>
<body>
  <div id='container' >
   
    <div id="content">
      <div id="present_quizz">
        <div class="container_quizz" >
          <img src="Img/quizzAnimals.png" id="quizzAnimalsImg" class="imgQuizz noOpacity" onmouseout="outImg(this)">
          <a class="link button notAvailable" id="quizzAnimalsButton" href="index.php?page=quizz&id=1" onmouseover="onButtonAnimals(this)">Start Quizz</a>
        </div>
        <div class="container_quizz">
          <img src="Img/quizzHistory.jpg" id="quizzHistoryImg" class="imgQuizz noOpacity" onmouseout="outImg(this)">
          <a class="link button notAvailable" id="quizzHistoryButton" href="index.php?page=quizz&id=2" onmouseover="onButtonHistory(this)">Start Quizz</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>