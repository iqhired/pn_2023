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
$f_type = $_GET['f_type'];
$_SESSION['10x_station'] = $station;

if($f_type == 'n' && empty($_SESSION['f_type'])){
    $_SESSION['timestamp_id'] = time();
    $_SESSION['f_type'] = 'n';
}

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

$x_timestamp = time();

$idddd = preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo
|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i"
    , $_SERVER["HTTP_USER_AGENT"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo $sitename; ?> |10x</title>
    <!-- Global stylesheets -->
    <link href="../assets/css/core.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->
    <script type="text/javascript" src="../assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- Theme JS files -->
    <script type="text/javascript" src="../assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="../assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
    <!--    <script type="text/javascript" src="../assets/js/plugins/forms/selects/select2.min.js"></script>-->
    <script type="text/javascript" src="../assets/js/pages/datatables_basic.js"></script>
    <!--    <script type="text/javascript" src="../assets/js/plugins/forms/selects/select2.min.js"></script>-->
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
    <!--    <script src="--><?php //echo $siteURL; ?><!--assets/js/form_js/select2.min.js"></script>-->
    <script type="text/javascript" src="../assets/js/plugins/forms/selects/bootstrap_select.min.js"></script>
    <script type="text/javascript" src="../assets/js/pages/form_bootstrap_select.js"></script>
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
        .breadcrumb-header {
            margin-left: 124px;
        }
        @media (min-width: 320px) and (max-width: 480px) {
            .col-md-4 {
                width: 30%;
            }
            .col-md-8.mg-t-5.mg-md-t-0 {
                width: 70%;
            }
            .row-sm {
                margin-left: 16px!important;
                margin-right: 53px!important;
                margin-top: 48px;
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
            .col-md-4 {
                width: 30%;
            }
            .col-md-8.mg-t-5.mg-md-t-0 {
                width: 70%;
            }
            .row-sm {
                margin-left: 16px!important;
                margin-right: 53px!important;
                margin-top: 48px;
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
            .col-md-4 {
                width: 30%;
            }
            .col-md-8.mg-t-5.mg-md-t-0 {
                width: 70%;
            }
            .row-sm {
                margin-left: 16px!important;
                margin-right: 53px!important;
                margin-top: 48px;
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
        @media (min-width: 482px) and (max-width: 767px) {
            .col-md-4 {
                width: 30%;
            }
            .col-md-8.mg-t-5.mg-md-t-0 {
                width: 70%;
            }
            .row-sm {
                margin-left: 16px!important;
                margin-right: 53px!important;
                margin-top: 48px;
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
        .row-sm {
            margin-left: 114px;
            margin-right: -102px;
        }
    </style>
</head>
<body class="ltr main-body app horizontal">
<?php if (!empty($station)){
    include("../cell-menu.php");
}else{
    include("../header.php");
    include("../admin_menu.php");
}
?>
<!-- main-content -->
<div class="main-content app-content">
    <!-- container -->
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Submit 10x</li>
                </ol>
            </div>
        </div>
        <!-- /breadcrumb -->
        <!-- row -->
        <div class="row row-sm">
            <div class="col-lg-10 col-xl-10 col-md-12 col-sm-12">
        <?php if ($temp == "one") { ?>
            <br/>
            <div class="alert alert-success no-border">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                            class="sr-only">Close</span></button>
                <span class="text-semibold">10x</span> Created Successfully.
            </div>
        <?php } ?>
        <?php if ($temp == "two") { ?>
            <br/>
            <div class="alert alert-success no-border">
                <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                            class="sr-only">Close</span></button>
                <span class="text-semibold">10x.</span> Updated Successfully.
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
        <form action="10x_backend.php" id="10x_setting" enctype="multipart/form-data"
              class="form-horizontal" method="post">
            <div class="row row-sm">
                <div class="col-lg-10 col-xl-10 col-md-12 col-sm-12">
                    <div class="card  box-shadow-0">
                        <div class="card-body pt-0">
                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-4">
                                        <label class="form-label mg-b-0">Station : </label>
                                    </div>
                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                        <?php $form_id = $_GET['id'];
                                        //$station_event_id = base64_decode(urldecode($station_event_id)); ?>
                                        <input type="hidden" name="station_event_id"
                                               value="<?php echo $station_event_id ?>">
                                        <input type="hidden" name="customer_account_id" value="<?php echo $account_id ?>">
                                        <input type="hidden" name="station" value="<?php echo $st; ?>">
                                        <input type="hidden" name="line_number" value="<?php echo $line_no; ?>">
                                        <input type="text" name="line_number1" style="pointer-events: none;" id="line_number"
                                               value="<?php echo $line_name ?>" class="form-control"
                                               placeholder="Enter Line Number">
                                    </div>
                                </div>
                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-4">
                                        <label class="form-label mg-b-0">Part Number : </label>
                                    </div>
                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <input type="hidden" name="part_number" value="<?php echo $part_number; ?>">
                                            <input type="text" name="part_number1" id="part_number" style="pointer-events: none;"
                                                   value="<?php echo $pm_part_number; ?>" class="form-control"
                                                   placeholder="Enter Part Number">
                                    </div>
                                </div>
                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-4">
                                        <label class="form-label mg-b-0">Part Family : </label>
                                    </div>
                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                        <input type="hidden" name="part_family" value="<?php echo $part_family; ?>">
                                        <input type="text" name="part_family1" id="part_family" style="pointer-events: none;"
                                               value="<?php echo $pm_part_family_name; ?>" class="form-control"
                                               placeholder="Enter Part Family">
                                    </div>
                                </div>
                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-4">
                                        <label class="form-label mg-b-0">Part Name : </label>
                                    </div>
                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                        <input type="text" name="part_name" id="part_name" style="pointer-events: none;"
                                               value="<?php echo $pm_part_name; ?>" class="form-control"
                                               placeholder="Enter Part Name">
                                    </div>
                                </div>
                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-4">
                                        <label class="form-label mg-b-0">Image : </label>
                                    </div>
                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                        <?php if(($idddd == 0)){?>
                                            <div id="my_camera"></div>
                                            <br/>
                                            <input type=button class="btn btn-primary " value="Take Snapshot" onClick="take_snapshot()">
                                            <input type="hidden" name="image" id="image" class="image-tag" accept="image/*,capture=camera"/>
                                        <?php } ?>
                                        <?php if(($idddd != 0)){?>
                                            <div style="display:none;" id="my_camera"></div>
                                            <label for="file" class="btn btn-primary ">Take Snapshot</label>
                                            <input type="file" name="image" id="file" class="image-tag" multiple accept="image/*;capture=camera" capture="environment" value="Take Snapshot" style="display: none"/>
                                            <div class="container"></div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="row row-xs align-items-center mg-b-20" style="display: none">
                                    <div class="col-md-4">
                                        <label class="form-label mg-b-0">Captured Image : </label>
                                    </div>
                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                        <div id="results"></div>
                                    </div>
                                </div>
                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-4">
                                        <label class="form-label mg-b-0">Previous Image : </label>
                                    </div>
                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                        <div class="col-md-6">
                                            <?php
                                            $time_stamp = $_SESSION['timestamp_id'];
                                            if(!empty($time_stamp)){
                                                $query2 = sprintf("SELECT * FROM  10x_images where 10x_id = '$time_stamp'");

                                                $qurimage = mysqli_query($db, $query2);
                                                $i =0 ;
                                                while ($rowcimage = mysqli_fetch_array($qurimage)) {
                                                    $image = $rowcimage['image_name'];
                                                    $d_tag = "delete_image_" . $i;
                                                    $r_tag = "remove_image_" . $i;
                                                    ?>

                                                    <div class="col-lg-3 col-sm-6">
                                                        <div class="thumbnail">
                                                            <div class="thumb">
                                                                <img src="../assets/images/10x/<?php echo $time_stamp; ?>/<?php echo $image; ?>"
                                                                     alt="">
                                                                <input type="hidden"  id="<?php echo $d_tag; ?>" name="<?php echo $d_tag; ?>" class="<?php echo $d_tag; ?>>" value="<?php echo $rowcimage['10x_images_id']; ?>">
                                                                <span class="remove remove_image" id="<?php echo $r_tag; ?>">Remove Image </span>


                                                                <!--                                                <div class="caption-overflow">-->
                                                                <!--														<span>-->
                                                                <!--															<a href="../material_images/--><?php //echo $rowcimage['image_name']; ?><!--"-->
                                                                <!--                                                               data-popup="lightbox" rel="gallery"-->
                                                                <!--                                                               class="btn border-white text-white btn-flat btn-icon btn-rounded"><i-->
                                                                <!--                                                                        class="icon-plus3"></i></a>-->
                                                                <!--														</span>-->
                                                                <!---->
                                                                <!--                                                </div>-->

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    $i++;}
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-4">
                                        <label class="form-label mg-b-0">Notes : </label>
                                    </div>
                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                        <textarea id="notes"   name="10x_notes"   rows="4"    placeholder="Enter Notes..." class="form-control"></textarea>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               <div class="row row-sm">
                <div class="col-lg-10 col-xl-10 col-md-12 col-sm-12">
                    <div class="card  box-shadow-0">
                        <div class="card-body pt-0">
                            <button type="submit" id="form_submit_btn" class="btn btn-primary submit_btn">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
<script language="JavaScript">
    Webcam.set({
        width: 290,
        height: 190,
        image_format: 'jpeg',
        jpeg_quality: 90
    });
    var camera = document.getElementById("my_camera");
    Webcam.attach( camera );
</script>
<script language="JavaScript">
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            var formData =  $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
            $.ajax({
                url: "webcam_backend.php",
                type: "POST",
                data: formData,
                success: function (msg) {
                    window.location.reload()
                },

            });
        } );
    }


</script>

<script>
    $(document).ready(function () {
        $('.select').select2();
    });


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
            url: 'add_delete_10x_image.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function (response) {

                if (response != 0) {
                    var count = $('.container .content_img').length;
                    count = Number(count) + 1;

                    // Show image preview with Delete button
                    $('.container').append("<div class='content_img' id='content_img_" + count + "' ><img src='" + response + "' width='100' height='100'><span class='delete' id='delete_" + count + "'>Delete</span></div>");
                }
            }
        });
    });


    // Remove file
    $('.container').on('click', '.content_img .delete', function () {

        var id = this.id;
        var split_id = id.split('_');
        var num = split_id[1];
        // Get image source
        var imgElement_src = $('#content_img_' + num)[0].children[0].src;
        //var deleteFile = confirm("Do you really want to Delete?");
        var succ = false;
        // AJAX request
        $.ajax({
            url: 'add_delete_10x_image.php',
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
                    var nodes = $(".container")[2].childNodes;
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

</script>
<script>
    $(document).on('click', '.remove_image', function () {
        var del_id = this.id.split("_")[2];
        var x_img_id = this.parentElement.childNodes[3].value;
        var info =  document.getElementById("delete_image"+del_id);
        var info =  "id="+del_id+"&10x_id="+ x_img_id;
        $.ajax({
            type: "POST",
            url: "delete_10x_image.php",
            data: info,
            success: function (data) {
            }
        });
        location.reload(true);
    });
</script>
<?php include('../footer.php') ?>
</body>
</html>