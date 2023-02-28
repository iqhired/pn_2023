<?php include("../config.php");
	$curdate = date('Y-m-d');
	
	$button = "";
	$temp = "";
	
	$sql_st_202 = "update sg_station_event_log as slog inner join sg_station_event as sg on slog.station_event_id = sg.station_event_id set slog.line_id=sg.line_id where slog.station_event_id = sg.station_event_id;";
	$result_st_202 = mysqli_query($db, $sql_st_202);
	
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
		$next_seq = 0;
//	while () {

//	$sql0 = "SELECT * FROM sg_station_event_log where  ignore_id != '1' AND station_event_log_id > '$station_event_old_id' AND  created_on < '$curdate1%'  OR  is_incomplete = 1";
		$sql0 = "SELECT slog.station_event_log_id,slog.event_seq, slog.station_event_id, slog.line_id, slog.event_cat_id, slog.event_type_id, slog.event_status,slog.created_on, slog.end_time, slog.tt, slog.total_time FROM sg_station_event_log AS slog inner join sg_station_event
AS se on slog.station_event_id = se.station_event_id where se.line_id= '$l_id' AND (slog.ignore_id != '1'
AND slog.station_event_log_id > '$station_event_old_id' )  ORDER BY `slog`.`created_on` ASC;";
		$result0 = mysqli_query($db, $sql0);
		$jj=0;
		$kk = 1;
		while ($row = mysqli_fetch_array($result0)) {
			$station_event_log_id = $row['station_event_log_id'];
			$event_seq = $row['event_seq'];
			$is_incomplete = $row['is_incomplete'];
			$station_event_id = $row['station_event_id'];
			$line_id = $row['line_id'];
			
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
			$end_time = $row['end_time'];
			$curr_seq = $row['event_seq'];
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
			
			
			
			if($jj > 0){
				
				$qur2 = "Select SEC_TO_TIME(TIME_TO_SEC(TIMEDIFF('$created_on', '$start_tt'))) as completed_time from `sg_station_event_log` WHERE station_event_log_id = '$station_event_log_id'";
				$res = mysqli_query($db, $qur2);
				$firstrow = mysqli_fetch_array($res);
				$total_time = $firstrow['completed_time'];
				
				$tt_t = explode(':',$total_time);
				$tt = round(($tt_t[0]+($tt_t[1]/60)+($tt_t[2]/3600)),2);
				$qur3 = "update `sg_station_event_log` set total_time = '$total_time' ,end_time = '$created_on',tt = '$tt',is_incomplete = '0' where  station_event_log_id = '$slog_id'";
				$result01 = mysqli_query($db, $qur3);
				if($station_event_id == $slog_seid){
					if(($station_cat_id == 0) && ($event_status == 1)){
						$qur3 = "update `sg_station_event_log` set event_cat_id = '$slog_ec' ,event_type_id = '$slog_et',event_seq = '$next_seq' where  station_event_log_id = '$station_event_log_id'";
						$result01 = mysqli_query($db, $qur3);
						$station_type_id =$slog_et;
						$station_cat_id = $slog_ec;
					}else if(($station_cat_id == 0) && ($event_status == 0)){
						$qur3 = "update `sg_station_event_log` set event_cat_id = '4' ,event_type_id = '7',event_seq = '$next_seq' where  station_event_log_id = '$station_event_log_id'";
						$result01 = mysqli_query($db, $qur3);
						$station_type_id =7;
						$station_cat_id = 4;
					}
				}
				
			}
			if($station_event_id == $slog_seid){
				$next_seq += 1;
			}else{
				$next_seq = $curr_seq + 1 ;
			}
			$start_tt = $created_on;
			$slog_id = $station_event_log_id;
			$slog_ec = $station_cat_id;
			$slog_et = $station_type_id;
			$slog_seid = $station_event_id;
			$slog_es = $event_status;
			
			
			$jj = 1;
		
		}
		
		
	}