<?php
include("../config.php");

$station = $_GET['station'];
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
        <?php echo $sitename; ?> |View Form</title>
    <!-- Global stylesheets -->

    <link href="../assets/css/core.css" rel="stylesheet" type="text/css">


    <!-- /global stylesheets -->
    <!-- Core JS files -->
    <!--    <script type="text/javascript" src="../assets/js/libs/jquery-3.6.0.min.js"> </script>-->


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
    <script src="<?php echo $siteURL; ?>assets/js/form_js/webcam.js"></script>


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
include("../cell-menu.php");

?>

<body class="ltr main-body app horizontal" onload="openScanner()">
<div class="main-content app-content">
    <!---container--->
    <!---breadcrumb--->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Document</a></li>
                <li class="breadcrumb-item active" aria-current="page">View Document</li>
            </ol>
        </div>
    </div>
     <?php

             $station = $_GET['station'];
             $part =   $_GET['part_number'];
       $sql_file_station = sprintf("SELECT * FROM `document_data` where part_number = '$part'");
       $qurmain = mysqli_query($db, $sql_file_station);
       while($rowcmain = mysqli_fetch_array($qurmain)){
           $doc_type = $rowcmain['doc_type'];


       }
       $sql_station = "SELECT * FROM `cam_line` where line_id = '$station'";
       $qurst = mysqli_query($db, $sql_station);
        while($rowcst = mysqli_fetch_array($qurst)){
            $station_name = $rowcst['line_name'];
        }

            ?>
     


<div class="row">
            <div class="col-lg-12 col-md-12">

                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">View Document</span>
                        </div>
                    </br>

                         <div class="col-md-12">
                            <h5 class="panel-title form_panel_title"><?php echo $station_name; ?>
                </h5>
                <div class="row ">
                    <form action="" id="form_settings" enctype="multipart/form-data"
                          class="form-horizontal" method="post" autocomplete="off">
                    <div class="col-md-12">
                        <?php
                        $sql_file = sprintf("SELECT * FROM `document_files` where station = '$station' AND part_number  = '0' ");
                        $qurmain1 = mysqli_query($db, $sql_file);
                        while($rowcmain1 = mysqli_fetch_array($qurmain1)){
                            $file_name = $rowcmain1['file_name'];
                            $id =  $rowcmain1['doc_id'];
                            $station =  $rowcmain1['station'];

                        $img_file = sprintf("SELECT * FROM `document_data` where doc_id = '$id'");
                        $qurmain1_d = mysqli_query($db, $img_file);
                        while($rowcmain1_d = mysqli_fetch_array($qurmain1_d)){
                            $doc_name_station = $rowcmain1_d['doc_name'];

                            ?>




                        <div class="form_row row">
                            <a href="../document_files/<?php echo $id; ?>/<?php echo $file_name; ?>" target="_blank">
                            </br>
                            <div class="col-md-12">

                            <input type="text" name="notes" class="form-control" id="notes"
                                       value="<?php echo $doc_name_station; ?>">
                            </div>
                            </a>

                        </div>
                            <?php } }?>
                        </div>
                    </form>
                </div>
                <?php
                $sql_part = "SELECT * FROM `pm_part_number` where pm_part_number_id = '$part'";
                $qur_part = mysqli_query($db, $sql_part);
                while($row_part = mysqli_fetch_array($qur_part)){
                    $part_number = $row_part['part_number'];
                    $part_name = $row_part['part_name'];
                }
                ?>
                <?php $query = sprintf("SELECT line_id,event_status FROM `sg_station_event` where line_id = '$station' ORDER BY created_on DESC");

                $qur_st = mysqli_query($db, $query);
                while($row_st = mysqli_fetch_array($qur_st)){
                $event_status = $row_st['event_status'];

                if ($event_status == '1'){ ?>


                <h5 class="panel-title form_panel_title"><?php echo $part_number."-".$part_name; ?></h5>

                <div class="row ">
                    <form action="" id="form_settings" enctype="multipart/form-data"
                          class="form-horizontal" method="post" autocomplete="off">
                        <div class="col-md-12">
                             <?php
                            $sql_file = sprintf("SELECT * FROM `document_files` where station = '$station' AND part_number = '$part' AND  part_number != '0' ");
                            $qurmain1 = mysqli_query($db,$sql_file);
                            while($rowcmain1 = mysqli_fetch_array($qurmain1)){
                                $file_name = $rowcmain1['file_name'];
                                $id =  $rowcmain1['doc_id'];

                                $img_file_p = sprintf("SELECT * FROM `document_data` where doc_id = '$id'");
                                $qurmain1_p = mysqli_query($db, $img_file_p);
                                while($rowcmain1_p = mysqli_fetch_array($qurmain1_p)){
                                    $doc_name_part = $rowcmain1_p['doc_name'];

                                    ?>
                                </br>
                                    <div class="form_row row">
                                    <a href="../document_files/<?php echo $id; ?>/<?php echo $file_name; ?>" target="_blank">
                                    </br>
                                        <div class="col-md-12">
                                            <input type="text" name="notes" class="form-control pn_none" id="notes"
                                                   value="<?php echo $doc_name_part; ?>">
                                        </div>
                                    </a>

                                </div>
                                 <?php } } ?>
                        </div>
                    </form>
                </div>
                <?php  }  ?>

               <?php } ?> 
           </div> 
       </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
   <?php include('../footer1.php') ?>
   </div>
</body>

