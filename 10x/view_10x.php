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
        <?php echo $sitename; ?> |View 10x</title>
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

    </style>
</head>
<?php
$cust_cam_page_header = "View 10x";
include("../header.php");
include("../admin_menu.php");
include("../heading_banner.php");
?>
<body class="ltr main-body app sidebar-mini">
<div class="main-content app-content">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-10 col-sm-10">
            <div class="breadcrumb-header justify-content-between">
                <div class="left-content">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Logs</a></li>
                        <li class="breadcrumb-item active" aria-current="page">View 10x</li>
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
            <div class="card">
                <div class="card-body">
                    <div class="card-header">
                        <div class="main-content-label mg-b-2">
                            <center><?php echo $line_number; ?></center>
                        </div>
                    </div>
                    <form action="" id="form_settings" enctype="multipart/form-data"
                          class="form-horizontal" method="post" autocomplete="off">
                    <div class="pd-30 pd-sm-20">
                        <input type="hidden" name="name" id="name"
                               value="<?php echo $rowcmain['station_event_id']; ?>">
                        <input type="hidden" name="formcreateid" id="formcreateid"
                               value="<?php echo $rowcmain['customer_account_id']; ?>">
                        <input type="hidden" name="form_user_data_id" id="form_user_data_id"
                               value="<?php echo $id; ?>">
                        <div class="row row-xs align-items-center mg-b-20">
                            <div class="col-md-4">
                                <label class="form-label mg-b-0">Notes :</label>
                            </div>
                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                <?php
                                $notes = $rowcmain["notes"];
                                ?>
                                <input type="text" name="notes" class="form-control pn_none" id="notes"
                                       value="<?php echo $notes; ?>" disabled>
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
                                       value="<?php echo $create_date; ?>" disabled>
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
                                <div class="thumbnail" style="height: 150px">
                                    <div class="thumb">
                                        <img src="../assets/images/10x/<?php echo $item_id; ?>/<?php echo $rowcimage['image_name']; ?>"
                                             alt="">
                                        <div class="caption-overflow" style="height: 150px">
                                                       <span>
															<center><a href="../assets/images/10x/<?php echo $item_id; ?>/<?php echo $rowcimage['image_name']; ?>"
                                                               data-popup="lightbox" rel="gallery"
                                                               class="btn border-white text-white btn-flat btn-icon btn-rounded">view</a></center>
														</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>
<?php include('../footer.php') ?>
</body>
</html>