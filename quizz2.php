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
      <p>Ici c est le quizz Histoire(je crois)</p>
      <form action="" method="post">
  <fieldset>
    <legend>Question 1 : Quel était le surnom de Louis XIV ?</legend>
    <input type="radio" name="radio" id="radio"> <label for="radio">Le roi des rats</label> <br/>
    <input type="radio" name="radio" id="radio"> <label for="radio">Le roi Soleil</label><br/>
    <input type="radio" name="radio" id="radio"> <label for="radio">Le roi FullStack</label><br/>
    <input type="radio" name="radio" id="radio"> <label for="radio">L'ami des bêtes</label><br/>
  </fieldset>
</form>
<form action="" method="post">
  <fieldset>
    <legend>Question 2 : Quel est l'évènement déclencheur de la 1ère guerre mondiale ?</legend>
    <input type="radio" name="radio" id="radio"> <label for="radio">Les conflits dans les balkans </label> <br/>
    <input type="radio" name="radio" id="radio"> <label for="radio">La France veut reconquérir l'Alsace et la Lorraine</label><br/>
    <input type="radio" name="radio" id="radio"> <label for="radio">Un dérapage de l'empereur allemand sur les réseaux sociaux</label><br/>
    <input type="radio" name="radio" id="radio"> <label for="radio">L'assassinat de l'archiduc François Ferdinand a Sarajevo</label><br/>
  </fieldset>
</form>
<form action="" method="get">
  <label for="GET-name">Question 3 : En quelle année c'est déroulée la bataille de Marignan ?</label>
  <input id="GET-name" type="number" name="name">
  <input type="submit" value="Enregistrer">
</form>
<fieldset>
<p>Question 4 : Parmi ces pays lesquels sont considérés comme vainqueur de la 2nd guerre mondiale</p>
<div>
  <input type="checkbox" id="rep1" name="rep1">
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
  <input type="checkbox" id="rep4" name="rep4">
  <label for="rep4">France</label>
</div>
<div>
  <input type="checkbox" id="rep5" name="rep5">
  <label for="rep5"> Etats-unis</label>
</div>
<div>
  <input type="checkbox" id="rep6" name="rep6">
  <label for="rep6">Le Vatican</label>
</div>
</fieldset>







<a href="answerquizz2.php" target="_blank"> <input type="button" value="Submit"> </a>

    </div>
    
    <?php include('footer.php') ?>

  </div>
  </body>
</html>