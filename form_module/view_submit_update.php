<?php
include("../config.php");

$form_id = $_GET['id'];
$form_user_data_item = "";
$querymain = sprintf("SELECT * FROM `form_user_data` where form_user_data_id = '$form_id' ");
$qurmain = mysqli_query($db, $querymain);
$count  = $qurmain->num_rows;
if($count > 0) {
    while ($rowcmain = mysqli_fetch_array($qurmain)) {

        $get_form_type = $rowcmain['form_type'];
        $get_station = $rowcmain['station'];
        $get_part_family = $rowcmain['part_family'];
        $get_part_number = $rowcmain['part_number'];
        $formname = $rowcmain['form_name'];
        $form_item_array1 = $rowcmain["form_user_data_item"];
        $form_item_array2 = explode(',', $form_item_array1);
//		$exp2 = explode("~" , $form_item_array2[0]);
//		$d_size = count($exp2);
//		if($d_size == 2) {
//			for ($x = 0; $x < count($form_item_array2); $x++) {
//				$exp3 = explode("~" , $form_item_array2[$x]);
//				$form_user_data_item .=  $exp3[1] . ",";
//			}
//		}
        $query1 = sprintf("SELECT form_create_id FROM  form_create where form_type = '$get_form_type' and station = '$get_station' and part_family = '$get_part_family' and part_number = '$get_part_number' and name = '$formname'");
        $qur1 = mysqli_query($db, $query1);
        $rowc1 = mysqli_fetch_array($qur1);
        $form_create_id = $rowc1['form_create_id'];

        $query = sprintf("SELECT * FROM  form_item where form_create_id = '$form_create_id'");
        $qur = mysqli_query($db, $query);
        $i = 0;
        $j = 1;
        $check = 0;
        while ($rowc = mysqli_fetch_array($qur)) {

            $item_id = $rowc['form_item_id'];
            $item_type = $rowc['item_val'];
            if( $item_type != "header"){
                $exp = explode("~" , $form_item_array2[$i]);
                $c_size = count($exp);
                if($c_size == 2){
                    $form_user_data_item .= $item_id . "~" . $exp[1] . ",";
                    $i++;
                    $sql2 = "UPDATE `form_item` SET `form_item_seq`='$j' WHERE `form_item_id` = '$item_id'";
                    $result2 = mysqli_query($db, $sql2);
                    $j++;
                }else if($c_size == 1){
                    $form_user_data_item .= $item_id . "~" . $form_item_array2[$i] . ",";
                    $i++;
                    $sql2 = "UPDATE `form_item` SET `form_item_seq`='$j' WHERE `form_item_id` = '$item_id'";
                    $result2 = mysqli_query($db, $sql2);
                    $j++;
                }else{
                	$check = 1;
				}
            }else{
                $sql2 = "UPDATE `form_item` SET `form_item_seq`='$j' WHERE `form_item_id` = '$item_id'";
                $result2 = mysqli_query($db, $sql2);
                $j++;
            }


        }
    }

	if($check == 1){
		$sql0 = "UPDATE `form_user_data` SET `f_check`=1 , updated_new_format = 0 WHERE `form_user_data_id` = '$form_id'";
		$result0 = mysqli_query($db, $sql0);
	}else{
		$sql0 = "UPDATE `form_user_data` SET `form_user_data_item`='$form_user_data_item' , updated_new_format = 1 WHERE `form_user_data_id` = '$form_id'";
		$result0 = mysqli_query($db, $sql0);
		if ($result0) {
			$_SESSION['message_stauts_class'] = 'alert-success';
			$_SESSION['import_status_message'] = 'Form Updated Sucessfully.';
		} else {
			$_SESSION['message_stauts_class'] = 'alert-danger';
			$_SESSION['import_status_message'] = 'Please retry';
		}
	}

}
//header("Location:form_edit.php?id=$hidden_id");
$page = "view_submit.php?id=$form_id";
header('Location: '.$page, true, 303);
exit;

?>