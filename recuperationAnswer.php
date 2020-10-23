<?php

  include('PDOFactory.php');


  function insertArray($array){
    $arrayIncr = array();   //give Id of answer
    foreach ($array as $elm) {
      if(is_array($elm)){
        insertArray($elm);
      }
      else{
        if ($elm != 'Submit') {
          echo $elm;    //valeur id
        }
      }
    }
  }

  insertArray($_POST);

  ?>
