<?php

include('connexion.php');
	$bdd = Connexion();

	$reponse = $bdd->query('SELECT * FROM users');

	// foreach($reponse as $value){
	//     echo $value[0]['first_name'];
	    
	// }

