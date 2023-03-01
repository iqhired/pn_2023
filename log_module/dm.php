<?php include("../config.php");
$curdate = date('Y-m-d');

$button = "";
$temp = "";

$sql_st_202 = "SELECT line_id FROM cam_line  where enabled = 1 and is_deleted = 0 ORDER BY `cam_line`.`line_id` ASC;";
$result_st_202 = mysqli_query($db, $sql_st_202);

while ($row_st_202 = mysqli_fetch_array($result_st_202)) {
	$ll_id = $row_st_202['line_id'];
	$sql_st_2022 = "update cam_station_pos_rel set assigned ='0' where line_id ='$ll_id' ";
	mysqli_query($db, $sql_st_2022);
	$sql_st_2021 = "SELECT * FROM cam_assign_crew WHERE line_id = '$ll_id' and resource_type = 'regular';";
	$result_st_2021 = mysqli_query($db, $sql_st_2021);
	while ($row_st_2021 = mysqli_fetch_array($result_st_2021)) {
		$sql_st_2022 = "update cam_station_pos_rel set assigned ='1' where position_id	='$row_st_2021[position_id]' and line_id ='$ll_id' ";
		mysqli_query($db, $sql_st_2022);
		
	}
}
//$url = "update_station_event_log_backend_page.php";
//header('Location: ' . $url, true, 303);