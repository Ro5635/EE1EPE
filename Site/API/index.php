<?php
//This is the API for the system, the raspberry PI will send http requests to here.
//The raspbery PI will use get requests for this:

//	t : the task to be compleated by the request.
//  dv : DeviceTocken, the unique id for a device

//Include the databaase connection:
require_once('/var/www/html/ee1epeproject/EE1EPEDBC.php');

//The bellow function allows the user to create a new device for communication with teh server:
//Returns the devices new unique (Problems will happen here on scale but with only really one or two devices being used here im happy with the comprimise to dev time) tocken
function RegisternewDevice($dbc, $NewDeviceName){

	$stmt = $dbc->prepare('INSERT INTO Devices(SimpleName , DeviceTocken) VALUES(:NewDeviceName , :Tocken)');
	$tocken = bin2hex(openssl_random_pseudo_bytes(100));
	$stmt->execute(array(':NewDeviceName' => $NewDeviceName, ':Tocken' => $tocken));
	$_SESSION['RegisternewDeviceID'] = $dbc->lastInsertId();
	echo $tocken;
	
}

////////Functions:

function testConnection($dbc, $DeviceToken){
	$stmt = $dbc->prepare('SELECT SimpleName, DeviceID, JoinDate FROM Devices WHERE DeviceTocken = :SubmittedDeviceToken');
	$stmt->execute(array(':SubmittedDeviceToken'=>$DeviceToken ) );
	$Data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	var_dump($Data);
	return $Data;
}

function checkValidation($dbc, $DeviceToken){
	//This insures that the device has access...
	//This has room for future exandability. (Understatment)
	$stmt = $dbc->prepare('SELECT DeviceID FROM Devices WHERE DeviceTocken = :SubmittedDeviceToken');
	$stmt->execute(array(':SubmittedDeviceToken'=>$DeviceToken ) );
	$Data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$num_rows = count($Data);

	if($num_rows == 1){
  			//Recorgnised DeviceTocken
		return true;
	}else{
  			//Bad Tocken:
		return false;
	}

}

function getUndisplayedMessages($dbc, $DeviceToken){
	//Get all (max 50) of the undisplayed authenticated messages:
	$stmt = $dbc->prepare('SELECT MessageID, MessageText, GivenName, TimeAdded FROM Messages WHERE Authorised = 1 AND Displayed = 0 ORDER BY MessageID ASC LIMIT 50');
	$stmt->execute(array(':SubmittedDeviceToken'=>$DeviceToken ) );
	$Data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	var_dump($Data);
	return $Data ;
}

function getDeviceIDForDeviceTocken($dbc, $DeviceTocken){
	$stmt = $dbc->prepare('SELECT DeviceID FROM Devices WHERE  DeviceTocken = :SubmittedDeviceTocken');
	$stmt->execute(array(':SubmittedDeviceTocken'=>$DeviceToken )) ;
	$Data = $stmt->fetchAll(PDO::FETCH_ASSOC);
	return $Data;
}


function awkMessageDisplay($dbc, $DeviceID, $MessageID){
 	//This function allows the user to ackowledge that they have displayed a message on the cube and that it can be removed from the pennding requests.
	$stmt = $dbc->prepare('UPDATE Messages SET Displayed = 1 AND ShownOnDeviceID = :DisplayedDeviceID WHERE MessageID = :MessageID');
	$stmt->execute(array(':DisplayedDeviceID'=>$DeviceID , ':MessageID' => $MessageID) );

 }

///////End of functions




if($_SERVER['REQUEST_METHOD'] == "POST")
{
	if($_POST['TASK'] == 1){
		//Create an Account:
		//CreateAccount($dbc, $_POST['userName'], $_POST['password']);
	} elseif ($_POST['TASK'] == 2) {
		//Register an new device:
		RegisternewDevice($dbc, $_POST['simpleName']);

	}

	switch ($_POST['t']) {
		case '1':
			//Test Connection by returnuing the device ID.
		testConnection($dbc, $_POST['dt']);
		die;
		break;
		
		case '2':
		//Get all of the undisplayed Authenticated messages:
		if(checkValidation($dbc,$_POST['dt'])){
			getUndisplayedMessages($dbc, $_POST['dt']);
		}else{
			error_log("API DeviceTocken Validation Failed");
			die;
		}
		break;

		case '3':
		$DevieID = getDeviceIDForDeviceTocken($dbc, $_POST['dt']);
		awkMessageDisplay($dbc, $DevieID, $_POST['MessageID']);
		die;
		break;

		default:
			# code...
		break;
	}

} elseif ($_SERVER['REQUEST_METHOD'] == "GET") {
	//This will mainly be used for testing purposes.
	switch ($_GET['t']) {
		case '1':
			//Test Connection by returnuing the device ID.
		testConnection($dbc, $_GET['dt']);
		die;
		break;
		
		case '2':
		//Get all of the undisplayed Authenticated messages:
		if(checkValidation($dbc,$_GET['dt'])){
			getUndisplayedMessages($dbc, $_GET['dt']);
		}else{
			error_log("API DeviceTocken Validation Failed");
			die;
		}
		break;

		case '3':
		$DevieID = getDeviceIDForDeviceTocken($dbc, $_GET['dt']);
		awkMessageDisplay($dbc, $DevieID, $_GET['MessageID']);
		die;
		break;

		default:
			# code...
		break;
	}
}






?>