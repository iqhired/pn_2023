<?php ob_start();
ini_set('display_errors', 'off');
session_start();
include("../s_config.php");
include '../config.php';
$form_create_id = $_POST['form_create'];
$date_from = $_POST['date_from'];
$date_to = $_POST['date_to'];
$form_item_id = $_POST['form_item_id'];
$line_id = $_POST['line_id'];
$form_type = $_POST['form_type'];
$part_family = $_POST['part_family'];
$part_num = $_POST['part_num'];
$datefrom = convertMDYToYMD($date_from);
$dateto = convertMDYToYMD($date_to);

$qur1 = mysqli_query($db, "SELECT * FROM cam_line where line_id = '$line_id' and enabled = 1");
$row1 = mysqli_fetch_array($qur1);
$line_name = $row1["line_name"];

$exp = mysqli_query($s_db,"SELECT data_item_value,(item_normal + item_upper_tol) as upper_tol,(item_normal + item_lower_tol) as lower_tol,created_at as created_at/*,data_item_id*/ FROM `spc_schedular_data` WHERE `data_item_id` = '$form_item_id' and created_at >= '$datefrom' and created_at <= '$dateto'");
$header = "Station" . "\t" . "Form type" . "\t" . "Part Family" . "\t" . "Part Number&Name" . "\t" . "Value" . "\t" . "Upper Tolerance" . "\t" . "Lower Tolerance" . "\t" . "Date" . "\t";
$p = "SPC Analytics Data From : " .datemdY($date_from). ' To : ' .datemdY($date_to);
while ($row = mysqli_fetch_row($exp)) {
    $line = '';
    $j = 1;
    foreach ($row as $value) {
        if ((!isset($value) ) || ( $value == "" )) {
            $value = "\t";
        } else {
            $value = str_replace('"', '""', $value);
            /*if ($j == 1) {
                $un = $value;
                $qur04 = mysqli_query($s_db, "SELECT data_item_value as data_item_value ,created_at as created_at FROM `spc_schedular_data` WHERE `data_item_id` = '$un' and created_at >= '$datefrom' and created_at <= '$dateto'");
                while ($rowc04 = mysqli_fetch_array($qur04)) {
                    $lnn = $rowc04['data_item_value'];
                }
                $value = $lnn;
            }*/
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
        $j++;
    }
    $result .= trim($line_name) . "\t" .trim($form_type) . "\t" .trim($part_family) . "\t" .trim($part_num) . "\t" . trim($line) ."\n";
}
$result = str_replace("\r", "", $result);
if ($result == "") {
    $result = "\nNo Record(s) Found!\n";
}
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename= spc_data.xls");
header("Pragma: no-cache");
header("Expires: 0");
print "\n\n" . $p . "\n\n" . $header . "\n" . $result;
?>
