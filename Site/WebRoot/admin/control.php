<?php

$InsertControlAJAX = 1;
$pageTitle = 'Authorise Messages';
$pageDescription = 'Submit mesages to the Cube';

//Check the login details:
require_once('../../Includes/CheckLogIn.php');
//Deal with the POST requests from the site, see 

//Include the databaase connection:
require_once('../..//EE1EPEDBC.php');

require_once('../../Includes/StdAdminHead.php');

echo '<span Class="Page"><section>';

include('../../Includes/StdImage.php');

?>

<article id="MainPageContent">
  <span id="PageTitleContainer"><span id="PageTitle"><h1>LED Cube Control</h1></span></span>
  <span id="ArticleContentContainer">


    <p><span class="ButtonsBlockStyle2 DeStyleLink"><a href="uploads3image.php">Upload Image for display on cube.</a></span></p>

    <?php
    //Create the buttons to control the differnt animations that are avalible on the cube.
    echo '<span id="AnButtonsPanel">';

    //The number of buttons to be created, the button number is it s label:
    $NumButtons = 9;

    for ($i=1; $i < ($NumButtons + 1); $i++) { 
      echo '<span class="AnButton" id="' . $i . '">' . $i . '</span>';
    }


    echo '</span><br><br>'; 

    ?>





 <span id="AJAXAuthTable">
              <?php 
              //Include the autharised messages table:
              include('../../API/awatingDisplayTableInclude.php');
              ?>
    </span>

  <br><br>
  <span class="regNewDevice"><?php  require_once('RegisterNewDevice.inc.php');  ?>
  </span>


</span>
</article>


<?php
echo '	</section></span>';
include('../../Includes/StdAdminFooter.php');
?>










