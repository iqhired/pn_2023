<?php
include("../config.php");
$chicagotime = date("Y-m-d H:i:s");
$temp = "";
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

$u_id = $_GET['id'];

if (count($_POST) > 0) {
//edit
    $id = $_POST['edit_id'];

    $edit_ratings = $_POST['edit_ratings'];

    $sql = "update cam_user_rating set ratings ='$edit_ratings' where user_rating_id='$id'";

    $result1 = mysqli_query($db, $sql);
    if ($result1) {
        $message_stauts_class = 'alert-success';
        $import_status_message = 'User ratings Updated successfully.';
    } else {
        $message_stauts_class = 'alert-danger';
        $import_status_message = 'Error: Please Insert valid data';
    }

    header('location: user_ratings.php');

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo $sitename; ?> | Edit User Rating</title>
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
        .badge {
            padding: 0.5em 0.5em!important;
            width: 100px;
            height: 23px;
        }

    </style>

    <!-- Main navbar -->
    <?php
    $cust_cam_page_header = "Edit User Rating";
    include("../header.php");
    include("../admin_menu.php");
    ?>

    <!-----body-------->
<body class="ltr main-body app sidebar-mini">
<!-----main content----->
<div class="main-content app-content">
    <!---container--->
    <!---breadcrumb--->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">User Config</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit User Station-Pos-Rating</li>
            </ol>
        </div>
    </div>

    <form action="" id="user_form" class="form-horizontal" method="post">
        <div class="row-body">
            <div class="col-lg-12 col-md-12">
                <?php
                $edit_id = $_GET['id'];

                $sql1 = "SELECT * FROM `cam_user_rating` where user_rating_id = '$edit_id' ";
                $result1 = mysqli_query($db, $sql1);

                while ($row1 = mysqli_fetch_array($result1)) {
                    $position = $row1['position_id'];
                    $line_id = $row1['line_id'];
                    $user_id = $row1['user_id'];
                    $ratings = $row1['ratings'];
                }
                ?>
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">EDIT USER RATINGS</span>
                        </div>
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-1">
                                    <label class="form-label mg-b-0">Station</label>
                                </div>
                                <div class="col-md-6 mg-t-10 mg-md-t-0">
                                    <input type="hidden" name="edit_id" value="<?php echo $edit_id; ?>">
                                    <select name="edit_line_name" id="edit_line_name" class="form-control" >
                                        <option value="" disabled>--- Select Station ---</option>
                                        <?php
                                        $sql_line = "SELECT line_id,line_name FROM `cam_line`";
                                        $result_line = mysqli_query($db,$sql_line);
                                        while ($row_line = mysqli_fetch_array($result_line)) {
                                            if($line_id == $row_line['line_id']){
                                                $entry = 'selected';
                                            }else{
                                                $entry = '';
                                            }
                                            echo "<option value='" . $row_line['line_id'] . "'$entry>" . $row_line['line_name'] . "</option>";
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>
                        </div>

                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-1">
                                    <label class="form-label mg-b-0">Position</label>
                                </div>
                                <div class="col-md-6 mg-t-10 mg-md-t-0">
                                    <select name="edit_position_name" id="edit_position_name" class="form-control"  >
                                        <option value="" disabled>--- Select Position ---</option>
                                        <?php
                                        $sql1 = "SELECT position_id,position_name FROM `cam_position`";
                                        $result1 = mysqli_query($db,$sql1);
                                        while ($row1 = mysqli_fetch_array($result1)) {
                                            if($position == $row1['position_id']){
                                                $entry = 'selected';
                                            }else{
                                                $entry = '';
                                            }
                                            echo "<option value='" . $row1['position_id'] . "'$entry>" . $row1['position_name'] . "</option>";
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>
                        </div>

                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-1">
                                    <label class="form-label mg-b-0">User</label>
                                </div>
                                <div class="col-md-6 mg-t-10 mg-md-t-0">
                                    <input type="hidden" name="edit_e" id="edit_e" >
                                    <select name="edit_user_name" id="edit_user_name" class=" form-control"  >
                                        <option value="" disabled>--- Select User ---</option>
                                        <?php
                                        $sql1 = "SELECT users_id,firstname,lastname FROM `cam_users`  where `users_id` != '1' order BY `user_name`";
                                        $result1 = mysqli_query($db,$sql1);
                                        while ($row1 =mysqli_fetch_array($result1)) {
                                            if($user_id == $row1['users_id']){
                                                $entry = 'selected';
                                            }else{
                                                $entry = '';
                                            }
                                            echo "<option value='" . $row1['user_id'] . "'$entry>" . $row1['firstname']. " " .$row1['lastname']. "</option>";
                                        }
                                        ?>
                                    </select>

                                </div>
                            </div>
                        </div>


                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-1">
                                    <label class="form-label mg-b-0">Ratings</label>
                                </div>
                                <div class="col-md-6 mg-t-10 mg-md-t-0">
                                    <select name="edit_ratings" id="edit_ratings" class="form-control"  >

                                        <option value="0" <?php if($ratings == '0'){echo 'selected';} ?> >0</option>
                                        <option value="1" <?php if($ratings == '1'){echo 'selected';} ?>>1</option>
                                        <option value="2" <?php if($ratings == '2'){echo 'selected';} ?>>2</option>
                                        <option value="3" <?php if($ratings == '3'){echo 'selected';} ?>>3</option>
                                        <option value="4" <?php if($ratings == '4'){echo 'selected';} ?>>4</option>
                                        <option value="5" <?php if($ratings == '5'){echo 'selected';} ?>>5</option>
                                    </select>


                                </div>
                            </div>
                        </div>

                        <div class="card-body pt-0">

                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>










                    </div>
                </div>
            </div>

        </div>
</div>
</form>


</div>
<?php include('../footer1.php') ?>

</body>

