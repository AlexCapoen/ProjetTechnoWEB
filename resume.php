<div id="content">
<?php
    $quizzId=$_GET["id"];
    $quizz = BDD::get()->query('SELECT quizz_name FROM quizz;')->fetchAll();
    echo('<div id="titrePage"><h2 id="textTitre">Résumé du Quizz '.$quizz[$quizzId-1]['quizz_name'].'</h2></div>');

  ?>
</div>