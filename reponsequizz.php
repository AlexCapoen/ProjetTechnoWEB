<div class='container'>
	
	<?php
		if (isset($_POST['delete'])){
			deleteUserAnswerOfQuizz($_SESSION['user_id'],$_GET['id']); // fonction de displayFonctions.php, section : "FONCTIONS ANNEXES"
			header("Refresh:0; url=index.php?page=quizz&id=".$_GET['id']);
			exit();
		}
		$quizz = BDD::get()->query('SELECT quizz_name FROM quizz;')->fetchAll();
		echo('<div id="content"><div id="titrePage"><h2 id= "textTitre">Quizz '.$quizz[$_GET['id']-1]['quizz_name'].'</h2></div>');
		$answerTabGlobal=answerTabCreation($_SESSION['user_id'],$_GET['id']);
		?>

		<form action="index.php?page=reponse&id=<?php echo($_GET['id']);?>" method="post">
        	<input id="buttonDelete" type="submit" name="delete" value="Réinitialiser mes résultats" />
      	</form>



		  <?php
		foreach ($answerTabGlobal as $key => $answerTab) {
			afficherRep($_GET['id'],$answerTab);
		}
		/*return home button*/
		echo('<div class="boutonSubmit"><a id="bouton_accueil"href="index.php?page=home"> ACCUEIL </a></div>)');
		echo("</div");
	?>
</div>

