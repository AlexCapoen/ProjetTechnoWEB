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
        <h2>Quizz Histoire de France</h2>
      </div>
      <form action="" method="post">
        <div id='questionContent'>

          <div id='question1_quizz2' class='questionQuizz'>
          

              <p class='titreQuestion'>Question 1 : Quel était le surnom de Louis XIV ?</p>
              <select  name="Roi" form="carform">
                <option value="select" checked>Selectionner une réponse</option>
                <option value="">Le Roi des rats</option>
                <option value="">L'ami des bêtes</option>
                <option value="">Le Roi Soleil</option>
                <option value="">Le Roi full-stack</option>
                </select>
              
          </div>

          <div id= 'question2_quizz2' class='questionQuizz'>

              <p class='titreQuestion'>Question 2 : Quel est l'évènement déclencheur de la 1ère guerre mondiale ?</p>
              <input type="radio" name="radio" class="radio"> <label for="radio">Les conflits dans les balkans </label> <br/>
              <input type="radio" name="radio" class="radio"> <label for="radio">La France veut reconquérir l'Alsace et la Lorraine</label><br/>
              <input type="radio" name="radio" class="radio"> <label for="radio">Un dérapage de l'empereur allemand sur les réseaux sociaux</label><br/>
              <input type="radio" name="radio" class="radio"> <label for="radio">L'assassinat de l'archiduc François Ferdinand a Sarajevo</label><br/>

            
          </div>

          <div id='question3_quizz2' class='questionQuizz'>
            
              <label class='titreQuestion' for="GET-name">Question 3 : En quelle année s'est déroulée la bataille de Marignan ?</label>
              <input id="GET-name" type="number" name="name">
              <input type="submit" value="Enregistrer">
            
          </div>

          <div id='question4_quizz2' class='questionQuizz'>
            <p class='titreQuestion'>Question 4 : Parmi ces pays lesquels sont considérés comme vainqueur de la 2nd guerre mondiale :</p>
            <div>
              <input type="checkbox" id="rep1q2" name="rep1">
              <label for="rep1q2">Royaume-Uni</label>
            </div>

            <div>
              <input type="checkbox" id="rep2q2" name="rep2">
              <label for="rep2q2">Italie</label>
            </div>
            <div>
              <input type="checkbox" id="rep3q2" name="rep3">
              <label for="rep3q2">Japon</label>
            </div>
            <div>
              <input type="checkbox" id="rep4q2" name="rep4">
              <label for="rep4q2">France</label>
            </div>
            <div>
              <input type="checkbox" id="rep5q2" name="rep5">
              <label for="rep5q2"> Etats-unis</label>
            </div>
            <div>
              <input type="checkbox" id="rep6q2" name="rep6">
              <label for="rep6q2">Le Vatican</label>
            </div>
          </div>
        </div>

        <div class='boutonSubmit'>
          <a href="answerquizz2.php"> <input type="submit" value="Submit" class="buttonSubmit"> </a>
        </div>
      </form>

    </div>

    <?php include('footer.php') ?>

  </div>
  </body>
</html>
