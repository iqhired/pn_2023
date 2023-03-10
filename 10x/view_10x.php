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
        <?php echo $sitename; ?> | View 10x</title>
    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link href="<?php echo $siteURL; ?>assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $siteURL; ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $siteURL; ?>assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $siteURL; ?>assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $siteURL; ?>assets/css/colors.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $siteURL; ?>assets/css/style_main.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->
    <!-- Core JS files -->
    <script type="text/javascript" src="<?php echo $siteURL; ?>assets/js/libs/jquery-3.6.0.min.js"> </script>
    <script type="text/javascript" src="<?php echo $siteURL; ?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo $siteURL; ?>assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="<?php echo $siteURL; ?>assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->
    <!-- Theme JS files -->
    <script type="text/javascript" src="<?php echo $siteURL; ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="<?php echo $siteURL; ?>assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
    <script type="text/javascript" src="<?php echo $siteURL; ?>assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="<?php echo $siteURL; ?>assets/js/plugins/media/fancybox.min.js"></script>
    <script type="text/javascript" src="<?php echo $siteURL; ?>assets/js/pages/datatables_basic.js"></script>
    <script type="text/javascript" src="<?php echo $siteURL; ?>assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="<?php echo $siteURL; ?>assets/js/pages/form_select2.js"></script>
    <script type="text/javascript" src="<?php echo $siteURL; ?>assets/js/pages/gallery.js"></script>
    <script type="text/javascript" src="<?php echo $siteURL; ?>assets/js/plugins/ui/ripple.min.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=WindSong&display=swap');

        .signature {

            font-family: 'WindSong', swap;
            font-size: 25px;
            font-weight: 600;
        }

        .form_table_mobile {
            display: none;
        }

        #form_save_btn {
            background-color: #1e73be;
            margin-left: 35px;
            padding: 12px 22px 10px 18px;
            margin-bottom: 10px;
        }

        .pn_none {
            pointer-events: none;
            color: #050505;
        }
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #191e3a!important;
            line-height: 20px!important;

        }
        .select2-container--disabled .select2-selection--single:not([class*=bg-]) {
            color: #060818!important;
            border-block-start: none;

        }
        .select2-container--disabled .select2-selection--single:not([class*=bg-]) {
            color: #999;
            border-bottom-style: inset;
        }
        .form-control {
            font-size: 15px;
        }
        @media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px) {
            .col-lg-2{
                width: 35%!important;
            }
            .content:first-child {
                padding-top: 90px!important;
            }
            .col-md-3 {
                width: 35%;
                float: left;
            }
            .col-md-1 {
                width: 5%;
                float: right;
            }
            .col-md-8.form_col_item {
                float: left;
                width: 100%;
            }
            .col-md-4.form {
                width: 100%;
                float: right;
                margin-top: 10px;
            }

            .form_table_mobile {
                width: 100%;
                background-color: #eee;
                margin-top: 12px;
            }
            .form_row_mobile {
                width: 100%;
                height: auto;
            }
            .col-lg-8.mobile {
                width: 58%;
                float: right;
                padding: 10px 30px 10px 26px;
            }
            label.col-lg-3.control-label.mobile {
                width: 42%;
                float: left;
                padding: 10px 30px 10px 26px;
            }
            .form_table_mobile {
                display: block;
            }
            table.form_table {
                display: none;
            }
            .col-md-1 {
                width: 50%;
                float: right;
            }
            .col-md-2 {
                width: 50%;
                float: left;
            }
            .border-primary {
                border-color: #ffffff;
            }
            .col-lg-3 {
                width: 50%!important;
            }



        }
        .create {
            float: right;
            padding: 12px;

        }
        .col-lg-3 {
            width: 18%;
        }

    </style>
</head>
<body>
<!-- Main navbar -->
<?php
$cust_cam_page_header = "View 10x";
include("../header.php");
include("../admin_menu.php");
include("../heading_banner.php");
?>
<!-- /main navbar -->
<!-- Page container -->
<div class="page-container">
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
<!--    <div class="col-md-2 create">-->
<!--        <a href="--><?php //echo $siteURL; ?><!--10x/10x_search.php?station=--><?php //echo $formname; ?><!--&station_event_id=--><?php //echo $station_event_id;?><!--">-->
<!--            <button type="submit" id="create" class="btn btn-primary" style="background-color: #009688;float:right">View 10x</button>-->
<!--        </a>-->
<!--    </div>-->
    <!-- Content area -->
    <div class="content" style="padding: 70px 30px !important;">


            <div class="panel panel-flat">
                <!--  <h5 style="text-align: left;margin-right: 120px;"> <b>Submitted on : </b>--><?php //echo date('d-M-Y h:m'); ?><!--</h5>-->
                <div class="panel-heading">

                    <h5 class="panel-title form_panel_title"><?php echo $line_number; ?>  </h5>
                    <div class="row ">
                        <div class="col-md-12">
                            <form action="" id="form_settings" enctype="multipart/form-data"
                                  class="form-horizontal" method="post" autocomplete="off">
                                <input type="hidden" name="name" id="name"
                                       value="<?php echo $rowcmain['station_event_id']; ?>">
                                <input type="hidden" name="formcreateid" id="formcreateid"
                                       value="<?php echo $rowcmain['customer_account_id']; ?>">
                                <input type="hidden" name="form_user_data_id" id="form_user_data_id"
                                       value="<?php echo $id; ?>">
                                <div class="form_row row">
                                    <label class="col-lg-2 control-label">Notes : </label>
                                    <div class="col-md-6">
                                        <?php
                                        $notes = $rowcmain["notes"];
                                        ?>

                                        <input type="text" name="notes" class="form-control pn_none" id="notes"
                                               value="<?php echo $notes; ?>">
                                    </div>
                                </div>

                                    <div class="form_row row">
                                        <label class="col-lg-2 control-label">Part Family : </label>
                                        <div class="col-md-6">

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
                                <div class="form_row row">
                                    <label class="col-lg-2 control-label">Part Number : </label>
                                    <div class="col-md-6">
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
                                <div class="form_row row">
                                    <label class="col-lg-2 control-label">Part Name : </label>
                                    <div class="col-md-6">

                                        <input type="text" name="part_name" class="form-control" id="part_name"
                                               value="<?php echo $rowcmain['part_name']; ?>" disabled>
                                    </div>
                                </div>


                                <div class="form_row row">
                                    <label class="col-lg-2 control-label">Submitted Time : </label>
                                    <div class="col-md-6">
                                        <?php $create_date = $rowcmain['created_at'];?>
                                        <input type="text" name="createdby" class="form-control" id="createdby"
                                               value="<?php echo $create_date; ?>" disabled>
                                    </div>
                                </div>
                                <div class="form_row row">
                                    <label class="col-lg-2 control-label">Submitted User : </label>
                                    <div class="col-md-6">
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
                                <div class="form_row row">

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
                                <br/>
                    </form>
                </div>
            </div>

    </div>

</div>

        <?php } ?>

    </div>

<?php include('../footer.php') ?>
<!--<script type="text/javascript" src="--><?php //echo $siteURL; ?><!--assets/js/core/app.js"></script>-->

</body>

</html>