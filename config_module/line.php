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
//create
    if ($name != "") {
        $name = $_POST['name'];
        $priority_order = $_POST['priority_order'];
        $enabled = $_POST['enabled'];
        $gbpd = $_POST['gbpd'] ;
        if($gbpd == '1'){
            $g = '1';
        }else{
            $g = '0';
        }
        $npd = $_POST['npd'] ;
        if($npd == '1'){
            $n = '1';
        }else{
            $n = '0';
        }
        $p_label1 = $_POST['p_label1'] ;
        if($p_label1 == '1'){
            $i = '1';
        }else{
            $i = '0';
        }
        $sql0 = "INSERT INTO `cam_line`(`line_name`,`priority_order` , `enabled` ,`gbd_id` ,`npr_id` ,`indivisual_label` , `created_at`) VALUES ('$name' , '$priority_order' , '$enabled','$g','$n','$i', '$chicagotime')";
        $result0 = mysqli_query($db, $sql0);
        if ($result0) {
            $message_stauts_class = 'alert-success';
            $import_status_message = 'Station created successfully.';
        } else {
            $message_stauts_class = 'alert-danger';
            $import_status_message = 'Error: Please Insert valid data';
        }
    }




}

//upload file

if (isset($_FILES['good_file']) && isset($_FILES['bad_file'])) {
    $errors = array();
    $good_name = $_FILES['good_file']['name'];
    $bad_name = $_FILES['bad_file']['name'];
//    $rework_name = $_FILES['rework_file'];
    $good_size = $_FILES['good_file']['size'];
    $bad_size = $_FILES['bad_file']['size'];
//    $rework_size = $_FILES['rework_file']['size'];
    $good_tmp = $_FILES['good_file']['tmp_name'];
    $good_tmp1 = $good_tmp;
    $bad_tmp = $_FILES['bad_file']['tmp_name'];
//    $rework_tmp = $_FILES['rework_file']['tmp_name'];
    $good_type = $_FILES['good_file']['type'];
    $bad_type = $_FILES['bad_file']['type'];
//    $rework_type = $_FILES['rework_file']['type'];


//    $good_ext = strtolower(end(explode('.', $good_name)));
//    $bad_ext = strtolower(end(explode('.', $bad_name)));
    $good_extensions = array("application/octet-stream","doc","docx");
    $bad_extensions = array("application/octet-stream","doc","docx");
//    $rework_extensions = array("doc","docx");
//    if (in_array($good_type, $good_extensions) == false && in_array($bad_type, $bad_extensions) == false ) {
//    $errors[] = "extension not allowed, please choose a doc file.";
//    $message_stauts_class = 'alert-danger';
//    $import_status_message = 'Error: Extension not allowed, please choose a doc file.';
//
//}
//    if ($good_size > 2097152 && $bad_size > 2097152 && $rework_size > 2097152) {
//        $errors[] = 'File size must be excately 2 MB';
//        $message_stauts_class = 'alert-danger';
//        $import_status_message = 'Error: File size must be less than 2 MB';
//    }
    if (empty($errors) == true) {
        $dir_path = "../assets/label_files/" . $_POST['label_line_id'];
        if (!file_exists($dir_path)) {
            mkdir($dir_path, 0777, true);
        }
        move_uploaded_file($good_tmp, $dir_path . '/' . 'g' . "_" . 'label');
        copy($dir_path . '/' . 'g' . "_" . 'label', $dir_path . '/' . 'f1');
//		move_uploaded_file($good_tmp1, $dir_path . '/' . 'f1');
        move_uploaded_file($bad_tmp, $dir_path . '/' . 'b' . "_" . 'label');
        copy($dir_path . '/' . 'b' . "_" . 'label', $dir_path . '/' . 'f2');
        $zpl_id = $_POST['label_line_id'];
        $sql1 = "update cam_line set zpl_file_status = '1',print_label = '1' where line_id ='$zpl_id'";
        $result1 = mysqli_query($db, $sql1);
        //    $sql0 = "INSERT INTO `cam_line`('logo',`line_name`,`priority_order` , `enabled` , `created_at`) VALUES (''$file_name','$name' , '$priority_order' , '$enabled', '$chicagotime')";
        $message_stauts_class = 'alert-success';
        $import_status_message = 'Upload Files Successfully';
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
        <?php echo $sitename; ?> | Station</title>
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
$cust_cam_page_header = "Station Configuration Management";
include("../header.php");
include("../admin_menu.php");
?>
<body class="ltr main-body app sidebar-mini">
<!-- main-content -->
<div class="main-content app-content">
    <!-- container -->
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Admin config</a></li>
                <li class="breadcrumb-item active" aria-current="page"> Station Configuration Management</li>
            </ol>
        </div>
    </div>
    <div class="row-body">
        <div class="col-lg-12 col-md-12">
    <?php
    if (!empty($import_status_message)) {
        echo '<div class="alert ' . $message_stauts_class . '">' . $import_status_message . '</div>';
    }
    displaySFMessage();
    ?>

        </div>
    </div>
    <form action="" id="user_form" class="form-horizontal" method="post">
        <div class="row-body">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">Station Configuration Management</span><br>
                        </div>
                        <div class="pd-20 pd-sm-10">
                            <div class="row row-xs">
                                <div class="col-md-4" >
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Station" required>
                                </div>
                                <div class="col-md-4" >
                                    <input type="number" name="priority_order" id="priority_order" class="form-control" placeholder="Enter Priority Order" required>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <select name="enabled" id="enabled" class="form-control form-select select2">
                                        <option value="0" >No</option>
                                        <option value="1" >Yes</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="pd-20 pd-sm-10">
                            <div class="row row-xs">
                                <div class="col-md-2.5">
                                    <label class="form-label mg-b-0">GBP Dashboard Required : </label>
                                </div>
                                <div class="col-md-1.5 mg-t-1 mg-md-t-9">
                                    <label class="ckbox"><input checked type="checkbox" name="gbpd" id="gbpd" value="1"><span></span></label>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-2.5">
                                    <label class="form-label mg-b-0">NPR Dashboard Required : </label>
                                </div>
                                <div class="col-md-1.5 mg-t-1 mg-md-t-9">
                                    <label class="ckbox"><input checked type="checkbox" name="npd" id="npd" value="1"><span></span></label>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-2.5">
                                    <label class="form-label mg-b-0">Print Individual Required : </label>
                                </div>
                                <div class="col-md-1.5 mg-t-1 mg-md-t-9">
                                    <label class="ckbox"><input checked type="checkbox" name="p_label1" id="p_label1" value="1"><span></span></label>
                                </div>
                            </div>
                        </div>
                        <div class="pd-20 pd-sm-10">
                            <div class="row row-xs">
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary mg-t-5 submit_btn">Create Station</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
    <form action="delete_line.php" method="post" class="form-horizontal">
    <div class="row-body">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">
                        <button type="submit" class="btn btn-danger btn-sm br-5">
                            <i>
                                <svg class="table-delete" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9zm7.5-5l-1-1h-5l-1 1H5v2h14V4h-3.5z"></path></svg>
                            </i>
                        </button>
                    </h4>
                </div>
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table datatable-basic table-bordered text-nowrap mb-0" id="example2">
                            <thead>
                            <tr>
                                <th><input type="checkbox" id="checkAll" ></th>
                                <th>S.No</th>
                                <th>Action</th>
                                <th>Print Individual Required</th>
                                <th>Station</th>
                                <th>Priority Order</th>
                                <th>Enabled</th>
                                <th>GBP Dashboard Required</th>
                                <th>NPR Dashboard Required</th>
                                <th>Print Required</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query = sprintf("SELECT * FROM  cam_line where is_deleted!='1'");
                            $qur = mysqli_query($db, $query);
                            while ($rowc = mysqli_fetch_array($qur)) {
                                ?>
                                <tr>
                                    <td><input type="checkbox" id="delete_check[]" name="delete_check[]" value="<?php echo $rowc["line_id"]; ?>"></td>
                                    <td><?php echo ++$counter; ?></td>
                                    <td>
                                        <?php $finalid = $rowc['form_create_id']; ?>
                                        <a class="btn btn-success btn-sm br-5 me-2" href="edit_line.php?id=<?php echo $rowc['line_id']; ?>" data-name="<?php echo $rowc['line_name']; ?>">
                                            <i>
                                                <svg class="table-edit" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-.45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z"></path></svg>
                                            </i>
                                        </a>
                                    </td>
                                    <td>
                                        <?php
                                        $zpl_result = ($rowc['zpl_file_status'] == 0) ? "Off" : "On"; ?>
                                        <?php if($zpl_result == 'Off'){ ?>
                                            <button type="button" id="edit_label" class="btn btn-info btn-xs" style="background-color: #d84315" data-id="<?php echo $rowc['line_id']; ?>"  data-toggle="modal" data-target="#edit_modal_theme_primary1"><?php echo $zpl_result ?> </button>
                                        <?php  }else {
                                            $print = ($rowc['print_label'] == 0) ? "Off" : "On";
                                            if($print == "Off"){?>
                                                <button type="button" class="print_status btn btn-info btn-xs"  style="background-color: #d84315" data-id="<?php echo $rowc['line_id']; ?>"  data-toggle="modal"><?php echo $print ?> </button>
                                            <?php  }else{ ?>
                                                <button type="button" class="print_status btn btn-info btn-xs"  style="background-color: #43a047" data-id="<?php echo $rowc['line_id']; ?>"  data-toggle="modal"><?php echo $print ?> </button>
                                            <?php   } ?>
                                        <?php   } ?>
                                    </td>
                                    <td><?php echo $rowc["line_name"]; ?></td>
                                    <td><?php echo $rowc["priority_order"]; ?></td>
                                    <td><?php
                                        $yn_result = ($rowc['enabled'] == 0) ? "No" : "Yes";
                                        echo $yn_result;
                                        ?></td>
                                    <!-- <td>--><?php //echo $rowc['created_at'];        ?><!--</td>-->
                                    <td>
                                        <input type="checkbox" name="gbpd" id="gbpd" value="<?php echo $rowc["line_id"]; ?>" <?php echo ($rowc['gbd_id']==1 ? 'checked' : '');?>>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="npd" id="npd" value="<?php echo $rowc["line_id"]; ?>" <?php echo ($rowc['npr_id']==1 ? 'checked' : '');?>>
                                    </td>
                                    <td>
                                        <input type="checkbox" name="p_label" id="p_label" value="<?php echo $rowc["line_id"]; ?>" <?php echo ($rowc['indivisual_label']==1 ? 'checked' : '');?>>
                                    </td>

                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
    <!-- enabled modal -->
    <div id="edit_modal_theme_primary1" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h6 class="modal-title">Upload Label File</h6>
                </div>
                <form action="" id="" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <label class="col-lg-4 control-label">Good Piece File : </label>
                            <div class="col-md-6">
                                <input type="hidden" name="label_line_id" id="label_line_id" >
                                <input type="file" name="good_file" id="good_file" value="" required
                                       class="form-control">
                                <!-- <div id="preview"></div>-->
                            </div>

                        </div>
                        <div class="row">
                            <label class="col-lg-4 control-label">Bad Piece File : </label>
                            <div class="col-md-6">
                                <input type="file" name="bad_file" id="bad_file" required
                                       class="form-control">
                                <!-- <div id="preview"></div>-->
                            </div>

                        </div>
                        <!--                                <div class="row">-->
                        <!--                                    <label class="col-lg-2 control-label">Select Printer : </label>-->
                        <!--                                    <div class="col-md-6">-->
                        <!--                                        <select  name="printer" id="printer" class="select form-control" data-style="bg-slate">-->
                        <!--                                            <option value="" disabled selected>Select Printer</option>-->
                        <!--                                            <option value="0" >Zebra Printer</option>-->
                        <!--                                            <option value="1" >EPSON Printer</option>-->
                        <!--                                            <option value="1" >HP Printer</option>-->
                        <!--                                        </select>-->
                        <!--                                    </div>-->
                        <!--                                </div>-->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<script> $(document).on('click', '#delete', function () {
        var element = $(this);
        var del_id = element.attr("data-id");
        var info = 'id=' + del_id;
        $.ajax({type: "POST", url: "ajax_line_delete.php", data: info, success: function (data) { }});
        $(this).parents("tr").animate({backgroundColor: "#003"}, "slow").animate({opacity: "hide"}, "slow");
    });

    $(document).on('click', '#edit_label', function () {
        var element = $(this);
        var edit_id = element.attr("data-id");
        $("#label_line_id").val(edit_id);
    });

</script>

<script>
    window.onload = function() {
        history.replaceState("", "", "<?php echo $scriptName; ?>config_module/line.php");
    }
</script>

<script>
    $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>

<script>
    $("input#gbpd").click(function () {
        var isChecked = $(this)[0].checked;
        var val = $(this).val();
        var data_1 = "&gbpd=" + val+ "&isChecked=" + isChecked;
        $.ajax({
            type: 'POST',
            url: "GBPD_backend.php",
            data: data_1,
            success: function (response) {

            }
        });

    });

</script>
<script>
    $("input#npd").click(function () {
        var isChecked = $(this)[0].checked;
        var val = $(this).val();
        var data_1 = "&npd=" + val+ "&isChecked=" + isChecked;
        $.ajax({
            type: 'POST',
            url: "nprd_backend.php",
            data: data_1,
            success: function (response) {

            }
        });

    });

</script>
<script>
    $("input#p_label").click(function () {
        var isChecked = $(this)[0].checked;
        var val = $(this).val();
        var data_1 = "&p_label=" + val+ "&isChecked=" + isChecked;
        $.ajax({
            type: 'POST',
            url: "print_label.php",
            data: data_1,
            success: function (response) {

            }
        });

    });

</script>
<script>
    $(".print_status").on('click', function () {
        var element = $(this);
        var print_id = element.attr("data-id");
        var info = 'print=' + print_id;
        $.ajax({
            type: "POST",
            url: "print_action.php",
            data: info,
            success: function (data) {

                location.reload();
            }
        });

    });
</script>
<?php include('../footer1.php') ?>

</body>
