<?php
	/*$firstname= $_POST["fname"];
	$Lastname= $_POST["Iname"];
	$email= $_POST["email"];*/

	include('connexion.php');
	$bdd = Connexion();

	$reponse = $bdd->query('SELECT * FROM users');
	$xml =
	'<?xml version="1.0" encoding="utf-8"?>
	<Leads>';
	$cmp = 1;
	foreach($reponse as $value){
		//if($cmp >= 1) break;
	   $xml .= '<row no="'.$cmp.'">
			<FL val="First Name">'.$value['first_name'].'</FL>
			<FL val="Last Name">'.$value['last_name'].'</FL>
			<FL val="Company">'.$value['company'].'</FL>
			<FL val="Email">'.$value['email'].'</FL>
			<FL val="Phone">'.$value['phone'].'</FL>
		</row>';
		$cmp++;
	}
	$xml .= '</Leads>';




/*------------------------------------Token-----------------------------------*/
//Le token generer en vous connectant a partir du lien 
//https://accounts.zoho.com/apiauthtoken/nb/create?SCOPE=ZohoCRM/crmapi&EMAIL_ID=votre_Email_de_connexion_sur_le_site_Zoho&PASSWORD=votre_mot_de_passe
$auth="930c52a9d307134e318ee6424d268130";
/*-------------------------------------------------------------------------------*/

/*-------------Liens pour l'entité que vous sohaite remplir ici les leads-----------------*/
$url ="https://crm.zoho.com/crm/private/xml/Leads/insertRecords";
/*----------------------------------------------------------------------------------------*/

$query="authtoken=".$auth."&scope=crmapi&newFormat=1&xmlData=".$xml;

$ch = curl_init();

/* set url to send post request */
curl_setopt($ch, CURLOPT_URL, $url);

/* allow redirects */
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);

/* return a response into a variable */
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

/* times out after 30s */
curl_setopt($ch, CURLOPT_TIMEOUT, 30);

/* desactivation de la verification de ssl */
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
/* set POST method */
curl_setopt($ch, CURLOPT_POST, 1);

/* add POST fields parameters */
curl_setopt($ch, CURLOPT_POSTFIELDS, $query);// Set the request as a POST FIELD for curl.

//Execute cUrl session
$response = curl_exec($ch);

//var_dump(curl_error($ch));
curl_close($ch);
echo $response;
?>