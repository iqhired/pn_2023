    <?php include("config.php");
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
    exit;
}
//Set the time of the user's last activity
$_SESSION['LAST_ACTIVITY'] = $time;
$_SESSION['timestamp_id'] = '';
$_SESSION['f_type'] = '';
$timestamp = date('H:i:s');
$message = date("Y-m-d H:i:s");
$is_cust_dash = $_SESSION['is_cust_dash'];
$line_cust_dash = $_SESSION['line_cust_dash'];
$cellID = $_GET['cell_id'];
$cell_name = $_GET['c_name'];
if (isset($cellID)) {
    $sql = "select stations from `cell_grp` where c_id = '$cellID'";
    $result1 = mysqli_query($db, $sql);
    $ass_line_array = array();
    while ($rowc = mysqli_fetch_array($result1)) {
        $arr_stations = explode(',', $rowc['stations']);
        foreach ($arr_stations as $station) {
            if (isset($station) && $station != '') {
                array_push($ass_line_array, $station);
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
        <?php echo $sitename; ?> |Line Dashboard</title>
    <!-- Global stylesheets -->

    <link href="<?php echo $siteURL; ?>assets/css/core.css" rel="stylesheet" type="text/css">


    <!-- /global stylesheets -->
    <!-- Core JS files -->
    <!--    <script type="text/javascript" src="../assets/js/libs/jquery-3.6.0.min.js"> </script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo $siteURL; ?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo $siteURL; ?>assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="<?php echo $siteURL; ?>assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- Theme JS files -->

    <script type="text/javascript" src="<?php echo $siteURL; ?>assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="<?php echo $siteURL; ?>assets/js/plugins/forms/selects/bootstrap_select.min.js"></script>
    <script type="text/javascript" src="<?php echo $siteURL; ?>assets/js/pages/form_bootstrap_select.js"></script>
    <script type="text/javascript" src="<?php echo $siteURL; ?>assets/js/pages/form_layouts.js"></script>
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
        .mt-4 {
            margin-top: 0rem!important;
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
        .widget-user .widget-user-image {
            left: 84%;
            margin-left: -45px;
            position: absolute;
            top: 0px;
        }.bg-primary {
             background-color: #fff!important;
         }
        .widget-user .widget-user-username{
            color: #1c273c;
            font-size: 20px;
        }
        .widget-user .widget-user-image>img {
            width: 110px;
        }
        .widget-user .widget-user-header {
            height: auto;
            padding: 20px;
            width: 78%;
        }
        .card-title{
            font-size: 18px;
        }
        .anychart-credits{
            display: none;
        }
        .img-circle {
            border-radius: 50%;
            height: 32vh;
            width: 42vh;
            background-color: #fff;
        }
        .widget-user-graph {
            left: 54%;
            margin-left: -45px;
            position: absolute;
            top: 2px;
        }
        .card .card{
            height: 245px;
        }
        .circle-icon {
            border-radius: 0px;
            height: 50px;
            position: absolute;
            right: 60px;
            top: 0px;
            width: 40px;
        }

        .box-shadow-primary {
            box-shadow: none;
        }
        .tx-20 {
            font-size: 32px!important;
        }
        .text-center {
            text-align: center!important;
            background-image: none!important;
        }
        .badge {
            padding: 0.5em 0.5em!important;
            width: 100px;
            height: 23px;
        }
        .img-thumbnail{
            height: 200px;
        }
        td {
            font-size: medium;
        }
        .card {
            border-radius: 5px;
            height: 286px;
        }
        .tr-row {
            padding: 3px;
        }
        .card-title {
            margin-bottom: 0.5rem;
            margin-top: 10px;
        }
        .card-footer{
            font-size: large;
        }
        .card-header{
            background-color: #fff !important;
            border-bottom: 1px solid #f0f0f8!important;
        }



    </style>
</head>


<!-- Main navbar -->
<?php
$cust_cam_page_header = "Cell Status Dashboard";
include("header.php");
include("admin_menu.php");

?>

<body class="ltr main-body app sidebar-mini">
<!-- main-content -->
<div class="main-content app-content">
    <!-- container -->
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">PN</a></li>
                <li class="breadcrumb-item active" aria-current="page">Cell Status Dashboard</li>
            </ol>
        </div>
    </div>

    <div class="row row-body">
        <?php
        if ($is_cust_dash == 1 && isset($line_cust_dash)){
        $line_cust_dash_arr = explode(',', $line_cust_dash);
        $line_rr = '';
        $i = 0;
        foreach ($line_cust_dash_arr as $line_cust_dash_item) {
            if ($i == 0) {
                $line_rr = "SELECT * FROM  cam_line where enabled = 1 and line_id IN (";
                $i++;
                if (isset($line_cust_dash_item) && $line_cust_dash_item != '') {
                    $line_rr .= "'" . $line_cust_dash_item . "'";
                }
            } else {
                if (isset($line_cust_dash_item) && $line_cust_dash_item != '') {
                    $line_rr .= ",'" . $line_cust_dash_item . "'";
                }
            }
        }
        $line_rr .= ")";
        $query = $line_rr;
        $qur = mysqli_query($db, $query);
        $countervariable = 0;

        while ($rowc = mysqli_fetch_array($qur)) {
        $event_status = '';
        $line_status_text = '';
        $buttonclass = '#000';
        $p_num = '';
        $p_name = '';
        $pf_name = '';
        $time = '';
        $countervariable++;
        $line = $rowc["line_id"];

        //$qur01 = mysqli_query($db, "SELECT created_on as start_time , modified_on as updated_time FROM  sg_station_event where line_id = '$line' and event_status = 1 order BY created_on DESC LIMIT 1");
        $qur01 = mysqli_query($db, "SELECT pn.part_number as p_num, pn.part_name as p_name , pf.part_family_name as pf_name,pf.pm_part_family_id as pf_no, et.event_type_name as e_name ,et.color_code as color_code , sg_events.modified_on as updated_time ,sg_events.station_event_id as station_event_id , sg_events.event_status as event_status , sg_events.created_on as e_start_time,sg_events.event_type_id as event_type_id FROM sg_station_event as sg_events inner join event_type as et on sg_events.event_type_id=et.event_type_id Inner Join pm_part_family as pf on sg_events.part_family_id = pf.pm_part_family_id inner join pm_part_number as pn on sg_events.part_number_id=pn.pm_part_number_id where sg_events.line_id= '$line' ORDER by sg_events.created_on DESC LIMIT 1");
        $rowc01 = mysqli_fetch_array($qur01);
        if ($rowc01 != null) {
            $event_type_id = $rowc01['event_type_id'];
            $time = $rowc01['updated_time'];
            $station_event_id = $rowc01['station_event_id'];
            $line_status_text = $rowc01['e_name'];
            $event_status = $rowc01['event_status'];
            $p_num = $rowc01["p_num"];
            $p_no = $rowc01["p_no"];;
            $p_name = $rowc01["p_name"];
            $pf_name = $rowc01["pf_name"];
            $pf_no = $rowc01["pf_no"];
//			$buttonclass = "94241c";
            $buttonclass = $rowc01["color_code"];
        } else {

        }

        if ($countervariable % 4 == 0) {
        ?>
        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4" onclick="cellDB('<?php echo $cellID; ?>','<?php echo $cell_name; ?>','<?php echo $line; ?>')">
            <div class="card custom-card">
                <div class="card-header d-flex custom-card-header border-bottom-0 ">
                    <h5 class="card-title"><?php echo $rowc["line_name"]; ?></h5>
                    <div class="card-options">
                        <a href="javascript:void(0);" class="btn btn-sm"><i class="fa fa-bars" aria-hidden="true"></i></a>
                    </div>
                </div>

                <div class="card-body">
                    <table>
                        <tr>
                            <td style="width: 40%;">
                                <div class="tr-row">Part Family :</div></td>

                            <td style="width: 60%;">
                                <span><?php echo $pf_name;
                                    $pf_name = ''; ?> </span>
                                <input type="hidden" id="id<?php echo $countervariable; ?>"
                                       value="<?php echo $time; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 40%;">
                                <div class="tr-row">Part Number : </div>
                            </td>
                            <td style="width: 60%;"><span><?php echo $p_num;
                                    $p_num = ''; ?></span></td>
                        </tr>
                        <tr>
                            <td style="width: 40%;">
                                <div class="tr-row">Part Name :</div>
                            </td>
                            <td style="width: 60%;"><span><?php echo $p_name;
                                    $p_name = ''; ?></span></td>
                        </tr>
                    </table>
                </div>
                <?php
                $variable123 = $time;
                if ($variable123 != "") {
                    //include the timing configuration file
                    include("timings_config.php");
                    ?>

                <?php } ?>
            <div class="card-footer" style="background-color:<?php echo $buttonclass; ?>;color: #fff;">
                    <?php echo $line_status_text; ?> -
                    <span id="demo<?php echo $countervariable; ?>">&nbsp;</span><span id="server-load"></span>
                </div>
            </div>
        </div>
            <?php
        } else {
        ?>
        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4" onclick="cellDB('<?php echo $cellID; ?>','<?php echo $cell_name; ?>','<?php echo $line; ?>')">
            <div class="card custom-card">
                <div class="card-header d-flex custom-card-header border-bottom-0 ">
                    <h5 class="card-title"><?php echo $rowc["line_name"]; ?></h5>
                    <div class="card-options">
                        <a href="javascript:void(0);" class="btn btn-sm"><i class="fa fa-bars" aria-hidden="true"></i></a>
                    </div>
                </div>
                <div class="card-body">
                    <table>
                        <tr>
                            <td style="width: 40%;">
                                <div class="tr-row">Part Family : </div>
                            </td>
                            <td style="width: 60%;">
                                <span><?php echo $pf_name;
                                    $pf_name = ''; ?> </span>
                                <input type="hidden" id="id<?php echo $countervariable; ?>"
                                       value="<?php echo $time; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 40%;">
                                <div class="tr-row">Part Number : </div>
                            </td>
                            <td style="width: 60%;"><span><?php echo $p_num;  $p_num = ''; ?></span></td>
                        </tr>
                        <tr>
                            <td style="width: 40%;">
                                <div>Part Name :</div>
                            </td>
                            <td style="width: 60%;"><span><?php echo $p_name;  $p_name = ''; ?></span></td>
                        </tr>
                    </table>
                </div>
                <?php
                $variable123 = $time;
                if ($variable123 != "") {
                    //include the timing configuration file
                    include("timings_config.php");
                    ?>

                <?php } ?>
            <div class="card-footer" style="background-color:<?php echo $buttonclass; ?>;color: #fff;">
                    <?php echo $line_status_text; ?> -
                    <span id="demo<?php echo $countervariable; ?>">&nbsp;</span><span id="server-load"></span>
                </div>
            </div>
        </div>
        <?php
                }
           }
        } else {
        $countervariable = 0;
        asort($ass_line_array);
        foreach ($ass_line_array as $line) {
        $query = sprintf("SELECT line_name FROM  cam_line where line_id = '$line'");
        $qur = mysqli_query($db, $query);
        $rowc = mysqli_fetch_array($qur);
        $event_status = '';
        $line_status_text = '';
        $buttonclass = '#000';
        $p_num = '';
        $p_name = '';
        $pf_name = '';
        $time = '';
        $countervariable++;
        $qur01 = mysqli_query($db, "SELECT pn.part_number as p_num, pn.pm_part_number_id as p_no, pn.part_name as p_name , pf.part_family_name as pf_name,pf.pm_part_family_id as pf_no, et.event_type_name as e_name ,et.color_code as color_code , sg_events.modified_on as updated_time ,sg_events.station_event_id as station_event_id , sg_events.event_status as event_status , sg_events.created_on as e_start_time,sg_events.event_type_id as event_type_id FROM sg_station_event as sg_events inner join event_type as et on sg_events.event_type_id=et.event_type_id Inner Join pm_part_family as pf on sg_events.part_family_id = pf.pm_part_family_id inner join pm_part_number as pn on sg_events.part_number_id=pn.pm_part_number_id where sg_events.line_id= '$line' ORDER by sg_events.created_on DESC LIMIT 1");
        $rowc01 = mysqli_fetch_array($qur01);
        if ($rowc01 != null) {
            $event_type_id = $rowc01['event_type_id'];
            $time = $rowc01['updated_time'];
            $station_event_id = $rowc01['station_event_id'];
            $line_status_text = $rowc01['e_name'];
            $event_status = $rowc01['event_status'];
            $p_num = $rowc01["p_num"];;
            $p_no = $rowc01["p_no"];;
            $p_name = $rowc01["p_name"];;
            $pf_name = $rowc01["pf_name"];
            $pf_no = $rowc01["pf_no"];
            $buttonclass = $rowc01["color_code"];
        } else {

        }

        if ($countervariable % 4 == 0) {
        ?>
        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4"onclick="cellDB('<?php echo $cellID; ?>','<?php echo $cell_name; ?>','<?php echo $line; ?>')">
            <div class="card custom-card">
                <div class="card-header d-flex custom-card-header border-bottom-0 ">
                    <h5 class="card-title"><?php echo $rowc["line_name"]; ?></h5>
                    <div class="card-options">
                        <a href="javascript:void(0);" class="btn btn-sm"><i class="fa fa-bars" aria-hidden="true"></i></a>
                    </div>
                </div>

                <div class="card-body">
                    <table>
                        <tr>
                            <td style="width: 40%;">
                                <div class="tr-row">Part Family :</div>
                            </td>
                            <td style="width: 60%;">
                                <span><?php echo $pf_name;
                                    $pf_name = ''; ?> </span>
                                <input type="hidden" id="id<?php echo $countervariable; ?>"
                                       value="<?php echo $time; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 40%;">
                                <div class="tr-row">Part Number :</div>
                            </td>
                            <td style="width: 60%;">
                                <span><?php echo $p_num;
                                    $p_num = ''; ?></span></td>
                        </tr>
                        <tr>
                            <td style="width: 40%;">
                                <div class="tr-row">Part Name :</div>
                            </td>
                            <td style="width: 60%;">
                                <span><?php echo $p_name;
                                    $p_name = ''; ?></span></td>
                        </tr>
                    </table>
                </div>
                <?php
                $variable123 = $time;
                if ($variable123 != "") {
                    //include the timing configuration file
                    include("timings_config.php");
                    ?>

                <?php } ?>
                <div class="card-footer" style="background-color:<?php echo $buttonclass; ?>;color: #fff;">
                    <?php echo $line_status_text; ?> -
                    <span id="demo<?php echo $countervariable; ?>">&nbsp;</span><span id="server-load"></span>
                </div>
            </div>
        </div>
            <?php
        } else {
        ?>
        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4" onclick="cellDB('<?php echo $cellID; ?>','<?php echo $cell_name; ?>','<?php echo $line; ?>')">
            <div class="card custom-card">
                <div class="card-header d-flex custom-card-header border-bottom-0 ">
                    <h5 class="card-title"><?php echo $rowc["line_name"]; ?></h5>
                    <div class="card-options">
                        <a href="javascript:void(0);" class="btn btn-sm"><i class="fa fa-bars" aria-hidden="true"></i></a>
                    </div>
                </div>

                <div class="card-body">
                    <table>
                        <tr>
                            <td style="width: 40%;">
                                <div class="tr-row">Part Family :</div>
                            </td>

                            <td style="width: 60%;">
                                <div  class="tr-row"><?php echo $pf_name;
                                    $pf_name = ''; ?> </div>
                                <input type="hidden" id="id<?php echo $countervariable; ?>"
                                       value="<?php echo $time; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 40%;">
                                <div class="tr-row">Part Number :</div>
                            </td>
                            <td style="width: 60%;"><span><?php echo $p_num;
                                    $p_num = ''; ?></span></td>
                        </tr>
                        <tr>
                            <td style="width: 40%;">
                                <div class="tr-row">Part Name :</div>
                            </td>
                            <td style="width: 60%;">
                                <span><?php echo $p_name;
                                    $p_name = ''; ?></span></td>
                        </tr>
                    </table>
                </div>
                <?php
                $variable123 = $time;
                if ($variable123 != "") {
                    //include the timing configuration file
                    include("timings_config.php");
                    ?>

                <?php } ?>
                <div class="card-footer" style="background-color:<?php echo $buttonclass; ?>;color: #fff;">
                    <?php echo $line_status_text; ?> -
                    <span id="demo<?php echo $countervariable; ?>">&nbsp;</span><span id="server-load"></span>
                </div>
            </div>
        </div>
            <?php
             }
          }
        }

        ?>
    </div>
</div>
<script>
    function cellDB(cell_id,c_name,station) {
        window.open("<?php echo $siteURL . "config_module/station_wise_dashboard.php?cell_id=" ; ?>" + cell_id + "<?php echo "&c_name=" ; ?>" + c_name + "<?php echo "&station=" ; ?>" + station)
    }

</script>
<?php include("footer1.php");?> <!-- /page container -->

</body>
</html>
