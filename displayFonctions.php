<?php


//______________________________________________________FONCTIONS ANNEXES_______________________________________________________________________________


function insertionAnswer($userId,$answerId,$date){        //takes in parameter values that we must insert
  //insert into the db, return the error or 'insert'
$PDOuser = BDD::get()->prepare('INSERT INTO user_answer VALUES (NULL, :userId, :answerId, :dateSubmit)');

$PDOuser->bindParam(':userId',$userId);
$PDOuser->bindParam(':answerId',$answerId);
$PDOuser->bindParam(':dateSubmit',$date);

$PDOuser->execute();
}



function stockAnswer($quizzid){

  if (isset($_POST['answerQuizz'])){

    $questionTab = BDD::get()->query('SELECT question_input_type , question_id FROM question WHERE question.question_quizz_id ='.$quizzid)->fetchAll();
    // var_dump($questionTab);

    foreach ($questionTab as $key => $question) {
      if ($question['question_input_type']=='checkbox'){
        foreach ($_POST['Question'.$question['question_id']] as $key => $checkboxAns) {
          insertionAnswer($_SESSION['user_id'],$checkboxAns,$_POST['date']);
        }  
      }else{
        insertionAnswer($_SESSION['user_id'],$_POST['Question'.$question['question_id']],$_POST['date']);
      }
    }
  }
}


function comparison($question_id,$answerArray){ 

  /*args : question_id of the current question being displayed, an array of all the answers of the user for this quizz
    return : an array of 2 dim, [0] : actual text to display ( bonne reponse / mauvaise reponse), [1] : class name to style this text 
  */
    // $timeSubmit_php = '<script type="text/javascript">document.write(datte);</script>';

  
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

function answerTab($userId,$quizz){

  $tabAnswer=BDD::get()->query('SELECT * FROM user_answer WHERE user_id ='.$userId.'')->fetchAll();
  // var_dump($tabAnswer);
  
  
  $postList=[];
  if($quizz==1) {
    $comp=1;
    $answers=BDD::get()->query('SELECT * FROM answer')->fetchAll();

    $dateList=BDD::get()->query('SELECT user_answer_date FROM user_answer')->fetchAll();
    // var_dump($dateList);

    for($i=0 ; $i <=count($dateList)-2;$i++) {
      var_dump($dateList);
      for($j=$i+1 ; $j <=count($dateList)-1;$j++) {

          echo "avant boucle";
          echo "j",$j;
          if($dateList[$i]==$dateList[$j]){ //D'ou c'est undefined merde MAJ : Les indices NE se mettent PAS a jour !! 
            echo "j",$j;
            var_dump($dateList[$j]);
            unset($dateList[$j]);
            // $j=$j-1;
          }
          
        }

        // $verif=;
        // $tmp=$dateList[$j];
        
      }
    
      var_dump($dateList);

      //Partie qu'il faudra un peu changer pour le grace à datList qui aura toutes les differentes dates et donc count(datelist) = nombre de differents quizz1 (quizz2)!
      
      foreach($answers as $key=>$answer){
        // echo "answerdb";
        // var_dump($answer);

        foreach($tabAnswer as $key2=>$post){
            // echo "post";
            // var_dump($post);

            if($answer['answer_id']==$post['answer_id']){ //Si on est à une certaine réponse, on regarde à quelle question elle appartient

              $questionNumber=$answer['answer_question_id']; //On récupère le numéro de la question correspondante !

              // echo ('questionNumber :'.$questionNumber.'');


              //On fait une liste si on est à la question 2 ou 8

              if ($questionNumber== 2 || $questionNumber== 8 ){

                $answerIdList= BDD::get()->query('SELECT answer_id FROM answer WHERE answer_question_id ='.$questionNumber.'')->fetchAll(); //Toutes les reponses possibles pour la question checkbox
                
                // var_dump($answerIdList);

              }
              // $postList['Question1']=$post['user_answer_id'];
            }

            // if($questions['question_id']==2){


            // }

          }

      }

      

      

      // $tab=['Question1'=> $value[]]
    
  }
  elseif($quizz==2){

  }
  
  // TODO il manque la question 3 dans la bdd. Pour cette fonction il faut juste creer un big tab qu'on remplit avec des tab formaté comme $_POST ; il faut alors créer un petit tab préformatté que l'on remplit puis ecrase dans un for ou foreach

}




//_____________________________________________________________________TITRE DES QUESTIONS EN FONCTIONS DES PAGES________________________________________





function printTitle($quizzId,$comp,$line,$exactQuestion){

  echo("<div id='question ".$comp."_quizz".$quizzId."' class='questionQuizz ".$exactQuestion."'>");
  echo("<p class='titreQuestion'>Question ".$comp." : ".$line['question_title']."</p>");
}

function printTitleRep($quizzId,$comp,$line,$exactQuestion){

  echo("<div id='question ".$comp."_quizz".$quizzId."' class='questionQuizz ".$exactQuestion."'>");
  echo("<p class='titreQuestion'>Question ".$comp." : ".$line['question_title']."</p><p class='".comparison($line['question_id'],$_POST)[1]."'>".comparison($line['question_id'],$_POST)[0]."</p>");

  if(comparison($line['question_id'],$_POST)[0]=="Bonne Reponse"){
    return 1;
  }else{
    return 0;
  }
}





//_______________________________________________________________________AFFICHAGE DES PAGES_________________________________________________________________________________




  function afficherQuizz($quizzId,$date){
    /*args : quizz id of the current quizz we need to display 
      return : nothing
    */
  
    echo('<form action="index.php?page=reponse&id='.$quizzId.'" method="post"><div id="questionContent">');
  
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
  
    echo('<div class="boutonSubmit"><a href=""> <input name="answerQuizz" type="submit" value="Envoyer vos réponse" id="submitButton" class="buttonSubmit"></a></div>');
  
  
    
    /*end submit button*/
    echo("</div>");/*end div questionContent*/
    echo('</form>');
    echo("</div>");/*end div content*/
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
      echo('<input value="'.$_POST[$stringQuestionId].'" type="text" name="name">');


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


  // var_dump($_POST);
  answerTab(2,1);


  echo("</div>");/*end div questionContent*/

  echo("</div>");/*end div content*/
}

?>
