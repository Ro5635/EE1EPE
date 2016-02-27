<?php


$pageTitle = 'Authorise Messages';
$pageDescription = 'Submit mesages to the Cube';

require_once('../../Includes/CheckLogIn.php');
//Deal with the POST requests from the site, see 

//Include the databaase connection:
require_once('../..//EE1EPEDBC.php');

if($_SERVER['REQUEST_METHOD'] == "POST") {

  if($_POST['task'] == 8){
    //Autharise the message:
    $stmt = $dbc->prepare('UPDATE Messages SET Authorised = 1 WHERE MessageID = :SubmittedMessagesID');
    $stmt->execute(array(':SubmittedMessagesID'=> $_POST['mid'] ) );
  
  } else if($_POST['task'] == 9){
    //This 'deletes' the messages:
    $stmt = $dbc->prepare('UPDATE Messages SET Authorised = 2 WHERE MessageID = :SubmittedMessagesID');
    $stmt->execute(array(':SubmittedMessagesID'=> $_POST['mid'] ) );

  }else{
    echo 'error';
  }

  die;
}







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


            <div class="MessagesAuthCompleteTable">

            </div>

					</span>
		</article>


<?php
echo '	</section></span>';
include('../../Includes/StdAdminFooter.php');
?>


	
	
		

		



	