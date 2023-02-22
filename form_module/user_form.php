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
$cell_station = $_GET['station'];
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
        <?php echo $sitename; ?> |Submit Form</title>
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
        .row-body {
            display: flex;
            flex-wrap: wrap;
            margin-left: -8.75rem;
            margin-right: 6.25rem;
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
            .breadcrumb-header {
                margin-left: 38px;
            }
            .col-md-5.mg-t-5.mg-md-t-0 {
                width: 80%;
            }
            .col-md-6 {
                width: 90%;
            }
            .col-md-3.mg-t-5.mg-md-t-0 {
                width: 70%;
            }
            .col-md-2.mg-t-5.mg-md-t-0 {
                width: 20%;
            }
            .col-lg-2\.5.mg-t-20.mg-lg-t-0 {
                max-width: 80%!important;
            }
            .col-lg-3.mg-t-20.mg-lg-t-0 {
                width: 32%;
            }
            .row.mg-t-15 {
                width: 100%;
            }
            .col-md-3 {
                padding: 10px;
            }
            .form_tab_td {
                float: left !important;
                width: 100%!important;
                padding: 0px 0px !important;
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
            .breadcrumb-header {
                margin-left: 38px;
            }
            .col-md-5.mg-t-5.mg-md-t-0 {
                width: 80%;
            }
            .col-md-6 {
                width: 90%;
            }
            .col-md-3.mg-t-5.mg-md-t-0 {
                width: 70%;
            }
            .col-md-2.mg-t-5.mg-md-t-0 {
                width: 20%;
            }
            .col-lg-3.mg-t-20.mg-lg-t-0 {
                width: 32%;
            }
            .row.mg-t-15 {
                width: 100%;
            }
            .col-md-3 {
                padding: 10px;
            }
            .form_tab_td {
                float: left !important;
                width: 100%!important;
                padding: 0px 0px !important;
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
            .breadcrumb-header {
                margin-left: 38px;
            }
            .col-md-5.mg-t-5.mg-md-t-0 {
                width: 80%;
            }
            .col-md-6 {
                width:90%;
            }
            .col-md-3.mg-t-5.mg-md-t-0 {
                width: 70%;
            }
            .col-md-2.mg-t-5.mg-md-t-0 {
                width: 20%;
            }
            .col-lg-3.mg-t-20.mg-lg-t-0 {
                width: 32%;
            }
            .row.mg-t-15 {
                width: 100%;
            }
            .col-md-3 {
                padding: 10px;
            }
            .form_tab_td {
                float: left !important;
                width: 100%!important;
                padding: 0px 0px !important;
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
            .breadcrumb-header {
                margin-left: 38px;
            }
            .col-md-5.mg-t-5.mg-md-t-0 {
                width: 80%;
            }
            .col-md-6 {
                width: 90%;
            }
            .col-md-3.mg-t-5.mg-md-t-0 {
                width: 70%;
            }
            .col-md-2.mg-t-5.mg-md-t-0 {
                width: 20%;
            }
            .col-lg-3.mg-t-20.mg-lg-t-0 {
                width: 32%;
            }
            .row.mg-t-15 {
                width: 100%;
            }
            .col-md-3 {
                padding: 10px;
            }
            .form_tab_td {
                float: left !important;
                width: 100%!important;
                padding: 0px 0px !important;
            }

        }
        .red-star {
            color: red;
        }
        #sub_app {
            padding: 20px 40px;
            color: red;
            font-size: initial;
        }
        .col-md-0\.5 {
            padding-top: 10px;
        }
        .form_tab_td{
            float: left;
            width: 100% ;
            padding: 0px 30px;
        }



    </style>
</head>

<!-- Main navbar -->
<?php if (!empty($cell_station)){
    include("../cell-menu.php");
}else{
    include("../header.php");
    include("../admin_menu.php");
}
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
                <li class="breadcrumb-item active" aria-current="page">Submit Form</li>
            </ol>

        </div>

    </div>
	<?php
	if (!empty($import_status_message)) {
		echo '<br/><div id = "success_msg_app" class="alert ' . $message_stauts_class . '">' . $import_status_message . '</div>';
	}
	displaySFMessage();
	?>
    <!-- /breadcrumb -->
    <form action="" id="form_settings" enctype="multipart/form-data"  class="form-horizontal" method="post" autocomplete="off">
        <div class="row row-sm">
            <div class="col-lg-10 col-xl-10 col-md-12 col-sm-12">
                <div class="card  box-shadow-0">
                    <div class="card-header">
                        <span class="main-content-title mg-b-0 mg-b-lg-1">FORM SUBMIT</span>
                    </div>
                    <div class="card-body pt-0">
                        <div class="pd-30 pd-sm-20">
                            <?php
                            $form_createid = $_GET['id'];
                            $query1 = sprintf("SELECT form_create_id,need_approval,approval_list FROM  form_create where form_create_id = '$form_createid' ");
                            $qur1 = mysqli_query($db, $query1);
                            $rowc1 = mysqli_fetch_array($qur1);
                            $item_id = $rowc1['form_create_id'];
                            $need_approval = $rowc1['need_approval'];
                            $bypass_approval = $rowc1['approval_list'];
                            ?>
                            <input type="hidden" name="name" id="name" value="<?php echo $_GET['form_name']; ?>">
                            <input type="hidden" name="formcreateid" id="formcreateid"  value="<?php echo $_GET['id']; ?>">
                            <input type="hidden" name="bypass_approve" id="bypass_approve" value="<?php echo $rowc1['approval_list']; ?>">
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Form Type</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <?php
                                    $get_form_type = $_GET['form_type'];
                                    if ($get_form_type != '') {
                                        $disabled = 'disabled';
                                    } else {
                                        $disabled = '';
                                    }
                                    ?>
                                    <input type="hidden" name="form_type" id="form_type" value="<?php echo $get_form_type; ?>">
                                    <select name="form_type1" id="form_type" class="form-control form-select select2" data-bs-placeholder="Select Country" disabled>
                                        <?php

                                        $sql1 = "SELECT * FROM `form_type` ";
                                        $result1 = $mysqli->query($sql1);
                                        //                                            $entry = 'selected';
                                        while ($row1 = $result1->fetch_assoc()) {
                                            if ($get_form_type == $row1['form_type_id']) {
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
                                    <?php
                                    $get_station = $_GET['station'];
                                    if ($get_station != '') {
                                        $disabled = 'disabled';
                                    } else {
                                        $disabled = '';
                                    }
                                    ?>
                                    <input type="hidden" name="station" id="station" value="<?php echo $get_station; ?>">
                                    <select name="station1" id="station1"
                                            class="form-control form-select select2" <?php echo $disabled; ?>>
                                        <option value="" selected disabled>--- Select Station ---</option>
                                        <?php
                                        $sql1 = "SELECT * FROM `cam_line` where enabled = '1' ORDER BY `line_name` ASC ";
                                        $result1 = $mysqli->query($sql1);
                                        //                                            $entry = 'selected';
                                        while ($row1 = $result1->fetch_assoc()) {
                                            if ($get_station == $row1['line_id']) {
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
                            <?php
                            $get_part_family = $_GET['part_family'];
                            if ($get_part_family != '') {
                                $disabled = 'disabled';
                                ?>
                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-4">
                                        <label class="form-label mg-b-0">Part Family</label>
                                    </div>
                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                        <input type="hidden" name="part_family" id="part_family" value="<?php echo $get_part_family; ?>">
                                        <select name="part_family1" id="part_family1"
                                                class="form-control form-select select2" <?php echo $disabled; ?>>
                                            <option value="" selected disabled>--- Select Part Family ---</option>
                                            <?php
                                            $sql1 = "SELECT * FROM `pm_part_family` ";
                                            $result1 = $mysqli->query($sql1);
                                            //                                            $entry = 'selected';
                                            while ($row1 = $result1->fetch_assoc()) {
                                                if ($get_part_family == $row1['pm_part_family_id']) {
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
                            <?php }
                            ?>
                            <?php
                            $get_part_number = $_GET['part_number'];
                            if ($get_part_number != '') {
                                $disabled = 'disabled'; ?>
                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-4">
                                        <label class="form-label mg-b-0">Part Number</label>
                                    </div>
                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                        <input type="hidden" name="part_number" id="part_number" value="<?php echo $get_part_number; ?>">
                                        <select name="part_number1" id="part_number1"
                                                class="form-control form-select select2" <?php echo $disabled; ?>>
                                            <option value="" selected disabled>--- Select Part Number ---</option>
                                            <?php
                                            $sql1 = "SELECT * FROM `pm_part_number` ";
                                            $result1 = $mysqli->query($sql1);
                                            //                                            $entry = 'selected';
                                            while ($row1 = $result1->fetch_assoc()) {
                                                if ($get_part_number == $row1['pm_part_number_id']) {
                                                    $entry = 'selected';
                                                } else {
                                                    $entry = '';
                                                }
                                                echo "<option style=\"word-wrap:break-word;\" value='" . $row1['pm_part_number_id'] . "'  $entry >" . $row1['part_number'] . " - " . $row1['part_name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            <?php  }  ?>
                            <?php
                            $sql_wol = "SELECT wol FROM `form_type` where form_type_id = '$get_form_type' ";
                            $res_wol = $mysqli->query($sql_wol);
                            $r=$res_wol->fetch_assoc();
                            $wol = $r['wol'];
                            ?>
                            <?php if($wol != 0){  ?>
                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-4">
                                        <label class="form-label mg-b-0">Work Order/Lot
                                            <span class="red-star">★</span>
                                        </label>

                                    </div>

                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                        <textarea class="form-control" name = "wol" id="wol" rows="1" required></textarea>
                                    </div>
                                </div>
                            <?php } ?>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Notes</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <textarea class="form-control" id ="notes" name="notes" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Images</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="text-wrap pb-3">
                                                        <?php
                                                        $qurimage = mysqli_query($db, "SELECT * FROM  form_images where form_create_id = '$item_id'");
                                                        while ($rowcimage = mysqli_fetch_array($qurimage)) { ?>
                                                            <div class="file-image-1">
                                                                <div class="product-image">
                                                                    <img src="../form_images/<?php echo $rowcimage['image_name']; ?>" class="br-5" alt="">
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

                            <div class="card-header">
                                <span class="main-content-title mg-b-0 mg-b-lg-1">FORM INFORMATION</span>
                            </div>
                            <?php
                            $query = sprintf("SELECT * FROM  form_item where form_create_id = '$item_id' order by form_item_seq+0 ASC ");
                            $qur = mysqli_query($db, $query);
                            while ($rowc = mysqli_fetch_array($qur)) {
                                $item_val = $rowc['item_val'];
                                if ($item_val == "header") {
                                    ?>

                                    <span class="main-content-title mg-b-0 mg-b-lg-1"><?php echo htmlspecialchars($rowc['item_desc']); ?></span>

                                    </br>
                                <?php }
                                if ($item_val == "numeric") {
                                    $numeric_normal = $rowc['numeric_normal'];
                                    $numeric_lower_tol1 = $rowc['numeric_lower_tol'];
                                    $numeric_upper_tol1 = $rowc['numeric_upper_tol'];

                                    $numeric_lower_tol1 = str_replace(' ', '', $numeric_lower_tol1); // Replaces all spaces with hyphens.
                                    $numeric_lower_tol1 = preg_replace('/[^A-Za-z0-9]/', '', $numeric_lower_tol1); // Removes special chars.
                                    $final_lower = $numeric_normal - $numeric_lower_tol1; // final lower value

                                    $numeric_upper_tol1 = str_replace(' ', '', $numeric_upper_tol1); // Replaces all spaces with hyphens.
                                    $numeric_upper_tol1 = preg_replace('/[^A-Za-z0-9]/', '', $numeric_upper_tol1); // Removes special chars.
                                    $final_upper = $numeric_normal + $numeric_upper_tol1; // final upper value

                                    ?>
                                    <input type="hidden" data-id="<?php echo $rowc['form_item_id']; ?>" class="lower_compare" value="<?php echo $final_lower; ?>">
                                    <input type="hidden" data-id="<?php echo $rowc['form_item_id']; ?>" class="upper_compare" value="<?php echo $final_upper; ?>">

                                    <div class="row row-xs align-items-center mg-b-20" style="margin-top: 20px;">
                                        <div class="col-md-0.5">
                                            <?php
                                            if ($rowc['optional'] != '1') {
                                                echo '<span class="red-star">★</span>';
                                            } ?>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label mg-b-0">
                                                <?php
                                                echo htmlspecialchars($rowc['item_desc']); ?>
                                                <?php if (isset($rowc['discription']) && ($rowc['discription'] != '')) { ?>
                                                    <?php echo "(" . $rowc['discription'] . ")" ?>
                                                <?php }
                                                ?>
                                            </label>
                                        </div>
                                        <div class="col-md-3 mg-t-5 mg-md-t-0">
                                            <input type="number" name="<?php echo $rowc['form_item_id']; ?>"
                                                   id="<?php echo $rowc['form_item_id']; ?>"
                                                   class="form-control compare_text" required step="any">
                                        </div>
                                        <div class="col-md-2 mg-t-5 mg-md-t-0">
                                            <?php
                                            $unit_of_measurement_id = $rowc['unit_of_measurement'];
                                            $sql1 = "SELECT unit_of_measurement FROM `form_measurement_unit` where form_measurement_unit_id = '$unit_of_measurement_id'";
                                            $result1 = $mysqli->query($sql1);
                                            $row1 = $result1->fetch_assoc();
                                            echo $row1['unit_of_measurement'];
                                            ?>
                                            <input type="hidden" name="form_item_array[]"
                                                   value="<?php echo $rowc['form_item_id']; ?>">

                                        </div>
                                    </div>


                                    <?php
                                }
                                if ($item_val == "binary") {
                                    $bin_def = $rowc['binary_normal'];
                                    $bnf = $rowc['binary_default'];
                                    ?>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-0.5">
                                            <?php
                                            if ($rowc['optional'] != '1') {
                                                echo '<span class="red-star">★</span>';
                                            } ?>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label mg-b-0">
                                                <input type="hidden" class="binary_compare"
                                                       value="<?php echo $bin_def; ?>"
                                                       data-id="<?php echo $rowc['form_item_id']; ?>"/>
                                                <?php
                                                echo htmlspecialchars($rowc['item_desc']); ?>
                                                <?php if (isset($rowc['discription']) && ($rowc['discription'] != '')) { ?>
                                                    <?php echo "(" . $rowc['discription'] . ")" ?>
                                                <?php } ?>
                                            </label>
                                        </div>
                                        <div class="col-md-5 mg-t-5 mg-md-t-0">
                                            <div class="row mg-t-15">
                                                <input type="hidden" name="form_item_array[]"
                                                       value="<?php echo $rowc['form_item_id']; ?>"/>
                                                <div class="col-lg-2.5 mg-t-20 mg-lg-t-0">
                                                    <label class="rdiobox">
                                                        <input type="radio" id="yes"
                                                               name="<?php echo $rowc['form_item_id']; ?>"
                                                               value="yes"
                                                            <?php if ($bnf == 'yes') {
                                                                echo 'checked';
                                                            }
                                                            if ($rowc['optional'] != '1') {
                                                                echo 'required';
                                                            } ?> />
                                                        <span  class="item_label <?php echo $rowc['form_item_id']; ?>"
                                                               id="<?php echo $rowc['form_item_id']; ?>"><?php $yes_alias = $rowc['binary_yes_alias'];
                                                            echo (($yes_alias != null) || ($yes_alias != '')) ? $yes_alias : "Yes" ?></span>
                                                    </label>
                                                </div>
                                                <div class="col-lg-2.5 mg-t-20 mg-lg-t-0">
                                                    <label class="rdiobox">
                                                        <input type="radio" id="no"
                                                               name="<?php echo $rowc['form_item_id']; ?>"
                                                               value="no"
                                                            <?php if ($bnf == "no") {
                                                                echo 'checked';
                                                            }
                                                            if ($rowc['optional'] != '1') {
                                                                echo 'required';
                                                            } ?> />
                                                        <span class="item_label <?php echo $rowc['form_item_id']; ?>"
                                                              id="<?php echo $rowc['form_item_id']; ?>"><?php $no_alias = $rowc['binary_no_alias'];
                                                            echo (($no_alias != null) || ($no_alias != '')) ? $no_alias : "No" ?></span>
                                                    </label>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                <?php }
                                if ($item_val == "list") {
                                    $list_def = $rowc['list_normal'];
                                    $lnf = $rowc['list_name1'];
                                    $lnf1 = $rowc['list_name2'];
                                    $lnf2 = $rowc['list_name2'];
                                    $list_enabled =  $rowc['list_enabled'];
                                    $extra_enabled =  $rowc['radio_extra'];
                                    ?>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-0.5">
                                            <?php
                                            if ($rowc['optional'] != '1') {
                                                echo '<span class="red-star">★</span>';
                                            } ?>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label mg-b-0">
                                                <input type="hidden" class="list_enabled" name="list_enabled" data-id="<?php echo $rowc['form_item_id']; ?>" value="<?php echo $list_enabled; ?>"/>
                                                <input type="hidden" class="binary_compare"
                                                       value="<?php echo $list_def; ?>"
                                                       data-id="<?php echo $rowc['form_item_id']; ?>"/>
                                                <?php
                                                echo htmlspecialchars($rowc['item_desc']); ?>
                                                <?php if (isset($rowc['discription']) && ($rowc['discription'] != '')) { ?>
                                                    <?php echo "(" . $rowc['discription'] . ")" ?>
                                                <?php } ?>
                                            </label>
                                        </div>
                                        <div class="col-md-5 mg-t-5 mg-md-t-0">
                                            <input type="hidden" name="form_item_array[]"
                                                   value="<?php echo $rowc['form_item_id']; ?>"/>
                                            <div class="row mg-t-15">
                                                <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                                                    <label class="rdiobox">
                                                        <input type="radio" id="yes"
                                                               name="<?php echo $rowc['form_item_id']; ?>"
                                                               value="yes"
                                                            <?php if ($list_def == 'yes') {
                                                                echo 'checked';
                                                            }
                                                            if ($rowc['optional'] != '1') {
                                                                echo 'required';
                                                            } ?> />
                                                        <span class="item_label <?php echo $rowc['form_item_id']; ?>"
                                                              id="<?php echo $rowc['form_item_id']; ?>"><?php $yes_alias = $rowc['list_name2'];
                                                            $none_alias = $rowc['list_name1'];
                                                            echo (($yes_alias != null) || ($yes_alias != '')) ? $yes_alias : "Yes" ?></span>
                                                    </label>
                                                </div>
                                                <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                                                    <label class="rdiobox">
                                                        <input type="radio" id="no"
                                                               name="<?php echo $rowc['form_item_id']; ?>"
                                                               value="no"
                                                            <?php if ($list_def == "no") {
                                                                echo 'checked';
                                                            }
                                                            if ($rowc['optional'] != '1') {
                                                                echo 'required';
                                                            } ?> />
                                                        <span class="item_label <?php echo $rowc['form_item_id']; ?>"
                                                              id="<?php echo $rowc['form_item_id']; ?>"><?php $no_alias = $rowc['list_name3'];
                                                            echo (($no_alias != null) || ($no_alias != '')) ? $no_alias : "No" ?></span>
                                                    </label>
                                                </div>
                                                <?php if ($list_enabled == 1 && !empty($none_alias)) { ?>
                                                    <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                                                        <label class="rdiobox">
                                                            <input type="radio" id="none"
                                                                   name="<?php echo $rowc['form_item_id']; ?>"
                                                                   value="none"
                                                                <?php if ($list_def == 'none') {
                                                                    echo 'checked';
                                                                }
                                                                if ($rowc['optional'] != '1') {
                                                                    echo 'required';
                                                                } ?> />
                                                            <span class="item_label <?php echo $rowc['form_item_id']; ?>"
                                                                  id="<?php echo $rowc['form_item_id']; ?>"><?php $none_alias = $rowc['list_name1'];
                                                                echo (($none_alias != null) || ($none_alias != '')) ? $none_alias : "None" ?></span>
                                                        </label>
                                                    </div>
                                                <?php } ?>

                                                <?php $list_extra =  $rowc['list_name_extra'];
                                                if(!empty($list_extra)){
                                                    $arrteam = explode(',', $list_extra);
                                                    $radiocount = 1;
                                                    foreach ($arrteam as $arr) { ?>
                                                        <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                                                            <label class="rdiobox">
                                                                <input type="radio" id="extra"
                                                                       name="<?php echo $rowc['form_item_id']; ?>"
                                                                       value="extra_<?php echo $radiocount; ?>"
                                                                    <?php if ($list_def == "extra_$radiocount") {
                                                                        echo 'checked';
                                                                    }
                                                                    if ($rowc['optional'] != '1') {
                                                                        echo 'required';
                                                                    } ?> />
                                                                <span class="item_label <?php echo $rowc['form_item_id']; ?>"
                                                                      id="<?php echo $rowc['form_item_id']; ?>"><?php $extra_alias = "$arr";
                                                                    echo (($extra_alias != null) || ($extra_alias != '')) ? $extra_alias : "Extra" ?></span>
                                                                <?php if ($rowc['optional'] == '1') {
                                                                    echo '<span style="color: #a1a1a1; font-size: small;">(Optional)</span>';

                                                                }   ?>
                                                            </label>
                                                        </div>
                                                        <?php     $radiocount++;
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                                if ($item_val == "text") {
                                    ?>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-0.5">
                                            <?php
                                            if ($rowc['optional'] != '1') {
                                            echo '<span class="red-star">★</span>';
                                            } ?>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label mg-b-0">
                                                <?php echo htmlspecialchars($rowc['item_desc']); ?>

                                            <?php if (isset($rowc['discription']) && ($rowc['discription'] != '')) { ?>
                                                <span><?php echo "(" . $rowc['discription'] . ")" ?></span>
                                            <?php } ?>
                                            </label>
                                        </div>
                                        <div class="col-md-5 mg-t-5 mg-md-t-0">
                                            <input type="hidden" name="form_item_array[]"
                                                   value="<?php echo $rowc['form_item_id']; ?>"/>
                                            <input type="text" class="form-control text_num" name="<?php echo $rowc['form_item_id']; ?>" autocomplete="off"
                                                   id="<?php echo $rowc['form_item_id']; ?>" <?php if ($rowc['optional'] != '1') {
                                                echo 'required';
                                            } ?> />

                                        </div>
                                    </div>

                                <?php } }?>
                            <?php if($need_approval == "yes") { ?>

                                <input type="hidden" name="click_id" id="click_id">
                                <div class="card-body pt-0">
                                    <button type="submit" id="btnSubmit" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5">Submit</button>
                                </div>
                            <?php } else { ?>
                                <input type="hidden" name="click_id" id="click_id">
                                <div class="card-body pt-0">
                                    <button type="submit" id="btnSubmit_app" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5">Submit</button>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-sm" style="display: none" id="approve_sec">
            <?php
            if ($need_approval == "yes") {
                ?>
                <div id="sub_app">The form needs to be approved before submitting</div>
                <div class="col-lg-10 col-xl-10 col-md-12 col-sm-12" id="app_list">
                    <div class="card box-shadow-0">
                            <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">APPROVAL LIST</span>
                        </div>
                        <form action="" id="approve_form" class="form-horizontal" method="post" autocomplete="off">
                            <div class="card-body pt-0">
                                <div class="pd-30 pd-sm-20">
                                    <?php
                                    $query1 = sprintf("SELECT * FROM  form_create where form_create_id = '$item_id' and need_approval = 'yes'");
                                    $qur1 = mysqli_query($db, $query1);
                                    $i = 0;
                                    while ($rowc1 = mysqli_fetch_array($qur1)) {
                                        $approval_by_array = $rowc1['approval_by'];

                                        $arrteam = explode(',', $approval_by_array);
                                        $j = 0;	$k = 0;
                                        foreach ($arrteam as $arr) {
                                            if ($arr != "") {
                                                ?>
                                                <div class="row row-xs align-items-center mg-b-20">
                                                    <?php
                                                    $qurtemp = mysqli_query($db, "SELECT group_name FROM `sg_group` where group_id = '$arr' ");
                                                    $rowctemp = mysqli_fetch_array($qurtemp);
                                                    $groupname = $rowctemp["group_name"]

                                                    ?>
                                                    <div class="col-md-3">
                                                        <input type="hidden" name="approval_dept"
                                                               id="approval_dept_<?php echo $j ?>"
                                                               value="<?php echo $arr; ?>">
                                                            <?php echo $groupname; ?>
                                                    </div>
                                                    <div class="col-md-3">

                                                        <select  name="approval_initials"
                                                                 id="approval_initials_<?php echo $j ?>" class="form-control form-select select2">
                                                            <?php
                                                            $sql1 = "SELECT * FROM `sg_user_group` where group_id = '$arr'";
                                                            $result1 = $mysqli->query($sql1);
                                                            while ($row1 = $result1->fetch_assoc()) {

                                                                $user_id = $row1['user_id'];
                                                                $qurtemp = mysqli_query($db, "SELECT firstname,lastname FROM `cam_users` where users_id = '$user_id' and pin_flag = '1' ");
                                                                $rowctemp = mysqli_fetch_array($qurtemp);
                                                                if ($rowctemp != NULL) {
                                                                    $fullnn = $rowctemp["firstname"] . " " . $rowctemp["lastname"];

                                                                    echo "<option value='" . $user_id . "' >" . $fullnn . "</option>";
                                                                }
                                                                $fullnm = "";
                                                            }
                                                            ?>
                                                        </select>
                                                        <span style="font-size: x-small;color: darkred;display: none;" id="u_error_<?php echo $j; ?>">Select User.</span>
                                                    </div>

                                                    <div class="col-md-3">
                                                            <span class="form_tab_td" id="approve_msg">
                                                            <input type="password" name="pin[]" id="pin_<?php echo $j ?>"
                                                                   class="form-control"
                                                                   placeholder="Enter Pin..."  autocomplete="off" >
                                                            <span style="font-size: x-small;color: darkred; display: none;width: 100px;" id="pin_error_<?php echo $j; ?>">Invalid Pin.</span>
                                                        </span>
                                                    </div>

                                                    <div class="col-md-1">
                                                        <input type="hidden" id="form_user_data_id"
                                                               name="form_user_data_id" value=""/>
                                                        <input type="hidden" id="approval_dept_cnt"
                                                               name="approval_dept_cnt" value=""/>
                                                        <button type="submit" id="approve_<?php echo $j ?>"
                                                                name="approve"
                                                                class="btn btn-primary approve">
                                                            <i class="fa fa-check" aria-hidden="true"></i>

                                                        </button>
                                                    </div>

                                                    <div class="col-md-1">
                                                        <button type="submit" id="reject_<?php echo $k ?>"
                                                                name="reject"
                                                                class="btn btn-primary reject">
                                                            <i class="fa fa-times" aria-hidden="true"></i>

                                                        </button>
                                                        <input type="hidden" id="rejected_dept_cnt"
                                                               name="rejected_dept_cnt" value=""/>
                                                        <input type="hidden" id="reject_dept_cnt"
                                                               name="reject_dept_cnt" value=""/>
                                                    </div>

                                                </div>
                                                <div class="row row-xs align-items-center mg-b-20">
                                                    <div class="col-md-12">
                                                        <div class="reason" id="rej_reason_div_<?php echo $j ?>" style="display: none">
                                                             <span class="form_tab_td" id="rej_reason_td_<?php echo $j ?>" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                $j++;
                                                $k++;
                                            }
                                        }
                                        ?>
                                        <input type="hidden" name="tot_approval_dept" id="tot_approval_dept"
                                               value="<?php echo ($j); ?>">
                                        <input type="hidden" name="tot_rejected_dept" id="tot_rejected_dept"
                                               value="<?php echo ($k); ?>">
                                        <?php
                                    }
                                    ?>

                                    <div>
                                        <hr class="form_hr"/>
                                    </div>

                                    <div class="row form_row_item">
                                        <input type="hidden" name="click_id_1" id="click_id_1">
                                        <div class="col-md-2">
                                            <button type="button" id="btnSubmit_1" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5 legitRipple" disabled>
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </form>
</div>
<script>
    $("#btnSubmit").click(function (e) {
        if ($("#form_settings")[0].checkValidity()){
            var data = $("#form_settings").serialize();
            $.ajax({
                type: 'POST',
                url: 'user_form_backend.php',
                dataType: "json",
                // context: this,
                async: false,
                data: data,
                success: function (data) {
                    $('#btnSubmit').attr('disabled', 'disabled');
                    $('form input[type="radio"]').attr('disabled', 'disabled');
                    $('form input[type="number"]').css('pointer-events','none');
                    $('form input[type="text"]').css('pointer-events','none');
                    $("label[for='yes']").css('pointer-events','none');
                    $("label[for='no']").css('pointer-events','none');
                    $("textarea#wol").css('pointer-events','none');
                    $("textarea#notes").css('pointer-events','none');
                    document.getElementById("form_user_data_id").value = data["form_user_data_id"];
                    document.getElementById("approval_dept_cnt").value = data["approval_dept_cnt"];
                    document.getElementById("rejected_dept_cnt").value = data["rejected_dept_cnt"];
                    var bypass_approve = $("#bypass_approve").val();
                    var err_cnt = data["out_of_tol_val_cnt"];
                    var dept_cnt =data["approval_dept_cnt"];

                    var x = document.getElementById("approve_sec");
                    if (x.style.display === "none") {
                        x.style.display = "block";
                        var y = document.getElementById("btnSubmit");
                        y.style.display = "none";
                    }

                    if(err_cnt > 0){
                        document.getElementById("sub_app").style.display = "block";
                        document.getElementById("app_list").style.display = "block";
                        document.getElementById("notes").required = true;
                        // document.getElementsByClassName("reason").style.display = "block";
                        for(var i =0 ; i<dept_cnt ; i++){
                            var z = document.getElementById("rej_reason_div_"+i);
                            if (z.style.display === "none") {
                                z.style.display = "block";
                                //<td class="form_tab_td" colspan="4">
                                //        <textarea class="form-control" placeholder="Enter Reject Reason..." oninvalid="this.setCustomValidity('Enter Reject reason')"
                                //    onvalid="this.setCustomValidity('')" id="rej_reason_<?php //echo $j ?>//" name = "rej_reason_<?php //echo $j ?>//" rows="1"></textarea>
                                //        </td>
                                var y = document.getElementById("rej_reason_td_"+i);
                                var rr_id = 'rej_reason_'+i;
                                y.innerHTML += "<textarea class= \"form-control\" placeholder=\"Enter Reason\" id= \"" +  rr_id + "\" name = \"" +  rr_id + "\" rows=\"1\" required></textarea>";
                            }
                        }


                    }else{
                        // document.getElementsByClassName("reason").style.display = "none";
                        if (bypass_approve == 'yes'){
                            $('#success_msg_app').text('Form submitted Successfully').css('background-color', '#0080004f');
                            window.scrollTo(0, 0);
                        }
                    }

                }
            });
        }
        // e.preventDefault();
    });

    $("#btnSubmit_app").click(function (e) {
        if ($("#form_settings")[0].checkValidity()){
            var data = $("#form_settings").serialize();
            $.ajax({
                type: 'POST',
                url: 'user_form_backend.php',
                dataType: "json",
                // context: this,
                async: false,
                data: data,
                success: function (data) {
                    $('#btnSubmit_app').attr('disabled', 'disabled');
                    $('#success_msg').text('Form submitted Successfully').css('background-color','#0080004f');
                    $("form :input").prop("disabled", true);
                    window.scrollTo(0, 0);

                }
            });
        }
        // e.preventDefault();
    });

    $("#btnSubmit_1").click(function (e) {
        var data = $("#form_settings").serialize();
        var data_req = [];
        var cnt = document.getElementById("rejected_dept_cnt").value;
        for(var rid = 0; rid < cnt ; rid++){
            var rr = document.getElementById("rej_reason_td_" + rid );
            var rr_id = 'rej_reason_'+ rid;
            var rr_e_id = 'rej_reason_error_'+ rid;
            if(null != document.getElementById("rej_reason_" + rid )){
                var rej_r = document.getElementById("rej_reason_" + rid ).value;
                if(null == rej_r || '' == rej_r) {
                    rr.innerHTML = "<textarea class= \"form-control\" placeholder=\"Enter Reason\" id= \"" + rr_id + "\" name = \"" + rr_id + "\" rows=\"1\" required></textarea><span style=\"font-size: x-small;color: darkred;\" id=\"" + rr_e_id + "\">Enter Reason.</span>";
                    data_req[rid] = true;
                }else if((null != rej_r || '' != rej_r) && (null != document.getElementById(rr_e_id))){
                    document.getElementById(rr_e_id).innerHTML = '';
                }else{
                    if( null != document.getElementById("rr_e_id")){
                        document.getElementById(rr_e_id).style.display = "none";
                        document.getElementById(rr_e_id).innerHTML = '';
                    }
                }
            }
        }
        if(data_req.length == 0){
            var data = $("#form_settings").serialize();
            var rr = document.getElementById("rej_reason_" + this.id.split("_")[1]);
            var rr_data = "";
            if (null != rr) {
                rr_data = rr.value;
            }
            var data_1 = data + "&update_fud=1" + "&form_user_data_id=" + document.getElementById("form_user_data_id").value + "&reject_reason=" + rr_data;
            $.ajax({
                type: 'POST',
                url: 'user_form_backend.php',
                // dataType: "json",
                // context: this,
                // async: false,
                data: data_1,
                success: function (response) {
                    $('#btnSubmit_1').attr('disabled', 'disabled');
                    var x = document.getElementById("sub_app");
                    x.style.display = "none";
                    $('#success_msg_app').text('Form submitted Successfully').css('background-color', '#0080004f');
                    $("form :input").css('pointer-events','none');
                    // window.location.reload();
                }
            });
        }
    });

    $(".approve").click(function (e) {
        e.preventDefault();
        var index = this.id.split("_")[1];
        //  alert(index);
        var x = document.getElementById("u_error_"+index);
        x.style.display = "none";
        var y = document.getElementById("pin_error_"+index);
        y.style.display = "none";
        var data_1 = "index="+index+"&approval_dept_cnt=" + document.getElementById("approval_dept_cnt").value + "&form_user_data_id=" + document.getElementById("form_user_data_id").value + "&app_dept=" + document.getElementById("approval_dept" + "_" + this.id.split("_")[1]).value + "&app_id=" + document.getElementById("approval_initials" + "_" + this.id.split("_")[1]).value + "&pin=" + document.getElementById("pin" + "_" + this.id.split("_")[1]).value;
        // alert(data_1);
        $.ajax({
            type: "POST",
            context: this,
            url: "approve_store_backend.php",
            data: data_1,
            //  cache: false,
            success: function (response) {
                // button manipulation here
                var arr_data = JSON.parse(response);
                if(arr_data["error_type"] === "user_error"){
                    var id = "u_error_"+ arr_data["err_row"];
                    var x = document.getElementById(id);
                    if (x.style.display === "none") {
                        x.style.display = "block";
                    }
                }else if (arr_data["error_type"] === "pin_error"){
                    var id = "pin_error_"+ arr_data["err_row"];
                    var x = document.getElementById(id);
                    if (x.style.display === "none") {
                        x.style.display = "block";
                    }
                }else if (arr_data["all_dept_approved"] == 1) {
                    $('#' + this.id).attr('disabled', 'disabled').addClass('<i class="fa fa-times" aria-hidden="true"></i>').css({'background-color': '#43a047'});
                    $('#pin_'+this.id.split("_")[1]).attr('disabled', 'disabled');
                    // $('#reject_'+this.id.split("_")[1]).attr('disabled', 'disabled');
                    $('#reject_'+this.id.split("_")[1]).css('display', 'none');
                    $('#approval_initials_'+this.id.split("_")[1]).attr('disabled', 'disabled');
                    $('#btnSubmit_1').removeAttr('disabled');
                }else if(arr_data["all_dept_approved"] == 0){
                    $('#' + this.id).attr('disabled', 'disabled').addClass('<i class="fa fa-times" aria-hidden="true"></i>').css({'background-color': '#43a047'});
                    $('#pin_'+this.id.split("_")[1]).attr('disabled', 'disabled');
                    $('#reject_'+this.id.split("_")[1]).css('display', 'none');
                    $('#approval_initials_'+this.id.split("_")[1]).attr('disabled', 'disabled');
                }
            },
        });
    });
    $(".reject").click(function (e) {
        e.preventDefault();
        var index = this.id.split("_")[1];
        var x = document.getElementById("u_error_"+index);
        x.style.display = "none";
        var y = document.getElementById("pin_error_"+index);
        y.style.display = "none";
        var z = document.getElementById("rej_reason_div_"+index);
        if (z.style.display === "none") {
            z.style.display = "block";
            //<td class="form_tab_td" colspan="4">
            //        <textarea class="form-control" placeholder="Enter Reject Reason..." oninvalid="this.setCustomValidity('Enter Reject reason')"
            //    onvalid="this.setCustomValidity('')" id="rej_reason_<?php //echo $j ?>//" name = "rej_reason_<?php //echo $j ?>//" rows="1"></textarea>
            //        </td>
            var y = document.getElementById("rej_reason_td_"+index);
            var rr_id = 'rej_reason_'+index;
            y.innerHTML += "<textarea class= \"form-control\" placeholder=\"Enter Reason\" id= \"" +  rr_id + "\" name = \"" +  rr_id + "\" rows=\"1\" required></textarea>";
        }

        // if(document.getElementById("rej_reason_"+index).value){
        var data_1 = "index="+index+"&rejected_dept_cnt=" + document.getElementById("rejected_dept_cnt").value + "&form_user_data_id=" + document.getElementById("form_user_data_id").value + "&app_dept=" + document.getElementById("approval_dept" + "_" + this.id.split("_")[1]).value + "&app_id=" + document.getElementById("approval_initials" + "_" + this.id.split("_")[1]).value + "&pin=" + document.getElementById("pin" + "_" + this.id.split("_")[1]).value ;
        $.ajax({
            type: "POST",
            context: this,
            url: "reject_store_backend.php",
            data: data_1,
            //  cache: false,
            success: function (response) {
                // button manipulation here
                var arr_data = JSON.parse(response);
                if(arr_data["error_type"] === "user_error"){
                    var id = "u_error_"+ arr_data["err_row"];
                    var x = document.getElementById(id);
                    if (x.style.display === "none") {
                        x.style.display = "block";
                    }
                }else if (arr_data["error_type"] === "pin_error"){
                    var id = "pin_error_"+ arr_data["err_row"];
                    var x = document.getElementById(id);
                    if (x.style.display === "none") {
                        x.style.display = "block";
                    }
                }else if(arr_data["all_dept_rejected"] == 1) {
                    $('#' + this.id).attr('disabled', 'disabled').addClass('<i class="fa fa-times" aria-hidden="true"></i>').css({'background-color': '#d84315'});
                    $('#rej_reason_div_'+this.id.split("_")[1]).attr('disabled', 'disabled');

                    $('#pin_'+this.id.split("_")[1]).attr('disabled', 'disabled');
                    // $('#approve_'+this.id.split("_")[1]).attr('disabled', 'disabled');
                    $('#approve_'+this.id.split("_")[1]).css('display', 'none');

                    $('#approval_initials_'+this.id.split("_")[1]).attr('disabled', 'disabled');
                    $('#btnSubmit_1').removeAttr('disabled');
                }else if(arr_data["all_dept_rejected"] == 0){
                    $('#' + this.id).attr('disabled', 'disabled').addClass('<i class="fa fa-times" aria-hidden="true"></i>').css({'background-color': '#d84315'});
                    $('#rej_reason_div_'+this.id.split("_")[1]).attr('disabled', 'disabled');

                    $('#pin_'+this.id.split("_")[1]).attr('disabled', 'disabled');
                    $('#approve_'+this.id.split("_")[1]).css('display', 'none');
                    $('#approval_initials_'+this.id.split("_")[1]).attr('disabled', 'disabled');
                    // $('#btnSubmit_1').removeAttr('disabled');
                }
            },
        });
    });
</script>
<script>
    $(".text_num").keyup(function () {

        var bypass_approve = $("#bypass_approve").val();
        if (bypass_approve == 'yes') {
            document.getElementById("app_list").style.display = "none"
            document.getElementById("sub_app").style.display = "none"
            // $('#success_msg_app').text('Form submitted Successfully').css('background-color', '#0080004f');
        }
    });
</script>
<script>
    $(".compare_text").keyup(function () {
        var text_id = $(this).attr("id");
        var lower_compare = parseFloat($(".lower_compare[data-id='" + text_id + "']").val());
        var upper_compare = parseFloat($(".upper_compare[data-id='" + text_id + "']").val());
        var text_val = $(this).val();
        var bypass_approve = $("#bypass_approve").val();
        if ($(".compare_text").val().length == 0) {
            $(this).attr('style','background-color:white !important');
            return false;
        } else {
            if ($.isNumeric(text_val)) {

                if (text_val >= lower_compare && text_val <= upper_compare) {
                    $(this).attr('style','background-color:#abf3ab !important');
                    if (bypass_approve == 'yes') {
                        document.getElementById("app_list").style.display = "none"
                        document.getElementById("sub_app").style.display = "none"
                        $('#success_msg_app').text('Form submitted Successfully').css('background-color', '#0080004f');
                    }
                    document.getElementById("notes").required = false;
                    document.getElementsByClassName("reason").style.display = "none";
                } else {
                    $(this).attr('style','background-color:#ffadad !important');
                    document.getElementById("app_list").style.display = "block"
                    document.getElementById("sub_app").style.display = "block"
                    document.getElementById("notes").required = true;
                    document.getElementsByClassName("reason").style.display = "block";
                }
            }
        }
    });
    $('form').attr('autocomplete', 'off');
    $('input').attr('autocomplete', 'off');
    $("input:radio").click(function () {
        var radio_id = $(this).attr("name");
        var binary_compare = $(".binary_compare[data-id='" + radio_id + "']").val();
        var exact_val = $('input[name="' + radio_id + '"]:checked').val();
        var bypass_approve = $("#bypass_approve").val();
        var list_value = $(".list_enabled[data-id='" + radio_id + "']").val();

        if (exact_val == binary_compare) {
            if (list_value != '0') {
                if (exact_val != 'none'){
                    $("." + radio_id).css("background-color", "#abf3ab");
                }
            }else {
                $("." + radio_id).css("background-color", "#FFF");
            }
            if (bypass_approve == 'yes' || exact_val == 'none'){
                document.getElementById("app_list").style.display = "none";
                document.getElementById("sub_app").style.display = "none";
                // $('#success_msg_app').text('Form submitted Successfully').css('background-color', '#0080004f');
            }
            document.getElementById("notes").required = false;
        } else {
            if (list_value != '0') {
                if (exact_val == 'no' ||exact_val == 'yes') {
                    $("." + radio_id).css("background-color", "#ffadad");
                }else{

                    $("." + radio_id).css("background-color", "#FFF");
                }
            }
            else {

                $("." + radio_id).css("background-color", "#FFF");
            }
            if (bypass_approve == 'yes' || exact_val == 'none'){
                if(list_value == null){
                    document.getElementById("notes").required = true;
                }else{
                    document.getElementById("app_list").style.display = "none";
                    document.getElementById("sub_app").style.display = "none";
                }
                // $('#success_msg_app').text('Form submitted Successfully').css('background-color', '#0080004f');
            }else{
                if ((list_value != '0') || (list_value == null)) {
                    document.getElementById("notes").required = true;
                }
                document.getElementById("app_list").style.display = "block"
                document.getElementById("sub_app").style.display = "block"

            }
        }
    });
</script>

<?php include('../footer1.php') ?>
</body>