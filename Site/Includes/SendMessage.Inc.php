<?php
//This is the send message form, include it in any location that you wish to have the messages submit form:

//Really need to not use this formbuilder...
require('FormBuilder.php');


$FormCreator = new FormBuilder;

	echo '<span id=SendMessageFormContainer>';

	echo $FormCreator->StartForm($PageCreationInstruction = array("Methord" => "post","Action" =>  1, "id" => "SendMessageForm"));

	$InputsRequired = array( array( "InputLabel" => "Name: " , "OptInputHTMLSeperator" => "<br>"  ,"Options" => array( array('type', 'text') ,array('value', $_POST["Name"]), array("maxlength", 20), array("name", "Name")) ));
	echo $FormCreator->CreateStandardInput($InputsRequired);

	echo '<textarea name="UserMessage" id="UserMessage"></textarea>';

	echo '<br>';

	echo '<button id="submitMessage" type="submit">Submit Message</button>';

	echo $FormCreator->EndForm();


?>
	
	
		

		



	