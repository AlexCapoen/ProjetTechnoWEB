<header>
  	<div id='headerContainer'>
  		<div id="headerContent">
			<h1 id="headerTitle">Welcome at Quizz.com</h1>
			<br/>
			<div id="linkContainer">
				<div>
					<a id="headerA" class="navlink" href="main.php">Home</a>
				</div>
        <div id="quizz">
				<a id="headerA" class="navlink">Quizz</a>
          <div class="navQuizz">
          	<?php
          		
          		$quizz=BDD::get()->query('SELECT quizz_id FROM quizz')->fetchAll();
          		foreach ($quizz as $key => $quizzIndex) {
          			echo('<a class="quizzElement" href="./quizz.php?id='.$quizzIndex['quizz_id'].'">Quizz '.$quizzIndex['quizz_id'].'</a>');
          		}
            ?>
          </div>
        </div>
			</div>
		</div>
		<a class="navlink" id="loginLink" href='login.php'><i class="fas fa-user-circle"></i>Login</a>
	</div>

</header>
