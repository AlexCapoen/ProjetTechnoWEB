<?php

if($_GET['page']==NULL){
    $page = '';

}
else{
    $page = $_GET['page'];
}


include('PDOFactory.php');
include('header.php');
include('displayFonctions.php');

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
        
    default:
        include('main.php');
    break;
    
    }
include('footer.php')
?>




