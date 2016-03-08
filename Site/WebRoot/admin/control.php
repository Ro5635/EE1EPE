<?php


$pageTitle = 'Authorise Messages';
$pageDescription = 'Submit mesages to the Cube';

//Check the login details:
require_once('../../Includes/CheckLogIn.php');
//Deal with the POST requests from the site, see 

//Include the databaase connection:
require_once('../..//EE1EPEDBC.php');


if($_SERVER['REQUEST_METHOD'] == "POST") {

  switch ($_POST['t']) {

    case 9:
      //This 'deletes' the messages:
      $stmt = $dbc->prepare('UPDATE Messages SET Authorised = 2 WHERE MessageID = :SubmittedMessagesID');
      $stmt->execute(array(':SubmittedMessagesID'=> $_POST['mid'] ) );
    break;

    case 10:
      //AJAX Serve table content as a whole:
      include('Includes/authTableInclude.php');
    break;

    default:
      echo 'error';
    break;
  }
  die;
} else if ($_SERVER['REQUEST_METHOD'] == "GET"){
    switch ($_GET['t']) {
      case 11:
         //AJAX Serve table content as a whole:
        include('Includes/authTableInclude.php');
        die;
      break;
      
      default:
        
      break;
    }
}

require_once('../../Includes/StdAdminHead.php');

echo '<span Class="Page"><section>';

include('../../Includes/StdImage.php');






?>

<article id="MainPageContent">
  <span id="PageTitleContainer"><span id="PageTitle"><h1>LED Cube Control</h1></span></span>
  <span id="ArticleContentContainer">


    <p><span class="ButtonsBlockStyle2 DeStyleLink"><a href="uploads3image.php">Upload Image for display on cube.</a></span></p>


   <?php
   //Include the autharised messages table:
   include('awatingDisplayTableInclude.php');

   ?>

  <br><br>
  <span class="regNewDevice"><?php  require_once('RegisterNewDevice.inc.php');  ?>
  </span>


</span>
</article>


<?php
echo '	</section></span>';
include('../../Includes/StdAdminFooter.php');
?>










