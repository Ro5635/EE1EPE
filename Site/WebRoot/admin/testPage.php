<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$captcha=$_POST['g-recaptcha-response'];
error_log($_POST['g-recaptcha-response']);
	       $response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LeIjBgTAAAAAKknkCcw8g2tnK12l0iN7llzYlgq&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
        if($response['success'] == false)
        {
          echo '<h2>You are spammer ! Get the out</h2>';
        }
        else
        {
          echo '<h2>Thanks for posting comment.</h2>';
        }

    }


$pageTitle = 'Admin Home';
$InsertGoogleSpamCatch = 1;
$pageDescription = 'Submit mesages to the Cube';

require_once('../../Includes/CheckLogIn.php');
require_once('../../Includes/StdAdminHead.php');

echo '<span Class="Page"><section>';

include('../../Includes/StdImage.php');



?>

<article id="MainPageContent">
	<span id="PageTitleContainer"><span id="PageTitle"><h1>Admin TEST Page</h1></span></span>
	<span id="ArticleContentContainer">

		<p><a href="uploads3image.php">Upload Image to S3 CDN.</a></p>

		<form action="?" method="POST">
			<div id="html_element"></div>
			<br>
			<input type="submit" value="Submit">
		</form>






	</span>
</article>


<?php
echo '	</section></span>';
include('../../Includes/StdAdminFooter.php');
?>










