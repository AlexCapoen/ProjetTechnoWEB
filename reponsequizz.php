<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e4339b56d6.js" crossorigin="anonymous"></script>
    <title>Quizz</title>
  </head>
  <body>
  <div class='container'>
    <?php 
      include('PDOFactory.php');
      include('header.php'); 
    ?>
         <?php
          include('displayFonctions.php');
          afficherrep($_GET['id']);
          ?>
    <?php include('footer.php'); ?>
  </div>
  </body>
</html>
