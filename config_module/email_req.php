<?php
include("../config.php");
$form_type_id = $_POST['email_req'];
$email_req = $_POST['isChecked'];
if ($form_type_id != "") {

    if($email_req =='true') {
        $sql1 = "UPDATE  `form_type` set  email_req = 1  WHERE `form_type_id`='$form_type_id'";
    }else{
        $sql1 = "UPDATE  `form_type` set  email_req = 0  WHERE `form_type_id`='$form_type_id'";
    }
    if (mysqli_query($db, $sql1)) {
        $_SESSION['message_stauts_class'] = 'alert-success';
        $_SESSION['import_status_message'] = 'Required Sucessfully';
    } else {
        $_SESSION['message_stauts_class'] = 'alert-danger';
        $_SESSION['import_status_message'] = 'please retry.';
    }
}

header("Location:form_type.php");
?>
