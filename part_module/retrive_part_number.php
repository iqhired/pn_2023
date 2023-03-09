<?php
include("../config.php");

$part = $_GET['part_number'];
$part_extra = $_GET['part_number_extra'];

if (!empty($part) && $part_extra == 'undefined') {
    $sql = "SELECT * FROM `pm_part_number` where NOT (pm_part_number_id = '$part') AND is_deleted != 1";
}else if (!empty($part_extra)){
    $sql = "SELECT * FROM `pm_part_number` where NOT (pm_part_number_id = '$part_extra') AND is_deleted != 1";
 }else{
    $sql = "SELECT * FROM `pm_part_number` where  is_deleted != 1";
}
$result = $mysqli->query($sql);
//$json = [];
while ($row = $result->fetch_assoc()) {
    $form_part_unit_id  = $row['pm_part_number_id'];
    $unit_of_part  = $row['part_number'] . "-" . $row['part_name'] ;

    $json[] = array(
        'name' => $unit_of_part,
        'id' => $form_part_unit_id
    );
}
echo json_encode($json);
?>
