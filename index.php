<?php




// catch(Undefined $e){
//     echo $e."putee";
//     include("main.php");
// }

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
        
    default:
        include('main.php');
    break;
    
    }
include('footer.php')
?>




