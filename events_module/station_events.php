<?php include("../config.php");
$chicagotime = date("Y-m-d H:i:s");
$temp = "";
checkSession();
$is_tab_login = $_SESSION['is_tab_user'];
$is_cell_login = $_SESSION['is_cell_login'];
$i = $_SESSION["role_id"];
$cellID = $_GET['cell_id'];
$c_name = $_GET['c_name'];
$station_id = null;
$event_line = $_GET['station'];
if (($station_id == null || $station_id == '') && (($event_line != null) && ($event_line != ''))) {
	$station_id = $event_line;
}
$part_family_id = $_GET['part_family'];

//check the station is line-up or line-down
$sqlc = "SELECT * FROM `sg_station_event` WHERE `line_id` = '$event_line' ORDER BY station_event_id DESC limit 1";
$resc = mysqli_query($db, $sqlc);
$rowc = mysqli_fetch_array($resc);
$event_type_id = $rowc['event_type_id'];
$e_type_id = $event_type_id;
$user_id = $_SESSION["id"];
$chicagotime = date("Y-m-d H:i:s");
if (count($_POST) > 0) {
if(isset($_POST['submit_btn'])) {
    $station_id = $_POST['station'];
    if (($station_id == null || $station_id == '') && (($event_line != null) && ($event_line != ''))) {
        $station_id = $event_line;
    }
    $part_family_id = $_POST['part_family'];
    $part_number = $_POST['part_number'];
    $event_type_id = $_POST['event_type_id'];
    $e_event_id = $_POST['edit_event_type'];
    $edit_event_id = explode("_", $e_event_id)[0];
    $station_event_id = $_POST['station_event_id'];
    $event_seq = $_POST['event_seq'];
    $event_total_time = $_POST['total_time'];

    // Edit Event
    if ($edit_event_id != "") {
        $reason = $_POST['edit_reason'];
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

        $qur2 = "Select SEC_TO_TIME(TIME_TO_SEC(TIMEDIFF('$chicagotime', created_on))) as completed_time from `sg_station_event_log` WHERE station_event_id = '$station_event_id' and event_seq = '$curr_seq'";
        $res = mysqli_query($db, $qur2);
        $firstrow = mysqli_fetch_array($res);
        $total_time = $firstrow['completed_time'];

        $qur22 = "Select event_cat_id as cat_id from `event_type` WHERE event_type_id = '$edit_event_id'";
        $res = mysqli_query($db, $qur22);
        $firstrow = mysqli_fetch_array($res);
        $event_cat_id = $firstrow['cat_id'];


        $qur3 = "update `sg_station_event_log` set total_time = '$total_time' , is_incomplete = '0' where station_event_id = '$station_event_id' and event_seq = '$curr_seq'";
        $result0 = mysqli_query($db, $qur3);


        $res_event = "select event_type_id from sg_station_event where station_event_id = '$station_event_id'";
        $sta_res = mysqli_query($db, $res_event);
        $event_row = mysqli_fetch_array($sta_res);
        $is_present = $event_row['event_type_id'];

        /*if ($is_present == '7') {
            $message_stauts_class = 'alert-success';
            $import_status_message = 'Event cycle was already Ended.';
        } else {*/
          /*  if ($edit_event_id == $fr_event_type_id) {
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


            } else {*/
                /* $sql = "update sg_station_event set event_type_id='$edit_event_id', reason='$reason' ,modified_on='$chicagotime', modified_by='$user_id' where  station_event_id = '$station_event_id'";
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
 */

            /*}*/
     /*   }*/
    } else {
        if (($part_number != "") && ($station_id != "") && ($part_family_id != "") && ($event_type_id != "")) {

//production cycle is already active code
            $sql_production = "select * from sg_station_event where line_id = '$station_id'  and event_status = '1' and event_type_id != 7;";
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
                    $sql0 = "insert into form_frequency_data(`station_event_id`,`line_up_time`,`up_time`,`event_type_id`) values ('$station_event_id','$chicagotime','$ttime','$event_type_id')";
                    $result0 = mysqli_query($db, $sql0);

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

                    $qur22 = "Select event_cat_id as cat_id from `event_type` WHERE event_type_id = '$event_type_id'";
                    $res = mysqli_query($db, $qur22);
                    $firstrow = mysqli_fetch_array($res);
                    $event_cat_id = $firstrow['cat_id'];

                    $qur2 = "Select SEC_TO_TIME(TIME_TO_SEC(TIMEDIFF('$chicagotime', '$prev_time'))) as completed_time";
                    $res = mysqli_query($db, $qur2);
                    $firstrow = mysqli_fetch_array($res);
                    $total_time = $firstrow['completed_time'];

                    $qur4 = "update `sg_station_event_log` set total_time = '$total_time' , is_incomplete = '0' where station_event_log_id = '$prev_seq'";
                    $result0 = mysqli_query($db, $qur4);


                    $sql0 = "INSERT INTO `sg_station_event_log`(`station_event_id` ,`event_seq`, `event_type_id`,`event_cat_id`, `event_status` , `created_on` ,`created_by`) VALUES ('$station_event_id','$next_seq','$event_type_id','$event_cat_id',1,'$chicagotime','$user_id')";
                    $result0 = mysqli_query($db, $sql0);


                    $message_stauts_class = 'alert-success';
                    $import_status_message = 'Station Event Created successfully.';
					$uuu = site_URL . "events_module/station_events.php?cell_id=".$cellID."&c_name=".$c_name."&station=".$station_id."&part_family=".$part_family_id."&part_number=".$part_number."&station_event_id=".$station_event_id;
					header("Location:".$uuu);
                } else {
                    $message_stauts_class = 'alert-danger';
                    $import_status_message = 'Error: Please Insert valid data';
                }

            }
        }
    }
}
}else{
    $station_id = $event_line;
}
if(isset($_POST['update_btn'])){
    $station_id = $_POST['station'];
    if(($station_id == null || $station_id =='') && (($event_line != null) && ($event_line != ''))){
        $station_id = $event_line;
    }
    $part_family_id = $_POST['part_family'];
    $part_number = $_POST['part_number'];
    $event_type_id = $_POST['event_type_id'];
    $station_event_id = $_GET['station_event_id'];
      if($event_type_id == 7){
                $sql = "update sg_station_event set event_status = '0' ,event_type_id='$event_type_id', modified_on='$chicagotime', modified_by='$user_id' where  station_event_id = '$station_event_id'";
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
        $sql11 = "update sg_station_event set event_type_id='$event_type_id', reason='$reason' ,modified_on='$chicagotime', modified_by='$user_id' where  station_event_id = '$station_event_id'";
        $result11 = mysqli_query($db, $sql11);
        if ($result11) {
            $message_stauts_class = 'alert-success';
            $import_status_message = 'Event Station Updated Successfully.';
        } else {
            $message_stauts_class = 'alert-danger';
            $import_status_message = 'Error: Please Insert valid data';
        }

        $sql111 = "INSERT INTO `sg_station_event_log`(`station_event_id` ,`reason`,`event_seq` , `event_type_id`,`event_cat_id`, `event_status` , `created_on` ,`created_by`) VALUES ('$station_event_id','$reason','$next_seq','$edit_event_id','$event_cat_id',1,'$chicagotime','$user_id')";
        $result0 = mysqli_query($db, $sql111);
    }
    /*if($event_type_id == 7){
        $uuu = site_URL . "events_module/station_events.php?cell_id=".$cellID."&c_name=".$c_name."&station=".$station_id."&part_family=&part_number=&station_event_id=";
        header("Location:".$uuu);
    }else{
        $uuu = site_URL . "events_module/station_events.php?cell_id=".$cellID."&c_name=".$c_name."&station=".$station_id."&part_family=".$part_family_id."&part_number=".$part_number."&station_event_id=".$station_event_id;
        header("Location:".$uuu);
    }*/
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
    <link href="../assets/css/core.css" rel="stylesheet" type="text/css">
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



        table.dataTable thead .sorting:after {
            content: ""!important;
            top: 49%;
        }
        .card-title:before{
            width: 0;

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
        @media (min-width: 614px) and (max-width: 874px) {
            .col-md-1 {
                max-width: 180px!important;
            }
            .col-md-4.mg-t-10.mg-md-t-0{
                max-width: 300px;
            }
            .col-md-1.media {
                max-width: 0px!important;
                display: none!important;
            }
            .col-md-4.mg-t-10.mg-md-t-0.query{
                max-width: 300px!important;
            }
        }
        @media (min-width: 768px) and (max-width: 1024px) {
            .col-md-1 {
                margin-top: -30px;
                max-width: 16.33333%!important;
            }
            .col-md-1.media{
                display: none!important;
            }
            .col-md-4.mg-t-10.mg-md-t-0{
                max-width: 300px;
                margin-left: 215px;
                margin-top: -30px;
                margin-bottom: 66px;
            }
            .row {
                display: grid;
                margin-bottom: -63px;
            }
            .col-md-4.mg-t-10.mg-md-t-0.query {
                margin-left: 215px;
                margin-top: -57px;
            }
            .col-md-1#ex {
                margin-top: -56px;
            }
        }
        @media (min-width: 320px) and (max-width: 480px) {
            .col-md-1 {
                max-width: 180px!important;
            }
            .col-md-4.mg-t-10.mg-md-t-0{
                max-width: 300px;
            }
            .col-md-1.media {
                max-width: 0px!important;
                display: none!important;
            }
            .col-md-4.mg-t-10.mg-md-t-0.query{
                max-width: 300px!important;
            }
            .col-md-1 {
                margin-top: -30px;
                max-width: 16.33333%!important;
            }
            .col-md-1.media{
                display: none!important;
            }
            .col-md-4.mg-t-10.mg-md-t-0{
                max-width: 300px;
                margin-left: 215px;
                margin-top: -30px;
                margin-bottom: 66px;
            }
            .row {
                display: grid;
                margin-bottom: -63px;
            }
            .col-md-4.mg-t-10.mg-md-t-0.query {
                margin-left: 215px;
                margin-top: -57px;
            }
            .col-md-1#ex {
                margin-top: -56px;
            }

        }

        @media (min-width: 481px) and (max-width: 768px) {
            .col-md-1 {
                max-width: 180px!important;
            }
            .col-md-4.mg-t-10.mg-md-t-0{
                max-width: 300px;
            }
            .col-md-1.media {
                max-width: 0px!important;
                display: none!important;
            }
            .col-md-4.mg-t-10.mg-md-t-0.query{
                max-width: 300px!important;
            }
            .col-md-1 {
                margin-top: -30px;
                max-width: 16.33333%!important;
            }
            .col-md-1.media{
                display: none!important;
            }
            .col-md-4.mg-t-10.mg-md-t-0{
                max-width: 300px;
                margin-left: 215px;
                margin-top: -30px;
                margin-bottom: 66px;
            }
            .row {
                display: grid;
                margin-bottom: -63px;
            }
            .col-md-4.mg-t-10.mg-md-t-0.query {
                margin-left: 215px;
                margin-top: -57px;
            }
            .col-md-1#ex {
                margin-top: -56px;
            }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .col-md-1 {
                max-width: 180px!important;
            }
            .col-md-4.mg-t-10.mg-md-t-0{
                max-width: 300px;
            }
            .col-md-1.media {
                max-width: 0px!important;
                display: none!important;
            }
            .col-md-4.mg-t-10.mg-md-t-0.query{
                max-width: 300px!important;
            }
            .col-md-1 {
                margin-top: -30px;
                max-width: 16.33333%!important;
            }
            .col-md-1.media{
                display: none!important;
            }
            .col-md-4.mg-t-10.mg-md-t-0{
                max-width: 300px;
                margin-left: 215px;
                margin-top: -30px;
                margin-bottom: 66px;
            }
            .row {
                display: grid;
                margin-bottom: -63px;
            }
            .col-md-4.mg-t-10.mg-md-t-0.query {
                margin-left: 215px;
                margin-top: -57px;
            }
            .col-md-1#ex {
                margin-top: -56px;
            }
        }

        @media (min-width: 482px) and (max-width: 767px) {
            .col-md-1 {
                max-width: 180px!important;
            }
            .col-md-4.mg-t-10.mg-md-t-0{
                max-width: 300px;
            }
            .col-md-1.media {
                max-width: 0px!important;
                display: none!important;
            }
            .col-md-4.mg-t-10.mg-md-t-0.query{
                max-width: 300px!important;
            }
            .col-md-1 {
                margin-top: -30px;
                max-width: 19.33333%!important;
            }
            .col-md-1.media{
                display: none!important;
            }
            .col-md-4.mg-t-10.mg-md-t-0{
                max-width: 300px;
                margin-left: 215px;
                margin-top: -30px;
                margin-bottom: 66px;
            }
            .row {
                display: grid;
                margin-bottom: -63px;
            }
            .col-md-4.mg-t-10.mg-md-t-0.query {
                margin-left: 215px;
                margin-top: -57px;
            }
            .col-md-1#ex {
                margin-top: -56px;
            }
        }



    </style>
</head>

<body class="ltr main-body app horizontal">
<!-- main-content -->
<?php if (!empty($event_line)){
    include("../cell-menu.php");
}else{
    include("../header.php");
    include("../admin_menu.php");
}
?>
<div class="main-content app-content">
    <!-- container -->
    <!-- container -->
    <div class="main-container container-fluid">
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
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <?php
                    if (!empty($import_status_message)) {
                        echo '<div class="alert ' . $message_stauts_class . '">' . $import_status_message . '</div>';
                    }
                    displaySFMessage();
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">Station Events</span>
                        </div>
                            <div class="card-body">
                                <div class="pd-30 pd-sm-20">
                                    <div class="row row-xs">
                                        <div class="col-md-1">
                                            <label class="form-label mg-b-0">Station  </label>
                                        </div>
                                        <div class="col-md-4 mg-t-10 mg-md-t-0" style="pointer-events: none">
                                            <select name="station" id="station" class="form-control form-select select2" data-placeholder="Select Station">
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
                                        <div class="col-md-1 media"></div>
                                        <div class="col-md-1" id="ex" >
                                            <label class="form-label mg-b-0">Part Family  </label>
                                        </div>
                                        <div class="col-md-4 mg-t-10 mg-md-t-0 query">
                                            <select name="part_family" id="part_family" class="form-control form-select select2" data-placeholder="Select Part Family">
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
                                        <div class="col-md-1">
                                            <label class="form-label mg-b-0">Part Number  </label>
                                        </div>
                                        <div class="col-md-4 mg-t-10 mg-md-t-0">
                                            <select name="part_number" id="part_number" class="select form-control select2" data-placeholder="Select Part Number">
                                                <option value="" selected disabled>--- Select Part Number ---</option>
                                                <?php
                                                $part_number = $_POST['part_number'];
                                                if(empty($part_number) && !empty($_REQUEST['part_number'])){
                                                    $part_number = $_REQUEST['part_number'];
                                                }
                                                $sql1 = "SELECT * FROM `pm_part_number` where station in('2','3','4','5','6','7','8') and part_number like 'E0%' and part_family = '$part_family' and is_deleted != 1  ORDER BY `part_name` ASC";
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
                                        <div class="col-md-1 media"></div>
                                        <div class="col-md-1" id="ex">
                                            <label class="form-label mg-b-0">Event Type   </label>
                                        </div>
                                        <div class="col-md-4 mg-t-10 mg-md-t-0 query">
                                            <select name="event_type_id" id="event_type_id" class="form-control form-select select2" data-placeholder="Select Event Type">
                                                <option value="" selected disabled>--- Select Event Type ---</option>
                                                <?php
                                                $event_type_id = $_POST['event_type_id'];
                                                if(empty($event_type_id) && !empty($_REQUEST['station_event_id'])){
                                                    $station_event_id = $_REQUEST['station_event_id'];
                                                }

                                                $station_event_query = "SELECT * FROM `sg_station_event` WHERE line_id = '$station' and part_family_id='$part_family_id' and part_number_id='$part_number' and station_event_id = '$station_event_id'";
                                                $res_station = mysqli_query($db,$station_event_query);
                                                $row_event = mysqli_fetch_assoc($res_station);
                                                $event_type_id = $row_event['event_type_id'];

                                                $sql1 = "SELECT event_type_id ,event_type_name, FIND_IN_SET('$station', stations) from `event_type` where FIND_IN_SET('$station', stations) IS NOT NULL and FIND_IN_SET('$station', stations) > 0 AND is_deleted != 1 ORDER BY so ASC";
                                                $result1 = $mysqli->query($sql1);
                                                if ($result1 != null) {
                                                    $count = $result1->num_rows;
                                                    while ($row1 = $result1->fetch_assoc()) {
                                                        if ($event_type_id == $row1['event_type_id']) {
                                                            $entry = 'selected';
                                                        } else {
                                                            $entry = '';
                                                        }
                                                        echo "<option value='" . $row1['event_type_id'] . "' $entry >" . $row1['event_type_name'] . "</option>";
                                                        /* if ($count == 1) {
                                                             echo "<option disabled value='" . $row1['event_type_id'] . "' $entry >" . $row1['event_type_name'] . "</option>";
                                                         } else {
                                                             echo "<option value='" . $row1['event_type_id'] . "' $entry >" . $row1['event_type_name'] . "</option>";
                                                         }
                                                         $count = $count - 1;*/
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

								<?php if($e_type_id == 7){ ?>
                                    <div class="card-body pt-0">
                                        <button type="submit" name="submit_btn" class="btn btn-primary mg-t-5 submit_btn">Start Event</button>
                                    </div>
								<?php } else{?>
                                    <div class="card-body pt-0">
                                        <button type="submit" name="update_btn" id="update_btn" class="btn btn-primary mg-t-5 update_btn">Update Event</button>
                                    </div>
								<?php } ?>
                            </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
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
// var flag= 0;
// if(station == null){
// 	$("#error1").show();
// 	var flag= 1;
// }
// if(part_family == null){
// 	$("#error2").show();
// 	var flag= 1;
// }
// if(part_number == null){
// 	$("#error3").show();
// 	var flag= 1;
// }
// if(event_type_id == null){
// 	$("#error4").show();
// 	var flag= 1;
// }
// if (flag == 1) {
//        return false;
//        }

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
