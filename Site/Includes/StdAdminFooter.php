<footer>
	<p>Copyright 2016 EE1EPE Team 2</p>
</footer>



<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.8/jquery.min.js"></script>
<script src="../Magic/Scripts/Standard.js"></script>
<script src="Magic/Scripts/SecureStandard.js"></script>
<?php
if(isset($InsertGoogleSpamCatch)){
	if ($InsertGoogleSpamCatch == 1) {
		echo '<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"async defer></script>';
	}
}
?>
</body>
</html>