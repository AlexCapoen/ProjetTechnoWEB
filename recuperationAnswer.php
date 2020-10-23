<?php

function addAnswerInDB($answer){
  if(isset($_POST['valide'])){
    insertArray($answer);
  }
  else{
    echo "ca marche pas";
  }
}


function insertArray($array){
  foreach ($array as $elm) {
    if(is_array($elm)){
      insertArray($elm);
    }
    else{
        //inserer elm dans la db

    }
  }
}

print_r($_POST);

  ?>
