<?php include("../config.php");
$button_event = "button3";
$curdate = date('Y-m-d H:i');
$cd = date('d-M-Y H:i:s');
//$dateto = $curdate;
//$datefrom = $curdate;
$button = "";
$temp = "";
//check user
checkSession();

$_SESSION['station'] = "";
$_SESSION['date_from'] = "";
$_SESSION['date_to'] = "";
$_SESSION['button'] = "";
$_SESSION['timezone'] = "";
$_SESSION['button_event'] = "";
$_SESSION['event_type'] = "";
$_SESSION['event_category'] = "";

if (count($_POST) > 0) {
    $_SESSION['station'] = $_POST['station'];
    $_SESSION['date_from'] = $_POST['date_from'];
    $_SESSION['date_to'] = $_POST['date_to'];
    $_SESSION['button'] = $_POST['button'];
    $_SESSION['timezone'] = $_POST['timezone'];
    $_SESSION['button_event'] = $_POST['button_event'];
    $_SESSION['event_type'] = $_POST['event_type'];
    $_SESSION['event_category'] = $_POST['event_category'];
    $button_event = $_POST['button_event'];
    $event_type = $_POST['event_type'];
    $event_category = $_POST['event_category'];
    $station = $_POST['station'];
    $dateto = $_POST['date_to'];
    $datefrom = $_POST['date_from'];
    $button = $_POST['button'];
    $timezone = $_POST['timezone'];
}
if (count($_POST) > 0) {
    $station1 = $_POST['station'];
    $qurtemp = mysqli_query($db, "SELECT * FROM  cam_line where line_id = '$station1' ");
    while ($rowctemp = mysqli_fetch_array($qurtemp)) {
        $station1 = $rowctemp["line_name"];
    }
}
if(empty($dateto)){
    $curdate = date(mdYHi_FORMAT);
    $dateto = $curdate;
}

if(empty($datefrom)){
    $yesdate = date(mdYHi_FORMAT, strtotime("-1 days"));
    $datefrom = $yesdate;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo $sitename; ?> | Station Events Log</title>
    <!-- Global stylesheets -->

    <link href="../assets/css/core.css" rel="stylesheet" type="text/css">


    <!-- /global stylesheets -->
    <!-- Core JS files -->
    <!--    <script type="text/javascript" src="../assets/js/libs/jquery-3.6.0.min.js"> </script>-->
    <script type="text/javascript" src="<?php echo site_URL; ?>/assets/js/form_js/jquery-min.js"></script>
    <script type="text/javascript" src="<?php echo site_URL; ?>/assets/js/libs/jquery-3.4.1.min.js"></script>

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
    <link href="<?php echo $siteURL; ?>assets/css/form_css/demo.css" rel="stylesheet"/>

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


        table.dataTable thead .sorting:after {
            content: ""!important;
            top: 49%;
        }
        .card-title:before{
            width: 0;

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
        .rdiobox {
            margin-top: 10px;
        }
        @media (min-width: 482px) and (max-width: 767px) {
            .col-md-3.mg-t-10.mg-md-t-0 {
                width: 50%;
            }
        }

    </style>
    <?php
    if ($button == "button2") {
        ?>
        <script>
            $(function () {
                $('#date_from').prop('disabled', true);
                $('#date_to').prop('disabled', true);
                $('#timezone').prop('disabled', false);
            });
        </script>
    <?php
    } else {
    ?>
        <script>
            $(function () {
                $('#date_from').prop('disabled', false);
                $('#date_to').prop('disabled', false);
                $('#timezone').prop('disabled', true);
            });
        </script>
        <?php
    }
    ?>

    <!-- event -->
    <?php
    if ($button_event == "button4") {
        ?>
        <script>
            $(function () {
                $('#event_type').prop('disabled', true);
                $('#event_category').prop('disabled', false);
            });
        </script>
    <?php
    } else {
    ?>
        <script>
            $(function () {
                $('#event_type').prop('disabled', false);
                $('#event_category').prop('disabled', true);
            });
        </script>
        <?php
    }
    ?>

</head>
<body class="ltr main-body app horizontal">
<!-- Main navbar -->
<?php
$cust_cam_page_header = "Station event log";
include("../header.php");
include("../admin_menu.php");
?>
<!-- main-content -->
<div class="main-content horizontal-content">
    <!-- container -->
    <!-- container -->
    <div class="main-container container">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Logs</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> Station event log</li>
                </ol>
            </div>
        </div>
        <form action="" id="user_form" class="form-horizontal" method="post">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header">
                                <span class="main-content-title mg-b-0 mg-b-lg-1">Station Event Log</span>
                            </div>
                            <div class="pd-20 pd-sm-10">
                                <div class="row row-xs">
                                    <div class="col-md-1">
                                        <label class="form-label mg-b-0">Event Type  </label>
                                    </div>
                                    <?php
                                    if ($button_event == "button3") {
                                        $checked = "checked";
                                    } else {
                                        $checked = "";
                                    }
                                    ?>

                                    <div class="col-md-0.5">
                                        <label class="rdiobox"><input type="radio" name="button_event" id="button3" value="button3"
                                                                      class="form-control"
                                                                      style="float: left;width: initial;" <?php echo $checked; ?>> <span></span></label>
                                    </div>

                                    <div class="col-md-3 mg-t-10 mg-md-t-0">
                                        <select name="event_type" id="event_type" class="form-control form-select select2" data-placeholder="Select Event Type">
                                            <option value="" selected>--- Select Event Type ---</option>
                                            <?php
                                            $ev_ty_post = $_POST['event_type'];
                                            $sql1 = "SELECT * FROM `event_type` where is_deleted != 1 ";
                                            $result1 = $mysqli->query($sql1);
                                            //                                            $entry = 'selected';
                                            while ($row1 = $result1->fetch_assoc()) {
                                                $lin = $row1['event_type_id'];

                                                if ($lin == $ev_ty_post) {
                                                    $entry = 'selected';
                                                } else {
                                                    $entry = '';
                                                }
                                                echo "<option value='" . $row1['event_type_id'] . "' $entry >" . $row1['event_type_name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-1">
                                        <label class="form-label mg-b-0">Event Category  </label>
                                    </div>
                                    <?php
                                    if ($button_event == "button4") {
                                        $checked = "checked";
                                    } else {
                                        $checked = "";
                                    }
                                    ?>
                                    <div class="col-md-0.5">
                                        <label class="rdiobox">  <input type="radio" name="button_event" id="button4" value="button4"
                                                                        class="form-control"  style="float: left;width: initial;" <?php echo $checked; ?>> <span></span></label>
                                    </div>

                                    <div class="col-md-3 mg-t-10 mg-md-t-0">
                                        <select name="event_category" id="event_category" class="form-control form-select select2" data-placeholder="Select Event Category">
                                            <option value="" selected disabled>--- Select Event Catagory ---</option>
                                            <?php
                                            $ev_cat_post = $_POST['event_category'];
                                            $sql1 = "SELECT * FROM `events_category` where is_deleted != 1 ";
                                            $result1 = $mysqli->query($sql1);
                                            //                                            $entry = 'selected';
                                            while ($row1 = $result1->fetch_assoc()) {
                                                $lin = $row1['events_cat_id'];

                                                if ($lin == $ev_cat_post) {
                                                    $entry = 'selected';
                                                } else {
                                                    $entry = '';
                                                }
                                                echo "<option value='" . $row1['events_cat_id'] . "' $entry >" . $row1['events_cat_name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="pd-20 pd-sm-10">
                                <div class="row row-xs">
                                    <div class="col-md-1" >
                                        <label class="form-label mg-b-0">Station  </label>
                                    </div>
                                    <div class="col-md-0.5"></div>
                                    <div class="col-md-3 mg-t-10 mg-md-t-0">
                                        <select name="station" id="station" class="form-control form-select select2" data-placeholder="Select Station">
                                            <option value="" selected disabled>--- Select Station ---</option>
                                            <?php
                                            $sql1 = "SELECT * FROM `cam_line` where  enabled = 1 and is_deleted != 1 ORDER BY `cam_line`.`line_id` ASC;";
                                            $result1 = $mysqli->query($sql1);
                                            //                                            $entry = 'selected';
                                            while ($row1 = $result1->fetch_assoc()) {
                                                $lin = $row1['line_id'];

                                                if ($lin == $station) {
                                                    $entry = 'selected';
                                                } else {
                                                    $entry = '';
                                                }
                                                echo "<option value='" . $row1['line_id'] . "' $entry >" . $row1['line_name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="pd-20 pd-sm-10">
                                <div class="row row-xs">
                                    <?php
                                    if ($button != "button2") {
                                        $checked = "checked";
                                    } else {
                                        $checked == "";
                                    }
                                    ?>
                                    <div class="col-md-1">
                                        <label class="form-label mg-b-0">Date From  </label>
                                    </div>
                                    <div class="col-md-0.5"></div>
                                    <div class="col-md-3 mg-t-10 mg-md-t-0">
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input class="form-control" name="date_from" id="date_from" type="text" value="<?php echo $datefrom; ?>" placeholder="MM/DD/YYYY">
                                        </div>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-0.5"></div>
                                    <div class="col-md-1">
                                        <label class="form-label mg-b-0">Date To  </label>
                                    </div>
                                    <div class="col-md-0.5"></div>
                                    <div class="col-md-3 mg-t-10 mg-md-t-0">
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input class="form-control" name="date_to" id="date_to" value="<?php echo $dateto; ?>" type="text" placeholder="MM/DD/YYYY">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <?php
                            if (!empty($import_status_message)) {
                                echo '<div class="alert ' . $message_stauts_class . '">' . $import_status_message . '</div>';
                            }
                            displaySFMessage();
                            ?>
                            <div class="pd-20 pd-sm-10">
                                <div class="row row-xs">
                                    <form action="log_schedular.php" method="post">
                                        <div class="col-md-1">
                                            <button type="submit" class="btn btn-primary mg-t-5 submit_btn">Submit</button>
                                        </div>
                                    </form>
                                    <div class="col-md-1">
                                        <button type="button" class="btn btn-primary mg-t-5" onclick="window.location.reload();">Reset</button>
                                    </div>
        </form>
        <form action="export_se_log_new.php" method="post" name="export_excel">
            <div class="col-md-1">
                <button type="submit" style="width: 180px!important" class="btn btn-primary mg-t-5" id="export" name="export">Export Data</button>
            </div>
        </form>
    </div>
</div>
</div>
</div>
</div>
</div>


<!-- row  -->
<?php
if(count($_POST) > 0)
{
    ?>
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table datatable-basic table-bordered text-nowrap mb-0" id="example2">
                            <thead>
                            <tr>
                                <th>Station</th>
                                <th>Event Type</th>
                                <th>Part Number</th>
                                <th>Part Name</th>
                                <th>Part Family</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Total Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $main_query = "select slogup.line_id ,slogup.tt , ( select event_type_name from event_type where event_type_id = slogup.event_type_id) as e_type,
( select events_cat_name from events_category where events_cat_id = slogup.event_cat_id) as cat_name , pn.part_number as p_num, pn.part_name as p_name , 
pf.part_family_name as pf_name,slogup.created_on as start_time , slogup.end_time as end_time ,slogup.total_time as total_time from sg_station_event_log as slogup
inner join sg_station_event as sg_events on slogup.station_event_id = sg_events.station_event_id INNER JOIN pm_part_family as pf on sg_events.part_family_id = pf.pm_part_family_id 
inner join pm_part_number as pn on sg_events.part_number_id = pn.pm_part_number_id where 1 ";
                            //where DATE_FORMAT(sg_events.created_on,'%Y-%m-%d') >= '2022-11-03'
                            //and DATE_FORMAT(sg_events.created_on,'%Y-%m-%d') <= '2022-11-03' and slogup.line_id = '3' ORDER BY slogup.created_on ASC";
                            /* Default Query */
                            $date_from = convertMDYToYMDwithTime($datefrom);
                            $date_to = convertMDYToYMDwithTime($dateto);
                            $q = $main_query . " and DATE_FORMAT(slogup.created_on,'%Y-%m-%d %H:%i') >= '$date_from' and DATE_FORMAT(slogup.created_on,'%Y-%m-%d %H:%i') <= '$date_to' ";
                            $q11 = $main_query . " and DATE_FORMAT(slogup.end_time,'%Y-%m-%d %H:%i') >= '$date_from' and DATE_FORMAT(slogup.created_on,'%Y-%m-%d %H:%i') <= '$date_from' ";

                            $line = $_POST['station'];

                            /* If Line is selected. */
                            if ($line != null) {
                                $line = $_POST['station'];
                                $cur_date = convertMDYToYMDwithTime($curdate);
                                $q = $main_query . "and DATE_FORMAT(slogup.created_on,'%Y-%m-%d %H:%i') >= '$cur_date' and DATE_FORMAT(slogup.created_on,'%Y-%m-%d %H:%i') <= '$cur_date' and slogup.line_id = '$line' ";
                                $q11 = $main_query . "and DATE_FORMAT(slogup.end_time,'%Y-%m-%d %H:%i') >= '$cur_date' and DATE_FORMAT(slogup.created_on,'%Y-%m-%d %H:%i') <= '$cur_date' and slogup.line_id = '$line' ";
                            }

                            /* Build the query to fetch the data*/
                            if (count($_POST) > 0) {
                                $line = $_POST['station'];
                                $line_id = $_POST['station'];
                                $dateto = $_POST['date_to'];
                                $datefrom = $_POST['date_from'];
                                $button = $_POST['button'];
                                $button_event = $_POST['button_event'];
                                $event_type = $_POST['event_type'];
                                $event_category = $_POST['event_category'];
                                $timezone = $_POST['timezone'];
                                //event type
                                $q = $main_query;
                                $q11 = $main_query;
                                $q12 = $main_query;

                                /* If Line is selected. */
                                if ($line_id != null) {
                                    $q = $q . " and slogup.line_id = '$line_id' ";
                                    $q11 = $q11 . " and slogup.line_id = '$line_id' ";
                                    $q12 = $q12 . " and slogup.line_id = '$line_id' ";
                                }
                                if ($datefrom != "" && $dateto != "") {
                                    $date_from = convertMDYToYMDwithTime($datefrom);
                                    $date_to = convertMDYToYMDwithTime($dateto);
                                    $q = $q . " AND DATE_FORMAT(slogup.created_on,'%Y-%m-%d %H:%i') >= '$date_from' and DATE_FORMAT(slogup.created_on,'%Y-%m-%d %H:%i') <= '$date_to' ";
                                    $q11 = $q11 . " AND DATE_FORMAT(slogup.end_time,'%Y-%m-%d %H:%i') >= '$date_from' and DATE_FORMAT(slogup.created_on,'%Y-%m-%d %H:%i') <= '$date_from' ";
                                    $q12 = $q12 . " AND (slogup.end_time is NULL) and IGNORE_id = 0  ";
                                } else if ($datefrom != "" && $dateto == "") {
                                    $date_from = convertMDYToYMDwithTime($datefrom);
                                    $q = $q . " AND DATE_FORMAT(slogup.created_on,'%Y-%m-%d %H:%i') >= '$date_from' ";
                                    $q11 = $q11 . " AND DATE_FORMAT(slogup.end_time,'%Y-%m-%d %H:%i') >= '$date_from' and DATE_FORMAT(slogup.created_on,'%Y-%m-%d %H:%i') <= '$date_from' ";
                                    $q12 = $q12 . " AND DATE_FORMAT(slogup.end_time,'%Y-%m-%d %H:%i') >= '$date_from' and DATE_FORMAT(slogup.created_on,'%Y-%m-%d %H:%i') <= '$date_from' ";
                                } else if ($datefrom == "" && $dateto != "") {
                                    $date_to = convertMDYToYMDwithTime($dateto);
                                    $q = $q . " AND DATE_FORMAT(slogup.created_on,'%Y-%m-%d %H:%i') <= '$date_to' ";
                                }

                                if ($event_type != "") {
                                    $q = $q . " and slogup.event_type_id = '$event_type'";
                                    $q11 = $q11 . " and slogup.event_type_id = '$event_type'";
                                    $q12 = $q12 . " and slogup.event_type_id = '$event_type'";
                                }

                                if ($event_category != "") {
                                    $q = $q . " AND  slogup.event_cat_id ='$event_category'";
                                    $q11 = $q11 . " AND  slogup.event_cat_id ='$event_category'";
                                    $q12 = $q12 . " AND  slogup.event_cat_id ='$event_category'";
                                }

                                $q = $q . " ORDER BY slogup.created_on  ASC";
                                $q11 = $q11 . " ORDER BY slogup.created_on  ASC";
                                $q12 = $q12 . " ORDER BY slogup.created_on  DESC";

                            }
                            /* Execute the Query Built*/
                            $qur11 = mysqli_query($db, $q11);
                            $numrows = $qur11->num_rows;
                            if($numrows > 0){
                                while ($rowc = mysqli_fetch_array($qur11)) {
                                    ?>
                                    <tr>
                                        <?php
                                        $un = $rowc['line_id'];
                                        $qur04 = mysqli_query($db, "SELECT line_name FROM  cam_line where line_id = '$un' ");
                                        while ($rowc04 = mysqli_fetch_array($qur04)) {
                                            $lnn = $rowc04["line_name"];
                                        }
                                        ?>
                                        <td><?php echo $lnn; ?></td>
                                        <td><?php echo $rowc["e_type"]; ?></td>
                                        <td><?php echo $rowc['p_num']; ?></td>
                                        <td><?php echo $rowc['p_name']; ?></td>
                                        <td><?php echo $rowc['pf_name']; ?></td>
                                        <td style="color: #0a53be"><?php echo dateReadFormat($date_from); ?></td>
                                        <?php
                                        $diff = abs(strtotime($date_to) - strtotime($date_from));
                                        $t = round(($diff/3600),2);
                                        $is_true = strtotime($rowc['end_time']) > strtotime($date_to);
                                        if($is_true)
                                        {
                                            $end_time = dateReadFormat($date_to);
                                            $t_time = $t;
                                        }else{
                                            $end_time = dateReadFormat($rowc['end_time']);
                                            $dd = (strtotime($rowc['end_time']) - strtotime($date_from));
                                            $t_time = round(($dd/3600),2);
                                        }
                                        ?>
                                        <td><?php echo $end_time; ?></td>
                                        <td><?php echo $t_time; ?></td>
                                    </tr>
                                <?php }
                            }else{
                                $qur12 = mysqli_query($db, $q12);
                                while ($rowc = mysqli_fetch_array($qur12)) {
                                    ?>
                                    <tr>
                                        <?php
                                        $un = $rowc['line_id'];
                                        $qur04 = mysqli_query($db, "SELECT line_name FROM  cam_line where line_id = '$un' ");
                                        while ($rowc04 = mysqli_fetch_array($qur04)) {
                                            $lnn = $rowc04["line_name"];
                                        }
                                        ?>
                                        <td><?php echo $lnn; ?></td>
                                        <td><?php echo $rowc["e_type"]; ?></td>
                                        <td><?php echo $rowc['p_num']; ?></td>
                                        <td><?php echo $rowc['p_name']; ?></td>
                                        <td><?php echo $rowc['pf_name']; ?></td>
                                        <td style="color: #0a53be"><?php echo dateReadFormat($date_from); ?></td>
                                        <?php
                                        $diff = abs(strtotime($date_to) - strtotime($date_from));
                                        $t = round(($diff/3600),2);
                                        $is_true = strtotime($rowc['end_time']) > strtotime($date_to);
                                        $end_time = dateReadFormat($date_to);
                                        $t_time = $t;
                                        ?>
                                        <td><?php echo $end_time; ?></td>
                                        <td><?php echo $t_time; ?></td>
                                    </tr>
                                <?php }
                            }
                            /* Execute the Query Built*/
                            $qur = mysqli_query($db, $q);
                            while ($rowc = mysqli_fetch_array($qur)) {
                                ?>
                                <tr>
                                    <?php
                                    $un = $rowc['line_id'];
                                    $qur04 = mysqli_query($db, "SELECT line_name FROM  cam_line where line_id = '$un' ");
                                    while ($rowc04 = mysqli_fetch_array($qur04)) {
                                        $lnn = $rowc04["line_name"];
                                    }
                                    ?>
                                    <td><?php echo $lnn; ?></td>
                                    <td><?php echo $rowc["e_type"]; ?></td>
                                    <td><?php echo $rowc['p_num']; ?></td>
                                    <td><?php echo $rowc['p_name']; ?></td>
                                    <td><?php echo $rowc['pf_name']; ?></td>
                                    <td><?php echo dateReadFormat($rowc['start_time']); ?></td>
                                    <?php
                                    $diff = abs(strtotime($date_to) - strtotime($rowc['start_time']));
                                    $t = round(($diff/3600),2);
                                    //if end time is empty  calculate time using current time
                                    $diff = abs(strtotime($curdate) - strtotime($rowc['start_time']));
                                    $ct = round(($diff/3600),2);
                                    $et = $rowc['end_time'];
                                    if(!empty($et)){
                                        $is_true = strtotime($rowc['end_time']) > strtotime($date_to);
                                        if($is_true)
                                        {
                                            $color = '#0a53be';
                                            $end_time = dateReadFormat($date_to);
                                            $t_time = $t;
                                        }else{
                                            $end_time = dateReadFormat($rowc['end_time']);
                                            $t_time = $rowc['total_time'];
                                        }
                                    }else{
                                        $color = '#0a53be';
                                        $t_time = $ct;
                                        $end_time = dateReadFormat($cd);
                                    }
                                    ?>
                                    <td style="color: <?php echo $color; ?>"><?php echo $end_time; ?></td>
                                    <td><?php echo $rowc['tt']; ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
</div>
</div>
<script>
    $('#date_to').datetimepicker({format: 'mm-dd-yyyy hh:ii'});
    $('#date_from').datetimepicker({format: 'mm-dd-yyyy hh:ii'});
    $(function () {
        $('input:radio').change(function () {
            var abc = $(this).val()
            //alert(abc)
            if (abc == "button1")
            {
                $('#date_from').prop('disabled', false);
                $('#date_to').prop('disabled', false);
                $('#timezone').prop('disabled', true);
            }
        });
    });
</script>
<!-- /dashboard content -->
<script>
    $(function () {
        $('input:radio').change(function () {
            var abc = $(this).val()
            //  alert(abc);
            if (abc == "button1") {
                $('#date_from').prop('disabled', false);
                $('#date_to').prop('disabled', false);
                $('#timezone').prop('disabled', true);
            } else if (abc == "button2") {
                $('#date_from').prop('disabled', true);
                $('#date_to').prop('disabled', true);
                $('#timezone').prop('disabled', false);
            } else if (abc == "button3") {
                $('#event_category').prop('disabled', true);
                $('#event_type').prop('disabled', false);
            } else if (abc == "button4") {
                $('#event_type').prop('disabled', true);
                $('#event_category').prop('disabled', false);
            }


        });
    });
</script>
<script>
    $("#update_btn").click(function (e) {
        //          $(':input[type="button"]').prop('disabled', true);
        $.ajax({
            type: 'POST',
            url: 'se_log_schedular.php',
            async: false,
            cache:false,
            success: function (data) {
                event.preventDefault()
                window.scrollTo(0, 300);
            }
        });

        // e.preventDefault();
    });
</script>
<script>
    window.onload = function () {
        history.replaceState("", "", "<?php echo $siteURL; ?>log_module/sg_station_event_log.php");
    }
</script>
<?php include('../footer1.php') ?>

</body>
</html>
