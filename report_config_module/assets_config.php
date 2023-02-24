<?php
include("../config.php");
include('./../assets/lib/phpqrcode/qrlib.php');
$chicagotime = date("Y-m-d H:i:s");
$temp = "";

//check user
checkSession();

$created_by = $_SESSION['id'];
$is_tab_login = $_SESSION['is_tab_user'];
$is_cell_login = $_SESSION['is_cell_login'];

if (count($_POST) > 0) {
    $station = $_POST['station'];
    $asset_name = $_POST['asset_name'];
    $assets_id = uniqid() . '~' . $station . '~' . $asset_name;

    //store the qr code to directory and database
    $text = $assets_id;

    // $path variable store the location where to
    // store image and $file creates directory name
    // of the QR code file by using 'uniqid'
    // uniqid creates unique id based on microtime
    $path = '../assets/images/qrCode/';
    $file = $path.uniqid() . '~' . $station . '~' . $asset_name.".png";

    // $ecc stores error correction capability('L')
    $ecc = 'L';
    $pixel_Size = 10;
    $frame_Size = 10;

    // Generates QR Code and Stores it in directory given
    QRcode::png($text, $file, $ecc, $pixel_Size, $frame_Size);

    $img = file_get_contents($file);

// Encode the image string data into base64
    $data = base64_encode($img);


    $sql2 = "INSERT INTO `station_assests`(`asset_id`, `line_id`, `asset_name`, `qrcode`, `created_date`, `created_time`, `created_by`,`notes`,`is_deleted`) VALUES ('$assets_id','$station','$asset_name','$data','$chicagodate','$chicagotime','$created_by','','1')";
    $result2 = mysqli_query($db, $sql2);

    $sql1 = "SELECT slno as a_id FROM  station_assests where line_id = '$station' ORDER BY `slno` DESC LIMIT 1";
    $result1 = mysqli_query($db, $sql1);
    $rowc04 = mysqli_fetch_array($result1);
    $a_trace_id = $rowc04["a_id"];
    $ts = $_SESSION['assets_timestamp_id'];
    $folderPath =  "../assets/images/assets_images/".$ts;
    $newfolder = "../assets/images/assets_images/".$a_trace_id;
    if ($result1) {
        rename( $folderPath, $newfolder) ;
        $sql = "update `station_assets_images` SET station_asset_id = '$a_trace_id' where station_asset_id = '$ts'";
        $result1 = mysqli_query($db, $sql);
        $_SESSION['timestamp_id'] = "";
        $_SESSION['message_stauts_class'] = 'alert-success';
        $_SESSION['import_status_message'] = 'Assets Created Sucessfully.';
    } else {
        $_SESSION['message_stauts_class'] = 'alert-danger';
        $_SESSION['import_status_message'] = 'Please retry';

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
        <?php echo $sitename; ?> |Station Assets Config</title>
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
    <script src="<?php echo $siteURL; ?>assets/js/form_js/webcam.js"></script>
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


            input[type="file"] {
                display: block;

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


<!-----body-------->
<body class="ltr main-body app horizontal">

<!-- Main navbar -->
<?php
$cust_cam_page_header = "Station Assets Config";
include("../header.php");
include("../admin_menu.php");
?>
<!-----main content----->
<div class="main-content app-content">
    <!---container--->
    <div class="main-container container">
    <!---breadcrumb--->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Admin Config</a></li>
                <li class="breadcrumb-item active" aria-current="page">Station Assets Config</li>
            </ol>
        </div>
    </div>
    <form action="" id="asset_create" enctype="multipart/form-data" class="form-horizontal" method="post">
        <?php $id = $_GET['id']; ?>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                 <?php
                if (!empty($import_status_message)) {
                    echo '<div class="alert ' . $message_stauts_class . '">' . $import_status_message . '</div>';
                }
                displaySFMessage();
                ?>

                <?php if ($temp == "one") { ?>
                    <div class="alert alert-success no-border">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                                    class="sr-only">Close</span></button>
                        <span class="text-semibold">Event Type</span> Created Successfully.
                    </div>
                <?php } ?>
                <?php if ($temp == "two") { ?>
                    <div class="alert alert-success no-border">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                                    class="sr-only">Close</span></button>
                        <span class="text-semibold">Event Type</span> Updated Successfully.
                    </div>
                <?php } ?>
                 <div class="card">
                    <div class="">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">Station Assets Config</span>
                        </div>
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-1.5">
                                    <label class="form-label mg-b-0">Station</label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <select name="station" id="station" class="form-control form-select select2" data-placeholder="Select Station">
                                        <option value="" selected disabled> Select Station</option>
                                        <?php
                                        $st_dashboard = $_POST['station'];
                                        $station22 = $st_dashboard;
                                        $sql1 = "SELECT * FROM `cam_line`  where enabled = '1' and is_deleted != 1 ORDER BY `line_name` ASC";
                                        $result1 = $mysqli->query($sql1);
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


                                <div class="col-md-0.5"></div>
                                <div class="col-md-1.5">
                                    <label class="form-label mg-b-0">Asset Name </label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <input type="text" class="form-control" name="asset_name" id="asset_name" placeholder="Enter Asset Name" required>
                                </div>
                            </div>
                        </div>
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-1.5">
                                    <label class="form-label mg-b-0">Image</label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <input id="image-input" type="file" name="image[]" class="form-control" multiple>
                                    <div class="container"></div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <button type="submit" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5 submit_btn">Create</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
     </form>

<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card">
           <div class="card-body pt-0 example1-table">
                <div class="table-responsive">
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table  datatable-basic table-bordered text-nowrap mb-0" id="example2">
                                    <thead>
                                    <tr>
                                        <th>Slno</th>
                                        <th>Asset Name</th>
                                        <th>Station</th>
                                        <th>Created Date</th>
                                        <!--<th>Image</th>-->
                                        <th>QR Code</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $query4  = mysqli_query($db, "SELECT * FROM `station_assests` where is_deleted != 0");
                                    while ($rowc08 = mysqli_fetch_array($query4)) {
                                        $slno = $rowc08["slno"];
                                        $asset_id = $rowc08["asset_id"];
                                        $line_id = $rowc08["line_id"];
                                        $asset_name = $rowc08["asset_name"];
                                        $created_date = $rowc08["created_date"];
                                        $qrcode = $rowc08["qrcode"];

                                        $qur1 = mysqli_query($db, "SELECT line_name  FROM `cam_line` where line_id = '$line_id'");
                                        $rowc1 = mysqli_fetch_array($qur1);
                                        $line_name = $rowc1['line_name'];
                                        ?>

                                        <tr>
                                            <td><?php echo ++$counter;; ?></td>
                                            <td><?php echo $asset_name; ?></td>
                                            <td><?php echo $line_name; ?></td>
                                            <td><?php echo dateReadFormat($created_date); ?></td>
                                            <!--<td>
                            <?php
                                            /*                            $query2 = sprintf("SELECT * FROM station_assets_images where station_asset_id = '$slno'");
                                                                        $qurimage = mysqli_query($db, $query2);
                                                                        $i =0 ;
                                                                        while ($rowcimage = mysqli_fetch_array($qurimage)) {
                                                                            $station_asset_image = $rowcimage['station_asset_image'];
                                                                            $mime_type = "image/gif";
                                                                            $file_content = file_get_contents("$station_asset_image");
                                                                            */?>
                                <?php /*echo '<img src="data:image/gif;base64,' . $station_asset_image . '" style="height:50px;width:50px;" />'; */?>
                                <?php
                                            /*                                $i++;}
                                                                        */?>
                        </td>-->
                                            <td><?php echo '<img src="data:image/gif;base64,' . $qrcode . '" style="height:50px;width:50px;" />'; ?>
                                                <a class="btn btn-primary btn-xs" style="background-color:#1e73be;" href= data:image/png;base64,<?php echo $qrcode ?> download><i class="fa fa-download"></i></a>
                                            </td>
                                            <td><a href="edit_assets_config.php?id=<?php echo $asset_id ?>" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                                                <a href="del_assets.php?id=<?php echo $asset_id ?>"  class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
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

<!---container--->
    </div>
</div>

<script>
    $("#image-input").on("change", function () {
        var fd = new FormData();
        var files = $('#image-input')[0].files[0];
        fd.append('file', files);
        //  fd.append('a', counter++);
        fd.append('request', 1);

        // AJAX request
        $.ajax({
            url: 'create_delete_asset_image.php',
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
        console.log(imgElement_src);
        var succ = false;
        // AJAX request
        $.ajax({
            url: 'create_delete_asset_image.php',
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
<?php include ('../footer1.php') ?>

</body>

</html>
