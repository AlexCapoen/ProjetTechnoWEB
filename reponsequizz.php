<div class='container'>
	<?php
		$answerTab=answerTabCreation($_SESSION['user_id'],$_GET['id']);
		afficherRep($_GET['id'],$answerTab);
	?>
</div>

