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
      <div id='titrePage'>
        <h2> Reponse quizz Animal</h2>
      </div>
      <div id='questionContent'>

        <div id='question1_quizz2' class='questionQuizz'>
          <form action="" method="post">

            <p class='titreQuestion'>Question 1 : Quel espece de requin a la plus longue queue ?</p>
            <input type="radio" name="radio" class="radio" checked> <label for="radio">Le requin renard</label><br/>

          </form>
        </div>

        <div id= 'question2_quizz2' class='questionQuizz'>
          <p class='titreQuestion'>Question 2 : Combien d'yeux peuvent avoir les araignées :</p>
          <div>
            <input type="checkbox" id="rep1q1" name="rep1"checked>
            <label for="rep1q1">4</label>
          </div>

          <div>
            <input type="checkbox" id="rep2q1" name="rep2" checked>
            <label for="rep2q1">6</label>
          </div>
          <div>
            <input type="checkbox" id="rep3q1" name="rep3"checked>
            <label for="rep3q1">8</label>
          </div>
          <div>
            <input type="checkbox" id="rep4q1" name="rep4"checked>
            <label for="rep4q1">10</label>
          </div>
          <div>
            <input type="checkbox" id="rep5q1" name="rep5"checked>
            <label for="rep5q1"> 12</label>
          </div>
        </div>

        </div>

        <div id='question3_quizz2' class='questionQuizz'>
          <form action="" method="get">
            <label class='titreQuestion' for="GET-name">Question 3 : Combien de rhinocéros reste-il en vie ?</label>
            <p>29 500</p>
          </form>
        </div>

        <div id='question4_quizz2' class='questionQuizz'>
          <p class='titreQuestion'>Question 4 : Combien de mort son responsable les moustiques chaque année ?</p>
          <input type="radio" name="radio" class="radio" checked> <label for="radio">750 000</label><br/>
        </div>
      <div id="validcontainer">
        <a class='validcontainer' href="main.php">HOME</a>
      </div>
    </div>

    <?php include('footer.php') ?>
  </div>
  </body>
</html>
