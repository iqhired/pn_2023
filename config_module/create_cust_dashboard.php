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

if (count($_POST) > 0) {
    //edit
    $edit_name = $_POST['edit_cell_name'];
    //$edit_file = $_FILES['edit_logo_image']['name'];
    if ($edit_name != "") {

        $id = $_POST['edit_id'];
        $stations = $_POST["edit_cell_stations"];
        //$account = (isset($_POST['edit_cell_account']))?$_POST['edit_cell_account']:NULL;
        foreach ($stations as $station) {
            $array_stations .= $station . ",";
        }
//eidt logo
        $sql = "update `sg_cust_dashboard` set sg_cust_dash_name = '$edit_name',  stations = '$array_stations', enabled = '$_POST[edit_enabled]'  where sg_cust_group_id='$id'";
        $result1 = mysqli_query($db, $sql);
        if ($result1) {
            $message_stauts_class = 'alert-success';
            $import_status_message = 'Dashboard Updated Successfully.';
//          $sql = "select stations from `sg_cust_dashboard`";
//          $result1 = mysqli_query($db, $sql);
//          $line_array = array();
//          while ($rowc = mysqli_fetch_array($result1)) {
//              $arr_stations = explode(',', $rowc['stations']);
//              foreach ($arr_stations as $station){
//                  if(isset($station) && $station != ''){
//                      array_push($line_array , $station);
//                  }
//              }
//          }
        } else {
            $message_stauts_class = 'alert-danger';
            if($import_status_message == "")
            {
                $import_status_message = 'Error: Please Try Again.';
            }
        }

    }else{
        $cell_name = $_POST['c_grp_name'];
//create
        if (isset($cell_name)) {
            $enabled = $_POST['enabled'];
            $stations = $_POST['stations'];
            foreach ($stations as $station) {
                $array_stations .= $station . ",";
            }
        }
        $sql = "INSERT INTO `sg_cust_dashboard`(`sg_cust_dash_name`,  `stations`, `enabled`, `created_at`) VALUES('$cell_name','$array_stations','$enabled','$chicagotime')";
        $result1 = mysqli_query($db, $sql);
        if (!$result1) {
            $message_stauts_class = 'alert-danger';
            if($import_status_message == "")
            {
                $import_status_message = 'Error: Dashboard Already Exists';
            }
        } else {
            $message_stauts_class = 'alert-success';
            $import_status_message = 'Dashboard Created Successfully';
//          $sql = "select stations from `sg_cust_dashboard`";
//          $result1 = mysqli_query($db, $sql);
//          $line_array = array();
//          while ($rowc = mysqli_fetch_array($result1)) {
//              $arr_stations = explode(',', $rowc['stations']);
//              foreach ($arr_stations as $station){
//                  if(isset($station) && $station != ''){
//                      array_push($line_array , $station);
//                  }
//              }
//          }
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
        <?php echo $sitename; ?> |Custom Dashboard Configuration</title>
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
$cust_cam_page_header = "Dashboard Configuration";
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
                <li class="breadcrumb-item active" aria-current="page">Dashboard Configuration</li>
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
                            <span class="main-content-title mg-b-0 mg-b-lg-1">Dashboard Configuration</span>
                        </div>

                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Dashboard Name :*</label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <input type="text" class="form-control" name="c_grp_name" id="c_grp_name" placeholder="Enter Cell Group Name" required>
                                    <div id="error6" class="red">
                                    </div>
                                </div>



                                <div class="col-md-1"></div>
                                <div class="col-md-1">
                                    <label class="form-label mg-b-0">Enabled : </label>
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
                                    <label class="form-label mg-b-0">Select Station : </label>
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
                                            <th>Sl. No</th>
                                            <th>Action</th>
                                            <th>Dashboard Name</th>
                                            <th>Stations</th>
                                            <th>Dashboard </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $query = sprintf("SELECT * FROM sg_cust_dashboard where is_deleted!='1'");
                                        $qur = mysqli_query($db, $query);

                                        while ($rowc = mysqli_fetch_array($qur)) {
                                            $c_id = $rowc["sg_cust_group_id"];
//                      $cust_id = $rowc["account_id"];
                                            ?>
                                            <tr>
                                                <td><label class="ckbox"><input type="checkbox" id="delete_check[]" name="delete_check[]" value="<?php echo $c_id; ?>"><span></span></label>
                                                </td>

                                                <td><?php echo ++$counter; ?>
                                                </td>
                                                <td>
                                                    <a href="edit_create_cust_dashboard.php?id=<?php echo $c_id; ?>" class="btn btn-primary" data-id="<?php echo $rowc['defect_list_id']; ?>"  style="background-color:#1e73be;"><i class="fa fa-edit"></i> </a>

                                                </td>
                                                <td><?php echo $rowc["sg_cust_dash_name"]; ?>
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
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<!-----main content----->
</div>
<script>
    window.onload = function () {
        history.replaceState("", "", "<?php echo $scriptName; ?>config_module/create_cust_dashboard.php");
    }
</script>

<script>
    $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
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
<?php include('../footer1.php') ?>

</body>
</html>
