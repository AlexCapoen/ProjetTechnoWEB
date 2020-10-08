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
  <div id='container'>
    <?php include('header.php') ?>
    <div id="content">
       <div id>
         <img src="Img/requinrenard.png" id="requinrenard" class="imgQuizz1">
         <br>
         <label for="name">quel est le nom de ce requin?</label>
         <br>
         <label for="name">-le requin renard</label>
       </div>
       <div>
         <img src="Img/araignee2.png" id="araignee" class="imgQuizz1">
         <br>
         <label for="name">combien d'yeux peuvent avoir les araignées?</label>
         <br>
         <label for="name">-4</label>
         <input type="checkbox" name="reponse2a" value="1" checked>
         <br>
         <label for="name">-6</label>
         <input type="checkbox" name="reponse2a" value="1" checked>
         <br>
         <label for="name">-8</label>
         <input type="checkbox" name="reponse2b" value="1" checked>
         <br>
         <label for="name">-10</label>
         <input type="checkbox" name="reponse2c" value="1" checked>
         <br>
         <label for="name">-12</label>
         <input type="checkbox" name="reponse2d" value="1" checked>
     </div>
     <div>
       <img src="Img/rhin.png" id="requinrenard" class="imgQuizz1">
       <form action="/action_page.php">
         <label for="fname">Combien de rhinoceros reste-il?</label><br>
         <label for="fname">29 500</label><br>
     </div>
     <div>
       <a class="ok" href="main.php">Home</a>
     </div>
    <?php include('footer.php') ?>

  </div>
  </body>
</html>