<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e4339b56d6.js" crossorigin="anonymous"></script>
    <title>Quizz</title>
  </head>
  <body>
  <?php include('header.php') ?>
  <div id="content">
      <div class="imageq1">
         <img src="Img/requinrenard.png" id="requinrenard" class="imgQuizz1">
       </div>
       <div class= "questionq1">
         <label class="questionq1" for="name">quel est le nom de ce requin? </label>
         <br>
       </div>
       <div id= "reponse1q1">
         <label for="name">-le requin fouet</label>
         <input type="radio" name="reponse1" value="1" class="buttonradioq1"><br>
         <label for="name">-le requin mako</label>
         <input type="radio" name="reponse1" value="1" class="buttonradioq1"><br>
         <label for="name">-le requin renard</label>
         <input type="radio" name="reponse1" value="1" class="buttonradioq1"><br>
         <label for="name">-le requin à lame</label>
         <input type="radio" name="reponse1" value="1" class="buttonradioq1"></br>
       </div>
       <div class="imageq1">
         <img src="Img/araignee2.png" id="araignee" class="imgQuizz1">
       </div>
       <div class= "questionq1">
         <label class="questionq1" for="name">combien d'yeux peuvent avoir les araignées?</label>
         <br>
       </div>
       <div id= "reponse2q1">
         <label for="name">-4</label>
         <input type="checkbox" name="reponse2a"><br>
         <label for="name">-6</label>
         <input type="checkbox" name="reponse2a"><br>
         <label for="name">-8</label>
         <input type="checkbox" name="reponse2b">
         <br>
         <label for="name">-10</label>
         <input type="checkbox" name="reponse2c">
         <br>
         <label for="name">-12</label>
         <input type="checkbox" name="reponse2d">
      </div>
      <div class="imageq1">
       <img src="Img/rhin.png" id="requinrenard" class="imgQuizz1">
      </div>
      <div class= "questionq1">
       <label class="questionq1" for="fname">Combien de rhinoceros reste-il?</label><br>
     </div>
     <form>
         <input type="number" id="reponse3" name="reponse3"><br>
         <br>
     </form> 
     <div>
       <a class="ok" href="reponsequizz1.php">Valider</a>
     </div>
    <?php include('footer.php') ?>

  </div>
  </body>
</html>