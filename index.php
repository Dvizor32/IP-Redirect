<?php

//Copyright Dornubari Vizor 2012
//use as you wish
include_once('ip2locationlite.class.php');
 
//Set geolocation cookie
if(!$_COOKIE["geolocation"]){
  $ipLite = new ip2location_lite;
  $ipLite->setKey('9150f850f184bd83c63a25782284482761bcf52c22ca2f5100f258f50d2c1b0d');
 
  $visitorGeolocation = $ipLite->getCountry($_SERVER['REMOTE_ADDR']);
  if ($visitorGeolocation['statusCode'] == 'OK') {
    $data = base64_encode(serialize($visitorGeolocation));
    setcookie("geolocation", $data, time()+3600*24*7); //set cookie for 1 week
  }
}else{
  $visitorGeolocation = unserialize(base64_decode($_COOKIE["geolocation"]));
}
//server query if needed for secure order form
$server_query = '';
if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING'])) {
	$server_query = '?' . $_SERVER['QUERY_STRING'];
}
switch($visitorGeolocation["countryCode"]) {
	case 'US':
  //United state visitors go here
		header('Location: www.USA.com' . $server_query); //can remove server_query if not needed
	exit;
	default:
  //International visitors go here.
		header('Location: www.Internaional.com' . $server_query);  //can remove server_query if not needed
	exit;
}
?>

