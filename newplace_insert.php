<?php
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

if (isset($address_components)) {
  foreach ($address_components as $component) {
    if (in_array("administrative_area_level_2", $component->types)) {
      $adminArea = $component->long_name || $component->short_name || "";
      if ($adminArea) {
        $county .= ", " . $adminArea;
      }
    }
  }
}

echo "data: " . $data . "<br>";
echo "realname: " . $realname . "<br>";
echo "youremail: " . $youremail . "<br>";
echo "latitude: " . $lat . "<br>";
echo "longitude: " . $lng . "<br>";
echo "name: " . $s10 . "<br>";
echo "street1: " . $s11 . "<br>";
echo "street2: " . $s12 . "<br>";
echo "ccity: " . $s13 . "<br>";
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
            uid
          ) 
          VALUES (?, ?)";

$stmt = $pdo->prepare($sql);

$stmt->bindParam(1, $s10);
$stmt->bindParam(2, $s11);
$stmt->bindParam(3, $s12);
$stmt->bindParam(4, $s13);
$stmt->bindParam(5, $s14);
$stmt->bindParam(6, $s15);
$stmt->bindParam(7, addslashes(trim($county)));
$stmt->bindParam(8, $s17);
$stmt->bindParam(9, $s20);
$stmt->bindParam(10, $s33);
$stmt->bindParam(11, $s32);
$stmt->bindParam(12, $s31);
$stmt->bindParam(13, $s30);
$stmt->bindParam(14, $s42);
$stmt->bindParam(15, $s34);
$stmt->bindParam(16, $s21);
$stmt->bindParam(17, $s22);
$stmt->bindParam(18, $realname);
$stmt->bindParam(19, $youremail);
$stmt->bindParam(20, $instrumental);
$stmt->bindParam(21, $both_i_a);
$stmt->bindParam(22, $multi_campus);
$stmt->bindParam(23, $egalitarian);
$stmt->bindParam(24, $lat);
$stmt->bindParam(25, $lng);
$stmt->bindParam(26, time());
$stmt->bindParam(27, $s35);
$stmt->bindParam(28, $s43);
$stmt->bindParam(29, $ip);
$stmt->bindParam(30, $s44);

$stmt->execute();

if ($stmt->rowCount() > 0) {
  echo "Record inserted successfully.";
} else {
  echo "Error inserting record.";
}

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
