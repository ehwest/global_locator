<? 
//config.php
//general header of all pages
//	error_reporting( E_PARSE);
	error_reporting( E_ALL );
//	error_reporting(E_ERROR | E_WARNING | E_PARSE);
	error_reporting(E_ERROR |  E_PARSE);
//	error_reporting(0);

//Only support https
//if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
//    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//    header('HTTP/1.1 301 Moved Permanently');
//    header('Location: ' . $redirect);
//    exit();
//}
$api_key = 'ABQIAAAA2PbZ2vlEyY9EtSbddABjuhR9oE53DZJKJmrmUwNm3zg_hUOh_RTivIabp07LAGvHU33fxX50K7tqJw';
$api_key = "AIzaSyD-oRSj6Z2EfjYuwaLJbmzOZbgCodxow0g";
$api_key = "AIzaSyCiIdWlMx2f6lHevZKlKcGOpM33uQHV36A";
$api_key = "AIzaSyDMkJzhYqS8mzIDIv4G8wRCEqhzVITuUgw";

//database setup
        $dbname = $_ENV["MYSQL_DBNAME"];
        $dbpassword = $_ENV["MYSQL_DBPASSWORD"];
        $dbhostname = $_ENV["MYSQL_DBHOST"];
        $dblogin = $_ENV["MYSQL_DBUSER"];
        $dbhostname = $_ENV["MYSQL_DBHOST"];

//print "dbhostname = $dbhostname";
//print "dblogin = $dblogin";
//print "dbpassword = $dbpassword";
        if( !($dbLink = mysqli_connect($dbhostname, $dblogin, $dbpassword))) {
                 print("Failed phase1 to connect to server!\n");
                 print("Request Aborted!\n");
                 exit();
        }

        if( ! mysqli_select_db($dbLink, $dbname) ) {
                 print("Failed phase2 to connect to database on server!<BR>\n");
                 print("Request Aborted!\n");
                 exit();
        }

       // Check link
          if (!$dbLink) {
            die("Connection failed: " . mysqli_connect_error());
          }else{
            //print "db connection good";
	}
	//print " DB SETUP ";

//Blacklist Ejector
        //$ip = trim($_SERVER['REMOTE_ADDR'] );
	//print (" IP address is:  $ip ");
        //$long = ip2long($ip);
        // if($long != -1 && $long!==FALSE) 
            //valid ip address
            //print "ip=$ip";
            //print_r($input);
	//
            //$q = "select * from blacklist where ip='?'" ;

	//	$stmt = mysqli_prepare($dbLink, $q);
	///	mysqli_stmt_bind_param($stmt, "s", $ip);
	//	mysqli_stmt_execute($stmt);
	//	$dbResult = mysqli_stmt_get_result($stmt);
         //       if(mysqli_num_rows($dbResult)>0 )  {//on the blacklist
          //        print "Bad boy ip=$ip !\n";
           //      // exit();
           //      } else {//not on blacklist
           //     print ( "Not on blacklist ");
           //     }
