<?php
$pageTitle = 'Authorise Messages';
$pageDescription = 'Submit mesages to the Cube';

require_once('../../Includes/CheckLogIn.php');
require_once('../../Includes/StdAdminHead.php');

echo '<span Class="Page"><section>';

include('../../Includes/StdImage.php');



?>

		<article id="MainPageContent">
						<span id="PageTitleContainer"><span id="PageTitle"><h1>Authorise Messages</h1></span></span>
						<span id="ArticleContentContainer">

						<span id="MessagesTable">
							<?php
							//Create the table of messages for authorisation:
								$stmt = $dbc->prepare('SELECT MessageText, GivenName  FROM Messages WHERE Authorised = 0 ORDER BY MessageID DESC');
  								$stmt->execute();
  								$DataBaseMessagesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
  								echo '<pre>';
  								var_dump($DataBaseMessagesData);
  								echo '</pre>';
							?>
						</span>

					</span>
		</article>


<?php
echo '	</section></span>';
include('../../Includes/StdFooter.php');
?>


	
	
		

		



	