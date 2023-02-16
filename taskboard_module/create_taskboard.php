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
if (count($_POST) > 0) {
    $name = $_POST['name'];
    $group_id = $_POST['group_id'];
    $created_by = $_SESSION["id"];
    if ($name != "") {
        $sql0 = "INSERT INTO `sg_taskboard`(`taskboard_name`,`group_id` , `created_by` ) VALUES ('$name' , '$group_id' , '$created_by')";
        $result0 = mysqli_query($db, $sql0);
        if ($result0) {
            $query1 = sprintf("SELECT * FROM `sg_taskboard` where taskboard_name = '$name'");
            $qur1 = mysqli_query($db, $query1);
            $rowc1 = mysqli_fetch_array($qur1);
            $val = $rowc1['sg_taskboard_id'];
            $sql1 = "INSERT INTO `tm_task_log_config`( `taskboard` ) VALUES ('$val')";
            $result11 = mysqli_query($db, $sql1);
            $message_stauts_class = 'alert-success';
            $import_status_message = 'Taskboard created successfully.';
        } else {
            $message_stauts_class = 'alert-danger';
            $import_status_message = 'Error: Please Insert valid data';
        }
////$temp = "one";
    }
    $edit_name = $_POST['edit_name'];
    if ($edit_name != "") {
        $id = $_POST['edit_id'];
        $sql = "update sg_taskboard set taskboard_name ='$_POST[edit_name]', group_id ='$_POST[edit_group_id]'  where sg_taskboard_id ='$id'";
        $result1 = mysqli_query($db, $sql);
        if ($result1) {
            $message_stauts_class = 'alert-success';
            $import_status_message = 'Taskboard Updated successfully.';
        } else {
            $message_stauts_class = 'alert-danger';
            $import_status_message = 'Error: Please Insert valid data';
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
        <?php echo $sitename; ?> |Create TaskBoard</title>
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




        table.dataTable thead .sorting:after {
            content: ""!important;
            top: 49%;
        }
        .card-title:before{
            width: 0;

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
<body class="ltr main-body app horizontal">


<!-- Main navbar -->
<?php
$cust_cam_page_header = "Create Task Board";
include("../header.php");
include("../admin_menu.php");
?>

<!-----body-------->
<!-----main content----->
<div class="main-content app-content">
    <div class="main-container container">

        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Admin Config</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create TaskBoard</li>
                </ol>
            </div>
        </div>

        <?php
        if (!empty($import_status_message)) {
            echo '<div class="alert ' . $message_stauts_class . '">' . $import_status_message . '</div>';
        }
        displaySFMessage();
        ?>




        <form action="" id="user_form" class="form-horizontal" method="post">
            <div class="row">
                <div class="col-lg-12 col-md-12">

                    <div class="card">
                        <div class="">
                            <div class="card-header">
                                <span class="main-content-title mg-b-0 mg-b-lg-1">Create TaskBoard</span>
                            </div>

                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs">
                                    <div class="col-md-2">
                                        <label class="form-label mg-b-0">Name </label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <input type="text" class="form-control" name="name" id="name"  required>
                                    </div>

                                    <div class="col-md-1"></div>
                                    <div class="col-md-1">
                                        <label class="form-label mg-b-0">Group Name</label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <select name="group_id" id="group_id" class="form-control form-select select2" data-style="bg-slate">
                                            <option value="" selected disabled>--- Select Group ---</option>
                                            <?php
                                            $sql1 = "SELECT DISTINCT `group_id` FROM `sg_group` where is_deleted != '1'";
                                            $result1 = $mysqli->query($sql1);
                                            while ($row1 = $result1->fetch_assoc()) {
                                                $station1 = $row1['group_id'];
                                                $qurtemp = mysqli_query($db, "SELECT group_name FROM  sg_group where group_id = '$station1' ");
                                                $rowctemp = mysqli_fetch_array($qurtemp);
                                                $station = $rowctemp["group_name"];
                                                echo "<option value='" . $row1['group_id'] . "'$entry>" . $station . "</option>";
                                            }
                                            ?>
                                        </select>                                    </div>
                                </div>
                            </div>

                            <div class="card-body pt-0">
                                <button type="submit" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5 submit_btn">CREATE TASKBOARD</button>
                            </div>
                        </div>
                    </div>
        </form>
    </div>
</div>



<form action="delete_taskboard.php" method="post" class="form-horizontal">
    <div class="row">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <button type="submit" class="btn btn-danger  submit_btn" style=""><i class="fa fa-trash-o" style="font-size:20px"></i></button>
                </div>

                <div class="card-body pt-0 example1-table">
                    <div class="table-responsive">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table datatable-basic table-bordered text-nowrap mb-0" id="example2">
                                        <thead>
                                        <tr>
                                            <th><label class="ckbox"><input type="checkbox" id="checkAll"><span></span></label></th>
                                            <th>S.No</th>
                                            <th>Action</th>
                                            <th>Name</th>
                                            <th>Group</th>
                                            <th>Created By</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $query = sprintf("SELECT * FROM  sg_taskboard");
                                        $qur = mysqli_query($db, $query);
                                        while ($rowc = mysqli_fetch_array($qur)) {
                                            ?>
                                            <tr>
                                                <td><label class="ckbox"><input type="checkbox" id="delete_check[]" name="delete_check[]" value="<?php echo $rowc["sg_taskboard_id"]; ?>"><span></span></label></td>
                                                <td><?php echo ++$counter; ?></td>
                                                <td>
                                                    <button type="button" id="edit" class="btn btn-primary btn-xs submit_btn legitRipple" data-id="<?php echo $rowc['sg_taskboard_id']; ?>" data-name="<?php echo $rowc['taskboard_name']; ?>" data-group_id="<?php echo $rowc['group_id']; ?>" data-toggle="modal" style="background-color:#1e73be;" data-target="#edit_modal_theme_primary"><i class="fa fa-edit"></i></button>
                                                    <!--                                    &nbsp; <button type="button" id="delete" class="btn btn-danger btn-xs" data-id="<?php echo $rowc['line_id']; ?>">Delete </button>
                                                    -->
                                                </td>
                                                <td><?php echo $rowc["taskboard_name"]; ?></td>
                                                <?php
                                                $station1 = $rowc['group_id'];
                                                $qurtemp = mysqli_query($db, "SELECT * FROM  sg_group where group_id = '$station1' ");
                                                while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                                                    $station = $rowctemp["group_name"];
                                                }
                                                ?>
                                                <td><?php echo $station; ?></td>
                                                <?php
                                                $un = $rowc['created_by'];
                                                $qur04 = mysqli_query($db, "SELECT * FROM  cam_users where users_id = '$un' ");
                                                while ($rowc04 = mysqli_fetch_array($qur04)) {
                                                    $first = $rowc04["firstname"];
                                                    $last = $rowc04["lastname"];
                                                }
                                                ?>
                                                <td><?php echo $first; ?>&nbsp;<?php echo $last; ?></td>

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
    <div class="modal-dialog" style="width:100%">
        <div class="modal-content">
            <div class="card-header">
                <button type="button" style="color: white;font-size: 1.9125rem;" class="close" data-dismiss="modal">&times;</button>
                <span class="main-content-title mg-b-0 mg-b-lg-1">Update Form Type</span>
            </div>
            <form action="" id="user_form" enctype="multipart/form-data" class="form-horizontal"
                  method="post">
                <div class="card-body" style="width:100%;">
                    <div class="col-lg-12 col-md-12">
                        <div class="pd-30 pd-sm-20">
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Name:</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <input type="text" name="edit_name" id="edit_name" class="form-control" required>
                                    <input type="hidden" name="edit_id" id="edit_id" >
                                </div>
                            </div>
                        </div>


                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Group Name:</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <select required name="edit_group_id" id="edit_group_id" class="form-control">
                                        <!--                                                            <option value="" selected disabled>--- Select Group ---</option>-->
                                        <?php
                                        $sql1 = "SELECT DISTINCT `group_id` FROM `sg_group` where is_deleted != 1";
                                        $result1 = $mysqli->query($sql1);
                                        while ($row1 = $result1->fetch_assoc()) {
                                            $station1 = $row1['group_id'];
                                            $qurtemp = mysqli_query($db, "SELECT group_name FROM  sg_group where group_id = '$station1' and is_deleted != 1 ");
                                            $rowctemp = mysqli_fetch_array($qurtemp);
                                            $station = $rowctemp["group_name"];
                                            echo "<option value='" . $row1['group_id'] . "'$entry>" . $station . "</option>";
                                        }
                                        ?>
                                    </select>
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
</div>
</div>
</div>
</div>



</div>
</div>
</div>


<script> $(document).on('click', '#delete', function () {
        var element = $(this);
        var del_id = element.attr("data-id");
        var info = 'id=' + del_id;
        $.ajax({type: "POST", url: "ajax_line_delete.php", data: info, success: function (data) { }});
        $(this).parents("tr").animate({backgroundColor: "#003"}, "slow").animate({opacity: "hide"}, "slow");
    });</script>
<script>
    jQuery(document).ready(function ($) {
        $(document).on('click', '#edit', function () {
            var element = $(this);
            var edit_id = element.attr("data-id");
            var name = $(this).data("name");
            var group_id = $(this).data("group_id");
            $("#edit_name").val(name);
            $("#edit_id").val(edit_id);
            $("#edit_group_id").val(group_id);
            //alert(role);
            const sb = document.querySelector('#group_id');
            const sb1 = document.querySelector('#edit_group_id');
            // create a new option
            // var pnums = part_number.split(',');
            var options = sb.options;
            var options1 = sb1.options;
            // $("#edit_part_number").val(options);
            $('#edit_modal_theme_primary .select2 .selection select2-selection select2-selection--single .select2-selection__choice').remove();

            for (var i = 0; i < options1.length; i++) {
                if(group_id == (options1[i].value)){ // EDITED THIS LINE
                    options1[i].selected="selected";
                    options1[i].className = ("select2-results__option--highlighted");
                    var opt = options1[i].outerHTML.split(">");
                    $('#select2-results .select2-results__option').prop('selectedIndex',i);
                    var gg = '<span class="select2-selection__rendered" id="select2-edit_group_id-container" title="' + opt[1].replace('</option','') + '">' + opt[1].replace('</option','') + '</span>';
                    $("#select2-edit_group_id-container")[0].outerHTML = gg;
                }
            }
        });
    });
</script>

<script>
    window.onload = function() {
        history.replaceState("", "", "<?php echo $scriptName; ?>taskboard_module/create_taskboard.php");
    }
</script>

<script>
    $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>
<!-----body-------->

</div>
</div>
<?php include('../footer1.php') ?>

</body>
