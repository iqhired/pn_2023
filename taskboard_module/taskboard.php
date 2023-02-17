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
$timestamp = date('H:i:s');
$message = date("Y-m-d H:i:s");
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
    <script type="text/javascript" src="<?php echo $siteURL; ?>assets/js/form_js/jquery-min.js"></script>
    <script type="text/javascript" src="<?php echo $siteURL; ?>assets/js/libs/jquery-3.6.0.min.js"></script>
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
        .dropdown-menu {
            background-clip: padding-box;
            background-color: #fff;
            border: 1px solid #ededf5;
            border-radius: 5px!important;
            box-shadow: 0 16px 18px rgba(135,135,182,.1)!important;
            color: #4a4a69;
            display: none;
            float: left;
            font-size: .875rem;
            left: 0;
            list-style: none;
            margin: 1.125rem 0px 0px;
            min-width: 14rem!important;
            padding: 0.5rem 0;
            position: absolute;
            text-align: left;
            top: 100%;
            z-index: 999;
            margin-top: 12px;
            height: 100px;

        }

    </style>
</head>


<!-- Main navbar -->
<?php
$cust_cam_page_header = "Cell Status Dashboard";
include("../header.php");
include("../admin_menu.php");

?>

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
            $query = sprintf("SELECT * FROM  sg_taskboard ");
            $qur = mysqli_query($db, $query);
            $countervariable = 0;
            while ($rowc = mysqli_fetch_array($qur)) {
            $countervariable++;
            $userassign = 0;
            $useravailable = 0;
            $group_id = $rowc["group_id"];
            $buttonclass = "";
            $qur01 = mysqli_query($db, "SELECT count(*) as star1 FROM  sg_user_group where group_id = '$group_id'");
            $rowc01 = mysqli_fetch_array($qur01);
            $usrcount = $rowc01["star1"];
            $qur01q = mysqli_query($db, "SELECT * FROM  sg_group where group_id = '$group_id'");
            $rowc01q = mysqli_fetch_array($qur01q);
            $group_name = $rowc01q["group_name"];
            $qur04 = mysqli_query($db, "SELECT * FROM  cam_assign_crew_log where station_id = '$line' and status = '1' ORDER BY `assign_time` ASC ");
            while ($rowc04 = mysqli_fetch_array($qur04)) {
                $last_assignedby = $rowc04["last_assigned_by"];
            }
            $qur05 = mysqli_query($db, "SELECT * FROM  cam_assign_crew_log where station_id = '$line' and status = '0' ORDER BY `unassign_time` ASC ");
            while ($rowc05 = mysqli_fetch_array($qur05)) {
                $last_un_assignedby = $rowc05["last_unassigned_by"];
            }
            $qur06 = mysqli_query($db, "SELECT * FROM  sg_user_group where group_id = '$group_id' ");
            while ($rowc06 = mysqli_fetch_array($qur06)) {
                $u1 = $rowc06["user_id"];
                $qur07 = mysqli_query($db, "SELECT * FROM  tm_task where assign_to = '$u1' and status = '1' ");
                while ($rowc07 = mysqli_fetch_array($qur07)) {
                    $userassign++;
                }
                $qur08 = mysqli_query($db, "SELECT * FROM  cam_users where users_id = '$u1' and available = '1' ");
                while ($rowc08 = mysqli_fetch_array($qur08)) {
                    $useravailable++;
                }
            }
            $total = $useravailable - $userassign;
            ?>
                        <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4" >
                            <div class="card custom-card">
                                <div class="card-header d-flex custom-card-header border-bottom-0 ">
                                    <h5 class="card-title"><?php echo $rowc["taskboard_name"]; ?></h5>
                                    <div class="card-options">
                                        <ul class="icons-list">
                                            <li class="dropdown">
                                                <a href="#" class="dropdown-toggle btn btn-sm" data-toggle="dropdown" ><i class="fa fa-bars" aria-hidden="true"></i></a>
                                                <ul class="dropdown-menu dropdown-menu-right">
                                                    <li><a href="view_taskboard_crew.php?group_id=<?php echo $rowc["group_id"]; ?>&taskboard=<?php echo $rowc["taskboard_name"]; ?>" ><i class="icon-pie5"></i> Dashboard</a></li>
                                                    <li><a href="create_task.php?taskboard=<?php echo $rowc["sg_taskboard_id"]; ?>" ><i class="icon-sync"></i>Create / Edit Task</a></li>
                                                    <li><a href="taskboard_users_list.php?group_id=<?php echo $rowc["group_id"]; ?>&taskboard=<?php echo $rowc["taskboard_name"]; ?>" ><i class="icon-cross3"></i> Users list</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <table>
                                        <tr>
                                            <td style="width: 40%;">
                                                <div class="tr-row">Total User :</div></td>

                                            <td style="width: 60%;">
                                    <span><?php echo $usrcount; ?> </span>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 40%;">
                                                <div class="tr-row">Available User : </div>
                                            </td>
                                            <td style="width: 60%;"><span><?php echo $total; ?>/<?php echo $useravailable; ?></span></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 40%;">
                                                <div class="tr-row">Group Name :</div>
                                            </td>
                                            <td style="width: 60%;"><span><?php echo $group_name; ?></span></td>
                                        </tr>
                                    </table>
                                </div>

                            </div>
                        </div>
                        <?php
                    } ?>

        </div>
    </div>
</div>
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
    function cellDB(cell_ID , c_name) {
        window.open("<?php echo site_URL . "cell_overview_dashboard.php?cell_id=" ; ?>" + cell_ID + "<?php echo "&c_name=" ; ?>" + c_name , "_self")
    }
    // setTimeout(function () {
    //    location.reload();
    // }, 60000);
</script>
<?php include("footer1.php");?> <!-- /page container -->

</body>
</html>
