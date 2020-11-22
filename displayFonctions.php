<?php


//______________________________________________________FONCTIONS ANNEXES_______________________________________________________________________________

function deleteUserAnswerByDate($date){  
  $PDOuser = BDD::get()->prepare('DELETE FROM user_answer WHERE user_answer_date="'.$date.'"');
  $PDOuser->execute();
}

function deleteUserAnswerOfQuizz($userId,$quizzId){  
  $answerUserArray=BDD::get()->query('SELECT answer_id, user_answer_date FROM user_answer WHERE user_answer.user_id = '.$userId)->fetchAll();
  $questionArray = BDD::get()->query('SELECT question_input_type , question_id FROM question WHERE question.question_quizz_id ='.$quizzId)->fetchAll();
  foreach ($questionArray as $key => $question) {
    $possibleAnswer=BDD::get()->query('SELECT answer_id FROM answer WHERE answer.answer_question_id ='.$question["question_id"])->fetchAll();
    foreach ($possibleAnswer as $key => $possible) {
      foreach ($answerUserArray as $key => $answerUser) {
        if ($answerUser['answer_id'] == $possible['answer_id']){
          deleteUserAnswerByDate($answerUser['user_answer_date']);
        }
      }
    }
  }
}


function insertionAnswer($userId,$answerId,$date,$value){        //takes in parameter values that we must insert
  //insert into the db, return the error or 'insert'

$PDOuser = BDD::get()->prepare('INSERT INTO user_answer VALUES (NULL, :userId, :answerId, :dateSubmit, :valueInput)');

$PDOuser->bindParam(':userId',$userId);
$PDOuser->bindParam(':answerId',$answerId);
$PDOuser->bindParam(':dateSubmit',$date);
$PDOuser->bindParam(':valueInput',$value);

$PDOuser->execute();

}



function stockAnswer($quizzid){
  $questionTab = BDD::get()->query('SELECT question_input_type , question_id FROM question WHERE question.question_quizz_id ='.$quizzid)->fetchAll();
  // var_dump($questionTab);

  foreach ($questionTab as $key => $question) {
    if ($question['question_input_type']=='checkbox'){
      foreach ($_POST['Question'.$question['question_id']] as $key => $checkboxAns) {
        insertionAnswer($_SESSION['user_id'],$checkboxAns,$_POST['date'],NULL);
      }
    }
    elseif ($question['question_input_type'] == 'input'){
        insertionAnswer($_SESSION['user_id'],29501,$_POST['date'],$_POST['Question'.$question['question_id']]);
    }
    else{
      insertionAnswer($_SESSION['user_id'],$_POST['Question'.$question['question_id']],$_POST['date'],NULL);
    }
  }
}


function comparison($question_id,$answerArray){

  /*args : question_id of the current question being displayed, an array of all the answers of the user for this quizz
    return : an array of 2 dim, [0] : actual text to display ( bonne reponse / mauvaise reponse), [1] : class name to style this text
  */
    // $timeSubmit_php = '<script type="text/javascript">document.write(datte);</script>';


    $response = BDD::get()->query('SELECT answer_id,is_valid_answer, answer_text FROM answer WHERE answer.answer_question_id ='.$question_id)->fetchAll();
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
    if ($question[0]['question_input_type']=='input'){
      if ($answerArray['Question'.$question[0]['question_id']]==$response[0]['answer_text']){
        return ['Bonne Reponse', 'goodAnswer'];
      }else{
        return ['MauvaiseReponse', 'badAnswer'];
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


function getDateOfQuizz($userId,$quizz){
  //récupérer les réponses au dernieres réponses du quizz :

  $dateList=BDD::get()->query('SELECT user_answer_date FROM user_answer WHERE user_answer.user_id ='.$userId)->fetchAll();
  $triDate=array();

  foreach ($dateList as $key => $date) {

    $currentDate=$date['user_answer_date'];
    $currentDate=strtotime($date['user_answer_date']);
    $triDate[]=$currentDate;

  }

  rsort($triDate);

  $dateOfQuizz = array();
  $already = FALSE ;
  $trueDate =NULL;
  foreach ($triDate as $key => $date) {

    $dateMin=date("Y-m-d H:i:s", $date);

    $answerUserArray=BDD::get()->query('SELECT answer_id FROM user_answer WHERE user_answer_date = "'.$dateMin.'"')->fetchAll();
    $questionArray = BDD::get()->query('SELECT question_input_type , question_id FROM question WHERE question.question_quizz_id ='.$quizz)->fetchAll();
    $possibleAnswer=BDD::get()->query('SELECT answer_id FROM answer WHERE answer.answer_question_id ='.$questionArray[0]["question_id"])->fetchAll();
    foreach ($answerUserArray as $key => $answerUser) {
      foreach ($possibleAnswer as $key => $possible) {
        if ($answerUser['answer_id'] == $possible['answer_id']){

          $trueDate=$date;
          foreach ($dateOfQuizz as $key => $datequizz) {
            if ($datequizz == $trueDate){
              $already=TRUE ;
            }
          }
          if ($already == FALSE) {
            $dateOfQuizz[]=$trueDate;
          }
          $already=FALSE;
          break (2);
        }
      }
    }

  }
  return($dateOfQuizz);
  //$dateMin=date("Y-m-d H:i:s", $trueDate);
}

function answerTabCreation($userId,$quizz){
  $globalAnswerTab=[];
  $allDate=getDateOfQuizz($userId,$quizz); // récupération de toutes les dates où l'utilisateur a passé un quizz donné

  foreach ($allDate as $key => $dateMin) {

    $dateMin=date("Y-m-d H:i:s", $dateMin);
    $answerUserArray=BDD::get()->query('SELECT answer_id, user_answer_input FROM user_answer WHERE user_answer_date = "'.$dateMin.'"')->fetchAll();// toute les réponses de l'utilisateur pour le dernier quizz numero $quizz passé
    // récupérer les réponses de l'utilisateur par question avec le bon formatage :

    $questionArray = BDD::get()->query('SELECT question_input_type , question_id FROM question WHERE question.question_quizz_id ='.$quizz)->fetchAll();

    $answerTab=array();// ce que l on va formater pour 1 quizz , qui sera très semblable à la structure de l ancien POST
    $answerTab['date']=$dateMin;

    foreach ($questionArray as $key => $question) {

      $possibleAnswer=BDD::get()->query('SELECT answer_id FROM answer WHERE answer.answer_question_id ='.$question["question_id"])->fetchAll();//toutes les réponses possible pour une question donnée

      $stringQuestionId='Question'.$question["question_id"].'';

      if($question["question_input_type"]=="input"){
        foreach ($answerUserArray as $key => $answer) {
          if( $answer['answer_id'] =='29501'){
            $answerTab[$stringQuestionId]=$answer['user_answer_input'];
          }
        }
      }
      elseif ($question["question_input_type"]=="checkbox") {
        $answerCheck=array();
        foreach ($answerUserArray as $key => $answerUser) {
          foreach ($possibleAnswer as $key => $possible) {

            if ($answerUser['answer_id'] == $possible['answer_id']){

              $answerCheck[]=$answerUser['answer_id'];
            }
          }
        }
        $answerTab[$stringQuestionId]=$answerCheck;
      }
      else{
        foreach ($answerUserArray as $key => $answerUser) {
          foreach ($possibleAnswer as $key => $possible) {

            if ($answerUser['answer_id'] == $possible['answer_id']){

              $answerTab[$stringQuestionId] = $answerUser['answer_id'];
              break 2;
            }
          }
        }
      }
    }
    $globalAnswerTab[]=$answerTab;
  }
  return($globalAnswerTab);
}


//_____________________________________________________________________TITRE DES QUESTIONS EN FONCTIONS DES PAGES________________________________________





function printTitle($quizzId,$comp,$line,$exactQuestion ){

  echo("<div id='question ".$comp."_quizz".$quizzId."' class='questionQuizz ".$exactQuestion."'>");
  echo("<p class='titreQuestion'>Question ".$comp." : ".$line['question_title']."</p>");
}

function printTitleRep($quizzId,$comp,$line,$exactQuestion,$answerTab){

  echo("<div id='question ".$comp."_quizz".$quizzId."' class='questionQuizz ".$exactQuestion."'>");
  echo("<p class='titreQuestion'>Question ".$comp." : ".$line['question_title']."</p><p class='".comparison($line['question_id'],$answerTab)[1]."'>".comparison($line['question_id'],$answerTab)[0]."</p>");

  if(comparison($line['question_id'],$answerTab)[0]=="Bonne Reponse"){
    return 1;
  }else{
    return 0;
  }
}



                              //-------------------------------------------------------------//
                             //   AFFICHAGE DES PAGES UTILSANT LES FONCTIONS PRECEDENTES    //
                            //-------------------------------------------------------------//






  function afficherQuizz($quizzId,$date){
    /*args : quizz id of the current quizz we need to display
      return : nothing
    */

    echo('<form action="index.php?page=quizz&id='.$quizzId.'" method="post"><div id="questionContent">');

    echo ('<input id="dateOfSubmit" name="date" value="'.$date.'" >');
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

        echo('<input id="GET-name" class="input" type="number" name="Question'.$question[$comp-1]['question_id'].'" required>');
        echo('</div>');
      }


      // ---------------------------radio------------------------------------------//


      if($line['question_input_type']=='radio'){

        printTitle ($quizzId,$comp,$line,$questionExacte);


        $response = BDD::get()->query('SELECT answer_id,answer_text,is_valid_answer FROM answer WHERE answer.answer_question_id ='.$line['question_id'])->fetchAll();

        foreach ($response as $key2 => $answer) {
          echo('<input type="radio" class="radioElmnt" name="Question'.$question[$comp-1]['question_id'].'" value='.$answer['answer_id'].' class="radio"> <label for="radio" required>'.$answer['answer_text'].'</label> <br/>');
        }

        echo('</div>');
      }
    }
    /*question quizz end*/
    /*start submit button*/

    echo('<div class="boutonSubmit"><a href=""> <input name="answerQuizz" type="submit" value="Envoyer vos réponse" id="submitButton" class="buttonSubmit"></a></div>');



    /*end submit button*/
    echo("</div>");/*end div questionContent*/
    echo('</form>');
    echo("</div>");/*end div content*/
  }



function afficherRep($quizzId,$answerTab){
  /*args : quizz id of the current quizz we need to display answers
  return : nothing*/
  /*titre et contenu*/
  $userScore=0;

  echo('<div id="questionContent">');
  echo('<div class = "dateOfQuizz"> Vous avez passé ce quizz le : '.$answerTab['date'].'</div>');// affiche la date à laquelle le test a été passé 
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
      $userScore=$userScore+printTitleRep ($quizzId,$comp,$line,$questionExacte,$answerTab);
      //User answer :

      echo('<p>Votre Réponse : </p>');

      echo(" <select  name='Question".$comp."Quizz".$line['question_quizz_id']."' form='carform'>");
      foreach ($response as $key2 => $answer) {
        if ($answer['answer_id'] == $answerTab[$stringQuestionId]){
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

      $userScore=$userScore+printTitleRep ($quizzId,$comp,$line,$questionExacte,$answerTab);

      $response = BDD::get()->query('SELECT answer_id,answer_text,is_valid_answer FROM answer WHERE answer.answer_question_id ='.$line['question_id'])->fetchAll();
      $compans=0;
      //User answer :
      echo('<p>Votre Réponse : </p>');
      foreach ($answerTab[$stringQuestionId] as $key => $userAnswerId) {
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
      $userScore=$userScore+printTitleRep ($quizzId,$comp,$line,$questionExacte,$answerTab);
      $response = BDD::get()->query('SELECT answer_id,answer_text,is_valid_answer FROM answer WHERE answer.answer_question_id ='.$line['question_id'])->fetchAll();

      //User answer :
      echo('<p>Votre Réponse : </p>');
      echo('<input value="'.$answerTab[$stringQuestionId].'" type="text" name="name">');


      //Good answer
      echo('<p>Réponse attendue : </p>');
      foreach ($response as $key => $answer) {
        echo('<input id="GET-name" value="'.$answer['answer_text'].'" type="text" name="name">');
      }
      echo('</div>');
    }


    // -------------------------------------radio------------------------------------------//


    if($line['question_input_type']=='radio'){
      $userScore=$userScore+printTitleRep ($quizzId,$comp,$line,$questionExacte,$answerTab);
      $response = BDD::get()->query('SELECT answer_id,answer_text,is_valid_answer FROM answer WHERE answer.answer_question_id ='.$line['question_id'])->fetchAll();
      //User answer :
      echo('<p>Votre Réponse : </p>');
      foreach ($response as $key2 => $answer) {
        if ($answer['answer_id'] == $answerTab[$stringQuestionId]){
          echo('<form><input type="radio" name="radio" class="radio"> <label for="radio">'.$answer['answer_text'].'</label></form) <br/>');
        }
      }


      //Good answer
      echo('<p>Réponse attendue : </p>');
      foreach ($response as $key2 => $answer) {
        if ($answer['is_valid_answer'] == 1){
          echo('<input type="radio"  name="radio" class="radio"> <label for="radio">'.$answer['answer_text'].'</label><br/>');
        }
      }

      echo('</div>');
    }
  }
  /*question quizz end*/
  /*start submit button*/
  echo('<div id="userScore">Votre score : '.$userScore.'/'.$comp.'</div>');

  echo("</div>");/*end div questionContent*/

}

?>
