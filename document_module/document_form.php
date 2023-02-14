<?php
include("../config.php");
$chicagotime = date("Y-m-d H:i:s");
$temp = "";
checkSession();
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
        <?php echo $sitename; ?> |Document Form</title>
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
$cust_cam_page_header = "Upload Documents";
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
    $st = $_GET['station'];
    $sql1 = "SELECT * FROM `cam_line` where line_id = '$st'";
    $result1 = $mysqli->query($sql1);
    //                                            $entry = 'selected';
    while ($row1 = $result1->fetch_assoc()) {
        $line_name = $row1['line_name'];
    }
    ?>

     <form action="" id="document_setting" class="form-horizontal" method="post">
        <div class="row-body">
            <div class="col-lg-12 col-md-12">
                 <?php if ($temp == "one") { ?>
                    <br/>
                    <div class="alert alert-success no-border">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button> <span class="text-semibold">Group</span> Created Successfully. </div>
                <?php } ?>
                <?php if ($temp == "two") { ?>
                    <br/>
                    <div class="alert alert-success no-border">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button> <span class="text-semibold">Group</span> Updated Successfully. </div>
                <?php } ?>
                <?php
                if (!empty($import_status_message)) {
                    echo '<br/><div class="alert ' . $message_stauts_class . '">' . $import_status_message . '</div>';
                    header("Refresh:0");
                }
                ?>
               <?php
                if (!empty($_SESSION['import_status_message'])) {
                    echo '<br/><div class="alert ' . $_SESSION['message_stauts_class'] . '">' . $_SESSION['import_status_message'] . '</div>';
                    $_SESSION['message_stauts_class'] = '';
                    $_SESSION['import_status_message'] = '';
                    header("Refresh:0");
                }
                ?>

                 <div class="card">
                    <div class="">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">UPLOAD DOCUMENT </span>
                        </div>
                        <div class="card-body pt-0">
                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-2">
                                        <label class="form-label mg-b-0">Station </label>
                                    </div>
                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                        <select name="station" id="station" class="form-control form-select select2 " data-placeholder="Select Station ">
                                             <option value="" selected disabled> Select Station</option>
                                            
                                        <?php
                                        if($_SESSION["role_id"] == "pn_user" &&  (!empty($is_tab_login) || $is_tab_login == 1) && (empty($is_cell_login) || $is_cell_login == 0)){
                                            $is_tab_login = 1;
                                            $tab_line = $_REQUEST['station'];
                                            if(empty($tab_line)){
                                                $tab_line = $_SESSION['tab_station'];
                                            }
                                        }
                                        if($is_tab_login){
                                            $sql1 = "SELECT line_id, line_name FROM `cam_line`  where enabled = '1' and line_id = '$tab_line' and is_deleted != 1 ORDER BY `line_name` ASC";
                                            $result1 = $mysqli->query($sql1);
                                            //                                            $entry = 'selected';
                                            while ($row1 = $result1->fetch_assoc()) {
                                                $entry = 'selected';
                                                echo "<option value='" . $row1['line_id'] . "'  $entry>" . $row1['line_name'] . "</option>";
                                            }
                                        }else if($is_cell_login){
                                            if(empty($_REQUEST)) {
                                                $c_stations = implode("', '", $c_login_stations_arr);
                                                $sql1 = "SELECT line_id,line_name FROM `cam_line`  where enabled = '1' and line_id IN ('$c_stations') and is_deleted != 1 ORDER BY `line_name` ASC";
                                                $result1 = $mysqli->query($sql1);
                                                //                                                                  $                        $entry = 'selected';
                                                $i = 0;
                                                while ($row1 = $result1->fetch_assoc()) {
                                                    //                                                      $entry = 'selected';
                                                    if ($i == 0) {
                                                        $entry = 'selected';
                                                        echo "<option value='" . $row1['line_id'] . "'  $entry>" . $row1['line_name'] . "</option>";
                                                        $c_station = $row1['line_id'];
                                                    } else {
                                                        echo "<option value='" . $row1['line_id'] . "'  >" . $row1['line_name'] . "</option>";

                                                    }
                                                    $i++;
                                                }
                                            }else{
                                                $line_id = $_REQUEST['line'];
                                                if(empty($line_id)){
                                                    $line_id = $_REQUEST['station'];
                                                }
                                                $sql1 = "SELECT line_id,line_name FROM `cam_line`  where enabled = '1' and line_id ='$line_id' and is_deleted != 1";
                                                $result1 = $mysqli->query($sql1);
                                                while ($row1 = $result1->fetch_assoc()) {
                                                    $entry = 'selected';
                                                    $station = $row1['line_id'];
                                                    echo "<option value='" . $station . "'  $entry>" . $row1['line_name'] . "</option>";

                                                }
                                            }
                                        }else{
                                            $st_dashboard = $_POST['station'];
                                            if (!isset($st_dashboard)) {
                                                $st_dashboard = $_REQUEST['station'];
                                            }
                                            $sql1 = "SELECT * FROM `cam_line` where enabled = '1' and is_deleted != 1 ORDER BY `line_name` ASC ";
                                            $result1 = $mysqli->query($sql1);
                                            //                                            $entry = 'selected';
                                            while ($row1 = $result1->fetch_assoc()) {
                                                if ($st_dashboard == $row1['line_id']) {
                                                    $entry = 'selected';
                                                } else {
                                                    $entry = '';

                                                }
                                                echo "<option value='" . $row1['line_id'] . "'  $entry>" . $row1['line_name'] . "</option>";
                                            }
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
                                        <input id="file" type="file" name="file" class="form-control" multiple>
                                        <div class="img_container"></div>
                                    </div>
                                </div>


                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-2">
                                        <label class="form-label mg-b-0">Previous File </label>
                                    </div>
                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
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
                                        <input type="text" class="form-control" name="doc_name" id="doc_name" placeholder="Name" required>
                                    </div>
                                

                                </div>

                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-2">
                                        <label class="form-label mg-b-0">Document Type </label>
                                    </div>
                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                        <div class="row mg-t-15">
                                            <div class="col-lg-2">
                                                <label class="rdiobox"><input id="pass" name="doc_type" value="1"  type="radio" checked> <span>Station </span></label>
                                            </div>
                                            <div class="col-lg-2 mg-t-20 mg-lg-t-0">
                                                <label class="rdiobox"><input  id="fail" name="doc_type"  value="0" type="radio"> <span>Part Number</span></label>
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                 <div class="row row-xs align-items-center mg-b-20 desc" id="Cars0" style="display: none;">



                                    <div class="col-md-2">
                                        <label class="form-label mg-b-1">Part Number</label>
                                    </div>
                                    <div class="col-md-8 mg-t-5 mg-md-t-0">
                                        <select name="part_number" id="part_number" class="form-control form-select select2" data-placeholder="Select Part Number">
                                            <option value="" selected disabled>--- Select Part Number ---</option>
                                            <?php
                                            $station = $_POST['station'];
                                            $sql1 = "SELECT * FROM `pm_part_number` where station = '$station' ORDER BY `part_number` ASC  ";
                                            $result1 = $mysqli->query($sql1);
                                            while ($row1 = $result1->fetch_assoc()) {

                                                echo "<option value='" . $row1['pm_part_number_id'] . "' >" . $row1['part_number'] ." - ".$row1['part_name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            
                           

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

                                            echo "<option value='" . $row1['document_type_id'] . "' >" . $row1['document_type_name'] . "</option>";
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
                                                <label for="pass" class="rdiobox"><input id="active" name="status" value="active" type="radio" checked> <span>Active</span></label>
                                            </div>
                                            <div class="col-lg-2 mg-t-20 mg-lg-t-0">
                                                <label  for="fail" class="rdiobox"><input  id="inactive" name="status" value="inactive" type="radio"> <span>Inactive</span></label>
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
                                               value="<?php echo $datefrom; ?>" placeholder="MM/DD/YYYY" type="date">
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
        $("input[name$='doc_type']").click(function() {
            var test = $(this).val();
             //   console.log(test);
            $("div.desc").hide();
            $("#Cars" + test).show();

        });
    });
</script>

<script>
    $(document).ready(function() {
        $('.select').select2();
    });
</script>

<script>
    $('#station').on('change', function (e) {
        $("#document_setting").submit();
    });
    $('#part_family').on('change', function (e) {
     //   $("#document_setting").submit();
    });
    function group1()
    {
        $("#out_of_tolerance_mail_list").select2("open");
    }
    function group2()
    {
        $("#out_of_control_list").select2("open");
    }


</script>
<script>
    $(document).on("click",".submit_btn",function() {
        var data = $("#document_setting").serialize();
        $.ajax({
            type: 'POST',
            url:' document_backend.php',
            data: data,

            success: function () {

            }
        });

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
            url: 'add_delete_doc_file.php',
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
            url: 'add_delete_doc_file.php',
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

// rename file
//     $('.container').on('click', '.content_img .renamebtn', function () {
//         var id = this.id;
//         var split_id = id.split('_');
//         var num = split_id[1];
//         var rename = $("#rename_" + num).val();
//         $.ajax({
//             url: 'rename_doc_file.php',
//             data: {rename: rename,},
//             type: 'POST',
//             success: function (data) {
//
//             }
//         });
//     });



</script>





<?php include('../footer1.php') ?>

</body>



