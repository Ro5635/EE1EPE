<?php
// Quick and dirty file type check, not inteligent a definate secuiriy hole.
//onus entierly om the user to not do anything bad.
//Source: http://www.9lessons.info/2012/08/upload-files-to-amazon-s3-php.html 

function getExtension($str) 
{
$i = strrpos($str,".");
if (!$i) { return ""; }
$l = strlen($str) - $i;
$ext = substr($str,$i+1,$l);
return $ext;
}
//Here you can add valid file extensions. 
$valid_formats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");
?>