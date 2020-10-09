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
      <div class="questionquizz1">
         <img src="Img/requinrenard.png" id="requinrenard" class="imgQuizz1"></br>
         <label class="questionq1"><span class="textquestionq1">Comment s'appelle cette espéce de requin?</span></label>
            <select  class=reponse1q1 name="dangereux" id="reponse4" form="carform">
              <option value="select" checked>Selectionner une réponse</option>
              <option value="mako">Le requin mako</option>
              <option value="requin">Le requin fouet</option>
             <option value="serpent">Le requin renard</option>
             <option value="arairgnée">Le requin lame</option>
           </select>
      </div>
      <div class="questionquizz1">
         <img src="Img/araignee2.png" id="araignee" class="imgQuizz1"></br>
         <label class="questionq1"><span class="textquestionq1">combien d'yeux peuvent avoir les araignées?</span></label>
         <div id="reponse2q1">  
            <input type="checkbox" name="reponse2a">
            <label><span class="textquestionq1">-4</span></label><br>
            <input type="checkbox" name="reponse2b">
            <label><span class="textquestionq1">-6</span></label><br>
            <input type="checkbox" name="reponse2c">
            <label><span class="textquestionq1">-8</span></label><br>
            <input type="checkbox" name="reponse2d">
            <label><span class="textquestionq1">-10</span></label><br>
            <input type="checkbox" name="reponse2e">
            <label><span class="textquestionq1">-12</span></label>
          </div>
      </div>
      <div class="questionquizz1">
       <img src="Img/rhin.png" id="requinrenard" class="imgQuizz1"></br>
       <label class="questionq1"><span class="textquestionq1">Combien de rhinoceros reste-il en vie?</span></label><br>
        <form>
         <input type="reponse3" id="reponse3" name="reponse3"  class=reponse1q1><br>
         <br>
        </form>
      </div>
      <div class="questionquizz1">
        <img src="Img/moustique.jpg" id="moustique" class="imgQuizz1"></br>
        <label class="questionq1"><span class="textquestionq1">De combien de mort son responsable les moustiques chaque année</span> </label>
        <div id="reponse4q1">
           <input type="radio" name="reponse4" value="1">
           <label>-900 000</label><br>
           <input type="radio" name="reponse4" value="1">
           <label>-750 000</label><br>
           <input type="radio" name="reponse4" value="1">
           <label>-500 000</label><br>
           <input type="radio" name="reponse4" value="1">
           <label>-250 000</label><br>
         </div>
      </div>      
     <div>
       <a class='validcontainer' href="reponsequizz1.php">Valider</a>
     </div>
    <?php include('footer.php') ?>
  </div>
  </body>
</html>