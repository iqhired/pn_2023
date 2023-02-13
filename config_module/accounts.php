<?php
include("../config.php");
$import_status_message = "";
//include("../sup_config.php");
$chicagotime = date("Y-m-d H:i:s");
$temp = "";
checkSession();

if (count($_POST) > 0) {
    $cust_name = $_POST['cust_name'];
//create
    if ($cust_name != "") {
        $enabled = $_POST['enabled'];
        $cust_type = $_POST['account_type'];
        $cust_address = $_POST['address'];
        $cust_contact = $_POST['contact_number'];
        $cust_website = $_POST['website'];
//      $cust_logo = $_POST['cust_name'];
//logo
        if (isset($_FILES['image'])) {
            $errors = array();
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];
            $file_ext = strtolower(end(explode('.', $file_name)));
            $extensions = array("jpeg", "jpg", "png", "pdf");
            if (in_array($file_ext, $extensions) === false) {
                $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
                $message_stauts_class = 'alert-danger';
                $import_status_message = 'Error: Extension not allowed, please choose a JPEG or PNG file.';
            }
            if ($file_size > 2097152) {
                $errors[] = 'File size must be excately 2 MB';
                $message_stauts_class = 'alert-danger';
                $import_status_message = 'Error: File size must be less than 2 MB';
            }
            if (empty($errors) == true) {
                move_uploaded_file($file_tmp, "../supplier_logo/" . $file_name);
                $sql = "INSERT INTO `cus_account`( `logo`,`c_name`, `c_type`, `c_mobile`, `c_address`, `c_website`, `c_status`, `created_at`) VALUES ('$file_name','$cust_name','$cust_type','$cust_contact','$cust_address','$cust_website','$enabled','$chicagotime')";
            }
        }
        else
        {
            $sql = "INSERT INTO `cus_account`( `c_name`, `c_type`, `c_mobile`, `c_address`, `c_website`, `c_status`, `created_at`) VALUES ('$cust_name','$cust_type','$cust_contact','$cust_address','$cust_website','$enabled','$chicagotime')";

        }

//logo code over
//      $sql = "INSERT INTO `sup_account`( `logo`,`c_name`, `c_type`, `c_mobile`, `c_address`, `c_website`, `c_status`, `created_at`) VALUES ('$file_name','$cust_name','$cust_type','$cust_contact','$cust_address','$cust_website','$enabled','$chicagotime')";
        $result1 = mysqli_query($db, $sql);
        if (!$result1) {
            $message_stauts_class = 'alert-danger';
            if($import_status_message == "")
            {
                $import_status_message = 'Error: Account Already Exists';
            }
        } else {
            $message_stauts_class = 'alert-success';
            $import_status_message = 'Account Created Successfully';
        }
    }
//edit
    $edit_name = $_POST['edit_cust_name'];
    $edit_file = $_FILES['edit_logo_image']['name'];
    if ($edit_name != "") {

        $id = $_POST['edit_id'];
//eidt logo
        if($edit_file != "")
        {
            if (isset($_FILES['edit_logo_image'])) {
                $errors = array();
                $file_name = $_FILES['edit_logo_image']['name'];
                $file_size = $_FILES['edit_logo_image']['size'];
                $file_tmp = $_FILES['edit_logo_image']['tmp_name'];
                $file_type = $_FILES['edit_logo_image']['type'];
                $file_ext = strtolower(end(explode('.', $file_name)));
                $extensions = array("jpeg", "jpg", "png", "pdf");
                if (in_array($file_ext, $extensions) === false) {
                    $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
                    $message_stauts_class = 'alert-danger';
                    $import_status_message = 'Error: Extension not allowed, please choose a JPEG or PNG file.';
                }
                if ($file_size > 2097152) {
                    $errors[] = 'File size must be excately 2 MB';
                    $message_stauts_class = 'alert-danger';
                    $import_status_message = 'Error: File size must be excately 2 MB';
                }
                if (empty($errors) == true) {
                    move_uploaded_file($file_tmp, "../supplier_logo/" . $file_name);

                    $sql = "update cus_account set logo='$file_name',c_name='$_POST[edit_cust_name]',c_type='$_POST[edit_account_type]',c_mobile='$_POST[edit_contact_number]',c_address='$_POST[edit_address]',c_website='$_POST[edit_website]',c_status='$_POST[edit_enabled]' where c_id='$id'";
                }
            }
        }
        else
        {
            $sql = "update cus_account set c_name='$_POST[edit_cust_name]',c_type='$_POST[edit_account_type]',c_mobile='$_POST[edit_contact_number]',c_address='$_POST[edit_address]',c_website='$_POST[edit_website]',c_status='$_POST[edit_enabled]' where c_id='$id'";
        }

        $result1 = mysqli_query($db, $sql);
        if ($result1) {
            $message_stauts_class = 'alert-success';
            $import_status_message = 'Account Updated Successfully.';
        } else {
            $message_stauts_class = 'alert-danger';
            if($import_status_message == "")
            {
                $import_status_message = 'Error: Please Try Again.';
            }
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
        <?php echo $sitename; ?> |Accounts</title>
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
$cust_cam_page_header = "Account";
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
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Admin Config</a></li>
                <li class="breadcrumb-item active" aria-current="page">Customer Account</li>
            </ol>
        </div>
    </div>
    <form action="" id="user_form" class="form-horizontal" method="post">
        <div class="row-body">
            <div class="col-lg-12 col-md-12">
                 <?php if ($temp == "one") { ?>
                    <div class="alert alert-success no-border">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                        <span class="text-semibold">Job</span> Created Successfully.
                    </div>
                <?php } ?>
                <?php if ($temp == "two") { ?>
                    <div class="alert alert-success no-border">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                        <span class="text-semibold">Job</span> Updated Successfully.
                    </div>
                <?php } ?>
                <?php
                if (!empty($import_status_message)) {
                    echo '<div class="alert ' . $message_stauts_class . '">' . $import_status_message . '</div>';
                }
                displaySFMessage();

                ?>


                <div class="card">
                    <div class="">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">ACCOUNT</span>
                        </div>


                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Account Name :</label>
                                </div>
                                <div class="col-md-3 mg-t-10 mg-md-t-0">
                                    <input type="text" name="cust_name" id="cust_name" class="form-control" placeholder="Enter Customer Name"  required>
                                    <div id="error6" class="red">
                                    </div>


                                </div>


                                <div class="col-md-1"></div>
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Account Type :</label>
                                </div>

                                <div class="col-md-3 mg-t-10 mg-md-t-0">
                                    <select class="form-control select2" name="account_type" id="account_type">
                                        <option value="" selected disabled>--- Select Account Type ---</option>
                                        <?php
                                        $sql1 = "SELECT * FROM `cus_account_type` ORDER BY `cus_account_type_name` ASC";
                                        $result1 = $mysqli->query($sql1);
                                        //                                            $entry = 'selected';
                                        while ($row1 = $result1->fetch_assoc()) {
                                            echo "<option value='" . $row1['cus_account_type_id'] . "'  >" . $row1['cus_account_type_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <div id="error6" class="red">
                                    </div>
                                </div>
                            </div>
                        </div>




                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Contact Number :</label>
                                </div>
                                <div class="col-md-3 mg-t-10 mg-md-t-0">
                                    <input type="number" name="contact_number" id="contact_number" class="form-control" placeholder="Enter Contact Number" required>
                                    <div id="error6" class="red">
                                    </div>

                                </div>




                                <div class="col-md-1"></div>
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Website :</label>
                                </div>

                                <div class="col-md-3 mg-t-10 mg-md-t-0">
                                    <input type="text" name="website" id="website" class="form-control" placeholder="Enter Website" required>
                                    <div id="error6" class="red">
                                    </div>
                                </div>
                            </div>
                        </div>





                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Upload Logo :</label>
                                </div>
                                <div class="col-md-3 mg-t-10 mg-md-t-0">
                                    <input type="file" name="image" id="image" class="form-control" required>
                                    <div id="1" style="color:red;">* File size must be less than 2 MB.
                                    </div>
                                    <div id="error6" class="red">
                                    </div>

                                </div>




                                <div class="col-md-1"></div>
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Enabled :</label>
                                </div>

                                <div class="col-md-3 mg-t-10 mg-md-t-0">
                                    <div class="row mg-t-15">
                                        <div class="col-lg-3">
                                            <label class="rdiobox">
                                                <input id="yes" name="enabled" value="1" type="radio" checked> <span>Yes</span></label>
                                        </div>
                                        <div class="col-lg-5 mg-t-20 mg-lg-t-0">
                                            <label class="rdiobox">
                                                <input  id="no" name="enabled" value="0" type="radio"> <span>No</span></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Address :</label>
                                </div>
                                <div class="col-md-3 mg-t-10 mg-md-t-0">
                                    <textarea type="text" name="address" id="address" class="form-control"  placeholder="Enter Address..." required></textarea>
                                    <div id="error6" class="red">
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="card-body pt-0">
                            <button type="submit" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5 submit_btn">ADD</button>
                        </div>
                        <!---------------->
                    </div>
                </div>
    </form>
</div>
</div>




<form action="delete_accounts.php" method="post" class="form-horizontal">
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
                                    <table class="table datatable-basic table-bordered">
                                        <thead>
                                        <tr>
                                            <th><label class="ckbox"><input type="checkbox" id="checkAll"><span></span></label></th>
                                            <th>S.No</th>
                                             <th>Action</th>
                                            <th>Account Name</th>
                                            <th>Account Type</th>
                                            <th>Account Status</th>
                                           
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $query = sprintf("SELECT * FROM  cus_account where is_deleted!='1'");
                                        $qur = mysqli_query($db, $query);

                                        while ($rowc = mysqli_fetch_array($qur)) {
                                            ?>
                                            <tr>
                                                <td><label class="ckbox"><input type="checkbox" id="delete_check[]" name="delete_check[]"
                                                                                value="<?php echo $rowc["c_id"]; ?>"><span></span></label></td>
                                                <td><?php echo ++$counter; ?>
                                                </td>
                                                <td>
                                                    <button type="button" id="edit" class="btn btn-primary btn-xs submit_btn legitRipple"
                                                            data-id="<?php echo $rowc['c_id']; ?>"
                                                            data-cust_name="<?php echo $rowc['c_name']; ?>"
                                                            data-cust_type="<?php echo $rowc['c_type']; ?>"
                                                            data-customer_enabled="<?php echo $rowc['c_status']; ?>"
                                                            data-cust_address="<?php echo $rowc['c_address']; ?>"
                                                            data-cust_mobile="<?php echo $rowc['c_mobile']; ?>"
                                                            data-cust_website="<?php echo $rowc['c_website']; ?>"
                                                            data-cust_logo="<?php echo $rowc['logo']; ?>"
                                                            data-toggle="modal" style="background-color:#1e73be;"
                                                            data-target="#edit_modal_theme_primary"><i class="fa fa-edit"></i>
                                                    </button>
                                                </td>
                                                <td><?php echo $rowc["c_name"]; ?>
                                                </td>
                                                <td><?php
                                                    $c_type = $rowc["c_type"];
                                                    $query34 = sprintf("SELECT * FROM  cus_account_type where cus_account_type_id = '$c_type'");
                                                    $qur34 = mysqli_query($db


                                                        , $query34);
                                                    $rowc34 = mysqli_fetch_array($qur34);
                                                    echo $rowc34["cus_account_type_name"]; ?>
                                                </td>
                                                <?php
                                                $enabled = $rowc['c_status'];
                                                $c_status = "Active";
                                                if($enabled == 0){
                                                    $c_status = "Inactive";
                                                }
                                                ?>


                                                <td><?php echo $c_status; ?>
                                                </td>
                                                
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
</form>



<!-- edit modal -->
<div id="edit_modal_theme_primary" class="modal"  >
    <div class="modal-dialog" style="width:100%">
        <div class="modal-content">
            <div class="card-header">
                <button type="button" style="color: white;font-size: 1.9125rem;" class="close" data-dismiss="modal">&times;</button>
                <span class="main-content-title mg-b-0 mg-b-lg-1">Update Accounts :</span>
            </div>


            <form action="" id="user_form" class="form-horizontal" method="post">
                <div class="card-body" style="width:100%">
                    <div class="col-lg-12 col-md-12">
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Account Name:</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <input type="text" name="edit_cust_name" id="edit_cust_name" class="form-control" required>
                                    <input type="hidden" name="edit_id" id="edit_id">
                                </div>
                            </div>
                        </div>

                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Account Type:</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <select required name="edit_account_type" id="edit_account_type" class="form-control">
                                        <option value="" selected disabled>--- Select Account Type ---
                                        </option>
                                        <?php
                                        $sql1 = "SELECT * FROM `cus_account_type` ORDER BY `cus_account_type_name` ASC";
                                        $result1 = $mysqli->query($sql1);
                                        //                                            $entry = 'selected';
                                        while ($row1 = $result1->fetch_assoc()) {
                                            echo "<option value='" . $row1['cus_account_type_id'] . "'  >" . $row1['cus_account_type_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Contact Number:</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <input type="text" name="edit_contact_number" id="edit_contact_number"
                                           class="form-control">
                                </div>
                            </div>
                        </div>


                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Website:</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <input type="text" name="edit_website" id="edit_website"
                                           class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Enabled:</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <div class="row mg-t-15">
                                        <div class="col-lg-4">
                                            <label class="rdiobox">
                                                <input id="edit_enabled" name="edit_enabled" value="1" type="radio"> <span>Yes</span></label>
                                        </div>
                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0">
                                            <label class="rdiobox">
                                                <input  id="edit_enabled" name="edit_enabled" value="0" type="radio" <?php if ($rowc["enabled"] == '0'){echo 'checked';} ?>> <span>No</span></label>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Address:</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <textarea id="edit_address" name="edit_address" rows="3" class="form-control"></textarea>
                                </div>
                            </div>
                        </div>


                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Upload New Logo:</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <input type="file" name="edit_logo_image" id="edit_logo_image1" class="form-control">
                                    <div id="error6" class="red">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-6">
                                    <label class="form-label mg-b-0">Previous Logo Preview:</label>
                                </div>
                                <div class="col-md-6 mg-t-10 mg-md-t-0">
                                    <img src="" alt="Image not Available" name="editlogo" id="editlogo" style="height:150px;width:150px;"/>
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
</div> <!-- edit modal -->
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
<script>
    $(document).on('click', '#delete', function () {
        var element = $(this);
        var del_id = element.attr("data-id");
        var info = 'id=' + del_id;
        $.ajax({
            type: "POST", url: "ajax_delete.php", data: info, success: function (data) {
            }
        });
        $(this).parents("tr").animate({backgroundColor: "#003"}, "slow").animate({opacity: "hide"}, "slow");
    });
</script>
<script>
    jQuery(document).ready(function ($) {
        $(document).on('click', '#edit', function () {
            var element = $(this);
            var edit_id = element.attr("data-id");
            var cust_name = $(this).data("cust_name");
            var cust_type = $(this).data("cust_type");
            var customer_enabled = $(this).data("customer_enabled");
            var cust_address = $(this).data("cust_address");
            var cust_mobile = $(this).data("cust_mobile");
            var cust_website = $(this).data("cust_website");
            var cust_logo = $(this).data("cust_logo");
            $("#edit_name").val(name);
            $("#edit_cust_name").val(cust_name);
            $("#edit_account_type").val(cust_type);
            $("#edit_enabled").val(customer_enabled);
            $("#edit_address").val(cust_address);
            $("#edit_contact_number").val(cust_mobile);
            $("#edit_website").val(cust_website);
            $("#editlogo").attr("src","../supplier_logo/"+cust_logo);
            $("#edit_id").val(edit_id);

            // Load Taskboard
            const sb1 = document.querySelector('#edit_account_type');
            var options1 = sb1.options;
            $('#edit_modal_theme_primary .select2 .selection select2-selection select2-selection--single .select2-selection__choice').remove();
            for (var i = 0; i < options1.length; i++) {
                if(cust_type == (options1[i].value)){ // EDITED THIS LINE
                    options1[i].selected="selected";
                    options1[i].className = ("select2-results__option--highlighted");
                    var opt = options1[i].outerHTML.split(">");
                    $('#select2-results .select2-results__option').prop('selectedIndex',i);
                    var gg = '<span class="select2-selection__rendered" id="select2-edit_account_type-container" title="' + opt[1].replace('</option','') + '">' + opt[1].replace('</option','') + '</span>';
                    $("#select2-edit_account_type-container")[0].outerHTML = gg;
                }
            }
        });
    });

</script>

<!---container--->

</div>
<script>
    window.onload = function () {
        history.replaceState("", "", "<?php echo $scriptName; ?>config_module/accounts.php");
    }
</script>
<script>
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
</script>
<script>
    $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>
<?php include('../footer1.php') ?>
</body>
</html>
