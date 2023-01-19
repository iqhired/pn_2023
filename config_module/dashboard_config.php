<?php
include("../config.php");
$import_status_message = "";
//include("../sup_config.php");
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
//$sql = "select stations from `sg_cust_dashboard`";
//$result1 = mysqli_query($db, $sql);
//$line_array = array();
//while ($rowc = mysqli_fetch_array($result1)) {
//  $arr_stations = explode(',', $rowc['stations']);
//  foreach ($arr_stations as $station){
//      if(isset($station) && $station != ''){
//          array_push($line_array , $station);
//      }
//  }
//}

$is_tab_login = $_SESSION['is_tab_user'];
$is_cell_login = $_SESSION['is_cell_login'];
//Set the time of the user's last activity
$_SESSION['LAST_ACTIVITY'] = $time;
$i = $_SESSION["role_id"];
if ($i != "super" && $i != "admin" && $i != "pn_user" && $_SESSION['is_tab_user'] != 1 && $_SESSION['is_cell_login'] != 1 ) {
    header('location: ../dashboard.php');
}

$sql = "select stations from `cell_grp`";
$result1 = mysqli_query($db, $sql);
$line_array = array();
while ($rowc = mysqli_fetch_array($result1)) {
    $arr_stations = explode(',', $rowc['stations']);
    foreach ($arr_stations as $station){
        if(isset($station) && $station != ''){
            array_push($line_array , $station);
        }
    }
}
if (count($_POST) > 0) {
    $cell_name = $_POST['c_grp_name'];
//create
    if (isset($cell_name)) {
        $enabled = $_POST['enabled'];
        $account = (isset($_POST['account']))?$_POST['account']:NULL;
        $stations = $_POST['stations'];
        foreach ($stations as $station) {
            $array_stations .= $station . ",";
        }
//logo
        if (isset($_FILES['image']) && ($_FILES['image']['size'] > 0 )) {
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
                $fname = "cell_grp_" .time() . "_" . $file_name;
                move_uploaded_file($file_tmp, "../supplier_logo/".$fname);
                if(isset($account)){
                    $sql = "INSERT INTO `cell_grp`(`c_name`, `account_id`, `cell_logo`, `stations`, `enabled`, `created_at`) VALUES('$cell_name','$account','$fname','$array_stations','$enabled','$chicagotime')";

                }else{
                    $sql = "INSERT INTO `cell_grp`(`c_name`,  `cell_logo`, `stations`, `enabled`, `created_at`) VALUES('$cell_name','$fname','$array_stations','$enabled','$chicagotime')";

                }
            }
        }
        else
        {
            if(isset($account)){
                $sql = "INSERT INTO `cell_grp`(`c_name`, `account_id`, `stations`, `enabled`, `created_at`) VALUES('$cell_name',$account,'$array_stations','$enabled','$chicagotime')";

            }else{
                $sql = "INSERT INTO `cell_grp`(`c_name`,  `stations`, `enabled`, `created_at`) VALUES('$cell_name','$array_stations','$enabled','$chicagotime')";

            }

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
            $import_status_message = 'Cell Created Successfully';
            $sql = "select stations from `cell_grp`";
            $result1 = mysqli_query($db, $sql);
            $line_array = array();
            while ($rowc = mysqli_fetch_array($result1)) {
                $arr_stations = explode(',', $rowc['stations']);
                foreach ($arr_stations as $station){
                    if(isset($station) && $station != ''){
                        array_push($line_array , $station);
                    }
                }
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
        <?php echo $sitename; ?> |Cell Dashboard Configuration</title>
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
$cust_cam_page_header = "Cell Dashboard Configuration";
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
                <li class="breadcrumb-item active" aria-current="page">Cell Dashboard Configuration</li>
            </ol>
        </div>
    </div>

    <form action="" id="cell_grp_form" class="form-horizontal" method="post">
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
                            <span class="main-content-title mg-b-0 mg-b-lg-1">Cell Dashboard Configuration</span>
                        </div>

                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Cell Group Name:</label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <input type="text" name="c_grp_name" id="c_grp_name" class="form-control" placeholder="Enter Cell Group Name" required>
                                    <div id="error6" class="red">
                                    </div>
                                </div>


                                <div class="col-md-1"></div>
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Customer/Account:</label>
                                </div>

                                <div class="col-md-3 mg-t-10 mg-md-t-0">
                                    <select name="account" id="account" class="form-control form-select select2">

                                        <option value="" selected disabled>--- Select Customer / Account  ---</option>
                                        <?php
                                        $sql1 = "SELECT * FROM `cus_account` where c_status = 1 and is_deleted != 1 ORDER BY `c_name` ASC";
                                        $result1 = $mysqli->query($sql1);
                                        //                                            $entry = 'selected';
                                        while ($row1 = $result1->fetch_assoc()) {
                                            echo "<option value='" . $row1['c_id'] . "'  >" . $row1['c_name'] . "</option>";
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
                                    <label class="form-label mg-b-0">Upload Cell Image:</label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <input type="file" name="image" id="image"
                                           class="form-control">
                                    <div id="1" style="color:red;">* File size must be less than 2 MB.
                                    </div>
                                    <div id="error6" class="red">
                                    </div>
                                </div>


                                <div class="col-md-1"></div>
                                <div class="col-md-1">
                                    <label class="form-label mg-b-0">Enabled:</label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
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
                                    <label class="form-label mg-b-0">Select Stations:</label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <select name="stations[]" id="stations" class="form-control form-select select2" data-placeholder="Add Stations.." multiple="multiple">

                                        <?php
                                        //$assigned_stations = implode("', '", $line_array);
                                        $sql1 = "SELECT `line_id`, `line_name` FROM `cam_line` where enabled = 1 order by line_name ASC";
                                        //                                              $sql1 = "SELECT `line_id`, `line_name` FROM `cam_line` where enabled = 1 order by line_name ASC";
                                        $result1 = $mysqli->query($sql1);
                                        while ($row1 = $result1->fetch_assoc()) {
                                            echo "<option id='" . $row1['line_id'] . "'  value='" . $row1['line_id'] . "'>" . $row1['line_name'] . "</option>";
                                        }
                                        ?>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-1"></div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5 submit_btn">ADD</button>
                        </div>
                    </div>
                </div>
    </form>
</div>
</div>


<form action="" id="update-form" method="post" class="form-horizontal">
    <div class="row-body">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <button type="submit" class="btn btn-danger  submit_btn"  onclick="submitForm('delete_dash.php')" style=""><i class="fa fa-trash-o" style="font-size:20px"></i></button>
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
                                            <th>Sl.No</th>
                                            <th>Action</th>
                                            <th>Cell Group Name</th>
                                            <th>Account</th>
                                            <th>Stations</th>
                                            <th>Cell Status</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $query = sprintf("SELECT * FROM cell_grp where is_deleted!='1';  ");
                                        $qur = mysqli_query($db, $query);

                                        while ($rowc = mysqli_fetch_array($qur)) {
                                            $c_id = $rowc["c_id"];
                                            $cust_id = $rowc["account_id"];
                                            ?>
                                            <tr>
                                                <td><input type="checkbox" id="delete_check[]" name="delete_check[]"
                                                           value="<?php echo $c_id; ?>"></td>
                                                <td><?php echo ++$counter; ?>
                                                </td>
                                                <td>
                                                    <a href="edit_dashboard_config.php?id=<?php echo $c_id; ?>" class="btn btn-primary" data-id="<?php echo $cust_id; ?>"  style="background-color:#1e73be;"><i class="fa fa-edit"></i></a>
                                                    <!--<button type="button" id="edit" class="btn btn-info btn-xs"
                                                data-id="<?php /*echo $rowc['c_id']; */?>"
                                                data-cell_name="<?php /*echo $rowc['c_name']; */?>"
                                                data-cell_enabled="<?php /*echo $rowc['enabled']; */?>"
                                                data-cell_account_id="<?php /*echo $cust_id; */?>"
                                                data-cell_stations="<?php /*echo $stations; */?>"
                                                data-cell_logo="<?php /*echo $rowc['cell_logo']; */?>"
                                                data-assigned_line="<?php /*echo implode(",", $line_array); */?>"
                                                data-toggle="modal" style="background-color:#1e73be;"
                                                data-target="#edit_modal_theme_primary">Edit
                                        </button>-->
                                                </td>
                                                <td><?php echo $rowc["c_name"]; ?>
                                                </td>
                                                <td><?php
                                                    $query34 = sprintf("SELECT * FROM  cus_account where c_id = '$cust_id'");
                                                    $qur34 = mysqli_query($db, $query34);
                                                    $rowc34 = mysqli_fetch_array($qur34);
                                                    echo $rowc34["c_name"]; ?>
                                                </td>
                                                <?php
                                                $enabled = $rowc['enabled'];
                                                $c_status = "Active";
                                                if($enabled == 0){
                                                    $c_status = "Inactive";
                                                }
                                                ?>
                                                <td>
                                                    <?php
                                                    $stations = $rowc['stations'];
                                                    $arr_stations = explode(',', $stations);

                                                    // glue them together with ', '
                                                    $stationStr = implode("', '", $arr_stations);
                                                    $sql = "SELECT line_name FROM `cam_line` WHERE line_id IN ('$stationStr')";
                                                    $result1 = mysqli_query($db, $sql);
                                                    $line = '';
                                                    $i = 0;
                                                    while ($row =  $result1->fetch_assoc()) {
                                                        if($i == 0){
                                                            $line = $row['line_name'];
                                                        }else{
                                                            $line .= " , " . $row['line_name'];
                                                        }
                                                        $i++;
                                                    }
                                                    echo $line;
                                                    ?>
                                                </td>
                                                <td><?php echo $c_status; ?>
                                                </td>

                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<!---container--->
</div>

<script>
    $(document).on('click', '#edit', function () {
        var element = $(this);
        var edit_id = element.attr("data-id");
        var cell_name = $(this).data("cell_name");
        var cell_account_id = $(this).data("cell_account_id");
        var cell_enabled = $(this).data("cell_enabled");
        var assigned_line = $(this).data("assigned_line");
        var cell_stations = $(this).data("cell_stations");
        var cell_logo = $(this).data("cell_logo");
        $("#edit_name").val(name);
        $("#edit_cell_name").val(cell_name);
        $("#edit_cs").val(cell_stations);
        $("#edit_cell_account").val(cell_account_id);
        $("#edit_cell_stations").val(cell_stations);
        $("#edit_enabled").val(cell_enabled);
        $("#editlogo").attr("src","../supplier_logo/"+cell_logo);
        $("#edit_id").val(edit_id);

        var assLineArr = assigned_line.split(',');

        // const sb = document.querySelector('#cell_stations');
        var sb1 = document.querySelector('#edit_cell_stations');
        // create a new option
        var stations = cell_stations.split(',');
        var options = [];
        var options1 = sb1.options;
        var nasslinearr = [];
        // $("#edit_part_number").val(options);
        $('#edit_modal_theme_primary .select2 .selection .select2-selection--multiple .select2-selection__choice').remove();
        var j = assigned_line.length;

        for (var i = 0; i < options1.length; i++) {
            if(stations.includes(options1[i].value)){ // EDITED THIS LINE
                options1[i].selected="selected";
                options1[i].className = ("select2-results__option--highlighted");
                var opt = document.getElementById(options1[i].value).outerHTML.split(">");
                // $('#edit_cell_stations').prop('selectedIndex',i);
                $('#select2-results .select2-results__option').prop('selectedIndex',i);
                var gg = '<li class="select2-selection__choice" title="' + opt[1].replace('</option','') + '"><span class="select2-selection__choice__remove" role="presentation">×</span>' + opt[1].replace('</option','') + '</li>';
                $('#edit_modal_theme_primary .select2-selection__rendered').append(gg);
                options[j]= options1[i];
                j++;
                nasslinearr [j] = options1[i].value;
                // $('.select2-search__field').style.visibility='hidden';
            }else if(assLineArr.includes(options1[i].value)){
                document.getElementById(options1[i].value).remove();
                i--;
            }

        }
    });
    $(".select").select2();
</script>

<script>
    window.onload = function () {
        history.replaceState("", "", "<?php echo $scriptName; ?>config_module/dashboard_config.php");
    }
</script>
<script>
    function submitForm(url) {
        //   $(':input[type="button"]').prop('disabled', true);
        location.reload();
        var data = $("#update-form").serialize();
        $.ajax({
            type: 'POST',
            url: url,
            data: data,
            success: function (data) {
                // window.location.href = window.location.href + "?aa=Line 1";
                //   $(':input[type="button"]').prop('disabled', false);
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

<!---container--->

</body>
</html>