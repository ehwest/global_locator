<?php
$realname = $_REQUEST["realname"];
$youremail = $_REQUEST["youremail"];
$country = $_REQUEST["country"];
$county = $_REQUEST["county"];
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

echo "realname: " . $realname . "<br>";
echo "youremail: " . $youremail . "<br>";
echo "latitude: " . $lat . "<br>";
echo "longitude: " . $lng . "<br>";
echo "name: " . $s10 . "<br>";
echo "street1: " . $s11 . "<br>";
echo "street2: " . $s12 . "<br>";
echo "ccity: " .  $s13 . "<br>";
echo "state: " . $s14 . "<br>";
echo "zipcode: " . $s15 . "<br>";
echo "country: " . $country . "<br>";
echo "phone: " . $s31 . "<br>";
echo "email: " . $s32 . "<br>";
echo "homepage: " . $s33 . "<br>";
echo "c1name: " . $s30 . "<br>";
echo "members: " . $s20 . "<br>";
echo "elders: " . $s21 . "<br>";
echo "ministerstatus: " . $s22 . "<br>";
echo "multi_campus: " . $multi_campus . "<br>";
echo "instrumental: " . $instrumental . "<br>";
echo "both_i_a: " . $both_i_a . "<br>";
echo "egalitarian: " . $egalitarian . "<br>";
echo "hours: " . $s34 . "<br>";
echo "character: " . $s23 . "<br>";
echo "class: " . $s35 . "<br>";

$q = "INSERT INTO pending_registry SET ";
$q .= " fname='" . $s10 . "', ";
$q .= " addressline1='" . $s11 . "', ";
$q .= " addressline2='" . $s12 . "', ";
$q .= " addresscity='" . $s13 . "', ";
$q .= " addressstate='" . $s14 . "', ";
$q .= " addresspostalcode='" . $s15 . "', ";
$q .= " addresscounty='" . addslashes(trim($county)) . "', ";
$q .= " addresscountrycode='" . $s17 . "', ";
$q .= " size='" . $s20 . "', ";
$q .= " url='" . $s33 . "', ";
$q .= " email='" . $s32 . "', ";
$q .= " phone='" . $s31 . "', ";
$q .= " contact='" . $s30 . "', ";
$q .= " qa1='" . $s42 . "', ";
$q .= " qa2='" . $s34 . "', ";
$q .= " qa3='" . $s21 . "', ";
$q .= " qa4='" . $s22 . "', ";
$q .= " providername='" . $realname . "', ";
$q .= " provideremail='" . $youremail . "', ";
$q .= " instrumental='" . $instrumental . "', ";
$q .= " both_i_a='" . $both_i_a . "', ";
$q .= " multi_campus='" . $multi_campus . "', ";
$q .= " egalitarian='" . $egalitarian . "', ";
$q .= " flattitude='" . $lat . "', ";
//$q .= " lat='" . $lat . "', ";
$q .= " flongitude='" . $lng . "', ";
//$q .= " lng='" . $lng . "', ";
$nowtime = time();
$q .= " geocoded='" . $nowtime . "', ";
$q .= " class='" . $s35 . "', ";
$q .= " modified='" . $s43 . "', ";
$q .= " ipaddress='" . $ip . "', ";
$q .= " uid='" . $s44 . "'; ";

function validated_searchname($input)
{
  //$filteredInput = preg_replace('/[^a-zA-Z0-9]/', '', $input);
  $filteredInput   = preg_replace('/[^a-zA-Z0-9\s]/', '', $input); //allows white space in the input
  if ($filteredInput == $input) {
    //print " Valid searchname input";
    return ($input);
  } else {
    print "Unsafe SQL insertion detected.  ";
    //print " Bad (decoded) value is:  ". $input;
    //print " Debug raw parameter= " . $input;
    //print " Debug=Forgot to base64_encode?  Try this value: " . base64_encode( base64_decode($input));
    //print  " Invalidated association input";
    //print  make_json("Invalidated association input");
    exit();
  }
}
