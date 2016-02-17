<?php
$pageTitle = 'Admin Login';
$pageDescription = 'Login to the admin pannel';

require_once('../../Includes/StdAdminHead.php');

echo '<span Class="Page"><section>';

include('../../Includes/StdImage.php');



?>

    <article id="MainPageContent">
            <span id="PageTitleContainer"><span id="PageTitle"><h1>Admin Login Page</h1></span></span>
            <span id="ArticleContentContainer">

            <p>Please login to the admin pannel:</p><br>
            <?php include('../../Includes/LogIn.inc.php'); ?>
          </span>
    </article>


<?php
echo '  </section></span>';
include('../Includes/StdFooter.php');
?>


  
  
    

    



  