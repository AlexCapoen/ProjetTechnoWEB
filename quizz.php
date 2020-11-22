<div class='container'>
  <div id="content">
  <?php
    if (isset($_POST['answerQuizz'])){
      stockAnswer($_GET['id']); // fonction de displayFonctions.php, section : "FONCTIONS ANNEXES"
      header("Refresh:0; url=index.php?page=reponse&id=".$_GET['id']);
      exit();
    }
  ?>
  
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
        $answerQuizz=answerTabCreation($_SESSION['user_id'],$_GET['id']);
        if(isset($answerQuizz[0])){
          header("Refresh:0; url=index.php?page=reponse&id=".$_GET['id']);
          exit();

        }else{
          echo('<script>alert("Vous devez avoir répondu aux quizz au moins une fois pour accéder aux résultats !")</script>'); 
          header("Refresh:0; url=index.php?page=quizz&id=".$_GET['id']);
          exit();
        }
      }
    ?>    
  </div>
</div>
