<?php
include("../config.php");
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
//if ($i != "super" && $i != "admin") {
//    header('location: ../dashboard.php');
//}
$station_event_id = $_GET['station_event_id'];
$station = $_GET['station'];

$cellID = $_GET['cell_id'];
$c_name = $_GET['c_name'];
$sqlmain = "SELECT * FROM `sg_station_event` where `station_event_id` = '$station_event_id'";
$resultmain = $mysqli->query($sqlmain);
$rowcmain = $resultmain->fetch_assoc();
$part_family = $rowcmain['part_family_id'];
$part_number = $rowcmain['part_number_id'];
$p_line_id = $rowcmain['line_id'];

$sqlprint = "SELECT * FROM `cam_line` where `line_id` = '$p_line_id'";
$resultnumber = $mysqli->query($sqlprint);
$rowcnumber = $resultnumber->fetch_assoc();
$printenabled = $rowcnumber['print_label'];
$p_line_name = $rowcnumber['line_name'];
$individualenabled = $rowcnumber['indivisual_label'];


$sqlnumber = "SELECT * FROM `pm_part_number` where `pm_part_number_id` = '$part_number'";
$resultnumber = $mysqli->query($sqlnumber);
$rowcnumber = $resultnumber->fetch_assoc();
$pm_part_number = $rowcnumber['part_number'];
$pm_part_name = $rowcnumber['part_name'];
$pm_npr= $rowcnumber['npr'];
$defect_list_id = $_GET['defect_list_id'];



$gp_timestamp = time();
$idddd = preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo
|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i"
    , $_SERVER["HTTP_USER_AGENT"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <META HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo $sitename; ?> |Add Bad piece</title>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>


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
<body class="ltr main-body app horizontal"   onload="openScanner()">

<!-- Main navbar -->
<?php if (!empty($station) || !empty($station_event_id)){
    include("../cell-menu.php");
}else{
    include("../header.php");
    include("../admin_menu.php");
}
?>

    <div class="main-content app-content">

        <div class="main-container container-fluid">
    <!---container--->
    <!---breadcrumb--->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Good Bad Piece</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Bad Piece</li>
            </ol>
        </div>
    </div>
    <?php
                            $cell_id = $_GET['cell_id'];
                            $cell_name = $_GET['c_name'];

                            $sql1 = "SELECT * FROM `defect_list` where  defect_list_id = '$defect_list_id'";
                            $result1 = $mysqli->query($sql1);
                            while ($row1 = $result1->fetch_assoc()) {

                            $defect_list_name = $row1['defect_list_name'];
                            ?>
                            <input type="hidden" name="station_event_id" value="<?php echo $station_event_id; ?>" >
                            <input type="hidden" name="edit_seid" value="<?php echo $station_event_id; ?>">
                            <input type="hidden" name="line_id" value="<?php echo $p_line_id; ?>">
                            <input type="hidden" name="pe" value="<?php echo $printenabled; ?>">
                            <input type="hidden" name="time" value="<?php echo time(); ?>">
                            <input type="hidden" name="line_name" value="<?php echo $p_line_name; ?>">
                            <input type="hidden" name="ipe" value="<?php echo $individualenabled; ?>">

                            <input type="hidden" name="cell_id" value="<?php echo $cell_id; ?>">
                            <input type="hidden" name="c_name" value="<?php echo $cell_name; ?>">




    <form action="create_good_bad_piece.php" id="asset_update"  enctype="multipart/form-data" class="form-horizontal" method="post">
        

        <div class="row">
            <div class="col-lg-12 col-md-12">
                
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">Add Bad Piece</span>
                        </div>


                         <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Select Type</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <div class="row mg-t-15">
                                            <div class="col-lg-3">
                                                <label class="rdiobox">
                                                    <input  name="bad_type" value="bad_piece" type="radio" checked> <span>Bad Piece</span></label>
                                            </div>
                                            <div class="col-lg-3 mg-t-20 mg-lg-t-0">
                                                <label class="rdiobox"><input   name="bad_type" value="rework" type="radio"> <span>  Re-Work</span></label>
                                            </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Defect Name:</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <input type="text" name="add_defect_name" id="add_defect_name" class="form-control" value="<?php echo $defect_list_name; ?>" readonly>
                                </div>
                            </div>
                        </div>


                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">No of Pieces:</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <input type="number" name="good_bad_piece_name" id="good_bad_piece_name" class="form-control" placeholder="Enter Pieces..." value="1" required>
                                </div>
                            </div>
                        </div>

                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Image:</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <?php if(($idddd == 0)){?>
                                    <div id="my_camera"></div>
                                        <br/>
                                        <input type=button class="btn btn-primary" value="Take Snapshot" onClick="take_snapshot()">
                                        <input type="hidden" name="image" id="image" class="image-tag" accept="image/*,capture=camera"/>
                                        <?php } ?>
                                        <?php if(($idddd != 0)){?>

                                        <div style="display:none;" id="my_camera"></div>
                                        <label for="file" class="btn btn-primary ">Take Snapshot</label>
                                        <input type="file" name="image" id="file" class="image-tag" multiple accept="image/*;capture=camera" capture="environment" value="Take Snapshot" style="display: none"/>
                                        <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="display: none">
                                <label class="col-lg-2 control-label">Captured Image : </label>
                                <div class="col-md-6">
                                    <div id="results"></div>
                                </div>
                            </div>

                             <div class="pd-30 pd-sm-20">
                                <div class="row row-xs">
                                 <div class="col-md-2">
                                    <label class="form-label mg-b-0">Previous Image:</label>
                                </div>
                                  <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <div class="container"></div>
                                    <?php
                                    $time_stamp = $_SESSION['good_timestamp_id'];
                                    if(!empty($time_stamp)){
                                        $query2 = sprintf("SELECT * FROM good_piece_images where bad_piece_id = '$time_stamp'");

                                        $qurimage = mysqli_query($db, $query2);
                                        $i =0 ;
                                        while ($rowcimage = mysqli_fetch_array($qurimage)) {
                                            $image = $rowcimage['good_image_name'];
                                            $mime_type = "image/gif";
                                            $file_content = file_get_contents("$image");
                                            $d_tag = "delete_image_" . $i;
                                            $r_tag = "remove_image_" . $i;
                                            ?>

                                            <div class="col-lg-3 col-sm-6">
                                                <div class="thumbnail">
                                                    <div class="thumb">
                                                        <?php echo '<img src="' . $image . '" style="height:50px;width:150px;border: 1px solid #555;" alt=""/>'; ?>

                                                        <input type="hidden"  id="<?php echo $d_tag; ?>" name="<?php echo $d_tag; ?>" class="<?php echo $d_tag; ?> >" value="<?php echo $rowcimage['good_image_id']; ?>">
                                                        <span class="remove remove_image" id="<?php echo $r_tag; ?>">Remove Image </span>
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

                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Cross Section Image:</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <div class="container"></div>
                                           <div class="col-lg-3 col-sm-6">
                                                <div class="thumbnail">
                                                    <div class="thumb">
                                                        <img src="<?php echo $siteURL; ?>assets/images/part_images/cs/201166568A.jpg" alt=""/>'

                                                        <input type="hidden"  id="<?php echo $d_tag; ?>" name="<?php echo $d_tag; ?>" class="<?php echo $d_tag; ?> >" value="<?php echo $rowcimage['good_image_id']; ?>">
                                                        <span class="remove remove_image" id="<?php echo $r_tag; ?>">Remove Image </span>
                                                    </div>
                                                </div>
                                            </div>
                                </div>
                            </div>
                        </div>

                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Defect Block:</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <select name="defect_block" id="defect_block" class="form-control form-select select2"
                                            data-style="bg-slate">
                                        <option value="" selected disabled>- Select Defect Block -</option>
                                        <option value="<?php echo defect_block[0];?>">A1</option>
                                        <option value="<?php echo defect_block[1];?>">A2</option>
                                        <option value="<?php echo defect_block[2];?>">A3</option>
                                        <option value="<?php echo defect_block[3];?>">B1</option>
                                        <option value="<?php echo defect_block[4];?>">B2</option>
                                        <option value="<?php echo defect_block[5];?>">B3</option>
                                        <option value="<?php echo defect_block[6];?>">C1</option>
                                        <option value="<?php echo defect_block[7];?>">C2</option>
                                        <option value="<?php echo defect_block[8];?>">C3</option>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card-body pt-0">
                             <div class="panel-footer p_footer">
                <?php if(($idddd != 0) && ($printenabled == 1)){?>
                    <iframe height="100" id="resultFrame" style="display: none;" src="./pp.php"></iframe>
                <?php }?>
                                 <button type="submit"  id="submitForm_bad" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5 submit_btn">Submit</button>
                                </div>
                    </div>
                 </div>
                 </form>
                 <?php } ?>
 
             </div>
    </div>
         </div> 
    </div>
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
<script>
    function take_snapshot() {
        Webcam.snap( function(data_uri) {
            var formData =  $(".image-tag").val(data_uri);
            document.getElementById('results').innerHTML = '<img src="'+data_uri+'"/>';
            $.ajax({
                url: "bad_piece_cam_backend.php",
                type: "POST",
                data: formData,
                success: function (msg) {
                    window.location.reload()
                },

            });
        });
    }
</script>

<script>
    $("#submitForm_bad").click(function (e) {

        // function submitForm_good(url) {
        // printing only rework not bad piece
        $(':input[type="button"]').prop('disabled', true);
        var data = $("#bad_form").serialize();
        $.ajax({
            type: 'POST',
            url: 'create_good_bad_piece.php',
            data: data,
            cache: false,
            async: false,
            success: function (data) {
                console.log('wfe');
                var line_id = this.data.split('&')[2].split("=")[1];
                var pe = this.data.split('&')[3].split("=")[1];
                var ff2 = this.data.split('&')[4].split("=")[1];
                var deftype = this.data.split('&')[9].split("=")[1];
                var file2 = '../assets/label_files/' + line_id +'/b_'+ff2;
                if((pe == '1') && (deftype != 'bad_piece')){
                    document.getElementById("resultFrame").contentWindow.ss(file2);
                }
            }
        });
        history.replaceState("", "", "<?php echo $scriptName; ?>events_module/good_bad_piece.php?station_event_id=<?php echo $station_event_id; ?>");
    });

    // Upload
    $("#file").on("change", function () {
        var fd = new FormData();
        var files = $('#file')[0].files[0];
        fd.append('file', files);
        fd.append('request', 1);

        // AJAX request
        $.ajax({
            url: 'add_delete_bad_piece_image.php',
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
            url: 'add_delete_bad_piece_image.php',
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
        var info =  "id="+del_id+"&bad_image_id="+ x_img_id;
        $.ajax({
            type: "POST",
            url: "delete_bad_piece_image.php",
            data: info,
            success: function (data) {
            }
        });
        location.reload(true);
    });
</script>

<script>
    $(document).ready(function () {
        $('.select').select2();
    });


</script>
<script>



    $("#search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".view_gpbp").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

</script>
<script>
    //window.onload = function() {
    //    history.replaceState("", "", "<?php //echo $scriptName; ?>//events_module/add_bad_piece.php?station_event_id=<?php //echo $station_event_id; ?>//&defect_list_id=<?php //echo $defect_list_id; ?>//&cell_id=<?php //echo $cell_id?>//&c_name=<?php //echo $cell_name; ?>//");
    //}
</script>
<?php include ('../footer1.php') ?>

    </body>
    </html>
