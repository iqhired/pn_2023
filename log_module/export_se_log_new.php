<?php include '../config.php';
$taskboard = $_SESSION['taskboard'];
$user = $_SESSION['user'];
$date = $_SESSION['assign_date'];
$curdate = date('Y-m-d H:i');
$dateto = $_SESSION['date_to'];
$datefrom = $_SESSION['date_from'];
$button = $_SESSION['button_event'];
$timezone = $_SESSION['timezone'];
$event_type = $_SESSION['event_type'];
$event_category = $_SESSION['event_category'];
$line_id = $_SESSION['station'];
$print_data='';

if(empty($dateto)){
    $curdate = date(mdYHi_FORMAT,strtotime("-1 days"));
    $dateto = $curdate;
}

if(empty($datefrom)){
    $yesdate = date(mdYHi_FORMAT,strtotime("-1 days"));
    $datefrom = $yesdate;
}

$q = "select slogup.line_id , ( select event_type_name from event_type where event_type_id = slogup.event_type_id) as e_type, 
( select events_cat_name from events_category where events_cat_id = slogup.event_cat_id) as cat_name , pn.part_number as p_num, pn.part_name as p_name , 
pf.part_family_name as pf_name,slogup.created_on as start_time , slogup.end_time as end_time ,slogup.total_time as total_time from sg_station_event_log_update as slogup 
inner join sg_station_event as sg_events on slogup.station_event_id = sg_events.station_event_id INNER JOIN pm_part_family as pf on sg_events.part_family_id = pf.pm_part_family_id 
inner join pm_part_number as pn on sg_events.part_number_id = pn.pm_part_number_id where 1";
$q11 = "select slogup.line_id , ( select event_type_name from event_type where event_type_id = slogup.event_type_id) as e_type, 
( select events_cat_name from events_category where events_cat_id = slogup.event_cat_id) as cat_name , pn.part_number as p_num, pn.part_name as p_name , 
pf.part_family_name as pf_name,slogup.created_on as start_time , slogup.end_time as end_time ,slogup.total_time as total_time from sg_station_event_log_update as slogup 
inner join sg_station_event as sg_events on slogup.station_event_id = sg_events.station_event_id INNER JOIN pm_part_family as pf on sg_events.part_family_id = pf.pm_part_family_id 
inner join pm_part_number as pn on sg_events.part_number_id = pn.pm_part_number_id where 1";

if ($line_id != null) {
    $qurtemp = mysqli_query($db, "SELECT line_name FROM  cam_line where line_id = '$line_id' ");
    while ($rowctemp = mysqli_fetch_array($qurtemp)) {
        $line_name = $rowctemp["line_name"];
    }
    $q = $q . " and slogup.line_id = '$line_id' ";
    $q11 = $q11 . " and slogup.line_id = '$line_id' ";
}
if($datefrom != "" && $dateto != ""){
    $date_from = convertMDYToYMDwithTime($datefrom);
    $date_to = convertMDYToYMDwithTime($dateto);
    $q = $q . " AND DATE_FORMAT(slogup.created_on,'%Y-%m-%d %H:%i') >= '$date_from' and DATE_FORMAT(slogup.created_on,'%Y-%m-%d %H:%i') <= '$date_to' ";
    $q11 = $q11 . " AND DATE_FORMAT(slogup.end_time,'%Y-%m-%d %H:%i') >= '$date_from' and DATE_FORMAT(slogup.created_on,'%Y-%m-%d %H:%i') <= '$date_from' ";
}else if($datefrom != "" && $dateto == ""){
    $date_from = convertMDYToYMDwithTime($datefrom);
    $q = $q . " AND DATE_FORMAT(slogup.created_on,'%Y-%m-%d %H:%i') >= '$date_from' ";
    $q11 = $q11 . " AND DATE_FORMAT(slogup.end_time,'%Y-%m-%d %H:%i') >= '$date_from' and DATE_FORMAT(slogup.created_on,'%Y-%m-%d %H:%i') <= '$date_from' ";
}else if($datefrom == "" && $dateto != ""){
    $date_to = convertMDYToYMDwithTime($dateto);
	$q = $q . " AND DATE_FORMAT(slogup.created_on,'%Y-%m-%d %H:%i') <= '$date_to'";
}

$print_data .=  "From Date : " . onlydateReadFormat($date_from) . '-' . "To Date : " . onlydateReadFormat($date_to). "\n";
if ($event_type != "") {
	$q = $q . " and slogup.event_type_id = '$event_type'";
    $q11 = $q11 . " and slogup.event_type_id = '$event_type'";
}

if ($event_category != "") {
	$q = $q . " AND  slogup.event_cat_id ='$event_category'";
    $q11 = $q11 . " AND  slogup.event_cat_id ='$event_category'";
}

if (empty($line_id)){
    $q = $q . " ORDER BY slogup.line_id,e_log.created_on";
    $q11 = $q11 . " ORDER BY slogup.line_id,slogup.created_on  ASC";
}else{
    $q = $q . " ORDER BY slogup.created_on  ASC";
    $q11 = $q11 . " ORDER BY slogup.created_on  ASC";
}


$exp = mysqli_query($db, $q11);
$header = "Station" . "\t" ."Event Type" . "\t" . "Part Number" . "\t" . "Part Name" . "\t" . "Part Family" .  "\t"  . "Date" .  "\t". "Start Time" . "\t" ."End Time" . "\t" ."Total Time" . "\t" ;
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
                $qurtemp = mysqli_query($db, "SELECT line_name FROM  cam_line where line_id = '$un'");
                while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                    $line_name = $rowctemp["line_name"];
                }
                $value = $line_name;
            }
            if ($j == 7) {
                $un = $value;
                $created_on = $un;
                $value = dateReadFormat($date_from);
            }
            if ($j == 8) {
                $un = $value;
                $end_time = $un;
                if($end_time > $date_to)
                {
                    $end_time = dateReadFormat($date_to);
                }else{
                    $end_time = dateReadFormat($end_time);
                }
                $value = $end_time;
            }
            if ($j == 9) {
                $un = $value;
                $diff = abs(strtotime($date_to) - strtotime($date_from));
                $t = round(($diff/3600),2);
                if($end_time > $date_to)
                {
                    $t_time = $t;
                }else{
                    $dd = (strtotime($end_time) - strtotime($date_from));
                    $t_time = round(($dd/3600),2);
                }
                $value = $t_time;
            }
			$value = '"' . $value . '"' . "\t";
		}
		$line .= $value;
		$j++;

	}
	$result .= trim($line) . "\n";

}
$export = mysqli_query($db, $q);
$header = "Station" . "\t" ."Event Type" . "\t" . "Part Number" . "\t" . "Part Name" . "\t" . "Part Family" .  "\t"  . "Date" .  "\t". "Start Time" . "\t" ."End Time" . "\t" ."Total Time" . "\t" ;
while ($row = mysqli_fetch_row($export)) {
    $line = '';
    $j = 1;
    foreach ($row as $value) {

        if ((!isset($value)) || ($value == "")) {
            $value = "\t";
        } else {
            $value = str_replace('"', '""', $value);
            if ($j == 1) {
                $un = $value;
                $qurtemp = mysqli_query($db, "SELECT line_name FROM  cam_line where line_id = '$un'");
                while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                    $line_name = $rowctemp["line_name"];
                }
                $value = $line_name;
            }
            if ($j == 7) {
                $un = $value;
                $created_on = $un;
                $value = dateReadFormat($created_on);
            }
            if ($j == 8) {
                $un = $value;
                $end_time = $un;
                if($end_time > $date_to)
                {
                    $end_time = dateReadFormat($date_to);
                }else{
                    $end_time = dateReadFormat($end_time);
                }
                $value = $end_time;
            }
            if ($j == 9) {
                $un = $value;
                $diff = abs(strtotime($date_to) - strtotime($created_on));
                $t = round(($diff/3600),2);
                if($end_time > $date_to)
                {
                    $t_time = $t;
                }else{
                    $t_time = $un;
                }
                $value = $t_time;
            }
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
        $j++;

    }
    $result .= trim($line) . "\n";

}

$result = str_replace("\r", "", $result);

if ($result == "") {
	$result = "\nNo Record(s) Found!\n";
}
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Station Events Log.xls");
header("Pragma: no-cache");
header("Expires: 0");
print "\n\n$print_data\n\n";
print "$header\n$result";
?>