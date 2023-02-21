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
    //Unset the session variablesc

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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo $sitename; ?> |View Form</title>
    <!-- Global stylesheets -->


    <link href="../assets/css/core.css" rel="stylesheet" type="text/css">


    <!-- /global stylesheets -->
    <!-- Core JS files -->
    <!--    <script type="text/javascript" src="../assets/js/libs/jquery-3.6.0.min.js"> </script>-->
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


        .contextMenu{ position:absolute;  width:min-content; left: 204px; background:#e5e5e5; z-index:999;}
        .collapse.in {
            display: block!important;
        }
        .file-image-1 .icons li a {
            height: 30px;
            width: 30px;
        }

        input[type="file"] {
            display: block;
        }

        button.remove {
            margin-left: 15px;
        }

        .red-star {
            color: red;
        }

        @import url('https://fonts.googleapis.com/css2?family=WindSong&display=swap');



        .pn_none {
            pointer-events: none;
            color: #050505;
        }

        @media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px) {
            .col-lg-2{
                width: 35%!important;
            }
            .content:first-child {
                padding-top: 90px!important;
            }
            .col-md-8.form_col_item {
                float: left;
                width: 100%;
                padding-bottom: 10px;
            }
            .border-primary {
                border-color: #ffffff;
            }

            label.col-lg-3.control-label.mobile {
                width: 42%;
                float: left;
                padding: 10px 30px 10px 26px;
            }

            .col-md-4 {
                width: 30%;
            }
            .col-md-8.mg-t-5.mg-md-t-0 {
                width: 70%;
            }
            .col-md-5.mg-t-5.mg-md-t-0 {
                width: 80%;
            }


        }

        .pd-30 {
            padding: 2rem !important;
        }

    </style>
</head>
<body>

<!-- Page container -->
<body class="ltr main-body app horizontal">
<!-- Main navbar -->
    <?php
    $cam_page_header = "View Form";
    include("../header.php");
    if ($is_tab_login || ($_SESSION["role_id"] == "pn_user")) {
        include("../tab_menu.php");
    } else {
        include("../admin_menu.php");
    }
    ?>
<!-----main content----->
<div class="main-content app-content">
    <!---container--->
    <div class="main-container container">
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Forms</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form View</li>
            </ol>
        </div>
    </div>
                <?php
                $id = $_GET['id'];
                $querymain = sprintf("SELECT * FROM `form_user_data` where form_user_data_id = '$id' ");
                $qurmain = mysqli_query($db, $querymain);

                while ($rowcmain = mysqli_fetch_array($qurmain)) {
                    $formname = $rowcmain['form_name'];
                    $form_create_id = $rowcmain['form_create_id'];

                    ?>
              <form action="user_form_backend.php" id="form_settings" enctype="multipart/form-data" class="form-horizontal" method="post">
                   <div class="row row-sm">
                     <div class="col-lg-10 col-xl-10 col-md-12 col-sm-12">
                       <div class="card box-shadow-0">
                          <div class="card-header">
                                                <span class="main-content-title mg-b-0 mg-b-lg-1"><?php echo $rowcmain['form_name']; ?></span>
                                            </div>
                            <div class="card-body pt-0">
                                 <div class="pd-30 pd-sm-20" >
                                    <input type="hidden" name="name" id="name" value="<?php echo $rowcmain['form_name']; ?>">
                                       <div class="row row-xs align-items-center mg-b-20">
                                                        <div class="col-md-4">
                                                            <label class="form-label mg-b-0">Form Type : </label>
                                                        </div>
                                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                            <?php
                                                            $get_form_type = $rowcmain['form_type'];
                                                            if ($get_form_type != '') {
                                                                $disabled = 'disabled';
                                                            } else {
                                                                $disabled = '';
                                                            }
                                                            ?>
                                                            <input type="hidden" name="form_type" id="form_type"
                                                                   value="<?php echo $get_form_type; ?>">
                                                            <select  name="form_type1" id="form_type1" class="form-control form-select select2" data-bs-placeholder="Select Country" <?php echo $disabled; ?>>
                                                                <option value="" selected disabled>--- Select Form Type ---</option>
                                                                <?php

                                                                $sql1 = "SELECT * FROM `form_type` ";
                                                                $result1 = $mysqli->query($sql1);
                                                                // $entry = 'selected';
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
                                                            <label class="form-label mg-b-0">Station : </label>
                                                        </div>
                                                        <div class="col-md-8 mg-t-5 mg-md-t-0">

                                                            <?php
                                                            $get_station = $rowcmain['station'];
                                                            if ($get_station != '') {
                                                                $disabled = 'disabled';
                                                            } else {
                                                                $disabled = '';
                                                            }
                                                            ?>

                                                            <input type="hidden" name="station" id="station"
                                                                   value="<?php echo $get_station; ?>">
                                                            <select  name="station1" id="station1" class="form-control form-select select2" data-bs-placeholder="Select Country" <?php echo $disabled; ?>>
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
                                       <div class="row row-xs align-items-center mg-b-20">
                                                        <div class="col-md-4">
                                                            <label class="form-label mg-b-0">Part Family : </label>
                                                        </div>
                                                        <div class="col-md-8 mg-t-5 mg-md-t-0">

                                                            <?php
                                                            $get_part_family = $rowcmain['part_family'];
                                                            if ($get_part_family != '') {
                                                                $disabled = 'disabled';
                                                            } else {
                                                                $disabled = '';
                                                            }
                                                            ?>

                                                            <input type="hidden" name="part_family" id="part_family"
                                                                   value="<?php echo $get_part_family; ?>">
                                                            <select name="part_family1" id="part_family1"
                                                                    class="form-control form-select select2" data-bs-placeholder="Select Country" <?php echo $disabled; ?>>
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
                                       <div class="row row-xs align-items-center mg-b-20">
                                                        <div class="col-md-4">
                                                            <label class="form-label mg-b-0">Part Number : </label>
                                                        </div>
                                                        <div class="col-md-8 mg-t-5 mg-md-t-0">

                                                            <?php
                                                            $get_part_number = $rowcmain['part_number'];
                                                            if ($get_part_number != '') {
                                                                $disabled = 'disabled';
                                                            } else {
                                                                $disabled = '';
                                                            }
                                                            ?>

                                                            <input type="hidden" name="part_number" id="part_number"
                                                                   value="<?php echo $get_part_number; ?>">
                                                            <select name="part_number1" id="part_number1"
                                                                    class="form-control form-select select2" data-bs-placeholder="Select Country" <?php echo $disabled; ?>>
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
                                                                    echo "<option value='" . $row1['pm_part_number_id'] . "' $entry >" . $row1['part_number'] . " - " . $row1['part_name'] . "</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                       <div class="row row-xs align-items-center mg-b-20">
                                                        <div class="col-md-4">
                                                            <label class="form-label mg-b-0">Operator : </label>
                                                        </div>
                                                        <div class="col-md-8 mg-t-5 mg-md-t-0">

                                                            <?php
                                                            $createdby = $rowcmain['created_by'];
                                                            $datetime = $rowcmain["created_at"];
                                                            $create_date = strtotime($datetime);
                                                            $qur04 = mysqli_query($db, "SELECT firstname,lastname,pin FROM  cam_users where users_id = '$createdby' ");
                                                            $rowc04 = mysqli_fetch_array($qur04);
                                                            $fullnnm = $rowc04["firstname"] . " " . $rowc04["lastname"];
                                                            $pin = $rowc04["pin"];
                                                            $updated_at = strtotime($rowcmain["updated_at"]);
                                                            ?>

                                                            <input type="text" name="createdby" class="form-control" id="createdby"
                                                                   value="<?php echo $fullnnm; ?>" disabled>
                                                        </div>
                                                    </div>
                                       <div class="row row-xs align-items-center mg-b-20">
                                                        <div class="col-md-4">
                                                            <label class="form-label mg-b-0">Images : </label>
                                                        </div>
                                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="card">
                                                                        <div class="card-body">
                                                                            <div class="text-wrap pb-3">
                                    <?php
                                    $item_id = $form_create_id;
                                    $qurimage = mysqli_query($db, "SELECT * FROM  form_images where form_create_id = '$item_id'");
                                    while ($rowcimage = mysqli_fetch_array($qurimage)) {
                                        ?>
                                        <div class="file-image-1">
                                            <div class="product-image">
                                                <img src="../form_images/<?php echo $rowcimage['image_name']; ?>" class="br-5" alt="">
                                            </div>
                                            <span class="file-name-1"><a href="../form_images/<?php echo $rowcimage['image_name']; ?>" data-popup="lightbox" rel="gallery" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-plus3"></i></a></span>
                                        </div>
                                        <?php   $i++;} ?>
                                </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                     <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                         <div class="card box-shadow-0">
                                           <div class="card-header">
                                            <span class="main-content-title mg-b-0 mg-b-lg-1"><center>Form Information</center></span>
                                           </div>
                                        </div>
                                     </div>
                                <?php

                                $query = sprintf("SELECT * FROM  form_item where form_create_id = '$item_id'  order by form_item_seq+0 ASC ");
                                $qur = mysqli_query($db, $query);
                                $aray_item_cnt = 0;
                                $arrteam = explode(',', $rowcmain["form_user_data_item"]);
                                while ($rowc = mysqli_fetch_array($qur)) {
                                    $expVal = $arrteam[$aray_item_cnt];
                                    $ccnt = substr_count ($expVal, '~');
                                    if($ccnt > 0){
                                        $itemVal = explode('~',  $expVal)[1];
                                    }else{
                                        $itemVal = explode('~',  $expVal)[0];
                                    }
                                    $item_val = $rowc['item_val'];

                                    if($item_val == "header"){

                                        ?>
                                    <div class="row row-xs align-items-center mg-b-20">
                                            <span class="main-content-title mg-b-0 mg-b-lg-1"><?php echo htmlspecialchars($rowc['item_desc']); ?></span>
                                        </div>
                                    <?php }
                                    if($item_val == "numeric")
                                    {
                                        $checked = $itemVal;


                                        $numeric_normal = $rowc['numeric_normal'];
                                        $numeric_lower_tol1 = $rowc['numeric_lower_tol'];
                                        $numeric_upper_tol1 = $rowc['numeric_upper_tol'];

                                        $numeric_lower_tol1 = str_replace(' ', '', $numeric_lower_tol1); // Replaces all spaces with hyphens.
                                        $numeric_lower_tol1 = preg_replace('/[^A-Za-z0-9]/', '', $numeric_lower_tol1); // Removes special chars.
                                        $final_lower = $numeric_normal - $numeric_lower_tol1; // final lower value

                                        $numeric_upper_tol1 = str_replace(' ', '', $numeric_upper_tol1); // Replaces all spaces with hyphens.
                                        $numeric_upper_tol1 = preg_replace('/[^A-Za-z0-9]/', '', $numeric_upper_tol1); // Removes special chars.
                                        $final_upper = $numeric_normal + $numeric_upper_tol1; // final upper value

                                        //echo $final_upper;



                                        ?>
                                        <input type="hidden" data-id="<?php echo $rowc['form_item_id']; ?>"
                                               class="lower_compare" value="<?php echo $final_lower; ?>">
                                        <input type="hidden" data-id="<?php echo $rowc['form_item_id']; ?>"
                                               class="upper_compare" value="<?php echo $final_upper; ?>">
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-0.5">
                                                <label class=" form_col_item">
                                                <?php  if ($rowc['optional'] != '1') {
                                                        echo '<span class="red-star">★</span>';
                                                    } ?>
                                                </label>
                                            </div>
                                            <div class="col-md-6" >
                                                <label class=" form_col_item"><?php  if ($rowc['optional'] != '1') {
                                                    echo $rowc['item_desc']; }?> </label>
                                                <?php if (isset($rowc['discription']) && ($rowc['discription'] != '')) { ?>
                                                    <?php echo "(" . $rowc['discription'] . ")" ?>
                                                <?php } ?>
                                            </div>

                                            <?php if ($checked >= $final_lower && $checked <= $final_upper) { ?>
                                                <div class="col-md-5 mg-t-5 mg-md-t-0">
                                                    <input type="number" name="<?php echo $rowc['form_item_id']; ?>"
                                                           id="<?php echo $rowc['form_item_id']; ?>"
                                                           class="form-control compare_text pn_none" required step="any"
                                                           value="<?php echo $itemVal; ?>"  disabled>
                                                </div>
                                            <?php } else { ?>
                                                <div class="col-md-5 mg-t-5 mg-md-t-0">
                                                    <input type="number" name="<?php echo $rowc['form_item_id']; ?>"
                                                           id="<?php echo $rowc['form_item_id']; ?>"
                                                           class="form-control compare_text pn_none" required step="any"
                                                           value="<?php echo $itemVal; ?>"  style="background-color: #ffadad" disabled>
                                                </div>
                                            <?php } ?>
                                            <div class="col-md-0.5">
                                            <?php
                                            $unit_of_measurement_id = $rowc['unit_of_measurement'];
                                            $sql1 = "SELECT unit_of_measurement FROM `form_measurement_unit` where form_measurement_unit_id = '$unit_of_measurement_id'";
                                            $result1 = $mysqli->query($sql1);
                                            $row1 = $result1->fetch_assoc();
                                            echo $row1['unit_of_measurement'];
                                            ?>
                                            </div>
                                            <input type="hidden"  name="form_item_array[]" value="<?php echo $rowc['form_item_id']; ?>">
                                        </div>
                                        <?php
                                        $aray_item_cnt++;
                                    }
                                    if($item_val == "binary"){
                                        $checked = $itemVal;
                                        ?>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-0.5">
                                                 <?php if ($rowc['optional'] != '1') {
                                                    echo '<span class="red-star">★</span>';
                                                } ?>
                                            </div>
                                            <div class="col-md-6 form_col_item">
                                               <?php
                                                echo htmlspecialchars($rowc['item_desc']); ?>
                                            </div>

                                            <div class="col-md-5 mg-t-5 mg-md-t-0">
                                                <div class="row mg-t-15">
                                                    <input type="hidden"  name="form_item_array[]" value="<?php echo $rowc['form_item_id']; ?>">
                                                    <?php
                                                    if ($checked == "yes") {
                                                        ?>
                                                    <div class="col-lg-2.5 mg-t-20 mg-lg-t-0">
                                                        <label class="rdiobox">
                                                        <input type="radio" id="yes" name="<?php echo $rowc['form_item_id']; ?>"
                                                               value="<?php echo $rowc['binary_yes_alias']; ?>"
                                                               class="pn_none" checked disabled >
                                                        <span for="yes"
                                                               class="pn_none item_label <?php echo $rowc['form_item_id']; ?>"
                                                               id="<?php echo $rowc['form_item_id']; ?>"><?php $yes_alias = $rowc['binary_yes_alias'];
                                                            echo (($yes_alias != null) || ($yes_alias != '')) ? $yes_alias : "Yes" ?></span>
                                                        </label>
                                                    </div>
                                                    <div class="col-lg-2.5 mg-t-20 mg-lg-t-0">
                                                        <label class="rdiobox">
                                                        <input type="radio" id="no" name="<?php echo $rowc['form_item_id']; ?>"
                                                               value="<?php echo $rowc['binary_no_alias']; ?>"
                                                               class="pn_none" disabled >
                                                        <span for="no"
                                                               class="pn_none item_label <?php echo $rowc['form_item_id']; ?>"
                                                               id="<?php echo $rowc['form_item_id']; ?>"><?php $no_alias = $rowc['binary_no_alias'];
                                                            echo (($no_alias != null) || ($no_alias != '')) ? $no_alias : "No" ?></span>
                                                        </label>
                                                    </div>

                                                        <?php
                                                    } else { ?>

                                                    <div class="col-lg-2.5 mg-t-20 mg-lg-t-0">
                                                       <label class="rdiobox">
                                                        <input type="radio" id="yes" name="<?php echo $rowc['form_item_id']; ?>"
                                                               value="<?php echo $rowc['binary_yes_alias']; ?>"
                                                               class="pn_none" disabled >
                                                        <span for="yes" class="item_label" style="background-color: #ffadad;"
                                                               style="background-color: #ffadad;"><?php echo $rowc['binary_yes_alias']; ?></span>
                                                       </label>
                                                    </div>
                                                    <div class="col-lg-2.5 mg-t-20 mg-lg-t-0">
                                                        <label class="rdiobox">
                                                        <input type="radio" id="no" name="<?php echo $rowc['form_item_id']; ?>"
                                                               value="<?php echo $rowc['binary_no_alias']; ?>"
                                                               class="pn_none" checked disabled >
                                                        <span for="no" class="item_label" style="background-color: #ffadad;"
                                                               style="background-color: #ffadad;"><?php echo $rowc['binary_no_alias']; ?></span>
                                                       </label>
                                                    </div>

                                                    <?php }
                                                    ?>
                                                    <?php if ($rowc['optional'] == '1') {
                                                        echo '<span style="color: #a1a1a1; font-size: small;padding-top: 15px;padding-left:15px;">(Optional)</span>';
                                                    } ?>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-8 form_col_item"><u><b><?php echo $rowc['discription']; ?> </b></u></div>

                                        </div>

                                        <?php
                                        $aray_item_cnt++;

                                    }
                                    if($item_val == "list"){
                                        $checked = $itemVal;
                                        ?>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-0.5">
                                                <?php if ($rowc['optional'] != '1') {
                                                    echo '<span class="red-star">★</span>';
                                                } ?>
                                            </div>
                                            <div class="col-md-6">
                                              <?php
                                                echo htmlspecialchars($rowc['item_desc']); ?>
                                            </div>


                                            <div class="col-md-5 mg-t-5 mg-md-t-0">
                                                <div class="row mg-t-15">
                                                    <input type="hidden"  name="form_item_array[]" value="<?php echo $rowc['form_item_id']; ?>">
                                                    <?php
                                                    if ($checked == "yes")  {
                                                        ?>
                                                    <div class="col-lg-2.5 mg-t-20 mg-lg-t-0">
                                                    <label class="rdiobox">
                                                        <input type="radio" id="yes" name="<?php echo $rowc['form_item_id']; ?>"
                                                               value="<?php echo $rowc['list_name2']; ?>"
                                                               class="pn_none" checked disabled >
                                                        <span for="yes"
                                                               class="pn_none item_label <?php echo $rowc['form_item_id']; ?>"
                                                               id="<?php echo $rowc['form_item_id']; ?>"><?php $yes_alias = $rowc['list_name2'];
                                                            echo (($yes_alias != null) || ($yes_alias != '')) ? $yes_alias : "Yes" ?></span>
                                                    </label>
                                                    </div>
                                                    <div class="col-lg-2.5 mg-t-20 mg-lg-t-0">
                                                    <label class="rdiobox">
                                                        <input type="radio" id="no" name="<?php echo $rowc['form_item_id']; ?>"
                                                               value="<?php echo $rowc['list_name3']; ?>"
                                                               class="pn_none" disabled >
                                                        <span for="no"
                                                               class="pn_none item_label <?php echo $rowc['form_item_id']; ?>"
                                                               id="<?php echo $rowc['form_item_id']; ?>"><?php $no_alias = $rowc['list_name3'];
                                                            echo (($no_alias != null) || ($no_alias != '')) ? $no_alias : "No" ?></span>
                                                    </label>
                                                    </div>
                                                        <?php if (empty($rowc['list_name1'])){ ?>
                                                    <div class="col-lg-2.5 mg-t-20 mg-lg-t-0">
                                                        <label class="rdiobox" style="display: none">
                                                                <input type="radio" id="none" name="<?php echo $rowc['form_item_id']; ?>"
                                                                       value="<?php echo $rowc['list_name1']; ?>"
                                                                       class="pn_none" disabled >
                                                                <span for="none"
                                                                       class="pn_none item_label <?php echo $rowc['form_item_id']; ?>"
                                                                       id="<?php echo $rowc['form_item_id']; ?>" >

                                                                </span>
                                                        </label>
                                                    </div>
                                                        <?php } else { ?>
                                                    <div class="col-lg-2.5 mg-t-20 mg-lg-t-0">

                                                            <label class="rdiobox">
                                                            <input type="radio" id="none" name="<?php echo $rowc['form_item_id']; ?>"
                                                                   value="<?php echo $rowc['list_name1']; ?>"
                                                                   class="pn_none" disabled >
                                                            <span for="none"
                                                                   class="pn_none item_label <?php echo $rowc['form_item_id']; ?>"
                                                                   id="<?php echo $rowc['form_item_id']; ?>"><?php $yes_alias = $rowc['list_name1'];
                                                                echo (($yes_alias != null) || ($yes_alias != '')) ? $yes_alias : "None" ?></span>
                                                            </label>
                                                        </div>
                                                        <?php } ?>
                                                        <?php $list_extra =  $rowc['list_name_extra'];
                                                        if(!empty($list_extra)){
                                                            $arrteam_list = explode(',', $list_extra);
                                                            $radiocount = 1;
                                                            foreach ($arrteam_list as $arr_list) { ?>
                                                        <div class="col-lg-2.5 mg-t-20 mg-lg-t-0">
                                                            <label class="rdiobox">
                                                                <input type="radio" id="extra" name="<?php echo $rowc['form_item_id']; ?>"
                                                                       value="<?php echo $arr_list; ?>"
                                                                       class=" pn_none" disabled >
                                                                <span for="none"
                                                                       class="pn_none item_label <?php echo $rowc['form_item_id']; ?>"
                                                                       id="<?php echo $rowc['form_item_id']; ?>"><?php $extra_alias = $arr_list;
                                                                    echo (($extra_alias != null) || ($extra_alias != '')) ? $extra_alias : "Extra" ?></span>

                                                            </label>
                                                        </div>
                                                                <?php  $radiocount++; }
                                                        }
                                                        ?>
                                                        <?php
                                                    }  else if (($checked == "no") ) { ?>
                                                    <div class="col-lg-2.5 mg-t-20 mg-lg-t-0">
                                                        <label class="rdiobox">
                                                        <input type="radio" id="yes" name="<?php echo $rowc['form_item_id']; ?>"
                                                               value="<?php echo $rowc['list_name2']; ?>"
                                                               class=" pn_none" disabled >
                                                        <span for="yes" class="item_label"
                                                            <?php if($rowc['list_enabled'] ==1 ){ echo 'style="background-color: #ffadad;"';}else{echo 'style="background-color: #fff;"';}?>><?php echo $rowc['list_name2']; ?></span>
                                                        </label>
                                                    </div>
                                                    <div class="col-lg-2.5 mg-t-20 mg-lg-t-0">
                                                        <label class="rdiobox">
                                                        <input type="radio" id="no" name="<?php echo $rowc['form_item_id']; ?>"
                                                               value="<?php echo $rowc['list_name3']; ?>"
                                                               class=" pn_none" checked disabled >
                                                        <span for="no" class="item_label" <?php if($rowc['list_enabled'] ==1 ){ echo 'style="background-color: #ffadad;"';}else{echo 'style="background-color: #fff;"';}?>><?php echo $rowc['list_name3']; ?></span>
                                                        </label>
                                                    </div>
                                                        <?php if (empty($rowc['list_name1'])){ ?>
                                                    <div class="col-lg-2.5 mg-t-20 mg-lg-t-0">
                                                            <label class="rdiobox" style="display: none">
                                                            <input type="radio" id="none" name="<?php echo $rowc['form_item_id']; ?>"
                                                                   value="<?php echo $rowc['list_name1']; ?>"
                                                                   class=" pn_none" disabled >
                                                            <span for="none"
                                                                   class="pn_none item_label <?php echo $rowc['form_item_id']; ?>"
                                                                   id="<?php echo $rowc['form_item_id']; ?>" <?php if($rowc['list_enabled'] ==1 ){ echo 'style="background-color: #ffadad;"';}else{echo 'style="background-color: #fff;"';}?>></span>
                                                            </label>
                                                    </div>
                                                        <?php } else { ?>
                                                    <div class="col-lg-2.5 mg-t-20 mg-lg-t-0">

                                                            <label class="rdiobox">
                                                            <input type="radio" id="none" name="<?php echo $rowc['form_item_id']; ?>"
                                                                   value="<?php echo $rowc['list_name1']; ?>"
                                                                   class=" pn_none" disabled >
                                                            <span for="none"
                                                                   class="pn_none item_label <?php echo $rowc['form_item_id']; ?>"
                                                                   id="<?php echo $rowc['form_item_id']; ?>" <?php if($rowc['list_enabled'] ==1 ){ echo 'style="background-color: #ffadad;"';}else{echo 'style="background-color: #fff;"';}?>><?php $yes_alias = $rowc['list_name1'];
                                                                echo (($yes_alias != null) || ($yes_alias != '')) ? $yes_alias : "None" ?></span>
                                                            </label>
                                                            </div>
                                                        <?php } ?>
                                                        <?php $list_extra =  $rowc['list_name_extra'];
                                                        if(!empty($list_extra)){
                                                            $arrteam_list = explode(',', $list_extra);
                                                            $radiocount = 1;
                                                            foreach ($arrteam_list as $arr_list) { ?>
                                                    <div class="col-lg-2.5 mg-t-20 mg-lg-t-0">
                                                            <label class="rdiobox">
                                                                <input type="radio" id="extra" name="<?php echo $rowc['form_item_id']; ?>"
                                                                       value="<?php echo $arr_list; ?>"
                                                                       class=" pn_none" disabled>
                                                                <span for="none"
                                                                       class="pn_none item_label <?php echo $rowc['form_item_id']; ?>"
                                                                       id="<?php echo $rowc['form_item_id']; ?>" <?php if($rowc['list_enabled'] ==1 ){ echo 'style="background-color: #ffadad;"';}else{echo 'style="background-color: #fff;"';}?>><?php $extra_alias = $arr_list;
                                                                    echo (($extra_alias != null) || ($extra_alias != '')) ? $extra_alias : "Extra" ?></span>
                                                            </label>
                                                    </div>
                                                                <?php  $radiocount++; }
                                                        }
                                                        ?>
                                                    <?php }  else if ($checked == "none"){ ?>
                                                    <div class="col-lg-2.5 mg-t-20 mg-lg-t-0">

                                                         <label class="rdiobox">
                                                        <input type="radio" id="yes" name="<?php echo $rowc['form_item_id']; ?>"
                                                               value="<?php echo $rowc['list_name2']; ?>"
                                                               class=" pn_none" disabled >
                                                        <span  for="yes" class="item_label"><?php echo $rowc['list_name2']; ?></span>
                                                         </label>
                                                    </div>
                                                    <div class="col-lg-2.5 mg-t-20 mg-lg-t-0">
                                                        <label class="rdiobox">
                                                        <input type="radio" id="no" name="<?php echo $rowc['form_item_id']; ?>"
                                                               value="<?php echo $rowc['list_name3']; ?>"
                                                               class=" pn_none"  disabled >
                                                        <span for="no" class="item_label"><?php echo $rowc['list_name3']; ?></span>
                                                        </label>
                                                    </div>
                                                    <div class="col-lg-2.5 mg-t-20 mg-lg-t-0">
                                                         <label class="rdiobox">
                                                        <input type="radio" id="none" name="<?php echo $rowc['form_item_id']; ?>"
                                                               value="<?php echo $rowc['list_name1']; ?>"
                                                               class=" pn_none" checked disabled >
                                                        <span for="none" class="item_label"><?php echo $rowc['list_name1']; ?></span>
                                                         </label>
                                                    </div>
                                                        <?php if (empty($rowc['list_name1'])){ ?>
                                                    <div class="col-lg-2.5 mg-t-20 mg-lg-t-0">
                                                                    <label class="rdiobox"  style="display: none">
                                                            <input type="radio" id="none" name="<?php echo $rowc['form_item_id']; ?>"
                                                                   value="<?php echo $rowc['list_name1']; ?>"
                                                                   class="pn_none" disabled>
                                                            <span for="none"
                                                                   class="pn_none item_label <?php echo $rowc['form_item_id']; ?>"
                                                                   id="<?php echo $rowc['form_item_id']; ?>" ></span>
                                                                    </label>
                                                    </div>
                                                        <?php } else { ?>
                                                    <div class="col-lg-2.5 mg-t-20 mg-lg-t-0">
                                                                    <label class="rdiobox">
                                                            <input type="radio" id="none" name="<?php echo $rowc['form_item_id']; ?>"
                                                                   value="<?php echo $rowc['list_name1']; ?>"
                                                                   class="pn_none" disabled >
                                                            <span for="none"
                                                                   class="pn_none item_label <?php echo $rowc['form_item_id']; ?>"
                                                                   id="<?php echo $rowc['form_item_id']; ?>"><?php $yes_alias = $rowc['list_name1'];
                                                                echo (($yes_alias != null) || ($yes_alias != '')) ? $yes_alias : "None" ?></span>
                                                                    </label>
                                                    </div>
                                                        <?php } ?>

                                                        <?php $list_extra =  $rowc['list_name_extra'];
                                                        if(!empty($list_extra)){
                                                            $arrteam_list = explode(',', $list_extra);
                                                            $radiocount = 1;
                                                            foreach ($arrteam_list as $arr_list) { ?>
                                                    <div class="col-lg-2.5 mg-t-20 mg-lg-t-0">
                                                                    <label class="rdiobox">
                                                                <input type="radio" id="extra" name="<?php echo $rowc['form_item_id']; ?>"
                                                                       value="extra_<?php echo $radiocount; ?>"
                                                                       class=" pn_none" disabled >
                                                                <span for="none"
                                                                       class="pn_none item_label <?php echo $rowc['form_item_id']; ?>"
                                                                       id="<?php echo $rowc['form_item_id']; ?>" <?php if($rowc['list_enabled'] == 1 ){ echo 'style="background-color: #ffadad;"';}else{echo 'style="background-color: #fff;"';}?>><?php $extra_alias = $arr_list;
                                                                    echo (($extra_alias != null) || ($extra_alias != '')) ? $extra_alias : "Extra" ?></span>
                                                                    </label>
                                                    </div>
                                                                <?php  $radiocount++; }
                                                        }
                                                        ?>

                                                    <?php } else { ?>
                                                    <div class="col-lg-2.5 mg-t-20 mg-lg-t-0">
                                                                    <label class="rdiobox">
                                                        <input type="radio" id="yes" name="<?php echo $rowc['form_item_id']; ?>"
                                                               value="<?php echo $rowc['list_name2']; ?>"
                                                               class=" pn_none" disabled >
                                                        <span for="yes" class="item_label"
                                                            <?php if($rowc['list_enabled'] ==1  ){ echo 'style="background-color: #ffadad;"';}else{echo 'style="background-color: #fff!important;"';}?>><?php echo $rowc['list_name2']; ?></span>
                                                                    </label>
                                                    </div>
                                                    <div class="col-lg-2.5 mg-t-20 mg-lg-t-0">
                                                                    <label class="rdiobox">
                                                        <input type="radio" id="no" name="<?php echo $rowc['form_item_id']; ?>"
                                                               value="<?php echo $rowc['list_name3']; ?>"
                                                               class="pn_none"  disabled >
                                                        <span for="no" class="item_label"
                                                            <?php if($rowc['list_enabled'] ==1  ){ echo 'style="background-color: #ffadad;"';}else{echo 'style="background-color: #fff!important;"';}?>><?php echo $rowc['list_name3']; ?></span>
                                                                    </label>
                                                    </div>
                                                        <?php if (empty($rowc['list_name1'])){ ?>
                                                    <div class="col-lg-2.5 mg-t-20 mg-lg-t-0">
                                                        <label class="rdiobox" style="display: none">
                                                            <input type="radio" id="none" name="<?php echo $rowc['form_item_id']; ?>"
                                                                   value="<?php echo $rowc['list_name1']; ?>"
                                                                   class="pn_none" disabled >
                                                            <span for="none"
                                                                   class="pn_none item_label <?php echo $rowc['form_item_id']; ?>"
                                                                   id="<?php echo $rowc['form_item_id']; ?>" ></span>
                                                                    </label>
                                                            </div>
                                                        <?php } else { ?>
                                                    <div class="col-lg-2.5 mg-t-20 mg-lg-t-0">
                                                                    <label class="rdiobox">
                                                            <input type="radio" id="none" name="<?php echo $rowc['form_item_id']; ?>"
                                                                   value="<?php echo $rowc['list_name1']; ?>"
                                                                   class="pn_none" disabled >
                                                            <span for="none"
                                                                   class="pn_none item_label <?php echo $rowc['form_item_id']; ?>"
                                                                   id="<?php echo $rowc['form_item_id']; ?>"><?php $yes_alias = $rowc['list_name1'];
                                                                echo (($yes_alias != null) || ($yes_alias != '')) ? $yes_alias : "None" ?></span>
                                                                    </label>
                                                    </div>
                                                    </div>
                                                        <?php } ?>
                                                        <?php $list_extra =  $rowc['list_name_extra'];
                                                        if(!empty($list_extra)){
                                                            $arrteam_list = explode(',', $list_extra);
                                                            $radiocount = 1;
                                                            foreach ($arrteam_list as $arr_list) { ?>
                                                         <div class="col-lg-2.5 mg-t-20 mg-lg-t-0">
                                                                    <label class="rdiobox">
                                                                <input type="radio" id="extra" name="<?php echo $rowc['form_item_id']; ?>"
                                                                       value="<?php echo $arr_list;?>"
                                                                       class=" pn_none" <?php if($checked == "extra_$radiocount"){echo 'checked'; }?>  disabled >
                                                                <span for="none"
                                                                       class="pn_none item_label <?php echo $rowc['form_item_id']; ?>"
                                                                       id="<?php echo $rowc['form_item_id']; ?>"><?php $extra_alias = $arr_list;
                                                                    echo (($extra_alias != null) || ($extra_alias != '')) ? $extra_alias : "Extra" ?></span>
                                                                    </label>
                                                               </div>
                                                                <?php  $radiocount++; }
                                                        }
                                                        ?>
                                                    <?php } ?>
                                                    <?php if ($rowc['optional'] == '1') {
                                                        echo '<span style="color: #a1a1a1; font-size: small;padding-top: 15px;padding-left:15px;">(Optional)</span>';
                                                    } ?>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-8 form_col_item"><u><b><?php echo $rowc['discription']; ?> </b></u></div>

                                        </div>
                                        <?php
                                        $aray_item_cnt++;
                                    }
                                    if($item_val == "text"){

                                        ?>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-0.5">
                                                 <?php
                                                if ($rowc['optional'] != '1') {
                                                    echo '<span class="red-star">★</span>';
                                                } ?>
                                            </div>
                                            <div class="col-md-6">

                                            <?php    echo htmlspecialchars($rowc['item_desc']); ?>
                                            </div>
                                            <div class="col-md-5 mg-t-5 mg-md-t-0">
                                                <div class="row mg-t-15">
                                                  <input type="hidden" name="form_item_array[]"
                                                       value="<?php echo $rowc['form_item_id']; ?>">

                                                      <input type="text" name="<?php echo $rowc['form_item_id']; ?>"
                                                       id="<?php echo $rowc['form_item_id']; ?>"
                                                       value="<?php echo $itemVal; ?>"
                                                       class="form-control pn_none" disabled>

                                                </div>
                                            </div>

                                                <div class="col-md-3 form_col_item">
                                                <u><b><?php echo $rowc['discription']; ?> </b></u>
                                                </div>

                                            </div>
                                        <?php
                                        $aray_item_cnt++;

                                    }
                                }
                                ?>

                                <?php
                                $qur05 = mysqli_query($db, "SELECT * FROM  form_approval where form_user_data_id = '$id' ");
                                $rowc05 = mysqli_fetch_array($qur05);
                                $app_in = $rowc05["approval_initials"];
                                $passcd = $rowc05["passcode"];
                                $datetime = $rowc05["created_at"];
                                $date_time = strtotime($datetime);

                                $approval_status = $rowc05["approval_status"];
                                $reject_status = $rowc05["reject_status"];

                                if (empty($approval_status) && empty($reject_status)){ ?>
                                <div class="col-lg-10 col-xl-10 col-md-12 col-sm-12">
                                    <div class="card box-shadow-0">
                                        <div class="card-header">
                                            <span class="main-content-title mg-b-0 mg-b-lg-1">Auto Approved by System</span>
                                        </div>
                                    </div>
                                </div>
                                <?php }else{ ?>
                                <div class="row row-xs align-items-center mg-b-20">
                                    <table class="table  table-bordered text-nowrap mb-0" id="example2">
                                        <tr class="form_tab_tr">
                                            <th class="form_tab_th">Department</th>
                                            <th class="form_tab_th">Form Status</th>
                                            <th class="form_tab_th">Approver</th>
                                            <th class="form_tab_th">Approval/Rejection Time</th>
                                        </tr>


                                        <?php
                                        $query1 = sprintf("SELECT * FROM  form_create where form_create_id = '$item_id'");
                                        $qur1 = mysqli_query($db, $query1);
                                        $i = 0;
                                        while ($rowc1 = mysqli_fetch_array($qur1)) {
                                            $approval_dept_array = $rowcmain['approval_dept'];
                                            $approval_dept = explode(',', $approval_dept_array);
                                            $approval_initials_array = $rowcmain['approval_initials'];
                                            $approval_initials = explode(',', $approval_initials_array);
                                            $passcode_array = $rowcmain['passcode'];
                                            $passcode = explode(',', $passcode_array);
                                            $approval_by_array = $rowc1['approval_by'];
                                            $arrteam = explode(',', $approval_by_array);


                                            foreach ($arrteam as $arr) {
                                                if ($arr != "") {
                                                    ?>
                                                    <tr class="form_tab_tr">
                                                        <!--								<div class="form_row_item row">-->
                                                        <?php
                                                        $qurtemp = mysqli_query($db, "SELECT group_name FROM `sg_group` where group_id = '$arr' ");
                                                        $rowctemp = mysqli_fetch_array($qurtemp);
                                                        $groupname = $rowctemp["group_name"];

                                                        $qur05 = mysqli_query($db, "SELECT * FROM  form_approval where approval_dept = '$arr' and form_user_data_id = '$id' ");
                                                        $rowc05 = mysqli_fetch_array($qur05);
                                                        $app_in = $rowc05["approval_initials"];
                                                        $passcd = $rowc05["passcode"];
                                                        $datetime = $rowc05["created_at"];
                                                        $date_time = strtotime($datetime);

                                                        $approval_status = $rowc05["approval_status"];
                                                        $reject_status = $rowc05["reject_status"];

                                                        if ($approval_status == '0' && $reject_status == '1') {
                                                            $form_status = "Rejected";
                                                        } else {
                                                            $form_status = "Approved";
                                                        }

                                                        $qur04 = mysqli_query($db, "SELECT firstname,lastname FROM  cam_users where users_id = '$app_in' ");
                                                        $rowc04 = mysqli_fetch_array($qur04);
                                                        $fullnnm = $rowc04["firstname"] . " " . $rowc04["lastname"];

                                                        ?>
                                                        <!--								</div>-->
                                                        <td class="form_tab_td">
                                                            <?php echo $groupname; ?>
                                                        </td>
                                                        <td class="form_tab_td">
                                                            <?php echo $form_status; ?>
                                                        </td>
                                                        <td class="form_tab_td">
                                                            <input type="text" name="approve_initial[]" id=""
                                                                   value="<?php echo $rowc04["firstname"] . " " . $rowc04["lastname"];; ?>"
                                                                   class="form-control pn_none">
                                                        </td>

                                                        <?php

                                                        $qur_pin = mysqli_query($db, "SELECT pin FROM  cam_users where users_id = '$id' ");
                                                        $row_pin = mysqli_fetch_assoc($qur_pin);
                                                        //  $full_pin = $row_pin["pin"];


                                                        ?>

                                                        <td class="form_tab_td">
                                                            <input type="text" name="approval_time" id="approval_time"
                                                                   value="<?php echo date('d-M-Y h:i:s', $date_time); ?>"
                                                                   class="form-control pn_none">
                                                        </td>

                                                    </tr>
                                                    <?php if ($form_status == 'Rejected') { ?>
                                                        <tr id="rej_reason_div" style="display: table-row;border: 1px solid red;">
                                                            <td class="form_tab_td" colspan="4"> Reject Reason :
                                                                <textarea class="form-control pn_none" name="rej_reason" rows="1" ><?php echo $rowc05['reject_reason']; ?>

                                                                </textarea>
                                                            </td>
                                                        </tr>
                                                    <?php } else if ($form_status == 'Approved') {
                                                        if ($rowc05['reject_reason'] != ""){?>
                                                            <tr id="rej_reason_div" style="display: table-row;border: 1px solid green;">
                                                                <td class="form_tab_td" colspan="4"> Approve Reason :
                                                                    <textarea class="form-control pn_none" name="rej_reason" rows="1"><?php echo $rowc05['reject_reason']; ?>

                                                                </textarea>
                                                                </td>
                                                            </tr>
                                                        <?php  } }
                                                    $fullnnm = "";
                                                    $passcd = "";
                                                }
                                            }
                                        }
                                        ?>


                                    </table>
                                </div>

                                    <?php
                                    $query1 = sprintf("SELECT * FROM  form_create where form_create_id = '$item_id'");
                                    $qur1 = mysqli_query($db, $query1);
                                    $i = 0;
                                    while ($rowc1 = mysqli_fetch_array($qur1)) {
                                        $approval_dept_array = $rowcmain['approval_dept'];
                                        $approval_dept = explode(',', $approval_dept_array);
                                        $approval_initials_array = $rowcmain['approval_initials'];
                                        $approval_initials = explode(',', $approval_initials_array);
                                        $passcode_array = $rowcmain['passcode'];
                                        $passcode = explode(',', $passcode_array);
                                        $approval_by_array = $rowc1['approval_by'];
                                        $arrteam = explode(',', $approval_by_array);


                                    }
                                    ?>
                                <?php  } ?>



                            </div>
                       </div>
                     </div>
                   </div>
              </form>

             <?php } ?>
    </div>
    <!-- /content area -->
</div>
<!-- /page container -->

<script>
    function submitFormSettings(url) {
        //          $(':input[type="button"]').prop('disabled', true);
        var data = $("#form_settings").serialize();
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function(data) {
                // $("#textarea").val("")
                // window.location.href = window.location.href + "?aa=Line 1";
                //                   $(':input[type="button"]').prop('disabled', false);
                //                   location.reload();
                //$(".enter-message").val("");
            }
        });
    }
    $(".compare_text").keyup(function () {
        var text_id = $(this).attr("id");
        var lower_compare = parseInt($(".lower_compare[data-id='" + text_id + "']").val());
        var upper_compare = parseInt($(".upper_compare[data-id='" + text_id + "']").val());
        var text_val = $(this).val();

        if ($(".compare_text").val().length == 0) {
            $(this).css("background-color", "white");
            return false;
        } else {
            if ($.isNumeric(text_val)) {

                if (text_val >= lower_compare && text_val <= upper_compare){
                    $(this).css("background-color", "");
                } else {
                    $(this).css("background-color", "#ffadad");
                }
            }
        }

    });
</script>
<?php include ('../footer.php') ?>
</body>
</html>