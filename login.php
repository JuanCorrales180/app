<?php

session_start();

unset($_SESSION['access_token']);
require "test/twitteroauth/autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;

define('CONSUMER_KEY', 'RM6MOs3QxQaBHDELzcVh5MKF1'); // add your app consumer key between single quotes
define('CONSUMER_SECRET', 'sqkcJQsGJ7k8wV43DDMcKWM9RANZLyW6EKqt3typ3THNyj0n3X'); // add your app consumer secret key between single quotes

define('OAUTH_CALLBACK', 'http://twitter01.ipdialbox.com');
$access_token = '1060667249688801280-yG9RysDNrFT3spCezLC0qRonXCRMIp';
$access_token_secret ='t3sOG6l2UgLTQW38cDWqYSI5XKIFwFsqWt2VEcspldJPp';

if (!isset($_SESSION['access_token'])) {
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET,$access_token,$access_token_secret);
	$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));

// QUITAR PARA PONER MAS ADELANTE 
	//account/verify_credentials



	$_SESSION['oauth_token'] = $request_token['oauth_token'];
	$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
	$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token'], 'force_login'=>'true'));
  // header("Location: $url");
	echo "<a href='$url'><button>Login with twitter </button></a>";
	//echo $url."<br>";
	//echo $_SESSION['oauth_token']."<br>";
			//$access_token = $_SESSION['access_token'];
	//echo $access_token;
	
} else {
// 	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);
// 	$request_token = $connection->oauth('oauth/request_token', array('oauth_callback' => OAUTH_CALLBACK));
// 	$_SESSION['oauth_token'] = $request_token['oauth_token'];
// 	$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
// 	$url = $connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
//   header("Location: $url");

// 	Aqui
	
	$access_token = $_SESSION['access_token'];
	
	
	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);
// 	$user = $connection->get("account/verify_credentials");
// 	echo "Bienvenido ".$user->name." a Twitter";

//   $statuses = $connection->get("statuses/mentions_timeline", ["count" => 10, "exclude_replies" => false]);
// 	$mysqli = new mysqli('107.190.130.225', 'ipdialbox_moni', '75ipdialbox_moni15%', 'ipdialbo_ipdialbox');
	$mysqli = new mysqli($db_server, $db_user, $db_pass, $db_database);
	
// 	$query = "select user from omnibox_conf_channel where user = "."'".$access_token["screen_name"]."'";
	$query = "select path2 from omnibox_conf_channel where path2 = "."'@".$access_token["screen_name"]."'";

	$resultado = $mysqli->query($query);
	
	if($resultado->num_rows < 1){
// 		$query_distri = "select id_distri from omnibox_conf_channel where user = '{$_SESSION["usuario"]}'";
// 		$res_distri = $mysqli->query($query_distri);
// 		$distri = "";
// 		while($row = $res_distri->fetch_assoc()){
// 			$distri = $row["id_distri"];
// 		}
		$distri = $_SESSION["usuario"];
	
		$insert_user = "insert into omnibox_conf_channel (id_distri, channel, user, path2, path3, path4, technology, Port) values
		              ("."$distri,'Twitter',"."'".$access_token["user_id"]."',"."'@".$access_token["screen_name"]."',"."'".$access_token["oauth_token"]."',"."'".$access_token["oauth_token_secret"]."','page','Active')";
		
		$mysqli->query($insert_user);
		
 		
// 		unset($_SESSION['access_token'], $access_token["user_id"],$access_token["screen_name"],$access_token["oauth_token"],$access_token["oauth_token_secret"]);

		
// 			mysqli_close($mysqli);
	}
}

?>


