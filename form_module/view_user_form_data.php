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
        .red-star {
            color: red;
        }
        #sub_app {
            padding: 20px 40px;
            color: red;
            font-size: initial;
        }


    </style>
</head>
<!-- Main navbar -->
<?php
include("../header.php");
if ($is_tab_login || ($_SESSION["role_id"] == "pn_user")) {
    include("../tab_menu.php");
} else {
    include("../admin_menu.php");
}
?>

<body class="ltr main-body app sidebar-mini">
<!-- main-content -->
<div class="main-content app-content">
    <!-- container -->
    <!-- breadcrumb -->
    <div class="row-body row-sm">
        <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
          <div class="breadcrumb-header justify-content-between">
           <div class="left-content">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Forms</a></li>
                <li class="breadcrumb-item active" aria-current="page">Form View</li>
            </ol>
           </div>
         </div>
        </div>
    </div>
    <!-- /breadcrumb -->
    <!-- row -->
    <?php
    $id = $_GET['id'];

    $querymain = sprintf("SELECT * FROM `form_user_data` where form_user_data_id = '$id' ");
    $qurmain = mysqli_query($db, $querymain);

    while ($rowcmain = mysqli_fetch_array($qurmain)) {
    $formname = $rowcmain['form_name'];
    $form_create_id = $rowcmain['form_create_id'];

    ?>
    <form action="fs_backend.php" id="form_settings" enctype="multipart/form-data" class="form-horizontal" method="post">
        <div class="row-body row-sm">
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card  box-shadow-0">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">Form View</span>
                        </div>
                    <input type="hidden" name="name" id="name" value="<?php echo $rowcmain['form_name']; ?>">
                    <div class="card-body pt-0">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1"><?php echo $rowcmain['form_name']; ?></span>
                        </div>
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Form Type :</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <?php
                                    $get_form_type = $rowcmain['form_type'];
                                    if($get_form_type != ''){	$disabled = 'disabled';	}else{$disabled = '';}
                                    ?>

                                    <input type="hidden" name="form_type" id="form_type" value="<?php echo $get_form_type; ?>">
                                    <select name="form_type1" id="form_type" class="form-control form-select select2" data-bs-placeholder="Select Country" <?php echo $disabled; ?>>
                                        <option value="" selected disabled>--- Select Form Type ---</option>
                                        <?php

                                        $sql1 = "SELECT * FROM `form_type` ";
                                        $result1 = $mysqli->query($sql1);
                                        // $entry = 'selected';
                                        while ($row1 = $result1->fetch_assoc()) {
                                            if($get_form_type == $row1['form_type_id'])
                                            {
                                                $entry = 'selected';
                                            }
                                            else
                                            {
                                                $entry = '';
                                            }
                                            echo "<option value='" . $row1['form_type_id'] . "'  $entry>" . $row1['form_type_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                    </select>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Form Station :</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <?php
                                    $get_station = $rowcmain['station'];
                                    if($get_station != ''){	$disabled = 'disabled';	}else{$disabled = '';}
                                    ?>

                                    <input type="hidden" name="station" id="station" value="<?php echo $get_station; ?>">
                                    <select name="station" id="station" class="form-control form-select select2" data-bs-placeholder="Select Country" <?php echo $disabled; ?>>
                                        <option value="" selected disabled>--- Select Station ---</option>
                                        <?php
                                        $sql1 = "SELECT * FROM `cam_line` where enabled = '1' ORDER BY `line_name` ASC ";
                                        $result1 = $mysqli->query($sql1);
                                        //                                            $entry = 'selected';
                                        while ($row1 = $result1->fetch_assoc()) {
                                            if($get_station == $row1['line_id'])
                                            {
                                                $entry = 'selected';
                                            }
                                            else
                                            {
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
                                    <label class="form-label mg-b-0">Part Family :</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <?php
                                    $get_part_family = $rowcmain['part_family'];
                                    if($get_part_family != ''){	$disabled = 'disabled';	}else{$disabled = '';}
                                    ?>

                                    <input type="hidden" name="part_family" id="part_family" value="<?php echo $get_part_family; ?>">
                                    <select name="part_family1" id="part_family1" class="form-control form-select select2" data-bs-placeholder="Select Country" <?php echo $disabled; ?>>
                                        <option value="" selected disabled>--- Select Part Family ---</option>
                                        <?php
                                        $sql1 = "SELECT * FROM `pm_part_family` ";
                                        $result1 = $mysqli->query($sql1);
                                        //                                            $entry = 'selected';
                                        while ($row1 = $result1->fetch_assoc()) {
                                            if($get_part_family == $row1['pm_part_family_id'])
                                            {
                                                $entry = 'selected';
                                            }
                                            else
                                            {
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
                                    <label class="form-label mg-b-0">Part Number :</label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <?php
                                    $get_part_number = $rowcmain['part_number'];
                                    if($get_part_number != ''){	$disabled = 'disabled';	}else{$disabled = '';}
                                    ?>

                                    <input type="hidden" name="part_number" id="part_number" value="<?php echo $get_part_number; ?>">
                                    <select name="part_number1" id="part_number1" class="form-control form-select select2" data-bs-placeholder="Select Country" <?php echo $disabled; ?>>
                                        <option value="" selected disabled>--- Select Part Number ---</option>
                                        <?php
                                        $sql1 = "SELECT * FROM `pm_part_number` ";
                                        $result1 = $mysqli->query($sql1);
                                        //                                            $entry = 'selected';
                                        while ($row1 = $result1->fetch_assoc()) {
                                            if($get_part_number == $row1['pm_part_number_id'])
                                            {
                                                $entry = 'selected';
                                            }
                                            else
                                            {
                                                $entry = '';
                                            }
                                            echo "<option value='" . $row1['pm_part_number_id'] . "' $entry >" . $row1['part_number'] ." - ".$row1['part_name']  . "</option>";
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
                                    $qur04 = mysqli_query($db, "SELECT firstname,lastname,pin FROM  cam_users where users_id = '$createdby' ");
                                    $rowc04 = mysqli_fetch_array($qur04);
                                    $fullnnm = $rowc04["firstname"]." ".$rowc04["lastname"];
                                    $pin = $rowc04["pin"];

                                    ?>

                                    <input type="text" name="createdby" class="form-control" id="createdby" value="<?php echo $fullnnm; ?>" disabled>
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
                                <span class="main-content-title mg-b-0 mg-b-lg-1">Form Information</span>
                            </div>
                            <br/>
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
                                    <span class="main-content-title mg-b-0 mg-b-lg-1"><?php echo htmlspecialchars($rowc['item_desc']); ?></span>
                                    </br>
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
                                        <div class="col-md-7" >
                                            <label class="form-label mg-b-0"><?php  if ($rowc['optional'] != '1') {
                                                    echo '<span class="red-star">★</span>';
                                                }echo $rowc['item_desc']; ?> </label>
                                            <?php if (isset($rowc['discription']) && ($rowc['discription'] != '')) { ?>
                                                <?php echo "(" . $rowc['discription'] . ")" ?>
                                            <?php } ?>
                                        </div>

                                        <?php if ($checked >= $final_lower && $checked <= $final_upper) { ?>
                                            <div class="col-md-3 mg-t-5 mg-md-t-0">
                                                <input type="number" name="<?php echo $rowc['form_item_id']; ?>"
                                                       id="<?php echo $rowc['form_item_id']; ?>"
                                                       class="form-control compare_text pn_none" required step="any"
                                                       value="<?php echo $itemVal; ?>"  disabled>
                                            </div>
                                        <?php } else { ?>
                                            <div class="col-md-2 mg-t-5 mg-md-t-0">
                                                <input type="number" name="<?php echo $rowc['form_item_id']; ?>"
                                                       id="<?php echo $rowc['form_item_id']; ?>"
                                                       class="form-control compare_text pn_none" required step="any"
                                                       value="<?php echo $itemVal; ?>"  style="background-color: #ffadad" disabled>
                                            </div>
                                        <?php } ?>


                                        <?php
                                        $unit_of_measurement_id = $rowc['unit_of_measurement'];
                                        $sql1 = "SELECT unit_of_measurement FROM `form_measurement_unit` where form_measurement_unit_id = '$unit_of_measurement_id'";
                                        $result1 = $mysqli->query($sql1);
                                        $row1 = $result1->fetch_assoc();
                                        echo $row1['unit_of_measurement'];
                                        ?>
                                        <input type="hidden" class="form-control"  name="form_item_array[]" value="<?php echo $rowc['form_item_id']; ?>">
                                    </div><br/>
                                    <?php
                                    $aray_item_cnt++;
                                }
                                if($item_val == "binary"){
                                    $checked = $itemVal;
                                    ?>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-7">
                                            <?php if ($rowc['optional'] != '1') {
                                                echo '<span class="red-star">★</span>';
                                            }
                                            echo htmlspecialchars($rowc['item_desc']); ?>
                                        </div>

                                        <input type="hidden" class="form-control"  name="form_item_array[]" value="<?php echo $rowc['form_item_id']; ?>">
                                        <div class="col-md-5 mg-t-5 mg-md-t-0">
                                            <div class="form-check form-check-inline">

                                                <?php
                                                if ($checked == "yes") {
                                                    ?>

                                                    <input type="radio" id="yes" name="<?php echo $rowc['form_item_id']; ?>"
                                                           value="<?php echo $rowc['binary_yes_alias']; ?>"
                                                           class="form-check-input pn_none" checked disabled >
                                                    <label for="yes"
                                                           class="form-label mg-b-0 <?php echo $rowc['form_item_id']; ?>"
                                                           id="<?php echo $rowc['form_item_id']; ?>"><?php $yes_alias = $rowc['binary_yes_alias'];
                                                        echo (($yes_alias != null) || ($yes_alias != '')) ? $yes_alias : "Yes" ?></label>
                                                    <!--															<label for="yes" class="item_label" style="background-color: green;">--><?php //echo $rowc['binary_yes_alias'];
                                                    ?><!--</label>-->
                                                    <input type="radio" id="no" name="<?php echo $rowc['form_item_id']; ?>"
                                                           value="<?php echo $rowc['binary_no_alias']; ?>"
                                                           class="form-check-input pn_none" disabled >
                                                    <label for="no"
                                                           class="form-label mg-b-0 <?php echo $rowc['form_item_id']; ?>"
                                                           id="<?php echo $rowc['form_item_id']; ?>"><?php $no_alias = $rowc['binary_no_alias'];
                                                        echo (($no_alias != null) || ($no_alias != '')) ? $no_alias : "No" ?></label>
                                                    <!--															<label for="no" class="item_label"  style="background-color: green;">--><?php //echo $rowc['binary_no_alias'];
                                                    ?><!--</label>-->


                                                    <?php
                                                } else { ?>

                                                    <input type="radio" id="yes" name="<?php echo $rowc['form_item_id']; ?>"
                                                           value="<?php echo $rowc['binary_yes_alias']; ?>"
                                                           class="form-check-input pn_none" disabled >
                                                    <label for="yes" class="form-label mg-b-0" style="background-color: #ffadad;"
                                                           style="background-color: #ffadad;"><?php echo $rowc['binary_yes_alias']; ?></label>
                                                    <input type="radio" id="no" name="<?php echo $rowc['form_item_id']; ?>"
                                                           value="<?php echo $rowc['binary_no_alias']; ?>"
                                                           class="form-check-input pn_none" checked disabled >
                                                    <label for="no" class="form-label mg-b-0" style="background-color: #ffadad;"
                                                           style="background-color: #ffadad;"><?php echo $rowc['binary_no_alias']; ?></label>

                                                <?php }
                                                ?>
                                                <?php if ($rowc['optional'] == '1') {
                                                    echo '<span style="color: #a1a1a1; font-size: small;padding-top: 15px;padding-left:15px;">(Optional)</span>';
                                                } ?>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="card-title mb-1"><?php echo $rowc['discription']; ?></div>
                                    </div>
                                    <?php
                                    $aray_item_cnt++;

                                }
                                if($item_val == "list"){
                                    $checked = $itemVal;
                                    ?>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-7">
                                            <?php if ($rowc['optional'] != '1') {
                                                echo '<span class="red-star">★</span>';
                                            }
                                            echo htmlspecialchars($rowc['item_desc']); ?>
                                        </div>

                                        <input type="hidden" class="form-control"  name="form_item_array[]" value="<?php echo $rowc['form_item_id']; ?>">
                                        <div class="col-md-5 mg-t-5 mg-md-t-0">
                                            <div class="form-check form-check-inline">

                                                <?php
                                                if (($checked == "yes") ) {
                                                    ?>

                                                    <input type="radio" id="yes" name="<?php echo $rowc['form_item_id']; ?>"
                                                           value="<?php echo $rowc['list_name2']; ?>"
                                                           class="form-check-input pn_none" checked disabled >
                                                    <label for="yes"
                                                           class="form-label mg-b-0 <?php echo $rowc['form_item_id']; ?>"
                                                           id="<?php echo $rowc['form_item_id']; ?>"><?php $yes_alias = $rowc['list_name2'];
                                                        echo (($yes_alias != null) || ($yes_alias != '')) ? $yes_alias : "Yes" ?></label>

                                                    <input type="radio" id="no" name="<?php echo $rowc['form_item_id']; ?>"
                                                           value="<?php echo $rowc['list_name3']; ?>"
                                                           class="form-check-input pn_none" disabled >
                                                    <label for="no"
                                                           class="form-label mg-b-0 <?php echo $rowc['form_item_id']; ?>"
                                                           id="<?php echo $rowc['form_item_id']; ?>"><?php $no_alias = $rowc['list_name3'];
                                                        echo (($no_alias != null) || ($no_alias != '')) ? $no_alias : "No" ?></label>

                                                    <?php if (empty($rowc['list_name1'])){ ?>
                                                        <input type="radio" id="none" name="<?php echo $rowc['form_item_id']; ?>"
                                                               value="<?php echo $rowc['list_name1']; ?>"
                                                               class="form-check-input pn_none" disabled style="display: none">
                                                        <label for="none"
                                                               class="form-label mg-b-0 <?php echo $rowc['form_item_id']; ?>"
                                                               id="<?php echo $rowc['form_item_id']; ?>" ></label>
                                                    <?php } else { ?>
                                                        <input type="radio" id="none" name="<?php echo $rowc['form_item_id']; ?>"
                                                               value="<?php echo $rowc['list_name1']; ?>"
                                                               class="form-check-input pn_none" disabled >
                                                        <label for="none"
                                                               class="form-label mg-b-0 <?php echo $rowc['form_item_id']; ?>"
                                                               id="<?php echo $rowc['form_item_id']; ?>"><?php $yes_alias = $rowc['list_name1'];
                                                            echo (($yes_alias != null) || ($yes_alias != '')) ? $yes_alias : "None" ?></label>
                                                    <?php } ?>
                                                    <?php $list_extra =  $rowc['list_name_extra'];
                                                    if(!empty($list_extra)){
                                                        $arrteam_list = explode(',', $list_extra);
                                                        $radiocount = 1;
                                                        foreach ($arrteam_list as $arr_list) { ?>

                                                            <input type="radio" id="extra" name="<?php echo $rowc['form_item_id']; ?>"
                                                                   value="<?php echo $arr_list; ?>"
                                                                   class="form-check-input pn_none" disabled >
                                                            <label for="none"
                                                                   class="form-label mg-b-0 <?php echo $rowc['form_item_id']; ?>"
                                                                   id="<?php echo $rowc['form_item_id']; ?>"><?php $extra_alias = $arr_list;
                                                                echo (($extra_alias != null) || ($extra_alias != '')) ? $extra_alias : "Extra" ?></label>
                                                            <?php  $radiocount++; }
                                                    }
                                                    ?>

                                                    <?php
                                                }  else if (($checked == "no") ) { ?>

                                                    <input type="radio" id="yes" name="<?php echo $rowc['form_item_id']; ?>"
                                                           value="<?php echo $rowc['list_name2']; ?>"
                                                           class="form-check-input pn_none" disabled >
                                                    <label for="yes" class="form-label mg-b-0"
                                                        <?php if($rowc['list_enabled'] ==1 ){ echo 'style="background-color: #ffadad;"';}else{echo 'style="background-color: #fff;"';}?>><?php echo $rowc['list_name2']; ?></label>

                                                    <input type="radio" id="no" name="<?php echo $rowc['form_item_id']; ?>"
                                                           value="<?php echo $rowc['list_name3']; ?>"
                                                           class="form-check-input pn_none" checked disabled >
                                                    <label for="no" class="form-label mg-b-0" <?php if($rowc['list_enabled'] ==1 ){ echo 'style="background-color: #ffadad;"';}else{echo 'style="background-color: #fff;"';}?>><?php echo $rowc['list_name3']; ?></label>

                                                    <?php if (empty($rowc['list_name1'])){ ?>
                                                        <input type="radio" id="none" name="<?php echo $rowc['form_item_id']; ?>"
                                                               value="<?php echo $rowc['list_name1']; ?>"
                                                               class="form-check-input pn_none" disabled style="display: none">
                                                        <label for="none"
                                                               class="form-label mg-b-0 <?php echo $rowc['form_item_id']; ?>"
                                                               id="<?php echo $rowc['form_item_id']; ?>" <?php if($rowc['list_enabled'] ==1 ){ echo 'style="background-color: #ffadad;"';}else{echo 'style="background-color: #fff;"';}?>></label>
                                                    <?php } else { ?>
                                                        <input type="radio" id="none" name="<?php echo $rowc['form_item_id']; ?>"
                                                               value="<?php echo $rowc['list_name1']; ?>"
                                                               class="form-check-input pn_none" disabled >
                                                        <label for="none"
                                                               class="form-label mg-b-0 <?php echo $rowc['form_item_id']; ?>"
                                                               id="<?php echo $rowc['form_item_id']; ?>" <?php if($rowc['list_enabled'] ==1 ){ echo 'style="background-color: #ffadad;"';}else{echo 'style="background-color: #fff;"';}?>><?php $yes_alias = $rowc['list_name1'];
                                                            echo (($yes_alias != null) || ($yes_alias != '')) ? $yes_alias : "None" ?></label>
                                                    <?php } ?>
                                                    <?php $list_extra =  $rowc['list_name_extra'];
                                                    if(!empty($list_extra)){
                                                        $arrteam_list = explode(',', $list_extra);
                                                        $radiocount = 1;
                                                        foreach ($arrteam_list as $arr_list) { ?>

                                                            <input type="radio" id="extra" name="<?php echo $rowc['form_item_id']; ?>"
                                                                   value="<?php echo $arr_list; ?>"
                                                                   class="form-check-input pn_none" disabled>
                                                            <label for="none"
                                                                   class="form-label mg-b-0 <?php echo $rowc['form_item_id']; ?>"
                                                                   id="<?php echo $rowc['form_item_id']; ?>" <?php if($rowc['list_enabled'] ==1 ){ echo 'style="background-color: #ffadad;"';}else{echo 'style="background-color: #fff;"';}?>><?php $extra_alias = $arr_list;
                                                                echo (($extra_alias != null) || ($extra_alias != '')) ? $extra_alias : "Extra" ?></label>
                                                            <?php  $radiocount++; }
                                                    }
                                                    ?>

                                                <?php }  else if (($checked == "none") ){ ?>

                                                    <input type="radio" id="yes" name="<?php echo $rowc['form_item_id']; ?>"
                                                           value="<?php echo $rowc['list_name2']; ?>"
                                                           class="form-check-input pn_none" disabled >
                                                    <label for="yes" class="form-label mg-b-0"><?php echo $rowc['list_name2']; ?></label>
                                                    <input type="radio" id="no" name="<?php echo $rowc['form_item_id']; ?>"
                                                           value="<?php echo $rowc['list_name3']; ?>"
                                                           class="form-check-input pn_none"  disabled >
                                                    <label for="no" class="form-label mg-b-0"><?php echo $rowc['list_name3']; ?></label>

                                                    <input type="radio" id="none" name="<?php echo $rowc['form_item_id']; ?>"
                                                           value="<?php echo $rowc['list_name1']; ?>"
                                                           class="form-check-input pn_none" checked disabled >
                                                    <label for="none" class="form-label mg-b-0"><?php echo $rowc['list_name1']; ?></label>

                                                    <?php if (empty($rowc['list_name1'])){ ?>
                                                        <input type="radio" id="none" name="<?php echo $rowc['form_item_id']; ?>"
                                                               value="<?php echo $rowc['list_name1']; ?>"
                                                               class="form-check-input pn_none" disabled style="display: none">
                                                        <label for="none"
                                                               class="form-label mg-b-0 <?php echo $rowc['form_item_id']; ?>"
                                                               id="<?php echo $rowc['form_item_id']; ?>" ></label>
                                                    <?php } else { ?>
                                                        <input type="radio" id="none" name="<?php echo $rowc['form_item_id']; ?>"
                                                               value="<?php echo $rowc['list_name1']; ?>"
                                                               class="form-check-input pn_none" disabled >
                                                        <label for="none"
                                                               class="form-label mg-b-0 <?php echo $rowc['form_item_id']; ?>"
                                                               id="<?php echo $rowc['form_item_id']; ?>"><?php $yes_alias = $rowc['list_name1'];
                                                            echo (($yes_alias != null) || ($yes_alias != '')) ? $yes_alias : "None" ?></label>
                                                    <?php } ?>

                                                    <?php $list_extra =  $rowc['list_name_extra'];
                                                    if(!empty($list_extra)){
                                                        $arrteam_list = explode(',', $list_extra);
                                                        $radiocount = 1;
                                                        foreach ($arrteam_list as $arr_list) { ?>

                                                            <input type="radio" id="extra" name="<?php echo $rowc['form_item_id']; ?>"
                                                                   value="extra_<?php echo $radiocount; ?>"
                                                                   class="form-check-input pn_none" disabled >
                                                            <label for="none"
                                                                   class="form-label mg-b-0 <?php echo $rowc['form_item_id']; ?>"
                                                                   id="<?php echo $rowc['form_item_id']; ?>" <?php if($rowc['list_enabled'] == 1 ){ echo 'style="background-color: #ffadad;"';}else{echo 'style="background-color: #fff;"';}?>><?php $extra_alias = $arr_list;
                                                                echo (($extra_alias != null) || ($extra_alias != '')) ? $extra_alias : "Extra" ?></label>
                                                            <?php  $radiocount++; }
                                                    }
                                                    ?>

                                                <?php } else { ?>

                                                    <input type="radio" id="yes" name="<?php echo $rowc['form_item_id']; ?>"
                                                           value="<?php echo $rowc['list_name2']; ?>"
                                                           class="form-check-input pn_none" disabled >>
                                                    <label for="yes" class="form-label mg-b-0"
                                                        <?php if($rowc['list_enabled'] ==1  ){ echo 'style="background-color: #ffadad;"';}else{echo 'style="background-color: #fff!important;"';}?>><?php echo $rowc['list_name2']; ?></label>
                                                    <input type="radio" id="no" name="<?php echo $rowc['form_item_id']; ?>"
                                                           value="<?php echo $rowc['list_name3']; ?>"
                                                           class="form-check-input pn_none"  disabled >
                                                    <label for="no" class="form-label mg-b-0"
                                                        <?php if($rowc['list_enabled'] ==1  ){ echo 'style="background-color: #ffadad;"';}else{echo 'style="background-color: #fff!important;"';}?>><?php echo $rowc['list_name3']; ?></label>

                                                    <?php if (empty($rowc['list_name1'])){ ?>
                                                        <input type="radio" id="none" name="<?php echo $rowc['form_item_id']; ?>"
                                                               value="<?php echo $rowc['list_name1']; ?>"
                                                               class="form-check-input pn_none" disabled style="display: none">
                                                        <label for="none"
                                                               class="form-label mg-b-0 <?php echo $rowc['form_item_id']; ?>"
                                                               id="<?php echo $rowc['form_item_id']; ?>" ></label>
                                                    <?php } else { ?>
                                                        <input type="radio" id="none" name="<?php echo $rowc['form_item_id']; ?>"
                                                               value="<?php echo $rowc['list_name1']; ?>"
                                                               class="form-check-input pn_none" disabled >
                                                        <label for="none"
                                                               class="form-label mg-b-0 <?php echo $rowc['form_item_id']; ?>"
                                                               id="<?php echo $rowc['form_item_id']; ?>"><?php $yes_alias = $rowc['list_name1'];
                                                            echo (($yes_alias != null) || ($yes_alias != '')) ? $yes_alias : "None" ?></label>
                                                    <?php } ?>
                                                    <?php $list_extra =  $rowc['list_name_extra'];
                                                    if(!empty($list_extra)){
                                                        $arrteam_list = explode(',', $list_extra);
                                                        $radiocount = 1;
                                                        foreach ($arrteam_list as $arr_list) { ?>

                                                            <input type="radio" id="extra" name="<?php echo $rowc['form_item_id']; ?>"
                                                                   value="<?php echo $arr_list;?>"
                                                                   class="form-check-input pn_none" <?php if($checked == "extra_$radiocount"){echo 'checked'; }?>  disabled >
                                                            <label for="none"
                                                                   class="form-label mg-b-0 <?php echo $rowc['form_item_id']; ?>"
                                                                   id="<?php echo $rowc['form_item_id']; ?>"><?php $extra_alias = $arr_list;
                                                                echo (($extra_alias != null) || ($extra_alias != '')) ? $extra_alias : "Extra" ?></label>
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
                                        <div class="col-md-8 mg-t-5 mg-md-t-0"><u><b><?php echo $rowc['discription']; ?> </b></u></div>
                                    </div>
                                    <?php
                                    $aray_item_cnt++;
                                }
                                if($item_val == "text"){

                                    ?>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-7">
                                            <?php
                                            if ($rowc['optional'] != '1') {
                                                echo '<span class="red-star">★</span>';
                                            }
                                            echo htmlspecialchars($rowc['item_desc']); ?> </div>
                                        <div class="col-md-5 mg-t-5 mg-md-t-0">
                                            <input type="hidden" class="form-control" name="form_item_array[]"
                                                   value="<?php echo $rowc['form_item_id']; ?>">
                                            <input type="text" class="form-control" name="<?php echo $rowc['form_item_id']; ?>"
                                                   id="<?php echo $rowc['form_item_id']; ?>"
                                                   value="<?php echo $itemVal; ?>"
                                                   disabled></div>
                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-8 mg-t-5 mg-md-t-0"><u><b><?php echo $rowc['discription']; ?> </b></u></div>
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
                                <div class="card-header">
                                    <span class="main-content-title mg-b-0 mg-b-lg-1">Auto Approved by System</span>
                                </div>
                            <?php }else{ ?>
                                <div class="card-header">
                                    <span class="main-content-title mg-b-0 mg-b-lg-1">Approval List</span>
                                </div>
                                <br/>
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
                                            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                                            <div class="table-responsive">
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
                                                <div class="row row-xs align-items-center mg-b-20">
                                                    <div class="col-md-2">
                                                    <label class="form-label mg-b-0">Department</label>
                                                    </div>
                                                    <div class="col-md-4 mg-t-5 mg-md-t-0">   <?php echo $groupname; ?></div>
                                                    <div class="col-md-2">
                                                        <label class="form-label mg-b-0">Form Status</label>
                                                    </div>
                                                    <div class="col-md-4 mg-t-5 mg-md-t-0">     <?php echo $form_status; ?></div>
                                                </div>
                                                <div class="row row-xs align-items-center mg-b-20">
                                                    <div class="col-md-2">
                                                    <label class="form-label mg-b-0">Approver</label>
                                                    </div>
                                                    <div class="col-md-4 mg-t-5 mg-md-t-0">
                                                        <input type="text" name="approve_initial[]" id=""
                                                               value="<?php echo $rowc04["firstname"] . " " . $rowc04["lastname"]; ?>"
                                                               class="form-control pn_none"></div>
                                                    <?php

                                                    $qur_pin = mysqli_query($db, "SELECT pin FROM  cam_users where users_id = '$id' ");
                                                    $row_pin = mysqli_fetch_assoc($qur_pin);
                                                    ?>
                                                    <div class="col-md-2">
                                                        <label class="form-label mg-b-0">Time</label>
                                                    </div>
                                                    <div class="col-md-4 mg-t-5 mg-md-t-0">
                                                        <input type="text" name="approval_time" id="approval_time"
                                                               value="<?php echo date('d-M-Y h:i:s', $date_time); ?>"
                                                               class="form-control pn_none">
                                                    </div>
                                                </div>
                                                <?php if ($form_status == 'Rejected') { ?>
                                                    <div id="rej_reason_div" style="border: 1px solid red;padding: 10px;">
                                                        <td class="form_tab_td pn_none" colspan="4">Reject Reason : <textarea
                                                                    placeholder="<?php echo $rowc05['reject_reason']; ?>"
                                                                    style="color: #333333 !important;width: 100%;height: auto; border: none;padding: 14px;" name="rej_reason" rows="1"></textarea>
                                                        </td>
                                                    </div>
                                                <?php }  else if ($form_status == 'Approved') { ?>
                                                    <div id="rej_reason_div" style="border: 1px solid green;padding: 10px;">
                                                        <td class="form_tab_td pn_none" colspan="4">Approve Reason : <textarea
                                                                    placeholder="<?php echo $rowc05['reject_reason']; ?>"
                                                                    style="color: #333333 !important;width: 100%;height: auto; border: none;padding: 14px;" name="rej_reason" rows="1"></textarea>
                                                        </td>
                                                    </div>
                                                <?php  } ?>
                                            </div>
                                        </div>
                                            <?php     $fullnnm = "";
                                            $passcd = "";
                                        }
                                    }
                                }
                                ?>
                            <?php  } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
    </form>
</div>

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