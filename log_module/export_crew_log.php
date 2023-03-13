<?php ini_set('display_errors', 'off');
include '../config.php';
$curdate = date('Y-m-d H:i');
$cd = date('d-M-Y H:i:s');
$taskboard = $_SESSION['taskboard'];
$user = $_SESSION['usr'];
$station = $_SESSION['station'];
$cell = $_SESSION['cell'];
$dateto = $_SESSION['date_to'];
$datefrom = $_SESSION['date_from'];
$query0003 = sprintf("SELECT SUBSTRING(stations,1,length(stations)-1) as stns FROM cell_grp where c_id = '$cell'");
$qur0003 = mysqli_query($db, $query0003);
while ($rowc0003 = mysqli_fetch_array($qur0003)) {
    $stt = $rowc0003["stns"];
}
$button = $_SESSION['button_event'];
$timezone = $_SESSION['timezone'];
$print_data='';
if(!empty($cell)){
    if ($user != "" && $stt == "" && $datefrom != "" && $dateto != "") {
        $date_from = convertMDYToYMDwithTime($datefrom);
        $date_to = convertMDYToYMDwithTime($dateto);
        $ss1 = "SELECT `user_id`,`station_id`,`position_id`,`assign_time`,`unassign_time`,`total_time`  as time FROM `cam_assign_crew_log` WHERE DATE_FORMAT(`unassign_time`,'%Y-%m-%d %H:%i') >= '$date_from' and DATE_FORMAT(`assign_time`,'%Y-%m-%d %H:%i') <= '$date_from' and `user_id` = '$user' order by assign_time asc";
        $qur = "SELECT `user_id`,`station_id`,`position_id`,`assign_time`,`unassign_time`,`total_time`  as time FROM `cam_assign_crew_log` WHERE DATE_FORMAT(`assign_time`,'%Y-%m-%d %H:%i') >= '$date_from' and DATE_FORMAT(`assign_time`,'%Y-%m-%d %H:%i') <= '$date_to' and `user_id` = '$user' order by assign_time asc";
    } else if ($user != "" && $stt == "" && $datefrom == "" && $dateto == "") {
        $qur = "SELECT `user_id`,`station_id`,`position_id`,`assign_time`,`unassign_time`,`total_time`  as time FROM `cam_assign_crew_log` WHERE `user_id` = '$user'";
    } else if ($user == "" && $stt != "" && $datefrom != "" && $dateto != "") {
        $date_from = convertMDYToYMDwithTime($datefrom);
        $date_to = convertMDYToYMDwithTime($dateto);
        $ss1 = "SELECT `user_id`,`station_id`,`position_id`,`assign_time`,`unassign_time`,`total_time`  as time FROM `cam_assign_crew_log`  WHERE DATE_FORMAT(`unassign_time`,'%Y-%m-%d %H:%i') >= '$date_from' and DATE_FORMAT(`assign_time`,'%Y-%m-%d %H:%i') <= '$date_from' and `station_id` in ($stt) order by assign_time asc";
        $qur = "SELECT `user_id`,`station_id`,`position_id`,`assign_time`,`unassign_time`,`total_time`  as time FROM `cam_assign_crew_log` WHERE DATE_FORMAT(`assign_time`,'%Y-%m-%d %H:%i') >= '$date_from' and DATE_FORMAT(`assign_time`,'%Y-%m-%d %H:%i') <= '$date_to' and `station_id` in ($stt) order by assign_time asc";
    } else if ($user == "" && $stt != "" && $datefrom == "" && $dateto == "") {
        $qur ="SELECT `user_id`,`station_id`,`position_id`,`assign_time`,`unassign_time`,`total_time`  as time FROM `cam_assign_crew_log` WHERE `station_id` in ($stt)";
    } else if ($user == "" && $stt == "" && $datefrom != "" && $dateto != "") {
        $date_from = convertMDYToYMDwithTime($datefrom);
        $date_to = convertMDYToYMDwithTime($dateto);
        $ss1 = "SELECT `user_id`,`station_id`,`position_id`,`assign_time`,`unassign_time`,`total_time`  as time FROM `cam_assign_crew_log` WHERE DATE_FORMAT(`unassign_time`,'%Y-%m-%d %H:%i') >= '$date_from' and DATE_FORMAT(`assign_time`,'%Y-%m-%d %H:%i') <= '$date_from' order by assign_time asc";
        $qur = "SELECT `user_id`,`station_id`,`position_id`,`assign_time`,`unassign_time`,`total_time`  as time FROM `cam_assign_crew_log` WHERE DATE_FORMAT(`assign_time`,'%Y-%m-%d %H:%i') >= '$date_from' and DATE_FORMAT(`assign_time`,'%Y-%m-%d %H:%i') <= '$date_to' order by assign_time asc";
    }
}else{
    if ($user != "" && $station == "" && $datefrom != "" && $dateto != "") {
        $date_from = convertMDYToYMDwithTime($datefrom);
        $date_to = convertMDYToYMDwithTime($dateto);
        $ss1 = "SELECT `user_id`,`station_id`,`position_id`,`assign_time`,`unassign_time`,`total_time`  as time FROM `cam_assign_crew_log` WHERE DATE_FORMAT(`unassign_time`,'%Y-%m-%d %H:%i') >= '$date_from' and DATE_FORMAT(`assign_time`,'%Y-%m-%d %H:%i') <= '$date_from' and `user_id` = '$user' order by assign_time asc";
        $qur = "SELECT `user_id`,`station_id`,`position_id`,`assign_time`,`unassign_time`,`total_time`  as time FROM `cam_assign_crew_log` WHERE DATE_FORMAT(`assign_time`,'%Y-%m-%d %H:%i') >= '$date_from' and DATE_FORMAT(`assign_time`,'%Y-%m-%d %H:%i') <= '$date_to' and `user_id` = '$user' order by assign_time asc";
    } else if ($user != "" && $station == "" && $datefrom == "" && $dateto == "") {
        $qur = "SELECT `user_id`,`station_id`,`position_id`,`assign_time`,`unassign_time`,`total_time`  as time FROM `cam_assign_crew_log` WHERE `user_id` = '$user'";
    } else if ($user == "" && $station != "" && $datefrom != "" && $dateto != "") {
        $date_from = convertMDYToYMDwithTime($datefrom);
        $date_to = convertMDYToYMDwithTime($dateto);
        $ss1 = "SELECT `user_id`,`station_id`,`position_id`,`assign_time`,`unassign_time`,`total_time`  as time FROM `cam_assign_crew_log`  WHERE DATE_FORMAT(`unassign_time`,'%Y-%m-%d %H:%i') >= '$date_from' and DATE_FORMAT(`assign_time`,'%Y-%m-%d %H:%i') <= '$date_from' and `station_id` = '$station' order by assign_time asc";
        $qur = "SELECT `user_id`,`station_id`,`position_id`,`assign_time`,`unassign_time`,`total_time`  as time FROM `cam_assign_crew_log` WHERE DATE_FORMAT(`assign_time`,'%Y-%m-%d %H:%i') >= '$date_from' and DATE_FORMAT(`assign_time`,'%Y-%m-%d %H:%i') <= '$date_to' and `station_id` = '$station' order by assign_time asc";
    } else if ($user == "" && $station != "" && $datefrom == "" && $dateto == "") {
        $qur = "SELECT `user_id`,`station_id`,`position_id`,`assign_time`,`unassign_time`,`total_time`  as time FROM `cam_assign_crew_log` WHERE  `station_id` = '$station'";
    } else if ($user == "" && $station == "" && $datefrom != "" && $dateto != "") {
        $date_from = convertMDYToYMDwithTime($datefrom);
        $date_to = convertMDYToYMDwithTime($dateto);
        $ss1 = "SELECT `user_id`,`station_id`,`position_id`,`assign_time`,`unassign_time`,`total_time`  as time FROM `cam_assign_crew_log` WHERE DATE_FORMAT(`unassign_time`,'%Y-%m-%d %H:%i') >= '$date_from' and DATE_FORMAT(`assign_time`,'%Y-%m-%d %H:%i') <= '$date_from' order by assign_time asc";
        $qur = "SELECT `user_id`,`station_id`,`position_id`,`assign_time`,`unassign_time`,`total_time`  as time FROM `cam_assign_crew_log` WHERE DATE_FORMAT(`assign_time`,'%Y-%m-%d %H:%i') >= '$date_from' and DATE_FORMAT(`assign_time`,'%Y-%m-%d %H:%i') <= '$date_to' order by assign_time asc";
    }
}

$exportData = mysqli_query($db, $ss1);
$header = "User" . "\t" . "Station" . "\t" . "Position" . "\t" . "Assign Time" . "\t" . "Un-Assign Time" . "\t" . "Total Time" . "\t";
while ($row = mysqli_fetch_row($exportData)) {
    $line = '';
    $j = 1;
    foreach ($row as $value) {
        if ((!isset($value)) || ($value == "") && (($j != 6))) {
            if ($j == 6) {
                $un = $value;
                $zero_time = '00:00:00';
                $database_time = $un;
                if ($zero_time == $database_time) {
                    $database_time = "0";
                }else{
                    $database_time = $t_time;
                }
                $value = $database_time;
            }
        } else {
            $value = str_replace('"', '""', $value);
            if ($j == 1) {
                $un = $value;
                $qurtemp = mysqli_query($db, "SELECT users_id,user_name FROM  cam_users where users_id = '$un'");
                while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                    $user_name = $rowctemp["user_name"];
                }
                $value = $user_name;
            }
            if ($j == 2) {
                $un = $value;
                $qurtemp = mysqli_query($db, "SELECT line_name FROM  cam_line where line_id = '$un'");
                while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                    $line_name = $rowctemp["line_name"];
                }
                $value = $line_name;
            }
            if ($j == 3) {
                $un = $value;
                $qurtemp = mysqli_query($db, "SELECT position_name FROM  cam_position where position_id = '$un'");
                while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                    $position_name = $rowctemp["position_name"];
                }
                $value = $position_name;
            }
            if ($j == 4) {
                $un = $value;
                $asn_time = $un;
                $value = $date_from;
            }
            if ($j == 5) {
                $un = $value;
                $d1 = $un;
                $unas = $un;
                $as = $asn_time;
                if($unas > $date_to)
                {
                    $unasign = dateReadFormat($date_to);
                } else if($unas == $date_from)
                {
                    $unasign = "Still Assigned";
                } else
                {
                    $unasign = dateReadFormat($unas);
                }
                $diffrence = abs(strtotime($unasign) - strtotime($date_from));
                $t_time = round(($diffrence/3600),2);
                $diff = abs(strtotime($date_to) - strtotime($as));
                $t = round(($diff/3600),2);
                $value = $unasign;
            }
            if ($j == 6) {
                $un = $value;
                $zero_time = '00:00:00';
                $database_time = $un;
                if ($zero_time == $database_time) {
                    $database_time = "0";
                }else{
                    $database_time = $t_time;
                }
                    $value = $database_time;
            }
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
        $j++;

    }
    $res .= trim($line) . "\n";
}
$exp = mysqli_query($db, $qur);
$header = "User" . "\t" . "Station" . "\t" . "Position" . "\t" . "Assign Time" . "\t" . "Un-Assign Time" . "\t" . "Total Time" . "\t";
while ($row = mysqli_fetch_row($exp)) {
    $line = '';
    $j = 1;
    foreach ($row as $value) {
        if ((!isset($value)) || ($value == "") && (($j != 6))) {
            if ($j == 6) {
                $un = $value;
                $zero_time = '00:00:00';
                $database_time = $un;
                if ($zero_time == $database_time) {
                    $database_time = $ct;
                }else{
                    $database_time = $t_time;
                }
                if($unas > $date_to){
                    $unt = $t;
                } else{
                    $unt = $database_time;
                }
                $value = $unt;
            }
        } else {
            $value = str_replace('"', '""', $value);
            if ($j == 1) {
                $un = $value;
                $qurtemp = mysqli_query($db, "SELECT users_id,user_name FROM  cam_users where users_id = '$un'");
                while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                    $user_name = $rowctemp["user_name"];
                }
                $value = $user_name;
            }
            if ($j == 2) {
                $un = $value;
                $qurtemp = mysqli_query($db, "SELECT line_name FROM  cam_line where line_id = '$un'");
                while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                    $line_name = $rowctemp["line_name"];
                }
                $value = $line_name;
            }
            if ($j == 3) {
                $un = $value;
                $qurtemp = mysqli_query($db, "SELECT position_name FROM  cam_position where position_id = '$un'");
                while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                    $position_name = $rowctemp["position_name"];
                }
                $value = $position_name;
            }
            if ($j == 4) {
                $un = $value;
                $asin_time = $un;
                $value = $asin_time;
            }
            if ($j == 5) {
                $un = $value;
                $unsgn_time = $un;
                $unas = $unsgn_time;
                $as = $asin_time;
                $diffrence = abs(strtotime($unas) - strtotime($as));
                $t_time = round(($diffrence/3600),2);
                $df = abs(strtotime($curdate) - strtotime($as));
                $ct = round(($df/3600),2);
                $diff = abs(strtotime($date_to) - strtotime($as));
                $t = round(($diff/3600),2);
                if($unas > $date_to)
                {
                    $unasign = dateReadFormat($date_to);
                } else if($unas == $as)
                {
                    $unasign = dateReadFormat($unas);
                } else
                {
                    $unasign = dateReadFormat($unas);
                }
                $value = $unasign;
            }
            if ($j == 6) {
                $un = $value;
                $zero_time = '00:00:00';
                $database_time = $un;
                if ($zero_time == $database_time) {
                    $database_time = $ct;
                }else{
                    $database_time = $t_time;
                }
                if($unas > $date_to){
                    $unt = $t;
                } else{
                    $unt = $database_time;
                }
                $value = $unt;
            }
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
        $j++;

    }
    $rt .= trim($line) . "\n";
}
$result = str_replace("\r", "", $res);
$result .= str_replace("\r", "", $rt);
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
