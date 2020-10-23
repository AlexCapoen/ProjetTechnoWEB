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
    <?php include('header.php'); ?>
         <?php
          include('PDOFactory.php');
          include('afficherrep.php');

          function getAnswer($array){
            $arrayIncr = array();   //give Id of answer
            foreach ($array as $elm) {
              if(is_array($elm)){
                getAnswer($elm);
              }
              else{
                if ($elm != 'Submit') {
                  echo $elm;    //valeur id
                }
              }
            }
          }

          getAnswer($_POST);
          afficherrep($_GET['id']);

          function comparison($question_id,$answerArray){
            switch ($question_id){
              case 1:
              switch ($answer_id){
                case 3:
                return "Vous aviez juste.";
                default: 
                return "Vous avez faux à la question 1.";
              }

              case 2:
              $goodAnswer=5;

              if (6<=$answer_id<=9){

              }
              



            }
          }

          ?>
    <?php include('footer.php'); ?>
  </div>
  </body>
</html>
