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
//	header('location: ../logout.php');
    exit;
}
//Set the time of the user's last activity
$_SESSION['LAST_ACTIVITY'] = $time;

$i = $_SESSION["role_id"];
if ($i != "super" && $i != "admin") {
    header('location: ../dashboard.php');
}
$edit_name = $_POST['edit_cust_name'];
$enabled = $_POST['edit_enabled'];
$stations = $_POST['edit_station'];

foreach ($stations as $station) {
    $array_station .= $station . ",";
}
if ($edit_name != "") {
    $id = $_POST['edit_id'];
    $sql = "update sg_cust_dashboard set sg_cust_dash_name='$edit_name',stations='$array_station',enabled = '$enabled' where sg_cust_group_id ='$id'";
    $result1 = mysqli_query($db, $sql);
    if ($result1) {
        $_SESSION['message_stauts_class'] = 'alert-success';
        $_SESSION['import_status_message'] = 'Dashboard Updated Sucessfully.';
    } else {
        $_SESSION['message_stauts_class'] = 'alert-danger';
        $_SESSION['import_status_message'] = 'Error: Please Retry';
    }
    header("Location:create_cust_dashboard.php");
}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $sitename; ?> | Update Dashboard</title>
    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link href="../assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/colors.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/style_main.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->
    <!-- Core JS files -->
    <script type="text/javascript" src="../assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="../assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->
    <!-- Theme JS files -->
    <script type="text/javascript" src="../assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="../assets/js/core/app.js"></script>
    <script type="text/javascript" src="../assets/js/pages/datatables_basic.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/ui/ripple.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/notifications/sweet_alert.min.js"></script>
    <script type="text/javascript" src="../assets/js/pages/components_modals.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/ui/ripple.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/forms/selects/bootstrap_select.min.js"></script>
    <script type="text/javascript" src="../assets/js/pages/form_bootstrap_select.js"></script>
    <script type="text/javascript" src="../assets/js/pages/form_layouts.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="../assets/js/pages/form_select2.js"></script>
    <style>
        th.sno{
            width: 5%
        }
        th.action {
            width: 15%
        }
        th.p_name {
            width: 60%; /* Not necessary, since only 70% width remains */
        }
        th.d_name{
            width: 20%
        }
        .select2-container{
            outline: 0;
            position: relative;
            display: inline-block;
            text-align: left;
            font-size: 14px;
        }
        @media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px) {
            .col-md-10{
                width: 72%;
                float: right;
            }
            .col-md-2 control-label{
                width: 26%!important;
            }
        }
    </style>
</head>
<body>
<!-- Main navbar -->
<?php $cust_cam_page_header = "Edit Dashboard";
include("../header_folder.php");
include("../admin_menu.php");
?>
<!-- /main navbar -->
<!-- Page container -->
<div class="page-container">

    <!-- Content area -->
    <div class="content">
        <!-- Main charts -->
        <!-- Basic datatable -->
        <div class="panel panel-flat">
            <div class="panel-heading">

                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <?php
                            $id = $_GET['id'];

                            ?>
                            <form action="" id="edit_form_grp" class="form-horizontal" method="post">
                                <div class="modal-body">
                                    <div class="row">

                                        <?php
                                        $query = sprintf("SELECT * FROM  sg_cust_dashboard where sg_cust_group_id = '$id' AND sg_cust_group_id != '1'");
                                        $qur = mysqli_query($db, $query);
                                        $rowc = mysqli_fetch_array($qur);
                                        ?>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Dashboard Name:</label>
                                                <div class="col-md-10">
                                                    <input type="text" name="edit_cust_name" id="edit_cust_name" class="form-control" value = "<?php echo $rowc['sg_cust_dash_name']; ?>" required>
                                                    <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $id; ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Stations:</label>

                                                <div class="col-md-10">
                                                    <select required name="edit_station[]" id="edit_station"  class="select-border-color"
                                                            multiple="multiple">
                                                        <!--                                                        <select name="edit_part_number[]" id="edit_part_number" class="form-control" multiple>-->
                                                        <?php
                                                        $arrteam = explode(',', $rowc["stations"]);
                                                        $sql1 = "SELECT line_id,line_name FROM `cam_line`";
                                                        $result1 = $mysqli->query($sql1);
                                                        while ($row1 = $result1->fetch_assoc()) {
                                                            if (in_array($row1['line_id'], $arrteam)) {
                                                                $selected = "selected";
                                                            } else {
                                                                $selected = "";
                                                            }
                                                            echo "<option id='" . $row1['line_id'] . "'  value='" . $row1['line_id'] . "' $selected>" . $row1['line_name'] . "</option>";
                                                        }

                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="col-md-2 control-label">Enabled : </label>

                                                <div class="col-lg-8">
                                                    <select name="edit_enabled" id="edit_enabled" class="form-control"
                                                            style="float: left;
                                                             width: initial;">
                                                        <option value="1"<?php if ($rowc["enabled"] == '1'){echo 'selected';} ?>>Yes</option>
                                                        <option value="0"<?php if ($rowc["enabled"] == '0'){echo 'selected';} ?>>No</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">

                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /basic datatable -->
                    <!-- /main charts -->


                    <!-- Dashboard content -->

                    <script>
                        $('#choose').on('change', function () {
                            var selected_val = this.value;
                            if (selected_val == 1 || selected_val == 2) {
                                $(".group_div").show();
                            } else {
                                $(".group_div").hide();
                            }
                            if (selected_val == 5 ) {
                                $('#delete_form').submit();
                            }
                        });
                    </script>
                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->
        </div>
        <!-- /page content -->
    </div>
</div>
<!-- /page container -->
<?php include ('../footer.php') ?>
<script>
    //window.onload = function() {
    //    history.replaceState("", "", "<?php //echo $scriptName; ?>//config_module/create_cust_dashboard.php");
    //}
</script>
</body>
</html>
