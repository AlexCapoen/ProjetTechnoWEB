<?php

include('PDOFactory.php');


if (isset($_POST)) {
  $email = $_POST['email'];
  $password = $_POST['psw'];
}


function isConnected(){                 //return 0 -> no connected, 1 -> connected
  if ($_SESSION['connected'] == 0) {
    return 0;
  }
  else {
    return 1;
  }
}


function disconnect(){
  $_SESSION = array();
  if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
  }
  session_destroy();
}


function connexion($login,$password){
  $user = BDD::get()->query('SELECT user_adress,user_password FROM user;')->fetchAll();
  foreach ($user as $value) {
    if ($login == $value[0]) {
      $mail = $value[0];
      $passwordHash = $value[1];
      echo $mail;
      if (password_verify($password,$passwordHash)) {
        $_SESSION['connected']=1;
        return 'c est co';
      }
      else {
        return 'Mot de passe incorrect';
      }
    }
  }
  return 'Adresse mail incorrect';
}

echo connexion($email,$password);
 ?>
