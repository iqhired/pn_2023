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
$is_tab_login = $_SESSION['is_tab_user'];
$is_cell_login = $_SESSION['is_cell_login'];
$station = $_GET['station'];
$station_event_id =  $_GET['station_event_id'];
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
}else{
    $curdate = date('Y-m-d');
    $dateto = $curdate;
    $yesdate = date('Y-m-d',strtotime("-1 days"));
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
        <?php echo $sitename; ?> | Material Form List</title>
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
    <link href="<?php echo $siteURL; ?>assets/css/form_css/fancy_fileupload.css" rel="stylesheet"/>
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
    <style>
        .navbar {

            padding-top: 0px !important;
        }

        .dropdown .arrow {

            margin-top: -25px !important;
            width: 1.5rem !important;
        }

        #ic .arrow {
            margin-top: -22px !important;
            width: 1.5rem !important;
        }

        .fs-6 {
            font-size: 1rem !important;
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

        .remove_btn {
            float: right;
        }

        .contextMenu {
            position: absolute;
            width: min-content;
            left: 204px;
            background: #e5e5e5;
            z-index: 999;
        }

        .collapse.in {
            display: block !important;
        }

        .mt-4 {
            margin-top: 0rem !important;
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
                max-width: 10.33333% !important;
            }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .row-body {

                margin-left: -15rem;
                margin-right: 0rem;
            }

        }


        table.dataTable thead .sorting:after {
            content: "" !important;
            top: 49%;
        }

        .card-title:before {
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
            padding: 0.5em 0.5em !important;
            width: 100px;
            height: 23px;
        }

    </style>
</head>

<!-- Main navbar -->
<?php $cust_cam_page_header = "View material Form";
include("../header.php");
if (($is_tab_login || $is_cell_login)) {
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
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);"></a></li>
                <li class="breadcrumb-item active" aria-current="page">View material Form</li>
            </ol>
        </div>
    </div>
    <div class="row row-body">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="main-content-title mg-b-0 mg-b-lg-1">View material Form</span>
                </div>
                <br/>
                <div class="col-md-4 create" style="margin-left: auto;">
                    <a href="<?php echo $siteURL; ?>material_tracability/material_tracability.php?station=<?php echo $station; ?>&station_event_id=<?php echo $station_event_id; ?>">
                        <button type="submit" id="create" class="btn btn-primary" style="background-color: #009688;float:right">Add/Create New Material Form</button>
                    </a>
                </div>
                <div class="card-body pt-0">

                    <?php
                    $result = "SELECT * FROM `material_tracability` where station_event_id = '$station_event_id' ORDER BY `material_id` DESC";
                    $qur = mysqli_query($db,$result); ?>
                    <div class="table-responsive">
                        <table class="table  table-bordered text-nowrap mb-0" id="example2">
                            <thead>
                            <tr>
                                <th>Sl. No</th>
                                <th>Action</th>
                                <th>Station</th>
                                <th>Material Type</th>
                                <th>Serial Number</th>
                                <th class="form_create">Created At</th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php
                            while ($rowc = mysqli_fetch_array($qur)) {
                                $line_name = $rowc["line_no"];
                                $sqlnumber = "SELECT * FROM `cam_line` where `line_id` = '$line_name'";
                                $resultnumber = mysqli_query($db,$sqlnumber);
                                $rowcnumber = mysqli_fetch_array($resultnumber);
                                $station = $rowcnumber['line_name'];

                                $material_type = $rowc["material_type"];
                                $serial_number = $rowc["serial_number"];
                                if($serial_number == 0){
                                    $serial =  '';
                                }else{
                                    $serial =  $serial_number;
                                }
                                $material_status = $rowc["material_status"];
                                $created_at= $rowc["created_at"];

                                if($material_status == '1'){
                                    $style = "style='background-color:#a8d8a8;'";
                                }else{

                                    $style = "style='background-color:#eca9a9;'";
                                }?>
                                <tr <?php echo $style; ?>>
                                    <td> <?php echo ++$counter; ?></td>
                                    <td >
                                        <a href="view_material.php?id=<?php echo $rowc['material_id']; ?>" class="btn btn-primary mg-t-5"><i class="fa fa-eye" aria-hidden="true"></i></a>

                                        <a href="edit_material.php?id=<?php echo $rowc['material_id']; ?>" class="btn btn-primary mg-t-5"> <i class="fa fa-edit"></i></i></a>

                                    </td>

                                    <td> <?php echo $station ?></td>
                                    <?php

                                    $result1 = "SELECT * FROM `material_config` where material_id = '$material_type'";
                                    $qur1 = mysqli_query($db,$result1);
                                    while ($rowc1 = mysqli_fetch_array($qur1)) {

                                        $material_type = $rowc1['material_type'];

                                    } ?>
                                    <td> <?php echo $material_type ?></td>
                                    <td> <?php echo $serial ?></td>

                                    <td> <?php echo $created_at ?></td>
                                </tr>

                            <?php } ?>
                            </tbody>
                        </table>
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
</div>
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
    });

</script>

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
<script>
    window.onload = function () {
        history.replaceState("", "", "<?php echo $siteURL; ?>material_tracability/material_search.php");
    }
</script>
<?php include('../footer1.php') ?>

</body>
</html>