<div id="content">
<?php
    $quizzId=$_GET["id"];
    $quizz = BDD::get()->query('SELECT quizz_name FROM quizz;')->fetchAll();
    echo('<div id="titrePage"><h2 id="textTitre">Résumé du Quizz '.$quizz[$quizzId-1]['quizz_name'].'</h2></div>');

    function quizzScore($quizzId,$answerTab){
      $userScore=0;
      $question = BDD::get()->query('SELECT question_id, question_title,question_input_type,question_quizz_id FROM question WHERE question.question_quizz_id = '.$quizzId)->fetchAll();
      foreach($question as $key => $Q){
        if(comparison($Q['question_id'],$answerTab)[0]=="Bonne Reponse"){
          $userScore+=1;
        }
      }
      return $userScore;
    }

    function resumeScoreQuizzUser($quizzId,$userId){
      $scoreTot = 0;
      $scoreMax = 0;
      $comptQuizz = 0;
      $scoreActuel = 0;
      $comptQuestion = 0; 
      $mean=0;
      $question = BDD::get()->query('SELECT question_id, question_title,question_input_type,question_quizz_id FROM question WHERE question.question_quizz_id = '.$quizzId)->fetchAll();
      foreach ($question as $key => $ques) {
        $comptQuestion+=1;
      }
      $answerTabGlobal = answerTabCreation($_SESSION['user_id'],$userId);
      var_dump($answerTabGlobal);
      if(isset($answerTabGlobal[0])){
        foreach ($answerTabGlobal as $key => $answerTab) {
          $comptQuizz+=1;
          $scoreActuel=quizzScore($quizzId,$answerTab);
          $scoreTot+=$scoreActuel;
          if ($scoreMax < $scoreActuel){
            $scoreMax=$scoreActuel;
          }
        }
        $mean=$scoreTot/$comptQuizz;
        return [$scoreMax,$mean,$comptQuizz,$comptQuestion];
      }
      else{
        return [0,0,0,$comptQuestion];
      }
    }
    
    //$result = resumeScoreQuizzUser($_GET['id'],$_SESSION['user_id']);
    //var_dump($result);

    function resumeScoreQuizzAllUser($quizzId){
      $userTab = BDD::get()->query('SELECT user_id FROM user ')->fetchAll();
      //var_dump($userTab);
      foreach ($userTab as $key => $user) {
        echo($user['user_id']);
        $returnScore=resumeScoreQuizzUser($_GET['id'],$user['user_id']);
        if($returnScore[0] == 0){
          echo('pas de reponse');
        }
        else{
          echo('vla les reponse');
        }
        
      }

    }
    resumeScoreQuizzAllUser($_GET['id']);
    

  ?>
</div>

