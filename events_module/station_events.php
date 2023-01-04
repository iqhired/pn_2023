<?php include("../config.php");
$chicagotime = date("Y-m-d H:i:s");
$temp = "";
if (!isset($_SESSION['user'])) {
    if($_SESSION['is_tab_user'] || $_SESSION['is_cell_login']){
        header($redirect_tab_logout_path);
    }else{
        header($redirect_logout_path);
    }
}
//Set the session duration for 10800 seconds - 3 hours
$duration = $auto_logout_duration;
//Read the request time of the user
$time = $_SERVER['REQUEST_TIME'];
//Check the user's session exist or not
if (isset($_SESSION['LAST_ACTIVITY']) && ($time - $_SESSION['LAST_ACTIVITY']) > $duration) {
    //Unset the session variables
    session_unset();
    //Destroy the session
    session_destroy();
    if($_SESSION['is_tab_user'] || $_SESSION['is_cell_login']){
        header($redirect_tab_logout_path);
    }else{
        header($redirect_logout_path);
    }

//	header('location: ../logout.php');
    exit;
}
//Set the time of the user's last activity
$_SESSION['LAST_ACTIVITY'] = $time;
$is_tab_login = $_SESSION['is_tab_user'];
$is_cell_login = $_SESSION['is_cell_login'];
$i = $_SESSION["role_id"];
//if ($i != "super" && $i != "admin") {
//	header('location: ../line_status_overview_dashboard.php');
//}
$station_id = null;
$event_line = $_GET['line'];
$user_id = $_SESSION["id"];
$chicagotime = date("Y-m-d H:i:s");
if (count($_POST) > 0) {

    $station_id = $_POST['station'];
    if(($station_id == null || $station_id =='') && (($event_line != null) && ($event_line != ''))){
        $station_id = $event_line;
    }
    $part_family_id = $_POST['part_family'];
    $part_number = $_POST['part_number'];
    $event_type_id = $_POST['event_type_id'];
    $e_event_id = $_POST['edit_event_type'];
    $edit_event_id = explode("_",$e_event_id)[0];
    $station_event_id = $_POST['station_event_id'];
    $event_seq = $_POST['event_seq'];
    $event_total_time = $_POST['total_time'];

    // Edit Event
    if ($edit_event_id != "") {
        $reason =  $_POST['edit_reason'];
        $station_event_id = $_POST['edit_id'];

        /*Update the log table with the event value*/
        $sql = "select * from event_type where so = (select (MAX(so)) as max_seq_num from event_type)";
        $res = mysqli_query($db, $sql);
        $firstrow = mysqli_fetch_array($res);
        $max_seq = $firstrow['so'];
        $fr_event_type_id = $firstrow['event_type_id'];
        $event_status_lat = 1;

        $qur1 = "select (count(station_event_id)) as seq_num from sg_station_event_log WHERE station_event_id='$station_event_id'";
        $res = mysqli_query($db, $qur1);
        $firstrow = mysqli_fetch_array($res);
        $curr_seq = $firstrow['seq_num'];
        $next_seq = $curr_seq + 1;

        $qur2="Select SEC_TO_TIME(TIME_TO_SEC(TIMEDIFF('$chicagotime', created_on))) as completed_time from `sg_station_event_log` WHERE station_event_id = '$station_event_id' and event_seq = '$curr_seq'";
        $res = mysqli_query($db, $qur2);
        $firstrow = mysqli_fetch_array($res);
        $total_time = $firstrow['completed_time'];

        $qur22="Select event_cat_id as cat_id from `event_type` WHERE event_type_id = '$edit_event_id'";
        $res = mysqli_query($db, $qur22);
        $firstrow = mysqli_fetch_array($res);
        $event_cat_id = $firstrow['cat_id'];



        $qur3 = "update `sg_station_event_log` set total_time = '$total_time' , is_incomplete = '0' where station_event_id = '$station_event_id' and event_seq = '$curr_seq'";
        $result0 = mysqli_query($db, $qur3);



        $res_event = "select event_type_id from sg_station_event where station_event_id = '$station_event_id'";
        $sta_res = mysqli_query($db,$res_event);
        $event_row = mysqli_fetch_array($sta_res);
        $is_present = $event_row['event_type_id'];

        if ($is_present == '7' ){
            $message_stauts_class = 'alert-success';
            $import_status_message = 'Event cycle was already Ended.';
        }else{
            if ($edit_event_id == $fr_event_type_id) {
                $sql = "update sg_station_event set event_status = '0' ,event_type_id='$edit_event_id', modified_on='$chicagotime', modified_by='$user_id' where  station_event_id = '$station_event_id'";
                $result1 = mysqli_query($db, $sql);
                if ($result1) {
                    $message_stauts_class = 'alert-success';
                    $import_status_message = 'Event Cycle Completed for the Station.';
                } else {
                    $message_stauts_class = 'alert-danger';
                    $import_status_message = 'Error: Please Insert valid data';
                }

                $sql = "INSERT INTO `sg_station_event_log`(`station_event_id`  ,`reason`,`event_seq`, `event_type_id`,`event_cat_id`, `event_status` , `created_on` ,`created_by`) VALUES ('$station_event_id','$reason','$next_seq','$edit_event_id','$event_cat_id',0,'$chicagotime','$user_id')";
                $result0 = mysqli_query($db, $sql);



            } else {
                $sql = "update sg_station_event set event_type_id='$edit_event_id', reason='$reason' ,modified_on='$chicagotime', modified_by='$user_id' where  station_event_id = '$station_event_id'";
                $result1 = mysqli_query($db, $sql);
                if ($result1) {

                    $message_stauts_class = 'alert-success';
                    $import_status_message = 'Event status Updated successfully.';
                } else {
                    $message_stauts_class = 'alert-danger';
                    $import_status_message = 'Error: Please Insert valid data';
                }
                $sql = "INSERT INTO `sg_station_event_log`(`station_event_id` ,`reason`,`event_seq` , `event_type_id`,`event_cat_id`, `event_status` , `created_on` ,`created_by`) VALUES ('$station_event_id','$reason','$next_seq','$edit_event_id','$event_cat_id',1,'$chicagotime','$user_id')";
                $result0 = mysqli_query($db, $sql);


            }
        }
    } else {
        if (($part_number != "") && ($station_id != "") && ($part_family_id != "") && ($event_type_id != "")) {

//production cycle is already active code
            $sql_production = "select * from sg_station_event where line_id = '$station_id'  and event_status = '1'";
            $res_production = mysqli_query($db, $sql_production);
            $firstrow_production = mysqli_fetch_array($res_production);
//		$condition = $firstrow_production['station_event_id'];

            if ($firstrow_production) {
                $message_stauts_class = 'alert-danger';
                $import_status_message = 'Error: This Station already has an active event.';
            } else {

                $sql0 = "INSERT INTO `sg_station_event`(`line_id` , `part_family_id`, `part_number_id` , `event_type_id` ,`created_on`,`created_by`,`modified_on`,`modified_by`) VALUES ('$station_id','$part_family_id','$part_number','$event_type_id','$chicagotime','$user_id','$chicagotime','$user_id')";
                $result0 = mysqli_query($db, $sql0);
                $station_event_id = ($db->insert_id);

                if ($result0) {
                    $qur1 = "select (count(station_event_id)) as seq_num from sg_station_event_log WHERE station_event_id='$station_event_id'";
                    $res = mysqli_query($db, $qur1);
                    $firstrow = mysqli_fetch_array($res);
                    $curr_seq = $firstrow['seq_num'];
                    $next_seq = $curr_seq + 1;

//					$qq = "SELECT max(station_event_log_id)  as prev_log_id FROM `sg_station_event_log` as sl inner join sg_station_event as se on sl.station_event_id = se.station_event_id where se.line_id = '$station_id' and sl.event_status = 0 order by sl.created_on";
                    $qq = "SELECT max(station_event_log_id) as prev_log_id , sl.created_on as prev_st_time FROM `sg_station_event_log` as sl inner join sg_station_event as se on sl.station_event_id = se.station_event_id where se.line_id = '$station_id' and sl.event_status = 0 group by sl.created_on order by sl.created_on desc LIMIT 1";
                    $res = mysqli_query($db, $qq);
                    $firstrow = mysqli_fetch_array($res);
                    $prev_seq = $firstrow['prev_log_id'];
                    $prev_time = $firstrow['prev_st_time'];

                    $qur22="Select event_cat_id as cat_id from `event_type` WHERE event_type_id = '$event_type_id'";
                    $res = mysqli_query($db, $qur22);
                    $firstrow = mysqli_fetch_array($res);
                    $event_cat_id = $firstrow['cat_id'];

                    $qur2="Select SEC_TO_TIME(TIME_TO_SEC(TIMEDIFF('$chicagotime', '$prev_time'))) as completed_time";
                    $res = mysqli_query($db, $qur2);
                    $firstrow = mysqli_fetch_array($res);
                    $total_time = $firstrow['completed_time'];

                    $qur4 = "update `sg_station_event_log` set total_time = '$total_time' , is_incomplete = '0' where station_event_log_id = '$prev_seq'";
                    $result0 = mysqli_query($db, $qur4);


                    $sql0 = "INSERT INTO `sg_station_event_log`(`station_event_id` ,`event_seq`, `event_type_id`,`event_cat_id`, `event_status` , `created_on` ,`created_by`) VALUES ('$station_event_id','$next_seq','$event_type_id','$event_cat_id',1,'$chicagotime','$user_id')";
                    $result0 = mysqli_query($db, $sql0);




                    $message_stauts_class = 'alert-success';
                    $import_status_message = 'Station Event Created successfully.';
                } else {
                    $message_stauts_class = 'alert-danger';
                    $import_status_message = 'Error: Please Insert valid data';
                }

            }
        }
    }
}else{
    $station_id = $event_line;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo $sitename; ?> | Station Events</title>
    <!-- Global stylesheets -->

    <link href="../assets/css/core.css" rel="stylesheet" type="text/css">


    <!-- /global stylesheets -->
    <!-- Core JS files -->
    <!--    <script type="text/javascript" src="../assets/js/libs/jquery-3.6.0.min.js"> </script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- Theme JS files -->
    <script type="text/javascript" src="../assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="../assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="../assets/js/pages/datatables_basic.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/forms/selects/bootstrap_select.min.js"></script>
    <script type="text/javascript" src="../assets/js/pages/form_bootstrap_select.js"></script>
    <script type="text/javascript" src="../assets/js/pages/form_layouts.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/ui/ripple.min.js"></script>

    <!--Internal  Datetimepicker-slider css -->
    <link href="<?php echo $siteURL; ?>assets/css/form_css/amazeui.datetimepicker.css" rel="stylesheet">
    <link href="<?php echo $siteURL; ?>assets/css/form_css/jquery.simple-dtpicker.css" rel="stylesheet">
    <link href="<?php echo $siteURL; ?>assets/css/form_css/picker.min.css" rel="stylesheet">
    <!--Bootstrap-datepicker css-->
    <link rel="stylesheet" href="<?php echo $siteURL; ?>assets/css/form_css/bootstrap-datepicker.css">
    <!-- Internal Select2 css -->
    <link href="<?php echo $siteURL; ?>assets/css/form_css/select2.min.css" rel="stylesheet">
    <!-- STYLES CSS -->
    <link href="<?php echo $siteURL; ?>assets/css/form_css/style.css" rel="stylesheet">
    <link href="<?php echo $siteURL; ?>assets/css/form_css/style-dark.css" rel="stylesheet">
    <link href="<?php echo $siteURL; ?>assets/css/form_css/style-transparent.css" rel="stylesheet">
    <!---Internal Fancy uploader css-->
    <link href="<?php echo $siteURL; ?>assets/css/form_css/fancy_fileupload.css" rel="stylesheet" />
    <!--Internal  Datepicker js -->
    <script src="<?php echo $siteURL; ?>assets/js/form_js/datepicker.js"></script>
    <!-- Internal Select2.min js -->
    <!--Internal  jquery.maskedinput js -->
    <script src="<?php echo $siteURL; ?>assets/js/form_js/jquery.maskedinput.js"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="<?php echo $siteURL; ?>assets/js/form_js/spectrum.js"></script>
    <!--Internal  jquery-simple-datetimepicker js -->
    <script src="<?php echo $siteURL; ?>assets/js/form_js/datetimepicker.min.js"></script>
    <!-- Ionicons js -->
    <script src="<?php echo $siteURL; ?>assets/js/form_js/jquery.simple-dtpicker.js"></script>
    <!--Internal  pickerjs js -->
    <script src="<?php echo $siteURL; ?>assets/js/form_js/picker.min.js"></script>
    <!--internal color picker js-->
    <script src="<?php echo $siteURL; ?>assets/js/form_js/pickr.es5.min.js"></script>
    <script src="<?php echo $siteURL; ?>assets/js/form_js/colorpicker.js"></script>
    <!--Bootstrap-datepicker js-->
    <script src="<?php echo $siteURL; ?>assets/js/form_js/bootstrap-datepicker.js"></script>
    <script src="<?php echo $siteURL; ?>assets/js/form_js/select2.min.js"></script>
    <!-- Internal form-elements js -->
    <script src="<?php echo $siteURL; ?>assets/js/form_js/form-elements.js"></script>
    <link href="<?php echo $siteURL; ?>assets/js/form_js/demo.css" rel="stylesheet"/>

    <style>
        .navbar {

            padding-top: 0px!important;
        }
        .dropdown .arrow {

            margin-top: -25px!important;
            width: 1.5rem!important;
        }
        #ic .arrow {
            margin-top: -22px!important;
            width: 1.5rem!important;
        }
        .fs-6 {
            font-size: 1rem!important;
        }

        .content_img {
            width: 113px;
            float: left;
            margin-right: 5px;
            border: 1px solid gray;
            border-radius: 3px;
            padding: 5px;
            margin-top: 10px;
        }

        /* Delete */
        .content_img span {
            border: 2px solid red;
            display: inline-block;
            width: 99%;
            text-align: center;
            color: red;
        }
        .remove_btn{
            float: right;
        }
        .contextMenu{ position:absolute;  width:min-content; left: 204px; background:#e5e5e5; z-index:999;}
        .collapse.in {
            display: block!important;
        }
        .mt-4 {
            margin-top: 0rem!important;
        }
        .row-body {
            display: flex;
            flex-wrap: wrap;
            margin-left: -8.75rem;
            margin-right: 6.25rem;
        }
        @media (min-width: 320px) and (max-width: 480px) {
            .row-body {

                margin-left: 0rem;
                margin-right: 0rem;
            }
        }

        @media (min-width: 481px) and (max-width: 768px) {
            .row-body {

                margin-left: -15rem;
                margin-right: 0rem;
            }
            .col-md-1 {
                flex: 0 0 8.33333%;
                max-width: 10.33333%!important;
            }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .row-body {

                margin-left:-15rem;
                margin-right: 0rem;
            }

        }


        table.dataTable thead .sorting:after {
            content: ""!important;
            top: 49%;
        }
        .card-title:before{
            width: 0;

        }
        .main-content .container, .main-content .container-fluid {
            padding-left: 20px;
            padding-right: 238px;
        }
        .main-footer {
            margin-left: -127px;
            margin-right: 112px;
            display: block;
        }

        a.btn.btn-success.btn-sm.br-5.me-2.legitRipple {
            height: 32px;
            width: 32px;
        }
        .badge {
            padding: 0.5em 0.5em!important;
            width: 100px;
            height: 23px;
        }

    </style>
</head>

<!-- Main navbar -->
<?php
$cust_cam_page_header = "Station Events";
include("../header.php");
include("../admin_menu.php");
?>

<body class="ltr main-body app sidebar-mini">
<!-- main-content -->
<div class="main-content app-content">
    <!-- container -->
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Events</a></li>
                <li class="breadcrumb-item active" aria-current="page">Station Events</li>
            </ol>
        </div>
    </div>
    <form action="" id="station_event_form" class="form-horizontal" method="post">
        <div class="row-body">
            <div class="col-lg-12 col-md-12">
                <?php
                if (!empty($import_status_message)) {
                    echo '<div class="alert ' . $message_stauts_class . '">' . $import_status_message . '</div>';
                }
                ?>
                <?php
                if (!empty($_SESSION['import_status_message'])) {
                    echo '<div class="alert ' . $_SESSION['message_stauts_class'] . '">' . $_SESSION['import_status_message'] . '</div>';
                    $_SESSION['message_stauts_class'] = '';
                    $_SESSION['import_status_message'] = '';
                }
                ?>
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">Station Events</span>
                        </div>
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-1">
                                    <label class="form-label mg-b-0">Station * : </label>
                                </div>
                                <div class="col-md-5 mg-t-10 mg-md-t-0">
                                    <select name="station" id="station" class="form-control form-select select2" data-bs-placeholder="Select Station">
                                        <option value="" selected disabled>--- Select Station ---</option>
                                        <option value="" selected disabled>--- Select Station ---</option>
                                        <?php
                                        if($is_tab_login){
                                            $station_id=$tab_line;
                                            $sql1 = "SELECT line_id,line_name FROM `cam_line`  where enabled = '1' and line_id = '$tab_line' and is_deleted != 1 ORDER BY `line_name` ASC";
                                            $result1 = $mysqli->query($sql1);
                                            //                                            $entry = 'selected';
                                            while ($row1 = $result1->fetch_assoc()) {
                                                $entry = 'selected';
                                                echo "<option value='" . $row1['line_id'] . "'  $entry>" . $row1['line_name'] . "</option>";
                                            }
                                        }else if($is_cell_login){
                                            if(empty($_REQUEST)){
                                                $c_stations = implode("', '", $c_login_stations_arr);
                                                $sql1 = "SELECT line_id,line_name FROM `cam_line`  where enabled = '1' and line_id IN ('$c_stations') and is_deleted != 1 ORDER BY `line_name` ASC";
                                                $result1 = $mysqli->query($sql1);
//													                $                        $entry = 'selected';
                                                $i = 0;
                                                while ($row1 = $result1->fetch_assoc()) {
//														$entry = 'selected';
                                                    if($i == 0 ){
                                                        $entry = 'selected';
                                                        $station = $row1['line_id'];
                                                        echo "<option value='" . $station . "'  $entry>" . $row1['line_name'] . "</option>";

                                                    }else{
                                                        echo "<option value='" . $row1['line_id'] . "'  >" . $row1['line_name'] . "</option>";

                                                    }
                                                    $i++;
                                                }
                                            }else{
                                                $line_id = $_REQUEST['line'];
                                                if(empty($line_id)){
                                                    $line_id = $_REQUEST['station'];
                                                }
                                                $sql1 = "SELECT line_id,line_name FROM `cam_line`  where enabled = '1' and line_id ='$line_id' and is_deleted != 1";
                                                $result1 = $mysqli->query($sql1);
//
                                                while ($row1 = $result1->fetch_assoc()) {
//
                                                    $entry = 'selected';
                                                    $station = $row1['line_id'];
                                                    echo "<option value='" . $station . "'  $entry>" . $row1['line_name'] . "</option>";

                                                }
                                            }

                                        }else{
                                            $station = $station_id;
                                            $sql1 = "SELECT * FROM `cam_line` where enabled = '1' and is_deleted != 1 ORDER BY `line_name` ASC";
                                            $result1 = $mysqli->query($sql1);
                                            while ($row1 = $result1->fetch_assoc()) {
                                                $lid = $row1['line_id'];
                                                if ($station == $lid) {
                                                    $station = $lid;
                                                    $entry = 'selected';
                                                } else {
                                                    $entry = '';

                                                }
                                                echo "<option value='" . $row1['line_id'] . "' $entry >" . $row1['line_name'] . "</option>";
                                            }
                                        }

                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Part Family  : </label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <select name="part_family" id="part_family" class="form-control form-select select2" data-bs-placeholder="Select Country">
                                        <option value="" selected disabled>--- Select Part Family ---</option>
                                        <?php
                                        if(empty($station)){
                                            $station = $station_id;
                                        }
                                        $part_family = $_POST['part_family'];
                                        if(empty($part_family) && !empty($_REQUEST['part_family'])){
                                            $part_family = $_REQUEST['part_family'];
                                        }
                                        $sql1 = "SELECT * FROM `pm_part_family` where is_deleted != 1 and station = '$station' ORDER BY `part_family_name` ASC";
                                        $result1 = $mysqli->query($sql1);
                                        //                                            $entry = 'selected';
                                        while ($row1 = $result1->fetch_assoc()) {
                                            if ($part_family == $row1['pm_part_family_id']) {
                                                $entry = 'selected';
                                            } else {
                                                $entry = '';

                                            }
                                            echo "<option value='" . $row1['pm_part_family_id'] . "'  $entry>" . $row1['part_family_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Part Number  : </label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <select name="part_number" id="part_number" class="form-control form-select select2" data-bs-placeholder="Select Country">
                                        <option value="" selected disabled>--- Select Part Number ---</option>
                                        <?php
                                        $part_number = $_POST['part_number'];
                                        if(empty($part_number) && !empty($_REQUEST['part_number'])){
                                            $part_number = $_REQUEST['part_number'];
                                        }
                                        $sql1 = "SELECT * FROM `pm_part_number` where part_family = '$part_family' and is_deleted != 1  ORDER BY `part_name` ASC";
                                        $result1 = $mysqli->query($sql1);
                                        //                                            $entry = 'selected';
                                        while ($row1 = $result1->fetch_assoc()) {
                                            if ($part_number == $row1['pm_part_number_id']) {
                                                $entry = 'selected';
                                            } else {
                                                $entry = '';

                                            }
                                            echo "<option value='" . $row1['pm_part_number_id'] . "' $entry >" . $row1['part_number'] . " - " . $row1['part_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Event Type  : </label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <select name="event_type_id" id="event_type_id" class="form-control form-select select2" data-bs-placeholder="Select Country">
                                        <option value="" selected disabled>--- Select Event Type ---</option>
                                        <?php
                                        $event_type_id = $_POST['event_type_id'];

                                        //$sql1 = "SELECT * FROM `event_type` ORDER BY `event_type_name` ASC";
                                        //												$sql1 = "SELECT event_type_id , FIND_IN_SET('$station', stations) AS result from `event_type` ORDER BY so ASC";
                                        $sql1 = "SELECT event_type_id ,event_type_name, FIND_IN_SET('$station', stations) from `event_type` where FIND_IN_SET('$station', stations) IS NOT NULL and FIND_IN_SET('$station', stations) > 0 and is_deleted != 1 ORDER BY so ASC";
                                        $result1 = $mysqli->query($sql1);
                                        if ($result1 != null) {
                                            $count = $result1->num_rows;
                                            //                                            $entry = 'selected';
                                            while ($row1 = $result1->fetch_assoc()) {
                                                if ($event_type_id == $row1['event_type_id']) {
                                                    $entry = 'selected';
                                                } else {
                                                    $entry = '';

                                                }
                                                if ($count == 1) {
                                                    echo "<option disabled value='" . $row1['event_type_id'] . "' $entry >" . $row1['event_type_name'] . "</option>";
                                                } else {
                                                    echo "<option value='" . $row1['event_type_id'] . "' $entry >" . $row1['event_type_name'] . "</option>";

                                                }
                                                $count = $count - 1;
                                            }
                                        }

                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary mg-t-5 submit_btn">Create Station Event</button>
                                    <button type="button" class="btn btn-primary mg-t-5" onclick="window.location.reload();">Reset</button>
                                </div>
                            </div>
                        </div>
    </form>
</div>
</div>
</div>
</div>
<!-- row  -->
<?php
if(count($_POST) > 0)
{
    ?>
    <div class="row-body">

        <div class="col-12 col-sm-12">
            <div class="card">

                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table  table-bordered text-nowrap mb-0" id="example2">
                            <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Actions</th>
                                <th>Station</th>
                                <th>Part Family</th>
                                <th>Part Number</th>
                                <th>Event Type</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query = sprintf("SELECT * FROM  sg_station_event  where event_status = 1 and line_id = '$station' order by modified_on DESC ;  ");
                            $qur = mysqli_query($db, $query);
                            while ($rowc = mysqli_fetch_array($qur)) {

                                $station_event_id = $rowc['station_event_id'];
                                $station_id = $rowc['line_id'];
                                $qurtemp = mysqli_query($db, "SELECT * FROM  cam_line where line_id  = '$station_id' ");
                                while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                                    $station_name = $rowctemp["line_name"];
                                }
                                $part_family_id = $rowc['part_family_id'];
                                $qurtemp = mysqli_query($db, "SELECT * FROM  pm_part_family where pm_part_family_id  = '$part_family_id' ");
                                while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                                    $part_family_name = $rowctemp["part_family_name"];
                                }
                                $part_number_id = $rowc['part_number_id'];
                                $qurtemp = mysqli_query($db, "SELECT * FROM  pm_part_number where pm_part_number_id  = '$part_number_id' ");
                                while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                                    $part_number = $rowctemp["part_number"];
                                }
                                $event_type_id = $rowc['event_type_id'];
                                $qurtemp = mysqli_query($db, "SELECT * FROM  event_type where event_type_id  = '$event_type_id' ");
                                while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                                    $event_type_name = $rowctemp["event_type_name"];
                                    $event_cat_id = $rowctemp["event_cat_id"];
                                }
                                ?>
                                <tr>
                                    <td><?php echo ++$counter; ?></td>
                                    <td>
                                        <button type="button" id="edit" class="btn btn-info btn-xs"
                                                data-id="<?php echo $station_event_id ?>"
                                                data-station="<?php echo $station_id ?>"
                                                data-part_family="<?php echo $part_family_id ?>"
                                                data-part_number="<?php echo $part_number_id ?>"
                                                data-event_type_id="<?php echo $event_type_id ."_".$event_cat_id ?>"
                                                data-reason=""
                                                data-toggle="modal"
                                                data-target="#edit_modal_theme_primary">Update
                                        </button>
                                    </td>
                                    <td><?php echo $station_name; ?></td>
                                    <td><?php echo $part_family_name; ?></td>
                                    <td><?php echo $part_number; ?></td>
                                    <td><?php echo $event_type_name; ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="edit_modal_theme_primary" class="modal col-lg-12 col-md-12">
        <div class="modal-dialog" style="width: 1180px!important;">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h6 class="modal-title">
                        Update Event Status
                    </h6>
                </div>
                <form action="" id="edit_station_event_form" enctype="multipart/form-data" class="form-horizontal"
                      method="post">
                    <div class="card-body" style="">
                            <div class="col-lg-12 col-md-12">
                                <div class="pd-30 pd-sm-20">
                                    <div class="row row-xs">
                                        <div class="col-md-4">
                                            <label class="form-label mg-b-0">Station  : </label>
                                        </div>
                                        <div class="col-md-8 mg-t-10 mg-md-t-0">
                                        <select name="edit_station" id="edit_station"
                                                class="form-control f_disabled" disabled>
                                            <option value="" selected disabled>--- Select Station ---</option>
                                            <?php
                                            $sql1 = "SELECT * FROM `cam_line` ORDER BY `line_name` ASC ";
                                            $result1 = $mysqli->query($sql1);
                                            while ($row1 = $result1->fetch_assoc()) {
                                                echo "<option value='" . $row1['line_id'] . "'  >" . $row1['line_name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="pd-30 pd-sm-20">
                                    <div class="row row-xs">
                                        <div class="col-md-4">
                                            <label class="form-label mg-b-0">Part Family * :</label>
                                        </div>
                                        <div class="col-md-8 mg-t-10 mg-md-t-0">
                                            <select name="edit_part_family" id="edit_part_family"
                                                    class="form-control f_disabled" disabled>
                                                <option value="" selected disabled>--- Select Part Family ---
                                                </option>
                                                <?php
                                                $sql1 = "SELECT * FROM `pm_part_family` ORDER BY `part_family_name` ASC ";
                                                $result1 = $mysqli->query($sql1);
                                                //                                            $entry = 'selected';
                                                while ($row1 = $result1->fetch_assoc()) {
                                                    echo "<option value='" . $row1['pm_part_family_id'] . "'  >" . $row1['part_family_name'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="pd-30 pd-sm-20">
                                    <div class="row row-xs">
                                        <div class="col-md-4">
                                            <label class="form-label mg-b-0">Part Number  :</label>
                                        </div>
                                        <div class="col-md-8 mg-t-10 mg-md-t-0">
                                            <select name="edit_part_number" id="edit_part_number"
                                                    class="form-control f_disabled" disabled>
                                                <option value="" selected disabled>--- Select Part Number ---
                                                </option>
                                                <?php
                                                $sql1 = "SELECT * FROM `pm_part_number` ORDER BY `part_number` ASC ";
                                                $result1 = $mysqli->query($sql1);
                                                while ($row1 = $result1->fetch_assoc()) {
                                                    echo "<option value='" . $row1['pm_part_number_id'] . "'  >" . $row1['part_number'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="pd-30 pd-sm-20">
                                    <div class="row row-xs">
                                        <div class="col-md-4">
                                            <label class="form-label mg-b-0">Event Type * :</label>
                                        </div>
                                        <div class="col-md-8 mg-t-10 mg-md-t-0">
                                            <select name="edit_event_type" id="edit_event_type"
                                                    class="form-control">
                                                <!-- <option value="" disabled>--- Select Event Type ----->
                                                <!-- </option>-->
                                                <?php
                                                $sql1 = "SELECT event_type_id ,event_cat_id,event_type_name, FIND_IN_SET('$station_id', stations) from `event_type` where FIND_IN_SET('$station_id', stations) IS NOT NULL and FIND_IN_SET('$station_id', stations) > 0 ORDER BY so ASC";
                                                $result1 = $mysqli->query($sql1);
                                                while ($row1 = $result1->fetch_assoc()) {
                                                    echo "<option value='" . $row1['event_type_id'] ."_".$row1['event_cat_id']. "'  >" . $row1['event_type_name'] . "</option>";

                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="reason_div">
                            </div>


                            <input type="hidden" name="edit_id" id="edit_id">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                            <button type="submit" id="edit_save" class="btn btn-primary ">Save</button>
                        </div>
                            </div>
                </form>
            </div>
        </div>
    </div>
    <?php
}
?>
<script>
    $("#edit_save").click(function (e) {
        if ($("#edit_station_event_form")[0].checkValidity()){
        }
    });
    $(document).on('click', '#delete', function () {
        var element = $(this);
        var del_id = element.attr("data-id");
        var info = 'id=' + del_id;
        $.ajax({
            type: "POST", url: "ajax_delete.php", data: info, success: function (data) {
            }
        });
        $(this).parents("tr").animate({backgroundColor: "#003"}, "slow").animate({opacity: "hide"}, "slow");
    });
</script>
<script>
    jQuery(document).ready(function ($) {
        $(document).on('click', '#edit', function () {
            var element = $(this);
            var edit_id = $(this).data("id");
            var station = $(this).data("station");
            var part_family = $(this).data("part_family");
            var part_number = $(this).data("part_number");
            var event_type = $(this).data("event_type_id");
            var reason = $(this).data("reason");
            $("#edit_station").val(station);
            $("#edit_part_family").val(part_family);
            $("#edit_part_number").val(part_number);
            $("#edit_event_type").val(event_type);
            $("#edit_id").val(edit_id);
            $("#edit_reason").val(reason);
        });
    });
</script>

<script>
    $('#edit_event_type').on('change', function () {

        var selected_val = this.value.split("_")[1];
        if (selected_val == 3) {
            document.getElementById("reason_div").innerHTML +="<div class=\"col-md-12\">\n" +
                "                                        <div class=\"form-group\">\n" +
                "                                            <label class=\"col-lg-4 control-label\">Reason * :</label>\n" +
                "                                            <div class=\"col-lg-8\">\n" +
                "                                                <textarea id=\"edit_reason\" name=\"edit_reason\" rows=\"2\" class=\"form-control\" required></textarea>\n" +
                "                                            </div>\n" +
                "                                        </div>\n" +
                "                                    </div>";
        } else {
            document.getElementById("reason_div").innerHTML ="";
        }
    });
</script>

<script>
    window.onload = function () {
        history.replaceState("", "", "<?php echo $scriptName; ?>events_module/station_events.php");
    }
</script>
<script>
    $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
    $('#generate').click(function () {
        let r = Math.random().toString(36).substring(7);
        $('#newpass').val(r);
    })

    function submitForm(url) {
        $(':input[type="button"]').prop('disabled', true);
        var data = $("#update-form").serialize();
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function (data) {
                // window.location.href = window.location.href + "?aa=Line 1";
                $(':input[type="button"]').prop('disabled', false);
                location.reload();
            }
        });
    }

    function submitForm11(url) {
        $(':input[type="button"]').prop('disabled', true);
        var data = $("#update-form").serialize();
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function (data) {
                // window.location.href = window.location.href + "?aa=Line 1";
                $(':input[type="button"]').prop('disabled', false);
                location.reload();
            }
        });
    }

    function submitForm12(url) {
        $(':input[type="button"]').prop('disabled', true);
        var data = $("#update-form").serialize();
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function (data) {
                // window.location.href = window.location.href + "?aa=Line 1";
                $(':input[type="button"]').prop('disabled', false);
                location.reload();
            }
        });
    }

    $('#choose').on('change', function () {
        var selected_val = this.value;
        if (selected_val == 4 || selected_val == 10) {
            $("#reason_div").show();
        } else {
            $("#reason_div").hide();
        }
    });


    $('#station').on('change', function (e) {
        $("#station_event_form").submit();
    });
    $('#part_family').on('change', function (e) {
        $("#station_event_form").submit();
    });
    $('#part_number').on('change', function (e) {
        $("#station_event_form").submit();
    });
    $(document).on("click",".submit_btn",function() {
        var station = $("#station").val();
        var part_family = $("#part_family").val();
        var part_number = $("#part_number").val();
        var event_type_id = $("#event_type_id").val();
    });
</script>
<script type="text/javascript">
    $(function () {
        $("#btn").bind("click", function () {
            $("#station")[0].selectedIndex = 0;
            $("#part_family")[0].selectedIndex = 0;
            $("#part_number")[0].selectedIndex = 0;
            $("#event_type_id")[0].selectedIndex = 0;
        });
    });
</script>
<?php include('../footer1.php') ?>
</body>