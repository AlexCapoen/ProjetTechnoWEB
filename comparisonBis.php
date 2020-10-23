
<?php

	function answerComparision($array){
		
		$question_input_type=BDD::get()->query('SELECT question_input_type FROM question;')->fetchAll();

		foreach ($question_input_type as $key => $value) {
			// var_dump($value[0]);

			if ($value[0]=='input'){ //Si on a une input on compare différemment



				if ($question_id==3){ //rhinos
					if($answer_id==29500){
						$isGoodAnswer="true";
					}
				}
				elseif ($question_id==7) {
					if($answer_id==1515){
						$isGoodAnswer="true";
					}
				}
				
				if($isGoodAnswer){
					
					return "VRAIE";
				}

				else{

					return "FAUX";
				}

			}

			elseif ($value[0]=='checkbox') { //On gère les checkbox aussi à part

				//il faudra verifier ici le type array de answer_id avant de poursuivre


				if ($question_id==2){ //rhinos

					if($answer_id==29500){
						$isGoodAnswer=true;
					}
				}

				elseif ($question_id==8) { //question vainqueurs
					
					foreach ($answer_id as $key => $value) {
						echo "value";
						echo $value;
					}
				}
			}

		}
		// var_dump ($question_input_type[0]['question_input_type']);

		// $goodAnswer=BDD::get()->query('SELECT quizz_name FROM quizz;')->fetchAll();
	}


?>