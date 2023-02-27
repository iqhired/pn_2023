<?php ini_set('display_errors', 'off');
include '../config.php';
$curdate = date('Y-m-d H:i');
$cd = date('d-M-Y H:i:s');
$taskboard = $_SESSION['taskboard'];
$user = $_SESSION['usr'];
$station = $_SESSION['station'];
$dateto = $_SESSION['date_to'];
$datefrom = $_SESSION['date_from'];
$button = $_SESSION['button_event'];
$timezone = $_SESSION['timezone'];
$print_data='';
$date_from = convertMDYToYMDwithTime($datefrom);
$date_to = convertMDYToYMDwithTime($dateto);
$ss3 = "SELECT `user_id`,`station_id`,`position_id`,`assign_time`,`unassign_time`,COALESCE(total_time,abs(`unassign_time` - `assign_time`)) AS time FROM `cam_assign_crew_log` WHERE DATE_FORMAT(`assign_time`,'%Y-%m-%d %H:%i') >= '$date_from' and DATE_FORMAT(`assign_time`,'%Y-%m-%d %H:%i') <= '$date_to'";
$ss2 = "SELECT `user_id`,`station_id`,`position_id`,`assign_time`,`unassign_time`,COALESCE(total_time,abs(`unassign_time` - '$date_from')) AS time FROM `cam_assign_crew_log` WHERE DATE_FORMAT(`unassign_time`,'%Y-%m-%d %H:%i') >= '$date_from' and DATE_FORMAT(`assign_time`,'%Y-%m-%d %H:%i') <= '$date_from'";
$ss1 = "SELECT `user_id`,`station_id`,`position_id`,`assign_time`,`unassign_time`,COALESCE(total_time,abs(`unassign_time` - '$date_from')) AS time  FROM `cam_assign_crew_log` WHERE DATE_FORMAT(`unassign_time`,'%Y-%m-%d %H:%i') >= '$date_from' and DATE_FORMAT(`assign_time`,'%Y-%m-%d %H:%i') <= '$date_from' and `station_id` = '$station'";
$qur = "SELECT `user_id`,`station_id`,`position_id`,`assign_time`,`unassign_time`,COALESCE(total_time,abs(`unassign_time` - `assign_time`)) AS time FROM `cam_assign_crew_log` WHERE DATE_FORMAT(`assign_time`,'%Y-%m-%d %H:%i') >= '$date_from' and DATE_FORMAT(`assign_time`,'%Y-%m-%d %H:%i') <= '$date_to' and `station_id` = '$station'";
$u = "SELECT `user_id`,`station_id`,`position_id`,`assign_time`,`unassign_time`,COALESCE(total_time,abs(`unassign_time` - '$date_from')) AS time FROM `cam_assign_crew_log` WHERE DATE_FORMAT(`unassign_time`,'%Y-%m-%d %H:%i') >= '$date_from' and DATE_FORMAT(`assign_time`,'%Y-%m-%d %H:%i') <= '$date_from' AND `user_id` = '$user'";
$u1 = "SELECT `user_id`,`station_id`,`position_id`,`assign_time`,`unassign_time`,COALESCE(total_time,abs(`unassign_time` - `assign_time`)) AS time FROM `cam_assign_crew_log` WHERE DATE_FORMAT(`assign_time`,'%Y-%m-%d %H:%i') >= '$date_from' and DATE_FORMAT(`assign_time`,'%Y-%m-%d %H:%i') <= '$date_to' AND `user_id` = '$user'";
if(!empty($station) || !empty($user)){
    //if station not empty
        $exportData = mysqli_query($db, $ss1);
        $header = "User" . "\t" . "Station" . "\t" . "Position" . "\t" . "Assign Time" . "\t" . "Un-Assign Time" . "\t" . "Total Time" . "\t";
        while ($row = mysqli_fetch_row($exportData)) {
            $line = '';
            $j = 1;

            foreach ($row as $value) {
                if ((!isset($value)) || ($value == "")) {
                    $value = "\t";
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
                            $database_time = "Still Assigned";
                        }else{
                            $database_time = $t_time;
                        }
                        if($value == ''){
                            $value = $t_time;
                        }else{
                            $value = $database_time;
                        }

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
            if ((!isset($value)) || ($value == "")) {
                $value = "\t";
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
                        $unasign = $cd;
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
                    }else{
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
    //if user not empty
    $exportData = mysqli_query($db, $u);
    $header = "User" . "\t" . "Station" . "\t" . "Position" . "\t" . "Assign Time" . "\t" . "Un-Assign Time" . "\t" . "Total Time" . "\t";
    while ($row = mysqli_fetch_row($exportData)) {
        $line = '';
        $j = 1;

        foreach ($row as $value) {
            if ((!isset($value)) || ($value == "")) {
                $value = "\t";
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
                        $unasign = $cd;
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
                    }else{
                        $unt = $database_time;
                    }
                    $value = $unt;

                }
                $value = '"' . $value . '"' . "\t";
            }
            $line .= $value;
            $j++;

        }
        $res .= trim($line) . "\n";
    }
    $exp = mysqli_query($db, $u1);
    $header = "User" . "\t" . "Station" . "\t" . "Position" . "\t" . "Assign Time" . "\t" . "Un-Assign Time" . "\t" . "Total Time" . "\t";
    while ($row = mysqli_fetch_row($exp)) {
        $line = '';
        $j = 1;

        foreach ($row as $value) {
            if ((!isset($value)) || ($value == "")) {
                $value = "\t";
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
                        $database_time = "Still Assigned";
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
        $rt .= trim($line) . "\n";
    }
}else{
    $exp1 = mysqli_query($db, $ss2);
    $header = "User" . "\t" . "Station" . "\t" . "Position" . "\t" . "Assign Time" . "\t" . "Un-Assign Time" . "\t" . "Total Time" . "\t";
    while ($row = mysqli_fetch_row($exp1)) {
        $line = '';
        $j = 1;

        foreach ($row as $value) {
            if ((!isset($value)) || ($value == "")) {
                $value = "\t";
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
                        $database_time = "Still Assigned";
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
        $rtt .= trim($line) . "\n";
    }
    $exp3 = mysqli_query($db, $ss3);
    $header = "User" . "\t" . "Station" . "\t" . "Position" . "\t" . "Assign Time" . "\t" . "Un-Assign Time" . "\t" . "Total Time" . "\t";
    while ($row = mysqli_fetch_row($exp3)) {
        $line = '';
        $j = 1;

        foreach ($row as $value) {
            if ((!isset($value)) || ($value == "")) {
                $value = "\t";
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
                        $unasign = $cd;
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
                    }else{
                        $unt = $database_time;
                    }
                    $value = $unt;

                }
                $value = '"' . $value . '"' . "\t";
            }
            $line .= $value;
            $j++;

        }
        $rttt .= trim($line) . "\n";
    }
}

    $result = str_replace("\r", "", $res);
    $result .= str_replace("\r", "", $rt);
    $result .= str_replace("\r", "", $rtt);
    $result .= str_replace("\r", "", $rttt);


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
