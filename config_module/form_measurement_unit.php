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
if (count($_POST) > 0) {
    $name = $_POST['name'];
//create
    if ($name != "") {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $unit_of_measurement = $_POST['unit_of_measurement'];

        $sql0 = "INSERT INTO `form_measurement_unit`(`name`,`description` , `unit_of_measurement` , `created_at`) VALUES ('$name' , '$description' , '$unit_of_measurement', '$chicagotime')";
        $result0 = mysqli_query($db, $sql0);
        if ($result0) {
            $message_stauts_class = 'alert-success';
            $import_status_message = 'Form Unit created successfully.';
        } else {
            $message_stauts_class = 'alert-danger';
            $import_status_message = 'Error: Please Insert valid data';
        }
    }
//edit
    $edit_name = $_POST['edit_name'];
    if ($edit_name != "") {
        $id = $_POST['edit_id'];
        $sql = "update form_measurement_unit set name='$_POST[edit_name]', description ='$_POST[edit_description]' , unit_of_measurement ='$_POST[edit_unit_of_measurement]'  where form_measurement_unit_id='$id'";
        $result1 = mysqli_query($db, $sql);
        if ($result1) {
            $message_stauts_class = 'alert-success';
            $import_status_message = 'Form Unit Updated successfully.';
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
        <?php echo $sitename; ?> |Form Measurement</title>
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
$cust_cam_page_header = "Measurement Unit";
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
                <li class="breadcrumb-item active" aria-current="page">Form Mesurment</li>
            </ol>
        </div>
    </div>


    <form action="" id="user_form" class="form-horizontal" method="post">
        <div class="row-body">
            <div class="col-lg-12 col-md-12">
                <?php
                if (!empty($import_status_message)) {
                    echo '<div class="alert ' . $message_stauts_class . '">' . $import_status_message . '</div>';
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
                            <span class="main-content-title mg-b-0 mg-b-lg-1">Form Measurement Unit</span>
                        </div>


                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-1">
                                    <label class="form-label mg-b-0">Name </label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" required>
                                </div>

                                <div class="col-md-1"></div>
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Description </label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <input type="text" class="form-control" name="description" id="description" placeholder="Enter Description" required>
                                </div>
                            </div>
                        </div>

                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Unit of Description</label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <input type="text" class="form-control" name="unit_of_measurement" id="unit_of_measurement" placeholder="Enter Unit of Description" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-1"></div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5 submit_btn">Create</button>
                        </div>
                    </div>
                </div>
    </form>
    <br/>

</div>

</div>
<br/>


<form action="delete_form_measurement_unit.php" method="post" class="form-horizontal">
    <div class="row-body">
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
                                    <table class="table  table-bordered text-nowrap mb-0" id="example2">
                                        <thead>
                                        <tr>
                                            <th><label class="ckbox"><input type="checkbox" id="checkAll"><span></span></label></th>
                                            <th>Sl. No</th>
                                            <th>Name</th>
                                            <th>Description</th>
                                            <th>Unit of Measurement</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                        $query = sprintf("SELECT * FROM  form_measurement_unit where is_deleted!='1'");
                                        $qur = mysqli_query($db, $query);
                                        while ($rowc = mysqli_fetch_array($qur)) {
                                            ?>
                                            <tr>
                                                <td><input type="checkbox" id="delete_check[]" name="delete_check[]" value="<?php echo $rowc["form_measurement_unit_id"]; ?>"></td>
                                                <td><?php echo ++$counter; ?></td>
                                                <td><?php echo $rowc["name"]; ?></td>
                                                <td><?php echo $rowc["description"]; ?></td>
                                                <td><?php echo $rowc["unit_of_measurement"]; ?></td>

                                                <!--                            <td>--><?php //echo $rowc['created_at'];        ?><!--</td>-->
                                                <td>
                                                    <button type="button" id="edit" class="btn btn-primary btn-xs submit_btn legitRipple" data-id="<?php echo $rowc['form_measurement_unit_id']; ?>" data-name="<?php echo $rowc['name']; ?>" data-description="<?php echo $rowc['description']; ?>" data-unit_of_measurement="<?php echo $rowc['unit_of_measurement']; ?>"  data-toggle="modal" data-target="#edit_modal_theme_primary"><i class="fa fa-edit"></i> </button>
                                                    <!---  &nbsp;  -->
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
    <div class="modal-dialog" style="width:100%">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Edit Unit</h6>
            </div>


            <form action="" id="user_form" class="form-horizontal" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label class="col-lg-5 control-label">Name:*</label>

                                <div class="col-lg-7">
                                    <input type="text" name="edit_name" id="edit_name" class="form-control" required>
                                    <input type="hidden" name="edit_id" id="edit_id" >
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label class="col-lg-5 control-label">Description:</label>
                                <div class="col-lg-7">
                                    <input type="text" name="edit_description" id="edit_description" class="form-control" >
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label class="col-lg-5 control-label">Unit Of Measurement:*</label>
                                <div class="col-lg-7">
                                    <input type="text" name="edit_unit_of_measurement" id="edit_unit_of_measurement" class="form-control" required>
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
            <!----->
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
<!-- Dashboard content -->
<!-- /dashboard content -->
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
            var description = $(this).data("description");
            var unit_of_measurement = $(this).data("unit_of_measurement");


            $("#edit_name").val(name);
            $("#edit_id").val(edit_id);
            $("#edit_description").val(description);
            $("#edit_unit_of_measurement").val(unit_of_measurement);

            //alert(role);
        });
    });
</script>

<script>
    window.onload = function() {
        history.replaceState("", "", "<?php echo $scriptName; ?>config_module/form_measurement_unit.php");
    }
</script>

<script>
    $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>


<!-----main content----->
</div>
</div>

<!-- /page container -->
<?php include('../footer.php') ?>
<script type="text/javascript" src="../assets/js/core/app.js"></script>


</body>
</html>
