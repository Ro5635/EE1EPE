<?php
$pageTitle = 'Admin Home';
$pageDescription = 'Submit mesages to the Cube';

require_once('../../Includes/CheckLogIn.php');
require_once('../../Includes/StdAdminHead.php');

echo '<span Class="Page"><section>';

include('../../Includes/StdImage.php');



?>

		<article id="MainPageContent">
						<span id="PageTitleContainer"><span id="PageTitle"><h1>Admin Page</h1></span></span>
						<span id="ArticleContentContainer">

						<p><a href="uploads3image.php">Upload Image to S3 CDN.</a></p>
					</span>
		</article>


<?php
echo '	</section></span>';
include('../../Includes/StdFooter.php');
?>


	
	
		

		



	