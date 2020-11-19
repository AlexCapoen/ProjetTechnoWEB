<div class='container'>
  <div id="content">
    <?php
    /*Title and content*/
      $quizz = BDD::get()->query('SELECT quizz_name FROM quizz;')->fetchAll();
      echo('<div id="titrePage"><h2 id= "textTitre">Quizz '.$quizz[$_GET['id']-1]['quizz_name'].'</h2></div>'); //Print quizz title from db
    ?>
    <div id="quizzChoice">
      <form action="index.php?page=quizz&id=<?php echo($_GET['id']);?>" method="post">
        <input class="buttonQuizzChoice" type="submit" name="affiche" value="Passer le Quizz" />
      </form>
      <form action="index.php?page=quizz&id=<?php echo($_GET['id']);?>" method="post">
        <input class="buttonQuizzChoice" type="submit" name="result" value="Afficher les résultats" />
      </form>
    </div>
    <?php
      if (isset($_POST['affiche'])){
        $today=getdate();
        $todayFormat = date($today['year']."-".$today['mon']."-".$today['mday']." ".$today['hours'].":".$today['minutes'].":".$today['seconds']);
        afficherQuizz($_GET['id'],$todayFormat);
      }
      if (isset($_POST['result'])){
        $userAnswer = BDD::get()->query('SELECT answer_id FROM user_answer WHERE user_id='.$_SESSION['user_id'])->fetchAll();
        var_dump($userAnswer);
        //header('Location: index.php?page=reponse&id='.$_GET['id']);
      }
    ?>    
  </div>
</div>
