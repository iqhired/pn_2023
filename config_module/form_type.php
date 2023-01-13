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

//	header('location: ../logout.php');
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
    $wol = $_POST['wol'];
//create
    if ($name != "") {
        $n_wol = 1;
        if(empty($wol) || $wol == 'no'){
            $n_wol = 0;
        }
        $sqlquery = "INSERT INTO `form_type`(`form_type_name`,`wol`,`created_at`,`updated_at`) VALUES ('$name','$n_wol','$chicagotime','$chicagotime')";
        if (!mysqli_query($db, $sqlquery)) {
            $message_stauts_class = 'alert-danger';
            $import_status_message = 'Error: Form Type with this Name Already Exists';
        } else {
            $temp = "one";
        }
    }
//edit
    $edit_name = $_POST['edit_name'];
    $edit_wol = $_POST['edit_wol'];
    $wol = 1;
    if($edit_wol == 'no'){
        $wol = 0;
    }
    if ($edit_name != "") {
        $id = $_POST['edit_id'];
        $sql = "update form_type set form_type_name='$edit_name',wol = '$wol',updated_at='$chicagotime' where form_type_id ='$id'";
        $result1 = mysqli_query($db, $sql);
        if ($result1) {
            $temp = "two";
        } else {
            $message_stauts_class = 'alert-danger';
            $import_status_message = 'Error: Form Type with this Name Already Exists';
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
        <?php echo $sitename; ?> | Form Type</title>
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
$cust_cam_page_header = "Form Type";
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
                <li class="breadcrumb-item active" aria-current="page">Form Type</li>
            </ol>
        </div>
    </div>

    <form action="" id="user_form" class="form-horizontal" method="post">
        <div class="row-body">
            <div class="col-lg-12 col-md-12">

                <?php if ($temp == "one") { ?>
                    <div class="alert alert-success no-border">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                                    class="sr-only">Close</span></button>
                        <span class="text-semibold">Form Type</span> Created Successfully.
                    </div>
                <?php } ?>
                <?php if ($temp == "two") { ?>
                    <div class="alert alert-success no-border">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                                    class="sr-only">Close</span></button>
                        <span class="text-semibold">Form Type</span> Updated Successfully.
                    </div>
                <?php } ?>
                <?php
                if (!empty($import_status_message)) {
                    echo '<div class="alert ' . $message_stauts_class . '">' . $import_status_message . '</div>';
                }
                ?>
                <?php
                if (!empty($_SESSION[$import_status_message])) {
                    echo '<div class="alert ' . $_SESSION['message_stauts_class'] . '">' . $_SESSION['import_status_message'] . '</div>';
                    $_SESSION['message_stauts_class'] = '';
                    $_SESSION['import_status_message'] = '';
                }
                ?>



                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">FORM TYPE</span>
                        </div>

                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Form Type</label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Form Type" required>
                                </div>



                                <div class="col-md-1"></div>
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Is Work Order/Lot Required:</label>
                                </div>
                                <div class="col-md-3 mg-t-10 mg-md-t-0">
                                    <div class="row mg-t-15">
                                        <div class="col-lg-3">
                                            <label class="rdiobox">
                                                <input id="yes" name="wol" value="yes" type="radio" checked> <span>Yes</span></label>
                                        </div>
                                        <div class="col-lg-5 mg-t-20 mg-lg-t-0">
                                            <label class="rdiobox">
                                                <input  id="no" name="wol" value="no" type="radio"> <span>No</span></label>
                                        </div>
                                    </div>
                                </div>


                                <div class="card-body pt-0">
                                    <button type="submit" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5 submit_btn">Create Form Type</button>

                                </div>
                            </div>
                        </div>
    </form>
</div>
</div>
<!-----------Create form sucessfully------------>


</div>
</div>

<form action="delete_form_type.php" method="post" class="form-horizontal">
    <div class="row-body">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <button type="submit" class="btn btn-danger submit_btn" style=""><i class="fa fa-trash-o" style="font-size:20px"></i></button>
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
                                            <th>Form Type</th>
                                            <th>Is Work Order/Lot Required </th>
                                            <th>Form Enabled/Disbaled</th>
                                            <th>Form Rejection Loop</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $query = sprintf("SELECT * FROM  form_type where is_deleted!='1'");
                                        $qur = mysqli_query($db, $query);
                                        while ($rowc = mysqli_fetch_array($qur)) {
                                            ?>
                                            <tr>
                                                <td><input type="checkbox" id="delete_check[]" name="delete_check[]" value="<?php echo $rowc["form_type_id"]; ?>"></td>
                                                <td><?php echo ++$counter; ?></td>
                                                <td><?php echo $rowc["form_type_name"]; ?></td>
                                                <td><?php if($rowc["wol"] == 0){ echo 'No' ;}else{ echo 'Yes' ;}?></td>
                                                <td>
                                                    <input type="checkbox" name="form_reject" id="form_reject" value="<?php echo $rowc["form_type_id"]; ?>" <?php echo ($rowc['form_type_reject']==1 ? 'checked' : '');?>>
                                                </td>
                                                <td>
                                                    <input type="checkbox" name="rejection_loop" id="rejection_loop" value="<?php echo $rowc["form_type_id"]; ?>" <?php echo ($rowc['form_rejection_loop']==1 ? 'checked' : '');?>>
                                                </td>
                                                <td>
                                                    <button type="button" id="edit" class="btn btn-primary btn-xs submit_btn"
                                                            data-id="<?php echo $rowc['form_type_id']; ?>"
                                                            data-name="<?php echo $rowc['form_type_name']; ?>"
                                                            data-wol="<?php if($rowc["wol"] == 0){ echo 'no' ;}else{ echo 'yes' ;} ?>"
                                                            data-toggle="modal"
                                                            style="color:background-color:legitReppile"
                                                            data-target="#edit_modal_theme_primary">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
</form>

<!-- edit modal -->
<div id="edit_modal_theme_primary" class="modal">
    <div class="modal-dialog" style="width:100%">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h6 class="modal-title">Update Form Type</h6>
            </div>
            <form action="" id="user_form" class="form-horizontal" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="col-lg-5 control-label">Form Type:*</label>
                            <div class="col-lg-6">
                                <input type="text" name="edit_name" id="edit_name" class="form-control" required>
                                <input type="hidden" name="edit_id" id="edit_id">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="col-lg-5 control-label">Work Order/Lot:*</label>
                        </div>
                        <div class="col-lg-6">
                            <input type="radio" id="edit_yes" name="edit_wol" value="yes">
                            <label for="yes" class="item_label" id="">Yes</label>
                            <input type="radio" id="edit_no" name="edit_wol" value="no">
                            <label for="no" class="item_label" id="">No</label>
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

<script> $(document).on('click', '#delete', function () {
        var element = $(this);
        var del_id = element.attr("data-id");
        var info = 'id=' + del_id;
        $.ajax({
            type: "POST", url: "ajax_job_title_delete.php", data: info, success: function (data) {
            }
        });
        $(this).parents("tr").animate({backgroundColor: "#003"}, "slow").animate({opacity: "hide"}, "slow");
    });</script>
<script>
    jQuery(document).ready(function ($) {
        $(document).on('click', '#edit', function () {
            var element = $(this);
            var edit_id = element.attr("data-id");
            var name = $(this).data("name");
            var wol = $(this).data("wol");
            $("#edit_name").val(name);
            if(wol == 'no'){
                document.getElementById("edit_no").checked = true;
            }else{
                document.getElementById("edit_yes").checked = true;
            }
            // $("#edit_wol").val(wol);
            $("#edit_id").val(edit_id);
            //alert(role);
        });
    });
</script>
<!----container---->
</div>
</div>


<script>
    $("input#form_reject").click(function () {
        var isChecked = $(this)[0].checked;
        var val = $(this).val();
        var data_1 = "&form_reject=" + val+ "&isChecked=" + isChecked;
        $.ajax({
            type: 'POST',
            url: "form_type_reject.php",
            data: data_1,
            success: function (response) {

            }
        });

    });

</script>
<script>
    $("input#rejection_loop").click(function () {
        var isChecked = $(this)[0].checked;
        var val = $(this).val();
        var data_1 = "&rejection_loop=" + val+ "&isChecked=" + isChecked;
        $.ajax({
            type: 'POST',
            url: "form_rejection_loop.php",
            data: data_1,
            success: function (response) {

            }
        });

    });

</script>
<script>
    window.onload = function () {
        history.replaceState("", "", "<?php echo $scriptName; ?>config_module/form_type.php");
    }
</script>
<script>
    $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>

<?php include('../footer1.php') ?>

</body>
</html>

