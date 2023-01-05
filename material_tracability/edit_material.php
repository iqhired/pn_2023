<?php
include("../config.php");
include("../config/pn_config.php");
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
if ($i != "super" && $i != "admin" && $i != "pn_user" ) {
    header('location: ../dashboard.php');
}
$s_event_id = $_GET['station_event_id'];



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo $sitename; ?> |Edit Material traceability</title>
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


    <script type="text/javascript" src="../assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/forms/selects/bootstrap_select.min.js"></script>
    <script type="text/javascript" src="../assets/js/pages/form_bootstrap_select.js"></script>
    <script type="text/javascript" src="../assets/js/pages/form_layouts.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/ui/ripple.min.js"></script>
    <link href="<?php echo $siteURL; ?>assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">x
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
        .breadcrumb-header {
            margin-left: 0;
        }
        .rdiobox span {
            padding-left: 27px;
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
        #preview {
            padding-top: 20px;
        }

    </style>
</head>

<!-- Main navbar -->
<?php
$cust_cam_page_header = "Material Traceabilty";
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
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);"></a>Edit</li>
                <li class="breadcrumb-item active" aria-current="page">Material Traceabilty</li>
            </ol>

        </div>

    </div>
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
    <form action="edit_material_backend.php" id="material_setting" enctype="multipart/form-data" class="form-horizontal" method="post">
        <div class="row row-sm">
            <div class="col-lg-10 col-xl-10 col-md-12 col-sm-12">
                <div class="card  box-shadow-0">
                    <div class="card-header">
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Material Traceability</span>
                    </div>
                    <div class="card-body pt-0">
                        <?php
                        $st = $_REQUEST['station'];

                        $sql1 = "SELECT * FROM `cam_line` where line_id = '$st'";
                        $result1 = $mysqli->query($sql1);
                        //                                            $entry = 'selected';
                        //    while ($row1 = $result1->fetch_assoc()) {
                        //        $line_name = $row1['line_name'];
                        //    }
                        ?>
                        <div class="pd-30 pd-sm-20">
                            <?php


                            $id = $_GET['id'];

                            $querymain = sprintf("SELECT * FROM `material_tracability` where material_id = '$id' ");
                            $qurmain = mysqli_query($db, $querymain);
                            while ($rowcmain = mysqli_fetch_array($qurmain)) {
                            $line_no = $rowcmain['line_no'];
                            $station_event_id = $rowcmain['station_event_id'];
                            $material_id = $rowcmain['material_id'];
                            $part_number = $rowcmain['part_no'];
                            $part_family= $rowcmain['part_family_id'];
                            $pm_part_name= $rowcmain['part_name'];
                            $material_type= $rowcmain['material_type'];
                            $material_status= $rowcmain['material_status'];
                            $fail_reason= $rowcmain['fail_reason'];
                            $reason_desc= $rowcmain['reason_desc'];
                            $quantity= $rowcmain['quantity'];
                            $notes= $rowcmain['notes'];
                            $created_at= $rowcmain['created_at'];

                            $sqlfamily = "SELECT * FROM `pm_part_family` where `pm_part_family_id` = '$part_family'";
                            $resultfamily = mysqli_query($db,$sqlfamily);
                            $rowcfamily = mysqli_fetch_array($resultfamily);
                            $pm_part_family_name = $rowcfamily['part_family_name'];

                            $sqlnumber = "SELECT * FROM `pm_part_number` where `pm_part_number_id` = '$part_number'";
                            $resultnumber = mysqli_query($db,$sqlnumber);
                            $rowcnumber = mysqli_fetch_array($resultnumber);
                            $pm_part_number = $rowcnumber['part_number'];
                            $pm_part_name = $rowcnumber['part_name'];

                            $sqlnumber = "SELECT * FROM `cam_line` where `line_id` = '$line_no'";
                            $resultnumber = mysqli_query($db,$sqlnumber);
                            $rowcnumber = mysqli_fetch_array($resultnumber);
                            $line_name = $rowcnumber['line_name'];
                            ?>
                            <?php if ($temp == "one") { ?>
                                <br/>
                                <div class="alert alert-success no-border">
                                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button> <span class="text-semibold">Group</span> Created Successfully. </div>
                            <?php } ?>
                            <?php if ($temp == "two") { ?>
                                <br/>
                                <div class="alert alert-success no-border">
                                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button> <span class="text-semibold">Group</span> Updated Successfully. </div>
                            <?php } ?>
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
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Station : </label>
                                </div>
                                <div class="col-md-10 mg-t-5 mg-md-t-0">
                                    <input type="hidden" name="material_id" id="material_id" value="<?php echo $material_id ?>">
                                    <input type="hidden" name="station_event_id" value="<?php echo $station_event_id ?>">
                                    <input type="hidden" name="customer_account_id" value="<?php echo $account_id ?>">
                                    <input type="hidden" name="line_number" id="line_number" value="<?php echo $line_no; ?>">
                                    <input type="text" name="line_number1" id="line_number1"  value="<?php echo $line_name ?>" class="form-control" placeholder="Enter Line Number">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Part Number : </label>
                                </div>
                                <div class="col-md-10 mg-t-5 mg-md-t-0">
                                    <input type="hidden" name="part_number" id="part_number"  value="<?php echo $part_number; ?>">
                                    <input type="text" name="part_number1" id="part_number1"  value="<?php echo $pm_part_number; ?>" class="form-control" placeholder="Enter Part Number">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Part Family : </label>
                                </div>
                                <div class="col-md-10 mg-t-5 mg-md-t-0">
                                    <input type="hidden" name="part_family" id="part_family"  value="<?php echo $part_family; ?>">
                                    <input type="text" name="part_family1" id="part_family1"  value="<?php echo $pm_part_family_name; ?>" class="form-control" placeholder="Enter Part Family">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Part Name : </label>
                                </div>
                                <div class="col-md-10 mg-t-5 mg-md-t-0">
                                    <input type="text" name="part_name" id="part_name"  value="<?php echo $pm_part_name; ?>" class="form-control" placeholder="Enter Part Name">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Material Type : </label>
                                </div>
                                <div class="col-md-10 mg-t-5 mg-md-t-0">
                                    <select name="material_type" id="material_type" class="form-control form-select select2"  data-bs-placeholder="Select Station">
                                        <option value="" selected disabled>--- Select material Type ---</option>
                                        <?php
                                        $m_type = $rowcmain['material_type'];
                                        $sql1 = "SELECT material_id, material_type FROM `material_config` where material_id = '$m_type'";
                                        $result1 = mysqli_query($db, $sql1);
                                        while ($row1 = $result1->fetch_assoc()) {
                                            if($m_type == $row1['material_id']){
                                                $entry = 'selected';
                                            }else{
                                                $entry = '';
                                            }

                                            echo "<option value='" . $row1['material_id'] . "' $entry>" . $row1['material_type'] . "</option>";

                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Image : </label>
                                </div>
                                <div class="col-md-10 mg-t-5 mg-md-t-0">
                                    <input type="file" name="edit_image[]" id="file-input" class="form-control" onchange="preview_image();" multiple="multiple">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Previous Image : </label>
                                </div>
                                <div class="col-md-10 mg-t-5 mg-md-t-0">

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="text-wrap pb-3">
                                                        <?php
                                                        $query1 = sprintf("SELECT material_id FROM  material_tracability where material_id = '$id'");
                                                        $qur1 = mysqli_query($db, $query1);
                                                        $rowc1 = mysqli_fetch_array($qur1);
                                                        $item_id = $rowc1['material_id'];

                                                        $query2 = sprintf("SELECT * FROM  material_images where material_id = '$item_id'");

                                                        $qurimage = mysqli_query($db, $query2);
                                                        $i =0 ;
                                                        while ($rowcimage = mysqli_fetch_array($qurimage)) {
                                                            $image = $rowcimage['image_name'];
                                                            $d_tag = "delete_image_" . $i;
                                                            $r_tag = "remove_image_" . $i;
                                                            ?>
                                                        <div class="file-image-1">
                                                            <div class="product-image">
                                                    <img src="../assets/images/mt/<?php echo $image; ?>"
                                                         alt="">
                                                            </div>
                                                    <input type="hidden"  id="<?php echo $d_tag; ?>" name="<?php echo $d_tag; ?>" class="<?php echo $d_tag; ?>>" value="<?php echo $rowcimage['material_images_id']; ?>">
                                                    <span style="font-size: smaller;" class="remove remove_image" id="<?php echo $r_tag; ?>">Remove Image </span>

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
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Serial Number : </label>
                                </div>
                                <div class="col-md-10 mg-t-5 mg-md-t-0">
                                    <input type="number" name="serial_number" id="serial_number"  value="<?php echo $rowcmain['serial_number'];?>" class="form-control" placeholder="Enter Serial Number" required>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Material Status : </label>
                                </div>
                                <div class="col-md-10 mg-t-5 mg-md-t-0">
                                    <div class="row mg-t-15">
                                        <div class="col-lg-3">
                                            <label for="pass" class="rdiobox"> <input type="radio" id="pass" name="material_status" value="1" class="form-check-input" <?php if($rowcmain['material_status'] == "1"){ echo 'checked'; } ?> required> <span>Pass</span></label>
                                        </div>
                                        <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                                            <label for="fail" class="rdiobox"> <input type="radio" id="fail" name="material_status" value="0" class="form-check-input reject"  <?php if($rowcmain['material_status'] == "0"){ echo 'checked'; } ?> required> <span>Fail</span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php if($rowcmain['material_status'] == "0"){?>
                                <div class="row row-xs align-items-center mg-b-20" id="material_statusfail">
                                    <div class="col-md-2">
                                        <label class="form-label mg-b-0">Reason : </label>
                                    </div>
                                    <div class="col-md-10 mg-t-5 mg-md-t-0">
                                        <?php if(($rowcmain['fail_reason'] == 'onhold') || ($rowcmain['fail_reason'] == 'Hold')){ ?>
                                            <select name="reason" id="reason" class="form-control form-select select2"  data-bs-placeholder="Select Station">
                                                <!--                                                <option value="" selected disabled>--- Select Reason ---</option>-->
                                                <option value="onhold" selected>On Hold</option>
                                                <option value="rejected" >Rejected</option>

                                            </select>
                                        <?php }else if(($rowcmain['fail_reason'] == 'rejected') || ($rowcmain['fail_reason'] == 'Reject')){?>
                                            <select name="reason" id="reason" class="form-control form-select select2"  data-bs-placeholder="Select Station">
                                                <!--                                                <option value="" selected disabled>--- Select Reason ---</option>-->
                                                <option value="onhold" >On Hold</option>
                                                <option value="rejected" selected >Rejected</option>

                                            </select>
                                        <?php }?>
                                    </div>
                                </div>
                                <div class="row row-xs align-items-center mg-b-20" id="quantityfail">
                                    <div class="col-md-2">
                                        <label class="form-label mg-b-0">Quantity: </label>
                                    </div>
                                    <div class="col-md-10 mg-t-5 mg-md-t-0">
                                        <input type="text" class="form-control" name="quantity" rows="1" id="quantity" value="<?php echo $quantity;?>">
                                    </div>

                                </div>
                            <?php }else{ ?>
                                <div class="row row-xs align-items-center mg-b-20" id="Reason0"  style="display: none;">
                                    <div class="col-md-2">
                                        <label class="form-label mg-b-0">Reason : </label>
                                    </div>
                                    <div class="col-md-10 mg-t-5 mg-md-t-0">
                                        <select name="reason" id="reason" class="form-control form-select select2"  data-bs-placeholder="Select Station">
                                            <option value="" selected disabled>--- Select Reason ---</option>
                                            <?php
                                            $string = $reason;

                                            $str_arr = explode (",", $string);
                                            for ($i=0; $i < count($str_arr) ; $i++)
                                            {  ?>

                                                <option value="<?php echo $str_arr[$i]; ?>"><?php echo $str_arr[$i]; ?></option>
                                            <?php     } ?>

                                        </select>                                </div>

                                </div>
                                <div class="row row-xs align-items-center mg-b-20" id="quantity0" style="display: none;">
                                    <div class="col-md-2">
                                        <label class="form-label mg-b-0">Quantity: </label>
                                    </div>
                                    <div class="col-md-10 mg-t-5 mg-md-t-0">
                                        <input type="text" class="form-control" name="quantity" rows="1" id="quantity" value="<?php echo $quantity;?>">
                                    </div>
                                </div>
                            <?php  }?>

                            <div class="row row-xs align-items-center mg-b-20">

                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Notes :</label>
                                </div>
                                <div class="col-md-10 mg-t-5 mg-md-t-0">
                                    <textarea id="notes" name="material_notes" rows="4" placeholder="Enter Notes..." value =" <?php echo $notes;?>" class="form-control"><?php echo $notes;?></textarea>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-2">
                                    <button type="submit" id="form_submit_btn" class="btn btn-primary submit_btn">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
</div>
</form>
</div>

<script>
    $(document).ready(function() {
        $('.select').select2();
    });
</script>

<script>
    $(document).on('click', '.remove_image', function () {
        var del_id = this.id.split("_")[2];
        var mat_img_id = this.parentElement.childNodes[3].value;
        var info =  document.getElementById("delete_image"+del_id);
        var info =  "id="+del_id+"&material_id="+mat_img_id;
        $.ajax({
            type: "POST", url: "../material_tracability/delete_material_image.php", data: info, success: function (data) {
            }
        });
        location.reload(true);
    });
</script>
<script>

    $("#file-input").on("change", function(e) {
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
                    "</span>").insertAfter("#file-input");
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

<!--<script>-->
<!--    function submitFormSettings(url) {-->
<!--        //          $(':input[type="button"]').prop('disabled', true);-->
<!--        var data = $("#material_setting").serialize();-->
<!--        $.ajax({-->
<!--            type: 'POST',-->
<!--            url: url,-->
<!--            data: data,-->
<!--            success: function(data) {-->
<!--                // $("#textarea").val("")-->
<!--                // window.location.href = window.location.href + "?aa=Line 1";-->
<!--                //                   $(':input[type="button"]').prop('disabled', false);-->
<!--                //                   location.reload();-->
<!--                //$(".enter-message").val("");-->
<!--            }-->
<!--        });-->
<!--    }-->
<!--</script><script>-->
<!--    function submitFormSettings(url) {-->
<!--        //          $(':input[type="button"]').prop('disabled', true);-->
<!--        var data = $("#material_setting").serialize();-->
<!--        $.ajax({-->
<!--            type: 'POST',-->
<!--            url: url,-->
<!--            data: data,-->
<!--            success: function(data) {-->
<!--                // $("#textarea").val("")-->
<!--                // window.location.href = window.location.href + "?aa=Line 1";-->
<!--                //                   $(':input[type="button"]').prop('disabled', false);-->
<!--                //                   location.reload();-->
<!--                //$(".enter-message").val("");-->
<!--            }-->
<!--        });-->
<!--    }-->
<!--</script>-->
<script>
    function group1()
    {
        $("#out_of_tolerance_mail_list").select2("open");
    }
    function group2()
    {
        $("#out_of_control_list").select2("open");
    }

    // $(document).on("click",".submit_btn",function() {
    //     //$("#form_settings").submit(function() {
    //
    //     var line_number = $("#line_number").val();
    //     var material_type = $("#material_type").val();
    //     var material_status = $("#material_status").val();
    //
    //
    //
    // });

    // function preview_image()
    // {
    //     var total_file=document.getElementById("file-input").files.length;
    //     for(var i=0;i<total_file;i++)
    //     {
    //         $('#preview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'><br>");
    //     }
    // }


    //image preview

    function previewImages() {
        $("#preview").html(" ");

        var preview = document.querySelector('#preview');

        if (this.files) {
            [].forEach.call(this.files, readAndPreview);
        }

        function readAndPreview(file) {

            // Make sure `file.name` matches our extensions criteria
            if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
                return alert(file.name + " is not an image");
            } // else...

            var reader = new FileReader();

            reader.addEventListener("load", function() {
                var image = new Image();
                image.height = 100;
                image.width = 100;
                image.title  = file.name;
                image.src    = this.result;
                preview.appendChild(image);
            });

            reader.readAsDataURL(file);

        }

    }

    document.querySelector('#file-input').addEventListener("change", previewImages);


</script>
<script>
    $(document).ready(function() {
        $("input[name$='material_status']").click(function() {
            var test = $(this).val();
            //    console.log(test);
            $("div.desc").hide();
            $("#Reason" + test).show();
            $("#material_status" + test).show();
            $("#quantity" + test).show();
            $("#Reason" + test).prop('required',true);


        });
    });
</script>
<?php include('../footer1.php') ?>

</body>