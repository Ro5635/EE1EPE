<?php
//This is the send message form, include it in any location that you wish to have the messages submit form:

//Really need to not use this formbuilder...
require('FormBuilder.php');


$FormCreator = new FormBuilder;

	echo '<span id=SendMessageFormContainer>';

	echo $FormCreator->StartForm($PageCreationInstruction = array("Methord" => "post","Action" =>  1, "id" => "SendMessageForm", "class" => "UserForm"));

	echo '<span id="NameTextBoxLabel">Name:</span>';

	echo '<span id="NameTextBoxContainer">';

	$InputsRequired = array( array( "OptInputHTMLSeperator" => "<br>"  ,"Options" => array( array('type', 'text') ,array('value', $_POST["Name"]), array("maxlength", 20), array("name", "Name") , array("id", "NameTextBox")) ));
	echo $FormCreator->CreateStandardInput($InputsRequired);


	echo '</span><span id="EmailText">Email: </span><span id="EmailInputBound"><br><input type="text" name="emailAddressInput" id="emailAddressInput"/></span><br><br>Message:';

	if(isset($_POST['UserMessage'])){ 
		$TextArreaContents = $_POST['UserMessage'];
	} else {
		$TextArreaContents = "";
	}

	echo '<textarea name="UserMessage" id="UserMessage">' . $TextArreaContents . '</textarea>';

	echo '<br><br><span id="GoogleAntiSpanStyleBuffer"></span>';

	//Google Recaptcha:
	echo '<div id="html_element"></div>';

	echo '<br><br><span id="submitMessageFormButtonContainer"><button id="submitMessage" type="submit">Submit Message</button></span>';

	echo $FormCreator->EndForm();
?>
	
	
		

		



	