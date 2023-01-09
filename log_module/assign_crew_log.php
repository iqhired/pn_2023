<?php
include("../config.php");
$curdate = date('Y-m-d');
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

$_SESSION['usr'] = "";
$_SESSION['station'] = "";
//$_SESSION['date_from'] = "";
//$_SESSION['date_to'] = "";
$_SESSION['button'] = "";
$_SESSION['timezone'] = "";
if (count($_POST) > 0) {
    $_SESSION['usr'] = $_POST['usr'];
    $_SESSION['station'] = $_POST['station'];
    $_SESSION['date_from'] = $_POST['date_from'];
    $_SESSION['date_to'] = $_POST['date_to'];
    $_SESSION['button'] = $_POST['button'];
    $_SESSION['timezone'] = $_POST['timezone'];
    $name = $_POST['usr'];
    $station = $_POST['station'];
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
        <?php echo $sitename; ?> | Assign Crew Log</title>
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
<?php
$cust_cam_page_header = "Assign Crew log";
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
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Logs</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Assign Crew log</li>
            </ol>
        </div>
    </div>
    <div class="row-body">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Assign Crew Log</span>
                    </div>
                    <form action="" id="user_form" class="form-horizontal" method="post">
                    <div class="pd-30 pd-sm-20">
                        <div class="row row-xs">
                            <div class="col-md-1">
                                <label class="form-label mg-b-0">User : </label>
                            </div>
                            <div class="col-md-5 mg-t-10 mg-md-t-0">
                                <select  name="usr" id="usr" class="form-control form-select select2"  style="float: left;width: initial;" >
                                    <option value="" selected disabled>--- Select User ---</option>
                                    <?php
                                    $sql1 = "SELECT DISTINCT `user_id` FROM `cam_assign_crew_log` order by user_id ";
                                    $result1 = $mysqli->query($sql1);
                                    //$entry = 'selected';
                                    while ($row1 = $result1->fetch_assoc()) {
                                        $lin = $row1['user_id'];
                                        $qur05 = mysqli_query($db, "SELECT * FROM  cam_users where users_id = '$lin' ");
                                        while ($rowc05 = mysqli_fetch_array($qur05)) {
                                            $first1 = $rowc05["firstname"];
                                            $last1 = $rowc05["lastname"];
                                        }
                                        $fulllname = $first1 . " " . $last1;
                                        if ($lin == $name) {
                                            $entry = 'selected';
                                        } else {
                                            $entry = '';
                                        }
                                        echo "<option value='" . $row1['user_id'] . "' $entry >$fulllname</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <label class="form-label mg-b-0">Station : </label>
                            </div>
                            <div class="col-md-5 mg-t-10 mg-md-t-0">
                                <select  name="station" id="station" class="form-control form-select select2" style="float: left;width: initial;" >
                                    <option value="" selected disabled>--- Select Station ---</option>
                                    <?php
                                    $sql1 = "SELECT DISTINCT `station_id` FROM `cam_assign_crew_log`";
                                    $result1 = $mysqli->query($sql1);
                                    //$entry = 'selected';
                                    while ($row1 = $result1->fetch_assoc()) {
                                        $lin = $row1['station_id'];
                                        if ($lin == $station) {
                                            $entry = 'selected';
                                        } else {
                                            $entry = '';
                                        }
                                        $qur05 = mysqli_query($db, "SELECT * FROM  cam_line where line_id = '$lin' and is_deleted != 1 ");
                                        while ($rowc05 = mysqli_fetch_array($qur05)) {
                                            $lnnm = $rowc05["line_name"];
                                        }
                                        echo "<option value='" . $row1['station_id'] . "' $entry >" . $lnnm . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="pd-30 pd-sm-20">
                        <div class="row row-xs">
                            <div class="col-md-1">
                                <label class="form-label mg-b-0">Date From : </label>
                            </div>
                            <div class="col-md-5 mg-t-10 mg-md-t-0">
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input class="form-control fc-datepicker" name="date_from" id="date_from" value="<?php echo $datefrom; ?>" placeholder="MM/DD/YYYY" type="text">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <label class="form-label mg-b-0">Date To : </label>
                            </div>
                            <div class="col-md-5 mg-t-10 mg-md-t-0">
                                <div class="input-group">
                                    <div class="input-group-text">
                                        <i class="fa fa-calendar"></i>
                                    </div>
                                    <input class="form-control fc-datepicker" name="date_to" id="date_to" value="<?php echo $dateto; ?>"placeholder="MM/DD/YYYY" type="text">
                                </div>
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
                                <button type="submit" class="btn btn-primary mg-t-5 submit_btn">Search</button>&nbsp;&nbsp;
                                <button type="button" class="btn btn-primary mg-t-5" onclick="window.location.reload();">Reset</button>

    </form>
                            <form action="export_crew_log.php" method="post" name="export_excel">
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
<?php
if(count($_POST) > 0)
{
?>
<div class="row-body">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="card-body pt-0">
                    <div class="table-responsive">
    <table class="table  table-bordered text-nowrap mb-0" id="example2">
        <thead>
        <tr>
            <th>S.No</th>
            <th>User</th>
            <th>Station</th>
            <th>Position</th>
            <th>Assign Time</th>
            <th>Unassign Time</th>
            <th>Total Assign Time</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $datefrom = date("Y-m-d", strtotime($datefrom));
        $dateto = date("Y-m-d", strtotime($dateto));
        $qur = mysqli_query($db, "SELECT `user_id`,`station_id`,`position_id`,`assign_time`,`unassign_time`,`total_time`  as time FROM `cam_assign_crew_log` WHERE DATE_FORMAT(`assign_time`,'%Y-%m-%d') >= '$datefrom' and DATE_FORMAT(`assign_time`,'%Y-%m-%d') <= '$dateto' ");
        if (count($_GET) > 0) {
            $ln = $_GET['line'];
            $datefrom = date("Y-m-d", strtotime($datefrom));
            $dateto = date("Y-m-d", strtotime($dateto));
            $qur = mysqli_query($db, "SELECT `user_id`,`station_id`,`position_id`,`assign_time`,`unassign_time`,`total_time`  as time FROM `cam_assign_crew_log` WHERE DATE_FORMAT(`assign_time`,'%Y-%m-%d') >= '$curdate' and DATE_FORMAT(`assign_time`,'%Y-%m-%d') <= '$curdate' and `station_id` = '$ln'");
        }
        if (count($_POST) > 0) {
            $name = $_POST['usr'];
            $station = $_POST['station'];
            $dateto = $_POST['date_to'];
            $datefrom = $_POST['date_from'];

                if ($name != "" && $station != "" && $datefrom != "" && $dateto != "") {
                    $datefrom = date("Y-m-d", strtotime($datefrom));
                    $dateto = date("Y-m-d", strtotime($dateto));
                    $qur = mysqli_query($db, "SELECT `user_id`,`station_id`,`position_id`,`assign_time`,`unassign_time`,`total_time`  as time FROM `cam_assign_crew_log` WHERE DATE_FORMAT(`assign_time`,'%Y-%m-%d') >= '$datefrom' and DATE_FORMAT(`assign_time`,'%Y-%m-%d') <= '$dateto' and `user_id` = '$name' and `station_id` = '$station'");
                } else if ($name != "" && $station != "" && $datefrom == "" && $dateto == "") {
                    $qur = mysqli_query($db, "SELECT `user_id`,`station_id`,`position_id`,`assign_time`,`unassign_time`,`total_time`  as time FROM `cam_assign_crew_log` WHERE  `station_id` = '$station' and `user_id` = '$name'");
                } else if ($name != "" && $station == "" && $datefrom != "" && $dateto != "") {
                    $datefrom = date("Y-m-d", strtotime($datefrom));
                    $dateto = date("Y-m-d", strtotime($dateto));
                    $qur = mysqli_query($db, "SELECT `user_id`,`station_id`,`position_id`,`assign_time`,`unassign_time`,`total_time`  as time FROM `cam_assign_crew_log` WHERE DATE_FORMAT(`assign_time`,'%Y-%m-%d') >= '$datefrom' and DATE_FORMAT(`assign_time`,'%Y-%m-%d') <= '$dateto' and `user_id` = '$name' ");
                } else if ($name != "" && $station == "" && $datefrom == "" && $dateto == "") {
                    $qur = mysqli_query($db, "SELECT `user_id`,`station_id`,`position_id`,`assign_time`,`unassign_time`,`total_time`  as time FROM `cam_assign_crew_log` WHERE `user_id` = '$name'");
                } else if ($name == "" && $station != "" && $datefrom != "" && $dateto != "") {
                    $datefrom = date("Y-m-d", strtotime($datefrom));
                    $dateto = date("Y-m-d", strtotime($dateto));
                    $qur = mysqli_query($db, "SELECT `user_id`,`station_id`,`position_id`,`assign_time`,`unassign_time`,`total_time`  as time FROM `cam_assign_crew_log` WHERE DATE_FORMAT(`assign_time`,'%Y-%m-%d') >= '$datefrom' and DATE_FORMAT(`assign_time`,'%Y-%m-%d') <= '$dateto' and `station_id` = '$station'");
                } else if ($name == "" && $station != "" && $datefrom == "" && $dateto == "") {
                    $qur = mysqli_query($db, "SELECT `user_id`,`station_id`,`position_id`,`assign_time`,`unassign_time`,`total_time`  as time FROM `cam_assign_crew_log` WHERE  `station_id` = '$station'");
                } else if ($name == "" && $station == "" && $datefrom != "" && $dateto != "") {
                    $datefrom = date("Y-m-d", strtotime($datefrom));
                    $dateto = date("Y-m-d", strtotime($dateto));
                    $qur = mysqli_query($db, "SELECT `user_id`,`station_id`,`position_id`,`assign_time`,`unassign_time`,`total_time`  as time FROM `cam_assign_crew_log` WHERE DATE_FORMAT(`assign_time`,'%Y-%m-%d') >= '$datefrom' and DATE_FORMAT(`assign_time`,'%Y-%m-%d') <= '$dateto' ");
                }

        }
        while ($rowc = mysqli_fetch_array($qur)) {
            $dateTime = $rowc["assign_time"];
            $dateTime2 = $rowc["unassign_time"];

            ?>
            <tr>
                <td><?php echo ++$counter; ?></td>
                <?php
                $un = $rowc['user_id'];
                $qur04 = mysqli_query($db, "SELECT * FROM  cam_users where users_id = '$un' ");
                while ($rowc04 = mysqli_fetch_array($qur04)) {
                    $first = $rowc04["firstname"];
                    $last = $rowc04["lastname"];
                }
                ?>
                <td><?php echo $first; ?>&nbsp;<?php echo $last; ?></td>
                <?php
                $un = $rowc['station_id'];
                $qur04 = mysqli_query($db, "SELECT * FROM  cam_line where line_id = '$un' ");
                while ($rowc04 = mysqli_fetch_array($qur04)) {
                    $lnn = $rowc04["line_name"];
                }
                ?>
                <td><?php echo $lnn; ?></td>
                <?php
                $un = $rowc['position_id'];
                $qur04 = mysqli_query($db, "SELECT * FROM  cam_position where position_id = '$un' ");
                while ($rowc04 = mysqli_fetch_array($qur04)) {
                    $pnn = $rowc04["position_name"];
                }
                ?>
                <td><?php echo $pnn; ?></td>
                <td><?php echo dateReadFormat($rowc["assign_time"]); ?></td>
                <?php
                $unas = $rowc["unassign_time"];
                $as = $rowc["assign_time"];
                if ($unas == $as) {
                    $unasign = "Still Assigned";
                } else {
                    $unasign = $unas;
                }
                ?>
                <td><?php echo dateReadFormat($unasign); ?></td>
                <?php
                $zero_time = '00:00:00';
                $database_time = $rowc["time"];
                if ($zero_time == $database_time) {
                    $database_time = "Still Assigned";
                }
                ?>
                <td><?php echo $database_time; ?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
</div>
<script>
    $('#date_to').datepicker({ dateFormat: 'mm-dd-yy' });
    $('#date_from').datepicker({ dateFormat: 'mm-dd-yy' });
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
<script>
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
<script>
    $(document).on("click","#submit_btn",function() {

        var station = $("#station").val();
        var usr = $("#usr").val();

        $("#user_form").submit();
    });
</script>
<script>
    $(function(){
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;

        $('#date_to').attr('max', maxDate);
        $('#date_from').attr('max', maxDate);
    });
</script>
<script>
    window.onload = function() {
        history.replaceState("", "", "<?php echo $scriptName; ?>log_module/assign_crew_log.php");
    }
</script>
<?php include('../footer1.php') ?>
</body>
</html>