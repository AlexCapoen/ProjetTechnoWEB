<div class='container'>
	<?php
		$quizz = BDD::get()->query('SELECT quizz_name FROM quizz;')->fetchAll();
		echo('<div id="content"><div id="titrePage"><h2 id= "textTitre">Quizz '.$quizz[$_GET['id']-1]['quizz_name'].'</h2></div>');
		$answerTabGlobal=answerTabCreation($_SESSION['user_id'],$_GET['id']);
		foreach ($answerTabGlobal as $key => $answerTab) {
			afficherRep($_GET['id'],$answerTab);
		}
		/*return home button*/
		echo('<div class="boutonSubmit"><a href="index.php?page=home"> ACCUEIL </a></div>)');
		echo("</div");
	?>
</div>

