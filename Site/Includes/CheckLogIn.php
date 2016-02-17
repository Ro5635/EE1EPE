<?php
session_start();
//require('Includes/LogInFunctions.php');
//Ensure user is logged in
if ($_SESSION['Status'] != "SiteAdminMode"){
	//Not logged In!
	redirect_user2('login.php');
	die;


} else{

	if( $_COOKIE['SessUserID'] != $_SESSION['SessUserID']){
        //User is not logged in 
		redirect_user2('login.php');
		die;

	} else{

		$LoggedInChecked = true;
	}
}


//included from login functions to solve file relative location disparity 
function redirect_user2 ($page = 'index.php') {

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



?>
