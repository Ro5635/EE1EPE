<?php
//This generates the Secure signed S3 URLS:

//The cloudfront key ID and location of the private cloudfront key is bellow in the 'get_canned_policy_stream_name' function, keep this updated.

//Amazon php code follows:


 function rsa_sha1_sign($policy, $private_key_filename) {
    $signature = "";

    // load the private key
    $fp = fopen($private_key_filename, "r");
    $priv_key = fread($fp, 8192);
    fclose($fp);
    $pkeyid = openssl_get_privatekey($priv_key);

    // compute signature
    openssl_sign($policy, $signature, $pkeyid);

    // free the key from memory
    openssl_free_key($pkeyid);

    return $signature;
 }

function url_safe_base64_encode($value) {
    $encoded = base64_encode($value);
    // replace unsafe characters +, = and / with 
    // the safe characters -, _ and ~
    return str_replace(
        array('+', '=', '/'),
        array('-', '_', '~'),
        $encoded);
 }

//The $expires, $key_pair_id and $private_key_filename has been replaced with a 2 mins and as above, this will do for this application. This has changed the signature.
//PHP does not do method overloading so im leaving it like this. If your looking for a bug intergrating outher code this is
//likley it. RC.    'https://cdn.ro5635.co.uk/'

function cloudFrontCannedPolicyURLSign($mediaFilePath) {
    // this policy is well known by CloudFront, but you still need to sign it, 
    // since it contains your parameters


//Location of the CLoudFront key on the server:
$private_key_filename = '/var/AWSKeys/CloudFront/pk-APKAI3O4WVSJRO2O3K4Q.pem';

//The CloudFront key pair ID. NOTE CLOUDFRONT IS SEPERATE TO STANDARD IAM STUFF, WHY? WHO KNOWS.
$key_pair_id = 'APKAI3O4WVSJRO2O3K4Q';


    //60 Second live time on the links that are generated.
    $expires = time() + 60;

    $canned_policy = '{"Statement":[{"Resource":"'  . $mediaFilePath . '","Condition":{"DateLessThan":{"AWS:EpochTime":'. $expires . '}}}]}';
    
    // sign the canned policy
    $signature = rsa_sha1_sign($canned_policy, $private_key_filename);
    // make the signature safe to be included in a url
    $encoded_signature = url_safe_base64_encode($signature);

    // combine the above into a stream name
    $stream_name = create_stream_name($mediaFilePath, null, $encoded_signature, $key_pair_id, $expires);
    // url-encode the query string characters to work around a flash player bug
    //return 'https://cdn.ro5635.co.uk/'.  encode_query_params($stream_name);
    return $stream_name;
    }


    function create_stream_name($stream, $policy, $signature, $key_pair_id, $expires) {
    $result = $stream;
    // if the stream already contains query parameters, attach the new query parameters to the end
    // otherwise, add the query parameters
    $separator = strpos($stream, '?') == FALSE ? '?' : '&';
    // the presence of an expires time means we're using a canned policy
    //$path = 'https://cdn.ro5635.co.uk/';
    if($expires) {
        $result .= $path . $separator . "Expires=" . $expires . "&Signature=" . $signature . "&Key-Pair-Id=" . $key_pair_id;
        error_log("APPLE happen");
    } 
    // not using a canned policy, include the policy itself in the stream name
    else {
        $result .= $path . $separator . "Policy=" . $policy . "&Signature=" . $signature . "&Key-Pair-Id=" . $key_pair_id;
        error_log("This should nwever happen");
    }

    // new lines would break us, so remove them
    return str_replace('\n', '', $result);
}

function encode_query_params($stream_name) {
    // the adobe flash player has trouble with query parameters being passed into it, 
    // so replace the bad characters with their url-encoded forms
    return str_replace(
        array('?', '=', '&'),
        array('%3F', '%3D', '%26'),
        $stream_name);
}