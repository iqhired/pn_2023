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
$station = $_GET['station'];
$cellID = $_GET['cell_id'];
$c_name = $_GET['c_name'];
$is_tab_login = $_SESSION['is_tab_user'];
$is_cell_login = $_SESSION['is_cell_login'];
//Set the time of the user's last activity
$_SESSION['LAST_ACTIVITY'] = $time;
$i = $_SESSION["role_id"];
if ($i != "super" && $i != "admin" && $i != "pn_user" && $_SESSION['is_tab_user'] != 1 && $_SESSION['is_cell_login'] != 1 ) {
    header('location: ../dashboard.php');
}
if (count($_POST) > 0) {

    $dateto = $_POST['date_to'];
    $datefrom = $_POST['date_from'];
    $button = $_POST['button'];

    $_SESSION['station_1'] = $_POST['station'];
    $_SESSION['part_family_1'] = $_POST['part_family'];
    $_SESSION['part_number_1'] = $_POST['part_number'];
    $_SESSION['form_type_1'] = $_POST['form_type'];
    $_SESSION['date_from_1'] = $_POST['date_from'];
    $_SESSION['date_to_1'] = $_POST['date_to'];
    $_SESSION['timezone_1'] = $_POST['timezone'];
}else{
    $curdate = date(mdY_FORMAT);
    $dateto = $curdate;
    $yesdate = date(mdY_FORMAT,strtotime("-1 days"));
    $datefrom = $yesdate;
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
        .row-body {
            display: flex;
            flex-wrap: wrap;
            margin-left: -8.75rem;
            margin-right: 6.25rem;
        }



        table.dataTable thead .sorting:after {
            content: ""!important;
            top: 49%;
        }
        .card-title:before{
            width: 0;

        }
        .main-content .container, .main-content .container-fluid {
            padding-left: 20px;
            padding-right: 238px;
        }
        .main-footer {
            margin-left: -127px;
            margin-right: 112px;
            display: block;
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
<?php if (!empty($station)){
    include("../cell-menu.php");
}else{
    include("../header.php");
    include("../admin_menu.php");
}
?>
<!-- main-content -->
<div class="main-content app-content">
    <!-- container -->
    <div class="main-container container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Forms</a></li>
                <li class="breadcrumb-item active" aria-current="page"> View Form</li>
            </ol>

        </div>

    </div>
    <form action="" id="user_form" class="form-horizontal" method="post">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">VIEW FORM</span>
                        </div>
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-1">
                                    <label class="form-label mg-b-0">Station</label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <select name="station" id="station" class="form-control form-select select2" data-placeholder="Select Station">
                                        <option value="" selected> Select Station </option>
                                        <?php
                                        $st_dashboard = $_GET['station'];
                                        if($is_tab_login){
                                            $sql1 = "SELECT line_id,line_name FROM `cam_line`  where enabled = '1' and line_id = '$tab_line' and is_deleted != 1 ORDER BY `line_name` ASC";
                                            $result1 = $mysqli->query($sql1);
                                            //                                            $entry = 'selected';
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

//														$entry = 'selected';
                                            if(empty($_REQUEST) && empty($_REQUEST['station'])){
                                                while ($row1 = $result1->fetch_assoc()) {
                                                    if($i == 0 ){
                                                        $entry = 'selected';
                                                        echo "<option value='" . $row1['line_id'] . "'  $entry>" . $row1['line_name'] . "</option>";
                                                        $c_station = $row1['line_id'];
                                                    }else{
                                                        echo "<option value='" . $row1['line_id'] . "'  >" . $row1['line_name'] . "</option>";

                                                    }
                                                    $i++;
                                                }
                                            }else{
                                                while ($row1 = $result1->fetch_assoc()) {
                                                    if($row1['line_id'] == $_REQUEST['station'] ){
                                                        $entry = 'selected';
                                                        echo "<option value='" . $row1['line_id'] . "'  $entry>" . $row1['line_name'] . "</option>";
                                                        $c_station = $row1['line_id'];
                                                    }else{
                                                        echo "<option value='" . $row1['line_id'] . "'  >" . $row1['line_name'] . "</option>";

                                                    }
                                                    $i++;
                                                }
                                            }


                                        }else{
                                            $st_dashboard = $_POST['station'];
                                            $station22 = $st_dashboard;
                                            $sql1 = "SELECT * FROM `cam_line` where enabled = '1' and is_deleted != 1 ORDER BY `line_name` ASC ";
                                            $result1 = $mysqli->query($sql1);
                                            //                                            $entry = 'selected';
                                            while ($row1 = $result1->fetch_assoc()) {
                                                if($st_dashboard == $row1['line_id'])
                                                {
                                                    $entry = 'selected';
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
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-1">
                                    <label class="form-label mg-b-0">Part Family</label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <select name="part_family" id="part_family" class="form-control form-select select2" data-placeholder="Select Part Family">
                                        <option value="" selected> Select Part Family </option>
                                        <?php
                                        if(empty($_POST)){
                                            if($_SESSION['is_tab_user'] == 1 ){
                                                $station22 = $_SESSION['tab_station'];
                                            }
                                        }
                                        $st_dashboard = $_POST['part_family'];
                                        if(empty($station22)){
                                            $station22 = $_POST['station'];
                                        }

                                        if(empty($station22) && ($is_cell_login == 1) && !empty($c_station)){
                                            $station22 = $c_station;
                                        }
                                        $part_family_name = $_POST['part_family_name'];
                                        $sql1 = "SELECT * FROM `pm_part_family` where is_deleted != 1 and station = '$station22' ";
                                        $result1 = $mysqli->query($sql1);
                                        //                                            $entry = 'selected';
                                        while ($row1 = $result1->fetch_assoc()) {
                                            if($st_dashboard == $row1['pm_part_family_id'])
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

                        </div>
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-1">
                                    <label class="form-label mg-b-0">Part Number</label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <select name="part_number" id="part_number" class="form-control form-select select2" data-placeholder="Select Part Number">
                                        <option value="" selected> Select Part Number </option>
                                        <?php
                                        $st_dashboard = $_POST['part_number'];
                                        $part_family = $_POST['part_family'];

                                        $sql1 = "SELECT * FROM `pm_part_number` where part_family = '$part_family' and is_deleted != 1 ";
                                        $result1 = $mysqli->query($sql1);
                                        //                                            $entry = 'selected';
                                        while ($row1 = $result1->fetch_assoc()) {
                                            if($st_dashboard == $row1['pm_part_number_id'])
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
                                <div class="col-md-1"></div>
                                <div class="col-md-1">
                                    <label class="form-label mg-b-0">Form Type</label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <select name="form_type" id="form_type" class="form-control form-select select2" data-placeholder="Select Form Type">
                                        <option value="" selected > Select Form Type </option>
                                        <?php
                                        $st_dashboard = $_POST['form_type'];

                                        $sql1 = "SELECT * FROM `form_type` where is_deleted != 1 ";
                                        $result1 = $mysqli->query($sql1);
                                        //                                            $entry = 'selected';
                                        while ($row1 = $result1->fetch_assoc()) {
                                            if($st_dashboard == $row1['form_type_id'])
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
                                </div>

                            </div>

                        </div>
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-1">
                                    <label class="form-label mg-b-0">Date From</label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control" name="date_from" id="date_from" value="<?php echo $datefrom; ?>" placeholder="MM-DD-YYYY" type="text">
                                    </div><!-- input-group -->
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-1">
                                    <label class="form-label mg-b-0">Date To</label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control fc-datepicker" name="date_to" id="date_to" value="<?php echo $dateto; ?>"placeholder="MM-DD-YYYY" type="text">
                                    </div><!-- input-group -->
                                </div>

                            </div>

                        </div>
                        <div class="card-body pt-0">
                            <button type="submit" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5 submit_btn">Submit</button>
                            <button type="clear" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5">Reset</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- row  -->
    <?php
    if(count($_POST) > 0)
    {
        ?>

        <div class="row">

            <div class="col-12 col-sm-12">
                <div class="card">

                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table  table-bordered text-nowrap mb-0" id="example2">
                                <thead>
                                <tr>
                                    <th class="text-center">Sl. No</th>
                                    <th>Action</th>
                                    <th>Form Name</th>
                                    <th>Part</th>
                                    <th>Form Type</th>
                                    <th>Form Status</th>
                                    <th>Time</th>

                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $station = $_POST['station'];
                                $part_number = $_POST['part_number'];
                                $part_family = $_POST['part_family'];
                                $form_type = $_POST['form_type'];
                                $dateto = $_POST['date_to'];
                                $datefrom = $_POST['date_from'];
                                $button = $_POST['button'];
                                if(!empty($part_number)){
                                    $q_str = "and part_number = '$part_number' ";
                                }
                                if(!empty($part_family)){
                                    $q_str .= "and part_family = '$part_family' ";
                                }
                                if(!empty($form_type)){
                                    $q_str .= "and form_type = '$form_type' ";
                                }

                                    if ($station != "" && $datefrom != "" && $dateto != "") {
                                        $date_from = convertMDYToYMD($datefrom);
                                        $date_to = convertMDYToYMD($dateto);
                                        $result = "SELECT `form_user_data_id`,`form_name`,`form_type`,`form_status`,`form_create_id`,`form_type`,`form_comp_status`,`created_at`,`updated_at` FROM `form_user_data` WHERE DATE_FORMAT(`created_at`,'%Y-%m-%d') >= '$date_from' and DATE_FORMAT(`created_at`,'%Y-%m-%d') <= '$date_to' and station = '$station' " . $q_str . "ORDER BY form_user_data_id DESC";
                                        $qur = mysqli_query($db,$result);
                                    } else if ($station != "" && $user != "" && $datefrom == "" && $dateto == "") {
                                        $qur = mysqli_query($db, "SELECT `form_user_data_id`,`form_name`,`form_type`,`form_status`,`form_create_id`,`form_type`,`form_comp_status`,`created_at`,`updated_at` FROM `form_user_data` WHERE  station = '$station' ");
                                    } else if ($station != "" && $user == "" && $datefrom != "" && $dateto != "") {
                                        $date_from = convertMDYToYMD($datefrom);
                                        $date_to = convertMDYToYMD($dateto);
                                        $qur = mysqli_query($db, "SELECT `form_user_data_id`,`form_name`,`form_type`,`form_status`,`form_create_id`,`form_type`,`form_comp_status`,`created_at`,`updated_at` FROM `form_user_data` WHERE DATE_FORMAT(`created_at`,'%Y-%m-%d') >= '$date_from' and DATE_FORMAT(`created_at`,'%Y-%m-%d') <= '$date_to' and station = '$station' " . $q_str . "ORDER BY form_user_data_id DESC ");
                                    } else if ($station != "" && $user == "" && $datefrom == "" && $dateto == "") {
                                        $qur = mysqli_query($db, "SELECT `form_user_data_id`,`form_name`,`form_type`,`form_status`,`form_create_id`,`form_type`,`form_comp_status`,`created_at`,`updated_at` FROM `form_user_data` WHERE station = '$station'");
                                    } else if ($station == "" && $user != "" && $datefrom != "" && $dateto != "") {
                                        $date_from = convertMDYToYMD($datefrom);
                                        $date_to = convertMDYToYMD($dateto);
                                        $qur = mysqli_query($db, "SELECT `form_user_data_id`,`form_name`,`form_type`,`form_status`,`form_create_id`,`form_type`,`form_comp_status`,`created_at`,`updated_at` FROM `form_user_data` WHERE DATE_FORMAT(`created_at`,'%Y-%m-%d') >= '$date_from' and DATE_FORMAT(`created_at`,'%Y-%m-%d') <= '$date_to' and station = '$station' " . $q_str . "ORDER BY form_user_data_id DESC");
                                    } else if ($station == "" && $user != "" && $datefrom == "" && $dateto == "") {
                                        $qur = mysqli_query($db, "SELECT `form_user_data_id`,`form_name`,`form_type`,`form_status`,`form_create_id`,`form_type`,`form_comp_status`,`created_at`,`updated_at` FROM `form_user_data` WHERE  station = '$station'");
                                    } else if ($station == "" && $user == "" && $datefrom != "" && $dateto != "") {
                                        $date_from = convertMDYToYMD($datefrom);
                                        $date_to = convertMDYToYMD($dateto);
                                        $qur = mysqli_query($db, "SELECT `form_user_data_id`,`form_name`,`form_type`,`form_status`,`form_create_id`,`form_type`,`form_comp_status`,`created_at`,`updated_at` FROM `form_user_data` WHERE DATE_FORMAT(`created_at`,'%Y-%m-%d') >= '$date_from' and DATE_FORMAT(`created_at`,'%Y-%m-%d') <= '$date_to' ");
                                    }


                                while ($rowc = mysqli_fetch_array($qur)) {


                                    $form_id = $rowc["form_user_data_id"];

                                    $query1  = mysqli_query($db, "SELECT part_number,form_comp_status,form_status, created_at , form_create_id FROM `form_user_data` where form_user_data_id = ' $form_id' LIMIT 1");

                                    $rowc1 = mysqli_fetch_array($query1);
                                    $pno = $rowc1['part_number'];
                                    $query2  = mysqli_query($db, "SELECT part_number,part_name FROM `pm_part_number` where pm_part_number_id = ' $pno' LIMIT 1");

                                    $rowc2 = mysqli_fetch_array($query2);

                                    $datetime = $rowc1["created_at"];
                                    $date_time = strtotime($datetime);

                                    $comp_status = $rowc1["form_comp_status"];
                                    $check_status = $rowc1["form_status"];

                                    $form_create_id = $rowc1["form_create_id"];



                                    ?>

                                    <tr>
                                        <td class="text-center"><?php echo ++$counter; ?></td>
                                        <?php
                                        $opt_sub = mysqli_query($db, "SELECT form_create_id FROM  form_user_data");
                                        while ($rowcopt = mysqli_fetch_array($opt_sub)) {
                                            $opt_id = $rowcopt["form_create_id"];
                                        }
                                        $option_submit = mysqli_query($db, "SELECT count(optional) as optional FROM  form_item where form_create_id  = '$opt_id' and optional = 1");
                                        while ($rowcoptional = mysqli_fetch_array($option_submit)) {

                                            $option = $rowcoptional["optional"];
                                            if($rowcoptional["optional"] > 0){
                                                $option = 1;
                                            }
                                        }
                                        if($option == 0){?>

                                            <td class="">
                                                <?php $finalid = $rowc['form_create_id']; ?>
                                                <a class="btn btn-success btn-sm br-5 me-2" href="view_user_form_data.php?id=<?php echo $rowc['form_user_data_id']; ?>&optional=<?php echo $option; ?>">
                                                    <i class="fa fa-file" style="padding: 1px;font-size: 16px;"></i>
                                                </a>

                                            </td>
                                        <?php } else if($option == 1){

                                            if ($check_status != null){  ?>
                                                <td class="">
                                                    <?php $finalid = $rowc['form_create_id']; ?>
                                                    <a class="btn btn-success btn-sm br-5 me-2" href="submit_user_form.php?id=<?php echo $rowc['form_user_data_id']; ?>&optional=<?php echo $option; ?>">
                                                        <i class="fa fa-file" style="padding: 1px;font-size: 16px;"></i>
                                                    </a>

                                                </td>
                                            <?php } else if($check_status == null) { ?>
                                                <td class="">
                                                    <?php $finalid = $rowc['form_create_id']; ?>
                                                    <a class="btn btn-success btn-sm br-5 me-2" href="view_submit.php?id=<?php echo $rowc['form_user_data_id']; ?>&optional=<?php echo $option; ?>">
                                                        <i class="fa fa-file" style="padding: 1px;font-size: 16px;"></i>
                                                    </a>

                                                </td>
                                            <?php } } ?>
                                        <td><?php echo $rowc["form_name"]; ?></td>
                                        <td><?php echo $rowc2["part_number"] . '-' . $rowc2["part_name"] ; ?></td>
                                        <td><?php
                                            $station1 = $rowc['form_type'];
                                            $qurtemp = mysqli_query($db, "SELECT * FROM  form_type where form_type_id  = '$station1' ");
                                            while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                                                $station = $rowctemp["form_type_name"];
                                            }
                                            ?><?php echo $station; ?></td>
                                       <?php $qur0554 = mysqli_query($db, "SELECT form_classification FROM `form_create` where form_create_id =  '$form_create_id' ");
                                        $rowc0554 = mysqli_fetch_array($qur0554);
                                        $is_general = false;
                                        if($rowc0554['form_classification'] == 'general' ){
                                        $is_general = true;
                                        }
                                        if(!$is_general) {
                                        $qur05 = mysqli_query($db, "SELECT SUM(approval_status) as app_status, SUM(reject_status) as rej_status FROM  form_approval where form_user_data_id = '$form_id' ");
                                        $rowc05 = mysqli_fetch_array($qur05);

                                        $approval_status = (int)$rowc05["app_status"];
                                        $reject_status = (int)$rowc05["rej_status"];
                                        $style = "";
                                        if ($reject_status >= 1) {
                                        $form_status = "Rejected"; ?>
                                         <td><span class="badge badge-danger"><?php echo $form_status; ?></span></td>
                                        <?php } else if ($approval_status >= 1) {
                                        $form_status = "Approved"; ?>
                                        <td><span class="badge badge-success"><?php echo $form_status; ?></span></td>
                                        <?php }else if (empty($approval_status) && empty($reject_status)){
                                        $form_status = "Auto Approved";?>
                                        <td><span class="badge badge-primary"><?php echo $form_status; ?></span></td>
                                       <?php }

                                        } ?>

                                        <td><?php   $datetime = $rowc["created_at"];  echo dateReadFormat($datetime); ?></td>

                                    </tr>

                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }
    ?>
    </div>
</div>
    <!-- /dashboard content -->
    <script> $(document).on('click', '#delete', function () {
            var element = $(this);
            var del_id = element.attr("data-id");
            var info = 'id=' + del_id;
            $.ajax({type: "POST", url: "ajax_job_title_delete.php", data: info, success: function (data) { }});
            $(this).parents("tr").animate({backgroundColor: "#003"}, "slow").animate({opacity: "hide"}, "slow");
        });</script>
    <script>
        jQuery(document).ready(function ($) {
            $(document).on('click', '#edit', function () {
                var element = $(this);
                var edit_id = element.attr("data-id");
                var name = $(this).data("name");
                $("#edit_name").val(name);
                $("#edit_id").val(edit_id);
                //alert(role);
            });
        });
    </script>
    <script>
        $('#date_from').datepicker({ dateFormat: 'mm-dd-yy' });
        $('#date_to').datepicker({ dateFormat: 'mm-dd-yy' });
        $(function () {
            $('input:radio').change(function () {
                var abc = $(this).val()
                //alert(abc)
                if (abc == "button1")
                {
                    $('#date_from').prop('disabled', false);
                    $('#date_to').prop('disabled', false);
                    $('#timezone').prop('disabled', true);
                }
            });
        });
    </script>

<!-- /content area -->



<script>

    $('#station').on('change', function (e) {
        $("#user_form").submit();
    });
    $('#part_family').on('change', function (e) {
        $("#user_form").submit();
    });
</script>
<script>
    $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });

    $(document).on("click","#submit_btn",function() {

        var station = $("#station").val();
        var part_family = $("#part_family").val();
        var part_number = $("#part_number").val();
        var form_type = $("#form_type").val();
        $("#user_form").submit();
        // var flag= 0;
        // if(station == null){
        //     $("#error1").show();
        //     var flag= 1;
        // }
        // if(part_family == null){
        //     $("#error2").show();
        //     var flag= 1;
        // }
        // if(part_number == null){
        //     $("#error3").show();
        //     var flag= 1;
        // }
        // if(form_type == null){
        //     $("#error4").show();
        //     var flag= 1;
        // }
        // if (flag == 1) {
        //     return false;
        // }

    });

</script>

<!-- <script>
	function clearForm()
{
document.getElementById("user_form").reset();

}
	</script> -->
<script type="text/javascript">
    $(function () {
        $("#btn").bind("click", function () {
            $("#station")[0].selectedIndex = 0;
            $("#part_family")[0].selectedIndex = 0;
            $("#part_number")[0].selectedIndex = 0;
            $("#form_type")[0].selectedIndex = 0;
        });
    });
</script>
<script>
    $(function(){
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;

        $('#date_to').attr('max', maxDate);
        $('#date_from').attr('max', maxDate);
    });
</script>
    <?php include('../footer1.php') ?>

</body>
