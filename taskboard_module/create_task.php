<?php
include("../config.php");
if (!isset($_SESSION['user'])) {
    header('location: ../logout.php');
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
$temp = "";
if (count($_POST) > 0) {
    $taskboard = $_POST['taskboard'];
    $equipment = $_POST['equipment'];
//    $description = $_POST['description'];
    $property = $_POST['property'];
    $building = $_POST['building'];
    $priority = $_POST['priority'];
    $duration_hh = $_POST['duration_hh'];
    $duration_mm = $_POST['duration_mm'];
    $comment = $_POST['comment'];
    $i = $_SESSION["role_id"];
    if ($i == "super" || $i == "admin") {
        $user_name = $_POST['user_name'];
    } else {
        $user_name = $_POST['user_name1'];
    }
    $dur = $duration_hh . ":" . $duration_mm;
    $assign_time = date("Y-m-d H:i:s");
    $assign_by = $_SESSION["id"];
    if ($taskboard != "") {


        $sql0 = "INSERT INTO `tm_task`(`taskboard`,`assign_to` , `equipment` ,  `property` , `building` , `priority` , `duration` , `comment` , `assigned_by` , `assigned_time` , `status` ) VALUES 
('$taskboard','$user_name','$equipment','$property','$building','$priority','$dur','$comment','$assign_by','$assign_time','1')";
        $result0 = mysqli_query($db, $sql0);

        $qur04 = mysqli_query($db, "SELECT * FROM  sg_taskboard where `sg_taskboard_id` = '$taskboard' ");
        $rowc04 = mysqli_fetch_array($qur04);
        $taskboard_name = $rowc04["taskboard_name"];

        $qur04 = mysqli_query($db, "SELECT * FROM  cam_users where `users_id` = '$user_name' ");
        $rowc04 = mysqli_fetch_array($qur04);
        $fullname = $rowc04["firstname"]." ".$rowc04["lastname"];

        $qur04 = mysqli_query($db, "SELECT * FROM  tm_equipment where `tm_equipment_id` = '$equipment' ");
        $rowc04 = mysqli_fetch_array($qur04);
        $equipment_name = $rowc04["tm_equipment_name"];

        $qur04 = mysqli_query($db, "SELECT * FROM  tm_property where `tm_property_id` = '$property' ");
        $rowc04 = mysqli_fetch_array($qur04);
        $property_name = $rowc04["tm_property_name"];

        $qur04 = mysqli_query($db, "SELECT * FROM  tm_building where `tm_building_id` = '$building' ");
        $rowc04 = mysqli_fetch_array($qur04);
        $building_name = $rowc04["tm_building_name"];

        $qur04 = mysqli_query($db, "SELECT * FROM  cam_users where `users_id` = '$assign_by' ");
        $rowc04 = mysqli_fetch_array($qur04);
        $assign_fullname = $rowc04["firstname"]." ".$rowc04["lastname"];


        if ($result0) {

            $sql1 = "INSERT INTO `tm_task_log`
(`taskboard`,`taskboard_name`,`assign_to` ,`assign_to_name`, `equipment` , `equipment_name` ,`property` , `property_name` , `building` ,  `building_name` ,`priority` , `duration` , `comment` , `assigned_by` , `assigned_by_name` , `assigned_time` , `status` ) VALUES 
('$taskboard','$taskboard_name','$user_name','$fullname','$equipment','$equipment_name','$property','$property_name','$building','$building_name','$priority','$dur','$comment','$assign_by','$assign_fullname','$assign_time','1')";

            $result01 = mysqli_query($db, $sql1);

            $message_stauts_class = 'alert-success';
            $import_status_message = 'Task created successfully.';
        } else {
            $message_stauts_class = 'alert-danger';
            $import_status_message = 'Error: Please Insert valid data';
        }
////$temp = "one";
    }
    $edit_taskboard = $_POST['edit_taskboard'];
    if ($edit_taskboard != "") {
        $id = $_POST['edit_id'];
        $hrmm = $_POST['edit_hrmm'];
        $hour = $_POST['edit_hour'];
        $minu = $_POST['edit_minutes'];
        $dur = $hour . ":" . $minu;

        $qur04 = mysqli_query($db, "SELECT * FROM  sg_taskboard where `sg_taskboard_id` = '$_POST[edit_taskboard]' ");
        $rowc04 = mysqli_fetch_array($qur04);
        $taskboard_name = $rowc04["taskboard_name"];

        $qur04 = mysqli_query($db, "SELECT * FROM  cam_users where `users_id` = '$_POST[edit_assign_to]' ");
        $rowc04 = mysqli_fetch_array($qur04);
        $fullname = $rowc04["firstname"]." ".$rowc04["lastname"];

        $qur04 = mysqli_query($db, "SELECT * FROM  tm_equipment where `tm_equipment_id` = '$_POST[edit_equipment]' ");
        $rowc04 = mysqli_fetch_array($qur04);
        $equipment_name = $rowc04["tm_equipment_name"];


        $qur04 = mysqli_query($db, "SELECT * FROM  tm_property where `tm_property_id` = '$_POST[edit_property]' ");
        $rowc04 = mysqli_fetch_array($qur04);
        $property_name = $rowc04["tm_property_name"];

        $qur04 = mysqli_query($db, "SELECT * FROM  tm_building where `tm_building_id` = '$_POST[edit_building]' ");
        $rowc04 = mysqli_fetch_array($qur04);
        $building_name = $rowc04["tm_building_name"];

        $qur04 = mysqli_query($db, "SELECT * FROM  cam_users where `users_id` = '$assign_by' ");
        $rowc04 = mysqli_fetch_array($qur04);
        $assign_fullname = $rowc04["firstname"]." ".$rowc04["lastname"];


        if ($hrmm == $dur) {
            $sql = "update tm_task set taskboard='$_POST[edit_taskboard]',assigned_by='$assign_by',assign_to='$_POST[edit_assign_to]',equipment='$_POST[edit_equipment]',property='$_POST[edit_property]',building='$_POST[edit_building]',priority='$_POST[edit_priority]',comment='$_POST[edit_comment]'  where tm_task_id ='$id'";
            $result1 = mysqli_query($db, $sql);
            if ($result1) {

                $sql12 = "update tm_task_log set taskboard='$_POST[edit_taskboard]', taskboard_name = '$taskboard_name' ,assigned_by='$assign_by', assigned_by_name = '$assign_fullname', assign_to='$_POST[edit_assign_to]', assign_to_name = '$fullname', equipment='$_POST[edit_equipment]' , equipment_name = '$equipment_name' ,  property='$_POST[edit_property]',  property_name='$property_name', building='$_POST[edit_building]' , building_name = '$building_name' , priority='$_POST[edit_priority]',comment='$_POST[edit_comment]'  where tm_task_log_id ='$id'";
                $result112 = mysqli_query($db, $sql12);


                $message_stauts_class = 'alert-success';
                $import_status_message = 'Task Updated successfully.';
            } else {
                $message_stauts_class = 'alert-danger';
                $import_status_message = 'Error: Please Insert valid data';
            }
        } else {
            $sql = "update tm_task_log set taskboard='$_POST[edit_taskboard]',assigned_by='$assign_by',duration='$dur',assign_to='$_POST[edit_assign_to]',equipment='$_POST[edit_equipment]',property='$_POST[edit_property]',building='$_POST[edit_building]',priority='$_POST[edit_priority]',comment='$_POST[edit_comment]'  where tm_task_id ='$id'";
            $result1 = mysqli_query($db, $sql);
            if ($result1) {

                $sql12 = "update tm_task_log set duration='$dur',taskboard='$_POST[edit_taskboard]', taskboard_name = '$taskboard_name' ,assigned_by='$assign_by', assigned_by_name = '$assign_fullname', assign_to='$_POST[edit_assign_to]', assign_to_name = '$fullname', equipment='$_POST[edit_equipment]' , equipment_name = '$equipment_name' ,  property='$_POST[edit_property]',  property_name='$property_name', building='$_POST[edit_building]' , building_name = '$building_name' , priority='$_POST[edit_priority]',comment='$_POST[edit_comment]'  where tm_task_log_id ='$id'";
                $result112 = mysqli_query($db, $sql12);

                $message_stauts_class = 'alert-success';
                $import_status_message = 'Task Updated successfully.';
            } else {
                $message_stauts_class = 'alert-danger';
                $import_status_message = 'Error: Please Insert valid data';
            }
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo $sitename; ?> |Create Task</title>
    <!-- Global stylesheets -->

    <link href="../assets/css/core.css" rel="stylesheet" type="text/css">


    <!-- /global stylesheets -->
    <!-- Core JS files -->
    <!--    <script type="text/javascript" src="../assets/js/libs/jquery-3.6.0.min.js"> </script>-->
    <script type="text/javascript" src="../assets/js/form_js/jquery-min.js"></script>
    <script type="text/javascript" src="../assets/js/libs/jquery-3.4.1.min.js"></script>
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
        .mt-4 {
            margin-top: 0rem!important;
        }
        .col-lg-2{
            width:30%;
        }

        .col-lg-9{
            width:100%;
        }




        table.dataTable thead .sorting:after {
            content: ""!important;
            top: 49%;
        }
        .card-title:before{
            width: 0;

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

    </style>
</head>


<body class="ltr main-body app horizontal">


<!-- Main navbar -->
<?php
$cust_cam_page_header = "Create Task Board";
include("../header.php");
include("../admin_menu.php");
?>

<!-----body-------->
<!-----main content----->
<div class="main-content app-content">
    <div class="main-container container">

        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Admin Config</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Task</li>
                </ol>
            </div>
        </div>

        <form action="" id="user_form" class="form-horizontal" method="post">
            <div class="row">
                <div class="col-lg-12 col-md-12">

                    <div class="card">
                        <div class="">
                            <div class="card-header">
                                <span class="main-content-title mg-b-0 mg-b-lg-1">Create TaskBoard</span>
                            </div>

                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs">
                                    <div class="col-md-1">
                                        <label class="form-label mg-b-0">TaskBoard </label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <select name="taskboard" id="taskboard" class="form-control select2" data-style="bg-slate">
                                            <option value="" selected disabled>--- Select Taskboard ---</option>
                                            <?php
                                            $sql1 = "SELECT * FROM `sg_taskboard` order BY `taskboard_name`";
                                            $result1 = $mysqli->query($sql1);
                                            while ($row1 = $result1->fetch_assoc()) {
                                                echo "<option value='" . $row1['sg_taskboard_id'] . "' >" . $row1['taskboard_name'] . "</option>";
                                            }
                                            ?>
                                        </select>                                    </div>

                                    <div class="col-md-1"></div>
                                    <div class="col-md-1">
                                        <label class="form-label mg-b-0">Assign To</label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <input type="hidden" name="role_id" id="role_id" value="<?php echo $_SESSION["role_id"]; ?>">
                                        <?php
                                        $i = $_SESSION["role_id"];
                                        if ($i == "super" || $i == "admin") {
                                            ?>
                                            <div class="col-lg-9">
                                                <select name="user_name" id="user_name" class="select form-control" data-style="bg-slate">
                                                    <option value="" selected >--- Select User ---</option>
                                                </select>
                                            </div>
                                        <?php } else { ?>
                                            <div class="col-lg-9">
                                                <select name="user_name1" id="user_name1" class="form-control select2" data-style="bg-slate">
                                                    <?php
                                                    $iddd = $_SESSION["id"];
                                                    $sql1 = "SELECT * FROM `cam_users` where users_id = '$iddd' and is_deleted != 1 ";
                                                    $result1 = $mysqli->query($sql1);
                                                    while ($row1 = $result1->fetch_assoc()) {
                                                        echo "<option value='" . $row1['users_id'] . "' selected >" . $row1['user_name'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>


                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs">
                                    <div class="col-md-1">
                                        <label class="form-label mg-b-0">Building </label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <select name="building" id="building" class="form-control select2" data-style="bg-slate" >
                                            <option value="" selected disabled>--- Select Building ---</option>
                                            <?php
                                            $sql1 = "SELECT * FROM `tm_building` where is_deleted != 1 ORDER BY `tm_building_name` ASC ";
                                            $result1 = $mysqli->query($sql1);
                                            //                                            $entry = 'selected';
                                            while ($row1 = $result1->fetch_assoc()) {
                                                echo "<option value='" . $row1['tm_building_id'] . "'  >" . $row1['tm_building_name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-md-1"></div>
                                    <div class="col-md-1">
                                        <label class="form-label mg-b-0">Property</label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <select name="property" id="property" class="form-control select2" data-style="bg-slate" >
                                            <option value="" selected disabled>--- Select Property ---</option>
                                            <?php
                                            $sql1 = "SELECT * FROM `tm_property` where is_deleted != 1 ORDER BY `tm_property_name` ASC";
                                            $result1 = $mysqli->query($sql1);
                                            //                                            $entry = 'selected';
                                            while ($row1 = $result1->fetch_assoc()) {
                                                echo "<option value='" . $row1['tm_property_id'] . "'  >" . $row1['tm_property_name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>



                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs">
                                    <div class="col-md-1">
                                        <label class="form-label mg-b-0">Equipment </label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <select name="equipment" id="equipment" class="form-control select2" data-style="bg-slate" >
                                            <option value="" selected disabled>--- Select Equipment ---</option>
                                            <?php
                                            $sql1 = "SELECT * FROM `tm_equipment` where is_deleted != 1 ORDER BY `tm_equipment_name` ASC";
                                            $result1 = $mysqli->query($sql1);
                                            //                                            $entry = 'selected';
                                            while ($row1 = $result1->fetch_assoc()) {
                                                echo "<option value='" . $row1['tm_equipment_id'] . "'  >" . $row1['tm_equipment_name'] . "</option>";
                                            }
                                            ?>
                                        </select>                                    </div>

                                    <div class="col-md-1"></div>
                                    <div class="col-md-1">
                                        <label class="form-label mg-b-0">Priority</label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <select name="priority" id="priority" class="form-control select2" data-style="bg-slate" >
                                            <option value="" selected disabled>--- Select Priority ---</option>
                                            <option value="Low" >Low</option>
                                            <option value="Medium" >Medium</option>
                                            <option value="High" >High</option>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs">
                                    <div class="col-md-1">
                                        <label class="form-label mg-b-0">Duration </label>
                                    </div>
                                    <div class="col-md-2 ">
                                        <select name="duration_hh" id="duration_hh" class="form-control select2" >
                                            <option value=""  disabled>--- Select Hours ---</option>
                                            <option value="00" selected>00</option>
                                            <option value="01" >01</option>
                                            <option value="02" >02</option>
                                            <option value="03" >03</option>
                                            <option value="04" >04</option>
                                            <option value="05" >05</option>
                                            <option value="06" >06</option>
                                            <option value="07" >07</option>
                                            <option value="08" >08</option>
                                            <option value="09" >09</option>
                                            <option value="10" >10</option>
                                            <option value="11" >11</option>
                                            <option value="12" >12</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2">
                                        <select name="duration_mm" id="duration_mm" class="form-control select2" >
                                            <option value=""  disabled>--- Select Minutes ---</option>
                                            <option value="00" >00</option>
                                            <option value="15" selected>15</option>
                                            <option value="30" >30</option>
                                            <option value="45" >45</option>
                                        </select>
                                    </div>

                                    <div class="col-md-1"></div>
                                    <div class="col-md-1">
                                        <label class="form-label mg-b-0">Notes</label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <textarea id="comment" name="comment" rows="4" placeholder="Enter Notes..." class="form-control" ></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <button type="submit" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5 submit_btn">CREATE TASKBOARD</button>
                            </div>

                        </div>
                    </div>
        </form>
    </div>
</div>

<?php
$i = $_SESSION["role_id"];
if ($i == "super" || $i == "admin") {
    ?>


    <form action="delete_task.php" method="post" class="form-horizontal">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <button type="submit" class="btn btn-danger  submit_btn" style=""><i class="fa fa-trash-o" style="font-size:20px"></i></button>
                    </div>
                    <div class="card-body pt-0 example1-table">
                        <div class="table-responsive">
                            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table class="table datatable-basic table-bordered text-nowrap mb-0" id="example2">
                                            <thead>
                                            <tr>
                                                <th><label class="ckbox"><input type="checkbox" id="checkAll"><span></span></label></th>
                                                <th>S.No</th>
                                                <th>Taskboard</th>
                                                <th>Priority</th>
                                                <th>Assign To</th>
                                                <th>Building</th>
                                                <th>Property</th>
                                                <th>Equipment</th>
                                                <th>Duration</th>
                                                <th>Action</th>

                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $query = sprintf("SELECT * FROM  tm_task where status = '1' ");
                                            $qur = mysqli_query($db, $query);
                                            while ($rowc = mysqli_fetch_array($qur)) {
                                                $arrteam1 = explode(':', $rowc["duration"]);
                                                $hr = $arrteam1[0];
                                                $min = $arrteam1[1];
                                                ?>
                                                <tr>
                                                    <td><input type="checkbox" id="delete_check[]" name="delete_check[]" value="<?php echo $rowc["tm_task_id"]; ?>"></td>
                                                    <td><?php echo ++$counter; ?></td>
                                                    <?php
                                                    $station1 = $rowc['taskboard'];
                                                    $qurtemp = mysqli_query($db, "SELECT * FROM  sg_taskboard where sg_taskboard_id  = '$station1' ");
                                                    while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                                                        $station = $rowctemp["taskboard_name"];
                                                    }
                                                    ?>
                                                    <td><?php echo $station; ?></td>
                                                    <td><?php echo $rowc["priority"]; ?></td>
                                                    <?php
                                                    $station1 = $rowc['assign_to'];
                                                    $qurtemp = mysqli_query($db, "SELECT firstname,lastname FROM  cam_users where users_id  = '$station1' ");
                                                    while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                                                        $first = $rowctemp["firstname"];
                                                        $last = $rowctemp["lastname"];
                                                        $name = $first . " " . $last;
                                                    }
                                                    ?>                                        <td><?php echo $name; ?></td>
                                                    <?php
                                                    $station1 = $rowc['building'];
                                                    $qurtemp = mysqli_query($db, "SELECT * FROM  tm_building where tm_building_id  = '$station1' ");
                                                    while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                                                        $name = $rowctemp["tm_building_name"];
                                                    }
                                                    ?>                                        <td><?php echo $name; ?></td>
                                                    <?php
                                                    $station1 = $rowc['property'];
                                                    $qurtemp = mysqli_query($db, "SELECT * FROM  tm_property where tm_property_id  = '$station1' ");
                                                    while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                                                        $name = $rowctemp["tm_property_name"];
                                                    }
                                                    ?>                                        <td><?php echo $name; ?></td>
                                                    <?php
                                                    $station1 = $rowc['equipment'];
                                                    $qurtemp = mysqli_query($db, "SELECT * FROM  tm_equipment where tm_equipment_id  = '$station1' ");
                                                    while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                                                        $name = $rowctemp["tm_equipment_name"];
                                                    }
                                                    ?>                                        <td><?php echo $name; ?></td>
                                                    <td><?php echo $rowc["duration"]; ?></td>
                                                    <td>
                                                        <button type="button" id="edit" class="btn btn-info btn-xs" data-id="<?php echo $rowc['tm_task_id']; ?>" data-hrmm="<?php echo $rowc['duration']; ?>" data-taskboard="<?php echo $rowc['taskboard']; ?>" data-assign_to="<?php echo $rowc['assign_to']; ?>" data-equipment="<?php echo $rowc['equipment']; ?>" data-description="<?php echo $rowc['description']; ?>" data-property="<?php echo $rowc['property']; ?>" data-building="<?php echo $rowc['building']; ?>" data-priority="<?php echo $rowc['priority']; ?>" data-comment="<?php echo $rowc['comment']; ?>" data-hour="<?php echo $hr; ?>" data-minutes="<?php echo $min; ?>"  data-toggle="modal" style="background-color:#1e73be;" data-target="#edit_modal_theme_primary">Edit </button>&nbsp;
                                                        <button type="button" id="delete" class="btn btn-danger btn-xs" data-id="<?php echo $rowc['tm_task_id']; ?>">Finish</button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
    </form>
    </div>
    <?php
} else {
    ?>

    <div class="col-sm-12">
        <table class="table datatable-basic table-bordered text-nowrap mb-0" id="example2">
            <thead>
            <tr>
                <th><label class="ckbox"><input type="checkbox" id="checkAll"><span></span></label></th>
                <th>S.No</th>
                <th>Taskboard</th>
                <th>Priority</th>
                <th>Assign To</th>
                <th>Building</th>
                <th>Property</th>
                <th>Equipment</th>
                <th>Duration</th>
                <!--         <th>Created At</th>-->
                <th>Action</th>

            </tr>
            </thead>
            <tbody>
            <?php
            $usr = $_SESSION["id"];
            $query5 = sprintf("SELECT * FROM `sg_user_group` WHERE `user_id` = '$usr'");
            $qur5 = mysqli_query($db, $query5);
            while ($rowc5 = mysqli_fetch_array($qur5)) {
                $groupid = $rowc5["group_id"];
                $query55 = sprintf("SELECT * FROM `sg_taskboard` WHERE `group_id` = '$groupid'");
                $qur55 = mysqli_query($db, $query55);
                while ($rowc55 = mysqli_fetch_array($qur55)) {
                    $taskboardid = $rowc55["sg_taskboard_id"];
                    $query4 = sprintf("SELECT * FROM `sg_user_group` WHERE `group_id` = '$groupid'");
                    $qur4 = mysqli_query($db, $query4);
                    while ($rowc4 = mysqli_fetch_array($qur4)) {
                        $userid = $rowc4['user_id'];
                        $query = sprintf("SELECT * FROM  tm_task where status = '1' and assign_to = '$userid' and taskboard = '$taskboardid'");
                        $qur = mysqli_query($db, $query);
                        while ($rowc = mysqli_fetch_array($qur)) {
                            $disabled = "";
                            $tm_user = $_SESSION["id"];
                            if ($tm_user != $userid) {
                                $disabled = "disabled";
                            }
                            $arrteam1 = explode(':', $rowc["duration"]);
                            $hr = $arrteam1[0];
                            $min = $arrteam1[1];
                            ?>
                            <tr>
                                <td><?php echo ++$counter; ?></td>
                                <?php
                                $station1 = $rowc['taskboard'];
                                $qurtemp = mysqli_query($db, "SELECT * FROM  sg_taskboard where sg_taskboard_id  = '$station1' ");
                                while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                                    $station = $rowctemp["taskboard_name"];
                                }
                                ?>
                                <td><?php echo $station; ?></td>
                                <td><?php echo $rowc["priority"]; ?></td>
                                <?php
                                $station1 = $rowc['assign_to'];
                                $qurtemp = mysqli_query($db, "SELECT firstname,lastname FROM  cam_users where users_id  = '$station1' ");
                                while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                                    $first = $rowctemp["firstname"];
                                    $last = $rowctemp["lastname"];
                                    $name = $first . " " . $last;
                                }
                                ?>                                        <td><?php echo $name; ?></td>
                                <?php
                                $station1 = $rowc['building'];
                                $qurtemp = mysqli_query($db, "SELECT * FROM  tm_building where tm_building_id  = '$station1' ");
                                while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                                    $name = $rowctemp["tm_building_name"];
                                }
                                ?>                                        <td><?php echo $name; ?></td>
                                <?php
                                $station1 = $rowc['property'];
                                $qurtemp = mysqli_query($db, "SELECT * FROM  tm_property where tm_property_id  = '$station1' ");
                                while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                                    $name = $rowctemp["tm_property_name"];
                                }
                                ?>                                        <td><?php echo $name; ?></td>
                                <?php
                                $station1 = $rowc['equipment'];
                                $qurtemp = mysqli_query($db, "SELECT * FROM  tm_equipment where tm_equipment_id  = '$station1' ");
                                while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                                    $name = $rowctemp["tm_equipment_name"];
                                }
                                ?>                                        <td><?php echo $name; ?></td>
                                <td><?php echo $rowc["duration"]; ?></td>
                                <td>
                                    <button type="button" id="edit" <?php echo $disabled; ?> class="btn btn-info btn-xs" data-id="<?php echo $rowc['tm_task_id']; ?>" data-hrmm="<?php echo $rowc['duration']; ?>" data-taskboard="<?php echo $rowc['taskboard']; ?>" data-assign_to="<?php echo $rowc['assign_to']; ?>" data-equipment="<?php echo $rowc['equipment']; ?>" data-description="<?php echo $rowc['description']; ?>" data-property="<?php echo $rowc['property']; ?>" data-building="<?php echo $rowc['building']; ?>" data-priority="<?php echo $rowc['priority']; ?>" data-comment="<?php echo $rowc['comment']; ?>" data-hour="<?php echo $hr; ?>" data-minutes="<?php echo $min; ?>"  data-toggle="modal" style="background-color:#1e73be;" data-target="#edit_modal_theme_primary">Edit </button>&nbsp;
                                    <button type="button" id="delete" <?php echo $disabled; ?> class="btn btn-danger btn-xs" data-id="<?php echo $rowc['tm_task_id']; ?>">Finish</button>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                }
            }
            ?>

            </tbody>
        </table>
    </div>
<?php }
?>



<div id="edit_modal_theme_primary" class="modal">
    <div class="modal-dialog" style="width:100%">
        <div class="modal-content">
            <div class="card-header">
                <button type="button" style="color: white;font-size: 1.9125rem;" class="close" data-dismiss="modal">&times;</button>
                <span class="main-content-title mg-b-0 mg-b-lg-1">Update Task</span>
            </div>

            <form action="" id="user_form" enctype="multipart/form-data" class="form-horizontal"
                  method="post">
                <div class="card-body" style="width:100%;">
                    <div class="col-lg-12 col-md-12">
                        <div class="pd-30 pd-sm-20">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Taskboard</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <select name="edit_taskboard" id="edit_taskboard" class="form-control" data-style="bg-slate">
                                        <option value="" selected disabled>--- Select Taskboard ---</option>
                                        <?php
                                        $sql1 = "SELECT * FROM `sg_taskboard` order BY `taskboard_name`";
                                        $result1 = $mysqli->query($sql1);
                                        while ($row1 = $result1->fetch_assoc()) {
                                            echo "<option value='" . $row1['sg_taskboard_id'] . "' >" . $row1['taskboard_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <input type="hidden" name="edit_id" id="edit_id" >
                                    <input type="hidden" name="edit_hrmm" id="edit_hrmm" >

                                </div>
                            </div>
                        </div>



                        <div class="pd-30 pd-sm-20">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Assign to: </label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <select name="edit_assign_to" id="edit_assign_to" class="form-control" data-style="bg-slate">
                                        <option value="1" selected >--- Select User ---</option>
                                        <?php
                                        $sql1 = "SELECT * FROM `cam_users` WHERE `assigned2` = '0'  and `users_id` != '1' order BY `firstname`";
                                        $result1 = $mysqli->query($sql1);
                                        while ($row1 = $result1->fetch_assoc()) {
                                            $full = $row1['firstname'] . " " . $row1['lastname'];
                                            echo "<option value='" . $row1['users_id']  . "'> " . $row1["firstname"]." ".$row1["lastname"] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="pd-30 pd-sm-20">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Building:</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <select name="edit_building" id="edit_building" class="form-control"  data-style="bg-slate">
                                        <option value="" selected disabled>--- Select Building ---</option>
                                        <?php
                                        $sql1 = "SELECT * FROM `tm_building` ";
                                        $result1 = $mysqli->query($sql1);
                                        //                                            $entry = 'selected';
                                        while ($row1 = $result1->fetch_assoc()) {
                                            echo "<option value='" . $row1['tm_building_id'] . "'  >" . $row1['tm_building_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="pd-30 pd-sm-20">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Property:</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <select name="edit_property" id="edit_property" class="form-control" data-style="bg-slate" >
                                        <option value="" selected disabled>--- Select Property ---</option>
                                        <?php
                                        $sql1 = "SELECT * FROM `tm_property` ";
                                        $result1 = $mysqli->query($sql1);
                                        //                                            $entry = 'selected';
                                        while ($row1 = $result1->fetch_assoc()) {
                                            echo "<option value='" . $row1['tm_property_id'] . "'  >" . $row1['tm_property_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="pd-30 pd-sm-20">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Equipment:</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <select name="edit_equipment" id="edit_equipment" class="form-control" data-style="bg-slate" >
                                        <option value="" selected disabled>--- Select Equipment ---</option>
                                        <?php
                                        $sql1 = "SELECT * FROM `tm_equipment` ";
                                        $result1 = $mysqli->query($sql1);
                                        //                                            $entry = 'selected';
                                        while ($row1 = $result1->fetch_assoc()) {
                                            echo "<option value='" . $row1['tm_equipment_id'] . "'  >" . $row1['tm_equipment_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="pd-30 pd-sm-20">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Priority:</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <select name="edit_priority" id="edit_priority"  class="form-control" >
                                        <option value="" selected disabled>--- Select Priority ---</option>
                                        <option value="Low" >Low</option>
                                        <option value="Medium" >Medium</option>
                                        <option value="High" >High</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="pd-30 pd-sm-20">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Duration:</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <select name="edit_hour" id="edit_hour" class="form-control" >
                                        <option value="" selected disabled>--- Select Hours ---</option>
                                        <option value="00" >00</option>
                                        <option value="01" >01</option>
                                        <option value="02" >02</option>
                                        <option value="03" >03</option>
                                        <option value="04" >04</option>
                                        <option value="05" >05</option>
                                        <option value="06" >06</option>
                                        <option value="07" >07</option>
                                        <option value="08" >08</option>
                                        <option value="09" >09</option>
                                        <option value="10" >10</option>
                                        <option value="11" >11</option>
                                        <option value="12" >12</option>
                                    </select>
                                </div>
                                <div class="col-lg-4">
                                    <select name="edit_minutes" id="edit_minutes" class="form-control" >
                                        <option value="" selected disabled>--- Select Minutes ---</option>
                                        <option value="00" >00</option>
                                        <option value="15" >15</option>
                                        <option value="30" >30</option>
                                        <option value="45" >45</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="pd-30 pd-sm-20">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Notes:</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <textarea id="edit_comment" name="edit_comment" rows="4" placeholder="Enter Notes..." class="form-control" ></textarea>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </form>

        </div>
    </div>
</div></div>
</div>
</div>
</div>

</div>
</div>
</div>

<script> $(document).on('click', '#delete', function () {
        var element = $(this);
        var del_id = element.attr("data-id");
        var info = 'id=' + del_id;
        $.ajax({type: "POST", url: "finish_task_ajax.php", data: info, success: function (data) {
                location.reload();
            }});
        $(this).parents("tr").animate({backgroundColor: "#003"}, "slow").animate({opacity: "hide"}, "slow");
    });</script>
<script>
    jQuery(document).ready(function ($) {
        $(document).on('click', '#edit', function () {
            var element = $(this);
            var edit_id = element.attr("data-id");
            var taskboard = $(this).data("taskboard");
            var assign_to = $(this).data("assign_to");
            var equipment = $(this).data("equipment");
            var property = $(this).data("property");
            var building = $(this).data("building");
            var priority = $(this).data("priority");
            var comment = $(this).data("comment");
            var hour = $(this).data("hour");
            var minutes = $(this).data("minutes");
            var hrmm = $(this).data("hrmm");
            $("#edit_taskboard").val(taskboard);
            $("#edit_id").val(edit_id);
            $("#edit_assign_to").val(assign_to);
            $("#edit_equipment").val(equipment);
            $("#edit_property").val(property);
            $("#edit_building").val(building);
            $("#edit_priority").val(priority);
            $("#edit_comment").val(comment);
            $("#edit_hour").val(hour);
            $("#edit_minutes").val(minutes);
            $("#edit_hrmm").val(hrmm);

            // Load Taskboard
            const sb1 = document.querySelector('#edit_taskboard');
            var options1 = sb1.options;
            $('#edit_modal_theme_primary .select2 .selection select2-selection select2-selection--single .select2-selection__choice').remove();
            for (var i = 0; i < options1.length; i++) {
                if(taskboard == (options1[i].value)){ // EDITED THIS LINE
                    options1[i].selected="selected";
                    options1[i].className = ("select2-results__option--highlighted");
                    var opt = options1[i].outerHTML.split(">");
                    $('#select2-results .select2-results__option').prop('selectedIndex',i);
                    var gg = '<span class="select2-selection__rendered" id="select2-edit_taskboard-container" title="' + opt[1].replace('</option','') + '">' + opt[1].replace('</option','') + '</span>';
                    $("#select2-edit_taskboard-container")[0].outerHTML = gg;
                }
            }

            // Assign To
            const sb2 = document.querySelector('#edit_assign_to');
            var options1 = sb2.options;
            $('#edit_modal_theme_primary .select2 .selection select2-selection select2-selection--single .select2-selection__choice').remove();
            for (var i = 0; i < options1.length; i++) {
                if(assign_to == (options1[i].value)){ // EDITED THIS LINE
                    options1[i].selected="selected";
                    options1[i].className = ("select2-results__option--highlighted");
                    var opt = options1[i].outerHTML.split(">");
                    $('#select2-results .select2-results__option').prop('selectedIndex',i);
                    var gg = '<span class="select2-selection__rendered" id="select2-edit_assign_to-container" title="' + opt[1].replace('</option','') + '">' + opt[1].replace('</option','') + '</span>';
                    $("#select2-edit_assign_to-container")[0].outerHTML = gg;
                }
            }

            // Building
            const sb3 = document.querySelector('#edit_building');
            var options1 = sb3.options;
            $('#edit_modal_theme_primary .select2 .selection select2-selection select2-selection--single .select2-selection__choice').remove();
            for (var i = 0; i < options1.length; i++) {
                if(building == (options1[i].value)){ // EDITED THIS LINE
                    options1[i].selected="selected";
                    options1[i].className = ("select2-results__option--highlighted");
                    var opt = options1[i].outerHTML.split(">");
                    $('#select2-results .select2-results__option').prop('selectedIndex',i);
                    var gg = '<span class="select2-selection__rendered" id="select2-edit_building-container" title="' + opt[1].replace('</option','') + '">' + opt[1].replace('</option','') + '</span>';
                    $("#select2-edit_building-container")[0].outerHTML = gg;
                }
            }

            // Property
            const sb4 = document.querySelector('#edit_property');
            var options1 = sb4.options;
            $('#edit_modal_theme_primary .select2 .selection select2-selection select2-selection--single .select2-selection__choice').remove();
            for (var i = 0; i < options1.length; i++) {
                if(property == (options1[i].value)){ // EDITED THIS LINE
                    options1[i].selected="selected";
                    options1[i].className = ("select2-results__option--highlighted");
                    var opt = options1[i].outerHTML.split(">");
                    $('#select2-results .select2-results__option').prop('selectedIndex',i);
                    var gg = '<span class="select2-selection__rendered" id="select2-edit_property-container" title="' + opt[1].replace('</option','') + '">' + opt[1].replace('</option','') + '</span>';
                    $("#select2-edit_property-container")[0].outerHTML = gg;
                }
            }

            // Equipment
            const sb5 = document.querySelector('#edit_equipment');
            var options1 = sb5.options;
            $('#edit_modal_theme_primary .select2 .selection select2-selection select2-selection--single .select2-selection__choice').remove();
            for (var i = 0; i < options1.length; i++) {
                if(equipment == (options1[i].value)){ // EDITED THIS LINE
                    options1[i].selected="selected";
                    options1[i].className = ("select2-results__option--highlighted");
                    var opt = options1[i].outerHTML.split(">");
                    $('#select2-results .select2-results__option').prop('selectedIndex',i);
                    var gg = '<span class="select2-selection__rendered" id="select2-edit_equipment-container" title="' + opt[1].replace('</option','') + '">' + opt[1].replace('</option','') + '</span>';
                    $("#select2-edit_equipment-container")[0].outerHTML = gg;
                }
            }

            // Priority
            const sb6 = document.querySelector('#edit_priority');
            var options1 = sb6.options;
            $('#edit_modal_theme_primary .select2 .selection select2-selection select2-selection--single .select2-selection__choice').remove();
            for (var i = 0; i < options1.length; i++) {
                if(priority == (options1[i].value)){ // EDITED THIS LINE
                    options1[i].selected="selected";
                    options1[i].className = ("select2-results__option--highlighted");
                    var opt = options1[i].outerHTML.split(">");
                    $('#select2-results .select2-results__option').prop('selectedIndex',i);
                    var gg = '<span class="select2-selection__rendered" id="select2-edit_priority-container" title="' + opt[1].replace('</option','') + '">' + opt[1].replace('</option','') + '</span>';
                    $("#select2-edit_priority-container")[0].outerHTML = gg;
                }
            }

            var temp = "";
            var stateID = $(this).data("taskboard");
            $.ajax({
                url: "retrive_taskboard_user.php",
                dataType: 'Json',
                data: {'campus': stateID},
                success: function (data) {
                    $('#edit_assign_to').empty();
                    $('#edit_assign_to').append('<option value="" selected disabled>--- Select Users ---</option>');
                    $.each(data, function (key, value) {
                        if (value.id == assign_to)
                        {
                            temp = "selected";
                        } else
                        {
                            temp = "";
                        }
                        $('#edit_assign_to').append('<option value="' + value.id + '" ' + temp + '>' + value.name + '</option>');
                    });
                }
            });
            //alert(role);
        });
    });
    $(document).on('change', '.select_st', function () {
        var stateID = $(this).val();
        //	var dataid = $(this).attr('data-id');
        //alert("You have selected the country - " + stateID);
        $.ajax({
            url: "retrive_taskboard_user.php",
            dataType: 'Json',
            data: {'campus': stateID},
            success: function (data) {
                $('#user_name').empty();
                $('#user_name').append('<option value="" selected disabled>--- Select Users ---</option>');
                $.each(data, function (key, value) {
                    $('#user_name').append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            }
        });
    });
    $(document).on('change', '.select_st1', function () {
        var stateID = $(this).val();
        //	var dataid = $(this).attr('data-id');
        //alert("You have selected the country - " + stateID);
        $.ajax({
            url: "retrive_taskboard_user.php",
            dataType: 'Json',
            data: {'campus': stateID},
            success: function (data) {
                $('#edit_assign_to').empty();
                $('#edit_assign_to').append('<option value="" selected disabled>--- Select Users ---</option>');
                $.each(data, function (key, value) {
                    $('#edit_assign_to').append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            }
        });
    });
</script>
<script>
    window.onload = function() {
        history.replaceState("", "", "<?php echo $scriptName; ?>taskboard_module/create_task.php");
    }
</script>

<script>
    $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
    //$( "#user_form" ).submit(function(event){
    $(document).on('submit', '#user_form', function () {
        $(".red").text("");
        //var taskboard = $("#taskboard").val();
        var taskboard = document.getElementById("taskboard").value;
        var building = document.getElementById("building").value;
        var property = document.getElementById("property").value;
        var equipment = document.getElementById("equipment").value;
        var priority = document.getElementById("priority").value;
        var i = document.getElementById("role_id").value;
        if (i == "super" || i == "admin")
        {
            var user_name = document.getElementById("user_name").value;
        } else
        {
            var user_name1 = document.getElementById("user_name1").value;
        }
        if (taskboard == "")
        {
            document.getElementById("error1").innerHTML = "Please Select Taskboard";
            var flag = 0;
        }
        if (building == "")
        {
            document.getElementById("error3").innerHTML = "Please Select Building";
            var flag = 0;
        }
        if (property == "")
        {
            document.getElementById("error4").innerHTML = "Please Select Property";
            var flag = 0;
        }

        if (equipment == "")
        {
            document.getElementById("error6").innerHTML = "Please Select Equipment";
            var flag = 0;
        }
        if (priority == "")
        {
            document.getElementById("error7").innerHTML = "Please Select Priority";
            var flag = 0;
        }
        if (i == "super" || i == "admin")
        {
            if (user_name == "")
            {
                document.getElementById("error21").innerHTML = "Please Select User";
                var flag = 0;
            }
        } else
        {
            if (user_name1 == "")
            {
                document.getElementById("error22").innerHTML = "Please Select User";
                var flag = 0;
            }
        }
        if (flag == 0) {
            return false;
        }
    });
</script>
</div>
</div>

<?php include ('../footer1.php') ?>

</body>
