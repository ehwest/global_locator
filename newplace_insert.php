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
          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($dbLink, $sql);
// $stmt = $pdo->prepare($sql);

mysqli_stmt_bind_param(
  $stmt,
  "ssssssssssssssssssssssssss",
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
  $s44
);

mysqli_stmt_execute($stmt);
// $stmt->execute();

$dbResult = mysqli_stmt_get_result($stmt);

echo "dbResult: " . $dbResult . "<br>";

// if ($stmt->rowCount() > 0) {
//   echo "Record inserted successfully.";
// } else {
//   echo "Error inserting record.";
// }

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
?>

<!DOCTYPE html>
<html data-bs-theme="light" lang="en" style>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no" />
  <title>New CZ Layout</title>
</head>

<body>
  <header id="header">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-4"><a href="index.html"><img src="brand-logo.png" style="width: 100%;" /></a></div>
        <div class="col-12 col-md-8 d-flex justify-content-center align-items-center">
          <h3 class="text-center">New Place Inserted</h3>
        </div>
      </div>
    </div>
    <section class="d-flex justify-content-center align-items-center" style="padding: 1rem 0;"><a href="about.html" style="font-size: 12px;margin: auto 0.25rem;">About Us</a><a href="recent.html" style="font-size: 12px;margin: auto 0.25rem;">Recent Changes</a><a href="newplace.html" style="font-size: 12px;margin: auto 0.25rem;">Add New Record</a><a href="otherdirectories.html" style="font-size: 12px;margin: auto 0.25rem;">Other Directories</a><a href="login.html" style="font-size: 12px;margin: auto 0.25rem;">Admin</a></section>
  </header>
  <section class="py-4 py-xl-5">
    <div class="container">
      <div class="text-center p-4 p-lg-5">
        <h1 class="fw-bold mb-4">Thank You!</h1>
      </div>
    </div>
  </section>
  <footer id="footer">
    <section class="d-flex flex-column justify-content-center align-items-center flex-md-row" style="padding: 1rem 0;"><a href="about.html" style="font-size: 12px;margin: auto 0.5rem;">About Us</a><a href="recent.html" style="font-size: 12px;margin: auto 0.5rem;">Recent Changes</a><a href="newplace.html" style="font-size: 12px;margin: auto 0.5rem;">Add New Record</a><a href="otherdirectories.html" style="font-size: 12px;margin: auto 0.5rem;">Other Directories</a><a href="statisticalsummary.html" style="font-size: 12px;margin: auto 0.5rem;">Statistics</a><a href="login.html" style="font-size: 12px;margin: auto 0.5rem;">Admin</a></section>
    <section style="padding: 1rem 0;">
      <h6 style="text-align: center;"><span style="color: black;">Copyright @2023 All Rights Reserved</span></h6>
    </section>
  </footer>
</body>

</html>