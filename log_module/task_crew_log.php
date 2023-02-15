<?php
include("../config.php");
$curdate = date(mdY_FORMAT);
//$dateto = $curdate;
//$datefrom = $curdate;
$button = "";
$temp = "";
if (!isset($_SESSION['user'])) {
    header('location: logout.php');
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
    header($redirect_logout_path);
//	header('location: ../logout.php');
    exit;
}
//Set the time of the user's last activity
$_SESSION['LAST_ACTIVITY'] = $time;

$_SESSION['taskboard'] = "";
$_SESSION['user'] = "";
$_SESSION['date_from'] = "";
$_SESSION['date_to'] = "";
$_SESSION['button'] = "";
$_SESSION['timezone'] = "";
if (count($_POST) > 0) {
    $_SESSION['taskboard'] = $_POST['taskboard'];
    $_SESSION['user'] = $_POST['user'];
    $_SESSION['date_from'] = $_POST['date_from'];
    $_SESSION['date_to'] = $_POST['date_to'];
    $_SESSION['button'] = $_POST['button'];
    $_SESSION['timezone'] = $_POST['timezone'];
    $taskboard = $_POST['taskboard'];
    $user = $_POST['user'];
    $dateto = $_POST['date_to'];
    $datefrom = $_POST['date_from'];
    $button = $_POST['button'];
    $timezone = $_POST['timezone'];
}
if (count($_GET) > 0) {
    $station1 = $_GET['line'];
    $qurtemp = mysqli_query($db, "SELECT * FROM  cam_line where line_id = '$station1' ");
    while ($rowctemp = mysqli_fetch_array($qurtemp)) {
        $station = $rowctemp["line_name"];
    }
}

if(empty($dateto)){
    $curdate = date(mdY_FORMAT);
    $dateto = $curdate;
}

if(empty($datefrom)){
    $yesdate = date(mdY_FORMAT,strtotime("-1 days"));
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
        <?php echo $sitename; ?> | Task Crew Log</title>
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

</head>


<body class="ltr main-body app horizontal">
<!-- main-content -->
<!-- Main navbar -->
<?php
$cust_cam_page_header = "Task Crew Log";
include("../header.php");
include("../admin_menu.php");
?>

<div class="main-content app-content">
    <!-- container -->
    <div class="main-container container">
    <!-- breadcrumb -->
            <div class="breadcrumb-header justify-content-between">
                <div class="left-content">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Logs</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Task Crew Log</li>
                    </ol>
                </div>
            </div>

              <form action="" id="user_form" class="form-horizontal" method="post">
        <div class="row-body">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">Task Crew Log</span>
                        </div>
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-1">
                                    <label class="form-label mg-b-0">Taskboard</label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <select name="taskboard" id="taskboard" class="form-control form-select select2" data-placeholder="Select Taskboard">
                                        <option value="" selected disabled>--- Select Taskboard ---</option>
                                        <?php
                                        $sql1 = "SELECT * FROM `sg_taskboard` ";

                                        $result1 = $mysqli->query($sql1);
                                        //                                            $entry = 'selected';
                                        while ($row1 = $result1->fetch_assoc()) {
                                            $lin = $row1['sg_taskboard_id'];

                                            if ($lin == $taskboard) {
                                                $entry = 'selected';
                                            } else {
                                                $entry = '';
                                            }
                                            echo "<option value='" . $row1['sg_taskboard_id'] . "' $entry >" . $row1['taskboard_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-1">
                                    <label class="form-label mg-b-0">User  </label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <select name="user" id="user" class="form-control form-select select2" data-placeholder="Select User">
                                        <option value="" selected >--- Select User ---</option>
                                        <?php
                                        $sql1 = "SELECT DISTINCT tt.assign_to FROM tm_task as tt right join cam_users as cu on tt.assign_to = cu.users_id where tt.assign_to != '' and cu.is_deleted != 1";
                                        $result1 = $mysqli->query($sql1);
                                        //$entry = 'selected';
                                        while ($row1 = $result1->fetch_assoc()) {
                                            $lin = $row1['assign_to'];
                                            if ($lin == $user) {
                                                $entry = 'selected';
                                            } else {
                                                $entry = '';
                                            }
                                            $qur05 = mysqli_query($db, "SELECT * FROM  cam_users where users_id = '$lin' and is_deleted != 1 ");
                                            while ($rowc05 = mysqli_fetch_array($qur05)) {
                                                $lnnm = $rowc05["firstname"]." ".$rowc05["lastname"];
                                            }
                                            echo "<option value='" . $row1['assign_to'] . "' $entry >" . $lnnm . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                        </div>

                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-1">
                                    <label class="form-label mg-b-0">Date From  </label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control fc-datepicker" name="date_from" id="date_from" value="<?php echo $datefrom; ?>" placeholder="MM/DD/YYYY" type="text">
                                    </div><!-- input-group -->
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-1">
                                    <label class="form-label mg-b-0">Date To  </label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control fc-datepicker" name="date_to" id="date_to" value="<?php echo $dateto; ?>"placeholder="MM/DD/YYYY" type="text">
                                    </div><!-- input-group -->
                                </div>
                            </div>

                        </div>
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
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-primary mg-t-5 submit_btn">Search</button>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-primary mg-t-5" onclick="window.location.reload();">Reset</button>
                                </div>
    </form>
                 <form action="export_task_log.php" method="post" name="export_excel">
                   <div class="col-md-1">
                      <button type="submit" style="width: 180px!important" class="btn btn-primary mg-t-5" id="export" name="export">Export Data</button>
                   </div>
              </form>
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
                        <table class="table  table-bordered text-nowrap mb-0" id="example2">
                            <thead>
                            <tr>
                                <th>Taskboard</th>
                                <th>Assign To</th>
                                <th>Equipment</th>
                                <th>Property</th>
                                <th>Building</th>
                                <th>Estimated Duration</th>
                                <th>Task Assign Time</th>
                                <th>Task Completion Time</th>
                                <th>Total Duration</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $date_from = convertMDYToYMD($datefrom);
                            $date_to = convertMDYToYMD($dateto);
                            $qur = mysqli_query($db, "SELECT `taskboard`,`assign_to`,`equipment`,`property`,`building`,`duration`,`assigned_time`,`finished_time`,SEC_TO_TIME(TIME_TO_SEC(TIMEDIFF(`finished_time` ,`assigned_time`))) as total_time FROM `tm_task` WHERE DATE_FORMAT(`assigned_time`,'%Y-%m-%d') >= '$date_from' and DATE_FORMAT(`assigned_time`,'%Y-%m-%d') <= '$date_to' ");
                            if (count($_GET) > 0) {
                                $task = $_GET['taskboard'];
                                $c_date = convertMDYToYMD($curdate);
                                $qur = mysqli_query($db, "SELECT `taskboard`,`assign_to`,`equipment`,`property`,`building`,`duration`,`assigned_time`,`finished_time`,SEC_TO_TIME(TIME_TO_SEC(TIMEDIFF(`finished_time` ,`assigned_time`))) as total_time FROM `tm_task` WHERE DATE_FORMAT(`assign_time`,'%Y-%m-%d') >= '$c_date' and DATE_FORMAT(`assign_time`,'%Y-%m-%d') <= '$c_date' and `station_id` = '$ln'");
                            }
                            if (count($_POST) > 0) {
                                $taskboard = $_POST['taskboard'];
                                $user = $_POST['user'];
                                $dateto = $_POST['date_to'];
                                $datefrom = $_POST['date_from'];
                                $button = $_POST['button'];
                                $timezone = $_POST['timezone'];
                                /*if ($button == "button1") {*/
                                    if ($taskboard != "" && $user != "" && $datefrom != "" && $dateto != "") {
                                        $date_from = convertMDYToYMD($datefrom);
                                        $date_to = convertMDYToYMD($dateto);
                                        $qur = mysqli_query($db, "SELECT `taskboard`,`assign_to`,`equipment`,`property`,`building`,`duration`,`assigned_time`,`finished_time`,SEC_TO_TIME(TIME_TO_SEC(TIMEDIFF(`finished_time` ,`assigned_time`))) as total_time FROM `tm_task` WHERE DATE_FORMAT(`assigned_time`,'%Y-%m-%d') >= '$date_from' and DATE_FORMAT(`assigned_time`,'%Y-%m-%d') <= '$date_to' and `taskboard` = '$taskboard' and `assign_to` = '$user'");
                                    } else if ($taskboard != "" && $user != "" && $datefrom == "" && $dateto == "") {
                                        $qur = mysqli_query($db, "SELECT `taskboard`,`assign_to`,`equipment`,`property`,`building`,`duration`,`assigned_time`,`finished_time`,SEC_TO_TIME(TIME_TO_SEC(TIMEDIFF(`finished_time` ,`assigned_time`))) as total_time FROM `tm_task` WHERE  `taskboard` = '$taskboard' and `assign_to` = '$user'");
                                    } else if ($taskboard != "" && $user == "" && $datefrom != "" && $dateto != "") {
                                        $date_from = convertMDYToYMD($datefrom);
                                        $date_to = convertMDYToYMD($dateto);
                                        $qur = mysqli_query($db, "SELECT `taskboard`,`assign_to`,`equipment`,`property`,`building`,`duration`,`assigned_time`,`finished_time`,SEC_TO_TIME(TIME_TO_SEC(TIMEDIFF(`finished_time` ,`assigned_time`))) as total_time FROM `tm_task` WHERE DATE_FORMAT(`assigned_time`,'%Y-%m-%d') >= '$date_from' and DATE_FORMAT(`assigned_time`,'%Y-%m-%d') <= '$date_to' and `taskboard` = '$taskboard' ");
                                    } else if ($taskboard != "" && $user == "" && $datefrom == "" && $dateto == "") {
                                        $qur = mysqli_query($db, "SELECT `taskboard`,`assign_to`,`equipment`,`property`,`building`,`duration`,`assigned_time`,`finished_time`,SEC_TO_TIME(TIME_TO_SEC(TIMEDIFF(`finished_time` ,`assigned_time`))) as total_time FROM `tm_task` WHERE `taskboard` = '$taskboard'");
                                    } else if ($taskboard == "" && $user != "" && $datefrom != "" && $dateto != "") {
                                        $date_from = convertMDYToYMD($datefrom);
                                        $date_to = convertMDYToYMD($dateto);
                                        $qur = mysqli_query($db, "SELECT `taskboard`,`assign_to`,`equipment`,`property`,`building`,`duration`,`assigned_time`,`finished_time`,SEC_TO_TIME(TIME_TO_SEC(TIMEDIFF(`finished_time` ,`assigned_time`))) as total_time FROM `tm_task` WHERE DATE_FORMAT(`assigned_time`,'%Y-%m-%d') >= '$date_from' and DATE_FORMAT(`assigned_time`,'%Y-%m-%d') <= '$date_to' and `assign_to` = '$user'");
                                    } else if ($taskboard == "" && $user != "" && $datefrom == "" && $dateto == "") {
                                        $qur = mysqli_query($db, "SELECT `taskboard`,`assign_to`,`equipment`,`property`,`building`,`duration`,`assigned_time`,`finished_time`,SEC_TO_TIME(TIME_TO_SEC(TIMEDIFF(`finished_time` ,`assigned_time`))) as total_time FROM `tm_task` WHERE  `assign_to` = '$user'");
                                    } else if ($taskboard == "" && $user == "" && $datefrom != "" && $dateto != "") {
                                        $date_from = convertMDYToYMD($datefrom);
                                        $date_to = convertMDYToYMD($dateto);
                                        $qur = mysqli_query($db, "SELECT `taskboard`,`assign_to`,`equipment`,`property`,`building`,`duration`,`assigned_time`,`finished_time`,SEC_TO_TIME(TIME_TO_SEC(TIMEDIFF(`finished_time` ,`assigned_time`))) as total_time FROM `tm_task` WHERE DATE_FORMAT(`assigned_time`,'%Y-%m-%d') >= '$date_from' and DATE_FORMAT(`assigned_time`,'%Y-%m-%d') <= '$date_to' ");
                                    }
                                /*}*/
//$message = "Date :- ".$name;
//echo "<script type='text/javascript'>alert('$message');</script>";
//$qur =  mysqli_query($db,"SELECT * FROM `assign_crew_log` WHERE DATE_FORMAT(`assign_time`,'%Y-%m-%d') = '$date' and `user` = '$name'");
                            }
                            while ($rowc = mysqli_fetch_array($qur)) {
                                $dateTime = $rowc["assign_time"];
                                $dateTime2 = $rowc["unassign_time"];
//$nt = TIMEDIFF($dateTime, $dateTime2);
                                ?>
                                <tr>
                                    <?php
                                    $un = $rowc['taskboard'];
                                    $qur04 = mysqli_query($db, "SELECT taskboard_name FROM  sg_taskboard where sg_taskboard_id = '$un' ");
                                    while ($rowc04 = mysqli_fetch_array($qur04)) {
                                        $lnn = $rowc04["taskboard_name"];
                                    }
                                    ?>
                                    <td><?php echo $lnn; ?></td>
                                    <?php
                                    $un = $rowc['assign_to'];
                                    $qur04 = mysqli_query($db, "SELECT * FROM  cam_users where users_id = '$un' ");
                                    while ($rowc04 = mysqli_fetch_array($qur04)) {
                                        $first = $rowc04["firstname"];
                                        $last = $rowc04["lastname"];
                                    }
                                    ?>
                                    <td><?php echo $first; ?>&nbsp;<?php echo $last; ?></td>

                                    <?php
                                    $un = $rowc['equipment'];
                                    $qur04 = mysqli_query($db, "SELECT tm_equipment_name FROM  tm_equipment where tm_equipment_id = '$un' ");
                                    while ($rowc04 = mysqli_fetch_array($qur04)) {
                                        $pnn = $rowc04["tm_equipment_name"];
                                    }
                                    ?>
                                    <td><?php echo $pnn; ?></td>

                                    <?php
                                    $un = $rowc['property'];
                                    $qur04 = mysqli_query($db, "SELECT tm_property_name FROM  tm_property where tm_property_id = '$un' ");
                                    while ($rowc04 = mysqli_fetch_array($qur04)) {
                                        $pnn = $rowc04["tm_property_name"];
                                    }
                                    ?>
                                    <td><?php echo $pnn; ?></td>

                                    <?php
                                    $un = $rowc['building'];
                                    $qur04 = mysqli_query($db, "SELECT tm_building_name FROM  tm_building where tm_building_id = '$un' ");
                                    while ($rowc04 = mysqli_fetch_array($qur04)) {
                                        $pnn = $rowc04["tm_building_name"];
                                    }
                                    ?>
                                    <td><?php echo $pnn; ?></td>
                                    <td><?php echo $rowc['duration']; ?></td>

                                    <td><?php echo dateReadFormat($rowc['assigned_time']); ?></td>
                                    <td><?php echo dateReadFormat($rowc['finished_time']); ?></td>
                                    <td><?php echo $rowc['total_time']; ?></td>

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
<!-- /dashboard content -->
<script>
    $('#date_from').datepicker({ dateFormat: 'mm-dd-yy' });
    $('#date_to').datepicker({ dateFormat: 'mm-dd-yy' });

    $('#taskboard').on('change', function (e) {
        $("#user_form").submit();
    });
    $(function () {
        $('input:radio').change(function () {
            var abc = $(this).val()
            //  alert(abc);
            if (abc == "button1")
            {
                $('#date_from').prop('disabled', false);
                $('#date_to').prop('disabled', false);
                $('#timezone').prop('disabled', true);
            } else if (abc == "button2")
            {
                $('#date_from').prop('disabled', true);
                $('#date_to').prop('disabled', true);
                $('#timezone').prop('disabled', false);
            }
        });
    });
</script>

<script type="text/javascript">
    $(function () {
        $("#btn").bind("click", function () {
            $("#taskboard")[0].selectedIndex = 0;
            $("#user")[0].selectedIndex = 0;

        });
    });
</script>
<script>
    window.onload = function () {
        history.replaceState("", "", "<?php echo $siteURL; ?>log_module/task_crew_log.php");
    }
</script>
<?php include('../footer1.php') ?>

</body>
