<?php
include("../config.php");
$chicagotime = date("Y-m-d H:i:s");
$temp = "";
checkSession();


if (count($_POST) > 0) {
    $equipment = $_POST['equipment'];
    $description = $_POST['description'];
    $property = $_POST['property'];
    $building = $_POST['building'];
    $created_by = $_SESSION["id"];
//create
    if ($equipment != "") {
        $sql0 = "INSERT INTO `tm_equipment`(`tm_equipment_name`, `created_by` ) VALUES ('$equipment' , '$created_by')";
        $result0 = mysqli_query($db, $sql0);
        if ($result0) {
            $message_stauts_class = 'alert-success';
            $import_status_message = 'Equipment created successfully.';
        } else {
            $message_stauts_class = 'alert-danger';
            $import_status_message = 'Error: Please Insert valid data';
        }
////$temp = "one";
    } else if ($description != "") {
        $sql0 = "INSERT INTO `tm_description`(`tm_description_name`, `created_by` ) VALUES ('$description' , '$created_by')";
        $result0 = mysqli_query($db, $sql0);
        if ($result0) {
            $message_stauts_class = 'alert-success';
            $import_status_message = 'Description created successfully.';
        } else {
            $message_stauts_class = 'alert-danger';
            $import_status_message = 'Error: Please Insert valid data';
        }
    } else if ($property != "") {
        $sql0 = "INSERT INTO `tm_property`(`tm_property_name`, `created_by` ) VALUES ('$property' , '$created_by')";
        $result0 = mysqli_query($db, $sql0);
        if ($result0) {
            $message_stauts_class = 'alert-success';
            $import_status_message = 'Property created successfully.';
        } else {
            $message_stauts_class = 'alert-danger';
            $import_status_message = 'Error: Please Insert valid data';
        }
    } else if ($building != "") {
        $sql0 = "INSERT INTO `tm_building`(`tm_building_name`, `created_by` ) VALUES ('$building' , '$created_by')";
        $result0 = mysqli_query($db, $sql0);
        if ($result0) {
            $message_stauts_class = 'alert-success';
            $import_status_message = 'Building created successfully.';
        } else {
            $message_stauts_class = 'alert-danger';
            $import_status_message = 'Error: Please Insert valid data';
        }
    }
//edit
    $edit_equipment = $_POST['edit_equipment'];
    $edit_description = $_POST['edit_description'];
    $edit_property = $_POST['edit_property'];
    $edit_building = $_POST['edit_building'];
    if ($edit_equipment != "") {
        $id = $_POST['edit_equipment_id'];
        $sql = "update tm_equipment set tm_equipment_name ='$_POST[edit_equipment]'  where tm_equipment_id ='$id'";
        $result1 = mysqli_query($db, $sql);
        if ($result1) {
            $message_stauts_class = 'alert-success';
            $import_status_message = 'Equipment Updated successfully.';
        } else {
            $message_stauts_class = 'alert-danger';
            $import_status_message = 'Error: Please Insert valid data';
        }
    } else if ($edit_description != "") {
        $id = $_POST['edit_description_id'];
        $sql = "update tm_description set tm_description_name ='$_POST[edit_description]'  where tm_description_id ='$id'";
        $result1 = mysqli_query($db, $sql);
        if ($result1) {
            $message_stauts_class = 'alert-success';
            $import_status_message = 'Description Updated successfully.';
        } else {
            $message_stauts_class = 'alert-danger';
            $import_status_message = 'Error: Please Insert valid data';
        }
    } else if ($edit_property != "") {
        $id = $_POST['edit_property_id'];
        $sql = "update tm_property set tm_property_name ='$_POST[edit_property]'  where tm_property_id ='$id'";
        $result1 = mysqli_query($db, $sql);
        if ($result1) {
            $message_stauts_class = 'alert-success';
            $import_status_message = 'Property Updated successfully.';
        } else {
            $message_stauts_class = 'alert-danger';
            $import_status_message = 'Error: Please Insert valid data';
        }
    } else if ($edit_building != "") {
        $id = $_POST['edit_building_id'];
        $sql = "update tm_building set tm_building_name ='$_POST[edit_building]'  where tm_building_id ='$id'";
        $result1 = mysqli_query($db, $sql);
        if ($result1) {
            $message_stauts_class = 'alert-success';
            $import_status_message = 'Building Updated successfully.';
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
        <?php echo $sitename; ?> |Asset Config</title>
    <!-- Global stylesheets -->

    <link href="../assets/css/core.css" rel="stylesheet" type="text/css">


    <!-- /global stylesheets -->
    <!-- Core JS files -->
    <!--    <script type="text/javascript" src="../assets/js/libs/jquery-3.6.0.min.js"> </script>-->
    <script src="<?php echo $siteURL; ?>assets/js/libs/jquery-3.4.1.min.js"></script>
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
    $cust_cam_page_header = "Asset Config";
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
                <li class="breadcrumb-item active" aria-current="page">Asset Config</li>
            </ol>
        </div>
    </div>

     <form action="" id="user_form" class="form-horizontal" method="post">
        <div class="row-body">
            <div class="col-lg-12 col-md-12">


                <?php
if (!empty($import_status_message)) {
    echo '<br/><div class="alert ' . $message_stauts_class . '">' . $import_status_message . '</div>';
}
                displaySFMessage();

?>

                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">ASSETS CONFIGURATION</span>
                        </div>
                    </br>
                        <div class="tabbable">
                                    <ul class="nav nav-tabs  nav-tabs-highlight" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#css-animate-tab1" role="tab" aria-controls="css-animate-tab1" aria-selected="true">Equipment</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#css-animate-tab3" role="tab" aria-controls="css-animate-tab3" aria-selected="false">Property</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#css-animate-tab4" role="tab" aria-controls="css-animate-tab4" aria-selected="false">Building</a>
                                        </li>
                                    </ul>
                                </div>
                            </br>

                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane animated fadeInUp active" id="css-animate-tab1" role="tabpanel" aria-labelledby="css-animate-tab1-tab">
                                        <form action="" id="user_form" class="form-horizontal" method="post">
                                            <div class="col-md-4">
                                                <input type="text" name="equipment" id="equipment" class="form-control" placeholder="Enter Equipment" required>
                                            </div>
                                        
                                           <div class="card-body pt-0">
                                    <button type="submit" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5 submit_btn">ADD</button>

                                </div>
                                        </form>
                                    </div>
                                    <div class="tab-pane animated fadeInUp" id="css-animate-tab3" role="tabpanel" aria-labelledby="css-animate-tab3-tab">
                                        <form action="" id="user_form" class="form-horizontal" method="post">
                                            <div class="col-md-4">
                                                <input type="text" name="property" id="property" class="form-control" placeholder="Enter Property" required>
                                            </div>
                                        
                                           <div class="card-body pt-0">
                                    <button type="submit" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5 submit_btn">ADD</button>

                                </div>
                                        </form>
                                    </div>

                                    <div class="tab-pane animated fadeInUp" id="css-animate-tab4" role="tabpanel" aria-labelledby="css-animate-tab4-tab">
                                        <form action="" id="user_form" class="form-horizontal" method="post">
                                            <div class="col-md-4">
                                                <input type="text" name="building" id="building" class="form-control" placeholder="Enter Building" required>
                                            </div>
                                        

                                             <div class="card-body pt-0">
                                    <button type="submit" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5 submit_btn">ADD</button>

                                </div>
                                        </form>
                                    </div> 

                                </div> 
                            </div> 
                        </form> 
                    </div> 
                </div>
            </div>




                
    <div class="row-body">
        <div class="col-12 col-sm-6">
            <div class="card">
                <div class="card-body pt-0 example1-table">
                    <div class="table-responsive">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table  table-bordered text-nowrap mb-0" id="example2">
                                        <thead>
                                        <tr>
                                            <th><label class="ckbox"><input type="checkbox" id="checkAll"><span></span></label></th>
                                           <th>Equipment</th>
                                           <th>Action</th>
                                          
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                $query = sprintf("SELECT * FROM  tm_equipment where is_deleted!='1'");
                                $qur = mysqli_query($db, $query);
                                while ($rowc = mysqli_fetch_array($qur)) {
                                    ?> 
                                                <tr>
                                                    <td><label class="ckbox"><input type="checkbox" id="delete_check[]" name="delete_check[]" value="<?php echo $rowc["tm_equipment_id"]; ?>" class="del_eq"><span></span></label></td>
                                                    <td><?php echo $rowc["tm_equipment_name"]; ?></td>
                                                    <td>
                                                       <button type="button" class="btn btn-primary btn-xs" data-popup="" title="Edit" id="edit1" data-id1="<?php echo $rowc['tm_equipment_id']; ?>" data-name1="<?php echo $rowc['tm_equipment_name']; ?>" data-toggle="modal"  data-target="#edit_modal_theme_primary1"><i class="fa fa-edit"></i></button>
                                                            <button type="button" class="btn btn-danger btn-xs" id="delete" data-name="equipment" data-id="<?php echo $rowc['tm_equipment_id']; ?>"><i class="fa fa-trash-o" style="font-size:18px"></i></button>
    <!--                                    
                                                <button type="button" id="delete" class="btn btn-danger btn-xs" data-id="<?php echo $rowc['tm_equipment_id']; ?>">Delete </button>
                                                        -->                                 
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

            </div>
        </div>



        <div class="col-12 col-sm-6">
            <div class="card">
                
                <div class="card-body pt-0 example1-table">
                    <div class="table-responsive">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table  table-bordered text-nowrap mb-0" id="example2">
                                        <thead>
                                        <tr>
                                            <th><label class="ckbox"><input type="checkbox" id="checkAll"><span></span></label></th>
                                          <th>Property</th>
                                                <th>Action</th>
                                          
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
$query = sprintf("SELECT * FROM  tm_property where is_deleted!='1'");
$qur = mysqli_query($db, $query);
while ($rowc = mysqli_fetch_array($qur)) {
    ?> 
                                                <tr>
                                                    <td><label class="ckbox"><input type="checkbox" id="delete_check[]" name="delete_check[]" value="<?php echo $rowc["tm_property_id"]; ?>"><span></span></label></td>
                                                    <td><?php echo $rowc["tm_property_name"]; ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary btn-xs" data-popup="tooltip" title="Edit" id="edit3" data-id3="<?php echo $rowc['tm_property_id']; ?>" data-name3="<?php echo $rowc['tm_property_name']; ?>"  data-toggle="modal"  data-target="#edit_modal_theme_primary3"><i class="fa fa-edit"></i></button>
                                                        <button type="button" class="btn btn-danger btn-xs" id="delete" data-name="property" data-id="<?php echo $rowc['tm_property_id']; ?>"><i class="fa fa-trash-o" style="font-size:18px"></i></button>
                                                        <!--                                    &nbsp; <button type="button" id="delete" class="btn btn-danger btn-xs" data-id="<?php echo $rowc['line_id']; ?>">Delete </button>
                                                        -->                                 
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

            </div>
        </div>


        <div class="col-12 col-sm-6">
            <div class="card">
                
                <div class="card-body pt-0 example1-table">
                    <div class="table-responsive">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table  table-bordered text-nowrap mb-0" id="example2">
                                        <thead>
                                        <tr>
                                            <th><label class="ckbox"><input type="checkbox" id="checkAll"><span></span></label></th>
                                           <th>Building</th>
                                                <th>Action</th>
                                          
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <?php
$query = sprintf("SELECT * FROM  tm_building where is_deleted!='1'");
$qur = mysqli_query($db, $query);
while ($rowc = mysqli_fetch_array($qur)) {
    ?> 
                                                <tr>
                                                    <td><label class="ckbox"><input type="checkbox" id="delete_check[]" name="delete_check[]" value="<?php echo $rowc["tm_building_id"]; ?>"><span></span></label></td>
                                                    <td><?php echo $rowc["tm_building_name"]; ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-primary btn-xs"data-popup="tooltip" title="Edit" id="edit4" data-id4="<?php echo $rowc['tm_building_id']; ?>" data-name4="<?php echo $rowc['tm_building_name']; ?>" data-toggle="modal"  data-target="#edit_modal_theme_primary4"> <i class="fa fa-edit"></i></button>
                                                            <button type="button" class="btn btn-danger btn-xs" id="delete" data-name="building" data-id="<?php echo $rowc['tm_building_id']; ?>"><i class="fa fa-trash-o" style="font-size:18px"></i></button>
                                                        <!--                                    &nbsp; <button type="button" id="delete" class="btn btn-danger btn-xs" data-id="<?php echo $rowc['line_id']; ?>">Delete </button>
                                                        -->                                 
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

            </div>
        </div>



</div>



 <!-- /basic datatable -->
                        <!-- /main charts -->
                        <!-- edit modal -->
                        <div id="edit_modal_theme_primary1" class="modal col-lg-12 col-md-12">
                            <div class="modal-dialog" style="width:100%">
                                <div class="modal-content">
                                     <div class="card-header">
                                        <button type="button" style="color: white;font-size: 1.9125rem;" class="close" data-dismiss="modal">&times;</button>
                <span class="main-content-title mg-b-0 mg-b-lg-1">Update Equipment</span>
                                    </div>
                                    <form action="" id="user_form"  enctype="multipart/form-data" class="form-horizontal" method="post">
                                        <div class="card-body" style="">
                    <div class="col-lg-12 col-md-12">
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                 <div class="col-md-4">
                                                        <label class="col-lg-3 control-label">Equipment:*</label>
                                                    </div>
                                                      <div class="col-md-8 mg-t-10 mg-md-t-0">
                                                            <input type="text" name="edit_equipment" id="edit_equipment" class="form-control" required>
                                                            <input type="hidden" name="edit_equipment_id" id="edit_equipment_id" >
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




                        <div id="edit_modal_theme_primary3" class="modal col-lg-12 col-md-12">
                            <div class="modal-dialog" style="width:100%">
                                 <div class="modal-content">
                                    <div class="card-header">
                                        <button type="button" style="color: white;font-size: 1.9125rem;" class="close" data-dismiss="modal">&times;</button>
                <span class="main-content-title mg-b-0 mg-b-lg-1">Update Property</span>
                                    </div>
                                    <form action="" id="user_form" enctype="multipart/form-data" class="form-horizontal" method="post">
                                        <div class="card-body" style="">
                    <div class="col-lg-12 col-md-12">
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Property</label>
                                </div>
                                                        
                                                         <div class="col-md-8 mg-t-10 mg-md-t-0">
                                                            <input type="text" name="edit_property" id="edit_property" class="form-control" required>
                                                            <input type="hidden" name="edit_property_id" id="edit_property_id" >
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
                        <div id="edit_modal_theme_primary4" class="modal col-lg-12 col-md-12">
                            <div class="modal-dialog" style="width:100%">
                                <div class="modal-content">
                                    <div class="card-header">
                                        <button type="button" style="color: white;font-size: 1.9125rem;" class="close" data-dismiss="modal">&times;</button>
                <span class="main-content-title mg-b-0 mg-b-lg-1">Update Building</span>
                                    </div>
                                    <form action="" id="user_form" class="form-horizontal" method="post">
                                        <div class="card-body" style="">
                    <div class="col-lg-12 col-md-12">
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                                    <div class="col-md-4">
                                    <label class="form-label mg-b-0">Building :</label>
                                </div>
                                                      <div class="col-md-8 mg-t-10 mg-md-t-0">
                                                            <input type="text" name="edit_building" id="edit_building" class="form-control" required>
                                                            <input type="hidden" name="edit_building_id" id="edit_building_id" >
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
                        <!-- /dashboard content -->
                        <script> $(document).on('click', '#delete', function () {
                                var element = $(this);
                                var del_id = element.attr("data-id");
                                var del_name = element.attr("data-name");
                                                                $.ajax({type: "POST", 
                                url: "ajax_assets_delete.php",
                                data:{
                                    info:del_id,
                                    name:del_name
                                },  
                                success: function (data) {
                                    //alert(data);
                                    
                                    }});
                                $(this).parents("tr").animate({backgroundColor: "#003"}, "slow").animate({opacity: "hide"}, "slow");
                                
                            });</script>
                        <script>
                            jQuery(document).ready(function ($) {
                                $(document).on('click', '#edit1', function () {
                                    var element = $(this);
                                    var edit_id1 = element.attr("data-id1");
                                    var name1 = $(this).data("name1");
                                    $("#edit_equipment").val(name1);
                                    $("#edit_equipment_id").val(edit_id1);
                                    //alert(role);
                                });
                                $(document).on('click', '#edit2', function () {
                                    var element = $(this);
                                    var edit_id2 = element.attr("data-id2");
                                    var name2 = $(this).data("name2");
                                    $("#edit_description").val(name2);
                                    $("#edit_description_id").val(edit_id2);
                                    //alert(role);
                                });
                                $(document).on('click', '#edit3', function () {
                                    var element = $(this);
                                    var edit_id3 = element.attr("data-id3");
                                    var name3 = $(this).data("name3");
                                    $("#edit_property").val(name3);
                                    $("#edit_property_id").val(edit_id3);
                                    //alert(role);
                                });
                                $(document).on('click', '#edit4', function () {
                                    var element = $(this);
                                    var edit_id4 = element.attr("data-id4");
                                    var name4 = $(this).data("name4");
                                    $("#edit_building").val(name4);
                                    $("#edit_building_id").val(edit_id4);
                                    //alert(role);
                                });
                            });
                        </script>
                        
                        <script>
                            window.onload = function() {
                                history.replaceState("", "", "<?php echo $scriptName; ?>config_module/create_assets.php");
                            }
                        </script> 
                        <script>
                            $("#checkAll").click(function () {
                                $('input:checkbox').not(this).prop('checked', this.checked);
                            });
                        </script>


    















</div>
 <?php include ('../footer1.php') ?>
</body>

