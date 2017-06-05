<?php

if(!session_id()){
        session_start();
};

require_once('../facebook_sdk/autoload.php');
include_once('../config.php');

include_once('../classes/Db.php');
include_once('../classes/User.php');
include_once('../classes/Melding.php');

 $fb = new Facebook\Facebook([
  'app_id' => $fb_config['app_id'],
  'app_secret' => $fb_config['app_secret'],
  'default_graph_version' => $fb_config['default_graph_version'],
  ]);

$helper = $fb->getRedirectLoginHelper();

$_SESSION['FBRLH_state']=$_GET['state'];

try {
  $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

if (! isset($accessToken)) {
  if ($helper->getError()) {
    header('HTTP/1.0 401 Unauthorized');
    echo "Error: " . $helper->getError() . "\n";
    echo "Error Code: " . $helper->getErrorCode() . "\n";
    echo "Error Reason: " . $helper->getErrorReason() . "\n";
    echo "Error Description: " . $helper->getErrorDescription() . "\n";
  } else {
    header('HTTP/1.0 400 Bad Request');
    echo 'Bad request';
  }
  exit;
}

// Logged in
//echo '<h3>Access Token</h3>';
//var_dump($accessToken->getValue());

// The OAuth 2.0 client handler helps us manage access tokens
$oAuth2Client = $fb->getOAuth2Client();

// Get the access token metadata from /debug_token
$tokenMetadata = $oAuth2Client->debugToken($accessToken);
//echo '<h3>Metadata</h3>';
//var_dump($tokenMetadata);

// Validation (these will throw FacebookSDKException's when they fail)
$tokenMetadata->validateAppId($fb_config['app_id']);
// If you know the user ID this access token belongs to, you can validate it here
//$tokenMetadata->validateUserId('123');
$tokenMetadata->validateExpiration();

if (! $accessToken->isLongLived()) {
  // Exchanges a short-lived access token for a long-lived one
  try {
    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
  } catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
    exit;
  }

  //echo '<h3>Long-lived</h3>';
  //var_dump($accessToken->getValue());
}

$_SESSION['fb_access_token'] = (string) $accessToken;

// User is logged in with a long-lived access token.
// You can redirect them to a members-only page.


try {
  // Returns a `Facebook\FacebookResponse` object
  $response = $fb->get('/me?fields=id,first_name,last_name,email,picture', $_SESSION['fb_access_token']);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

$user = $response->getGraphUser();

//geef user in sessie een facebook_id in de db
$conn = Db::getInstance();
$profile = new User;
$statement = $conn->prepare("UPDATE users SET facebook_id = :facebook_id, firstname = :firstname, lastname = :lastname WHERE username = :username;");
$statement->bindValue(":username", $_SESSION["user"]);
$statement->bindValue(":facebook_id", $user->getId());
$statement->bindValue(":firstname", $user->getFirstName());
$statement->bindValue(":lastname", $user->getLastName());
$statement->execute();
//sessies aanpassen
$_SESSION['firstname'] = $user->getFirstName();
$_SESSION['lastname'] = $user->getLastName();

header('Location: ../pages/profile.php');
?>