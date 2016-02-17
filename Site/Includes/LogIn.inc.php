<?php
//If the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {


	require('../../Includes/LogInFunctions.php');
	require('../../EE1EPEDBC.php');
	
	//Pull the login data from the post request.
	$RawUserName = $_POST["RAWUserName"];
	$RawPassword = $_POST["Password"];

	//Ensure user name is compleated.
	if (empty($RawUserName)  || empty($RawPassword) ) {

	PrintFormFormForReEntry(0);

} else { 

	$CheckLogin = check_login($dbc,$RawUserName, $RawPassword);

		if ($CheckLogin["LoginState"]) { //Correct user and pass.

		ClearAndStartSession(); 

		// Generate a secure ID $PsudoRandID
		$PsudoRandID = openssl_random_pseudo_bytes(50, $cstrong);

		$_SESSION['SessUserID'] = $PsudoRandID;
		$_SESSION['Status'] = "SiteAdminMode"; //Set status to alive
		setcookie("SessUserID", $PsudoRandID, time()+3600); //Expire in one hour.
		$_SESSION['UserName'] = $RawUserName;
		$_SESSION['UserID'] = $data['id'];	

		//redirect
		redirect_user('index.php');


		} else { // Unsuccessful!
			PrintFormFormForReEntry(1);
		}
	}

} 
else 
{ 	//Print the log in form to the page

	PrintFormFormForReEntry(-1);
}





function PrintFormFormForReEntry($Type){

	$CurrentPage = htmlspecialchars($_SERVER["PHP_SELF"]);

	//Determinte the introduction to give to the form.
	if ($Type == 0){

		echo 'Error, Please Compleate form bellow:</br></br>';

	} elseif ($Type == 1){

		echo 'Error, Incorrect Username or Password:</br></br>';

	}

	require('FormBuilder.php');

	$FormCreator = new FormBuilder;

	echo '<span id=LogInFormContainer>';

	echo $FormCreator->StartForm($PageCreationInstruction = array("Methord" => "post","Action" =>  1, "id" => "LogInForm"));

	$InputsRequired = array( array( "InputLabel" => "UserName: " , "OptInputHTMLSeperator" => "<br>"  ,"Options" => array( array('type', 'text') ,array('value', $_POST["RAWUserName"]), array("maxlength", 100), array("name", "RAWUserName")) ),array( "InputLabel" => "Password: " ,"Options" => array( array('type', 'password') ,array("maxlength", 100) , array("name", "Password")) ) );

	echo $FormCreator->CreateStandardInput($InputsRequired);

	echo '<br>';

	echo $FormCreator->CreateSubmitButton();

	echo $FormCreator->EndForm();

	echo '<span/>';

/*
	//Print the form to the page.
	echo "<form method=\"post\" action=\"$CurrentPage\" >"; //Submits Data to self

	if(isset($_POST["RAWUserName"])){//Add the submitted user name if avaliable
	echo 'User: <input type="text" name="RAWUserName" value="' . $_POST["RAWUserName"] . '"/></br>';
	}else{
		echo 'User: <input type="text" name="RAWUserName" /></br>';
	}
	echo 'Password: <input type="Password" name="Password"/></br>';
	echo '</br>';
	echo '<input type="submit" value="Log In"/>';
	echo "</form>";
*/


}





?>