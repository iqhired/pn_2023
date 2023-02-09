<?php
include("../config.php");
$chicagotime = date("Y-m-d H:i:s");
$temp = "";
checkSession();
if (count($_POST) > 0) {

//edit
    $edit_pass = $_POST['pass'];
    if ($edit_pass != "") {
        $id = $_POST['edit_id'];
        $pass1 = $_POST['pass'];
        $pass = md5($pass1);
        $sql = "update cam_users set password='$pass',updated_at='$chicagotime' where users_id  ='$id'";
        $result1 = mysqli_query($db, $sql);
        if ($result1) {
            $message_stauts_class = 'alert-success';
            $import_status_message = 'Password changed successfully';
        } else {
            $message_stauts_class = 'alert-danger';
            $import_status_message = 'Try Again';
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
    <title><?php echo $sitename; ?> | Admin Config</title>
    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="../assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/colors.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/style_main.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->
    <!-- Core JS files -->
    <script type="text/javascript" src="../assets/js/libs/jquery-3.6.0.min.js"> </script>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->
    <!-- Theme JS files -->
    <script type="text/javascript" src="../assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="../assets/js/pages/datatables_basic.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/ui/ripple.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/notifications/sweet_alert.min.js"></script>
    <script type="text/javascript" src="../assets/js/pages/components_modals.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/ui/ripple.min.js"></script>
</head>
<style>
    @media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px) {
        .col-md-6 {
            float: left;
        }
        .col-md-4 {
            float: right;
        }
        .col-md-4 {
            float: left;
            margin-top: 12px;
        }
    }
</style>

<!-- Main navbar -->
<?php $cust_cam_page_header = "Admin Config";
include("../header.php");
include("../admin_menu.php");
include("../heading_banner.php");
?>
<body class="alt-menu sidebar-noneoverflow">
<!-- /main navbar -->
<!-- Page container -->
<div class="page-container">

    <!-- Content area -->
    <div class="content">
        <!-- Main charts -->
        <!-- Main charts -->
        <!-- Basic datatable -->
        <?php
        if (!empty($import_status_message)) {
            echo '<div class="alert ' . $message_stauts_class . '">' . $import_status_message . '</div>';
        }
        displaySFMessage();

        ?>

        <form action="" method="post" class="form-horizontal">
            <br/>
            <div class="panel panel-flat">
                <table class="table datatable-basic">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>User Name</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $query = sprintf("SELECT * FROM  cam_users");
                    $qur = mysqli_query($db, $query);
                    while ($rowc = mysqli_fetch_array($qur)) {
                        ?>
                        <tr>
                            <td><?php echo ++$counter; ?></td>
                            <td><?php echo $rowc["firstname"]; ?></td>
                            <td><?php echo $rowc["lastname"]; ?></td>
                            <td><?php echo $rowc["user_name"]; ?></td>
                            <td>
                                <button type="button" id="edit" class="btn btn-info btn-xs" data-id="<?php echo $rowc['users_id']; ?>" data-name="<?php echo $rowc['user_name']; ?>" data-pass="<?php echo $rowc['password']; ?>"  data-toggle="modal" style="background-color:#1e73be;" data-target="#edit_modal_theme_primary">Change Password </button>

                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
        </form>
    </div>
    <!-- /basic datatable -->
    <!-- /main charts -->
    <!-- edit modal -->
    <div id="edit_modal_theme_primary" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h6 class="modal-title">Change Password</h6>
                </div>
                <form action="" id="user_form" class="form-horizontal" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">User Name:*</label>
                                    <div class="col-lg-7 mob_modal">
                                        <input type="text" name="edit_name" id="edit_name" class="form-control" style="pointer-events: none;">
                                        <input type="hidden" name="edit_id" id="edit_id" >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-lg-3 control-label">Password:*</label>
                                    <div class="col-lg-7 mob_modal">
                                        <input type="password" name="pass" id="pass" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Dashboard content -->

    <script>
        jQuery(document).ready(function ($) {
            $(document).on('click', '#edit', function () {
                var element = $(this);
                var edit_id = element.attr("data-id");
               // var pass = $(this).data("pass");
                var name = $(this).data("name");
                $("#edit_name").val(name);
              //  $("#pass").val(pass);
                $("#edit_id").val(edit_id);
                //alert(role);
            });
        });
    </script>
</div>
<!-- /content area -->

</div>
<!-- /page container -->

<script>
    //window.onload = function() {
    //    history.replaceState("", "", "<?php //echo $scriptName; ?>//config_module/job_title.php");
    //}
</script>
<script>
    $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>
<?php include('../footer.php') ?>
<script type="text/javascript" src="../assets/js/core/app.js"></script>
</body>
</html>
