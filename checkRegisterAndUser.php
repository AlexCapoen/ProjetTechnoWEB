<?php

include('PDOFactory.php');

if (isset($_POST['register'])) {
  $email = $_POST['email'];
  $name = $_POST['Name'];
  $firstName = $_POST['FirstName'];
  $password = $_POST['psw'];
  $repassword = $_POST['confirmePsw'];
  $phone = $_POST['phone'];
  $birthdate = $_POST['birthdate'];

  setcookie("returnRegister",register($email,$password,$repassword,$name,$firstName,$phone,$birthdate),time()+3);
  header('Location: index.php?page=register');
  exit();
}

if (isset($_POST['login'])) {
  $email = $_POST['email'];
  $password = $_POST['psw'];

  setcookie("returnLogin",connexion($email,$password),time()+3);
  header('Location: index.php?page=login');
  exit();
}



function testPassword($password,$repassword){   //takes in parameter the 2 passwords inputby the user
  if ($password != $repassword) {               //test if the user has input the same password twice, return -1 (=/=) or 0 (=)
    return -1;
  }
  else{
    return 0;
  }
}



function testEmail($email){                    //takes in parameter the email input by user test if there is not the same email in the db, return -1 (=) or 0 (=/=)
  $emailInDB = BDD::get()->query('SELECT user_adress FROM user;')->fetchAll();
  foreach ($emailInDB as $value) {
    if ($value[0] == $email) {
      return -1;
    }
  }
  return 0;
}



function testInsert($testPassword,$testEmail){                    //takes in parameter the result of the tests (password and email)
  if ($testPassword == -1) {                                      //test if we can insert in db, return  0 (can insert) or  the error
    return 'Les 2 mots de passes ne sont pas correspondant';
  }
  if ($testEmail == -1) {
    return "L'adresse mail est deja utilisée";
  }
  return 0;
}

function insertionDB($email,$password,$name,$firstName,$phone,$birthdate){        //takes in parameter values that we must insert
                                                                                  //insert into the db, return the error or 'insert'
  $password = password_hash($password,PASSWORD_DEFAULT);

  $PDOuser = BDD::get()->prepare('INSERT INTO user VALUES (NULL, :name, :firstName, :email, :phone, :birthdate, :password)');

  $PDOuser->bindParam(':name',$name);
  $PDOuser->bindParam(':firstName',$firstName);
  $PDOuser->bindParam(':email',$email);
  $PDOuser->bindParam(':phone',$phone);
  $PDOuser->bindParam(':birthdate',$birthdate);
  $PDOuser->bindParam(':password',$password);

  $PDOuser->execute();
}

function register($email,$password,$repassword,$name,$firstName,$phone,$birthdate){
  $testPass = testPassword($password,$repassword);
  $testEmail = testEmail($email);
  $result = strval(testInsert($testPass,$testEmail));
  if ($result == "0"){
    insertionDB($email,$password,$name,$firstName,$phone,$birthdate);
    return 'Inscription effectuée';
  }
  else{
    return $result; // str of the error
  }
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
  $user = BDD::get()->query('SELECT user_id, user_adress,user_password FROM user;')->fetchAll();
  foreach ($user as $value) {
    if ($login == $value['user_adress']) {
      $email = $value['user_adress'];
      $passwordHash = $value['user_password'];
      if (password_verify($password,$passwordHash)) {
        $_SESSION['connected']=1;
        $_SESSION['user_id']=$value['user_id'];
        return 'Connexion établie';
      }
      else {
        return 'Mot de passe incorrect';
      }
    }
  }
  return 'Adresse mail incorrect';
}
?>
