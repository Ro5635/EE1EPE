<?php
$pageTitle = 'Upload Image';
$pageDescription = 'Submit mesages to the Cube';


require_once('../../Includes/StdAdminHead.php');



include('../../Includes/StdImage.php');

include('image_check.php'); // getExtension Method
$msg='';
$outputMessages = 0;
if($_SERVER['REQUEST_METHOD'] == "POST")
{
	$name = $_FILES['file']['name'];
	$size = $_FILES['file']['size'];
	$tmp = $_FILES['file']['tmp_name'];
	$ext = getExtension($name);

	if(strlen($name) > 0)
	{
// File format validation
		if(in_array($ext,$valid_formats))
		{
// File size validation
if($size<(1024*1024 * 10))	//10 Megs is reasonable, cost is based on data don't forget!
{
	include('s3_config.php');
//Rename image name. 
	$actual_image_name = $_POST['fileName'] . ".".$ext;

	if($s3->putObjectFile($tmp,  $bucket , 'EE1EPE/Media/' . $actual_image_name,  S3::ACL_PRIVATE) )
	{
		$msg = "S3 Upload Successful."; 
		$s3file='https://cdn.ro5635.co.uk/'. $actual_image_name ;
		$outputMessages = 1;
	}
	else
		$msg = "S3 Upload Fail.";

}
else
	$msg = "Image size Max 1 MB";

}
else
	$msg = "Invalid file, please upload image file.";

}
else
	$msg = "Please select image file.";

}

echo '<span Class="Page"><section>';

?>
<article id="MainPageContent">
	<span id="PageTitleContainer"><span id="PageTitle"><h1>Upload Image</h1></span></span>
	<span id="ArticleContentContainer">

		<form action="" method='post' enctype="multipart/form-data">
			Upload image file here
			<input type='file' name='file'/>
			<br><br>
			FileName: (Ensure Unique!!)<input type="text" name="fileName">
			<br><br>
			<input type='submit' value='Upload Image'/>
			
			<?php echo $msg; 
			if($outputMessages == 1){
				echo "Image placed at: $s3file";
				echo '<br><br>Image:<br><br>';
				echo '<img src="' . cloudFrontCannedPolicyURLSign($s3file) . '">';
			}
			?>
		</form>


		<p></p>
	</span>
</article>





<?php
echo '	</section></span>';
include('../../Includes/StdFooter.php');
?>

