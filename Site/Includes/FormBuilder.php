<?php
//Form Builder Version 0.1
//05/07/10 RC
class FormBuilder{

	public function StartForm($ConfigOptsArray) {
		//This function creates the start of the form. this was the first one written and follows a unstatisfactory design, this could do with updating at some point.
		//Submit template: $PageCreationInstruction = array("Methord" => $Methord,"id" =>  $id,"Name" => $Name,"Action" => $Action );
		//<form action="" method="" id="" name="">

		if($ConfigOptsArray['Action'] == 1){//Current page
			$CurrentPage = htmlspecialchars($_SERVER["PHP_SELF"]);
			$StringBuilder = '<form action="' . $CurrentPage . '" ';
		} else{
			$StringBuilder = '<form action="' . $ConfigOptsArray['Action'] . '" ';
		}
		if(isset($ConfigOptsArray['Methord'])){
			$StringBuilder .= 'method="' . $ConfigOptsArray['Methord'] . '" ';
		}
		if(isset($ConfigOptsArray['id'])){
			$StringBuilder .= ' id="' . $ConfigOptsArray['id'] . '" ';
		}
		if(isset($ConfigOptsArray['Name'])){
			$StringBuilder .=   'name="' . $ConfigOptsArray['Name'] . '" ';
		}

		if(isset($ConfigOptsArray["Options"])){
				foreach ($ConfigOptsArray["Options"] as $key => $value) {
				$StringBuilder .= ' ' . $value[0] . '="' . $value[1] . '" ';
				}
			}


		$StringBuilder .= '>';

		return  $StringBuilder;

	}

	public function EndForm(){
		return '</form>';
	}

	public function CreateSelectInput($DataArray, $ConfigOptsArray){
		//This creates a select input for the user to use, it returns a string with the correct html.
		//supply the $ConfigOptsArray['name'] 
		//example: ($DataArray, array('name' => 'SelectName' , 'BlankFirst' => 1))

		$StringBuilder;
		
		$StringBuilder .=  '<select name="' . $ConfigOptsArray['name'] . '">';
		
		if(isset($ConfigOptsArray['BlankFirst']) && $ConfigOptsArray['BlankFirst']  == 1){
			$StringBuilder .=  '<option selected disabled hidden value=""></option>';
		}

		foreach($DataArray as $key => $SelectOption) {

				$StringBuilder .=  '<option value="' . $SelectOption . '">' . $SelectOption . '</option>';
			
		}

		$StringBuilder .=  '</select>';

		return $StringBuilder;


	}

	public function CreateTextArea($ConfigOptsArray){
		//This function allows the creation of a text area input.
		//Submit Template:  $Options = array( "InputLabel" => "comments: " , "TextAreaContents" => "Long text passage..." , "Options" => array(array('value', 'Rob')) );

		 $StringBuilder = '';//Ensure is clear.

		foreach ($ConfigOptsArray as $key => $ConfigOptsArraySingle) {


			if(isset($ConfigOptsArraySingle["InputLabel"])){
				$StringBuilder .= '<lablel>' . $ConfigOptsArraySingle["InputLabel"] . '</label>';
			} else{
				$StringBuilder .= '';
			}

		//Start the input tag
			$StringBuilder .= ' <textarea ';

			if(isset($ConfigOptsArraySingle["Options"])){
				foreach ($ConfigOptsArraySingle["Options"] as $key => $value) {
				$StringBuilder .= ' ' . $value[0] . '="' . $value[1] . '" ';
				}
			}

			//End the textarea tag
			$StringBuilder .= ' >';

			//Place the data in
			$StringBuilder .= $ConfigOptsArraySingle['TextAreaContents'];

			//close the textarea with closing tag

			$StringBuilder .= '</textarea>';


			if(!empty($ConfigOptsArraySingle["OptInputHTMLSeperator"])) {
				$StringBuilder .= $ConfigOptsArraySingle["OptInputHTMLSeperator"]; //Add the option input seperation
			}

		}

		return $StringBuilder;



	}

	public function CreateStandardInput($ConfigOptsArray){
		//This function creates a input with the specified parameters.
		//Submit Template:  $Options = array( "InputLabel" => "UserName: " ,"BoxRadioDefaultCheck" => "TRUE" ,"Options" => array( array('type', 'text') ,array('value', 'Rob')) );
		//To have a radiobutton or checkbox default checked supply "BoxRadioDefaultCheck" => "TRUE"

		 $StringBuilder = '';//Ensure is clear.

		foreach ($ConfigOptsArray as $key => $ConfigOptsArraySingle) {


			if(isset($ConfigOptsArraySingle["InputLabel"])){
				$StringBuilder .= '<lablel>' . $ConfigOptsArraySingle["InputLabel"] . '</label>';
			} else{
				$StringBuilder .= '';
			}

		//Start the input tag
			$StringBuilder .= ' <input ';

			foreach ($ConfigOptsArraySingle["Options"] as $key => $value) {
				$StringBuilder .= ' ' . $value[0] . '="' . $value[1] . '" ';
			}

			//End the input tag whilst allowing for default checked state

			if(isset($ConfigOptsArraySingle["BoxRadioDefaultCheck"]) && $ConfigOptsArraySingle["BoxRadioDefaultCheck"] = "TRUE"){
				$StringBuilder .= 'checked />';
			} else{
			$StringBuilder .= ' />';
			}


			if(!empty($ConfigOptsArraySingle["OptInputHTMLSeperator"])) {
				$StringBuilder .= $ConfigOptsArraySingle["OptInputHTMLSeperator"]; //Add the option input seperation
			}

		}

		return $StringBuilder;


	}

	public function CreateSubmitButton(){
		return '<button id="submit" type="submit">Submit</button>';
	}

}



?>
