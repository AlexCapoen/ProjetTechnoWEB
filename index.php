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
include('PDOFactory.php');
include('header.php');
include('displayFonctions.php');

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
        include('quizz.php');
        break;
    case "reponse":
        include('reponsequizz.php');
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

    default:
        include('main.php');
    break;

    }

include('footer.php')
?>

</body>
</html>
