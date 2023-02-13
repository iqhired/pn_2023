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
//Set the time of the user's last activity
$_SESSION['LAST_ACTIVITY'] = $time;
$is_tab_login = $_SESSION['is_tab_user'];
$is_cell_login = $_SESSION['is_cell_login'];
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
<!-- main-content -->
<?php if (!empty($station)){
    include("../cell-menu.php");
}else{
    include("../header.php");
    include("../admin_menu.php");
}
?>
<div class="main-content app-content">
    <!-- container -->
    <div class="main-container container-fluid">
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Forms</a></li>
                <li class="breadcrumb-item active" aria-current="page">Submit Form</li>
            </ol>

        </div>

    </div>
    <form action="" id="user_form" class="form-horizontal" method="post">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">SUBMIT FORM</span>
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
                                        if($_SESSION["role_id"] == "pn_user" &&  (!empty($is_tab_login) || $is_tab_login == 1) && (empty($is_cell_login) || $is_cell_login == 0)){
                                            $is_tab_login = 1;
                                            $tab_line = $_REQUEST['station'];
                                            if(empty($tab_line)){
                                                $tab_line = $_SESSION['tab_station'];
                                            }
                                        }
                                        if($is_tab_login){
                                            $sql1 = "SELECT line_id, line_name FROM `cam_line`  where enabled = '1' and line_id = '$tab_line' and is_deleted != 1 ORDER BY `line_name` ASC";
                                            $result1 = $mysqli->query($sql1);
                                            //                                            $entry = 'selected';
                                            while ($row1 = $result1->fetch_assoc()) {
                                                $entry = 'selected';
                                                echo "<option value='" . $row1['line_id'] . "'  $entry>" . $row1['line_name'] . "</option>";
                                            }
                                        }else if($is_cell_login){
                                            if(empty($_REQUEST)) {
                                                $c_stations = implode("', '", $c_login_stations_arr);
                                                $sql1 = "SELECT line_id,line_name FROM `cam_line`  where enabled = '1' and line_id IN ('$c_stations') and is_deleted != 1 ORDER BY `line_name` ASC";
                                                $result1 = $mysqli->query($sql1);
                                                //													                $                        $entry = 'selected';
                                                $i = 0;
                                                while ($row1 = $result1->fetch_assoc()) {
                                                    //														$entry = 'selected';
                                                    if ($i == 0) {
                                                        $entry = 'selected';
                                                        echo "<option value='" . $row1['line_id'] . "'  $entry>" . $row1['line_name'] . "</option>";
                                                        $c_station = $row1['line_id'];
                                                    } else {
                                                        echo "<option value='" . $row1['line_id'] . "'  >" . $row1['line_name'] . "</option>";

                                                    }
                                                    $i++;
                                                }
                                            }else{
                                                $line_id = $_REQUEST['line'];
                                                if(empty($line_id)){
                                                    $line_id = $_REQUEST['station'];
                                                }
                                                $sql1 = "SELECT line_id,line_name FROM `cam_line`  where enabled = '1' and line_id ='$line_id' and is_deleted != 1";
                                                $result1 = $mysqli->query($sql1);
                                                while ($row1 = $result1->fetch_assoc()) {
                                                    $entry = 'selected';
                                                    $station = $row1['line_id'];
                                                    echo "<option value='" . $station . "'  $entry>" . $row1['line_name'] . "</option>";

                                                }
                                            }
                                        }else{
                                            $st_dashboard = $_POST['station'];
                                            if (!isset($st_dashboard)) {
                                                $st_dashboard = $_REQUEST['station'];
                                            }
                                            $sql1 = "SELECT * FROM `cam_line` where enabled = '1' and is_deleted != 1 ORDER BY `line_name` ASC ";
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
                                        $st_dashboard = $_POST['part_family'];
                                        if(empty($st_dashboard) && !empty($_REQUEST['part_family'])){
                                            $st_dashboard = $_REQUEST['part_family'];
                                        }
                                        $station = $_POST['station'];
                                        if(empty($station) && !empty($_REQUEST['station'])){
                                            $station = $_REQUEST['station'];
                                        }
                                        if(empty($station) && !empty($tab_line)){
                                            $station = $tab_line;
                                        }
                                        if(empty($station) && ($is_cell_login == 1) && !empty($c_station)){
                                            $station = $c_station;
                                        }
                                        $sql1 = "SELECT * FROM `pm_part_family` where station = '$station' and is_deleted != 1 ORDER BY `part_family_name` ASC";
                                        $result1 = $mysqli->query($sql1);
                                        //                                            $entry = 'selected';
                                        while ($row1 = $result1->fetch_assoc()) {
                                            if ($st_dashboard == $row1['pm_part_family_id']) {
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
                                        //	$st_dashboard = $_POST['part_number'];
                                        $part_family = $_REQUEST['part_family'];
                                        $st_dashboard = $_REQUEST['part_number'];
                                        $sql1 = "SELECT * FROM `pm_part_number` where part_family = '$part_family' and is_deleted != 1  ORDER BY `part_name` ASC";
                                        $result1 = $mysqli->query($sql1);
                                        while ($row1 = $result1->fetch_assoc()) {
                                            if ($st_dashboard == $row1['pm_part_number_id']) {
                                                $entry = 'selected';
                                            } else {
                                                $entry = '';

                                            }
                                            echo "<option value='" . $row1['pm_part_number_id'] . "' $entry >" . $row1['part_number'] . " - " . $row1['part_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-1 "></div>
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
                                            if ($st_dashboard == $row1['form_type_id']) {
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
                                        <th>Form Type</th>
                                        <th>PO Number</th>
                                        <th>DA Number</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $station = $_POST['station'];
                                    $part_number = $_POST['part_number'];
                                    $part_family = $_POST['part_family'];
                                    $form_type = $_POST['form_type'];


                                    if ($station != "" && $part_family == "" && $part_number == "" && $form_type == "") {
                                        $query = sprintf("SELECT * FROM `form_create` where station = '$station' and delete_flag = '0'");
                                    } else if ($station != "" && $part_family != "" && $part_number == "" && $form_type == "") {
                                        $query = sprintf("SELECT * FROM `form_create` where station = '$station' and part_family = '$part_family' and delete_flag = '0'");
                                    } else if ($station != "" && $part_family != "" && $part_number != "" && $form_type == "") {
                                        $query = sprintf("SELECT * FROM `form_create` where station = '$station' and part_family = '$part_family' and part_number = '$part_number' and delete_flag = '0'");
                                    } else {
                                        $query = sprintf("SELECT * FROM `form_create` where station = '$station' and part_family = '$part_family' and part_number = '$part_number' and form_type = '$form_type' and delete_flag = '0'");
                                    }

                                    $qur = mysqli_query($db, $query);
                                    while ($rowc = mysqli_fetch_array($qur)) {
                                        ?>
                                        <tr>
                                            <td class="text-center"><?php echo ++$counter; ?></td>
                                            <td class="">
                                                <?php $finalid = $rowc['form_create_id']; ?>
                                                <a class="btn btn-success btn-sm br-5 me-2" href="user_form.php?id=<?php echo $rowc['form_create_id']; ?>&station=<?php echo $rowc['station']; ?>&form_type=<?php echo $rowc['form_type']; ?>&part_family=<?php echo $rowc['part_family']; ?>&part_number=<?php echo $rowc['part_number']; ?>&form_name=<?php echo $rowc['name']; ?>">
                                                    <i class="fa fa-file" style="padding: 1px;font-size: 16px;"></i>
                                                </a>

                                            </td>
                                            <td><?php echo $rowc["name"]; ?></td>
                                            <td><?php
                                                $station1 = $rowc['form_type'];
                                                $qurtemp = mysqli_query($db, "SELECT * FROM  form_type where form_type_id  = '$station1' ");
                                                while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                                                    $station = $rowctemp["form_type_name"];
                                                }
                                                echo $station; ?></td>
                                            <td><?php echo $rowc["po_number"]; ?></td>
                                            <td><?php echo $rowc["da_number"]; ?></td>
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
    <!-- /content area -->
    <script>
        $("#checkAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });


        $('#station').on('change', function (e) {
            $("#user_form").submit();
        });
        $('#part_family').on('change', function (e) {
            $("#user_form").submit();
        });
        $(document).on("click", ".submit_btn", function () {

            var station = $("#station").val();
            var part_family = $("#part_family").val();
            var part_number = $("#part_number").val();
            var form_type = $("#form_type").val();
        });
    </script>
    <script type="text/javascript">
        $(function () {
            $("#btn").bind("click", function () {
                var url = window.location.origin + "/form_module/options.php?station=" + $("#station")[0].value;
                window.close();
                window.open(url,"_blank");

            });
        });
    </script>
    <?php include('../footer1.php') ?>

</body>
</html>
