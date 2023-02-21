<?php
include("../config.php");
$chicagotime = date("Y-m-d H:i:s");
$temp = "";
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
//  header('location: ../logout.php');
    exit;
}
//Set the time of the user's last activity
$_SESSION['LAST_ACTIVITY'] = $time;

$i = $_SESSION["role_id"];
if ($i != "super" && $i != "admin") {
    header('location: ../dashboard.php');
}
$array_station = $_POST['menu_value'];
$user_id = $_SESSION["id"];
if(isset($array_station) && count($array_station) > 0) {
    $line_str = '';
    foreach ($array_station as $station) {
        $line_str .= $station . ',';
    }
    $sqlquery = "update `cam_users` set is_cust_dash=1 , line_cust_dash = '$line_str' where users_id = '$user_id'";
    if (!mysqli_query($db, $sqlquery)) {
        $message_stauts_class = 'alert-danger';
        $import_status_message = 'Error: Unable to update Stations. Please try after sometime';
    } else {
        $temp = "one";
        $_SESSION['line_cust_dash'] = $line_str;
        $_SESSION['is_cust_dash'] = 1;
        $line_cust_dash_arr = explode(',', $line_str);
    }
}
else {
    $sqlquery = "update `cam_users` set is_cust_dash = 0 , line_cust_dash = '' where users_id = '$user_id'";
    if (mysqli_query($db, $sqlquery)) {
        $_SESSION['is_cust_dash'] = 0;
        $_SESSION['line_cust_dash'] = '';
        $message_stauts_class = 'alert-success';
        $import_status_message = 'Custom Dashboard Settings updated Successfully';
    } else {
        $message_stauts_class = 'alert-danger';
        $import_status_message = 'Error updating Custom Dashboard Settings. Try after sometime.';
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
        <?php echo $sitename; ?> |Custom Dashboard</title>
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
    <!----------------------->


    <link href="../assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/colors.css" rel="stylesheet" type="text/css">
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


<!-- Main navbar -->
<body class="ltr main-body app horizontal">

<?php
$cust_cam_page_header = "Custom Dashboard";
include("../header.php");
include("../admin_menu.php");
?>

<!-----main content----->
<div class="main-content app-content">
    <div class="main-container container-fluid">

    <!---container--->
    <!---breadcrumb--->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">User Config</a></li>
                <li class="breadcrumb-item active" aria-current="page">Custom Dashboard</li>
            </ol>
        </div>
    </div>
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="">
                    <div class="card-header">
                        <span class="main-content-title mg-b-0 mg-b-lg-1">CUSTOM DASHBOARD</span>
                    </div>


                    <div class="page-container">
                        <!-- Page content -->

                        <!-- Content area -->
                        <div class="content">
                            <!-- Main charts -->
                            <!-- Basic datatable -->
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h5 class="panel-title">Select Station(s) for Custom Dashboard</h5>
                                    <hr/>
                                    <form action="" id="user_form" class="form-horizontal" method="post" style="padding: 15px;">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div id="error1" class="red" style="display:none;color:red;">Please select Station</div>
                                                    <div class="row">
                                                        <div id="error1" class="red" style="display:none;color:red;">Please select Module</div>
                                                        <?php
                                                        $query12 = sprintf("SELECT * FROM  cam_line where enabled = 1 order by line_name ASC");
                                                        $qur12 = mysqli_query($db, $query12);
                                                        while ($rowc12 = mysqli_fetch_array($qur12)) {
                                                            $parentid = $rowc12["line_id"];

                                                            ?>
                                                            <div class="col-md-3 rmchk">
                                                                <div class="checkbox">
                                                                    <label>
                                                                        <input type="checkbox" class="control-primary chk_menu" name="menu_value[]" id="<?php echo $parentid; ?>" value="<?php echo $parentid; ?>"  <?php if(in_array("$parentid", $line_cust_dash_arr)){echo "checked";}?> >
                                                                        <?php echo $rowc12["line_name"]; ?>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>

                                                    </div>
                                                    <div class="row" style="margin-top: 25px;">
                                                        <div class="col-md-4">
                                                            <button type="submit" class="btn btn-primary create" style="background-color:#1e73be;">Save</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- /basic datatable --><!-- /page content -->
    </div>
</div>


    <!-- /page container -->

    <script>
        window.onload = function() {
            $(".control-primary").uniform({
                radioClass: 'choice',
                wrapperClass: 'border-primary-600 text-primary-800'
            });
            $(".control-danger").uniform({
                radioClass: 'choice',
                wrapperClass: 'border-danger-600 text-danger-800'
            });
            history.replaceState("", "", "<?php echo $scriptName; ?>user_module/user_custom_dashboard.php");
        }
    </script>
    <script>
        $("#checkAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });


    </script>

    <script>
        $('button[type="submit"]').on('click', function() {
            var flag = 0;
            if($("#name").val().length > 0){

                $("#error2").hide();

            }else{
                var flag = 1;
                $("#error2").show();


            }
            // skipping validation part mentioned above
            //if($('.chk_menu:checkbox:checked').length > 0){
            if($('.checked').length > 0){

                $("#error1").hide();
            }else{
                var flag = 1;
                $("#error1").show();
            }

            if(flag == 0){
                return true;
            }
            else{
                return false;
            }

        });
        $(".chk_menu").click(function() {
            var value_c =   $(this).val();
            if($(this).prop("checked") == true){

                $(".cl"+value_c).show();

            } else {
                var abc = "cl" +value_c+" span";
                //      console.log(abc);
                $(".cl"+value_c).hide();
                $(".cl"+value_c).find('input:checkbox:first').prop('checked', false);
                //  $(".cl"+value_c).prop('checked', false);
                $('.'+ abc).removeClass();

            }
        });


    </script>
    <?php include ('../footer1.php') ?>
</body>
</html>
