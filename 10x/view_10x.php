<?php
include("../config.php");
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

$cellID = $_GET['cell_id'];
$c_name = $_GET['c_name'];

//Set the time of the user's last activity
$_SESSION['LAST_ACTIVITY'] = $time;
$i = $_SESSION["role_id"];
if ($i != "super" && $i != "admin" && $i != "pn_user" && $_SESSION['is_tab_user'] != 1 && $_SESSION['is_cell_login'] != 1 ) {
    header('location: ../dashboard.php');
}

$s_event_id = $_GET['station_event_id'];
$station_event_id = base64_decode(urldecode($s_event_id));
$sqlmain = "SELECT * FROM `sg_station_event` where `station_event_id` = '$station_event_id'";
$resultmain = mysqli_query($db,$sqlmain);
$rowcmain = mysqli_fetch_array($resultmain);
$part_family = $rowcmain['part_family_id'];
$part_number = $rowcmain['part_number_id'];

$sqlnumber = "SELECT * FROM `pm_part_number` where `pm_part_number_id` = '$part_number'";
$resultnumber = mysqli_query($db,$sqlnumber);
$rowcnumber = mysqli_fetch_array($resultnumber);
$pm_part_number = $rowcnumber['part_number'];
$pm_part_name = $rowcnumber['part_name'];

$sqlfamily = "SELECT * FROM `pm_part_family` where `pm_part_family_id` = '$part_family'";
$resultfamily = mysqli_query($db,$sqlfamily);
$rowcfamily = mysqli_fetch_array($resultfamily);
$pm_part_family_name = $rowcfamily['part_family_name'];

$sqlaccount = "SELECT * FROM `part_family_account_relation` where `part_family_id` = '$part_family'";
$resultaccount = mysqli_query($db,$sqlaccount);
$rowcaccount = mysqli_fetch_array($resultaccount);
$account_id = $rowcaccount['account_id'];

$sqlcus = "SELECT * FROM `cus_account` where `c_id` = '$account_id'";
$resultcus =mysqli_query($db,$sqlcus);
$rowccus = mysqli_fetch_array($resultcus);
$cus_name = $rowccus['c_name'];
$logo = $rowccus['logo'];

$idddd = preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo
|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i"
    , $_SERVER["HTTP_USER_AGENT"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo $sitename; ?> | View 10x Form</title>
    <script type="text/javascript" src="../assets/js/form_js/jquery-min.js"></script>
    <script type="text/javascript" src="../assets/js/libs/jquery-3.6.0.min.js"></script>
    <!-- INTERNAL Select2 css -->
    <link href="<?php echo $siteURL; ?>assets/css/form_css/select2.min.css" rel="stylesheet" />
    <!-- STYLES CSS -->
    <link href="<?php echo $siteURL; ?>assets/css/form_css/style.css" rel="stylesheet">
    <link href="<?php echo $siteURL; ?>assets/css/form_css/style-dark.css" rel="stylesheet">
    <link href="<?php echo $siteURL; ?>assets/css/form_css/style-transparent.css" rel="stylesheet">
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
    <!-- anychart documentation -->
    <!-- INTERNAL Select2 css -->
    <link href="<?php echo $siteURL; ?>assets/css/form_css/select2.min.css" rel="stylesheet" />
    <!-- STYLES CSS -->
    <link href="<?php echo $siteURL; ?>assets/css/form_css/style.css" rel="stylesheet">
    <link href="<?php echo $siteURL; ?>assets/css/form_css/style-dark.css" rel="stylesheet">
    <link href="<?php echo $siteURL; ?>assets/css/form_css/style-transparent.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=WindSong&display=swap');
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
        .pn_none {
            pointer-events: none;
            color: #050505;
        }
        @media (min-width: 320px) and (max-width: 480px) {
            .col-md-8.mg-t-5.mg-md-t-0{
                max-width: 300px!important;
            }
            .col-md-4{
                max-width: 200px!important;
            }
        }

        @media (min-width: 481px) and (max-width: 768px) {
            .col-md-8.mg-t-5.mg-md-t-0{
                max-width: 300px!important;
            }
            .col-md-4{
                max-width: 200px!important;
            }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .col-md-8.mg-t-5.mg-md-t-0{
                max-width: 300px!important;
            }
            .col-md-4{
                max-width: 200px!important;
            }

        }
    </style>
</head>
<body class="ltr main-body app horizontal">
<?php if (!empty($station) || !empty($station_event_id)){
    include("../cell-menu.php");
}else{
    include("../header.php");
    include("../admin_menu.php");
}
?>
<div class="main-content horizontal-content">
    <div class="main-container container">
        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> 10x</li>
                </ol>
            </div>
        </div>
        <?php
        $id = $_GET['id'];
        $querymain = sprintf("SELECT * FROM `10x` where 10x_id = '$id' ");
        $qurmain = mysqli_query($db, $querymain);

        while ($rowcmain = mysqli_fetch_array($qurmain)) {
            $formname = $rowcmain['line_no'];

            ?>
            <?php

            $line_no = "SELECT line_id,line_name from cam_line where line_id = '$formname'";
            $rowline = mysqli_query($db,$line_no);
            $sqlline = mysqli_fetch_assoc($rowline);
            $line_number = $sqlline['line_name'];

            $station_event_id = $_GET['station_event_id'];
            ?>
            <form action="" id="form_settings" enctype="multipart/form-data" class="form-horizontal" method="post" autocomplete="off">
                <div class="row">
                    <div class="col-lg-12 col-sm-12">
                        <div class="card">
<!--                            <div class="card-body pt-0">-->
                                <div class="card-header">
                                    <span class="main-content-title mg-b-0 mg-b-lg-1">View 10x</span>
                                </div>
                                <div class="pd-30 pd-sm-20">
<!--                                    <div class="card-header" style="background-color: lightgrey;text-align: center;">-->
<!--                                        <span style="" class="main-content-title mg-b-0 mg-b-lg-1">--><?php //echo $line_number; ?><!--</span>-->
<!--                                    </div>-->
                                    <br/>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="form-label mg-b-0">Station : </label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <input type="text" class="form-control" value="<?php echo $line_number; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <input type="hidden" name="name" id="name"
                                               value="<?php echo $rowcmain['station_event_id']; ?>">
                                        <input type="hidden" name="formcreateid" id="formcreateid"
                                               value="<?php echo $rowcmain['customer_account_id']; ?>">
                                        <input type="hidden" name="form_user_data_id" id="form_user_data_id"
                                               value="<?php echo $id; ?>">
                                        <div class="col-md-4">
                                            <label class="form-label mg-b-0">Notes : </label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <?php
                                            $notes = $rowcmain["notes"];
                                            ?>

                                            <input type="text" name="notes" class="form-control pn_none" id="notes"
                                                   value="<?php echo $notes; ?>">
                                        </div>
                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="form-label mg-b-0">Part Family : </label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">

                                            <?php
                                            $part_family_id = $rowcmain['part_family_id'];
                                            $part_family = "SELECT * from pm_part_family where pm_part_family_id = '$part_family_id'";
                                            $rowpart = mysqli_query($db,$part_family);
                                            $sqlpart = mysqli_fetch_assoc($rowpart);
                                            $part_family = $sqlpart['part_family_name'];
                                            ?>
                                            <input type="text" name="part_family" class="form-control" id="part_family"
                                                   value="<?php echo $part_family ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="form-label mg-b-0">Part Number : </label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <?php
                                            $part_no = $rowcmain['part_no'];
                                            $part_num = "SELECT * from pm_part_number where pm_part_number_id = '$part_no'";
                                            $rowpartno = mysqli_query($db,$part_num);
                                            $sqlpartno = mysqli_fetch_assoc($rowpartno);
                                            $part_num_pm = $sqlpartno['part_number'];
                                            ?>
                                            <input type="text" name="part_number" class="form-control" id="part_number"
                                                   value="<?php echo $part_num_pm; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="form-label mg-b-0">Part Name : </label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <input type="text" name="part_name" class="form-control" id="part_name"
                                                   value="<?php echo $rowcmain['part_name']; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="form-label mg-b-0">Submitted Time : </label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <?php $create_date = $rowcmain['created_at'];?>
                                            <input type="text" name="createdby" class="form-control" id="createdby"
                                                   value="<?php echo dateReadFormat($create_date); ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="form-label mg-b-0">Submitted User : </label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <?php $create_user = $rowcmain['created_by'];
                                            $user = "select firstname,lastname from cam_users where users_id = '$create_user' ";
                                            $row_user = mysqli_query($db,$user);
                                            $user_q = mysqli_fetch_array($row_user);
                                            $fname = $user_q['firstname'];
                                            $lname = $user_q['lastname'];
                                            ?>
                                            <input type="text" name="createdby" class="form-control" id="createdby"
                                                   value="<?php echo $fname." ".$lname; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20">
                                            <?php
                                            $query1 = sprintf("SELECT 10x_id FROM  10x where 10x_id = '$id'");
                                            $qur1 = mysqli_query($db, $query1);
                                            $rowc1 = mysqli_fetch_array($qur1);
                                            $item_id = $rowc1['10x_id'];

                                            $query2 = sprintf("SELECT * FROM  10x_images where 10x_id = '$item_id'");

                                            $qurimage = mysqli_query($db, $query2);
                                            while ($rowcimage = mysqli_fetch_array($qurimage)) {
                                                ?>

                                                <div class="col-lg-3 col-sm-6">
                                                    <div class="thumbnail">
                                                        <div class="thumb">
                                                            <img src="../assets/images/10x/<?php echo $item_id; ?>/<?php echo $rowcimage['image_name']; ?>"
                                                                 alt="">
                                                            <div class="caption-overflow">
                                                        <span>
															<a href="../assets/images/10x/<?php echo $item_id; ?>/<?php echo $rowcimage['image_name']; ?>"
                                                               data-popup="lightbox" rel="gallery"
                                                               class="btn border-white text-white btn-flat btn-icon btn-rounded">view</a>
														</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        <?php } ?>
    </div>
</div>
<?php include('../footer.php') ?>
</body>
</html>
