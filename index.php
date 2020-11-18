

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/e4339b56d6.js" crossorigin="anonymous"></script>
  <script src="look.js"></script>
  <title>Quizz.com</title>
</head>
<body>

<?php
session_start();

//--------------------------------------Include-------------------------------
include('PDOFactory.php');
include('displayFonctions.php');
include('checkRegisterAndUser.php');
include('header.php');

//----------------------------------------Redirection---------------------------------------

if(!isset($_GET['page'])){
    $page=' ';
    include('main.php');
}
else{
    $page = $_GET['page'];
}

switch ($page) {
    case "home":
        include('main.php');
        break;
    case "quizz":
        if(isconnected()==1){
            include('quizz.php');
        }else{
             echo('<script>alert("Connexion requise pour accéder aux quizzs");window.location.href="index.php";</script>');            
        }
        break;
    case "reponse":
        if(isconnected()==1){
            include('reponsequizz.php');
        }else{
            echo('<script>alert("Connexion requise pour accéder aux réponses des quizzs");window.location.href="index.php";</script>');            
        }
        break;
    case "login":
        include('login.php');
        break;
    case("register"):
        include('register.php');
        break;
    case("aboutUs"):
        include('aboutUs.php');
        break;
    case("resume"):
        include('resume.php');
        break;

    default:
        include('main.php');
    break;

    }

include('footer.php')
?>

</body>
</html>
