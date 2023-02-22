<?php include("../config.php");
$curdate = date('Y-m-d');

$button = "";
$temp = "";

$sql_st_202 = "SELECT line_id FROM cam_line  where enabled = 1 and is_deleted = 0 ORDER BY `cam_line`.`line_id` ASC;";
$result_st_202 = mysqli_query($db, $sql_st_202);

while ($row_st_202 = mysqli_fetch_array($result_st_202)) {
	$ll_id = $row_st_202['line_id'];
	$sql_st_22 = "SELECT MAX(station_event_id) as m_ev FROM `sg_station_event` where line_id = '$ll_id' ;";
	$result_st_22 = mysqli_query($db, $sql_st_22);
	$row_st_22 = mysqli_fetch_array($result_st_22);
	$mev = $row_st_22['m_ev'];


//$sql_st = "SELECT * FROM `sg_station_event_log_update` where line_id = 3 ORDER BY `sg_station_event_old_id` DESC LIMIT 1";
//	$sql_st = "SELECT MAX(sg_station_event_id) as s_id ,(line_id) FROM `sg_station_event_log` where line_id = '$ll_id' group by line_id  ORDER by line_id";
//	$result_st = mysqli_query($db, $sql_st);
//	$row_st = mysqli_fetch_array($result_st);
	$station_event_old_id = 0;
	$l_id = $ll_id;
	$curdate1 = date('Y-m-d', strtotime('+1 days'));
//	while () {

//	$sql0 = "SELECT * FROM sg_station_event_log where  ignore_id != '1' AND station_event_log_id > '$station_event_old_id' AND  created_on < '$curdate1%'  OR  is_incomplete = 1";
	$sql0 = "SELECT slog.station_event_log_id ,slog.event_seq , slog.station_event_id , slog.event_cat_id , slog.is_incomplete , slog.event_type_id ,slog.created_on , slog.total_time ,slog.created_by FROM sg_station_event_log AS slog inner join sg_station_event AS se on slog.station_event_id = se.station_event_id where se.line_id= '$l_id' AND (slog.ignore_id != '1' AND slog.station_event_log_id > '$station_event_old_id' AND slog.created_on < '$curdate1%' OR slog.is_incomplete = 1);";
	$result0 = mysqli_query($db, $sql0);
	while ($row = mysqli_fetch_array($result0)) {
		$station_event_log_id = $row['station_event_log_id'];
		$event_seq = $row['event_seq'];
		$is_incomplete = $row['is_incomplete'];
		$station_event_id = $row['station_event_id'];
		$sql_seid = "select `line_id` from `sg_station_event` where station_event_id = '$station_event_id' order by line_id";
		$result_seid = mysqli_query($db, $sql_seid);
		$row_see = mysqli_fetch_array($result_seid);
		$line_id = $row_see['line_id'];

		if ($line_id != $l_id) {
			continue;
		}
//			if ($line_id == 47) {
//				$sgerg = 1;
//			}
		$i = 0;
		$station_cat_id = $row['event_cat_id'];
		$station_type_id = $row['event_type_id'];
		$event_status = $row['event_status'];
		$reason = $row['reason'];
		$created_on = $row['created_on'];
		$total_time = $row['total_time'];
		$created_by = $row['created_by'];
		$current_time = date("Y-m-d H:i:s");
		$time = ($created_on);

		//Created time details
		$s_arr_1 = explode(' ', $created_on);
		$s_arr = explode(':', $s_arr_1[1]);
		$create_date = $s_arr_1[0];
		$st_time = $s_arr[0] + ($s_arr[1] / 60) + ($s_arr[2] / 3600);
		$start_time = round($st_time, 2);

		//Current time details
		$s_arr_2 = explode(' ', $current_time);
		$s_arr2 = explode(':', $s_arr_2[1]);
		$current_date = $s_arr_2[0];
		$c_time2 = $s_arr2[0] + ($s_arr2[1] / 60) + ($s_arr2[2] / 3600);
		$c_time = round($c_time2, 2);

		if (!empty($total_time)) {
//			$sql_result1 = "Update sg_station_event_log SET is_incomplete = '0' where station_event_log_id = '$station_event_log_id'";
//			$sql_result2 = mysqli_query($db, $sql_result1);
			$s_arr_1 = explode(' ', $time);
			$s_arr = explode(':', $s_arr_1[1]);
			$st_time = $s_arr[0] + ($s_arr[1] / 60) + ($s_arr[2] / 3600);
			$start_time = round($st_time, 2);

			$t_arr = explode(':', $total_time);
			$tot_time = $t_arr[0] + ($t_arr[1] / 60) + ($t_arr[2] / 3600);
			$total_time = round($tot_time, 2);
			$total_time = $total_time;
			$end_hrs = $start_time + $total_time;

//			$tt = sprintf('%02d:%02d', (int)$start_time, fmod($start_time, 1) * 60);
			$tt = sprintf('%02d:%02d', (int)$end_hrs, fmod($end_hrs, 1) * 60);
			$tt1 = explode(":",$tt);
			$tt2 = $total_time;
			if((!empty($tt)) && ($tt1[0] < 24)){
				$end_time2 = $s_arr_1[0] . ' ' . $tt;
				$sql_result1 = "Update sg_station_event_log SET end_time = '$end_time2' , tt = '$total_time' where station_event_log_id = '$station_event_log_id' and event_seq = '$event_seq'";
				$sql_result2 = mysqli_query($db, $sql_result1);
			}else if((!empty($tt)) && ($tt1[0] > 24)){
				$ex_days = ($tt1[0] / 24);
				$days_d = (int)$ex_days;
				$dd = date('Y-m-d', strtotime($s_arr_1[0]. ' + '.$days_d.' days'));
				$time_tt = $tt1[0] - (24* $days_d);
				$time_t = $time_tt . ':' .$tt1[1];
				$end_time2 = $dd . ' ' . $time_t;
				$sql_result1 = "Update sg_station_event_log SET end_time = '$end_time2' , tt = '$total_time' where station_event_log_id = '$station_event_log_id' and event_seq = '$event_seq'";
				$sql_result2 = mysqli_query($db, $sql_result1);
			}

		}
	}


}
//$url = "update_station_event_log_backend_page.php";
//header('Location: ' . $url, true, 303);