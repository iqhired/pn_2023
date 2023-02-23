<?php include("config.php");
if (!isset($_SESSION['user'])) {
    header($redirect_tab_logout_path);
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
    header($redirect_tab_logout_path);
//	header('location: ../logout.php');
    exit;
}
//Set the time of the user's last activity
$_SESSION['LAST_ACTIVITY'] = $time;

$timestamp = date('H:i:s');
$message = date("Y-m-d H:i:s");
$line_cust_dash = $_SESSION['line_cust_dash'];
$role = $_SESSION['role_id'];
$is_admin = (($role != null) && (isset($role)) && ($role == 'admin'))?1:0;
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

    <!-- STYLES CSS -->
    <link href="<?php echo $siteURL; ?>assets/css/form_css/style.css" rel="stylesheet">
    <link href="<?php echo $siteURL; ?>assets/css/form_css/style-dark.css" rel="stylesheet">
    <link href="<?php echo $siteURL; ?>assets/css/form_css/style-transparent.css" rel="stylesheet">

    <!-- Internal form-elements js -->
    <script src="<?php echo $siteURL; ?>assets/js/form_js/form-elements.js"></script>
    <link href="<?php echo $siteURL; ?>assets/css/form_css/demo.css" rel="stylesheet"/>

    <style>
        .main-content{
            max-width: 95%;
            padding: 0 !important;
            margin: auto !important;
        }
        .main-container {
            max-width: 85% !important;
            padding: 0;
            margin: auto !important;
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


        table.dataTable thead .sorting:after {
            content: ""!important;
            top: 49%;
        }
        .card-title:before{
            width: 0;

        }
        .main-footer {
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
        .header{
            background-color: #1c4e8018 !important;
        }
        .navbar{
            background-color: #073857 !important;
            height: 40px !important;
        }



    </style>
</head>
<?php
$cust_cam_page_header = "Cell Status Dashboard";
include("tab_header.php");
include("tab_menu.php"); ?>
<body class="pace-done">
<!-- main-content -->
<div class="main-content horizontal-content">
    <div class="main-container container">
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

        <div class="row">
            <?php
            $query = sprintf("SELECT * FROM  cam_line where enabled = '1' and line_id = '$tab_line'");
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
                $qur01 = mysqli_query($db, "SELECT pn.part_number as p_num, pn.part_name as p_name , pf.part_family_name as pf_name, et.event_type_name as e_name ,et.color_code as color_code , sg_events.modified_on as updated_time ,sg_events.station_event_id as station_event_id , sg_events.event_status as event_status , sg_events.created_on as e_start_time FROM sg_station_event as sg_events inner join event_type as et on sg_events.event_type_id=et.event_type_id Inner Join pm_part_family as pf on sg_events.part_family_id = pf.pm_part_family_id inner join pm_part_number as pn on sg_events.part_number_id=pn.pm_part_number_id where sg_events.line_id= '$line' ORDER by sg_events.created_on DESC LIMIT 1");
                $rowc01 = mysqli_fetch_array($qur01);
                if($rowc01 != null){
                    $time = $rowc01['updated_time'];
                    $station_event_id = $rowc01['station_event_id'];
                    $line_status_text = $rowc01['e_name'];
                    $event_status = $rowc01['event_status'];
                    $p_num = $rowc01["p_num"];;
                    $p_name = $rowc01["p_name"];;
                    $pf_name = $rowc01["pf_name"];;
                    $buttonclass = $rowc01["color_code"];
                }
                ?>
                <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4" onclick="cellDB('<?php echo $line; ?>')">
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
                            ?>
                            <script>

                                // Set the date we're counting down to
                                var iddd<?php echo $countervariable; ?> = $("#id<?php echo $countervariable; ?>").val();
                                console.log(iddd<?php echo $countervariable; ?>);
                                var countDownDate<?php echo $countervariable; ?> = new Date(iddd<?php echo $countervariable; ?>).getTime();
                                // Update the count down every 1 second
                                var x = setInterval(function () {
                                    // Get today's date and time
                                    var now = getCurrentTime();
                                    //new Date().getTime();
                                    // Find the distance between now and the count down date
                                    var distance = now - countDownDate<?php echo $countervariable; ?>;
                                    // Time calculations for days, hours, minutes and seconds
                                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                    //console.log(days + "d " + hours + "h "+ minutes + "m " + seconds + "s ");
                                    //console.log("------------------------");
                                    // Output the result in an element with id="demo"
                                    document.getElementById("demo<?php echo $countervariable; ?>").innerHTML = days + "d " + hours + "h "
                                        + minutes + "m " + seconds + "s ";
                                    // If the count down is over, write some text
                                    if (distance < 0) {
                                        clearInterval(x);
                                        document.getElementById("demo<?php echo $countervariable; ?>").innerHTML = "EXPIRED";
                                    }
                                }, 1000);
                            </script>
                        <?php } ?>
                        <div class="card-footer" style="background-color:<?php echo $buttonclass; ?>;color: #fff;">
                            <?php echo $line_status_text; ?> -
                            <span id="demo<?php echo $countervariable; ?>">&nbsp;</span><span id="server-load"></span>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>

        </div>
    </div>
</div>
<script>
    function cellDB(station) {
        window.open("<?php echo $siteURL . "station_float_menu.php?station=" ; ?>"  + station , "_self")
    }
</script>
<?php
$i = $_SESSION["sqq1"];
if ($i == "") {
    ?>
    <script>
        $(document).ready(function () {
            $('#modal_theme_primarydash').modal('show');
        });
    </script>
<?php }
?>
<script>
    setTimeout(function () {
        //alert("reload");
        location.reload();
    }, 60000);
</script>
<?php include("footer1.php");?> <!-- /page container -->

</body>
</html>
