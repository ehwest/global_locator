<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>ChurchZip</title>
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css?h=fe7fdfec700d100dc745dc64d3600cb2">
  <link rel="stylesheet" href="assets/css/styles.css?h=254b61860c920870de767873a6361e6a">
</head>

<body>
  <header id="header">
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-4"><a href="index.html"><img src="brand-logo.png" style="width: 100%;" /></a></div>
        <div class="col-12 col-md-8 d-flex justify-content-center align-items-center">
          <h3 class="text-center">Recent</h3>
        </div>
      </div>
    </div>
    <section class="d-flex justify-content-center align-items-center" style="padding: 1rem 0;"><a href="about.html" style="font-size: 12px;margin: auto 0.25rem;">About Us</a><a href="recent.html" style="font-size: 12px;margin: auto 0.25rem;">Recent Changes</a><a href="newplace.html" style="font-size: 12px;margin: auto 0.25rem;">Add New Record</a><a href="otherdirectories.html" style="font-size: 12px;margin: auto 0.25rem;">Other Directories</a><a href="login.html" style="font-size: 12px;margin: auto 0.25rem;">Admin</a></section>
  </header>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/1map.js?h=8a7d68a5606f8915b110f5457f761748"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzO0Ahomj_b0Keb9iLfCBmgoZfPtawreI&amp;libraries=places&amp;callback=initMap"></script>
  <script src="assets/js/script.js?h=dcb758167cb6834896871e8b865a0d7f"></script>


  <div style="margin-left: 40px; margin-right: 40px;">

    <?
    include("config.php");

    $q = "SELECT * FROM registry WHERE ! ISNULL(modified) ORDER BY modified DESC LIMIT 10";
    $stmt = mysqli_prepare($dbLink, $q);
    //mysqli_stmt_bind_param($stmt, "");
    mysqli_stmt_execute($stmt);
    $dbResult = mysqli_stmt_get_result($stmt);
    //print "q=$q\n";
    unset($row);
    //$row = mysqli_fetch_object($dbResult);
    //$row  = $dbResult->fetch_assoc();
    //print_r($row);
    //while ($row  = $dbResult->fetch_assoc()) {
    ?>
    <table>
      <?
      while ($row    = $dbResult->fetch_object()) {
        //print_r($row);
        //print "\n";

        if ($bg != "#FFFFC0") {
          $bg = "#FFFFC0";
        } else {
          $bg = "#FFFFFF";
        }

        print "<tr><td colspan='4'>&nbsp;</td></tr>";
        //this is the 3-column table showing one record
        print "<tr valign='top' bgcolor='" . $bg . "'>";

        //START of TITLE ROW 

        //COLUMN 1-2 for RECORD TITLE
        print "<td colspan='2'  > ";
        print "<div align='left'> ";

        if ($row->url == "") {
          print stripslashes($row->fname);
          print "<br>&nbsp;&nbsp;&nbsp;(no reported Internet URL)";
        } else { //there is a url
          if (substr($row->url, 0, 4) == "http") {
            print "<a href='" . stripslashes($row->url) . "' target='_new' class='url' >" . stripslashes($row->fname) . "</a>";;
          } else {
            print "<a href='" . "http://" . $row->url . "' target='_new' class='url' >" . stripslashes($row->fname) . "</a>";;
          }
        }
        print "</div>";
        print "</td>";

        //COLUMN 3
        print "<td  > ";
        print "<div align='center'> ";
        $d = number_format($row->distance, 0);
        if ($d > 1) {
          print $d . " miles";
        } else {
          print "";
        }
        print "</div>";
        print "</td>";

        //COLUMN 4
        print "<td  align=right> ";
        $d1 = "<a href='http://churchzip.com/editor/ezeditor.htm?fid=" . $row->fid . "' target='_new' class='url'><font size='-2'>Edit</font></a> ";
        print $d1;
        print "</td>";

        print "</tr>";
        //END of RECORD TITLE

        //START of RECORD DETAILS

        print "<tr bgcolor='" . $bg . "'> ";
        //COLUMN 1
        print "<td width=60px valign=top align=center><br>";
        //Link to a map display
        //print "<a href=centeredmap.htm?lat=" . $row->flattitude . "&lng=" . $row->flongitude . "&fid=" . $row->fid . " target=_new class=link >MAP</a>"; //map URL
        print "<br><br><a href=simple.htm?lat=" . $row->flattitude . "&lng=" . $row->flongitude . "  target=_new class=link >Area Map</a>"; //map URL
        $address = $row->fname . ", ";
        $address .= $row->addressline1 . ", ";
        $address .= $row->addressline2 . ", ";
        $address .= $row->addresscity . ", ";
        $address .= $row->addressstate . ", ";
        $address .= $row->addresspostalcode . ", ";
        $address .= $row->countryname . " ";

        print "<br>";
        $smlink = "";
        if ($row->facebook == "") {
          $smlink = "";
        } else {
          $smlink = "<a href='" . $row->facebook  .  "' target=_new >Facebook</a>&nbsp;";
        }
        print $smlink;

        $smlink = "";
        if ($row->twitter == "") {
          $smlink = "";
        } else {
          $smlink = "<br><a href='" . $row->twitter .  "' target=_new >Twitter</a>&nbsp;";
        }
        print $smlink;

        $smlink = "";
        if ($row->linkedin == "") {
          $smlink = "";
        } else {
          $smlink = "<br><a href='" . $row->linkedin .  "' target=_new >LinkedIn</a>&nbsp;";
        }
        print $smlink;

        $smlink = "";
        if ($row->youtube == "") {
          $smlink = "";
        } else {
          $smlink = "<br><a href='" . $row->youtube .  "' target=_new >YouTube</a>&nbsp;";
        }
        print $smlink;

        $smlink = "";
        if ($row->instagram == "") {
          $smlink = "";
        } else {
          $smlink = "<br><a href='" . $row->instagram .  "' target=_new >Instagram</a>&nbsp;";
        }
        print $smlink;

        $smlink = "";
        if ($row->livestream == "") {
          $smlink = "";
        } else {
          $smlink = "<br><a href='" . $row->livestream .  "' target=_new >LiveStream</a>&nbsp;";
        }
        print $smlink;

        print "</td>";
        print "</td>";

        //COLUMN 2
        print "<td width=50% > ";
        //START OF ADDRESS BLOCK
        print "<table class='standardcz' width='100%' >";
        print "<tr>";
        print "<td > ";
        print $row->addressline1;
        print "</td>";
        print "</tr>";

        print "<tr>";
        print  $row->addressline2;
        print "</td>";
        print "</tr>";

        print "<tr>";
        print "<td width='44%'  > ";
        print $row->addresscity;
        print "&nbsp;&nbsp;";
        print $row->addressstate;
        print "&nbsp;&nbsp;";
        print $row->addresspostalcode;
        print "</td></tr>";

        print "<tr><td>";
        print $row->countryname;
        print "</td></tr>";

        print "<tr><td >Contact: ";
        print $row->contact;
        print "</td></tr>";

        print "<tr><td width='44%' >Phone: ";
        print $row->phone;
        print "</td></tr>";
        print "</table>";
        //END OF ADDRESS BLOCK

        print "</td>";
        print "</td>";

        //START of INFO BLOCK
        print "<td colspan='2' >";
        print "<table class='standardcz' width='100%' >";
        print "<tr>";
        print "<td >";
        print "<div align='left'>Elders? ";
        print $row->qa3;
        print " &nbsp;&nbsp;Minister? ";
        print $row->qa4;
        print "</div>";
        print "</td>";
        print "</tr>";

        if ($row->multi_campus != "" || $row->egalitarian != "") {
          print    "<tr>";
          print      "<td >";
          print        "<div align='left'>Egalitarian? ";
          print           stripslashes($row->egalitarian);
          print           "&nbsp;&nbsp;Multi-Campus? " . stripslashes($row->multi_campus);
          print          "</div>";
          print       "</td>";
          print     "</tr>";
        }

        if ($row->instrumental != ""  || $row->both_i_a != "") {
          print    "<tr>";
          print      "<td >";
          print        "<div align='left'>Instrumental/Band? ";
          print           stripslashes($row->instrumental);
          print          "</div>";
          print       "</td>";
          print     "</tr>";
          print    "<tr>";
          print      "<td >";
          print        "<div align='left'>Both Instrumental AND Acappella? ";
          print           stripslashes($row->both_i_a);
          print          "</div>";
          print       "</td>";
          print     "</tr>";
        }

        print "<tr> ";
        print "<td  > ";
        print "<div align='left'>Size: ";
        print $row->size;
        print "</div>";
        print "</td>";
        print "</tr>";

        print "<tr> ";
        print "<td  > ";
        print $row->hours;
        print "<div align='left'> ";
        print $row->qa2;
        print "</div>";
        print "</td>";
        print "</tr>";

        print "<tr> ";
        print "<td ><font size='1'>Updated: ";
        print date("n/j/Y H:i", $row->modified);
        print "</font><font size='-1'> </font> </td>";
        print "</tr>";
        print "</table>";
        print "</td>";
        //END of INFO BLOCK

        print "</td>";
        print "</tr>";
      } //while
      ?>
    </table>
  </div>

  </div>
  <footer id="footer">
    <section class="d-flex flex-column justify-content-center align-items-center flex-md-row" style="padding: 1rem 0;"><a href="about.html" style="font-size: 12px;margin: auto 0.5rem;">About Us</a><a href="recent.html" style="font-size: 12px;margin: auto 0.5rem;">Recent Changes</a><a href="newplace.html" style="font-size: 12px;margin: auto 0.5rem;">Add New Record</a><a href="otherdirectories.html" style="font-size: 12px;margin: auto 0.5rem;">Other Directories</a><a href="statisticalsummary.html" style="font-size: 12px;margin: auto 0.5rem;">Statistics</a><a href="login.html" style="font-size: 12px;margin: auto 0.5rem;">Admin</a></section>
    <section style="padding: 1rem 0;">
      <h6 style="text-align: center;"><span style="color: black;">Copyright @2023 All Rights Reserved</span></h6>
    </section>
  </footer>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/1map.js?h=8a7d68a5606f8915b110f5457f761748"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzO0Ahomj_b0Keb9iLfCBmgoZfPtawreI&amp;libraries=places&amp;callback=initMap"></script>
  <script src="assets/js/script.js?h=dcb758167cb6834896871e8b865a0d7f"></script>
</body>

</html>