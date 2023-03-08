<?php include("../config.php");
$curdate = date(mdYHi_FORMAT);
//$dateto = $curdate;
//$datefrom = $curdate;
$button = "";
$temp = "";
//check user
checkSession();

$button_event = "button3";
$curdate = date(mdYHi_FORMAT);
$dateto = $curdate;
$datefrom = $curdate;
$button = "button3";
$temp = "";
// if (!isset($_SESSION['user'])) {
// 	header('location: logout.php');
// }
$station = $_SESSION['station'];
$datefrom = $_SESSION['date_from'];
$dateto = $_SESSION['date_to'];
$pf = $_SESSION['pf'];
$pn = $_SESSION['pn'];
$cell = $_SESSION['cell'];

$query0003 = sprintf("SELECT SUBSTRING(stations,1,length(stations)-1) as stns FROM cell_grp where c_id = '$cell'");
$qur0003 = mysqli_query($db, $query0003);
while ($rowc0003 = mysqli_fetch_array($qur0003)) {
    $stt = $rowc0003["stns"];
}
$wc = '';
$print_data='';
if(!empty($cell)){
    $wc = $wc . " and sg_station_event.line_id in ($stt)";
}else{
    if($station == '0'){
        $print_data .= "Station :  All Station \n";
        $wc = $wc . " ";

    }else {
        if (!empty($station)  && $station != '0') {
            $qurtemp = mysqli_query($db, "SELECT line_name FROM  cam_line where line_id = '$station' ");
            while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                $line_name = $rowctemp["line_name"];
                $print_data .= "Station : " . $line_name . "\n";
            }
            $wc = $wc . " and sg_station_event.line_id = '$station'";
        }
        if (!empty($pn)) {
            $qurtemp = mysqli_query($db, "SELECT part_number , part_name FROM `pm_part_number` where pm_part_number_id = '$pn' ");
            while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                $part_number = $rowctemp["part_number"];
                $part_name = $rowctemp["part_name"];
                $print_data .= "Part Number  : " . $part_number . "\n";
                $print_data .= "Part Description / Name  : " . $part_name . "\n";
            }
            $wc = $wc . " and sg_station_event.part_number_id = '$pn'";
        }
        if (!empty($pf)) {
            $qurtemp = mysqli_query($db, "SELECT part_family_name FROM `pm_part_family` where pm_part_family_id = '$pf' ");
            while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                $part_family_name = $rowctemp["part_family_name"];
                $print_data .= "Part Family  : " . $part_family_name . "\n";
            }
            $wc = $wc . " and sg_station_event.part_family_id = '$pf'";
        }
    }
}
    /* If Data Range is selected */
$date_from = convertMDYToYMDwithTime($datefrom);
$date_to = convertMDYToYMDwithTime($dateto);
$wc = $wc . " and DATE_FORMAT(`created_at`,'%Y-%m-%d %H:%i') >= '$date_from' and DATE_FORMAT(`created_at`,'%Y-%m-%d %H:%i') <= '$date_to' ";

$print_data .= "From Date : " . onlydateReadFormat($date_from) . "\n";
$print_data .= "To Date : " . onlydateReadFormat($date_to) . "\n\n\n";


$sql = "SELECT ( select cam_line.line_name from cam_line where cam_line.line_id = sg_station_event.line_id) as Station ,good_bad_pieces_details.good_pieces AS good_pieces  , ( select pm_part_family.part_family_name from pm_part_family where pm_part_family.pm_part_family_id = sg_station_event.part_family_id) as p_fam_name ,( select pm_part_number.part_number from pm_part_number where pm_part_number.pm_part_number_id = sg_station_event.part_number_id) as pm_p_num , ( select pm_part_number.part_name from pm_part_number where pm_part_number.pm_part_number_id = sg_station_event.part_number_id) as pm_part_name , good_bad_pieces_details.created_by ,cast(good_bad_pieces_details.created_at AS date) as crtd_date,cast(good_bad_pieces_details.created_at AS Time) as crtd_t  FROM `good_bad_pieces_details`  INNER JOIN sg_station_event ON good_bad_pieces_details.station_event_id = sg_station_event.station_event_id where 1 and good_pieces > 0 " . $wc ."ORDER BY sg_station_event.line_id,good_bad_pieces_details.created_at";
$gp_result = mysqli_query($db,$sql);


$header1 = "Sl. No" . "\t" . "Station" . "\t" . "Good Pieces" . "\t" .  "Part Family" ."\t" . "Part Number" ."\t" . "Part Name" ."\t". "Personnel" . "\t" . "Date" . "\t" . "Time";
$result1 = '';
$i=1;
while ($row = mysqli_fetch_row($gp_result)) {
	$line = '';
	$j = 1;
	foreach ($row as $value) {
		if ((empty($value)) || ($value == "")) {
			$value = "-"."\t";
		} else {
			$value = str_replace('"', '""', $value);
            if ($j == 7) {
                $un = $value;
                $cc_date = $un;
                $c = onlydateReadFormat($cc_date);
                $value = $c;
            }
			$value = '"' . $value . '"' . "\t";
		}
		$line .= $value;
		$j++;
	}
	$result1 .= $i."\t".trim($line) . "\n";
	$i++;
}
$result1 = str_replace("\r", "", $result1);
if ($result1 == "") {
	$result1 = "\nNo Record(s) Found!\n";
}

$sql1 = "SELECT (select cam_line.line_name from cam_line where cam_line.line_id = sg_station_event.line_id) as station ,(good_bad_pieces_details.bad_pieces)   ,(good_bad_pieces_details.part_defect_zone), (good_bad_pieces_details.rework) AS Rework , good_bad_pieces_details.defect_name  , ( select pm_part_family.part_family_name from pm_part_family where pm_part_family.pm_part_family_id = sg_station_event.part_family_id) as p_fam_name ,( select pm_part_number.part_number from pm_part_number where pm_part_number.pm_part_number_id = sg_station_event.part_number_id) as pm_p_num , ( select pm_part_number.part_name from pm_part_number where pm_part_number.pm_part_number_id = sg_station_event.part_number_id) as pm_part_name , good_bad_pieces_details.created_by as Personnel , cast(good_bad_pieces_details.created_at AS date) as crtd_date,cast(good_bad_pieces_details.created_at AS Time) as crtd_t FROM `good_bad_pieces_details` INNER JOIN sg_station_event ON good_bad_pieces_details.station_event_id = sg_station_event.station_event_id WHERE defect_name IS NOT NULL " . $wc . " ORDER BY sg_station_event.line_id,good_bad_pieces_details.created_at;";
$exportData = mysqli_query($db, $sql1);

$header = "Sl. No" . "\t" . "Station" . "\t" ."Bad Pieces" . "\t" ."Defect zone" . "\t" . "Rework" . "\t" . "Defect Name" . "\t" . "Part Family" ."\t" . "Part Number" ."\t" . "Part Name" ."\t" . "Personnel" . "\t" . "Date" . "\t" . "Time";
$result = '';
$i=1;
while ($row = mysqli_fetch_row($exportData)) {
	$line = '';
	$j = 1;
	foreach ($row as $value) {
		if ((empty($value)) || ($value == "")) {
			$value = "-"."\t";
		} else {
			$value = str_replace('"', '""', $value);
            if ($j == 9) {
                $un = $value;
                $c_date = $un;
                $cc = onlydateReadFormat($c_date);
                $value = $cc;
            }
			$value = '"' . $value . '"' . "\t";
		}
		$line .= $value;
		$j++;
	}
	$result .= $i."\t".trim($line) . "\n";
	$i++;
}
$result = str_replace("\r", "", $result);
if ($result == "") {
	$result = "\nNo Record(s) Found!\n";
}
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Good Bad Piece Log.xls");
header("Pragma: no-cache");
header("Expires: 0");
print "\n\n$print_data\n$header1\n$result1\n\n\n\n";
print "$header\n$result";
?>