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

						<div id="MessagesTable">
							<?php
							//Create the table of messages for authorisation:
								$stmt = $dbc->prepare('SELECT MessageID , MessageText, GivenName  FROM Messages WHERE Authorised = 0 ORDER BY MessageID DESC');
  								$stmt->execute();
  								$DataBaseMessagesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
  								// echo '<pre>';
  								// var_dump($DataBaseMessagesData);
  								// echo '</pre>';

  								echo '<div class="MessagesAuthTable">';

  								echo '<span class="TableLine">';
  									  	echo '<span class="GivenNameColumn"><h3>Name</h3></span>';
  										echo '<span class="MessageTextColumn"><h3>Message</h3></span>';
  								echo '</span>';


  								foreach ($DataBaseMessagesData as $key => $DataBaseLine) {
  										echo '<span class="TableLine">';
  									  	echo '<span class="GivenNameColumn">' . $DataBaseLine['GivenName'] . '</span>';
  										echo '<span class="MessageTextColumn">' . $DataBaseLine['MessageText'] . '</span>';
  										echo '<span class="AuthoriseButton ButtonsBlock" ID="' . $DataBaseLine['MessageID'] . '" >Authorise</span>';
  										echo '<span class="DeleteButton ButtonsBlock" ID="' . $DataBaseLine['MessageID'] . '">Delete</span>';
  										echo '</span>';
  								}

  								echo '</div>';

							?>
						</div>

					</span>
		</article>


<?php
echo '	</section></span>';
include('../../Includes/StdFooter.php');
?>


	
	
		

		



	