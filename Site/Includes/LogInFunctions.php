<?php 

function redirect_user ($page = 'index.php') {

	// Start defining the URL...
	// URL is http:// plus the host name plus the current directory:
	$url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
	
	// Remove any trailing slashes:
	$url = rtrim($url, '/\\');
	
	// Add the page:
	$url .= '/' . $page;
	
	// Redirect the user:
	header("Location: $url");
	exit(); // Quit the script.

} // End of redirect_user() function.


//Function to clear out all session data and the local cookie
function ClearAndStartSession(){

	session_unset();   // Remove the $_SESSION variable information.
	session_destroy(); // Remove the server-side session information.

	// Unset the cookie on the client-side.
	setcookie("PHPSESSID", "", 1); // Expire the PHP sessID cookie.

	setcookie("UserID", "", time()); //Expire User ID cookie

	// Start a new session
	session_start();

	// Generate a new session ID
	session_regenerate_id(true);

	// pick up the new session ID
	$session_id = session_id();

	// $_SESSION will now be empty, and $session_id will have been regenerated.
	// You have a completely empty, new session.

}

function LogOut(){

	session_unset();   // Remove the $_SESSION variable information.
	session_destroy(); // Remove the server-side session information.

	// Unset the cookie on the client-side.
	setcookie("PHPSESSID", "", 1); // Expire the PHP sessID cookie.

	setcookie("UserID", "", time()); //Expire User ID cookie

	

}
function ReDirectToSiteRoot(){
	$url = 'http://' . $_SERVER['HTTP_HOST'];
	$url = rtrim($url, '/\\');
	
	// Redirect the user:
	header("Location: $url");
	die(); 
}




function RemoveSessionEntirely(){
	//UESED?
	
	session_unset();   // Remove the $_SESSION variable information.
	session_destroy(); // Remove the server-side session information.

	// Unset the cookie on the client-side.
	setcookie("PHPSESSID", "", 1); // Expire the cookie.

}



/* This function validates the form data (user and password).
 * The function requires a database connection.
 * The function returns an array of information, including:
 * - a TRUE/FALSE variable indicating success
 * - an array of the database result if success
 */
function check_login($dbc, $username = '', $pass = '') {
  //PDO update makes string cleaning against SQL injection redundent.

  $stmt = $dbc->prepare('SELECT UserID FROM Users  WHERE ComName=:CleanUserName and Password=sha1(:UserPass)');
  $stmt->execute(array(':CleanUserName' => $username , ':UserPass' => $pass ) );
  $Data = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $num_rows = count($Data);

  if($num_rows == 1){

  return array("LoginState" => true,"Data" =>  $Data);

  } else{
  	//Login Failed.

  	return array("LoginState" => false,"Data" =>  "FAIL");

  }
	
} // End of check_login() function.
