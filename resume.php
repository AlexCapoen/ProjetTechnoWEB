<?php
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
          }
        }
        $mean=$scoreTot/$comptQuizz;
        return [$scoreMax,$mean,$comptQuizz,$comptQuestion];
      }
      else{
        return [0,0,0,$comptQuestion,0];
      }
    }

    function resumeScoreQuizzAllUser($quizzId){
      $ScoreTotal=0;
      $comptUser=0;
      $BigMean=0;
      $rankedList=[];
      $i=0;
      $userTab = BDD::get()->query('SELECT user_id,user_last_name, user_first_name FROM user')->fetchAll();
      
      foreach ($userTab as $key => $user) {

        $returnScore=resumeScoreQuizzUser($_GET['id'],$user['user_id']);

        if($returnScore[2] == 0){
        }

        else{ //S'il a déja essayé ! 
          $ScoreTotal+=$returnScore[0];
          $comptUser+=1;
          $scoreMaxUser=$returnScore[0];

          $rankedList[]=[$scoreMaxUser,$user['user_first_name'],$user['user_last_name']];
         
        }
      }
      rsort($rankedList);
      if($comptUser!=0){
        $BigMean=$ScoreTotal/$comptUser;
      }
      return[$BigMean,$comptUser,$rankedList];

    }
    ?>
<div id="content">
<?php
    $quizzId=$_GET["id"];
    $quizz = BDD::get()->query('SELECT quizz_name FROM quizz;')->fetchAll();
    echo('<div id="titrePage"><h2 id="textTitre">Résumé du Quizz '.$quizz[$quizzId-1]['quizz_name'].'</h2></div>');


    //TODO affichage des scores 
    $resultUser=resumeScoreQuizzUser($_GET['id'],$_SESSION['user_id']);
    $resultAllUser = resumeScoreQuizzAllUser($_GET['id']);
    echo('<div id="infoContenair">');
    echo('<div id="infoUser">');
    echo('<div class="result" id="result_max">Votre score max est : '.$resultUser[0] .'/' .$resultUser[3].'</div>');
    echo('<div class="result" id="result_moy">Votre moyenne est : '.$resultUser[1].'/' .$resultUser[3].' en '.$resultUser[2].' tentatives </div>');
    echo('<div class="result" id="result_all_moy">La moyenne des resultats des '.$resultAllUser[1].' joueurs est : '.$resultAllUser[0].'/' .$resultUser[3].'</div>');
    echo('</div >');
    echo('<div id="classementUser">');
    echo('<table><tr id="table":><td class="titreTable">Nom</td><td class="titreTable" >Prenom</td><td class="titreTable" >Score</td></tr>');
    foreach ($resultAllUser[2] as $key => $line_user) {
      echo('<tr class="classement_user"><td>'.$line_user[2].'</td><td>'.$line_user[1].'</td><td>'.$line_user[0].'</td></tr>');
    }

    echo('</table>');
    echo("</div>");
    echo('</div>');
    //$resultUser[0] = score max
    //$resultUser[1] = moyenne du user
    //$resultUser[2] = nombre de quizz du user
    //$resultUser[3] = nombre de question du quizz

    //$resultAllUser[0] = moyenne de tt les users
    //$resultAllUser[1] = nombre de user qui ont rep au quizz
    //$resultAllUser[2] = liste des user quit on rep au quizz ranked selon le resultat
  ?>
</div>

