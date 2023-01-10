<?php include("../config.php");
$curdate = date(mdY_FORMAT);
$button = "";
$temp = "";
if (!isset($_SESSION['user'])) {
    header('location: logout.php');
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
$button_event = "button3";
$curdate = date(mdY_FORMAT);
$dfrom =   date(mdY_FORMAT,strtotime("-1 days"));
$dateto = $curdate;
$datefrom = $dfrom;
$temp = "";

$_SESSION['station'] = "";
$_SESSION['date_from'] = "";
$_SESSION['date_to'] = "";
$_SESSION['timezone'] = "";
$_SESSION['part_family'] = "";
$_SESSION['part_number'] = "";
$_SESSION['material_type'] = "";

if (count($_POST) > 0) {
    $_SESSION['station'] = $_POST['station'];
    $_SESSION['part_family'] = $_POST['part_family'];
    $_SESSION['part_number'] = $_POST['part_number'];
    $_SESSION['date_from'] = $_POST['date_from'];
    $_SESSION['date_to'] = $_POST['date_to'];
    $_SESSION['timezone'] = $_POST['timezone'];

    $station = $_POST['station'];
    $pf = $_POST['part_family'];
    $pn = $_POST['part_number'];
    $dateto = $_POST['date_to'];
    $datefrom = $_POST['date_from'];
    $timezone = $_POST['timezone'];
}

$qurtemp = mysqli_query($db, "SELECT * FROM  cam_line where line_id = '$station' ");
while ($rowctemp = mysqli_fetch_array($qurtemp)) {
    $station1 = $rowctemp["line_name"];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo $sitename; ?> | 10x Log</title>
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
$cust_cam_page_header = "10x Log";
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
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Logs</a></li>
                <li class="breadcrumb-item active" aria-current="page"> 10x Log</li>
            </ol>
        </div>
    </div>
    <form action="" id="user_form" class="form-horizontal" method="post">
        <div class="row-body">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">10x Log</span>
                        </div>
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-1">
                                    <label class="form-label mg-b-0">Station : </label>
                                </div>
                                <div class="col-md-5 mg-t-10 mg-md-t-0">
                                    <select name="station" id="station" class="form-control form-select select2" data-placeholder="Select Station">
                                        <option value="" selected disabled>--- Select Station ---</option>
                                        <?php
                                        $st_dashboard = $_POST['station'];
                                        $sql1 = "SELECT * FROM `cam_line` where enabled = '1' and is_deleted != 1 ORDER BY `line_name` ASC ";
                                        $result1 = $mysqli->query($sql1);
                                        //                                            $entry = 'selected';
                                        while ($row1 = $result1->fetch_assoc()) {
                                            if($st_dashboard == $row1['line_id'])
                                            {
                                                $entry = 'selected';
                                            }
                                            else
                                            {
                                                $entry = '';

                                            }
                                            echo "<option value='" . $row1['line_id'] . "'  $entry>" . $row1['line_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Part Family *  : </label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <select name="part_family" id="part_family" class="form-control form-select select2" data-placeholder="Select Part Family">
                                        <option value="" selected disabled>--- Select Part Family ---</option>
                                        <?php
                                        $st_dashboard = $_POST['part_family'];
                                        $station = $_POST['station'];
                                        $ss = (isset($station)?' and station = ' . $station : '');
                                        $sql1 = "SELECT * FROM `pm_part_family` where is_deleted != 1" . $ss;
                                        $result1 = $mysqli->query($sql1);
                                        while ($row1 = $result1->fetch_assoc()) {
                                            if($st_dashboard == $row1['pm_part_family_id'])
                                            {
                                                $entry = 'selected';
                                            }
                                            else
                                            {
                                                $entry = '';

                                            }
                                            echo "<option value='" . $row1['pm_part_family_id'] . "' $entry >" . $row1['part_family_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Part Number *  : </label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <select name="part_number" id="part_number" class="form-control form-select select2" data-placeholder="Select Part Number">
                                        <option value="" selected disabled>--- Select Part Number ---</option>
                                        <?php
                                        $st_dashboard = $_POST['part_number'];
                                        $part_family = $_POST['part_family'];
                                        $sql1 = "SELECT * FROM `pm_part_number` where part_family = '$part_family' and is_deleted != 1 ";
                                        $result1 = $mysqli->query($sql1);
                                        while ($row1 = $result1->fetch_assoc()) {
                                            if($st_dashboard == $row1['pm_part_number_id'])
                                            {
                                                $entry = 'selected';
                                            }
                                            else
                                            {
                                                $entry = '';

                                            }
                                            echo "<option value='" . $row1['pm_part_number_id'] . "' $entry >" . $row1['part_number']."</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-1">
                                    <label class="form-label mg-b-0">Date From : </label>
                                </div>
                                <div class="col-md-5 mg-t-10 mg-md-t-0">
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control fc-datepicker" name="date_from" id="date_from" value="<?php echo $datefrom; ?>" placeholder="MM/DD/YYYY" type="text">
                                    </div><!-- input-group -->
                                </div>

                                <div class="col-md-1">
                                    <label class="form-label mg-b-0">Date To : </label>
                                </div>
                                <div class="col-md-5 mg-t-10 mg-md-t-0">
                                    <div class="input-group">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control fc-datepicker" name="date_to" id="date_to" value="<?php echo $dateto; ?>"placeholder="MM/DD/YYYY" type="text">
                                    </div><!-- input-group -->
                                </div>
                            </div>
                        </div>
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
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-1">
                                    <button type="submit" class="btn btn-primary mg-t-5 submit_btn">Submit</button>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-primary mg-t-5" onclick="window.location.reload();">Reset</button>
                                </div>
                            </div>
                        </div>
    </form>
</div>
</div>
</div>
</div>



<!-- row  -->
<?php
if(count($_POST) > 0)
{
    ?>
    <div class="row-body">

        <div class="col-12 col-sm-12">
            <div class="card">

                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <table class="table  table-bordered text-nowrap mb-0" id="example2">
                            <thead>
                            <tr>
                                <th>Action</th>
                                <th>Station</th>
                                <th>Part</th>
                                <th>Time</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $datefrom = date("Y-m-d", strtotime($datefrom));
                            $dateto = date("Y-m-d", strtotime($dateto));
                            $q = ("SELECT pn.part_name ,pn.part_number,pn.part_name, cl.line_name ,xx.part_family_id,xx.created_at,xx.10x_id  FROM  10x as xx inner join cam_line as cl on xx.line_no = cl.line_id inner join pm_part_family as pf on xx.part_family_id= pf.pm_part_family_id inner join pm_part_number as pn on xx.part_no=pn.pm_part_number_id where DATE_FORMAT(xx.created_at,'%Y-%m-%d') >= '$datefrom' and DATE_FORMAT(xx.created_at,'%Y-%m-%d') <= '$dateto' and cl.line_id='$station'");
                            $qur = mysqli_query($db, $q);
                            while ($rowc = mysqli_fetch_array($qur)) {
                                ?>
                                <tr>
                                    <?php
                                    $un = $rowc['line_no'];
                                    $qur04 = mysqli_query($db, "SELECT line_name FROM  cam_line where line_id = '$station' ");
                                    while ($rowc04 = mysqli_fetch_array($qur04)) {
                                        $lnn = $rowc04["line_name"];
                                    }
                                    ?>
                                    <td>
                                        <a href="../10x/view_10x.php?id=<?php echo $rowc['10x_id'];?>&station=<?php echo $station;?>" class="btn btn-primary legitRipple"  target="_blank"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                    <td><?php echo $lnn; ?></td>
                                    <td><?php echo $rowc['part_number']." - ".$rowc['part_name']; ?></td>
                                    <td><?php echo dateReadFormat($rowc['created_at']); ?></td>

                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
}
?>

<!-- /dashboard content -->
<script>
    $('#date_to').datepicker({ dateFormat: 'mm-dd-yy' });
    $('#date_from').datepicker({ dateFormat: 'mm-dd-yy' });
    $(function () {
        $('input:radio').change(function () {
            var abc = $(this).val()
            //alert(abc)
            if (abc == "button1")
            {
                $('#date_from').prop('disabled', false);
                $('#date_to').prop('disabled', false);
                $('#timezone').prop('disabled', true);
            }
        });
    });
</script>
<script>
    $('#station').on('change', function (e) {
        $("#10x_form").submit();
    });

    $('#part_family').on('change', function (e) {
        $("#10x_form").submit();
    });
    $('#part_number').on('change', function (e) {
        $("#10x_form").submit();
    });


</script>
<script>
    window.onload = function () {
        history.replaceState("", "", "<?php echo $siteURL; ?>log_module/10x_log.php");
    }
</script>
<?php include('../footer1.php') ?>

</body>
