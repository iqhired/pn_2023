<?php
include("../config.php");
$chicagotime = date("Y-m-d H:i:s");
$temp = "";
if (!isset($_SESSION['user'])) {
    header('location: ../logout.php');
}
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
    $sql = "update sg_email_report_config set teams='$array_team',users='$array_user',subject='$_POST[subject]',message='$_POST[message]',signature='$_POST[signature]' where sg_mail_report_config_id='4'";
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
        <?php echo $sitename; ?> |Training Mail Config</title>
    <!-- Global stylesheets -->


    <link href="../assets/css/core.css" rel="stylesheet" type="text/css">


    <!-- /global stylesheets -->
    <script type="text/javascript" src="../assets/js/form_js/jquery-min.js"></script>
    <script type="text/javascript" src="../assets/js/libs/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- Theme JS files -->
    <script type="text/javascript" src="../assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="../assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
    <!--    <script type="text/javascript" src="../assets/js/plugins/forms/selects/select2.min.js"></script>-->
    <script type="text/javascript" src="../assets/js/pages/datatables_basic.js"></script>
    <!--    <script type="text/javascript" src="../assets/js/plugins/forms/selects/select2.min.js"></script>-->
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
    <!--    <script src="--><?php //echo $siteURL; ?><!--assets/js/form_js/select2.min.js"></script>-->
    <script type="text/javascript" src="../assets/js/plugins/forms/selects/bootstrap_select.min.js"></script>
    <script type="text/javascript" src="../assets/js/pages/form_bootstrap_select.js"></script>
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
        .breadcrumb-header {
            margin-left: 124px;
        }
        @media (min-width: 320px) and (max-width: 480px) {
            .col-md-4 {
                width: 30%;
            }
            .col-md-8.mg-t-5.mg-md-t-0 {
                width: 70%;
            }
            .row-sm {
                margin-left: 16px!important;
                margin-right: 53px!important;
                margin-top: 48px;
            }
            .contextMenu {
                left: 0!important;
            }
            .d-sm-none {
                z-index: 1!important;
            }
            .breadcrumb-header {
                margin-left: 38px;
            }
            button.remove.btn.btn-sm.btn-danger-light {
                margin-top: 14px!important;
                margin-bottom: 10px!important;
                margin-left: 24px!important;
            }
        }

        @media (min-width: 481px) and (max-width: 768px) {
            .col-md-4 {
                width: 30%;
            }
            .col-md-8.mg-t-5.mg-md-t-0 {
                width: 70%;
            }
            .row-sm {
                margin-left: 16px!important;
                margin-right: 53px!important;
                margin-top: 48px;
            }
            .contextMenu {
                left: 0!important;
            }
            .d-sm-none {
                z-index: 1!important;
            }
            .breadcrumb-header {
                margin-left: 38px;
            }
            button.remove.btn.btn-sm.btn-danger-light {
                margin-top: 14px!important;
                margin-bottom: 10px!important;
                margin-left: 24px!important;
            }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .col-md-4 {
                width: 30%;
            }
            .col-md-8.mg-t-5.mg-md-t-0 {
                width: 70%;
            }
            .row-sm {
                margin-left: 16px!important;
                margin-right: 53px!important;
                margin-top: 48px;
            }
            .contextMenu {
                left: 0!important;
            }
            .d-sm-none {
                z-index: 1!important;
            }
            .breadcrumb-header {
                margin-left: 38px;
            }
            button.remove.btn.btn-sm.btn-danger-light {
                margin-top: 14px!important;
                margin-bottom: 10px!important;
                margin-left: 24px!important;
            }

        }
        @media (min-width: 482px) and (max-width: 767px) {
            .col-md-4 {
                width: 30%;
            }
            .col-md-8.mg-t-5.mg-md-t-0 {
                width: 70%;
            }
            .row-sm {
                margin-left: 16px!important;
                margin-right: 53px!important;
                margin-top: 48px;
            }
            .contextMenu {
                left: 0!important;

            }
            .d-sm-none {
                z-index: 1!important;
            }
            .breadcrumb-header {
                margin-left: 38px;
            }
            button.remove.btn.btn-sm.btn-danger-light {
                margin-top: 14px!important;
                margin-bottom: 10px!important;
                margin-left: 24px!important;
            }

        }
        button.remove.btn.btn-sm.btn-danger-light {
            margin-top: -36px;
            margin-bottom: 10px;
            margin-left: 156px;
        }
        .col-lg-3.mg-t-20.mg-lg-t-0.extra_input {
            margin-left: -23px;
            margin-top: 10px;
        }
        .row-sm {
            margin-left: 114px;
            margin-right: -102px;
        }
    </style>
</head>
<body class="ltr main-body app horizontal">
<?php
$cust_cam_page_header = "Training Mail Config";
include("../header_folder.php");
include("../admin_menu.php");
?>
<!-- main-content -->
<div class="main-content app-content">
    <!-- container -->
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Report Config</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Training Mail Config</li>
                </ol>
            </div>
        </div>
        <!-- /breadcrumb -->
        <!-- row -->
        <?php
        if (!empty($import_status_message)) {
            echo '<br/><div class="alert ' . $message_stauts_class . '">' . $import_status_message . '</div>';
        }
        displaySFMessage();
        ?>

        <?php
        $query = sprintf("SELECT * FROM  sg_email_report_config where sg_mail_report_config_id = '4'");
        $qur = mysqli_query($db, $query);
        while ($rowc = mysqli_fetch_array($qur)) {
        ?>
        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $rowc['sg_mail_report_config_id']; ?>" >
        <form action="" id="user_form" enctype="multipart/form-data"  class="form-horizontal" method="post">
            <div class="row row-sm">
                <div class="col-lg-10 col-xl-10 col-md-12 col-sm-12">
                    <div class="card  box-shadow-0">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">Training Mail Config</span>
                        </div>
                        <div class="card-body pt-0">
                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-2">
                                        <label class="form-label mg-b-0">To Teams : </label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <select class="form-control form-select select2" data-placeholder="Add Teams..." value="<?php echo $rowc["teams"]; ?>" name="teams[]" id="teams" multiple="multiple"  >
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
                                    <div class="col-md-2">
                                        <label class="form-label mg-b-0">To Users : </label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
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
                                    <div class="col-md-2">
                                        <label class="form-label mg-b-0">Subject : </label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Subject" value="<?php echo $rowc["subject"]; ?>" required>
                                    </div>
                                </div>
                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-2">
                                        <label class="form-label mg-b-0">Message : </label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <textarea id="message" name="message" rows="4" placeholder="Enter Message..." class="form-control" ><?php echo $rowc["message"]; ?></textarea>
                                    </div>
                                </div>
                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-2">
                                        <label class="form-label mg-b-0">Signature : </label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <input type="text" name="signature" id="signature" class="form-control" value="<?php echo $rowc["signature"]; ?>" placeholder="Enter Signature..." required>
                                    </div>
                                </div>
                                <div class="row row-sm" style="margin-left: -24px!important;">
                                     <div class="col-lg-10 col-xl-10 col-md-12 col-sm-12">
                                          <div class="card  box-shadow-0">
                                               <div class="card-body pt-0">
                                                   <button type="submit" class="btn btn-primary">Update</button>
                                               </div>
                                          </div>
                                     </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php } ?>
    </div>
</div>
<script>
    window.onload = function() {
        history.replaceState("", "", "<?php echo $scriptName; ?>cronjobs/training_mail_config.php");
    }
</script>
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
<?php include('../footer1.php') ?>
</body>
</html>