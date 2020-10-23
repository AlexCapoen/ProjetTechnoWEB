<?php
	function afficherQuizz($quizzId){
		/*titre et contenu*/
            $quizz = BDD::get()->query('SELECT quizz_name FROM quizz;')->fetchAll();
            echo('<div id="content"><div id="titrePage"><h2>Quizz '.$quizz[$quizzId-1]['quizz_name'].'</h2></div>');
            echo('<form action="recuperationAnswer.php" method="post"><div id="questionContent">');
            /*question quizz start*/
            $question = BDD::get()->query('SELECT question_id, question_title,question_input_type,question_quizz_id FROM question WHERE question.question_quizz_id = '.$quizzId)->fetchAll();
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
                  echo('<option value='.$answer['answer_text'].' checked>'.$answer['answer_text'].'</option>');
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
                	$compans=$compans+1;
                  echo("<div> <input type='checkbox' id='rep".$compans."1q1' name='choix[]'' value=".$answer['answer_text']." '> <label for='rep1q1'>".$answer['answer_text']."</label></div>");
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
                  echo('<input type="radio" name="radio" value='.$answer['answer_text'].' class="radio"> <label for="radio">'.$answer['answer_text'].'</label> <br/>');
                }

                echo('</div>');
              }
            }
            /*question quizz end*/
            /*start submit button*/
            echo('<div class="boutonSubmit"><a href="reponsequizz1.php"> <input type="submit" formaction="reponsequizz1.php" name="valide" value="Submit" class="buttonSubmit"> </a></div>)');
            /*end submit button*/
            echo("</div>");/*end div questionContent*/
            echo('</form>');
            echo("</div>");/*end div content*/
	}

 ?>
