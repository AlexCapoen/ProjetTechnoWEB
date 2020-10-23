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
    <?php include('header.php');
          include('PDOFactory.php');
     ?>
     <?php
            /*titre et contenu*/
            $quizz = BDD::get()->query('SELECT quizz_name FROM quizz;')->fetchAll();
            echo('<div id="content"><div id="titrePage"><h2>Quizz '.$quizz[0]['quizz_name'].'</h2></div>');
            echo('<form action="" method="post"><div id="questionContent">');
            /*question quizz start*/
            $question = BDD::get()->query('SELECT question_id, question_title,question_input_type,question_quizz_id FROM question WHERE question.question_quizz_id = 1;')->fetchAll();
            $comp=0;/*compteur de question affichées*/

            foreach ($question as $key=>$line){
              $comp=$comp+1;

              if($line['question_input_type']=='carform'){
                echo("<div id='question ".$comp."_quizz1' class='questionQuizz'>");
                echo("<p class='titreQuestion'>Question".$comp." : ".$line['question_title']."</p>");
                echo(" <select  name='Question".$comp."Quizz".$line['question_quizz_id']."' form='carform'>");
                echo('<option value="select" checked>Selectionner une réponse</option>');
                $response = BDD::get()->query('SELECT answer_id,answer_text,is_valid_answer FROM answer WHERE answer.answer_question_id ='.$line['question_id'])->fetchAll();

                foreach ($response as $key2 => $answer) {
                  echo('<option value="select" checked>'.$answer['answer_text'].'</option>');
                }

                echo("</select>");
                echo("</div>");
              }

              if($line['question_input_type']=='checkbox'){
                echo("<div id='question ".$comp."_quizz1' class='questionQuizz'>");
                echo("<p class='titreQuestion'>Question".$comp." : ".$line['question_title']."</p>");
                $response = BDD::get()->query('SELECT answer_id,answer_text,is_valid_answer FROM answer WHERE answer.answer_question_id ='.$line['question_id'])->fetchAll();
                $compans=0;

                foreach ($response as $key2 => $answer) {
                  echo("<div> <input type='checkbox' id='rep".$compans."1q1' name='rep".$compans."'> <label for='rep1q1'>".$answer['answer_text']."</label></div>");
                }

                echo('</div>');
                $compans=0;
              }

              if($line['question_input_type']=='input'){
                echo($line['question_id']);
                echo("<div id='question ".$comp."_quizz1' class='questionQuizz'>");
                echo("<p class='titreQuestion'>Question".$comp." : ".$line['question_title']."</p>");
                echo('<input id="GET-name" type="number" name="name">');
                echo('</div>');
              }

              if($line['question_input_type']=='radio'){
                echo($line['question_id']);
                echo("<div id='question ".$comp."_quizz1' class='questionQuizz'>");
                echo("<p class='titreQuestion'>Question".$comp." : ".$line['question_title']."</p>");
                $response = BDD::get()->query('SELECT answer_id,answer_text,is_valid_answer FROM answer WHERE answer.answer_question_id ='.$line['question_id'])->fetchAll();

                foreach ($response as $key2 => $answer) {
                  echo('<input type="radio" name="radio" class="radio"> <label for="radio">'.$answer['answer_text'].'</label> <br/>');
                }
                
                echo('</div>');
              }
            }
            /*question quizz end*/
            /*start submit button*/
            echo('<div class="boutonSubmit"><a href="reponsequizz1.php"> <input type="submit" value="Submit"class="buttonSubmit"> </a></div>)');
            /*end submit button*/
            echo("</div");/*end div questionContent*/
            echo('</form>');
            echo("</div");/*end div content*/
          ?>
    <div id="content">
      <div id='titrePage'>
        
        <h2>Quizz Animal</h2>
      </div>
      
      <form action="" method="post">
        <div id='questionContent'>
          
          <div id='question1_quizz1' class='questionQuizz'>
            

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
        

          <div id='question3_quizz1' class='questionQuizz'>
            <form action="" method="get">
              <label class='titreQuestion' for="GET-name">Question 3 : Combien de rhinocéros reste-il en vie ?</label>
              <input id="GET-name" type="number" name="name">
              <input type="submit" value="Enregistrer">
          </div>

          <div id= 'question4_quizz1' class='questionQuizz'>
            <p class='titreQuestion'>Question 4 : Combien de mort son responsable les moustiques chaque année ?</p>
            <input type="radio" name="radio" class="radio"> <label for="radio">250 000</label> <br/>
            <input type="radio" name="radio" class="radio"> <label for="radio">500 000</label><br/>
            <input type="radio" name="radio" class="radio"> <label for="radio">750 000</label><br/>
            <input type="radio" name="radio" class="radio"> <label for="radio">1 000 000</label><br/>
          </div>

        </div>
          

        <div class='boutonSubmit'>
          <a href="reponsequizz1.php"> <input type="submit" value="Submit" class="buttonSubmit"> </a>
        </div>
      </form>

    </div>

    <?php include('footer.php') ?>

  </div>
  </body>
</html>
