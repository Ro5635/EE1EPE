<?php
require_once('../../Includes/S3SignedURLGen.php');
require_once('../../EE1EPEDBC.php');
?>

<!doctype html>

<html lang="en">
<head>
	<meta charset="utf-8">

	<title><?php $pageTitle ?></title>
	<meta name="description" content="<?php $pageDescription ?>">
	<meta name="author" content="Aston EE1EPE Team 2">

	<link rel="stylesheet" href="../Magic/CSS/Standard.css">
	<link rel='stylesheet' media='screen and (min-width: 900px)' href='../Magic/CSS/LargeScreen.css' />
	<link rel='stylesheet' media='screen and (min-width: 701px) and (max-width: 899px)' href='../Magic/CSS/Standard.css' />
	<link rel='stylesheet' media='screen and (min-width: 500px) and (max-width: 700px)' href='../Magic/CSS/MidScreen.css' />
	<link rel='stylesheet' media='screen and (max-width: 700px)' href='../Magic/CSS/Mobile.css' />

  <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <![endif]-->
</head>

<body>

	<header id="PageHeader">
		<nav class="PrimaryNav">
			<ul>
				<li><a href="index.php"><span class="NavLinkButton active">Home</span></a></li>
				<li><a href="authorise.php"><span class="NavLinkButton">Authorise</span></a></li>
				<li><a href="index.php"><span class="NavLinkButton">Data</span></a></li>
			</ul>
		</nav>
		<span class="MobileOnly" id="MobileHeader"><span id="HamburgerContainer" class="icon-menu"><img src=" <?php echo cloudFrontCannedPolicyURLSign('https://cdn.ro5635.co.uk/MediaSiteStructure/HamburgerMenuIcon.png') ?> "></span><span id="MobileTitle"><?php echo $pageTitle ?></span></span>
		<nav class="MobileNav MobileOnly">
		 <ul>
				<li><a href="index.php"><span class="NavLinkButton active">Home</span></a></li>
				<li><a href="authorise.php"><span class="NavLinkButton">Authorise</span></a></li>
				<li><a href="index.php"><span class="NavLinkButton">Data</span></a></li>
			</ul>
		</nav>

<?php
	if(isset($InsertGoogleSpamCatch)){
		if($InsertGoogleSpamCatch == 1){
			echo '<script type="text/javascript">';
			echo 'var onloadCallback = function() {';	
			echo 'grecaptcha.render(\'html_element\', {	\'sitekey\' : \'6LeIjBgTAAAAAGkBCyXq7rB43rNRlKw4btkhXTaF\'	});';
			echo '};</script>';

		

		}
	}
?>

	</header>