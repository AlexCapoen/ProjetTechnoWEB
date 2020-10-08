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
        <h2> Reponse quizz Histoire de France</h2>
      </div>
      <div id='questionContent'>

        <div id='question1_quizz2' class='questionQuizz2'>
          <form action="" method="post">
    
            <p class='titreQuestion'>Question 1 : Quel était le surnom de Louis XIV ?</p>
            <input type="radio" name="radio" class="radio" checked> <label for="radio">Le roi Soleil</label><br/>
    
          </form>
        </div>

        <div id= 'question2_quizz2' class='questionQuizz2'>
          <form action="" method="post">
    
            <p class='titreQuestion'>Question 2 : Quel est l'évènement déclencheur de la 1ère guerre mondiale ?</p>
            <input type="radio" name="radio" class="radio" checked> <label for="radio">L'assassinat de l'archiduc François Ferdinand a Sarajevo</label><br/>
    
          </form>
        </div>

        <div id='question3_quizz2' class='questionQuizz2'>
          <form action="" method="get">
            <label class='titreQuestion' for="GET-name">Question 3 : En quelle année s'est déroulée la bataille de Marignan ?</label>
            <p>1515</p>
          </form>
        </div>

        <div id='question4_quizz2' class='questionQuizz2'>
          <p class='titreQuestion'>Question 4 : Parmi ces pays lesquels sont considérés comme vainqueur de la 2nd guerre mondiale :</p>
          <div>
            <input type="checkbox" id="rep1" name="rep1" checked>
            <label for="rep1">Royaume-Uni</label>
          </div>

          <div>
            <input type="checkbox" id="rep2" name="rep2">
            <label for="rep2">Italie</label>
          </div>
          <div>
            <input type="checkbox" id="rep3" name="rep3">
            <label for="rep3">Japon</label>
          </div>
          <div>
            <input type="checkbox" id="rep4" name="rep4" checked>
            <label for="rep4">France</label>
          </div>
          <div>
            <input type="checkbox" id="rep5" name="rep5" checked>
            <label for="rep5"> Etats-unis</label>
          </div>
          <div>
            <input type="checkbox" id="rep6" name="rep6">
            <label for="rep6">Le Vatican</label>
          </div>
        </div>
      </div>

      <a class='validcontainer' href="main.php">HOME</a>
    </div>
    
    <?php include('footer.php') ?>

  </div>
  </body>
</html>