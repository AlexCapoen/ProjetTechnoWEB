<?php

function printTitle ($quizzId,$comp,$line,$exactQuestion){

  echo("<div id='question ".$comp."_quizz".$quizzId."' class='questionQuizz ".$exactQuestion."'>");
  echo("<p class='titreQuestion'>Question ".$comp." : ".$line['question_title']."</p>");
}

function printTitleRep ($quizzId,$comp,$line,$exactQuestion){

  echo("<div id='question ".$comp."_quizz".$quizzId."' class='questionQuizz ".$exactQuestion."'>");
  echo("<p class='titreQuestion'>Question ".$comp." : ".$line['question_title']."</p><p class='".comparison($line['question_id'],$_POST)[1]."'>".comparison($line['question_id'],$_POST)[0]."</p>");
  if(comparison($line['question_id'],$_POST)[0]=="Bonne Reponse"){
    return 1;
  }else{
    return 0;
  }
}

function afficherQuizz($quizzId){
  /*args : quizz id of the current quizz we need to display 
    return : nothing
  */

  /*Title and content*/
  $quizz = BDD::get()->query('SELECT quizz_name FROM quizz;')->fetchAll();

  echo('<div id="content"><div id="titrePage"><h2>Quizz '.$quizz[$quizzId-1]['quizz_name'].'</h2></div>'); //Print quizz title from db
  echo('<form action="index.php?page=reponse&id='.$quizzId.'" method="post"><div id="questionContent">');
  /*question quizz start*/
  $question = BDD::get()->query('SELECT question_id, question_title,question_input_type,question_quizz_id FROM question WHERE question.question_quizz_id = '.$quizzId)->fetchAll();
  $comp=0;/*number of question index */

  foreach ($question as $key=>$line){
    $comp=$comp+1;

    $questionExacte="q".$comp."f".$quizzId."";

    // Printing forms 

    // ---------------------------carform------------------------------------------//

    if($line['question_input_type']=='carform'){
      printTitle ($quizzId,$comp,$line,$questionExacte);
      
      echo(" <select  name='Question".$question[$comp-1]['question_id']."' class='carform'>");

      $response = BDD::get()->query('SELECT answer_id,answer_text,is_valid_answer FROM answer WHERE answer.answer_question_id ='.$line['question_id'])->fetchAll();

      foreach ($response as $key2 => $answer) {
        echo('<option value=' .$answer['answer_id']. '>'.$answer['answer_text'].'</option>');
      }

      echo("</select>");
      echo("</div>");
    }


      // ---------------------------checkbox------------------------------------------//


    if($line['question_input_type']=='checkbox'){

      printTitle ($quizzId,$comp,$line,$questionExacte);

      $response = BDD::get()->query('SELECT answer_id,answer_text,is_valid_answer FROM answer WHERE answer.answer_question_id ='.$line['question_id'])->fetchAll();
      $compans=0;

      foreach ($response as $key2 => $answer) {
       $compans=$compans+1;
       echo("<div> <input class='checkboxElmnt' type='checkbox' id='rep".$compans."1q1' name='Question".$question[$comp-1]['question_id']."[]' value=".$answer['answer_id']." > <label for='rep1q1'>".$answer['answer_text']."</label></div>");
      }

      echo('</div>');
      $compans=0;
    }


    // ---------------------------input------------------------------------------//


    if($line['question_input_type']=='input'){

      printTitle ($quizzId,$comp,$line,$questionExacte);

      echo('<input id="GET-name" class="input" type="number" name="Question'.$question[$comp-1]['question_id'].'" require>');
      echo('</div>');
    }


    // ---------------------------radio------------------------------------------//


    if($line['question_input_type']=='radio'){

      printTitle ($quizzId,$comp,$line,$questionExacte);


      $response = BDD::get()->query('SELECT answer_id,answer_text,is_valid_answer FROM answer WHERE answer.answer_question_id ='.$line['question_id'])->fetchAll();

      foreach ($response as $key2 => $answer) {
        echo('<input type="radio" class="radioElmnt" name="Question'.$question[$comp-1]['question_id'].'" value='.$answer['answer_id'].' class="radio"> <label for="radio" require>'.$answer['answer_text'].'</label> <br/>');
      }

      echo('</div>');
    }
  }
  /*question quizz end*/
  /*start submit button*/

  echo('<div class="boutonSubmit"><a href=""> <input type="submit" value="Submit"class="buttonSubmit"></a></div>');

  /*end submit button*/
  echo("</div>");/*end div questionContent*/
  echo('</form>');
  echo("</div>");/*end div content*/
}



function comparison($question_id,$answerArray){ 

  /*args : question_id of the current question being displayed, an array of all the answers of the user for this quizz
    return : an array of 2 dim, [0] : actual text to display ( bonne reponse / mauvaise reponse), [1] : class name to style this text 
  */

    $response = BDD::get()->query('SELECT answer_id,is_valid_answer FROM answer WHERE answer.answer_question_id ='.$question_id)->fetchAll();
    $question = BDD::get()->query('SELECT question_input_type , question_id FROM question WHERE question_id ='.$question_id)->fetchAll();
  //count all the possible answer to this question
    $compGoodAns=0;
    foreach ($response as $value1) {
      if ($value1['is_valid_answer']) {
        $compGoodAns=$compGoodAns+1;
      }
    }
  // Special case of checkbox because several answer possible
    if ($question[0]['question_input_type']=='checkbox'){
      $compCheck=0;
      foreach ($answerArray['Question'.$question[0]['question_id']] as $checkboxAnswer){
        $compCheck+=1;
        $givenAnswer=BDD::get()->query('SELECT is_valid_answer FROM answer WHERE answer_id ='.$checkboxAnswer)->fetchAll();
        if($givenAnswer[0]['is_valid_answer']==0){
          return ['MauvaiseReponse', 'badAnswer'];
        }
      }
      if($compCheck==$compGoodAns){
        return ['Bonne Reponse', 'goodAnswer'];
      }
    }
  //General case, with only one good answer possible

    $comp=0;
    foreach($response as $value){
      if( in_array($value['answer_id'],$answerArray)&&($value['is_valid_answer'])){
        $comp=$comp+1;
      }
    }

    if($comp==$compGoodAns){
      return ['Bonne Reponse', 'goodAnswer'];
    }else{
      return ['Mauvaise Reponse', 'badAnswer'];
    }            
  }



function afficherRep($quizzId){
  /*args : quizz id of the current quizz we need to display answers
  return : nothing*/
  /*titre et contenu*/
  $userScore=0;
  $quizz = BDD::get()->query('SELECT quizz_name FROM quizz;')->fetchAll();
  echo('<div id="content"><div id="titrePage"><h2>Quizz '.$quizz[$quizzId-1]['quizz_name'].'</h2></div>');
  echo('<div id="questionContent">');

  /*question quizz start*/
  $question = BDD::get()->query('SELECT question_id, question_title,question_input_type,question_quizz_id FROM question WHERE question.question_quizz_id = '.$quizzId)->fetchAll();
  $comp=0;/*compteur de question affichées*/

  foreach ($question as $key=>$line){
    $stringQuestionId='Question'.$line["question_id"].'';
    $comp=$comp+1;

    $questionExacte="q".$comp."f".$quizzId."";
    // Printing forms 


    // ---------------------------carform------------------------------------------//
    
    if($line['question_input_type']=='carform'){
      $response = BDD::get()->query('SELECT answer_id,answer_text,is_valid_answer FROM answer WHERE answer.answer_question_id ='.$line['question_id'])->fetchAll();
      $userScore=$userScore+printTitleRep ($quizzId,$comp,$line,$questionExacte);
      //User answer :

      echo('<p>Votre Réponse : </p>');
      
      echo(" <select  name='Question".$comp."Quizz".$line['question_quizz_id']."' form='carform'>");
      foreach ($response as $key2 => $answer) {
        if ($answer['answer_id'] == $_POST[$stringQuestionId]){
          echo('<option value="true">'.$answer['answer_text'].'</option>');
        }
      }
      echo("</select>");
      //Good answer 
      echo('<p>Réponse attendue : </p>');
      echo(" <select  name='Question".$comp."Quizz".$line['question_quizz_id']."' form='carform'>");  

      foreach ($response as $key2 => $answer) {
        if ($answer['is_valid_answer'] == 1){
          echo('<option value="true">'.$answer['answer_text'].'</option>');
        }
      }
      echo("</select>");
      echo("</div>");
    }


    // ---------------------------checkbox------------------------------------------//


    if($line['question_input_type']=='checkbox'){

      $userScore=$userScore+printTitleRep ($quizzId,$comp,$line,$questionExacte);

      $response = BDD::get()->query('SELECT answer_id,answer_text,is_valid_answer FROM answer WHERE answer.answer_question_id ='.$line['question_id'])->fetchAll();
      $compans=0;
      //User answer :
      echo('<p>Votre Réponse : </p>');
      foreach ($_POST[$stringQuestionId] as $key => $userAnswerId) {
        foreach ($response as $key2 => $answer) {
          $compans=$compans+1;
          if ($answer['answer_id'] == $userAnswerId){
            echo("<div> <input type='checkbox' checked id='rep".$compans."1q1' name='rep".$compans."'> <label for='rep1q1'>".$answer['answer_text']."</label></div>");
          }
        }
      }

      //Good answer 
      echo('<p>Réponse attendue : </p>');
      foreach ($response as $key2 => $answer) {
        $compans=$compans+1;
        if ($answer['is_valid_answer'] == 1){
          echo("<div> <input type='checkbox' checked id='rep".$compans."1q1' name='rep".$compans."'> <label for='rep1q1'>".$answer['answer_text']."</label></div>");
        }
      }

      echo('</div>');
      $compans=0;
    }


    // ---------------------------input------------------------------------------//

  
    if($line['question_input_type']=='input'){
      $userScore=$userScore+printTitleRep ($quizzId,$comp,$line,$questionExacte);
      $response = BDD::get()->query('SELECT answer_id,answer_text,is_valid_answer FROM answer WHERE answer.answer_question_id ='.$line['question_id'])->fetchAll();

      //User answer :
      echo('<p>Votre Réponse : </p>');
      echo('<input id="GET-name" value="'.$_POST[$stringQuestionId].'" type="text" name="name">');


      //Good answer 
      echo('<p>Réponse attendue : </p>');
      foreach ($response as $key => $answer) {
        echo('<input id="GET-name" value="'.$answer['answer_text'].'" type="text" name="name">');
      }
      echo('</div>');
    }


    // -------------------------------------radio------------------------------------------//


    if($line['question_input_type']=='radio'){
      $userScore=$userScore+printTitleRep ($quizzId,$comp,$line,$questionExacte);
      $response = BDD::get()->query('SELECT answer_id,answer_text,is_valid_answer FROM answer WHERE answer.answer_question_id ='.$line['question_id'])->fetchAll();
      //User answer :
      echo('<p>Votre Réponse : </p>');
      foreach ($response as $key2 => $answer) {
        if ($answer['answer_id'] == $_POST[$stringQuestionId]){
          echo('<form><input type="radio" checked name="radio" class="radio"> <label for="radio">'.$answer['answer_text'].'</label></form) <br/>');
        }
      }


      //Good answer 
      echo('<p>Réponse attendue : </p>');
      foreach ($response as $key2 => $answer) {
        if ($answer['is_valid_answer'] == 1){
          echo('<input type="radio" checked name="radio" class="radio"> <label for="radio">'.$answer['answer_text'].'</label><br/>');
        }
      }

      echo('</div>');
    }
  }
  /*question quizz end*/
  /*start submit button*/
  echo('<div id="userScore">Votre score : '.$userScore.'/'.$comp.'</div>');
  echo('<div class="boutonSubmit"><a href="index.php?page=home"> <input type="submit" value="Home"class="buttonSubmit"></a></div>)');
  /*end submit button*/
  
  echo("</div>");/*end div questionContent*/

  echo("</div>");/*end div content*/
}

?>
