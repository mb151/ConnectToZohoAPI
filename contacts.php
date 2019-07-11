<?php
	$firstname= $_POST["fname"];
	$Lastname= $_POST["Iname"];
	$email= $_POST["email"];


$xml =
'<?xml version="1.0" encoding="UTF-8"?>
<Leads>
	<row no="1">
		<FL val="First Name">'.$firstname.'</FL>
		<FL val="Last Name">'.$Lastname.'</FL>
		<FL val="Email">'.$email.'</FL>
	</row>
</Leads>';


/*------------------------------------Token-----------------------------------*/
//Le token generer en vous connectant a partir du lien 
//https://accounts.zoho.com/apiauthtoken/nb/create?SCOPE=ZohoCRM/crmapi&EMAIL_ID=votre_Email_de_connexion_sur_le_site_Zoho&PASSWORD=votre_mot_de_passe
$auth="__My___Token";
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