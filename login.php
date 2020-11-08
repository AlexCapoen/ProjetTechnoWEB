<div id="loginContainer">
  	<div id="formLogin" class="logging">
		<form action="index.php" method='POST' class="container">

			<?php
			if(isset($_COOKIE["returnRegister"])){
			    if($_COOKIE["returnRegister"]=="Inscription effectuée, connectez-vous : "){
			    	echo('<p class="connecSucces">'.$_COOKIE["returnRegister"].'</p>');
			    }
			}
			?>	
		    <label  for="email"><b class="itemLogin">Email <?php
		    if(isset($_COOKIE["returnLogin"])){
			    if($_COOKIE["returnLogin"]=="Adresse mail incorrect"){
			    	echo('<p class="connecError">'.$_COOKIE["returnLogin"].'</p>');
			    }
			}	
		    ?>	</b></label>
		    </br>
        	<input type="email" class="inputForm formBox" placeholder="welcome@quizzeria.fr" name="email" required>
		     </br>
		    <label class="itemLogin" for="psw"><b class="itemLogin">Password <?php
		    if(isset($_COOKIE["returnLogin"])){
			    if($_COOKIE["returnLogin"]=="Mot de passe incorrect"){
			    	echo('<p class="connecError">'.$_COOKIE["returnLogin"].'</p>');
			    }
			}	
		    ?>	
		    </b></label>
		    </br>
        	<input type="password" class="inputForm formBox" placeholder="Password" name="psw" required>
			</br>
			</br>
		 	<button class="buttonLoginRegister" type="submit" name='login'>Log In</button>
		 	</br>
		 	</br>
		    <a id="registerLoginLink" href="index.php?page=register">Register</a>

        </form>

	</div>

</div>
