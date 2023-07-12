<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
require_once("config.php");

$ip = trim($_SERVER['REMOTE_ADDR'] );
$data = json_decode($_REQUEST["data"]);
$address_compponents = $data->address_components;



$realname = $_REQUEST["realname"];
$youremail = $_REQUEST["youremail"];
$country = $_REQUEST["country"];
$lat = $_REQUEST["latitude"];
$lng = $_REQUEST["longitude"];
$multi_campus = $_REQUEST["multi_campus"];
$instrumental = $_REQUEST["instrumental"];
$both_i_a = $_REQUEST["both_i_a"];
$egalitarian = $_REQUEST["egalitarian"];



$s10 = $_REQUEST["name"];
$s11 = $_REQUEST["street1"];
$s12 = $_REQUEST["street2"];
$s13 = $_REQUEST["ccity"];
$s14 = $_REQUEST["state"];
$s15 = $_REQUEST["zipcode"];
$s20 = $_REQUEST["members"];
$s21 = $_REQUEST["elders"];
$s22 = $_REQUEST["ministerstatus"];
$s23 = $_REQUEST["character"];
$s30 = $_REQUEST["c1name"];
$s31 = $_REQUEST["phone"];
$s32 = $_REQUEST["email"];
$s33 = $_REQUEST["homepage"];
$s34 = $_REQUEST["hours"];
$s35 = $_REQUEST["class"];

$address_components = $_REQUEST["adress_components"];
if (isset($address_components)) {
//print_r($address_components);
foreach ($address_components as $component) {
if (in_array("administrative_area_level_2", $component->types)) {
$adminArea = $component->long_name || $component->short_name || "";
if ($adminArea) {
$county .= ", " . $adminArea;
}
}
}
}


//ok this works
$qtry = "INSERT INTO pending_registry (
fname, 
addressline1,
addressline2,
addresscity,
addressstate, 
addresscounty,
addresscountrycode,
countryname,
size,
url,
email,
phone,
contact,
qa1,
qa2,
qa3,
qa4,
providername,
provideremail,
instrumental,
both_i_a,
egalitarian,
multi_campus,
flattitude,
flongitude,
class,
modified,
ipaddress,
formatted_address
) 
VALUES (
?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
)";

$stmt = $dbLink->prepare($qtry);
$stmt->bind_param(

"sssssssssssssssssssssssddsiss",

$fname, 
$addressline1,
$addressline2,
$addresscity,
$addressstate,
$addresscounty,
$addresscountrycode,
$countryname,
$size,
$url,
$email,
$phone,
$contact,
$qa1,
$qa2,
$qa3,
$qa4,
$providername,
$provideremail,
$instrumental,
$both_i_a,
$egalitarian,
$multi_campus,
$flattitude,
$flongitude,
$class,
$modified,
$ipaddress,
$formatted_address
);

$fname         = $s10;
$addressline1  = $s11;
$addressline2  = $s12;
$addresscity   = $s13;
$addressstate  = $s14;
$addresscounty     = $county;
$addresscountrycode = $s17;
$countryname	    = $s16;
$size		    = $s20;
$url		    = $s33;
$email		    = $s32;
$phone		    = $s31;
$contact	    = $s30;
$qa1		    = $s42;
$qa2		    = $s34;
$qa3		    = $s21;
$qa4		    = $s22;
$providername	    = $_REQUEST["realname"];
$provideremail	    = $_REQUEST["youremail"];
$instrumental       = $_REQUEST["instrumental"];
$both_i_a	    = $_REQUEST["both_i_a"];
$egalitarian	    = $_REQUEST["egalitarian"];
$multi_campus	    = $_REQUEST["multi_campus"];
$flattitude	    = $_REQUEST["flattitude"];
$flongitude	    = $_REQUEST["flongitude"];
$class		    = $s35;
$modified	    = $nowtime;
$ipaddress	    = $ip;
$formatted_addresss = $_REQUEST['formatted_address'];

$stmt->execute();
$result = $stmt->get_result();

//print_r( $result );;
//print_r( $stmt);;
$numrows = $stmt->affected_rows;
//print "numrows=$numrows ";
print $numrows;

//if($numrows>0){
//  header("Location: thanks.html?message=");
//}else{
//  header("Location: thanks.html?message=");
//}
exit();



function validated_searchname($input)
{
$filteredInput = preg_replace('/[^a-zA-Z0-9\s]/', '', $input);
if ($filteredInput == $input) {
return $input;
} else {
print "Unsafe SQL insertion detected. ";
exit();
}
}
