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
  <div class='container'>
    <?php include('header.php') ?>
    <div id="content">
      <div id='titrePage'>
        <h2>Quizz Animal</h2>
      </div>
      <div id='questionContent'>

        <div id='question1_quizz1' class='questionQuizz'>
          <form action="" method="post">

            <p class='titreQuestion'>Question 1 : Quel espece de requin a la plus longue queue ?</p>
            <select  name="Roi" form="carform">
              <option value="select" checked>Selectionner une réponse</option>
              <option value="mako">Le requin mako</option>
              <option value="requin">Le requin fouet</option>
              <option value="serpent">Le requin renard</option>
              <option value="arairgnée">Le requin lame</option>
              </select>
            
        </div>
        <div id='question2_quizz1' class='questionQuizz'>
          <p class='titreQuestion'>Question 2 : Combien d'yeux peuvent avoir les araignées :</p>
          <div>
            <input type="checkbox" id="rep1q1" name="rep1">
            <label for="rep1q1">4</label>
          </div>

          <div>
            <input type="checkbox" id="rep2q1" name="rep2">
            <label for="rep2q1">6</label>
          </div>
          <div>
            <input type="checkbox" id="rep3q1" name="rep3">
            <label for="rep3q1">8</label>
          </div>
          <div>
            <input type="checkbox" id="rep4q1" name="rep4">
            <label for="rep4q1">10</label>
          </div>
          <div>
            <input type="checkbox" id="rep5q1" name="rep5">
            <label for="rep5q1"> 12</label>
          </div>
        </div>
      </div>

        <div id='question3_quizz1' class='questionQuizz'>
          <form action="" method="get">
            <label class='titreQuestion' for="GET-name">Question 3 : Combien de rhinocéros reste-il en vie ?</label>
            <input id="GET-name" type="number" name="name">
            <input type="submit" value="Enregistrer">
          </form>
        </div>
        <div id= 'question2_quizz1' class='questionQuizz'>
          <form action="" method="post">

            <p class='titreQuestion'>Question 4 : Combien de mort son responsable les moustiques chaque année ?</p>
            <input type="radio" name="radio" class="radio"> <label for="radio">250 000</label> <br/>
            <input type="radio" name="radio" class="radio"> <label for="radio">500 000</label><br/>
            <input type="radio" name="radio" class="radio"> <label for="radio">750 000</label><br/>
            <input type="radio" name="radio" class="radio"> <label for="radio">1 000 000</label><br/>

          </form>
        </div>
        

      <div class='boutonSubmit'>
        <a href="reponsequizz1.php"> <input type="button" value="Submit" class="buttonSubmit"> </a>
      </div>

    </div>

    <?php include('footer.php') ?>

  </div>
  </body>
</html>
