<?php
require_once("config.php");

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

// formatted_address extraction
$formatted_address = $data->formatted_address;

if (isset($address_components)) {
  foreach ($address_components as $component) {
    if (in_array("administrative_area_level_2", $component->types)) {
      $adminArea = $component->long_name || $component->short_name || "";
      if ($adminArea) {
        $county .= ", " . $adminArea;
      }
    }

    // extract the country code
    if (in_array("country", $component->types)) {
      $countryCode = $component->short_name || "";
      if ($countryCode) {
        $s17 = $countryCode;
      }
    }
  }
}

// YOUR WORK (APPENDING TO QUERY)
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

$q .= " providername='" . $_REQUEST["realname"] . "', ";
$q .= " provideremail='" . $_REQUEST["youremail"] . "', ";

$q .= " instrumental='" . $instrumental . "', ";
$q .= " both_i_a='" . $both_i_a . "', ";
$q .= " multi_campus='" . $multi_campus . "', ";
$q .= " egalitarian='" . $egalitarian . "', ";

$q .= " flattitude='" . $lat . "', ";
$q .= " flongitude='" . $lng . "', ";
$nowtime = time();
$q .= " geocoded='" . $nowtime . "', ";
//$q .= " class='" . $s35 . "', ";
$q .= " class='" .    $nowtime . "', ";
$q .= " modified='" . $nowtime . "', ";
$q .= " ipaddress='" . $ip . "', ";
$q .= " uid='" . 1 . "'; ";


//        all this is in config.php on line 2
//        if( !($dbLink = mysqli_connect($dbhostname, $dblogin, $dbpassword))) {
//                 print("Failed phase1 to connect to server 1!\n");
//                 print("Request Aborted!\n");
//                 exit();
//        }

//        if( ! mysqli_select_db($dbLink, $dbname) ) {
//                 print("Failed phase2 to connect to database on server2!<BR>\n");
//                 print("Request Aborted!\n");
//                 exit();
//        }

// if ($result = mysqli_query($dbLink, $q)) {
//   $numRows = mysqli_affected_rows($dbLink);
//   // Return the number of rows in result set
//   //printf("Result set has %d rows.\n",$numRows);
//   //print "INSERTED RECORD SUCCESSFULLY";
// } else {
//   print "failed to insert for some reason";
// }
// print "$numRows WAS successfully inserted, thanks!";
// // Redirect the user to another page
// header("Location: thanks.html");
// exit();

// MY WORK (PREPARED SQL STATEMENT USING mysqli_prepare AND mysqli_stmt_bind_param FUNCTIONS)
$sql = "INSERT INTO pending_registry
          (
            fname, 
            addressline1,
            addressline2,
            addresscity,
            addressstate,
            addresspostalcode,
            addresscounty,
            addresscountrycode,
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
            multi_campus,
            egalitarian,
            flattitude,
            flongitude,
            geocoded,
            class,
            modified,
            ipaddress,
            uid,
            formatted_address
          ) 
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($dbLink, $sql);

mysqli_stmt_bind_param(
  $stmt,
  "sssssssssssssssssssddssisis",
  $s10,
  $s11,
  $s12,
  $s13,
  $s14,
  $s15,
  addslashes(trim($county)),
  $s17,
  $s20,
  $s33,
  $s32,
  $s31,
  $s30,
  $s42,
  $s34,
  $s21,
  $s22,
  $realname,
  $youremail,
  $instrumental,
  $both_i_a,
  $multi_campus,
  $egalitarian,
  $lat,
  $lng,
  time(),
  $s35,
  $s43,
  $ip,
  $s44,
  $formatted_address,
);

mysqli_stmt_execute($stmt);
$dbResult = mysqli_stmt_get_result($stmt);
echo "dbResult: " . $dbResult . "<br>";

// header("Location: thanks.html");
echo '<script>window.open("thanks.html", "_blank");</script>';
exit();

function validated_searchname($input)
{
  $filteredInput = preg_replace('/[^a-zA-Z0-9\s]/', '', $input);
  if ($filteredInput == $input) {
    return $input;
  } else {
    print "Unsafe SQL insertion detected.  ";
    exit();
  }
}
