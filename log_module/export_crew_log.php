<?php ini_set('display_errors', 'off');
include '../config.php';
$taskboard = $_SESSION['taskboard'];
$user = $_SESSION['usr'];
$station = $_SESSION['station'];
$dateto = $_SESSION['date_to'];
$datefrom = $_SESSION['date_from'];
$button = $_SESSION['button_event'];
$timezone = $_SESSION['timezone'];
$print_data='';

$q = "SELECT cam_u.user_name as User,cam_l.line_name as Station,cam_p.position_name as Position,cam_ass.assign_time,cam_ass.unassign_time,cam_ass.total_time as time FROM cam_assign_crew_log as cam_ass INNER JOIN cam_users as cam_u on cam_ass.user_id = cam_u.users_id INNER JOIN cam_line as cam_l on cam_ass.station_id = cam_l.line_id INNER JOIN cam_position as cam_p on cam_ass.position_id = cam_p.position_id";

/* If User is selected. */
if ($user != null) {
    $qurtemp = mysqli_query($db, "SELECT users_id,user_name FROM  cam_users where users_id = '$user' ");
    while ($rowctemp = mysqli_fetch_array($qurtemp)) {
        $user_name = $rowctemp["user_name"];
        $print_data .= "User : " . $user_name . "\n";
    }
    $q = $q . " and user_id = '$user' ";

}

/* If Line is selected. */
if ($station != null) {
    $qurtemp = mysqli_query($db, "SELECT line_name FROM  cam_line where line_id = '$station' ");
    while ($rowctemp = mysqli_fetch_array($qurtemp)) {
        $line_name = $rowctemp["line_name"];
        $print_data .= "Station : " . $line_name . "\n";
    }
    $q = $q . " and station_id = '$station' ";

}

if($datefrom != "" && $dateto != ""){
    $date_from = convertMDYToYMDwithTime($datefrom);
    $date_to = convertMDYToYMDwithTime($dateto);
    $q = $q . " AND DATE_FORMAT(assign_time,'%Y-%m-%d %H:%i') >= '$date_from' and DATE_FORMAT(assign_time,'%Y-%m-%d %H:%i') <= '$date_to' ";
}else if($datefrom != "" && $dateto == ""){
    $date_from = convertMDYToYMDwithTime($datefrom);
    $q = $q . " AND DATE_FORMAT(assign_time,'%Y-%m-%d %H:%i') >= '$date_from' ";
}else if($datefrom == "" && $dateto != ""){
    $date_to = convertMDYToYMDwithTime($dateto);
    $q = $q . " AND DATE_FORMAT(assign_time,'%Y-%m-%d %H:%i') <= '$date_to' ";
}

$q = $q . " ORDER BY assign_time  DESC";

$exportData = mysqli_query($db, $q);
$header = "User" . "\t" . "Station" . "\t" . "Position" . "\t" . "Assign Time" .  "\t" .  "Un-Assign Time" . "\t" .  "Total Time" . "\t";
$result = '';
//$fields = mysqli_num_fields($db, $exportData);
//for ($i = 0; $i < $fields; $i++) {
//    $header .= mysqli_field_name($db, $exportData, $i) . "\t";
//}
//$k =1;
while ($row = mysqli_fetch_row($exportData)) {
//    $date_n = $row[6];
//    $date_ne = explode(' ',$date_n);
//    $date_next = $date_ne[0];
    $line = '';
    $j = 1;

//    if (($datefrom == $date_next) && ($k == 1)) {
//        $date_data = "\nDate : " . $date_next . "\n";
//        $line .= "$date_data\n$header\n";
//        $k =0;
//    }else if ($datefrom < $date_next) {
//        $line .= ".\n";
//        $date_data = "Date : " . $date_next . "\n";
//        $line .= "$date_data\n$header\n";
//        $datefrom = $date_next;
//    }
//    $skipped = array('0', '2', '6' , '7');
//    foreach ($row as $key => $value) {
//        if(in_array($key, $skipped)) {
//            continue;
//        }

       foreach ($row as $value) {
        if ((!isset($value)) || ($value == "")) {
            $value = "\t";
        } else {
            $value = str_replace('"', '""', $value);
            if ($j == 4) {
				$un = $value;
				$date = $un;
			    $value = $date;
			}
            if ($j == 5) {
				$un = $value;
                $d1 = $un;
                $diff = abs(strtotime($date_to) - strtotime($date));
                $t = round(($diff/3600),2);
                if ($un == $date) {
                    $unasign = "Still Assigned";
                } else {
                    $unasign = $un;
                }
                 if($un > $date_to){
                     $value =  $date_to;
                 }else{
                     $value = $unasign;
                 }
			}
            if ($j == 6) {
                $un = $value;
                $zero_time = '00:00:00';
                $database_time = $un;
                $diffrence = abs(strtotime($d1) - strtotime($date));
                $t_time = round(($diffrence/3600),2);
                if ($zero_time == $database_time) {
                    $database_time = "Still Assigned";
                }else{
                    $database_time = $t_time;
                }
                if($d1 > $date_to){
                    $value =  $t;
                }else{
                    $value = $database_time;
                }
            }
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
        $j++;

    }
    $result .= trim($line) . "\n";

}
//$k++;

$result = str_replace("\r", "", $result);

if ($result == "") {
    $result = "\nNo Record(s) Found!\n";
}
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Crew assign  Log.xls");
header("Pragma: no-cache");
header("Expires: 0");
print "\n\n$print_data\n\n";
print "$header\n$result";
?>
