<?php
	function afficherRep($quizzId){
		/*titre et contenu*/
            $quizz = BDD::get()->query('SELECT quizz_name FROM quizz;')->fetchAll();
            echo('<div id="content"><div id="titrePage"><h2>Quizz '.$quizz[$quizzId-1]['quizz_name'].'</h2></div>');

            /*question quizz start*/
            $question = BDD::get()->query('SELECT question_id, question_title,question_input_type,question_quizz_id FROM question WHERE question.question_quizz_id = '.$quizzId)->fetchAll();
            $comp=0;/*compteur de question affichées*/

            foreach ($question as $key=>$line){
              $comp=$comp+1;


              if($line['question_input_type']=='carform'){
                echo("<div id='question ".$comp."_quizz1' class='questionQuizz'>");
                echo("<p class='titreQuestion'>Question".$comp." : ".$line['question_title']."</p>");
                echo(" <select  name='Question".$comp."Quizz".$line['question_quizz_id']."' form='carform'>");

                $response = BDD::get()->query('SELECT answer_id,answer_text,is_valid_answer FROM answer WHERE answer.answer_question_id ='.$line['question_id'])->fetchAll();

                foreach ($response as $key2 => $answer) {
                    if ($answer['is_valid_answer'] == 1){
                    echo('<option value="true">'.$answer['answer_text'].'</option>');
                    }

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
                    if ($answer['is_valid_answer'] == 1){
                    echo("<div> <input type='checkbox' checked id='rep".$compans."1q1' name='rep".$compans."'> <label for='rep1q1'>".$answer['answer_text']."</label></div>");
                    }
                }

                echo('</div>');
                $compans=0;
              }

              if($line['question_input_type']=='input'){
                $response = BDD::get()->query('SELECT answer_id,answer_text,is_valid_answer FROM answer WHERE answer.answer_question_id ='.$line['question_id'])->fetchAll();
                
                echo("<div id='question ".$comp."_quizz1' class='questionQuizz'>");
                echo("<p class='titreQuestion'>Question".$comp." : ".$line['question_title']."</p>");
                foreach ($response as $key2 => $answer) {
                    echo('<input id="GET-name" value="'.$answer['answer_text'].'" type="text" name="name">');
                }
                echo('</div>');
              }

              if($line['question_input_type']=='radio'){
                echo("<div id='question ".$comp."_quizz1' class='questionQuizz'>");
                echo("<p class='titreQuestion'>Question".$comp." : ".$line['question_title']."</p>");
                $response = BDD::get()->query('SELECT answer_id,answer_text,is_valid_answer FROM answer WHERE answer.answer_question_id ='.$line['question_id'])->fetchAll();

                foreach ($response as $key2 => $answer) {
                    if ($answer['is_valid_answer'] == 1){
                    echo('<input type="radio" checked name="radio" class="radio"> <label for="radio">'.$answer['answer_text'].'</label> <br/>');
                    }
                }

                echo('</div>');
              }
            }
            /*question quizz end*/
            /*start submit button*/
            echo('<div class="boutonSubmit"><a href="main.php"> <input type="submit" value="Home"class="buttonSubmit"></a></div>)');
            /*end submit button*/
            echo("</div>");/*end div questionContent*/
            echo("</div>");/*end div content*/
	}

 ?>
