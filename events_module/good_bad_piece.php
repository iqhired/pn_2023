<?php include("../config.php");
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
if ($i != "super" && $i != "admin" && $i != "pn_user" && $_SESSION['is_tab_user'] != 1 && $_SESSION['is_cell_login'] != 1 ) {
    header('location: ../line_status_overview_dashboard.php');
}
$user_id = $_SESSION["id"];
$def_ch = $_POST['def_ch'];
$chicagotime = date("Y-m-d H:i:s");
//$line = "<b>-</b>";
$line = "";
$station_event_id = $_GET['station_event_id'];
$station = $_GET['station'];

$cellID = $_GET['cell_id'];
$c_name = $_GET['c_name'];

$sqlmain = "SELECT * FROM `sg_station_event` where `station_event_id` = '$station_event_id'";
$resultmain = $mysqli->query($sqlmain);
$rowcmain = $resultmain->fetch_assoc();
$part_family = $rowcmain['part_family_id'];
$part_number = $rowcmain['part_number_id'];
$p_line_id = $rowcmain['line_id'];

$sqlprint = "SELECT * FROM `cam_line` where `line_id` = '$p_line_id'";
$resultnumber = $mysqli->query($sqlprint);
$rowcnumber = $resultnumber->fetch_assoc();
$printenabled = $rowcnumber['print_label'];
$p_line_name = $rowcnumber['line_name'];
$individualenabled = $rowcnumber['indivisual_label'];

$idddd = preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo
|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i"
    , $_SERVER["HTTP_USER_AGENT"]);

$sqlnumber = "SELECT * FROM `pm_part_number` where `pm_part_number_id` = '$part_number'";
$resultnumber = $mysqli->query($sqlnumber);
$rowcnumber = $resultnumber->fetch_assoc();
$pm_part_number = $rowcnumber['part_number'];
$pm_part_name = $rowcnumber['part_name'];
$pm_npr= $rowcnumber['npr'];
if(empty($pm_npr))
{
    $npr = 0;
    $pm_npr = 0;
}else{
    $npr = $pm_npr;
}
$sqlfamily = "SELECT * FROM `pm_part_family` where `pm_part_family_id` = '$part_family'";
$resultfamily = $mysqli->query($sqlfamily);
$rowcfamily = $resultfamily->fetch_assoc();
$pm_part_family_name = $rowcfamily['part_family_name'];

$sqlaccount = "SELECT * FROM `part_family_account_relation` where `part_family_id` = '$part_family'";
$resultaccount = $mysqli->query($sqlaccount);
$rowcaccount = $resultaccount->fetch_assoc();
$account_id = $rowcaccount['account_id'];

$sqlcus = "SELECT * FROM `cus_account` where `c_id` = '$account_id'";
$resultcus = $mysqli->query($sqlcus);
$rowccus = $resultcus->fetch_assoc();
$cus_name = $rowccus['c_name'];
$logo = $rowccus['logo'];

$sql2 = "SELECT SUM(good_pieces) AS good_pieces,SUM(bad_pieces)AS bad_pieces,SUM(rework) AS rework FROM `good_bad_pieces`  INNER JOIN sg_station_event ON good_bad_pieces.station_event_id = sg_station_event.station_event_id where sg_station_event.line_id = '$p_line_id' and sg_station_event.event_status = 1" ;
$result2 = mysqli_query($db,$sql2);
$total_time = 0;
$row2=$result2->fetch_assoc();
$total_gp =  $row2['good_pieces'] + $row2['rework'];

$sql3 = "SELECT * FROM `sg_station_event_log` where 1 and event_status = 1 and station_event_id = '$station_event_id' and event_cat_id in (SELECT events_cat_id FROM `events_category` where npr = 1)" ;
$result3 = mysqli_query($db,$sql3);
$ttot = null;
$tt = null;
while ($row3 = $result3->fetch_assoc()) {
    $ct = $row3['created_on'];
    $tot = $row3['total_time'];
    if(!empty($row3['total_time'])){
        $ttot = explode(':' , $row3['total_time']);
        $i = 0;
        foreach($ttot as $t_time) {
            if($i == 0){
                $total_time += ( $t_time * 60 * 60 );
            }else if( $i == 1){
                $total_time += ( $t_time * 60 );
            }else{
                $total_time += $t_time;
            }
            $i++;
        }
    }else{
        $total_time +=  strtotime($chicagotime) - strtotime($ct);
    }
}
$total_time = (($total_time/60)/60);
$b = round($total_time);
$target_eff = round($pm_npr * $b);
$actual_eff = $total_gp;
if( $actual_eff ===0 || $target_eff === 0 || $target_eff === 0.0){
    $eff = 0;
}else{
    $eff = round(100 * ($actual_eff/$target_eff));
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo $sitename; ?> | Good Bad Piece</title>


    <!-- INTERNAL Select2 css -->
    <link href="<?php echo $siteURL; ?>assets/css/form_css/select2.min.css" rel="stylesheet" />


    <!-- STYLES CSS -->
    <link href="<?php echo $siteURL; ?>assets/css/form_css/style.css" rel="stylesheet">
    <link href="<?php echo $siteURL; ?>assets/css/form_css/style-dark.css" rel="stylesheet">
    <link href="<?php echo $siteURL; ?>assets/css/form_css/style-transparent.css" rel="stylesheet">

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
    <link href="<?php echo $siteURL; ?>assets/js/form_css/demo.css" rel="stylesheet"/>
    <!-- anychart documentation -->
    <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-base.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-data-adapter.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-ui.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-exports.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-pareto.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-core.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-circular-gauge.min.js"></script>
    <link href="https://cdn.anychart.com/releases/8.11.0/css/anychart-ui.min.css" type="text/css" rel="stylesheet">
    <link href="https://cdn.anychart.com/releases/8.11.0/fonts/css/anychart-font.min.css" type="text/css"
          rel="stylesheet">



    <!-- INTERNAL Select2 css -->
    <link href="<?php echo $siteURL; ?>assets/css/form_css/select2.min.css" rel="stylesheet" />


    <!-- STYLES CSS -->
    <link href="<?php echo $siteURL; ?>assets/css/form_css/style.css" rel="stylesheet">
    <link href="<?php echo $siteURL; ?>assets/css/form_css/style-dark.css" rel="stylesheet">
    <link href="<?php echo $siteURL; ?>assets/css/form_css/style-transparent.css" rel="stylesheet">



    <style>

        .logo-horizontal {
            width: 150px;
        }
        img.mobile-logo.logo-1 {
            width: 150px;
        }
        .breadcrumb-header {sticky
        margin-left: 20px;
        }
        .main-profile-menu .dropdown-menu:before{
            right: 135px;
        }
        .main-profile-menu .dropdown-menu{
            width: 100%;
            position: fixed;
        }
        .nav .nav-item .dropdown-menu{
            top: 60px;
        }
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
            font-size: 25px;
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
        a.btn.bg-danger-gradient.text-white.view_gpbp.legitRipple {
            width: 196px;
            height: 60px;
        }
        .text-center {
            text-align: center!important;
            font-size: 15px;
        }
        .bg-primary-gradient,.bg-success,.bg-danger-gradient,.bg-warning-gradient{
            height: 92px;
        }
        a.btn.bg-danger-gradient.text-white.view_gpbp {
            height: 60px;
            width: 196px;
            font-weight: 600!important;
        }

    </style>

</head>

<body class="ltr main-body app horizontal">

<?php if (!empty($station) || !empty($station_event_id)){
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
                    <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Events Module</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Good Bad Piece</li>
                </ol>

            </div>

        </div>
        <!-- /breadcrumb -->

        <!-- row -->
        <div class="row">
            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                <div class="card  box-shadow-0">
                    <div class="card-header">
                        <h4 class="card-title mb-1 text-white"><?php if($cus_name != ""){ echo $cus_name; }else{ echo "Customer Name";} ?></h4>
                    </div>
                    <div class="card-body pt-0">
                        <div class="card user-wideget user-wideget-widget widget-user">
                            <div class="widget-user-header br-te-5  br-ts-5  bg-primary">
                                <h3 class="widget-user-username">Part Family - <?php echo $pm_part_family_name; ?></h3>
                                <h3 class="widget-user-username">Part Number - <?php echo $pm_part_number; ?></h3>
                                <h3 class="widget-user-username">Part Name - <?php echo $pm_part_name; ?></h3>
                            </div>
                            <div class="widget-user-image">
                                <img  src="../supplier_logo/<?php if($logo != ""){ echo $logo; }else{ echo "user.png"; } ?>" class="brround" alt="User Avatar">
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                <div class="card  box-shadow-0 ">
                    <div class="card-header">
                        <h4 class="card-title mb-1 text-white">Current Staff Efficiency</h4>
                    </div>
                    <div class="card-body pt-0">
                        <div class="card user-wideget user-wideget-widget widget-user">
                            <div class="widget-user-header br-te-5  br-ts-5  bg-primary">
                                <h6>Target Pieces - <?php echo $target_eff; ?></h6>
                                <h6>Actual Pieces - <?php echo $actual_eff; ?></h6>
                                <h6>Efficiency - <?php echo $eff; ?>%</h6>
                            </div>
                            <div class="widget-user-graph">
                                <div id="eff_container" class="img-circle"></div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- row -->
        </div>
        <!-- row -->
        <div class="row ">
            <?php
            $sql = "select SUM(good_pieces) as good_pieces,SUM(bad_pieces) AS bad_pieces,SUM(rework) as rework from good_bad_pieces_details where station_event_id ='$station_event_id' ";
            $result1 = mysqli_query($db, $sql);
            $rowc = mysqli_fetch_array($result1);
            $gp = $rowc['good_pieces'];
            if(empty($gp)){
                $g = 0;
            }else{
                $g = $gp;
            }
            $bp = $rowc['bad_pieces'];
            if(empty($bp)){
                $b = 0;
            }else{
                $b = $bp;
            }
            $rwp = $rowc['rework'];
            if(empty($rwp)){
                $r = 0;
            }else{
                $r = $rwp;
            }
            $tp = $gp + $bp+ $rwp;
            if(empty($tp)){
                $t = 0;
            }else{
                $t = $tp;
            }
            ?>
            <div class="col-lg-6 col-xl-3 col-md-6 col-12">
                <div class="card bg-primary-gradient text-white ">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="mt-0 text-center">
                                    <span class="text-white">Total Pieces</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mt-0 text-center">

                                    <h2 class="text-white mb-0"><?php echo $t ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-3 col-md-6 col-12">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="mt-0 text-center">
                                    <span class="text-white">Total Good Pieces</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mt-0 text-center">
                                    <h2 class="text-white mb-0"><?php echo $g ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-3 col-md-6 col-12">
                <div class="card bg-danger-gradient text-white">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="mt-0 text-center">
                                    <span class="text-white">Total Bad Pieces</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mt-0 text-center">
                                    <h2 class="text-white mb-0"><?php echo $b ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xl-3 col-md-6 col-12">
                <div class="card bg-warning-gradient text-white">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <div class="mt-0 text-center">
                                    <span class="text-white">Rework</span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mt-0 text-center">
                                    <h2 class="text-white mb-0"><?php echo $r ?></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row ">
            <div class="col-sm-12 col-md-12">
                <div class="card custom-card">
                    <div class="card-body pb-0">
                        <div class="input-group mb-2">
                            <input id="search" type="text" class="form-control" placeholder="Searching....." >
                            <span class="input-group-append">
                           <button class="btn ripple btn-primary" type="button" fdprocessedid="jzln6h">Search</button>
                    </span>
                        </div>
                        <div class="input-group mb-2">
                            <a class="form-control btn ripple btn-success" href="<?php echo $siteURL; ?>events_module/add_good_piece.php?station=<?php echo $station;?>&station_event_id=<?php echo $station_event_id; ?>">IN-SPEC</a>
                        </div>
                        <div class="text-wrap">
                            <div class="example">
                                <div class="btn-list">

                                    <?php
                                    $i = 1;
                                    $def_list_arr = array();
                                    $sql1 = "SELECT * FROM `defect_list` ORDER BY `defect_list_name` ASC";
                                    $result1 = $mysqli->query($sql1);
                                    while ($row1 = $result1->fetch_assoc()) {
                                        $pnums = $row1['part_number_id'];
                                        $arr_pnums = explode(',', $pnums);
                                        if (in_array($part_number, $arr_pnums)) {
                                            array_push($def_list_arr, $row1['defect_list_id']);
                                        }
                                    }

                                    $sql1 = "SELECT sdd.defect_list_id as dl_id FROM sg_defect_group as sdg inner join sg_def_defgroup as sdd on sdg.d_group_id = sdd.d_group_id WHERE FIND_IN_SET('$part_number',sdg.part_number_id) > 0";
                                    $result1 = $mysqli->query($sql1);
                                    while ($row1 = $result1->fetch_assoc()) {
                                        array_push($def_list_arr, $row1['dl_id']);
                                    }
                                    $def_list_arr = array_unique($def_list_arr);
                                    $def_lists = implode("', '", $def_list_arr);
                                    $sql1 = "SELECT * FROM `defect_list` where  defect_list_id IN ('$def_lists') ORDER BY `defect_list_name` ASC";
                                    $result1 = $mysqli->query($sql1);
                                    while ($row1 = $result1->fetch_assoc()) {
                                        ?>
                                        <a href="<?php echo $siteURL; ?>events_module/add_bad_piece.php?station=<?php echo $station;?>&station_event_id=<?php echo $station_event_id; ?>&defect_list_id=<?php echo $row1['defect_list_id']; ?>" class="btn bg-danger-gradient text-white view_gpbp"><?php echo $row1['defect_list_name']; ?></a>
                                        <?php
                                        if($i == 4)
                                        {
                                            $i = 0;
                                        }

                                        $i++;
                                    }
                                    ?>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="row ">
            <div class="col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">
                            <button type="button" class="btn btn-danger btn-sm br-5" onclick="submitForm('delete_form_option.php')">
                                <i>
                                    <svg class="table-delete" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9zm7.5-5l-1-1h-5l-1 1H5v2h14V4h-3.5z"></path></svg>
                                </i>
                            </button></h4>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table  table-bordered text-nowrap mb-0" id="example2">
                                <thead>
                                <tr>
                                    <th><label class="ckbox"><input type="checkbox" id="checkAll" ><span></span></label></th>
                                    <th class="text-center">S.No</th>
                                    <th>Good Pieces</th>
                                    <th>Defect Name</th>
                                    <th>Bad Pieces</th>
                                    <th>Re-Work</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $station_event_id = $_GET['station_event_id'];
                                $query = sprintf("SELECT gbpd.bad_pieces_id as bad_pieces_id , gbpd.good_pieces as good_pieces, gbpd.defect_name as defect_name, gbpd.bad_pieces as bad_pieces ,gbpd.rework as rework FROM good_bad_pieces_details as gbpd where gbpd.station_event_id  = '$station_event_id' order by gbpd.bad_pieces_id DESC");
                                $qur = mysqli_query($db, $query);
                                while ($rowc = mysqli_fetch_array($qur)) {
                                    $bad_pieces_id = $rowc['bad_pieces_id'];
                                    $good_pieces = $rowc['good_pieces'];
                                    $bad_pieces = $rowc['bad_pieces'];
                                    $rework = $rowc['rework'];
                                    $style = "";

                                    ?>
                                    <tr>
                                        <td class="text-center"><label class="ckbox"><input type="checkbox" id="delete_check[]" name="delete_check[]" value="<?php echo $rowc["bad_pieces_id"]; ?>"><span></span></label></td>
                                        <td><?php echo ++$counter; ?></td>
                                        <td><?php if($rowc['good_pieces'] != ""){echo $rowc['good_pieces']; }else{ echo $line; } ?></td>
                                        <td><?php $un = $rowc['defect_name']; if($un != ""){ echo $un; }else{ echo $line; } ?></td>
                                        <td><?php if($rowc['bad_pieces'] != ""){echo $rowc['bad_pieces'];}else{ echo $line; } ?></td>
                                        <td><?php if($rowc['rework'] != ""){echo $rowc['rework']; }else{ echo $line; } ?></td>
                                        <?php
                                        $qur04 = mysqli_query($db, "SELECT * FROM good_bad_pieces_details where station_event_id= '$station_event_id' ORDER BY `bad_pieces_id` DESC LIMIT 1");
                                        $rowc04 = mysqli_fetch_array($qur04);
                                        $bad_trace_id = $rowc04["bad_pieces_id"];

                                        $query1 = sprintf("SELECT bad_piece_id,good_image_name FROM  good_piece_images where bad_piece_id = '$bad_trace_id'");
                                        $qur1 = mysqli_query($db, $query1);
                                        $rowc1 = mysqli_fetch_array($qur1);
                                        $item_id = $rowc1['bad_piece_id'];
                                        $image_name = $rowc1['good_image_name'];

                                        ?>
                                        <?php
                                        if($rowc['good_pieces'] != ""){ ?>
                                            <td><span class="badge badge-success">Good Pieces</span></td>
                                        <?php }
                                        if($rowc['bad_pieces'] != ""){ ?>
                                            <td><span class="badge badge-danger">Bad Pieces</span></td>
                                        <?php }
                                        if($rowc['rework'] != ""){ ?>
                                            <td><span class="badge badge-primary">Rework Pieces</span></td>
                                        <?php } ?>

                                        <td class="">
                                            <?php   if($rowc['good_pieces'] != ""){ ?>
                                                <a  href="<?php echo $siteURL; ?>events_module/edit_good_piece.php?station_event_id=<?php echo $station_event_id; ?>&bad_pieces_id=<?php echo $bad_pieces_id;?>" data-id="<?php echo $rowc['good_bad_pieces_id']; ?>" data-gbid="<?php echo $rowc['bad_pieces_id']; ?>" data-seid="<?php echo $station_event_id; ?>" data-good_pieces="<?php echo $rowc['good_pieces']; ?>"
                                                    data-defect_name="<?php echo $rowc['defect_name']; ?>" data-bad_pieces="<?php echo $rowc['bad_pieces']; ?>" data-re_work="<?php echo $rowc['rework']; ?>" data-image="<?php echo $item_id; ?>"
                                                    data-image_name="<?php echo $image_name; ?>" class="btn btn-success btn-sm br-5 me-2" id="edit">
                                                    <i>
                                                        <svg class="table-edit" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-.45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z"></path></svg>
                                                    </i>
                                                </a>
                                            <?php } elseif($rowc['bad_pieces'] != ""){?>
                                                <a href="<?php echo $siteURL; ?>events_module/edit_bad_piece.php?station_event_id=<?php echo $station_event_id; ?>&bad_pieces_id=<?php echo $bad_pieces_id;?>" data-id="<?php echo $rowc['good_bad_pieces_id']; ?>" data-gbid="<?php echo $rowc['bad_pieces_id']; ?>" data-seid="<?php echo $station_event_id; ?>" data-good_pieces="<?php echo $rowc['good_pieces']; ?>"
                                                   data-defect_name="<?php echo $rowc['defect_name']; ?>" data-bad_pieces="<?php echo $rowc['bad_pieces']; ?>" data-re_work="<?php echo $rowc['rework']; ?>" data-image="<?php echo $item_id; ?>"
                                                   data-image_name="<?php echo $image_name; ?>" class="btn btn-success btn-sm br-5 me-2" id="edit">
                                                    <i>
                                                        <svg class="table-edit" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-.45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z"></path></svg>
                                                    </i>
                                                </a>
                                                <?php if($rowc['bad_pieces'] != "")  { ?>
                                                    <a href="<?php echo $siteURL; ?>events_module/view_bad_piece.php?station_event_id=<?php echo $station_event_id; ?>&bad_pieces_id=<?php echo $bad_pieces_id;?>" data-id="<?php echo $rowc['good_bad_pieces_id']; ?>" data-gbid="<?php echo $rowc['bad_pieces_id']; ?>" data-seid="<?php echo $station_event_id; ?>" data-good_pieces="<?php echo $rowc['good_pieces']; ?>"
                                                       data-defect_name="<?php echo $rowc['defect_name']; ?>" data-bad_pieces="<?php echo $rowc['bad_pieces']; ?>" data-re_work="<?php echo $rowc['rework']; ?>" data-image="<?php echo $item_id; ?>" class="btn btn-success btn-sm br-5 me-2" id="edit">
                                                        <i class="fa fa-eye" style="padding: 4px;font-size: 14px;margin-left: -3px;"></i>
                                                    </a> <?php }else{ echo $line; } ?>
                                            <?php } else{ ?>
                                                <a href="<?php echo $siteURL; ?>events_module/rework_piece.php?station_event_id=<?php echo $station_event_id; ?>&bad_pieces_id=<?php echo $bad_pieces_id;?>" data-id="<?php echo $rowc['good_bad_pieces_id']; ?>" data-gbid="<?php echo $rowc['bad_pieces_id']; ?>" data-seid="<?php echo $station_event_id; ?>" data-good_pieces="<?php echo $rowc['good_pieces']; ?>"
                                                   data-defect_name="<?php echo $rowc['defect_name']; ?>" data-bad_pieces="<?php echo $rowc['bad_pieces']; ?>" data-re_work="<?php echo $rowc['rework']; ?>" data-image="<?php echo $item_id; ?>"
                                                   data-image_name="<?php echo $image_name; ?>" class="btn btn-success btn-sm br-5 me-2" id="edit">
                                                    <i>
                                                        <svg class="table-edit" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-.45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z"></path></svg>
                                                    </i>
                                                </a>
                                            <?php } ?>
                                        </td>
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
    <!-- Container closed -->
</div>
<!-- main-content closed -->



<!-- Footer opened -->
<?php include('../footer1.php') ?>

<!-- Footer closed -->


<script>
    //Efficiency
    anychart.onDocumentReady(function () {
        var data = this.window.location.href.split('?')[1];
        $.ajax({
            type: 'POST',
            url: 'gbp_eff.php',
            // dataType: 'good_bad_piece_fa.php',
            data: data,
            success: function (data1) {
                var data = JSON.parse(data1);
                // console.log(data);
                var target_eff = data.posts.map(function (elem) {
                    return elem.target_eff;
                });
                // console.log(goodpiece);
                // var avg_npr = data.posts.map(function (elem) {
                //     return elem.avg_npr;
                // });
                var actual_eff = data.posts.map(function (elem) {
                    return elem.actual_eff;
                });

                var eff = data.posts.map(function (elem) {
                    return elem.eff;
                });
                // var range1 = avg_npr;
                var range1 = actual_eff;
                var range2 = target_eff;
                var range3 = eff;

                var fill3 = '#009900 0.8';
                var fill2 = '#B31B1B 0.8';
                var fill1 = '#B31B1B 0.8';

                var maxr3 =  parseFloat(range2) + parseFloat(range2 * .2)


                if((actual_eff >= target_eff)){
                    range1 = target_eff;
                    // range2 = avg_npr;
                    range2 = actual_eff;
                    fill1 = '#009900 0.8';
                    fill2 = '#009900 0.8';
                    fill3 = '#B31B1B 0.8';
                    maxr3 =  parseFloat(target_eff) + parseFloat(target_eff * .2)
                }

                var gauge = anychart.gauges.circular();
                gauge
                    .fill('#fff')
                    .stroke(null)
                    .padding(50)
                    .margin(0)
                    .startAngle(270)
                    .sweepAngle(180);

                gauge
                    .axis()
                    .labels()
                    .padding(5)
                    .fontSize(15)
                    .position('outside')
                    .format('{%Value}');

                gauge.data([actual_eff]);
                gauge
                    .axis()
                    .scale()
                    .minimum(0)
                    .maximum(maxr3)
                    .ticks({ interval: 1 })
                    .minorTicks({ interval: 1 });

                gauge
                    .axis()
                    .fill('#545f69')
                    .width(1)
                    .ticks({ type: 'line', fill: 'white', length: 2 });

                gauge.title(
                    /* '<div style=\'color:#333; font-size: 20px;\'> <span style="color:#009900; font-size: 22px;"><strong> ' +target_eff+' </strong><l/span></div>' +
                     '<br/><br/><div style=\'color:#333; font-size: 20px;\'> <span style="color:#009900; font-size: 22px;"><strong> ' +actual_eff+' </strong></span></div><br/><br/>' +
                     '<div style=\'color:#333; font-size: 20px;\'> <span style="color:#009900; font-size: 22px;"><strong> ' +eff+' </strong>%</span></div><br/><br/>'*/
                );

                gauge
                    .title()
                    .useHtml(true)
                    .padding(0)
                    .fontColor('#212121')
                    .hAlign('center')
                    .margin([0, 0, 10, 0]);

                gauge
                    .needle()
                    .stroke('2 #545f69')
                    .startRadius('5%')
                    .endRadius('90%')
                    .startWidth('0.1%')
                    .endWidth('0.1%')
                    .middleWidth('0.1%');

                gauge.cap().radius('3%').enabled(true).fill('#545f69');

                gauge.range(0, {
                    from: 0,
                    to: range1,
                    position: 'inside',
                    fill: fill1,
                    startSize: 50,
                    endSize: 50,
                    radius: 98
                });

                gauge.range(1, {
                    from: range1,
                    to: range2,
                    position: 'inside',
                    fill: fill2,
                    startSize: 50,
                    endSize: 50,
                    radius: 98
                });

                gauge.range(2, {
                    from: range2,
                    to: (maxr3),
                    position: 'inside',
                    fill: '#009900 0.8',
                    startSize: 50,
                    endSize: 50,
                    radius: 98

                });

                gauge
                    .label(1)
                    .text('')
                    .fontColor('#212121')
                    .fontSize(20)
                    .offsetY('68%')
                    .offsetX(25)
                    .anchor('center');
                gauge
                    .label(2)
                    .text('')
                    .fontColor('#212121')
                    .fontSize(20)
                    .offsetY('68%')
                    .offsetX(90)
                    .anchor('center');

                gauge
                    .label(3)
                    .text('')
                    .fontColor('#212121')
                    .fontSize(20)
                    .offsetY('68%')
                    .offsetX(155)
                    .anchor('center');


                // set container id for the chart
                gauge.container('eff_container');
                // initiate chart drawing
                gauge.draw();
            }
        });
    });
</script>
<script> $(document).on('click', '#add_gp', function () {
        var element = $(this);
        var del_id = element.attr("data-id");
        var info = 'station_event_id=' + <?php echo $station_event_id; ?>;
        var url = window.location.origin + "/events_module/add_good_piece.php?" + info;
        window.close();
        window.open(url,"_blank");

    });</script>

<script>
    $("#submitForm_good").click(function (e) {

        // function submitForm_good(url) {

        $(':input[type="button"]').prop('disabled', true);
        var data = $("#good_form").serialize();
        //var main_url = "<?php //echo $url; ?>//";
        $.ajax({
            type: 'POST',
            url: 'create_good_bad_piece.php',
            data: data,
            // dataType: "json",
            // context: this,
            async: false,
            success: function (data) {
                // window.location.href = window.location.href + "?aa=Line 1";
                // $(':input[type="button"]').prop('disabled', false);
                var line_id = this.data.split('&')[1].split("=")[1];
                var pe = this.data.split('&')[2].split("=")[1];
                var ff1 = this.data.split('&')[3].split("=")[1];
                var file1 = '../assets/label_files/' + line_id +'/g_'+ff1;
                var file = '../assets/label_files/' + line_id +'/g_'+ff1;;
                var ipe = document.getElementById("ipe").value;
                if(pe == '1'){
                    if(ipe == '1'){
                        var i;
                        var nogp = document.getElementById("good_name").value;
                        //alert('no of good pieces are' +nogp);
                        //for(var i = 1; i <= nogp; i++) {
                        document.getElementById("resultFrame").contentWindow.ss(file1);
                        // alert('no of good pieces are' +nogp);
                        //}
                        // document.getElementById("resultFrame").contentWindow.ss(file , nogp);
                    }else{
                        document.getElementById("resultFrame").contentWindow.ss(file1);
                    }
                }
                //var ipe = this.data.split('&')[2].split("=")[1];
                // location.reload();
            }
        });

    });

    $("#submitForm_bad").click(function (e) {

        // function submitForm_good(url) {

        $(':input[type="button"]').prop('disabled', true);
        var data = $("#bad_form").serialize();
        //var main_url = "<?php //echo $url; ?>//";
        $.ajax({
            type: 'POST',
            url: 'create_good_bad_piece.php',
            data: data,
            // dataType: "json",
            // context: this,
            async: false,
            success: function (data) {
                // window.location.href = window.location.href + "?aa=Line 1";
                // $(':input[type="button"]').prop('disabled', false);
                var line_id = this.data.split('&')[1].split("=")[1];
                var pe = this.data.split('&')[2].split("=")[1];
                var ff2 = this.data.split('&')[3].split("=")[1];
                var deftype = this.data.split('&')[6].split("=")[1];
                var file2 = '../assets/label_files/' + line_id +'/b_'+ff2;
                if((pe == '1') && (deftype != 'bad_piece')){
                    document.getElementById("resultFrame").contentWindow.ss(file2);
                }

                // location.reload();
            }
        });

    });

    $("#search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".view_gpbp").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

</script>
<script>
    $(document).on('click', '#view', function () {
        var element = $(this);
        //var edit_id = element.attr("data-id");
        var buttonid = $(this).data("buttonid");
        $("#add_defect_name").val($(this).data("defect_name"));
    });
    $(document).on('click', '#edit', function () {
        var element = $(this);
        var edit_id = element.attr("data-id");
        var edit_gbid = element.attr("data-gbid");
        var edit_seid = element.attr("data-seid");
        var editgood_name = $(this).data("good_pieces");
        var editdefect_name = $(this).data("defect_name");
        var editbad_name = $(this).data("bad_pieces");
        var editre_work = $(this).data("re_work");
        var edit_image = $(this).data("data-image");
        $("#editgood_name").val(editgood_name);
        $("#editdefect_name").val(editdefect_name);
        $("#editbad_name").val(editbad_name);
        $("#editre_work").val(editre_work);
        $("#editimage").val(edit_image);
        $("#edit_id").val(edit_id);
        $("#edit_gbid").val(edit_gbid);
        $("#edit_seid").val(edit_seid);

        if(editgood_name != "")
        {
            // $("#badpiece").hide();
            // $("#badpiece1").hide();
            // $("#badpiece2").hide();
            // $("#goodpiece").show();

            window.location = "<?php echo $siteURL; ?>events_module/edit_good_piece.php?station=<?php echo $station; ?>&station_event_id=<?php echo $station_event_id; ?>&bad_pieces_id=<?php echo $bad_pieces_id;?>";


        }else if(editbad_name != ""){
            // $("#badpiece").show();
            // $("#badpiece1").show();
            // $("#badpiece2").hide();
            // $("#goodpiece").hide();
            window.location = "<?php echo $siteURL; ?>events_module/edit_bad_piece.php?station=<?php echo $station; ?>&station_event_id=<?php echo $station_event_id; ?>";

        }
        //else if(editre_work != "")
        //{
        //    // $("#badpiece").show();
        //    // $("#badpiece1").hide();
        //    // $("#badpiece2").show();
        //    //
        //    // $("#goodpiece").hide();
        //    window.location = "<?php //echo $siteURL; ?>//events_module/add_bad_piece.php?station_event_id=<?php //echo $station_event_id; ?>//";
        //
        //}
    });
</script>
<script>
    $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
    $('#generate').click(function () {
        let r = Math.random().toString(36).substring(7);
        $('#newpass').val(r);
    })

    $('#choose').on('change', function () {
        var selected_val = this.value;
        if (selected_val == 1 || selected_val == 2) {
            $(".group_div").show();
        } else {
            $(".group_div").hide();
        }
    });


</script>
<script>


    function submitForm_edit(url) {

        $(':input[type="button"]').prop('disabled', true);
        var data = $("#edit_form").serialize();
        var main_url = "<?php echo $url; ?>";
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
<script>
    //window.onload = function() {
    //    history.replaceState("", "", "<?php //echo $scriptName; ?>//events_module/good_bad_piece_new.php?station=<?php //echo $station;?>//&station_event_id=<?php //echo $station_event_id; ?>//");
    //}
</script>
<script>
    // Upload

    $("#file").on("change", function () {
        var fd = new FormData();
        var files = $('#file')[0].files[0];
        fd.append('file', files);
        fd.append('request', 1);

        // AJAX request
        $.ajax({
            url: 'add_delete_good_bad_piece_image.php',
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
        var succ = false;
        // AJAX request
        $.ajax({
            url: 'add_delete_good_bad_piece_image.php',
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

            });
            fileReader.readAsDataURL(f);
        }
    });

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
                image.title  = file.name;
                image.src    = this.result;
                preview.appendChild(image);
            });

            reader.readAsDataURL(file);

        }

    }

    document.querySelector('#file-input').addEventListener("change", previewImages);
</script>



</body>
</html>
