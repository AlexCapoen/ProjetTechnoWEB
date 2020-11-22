<div id="content">
<?php
    $quizzId=$_GET["id"];
    $quizz = BDD::get()->query('SELECT quizz_name FROM quizz;')->fetchAll();
    echo('<div id="titrePage"><h2 id="textTitre">Résumé du Quizz '.$quizz[$quizzId-1]['quizz_name'].'</h2></div>');

    function quizzScore($quizzId,$answerTab){
      $userScore=0;
      $question = BDD::get()->query('SELECT question_id, question_title,question_input_type,question_quizz_id FROM question WHERE question_quizz_id = '.$quizzId)->fetchAll();
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

      $dateMax=BDD::get()->query('SELECT user_answer_date FROM user_answer WHERE user_id = '.$userId)->fetchAll();

      if (isset($dateMax[0])){ //Si il est nul on prend la date la plus récente
        $dateMax=$dateMax[0][0];
      }
      

      $question = BDD::get()->query('SELECT question_id FROM question WHERE question_quizz_id = '.$quizzId)->fetchAll();
      foreach ($question as $key => $ques) {
        $comptQuestion+=1;
      }
      $answerTabGlobal = answerTabCreation($userId,$quizzId);
      
      if(isset($answerTabGlobal[0])){
        foreach ($answerTabGlobal as $key => $answerTab) {
          $comptQuizz+=1;
          $scoreActuel=quizzScore($quizzId,$answerTab);
          $scoreTot+=$scoreActuel;
          if ($scoreMax < $scoreActuel){
            $scoreMax=$scoreActuel;
            $dateMax=$answerTab['date']; //date?.
          }
        }
        $mean=$scoreTot/$comptQuizz;
        return [$scoreMax,$mean,$comptQuizz,$comptQuestion,$dateMax];
      }
      else{
        return [0,0,0,$comptQuestion,0];
      }
    }
    
    //$result = resumeScoreQuizzUser($_GET['id'],$_SESSION['user_id']);
    //var_dump($result);

    function resumeScoreQuizzAllUser($quizzId){
      $rankedList=[];
      $i=0;
      $userTab = BDD::get()->query('SELECT user_id,user_last_name, user_first_name FROM user')->fetchAll();
      // var_dump($userTab);
      foreach ($userTab as $key => $user) {
        echo($user['user_id']);

        $returnScore=resumeScoreQuizzUser($_GET['id'],$user['user_id']);
        // TODO calcul BigMean
        
        // echo "return score";
        // var_dump($returnScore);

        if($returnScore[2] == 0){

          echo('pas de reponse');
        }

        else{ //S'il a déja essayé ! 
          $userName=[];
          $userName['user_last_name']=$user['user_last_name'];
          $userName['user_first_name']=$user['user_first_name'];

          $scoreMaxUser=$returnScore[0];
          $dateMax=$returnScore[4];
          // echo 'score';
          // // var_dump($scoreMaxUser);
          // echo('vla les reponse');

          $rankedList[$i]=[$userName,$scoreMaxUser,$dateMax];
          $i++;
        }
        
        
      }
      var_dump($rankedList);

    }
    resumeScoreQuizzAllUser($_GET['id']);
    

  ?>
</div>

