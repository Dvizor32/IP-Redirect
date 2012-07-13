<?php
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
$server_query = '';
if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING'])) {
	$server_query = '?' . $_SERVER['QUERY_STRING'];
}
switch($visitorGeolocation["countryCode"]) {
	case 'US':
		header('Location: https://www.joepolish.com/freesuccesskit/step3-secureorder.php' . $server_query);
	exit;
	default:
		header('Location: https://www.joepolish.com/freesuccesskit/step3-secureorderinternational.php' . $server_query);
	exit;
}
?>

