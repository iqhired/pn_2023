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
$date_from = convertMDYToYMDwithTime($datefrom);
$date_to = convertMDYToYMDwithTime($dateto);
$ss1 = "SELECT `user_id`,`station_id`,`position_id`,`assign_time`,`unassign_time`,`total_time`  as time FROM `cam_assign_crew_log` WHERE DATE_FORMAT(`unassign_time`,'%Y-%m-%d %H:%i') >= '$date_from' and DATE_FORMAT(`assign_time`,'%Y-%m-%d %H:%i') <= '$date_from' and `station_id` = '$station'";
$qur = "SELECT `user_id`,`station_id`,`position_id`,`assign_time`,`unassign_time`,`total_time`  as time FROM `cam_assign_crew_log` WHERE DATE_FORMAT(`assign_time`,'%Y-%m-%d %H:%i') >= '$date_from' and DATE_FORMAT(`assign_time`,'%Y-%m-%d %H:%i') <= '$date_to' and `station_id` = '$station'";
if(!empty($ss1)){
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
                $date = $un;
                    if ($date <= $date_from) {
                        $value = $date_from;
                    } else {
                        $value = $date;
                    }
                }
                if ($j == 5) {
                    $un = $value;
                    $d1 = $un;
                    if ($un == $date) {
                        $unasign = "Still Assigned";
                    } else {
                        $unasign = $un;
                    }
                    if ($un > $date_to) {
                        $value = $date_to;
                    } else {
                        $value = $unasign;
                    }
                }
                if ($j == 6) {
                    $un = $value;
                    $zero_time = '00:00:00';
                    $database_time = $un;
                    $diffrence = abs(strtotime($date) - strtotime($d1));
                    $t_time = round(($diffrence / 3600), 2);
                    $diff = abs(strtotime($date_to) - strtotime($date));
                    $t = round(($diff / 3600), 2);
                    $dd = abs(strtotime($d1) - strtotime($date_from));
                    $tt = round(($dd / 3600), 2);
                    if ($zero_time == $database_time) {
                        $database_time = "Still Assigned";
                    } else {
                        $database_time = $t_time;
                    }
                    if ($date < $date_from) {
                        $value = $tt;
                    }else if ($unasign > $date_to) {
                        $value = $t;
                    } else {
                        $value = $database_time;
                    }
                }
                /*if ($j == 4) {
                    $un = $value;
                    $date = $un;
                    $value = $date;
                }
                if ($j == 5) {
                    $un = $value;
                    $d1 = $un;
                    if ($un == $date) {
                        $unasign = "Still Assigned";
                    } else {
                        $unasign = $un;
                    }
                    if ($un > $date_to) {
                        $value = $date_to;
                    } else {
                        $value = $unasign;
                    }
                }
                if ($j == 6) {
                    $un = $value;
                    $zero_time = '00:00:00';
                    $database_time = $un;
                    $diffrence = abs(strtotime($unasign) - strtotime($date));
                    $t_time = round(($diffrence / 3600), 2);
                    $diff = abs(strtotime($date_to) - strtotime($date));
                    $t = round(($diff / 3600), 2);
                    if ($zero_time == $database_time) {
                        $database_time = "Still Assigned";
                    } else {
                        $database_time = $t_time;
                    }
                    if ($unasign > $date_to) {
                        $value = $t;
                    } else {
                        $value = $database_time;
                    }
                }*/
                $value = '"' . $value . '"' . "\t";
            }
            $line .= $value;
            $j++;

        }
        $res .= trim($line) . "\n";
    }
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
                $date = $un;
                if ($date <= $date_from) {
                    $value = $date_from;
                } else {
                    $value = $date;
                }
            }
            if ($j == 5) {
                $un = $value;
                $d1 = $un;
                if ($un == $date) {
                    $unasign = "Still Assigned";
                } else {
                    $unasign = $un;
                }
                if ($un > $date_to) {
                    $value = $date_to;
                } else {
                    $value = $unasign;
                }
            }
            if ($j == 6) {
                $un = $value;
                $zero_time = '00:00:00';
                $database_time = $un;
                $diffrence = abs(strtotime($date) - strtotime($d1));
                $t_time = round(($diffrence / 3600), 2);
                $diff = abs(strtotime($date_to) - strtotime($date));
                $t = round(($diff / 3600), 2);
                $dd = abs(strtotime($d1) - strtotime($date_from));
                $tt = round(($dd / 3600), 2);
                if ($zero_time == $database_time) {
                    $database_time = "Still Assigned";
                } else {
                    $database_time = $t_time;
                }
                if ($date < $date_from) {
                    $value = $tt;
                } else if ($unasign > $date_to) {
                    $value = $t;
                } else {
                    $value = $database_time;
                }
            }
           /* if ($j == 4) {
                $un = $value;
                $date = $un;
                $value = $date;
            }
            if ($j == 5) {
                $un = $value;
                $d1 = $un;
                if ($un == $date) {
                    $unasign = "Still Assigned";
                } else {
                    $unasign = $un;
                }
                if ($un > $date_to) {
                    $value = $date_to;
                } else {
                    $value = $unasign;
                }
            }
            if ($j == 6) {
                $un = $value;
                $zero_time = '00:00:00';
                $database_time = $un;
                $diffrence = abs(strtotime($unasign) - strtotime($date));
                $t_time = round(($diffrence / 3600), 2);
                $diff = abs(strtotime($date_to) - strtotime($date));
                $t = round(($diff / 3600), 2);
                if ($zero_time == $database_time) {
                    $database_time = "Still Assigned";
                } else {
                    $database_time = $t_time;
                }
                if ($unasign > $date_to) {
                    $value = $t;
                } else {
                    $value = $database_time;
                }
            }*/
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
