<?php

	function ProccessMessage($dbc ,$GivenName, $GivenMessage, $GivenEmail){
		//Add the new data to the database:
		$stmt = $dbc->prepare('INSERT INTO Messages(MessageText, GivenName) Values(:MessageText,:GivenUserName)');
  		$stmt->execute(array(':MessageText' => $GivenMessage , ':GivenUserName' => $GivenName ) );

  		//Send the email to the user if requested:

  		//IMPLEMENT THIS


	}
//This submits the message from the user to the databse and handles any email sending:

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		//Qurey The google API with the recapcha:
	    $response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LeIjBgTAAAAAKknkCcw8g2tnK12l0iN7llzYlgq&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']), true);

        if($response['success'] == true)
        {
          ProccessMessage($dbc, $_POST['Name'], $_POST['UserMessage'] , $EMAIL);
        }
        else
        {
        //The recapcha failed.
        //Have the user try again...
        //posibly intergrate fail2ban here
        }



}
   