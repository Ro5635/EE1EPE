<?php
// Bucket Name
$bucket="uniprojects/EE1EPE/Media/";
if (!class_exists('S3'))require_once('S3.php');

//AWS access info
//Modified by RC to pull key from /var/Amazon for secuirity (Public Code) 


$fp = fopen('/var/AWSKeys/IAM/AWSAKEE1EPE', "rb");
$AWSAK = fread($fp, 8192);
fclose($fp);

$fp = fopen('/var/AWSKeys/IAM/AWSSKEE1EPE', "rb");
$AWSSK = fread($fp, 8192);
fclose($fp);

if (!defined('awsAccessKey')) define('awsAccessKey', $AWSAK);
if (!defined('awsSecretKey')) define('awsSecretKey',$AWSSK);

$s3 = new S3(awsAccessKey, awsSecretKey);
//$s3->putBucket($bucket, S3::ACL_PUBLIC_READ);
