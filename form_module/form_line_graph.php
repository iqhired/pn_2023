<?php include("../s_config.php");
include("../config.php");
$form_create_id = $_POST['form_create'];
$date_from = $_POST['date_from'];
$date_to = $_POST['date_to'];
$form_item_id = $_POST['form_item_id'];
error_log("inside Form Line graph");
$datefrom = convertMDYToYMD($date_from);
$dateto = convertMDYToYMD($date_to);
    //$sql = "SELECT data_item_value FROM `spc_schedular_data` WHERE `data_item_id` = '$form_item_id' and created_at >= '$date_from' and created_at <= '$date_to'";
$sql = "SELECT data_item_value as data_item_value , data_item_desc as data_item_desc , created_at as created_at,item_upper_tol as item_upper_tol,item_lower_tol as item_lower_tol,item_normal as item_normal FROM `spc_schedular_data` WHERE `data_item_id` = '$form_item_id' and created_at >= '$datefrom' and created_at <= '$dateto'";
    $response = array();
    $posts = array();
    $result = mysqli_query($s_db,$sql);
    $data =array();
    while ($row = mysqli_fetch_array($result)){
		$date = explode(' ', $row["created_at"])[0];
        $c_date = onlydateReadFormat($date);
        $item_normal = $row['item_normal'];
        $upper_tol = $row['item_upper_tol'];
        $lower_tol = $row['item_lower_tol'];
    	if($row['data_item_desc'] == 'binary'){
    		if($row['data_item_value'] == 'yes'){
				$val = $c_date . "~" . 1;
                $upper_tol = $c_date . "~" . ($item_normal + $row['item_upper_tol']);
                $lower_tol = $c_date . "~" . ($item_normal - $row['item_lower_tol']);
				$posts[] = array('item_value'=> $val,'upper_tol'=>$upper_tol,'lower_tol'=>$lower_tol);
			}else if($row['data_item_value'] == 'no'){
				$val = $c_date . "~" . 0;
                $upper_tol = $c_date . "~" . ($item_normal + $row['item_upper_tol']);
                $lower_tol = $c_date . "~" . ($item_normal - $row['item_lower_tol']);
				$posts[] = array('item_value'=> $val,'upper_tol'=>$upper_tol,'lower_tol'=>$lower_tol);
			}
		}else if($row['data_item_desc'] == 'numeric'){
			$val = $c_date . "~" . $row['data_item_value'];
            $upper_tol = $c_date . "~" . ($item_normal + $row['item_upper_tol']);
            $lower_tol = $c_date . "~" . ($item_normal + $row['item_lower_tol']);
			$posts[] = array('item_value'=> $val,'upper_tol'=>$upper_tol,'lower_tol'=>$lower_tol);
		}
    }
    $response['posts'] = $posts;
    echo json_encode($response);
