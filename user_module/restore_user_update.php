<?php include("../config.php");
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
//  header('location: ../logout.php');
    exit;
}
//Set the time of the user's last activity
$_SESSION['LAST_ACTIVITY'] = $time;
//if($_SESSION['user'] != "admin"){
//  header('location: dashboard.php');
//}
$i = $_SESSION["role_id"];
if ($i != "super" && $i != "admin") {
    header('location: ../dashboard.php');
}
// to display error msg
if (!empty($_SESSION['import_status_message'])) {
    $message_stauts_class = $_SESSION['message_stauts_class'];
    $import_status_message = $_SESSION['import_status_message'];
    $_SESSION['message_stauts_class'] = '';
    $_SESSION['import_status_message'] = '';
}
$user_id = $_GET['user_id'];
$user_name = $_GET['user_name'];
$sql1 = "SELECT * FROM `cam_users` where `users_id` = '$user_id'";
$result1 = $mysqli->query($sql1);
$rowc1 = $result1->fetch_assoc();
$email = $rowc1['email'];
$trainee = $rowc1['trainee'];
$training_station = $rowc1['training_station'];
$training_position = $rowc1['training_position'];
$mobile = $rowc1['mobile'];
$role = $rowc1['role'];
$s_question1 = $rowc1['s_question1'];
$s_question2 = $rowc1['s_question2'];
$s_question3 = $rowc1['s_question3'];
$firstname = $rowc1['firstname'];
$lastname = $rowc1['lastname'];
$hiring_date = $rowc1['hiring_date'];
$total_days = $rowc1['total_days'];
$job_title_description = $rowc1['job_title_description'];
$shift_location = $rowc1['shift_location'];
if (count($_POST) > 0) {
    $edit_user_id = $_POST['edit_user_id'];
    $name = $_POST['username'];
    $email_id = $_POST['email_id'];
    $edit_firstname = $_POST['edit_firstname'];
    $edit_lastname = $_POST['edit_lastname'];
    $edit_hiring_date = $_POST['edit_hiring_date'];
    $edit_job_title_description = $_POST['edit_job_title_description'];
    $edit_shift_location = $_POST['edit_shift_location'];
    $edit_mobile = $_POST['edit_mobile'];
    $newpass = $_POST['newpass'];
    $edit_role = $_POST['edit_role'];
    $sql121 = "delete from `restore_cam_users` where users_id = '$edit_user_id'";
    mysqli_query($db, $sql121);
    $sql11 = "INSERT INTO `restore_cam_users` select * from cam_users where users_id = '$edit_user_id'";
    if (!mysqli_query($db, $sql11)) {
        $message_stauts_class = 'alert-danger';
        $import_status_message = 'No Data Stored..';
    } else {
        $sql = "update cam_users set user_name='$name',mobile='$edit_mobile',email='$email_id',role='$edit_role',updated_at='$chicagotime',firstname='$edit_firstname',lastname='$edit_lastname',hiring_date='$edit_hiring_date',job_title_description='$edit_job_title_description',shift_location='$edit_shift_location',is_deleted = '0',is_restored = '1' where users_id='$edit_user_id'";
        $result1 = mysqli_query($db, $sql);
        if ($result1) {
            $message_stauts_class = 'alert-success';
            $import_status_message = 'User Data Restored Successfully.';
            $_SESSION['message_stauts_class'] = 'alert-success';
            $_SESSION['import_status_message'] = 'User Data Restored Successfully.';
            $page = "users_list.php";
            header('Location: '.$page, true, 303);
            exit;
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
        <?php echo $sitename; ?> |Update Restore User</title>
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
</head>
<!-- Main navbar -->
<?php
$cust_cam_page_header = "Update Restore Users";
include("../header.php");
include("../admin_menu.php");
?>




  <body class="ltr main-body app sidebar-mini">
<!-----main content----->
<div class="main-content app-content">
    <!---container--->
    <!---breadcrumb--->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">User Config</a></li>
                <li class="breadcrumb-item active" aria-current="page">Update Restore User</li>
            </ol>
        </div>
    </div>


 <form action="" id="user_form" class="form-horizontal" method="post">
        <div class="row-body">
            <div class="col-lg-12 col-md-12">

                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">UPDATE RESTORE USER</span>
                        </div>

                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-3">
                                    <label class="form-label mg-b-0">User Name</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                            <input type="hidden" name="edit_user_id" value="<?php echo $user_id; ?>">
                                        <input type="text" name="username" value="<?php echo $user_name; ?>" class="form-control" required>
                                        <input type="hidden" name="edit_id" id="edit_id" >                                </div>

                            </div>
                        </div>



                         <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-3">
                                    <label class="form-label mg-b-0">Email</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                        <input type="text" name="email_id" value="<?php echo $email; ?>" class="form-control">
                                </div>

                            </div>
                        </div>



                         <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-3">
                                    <label class="form-label mg-b-0">First Name</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                        <input type="text" name="edit_firstname" value="<?php echo $firstname; ?>" class="form-control" required>
                                </div>

                            </div>
                        </div>



                         <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-3">
                                    <label class="form-label mg-b-0">Last Name</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                        <input type="text" name="edit_lastname" value="<?php echo $lastname; ?>" class="form-control" required>
                                </div>

                            </div>
                        </div>



                         <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-3">
                                    <label class="form-label mg-b-0">Hiring Date</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control fc-datepicker" name="edit_hiring_date" value="<?php echo $hiring_date; ?>" placeholder="MM/DD/YYYY" >
                                </div>

                            </div>
                        </div>


                         <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-3">
                                    <label class="form-label mg-b-0">Job Title Description</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <select class="form-control form-select select2" name="edit_job_title_description" id="edit_job_title_description" >
                                                                                <option value="" selected disabled>--- Select Job Title ---</option>

                                            <?php
                                            $sql1 = "SELECT * FROM `cam_job_title`";
                                            $result1 = $mysqli->query($sql1);
                                            while ($row1 = $result1->fetch_assoc()) {
                                                if($job_title_description == $row1['job_name'])
                                                {
                                                    $entry = 'selected';
                                                }
                                                else
                                                {
                                                    $entry = '';
                                                }
                                                echo "<option value='" . $row1['job_name'] . "'$entry>" . $row1['job_name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                  </div>

                            </div>
                        </div>

                         <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-3">
                                    <label class="form-label mg-b-0">Shift Location</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                 <select class="form-control form-select select2" name="edit_shift_location" id="edit_shift_location">
                                    <option value="" selected disabled>--- Select Shift Location ---</option>
                                            <?php
                                            $sql1 = "SELECT * FROM `cam_shift`";
                                            $result1 = $mysqli->query($sql1);
                                            while ($row1 = $result1->fetch_assoc()) {
                                                if($shift_location == $row1['shift_name'])
                                                {
                                                    $entry = 'selected';
                                                }
                                                else
                                                {
                                                    $entry = '';
                                                }
                                                echo "<option value='" . $row1['shift_name'] . "'$entry>" . $row1['shift_name'] . "</option>";
                                            }
                                            ?>
                                        </select>                                
                                    </div>

                            </div>
                        </div>

                         <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-3">
                                    <label class="form-label mg-b-0">Mobile</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                        <input type="text"  name="edit_mobile" id="edit_mobile" class="form-control" pattern= "[0-9]{10}" value="<?php echo $mobile; ?>" class="form-control" >
                                </div>

                            </div>
                        </div>


                         <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-3">
                                    <label class="form-label mg-b-0">New Password</label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <input type="text" name="newpass" id="newpass" class="form-control" required>
                                </div>
                                 <div class="col-sm-1 text-secondary">
                                        <button type="button" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5 submit_btn" name="generate" id="generate" >Generate</button>
                                    </div>

                            </div>
                        </div>


                         <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-3">
                                    <label class="form-label mg-b-0">Role</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                   <select name="edit_role" id="edit_role" class="form-control form-select select2">
                                    <option value="" selected disabled>--- Select Role ---</option>
                                            <?php
                                            $sql1 = "SELECT * FROM `cam_role` where role_id != '0'";
                                            $result1 = $mysqli->query($sql1);
                                            while ($row1 = $result1->fetch_assoc()) {
                                                if($role == $row1['role_id'])
                                                {
                                                    $entry = 'selected';
                                                }
                                                else
                                                {
                                                    $entry = '';
                                                }
                                                echo "<option value='" . $row1['role_id'] . "'$entry>" . $row1['role_name'] . "</option>";
                                            }
                                            ?>
                                        </select>                                </div>

                            </div>
                        </div>


                        <div class="card-body pt-0">
                                    <button type="submit" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5 submit_btn">RESTORE</button>

                                </div>
                    </div>
                </div>

            </div>
        </div>
    </form>


        </div>
   
   </div>
</div>

<script>
    $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
    $('#generate').click(function () {
        let r = Math.random().toString(36).substring(7);
        $('#newpass').val(r);
    })
    function submitForm(url) {
        $(':input[type="button"]').prop('disabled', true);
        var data = $("#update-form").serialize();
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
    function submitForm11(url) {
        $(':input[type="button"]').prop('disabled', true);
        var data = $("#update-form").serialize();
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
    function submitForm12(url) {
        $(':input[type="button"]').prop('disabled', true);
        var data = $("#update-form").serialize();
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
    $('#choose').on('change', function () {
        var selected_val = this.value;
        if (selected_val == 1 || selected_val == 2) {
            $(".group_div").show();
        } else {
            $(".group_div").hide();
        }
        if (selected_val == 5 ) {
            $('#update-form').submit();
        }
    });
</script>
<script>
    function filePreview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imgPreview + img').remove();
                $('#imgPreview').after('<img src="' + e.target.result + '" class="pic-view" width="200" height="150" float="left"/>');
            };
            reader.readAsDataURL(input.files[0]);
            $('.img-preview').show();
        } else {
            $('#imgPreview + img').remove();
            $('.img-preview').hide();
        }
    }
    $("#file").change(function () {
        // Image preview
        filePreview(this);
    });
    $(function () {
        var rotation = 0;
        $("#rright").click(function () {
            rotation = (rotation - 90) % 360;
            $(".pic-view").css({'transform': 'rotate(' + rotation + 'deg)'});
            if (rotation != 0) {
                $(".pic-view").css({'width': '100px', 'height': '132px'});
            } else {
                $(".pic-view").css({'width': '24%', 'height': '132px'});
            }
            $('#rotation').val(rotation);
        });
        $("#rleft").click(function () {
            rotation = (rotation + 90) % 360;
            $(".pic-view").css({'transform': 'rotate(' + rotation + 'deg)'});
            if (rotation != 0) {
                $(".pic-view").css({'width': '100px', 'height': '132px'});
            } else {
                $(".pic-view").css({'width': '24%', 'height': '132px'});
            }
            $('#rotation').val(rotation);
        });
    });
</script>
        <?php include ('../footer1.php') ?>


</body>
</html>