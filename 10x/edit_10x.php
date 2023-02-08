<?php
include("../config.php");
include("../config/pn_config.php");
$chicagotime = date("Y-m-d H:i:s");
$temp = "";

//check user
checkSession();

$cellID = $_GET['cell_id'];
$c_name = $_GET['c_name'];
$s_event_id = $_GET['station_event_id'];
$station = $_GET['station'];

$station_event_id = $s_event_id;

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
        <?php echo $sitename; ?> |Edit 10x</title>
    <!-- Global stylesheets -->
    <link href="<?php echo $siteURL; ?>assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $siteURL; ?>assets/css/style_main.css" rel="stylesheet" type="text/css">
    <script src="<?php echo $siteURL; ?>assets/js/libs/jquery-3.6.0.min.js"> </script>
    <!-- INTERNAL Select2 css -->
    <link href="<?php echo $siteURL; ?>assets/css/form_css/select2.min.css" rel="stylesheet" />


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
    <!-- INTERNAL Select2 css -->
    <link href="<?php echo $siteURL; ?>assets/css/form_css/select2.min.css" rel="stylesheet" />
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
        .red {
            color: red;
            display: none;
        }


        .col-md-6.date {
            width: 25%;
        }
        .create {
            float: right;
            padding: 12px;

        }


        @media
        only screen and (max-width: 760px),
        (min-device-width: 768px) and (max-device-width: 1024px)  {

            .form_mob{
                display: none;
            }
            .form_create{
                display: none;
            }




        }
        @media
        only screen and (max-width: 400px),
        (min-device-width: 400px) and (max-device-width: 670px)  {

            .form_mob{
                display: none;
            }
            .form_create{
                display: none;
            }
            .col-md-6.date {
                width: 100%;
                float: right;
            }

        }
        .remove {
            display: block;
            background: #444;
            border: 1px solid black;
            color: white;
            text-align: center;
            cursor: pointer;
        }
        .remove:hover {
            background: white;
            color: black;
        }
        .form-control[disabled], fieldset[disabled] .form-control {
            background-color: #eee;
        }
        #line_number1 , #part_number1 , #part_family1 , #part_name , #material_type{
            pointer-events: none;
            background-color: #efefef;
        }
        input[type="file"] {
            display: block;
        }
        .imageThumb {
            max-height: 100px;
            border: 2px solid;
            padding: 1px;
            cursor: pointer;
        }
        .pip {
            display: inline-block;
            margin: 10px 10px 0 0;
        }
        .create {
            float: right;
            padding: 12px;

        }
/* new styles */
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
            .col-md-8.mg-t-5.mg-md-t-0{
                max-width: 300px!important;
            }
            .col-md-4{
                max-width: 200px!important;
            }
        }

        @media (min-width: 481px) and (max-width: 768px) {
            .col-md-8.mg-t-5.mg-md-t-0{
                max-width: 300px!important;
            }
            .col-md-4{
                max-width: 200px!important;
            }
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .col-md-8.mg-t-5.mg-md-t-0{
                max-width: 300px!important;
            }
            .col-md-4{
                max-width: 200px!important;
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

    </style>

</head>
<body class="ltr main-body app horizontal">
<!-- Main navbar -->
<?php if (!empty($station) || !empty($station_event_id)){
    include("../cell-menu.php");
}else{
    include("../header.php");
    include("../admin_menu.php");
}
?>
<!-- /main navbar -->
<!-- Page container -->
<div class="main-content app-content">
    <div class="main-container container-fluid">
        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> Edit 10x</li>
                </ol>
            </div>
        </div>
    <?php
    $id = $_GET['id'];
    $querymain = sprintf("SELECT * FROM `10x` where 10x_id = '$id' ");
    $qurmain = mysqli_query($db, $querymain);
    while ($rowcmain = mysqli_fetch_array($qurmain)) {
        $line_no = $rowcmain['line_no'];
        $station_event_id = $rowcmain['station_event_id'];
        $x_id = $rowcmain['10x_id'];
        $part_number = $rowcmain['part_no'];
        $part_family = $rowcmain['part_family_id'];
        $pm_part_name = $rowcmain['part_name'];

        $notes = $rowcmain['notes'];
        $created_at = $rowcmain['created_at'];

        $sqlfamily = "SELECT * FROM `pm_part_family` where `pm_part_family_id` = '$part_family'";
        $resultfamily = mysqli_query($db, $sqlfamily);
        $rowcfamily = mysqli_fetch_array($resultfamily);
        $pm_part_family_name = $rowcfamily['part_family_name'];

        $sqlnumber = "SELECT * FROM `pm_part_number` where `pm_part_number_id` = '$part_number'";
        $resultnumber = mysqli_query($db, $sqlnumber);
        $rowcnumber = mysqli_fetch_array($resultnumber);
        $pm_part_number = $rowcnumber['part_number'];
        $pm_part_name = $rowcnumber['part_name'];

        $sqlnumber = "SELECT * FROM `cam_line` where `line_id` = '$line_no'";
        $resultnumber = mysqli_query($db, $sqlnumber);
        $rowcnumber = mysqli_fetch_array($resultnumber);
        $line_name = $rowcnumber['line_name'];
        $_SESSION['edit_10x_id'] = $id;

        $station_event_id = $_GET['station_event_id'];
        ?>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <?php if ($temp == "one") { ?>
                    <div class="col-lg-10 col-xl-10 col-md-12 col-sm-12">
                        <div class="alert alert-success no-border">
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                                        class="sr-only">Close</span></button>
                            <span class="text-semibold">Edit 10x.</span> Created Successfully.
                        </div>
                    </div>
                <?php } ?>
                <?php if ($temp == "two") { ?>
                    <div class="col-lg-10 col-xl-10 col-md-12 col-sm-12">
                        <div class="alert alert-success no-border">
                            <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                                        class="sr-only">Close</span></button>
                            <span class="text-semibold">Edit 10x.</span> Updated Successfully.
                        </div>
                    </div>
                <?php } ?>
                <?php
                if (!empty($import_status_message)) {
                    echo '<br/><div class="alert ' . $message_stauts_class . '">' . $import_status_message . '</div>';
                }
                displaySFMessage();
                ?>

            </div>
        </div>
        <form action="edit_10x_backend.php" id="10x_setting" enctype="multipart/form-data" class="form-horizontal" method="post">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12">
                                            <div class="card">
                                                <div class="card-body pt-0">
                                                    <div class="card-header">
                                                        <span class="main-content-title mg-b-0 mg-b-lg-1">Edit 10x</span>
                                                    </div>
                                                    <div class="pd-30 pd-sm-20">
                                                        <div class="row row-xs align-items-center mg-b-20">
                                                            <div class="col-md-4">
                                                                <label class="form-label mg-b-0">Station :</label>
                                                            </div>
                                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                                <input type="hidden" name="10x_id" id="10x_id" value="<?php echo $x_id ?>">
                                                                <input type="hidden" name="station_event_id" value="<?php echo $station_event_id ?>">
                                                                <input type="hidden" name="line_number" id="line_number" value="<?php echo $line_no; ?>">
                                                                <input type="text" name="line_number1" id="line_number1"  value="<?php echo $line_name ?>" class="form-control" placeholder="Enter Line Number">
                                                            </div>
                                                        </div>
                                                        <div class="row row-xs align-items-center mg-b-20">
                                                            <div class="col-md-4">
                                                                <label class="form-label mg-b-0">Part Number : </label>
                                                            </div>
                                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                                <input type="hidden" name="part_number" id="part_number"  value="<?php echo $part_number; ?>">
                                                                <input type="text" name="part_number1" id="part_number1"  value="<?php echo $pm_part_number; ?>" class="form-control" placeholder="Enter Part Number">
                                                            </div>
                                                        </div>
                                                        <div class="row row-xs align-items-center mg-b-20">
                                                            <div class="col-md-4">
                                                                <label class="form-label mg-b-0">Part Family : </label>
                                                            </div>
                                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                                <input type="hidden" name="part_family" id="part_family"  value="<?php echo $part_family; ?>">
                                                                <input type="text" name="part_family1" id="part_family1"  value="<?php echo $pm_part_family_name; ?>" class="form-control" placeholder="Enter Part Family">
                                                            </div>
                                                        </div>
                                                        <div class="row row-xs align-items-center mg-b-20">
                                                            <div class="col-md-4">
                                                                <label class="form-label mg-b-0">Part Name : </label>
                                                            </div>
                                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                                <input type="text" name="part_name" id="part_name"  value="<?php echo $pm_part_name; ?>" class="form-control" placeholder="Enter Part Name">
                                                            </div>
                                                        </div>
                                                        <div class="row row-xs align-items-center mg-b-20">
                                                            <div class="col-md-4">
                                                                <label class="form-label mg-b-0">Image : </label>
                                                            </div>
                                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                                <?php if($idddd == 0){?>
                                                                    <div id="my_camera"></div>
                                                                    <br/>
                                                                    <input type="button" class="btn btn-primary " value="Take Snapshot" onClick="take_snapshot(<?php echo $x_id?>)">
                                                                    <input type="hidden" name="image" id="image" class="image-tag" accept="image/*,capture=camera"/>
                                                                <?php } ?>
                                                                <?php if($idddd != 0){?>
                                                                    <div style ="display:none" id="my_camera"></div>
                                                                    <label for="file-input" class="btn btn-primary ">Take Snapshot</label>
                                                                    <input type="file" name="edit_image[]" id="file-input" class="image-tag" multiple accept="image/*;capture=camera" capture="environment" value="Take Snapshot" style="display: none"/>

                                                                    <!--                                            <input type="file" name="edit_image[]" id="file-input" accept="image/*;capture=camera" capture="environment"  multiple="multiple" value="Take Snapshot" style="display: none">-->
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
                                                                    //										$query1 = sprintf("SELECT 10x_id FROM  10x where 10x_id = '$id'");
                                                                    $item_id = $x_id;

                                                                    //										$query2 = sprintf("SELECT * FROM  10x_images where 10x_id = '$item_id'");
                                                                    $query2 = sprintf("SELECT * FROM `10x_images` where 10x_id = '$item_id'");

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
                                                                                    <img src="../assets/images/10x/<?php echo $item_id; ?>/<?php echo $image; ?>"
                                                                                         alt="">
                                                                                    <input type="hidden"  id="<?php echo $d_tag; ?>" name="<?php echo $d_tag; ?>" class="<?php echo $d_tag; ?>>" value="<?php echo $rowcimage['10x_images_id']; ?>">
                                                                                    <span class="remove remove_image" id="<?php echo $r_tag; ?>">Remove Image </span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php
                                                                        $i++;} ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row row-xs align-items-center mg-b-20">
                                                            <div class="col-md-4">
                                                                <label class="form-label mg-b-0">Notes : </label>
                                                            </div>
                                                            <div class="col-md-8 mg-t-5 mg-md-t-0">
                                                                <textarea id="notes" name="10x_notes" rows="4" placeholder="Enter Notes..." value =" <?php echo $notes;?>" class="form-control"><?php echo $notes;?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                       <div class="col-lg-12 col-sm-12">
                                           <div class="card">
                                               <div class="card-body pt-0">
                                                    <button type="submit" id="form_submit_btn" class="btn btn-primary submit_btn">Update</button>
                                               </div>
                                           </div>
                                       </div>
                                    </div>
        </form>
    <?php } ?>
    </div>
</div>
<!-- Configure a few settings and attach camera -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
<script>
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
    function take_snapshot(id) {
        Webcam.snap( function(data_uri) {
            var formData =  $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
            $.ajax({
                url: "webcam_backend.php?10x_id="+id,
                type: "POST",
                data: formData,
                success: function () {
                    window.location.reload()
                },

            });

        } );
    }
</script>

<script>
    $(document).ready(function() {
        $('.select').select2();
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
        window.location.reload()
    });
</script>
<script>

    $("#file-input").on("change", function(e) {
        var files = e.target.files,
            filesLength = files.length;
        for (var i = 0; i < filesLength; i++) {
            var f = files[i]
            var fileReader = new FileReader();
            fileReader.onload = (function(e) {
                var file = e.target;
                $("<span class=\"pip\">" +
                    "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                    "<br/><span class=\"remove\">Remove image</span>" +
                    "</span>").insertAfter("#file-input");
                $(".remove").click(function(){
                    $(this).parent(".pip").remove();
                });



            });
            fileReader.readAsDataURL(f);
        }
    });

</script>

<script>
    function group1()
    {
        $("#out_of_tolerance_mail_list").select2("open");
    }
    function group2()
    {
        $("#out_of_control_list").select2("open");
    }




</script>


<?php include('../footer.php') ?>

</body>

</html>