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
if ($i != "super" && $i != "admin" && $i != "pn_user" ) {
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
        <?php echo $sitename; ?> |Add / Create Form</title>
    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="../assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/colors.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/style_main.css" rel="stylesheet" type="text/css">
    <!--    <link rel=stylesheet href=https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css>-->
    <!--    <link rel=stylesheet href=https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css>-->

    <!-- /global stylesheets -->
    <!-- Core JS files -->
    <script type="text/javascript" src="../assets/js/libs/jquery-3.6.0.min.js"> </script>
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



    <style>
        .checkbox-control {
            height: 15px;
            width: 15px;
        }
        @media (min-width: 576px)
            .d-sm-block {
                display: block!important;
            }
            .bg-white {
                background-color: #191e3a!important;
                height: 30px;
            }
            .shadow-sm {
                box-shadow: 0 .125rem .25rem rgba(0,0,0,.075)!important;
            }
            .d-none {
                display: none!important;
            }
            @media (min-width: 992px)
                .navbar-expand-lg {
                    flex-wrap: nowrap;
                    justify-content: flex-start;
                }

            }
            .sidebar-default .navigation li>a {
                color: #f5f5f5
            }

        ;
            a:hover {
                background-color: #20a9cc;
            }

            .sidebar-default .navigation li>a:focus,
            .sidebar-default .navigation li>a:hover {
                background-color: #20a9cc;
            }

            .form-control:focus {
                border-color: transparent transparent #1e73be !important;
                -webkit-box-shadow: 0 1px 0 #1e73be;
                box-shadow: 0 1px 0 #1e73be !important;
            }

            .form-control {
                border-color: transparent transparent #1e73be;
                border-radius: 0;
                -webkit-box-shadow: none;
                box-shadow: none;
                font-size: 14px;
            }

            span.select2-selection.select2-selection--multiple {
                border-bottom: 1px solid #1b2e4b !important;
            }
            .select2-selection--multiple:not([class*=bg-]):not([class*=border-]) {
                border-color: #1b2e4b;
            }

            .contextMenu{ position:absolute;  width:min-content; left: -18px; background:#e5e5e5; z-index:999;}

            .red {
                color: red;
                display: none;
            }
            .remove_btn {
                float: right;
                width: 2%;
            }
            input.select2-search__field {
                width: auto!important;

            }
            .collapse.in {
                display: block!important;
            }
            .select2-search--dropdown .select2-search__field {
                padding: 4px;
                width: 100%!important;
                box-sizing: border-box;
            }
            .list_none {
                float: right;
                margin-right: 58px;
            }
            .add_option {
                padding: 10px;
            }
            .custom-radio{
                padding: 10px;
                         }


            @media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px) {

                .col-md-0\.5 {
                    float: right;
                    width: 5%;
                }
                .col-md-6 {
                    width: 60%;
                    float: left;
                }
                .col-lg-2 {
                    width: 35%!important;
                    float: left;
                }
                .col-md-3 {
                    width: 30%;
                    float: left;
                }
                .form-check.form-check-inline {
                    width: 70%;
                }
            }

            .form-check-inline .form-check-input {
                position: static;
                margin-top: -4px!important;
                margin-right: 0.3125rem;
                margin-left: 10px!important;
            }
            .panel-heading>.dropdown .dropdown-toggle, .panel-title, .panel-title>.small, .panel-title>.small>a, .panel-title>a, .panel-title>small, .panel-title>small>a {
                color: inherit !important;
            }
            .item_label{
                margin-bottom: 0px !important;
                margin-right: 10px !important;
            }
            .select2-selection--multiple {
                border: 1px solid transparent !important;
            }
            .checkbox-control {
                height: 15px;
                width: 15px;
            }
            input[type="file"] {
                display: block;
            }

            .container {
                margin: 0 auto;
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

            .content_img span:hover {
                cursor: pointer;
            }
            input.radio_input {
                border-top: none;
                border-right-style: none;
                border-left-style: none;
                margin-left: 10px;
                order-bottom-color: grey;
                border-bottom-width: thin;
            }

            button.remove {
                margin-left: 15px;
                margin-top: 6px;
            }
    </style>
</head>

<body>
<!-- Main navbar -->
<?php
$cust_cam_page_header = "Add / Create Form";
include("../header.php");
include("../admin_menu.php");
include("../heading_banner.php");
?>
<!-- /main navbar -->
<!-- Page container -->
<div class="page-container">
    <!-- Page content -->

    <!-- Content area -->
    <div class="content">
        <!-- Main charts -->
        <!-- Basic datatable -->
        <div class="panel panel-flat">
            <div class="panel-heading">

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

                <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $rowc['sg_communicator_config_id']; ?>">
                <div class="row">
                    <div class="col-md-12">
                        <form action="fs_backend.php" id="form_settings" enctype="multipart/form-data" class="form-horizontal" method="post">
                            <div class="row">
                                <label class="col-lg-2 control-label" style="padding-top: 10px;">Name : </label>
                                <div class="col-md-6">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Form Name" required>
                                </div>
                                <div id="error1" class="red">Please Enter Name</div>
                            </div>
                            <br/>
                            <div class="row">
                                <label class="col-lg-2 control-label" for="default">Form Classification:</label>
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline">
                                        <input type="radio" id="event" name="form_classification" value="event" class="form-check-input" checked>
                                        <label for="event" class="item_label">Event</label>
                                        <input type="radio" id="general" name="form_classification" value="general" class="form-check-input" >
                                        <label for="general" class="item_label">General</label>

                                    </div>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <label class="col-lg-2 control-label">Form Type : </label>
                                <div class="col-md-6">
                                    <select name="form_type" id="form_type"  class="select" data-style="bg-slate">
                                        <option value="" selected disabled>--- Select Form Type ---</option>
                                        <?php
                                        $sql1 = "SELECT * FROM `form_type` where is_deleted != 1";
                                        $result1 = $mysqli->query($sql1);
                                        //                                            $entry = 'selected';
                                        while ($row1 = $result1->fetch_assoc()) {
                                            echo "<option value='" . $row1['form_type_id'] . "'  >" . $row1['form_type_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <div id="error2" class="red">Please Enter Form Type</div>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <label class="col-lg-2 control-label">Station : </label>
                                <div class="col-md-6">
                                    <select name="station" id="station" class="select form-control" data-style="bg-slate">
                                        <option value="" selected disabled>--- Select Station ---</option>
                                        <?php
                                        $st_dashboard = $_GET['station'];
                                        if($is_tab_login){
                                            $sql1 = "SELECT line_id,line_name FROM `cam_line`  where enabled = '1' and line_id = '$tab_line' and is_deleted != 1 ORDER BY `line_name` ASC";
                                            $result1 = $mysqli->query($sql1);

                                            while ($row1 = $result1->fetch_assoc()) {
                                                $entry = 'selected';
                                                echo "<option value='" . $row1['line_id'] . "'  $entry>" . $row1['line_name'] . "</option>";
                                            }
                                        }else if($is_cell_login){
                                            $c_stations = implode("', '", $c_login_stations_arr);
                                            $sql1 = "SELECT line_id,line_name FROM `cam_line`  where enabled = '1' and line_id IN ('$c_stations') and is_deleted != 1 ORDER BY `line_name` ASC";
                                            $result1 = $mysqli->query($sql1);
//													                $                        $entry = 'selected';
                                            $i = 0;
                                            while ($row1 = $result1->fetch_assoc()) {
//														$entry = 'selected';
                                                if($i == 0 ){
                                                    $entry = 'selected';
                                                    echo "<option value='" . $row1['line_id'] . "'  $entry>" . $row1['line_name'] . "</option>";

                                                }else{
                                                    echo "<option value='" . $row1['line_id'] . "'  >" . $row1['line_name'] . "</option>";

                                                }
                                                $i++;
                                            }
                                        }else{
                                            $sql1 = "SELECT * FROM `cam_line`  where enabled = '1' and is_deleted != 1 ORDER BY `line_name` ASC";
                                            $result1 = $mysqli->query($sql1);
                                            //                                            $entry = 'selected';
                                            while ($row1 = $result1->fetch_assoc()) {
                                                if($st_dashboard == $row1['line_id'])
                                                {
                                                    $entry = 'selected disabled';
                                                }
                                                else
                                                {
                                                    $entry = '';
                                                }
                                                echo "<option value='" . $row1['line_id'] . "'  $entry>" . $row1['line_name'] . "</option>";
                                            }
                                        }

                                        ?>
                                    </select>
                                    <div id="error3" class="red">Please Enter Station </div>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <label class="col-lg-2 control-label">Part Family : </label>
                                <div class="col-md-6">
                                    <select name="part_family" id="part_family" class="select form-control"  data-style="bg-slate">
                                        <option value="" selected disabled>--- Select Part Family ---</option>
                                        <?php
                                        $st_dashboard = $_GET['station'];
                                        $sql1 = "SELECT * FROM `pm_part_family`  where is_deleted != 1";
                                        $result1 = $mysqli->query($sql1);
                                        //                                            $entry = 'selected';
                                        while ($row1 = $result1->fetch_assoc()) {
                                            echo "<option value='" . $row1['pm_part_family_id'] . "'  >" . $row1['part_family_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <div id="error4" class="red">Please Enter Part Family</div>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <label class="col-lg-2 control-label">Part Number : </label>
                                <div class="col-md-6">
                                    <select name="part_number" id="part_number" class="select form-control" data-style="bg-slate">
                                        <option value="" selected disabled>--- Select Part Number ---</option>
                                        <?php
                                        $sql1 = "SELECT * FROM `pm_part_number` where is_deleted != 1";
                                        $result1 = $mysqli->query($sql1);
                                        //                                            $entry = 'selected';
                                        while ($row1 = $result1->fetch_assoc()) {
                                            $station = $row1['station'];
                                            $row_station ="select line_id,line_name from cam_line where line_id = '$station' and is_deleted != 1";
                                            $sta_row = mysqli_query($db,$row_station);
                                            $row = mysqli_fetch_assoc($sta_row);
                                            $line_name = $row['line_name'];
                                            echo "<option value='" . $row1['pm_part_number_id'] . "'  >" . $row1['part_number']." - ".$row1['part_name']." - ".$line_name. "</option>";
                                        }
                                        ?>
                                    </select>
                                    <div id="error5" class="red">Please Enter Part Number</div>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <label class="col-lg-2 control-label">Image : </label>
                                <div class="col-md-6">
                                    <input type="file" name="image[]" id="file-input" class="form-control" multiple>
                                    <div class="container"></div>
                                </div>

                            </div>
                            <br/>
                            <div class="row">
                                <label class="col-lg-2 control-label">PO Number : </label>
                                <div class="col-md-6">
                                    <input type="text" name="po_number" id="po_number" class="form-control"> </div>
                                <div id="error6" class="red">Please Enter PO Number</div>

                            </div>
                            <br/>
                            <div class="row">
                                <label class="col-lg-2 control-label">DA Number : </label>
                                <div class="col-md-6">
                                    <input type="text" name="da_number" id="da_number" class="form-control"> </div>
                                <div id="error7" class="red">Please Enter DA Number</div>

                            </div>
                            <br/>

                            <div class="row">
                                <label class="col-lg-2 control-label">Out of tolerance Mail List  </label>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="select form-control select-border-color" data-placeholder="Tolerance Mail List..."  name="out_of_tolerance_mail_list[]" id="out_of_tolerance_mail_list" multiple="multiple" data-style="bg-slate">
                                            <?php
                                            $arrteam = explode(',', $rowc["teams"]);
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
                                        <div id="error9" class="red">Please Select Tolerance Mail List</div>

                                    </div>
                                </div>
                                <div class="col-md-0.5">
                                    <button type="button" class="btn btn-primary" style="background-color:#1e73be;" onclick="group1()"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                </div>
                            </div>

                            <div class="row">
                                <label class="col-lg-2 control-label">Out of Control List : </label>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="select form-control select-border-color select-access-multiple-open" data-style="bg-slate" data-placeholder="Out of Control List ..." name="out_of_control_list[]" id="out_of_control_list" multiple="multiple">
                                            <?php
                                            $arrteam = explode(',', $rowc["teams"]);
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
                                        <div id="error10" class="red">Please Select Out of Control List</div>

                                    </div>
                                </div>
                                <div class="col-md-0.5">
                                    <button type="button" class="btn btn-primary" style="background-color:#1e73be;" onclick="group2()"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                </div>
                            </div>
                            <div class="row">
                                <label class="col-lg-2 control-label">Notification List : </label>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="select form-control select-border-color select-access-multiple-open" data-style="bg-slate" data-placeholder="Notification List ..." name="notification_list[]" id="notification_list" multiple="multiple">
                                            <?php
                                            $sql1 = "SELECT * FROM `cam_users` WHERE `assigned2` = '0'  and `users_id` != '1' order BY `firstname` ";
                                            $result1 = $mysqli->query($sql1);
                                            while ($row1 = $result1->fetch_assoc()) {

                                                echo "<option value='" . $row1['users_id'] . "' $selected>" . $row1['firstname'] . "&nbsp;" . $row1['lastname'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-0.5">
                                    <button type="button" class="btn btn-primary" style="background-color:#1e73be;" onclick="group3()"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                </div>
                            </div>
                            <div class="row" style="padding: 10px 0px 20px 0px;">
                                <label class="col-lg-8 control-label" style="color: #999999;">* If the form is not filled within 30 mins of the frequency time then the personnel in the Notification List will be notified.</label>
                            </div>
                            <div class="row">
                                <!--<div class="col-md-4">-->
                                <label class="col-lg-2 control-label">Notes : </label>
                                <div class="col-md-6">
                                    <textarea id="notes" name="form_create_notes" rows="4" placeholder="Enter Notes..." class="form-control"></textarea>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <label class="col-lg-2 control-label">Needs Approval : </label>
                                <div class="col-md-6">
                                    <input type="checkbox" class="checkbox-control" name="need_approval" id="need_approval" checked>
                                </div>
                            </div>
                            <br/>
                            <div class="row">
                                <label class="col-lg-2 control-label"> Bypass Approval List : </label>
                                <div class="col-md-6">
                                    <input type="checkbox" class="checkbox-control" name="approval_list" id="approval_list" checked>
                                </div>
                            </div>
                            <br/>
                            <div class="row" id="approve_row">
                                <label class="col-lg-2 control-label">Approval By : </label>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <select class="select form-control select-border-color select-access-multiple-open" data-style="bg-slate" data-placeholder="Approval By ..." name="approval_by[]" id="approval_by" multiple="multiple">
                                            <?php
                                            $arrteam = explode(',', $rowc["teams"]);
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
                                <div class="col-md-0.5">
                                    <button type="button" class="btn btn-primary" style="background-color:#1e73be;" onclick="group4()"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                </div>
                            </div>
                            <div class="row">
                                <!--<div class="col-md-4">-->
                                <label class="col-lg-2 control-label">Valid From : </label>
                                <div class="col-md-6">
                                    <input type="date" name="valid_from" id="valid_from" class="form-control"> </div>
                            </div>
                            <br/>
                            <div class="row">
                                <!--<div class="col-md-4">-->
                                <label class="col-lg-2 control-label">Valid Till : </label>
                                <div class="col-md-6">
                                    <input type="date" name="valid_till" id="valid_till" class="form-control"> </div>
                            </div>
                            <br/>
                            <div class="row">
                                <!--<div class="col-md-4">-->
                                <label class="col-lg-2 control-label">Frequency : </label>
                                <div class="col-md-3">
                                    <select name="duration_hh" id="duration_hh"  class="select form-control"  data-style="bg-slate">
                                        <option value="" disabled selected>--Select Hours--</option>
                                        <option value="00">00</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select name="duration_mm" id="duration_mm" class="select form-control"  data-style="bg-slate">
                                        <option value="" selected disabled>--Select Min--</option>
                                        <option value="00">00</option>
                                        <option value="01">01</option>
                                        <option value="02">02</option>
                                        <option value="03">03</option>
                                        <option value="04">04</option>
                                        <option value="05">05</option>
                                        <option value="06">06</option>
                                        <option value="07">07</option>
                                        <option value="08">08</option>
                                        <option value="09">09</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="13">13</option>
                                        <option value="14">14</option>
                                        <option value="15">15</option>
                                        <option value="16">16</option>
                                        <option value="17">17</option>
                                        <option value="18">18</option>
                                        <option value="19">19</option>
                                        <option value="20">20</option>
                                        <option value="21">21</option>
                                        <option value="22">22</option>
                                        <option value="23">23</option>
                                        <option value="24">24</option>
                                        <option value="25">25</option>
                                        <option value="26">26</option>
                                        <option value="27">27</option>
                                        <option value="28">28</option>
                                        <option value="29">29</option>
                                        <option value="30">30</option>
                                        <option value="31">31</option>
                                        <option value="32">32</option>
                                        <option value="33">33</option>
                                        <option value="34">34</option>
                                        <option value="35">35</option>
                                        <option value="36">36</option>
                                        <option value="37">37</option>
                                        <option value="38">38</option>
                                        <option value="39">39</option>
                                        <option value="40">40</option>
                                        <option value="41">41</option>
                                        <option value="42">42</option>
                                        <option value="43">43</option>
                                        <option value="44">44</option>
                                        <option value="45">45</option>
                                        <option value="46">46</option>
                                        <option value="47">47</option>
                                        <option value="48">48</option>
                                        <option value="49">49</option>
                                        <option value="50">50</option>
                                        <option value="51">51</option>
                                        <option value="52">52</option>
                                        <option value="53">53</option>
                                        <option value="54">54</option>
                                        <option value="55">55</option>
                                        <option value="56">56</option>
                                        <option value="57">57</option>
                                        <option value="58">58</option>
                                        <option value="59">59</option>
                                    </select>

                                </div>
                            </div>
                            <br/>
                            <br/>
                            <hr/>


                            <input type="hidden" id="collapse_id" value="1">
                            <div class="query_rows">

                            </div>
                            <br/>
                            <button type="button" name="add_more" id="add_more" class="btn btn-primary legitRipple" style="background-color:#1e73be;">Add More Form Items</button>

                            <br/><br/>
                            <div class="row">
                                <input type="hidden" name="click_id" id="click_id" >

                            </div>

                            <br/>

                    </div>
                </div>
            </div>

            <div  class="panel-footer p_footer">
                <button type="submit" id="form_submit_btn" class="btn btn-primary submit_btn" style="background-color:#1e73be;">Create Form</button>
            </div>
            </form>
        </div>
    </div>
</div>
<!-- /main charts -->

<script>
    $(document).ready(function() {
        $('.select').select2();
    });

</script>

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
</script>
<script>
    function group1()
    {
        $("#out_of_tolerance_mail_list").select2("open");
    }
    function group2()
    {
        $("#out_of_control_list").select2("open");
    }
    function group3()
    {
        $("#notification_list").select2("open");
    }
    function group4()
    {
        $("#approval_by").select2("open");
    }
    $(document).on("click",".submit_btn",function() {
        //$("#form_settings").submit(function() {

        var station = $("#station").val();
        var part_family = $("#part_family").val();
        var part_number = $("#part_number").val();
        var form_type = $("#form_type").val();
        var classification = $('input:radio[name=form_classification]:checked').val();
        var flag= 0;
        if(form_type == null){
            $("#error2").show();
            var flag= 1;
        }

        if(station == null){
            $("#error3").show();
            var flag= 1;
        }

        if(classification == 'event'){

            if(part_family == null){
                $("#error4").show();
                var flag= 1;
            }
            if(part_number == null){
                $("#error5").show();
                var flag= 1;
            }
        }


        if (flag == 1) {
            return false;
        }

    });

    $('#need_approval').on('change', function() {
        var app_value = $(this).val();
        if(app_value == "yes"){
            $("#approve_row").show();
        }
        if(app_value == "no"){
            $("#approve_row").hide();
        }
    });
    $( document ).ready(function() {
        // setInterval(function () {
        //     var link = document.getElementById('form_submit_btn');
        //     link.click();
        // }, 20000);
        $(".binary_section").hide();
        $(".list_section").hide();
        $("input[name='item']").click(function(){
            if($('input:radio[name=item]:checked').val() == "numeric"){
                $(".binary_section").hide();
                $(".list_section").hide();
                $(".numeric_section").show();
            }

            if($('input:radio[name=item]:checked').val() == "binary"){
                $(".numeric_section").hide();
                $(".list_section").hide();
                $(".binary_section").show();
            }

            if($('input:radio[name=item]:checked').val() == "text"){
                $(".numeric_section").hide();
                $(".list_section").hide();
                $(".binary_section").hide();
            }

            if($('input:radio[name=item]:checked').val() == "header"){
                $(".numeric_section").hide();
                $(".list_section").hide();
                $(".binary_section").hide();
            }
            if($('input:radio[name=item]:checked').val() == "list"){
                $(".numeric_section").hide();
                $(".binary_section").hide();
                $(".list_section").show();
            }


        })

        $(document).on("click","#add_more",function() {
            //var html_content = '<div class="qry_section"><button type="button" name="add_more" id="add_more" class="btn btn-primary legitRipple" style="background-color:#1e73be">Add More Query</button><div class="row"><div class="col-md-2"><label for="query_text">Query Text :</label></div><div class="col-md-6"><input class="form-control" name="query_text" id="query_text" autocomplete="off" placeholder="Enter Query" required></div></div><br><div class="row"><div class="col-md-2"><label for="item_class">ITEM CLASS:</label></div><div class="col-md-6"><div class="form-check form-check-inline"><input type="radio" id="numeric" name="item" value="numeric" class="form-check-input" checked><label for="numeric" class="item_label">Numeric</label><input type="radio" id="binary" name="item" value="binary" class="form-check-input"><label for="binary" class="item_label">Binary</label><input type="radio" id="text" name="item" value="text" class="form-check-input"><label for="text" class="item_label">Text</label><input type="radio" id="header" name="item" value="header" class="form-check-input"><label for="header" class="item_label">Header</label></div></div></div><br><div class="numeric_section"><div class="row"><div class="col-md-2"><label for="normal">Normal:</label></div><div class="col-md-6"><input class="form-control" name="normal" id="normal" autocomplete="off"></div></div><br><div class="row"><div class="col-md-2"><label for="lower_tolerance">LowerTolerance:</label></div><div class="col-md-6"><input class="form-control" name="lower_tolerance" id="lower_tolerance" autocomplete="off"></div></div><br><div class="row"><div class="col-md-2"><label for="upper_tolerance">UpperTolerance:</label></div><div class="col-md-6"><input class="form-control" name="upper_tolerance" id="upper_tolerance" autocomplete="off"></div></div><br></div><div class="binary_section" id="binary_"><div class="row"><div class="col-md-2"><label for="default">Default:</label></div><div class="col-md-6"><div class="form-check form-check-inline"><input type="radio" id="none" name="default_binary" value="none" class="form-check-input" checked><label for="none" class="item_label">None</label><input type="radio" id="yes" name="default_binary" value="yes" class="form-check-input"><label for="yes" class="item_label">Yes</label><input type="radio" id="no" name="default_binary" value="no" class="form-check-input"><label for="no" class="item_label">No</label></div></div></div><br><div class="row"><div class="col-md-2"><label for="normal">Normal:</label></div><div class="col-md-6"><div class="form-check form-check-inline"><input type="radio" id="yes" name="normal_binary" value="yes" class="form-check-input" checked><label for="yes" class="item_label">Yes</label><input type="radio" id="no" name="normal_binary" value="no" class="form-check-input"><label for="no" class="item_label">No</label></div></div></div><div class="row"><div class="col-md-2"><label for="yes_alias">Yes Alias:</label></div><div class="col-md-6"><input class="form-control" name="yes_alias" id="yes_alias" autocomplete="off"></div></div><div class="row"><div class="col-md-2"><label for="no_alias">No Alias:</label></div><div class="col-md-6"><input class="form-control" name="no_alias" id="no_alias" autocomplete="off"></div></div></div><div class="row"><div class="col-md-2"><label for="notes">Notes:</label></div><div class="col-md-6"><textarea class="form-control" aria-label="With textarea" id="notes" name="notes" autocomplete="off"></textarea></div></div></div>';
            var i = $('#collapse_id').val();
            var collapse_id = "collapse"+i;
            var count = i;
            $("#click_id").val(count);
            var html_content = '<div class="rowitem_'+count+'"><br/><div class="contextMenu"><button type="button" id="moveup" class="btn"><i class="fa fa-angle-up"></i></button><button type="button" id="movedown" class="btn"><i class="fa fa-angle-down"></i></button></div><div class="panel panel-default"><div class="panel-heading"><h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion" href="#'+collapse_id+'">Form Item ' + i + '</a><button type="button" name="remove_btn" class="btn btn-danger btn-xs remove_btn" id="btn_id' + i + '" data-id="' + i + '">-</button></h4></div><div id="'+collapse_id+'" class="panel-collapse collapse in"><div class="panel-body"><div class="qry_section" id="section_' + count + '"><div class="row"><div class="col-md-2"><input type="checkbox" id="optional_' + count + '[]" name="optional_' + count + '[]" class="checkbx" style="margin-right:15px;"/>Optional</div></div></br><div class="row"><label class="col-lg-2 control-label" for="query_text">Item Description :</label><div class="col-md-6"><input class="form-control" name="query_text[]" id="query_text" autocomplete="off" placeholder="Form Item Description" required></div></div><br><div class="row"><label class="col-lg-2 control-label" for="item_class">Form Item Type:</label><div class="col-md-6"><div class="form-check form-check-inline"><input type="radio" id="numeric_' + count + '" name="item_' + count + '[]" value="numeric" data-name="numeric_' + count + '" class="form-check-input" checked> <label for="numeric" class="item_label">Numeric</label> <input type="radio" id="binary_' + count + '" name="item_' + count + '[]" value="binary" data-name="binary_' + count + '" class="form-check-input"> <label for="binary" class="item_label">Binary</label> <input type="radio" id="text_' + count + '_' + count + '" name="item_' + count + '[]" value="text" data-name="text_' + count + '" class="form-check-input"> <label for="text" class="item_label">Text</label> <input type="radio" id="header" name="item_' + count + '[]" value="header" data-name="header_' + count + '" class="form-check-input"> <label for="header" class="item_label">Header</label><input type="radio" id="list_' + count + '" name="item_' + count + '[]" value="list" data-name="list_' + count + '" class="form-check-input"><label for="list" class="item_label">List</label></div></div></div><br><div class="numeric_section" id="numericsection_'+count+'"><div class="row"><label class="col-lg-2 control-label" for="measurement">Measurement Unit:</label><div class="col-md-6"><select class="select form-control"  data-style="bg-slate" name="unit_of_measurement[]" id="unit_of_measurement' + count + '"></select></div></div><br/><div class="row"><label class="col-lg-2 control-label" for="normal">Nominal:</label><div class="col-md-6"><input class="form-control" name="normal[]" id="normal" autocomplete="off"></div></div><br><div class="row"><label class="col-lg-2 control-label" for="lower_tolerance"> LowerTolerance:</label><div class="col-md-6"><input class="form-control" name="lower_tolerance[]" id="lower_tolerance" autocomplete="off"></div></div><br><div class="row"><label class="col-lg-2 control-label" for="upper_tolerance">UpperTolerance:</label><div class="col-md-6"><input class="form-control" name="upper_tolerance[]" id="upper_tolerance" autocomplete="off"></div></div><br><!--<div class="row"><label class="col-lg-2 control-label" for="upper_tolerance">Graph Required:</label><div class="col-md-6"> <input type="radio" id="yes_n" name="graph_numeric_' + count + '[]" value="yes" class="form-check-input" checked><label for="yes" class="item_label">Yes</label><input type="radio" id="no_n" name="graph_numeric_' + count + '[]" value="no" class="form-check-input"><label for="no" class="item_label">No</label></div></div><br>--></div><div class="binary_section" id="binarysection_'+count+'"><div class="row"><label class="col-lg-2 control-label" for="default">Default:</label><div class="col-md-6"><div class="form-check form-check-inline"><input type="hidden" name="bansi_row_click[]"  value='+ count +' ><input type="radio" id="none" name="default_binary_' + count + '[]" value="none" class="form-check-input" checked> <label for="none" class="item_label">None</label> <input type="radio" id="yes" name="default_binary_' + count + '[]" value="yes" class="form-check-input"> <label for="yes" class="item_label">Yes</label> <input type="radio" id="no" name="default_binary_' + count + '[]" value="no" class="form-check-input"> <label for="no" class="item_label">No</label></div></div></div><br><!--<div class="row"><label class="col-lg-2 control-label" for="graph">Graph Required:</label><div class="col-md-6"><div class="form-check form-check-inline"><input type="radio" id="yes" name="graph_binary_' + count + '[]" value="yes" class="form-check-input" checked> <label for="yes" class="item_label">Yes</label> <input type="radio" id="no" name="graph_binary_' + count + '[]" value="no" class="form-check-input"> <label for="no" class="item_label">No</label></div></div></div><br>--><div class="row"><label class="col-lg-2 control-label item_label" for="normal">Nominal:</label><div class="col-md-6"><div class="form-check form-check-inline"><input type="radio" id="yes" name="normal_binary_' + count + '[]" value="yes" class="form-check-input" checked> <label for="yes" class="item_label">Yes</label> <input type="radio" id="no" name="normal_binary_' + count + '[]" value="no" class="form-check-input"> <label for="no" class="item_label">No</label></div></div></div><br><div class="row"><label class="col-lg-2 control-label" for="yes_alias">Yes Alias:</label><div class="col-md-6"><input class="form-control" name="yes_alias[]" id="yes_alias" autocomplete="off"></div></div><div class="row"><label class="col-lg-2 control-label item_label"  for="no_alias">No Alias:</label><div class="col-md-6"><input class="form-control" name="no_alias[]" id="no_alias" autocomplete="off"></div></div></div><div class="list_section" id="listsection_'+count+'"><div class="row"><label class="col-lg-2 control-label" for="default">Values:</label><div class="col-md-6"><div class="form-check form-check-inline"><input type="radio" id="yes" name="default_list_' + count + '[]" value="yes" class="form-check-input custom-control-input" checked><input type="search" name="radio_list_yes[]" id="radio_list_yes[]" placeholder="Option1" class="radio_input" ><input type="radio" id="no" name="default_list_' + count + '[]" value="no" class="form-check-input custom-control-input"><input type="search" name="radio_list_no[]" id="radio_list_no" placeholder="Option2" class="radio_input"><div class="list_none" id="listnone_' + count + '" style="display:none" > <input type="radio" id="none" name="default_list_' + count + '[]" value="none" class="form-check-input custom-control-input" ><input type="search" disabled name="radio_list_none_' + count + '[]" id="radio_list_none_' + count + '[]" placeholder="Option3" class="radio_input"></div><div class="custom-control custom-radio" id="add_other_' + count + '"></div><div class="custom-control custom-radio add_other_options_' + count + '" name="add_other_options" id="add_other_options"></div>  <input type="hidden" name="add_option_id"  id="add_option_id" value="0"><br/> <button type="button" class="add_option_btn btn btn-primary legitRipple" id="add_other_' + count + '" style="background-color:#1e73be;"><i class="fa fa-plus" aria-hidden="true"></i></button></div></div></div></div><br><div class="row"><label class="col-lg-2 control-label" for="default">Value Evaluation Enabled:</label><div class="col-md-6"><div class="form-check form-check-inline"> <input type="checkbox" class="checkbox-control evaluation_enabled" name="list_enabled_' + count + '[]" id="listenabled_' + count + '"></div></div></div></div><br><div class="row"><label class="col-lg-2 control-label item_label" for="notes">Notes:</label><div class="col-md-6"><textarea class="form-control" aria-label="With textarea" id="notes" name="form_item_notes[]" autocomplete="off"></textarea></div></div><br/><div class="row"><label class="col-lg-2 control-label item_label" for="disc">Description:</label><div class="col-md-6"><textarea class="form-control" aria-label="With textarea" id="disc" name="form_item_disc[]" autocomplete="off"></textarea></div></div></div></div></div></div></div>';
            $( ".query_rows" ).append( html_content );
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
            $("#binarysection_"+count).hide();
            $("#listsection_"+count).hide();
            document.getElementById("collapse_id").value = parseInt(i) + 1;
        });

        $(document).on("click","#moveup",function() {
            var parentDiv = $(this).closest('div.contextMenu').parent();
            parentDiv.insertBefore( parentDiv.prev() )
        });

        $(document).on("click","#movedown",function() {
            var parentDiv = $(this).closest('div.contextMenu').parent();
            parentDiv.insertAfter( parentDiv.next() )
        });

    });
    // $(document).on("change",input[type='radio']",function() {
    //$("input[type='radio']").change(function(){


    $(document).on("click",".remove_btn",function() {

        var row_id = $(this).attr("data-id");
        $(".rowitem_"+row_id).remove();

    });


    $(document).on("click",'input:radio',function() {

        var radio_val = $(this).val();
// var radio_txt = radio_val.split("_")[0];
// var radio_id = radio_val.split("_")[1];

        var radio_txt = $(this).data("name").split("_")[0];
        var radio_id = $(this).data("name").split("_")[1];

//alert(radio_id);

        if( radio_txt == "numeric"){
            $("#binarysection_"+radio_id).hide();
            $("#listsection_"+radio_id).hide();
            $("#numericsection_"+radio_id).show();
        }
        if( radio_txt == "binary"){

            $("#numericsection_"+radio_id).hide();
            $("#listsection_"+radio_id).hide();
            $("#binarysection_"+radio_id).show();


        }
        if( radio_txt == "text"){

            $("#numericsection_"+radio_id).hide();
            $("#listsection_"+radio_id).hide();
            $("#binarysection_"+radio_id).hide();

        }
        if( radio_txt == "header"){
            $("#numericsection_"+radio_id).hide();
            $("#listsection_"+radio_id).hide();
            $("#binarysection_"+radio_id).hide();
        }
        if( radio_txt == "list"){
            $("#numericsection_"+radio_id).hide();
            $("#binarysection_"+radio_id).hide();
            $("#listsection_"+radio_id).show();
        }
    })

</script>
<script>
    $("#file-input").on("change", function () {
        var fd = new FormData();
        var files = $('#file-input')[0].files[0];
        fd.append('file', files);
        fd.append('request', 1);

        // AJAX request
        $.ajax({
            url: 'add_delete_form_image.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function (response) {

                if (response != 0) {
                    var count = $('.container .content_img').length;
                    count = Number(count) + 1;

                    // Show image preview with Delete button
                    $('.container').append("<div class='content_img' id='content_img_" + count + "' ><img src='" + response + "' width='100' height='100'><span class='delete' id='delete_" + count + "'>Delete</span></div>");
                }
            }
        });
    });


    // Remove file
    $('.container').on('click', '.content_img .delete', function () {

        var id = this.id;
        var split_id = id.split('_');
        var num = split_id[1];
        // Get image source
        var imgElement_src = $('#content_img_' + num)[0].children[0].src;
        //var deleteFile = confirm("Do you really want to Delete?");
        console.log(imgElement_src);
        var succ = false;
        // AJAX request
        $.ajax({
            url: 'add_delete_form_image.php',
            type: 'post',
            data: {path: imgElement_src, request: 2},
            async: false,
            success: function (response) {
                // Remove <div >
                if (response == 1) {
                    succ = true;
                }
            }, complete: function (data) {
                if (succ) {
                    var id = 'content_img_' + num;
                    // $('#content_img_'+num)[0].remove();
                    var elem = document.getElementById(id);
                    document.getElementById(id).style.display = 'none';
                    var nodes = $(".container")[2].childNodes;
                    for (var i = 0; i < nodes.length; i++) {
                        var node = nodes[i];
                        if (node.id == id) {
                            node.style.display = 'none';
                        }
                    }
                }
            }
        });
    });

</script>
<script>

        $(document).on('change', 'input[type="checkbox"]', function (e) {
            // var index = this.id.split("_")[1];
            // var checkBox = document.getElementById("listenabled_" + index);
            // var text = document.getElementById("listnone_" + index);
            // if (checkBox.checked == true) {
            //     text.style.display = "block";
            // } else {
            //     text.style.display = "none";
            // }

            var index = this.id.split("_")[1];
            var checkBox = document.getElementById("listenabled_" + index);
            var text = document.getElementById("listnone_" + index);
            var extraCount = 0;
            var list_none = 0;
            if(null != this.parentElement.parentElement.parentElement.parentElement.getElementsByClassName('list_section')){
                extraCount = this.parentElement.parentElement.parentElement.parentElement.getElementsByClassName('list_section')[0].querySelectorAll('#extra').length;
                //list_none = this.parentElement.parentElement.parentElement.parentElement.getElementsByClassName('list_section')[0].getElementsByClassName('list_none').length;
            }
            if((null != document.getElementById("radio_list_none_" + index + "[]")) &&(document.getElementById("radio_list_none_" + index + "[]").disabled == false)){
                list_none = 1;
            }
            if ((checkBox.checked == true) && (((extraCount == 0) && (list_none == 0)) || ((extraCount > 0)  && (list_none == 1)) )) {
                // document.getElementById("listnone_" + index).disabled = false;
                // document.getElementById("radio_list_extra[]").disabled = false;
                document.getElementById("radio_list_none_" + index + "[]").disabled = false;
                text.style.display = "block";
            } else {
                // document.getElementById("listnone_" + index).attr('disabled', 'disabled');
                // document.getElementById("listnone_" + index).disabled = true;
                // document.getElementById("radio_list_extra[]").disabled = true;
                document.getElementById("radio_list_none_" + index + "[]").disabled = true;
                text.style.display = "none";
            }

        });

</script>
<!--<script>-->
<!--    var rowNum = 0;-->
<!--    $(document).on("click",".add_option",function() {-->
<!--        var index = this.id.split("_")[2];-->
<!--        rowNum++;-->
<!--        $('#add_other_' + index).append('<div id="list_' + index + '">' + '<input type="radio" class="custom-control-input" name="default_list_' + index + '[]" value="radio_extra_' + rowNum + '[]">' + '<input type="search" name="radio_list_extra[]" id="radio_list_extra[]" value="" class="radio_input">' + '<button class="remove" onclick="removeDiv(this);">X</button>' + "</div>");-->
<!--        // $('#add_other_' + index).append('<div class="custom-control custom-radio" id="add_other_' + count + '"></div><div id="list_' + index + '">' + '<input type="radio" class="custom-control-input" name="default_list_' + index + '[]" value="radio_extra_' + index + '[]">' + '<input type="search" name="radio_list_extra[]" id="radio_list_extra[]" value="" class="radio_input">' + '<button class="remove" onclick="removeDiv(this);">X</button>' + "</div>");-->
<!--    });-->
<!---->
<!--    function removeDiv(btn) {-->
<!--        ((btn.parentNode).parentNode).removeChild(btn.parentNode);-->
<!--    }</script>-->
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
        $('.add_other_options_' + index1 + '').append('<div id="add_other_' + op_val + '">' + '<input type="radio" class="custom-control-input" id="extra" name="default_list_' + index1 + '[]" value="extra_' + op_val + '" class="form-check-input">' + '<input type="search" name="radio_list_extra_' + index1 + '[]" id="radio_list_extra_' + index1 + '[]" value="" class="radio_input">' + '<button class="remove" onclick="removeDiv(this);">X</button>' + "</div>");

    });
    function removeDiv(btn) {
        ((btn.parentNode).parentNode).removeChild(btn.parentNode);
    }

</script>
<?php include('../footer.php') ?>
</body>

</html>