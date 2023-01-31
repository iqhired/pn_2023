<?php
include("../config.php");
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
//Set the time of the user's last activity
$_SESSION['LAST_ACTIVITY'] = $time;
$i = $_SESSION["role_id"];
if ($i != "super" && $i != "admin" && $i != "pn_user" ) {
    header('location: ../dashboard.php');
}

 

$yesdate = date('Y-m-d',strtotime("365 days"));
$datefrom = $yesdate;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo $sitename; ?> |Edit Document</title>
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

<!-- Main navbar -->
<?php
$cust_cam_page_header = "Edit Documents";
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
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Document</a></li>
            <li class="breadcrumb-item active" aria-current="page">Upload Document</li>
            </ol>
        </div>
    </div>
      <?php
    $id = $_GET['id'];
    $_SESSION['edit_id'] = $id;
    $sql1 = "SELECT * FROM `document_data` where doc_id = '$id'";
    $result1 = mysqli_query($db, $sql1);

    while ($row1 = mysqli_fetch_assoc($result1)) {
        $doc_name = $row1['doc_name'];
        $doc_type = $row1['doc_type'];
        $doc_cat = $row1['doc_category'];
        $status = $row1['status'];
        $station = $row1['station'];
        $expirydate = $row1['expiry_date'];
        $part_number = $row1['part_number'];
        $_SESSION['doc_station'] = $station;
        $_SESSION['doc_part_number'] = $part_number;

        $sql1 = "SELECT * FROM `cam_line` where line_id = '$station'";
        $result1 = mysqli_query($db,$sql1);
        //                                            $entry = 'selected';
        while ($row1 = mysqli_fetch_assoc($result1)) {
            $line_name = $row1['line_name'];
        }

        $sql_cat = "SELECT * FROM `document_type` where document_type_id = '$doc_cat'";
        $result_cat = mysqli_query($db,$sql_cat);
        while ($row_cat = mysqli_fetch_assoc($result_cat)){
            $doc_category = $row_cat['document_type_name'];
        }

        $path = "../document_files/".$id.'/';
        $sql_file = sprintf("SELECT * FROM `document_files` where station = '$station' AND part_number  = '0' ");
        $qurmain1 = mysqli_query($db, $sql_file);
        while($rowcmain1 = mysqli_fetch_array($qurmain1)){
            $file_name = $rowcmain1['file_name'];
        }
        ?>
   

     <form action="edit_document_backend.php" id="document_setting" enctype="multipart/form-data" class="form-horizontal" method="post">
        <div class="row-body">
            <div class="col-lg-12 col-md-12">
                
                 
                 <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">EDIT DOCUMENT </span>
                        </div>
                        <div class="card-body pt-0">
                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-2">
                                        <label class="form-label mg-b-0">Station </label>
                                    </div>
                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                         <input type="hidden" name="doc_id" value="<?php echo $id; ?>">
                                        <select name="station" id="station" class="form-control form-select select2 " data-placeholder="Select Station ">
                                             <option value="" selected disabled> Select Station</option>
                                            
                                        <?php
                                            $sql1 = "SELECT * FROM `cam_line` ";
                                            $result1 = $mysqli->query($sql1);
                                            //                                            $entry = 'selected';
                                            while ($row1 = $result1->fetch_assoc()) {
                                                $lin = $row1['line_id'];

                                                if ($station == $lin) {
                                                    $entry = 'selected';
                                                } else {
                                                    $entry = '';
                                                }
                                                echo "<option value='" . $row1['line_id'] . "' $entry >" . $row1['line_name'] . "</option>";
                                            }
                                            ?>
                                    </select>
                                    </div>
                                    
                                </div>

                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-2">
                                        <label class="form-label mg-b-0">Document File </label>
                                    </div>
                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                        <input id="file" type="file" name="file[]" class="form-control" multiple>
                                        <div class="container"></div>
                                    </div>
                                </div>


                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-2">
                                        <label class="form-label mg-b-0">Previous Image </label>
                                    </div>
                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                        <?php
                                        $query1 = sprintf("SELECT doc_id FROM  document_data where doc_id = '$id'");
                                        $qur1 = mysqli_query($db, $query1);
                                        $rowc1 = mysqli_fetch_array($qur1);
                                        $item_id = $rowc1['doc_id'];

                                        $query2 = sprintf("SELECT * FROM  document_files where doc_id = '$item_id'");

                                        $qurimage = mysqli_query($db, $query2);
                                        $i =0 ;
                                        while ($rowcimage = mysqli_fetch_array($qurimage)) {
                                            $image = $rowcimage['file_name'];
                                            $d_tag = "delete_image_" . $i;
                                            $r_tag = "remove_image_" . $i;
                                            ?>
                                        <div class="col-lg-3 col-sm-6">
                                            <div class="thumbnail">
                                                <div class="thumb">
                                                   <img src="../document_files/<?php echo $item_id; ?>/<?php echo $image; ?>"
                                                             alt="">
                                                     <input type="hidden"  id="<?php echo $d_tag; ?>" name="<?php echo $d_tag; ?>" class="<?php echo $d_tag; ?>" value="<?php echo $rowcimage['doc_file_id']; ?>">
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

                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-2">
                                        <label class="form-label mg-b-0">Document Name</label>
                                    </div>
                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                        <input type="text" class="form-control" name="doc_name" id="doc_name"  value="<?php echo $doc_name; ?>"  placeholder="Enter Doc Name" required>
                                    </div>
                                

                                </div>

                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-2">
                                        <label class="form-label mg-b-0">Document Type </label>
                                    </div>
                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                        <div class="row mg-t-15">
                                            <div class="col-lg-2">
                                                <label class="rdiobox"><input id="pass" name="doc_type" value="1"  type="radio"  <?php if($doc_type == "1"){echo 'checked';} ?>  required> <span>Station </span></label>
                                            </div>
                                            <div class="col-lg-2 mg-t-20 mg-lg-t-0">
                                                <label class="rdiobox"><input  id="fail" name="doc_type"  value="0" type="radio" <?php if($doc_type == "0"){echo 'checked';}?> required> <span>Part Number</span></label>
                                            </div>

                                        </div>
                                    </div>
                                </div>


                                 <?php if($doc_type == "0"){ ?>

                                 <div class="row row-xs align-items-center mg-b-20 desc" id="Carspart_number" style="display: none;">



                                    <div class="col-md-2">
                                        <label class="form-label mg-b-1">Part Number</label>
                                    </div>
                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                        <select name="part_number" id="part_number" class="form-control form-select select2" data-placeholder="Select Part Number">
                                            <option value="" selected disabled>--- Select Part Number ---</option>
                                             <?php
                                                $sql1 = "SELECT * FROM `pm_part_number` where station = '$station' ORDER BY `part_number` ASC  ";
                                                $result1 = $mysqli->query($sql1);
                                                while ($row1 = $result1->fetch_assoc()) {
                                                    if ($part_number = $row1['pm_part_number_id']){
                                                        $entry = 'selected';
                                                    }else{
                                                        $entry = '';
                                                    }

                                                    echo "<option value='" . $row1['pm_part_number_id'] . "' $entry>" . $row1['part_number'] ." - ".$row1['part_name'] . "</option>";
                                                }
                                                ?>
                                        </select>
                                    </div>
                                </div>
                                 <?php } else { ?>


                                <div class="row row-xs align-items-center mg-b-20 desc" id="Cars0" style="display: none;">



                                    <div class="col-md-2">
                                        <label class="form-label mg-b-1">Part Number</label>
                                    </div>
                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                        <select name="part_number" id="part_number" class="form-control form-select select2" data-placeholder="Select Part Number">
                                            <option value="" selected disabled>--- Select Part Number ---</option>
                                             <?php
                                                   $sql1 = "SELECT * FROM `pm_part_number` where station = '$station' ORDER BY `part_number` ASC  ";
                                                   $result1 = $mysqli->query($sql1);
                                                   while ($row1 = $result1->fetch_assoc()) {
                                                       if ($part_number = $row1['pm_part_number_id']){
                                                           $entry = 'selected';
                                                       }else{
                                                           $entry = '';
                                                       }

                                                       echo "<option value='" . $row1['pm_part_number_id'] . "' $entry>" . $row1['part_number'] ." - ".$row1['part_name'] . "</option>";
                                                   }
                                                   ?>
                                        </select>
                                    </div>
                                </div>
                                <?php } ?>
                            
                           

                           <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-2">
                                        <label class="form-label mg-b-0">Document Category</label>
                                    </div>
                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                        <select name="category" id="category" class="form-control form-select select2" data-placeholder="Select Category">
                                            <option value="" selected disabled> Select Category</option>
                                           <?php

                                        $sql2 = "SELECT * FROM `document_type` where enabled = '1' ORDER BY `document_type_name` ASC ";
                                            $result2 = mysqli_query($db,$sql2);
                                            //                                            $entry = 'selected';
                                            while ($row1 = mysqli_fetch_assoc($result2)) {
                                                if($doc_cat == $row1['document_type_id']){
                                                    $entry = 'selected';
                                                }else{
                                                    $entry = '';
                                                }

                                                echo "<option value='" . $row1['document_type_id'] . "' $entry>" . $row1['document_type_name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-2">
                                        <label class="form-label mg-b-0">Status</label>
                                    </div>
                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                        <div class="row mg-t-15">
                                            <div class="col-lg-2">
                                                <label  class="rdiobox"><input id="active" name="status" value="active" type="radio" <?php if($status == "active"){echo 'checked';} ?>> <span>Active</span></label>
                                            </div>
                                            <div class="col-lg-2 mg-t-20 mg-lg-t-0">
                                                <label class="rdiobox"><input  id="inactive" name="status" value="inactive" type="radio" <?php if($status == "inactive"){echo 'checked';} ?> > <span>Inactive</span></label>
                                            </div>

                                        </div>
                                    </div>
                                </div>



                                 <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-2">
                                        <label class="form-label mg-b-0">Expiry Date</label>
                                    </div>
                                    <div class="col-md-3 mg-t-10 mg-md-t-0">
                                         <div class="input-group">
                                        <div class="input-group-text">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input class="form-control fc-datepicker" name="exp_date" id="exp_date"
                                               value="<?php echo $expirydate; ?>" placeholder="MM/DD/YYYY" type="date">
                                    </div>
                                </div> 
                            </div>
                        </div>


                                 <div class="card-body pt-0">

                                    <button type="submit" id="form_submit_btn" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5 submit_btn">SUBMIT</button>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
    $(document).ready(function() {
        $('.select').select2();
    });
</script>

<script>
    $(document).on('click', '.remove_image', function () {
        var del_id = this.id.split("_")[2];
        var mat_img_id = this.parentElement.childNodes[3].value;
        var info =  document.getElementById("delete_image"+del_id);
        var info =  "id="+del_id+"&doc_id="+mat_img_id;
        $.ajax({
            type: "POST",
            url: "../document_module/delete_document_file.php",
            data: info,
            success: function (data) {
            }
        });
        location.reload(true);
    });
</script>
<script>
    $(document).ready(function() {
        $("input[name$='doc_type']").click(function() {
            var test = $(this).val();
            //    console.log(test);
            $("div.desc").hide();
            $("#Cars" + test).show();

        });
    });
</script>
<script>
    $("#file").on("change", function () {
        var fd = new FormData();
        var files = $('#file')[0].files[0];
        fd.append('file', files);
        fd.append('request', 1);

        // AJAX request
        $.ajax({
            url: 'edit_delete_doc_file.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function (response) {

                if (response != 0) {
                    var count = $('.container .content_img').length;
                    count = Number(count) + 1;

                    // Show image preview with Delete button
                    // $('.container').append("<div class='content_img' id='content_img_" + count + "' ><img src='" + response + "' width='100' height='100'><div class='action'> <span class='rename' id='rename_" + count + "'>Rename</span><span class='delete' id='delete_" + count + "'>Delete</span></div><div id='Renamediv'><input type='text' class='form-control' name='rename' id='rename_" + count + "' placeholder='rename file'><button type='submit' id='renamebtn_" + count + "' class='btn-primary renamebtn'>Save</button></div></div>");
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
            url: 'edit_delete_doc_image.php',
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

    // $("#file-input").on("change", function(e) {
    //     var files = e.target.files,
    //         filesLength = files.length;
    //     for (var i = 0; i < filesLength; i++) {
    //         var f = files[i]
    //         var fileReader = new FileReader();
    //         fileReader.onload = (function(e) {
    //             var file = e.target;
    //             $("<span class=\"pip\">" +
    //                 "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
    //                 "<br/><span class=\"remove\">Remove image</span>" +
    //                 "</span>").insertAfter("#file-input");
    //             $(".remove").click(function(){
    //                 $(this).parent(".pip").remove();
    //             });
    //
    //             // Old code here
    //             /*$("<img></img>", {
    //               class: "imageThumb",
    //               src: e.target.result,
    //               title: file.name + " | Click to remove"
    //             }).insertAfter("#files").click(function(){$(this).remove();});*/
    //
    //         });
    //         fileReader.readAsDataURL(f);
    //     }
    // });

</script>

<?php include('../footer1.php') ?>
</body>
</head>

