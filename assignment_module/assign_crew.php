<?php
include("../config.php");
$temp = "";
$message_stauts_class = 'alert-danger';
$import_status_message = 'Error: Assignment Position Relation does not exist';
$assign_line = $_GET['line'];
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
if (count($_POST) > 0) {
//assign crew delete
    $jm = $_POST['assign_line'];
    if ($jm != "") {
        $assign_line = $jm;
    }
    $delete_check = $_POST['delete_check'];
    $delete_user = $_POST['delete_user'];
    $transaction = $_POST['transaction'];
    $delete_position = $_POST['delete_position'];
    $delete_station = $_POST['delete_station'];
    if ($delete_check != "") {
        $cnt = count($delete_check);
        for ($i = 0; $i < $cnt;) {
            $query0001 = sprintf("SELECT * FROM  cam_assign_crew WHERE `assign_crew_id`='$delete_check[$i]' ");
            $qur0001 = mysqli_query($db, $query0001);
            $rowc0001 = mysqli_fetch_array($qur0001);
            $posname = $rowc0001["position_name"];
            $linename = $rowc0001["line_name"];
            $username = $rowc0001["user_name"];
            $assigncrewtransactionid = $rowc0001["assign_crew_transaction_id"];
            $sql1 = "DELETE FROM `cam_assign_crew` WHERE `assign_crew_id`='$delete_check[$i]'";
            if (!mysqli_query($db, $sql1)) {
                echo "Invalid Data";
            } else {

            }
            $sql = "update cam_users set assigned ='0' where user_name='$username'";
            $result1 = mysqli_query($db, $sql);
            $sqltra = "update cam_assign_crew_log set status ='0' where assign_crew_transaction_id='$assigncrewtransactionid'";
            $resulttra = mysqli_query($db, $sqltra);
            $sql5 = "update cam_station_pos_rel set assigned ='0' where line_name='$linename' and position_name='$posname'";
            $result5 = mysqli_query($db, $sql5);
            $i++;
        }
        $_SESSION['message_stauts_class'] = 'alert-success';
        $_SESSION['import_status_message'] = 'Crew Unassigned Sucessfully.';
        $assign_line = $_POST['assignline'];
    }
}
$ps = $_SESSION['aasignline'];
if ($ps != "") {
    $assign_line = $ps;
    $_SESSION['aasignline'] = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo $sitename; ?> |Add / Create Form</title>
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


    </style>
</head>
<!-- Main navbar -->
<?php
$cust_cam_page_header = "Assign Unassign Crew Members";
include("../header.php");

include("../admin_menu.php");
include("../heading_banner.php");
?>
<body class="ltr main-body app sidebar-mini">
<div class="main-content app-content">
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <span class="main-content-title mg-b-0 mg-b-lg-1"></span>
        </div>
        <div class="justify-content-center mt-2">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);"></a></li>
                <li class="breadcrumb-item active" aria-current="page"></li>
            </ol>
        </div>
    </div>
    <?php
    if (!empty($_SESSION['import_status_message'])) {
        echo '<div class="alert ' . $_SESSION['message_stauts_class'] . '">' . $_SESSION['import_status_message'] . '</div>';
        $_SESSION['message_stauts_class'] = '';
        $_SESSION['import_status_message'] = '';
    }
    ?>
    <form action="" method="post"  class="form-horizontal">
        <div class="row row-sm">
            <div class="col-lg-10 col-xl-10 col-md-12 col-sm-12">
                <div class="card  box-shadow-0">
                    <div class="card-header">
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Select Station</span>
                    </div>
                    <div class="card-body pt-0">
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-8">
                                    <select name="assign_line" id="assign_line" class="form-control form-select select2 select2-hidden-accessible" data-bs-placeholder="Select Country" tabindex="-1" aria-hidden="true">
                                        <option value="" selected disabled>Select Station</option>
                                        <?php
                                        $sql1 = "SELECT * FROM `cam_line` where enabled = '1' and is_deleted != 1";
                                        $result1 = $mysqli->query($sql1);
                                        //                                            $entry = 'selected';
                                        while ($row1 = $result1->fetch_assoc()) {
                                            $lin = $row1['line_id'];
                                            if ($lin == $assign_line) {
                                                $entry = 'selected';
                                            } else {
                                                $entry = '';
                                            }
                                            echo "<option value='" . $row1['line_id'] . "' $entry >" . $row1['line_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-2 mg-t-5 mg-md-t-0">
                                    <button class="btn btn-primary pd-x-30 mg-r-5 mg-t-5">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php
    if ($assign_line != "") {
        $qur04 = mysqli_query($db, "SELECT * FROM  cam_line where line_id = '$assign_line' ");
        $rowc04 = mysqli_fetch_array($qur04);
        $lnname = $rowc04["line_name"];
        $cnt = 1;
        ?>
        <form action="" method="post" id="update-form" class="form-horizontal">
            <div class="row row-sm">
                <div class="col-lg-10 col-xl-10 col-md-12 col-sm-12">
                    <div class="card  box-shadow-0">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">Select Crew for <?php echo $lnname; ?> - Positions</span>
                        </div>
                        <div class="card-body pt-0">
                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-12">
                                        <label class="ckbox">
                                            <input type="checkbox" id="checkAll"><span class="tx-13" style="color: #000000">Select All to Unassign </span> <hr/>
                                        </label>
                                    </div>
                                </div>
                                <?php
                                $query = sprintf("SELECT * FROM  cam_station_pos_rel where line_id = '$assign_line' ; ");
                                $qur = mysqli_query($db, $query);
                                while ($rowc = mysqli_fetch_array($qur)) {
                                    $message_stauts_class = '';
                                    $import_status_message = '';
                                    ?>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <?php
                                        $asign = $rowc["assigned"];
                                        if ($asign == "1") {
                                            ?>
                                            <?php
                                            $query001 = sprintf("SELECT * FROM  cam_assign_crew where line_id = '$assign_line' and position_id = '$rowc[position_id]' and resource_type = 'regular' ; ");
                                            $qur001 = mysqli_query($db, $query001);
                                            $rowc001 = mysqli_fetch_array($qur001);
                                            $usrr = $rowc001["user_id"];
                                            $transidd = $rowc001["assign_crew_transaction_id"];
                                            $asigncrewid = $rowc001["assign_crew_id"];
                                            $res_type = $rowc001["resource_type"];
                                            $query002 = sprintf("SELECT * FROM  cam_users where users_id = '$usrr'; ");
                                            $qur002 = mysqli_query($db, $query002);
                                            while ($rowc002 = mysqli_fetch_array($qur002)) {
                                                $firstname = $rowc002["firstname"];
                                                $lastname = $rowc002["lastname"];
                                            }
                                            $query003 = sprintf("SELECT * FROM  cam_position where position_id = '$rowc[position_id]'; ");
                                            $qur003 = mysqli_query($db, $query003);
                                            while ($rowc003 = mysqli_fetch_array($qur003)) {
                                                $positionname = $rowc003["position_name"];
                                            }
                                            ?>
                                            <div class="col-md-2">
                                                <label class="ckbox">
                                                    <input type="checkbox" id="delete_check[]" name="delete_check[]" value="<?php echo $asigncrewid; ?>"><span class="tx-13"></span>
                                                    <input type="hidden" id="res_type[]" name="res_type[]" value="<?php echo $res_type; ?>">
                                                </label>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label mg-b-0"><?php echo $positionname; ?>:</label>
                                            </div>
                                            <div class="col-md-6 mg-t-5 mg-md-t-0">
                                                <input type="text" class="form-control" value="<?php echo $firstname; ?>&nbsp;<?php echo $lastname; ?>" disabled>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <?php
                                            $query004 = sprintf("SELECT * FROM  cam_position where position_id = '$rowc[position_id]'; ");
                                            $qur004 = mysqli_query($db, $query004);
                                            while ($rowc004 = mysqli_fetch_array($qur004)) {
                                                $positionname = $rowc004["position_name"];
                                            }
                                            ?>
                                            <div class="col-md-2"></div>
                                            <div class="col-md-4">
                                                <label class="form-label mg-b-0"><?php echo $positionname; ?>:</label>
                                            </div>
                                            <div class="col-md-6 mg-t-5 mg-md-t-0">
                                                <input type="hidden" name="position[]" value="<?php echo $rowc["position_id"]; ?>">
                                                <input type="hidden" name="assignline" value="<?php echo $assign_line; ?>">
                                                <input type="hidden" name="resource_type[]" value="regular">
                                                <select name="user_name[]" id="user_name<?php echo $cnt; ?>" data-count="<?php echo $cnt; ?>" class="form-control form-select select2 select2-hidden-accessible" data-bs-placeholder="Select Country" tabindex="-1" aria-hidden="true">
                                                    <option value="1" selected >Select User</option>
                                                    <?php
                                                    $sql1 = "SELECT * FROM `cam_users` WHERE `assigned2` = '0'  and `users_id` != '1' order BY `firstname`";
                                                    $result1 = $mysqli->query($sql1);
                                                    while ($row1 = $result1->fetch_assoc()) {
                                                        $full = $row1['firstname'] . " " . $row1['lastname'];
                                                        echo "<option value='" . $row1['users_id'] . "' data-fullnm = '$full' data-id='" . $row1['assigned'] . "'>$full</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <br/>
                                    <?php $cnt++; ?>
                                <?php } ?>
                                <?php
                                $priyantcount = 2;
                                $qurtemp2 = mysqli_query($db, "SELECT * FROM cam_assign_crew WHERE line_id = '$assign_line' and resource_type  NOT IN ('regular' , 'On Break' , 'Covering for break')   ORDER by created_at ");
                                while ($rowctemp2 = mysqli_fetch_array($qurtemp2)) {
                                    $userid = $rowctemp2["user_id"];
                                    $assigncrewid = $rowctemp2["assign_crew_id"];
                                    $res_type = $rowctemp2["resource_type"];
                                    $po = $rowctemp2["position_id"];
                                    $qurtemp3 = mysqli_query($db, "SELECT firstname,lastname FROM cam_users WHERE users_id = '$userid'");
                                    $rowctemp3 = mysqli_fetch_array($qurtemp3);
                                    $firstname = $rowctemp3["firstname"];
                                    $lastname = $rowctemp3["lastname"];
                                    $qurtemp4 = mysqli_query($db, "SELECT position_name FROM cam_position WHERE position_id = '$po'");
                                    $rowctemp4 = mysqli_fetch_array($qurtemp4);
                                    $po_name = $rowctemp4["position_name"];
                                    $priyantcount--;
                                    ?>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-2">
                                            <label class="ckbox">
                                                <input type="checkbox"  id="delete_check[]" name="delete_check[]" value="<?php echo $assigncrewid; ?>"><span class="tx-13"></span>
                                                <input type="hidden" id="res_type[]" name="res_type[]" value="<?php echo $res_type; ?>">
                                            </label>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label mg-b-0"><?php echo $po_name; ?>:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" value="<?php echo $firstname; ?>&nbsp;<?php echo $lastname; ?>" disabled>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" value="<?php echo $res_type; ?>" disabled>
                                        </div>
                                    </div>
                                    <br/>
                                <?php } ?>
                                <?php
                                if ($priyantcount != "0") {
                                    for ($i = 0; $i < $priyantcount;) {
                                        ?>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <select name="position[]" id="position" class="form-control form-select select2 select2-hidden-accessible" data-bs-placeholder="Select Country" tabindex="-1" aria-hidden="true">
                                                    <option value="1" selected >Select Position </option>
                                                    <?php
                                                    $sql1 = "SELECT * FROM  cam_station_pos_rel where line_id = '$assign_line'";
                                                    $result1 = $mysqli->query($sql1);
                                                    while ($row1 = $result1->fetch_assoc()) {
                                                        $pid = $row1['position_id'];
                                                        $qurtemp5 = mysqli_query($db, "SELECT position_name FROM cam_position WHERE position_id = '$pid'");
                                                        $rowctemp5 = mysqli_fetch_array($qurtemp5);
                                                        $p = $rowctemp5["position_name"];
                                                        echo "<option value='" . $row1['position_id'] . "' >" . $p . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="hidden" name="assignline" value="<?php echo $assign_line; ?>">
                                                <select name="user_name[]" id="user_name<?php echo $cnt; ?>" class="form-control form-select select2 select2-hidden-accessible" data-bs-placeholder="Select Country" tabindex="-1" aria-hidden="true" data-row="5"  data-count="<?php echo $cnt; ?>">
                                                    <option value="1" selected >Select User</option>
                                                    <?php
                                                    $sql1 = "SELECT * FROM `cam_users` WHERE `assigned2` = '0'  and `users_id` != '1' order BY `firstname`";
                                                    $result1 = $mysqli->query($sql1);
                                                    while ($row1 = $result1->fetch_assoc()) {
                                                        $full = $row1['firstname'] . " " . $row1['lastname'];
                                                        echo "<option value='" . $row1['users_id'] . "' data-fullnm = '$full' data-row='5' data-id='" . $row1['assigned'] . "'>$full</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <select name="resource_type[]" id="resource_type<?php echo $cnt; ?>" class="form-control form-select select2 select2-hidden-accessible" data-bs-placeholder="Select Country" tabindex="-1" aria-hidden="true" data-count="<?php echo $cnt; ?>">
                                                    <option value="Cross Training" selected >Select Resource Type</option>
                                                    <option value="Cross Training"  >Cross Training</option>
                                                    <option value="Additional Personnel" >Additional Personnel</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br/>
                                        <?php
                                        $i++;
                                        $cnt++;
                                    }
                                }
                                ?>

                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-12">
                                        <label class="form-label mg-b-0" style="color: #000000">Break Assignment</label><hr/>
                                    </div>
                                </div>
                                <?php
                                $priyantcount = 2;
                                $qurtemp2 = mysqli_query($db, "SELECT * FROM cam_assign_crew WHERE line_id = '$assign_line' and resource_type  NOT IN ('regular' , 'Additional Personnel' , 'Cross Training')  ORDER by created_at");
                                while ($rowctemp2 = mysqli_fetch_array($qurtemp2)) {
                                    $userid = $rowctemp2["user_id"];
                                    $assigncrewid = $rowctemp2["assign_crew_id"];
                                    $res_type = $rowctemp2["resource_type"];
                                    $po = $rowctemp2["position_id"];
                                    $qurtemp3 = mysqli_query($db, "SELECT firstname,lastname FROM cam_users WHERE users_id = '$userid'");
                                    $rowctemp3 = mysqli_fetch_array($qurtemp3);
                                    $firstname = $rowctemp3["firstname"];
                                    $lastname = $rowctemp3["lastname"];
                                    $qurtemp4 = mysqli_query($db, "SELECT position_name FROM cam_position WHERE position_id = '$po'");
                                    $rowctemp4 = mysqli_fetch_array($qurtemp4);
                                    $po_name = $rowctemp4["position_name"];
                                    $priyantcount--;
                                    ?>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-2">
                                            <label class="ckbox">
                                                <input type="checkbox"  id="delete_check[]" name="delete_check[]" value="<?php echo $assigncrewid; ?>"><span class="tx-13"></span>
                                                <input type="hidden" id="res_type[]" name="res_type[]" value="<?php echo $res_type; ?>">
                                            </label>
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label mg-b-0"><?php echo $po_name; ?>:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" value="<?php echo $firstname; ?>&nbsp;<?php echo $lastname; ?>" disabled>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" value="<?php echo $res_type; ?>" disabled>
                                        </div>
                                    </div>
                                    <br/>
                                <?php } ?>
                                <?php
                                if ($priyantcount != "0") {
                                    for ($i = 0; $i < $priyantcount;) {
                                        ?>
                                        <div class="row row-xs align-items-center mg-b-20">
                                            <div class="col-md-4">
                                                <select name="position[]" id="position" class="form-control form-select select2 select2-hidden-accessible" data-bs-placeholder="Select Country" tabindex="-1" aria-hidden="true">
                                                    <option value="1" selected >Select Position</option>
                                                    <?php
                                                    $sql1 = "SELECT * FROM  cam_station_pos_rel where line_id = '$assign_line'";
                                                    $result1 = $mysqli->query($sql1);
                                                    while ($row1 = $result1->fetch_assoc()) {
                                                        $pid = $row1['position_id'];
                                                        $qurtemp5 = mysqli_query($db, "SELECT position_name FROM cam_position WHERE position_id = '$pid'");
                                                        $rowctemp5 = mysqli_fetch_array($qurtemp5);
                                                        $p = $rowctemp5["position_name"];
                                                        echo "<option value='" . $row1['position_id'] . "' >" . $p . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <input type="hidden" name="assignline" value="<?php echo $assign_line; ?>">
                                                <select name="user_name[]" id="user_name<?php echo $cnt; ?>" class="form-control form-select select2 select2-hidden-accessible" data-bs-placeholder="Select Country" tabindex="-1" aria-hidden="true" data-row="5"  data-count="<?php echo $cnt; ?>">
                                                    <option value="1" selected >Select User</option>
                                                    <?php
                                                    $sql1 = "SELECT * FROM `cam_users` WHERE `assigned2` = '0'  and `users_id` != '1' order BY `firstname`";
                                                    $result1 = $mysqli->query($sql1);
                                                    while ($row1 = $result1->fetch_assoc()) {
                                                        $full = $row1['firstname'] . " " . $row1['lastname'];
                                                        echo "<option value='" . $row1['users_id'] . "' data-fullnm = '$full' data-row='5' data-id='" . $row1['assigned'] . "'>$full</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <select name="resource_type[]" id="resource_type<?php echo $cnt; ?>" class="form-control form-select select2 select2-hidden-accessible" data-bs-placeholder="Select Country" tabindex="-1" aria-hidden="true" data-count="<?php echo $cnt; ?>">
                                                    <option value="On Break" selected >Select Resource Type</option>
                                                    <option value="On Break"  >On Break</option>
                                                    <option value="Covering for break" >Covering for break</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br/>
                                        <?php
                                        $i++;
                                        $cnt++;
                                    }
                                }
                                ?>
                                <div class="row row-xs align-items-center mg-b-20">
                                    <?php
                                    if ($message_stauts_class == '') {
                                        ?>
                                        <div class="col-md-3">
                                            <button type="submit" onclick="submitForm('assign_crew_submit.php')" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5 legitRipple" id="form_submit_btn">ASSIGN CREW<span class="legitRipple-ripple" style="left: 77.1927%; top: 62.5874%; transform: translate3d(-50%, -50%, 0px); width: 211.636%; opacity: 0;"></span></button>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="submit" onclick="submitForm11('assign_crew_unassign_submit.php')" class="btn btn-danger pd-x-30 mg-r-5 mg-t-5 legitRipple" id="form_submit_btn">UNASSIGN CREW<span class="legitRipple-ripple" style="left: 77.1927%; top: 62.5874%; transform: translate3d(-50%, -50%, 0px); width: 211.636%; opacity: 0;"></span></button>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <br/>
        <?php
        if (!empty($import_status_message)) {
            echo '<div class="alert ' . $message_stauts_class . '">' . $import_status_message . '</div>';
        }
        ?>
    <?php } ?>
</div>

<script>
    $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>
<script>
    window.onload = function () {
        history.replaceState("", "", "<?php echo $scriptName; ?>assignment_module/assign_crew.php");
    }
    $('.update').on('change', function (event) {
        //	debugger;
        var prevValue = $(this).data('previous');
        var neww = 0;
        var row_no = $(this).data('row');
        //    $('.update').not(this).find('option[value="' + prevValue + '"]').show();
        // The .each() method is unnecessary here:
        //    var count = 0;
        //   $( ".update" ).each(function() {
        //      var option2 = $('option:selected', this).val();
        //      if(option2 == prevValue){
        //          count++;
        //      }
        //      if(count == 0){
        // $('.update').find('option[value="' + prevValue + '"]').attr("data-id", "0");
        neww = $('.update').find('option[value="' + prevValue + '"]:selected').attr("data-row");
        //console.log("neww");
        //console.log(neww);
        //console.log(prevValue);
        //      }
        //    });
        var selected_val = $(this).attr("id");
        //console.log(selected_val);
        var fullnm = $('#' + selected_val).find(":selected").attr("data-fullnm");
        var sel_data_id = parseInt($('#' + selected_val).find(":selected").attr("data-id"));
        var prevValue = $(this).data('previous');
        if (prevValue) {
            var prev_dat_id = parseInt($("#" + selected_val + " option[value= '" + prevValue + "']")[0].attributes['data-id'].value);
            $('.update').find('option[value="' + prevValue + '"]').attr("data-id", parseInt(prev_dat_id - 1));
            prefullnm = $('.update').find('option[value="' + prevValue + '"]:selected').attr("data-fullnm");
            $('.update').not(this).find('option[value="' + prevValue + '"]').show();
            $this = $(".custom_cls > span:contains(" + prefullnm + ")");
            $this.parent().show()
        }
        var value = $(this).val();
        //console.log(prevValue);
        $('.update').find('option[data-row="' + neww + '"][value="' + prevValue + '"]').hide();
        if (value) {
            $(this).data('previous', value);
            if (sel_data_id == 1) {
                $('.update').not(this).find('option[value="' + value + '"]').hide();
                $this = $(".custom_cls > span:contains(" + fullnm + ")");
                $this.parent().hide()
            }
            $('.update').find('option[value="' + value + '"]').attr("data-id", sel_data_id + 1);
            $('.update').not(this).find('option[data-row="5"][value="' + value + '"]').hide();
            //$(".opt > span:contains('Additional Personnel')").hide ();
            //console.log(value);
        }
    });
    function submitForm(url) {
        $(':input[type="button"]').prop('disabled', true);
        var data = $("#update-form").serialize();
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function (data) {
                // window.location.href = window.location.href + "?aa=Line 1";
                $(':input[type="button"]').prop('disabled', false);
                location.reload();
            }
        });
    }
    function submitForm11(url) {
        $(':input[type="button"]').prop('disabled', true);
        var data = $("#update-form").serialize();
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function (data) {
                // window.location.href = window.location.href + "?aa=Line 1";
                $(':input[type="button"]').prop('disabled', false);
                location.reload();
            }
        });
    }
</script>
<?php include('../footer.php') ?>
</body>