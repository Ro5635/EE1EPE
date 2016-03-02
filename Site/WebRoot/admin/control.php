<?php


$pageTitle = 'Authorise Messages';
$pageDescription = 'Submit mesages to the Cube';

//Check the login details:
require_once('../../Includes/CheckLogIn.php');
//Deal with the POST requests from the site, see 

//Include the databaase connection:
require_once('../..//EE1EPEDBC.php');

//The XHRs from here will use authorise.php.

require_once('../../Includes/StdAdminHead.php');

echo '<span Class="Page"><section>';

include('../../Includes/StdImage.php');






?>

<article id="MainPageContent">
  <span id="PageTitleContainer"><span id="PageTitle"><h1>LED Cube Control</h1></span></span>
  <span id="ArticleContentContainer">


    <p><span class="ButtonsBlockStyle2 DeStyleLink"><a href="uploads3image.php">Upload Image for display on cube.</a></span></p>


    <div id="MessagesTable">
     <?php

     echo '<p>Messages Waiting to be displayed on cube:</p>';

		 //Create the table of messages that are waiting to be displayed:

     $stmt = $dbc->prepare('SELECT MessageID , MessageText, GivenName  FROM Messages WHERE Authorised = 1 ORDER BY MessageID ASC');
     $stmt->execute();
     $DataBaseMessagesData = $stmt->fetchAll(PDO::FETCH_ASSOC);

     echo '<div class="MessagesAuthTable">';

     echo '<span class="TableLine">';
     echo '<span class="GivenNameColumn"><h3>Name</h3></span>';
     echo '<span class="MessageTextColumn"><h3>Message</h3></span>';
     echo '</span>';


     //JQuery Slide issue workaround:
     echo '<span class="TableLine">';
     echo '<span class="GivenNameColumn"></span>';
     echo '<span class="MessageTextColumn"></span>';
     echo '<span class="AuthoriseButton ButtonsBlock" ID="" ></span>';
     echo '<span class="DeleteButton ButtonsBlock" ID=""></span>';
     echo '</span><br><span class="LineSpacer"></span>';


     foreach ($DataBaseMessagesData as $key => $DataBaseLine) {
      echo '<span class="TableLine">';
      echo '<span class="GivenNameColumn">' . $DataBaseLine['GivenName'] . '</span>';
      echo '<span class="MessageTextColumn">' . $DataBaseLine['MessageText'] . '</span>';
      echo '<span class="DeleteButtonPendingDisplay ButtonsBlock" ID="' . $DataBaseLine['MessageID'] . '">Delete</span>';
      echo '</span><br><span class="LineSpacer"></span>';
    }

    echo '</div>';


    ?>
  </div>

  <br><br>
  <span class="regNewDevice"><?php  require_once('RegisterNewDevice.inc.php');  ?>
  </span>


</span>
</article>


<?php
echo '	</section></span>';
include('../../Includes/StdAdminFooter.php');
?>










