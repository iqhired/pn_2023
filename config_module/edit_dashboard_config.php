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
//  header('location: ../logout.php');
    exit;
}
//Set the time of the user's last activity
$_SESSION['LAST_ACTIVITY'] = $time;

$i = $_SESSION["role_id"];
if ($i != "super" && $i != "admin") {
    header('location: ../dashboard.php');
}
$edit_name = $_POST['edit_cell_name'];
$enabled = $_POST['edit_enabled'];
$edit_file = $_FILES['upload_image']['name'];
if ($edit_name != "") {
    $id = $_POST['edit_id'];
    $stations = $_POST["edit_cell_stations"];
    $account = (isset($_POST['edit_cell_account']))?$_POST['edit_cell_account']:NULL;
    foreach ($stations as $station) {
        $array_stations .= $station . ",";
    }
//eidt logo
    if($edit_file != "")
    {
        if (isset($_FILES['upload_image'])) {
            $errors = array();
            $file_name = $_FILES['upload_image']['name'];
            $file_size = $_FILES['upload_image']['size'];
            $file_tmp = $_FILES['upload_image']['tmp_name'];
            $file_type = $_FILES['upload_image']['type'];
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
                move_uploaded_file($file_tmp, "../supplier_logo/" . $file_name);

                if(isset($account)){
                    $sql = "update `cell_grp` set c_name = '$edit_name',cell_logo = '$file_name',account_id = '$account',stations = '$array_stations', enabled = '$enabled'  where c_id='$id'";

                }else{
                    $sql = "update `cell_grp` set c_name = '$edit_name',cell_logo = '$file_name',stations = '$array_stations', enabled = '$enabled'  where c_id='$id'";

                }
            }
        }

    }
    else
    {
        if(isset($account)){
            $sql = "update `cell_grp` set c_name = '$edit_name', account_id = '$account',  stations = '$array_stations', enabled = '$enabled'  where c_id='$id'";

        }else{
            $sql = "update `cell_grp` set c_name = '$edit_name',  stations = '$array_stations', enabled = '$enabled'  where c_id='$id'";

        }
    }
    $result1 = mysqli_query($db, $sql);
    if ($result1) {
        $_SESSION['message_stauts_class'] = 'alert-success';
        $_SESSION['import_status_message'] = 'Cell Updated Sucessfully.';
        header("Location:dashboard_config.php");
    } else {
        $_SESSION['message_stauts_class'] = 'alert-danger';
        $_SESSION['import_status_message'] = 'Error: Please Retry';
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
        <?php echo $sitename; ?> |Update Cell Dashboard Config</title>
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
$cust_cam_page_header = "Edit Cell Dashboard Config";
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
                <li class="breadcrumb-item active" aria-current="page">Edit Dashboard Config</li>
            </ol>
        </div>
    </div>

    <form action="" id="edit_form_grp" class="form-horizontal" method="post">
        <div class="row-body">
            <?php
            $id = $_GET['id']; ?>
             <div class="col-lg-12 col-md-12">
                                       <?php
                                        $query = sprintf("SELECT * FROM cell_grp where c_id = '$id' AND is_deleted != '1'");
                                        $qur = mysqli_query($db, $query);
                                        $rowc = mysqli_fetch_array($qur);
                                        $cust_id = $rowc["account_id"];
                                        ?>
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">Edit Dashboard Configuration</span>
                        </div>


                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Cell Name:</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <input type="text" name="edit_cell_name" id="edit_cell_name" class="form-control" value = "<?php echo $rowc['c_name']; ?>" required>
                                    <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $id; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Stations:</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <select name="edit_cell_stations[]" id="edit_cell_stations" class="form-control form-select select2"  multiple="multiple">

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



                         <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Account:</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <select name="edit_cell_account" id="edit_cell_account"class="form-control form-select select2">
                                                   
                                                    <?php
                                                    $sql1 = "SELECT * FROM `cus_account` where is_deleted != 1 ORDER BY `c_name` ASC";
                                                    $result1 = $mysqli->query($sql1);
                                                    // $entry = 'selected';
                                                    while ($row1 = $result1->fetch_assoc()) {
                                                        echo "<option value='" . $row1['c_id'] . "'  >" . $row1['c_name'] . "</option>";
                                                    }
                                                    ?>
                                                </select>
                                </div>
                            </div>
                        </div>


                         <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Enabled: </label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <div class="row mg-t-17">
                                        <div class="col-lg-2">
                                            <label class="rdiobox">
                                                <input id="yes" name="edit_enabled" value="1" type="radio" <?php if ($rowc["enabled"] == '1'){echo 'checked';} ?>> <span>Yes</span></label>
                                        </div>
                                        <div class="col-lg-3 mg-t-10 mg-lg-t-0">
                                            <label class="rdiobox">
                                                <input  id="no" name="edit_enabled" value="0" type="radio" <?php if ($rowc["enabled"] == '0'){echo 'checked';} ?>> <span>No</span></label>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>


                         <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Upload Logo Image:</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <input type="file" name="upload_image" id="upload_image" class="form-control">
                                </div>
                            </div>
                        </div>



                         <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Previous Logo Preview :</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                   <div class="col-lg-9">

                                <img src="" alt="Image not Available" name="editlogo" id="editlogo" style="height:150px;width:150px;"/>
                                                
                                </div>
                            </div>
                        </div>
                    </div><div class="col-md-1"></div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5 submit_btn">SAVE</button>
                        </div>


                         
                    </div>
                </div>
                </form>
             </div>
        </div>
</div>
</body>
</html>