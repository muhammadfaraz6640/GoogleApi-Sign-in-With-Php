<?php

require_once 'vendor/autoload.php';

$clientID = "583092311620-toop7bhtt33q5dm4dp87mbg9e78avvvu.apps.googleusercontent.com";

$clientSecret = "LUhMgMft8lh7yEVCiMuaWsW1";

$redirectUrl = "http://localhost/GoogleApi/redirect.php";

$client = new Google_Client();
$client->setClientId($clientID);
$client->setClientSecret($clientSecret);
$client->setRedirectUri($redirectUrl);

$client->addScope('email');
$client->addScope('profile');

if(isset($_GET['code'])){
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);    
    $client->setAccessToken($token['access_token']);

    $google_oauth = new Google_Service_Oauth2($client);

    $account_info = $google_oauth->userinfo->get();
    $email = $account_info->email;
    $name = $account_info->name;
    $pic = $account_info->picture;

    echo $email;
    echo $name;
    echo "<img src='$pic'/>";
}else{
    echo "<a href=".$client->createAuthUrl().">Login With Google</a>";
}
?>