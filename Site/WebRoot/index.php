<?php
$pageTitle = 'Home';
$pageDescription = 'Submit mesages to the Cube';


require_once('../Includes/StdHead.php');

echo '<span Class="Page"><section>';

include('../Includes/StdImage.php');



?>

		<article id="MainPageContent">
						<span id="PageTitleContainer"><span id="PageTitle"><h1>Main Page</h1></span></span>
						<span id="ArticleContentContainer">
						<?php echo '<img src="' .  cloudFrontCannedPolicyURLSign('https://cdn.ro5635.co.uk/Cone.jpg') . '">'; 
						
						require('../Includes/SendMessage.Inc.php');


						?>
					</span>
		</article>


<?php
echo '	</section></span>';
include('../Includes/StdFooter.php');
?>


	
	
		

		



	