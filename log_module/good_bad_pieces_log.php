<?php include("../config.php");
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
$button_event = "button3";
if (empty($dateto)) {
    $curdate = date(mdY_FORMAT);
    $dateto = $curdate;
}

if (empty($datefrom)) {
    $yesdate = date(mdY_FORMAT, strtotime("-1 days"));
    $datefrom = $yesdate;
}
$button = "";
$temp = "";
// if (!isset($_SESSION['user'])) {
// 	header('location: logout.php');
// }
$_SESSION['station'] = "";
$_SESSION['date_from'] = "";
$_SESSION['date_to'] = "";
$_SESSION['button'] = "";
$_SESSION['timezone'] = "";
$_SESSION['button_event'] = "";
$_SESSION['event_type'] = "";
$_SESSION['event_category'] = "";
$_SESSION['pf'] = "";
$_SESSION['pn'] = "";

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
    $sta = $_POST['station'];
    $pf = $_POST['part_family'];
    $pn = $_POST['part_number'];
    if (empty($station1) || $station1 == "0") {
        $qurtemp = mysqli_query($db, "SELECT * FROM  cam_line where enabled = '1' and is_deleted != 1 ");
        while ($rowctemp = mysqli_fetch_array($qurtemp)) {
            $station1 = $rowctemp["line_name"];
        }
    } else {
        $qurtemp = mysqli_query($db, "SELECT * FROM  cam_line where line_id = '$station1' ");
        while ($rowctemp = mysqli_fetch_array($qurtemp)) {
            $station1 = $rowctemp["line_name"];
        }
    }

}

if (empty($dateto)) {
    $curdate = date('Y-m-d');
    $dateto = $curdate;
}

if (empty($datefrom)) {
    $yesdate = date('Y-m-d', strtotime("-1 days"));
    $datefrom = $yesdate;
}

$wc = '';

if (isset($station)) {
    if (!empty($station) && $station != 'all') {
        $wc = $wc . " and sg_station_event.line_id = '$station'";
    }
}
if (isset($pf)) {
    $_SESSION['pf'] = $pf;
    $wc = $wc . " and sg_station_event.part_family_id = '$pf'";
}
if (isset($pn)) {
    $_SESSION['pn'] = $pn;
    $wc = $wc . " and sg_station_event.part_number_id = '$pn'";
}

/* If Data Range is selected */
if ($button == "button1") {
    if (isset($datefrom)) {
		$date_from = date('Y-m-d', strtotime($datefrom));
        $wc = $wc . " and DATE_FORMAT(`created_at`,'%Y-%m-%d') >= '$date_from' ";
    }
    if (isset($dateto)) {
		$date_to = date("Y-m-d", strtotime($dateto));
        $wc = $wc . " and DATE_FORMAT(`created_at`,'%Y-%m-%d') <= '$date_to' ";
    }
} else if ($button == "button2") {
    /* If Date Period is Selected */
    $curdate = date('Y-m-d');
    if ($timezone == "7") {
        $countdate = date('Y-m-d', strtotime('-7 days'));
    } else if ($timezone == "1") {
        $countdate = date('Y-m-d', strtotime('-1 days'));
    } else if ($timezone == "30") {
        $countdate = date('Y-m-d', strtotime('-30 days'));
    } else if ($timezone == "90") {
        $countdate = date('Y-m-d', strtotime('-90 days'));
    } else if ($timezone == "180") {
        $countdate = date('Y-m-d', strtotime('-180 days'));
    } else if ($timezone == "365") {
        $countdate = date('Y-m-d', strtotime('-365 days'));
    }
    if (isset($countdate)) {
		$countdate = date("Y-m-d", strtotime($countdate));
		$curdate = date("Y-m-d", strtotime($curdate));
        $wc = $wc . " AND DATE_FORMAT(`created_at`,'%Y-%m-%d') >= '$countdate' and DATE_FORMAT(created_at,'%Y-%m-%d') <= '$curdate' ";
    }
} else {
	$date_from =  convertMDYToYMD($datefrom);
	$date_to = convertMDYToYMD($dateto);
    $wc = $wc . " and DATE_FORMAT(`created_at`,'%Y-%m-%d') >= '$date_from' and DATE_FORMAT(`created_at`,'%Y-%m-%d') <= '$date_to' ";
}

$sql = "SELECT SUM(good_pieces) AS good_pieces,SUM(bad_pieces)AS bad_pieces,SUM(rework) AS rework FROM `good_bad_pieces`  INNER JOIN sg_station_event ON good_bad_pieces.station_event_id = sg_station_event.station_event_id where 1 " . $wc;
$response = array();
$posts = array();
$result = mysqli_query($db, $sql);
//$result = $mysqli->query($sql);
$data = array();
if (null != $result) {
    while ($row = $result->fetch_assoc()) {
        $posts[] = array('good_pieces' => $row['good_pieces'], 'bad_pieces' => $row['bad_pieces'], 'rework' => $row['rework']);
    }
}

$response['posts'] = $posts;
//$fp = fopen('./results.json', 'w');
//fwrite($fp, json_encode($response));
//fclose($fp);
if (null == $sta) {
    $sta = '';
}
$fp = fopen('results.json', 'w');
fwrite($fp, json_encode($response));
fclose($fp);

//$sql1 = "SELECT bad_pieces,defect_name FROM `good_bad_pieces_details`";
$sql1 = "SELECT good_bad_pieces_details.defect_name,SUM(good_bad_pieces_details.rework) AS rework,SUM(good_bad_pieces_details.bad_pieces) AS bad_pieces FROM `good_bad_pieces_details` INNER JOIN sg_station_event ON good_bad_pieces_details.station_event_id = sg_station_event.station_event_id WHERE defect_name IS NOT NULL " . $wc . " GROUP BY defect_name";
$response1 = array();
$posts1 = array();
$result1 = mysqli_query($db, $sql1);
//$result = $mysqli->query($sql);
$data = array();
if (null != $result1) {
    while ($row = $result1->fetch_assoc()) {
//	$posts1[] = array( 'bad_pieces'=> $row['bad_pieces'], 'rework'=> $row['rework'],'defect_name'=> $row['defect_name']);
        $posts1[] = array($row['defect_name'], $row['bad_pieces'], $row['rework']);
    }
}

$response1['posts1'] = $posts1;
$fp = fopen('results1.json', 'w');
fwrite($fp, json_encode($response1));
fclose($fp);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo $sitename; ?> | Good Bad Pieces Log</title>
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
    <!-- Anychart starts-->
    <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-base.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-data-adapter.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-ui.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-exports.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-pareto.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-circular-gauge.min.js"></script>
    <link href="https://cdn.anychart.com/releases/8.11.0/css/anychart-ui.min.css" type="text/css" rel="stylesheet">
    <link href="https://cdn.anychart.com/releases/8.11.0/fonts/css/anychart-font.min.css" type="text/css" rel="stylesheet">
    <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-base.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-data-adapter.min.js"></script>
    <script src="<?php echo $siteURL; ?>assets/js/charts/anychart/anychart-ui.min.js"></script>
    <script src="<?php echo $siteURL; ?>assets/js/charts/anychart/anychart-pareto.min.js"></script>
    <script src="<?php echo $siteURL; ?>assets/js/charts/anychart/anychart-exports.min.js"></script>
    <script src="<?php echo $siteURL; ?>assets/js/charts/anychart/anychart-data-adapter.min.js"></script>
    <script src="<?php echo $siteURL; ?>assets/js/charts/anychart/anychart-circular-gauge.min.js"></script>
    <script src="<?php echo $siteURL; ?>assets/js/charts/anychart/anychart-base.min.js"></script>
    <link href="<?php echo $siteURL; ?>assets/css/anychart/anychart-ui.min.css" rel="stylesheet">
    <link href="<?php echo $siteURL; ?>assets/css/anychart/anychart-font.min.css" rel="stylesheet">
    <!-- Anychart ends-->


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
        .anychart-credits{
            display: none;
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

<!-- Main navbar -->
<?php
$cust_cam_page_header = "Add / Create Form";
include("../header.php");
include("../admin_menu.php");
?>
<body class="ltr main-body app sidebar-mini">
<!-- main-content -->
<div class="main-content app-content">
    <div class="row-body">
        <div class="col-lg-12 col-md-12">
            <div class="breadcrumb-header justify-content-between">
                <div class="left-content">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Logs</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Good Bad Piece Log</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
            <div class="row-body">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <form action="" id="good_bad_piece_form" class="form-horizontal" method="post">
                        <div class="card-body">
                            <div class="card-header">
                                <span class="main-content-title mg-b-0 mg-b-lg-1">GOOD BAD PIECE LOG</span>
                            </div>
                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs">
                                    <div class="col-md-1">
                                        <label class="form-label mg-b-0">Station</label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <select name="station" id="station" class="form-control form-select select2" data-placeholder="Select Station">
                                            <option value="" selected> Select Station </option>
                                            <!--<option value="0" selected>All</option>-->
                                            <?php
                                            $entry = '';
                                            $a = 'All';
                                            $b = '0';
                                            echo "<option value='". $b ."'  $entry selected>" . $a . "</option>";
                                            $st_dashboard = $_POST['station'];
                                            $sql1 = "SELECT * FROM `cam_line` where enabled = '1' and is_deleted != 1 ORDER BY `line_id` ASC";
                                            $result1 = $mysqli->query($sql1);
                                            while ($row1 = $result1->fetch_assoc()) {
                                                if ($st_dashboard == $row1['line_id']) {
                                                    $entry = 'selected';
                                                } else {
                                                    $entry = '';

                                                }
                                                echo "<option value='" . $row1['line_id'] . "'  $entry>" . $row1['line_name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-1"></div>
                                    <div class="col-md-1">
                                        <label class="form-label mg-b-0">Part Family</label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <select name="part_family" id="part_family" class="form-control form-select select2" data-placeholder="Select Part Family">
                                            <option value="" selected disabled> Select Part Family </option>
                                            <?php
                                            $st_dashboard = $_POST['part_family'];
                                            $station = $_POST['station'];
                                            $sql1 = "SELECT * FROM `pm_part_family` where is_deleted != 1 and station = '$station'";
                                            $result1 = $mysqli->query($sql1);
                                            while ($row1 = $result1->fetch_assoc()) {
                                                if ($st_dashboard == $row1['pm_part_family_id']) {
                                                    $entry = 'selected';
                                                } else {
                                                    $entry = '';
                                                }
                                                echo "<option value='" . $row1['pm_part_family_id'] . "' $entry >" . $row1['part_family_name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                </div>

                            </div>
                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs">
                                    <div class="col-md-1">
                                        <label class="form-label mg-b-0">Part Number</label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <select name="part_number" id="part_number" class="form-control form-select select2" data-placeholder="Select Part Number">
                                            <option value="" selected disabled> Select Part Number </option>
                                            <?php
                                            $st_dashboard = $_POST['part_number'];
                                            $part_family = $_POST['part_family'];
                                            $sql1 = "SELECT * FROM `pm_part_number` where part_family = '$part_family' and is_deleted != 1 ";
                                            $result1 = $mysqli->query($sql1);
                                            while ($row1 = $result1->fetch_assoc()) {
                                                if ($st_dashboard == $row1['pm_part_number_id']) {
                                                    $entry = 'selected';
                                                } else {
                                                    $entry = '';

                                                }
                                                echo "<option value='" . $row1['pm_part_number_id'] . "' $entry >" . $row1['part_number'] . " - " . $row1['part_name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-1"></div>

                                </div>

                            </div>
                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs">
                                    <div class="col-md-1">
                                        <label class="form-label mg-b-0">Date From</label>
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
                                        <label class="form-label mg-b-0">Date To</label>
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
                        </div>



                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs">
                                    <div class="col-md-2" style="max-width: 10.66667%;">
                                <button type="submit" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5 submit_btn">Submit</button>
                                    </div>
                                    <div class="col-md-2">
                                <button type="button" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5" onclick='window.location.reload();'>Reset</button>
                                    </div>
                            </form>
                                <div class="col-md-3" style="margin-left: -78px;">
                                <form action="export_good_bad_piece.php" method="post" name="export_excel">
                                <button type="submit" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5" id="export" name="export">Export Data</button>
                                </form>
                                     </div>
                            </div>
                           </div>
                        </div>
                </div>
         </div>

           <div class="row-body">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">GRAPH</span>
                        </div>
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <div id="gf_container" style="height: 500px; width: 100%;"></div>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <div id="gf_container1" style="height: 500px; width: 100%;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
          <?php if($pn != "" && $pf != ""){ ?>
           <div class="row-body">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">

                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">

                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <div id="bsr_container" style="height: 450px;border:1px solid #efefef; margin-top: 20px; "></div>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <div id="npr_container" style="height: 450px;border:1px solid #efefef; margin-top: 20px;"></div>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <div id="eff_container" style="height: 450px;border:1px solid #efefef; margin-top: 20px;"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
          <?php } ?>
            <div class="row-body">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header">
                                <span class="main-content-title mg-b-0 mg-b-lg-1">SHIFT WISE GOOD PIECES, BAD PIECES & REWORK</span>
                            </div>
                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs">
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <div id="container" style="height: 500px; width: 100%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


</div>

<script>
    $('#date_from').datepicker({ dateFormat: 'mm-dd-yy' });
    $('#date_to').datepicker({ dateFormat: 'mm-dd-yy' });
    $('#station').on('change', function (e) {
        $("#good_bad_piece_form").submit();
    });

    //$('#export').on('click', function (e) {
    //    var data = $("#good_bad_piece_form").serialize();
    //    var main_url = "<?php //echo $siteURL . "log_module/export_good_bad_piece.php"; ?>//";
    //    $.ajax({
    //        type: 'POST',
    //        url: main_url,
    //        data: data,
    //        success: function (data) {
    //            // window.location.href = window.location.href + "?aa=Line 1";
    //            // $(':input[type="button"]').prop('disabled', false);
    //            // location.reload();
    //        }
    //    });
    //});
    $('#part_family').on('change', function (e) {
        $("#good_bad_piece_form").submit();
    });
    anychart.onDocumentReady(function () {
        var data = $("#good_bad_piece_form").serialize();
        $.ajax({
            type: 'POST',
            url: 'good_bad_piece_fa.php',
            // dataType: 'good_bad_piece_fa.php',
            data: data + "&fa_op=1",
            success: function (data1) {
                var data = JSON.parse(data1);
                // console.log(data);
                var good_pieces = data.posts.map(function (elem) {
                    return elem.good_pieces;
                });
                // console.log(goodpiece);
                var bad_pieces = data.posts.map(function (elem) {
                    return elem.bad_pieces;
                });
                var rework = data.posts.map(function (elem) {
                    return elem.rework;
                });
                var data = [
                    {x: 'Good Pieces', value: good_pieces, fill: '#177b09'},
                    {x: 'Bad Pieces', value: bad_pieces, fill: '#BE0E31'},
                    {x: 'Rework', value: rework, fill: '#2643B9'},
                ];
                // create pareto chart with data
                var chart = anychart.pareto(data);
                // set chart title text settings
                chart.labels().fontSize(14);
                // chart.title('Good Pieces & Bad Pieces');
                var title = chart.title();
                title.enabled(true);
//enables HTML tags
                title.useHtml(true);
                title.text(
                    "<br><br>" + "Good Pieces & Bad Pieces" +
                    "<br><br><br>"
                );

                // set measure y axis title
                chart.yAxis(0).title('Numbers');
                // cumulative percentage y axis title
                chart.yAxis(1).title(' Percentage');
                // set interval
                chart.yAxis(1).scale().ticks().interval(10);

                // get pareto column series and set settings
                var column = chart.getSeriesAt(0);

                column.labels().enabled(true).format('{%Value}');
                column.tooltip().format('Value: {%Value}');

                // background border color
                // column.labels().background().stroke("#663399");
                column.labels().background().enabled(true).stroke("Green");

                var labels = chart.xAxis().labels();
                labels.fontFamily("Courier");
                labels.fontSize(14);
                labels.fontColor("#125393");
                labels.fontWeight("bold");
                labels.useHtml(false);

                // get pareto line series and set settings
                var line = chart.getSeriesAt(1);
                line
                    .tooltip()
                    // .format('Good Pieces: {%CF}% \n Bad Pieces: {%RF}%');
                    .format('Percent : {%RF}%');

                // turn on the crosshair and set settings
                chart.crosshair().enabled(true).xLabel(false);
                chart.xAxis().labels().rotation(-90);

                // set container id for the chart
                chart.container('gf_container');
                // initiate chart drawing
                chart.draw();
            }
        });
    });

</script>
<script>

    anychart.onDocumentReady(function () {
        var data = $("#good_bad_piece_form").serialize();
        $.ajax({
            type: 'POST',
            url: 'good_bad_piece_fa.php',
            // dataType: 'good_bad_piece_fa.php',
            data: data + "&fa_op=0",
            success: function (data1) {
                var data = JSON.parse(data1);
                //var data = JSON.parse(this.responseText);
                // console.log(data);
                // create a data set
                var data = anychart.data.set(data.posts1);

                // map the data
                var seriesData_1 = data.mapAs({x: 0, value: 1});
                // var seriesData_2 = data.mapAs({x: 0, value: 2 });

                // create a chart
                var chart = anychart.column();
                // turn on X Scroller
                chart.xScroller(true);
                chart.xZoom().setToPointsCount(5, false);
                chart.labels().fontSize(14);
                // enable HTML for tooltips
                chart.tooltip().useHtml(true);

// tooltip settings
                var tooltip = chart.tooltip();
                tooltip.positionMode("point");
                tooltip.format("Defect Count: <b>{%value}</b>\nPercent: <b>{%RF}%</b>\n");


                // create the first series, set the data and name
                var series1 = chart.column(seriesData_1);
                series1.name("Defect");

                // configure the visual settings of the first series
                series1.normal().fill("#BE0E31", 1);
                series1.hovered().fill("#BE0E31", 0.8);
                series1.selected().fill("#BE0E31", 0.5);
                series1.normal().stroke("#BE0E31");
                series1.hovered().stroke("#BE0E31", 2);
                series1.selected().stroke("#BE0E31", 4);
                series1.labels().enabled(true);
                // background settings
                var background = series1.labels().background();
                background.enabled(true);
                background.fill("#ffffff");
                background.stroke("green");
                background.cornerType("round");
                background.corners(5);
                // series1.labels().fontsize(14);


                //var chart = anychart.pareto(data);
                // set the chart title
                //chart.title("'Good Piece Bad Piece'");
                // enable title
                var title = chart.title();
                title.enabled(true);
//enables HTML tags
                title.useHtml(true);
                title.text(
                    "<br><br>" + "Bad Piece(s) - Defects" +
                    "<br><br><br>"
                );

                // set the titles of the axes
                chart.xAxis().title("Defect(s)");
                chart.yAxis(0).title("Numbers");
                // cumulative percentage y axis title
                // chart.yAxis(1).title(' Percentage');
                // set interval
                // chart.yAxis(1).scale().ticks().interval(10);
                // cumulative percentage y axis title
                // chart.yAxis(1).title(' Percentage');
                // set interval
                // chart.yAxis(1).scale().ticks().interval(10);
                chart.xGrid().enabled(true);
                chart.yGrid().enabled(true);
                chart.xAxis().labels().rotation(-90);

                var xLabels = chart.xAxis().labels();
                xLabels.width(150);
                xLabels.wordWrap("break-word");
                // xLabels.wordBreak("break-all");

                var labels = chart.xAxis().labels();
                labels.fontFamily("Courier");
                labels.fontSize(14);
                labels.fontColor("#125393");
                labels.fontWeight("bold");
                labels.useHtml(false);

                // set the container id
                chart.container("gf_container1");

                // initiate drawing the chart
                chart.draw();
            }
        });
    });

</script>
<script>
    //BSR
    anychart.onDocumentReady(function () {
        var data = $("#good_bad_piece_form").serialize();
        $.ajax({
            type: 'POST',
            url: 'good_bad_piece_fa.php',
            // dataType: 'good_bad_piece_fa.php',
            data: data + "&fa_op=2",
            success: function (data1) {
                var data = JSON.parse(data1);
                // console.log(data);
                var bsr = data.posts.map(function (elem) {
                    return elem.bsr;
                });
                // console.log(goodpiece);
                var avg_bsr = data.posts.map(function (elem) {
                    return elem.avg_bsr;
                });
                var actual_bsr = data.posts.map(function (elem) {
                    return elem.actual_bsr;
                });

                var gauge = anychart.gauges.circular();
                gauge
                    .fill('#fff')
                    .stroke(null)
                    .padding(20)
                    .margin(0)
                    .startAngle(270)
                    .sweepAngle(180);

                gauge
                    .axis()
                    .labels()
                    .padding(5)
                    .fontSize(10)
                    .position('outside')
                    .format('{%Value}%');

                gauge.data([actual_bsr]);
                gauge
                    .axis()
                    .scale()
                    .minimum(0)
                    .maximum(20)
                    .ticks({interval: 1})
                    .minorTicks({interval: 1});

                gauge
                    .axis()
                    .fill('#545f69')
                    .width(1)
                    .ticks({type: 'line', fill: 'white', length: 2});

                gauge.title(
                    '<div style=\'color:#333; font-size: 18px;\'>Budget Scrap Rate - <span style="color:#009900; font-size: 20px;"><strong> ' + bsr + ' </strong>%</span></div>' +
                    '<br/><br/><div style=\'color:#333; font-size: 18px;\'>Actual Scrap Rate <span style="color:#009900; font-size: 20px;"><strong> ' + actual_bsr + ' </strong>% </span></div><br/><br/>'
                );

                gauge
                    .title()
                    .useHtml(true)
                    .padding(0)
                    .fontColor('#212121')
                    .hAlign('center')
                    .margin([0, 0, 10, 0]);

                gauge
                    .needle()
                    .stroke('2 #545f69')
                    .startRadius('5%')
                    .endRadius('90%')
                    .startWidth('0.1%')
                    .endWidth('0.1%')
                    .middleWidth('0.1%');

                gauge.cap().radius('3%').enabled(true).fill('#545f69');

                gauge.range(0, {
                    from: 0,
                    to: avg_bsr,
                    position: 'inside',
                    fill: '#009900 0.8',
                    startSize: 50,
                    endSize: 50,
                    radius: 98
                });

                gauge.range(1, {
                    from: avg_bsr,
                    to: bsr,
                    position: 'inside',
                    fill: '#ffa000 0.8',
                    startSize: 50,
                    endSize: 50,
                    radius: 98
                });

                gauge.range(2, {
                    from: bsr,
                    to: 20,
                    position: 'inside',
                    fill: '#B31B1B 0.8',
                    startSize: 50,
                    endSize: 50,
                    radius: 98

                });

                gauge
                    .label(1)
                    .text('')
                    .fontColor('#212121')
                    .fontSize(20)
                    .offsetY('68%')
                    .offsetX(25)
                    .anchor('center');
                gauge
                    .label(2)
                    .text('')
                    .fontColor('#212121')
                    .fontSize(20)
                    .offsetY('68%')
                    .offsetX(90)
                    .anchor('center');

                gauge
                    .label(3)
                    .text('')
                    .fontColor('#212121')
                    .fontSize(20)
                    .offsetY('68%')
                    .offsetX(155)
                    .anchor('center');


                // set container id for the chart
                gauge.container('bsr_container');
                // initiate chart drawing
                gauge.draw();
            }
        });
    });

</script>
<script>
    anychart.onDocumentReady(function () {
        var data = $("#good_bad_piece_form").serialize();
        $.ajax({
            type: 'POST',
            url: 'good_bad_piece_fa.php',
            // dataType: 'good_bad_piece_fa.php',
            data: data + "&fa_op=3",
            success: function (data1) {
                var data = JSON.parse(data1);
                // console.log(data);
                var npr = data.posts.map(function (elem) {
                    return elem.npr;
                });
                // console.log(goodpiece);
                // var avg_npr = data.posts.map(function (elem) {
                //     return elem.avg_npr;
                // });
                var actual_npr = data.posts.map(function (elem) {
                    return elem.actual_npr;
                });
                // var range1 = avg_npr;
                var range1 = actual_npr;
                var range2 = npr;

                var fill3 = '#009900 0.8';
                var fill2 = '#B31B1B 0.8';
                var fill1 = '#B31B1B 0.8';

                var maxr3 = parseFloat(range2) + parseFloat(range2 * .2)


                if ((actual_npr >= npr)) {
                    range1 = npr;
                    // range2 = avg_npr;
                    range2 = actual_npr;
                    fill1 = '#009900 0.8';
                    fill2 = '#009900 0.8';
                    fill3 = '#B31B1B 0.8';
                    maxr3 = parseFloat(actual_npr) + parseFloat(actual_npr * .2)
                }

                var gauge = anychart.gauges.circular();
                gauge
                    .fill('#fff')
                    .stroke(null)
                    .padding(50)
                    .margin(0)
                    .startAngle(270)
                    .sweepAngle(180);

                gauge
                    .axis()
                    .labels()
                    .padding(5)
                    .fontSize(20)
                    .position('outside')
                    .format('{%Value}');

                gauge.data([actual_npr]);
                gauge
                    .axis()
                    .scale()
                    .minimum(0)
                    .maximum(maxr3)
                    .ticks({interval: 1})
                    .minorTicks({interval: 1});

                gauge
                    .axis()
                    .fill('#545f69')
                    .width(1)
                    .ticks({type: 'line', fill: 'white', length: 2});

                gauge.title(
                    '<div style=\'font-weight: 900;font-size:24px;margin-bottom:50px\'>Target Net Pack Rate - <span style="color:#009900; font-size: 22px;"><strong> ' + npr + ' </strong> per hour </span></div>' +
                    '<br/><br/><div style=\'color:#333; font-size: 24px;\'>Actual NPR <span style="color:#009900; font-size: 22px;"><strong> ' + actual_npr + ' </strong> per hour </span></div><br/><br/>'
                );

                gauge
                    .title()
                    .useHtml(true)
                    .padding(0)
                    .fontColor('#212121')
                    .hAlign('center')
                    .margin([0, 0, 10, 0]);

                gauge
                    .needle()
                    .stroke('2 #545f69')
                    .startRadius('5%')
                    .endRadius('90%')
                    .startWidth('0.1%')
                    .endWidth('0.1%')
                    .middleWidth('0.1%');

                gauge.cap().radius('3%').enabled(true).fill('#545f69');

                gauge.range(0, {
                    from: 0,
                    to: range1,
                    position: 'inside',
                    fill: fill1,
                    startSize: 50,
                    endSize: 50,
                    radius: 98
                });

                gauge.range(1, {
                    from: range1,
                    to: range2,
                    position: 'inside',
                    fill: fill2,
                    startSize: 50,
                    endSize: 50,
                    radius: 98
                });

                gauge.range(2, {
                    from: range2,
                    to: (maxr3),
                    position: 'inside',
                    fill: '#009900 0.8',
                    startSize: 50,
                    endSize: 50,
                    radius: 98

                });

                gauge
                    .label(1)
                    .text('')
                    .fontColor('#212121')
                    .fontSize(20)
                    .offsetY('68%')
                    .offsetX(25)
                    .anchor('center');
                gauge
                    .label(2)
                    .text('')
                    .fontColor('#212121')
                    .fontSize(20)
                    .offsetY('68%')
                    .offsetX(90)
                    .anchor('center');

                gauge
                    .label(3)
                    .text('')
                    .fontColor('#212121')
                    .fontSize(20)
                    .offsetY('68%')
                    .offsetX(155)
                    .anchor('center');


                // set container id for the chart
                gauge.container('npr_container');
                // initiate chart drawing
                gauge.draw();
            }
        });
    });
</script>
<script>
    anychart.onDocumentReady(function () {
        var data = $("#good_bad_piece_form").serialize();
        $.ajax({
            type: 'POST',
            url: 'good_bad_piece_fa.php',
            // dataType: 'good_bad_piece_fa.php',
            data: data + "&fa_op=4",
            success: function (data1) {
                var data = JSON.parse(data1);
                // console.log(data);
                var target_eff = data.posts.map(function (elem) {
                    return elem.target_eff;
                });
                // console.log(goodpiece);
                // var avg_npr = data.posts.map(function (elem) {
                //     return elem.avg_npr;
                // });
                var actual_eff = data.posts.map(function (elem) {
                    return elem.actual_eff;
                });

                var eff = data.posts.map(function (elem) {
                    return elem.eff;
                });
                // var range1 = avg_npr;
                var range1 = actual_eff;
                var range2 = target_eff;
                var range3 = eff;

                var fill3 = '#009900 0.8';
                var fill2 = '#B31B1B 0.8';
                var fill1 = '#B31B1B 0.8';

                var maxr3 = parseFloat(range2) + parseFloat(range2 * .2)


                if ((actual_eff >= target_eff)) {
                    range1 = target_eff;
                    // range2 = avg_npr;
                    range2 = actual_eff;
                    fill1 = '#009900 0.8';
                    fill2 = '#009900 0.8';
                    fill3 = '#B31B1B 0.8';
                    maxr3 = parseFloat(target_eff) + parseFloat(target_eff * .2)
                }

                var gauge = anychart.gauges.circular();
                gauge
                    .fill('#fff')
                    .stroke(null)
                    .padding(40)
                    .margin(0)
                    .startAngle(270)
                    .sweepAngle(180);

                gauge
                    .axis()
                    .labels()
                    .padding(5)
                    .fontSize(20)
                    .position('outside')
                    .format('{%Value}');

                gauge.data([actual_eff]);
                gauge
                    .axis()
                    .scale()
                    .minimum(0)
                    .maximum(maxr3)
                    .ticks({interval: 1})
                    .minorTicks({interval: 1});

                gauge
                    .axis()
                    .fill('#545f69')
                    .width(1)
                    .ticks({type: 'line', fill: 'white', length: 2});

                gauge.title(
                    '<div style=\'color:#333; font-size: 20px;\'>Target Pieces: <span style="color:#009900; font-size: 22px;"><strong> ' + target_eff + ' </strong><l/span></div>' +
                    '<br/><br/><div style=\'color:#333; font-size: 20px;\'>Actual Pieces: <span style="color:#009900; font-size: 22px;"><strong> ' + actual_eff + ' </strong></span></div><br/><br/>' +
                    '<div style=\'color:#333; font-size: 20px;\'>Efficiency: <span style="color:#009900; font-size: 22px;"><strong> ' + eff + ' </strong>%</span></div><br/><br/>'
                );
                gauge
                    .title()
                    .useHtml(true)
                    .padding(0)
                    .fontColor('#212121')
                    .hAlign('center')
                    .margin([0, 0, 10, 0]);

                gauge
                    .needle()
                    .stroke('2 #545f69')
                    .startRadius('5%')
                    .endRadius('90%')
                    .startWidth('0.1%')
                    .endWidth('0.1%')
                    .middleWidth('0.1%');

                gauge.cap().radius('3%').enabled(true).fill('#545f69');

                gauge.range(0, {
                    from: 0,
                    to: range1,
                    position: 'inside',
                    fill: fill1,
                    startSize: 50,
                    endSize: 50,
                    radius: 98
                });

                gauge.range(1, {
                    from: range1,
                    to: range2,
                    position: 'inside',
                    fill: fill2,
                    startSize: 50,
                    endSize: 50,
                    radius: 98
                });

                gauge.range(2, {
                    from: range2,
                    to: (maxr3),
                    position: 'inside',
                    fill: '#009900 0.8',
                    startSize: 50,
                    endSize: 50,
                    radius: 98

                });

                gauge
                    .label(1)
                    .text('')
                    .fontColor('#212121')
                    .fontSize(20)
                    .offsetY('68%')
                    .offsetX(25)
                    .anchor('center');
                gauge
                    .label(2)
                    .text('')
                    .fontColor('#212121')
                    .fontSize(20)
                    .offsetY('68%')
                    .offsetX(90)
                    .anchor('center');

                gauge
                    .label(3)
                    .text('')
                    .fontColor('#212121')
                    .fontSize(20)
                    .offsetY('68%')
                    .offsetX(155)
                    .anchor('center');


                // set container id for the chart
                gauge.container('eff_container');
                // initiate chart drawing
                gauge.draw();
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
                $('#period').prop('disabled', false);
                $('#timezone').prop('disabled', true);
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
    anychart.onDocumentReady(function () {
        var data = $("#good_bad_piece_form").serialize();
        $.ajax({
            type: 'POST',
            url: 'good_bad_piece_fa.php',
            // dataType: 'good_bad_piece_fa.php',
            data: data + "&fa_op=5",
            success: function (data1) {
                var data = JSON.parse(data1);
                // console.log(data);
                var good_pieces = data.posts.map(function (elem) {
                    return elem.good_pieces;
                });
                // console.log(goodpiece);
                var bad_pieces = data.posts.map(function (elem) {
                    return elem.bad_pieces;
                });
                var rework = data.posts.map(function (elem) {
                    return elem.rework;
                });
                var good_pieces1 = data.posts.map(function (elem) {
                    return elem.good_pieces1;
                });
                // console.log(goodpiece);
                var bad_pieces1 = data.posts.map(function (elem) {
                    return elem.bad_pieces1;
                });
                var rework1 = data.posts.map(function (elem) {
                    return elem.rework1;
                });
                var good_pieces2 = data.posts.map(function (elem) {
                    return elem.good_pieces2;
                });
                // console.log(goodpiece);
                var bad_pieces2 = data.posts.map(function (elem) {
                    return elem.bad_pieces2;
                });
                var rework2 = data.posts.map(function (elem) {
                    return elem.rework2;
                });
                var chart = anychart.column();

                var series1 = chart.column([
                    {x: 'Shift-1', value: good_pieces, fill: '#177b09'},
                    {x: 'Shift-2', value: good_pieces1, fill: '#177b09'},
                    {x: 'Shift-3', value: good_pieces2, fill: '#177b09'}
                ]);
                series1.name('Good Pieces');

                // Set point position.
                series1.xPointPosition(0.3);

                var series2 = chart.column([
                    {x: 'Shift-1', value: bad_pieces, fill: '#BE0E31'},
                    {x: 'Shift-2', value: bad_pieces1, fill: '#BE0E31'},
                    {x: 'Shift-3', value: bad_pieces2, fill: '#BE0E31'}
                ]);
                series2.name('Bad Pieces');

                // Set point position.
                series2.xPointPosition(0.5);

                var series3 = chart.column([
                    {x: 'Shift-1', value: rework, fill: '#2643B9'},
                    {x: 'Shift-2', value: rework1, fill: '#2643B9'},
                    {x: 'Shift-3', value: rework2, fill: '#2643B9'}
                ]);

                series3.name('Rework');

                // Set point position.
                series3.xPointPosition(0.7);

                series1
                    .fill("#6698FF .6")
                    .hovered().stroke("#0000A0", 4)
                    .stroke("#56561a", 4)
                    .hatchFill("diagonal-brick", "#348781")
                    .hovered().hatchFill("diagonal-brick", "#0000A0")

                series1.tooltip().enabled(true).title().enabled(true).text("Information:");
                series1.labels().enabled(true).anchor("top").position("top").fontSize(14);

                series2
                    .fill("#6698FF .6")
                    .hovered().stroke("#0000A0", 4)
                    .stroke("#56561a", 4)
                    .hatchFill("diagonal-brick", "#348781")
                    .hovered().hatchFill("diagonal-brick", "#0000A0")

                series2.tooltip().enabled(true).title().enabled(true).text("Information:");
                series2.labels().enabled(true).anchor("top").position("top").fontSize(14);

                series3
                    .fill("#6698FF .6")
                    .hovered().stroke("#0000A0", 4)
                    .stroke("#56561a", 4)
                    .hatchFill("diagonal-brick", "#348781")
                    .hovered().hatchFill("diagonal-brick", "#0000A0")

                series3.tooltip().enabled(true).title().enabled(true).text("Information:");
                series3.labels().enabled(true).anchor("top").position("top").fontSize(14);

// set container id for the chart
                chart.container("container");

                // set scale minimum
                chart.yScale().minimum(0);

                chart.title('Shift Wise Good Pieces,Bad Pieces & Rework');


                chart.container('container');
                chart.draw();

            }
        });
    });

</script>
<script>
    window.onload = function() {
        history.replaceState("", "", "<?php echo $scriptName; ?>log_module/good_bad_pieces_log.php");
    }
</script>
<?php include('../footer1.php') ?>
</body>
</html>
