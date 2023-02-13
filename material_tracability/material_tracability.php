<?php
include("../config.php");
include("../config/pn_config.php");
$chicagotime = date("Y-m-d H:i:s");
$temp = "";
if (!isset($_SESSION['user'])) {
    if ($_SESSION['is_tab_user'] || $_SESSION['is_cell_login']) {
        header($redirect_tab_logout_path);
    } else {
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
    if ($_SESSION['is_tab_user'] || $_SESSION['is_cell_login']) {
        header($redirect_tab_logout_path);
    } else {
        header($redirect_logout_path);
    }

    //	header('location: ../logout.php');
    exit;
}
//Set the time of the user's last activity
$_SESSION['LAST_ACTIVITY'] = $time;
$i = $_SESSION["role_id"];
if ($i != "super" && $i != "admin" && $i != "pn_user") {
    header('location: ../dashboard.php');
}
$s_event_id = $_GET['station_event_id'];
$station = $_GET['station'];

$station_event_id = $s_event_id;
//$station_event_id = base64_decode(urldecode($s_event_id));
$sqlmain = "SELECT * FROM `sg_station_event` where `station_event_id` = '$s_event_id'";
$resultmain = mysqli_query($db, $sqlmain);
$rowcmain = mysqli_fetch_array($resultmain);
$part_family = $rowcmain['part_family_id'];
$part_number = $rowcmain['part_number_id'];

$sqlnumber = "SELECT * FROM `pm_part_number` where `pm_part_number_id` = '$part_number'";
$resultnumber = mysqli_query($db, $sqlnumber);
$rowcnumber = mysqli_fetch_array($resultnumber);
$pm_part_number = $rowcnumber['part_number'];
$pm_part_name = $rowcnumber['part_name'];

$sqlfamily = "SELECT * FROM `pm_part_family` where `pm_part_family_id` = '$part_family'";
$resultfamily = mysqli_query($db, $sqlfamily);
$rowcfamily = mysqli_fetch_array($resultfamily);
$pm_part_family_name = $rowcfamily['part_family_name'];

$sqlaccount = "SELECT * FROM `part_family_account_relation` where `part_family_id` = '$part_family'";
$resultaccount = mysqli_query($db, $sqlaccount);
$rowcaccount = mysqli_fetch_array($resultaccount);
$account_id = $rowcaccount['account_id'];

$sqlcus = "SELECT * FROM `cus_account` where `c_id` = '$account_id'";
$resultcus = mysqli_query($db, $sqlcus);
$rowccus = mysqli_fetch_array($resultcus);
$cus_name = $rowccus['c_name'];
$logo = $rowccus['logo'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo $sitename; ?> | Material Tracability</title>

    <script type="text/javascript" src="../assets/js/form_js/jquery-min.js"></script>
    <script type="text/javascript" src="../assets/js/libs/jquery-3.6.0.min.js"></script>

    <!-- STYLES CSS -->
    <link href="<?php echo $siteURL; ?>assets/css/form_css/style.css" rel="stylesheet">
    <link href="<?php echo $siteURL; ?>assets/css/form_css/style-dark.css" rel="stylesheet">
    <link href="<?php echo $siteURL; ?>assets/css/form_css/style-transparent.css" rel="stylesheet">

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
    <!-- anychart documentation -->
    <!-- STYLES CSS -->
    <link href="<?php echo $siteURL; ?>assets/css/form_css/style.css" rel="stylesheet">
    <link href="<?php echo $siteURL; ?>assets/css/form_css/style-dark.css" rel="stylesheet">
    <link href="<?php echo $siteURL; ?>assets/css/form_css/style-transparent.css" rel="stylesheet">


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
            .col-md-4 {
                width: 30%;
            }
            .col-md-8.mg-t-5.mg-md-t-0 {
                width: 70%;
            }

            .contextMenu {
                left: 0!important;
            }
            .d-sm-none {
                z-index: 1!important;
            }
            .breadcrumb-header {
                margin-left: 38px;
            }
            button.remove.btn.btn-sm.btn-danger-light {
                margin-top: 14px!important;
                margin-bottom: 10px!important;
                margin-left: 24px!important;
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
            .col-md-4 {
                width: 30%;
            }
            .col-md-8.mg-t-5.mg-md-t-0 {
                width: 70%;
            }

            .contextMenu {
                left: 0!important;
            }
            .d-sm-none {
                z-index: 1!important;
            }
            .breadcrumb-header {
                margin-left: 38px;
            }
            button.remove.btn.btn-sm.btn-danger-light {
                margin-top: 14px!important;
                margin-bottom: 10px!important;
                margin-left: 24px!important;
            }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .row-body {

                margin-left:-15rem;
                margin-right: 0rem;
            }
            .col-md-4 {
                width: 30%;
            }
            .col-md-8.mg-t-5.mg-md-t-0 {
                width: 70%;
            }

            .contextMenu {
                left: 0!important;
            }
            .d-sm-none {
                z-index: 1!important;
            }
            .breadcrumb-header {
                margin-left: 38px;
            }
            button.remove.btn.btn-sm.btn-danger-light {
                margin-top: 14px!important;
                margin-bottom: 10px!important;
                margin-left: 24px!important;
            }


        }


        table.dataTable thead .sorting:after {
            content: ""!important;
            top: 49%;
        }
        .card-title:before{
            width: 0;

        }
        .main-content .image_box, .main-content .container-fluid {
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
        @media (min-width: 482px) and (max-width: 767px) {
            .col-md-4 {
                width: 30%;
            }
            .col-md-8.mg-t-5.mg-md-t-0 {
                width: 70%;
            }

            .contextMenu {
                left: 0!important;

            }
            .d-sm-none {
                z-index: 1!important;
            }
            .breadcrumb-header {
                margin-left: 38px;
            }
            button.remove.btn.btn-sm.btn-danger-light {
                margin-top: 14px!important;
                margin-bottom: 10px!important;
                margin-left: 24px!important;
            }

        }
        button.remove.btn.btn-sm.btn-danger-light {
            margin-top: -36px;
            margin-bottom: 10px;
            margin-left: 156px;
        }
        .col-lg-3.mg-t-20.mg-lg-t-0.extra_input {
            margin-left: -23px;
            margin-top: 10px;
        }

    </style>
</head>

<body class="ltr main-body app horizontal">

<?php if (!empty($station) || !empty($station_event_id)){
    include("../cell-menu.php");
}else{
    include("../header.php");
    include("../admin_menu.php");
}
?>
<div class="main-content horizontal-content">
    <!-- container -->
    <div class="main-container container">
    <?php
    $st = $_REQUEST['station'];
    //$st_dashboard = base64_decode(urldecode($st));
    $sql1 = "SELECT * FROM `cam_line` where line_id = '$st'";
    $result1 = $mysqli->query($sql1);
    //                                            $entry = 'selected';
    while ($row1 = $result1->fetch_assoc()) {
        $line_name = $row1['line_name'];
        $line_no = $row1['line_id'];
    }
    ?>

    <div class="breadcrumb-header justify-content-between">
                <div class="left-content">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page"> Material Tracability</li>
                    </ol>
                </div>
            </div>

    <div class="row">
        <div class="col-lg-12 col-md-12">
    <?php if ($temp == "one") { ?>
        <div class="col-lg-10 col-xl-10 col-md-12 col-sm-12">
            <div class="alert alert-success no-border">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                            class="sr-only">Close</span></button>
                <span class="text-semibold">Material Tracability.</span> Created Successfully.
            </div>
        </div>
    <?php } ?>
    <?php if ($temp == "two") { ?>
        <div class="col-lg-10 col-xl-10 col-md-12 col-sm-12">
            <div class="alert alert-success no-border">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                            class="sr-only">Close</span></button>
                <span class="text-semibold">Material Tracability.</span> Updated Successfully.
            </div>
        </div>
    <?php } ?>
    <?php
    if (!empty($import_status_message)) {
        echo '<br/><div class="alert ' . $message_stauts_class . '">' . $import_status_message . '</div>';
    }
    ?>
    <?php
    if (!empty($_SESSION['import_status_message'])) {
        echo '<br/><div class="alert ' . $_SESSION['message_stauts_class'] . '">' . $_SESSION['import_status_message'] . '</div>';
        $_SESSION['message_stauts_class'] = '';
        $_SESSION['import_status_message'] = '';
    }
    ?>
        </div>
    </div>
    <form action="material_backend.php" id="material_setting" enctype="multipart/form-data"
          class="form-horizontal" method="post">
        <div class="row row-sm">
            <div class="col-lg-10 col-xl-10 col-md-12 col-sm-12">
                <div class="card-header">
                    <span class="main-content-title mg-b-0 mg-b-lg-1">Material Traceability</span>
                </div>
                <div class="card  box-shadow-0">
                    <div class="card-body pt-0">
                        <div class="pd-30 pd-sm-20">
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                            <label class="form-label mg-b-0">Station :</label>
                        </div>
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
							<?php $form_id = $_GET['id'];
							?>
                            <input type="hidden" name="station_event_id"
                                   value="<?php echo $station_event_id ?>">
                            <input type="hidden" name="customer_account_id" value="<?php echo $account_id ?>">
                            <input type="hidden" name="station" value="<?php echo $st; ?>">
                            <input type="hidden" name="line_number" value="<?php echo $line_no; ?>">
							<?php if (!empty($station) || !empty($station_event_id)){ ?>
                                <input type="text" name="line_number1" id="line_number"
                                       value="<?php echo $line_name ?>" class="form-control"
                                       placeholder="Enter Line Number" style="pointer-events: none">
							<?php } else { ?>
                                <input type="text" name="line_number1" id="line_number"
                                       value="<?php echo $line_name ?>" class="form-control"
                                       placeholder="Enter Line Number">
							<?php  } ?>
                        </div>
                    </div>
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                            <label class="form-label mg-b-0">Part Number :</label>
                        </div>
						<?php if (!empty($station) || !empty($station_event_id)){ ?>
                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                <input type="hidden" name="part_number" value="<?php echo $part_number; ?>">
                                <input type="text" name="part_number1" id="part_number"
                                       value="<?php echo $pm_part_number; ?>" class="form-control"
                                       placeholder="Enter Part Number"  style="pointer-events: none">
                            </div>
						<?php } else { ?>
                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                <input type="hidden" name="part_number" value="<?php echo $part_number; ?>">
                                <input type="text" name="part_number1" id="part_number"
                                       value="<?php echo $pm_part_number; ?>" class="form-control"
                                       placeholder="Enter Part Number">
                            </div>
						<?php  } ?>
                    </div>
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                            <label class="form-label mg-b-0">Part Family :</label>
                        </div>
						<?php if (!empty($station) || !empty($station_event_id)){ ?>
                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                <input type="hidden" name="part_family" value="<?php echo $part_family; ?>">
                                <input type="text" name="part_family1" id="part_family"
                                       value="<?php echo $pm_part_family_name; ?>" class="form-control"
                                       placeholder="Enter Part Family" style="pointer-events: none">
                            </div>
						<?php } else { ?>
                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                <input type="hidden" name="part_family" value="<?php echo $part_family; ?>">
                                <input type="text" name="part_family1" id="part_family"
                                       value="<?php echo $pm_part_family_name; ?>" class="form-control"
                                       placeholder="Enter Part Family">
                            </div>
						<?php  } ?>
                    </div>
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                            <label class="form-label mg-b-0">Part Name :</label>
                        </div>
						<?php if (!empty($station) || !empty($station_event_id)){ ?>
                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                <input type="text" name="part_name" id="part_name"
                                       value="<?php echo $pm_part_name; ?>" class="form-control"
                                       placeholder="Enter Part Name" style="pointer-events: none">
                            </div>
						<?php } else { ?>
                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                <input type="text" name="part_name" id="part_name"
                                       value="<?php echo $pm_part_name; ?>" class="form-control"
                                       placeholder="Enter Part Name">
                            </div>
						<?php  } ?>
                    </div>
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                            <label class="form-label mg-b-0">Material type :</label>
                        </div>
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                            <div class="SumoSelect" tabindex="0" role="button" aria-expanded="true">
                                <select name="material_type" id="material_type" class="form-control form-select select2" tabindex="-1" data-placeholder="Select Material Type">
                                    <option value="" selected disabled>Select material Type</option>
									<?php
									$sql1 = "SELECT material_id, material_type,serial_num_required FROM `material_config`";
									$result1 = mysqli_query($db, $sql1);
									while ($row1 = $result1->fetch_assoc()) {

										echo "<option value=" . $row1['material_id'] . "_" . $row1['serial_num_required'] . ">" . $row1['material_type'] . "</option>";

									}
									?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                            <label class="form-label mg-b-0">Image :</label>
                        </div>
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                            <input type="file" id="file" name="file" class="form-control"/>
                            <div class="image_box"></div>
                        </div>
                    </div>
                    <br/>
					<?php
					$m_type = $_POST['material_type'];

					$sql = "SELECT serial_num_required FROM `material_config` where material_type = '$m_type'";
					$row = mysqli_query($db, $sql);
					$se_row = mysqli_fetch_assoc($row);

					$serial = $se_row['serial_num_required'];

					?>
                    <div class="row row-xs align-items-center mg-b-20" id = "serial_num">

                    </div>
                    <br/>
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                            <label class="form-label mg-b-0">Material Status :</label>
                        </div>
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                            <div class="row mg-t-15">
                                <div class="col-lg-3">
                                    <label class="rdiobox"><input id="pass" name="material_status" value="1" type="radio" checked> <span>Pass</span></label>
                                </div>
                                <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                                    <label class="rdiobox"><input id="fail" name="material_status" value="0" type="radio"> <span>Fail</span></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/>
                    <div id="rej_fail" style="display: none;">

                    </div>
                    <div class="row row-xs align-items-center mg-b-20">
                        <div class="col-md-4">
                            <label class="form-label mg-b-0">Notes :</label>
                        </div>
                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                            <textarea id="notes" name="material_notes" rows="4" placeholder="Enter Notes..." class="form-control"></textarea>
                        </div>
                    </div>
                    <button id="form_submit_btn" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5">Submit</button>
                </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('.select').select2();
    });


</script>
<script>
    document.getElementById('material_type').onchange = function () {
        var sel_val = this.value.split('_');
        var isDis = sel_val[1];
        var rr = document.getElementById("serial_num");
        if(isDis == 0){
            rr.innerHTML = "";
            document.getElementById("serial_num").style.display = 'none';
            document.getElementById("file").required = false;
        }else{
            rr.innerHTML = "<div class=\"row row-xs align-items-center mg-b-20\"><label class=\"col-lg-4\" style=\"padding-top: 10px;\">Serial Number\n" +
                "                                    : </label>\n" +
                "                                <div class=\"col-md-8 mg-t-5 mg-md-t-0\">\n" +
                "                                    <input type=\"text\" size=\"30\" name=\"serial_number\" id=\"serial_number\"\n" +
                "                                           class=\"form-control\" required/>\n" +
                "                                </div>\n" +
                "                                <!--<div id=\"error1\" class=\"red\">Enter valid Serial Number</div></div>-->";
            document.getElementById("serial_num").style.display = 'block';
            document.getElementById("file").required = true;
        }

    }
</script>
<script>
    // Upload

    $("#file").on("change", function () {
        var fd = new FormData();
        var files = $('#file')[0].files[0];
        fd.append('file', files);
        fd.append('request', 1);

        // AJAX request
        $.ajax({
            url: 'add_delete_mat_image.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function (response) {

                if (response != 0) {
                    var count = $('.image_box .content_img').length;
                    count = Number(count) + 1;

                    // Show image preview with Delete button
                    $('.image_box').append("<div class='content_img' id='content_img_" + count + "' ><img src='" + response + "' width='100' height='100'><span class='delete' id='delete_" + count + "'>Delete</span></div>");
                }
            }
        });
    });


    // Remove file
    $('.image_box').on('click', '.content_img .delete', function () {

        var id = this.id;
        var split_id = id.split('_');
        var num = split_id[1];
        // Get image source
        var imgElement_src = $('#content_img_' + num)[0].children[0].src;
        //var deleteFile = confirm("Do you really want to Delete?");
        var succ = false;
        // AJAX request
        $.ajax({
            url: 'add_delete_mat_image.php',
            type: 'post',
            data: {path: imgElement_src, request: 2},
            async: false,
            success: function (response) {
                // Remove <div >
                if (response == 1) {
                    succ = true;
                }
            }, complete: function (data) {
                if (succ) {
                    var id = 'content_img_' + num;
                    // $('#content_img_'+num)[0].remove();
                    var elem = document.getElementById(id);
                    document.getElementById(id).style.display = 'none';
                    var nodes = $(".image_box")[2].childNodes;
                    for (var i = 0; i < nodes.length; i++) {
                        var node = nodes[i];
                        if (node.id == id) {
                            node.style.display = 'none';
                        }
                    }
                }
            }
        });
    });
    $(document).on("click", ".submit_btn", function () {
        var line_number = $("#line_number").val();
        var material_type = $("#material_type").val();
        var material_status = $("#material_status").val();
    });

</script>
<script>
    $("input[name$='material_status']").click(function () {
        var test = $(this).val();
        //    console.log(test);
        var z = document.getElementById("rej_fail");
        if ((test === "0") && (z.style.display === "none")) {
            z.style.display = "block";
            z.innerHTML = '<div class="row row-xs align-items-center mg-b-20" id="Reason0">\n' +
                '                                    <label class="col-md-4">Reason : </label>\n' +
                '                                    <div class="col-md-8 mg-t-5 mg-md-t-0">\n' +
                '                                        <select name="reason" id="reason" required class="select form-control"\n' +
                '                                                data-style="bg-slate">\n' +
                '                                            <option value="Reject" selected >Reject</option>\n' +
                '                                            <option value="Hold" >On Hold</option>\n' +
                '                                        </select>\n' +
                '                                    </div>\n' +
                '                                </div>\n' +
                '                                <br/>\n' +
                '                                <div class="row row-xs align-items-center mg-b-20" id="quantity0">\n' +
                '                                    <label class="col-md-4"> Quantity : </label>\n' +
                '                                    <div class="col-md-8 mg-t-5 mg-md-t-0">\n' +
                '                                        <input class="form-control" name="quantity" rows="1" id="quantity" required>\n' +
                '                                    </div>\n' +
                '\n' +
                '                                </div>\n' +
                '                                <br/>';
        } else if (test === "1") {
            z.style.display = "none";
            z.innerHTML = '';
        }
    });
</script>


<?php include('../footer1.php') ?>
</body>
</html>
