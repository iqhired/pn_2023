<?php
//include("../database_config.php");
include("../config.php");
$station_event_id = $_POST['station_event_id'];
$delete_check = $_POST['delete_check'];
$part_number = $_POST['del_part_no'];
if ($delete_check != "") {
    $cnt = count($delete_check);
    for ($i = 0; $i < $cnt;) {

        $sql = "select * from good_bad_pieces_details where bad_pieces_id ='$delete_check[$i]'";
//		$sql = "select * from good_bad_pieces where station_event_id ='$station_event_id' and event_status = '1' and defect_name = '$add_defect_name'";
        $result1 = mysqli_query($db, $sql);
        $rowc = mysqli_fetch_array($result1);
        $gp = (($rowc['good_pieces'] == null) || ($rowc['good_pieces'] == "" ) )?0:$rowc['good_pieces'] ;;
        $bp = (($rowc['bad_pieces'] == null) || ($rowc['bad_pieces'] == "" ) )?0:$rowc['bad_pieces'] ;;
        $rw = (($rowc['rework'] == null) || ($rowc['rework'] == "" ) )?0:$rowc['rework'] ;;
        $station_event_id = $rowc['station_event_id'];

        $aray_item_cnt = 0;
        $sql_part_prod = "select dependant_parts from pno_vs_pproduced where part_number = '$part_number'";
        $result_part_prod = mysqli_query($db,$sql_part_prod);
        while($row_part_prod = mysqli_fetch_array($result_part_prod)){
            $dependent = $row_part_prod['dependant_parts'];
            $removed_last_one   = substr($dependent, 1, -1);


            $arrteam = explode(',', $removed_last_one);
            foreach ($arrteam as $arr){
                if(!empty($arr)){
                    $ccnt = substr_count($arr, '~');
                    if ($ccnt > 0) {
                        $itemVal = explode('~', $arr)[0];
                        $itemCount = explode('~', $arr)[1];

                        $sql_pp = "select available_stock from pm_part_number where pm_part_number_id = '$itemVal'";
                        $result_pp = mysqli_query($db, $sql_pp);
                        $rr_pp = mysqli_fetch_assoc($result_pp);
                        $part_rr = $rr_pp['available_stock'];

                        $stock_avail = $part_rr + $itemCount;

                        $sql_part_pp = "update pm_part_number set available_stock = '$stock_avail' where pm_part_number_id = '$itemVal'";
                        $result11_part_pp = mysqli_query($db, $sql_part_pp);

                        $sql_part_pp1 = "update pm_part_number set available_stock =  ('$part_rr' + '$gp')  where pm_part_number_id = '$part_number'";
                        $result11_part_pp1 = mysqli_query($db, $sql_part_pp1);

                    }
                }
            }
        }

        $sql1 = "DELETE FROM `good_bad_pieces_details` WHERE `bad_pieces_id`='$delete_check[$i]'";
        if (!mysqli_query($db, $sql1)) {
            echo "Invalid Data";
        } else {
            $_SESSION['message_stauts_class'] = 'alert-success';
            $_SESSION['import_status_message'] = 'Data Deleted Sucessfully.';
            $sql1 = "update good_bad_pieces set good_pieces = (good_pieces - '$gp') ,bad_pieces = (bad_pieces - '$bp'),rework = (rework - '$rw') , modified_at = '$chicagotime' where station_event_id ='$station_event_id' and event_status = '1'";
            $result11 = mysqli_query($db, $sql1);
        }
        $i++;
    }
} else {
    $_SESSION['message_stauts_class'] = 'alert-danger';
    $_SESSION['import_status_message'] = 'Please Select Atleast one row.';
}
header("Location:good_bad_piece.php?station_event_id=$station_event_id");

?>
