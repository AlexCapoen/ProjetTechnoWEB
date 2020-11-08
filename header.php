<header>
  <div id='headerContainer'>
    <div id="headerContent">
      <h1 id="headerTitle">Quizzeria</h1>
      <br/>
      <div id="linkContainer">
        <div>
          <a id="headerA" class="navlink" href="index.php?page=home">Home</a>
        </div>
        <div id="quizz">
          <p id="headerA" class="navlink">Quizz</p>
          <div class="navQuizz">
            <?php
            $quizz=BDD::get()->query('SELECT quizz_id FROM quizz')->fetchAll();
            foreach ($quizz as $key => $quizzIndex) {
              echo('<a class="quizzElement" href="index.php?page=quizz&id='.$quizzIndex['quizz_id'].'">Quizz '.$quizzIndex['quizz_id'].'</a>');
            }
            ?>
          </div>
        </div>
      </div>
    </div>   
    <?php
    // Profil de l'utilisateur connecté et boutton disconnect
    if(isconnected()==1){
    ?>
    <div id="userProfil">
      <?php
       $user=BDD::get()->query('SELECT user_last_name,user_first_name FROM user WHERE user_id='.$_SESSION["user_id"])->fetchAll();
       echo($user[0]['user_last_name']." ".$user[0]['user_first_name'].'<span id="detailArrow"><i class="fas fa-caret-down"></i></span>');
      ?>
      <div id="detailButton">
        <a class="detailElement" href="index.php?page=profil">Profil</a>
      </div>
    </div>
    <?php
    echo('<form action="index.php" method="post"><button id="decoButtun" name="deconnexion" type="submit" ><i class="fas fa-sign-out-alt"></i>Logout</button></form>');
    }
    ?>
    <?php
    //boutton login
    if(isconnected()==0){
      echo('<a class="navlink" id="loginLink" href="index.php?page=login"><i class="fas fa-user-circle"></i>Log In</a>');
    }
    ?>
  </div>
</header>
