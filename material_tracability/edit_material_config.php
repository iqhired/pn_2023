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

//  header('location: ../logout.php');
    exit;
}
$is_tab_login = $_SESSION['is_tab_user'];
$is_cell_login = $_SESSION['is_cell_login'];
//Set the time of the user's last activity
$_SESSION['LAST_ACTIVITY'] = $time;
$i = $_SESSION["role_id"];
if ($i != "super" && $i != "admin" && $i != "pn_user" && $_SESSION['is_tab_user'] != 1 && $_SESSION['is_cell_login'] != 1 ) {
    header('location: ../dashboard.php');
}
$edit_id = $_POST['edit_id'];
if ($edit_id != "") {
    // edit material config
    $id = $_POST['edit_id'];
    $edit_teams1 = $_POST['edit_teams'];
    $edit_users1 = $_POST['edit_users'];
    $edit_m_type = $_POST['edit_material_type'];
    $edit_material_type = count($_POST['edit_material_type']);
    $edit_serial_check = $_POST['serial_status'];
    foreach ($edit_teams1 as $edit_teams) {
        $array_team .= $edit_teams . ",";
    }

    foreach ($edit_users1 as $edit_users) {
        $array_user .= $edit_users . ",";
    }
    if ($edit_material_type > 1) {
        for ($i = 0; $i < $edit_material_type; $i++) {
            if (trim($_POST['edit_material_type'][$i]) != '') {
                if($edit_serial_check == ""){
                    $sql = "update `material_config` set `teams` = '$array_team', `users` = '$array_user', `material_type` = '  $edit_m_type[$i]',`serial_num_required` = '0', `created_at` = '$chicagotime' where `material_id`='$id'";
                }else{
                    $sql = "update `material_config` set `teams` = '$array_team', `users` = '$array_user', `material_type` = '  $edit_m_type[$i]',`serial_num_required` = '1', `created_at` = '$chicagotime' where `material_id`='$id'";

                }
                $result1 = mysqli_query($db, $sql);
                if ($result1) {
                    $message_stauts_class = 'alert-success';
                    $import_status_message = 'Data Updated successfully.';
                } else {
                    $message_stauts_class = 'alert-danger';
                    $import_status_message = 'Error: Please Retry...';
                }
            }
        }
    } else {
        if($edit_serial_check == ""){
            $sql = "update `material_config` set `teams` = '$array_team', `users` = '$array_user', `material_type` = '$edit_m_type[0]',`serial_num_required` = '0', `created_at` = '$chicagotime' where `material_id`='$id'";
        }else{
            $sql = "update `material_config` set `teams` = '$array_team', `users` = '$array_user', `material_type` = '$edit_m_type[0]',`serial_num_required` = '1', `created_at` = '$chicagotime' where `material_id`='$id'";

        }
        $result1 = mysqli_query($db, $sql);

        if ($result1) {
            $temp = "two";
            $message_stauts_class = 'alert-success';
            $import_status_message = 'Data Updated successfully.';
        } else {
            $message_stauts_class = 'alert-danger';
            $import_status_message = 'Error: Please Retry...';
        }
        header("Location:material_config.php");

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
        <?php echo $sitename; ?> |Edit Material Config</title>
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
$cust_cam_page_header = " Edit Material Tracability Config";
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
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Admin Config</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Material Tracability Config</li>
            </ol>
        </div>
    </div>


    <form action="" id="user_form" class="form-horizontal" method="post">
        <?php
        $edit_id = $_GET['id'];
        ?>
        <?php
        $sql1 = "SELECT * FROM `material_config` where material_id = '$edit_id' ";
        $result1 = $mysqli->query($sql1);
        while ($row1 = $result1->fetch_assoc()) {
            $teams = $row1['teams'];
            $users = $row1['users'];
            $material_type = $row1['material_type'];
            $serial_check = $row1['serial_num_required'];
        }
        ?>
        <div class="row-body">
            <div class="col-lg-12 col-md-12">
                <?php
                if (!empty($import_status_message)) {
                    echo '<div class="alert ' . $message_stauts_class . '">' . $import_status_message . '</div> ';
                }
                ?>
                <?php
                if (!empty($_SESSION['import_status_message'])) {
                    echo '<div class="alert ' . $_SESSION['message_stauts_class'] . '">' . $_SESSION['import_status_message'] . '</div>';
                    $_SESSION['message_stauts_class'] = '';
                    $_SESSION['import_status_message'] = '';
                }
                ?>

                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">Material Traceability</span>
                        </div>
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">To Teams :</label>
                                </div>
                                <div class="col-md-3 mg-t-10 mg-md-t-0" id="edit_teams_val">
                                    <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $edit_id; ?>">
                                    <select class="form-control select2" name="edit_teams[]" id="edit_teams" multiple="multiple">
                                        <?php
                                        $arrteam = explode(',',$teams);
                                        $sql1 = "SELECT * FROM sg_group order by group_name ASC";
                                        $result1 = $mysqli->query($sql1);
                                        while ($rowt = $result1->fetch_assoc()) {
                                            if (in_array($rowt['group_id'], $arrteam)) {
                                                $selected = "selected";
                                            } else {
                                                $selected = "";
                                            }

                                            echo "<option id='" . $rowt['group_id'] . "' value='" . $rowt['group_id'] . "' $selected>" . $rowt['group_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>



                                <div class="col-md-1"></div>
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">To Users :</label>
                                </div>
                                <div class="col-md-3 mg-t-10 mg-md-t-0" id="edit_users_val">
                                    <select class="form-control select2" name="edit_users[]" id="edit_users" multiple="multiple">
                                        <?php
                                        $arrteam = explode(',',$users);
                                        $sql12= "SELECT users_id, firstname,lastname FROM cam_users order by firstname ASC";
                                        $result2 = mysqli_query($db,$sql12);
                                        while ($rowu = $result2->fetch_assoc()) {
                                            if (in_array($rowu['users_id'], $arrteam)) {
                                                $selected = "selected";
                                            } else {
                                                $selected = "";
                                            }
                                            echo "<option id='" . $rowu['users_id'] . "' value='" . $rowu['users_id'] . "' $selected>" . $rowu['firstname'] . "&nbsp" . $rowu['lastname'] . "</option>";
                                        }


                                        ?>

                                    </select>
                                </div>
                            </div>
                        </div>



                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Material Type</label>
                                </div>
                                <div class="col-md-3 mg-t-10 mg-md-t-0">
                                    <div id="inputFormRow">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="edit_material_type[]" id="edit_material_type"  value="<?php echo  $material_type; ?>" placeholder="Enter Material Type" required>
                                        </div>



                                    </div>
                                </div>

                                <div class="col-md-1"></div>
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Is Serial Number Required:*</label>
                                </div>
                                <div class="col-md-1 mg-t-10 mg-md-t-0">
                                    <label class="ckbox"><input checked type="checkbox" name="serial_status" id="serial_status" <?php if($serial_check == 1){echo 'checked';} ?> ><span></span></label>
                                </div>
                            </div>
                        </div>


                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5 submit_btn">SAVE</button>
                                    <button type="submit" class="btn btn-danger pd-x-30 mg-r-5 mg-t-5 submit_btn" onclick="history.go(-1)">CANCEL</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </form>
</div>
</div>




<!---container--->
</div>

<script>
    // add row
    $("#addRow2").click(function () {
        var html = '';
        html += '<div id="inputFormRow2">';
        html += '<div class="input-group mb-3">';
        html += '<input type="text" name="material_type[]" class="form-control m-input" placeholder="Enter Material Type" autocomplete="off">';
        html += '<div class="input-group-append">';
        html += '<button id="removeRow2" type="button" class="btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></button>';
        html += '</div>';
        html += '</div>';

        $('#newRow1').append(html);
    });

    // remove row
    $(document).on('click', '#removeRow2', function () {
        $(this).closest('#inputFormRow2').remove();
    });
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
<script>
    function showDiv() {
        document.getElementById('edit_modal_theme_primary').style.display = "block";
        $('.focus').focus();
    }
    function hideDiv() {
        document.getElementById('edit_modal_theme_primary').style.display = "none";

    }
</script>

<!-- /page container -->

<?php include ('../footer1.php') ?>
</body>
</html>
