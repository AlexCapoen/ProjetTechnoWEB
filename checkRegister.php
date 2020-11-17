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
}



function testPassword($password,$repassword){   //takes in parameter the 2 passwords inputby the user
  if ($password != $repassword) {               //test if the user has input the same password twice, return -1 (=/=) or 0 (=)
    return -1;
  }
  else{
    return 0;
  }
}



function testEmail($email){                      //takes in parameter the email input by user test if there is not the same email in the db, return -1 (=) or 0 (=/=)
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
    return 'Les 2 mots de passes ne sont pas correspondants';
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
    return 'ca insert';
  }
  else{
    return $result; // str of the error
  }
}

register($email,$password,$repassword,$name,$firstName,$phone,$birthdate);
header('Location: index.php?page=register');
exit();
?>
