<?php
include("../config.php");
$chicagotime = date("Y-m-d H:i:s");
$temp = "";
checkSession();
if (count($_POST) > 0) {
    $name = $_POST['name'];
    $wol = $_POST['enabled'];
//create
    if ($name != "") {
        $n_wol = 1;
        if(empty($wol) || $wol == 'no'){
            $n_wol = 0;
        }
        $sqlquery = "INSERT INTO `document_type`(`document_type_name`,`enabled`,`created_at`,`updated_at`) VALUES ('$name','$n_wol','$chicagotime','$chicagotime')";
        $result = mysqli_query($db, $sqlquery);
        if ($result) {
            $temp = "one";

        } else {
            $message_stauts_class = 'alert-danger';
            $import_status_message = 'Error: Document Type with this Name Already Exists';
        }
    }
//edit
    $edit_name = $_POST['edit_name'];
    $edit_wol = $_POST['edit_enabled'];
    $wol = 1;
    if($edit_wol == 'no'){
        $wol = 0;
    }
    if ($edit_name != "") {
        $id = $_POST['edit_id'];
        $sql = "update document_type set document_type_name='$edit_name',enabled = '$wol',updated_at='$chicagotime' where document_type_id ='$id'";
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
        <?php echo $sitename; ?> |Document Type</title>
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

<!-- Main navbar -->
<?php
$cust_cam_page_header = "Document Category";
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
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Document</a></li>
                <li class="breadcrumb-item active" aria-current="page">Document Category</li>
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
                        <span class="text-semibold">Document Type</span> Created Successfully.
                    </div>
                <?php } ?>
                <?php if ($temp == "two") { ?>
                    <div class="alert alert-success no-border">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                                    class="sr-only">Close</span></button>
                        <span class="text-semibold">Document Type</span> Updated Successfully.
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
                            <span class="main-content-title mg-b-0 mg-b-lg-1">DOCUMENT TYPE</span>
                        </div>

                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Document Type</label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Document Type" required>
                                </div>


                                 <div class="col-md-1"></div>
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Enabled/Disabled:</label>
                                </div>
                                <div class="col-md-3 mg-t-10 mg-md-t-0">
                                    <div class="row mg-t-15">
                                        <div class="col-lg-3">
                                            <label class="rdiobox">
                                                <input id="yes" name="enabled" value="yes" type="radio" checked> <span>Yes</span></label>
                                        </div>
                                        <div class="col-lg-5 mg-t-20 mg-lg-t-0">
                                            <label class="rdiobox">
                                                <input  id="no" name="enabled" value="no" type="radio"> <span>No</span></label>
                                        </div>
                                    </div>
                                </div>

                                 <div class="card-body pt-0">
                                    <button type="submit" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5 submit_btn">Create</button>
                                </div> 
                            </div> 
                        </div> 
                    </form> 
                </div> 
            </div>


        </div>
    </div>


<form action="delete_document_category.php" method="post" class="form-horizontal">
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
                                    <table class="table  datatable-basic table-bordered text-nowrap mb-0" id="example2">
                                        <thead>
                                        <tr>
                                            <th><label class="ckbox"><input type="checkbox" id="checkAll"><span></span></label></th>
                                            <th>Sl. No</th>
                                            <th>Action</th>
                                            <th>Document Type</th>
                                            <th>Enabled/Disabled</th>
                                           
                                        
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                            $query = sprintf("SELECT * FROM  document_type where is_deleted != '1'");
                            $qur = mysqli_query($db, $query);
                            while ($rowc = mysqli_fetch_array($qur)) {
                                ?>
                                <tr>
                                    <td><label class="ckbox"><input type="checkbox" id="delete_check[]" name="delete_check[]"
                                               value="<?php echo $rowc["document_type_id"]; ?>"><span></span></label></td>
                                    <td><?php echo ++$counter; ?></td>
                                    <td>
                                        <button type="button" id="edit" class="btn btn-primary btn-xs submit_btn"
                                                data-id="<?php echo $rowc['document_type_id']; ?>"
                                                data-name="<?php echo $rowc['document_type_name']; ?>"
                                                data-enabled="<?php if($rowc["enabled"] == 0){ echo 'no' ;}else{ echo 'yes' ;} ?>"
                                                data-toggle="modal"
                                                style="background-color:legitRipple;"
                                                data-target="#edit_modal_theme_primary">
                                           <i class="fa fa-edit"></i>
                                        </button>
                                        <!--&nbsp; <button type="button" id="delete" class="btn btn-danger btn-xs" data-id="<?php echo $rowc['job_title_id']; ?>">Delete </button>
                                                    -->
                                    </td>
                                    <td><?php echo $rowc["document_type_name"]; ?></td>
                                    <td><?php if($rowc["enabled"] == 0){ echo 'No' ;}else{ echo 'Yes' ;}?></td>
                                    <!--                                         <td>-->
                                    <?php //echo $rowc['created_at']; ?><!--</td>-->
                                    <!--                                        <td>-->
                                    <?php //echo $rowc['updated_at']; ?><!--</td>-->
                                    
                                </tr>
                            <?php } ?>
                            
                                        </tbody>
                                    </table>
                               </div>
                               </form>

<div id="edit_modal_theme_primary" class="modal col-lg-12 col-md-12">
    <div class="modal-dialog" style="width:100%">
        <div class="modal-content"><div class="card-header">
                <button type="button" style="color: white;font-size: 1.9125rem;" class="close" data-dismiss="modal">&times;</button>
                <span class="main-content-title mg-b-0 mg-b-lg-1">Update Document Type</span>
            </div>
            <form action="" id="user_form" enctype="multipart/form-data" class="form-horizontal"
                  method="post">
                <div class="card-body" style="">
                    <div class="col-lg-12 col-md-12">
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                 <div class="col-md-4">
                                    <label class="form-label mg-b-0">Document Type</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                     <input type="text" name="edit_name" id="edit_name" class="form-control" required>
                                <input type="hidden" name="edit_id" id="edit_id">
                                </div>
                            </div>
                         </div>

                         <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Enabled/Disabled </label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-2">
                                    <div class="row mg-t-15">
                                    <div class="col-lg-4">
                                    <label class="rdiobox">
                                                <input id="edit_yes" name="edit_enabled" value="yes" type="radio"> <span>Yes</span></label></div>
                                                <div class="col-lg-3 mg-t-10mg-lg-t-0">
                                                <label class="rdiobox">
                                                <input  id="edit_no" name="edit_enabled" value="no" type="radio"> <span>No</span></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">SAVE</button>
                </div>
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
                        var enabled = $(this).data("enabled");
                        $("#edit_name").val(name);
                        if(enabled == 'no'){
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
</div>
<script>
    window.onload = function () {
        history.replaceState("", "", "<?php echo $scriptName; ?>document_module/document_category.php");
    }
</script>
<script>
    $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>
<?php include('../footer1.php') ?>
</body>