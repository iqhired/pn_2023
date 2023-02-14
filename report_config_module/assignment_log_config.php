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

$i = $_SESSION["role_id"];
if ($i != "super" && $i != "admin") {
    header('location: ../dashboard.php');
}
if (count($_POST) > 0) {
    $teams1 = $_POST['teams'];
    $users1 = $_POST['users'];
    foreach ($teams1 as $teams) {
        $array_team .= $teams . ",";
    }
    foreach ($users1 as $users) {
        $array_user .= $users . ",";
    }
    $sql = "update sg_email_report_config set teams='$array_team',users='$array_user',subject='$_POST[subject]',message='$_POST[message]',signature='$_POST[signature]' where sg_mail_report_config_id='1'";
    $result1 = mysqli_query($db, $sql);
    if ($result1) {
        $message_stauts_class = 'alert-success';
        $import_status_message = 'Data Updated successfully.';
    } else {
        $message_stauts_class = 'alert-danger';
        $import_status_message = 'Error: Please Retry...';
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
        <?php echo $sitename; ?> |Assignment Log Config</title>
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

            input[type="file"] {
                display: block;

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
                font-size: 1.5em;
            }
    </style>
</head>
<body class="ltr main-body app sidebar-mini">
<!-- Main navbar -->
<?php
$cust_cam_page_header = "Assignment Log Config";
include("../header_folder.php");
include("../admin_menu.php");
?>
<div class="main-content app-content">
    <!---container--->
    <!---breadcrumb--->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Report Config</a></li>
                <li class="breadcrumb-item active" aria-current="page">Assignment Log Config</li>
            </ol>
        </div>
    </div>
    <form action="" id="user_form" class="form-horizontal" method="post">
        <div class="row-body">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="">
                        <?php if ($temp == "one") { ?>
                            <br/>					<div class="alert alert-success no-border">
                                <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                                <span class="text-semibold">Group</span> Created Successfully.
                            </div>
                        <?php } ?>
                        <?php if ($temp == "two") { ?>
                            <br/>					<div class="alert alert-success no-border">
                                <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                                <span class="text-semibold">Group</span> Updated Successfully.
                            </div>
                        <?php } ?>
                        <?php
                        if (!empty($import_status_message)) {
                            echo '<br/><div class="alert ' . $message_stauts_class . '">' . $import_status_message . '</div>';
                        }
                        displaySFMessage();
                        ?>

                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">Assignment Log Config</span>
                        </div>
                        <?php
                        $query = sprintf("SELECT * FROM  sg_email_report_config where sg_mail_report_config_id = '1'");
                        $qur = mysqli_query($db, $query);
                        while ($rowc = mysqli_fetch_array($qur)) {
                        ?>
                        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $rowc['sg_mail_report_config_id']; ?>" >
                        <div class="card-body pt-0">
                            <form action="" id="user_form" enctype="multipart/form-data"  class="form-horizontal" method="post">
                             <div class="pd-30 pd-sm-20">
                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-4">
                                        <label class="col-lg-4 control-label">To Teams : </label>
                                    </div>
                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                      <select class="form-control form-select select2" data-placeholder="Add Teams..." value="<?php echo $rowc["teams"]; ?>" name="teams[]" id="teams" multiple="multiple">
                                          <?php
                                          $arrteam = explode(',', $rowc["teams"]);
                                          $sql1 = "SELECT DISTINCT(`group_id`) FROM `sg_user_group`";
                                          $result1 = $mysqli->query($sql1);
                                          while ($row1 = $result1->fetch_assoc()) {
                                              if (in_array($row1['group_id'], $arrteam)) {
                                                  $selected = "selected";
                                              } else {
                                                  $selected = "";
                                              }
                                              $station1 = $row1['group_id'];
                                              $qurtemp = mysqli_query($db, "SELECT * FROM  sg_group where group_id = '$station1' ");
                                              $rowctemp = mysqli_fetch_array($qurtemp);
                                              $groupname = $rowctemp["group_name"];
                                              echo "<option value='" . $row1['group_id'] . "' $selected>" . $groupname . "</option>";
                                          }
                                          ?>
                                      </select>
                                    </div>
                                </div>
                                 <div class="row row-xs align-items-center mg-b-20">
                                     <div class="col-md-4">
                                         <label class="col-lg-4 control-label">To Users : </label>
                                     </div>
                                     <div class="col-md-8 mg-t-5 mg-md-t-0">
                                         <select class="form-control form-select select2" data-placeholder="Add Users ..." name="users[]" id="users"  multiple="multiple">
                                             <?php
                                             $arrteam1 = explode(',', $rowc["users"]);
                                             $sql1 = "SELECT * FROM `cam_users` WHERE `assigned2` = '0'  and `users_id` != '1' order BY `firstname` ";
                                             $result1 = $mysqli->query($sql1);
                                             while ($row1 = $result1->fetch_assoc()) {
                                                 if (in_array($row1['users_id'], $arrteam1)) {
                                                     $selected = "selected";
                                                 } else {
                                                     $selected = "";
                                                 }
                                                 echo "<option value='" . $row1['users_id'] . "' $selected>" . $row1['firstname'] . "&nbsp;" . $row1['lastname'] . "</option>";
                                             }
                                             ?>
                                         </select>
                                     </div>
                                 </div>
                                 <div class="row row-xs align-items-center mg-b-20">
                                     <div class="col-md-4">
                                         <label class="col-lg-4 control-label">Subject : </label>
                                     </div>
                                     <div class="col-md-8 mg-t-5 mg-md-t-0">
                                         <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Subject" value="<?php echo $rowc["subject"]; ?>" required>
                                     </div>
                                 </div>
                                 <div class="row row-xs align-items-center mg-b-20">
                                     <div class="col-md-4">
                                         <label class="col-lg-4 control-label">Message : </label>
                                     </div>
                                     <div class="col-md-8 mg-t-5 mg-md-t-0">
                                         <textarea id="message" name="message" rows="4" placeholder="Enter Message..." class="form-control" ><?php echo $rowc["message"]; ?></textarea>
                                     </div>
                                 </div>
                                 <div class="row row-xs align-items-center mg-b-20">
                                     <div class="col-md-4">
                                         <label class="col-lg-4 control-label">Signature : </label>
                                     </div>
                                     <div class="col-md-8 mg-t-5 mg-md-t-0">
                                         <input type="text" name="signature" id="signature" class="form-control" value="<?php echo $rowc["signature"]; ?>" placeholder="Enter Signature..." required>
                                     </div>
                                 </div>
                             </div>
                                <div class="pd-30 pd-sm-20">
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
    function group1()
    {
        $("#teams").select2("open");
    }
    function group2()
    {
        $("#users").select2("open");
    }
</script>
<script>
    window.onload = function() {
        history.replaceState("", "", "<?php echo $scriptName; ?>report_config_module/assignment_log_config.php");
    }
</script>
<?php include ('../footer1.php') ?>
</body>
</html>
