<?php
include("../config.php");
$chicagotime = date("Y-m-d H:i:s");
$temp = "";
if (!isset($_SESSION['user'])) {
    header('location: ../logout.php');
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
//  header('location: ../logout.php');
    exit;
}
//Set the time of the user's last activity
$_SESSION['LAST_ACTIVITY'] = $time;

$i = $_SESSION["role_id"];
if ($i != "super" && $i != "admin") {
    header('location: ../dashboard.php');
}
$station_event_id = $_GET['station_event_id'];
$station = $_GET['station'];

$cellID = $_GET['cell_id'];
$c_name = $_GET['c_name'];

if(empty($_SESSION['$station_event_id'])){
    $_SESSION['good_timestamp_id'] = time();
}


$gp_timestamp = time();
$idd = preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo
|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i"
    , $_SERVER["HTTP_USER_AGENT"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo $sitename; ?> |Update rework piece</title>
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
<body class="ltr main-body app horizontal" onload="openScanner()">

<?php if (!empty($station) || !empty($station_event_id)){
    include("../cell-menu.php");
}else{
    include("../header.php");
    include("../admin_menu.php");
}
?>


    <div class="main-content app-content">
        <div class="main-container container-fluid">



        <!---container--->
    <!---breadcrumb--->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Admin Config</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update Rework Piece</li>
            </ol>
        </div>
    </div>
    <?php
        $station_event_id = $_GET['station_event_id'];
        $bad_pieces_id = $_GET['bad_pieces_id'];
        $query = sprintf("SELECT gbpd.bad_pieces_id as bad_pieces_id , gbpd.good_pieces as good_pieces, gbpd.defect_name as defect_name, gbpd.bad_pieces as bad_pieces ,gbpd.rework as rework FROM good_bad_pieces_details as gbpd where gbpd.station_event_id  = '$station_event_id' AND gbpd.bad_pieces_id = '$bad_pieces_id' order by gbpd.bad_pieces_id DESC");
        $qur = mysqli_query($db, $query);
        while ($result_good = mysqli_fetch_array($qur)) {
            $good_pieces = $result_good['good_pieces'];
            $good_bad_pieces_id = $result_good['good_bad_pieces_id'];
            $bad_pieces_id = $result_good['bad_pieces_id'];
            $defect_name = $result_good['defect_name'];
            $bad_pieces = $result_good['bad_pieces'];
            $rework = $result_good['rework'];

            ?>

 <form action="create_good_bad_piece.php" id="asset_update"  enctype="multipart/form-data" class="form-horizontal" method="post">
     <input type="hidden" name="station_event_id" id="station_event_id" class="form-control" value="<?php echo $station_event_id; ?>" >
        

        <div class="row-body">
            <div class="col-lg-12 col-md-12">
                
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">Update Rework Piece</span>
                        </div>

                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Defect Name:</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                     <input type="text" name="editdefect_name" id="editdefect_name" class="form-control" value="<?php echo $defect_name; ?>"  required readonly>
                                </div>
                            </div>
                        </div>

                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs" id="badpiece1">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Rework Pieces:</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <input type="number" name="editre_work" min="1" id="editre_work" class="form-control" placeholder="Enter Pieces..." value="<?php echo $rework; ?>" >
                                </div>
                            </div>
                        </div>
                         <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $good_bad_pieces_id; ?>">
                                    <input type="hidden" name="edit_gbid" id="edit_gbid" value="<?php echo $result_good['bad_pieces_id']; ?>">
                                    <input type="hidden" name="edit_seid" id="edit_seid" value="<?php echo $station_event_id; ?>">
                                    <input type="hidden" name="good_bad_piece_id" id="good_bad_piece_id" value="<?php echo $good_bad_pieces_id; ?>">

                         <div class="card-body pt-0">
                            <button type="submit"  id="submitForm_bad" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5 submit_btn">Submit</button>
                        </div>

                    </div>
                </div>
          
        </div>
    </div>
</form>
    <?php } ?>
        </div>

</div>
 <script>
        $(document).ready(function () {
            $('.select').select2();
        });


    </script>
    <script>
        window.onload = function() {
            history.replaceState("", "", "<?php echo $scriptName; ?>events_module/rework_piece.php?station_event_id=<?php echo $station_event_id; ?>&bad_pieces_id=<?php echo $bad_pieces_id; ?>");
        }
    </script>

    <?php include ('../footer1.php') ?>
</body>

</html>