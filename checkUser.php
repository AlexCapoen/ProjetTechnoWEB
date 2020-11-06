<?php

include('PDOFactory.php');


if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['psw'];
}


function isConnected(){                 //test if an user is connected, return 0 -> no connected, 1 -> connected
  if (isset($_SESSION['connected'])) {
    return 1;
  }
  else {
    return 0;
  }
}


function disconnect(){             //destroy the variable session
  $_SESSION = array();
}


function connexion($login,$password){           //takes in parameters login and password, look into db to know if user and password is ok then changes a session varibale and return error or co
  disconnect();
  $user = BDD::get()->query('SELECT user_adress,user_password,user_last_name,user_first_name,user_phone,user_birthdate FROM user;')->fetchAll();
  foreach ($user as $value) {
    if ($login == $value[0]) {
      $email = $value['user_adress'];
      $passwordHash = $value['user_password'];
      if (password_verify($password,$passwordHash)) {
        $_SESSION['connected']=1;
        $_SESSION['email']=$email;
        $_SESSION['last_name']=$value['user_last_name'];
        $_SESSION['first_name']=$value['user_first_name'];
        $_SESSION['phone']=$value['user_phone'];
        $_SESSION['birthdate']=$value['user_birthdate'];
        return 'Connexion établie';
      }
      else {
        return 'Mot de passe incorrect';
      }
    }
  }
  return 'Adresse mail incorrect';
}

connexion($email,$password);

header('Location: index.php?page=login');
exit();
 ?>
