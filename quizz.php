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
        afficherQuizz($_GET['id']);
      }
      if (isset($_POST['result'])){
        header('Location: index.php?page=reponse&id='.$_GET['id']);
      }
    ?>    
  </div>
</div>
