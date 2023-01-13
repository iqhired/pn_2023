<?php
include("../config.php");
$chicagotime = date("Y-m-d H:i:s");
$temp = "";
if (!isset($_SESSION['user'])) {
    if ($_SESSION['is_tab_user'] || $_SESSION['is_cell_login']) {
        header($redirect_tab_logout_path);
    } else {
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
    if ($_SESSION['is_tab_user'] || $_SESSION['is_cell_login']) {
        header($redirect_tab_logout_path);
    } else {
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
if ($i != "super" && $i != "admin" && $i != "pn_user" && $_SESSION['is_tab_user'] != 1 && $_SESSION['is_cell_login'] != 1) {
    header('location: ../dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo $sitename; ?> |Edit Form</title>
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
        .file-image-1 .icons li a {
            height: 30px;
            width: 30px;
        }
        .remove {
            display: block;
            background: #444;
            border: 1px solid black;
            color: white;
            text-align: center;
            cursor: pointer;
        }
        .remove:hover {
            background: white;
            color: black;
        }
        input[type="file"] {
            display: block;
        }
        .imageThumb {
            max-height: 100px;
            border: 2px solid;
            padding: 1px;
            cursor: pointer;
        }
        .pip {
            display: inline-block;
            margin: 10px 10px 0 0;
        }

        button.remove {
            margin-left: 15px;
        }
        .breadcrumb-header {
            margin-left: 38px;
        }
        @media (min-width: 320px) and (max-width: 480px) {
            .col-md-4 {
                width: 30%;
            }
            .col-md-8.mg-t-5.mg-md-t-0 {
                width: 70%;
            }
            .row-sm {
                margin-left: 26px;
                margin-right: 53px;
            }
            .contextMenu {
                left: 0!important;
            }
            .d-sm-none {
                z-index: 1!important;
            }
            button.remove.btn.btn-sm.btn-danger-light {
                margin-top: 14px!important;
                margin-bottom: 10px!important;
                margin-left: 24px!important;
            }

        }

        @media (min-width: 481px) and (max-width: 768px) {
            .col-md-4 {
                width: 30%;
            }
            .col-md-8.mg-t-5.mg-md-t-0 {
                width: 70%;
            }
            .row-sm {
                margin-left: 26px;
                margin-right: 53px;
            }
            .contextMenu {
                left: 0!important;
            }
            .d-sm-none {
                z-index: 1!important;
            }
            button.remove.btn.btn-sm.btn-danger-light {
                margin-top: 14px!important;
                margin-bottom: 10px!important;
                margin-left: 24px!important;
            }

        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .col-md-4 {
                width: 30%;
            }
            .col-md-8.mg-t-5.mg-md-t-0 {
                width: 70%;
            }
            .row-sm {
                margin-left: 26px;
                margin-right: 53px;
            }
            .contextMenu {
                left: 0!important;
            }
            .d-sm-none {
                z-index: 1!important;
            }
            button.remove.btn.btn-sm.btn-danger-light {
                margin-top: 14px!important;
                margin-bottom: 10px!important;
                margin-left: 24px!important;
            }


        }
        @media (min-width: 482px) and (max-width: 767px) {
            .col-md-4 {
                width: 30%;
            }
            .col-md-8.mg-t-5.mg-md-t-0 {
                width: 70%;
            }
            .row-sm {
                margin-left: 26px;
                margin-right: 53px;
            }
            .contextMenu {
                left: 0!important;

            }
            .d-sm-none {
                z-index: 1!important;
            }
            button.remove.btn.btn-sm.btn-danger-light {
                margin-top: 14px!important;
                margin-bottom: 10px!important;
                margin-left: 24px!important;
            }


        }
        button.remove.btn.btn-sm.btn-danger-light {
            margin-top: -30px;
            margin-bottom: 20px;
            margin-left: 156px;
        }
        .col-lg-3.mg-t-20.mg-lg-t-0.extra_input {
            margin-left: -23px;
            margin-top: 10px;
        }


    </style>
</head>

<!-- Main navbar -->
<?php
$cust_cam_page_header = "Edit Form";
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
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Forms</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form Edit</li>
            </ol>

        </div>

    </div>
    <!-- /breadcrumb -->
    <!-- row -->
    <?php
    if (!empty($import_status_message)) {
        echo '<br/><div class="alert ' . $message_stauts_class . '">' . $import_status_message . '</div>';
    }
    ?>
    <?php
    if (!empty($_SESSION['import_status_message'])) {
        echo '<br/><div class="alert ' . $_SESSION['message_stauts_class'] . '">' . $_SESSION['import_status_message'] . '</div>';
        $_SESSION['message_stauts_class'] = '';
        $_SESSION['import_status_message'] = '';
    }
    ?>
    <?php
    $id = $_GET['id'];

    //   $id = base64_decode( urldecode( $form_id));

    $querymain = sprintf("SELECT * FROM `form_create` where form_create_id = '$id' ");
    $qurmain = mysqli_query($db, $querymain);
    while ($rowcmain = mysqli_fetch_array($qurmain)) {
    $formname = $rowcmain['name'];
    ?>
    <form action="edit_fs_backend.php" id="form_settings" enctype="multipart/form-data" class="form-horizontal" method="post">

        <div class="row row-sm">
            <div class="col-lg-10 col-xl-10 col-md-12 col-sm-12">
                <div class="card  box-shadow-0">
                    <div class="card-header">
                        <span class="main-content-title mg-b-0 mg-b-lg-1">FORM EDIT</span>
                    </div>
                    <div class="card-body pt-0">
                        <div class="pd-30 pd-sm-20">
                            <input type="hidden" name="hidden_id" id="hidden_id" value="<?php echo $id; ?>">
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Form Name</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input type="text" name="name" id="name" class="form-control"
                                           value="<?php echo $rowcmain['name']; ?>" placeholder="Name" required>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Form Classification</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <div class="row mg-t-15">
                                        <div class="col-lg-3">
                                            <label class="rdiobox"><input id="event" name="form_classification" value="event" type="radio" <?php if ($rowcmain['form_classification'] == "event") {
                                                    echo 'checked';
                                                } ?>> <span>Event</span></label>
                                        </div>
                                        <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                                            <label class="rdiobox"><input  id="general" name="form_classification" value="general" type="radio" <?php if ($rowcmain['form_classification'] == "general") {
                                                    echo 'checked';
                                                } ?>> <span>General</span></label>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Form Type</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <select name="form_type" id="form_type" class="form-control form-select select2" data-bs-placeholder="Select Country">
                                        <option value="" selected disabled> Select Form Type </option>
                                        <?php
                                        $form_type = $rowcmain['form_type'];
                                        $sql1 = "SELECT * FROM `form_type` ";
                                        $result1 = $mysqli->query($sql1);
                                        //                                            $entry = 'selected';
                                        while ($row1 = $result1->fetch_assoc()) {
                                            if ($form_type == $row1['form_type_id']) {
                                                $entry = 'selected';
                                            } else {
                                                $entry = '';

                                            }
                                            echo "<option value='" . $row1['form_type_id'] . "'  $entry>" . $row1['form_type_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Station</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <select name="station" id="station" class="form-control form-select select2" data-bs-placeholder="Select Country">
                                        <option value="" selected disabled> Select Station </option>
                                        <?php
                                        $st_dashboard = $rowcmain['station'];
                                        $sql1 = "SELECT * FROM `cam_line`  where enabled = '1' ORDER BY `line_name` ASC";
                                        $result1 = $mysqli->query($sql1);
                                        //                                            $entry = 'selected';
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
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Part Family</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <select name="part_family" id="part_family" class="form-control form-select select2" data-bs-placeholder="Select Country">
                                        <option value="" selected disabled> Select Part Number </option>
                                        <?php
                                        $part_family = $rowcmain['part_family'];
                                        $sql1 = "SELECT * FROM `pm_part_family` ";
                                        $result1 = $mysqli->query($sql1);
                                        //                                            $entry = 'selected';
                                        while ($row1 = $result1->fetch_assoc()) {
                                            if ($part_family == $row1['pm_part_family_id']) {
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
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Part Number</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <select name="part_number" id="part_number" class="form-control form-select select2" data-bs-placeholder="Select Country">
                                        <option value="" selected disabled> Select Part Number </option>
                                        <?php
                                        $part_number = $rowcmain['part_number'];
                                        $sql1 = "SELECT * FROM `pm_part_number` ";
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
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Image</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input type="file" name="image[]" id="image" class="form-control"  multiple="multiple">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Preview Image</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="text-wrap pb-3">
                                                        <?php
                                                        $query1 = sprintf("SELECT form_create_id FROM  form_create where form_create_id = '$id'");
                                                        $qur1 = mysqli_query($db, $query1);
                                                        $rowc1 = mysqli_fetch_array($qur1);
                                                        $item_id = $rowc1['form_create_id'];

                                                        $query2 = sprintf("SELECT * FROM  form_images where form_create_id = '$item_id'");

                                                        $qurimage = mysqli_query($db, $query2);
                                                        $i =0 ;
                                                        while ($rowcimage = mysqli_fetch_array($qurimage)) {
                                                        $image = $rowcimage['image_name'];
                                                        $d_tag = "delete_image_" . $i;
                                                        $r_tag = "remove_image_" . $i;
                                                        ?>
                                                        <div class="file-image-1">
                                                            <div class="product-image">
                                                                    <img  src="../form_images/<?php echo $image; ?>" class="br-5" alt="">
                                                                <ul class="icons">
                                                                    <li>
                                                                        <input type="hidden"  id="<?php echo $d_tag; ?>" name="<?php echo $d_tag; ?>" class="<?php echo $d_tag; ?>>" value="<?php echo $rowcimage['form_images_id']; ?>">
                                                                        <a id="<?php echo $r_tag; ?>" class="remove remove_image bg-danger"><i class="fa fa-trash"></i></a></li>

                                                                </ul>
                                                            </div>
                                                            <span class="file-name-1"><?php echo $image; ?></span>
                                                        </div>
                                                            <?php
                                                            $i++;} ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">PO Number</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input type="text" class="form-control" name="po_number" id="po_number" placeholder="PO number"  value="<?php echo $rowcmain['po_number']; ?>" required>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">DA Number</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input type="text" class="form-control" name="da_number" id="da_number" placeholder="DA Number" value="<?php echo $rowcmain['da_number']; ?>" required>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Out of Tolerance Mail List</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <select class="form-control select2" name="out_of_tolerance_mail_list[]" id="out_of_tolerance_mail_list" data-style="bg-slate" multiple="multiple" data-placeholder="Out of Tolerance Mail List ..." >
                                        <?php
                                        $arrteam = explode(',', $rowcmain["out_of_tolerance_mail_list"]);
                                        $sql1 = "SELECT DISTINCT(`group_id`) FROM `sg_user_group`";
                                        $result1 = $mysqli->query($sql1);
                                        while ($row1 = $result1->fetch_assoc()) {
                                            if (in_array($row1['group_id'], $arrteam)) {
                                                $selected = "selected";
                                            } else {
                                                $selected = "";
                                            }
                                            $station1 = $row1['group_id'];
                                            $qurtemp = mysqli_query($db, "SELECT * FROM  sg_group where group_id = '$station1' ");
                                            $rowctemp = mysqli_fetch_array($qurtemp);
                                            $groupname = $rowctemp["group_name"];
                                            echo "<option value='" . $row1['group_id'] . "' $selected>" . $groupname . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Out of Control List</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <select class="form-control select2" name="out_of_control_list[]" id="out_of_control_list" multiple="multiple" data-placeholder="Out of Control Mail List ..." >
                                        <?php
                                        $arrteam = explode(',', $rowcmain["out_of_control_list"]);
                                        $sql1 = "SELECT DISTINCT(`group_id`) FROM `sg_user_group`";
                                        $result1 = $mysqli->query($sql1);
                                        while ($row1 = $result1->fetch_assoc()) {
                                            if (in_array($row1['group_id'], $arrteam)) {
                                                $selected = "selected";
                                            } else {
                                                $selected = "";
                                            }
                                            $station1 = $row1['group_id'];
                                            $qurtemp = mysqli_query($db, "SELECT * FROM  sg_group where group_id = '$station1' ");
                                            $rowctemp = mysqli_fetch_array($qurtemp);
                                            $groupname = $rowctemp["group_name"];
                                            echo "<option value='" . $row1['group_id'] . "' $selected>" . $groupname . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Notification List</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <select class="form-control select2" name="notification_list[]" id="notification_list" multiple="multiple" data-placeholder="Notification List ...">
                                        <?php
                                        $arrteam1 = explode(',', $rowcmain["notification_list"]);
                                        $sql1 = "SELECT * FROM `cam_users` WHERE `assigned2` = '0'  and `users_id` != '1' order BY `firstname` ";
                                        $result1 = $mysqli->query($sql1);
                                        while ($row1 = $result1->fetch_assoc()) {
                                            if (in_array($row1['users_id'], $arrteam1)) {
                                                $selected = "selected";
                                            } else {
                                                $selected = "";
                                            }
                                            echo "<option value='" . $row1['users_id'] . "' $selected>" . $row1['firstname'] . "&nbsp;" . $row1['lastname'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <label class="form-label mg-b-0">
                                    * If the form is not filled within 30 mins of the frequency time then the personnel in the Notification List will be notified.
                                </label>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Notes</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <textarea id="notes" name="form_create_notes" class="form-control" placeholder="Enter Notes..." rows="3"   value="<?php echo $rowcmain['form_create_notes']; ?>"></textarea>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Needs Approval</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <?php

                                    $need_approval = $rowcmain['need_approval'];
                                    if ($need_approval == "yes") {
                                        $select_n = 'checked';
                                    } else {
                                        $select_n = '';
                                    }

                                    ?>
                                    <label class="ckbox"><input type="checkbox" name="need_approval" id="need_approval" <?php echo $select_n ?>><span></span></label>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Bypass Approval List</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <?php

                                    $approve_list = $rowcmain['approval_list'];
                                    if ($approve_list == "yes") {
                                        $select_a = 'checked';
                                    } else {
                                        $select_a = '';
                                    }

                                    ?>
                                    <label class="ckbox"><input checked type="checkbox" name="approval_list" id="approval_list" <?php echo $select_a ?>><span></span></label>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Approved By</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <select class="form-control select2" name="approval_by[]" id="approval_by" multiple="multiple" data-placeholder="Approvalcccc List ...">
                                        <?php
                                        $arrteam = explode(',', $rowcmain["approval_by"]);
                                        $sql1 = "SELECT DISTINCT(`group_id`) FROM `sg_user_group`";
                                        $result1 = $mysqli->query($sql1);
                                        while ($row1 = $result1->fetch_assoc()) {
                                            if (in_array($row1['group_id'], $arrteam)) {
                                                $selected = "selected";
                                            } else {
                                                $selected = "";
                                            }
                                            $station1 = $row1['group_id'];
                                            $qurtemp = mysqli_query($db, "SELECT * FROM  sg_group where group_id = '$station1' ");
                                            $rowctemp = mysqli_fetch_array($qurtemp);
                                            $groupname = $rowctemp["group_name"];
                                            echo "<option value='" . $row1['group_id'] . "' $selected>" . $groupname . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Valid From</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control fc-datepicker" name="valid_from" id="valid_from" value="<?php echo $rowcmain["valid_from"]; ?>" placeholder="MM/DD/YYYY" type="text">
                                    </div><!-- input-group -->
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Valid Till</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control fc-datepicker" name="valid_till" id="valid_till" value="<?php echo $rowcmain["valid_till"]; ?>" placeholder="MM/DD/YYYY" type="text" >
                                    </div><!-- input-group -->
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Frequency</label>
                                </div>
                                <div class="col-md-4 mg-t-5 mg-md-t-0">
                                    <?php
                                    $arrteam1 = explode(':', $rowcmain["frequency"]);
                                    $hr = $arrteam1[0];
                                    $min = $arrteam1[1];
                                    ?>
                                    <select name="duration_hh" id="duration_hh" class="form-control form-select select2" data-bs-placeholder="Select Hours">
                                        <option value=""  selected>--Select Hours--</option>
                                        <option value="00" <?php if ($hr == '00') {
                                            echo 'selected';
                                        } ?>>00
                                        </option>
                                        <option value="01" <?php if ($hr == '01') {
                                            echo 'selected';
                                        } ?>>01
                                        </option>
                                        <option value="02" <?php if ($hr == '02') {
                                            echo 'selected';
                                        } ?>>02
                                        </option>
                                        <option value="03" <?php if ($hr == '03') {
                                            echo 'selected';
                                        } ?>>03
                                        </option>
                                        <option value="04" <?php if ($hr == '04') {
                                            echo 'selected';
                                        } ?>>04
                                        </option>
                                        <option value="05" <?php if ($hr == '05') {
                                            echo 'selected';
                                        } ?>>05
                                        </option>
                                        <option value="06" <?php if ($hr == '06') {
                                            echo 'selected';
                                        } ?>>06
                                        </option>
                                        <option value="07" <?php if ($hr == '07') {
                                            echo 'selected';
                                        } ?>>07
                                        </option>
                                        <option value="08" <?php if ($hr == '08') {
                                            echo 'selected';
                                        } ?>>08
                                        </option>
                                        <option value="09" <?php if ($hr == '09') {
                                            echo 'selected';
                                        } ?>>09
                                        </option>
                                        <option value="10" <?php if ($hr == '10') {
                                            echo 'selected';
                                        } ?>>10
                                        </option>
                                        <option value="11" <?php if ($hr == '11') {
                                            echo 'selected';
                                        } ?>>11
                                        </option>
                                        <option value="12" <?php if ($hr == '12') {
                                            echo 'selected';
                                        } ?>>12
                                        </option>
                                        <option value="13" <?php if ($hr == '13') {
                                            echo 'selected';
                                        } ?>>13
                                        </option>
                                        <option value="14" <?php if ($hr == '14') {
                                            echo 'selected';
                                        } ?>>14
                                        </option>
                                        <option value="15" <?php if ($hr == '15') {
                                            echo 'selected';
                                        } ?>>15
                                        </option>
                                        <option value="16" <?php if ($hr == '16') {
                                            echo 'selected';
                                        } ?>>16
                                        </option>
                                        <option value="17" <?php if ($hr == '17') {
                                            echo 'selected';
                                        } ?>>17
                                        </option>
                                        <option value="18" <?php if ($hr == '18') {
                                            echo 'selected';
                                        } ?>>18
                                        </option>
                                        <option value="19" <?php if ($hr == '19') {
                                            echo 'selected';
                                        } ?>>19
                                        </option>
                                        <option value="20" <?php if ($hr == '20') {
                                            echo 'selected';
                                        } ?>>20
                                        </option>
                                        <option value="21" <?php if ($hr == '21') {
                                            echo 'selected';
                                        } ?>>21
                                        </option>
                                        <option value="22" <?php if ($hr == '22') {
                                            echo 'selected';
                                        } ?>>22
                                        </option>
                                        <option value="23" <?php if ($hr == '23') {
                                            echo 'selected';
                                        } ?>>23
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-4 mg-t-5 mg-md-t-0">
                                    <select name="duration_mm" id="duration_mm" class="form-control form-select select2" data-bs-placeholder="Select Minutes">
                                        <option value="" selected>--Select Minutes--</option>
                                        <option value="00" <?php if ($min == '00') {
                                            echo 'selected';
                                        } ?>>00
                                        </option>
                                        <option value="01" <?php if ($min == '01') {
                                            echo 'selected';
                                        } ?>>01
                                        </option>
                                        <option value="02" <?php if ($min == '02') {
                                            echo 'selected';
                                        } ?>>02
                                        </option>
                                        <option value="03" <?php if ($min == '03') {
                                            echo 'selected';
                                        } ?>>03
                                        </option>
                                        <option value="04" <?php if ($min == '04') {
                                            echo 'selected';
                                        } ?>>04
                                        </option>
                                        <option value="05" <?php if ($min == '05') {
                                            echo 'selected';
                                        } ?>>05
                                        </option>
                                        <option value="06" <?php if ($min == '06') {
                                            echo 'selected';
                                        } ?>>06
                                        </option>
                                        <option value="07" <?php if ($min == '07') {
                                            echo 'selected';
                                        } ?>>07
                                        </option>
                                        <option value="08" <?php if ($min == '08') {
                                            echo 'selected';
                                        } ?>>08
                                        </option>
                                        <option value="09" <?php if ($min == '09') {
                                            echo 'selected';
                                        } ?>>09
                                        </option>
                                        <option value="10" <?php if ($min == '10') {
                                            echo 'selected';
                                        } ?>>10
                                        </option>
                                        <option value="11" <?php if ($min == '11') {
                                            echo 'selected';
                                        } ?>>11
                                        </option>
                                        <option value="12" <?php if ($min == '12') {
                                            echo 'selected';
                                        } ?>>12
                                        </option>
                                        <option value="13" <?php if ($min == '13') {
                                            echo 'selected';
                                        } ?>>13
                                        </option>
                                        <option value="14" <?php if ($min == '14') {
                                            echo 'selected';
                                        } ?>>14
                                        </option>
                                        <option value="15" <?php if ($min == '15') {
                                            echo 'selected';
                                        } ?>>15
                                        </option>
                                        <option value="16" <?php if ($min == '16') {
                                            echo 'selected';
                                        } ?>>16
                                        </option>
                                        <option value="17" <?php if ($min == '17') {
                                            echo 'selected';
                                        } ?>>17
                                        </option>
                                        <option value="18" <?php if ($min == '18') {
                                            echo 'selected';
                                        } ?>>18
                                        </option>
                                        <option value="19" <?php if ($min == '19') {
                                            echo 'selected';
                                        } ?>>19
                                        </option>
                                        <option value="20" <?php if ($min == '20') {
                                            echo 'selected';
                                        } ?>>20
                                        </option>
                                        <option value="21" <?php if ($min == '21') {
                                            echo 'selected';
                                        } ?>>21
                                        </option>
                                        <option value="22" <?php if ($min == '22') {
                                            echo 'selected';
                                        } ?>>22
                                        </option>
                                        <option value="23" <?php if ($min == '23') {
                                            echo 'selected';
                                        } ?>>23
                                        </option>
                                        <option value="24" <?php if ($min == '24') {
                                            echo 'selected';
                                        } ?>>24
                                        </option>
                                        <option value="25" <?php if ($min == '25') {
                                            echo 'selected';
                                        } ?>>25
                                        </option>
                                        <option value="26" <?php if ($min == '26') {
                                            echo 'selected';
                                        } ?>>26
                                        </option>
                                        <option value="27" <?php if ($min == '27') {
                                            echo 'selected';
                                        } ?>>27
                                        </option>
                                        <option value="28" <?php if ($min == '28') {
                                            echo 'selected';
                                        } ?>>28
                                        </option>
                                        <option value="29" <?php if ($min == '29') {
                                            echo 'selected';
                                        } ?>>29
                                        </option>
                                        <option value="30" <?php if ($min == '30') {
                                            echo 'selected';
                                        } ?>>30
                                        </option>
                                        <option value="31" <?php if ($min == '31') {
                                            echo 'selected';
                                        } ?>>31
                                        </option>
                                        <option value="32" <?php if ($min == '32') {
                                            echo 'selected';
                                        } ?>>32
                                        </option>
                                        <option value="33" <?php if ($min == '33') {
                                            echo 'selected';
                                        } ?>>33
                                        </option>
                                        <option value="34" <?php if ($min == '34') {
                                            echo 'selected';
                                        } ?>>34
                                        </option>
                                        <option value="35" <?php if ($min == '35') {
                                            echo 'selected';
                                        } ?>>35
                                        </option>
                                        <option value="36" <?php if ($min == '36') {
                                            echo 'selected';
                                        } ?>>36
                                        </option>
                                        <option value="37" <?php if ($min == '37') {
                                            echo 'selected';
                                        } ?>>37
                                        </option>
                                        <option value="38" <?php if ($min == '38') {
                                            echo 'selected';
                                        } ?>>38
                                        </option>
                                        <option value="39" <?php if ($min == '39') {
                                            echo 'selected';
                                        } ?>>39
                                        </option>
                                        <option value="40" <?php if ($min == '40') {
                                            echo 'selected';
                                        } ?>>40
                                        </option>
                                        <option value="41" <?php if ($min == '41') {
                                            echo 'selected';
                                        } ?>>41
                                        </option>
                                        <option value="42" <?php if ($min == '42') {
                                            echo 'selected';
                                        } ?>>42
                                        </option>
                                        <option value="43" <?php if ($min == '43') {
                                            echo 'selected';
                                        } ?>>43
                                        </option>
                                        <option value="44" <?php if ($min == '44') {
                                            echo 'selected';
                                        } ?>>44
                                        </option>
                                        <option value="45" <?php if ($min == '45') {
                                            echo 'selected';
                                        } ?>>45
                                        </option>
                                        <option value="46" <?php if ($min == '46') {
                                            echo 'selected';
                                        } ?>>46
                                        </option>
                                        <option value="47" <?php if ($min == '47') {
                                            echo 'selected';
                                        } ?>>47
                                        </option>
                                        <option value="48" <?php if ($min == '48') {
                                            echo 'selected';
                                        } ?>>48
                                        </option>
                                        <option value="49" <?php if ($min == '49') {
                                            echo 'selected';
                                        } ?>>49
                                        </option>
                                        <option value="50" <?php if ($min == '50') {
                                            echo 'selected';
                                        } ?>>50
                                        </option>
                                        <option value="51" <?php if ($min == '51') {
                                            echo 'selected';
                                        } ?>>51
                                        </option>
                                        <option value="52" <?php if ($min == '52') {
                                            echo 'selected';
                                        } ?>>52
                                        </option>
                                        <option value="53" <?php if ($min == '53') {
                                            echo 'selected';
                                        } ?>>53
                                        </option>
                                        <option value="54" <?php if ($min == '54') {
                                            echo 'selected';
                                        } ?>>54
                                        </option>
                                        <option value="55" <?php if ($min == '55') {
                                            echo 'selected';
                                        } ?>>55
                                        </option>
                                        <option value="56" <?php if ($min == '56') {
                                            echo 'selected';
                                        } ?>>56
                                        </option>
                                        <option value="57" <?php if ($min == '57') {
                                            echo 'selected';
                                        } ?>>57
                                        </option>
                                        <option value="58" <?php if ($min == '58') {
                                            echo 'selected';
                                        } ?>>58
                                        </option>
                                        <option value="59" <?php if ($min == '59') {
                                            echo 'selected';
                                        } ?>>59
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- closing row -->

        <div class="query_rows">
            <?php
            $id = $_GET['id'];
            //							$id = base64_decode(urldecode($_GET['id']));
            $rowcount = 1;
            $queryitem = sprintf("SELECT * FROM `form_item` where form_create_id = '$id' order by form_item_seq+0 ASC");
            $quritem = mysqli_query($db, $queryitem);
            while ($rowcitem = mysqli_fetch_array($quritem)) {
                //$formname = $rowcitem['form_name'];
                $item_val = $rowcitem['item_val'];
                $item_Id = $rowcitem['form_item_id'];
                ?>

                <div class="rowitem_<?php echo $rowcount; ?>">

                    <div class="contextMenu">
                        <button type="button" id="moveup" class="btn"><i
                                    class="fa fa-angle-up"></i></button>
                        <button type="button" id="movedown" class="btn"><i
                                    class="fa fa-angle-down"></i></button>
                    </div>
                    <div class="row row-sm">
                        <div class="col-lg-10 col-xl-10 col-md-12 col-sm-12">
                            <div class="card-header">
                <span class="main-content-title mg-b-0 mg-b-lg-1"><a data-toggle="collapse"
                                                                     data-parent="#accordion"
                                                                     href="#<?php echo $rowcount; ?>">FORM
                    ITEM <?php echo $rowcount; ?></a>
                <button type="button" name="remove_btn"
                        class="btn btn-sm btn-danger-light remove_btn"
                        id="btn_id<?php echo $rowcount; ?>"
                        data-id="<?php echo $rowcount; ?>"
                        data-i_id="<?php echo $item_Id; ?>"
                        data-c_id="<?php echo $id; ?>"><i class="fa fa-trash"></i>
                </button>
                </span>
                            </div>
                        </div>
                        <div class="col-lg-10 col-xl-10 col-md-12 col-sm-12">
                        <div id="<?php echo $rowcount; ?>" class="card box-shadow-0 collapse in">
                            <div class="card-body pt-0">
                                <div class="pd-30 pd-sm-20" id="section_<?php echo $rowcount; ?>">
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4"><label class="form-label mg-b-0">Optional</label></div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0"><label class="ckbox">
                                                <input type="checkbox"
                                                       id="optional_<?php echo $rowcount; ?>[]"
                                                       name="optional_<?php echo $rowcount; ?>[]" <?php if ($rowcitem['optional'] == "1") {
                                                    echo 'checked';
                                                } ?> class="form-control"><span></span></label>
                                        </div>
                                    </div>

                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4"><label class="form-label mg-b-0">Item Description :</label></div>

                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <input class="form-control" name="query_text[]"
                                                   id="query_text"
                                                   value="<?php echo $rowcitem['item_desc']; ?>"
                                                   autocomplete="off"
                                                   placeholder="Form Item Description" required>
                                        </div>
                                    </div>

                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4"><label class="form-label mg-b-0" for="item_class">Form Item
                                                Type:</label></div>

                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <div class="row mg-t-15">
                                                <div class="col-lg-2 mg-t-20 mg-lg-t-0"><label class="rdiobox">
                                                        <input type="radio"
                                                               id="numeric_<?php echo $rowcount; ?>" <?php if ($item_val == "numeric") {
                                                            echo 'checked';
                                                        } ?> name="item_<?php echo $rowcount; ?>[]"
                                                               value="numeric"
                                                               data-name="numeric_<?php echo $rowcount; ?>"
                                                               checked><span>Numeric</span>
                                                    </label>
                                                </div>
                                                <div class="col-lg-2 mg-t-20 mg-lg-t-0"><label class="rdiobox">
                                                        <input type="radio" id="binary_<?php echo $rowcount; ?>" <?php if ($item_val == "binary") {
                                                            echo 'checked';
                                                        } ?> name="item_<?php echo $rowcount; ?>[]"
                                                               value="binary"
                                                               data-name="binary_<?php echo $rowcount; ?>"
                                                        ><span>Binary</span>
                                                    </label>
                                                </div>
                                                <div class="col-lg-2 mg-t-20 mg-lg-t-0"><label class="rdiobox">
                                                        <input type="radio" id="header"
                                                               name="item_<?php echo $rowcount; ?>[]" <?php if ($item_val == "header") {
                                                            echo 'checked';
                                                        } ?> value="header"
                                                               data-name="header_<?php echo $rowcount; ?>"
                                                        > <span>Header</span>
                                                    </label>
                                                </div>
                                                <div class="col-lg-2 mg-t-20 mg-lg-t-0"><label class="rdiobox">
                                                        <input type="radio"
                                                               id="text_<?php echo $rowcount; ?>_<?php echo $rowcount; ?>" <?php if ($item_val == "text") {
                                                            echo 'checked';
                                                        } ?> name="item_<?php echo $rowcount; ?>[]"
                                                               value="text"
                                                               data-name="text_<?php echo $rowcount; ?>"
                                                        > <span>Text</span>
                                                    </label>
                                                </div>
                                                <div class="col-lg-2 mg-t-20 mg-lg-t-0"><label class="rdiobox">
                                                        <input type="radio" id="list_<?php echo $rowcount; ?>" <?php if ($item_val == "list") {
                                                            echo 'checked';
                                                        } ?> name="item_<?php echo $rowcount; ?>[]"
                                                               value="list"
                                                               data-name="list_<?php echo $rowcount; ?>"
                                                        ><span>List</span>
                                                    </label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="numeric_section"
                                         id="numericsection_<?php echo $rowcount; ?>" <?php if ($item_val != "numeric") {
                                        echo "style='display:none;'";
                                    } ?>>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4"><label class="form-label mg-b-0">Measurement Unit</label></div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <select name="unit_of_measurement[]"
                                                        id="unit_of_measurement"
                                                        class="form-control form-select select2">
                                                    <?php
                                                    $sql1 = "SELECT * FROM `form_measurement_unit` ";
                                                    $result1 = $mysqli->query($sql1);
                                                    $me = $rowcitem['unit_of_measurement'];
                                                    // $entry = 'selected';
                                                    while ($row1 = $result1->fetch_assoc()) {
                                                        if ($me == $row1['form_measurement_unit_id']) {
                                                            $entry = 'selected';
                                                        } else {
                                                            $entry = '';
                                                        }
                                                        echo "<option value='" . $row1['form_measurement_unit_id'] . "'  $entry>" . $row1['unit_of_measurement'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4"><label class="form-label mg-b-0">Nominal</label></div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <input class="form-control" name="normal[]"
                                                       id="normal" autocomplete="off"
                                                       value="<?php echo $rowcitem['numeric_normal']; ?>">
                                            </div>
                                        </div>

                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4"><label class="form-label mg-b-0">Lower Tolerance</label></div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <input class="form-control"
                                                       name="lower_tolerance[]"
                                                       id="lower_tolerance" autocomplete="off"
                                                       value="<?php echo $rowcitem['numeric_lower_tol']; ?>">
                                            </div>
                                        </div>

                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4"><label class="form-label mg-b-0">Upper Tolerance</label></div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <input class="form-control"
                                                       name="upper_tolerance[]"
                                                       id="upper_tolerance" autocomplete="off"
                                                       value="<?php echo $rowcitem['numeric_upper_tol']; ?>">
                                            </div>
                                        </div>

                                    </div>
                                    <div class="binary_section"
                                         id="binarysection_<?php echo $rowcount; ?>" <?php if ($item_val != "binary") {
                                        echo "style='display:none;'";
                                    } ?>>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4"><label class="form-label mg-b-0" for="item_class">Default:</label></div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <div class="row mg-t-15">
                                                    <div class="col-lg-3 mg-t-20 mg-lg-t-0"><label class="rdiobox">
                                                            <?php $defaultbina = $rowcitem['binary_default']; ?>
                                                            <input type="hidden"
                                                                   name="bansi_row_click[]"
                                                                   value="<?php echo $rowcitem['form_item_id'] . '-' .$rowcount; ?>">
                                                            <input type="radio" id="none"
                                                                   name="default_binary_<?php echo $rowcount; ?>[]"
                                                                   value="none"
                                                                <?php if ($defaultbina == "none") {
                                                                    echo 'checked';
                                                                } ?>><span>None</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-lg-3 mg-t-20 mg-lg-t-0"><label class="rdiobox">

                                                            <input type="radio" id="yes"
                                                                   name="default_binary_<?php echo $rowcount; ?>[]"
                                                                   value="yes"
                                                                   <?php if ($defaultbina == "yes") {
                                                                echo 'checked';
                                                            } ?>><span>Yes</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-lg-3 mg-t-20 mg-lg-t-0"><label class="rdiobox">

                                                            <input type="radio" id="no"
                                                                   name="default_binary_<?php echo $rowcount; ?>[]"
                                                                   value="no"
                                                                   <?php if ($defaultbina == "no") {
                                                                echo 'checked';
                                                            } ?>><span>No</span>
                                                        </label>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4"><label class="form-label mg-b-0">Nominal</label></div>

                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <div class="row mg-t-15">
                                                    <?php $nominalbina = $rowcitem['binary_normal']; ?>
                                                    <div class="col-lg-3 mg-t-20 mg-lg-t-0"><label class="rdiobox">
                                                            <input type="radio" id="yes"
                                                                   name="normal_binary_<?php echo $rowcount; ?>[]"
                                                                   value="yes"
                                                                <?php if ($nominalbina == "yes") {
                                                                    echo 'checked';
                                                                } ?>><span>Yes</span>
                                                        </label>
                                                    </div>
                                                    <div class="col-lg-3 mg-t-20 mg-lg-t-0"><label class="rdiobox">
                                                            <input type="radio" id="no"
                                                                   name="normal_binary_<?php echo $rowcount; ?>[]"
                                                                   value="no"
                                                                <?php if ($nominalbina != "yes") {
                                                                    echo 'checked';
                                                                } ?>><span>No</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4"><label class="form-label mg-b-0">Yes Alias</label></div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <input class="form-control" name="yes_alias[]"
                                                       id="yes_alias" autocomplete="off"
                                                       value="<?php echo $rowcitem['binary_yes_alias']; ?>">
                                            </div>
                                        </div>

                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4"><label class="form-label mg-b-0">No Alias</label></div>

                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <input class="form-control" name="no_alias[]"
                                                       id="no_alias" autocomplete="off"
                                                       value="<?php echo $rowcitem['binary_no_alias']; ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="list_section"
                                         id="listsection_<?php echo $rowcount; ?>" <?php if ($item_val != "list") {
                                        echo "style='display:none;'";
                                    } ?>>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4"><label class="form-label mg-b-0">Values</label></div>

                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                <div class="row mg-t-15">
                                                    <div class="col-lg-3 mg-t-20 mg-lg-t-0"><label class="rdiobox">
                                                            <?php $defaultlist = $rowcitem['list_normal']; ?>
                                                            <input type="hidden"
                                                                   name="bansi_row_click1[]"
                                                                   value="<?php echo $rowcitem['form_item_id'] . '-' .$rowcount; ?>">

                                                            <input type="radio" id="yes"
                                                                   name="default_list_<?php echo $rowcount; ?>[]"
                                                                   value="yes"
                                                                <?php if ($defaultlist == "yes") {
                                                                    echo 'checked';
                                                                } ?>>
                                                            <span>
                                    <input type="search" name="radio_list_yes[]" id="radio_list_yes" value="<?php echo $rowcitem['list_name2']; ?>" class="form-control form-control-sm input_list_search" placeholder="Option1">
                                            </span>
                                                        </label>
                                                    </div>
                                                    <div class="col-lg-3 mg-t-20 mg-lg-t-0"><label class="rdiobox">
                                                            <input type="radio" id="no"
                                                                   name="default_list_<?php echo $rowcount; ?>[]"
                                                                   value="no"
                                                                <?php if ($defaultlist == "no") {
                                                                    echo 'checked';
                                                                } ?>><span>
                                    <input type="search" name="radio_list_no[]" id="radio_list_no" value="<?php echo $rowcitem['list_name3']; ?>" placeholder="Option2"
                                           class="form-control form-control-sm input_list_search"></span>
                                                        </label>
                                                    </div>
                                                    <?php if (empty($rowcitem['list_name1'])){ ?>
                                                        <div class="list_none" id="listnone_<?php echo $rowcount; ?>" style="display: none">
                                                            <label  class="rdiobox">
                                                                <input type="radio" id="none"
                                                                       name="default_list_<?php echo $rowcount; ?>[]"
                                                                       value="none"
                                                                    <?php if ($defaultlist == "none") {
                                                                        echo 'checked';
                                                                    } ?>><span>
                                            <input type="search" name="radio_list_none_<?php echo $rowcount; ?>[]" id="radio_list_none_<?php echo $rowcount; ?>[]" value="<?php echo $rowcitem['list_name1']; ?>" class="radio_input">
                                                    </span>
                                                            </label>
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="list_none" id="listnone_<?php echo $rowcount; ?>" style="display: block">
                                                            <label  class="rdiobox">
                                                                <input type="radio" id="none"
                                                                       name="default_list_<?php echo $rowcount; ?>[]"
                                                                       value="none"
                                                                    <?php if ($defaultlist == "none") {
                                                                        echo 'checked';
                                                                    } ?>><span>
                                            <input type="search" name="radio_list_none_<?php echo $rowcount; ?>[]" id="radio_list_none_<?php echo $rowcount; ?>[]" value="<?php echo $rowcitem['list_name1']; ?>" class="radio_input">
                                            </span>
                                                            </label>
                                                        </div>
                                                    <?php } ?>

                                                    <?php $list_extra =  $rowcitem['list_name_extra'];
                                                    if(!empty($list_extra)){
                                                        $arrteam = explode(',', $list_extra);
                                                        $radiocount = 1;
                                                        foreach ($arrteam as $arr) { ?>
                                                            <div class="list_extra" id="listextra_<?php echo $rowcount; ?>">
                                                                <label  class="rdiobox">
                                                                    <input class="form-check-input" id="extra"
                                                                           name="default_list_<?php echo $rowcount; ?>[]"
                                                                           type="radio"
                                                                           value="extra_<?php echo $radiocount; ?>"
                                                                           class="form-check-input" <?php if ($defaultlist == "extra_$radiocount") {
                                                                        echo 'checked';
                                                                    } ?>><span>
                                                <input type="search" name="radio_list_extra_<?php echo $rowcount; ?>[]" id="radio_list_extra_<?php echo $rowcount; ?>[]" value="<?php echo $arr; ?>" class="radio_input">
                                               </span>
                                                                </label>
                                                                <button class="remove" onclick="removeDiv(this);"><i class="fa fa-trash"></i></button>
                                                            </div>

                                                            <?php $radiocount++;  }
                                                    }
                                                    ?>

                                                   </div>

                                                <div class="custom-control custom-radio add_other_options_<?php echo $rowcount; ?>" name="add_other_options_<?php echo $rowcount; ?>" id="add_other_options_<?php echo $rowcount; ?>"></div>
                                                <input type="hidden" name="add_option_id"  id="add_option_id" value="0">

                                                <button type="button" class="add_option_btn btn btn-primary legitRipple" id="add_other_<?php echo $rowcount; ?>" class="btn btn-primary legitRipple"><i class="fa fa-plus" aria-hidden="true"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="row row-xs align-items-center mg-b-20">

                                            <div class="col-md-4"><label class="form-label mg-b-0">Value Evaluation Enabled</label>
                                            </div>
                                            <div class="col-md-8 mg-t-5 mg-md-t-0"><label class="ckbox">
                                                    <?php $enabledlist = $rowcitem['list_enabled']; ?>
                                                    <input type="hidden"
                                                           name="bansi_row_click1[]"
                                                           value="<?php echo $rowcitem['form_item_id'] . '-' .$rowcount; ?>">
                                                    <input type="checkbox" class="checkbox-control" name="list_enabled_<?php echo $rowcount; ?>[]"  id="listenabled_<?php echo $rowcount; ?>" <?php if($enabledlist == 1){ echo 'checked';}else if($enabledlist == 0){}?>>
                                                    <span></span>

                                                </label>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="pd-30 pd-sm-20">
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4"><label class="form-label mg-b-0">Notes</label></div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                                    <textarea class="form-control"
                                                                              aria-label="With textarea" id="notes"
                                                                              name="form_item_notes[]"
                                                                              autocomplete="off"><?php echo $rowcitem['notes']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4"><label class="form-label mg-b-0">Description</label></div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">      <textarea class="form-control"
                                                                                               aria-label="With textarea" id="disc"
                                                                                               name="form_item_disc[]"
                                                                                               autocomplete="off"><?php echo $rowcitem['discription']; ?></textarea>
                                        </div></div>
                                </div>
                            </div>

                        </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="not_click_id" id="not_click_id"
                       value="<?php echo $rowcount; ?>">
                <input type="hidden" name="formitemhiddenid[]" id="formitemhiddenid"
                       value="<?php echo $rowcitem['form_item_id']; ?>">

                <?php
                $rowcount++;
            } ?>

        </div>

        <input type="hidden" id="collapse_id"  name="collapse_id" value="<?php echo $rowcount; ?>">
        <div class="row row-sm">
            <div class="col-lg-10 col-xl-10 col-md-12 col-sm-12">
                <div class="card  box-shadow-0">
                    <div class="card-body pt-0">
                        <button type="button" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5" name="add_more" id="add_more"><i class="fa fa-plus"></i> ADD MORE FORM ITEMS</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <input type="hidden" name="click_id" id="click_id" >

        </div>
        <div class="row row-sm">
            <div class="col-lg-10 col-xl-10 col-md-12 col-sm-12">
                <div class="card  box-shadow-0">
                    <div class="card-body pt-0">
                        <button type="submit" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5" id="form_save_btn" class="btn btn-primary submit_btn">Update</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php } ?>
</div>

<script>
    $('#valid_from').datepicker({ dateFormat: 'mm-dd-yy' });
    $('#valid_till').datepicker({ dateFormat: 'mm-dd-yy' });
    $(document).on('click', '.remove_image', function () {
        var del_id = this.id.split("_")[2];
        var form_img_id = this.parentElement.childNodes[3].value;
        var info =  document.getElementById("delete_image"+del_id);
        var info =  "id="+del_id+"&form_create_id="+form_img_id;
        $.ajax({
            type: "POST", url: "../form_module/delete_form_image.php", data: info, success: function (data) {
            }
        });
        location.reload(true);
    });
</script>
<script>

    $("#image").on("change", function(e) {
        var files = e.target.files,
            filesLength = files.length;
        for (var i = 0; i < filesLength; i++) {
            var f = files[i]
            var fileReader = new FileReader();
            fileReader.onload = (function(e) {
                var file = e.target;
                $("<span class=\"pip\">" +
                    "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                    "<br/><span class=\"remove\">Remove image</span>" +
                    "</span>").insertAfter("#image");
                $(".remove").click(function(){
                    $(this).parent(".pip").remove();
                });

                // Old code here
                /*$("<img></img>", {
                  class: "imageThumb",
                  src: e.target.result,
                  title: file.name + " | Click to remove"
                }).insertAfter("#files").click(function(){$(this).remove();});*/

            });
            fileReader.readAsDataURL(f);
        }
    });

</script>
<script>
    //add this js script into the web page,
    //you want reload once after first load
    window.onload = function () {
        //considering there aren't any hashes in the urls already
        if (!window.location.hash) {
            //setting window location
            window.location = window.location + '#loaded';
            //using reload() method to reload web page
            window.location.reload();
        }
    }

    function group1() {
        $("#out_of_tolerance_mail_list").select2("open");
    }

    function group2() {
        $("#out_of_control_list").select2("open");
    }

    function group3() {
        $("#notification_list").select2("open");
    }

    function group4() {
        $("#approval_by").select2("open");
    }

    function submitFormSettings(url) {
        //          $(':input[type="button"]').prop('disabled', true);
        var data = $("#form_settings").serialize();
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function (data) {
                // $("#textarea").val("")
                // window.location.href = window.location.href + "?aa=Line 1";
                //                   $(':input[type="button"]').prop('disabled', false);
                //                   location.reload();
                //$(".enter-message").val("");
            }
        });
    }
</script>
<script>

    $(document).on("click", ".remove_btn", function () {

        var row_id = $(this).attr("data-id");
        var row_i_id = $(this).attr("data-i_id");
        var row_c_id = $(this).attr("data-c_id");
        // $(".rowitem_" + row_id).remove();
        var info = 'seq_id=' + row_id + '&i_id=' + row_i_id+ '&c_id=' + row_c_id;
        $.ajax({
            type: "POST", url: "del_form_item.php", data: info, success: function (data) {
            }
        });
        window.location.reload();
    });
    $(document).on("click", ".submit_btn", function () {
        //$("#form_settings").submit(function() {

        var station = $("#station").val();
        var part_family = $("#part_family").val();
        var part_number = $("#part_number").val();
        var form_type = $("#form_type").val();
        var classification = $('input:radio[name=form_classification]:checked').val();

        var flag = 0;
        if (form_type == null) {
            $("#error2").show();
            var flag = 1;
        }

        if (station == null) {
            $("#error3").show();
            var flag = 1;
        }
        if (classification == 'event') {

            if (part_family == null) {
                $("#error4").show();
                var flag = 1;
            }
            if (part_number == null) {
                $("#error5").show();
                var flag = 1;
            }
        }

        if (flag == 1) {
            return false;
        }

    });

    $('#need_approval').on('change', function () {
        var app_value = $(this).val();
        if (app_value == "yes") {
            $("#approve_row").show();
        }
        if (app_value == "no") {
            $("#approve_row").hide();
        }
    });
    $(document).ready(function () {

        // setInterval(function () {
        //     var link = document.getElementById('form_save_btn');
        //     link.click();
        // }, 60000);


        $("input[name='item']").click(function () {
            $(".binary_section").hide();
            $(".list_section").hide();
            if ($('input:radio[name=item]:checked').val() == "numeric") {
                $(".binary_section").hide();
                $(".list_section").hide();
                $(".numeric_section").show();
            }

            if ($('input:radio[name=item]:checked').val() == "binary") {
                $(".numeric_section").hide();
                $(".list_section").hide();
                $(".binary_section").show();
            }

            if ($('input:radio[name=item]:checked').val() == "text") {
                $(".numeric_section").hide();
                $(".list_section").hide();
                $(".binary_section").hide();
            }

            if ($('input:radio[name=item]:checked').val() == "header") {
                $(".numeric_section").hide();
                $(".list_section").hide();
                $(".binary_section").hide();
            }
            if ($('input:radio[name=item]:checked').val() == "list") {
                $(".numeric_section").hide();
                $(".binary_section").hide();
                $(".list_section").show();
            }


        })

        $(document).on("click", "#add_more", function () {
            //var html_content = '<div class="qry_section"><button type="button" name="add_more" id="add_more" class="btn btn-primary legitRipple" style="background-color:#1e73be">Add More Query</button><div class="row"><div class="col-md-2"><label for="query_text">Query Text :</label></div><div class="col-md-6"><input class="form-control" name="query_text" id="query_text" autocomplete="off" placeholder="Enter Query" required></div></div><br><div class="row"><div class="col-md-2"><label for="item_class">ITEM CLASS:</label></div><div class="col-md-6"><div class="form-check form-check-inline"><input type="radio" id="numeric" name="item" value="numeric" class="form-check-input" checked><label for="numeric" class="item_label">Numeric</label><input type="radio" id="binary" name="item" value="binary" class="form-check-input"><label for="binary" class="item_label">Binary</label><input type="radio" id="text" name="item" value="text" class="form-check-input"><label for="text" class="item_label">Text</label><input type="radio" id="header" name="item" value="header" class="form-check-input"><label for="header" class="item_label">Header</label></div></div></div><br><div class="numeric_section"><div class="row"><div class="col-md-2"><label for="normal">Normal:</label></div><div class="col-md-6"><input class="form-control" name="normal" id="normal" autocomplete="off"></div></div><br><div class="row"><div class="col-md-2"><label for="lower_tolerance">LowerTolerance:</label></div><div class="col-md-6"><input class="form-control" name="lower_tolerance" id="lower_tolerance" autocomplete="off"></div></div><br><div class="row"><div class="col-md-2"><label for="upper_tolerance">UpperTolerance:</label></div><div class="col-md-6"><input class="form-control" name="upper_tolerance" id="upper_tolerance" autocomplete="off"></div></div><br></div><div class="binary_section" id="binary_"><div class="row"><div class="col-md-2"><label for="default">Default:</label></div><div class="col-md-6"><div class="form-check form-check-inline"><input type="radio" id="none" name="default_binary" value="none" class="form-check-input" checked><label for="none" class="item_label">None</label><input type="radio" id="yes" name="default_binary" value="yes" class="form-check-input"><label for="yes" class="item_label">Yes</label><input type="radio" id="no" name="default_binary" value="no" class="form-check-input"><label for="no" class="item_label">No</label></div></div></div><br><div class="row"><div class="col-md-2"><label for="normal">Normal:</label></div><div class="col-md-6"><div class="form-check form-check-inline"><input type="radio" id="yes" name="normal_binary" value="yes" class="form-check-input" checked><label for="yes" class="item_label">Yes</label><input type="radio" id="no" name="normal_binary" value="no" class="form-check-input"><label for="no" class="item_label">No</label></div></div></div><div class="row"><div class="col-md-2"><label for="yes_alias">Yes Alias:</label></div><div class="col-md-6"><input class="form-control" name="yes_alias" id="yes_alias" autocomplete="off"></div></div><div class="row"><div class="col-md-2"><label for="no_alias">No Alias:</label></div><div class="col-md-6"><input class="form-control" name="no_alias" id="no_alias" autocomplete="off"></div></div></div><div class="row"><div class="col-md-2"><label for="notes">Notes:</label></div><div class="col-md-6"><textarea class="form-control" aria-label="With textarea" id="notes" name="notes" autocomplete="off"></textarea></div></div></div>';
            var i = $('#collapse_id').val();
            var collapse_id = "collapse" + i;
            var count = i;
            $("#click_id").val(count);


            // var html_content = '<div class="rowitem_' + count + '"><br/><div class="contextMenu"><button type="button" id="moveup" class="btn"><i class="fa fa-angle-up"></i></button><button type="button" id="movedown" class="btn"><i class="fa fa-angle-down"></i></button></div><div class="panel panel-default"><div class="panel-heading"><h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#' + collapse_id + '">Form Item ' + i + '</a><button type="button" name="remove_btn" class="btn btn-danger btn-xs remove_btn" id="btn_id' + i + '" data-id="' + i + '">-</button></h4></div><div id="' + collapse_id + '" class="panel-collapse collapse in"><div class="panel-body"><div class="qry_section" id="section_' + count + '"><div class="row"><div class="col-md-2"><input type="checkbox" id="optional_' + count + '[]" name="optional_' + count + '[]" class="checkbx" style="margin-right:15px;"/>Optional</div></div><br/><div class="row"><label class="col-lg-2 control-label" for="query_text">Item Description :</label><div class="col-md-6"><input class="form-control" name="query_text[]" id="query_text" autocomplete="off" placeholder="Form Item Description" required></div></div><br><div class="row"><label class="col-lg-2 control-label" for="item_class">Form Item Type:</label><div class="col-md-6"><div class="form-check form-check-inline"><input type="radio" id="numeric_' + count + '" name="item_' + count + '[]" value="numeric" data-name="numeric_' + count + '" class="form-check-input" checked> <label for="numeric" class="item_label">Numeric</label> <input type="radio" id="binary_' + count + '" name="item_' + count + '[]" value="binary" data-name="binary_' + count + '" class="form-check-input"> <label for="binary" class="item_label">Binary</label> <input type="radio" id="text_' + count + '_' + count + '" name="item_' + count + '[]" value="text" data-name="text_' + count + '" class="form-check-input"> <label for="text" class="item_label">Text</label> <input type="radio" id="header" name="item_' + count + '[]" value="header" data-name="header_' + count + '" class="form-check-input"> <label for="header" class="item_label">Header</label></div></div></div><br><div class="numeric_section" id="numericsection_' + count + '"><div class="row"><label class="col-lg-2 control-label" for="measurement">Measurement Unit:</label><div class="col-md-6"><select name="unit_of_measurement[]" id="unit_of_measurement' + count + '" class="form-control" ></select></div></div><br/><div class="row"><label class="col-lg-2 control-label" for="normal">Nominal:</label><div class="col-md-6"><input class="form-control" name="normal[]" id="normal" autocomplete="off"></div></div><br><div class="row"><label class="col-lg-2 control-label" for="lower_tolerance">LowerTolerance:</label><div class="col-md-6"><input class="form-control" name="lower_tolerance[]" id="lower_tolerance" autocomplete="off"></div></div><br><div class="row"><label class="col-lg-2 control-label" for="upper_tolerance">UpperTolerance:</label><div class="col-md-6"><input class="form-control" name="upper_tolerance[]" id="upper_tolerance" autocomplete="off"></div></div><br></div><div class="binary_section" id="binarysection_' + count + '"><div class="row"><label class="col-lg-2 control-label" for="default">Default:</label></div><div class="col-md-6"><div class="form-check form-check-inline"><input type="radio" id="none" name="default_binary_' + count + '[]" value="none" class="form-check-input" checked> <label for="none" class="item_label">None</label> <input type="radio" id="yes" name="default_binary_' + count + '[]" value="yes" class="form-check-input"> <label for="yes" class="item_label">Yes</label><input type="hidden" name="bansi_row_click[]"  value=' + count + ' > <input type="radio" id="no" name="default_binary_' + count + '[]" value="no" class="form-check-input"> <label for="no" class="item_label">No</label></div></div></div><br><div class="row"><label class="col-lg-2 control-label" for="normal">Nominal:</label><div class="col-md-6"><div class="form-check form-check-inline"><input type="radio" id="yes" name="normal_binary_' + count + '[]" value="yes" class="form-check-input" checked> <label for="yes" class="item_label">Yes</label> <input type="radio" id="no" name="normal_binary_' + count + '[]" value="no" class="form-check-input"> <label for="no" class="item_label">No</label></div></div></div><div class="row"><div class="col-md-2"><label for="yes_alias">Yes Alias:</label></div><div class="col-md-6"><input class="form-control" name="yes_alias[]" id="yes_alias" autocomplete="off"></div></div><div class="row"><div class="col-md-2"><label for="no_alias">No Alias:</label></div><div class="col-md-6"><input class="form-control" name="no_alias[]" id="no_alias" autocomplete="off"></div></div></div><div class="row"><div class="col-md-2"><label for="notes">Notes:</label></div><div class="col-md-6"><textarea class="form-control" aria-label="With textarea" id="notes" name="form_item_notes[]" autocomplete="off"></textarea></div></div><br/><div class="row"><div class="col-md-2"><label for="notes">Discription:</label></div><div class="col-md-6"><textarea class="form-control" aria-label="With textarea" id="disc" name="form_item_disc[]" autocomplete="off"></textarea></div></div></div></div></div></div></div>';
            var html_content = '<div class="rowitem_'+count+'"><br/><div class="contextMenu"><button type="button" id="moveup" class="btn"><i class="fa fa-angle-up"></i></button><button type="button" id="movedown" class="btn"><i class="fa fa-angle-down"></i></button></div><div class="row row-sm"><div class="col-lg-10 col-xl-10 col-md-12 col-sm-12"><div class="card-header"><span class="main-content-title mg-b-0 mg-b-lg-1"><a data-toggle="collapse" data-parent="#accordion" href="' + collapse_id + '">FORM ITEM ' + i + '</a><button type="button" name="remove_btn" class="btn btn-sm btn-danger-light remove_btn" id="btn_id' + i + '" data-id="' + i + '" fdprocessedid="7w26pm"><i class="fa fa-trash"></i></button></span></div></div><div class="col-lg-10 col-xl-10 col-md-12 col-sm-12"><div id="'+collapse_id+'" class="card box-shadow-0  collapse in"><div class="card-body pt-0"><div class="pd-30 pd-sm-20" id="section_' + count + '"><div class="row row-xs align-items-center mg-b-20"><div class="col-md-4"><label class="form-label mg-b-0">Optional</label></div><div class="col-md-8 mg-t-5 mg-md-t-0"><label class="ckbox"><input type="checkbox" id="optional_' + count + '[]" name="optional_' + count + '[]" class="form-control"><span></span></label></div></div><div class="row row-xs align-items-center mg-b-20"><div class="col-md-4"><label class="form-label mg-b-0">Item Description :</label></div><div class="col-md-8 mg-t-5 mg-md-t-0"><input class="form-control" name="query_text[]" id="query_text" autocomplete="off" placeholder="Form Item Description" required></div></div><div class="row row-xs align-items-center mg-b-20"><div class="col-md-4"><label class="form-label mg-b-0" for="item_class">Form Item Type:</label></div><div class="col-md-8 mg-t-5 mg-md-t-0"><div class="row mg-t-15"><div class="col-lg-2 mg-t-20 mg-lg-t-0"><label class="rdiobox"><input type="radio" id="numeric_' + count + '" name="item_' + count + '[]" value="numeric" data-name="numeric_' + count + '" checked><span>Numeric</span></label></div><div class="col-lg-2 mg-t-20 mg-lg-t-0"><label class="rdiobox"><input type="radio" id="binary_' + count + '" name="item_' + count + '[]" value="binary" data-name="binary_' + count + '"><span>Binary</span></label></div><div class="col-lg-2 mg-t-20 mg-lg-t-0"><label class="rdiobox"> <input type="radio" id="text_' + count + '_' + count + '" name="item_' + count + '[]" value="text" data-name="text_' + count + '"> <span>Text</span></label></div><div class="col-lg-2 mg-t-20 mg-lg-t-0"><label class="rdiobox"><input type="radio" id="header" name="item_' + count + '[]" value="header" data-name="header_' + count + '"> <span>Header</span></label></div><div class="col-lg-2 mg-t-20 mg-lg-t-0"><label class="rdiobox"><input type="radio" id="list_' + count + '" name="item_' + count + '[]" value="list" data-name="list_' + count + '"><span>List</span></label></div></div></div></div><br><div class="numeric_section" id="numericsection_'+count+'"><div class="row row-xs align-items-center mg-b-20"><div class="col-md-4"> <label class="form-label mg-b-0">Measurement Unit</label></div><div class="col-md-8 mg-t-5 mg-md-t-0"><select class="form-control form-select select2"  data-style="bg-slate" name="unit_of_measurement[]" id="unit_of_measurement' + count + '"></select></div></div><br/><div class="row row-xs align-items-center mg-b-20"><div class="col-md-4"><label class="form-label mg-b-0">Nominal</label> </div><div class="col-md-8 mg-t-5 mg-md-t-0"><input class="form-control" name="normal[]" id="normal" autocomplete="off" placeholder = "Nominal"></div></div><div class="row row-xs align-items-center mg-b-20"><div class="col-md-4"> <label class="form-label mg-b-0">Lower Tolerance</label></div><div class="col-md-8 mg-t-5 mg-md-t-0"><input class="form-control" name="lower_tolerance[]" id="lower_tolerance" autocomplete="off" placeholder = "Lower Tolerance"></div></div><div class="row row-xs align-items-center mg-b-20"><div class="col-md-4"> <label class="form-label mg-b-0">Upper Tolerance</label></div><div class="col-md-8 mg-t-5 mg-md-t-0"><input class="form-control" name="upper_tolerance[]" id="upper_tolerance" autocomplete="off" placeholder = "Upper Tolerance"></div></div><br><!--<div class="row"><label class="col-lg-2 control-label" for="upper_tolerance">Graph Required:</label><div class="col-md-6"> <input type="radio" id="yes_n" name="graph_numeric_' + count + '[]" value="yes" class="form-check-input" checked><label for="yes" class="item_label">Yes</label><input type="radio" id="no_n" name="graph_numeric_' + count + '[]" value="no" class="form-check-input"><label for="no" class="item_label">No</label></div></div><br>--></div><div class="binary_section" id="binarysection_'+count+'"><div class="row row-xs align-items-center mg-b-20"><div class="col-md-4"><label class="form-label mg-b-0" for="item_class">Default:</label></div><div class="col-md-8 mg-t-5 mg-md-t-0"><div class="row mg-t-15"><div class="col-lg-3 mg-t-20 mg-lg-t-0"> <label class="rdiobox"><input type="hidden" name="bansi_row_click[]"  value='+ count +' ><input type="radio" id="none" name="default_binary_' + count + '[]" value="none" checked><span>None</span></label></div><div class="col-lg-3 mg-t-20 mg-lg-t-0"> <label class="rdiobox"> <input type="radio" id="yes" name="default_binary_' + count + '[]" value="yes" ><span>Yes</span></label></div><div class="col-lg-3 mg-t-20 mg-lg-t-0"><label class="rdiobox"><input type="radio" id="no" name="default_binary_' + count + '[]" value="no"><span>No</span></label></div></div></div></div><!--<div class="row"><label class="col-lg-2 control-label" for="graph">Graph Required:</label><div class="col-md-6"><div class="form-check form-check-inline"><input type="radio" id="yes" name="graph_binary_' + count + '[]" value="yes" class="form-check-input" checked> <label for="yes" class="item_label">Yes</label> <input type="radio" id="no" name="graph_binary_' + count + '[]" value="no" class="form-check-input"> <label for="no" class="item_label">No</label></div></div></div><br>--><div class="row row-xs align-items-center mg-b-20"><div class="col-md-4"><label class="form-label mg-b-0">Nominal</label></div><div class="col-md-8 mg-t-5 mg-md-t-0"><div class="row mg-t-15"><div class="col-lg-3 mg-t-20 mg-lg-t-0"><label class="rdiobox"><input type="radio" id="yes" name="normal_binary_' + count + '[]" value="yes" checked><span>Yes</span></label></div><div class="col-lg-3 mg-t-20 mg-lg-t-0"><label class="rdiobox"><input type="radio" id="no" name="normal_binary_' + count + '[]" value="no"><span>No</span></label> </div></div></div></div><div class="row row-xs align-items-center mg-b-20"><div class="col-md-4"><label class="form-label mg-b-0">Yes Alias</label></div><div class="col-md-8 mg-t-5 mg-md-t-0"><input class="form-control" name="yes_alias[]" id="yes_alias" autocomplete="off"></div></div><div class="row row-xs align-items-center mg-b-20"><div class="col-md-4"><label class="form-label mg-b-0">No Alias</label></div><div class="col-md-8 mg-t-5 mg-md-t-0"><input class="form-control" name="no_alias[]" id="no_alias" autocomplete="off"></div></div></div><div class="list_section" id="listsection_'+count+'"><div class="row row-xs align-items-center mg-b-20"><div class="col-md-4"><label class="form-label mg-b-0">Values</label></div><div class="col-md-8 mg-t-5 mg-md-t-0"> <div class="row mg-t-15"><div class="col-lg-3 mg-t-20 mg-lg-t-0"><label class="rdiobox"><input type="radio" id="yes" name="default_list_' + count + '[]" value="yes" class="form-check-input custom-control-input" checked><span><input type="search" name="radio_list_yes[]" id="radio_list_yes[]" placeholder="Option1" class="form-control form-control-sm input_list_search" ></span></label> </div><div class="col-lg-3 mg-t-20 mg-lg-t-0"><label class="rdiobox"><input type="radio" id="no" name="default_list_' + count + '[]" value="no" class="form-check-input custom-control-input"><span><input type="search" name="radio_list_no[]" id="radio_list_no" placeholder="Option2" class="form-control form-control-sm input_list_search"></span></label></div><div class="col-lg-3 mg-t-20 mg-lg-t-0"><div class="list_none" id="listnone_' + count + '" style="display:none"><label class="rdiobox"><input type="radio" id="none" name="default_list_' + count + '[]" value="none" class="form-check-input custom-control-input"><span><input type="search" disabled name="radio_list_none_' + count + '[]" id="radio_list_none_' + count + '[]" placeholder="Option3" class="form-control form-control-sm input_list_search"></span></label></div></div><div class="custom-control custom-radio" id="add_other_' + count + '"></div><div class="col-lg-3 mg-t-20 mg-lg-t-0 extra_input"><div class="custom-control custom-radio add_other_options_' + count + '" name="add_other_options" id="add_other_options"></div></div></div><input type="hidden" name="add_option_id"  id="add_option_id" value="0"><button type="button" class="add_option_btn btn btn-primary legitRipple" id="add_other_' + count + '"><i class="fa fa-plus" aria-hidden="true"></i></button></div></div></div><div class="row row-xs align-items-center mg-b-20"><div class="col-md-4"><label class="form-label mg-b-0">Value Evaluation Enabled</label></div><div class="col-md-8 mg-t-5 mg-md-t-0"><label class="ckbox"> <input type="checkbox" class="evaluation_enabled" name="list_enabled_' + count + '[]" id="listenabled_' + count + '"><span></span></label></div></div></div><div class="pd-30 pd-sm-20"><div class="row row-xs align-items-center mg-b-20"><div class="col-md-4"><label class="form-label mg-b-0">Notes</label></div><div class="col-md-8 mg-t-5 mg-md-t-0"><textarea class="form-control" aria-label="With textarea" id="notes" name="form_item_notes[]" autocomplete="off"></textarea></div></div><div class="row row-xs align-items-center mg-b-20"><div class="col-md-4"><label class="form-label mg-b-0">Description</label></div><div class="col-md-8 mg-t-5 mg-md-t-0"><textarea class="form-control" aria-label="With textarea" id="disc" name="form_item_disc[]" autocomplete="off"></textarea></div></div></div></div></div></div></div></div></div></div>';
            $(".query_rows").append(html_content);
            $.ajax({
                url: "retrive_unit_of_measurement.php",
                dataType: 'Json',
                data: {},
                success: function (data) {
                    // $('select[name="item_name[]"]').empty();
                    // $('#'+select_id).append('<option value="" selected disabled>Select Your Item</option>');
                    $.each(data, function (key, value) {
                        $('#unit_of_measurement' + count).append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
            });
            $("#binarysection_" + count).hide();
            $("#listsection_" + count).hide();
            document.getElementById("collapse_id").value = parseInt(i) + 1;
        });

        $(document).on("click", "#moveup", function () {
            var parentDiv = $(this).closest('div.contextMenu').parent();
            parentDiv.insertBefore(parentDiv.prev())
        });

        $(document).on("click", "#movedown", function () {
            var parentDiv = $(this).closest('div.contextMenu').parent();
            parentDiv.insertAfter(parentDiv.next())
        });

    });
    // $(document).on("change",input[type='radio']",function() {
    //$("input[type='radio']").change(function(){

    $(document).on("click", 'input:radio', function () {

        var radio_val = $(this).val();
//var radio_txt = radio_val.split("_")[0];
//var radio_id = radio_val.split("_")[1];

        var radio_txt = $(this).data("name").split("_")[0];
        var radio_id = $(this).data("name").split("_")[1];

//alert(radio_id);

        if (radio_txt == "numeric") {
            $("#binarysection_" + radio_id).hide();
            $("#listsection_" + radio_id).hide();
            $("#numericsection_" + radio_id).show();
        }
        if (radio_txt == "binary") {

            $("#numericsection_" + radio_id).hide();
            $("#listsection_" + radio_id).hide();
            $("#binarysection_" + radio_id).show();
        }
        if (radio_txt == "list") {

            $("#numericsection_" + radio_id).hide();
            $("#binarysection_" + radio_id).hide();
            $("#listsection_" + radio_id).show();
        }
        if (radio_txt == "text") {

            $("#numericsection_" + radio_id).hide();
            $("#listsection_" + radio_id).hide();
            $("#binarysection_" + radio_id).hide();

        }
        if (radio_txt == "header") {
            $("#numericsection_" + radio_id).hide();
            $("#listsection_" + radio_id).hide();
            $("#binarysection_" + radio_id).hide();
        }
    })
</script>
<script>

    $(document).on('change', 'input[type="checkbox"]', function (e) {
        var index = this.id.split("_")[1];
        var checkBox = document.getElementById("listenabled_" + index);
        var text = document.getElementById("listnone_" + index);
        var extraCount = 0;
        var list_none = 0;
        if(null != this.parentElement.parentElement.parentElement.parentElement.childNodes[1].parentElement.getElementsByClassName('list_section')){
            extraCount = this.parentElement.parentElement.parentElement.parentElement.childNodes[1].parentElement.getElementsByClassName('list_section')[0].querySelectorAll('#extra').length;
            // list_none = this.parentElement.parentElement.parentElement.parentElement.childNodes[1].parentElement.getElementsByClassName('list_section')[0].getElementsByClassName('list_none').length;
        }
        if((null != document.getElementById("radio_list_none_" + index + "[]")) &&(document.getElementById("radio_list_none_" + index + "[]").disabled == false)){
            list_none = 1;
        }
        if ((checkBox.checked == true) && (((extraCount == 0) && (list_none == 0)) || ((extraCount > 0)  && (list_none == 1)) )) {
            // document.getElementById("listnone_" + index).disabled = false;
            // text.style.display = "block";
            document.getElementById("radio_list_none_" + index + "[]").disabled = false;
            text.style.display = "block";
        } else {
            // document.getElementById("listnone_" + index).attr('disabled', 'disabled');
            // document.getElementById("listnone_" + index).disabled = true;
            // text.style.display = "none";
            document.getElementById("radio_list_none_" + index + "[]").disabled = true;
            text.style.display = "none";
        }
    });
</script>

<script>
    $(document).on("click",".add_option_btn",function() {
        var op_val = this.parentElement.children.add_option_id.value;
        var index1 = this.id.split("_")[2];

        if (op_val == '0') {
            op_val = 1;
            index = op_val;
            this.parentElement.children.add_option_id.value = index;
        } else {
            op_val = parseInt(op_val) + 1;
            this.parentElement.children.add_option_id.value = op_val;
            index = op_val;
        }

        //add_other_options
        // document.getElementById("add_other_options").innerHTML;
        $('.add_other_options_' + index1 + '').append('<label class="rdiobox" id="add_other_' + op_val + '">' + '<input type="radio" class="custom-control-input" id="extra" name="default_list_' + index1 + '[]" value="extra_' + op_val + '">' + '<span><input type="search" name="radio_list_extra_' + index1 + '[]" id="radio_list_extra_' + index1 + '[]" value="" class="form-control form-control-sm input_list_search"></span>' + '<button class="remove btn btn-sm btn-danger-light" onclick="removeDiv(this);"><i class="fa fa-trash"></i></button>' + "</label>");


    });
    function removeDiv(btn) {
        ((btn.parentNode).parentNode).removeChild(btn.parentNode);
    }

</script>


<?php include('../footer1.php') ?>

</body>