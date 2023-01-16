<?php include("../config.php");
$station = $_GET['id'];
$sql1 = "SELECT * FROM `cam_line` WHERE line_id = '$station'";
$result1 = mysqli_query($db, $sql1);
while ($cam1 = mysqli_fetch_array($result1)) {
    $station1 = $cam1['line_id'];
    $station2 = $cam1['line_name'];
}
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>
            <?php echo $sitename; ?> Station dashboard</title>


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
        <link href="<?php echo $siteURL; ?>assets/js/form_css/demo.css" rel="stylesheet"/>
        <!-- anychart documentation -->
        <!-- INTERNAL Select2 css -->
        <link href="<?php echo $siteURL; ?>assets/css/form_css/select2.min.css" rel="stylesheet" />
        <!-- STYLES CSS -->
        <link href="<?php echo $siteURL; ?>assets/css/form_css/style.css" rel="stylesheet">
        <link href="<?php echo $siteURL; ?>assets/css/form_css/style-dark.css" rel="stylesheet">
        <link href="<?php echo $siteURL; ?>assets/css/form_css/style-transparent.css" rel="stylesheet">
        <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-base.min.js"></script>
        <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-data-adapter.min.js"></script>
        <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-ui.min.js"></script>
        <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-exports.min.js"></script>
        <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-pareto.min.js"></script>
        <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-circular-gauge.min.js"></script>
        <link href="https://cdn.anychart.com/releases/8.11.0/css/anychart-ui.min.css" type="text/css" rel="stylesheet">
        <link href="https://cdn.anychart.com/releases/8.11.0/fonts/css/anychart-font.min.css" type="text/css" rel="stylesheet">

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

    <body class="ltr main-body app horizontal">

    <?php if (!empty($station) || !empty($station_event_id)){
        include("../cell-menu.php");
    }else{
        include("../header.php");
        include("../admin_menu.php");
    }
    ?>

    <div class="main-content app-content">
        <!-- container -->
        <div class="main-container container-fluid">
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
                        <li class="breadcrumb-item active" aria-current="page"> Station Dashboard</li>
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
            <form action="" id="material_setting" enctype="multipart/form-data"
                  class="form-horizontal" method="post">
                <?php
                $countervariable = 0;
                $buttonclass = '#000';
                $p_num = '';
                $p_name = '';
                $pf_name = '';
                $time = '';


                $qur01 = mysqli_query($db, "SELECT pn.part_number as p_num, pn.part_name as p_name , pf.part_family_name as pf_name,pf.pm_part_family_id as pf_no, et.event_type_name as e_name ,et.color_code as color_code , sg_events.modified_on as updated_time ,sg_events.station_event_id as station_event_id , sg_events.event_status as event_status , sg_events.created_on as e_start_time FROM sg_station_event as sg_events inner join event_type as et on sg_events.event_type_id=et.event_type_id Inner Join pm_part_family as pf on sg_events.part_family_id = pf.pm_part_family_id inner join pm_part_number as pn on sg_events.part_number_id=pn.pm_part_number_id where sg_events.line_id= '$station1' ORDER by sg_events.created_on DESC LIMIT 1");
                $rowc01 = mysqli_fetch_array($qur01);
                if ($rowc01 != null) {
                    $time = $rowc01['updated_time'];
                    $station_event_id = $rowc01['station_event_id'];
                    $line_status_text = $rowc01['e_name'];
                    $event_status = $rowc01['event_status'];
                    $p_num = $rowc01["p_num"];
                    $p_no = $rowc01["p_no"];;
                    $p_name = $rowc01["p_name"];
                    $pf_name = $rowc01["pf_name"];
                    $pf_no = $rowc01["pf_no"];
                    $buttonclass = $rowc01["color_code"];
                } else {

                }

                ?>
                    <div class="row">
                        <?php
                        $countervariable++;
                        $query = sprintf("SELECT * FROM  cam_line where enabled = '1' and line_id  = '$station1'");
                        $qur = mysqli_query($db, $query);
                        while ($rowc = mysqli_fetch_array($qur)) {
                            $line = $rowc["line_id"];
                            $buttonclass = "";
                            $qur01 = mysqli_query($db, "SELECT count(*) as star1 FROM  cam_station_pos_rel where line_id = '$line'");
                            $rowc01 = mysqli_fetch_array($qur01);
                            $star1 = $rowc01["star1"];
                            $qur02 = mysqli_query($db, "SELECT count(*) as star2 FROM  cam_assign_crew where line_id = '$line' and resource_type = 'regular'");
                            $rowc02 = mysqli_fetch_array($qur02);
                            $star2 = $rowc02["star2"];
                            if ($star1 > $star2) {
                                $buttonclass = "dc6805";
                            } else if ($star1 == $star2) {
                                $buttonclass = "218838";
                            }
                            if ($star2 == "0") {
                                $buttonclass = "1F449C";
                            }
                            $time = "";
                            $qur03 = mysqli_query($db, "SELECT * FROM  cam_log where line_id = '$line' and flag = '1'");
                            while ($rowc03 = mysqli_fetch_array($qur03)) {
                                $notific = $rowc03["email_notification"];
                                if ($notific == "1") {
                                    $buttonclass = "c9302c";
                                }
                                $time = $rowc03["created_at"];
                            }
                            $qur04 = mysqli_query($db, "SELECT * FROM  cam_assign_crew_log where station_id = '$line' and status = '1' ORDER BY `assign_time` ASC ");
                            while ($rowc04 = mysqli_fetch_array($qur04)) {
                                $last_assignedby = $rowc04["last_assigned_by"];
                            }
                            $qur05 = mysqli_query($db, "SELECT * FROM  cam_assign_crew_log where station_id = '$line' and status = '0' ORDER BY `unassign_time` ASC ");
                            while ($rowc05 = mysqli_fetch_array($qur05)) {
                                $last_un_assignedby = $rowc05["last_unassigned_by"];
                            }
                            ?>
                        <div class="col-sm-12 col-md-12 col-xl-4">
                            <div class="card custom-card">
                                <div class="card-body text-center card-img-top-1">
                                    <div>
                                        <h6 class="card-title">CELL STATUS OVERVIEW</h6>
                                    </div>
                                    <table>
                                        <h6 class="card-title"> <?php echo $station2; ?></h6>
                                        <tr>
                                            <td style="width: 40%;">
                                                <div class="tr-row">Part Family :</div>
                                            </td>

                                            <td style="width: 60%;">
                                               <span><?php echo $pf_name;
                                                   $pf_name = ''; ?></span>
                                                <input type="hidden" id="id<?php echo $countervariable; ?>"
                                                       value="<?php echo $time; ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 40%;">
                                                <div class="tr-row">Part Number : </div>
                                            </td>
                                            <td style="width: 60%;"><span><?php echo $p_num;
                                                    $p_num = ''; ?></span></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 40%;">
                                                <div class="tr-row">Part Name :</div>
                                            </td>
                                            <td style="width: 60%;"><span><?php echo $p_name;
                                                    $p_name = ''; ?></span></td>
                                        </tr>
                                    </table>
                                    <?php
                                    $variable123 = $time;
                                    if ($variable123 != "") {
                                        ?>
                                        <script>
                                            function calcTime(city, offset) {
                                                d = new Date();
                                                utc = d.getTime() + (d.getTimezoneOffset() * 60000);
                                                nd = new Date(utc + (3600000 * offset));
                                                return nd;
                                            }
                                            // Set the date we're counting down to
                                            var iddd<?php echo $countervariable; ?> = $("#id<?php echo $countervariable; ?>").val();
                                            console.log(iddd<?php echo $countervariable; ?>);
                                            var countDownDate<?php echo $countervariable; ?> = new Date(iddd<?php echo $countervariable; ?>).getTime();
                                            // Update the count down every 1 second
                                            var x = setInterval(function () {
                                                // Get today's date and time
                                                var now = calcTime('Chicago', '-6');
                                                //new Date().getTime();
                                                // Find the distance between now and the count down date
                                                var distance = now - countDownDate<?php echo $countervariable; ?>;
                                                // Time calculations for days, hours, minutes and seconds
                                                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                                //console.log(days + "d " + hours + "h "+ minutes + "m " + seconds + "s ");
                                                //console.log("------------------------");
                                                // Output the result in an element with id="demo"
                                                document.getElementById("demo<?php echo $countervariable; ?>").innerHTML = days + "d " + hours + "h "
                                                    + minutes + "m " + seconds + "s ";
                                                // If the count down is over, write some text
                                                if (distance < 0) {
                                                    clearInterval(x);
                                                    document.getElementById("demo<?php echo $countervariable; ?>").innerHTML = "EXPIRED";
                                                }
                                            }, 1000);
                                        </script>
                                    <?php } ?>
                                    <div class="mt-4 bg-warning text-white p-3 br-5">
                                        <span id="timer-countinbetween1" class="tx-26 mb-0"  id="demo<?php echo $countervariable; ?>"><?php echo $line_status_text; ?> </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-12 col-xl-4">
                            <div class="card custom-card">
                                <div class="card-body text-center card-img-top-1 ">
                                    <div>
                                        <h6 class="card-title">CREW STATUS OVERVIEW</h6>
                                    </div>
                                    <table>
                                        <h6 class="card-title"> <?php echo $station2; ?></h6>
                                        <tr>
                                            <td style="width: 40%;">
                                                <div class="tr-row">Position Assigned :</div>
                                            </td>

                                            <td style="width: 60%;">
                                               <span><?php echo $star2; ?> / <?php echo $star1; ?></span>
                                                <input type="hidden" id="id<?php echo $countervariable; ?>" value="<?php echo $time; ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="width: 40%;">
                                                <div class="tr-row">Last Assigned by :</div>
                                            </td>
                                            <td style="width: 60%;"><span><?php
                                                    echo $last_assignedby;
                                                    $last_assignedby = "";
                                                    ?></span></td>
                                        </tr>
                                        <tr>
                                            <td style="width: 40%;">
                                                <div class="tr-row">Last Unassigned by :</div>
                                            </td>
                                            <td style="width: 60%;"><span><?php
                                                    echo $last_un_assignedby;
                                                    $last_un_assignedby = "";
                                                    ?></span></td>
                                        </tr>
                                    </table>
                                    <div class="mt-4 text-white p-3 br-5">
                                        <span class="tx-26 mb-0" id="demo<?php echo $countervariable; ?>"></span>
                                    </div>
                                    <?php
                                    $variable123 = $time;
                                    if ($variable123 != "") {
                                        ?>
                                        <script>
                                            function calcTime(city, offset) {
                                                d = new Date();
                                                utc = d.getTime() + (d.getTimezoneOffset() * 60000);
                                                nd = new Date(utc + (3600000 * offset));
                                                return nd;
                                            }
                                            // Set the date we're counting down to
                                            var iddd<?php echo $countervariable; ?> = $("#id<?php echo $countervariable; ?>").val();
                                            console.log(iddd<?php echo $countervariable; ?>);
                                            var countDownDate<?php echo $countervariable; ?> = new Date(iddd<?php echo $countervariable; ?>).getTime();
                                            // Update the count down every 1 second
                                            var x = setInterval(function () {
                                                // Get today's date and time
                                                var now = calcTime('Chicago', '-6');
                                                //new Date().getTime();
                                                // Find the distance between now and the count down date
                                                var distance = now - countDownDate<?php echo $countervariable; ?>;
                                                // Time calculations for days, hours, minutes and seconds
                                                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                                //console.log(days + "d " + hours + "h "+ minutes + "m " + seconds + "s ");
                                                //console.log("------------------------");
                                                // Output the result in an element with id="demo"
                                                document.getElementById("demo<?php echo $countervariable; ?>").innerHTML = days + "d " + hours + "h "
                                                    + minutes + "m " + seconds + "s ";
                                                // If the count down is over, write some text
                                                if (distance < 0) {
                                                    clearInterval(x);
                                                    document.getElementById("demo<?php echo $countervariable; ?>").innerHTML = "EXPIRED";
                                                }
                                            }, 1000);
                                        </script>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                       <?php } ?>
                        <div class="col-sm-12 col-md-12 col-xl-4">
                            <div class="card custom-card">
                                <div class="card-body text-center card-img-top-1 ">
                                       <?php
                                        $countervariable++;
                                        $sql1 = "SELECT * FROM `form_user_data` WHERE `station` = '$station' and `form_type` = 4 order by created_at desc limit 1";
                                        $result1 = $mysqli->query($sql1);
                                        while ($rowc = $result1->fetch_assoc()) {
                                            $form_create_id = $rowc["form_create_id"];
                                            $form_user_data_id = $rowc["form_user_data_id"];
                                            $station = $rowc["station"];
                                            $form_type = $rowc["form_type"];
                                            $part_family = $rowc["part_family"];
                                            $part_number = $rowc["part_number"];
                                            $form_submitted_by = $rowc['firstname'] . " " . $rowc['lastname'];

                                            $qur = mysqli_query($db, "SELECT * FROM `form_create` where form_create_id = '$form_create_id'");
                                            $row1 = mysqli_fetch_array($qur);
                                            $estimateduration = $row1["frequency"];
                                            $estimateduration = $row1["frequency"];
                                            $time = $row1["frequency"];
                                            $t11 = $row1["frequency"];
                                            $color = "";

                                            //retrieve the form type name from the table
                                            $qur0351 = mysqli_query($db, "SELECT * FROM `form_type` where form_type_id = '$form_type'");
                                            $rowc0351 = mysqli_fetch_array($qur0351);
                                            $form_type_name = $rowc0351['form_type_name'];

                                            //retrieve the part family name from the table
                                            $qur0352 = mysqli_query($db, "SELECT * FROM `pm_part_family` where pm_part_family_id = '$part_family' ");
                                            $rowc0352 = mysqli_fetch_array($qur0352);
                                            $part_family_name = $rowc0352['part_family_name'];

                                            //retrieve the part number and part name from the table
                                            $qur0353 = mysqli_query($db, "SELECT * FROM `pm_part_number` where pm_part_number_id = '$part_number'  ");
                                            $rowc0353 = mysqli_fetch_array($qur0353);
                                            $part_number = $rowc0353['part_number'];
                                            $part_name = $rowc0353['part_name'];

                                            $arrteam1 = explode(':', $t11);
                                            $hours = $arrteam1[0];
                                            $minutes = $arrteam1[1];
                                            $hours1 = $hours * 60;
                                            $minutes1 = $minutes + $hours1;
                                            $date = $rowc["created_at"];
                                            $date = strtotime($date);
                                            $date = strtotime("+" . $minutes1 . " minute", $date);
                                            $date = date('Y-m-d H:i:s', $date);
                                            $working_from_time = $rowc["created_at"];
                                            $calcdatet = strtotime($date);
                                            $calccurrdate = strtotime($curdate);
                                            ?>
                                    <div>
                                        <h6 class="card-title">FIRST PIECE SHEET LAB</h6>
                                    </div>

                                        <?php
                                        $countervariable++;
                                        $sql1 = "SELECT * FROM `form_user_data` WHERE `station` = '$station' and `form_type` = 4 order by created_at desc limit 1";
                                        $result1 = $mysqli->query($sql1);
                                        while ($rowc = $result1->fetch_assoc()) {
                                            $form_create_id = $rowc["form_create_id"];
                                            $form_user_data_id = $rowc["form_user_data_id"];
                                            $station = $rowc["station"];
                                            $form_type = $rowc["form_type"];
                                            $part_family = $rowc["part_family"];
                                            $part_number = $rowc["part_number"];
                                            $form_submitted_by = $rowc['firstname'] . " " . $rowc['lastname'];

                                            $qur = mysqli_query($db, "SELECT * FROM `form_create` where form_create_id = '$form_create_id'");
                                            $row1 = mysqli_fetch_array($qur);
                                            $estimateduration = $row1["frequency"];
                                            $estimateduration = $row1["frequency"];
                                            $time = $row1["frequency"];
                                            $t11 = $row1["frequency"];
                                            $color = "";

                                            //retrieve the form type name from the table
                                            $qur0351 = mysqli_query($db, "SELECT * FROM `form_type` where form_type_id = '$form_type'");
                                            $rowc0351 = mysqli_fetch_array($qur0351);
                                            $form_type_name = $rowc0351['form_type_name'];

                                            //retrieve the part family name from the table
                                            $qur0352 = mysqli_query($db, "SELECT * FROM `pm_part_family` where pm_part_family_id = '$part_family' ");
                                            $rowc0352 = mysqli_fetch_array($qur0352);
                                            $part_family_name = $rowc0352['part_family_name'];

                                            //retrieve the part number and part name from the table
                                            $qur0353 = mysqli_query($db, "SELECT * FROM `pm_part_number` where pm_part_number_id = '$part_number'  ");
                                            $rowc0353 = mysqli_fetch_array($qur0353);
                                            $part_number = $rowc0353['part_number'];
                                            $part_name = $rowc0353['part_name'];

                                            $arrteam1 = explode(':', $t11);
                                            $hours = $arrteam1[0];
                                            $minutes = $arrteam1[1];
                                            $hours1 = $hours * 60;
                                            $minutes1 = $minutes + $hours1;
                                            $date = $rowc["created_at"];
                                            $date = strtotime($date);
                                            $date = strtotime("+" . $minutes1 . " minute", $date);
                                            $date = date('Y-m-d H:i:s', $date);
                                            $working_from_time = $rowc["created_at"];
                                            $calcdatet = strtotime($date);
                                            $calccurrdate = strtotime($curdate);
                                            ?>
                                            <h6>First Piece Sheet Lab</h6>
                                            <input type="hidden" id="id<?php echo $countervariable; ?>" value="<?php echo $date; ?>">
                                            <input type="hidden" id="working_from_time<?php echo $countervariable; ?>" value="<?php echo $working_from_time; ?>">
                                            <div class="caption text-center">
                                                <h4>
                                                    <?php if ($date != "") { ?>
                                                        <div class="mt-4 text-white p-3 br-5" id="demo<?php echo $countervariable; ?>">&nbsp;</div>
                                                    <?php } else { ?>
                                                        <div class="mt-4 text-white p-3 br-5" id="demo<?php echo $countervariable; ?>">Available</div>
                                                    <?php } ?>
                                                </h4>
                                            </div>
                                        <hr/>
                                            <script>
                                                function calcTime(city, offset) {
                                                    d = new Date();
                                                    utc = d.getTime() + (d.getTimezoneOffset() * 60000);
                                                    nd = new Date(utc + (3600000 * offset));
                                                    return nd;
                                                }
                                                // Set the date we're counting down to
                                                var iddd<?php echo $countervariable; ?> = $("#id<?php echo $countervariable; ?>").val();

                                                var working_from_time<?php echo $countervariable; ?> = $("#working_from_time<?php echo $countervariable; ?>").val();

                                                //console.log(iddd<?php /* echo $countervariable;*/ ?>);
                                                var countDownDate<?php echo $countervariable; ?> = new Date(iddd<?php echo $countervariable; ?>).getTime();

                                                var countDownworkingDate<?php echo $countervariable; ?> = new Date(working_from_time<?php echo $countervariable; ?>).getTime();

                                                // Update the count down every 1 second
                                                var x = setInterval(function () {
                                                    // Get today's date and time
                                                    // var now = new Date().getTime();
                                                    var now = calcTime('Chicago', '-6');
                                                    // Find the distance between now and the count down date
                                                    //aaya change karvano che
                                                    var distance = countDownDate<?php echo $countervariable; ?> - now;
                                                    // Time calculations for days, hours, minutes and seconds
                                                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                                    // console.log(days + "d " + hours + "h " + minutes + "m " + seconds + "s ");
                                                    //  console.log("------------------------");
                                                    // Output the result in an element with id="demo"
                                                    document.getElementById("demo<?php echo $countervariable; ?>").innerHTML = 'Submit in: ' + hours + "h "
                                                        + minutes + "m " + seconds + "s ";
                                                    document.getElementById("demo<?php echo $countervariable; ?>").style.backgroundColor = 'green';
                                                    // If the count down is over, write some text
                                                    if (distance <= 0) {
                                                        // clearInterval(x);
                                                        var workingdistance = now - countDownworkingDate<?php echo $countervariable; ?>;
                                                        var workingdays = Math.floor(workingdistance / (1000 * 60 * 60 * 24));
                                                        var workinghours = Math.floor((workingdistance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                        var workingminutes = Math.floor((workingdistance % (1000 * 60 * 60)) / (1000 * 60));
                                                        var workingseconds = Math.floor((workingdistance % (1000 * 60)) / 1000);

                                                        document.getElementById("demo<?php echo $countervariable; ?>").innerHTML = 'Expired: ' + workingdays + "d " + workinghours + "h "
                                                            + workingminutes + "m " + workingseconds + "s ";
                                                        document.getElementById("demo<?php echo $countervariable; ?>").style.backgroundColor = 'red';
                                                    }
                                                }, 1000);
                                            </script>
                                            <?php
                                            $form_type_name = "";
                                            $part_family_name = "";
                                            $part_number = "";
                                            $part_name = "";
                                            $buttonclass = "218838";
                                            $date = "";
                                            ?>
                                            <?php
                                            $ratecheck = "";
                                        }
                                        ?>
                                        <?php
                                        $countervariable++;
                                        $sql1 = "SELECT * FROM `form_user_data` WHERE `station` = '$station' and `form_type` = 5 order by created_at desc limit 1";
                                        $result1 = $mysqli->query($sql1);
                                        while ($rowc = $result1->fetch_assoc()) {
                                            $form_create_id = $rowc["form_create_id"];
                                            $form_user_data_id = $rowc["form_user_data_id"];
                                            $station = $rowc["station"];
                                            $form_type = $rowc["form_type"];
                                            $part_family = $rowc["part_family"];
                                            $part_number = $rowc["part_number"];
                                            $form_submitted_by = $rowc['firstname'] . " " . $rowc['lastname'];

                                            $qur = mysqli_query($db, "SELECT * FROM `form_create` where form_create_id = '$form_create_id'");
                                            $row1 = mysqli_fetch_array($qur);
                                            $estimateduration = $row1["frequency"];
                                            $estimateduration = $row1["frequency"];
                                            $time = $row1["frequency"];
                                            $t11 = $row1["frequency"];
                                            $color = "";

                                            //retrieve the form type name from the table
                                            $qur0351 = mysqli_query($db, "SELECT * FROM `form_type` where form_type_id = '$form_type'");
                                            $rowc0351 = mysqli_fetch_array($qur0351);
                                            $form_type_name = $rowc0351['form_type_name'];

                                            //retrieve the part family name from the table
                                            $qur0352 = mysqli_query($db, "SELECT * FROM `pm_part_family` where pm_part_family_id = '$part_family' ");
                                            $rowc0352 = mysqli_fetch_array($qur0352);
                                            $part_family_name = $rowc0352['part_family_name'];

                                            //retrieve the part number and part name from the table
                                            $qur0353 = mysqli_query($db, "SELECT * FROM `pm_part_number` where pm_part_number_id = '$part_number'  ");
                                            $rowc0353 = mysqli_fetch_array($qur0353);
                                            $part_number = $rowc0353['part_number'];
                                            $part_name = $rowc0353['part_name'];

                                            $arrteam1 = explode(':', $t11);
                                            $hours = $arrteam1[0];
                                            $minutes = $arrteam1[1];
                                            $hours1 = $hours * 60;
                                            $minutes1 = $minutes + $hours1;
                                            $date = $rowc["created_at"];
                                            $date = strtotime($date);
                                            $date = strtotime("+" . $minutes1 . " minute", $date);
                                            $date = date('Y-m-d H:i:s', $date);
                                            $working_from_time = $rowc["created_at"];
                                            $calcdatet = strtotime($date);
                                            $calccurrdate = strtotime($curdate);
                                            ?>
                                            <h6>First Piece Sheet Op</h6>
                                            <input type="hidden" id="id<?php echo $countervariable; ?>" value="<?php echo $date; ?>">
                                            <input type="hidden" id="working_from_time<?php echo $countervariable; ?>" value="<?php echo $working_from_time; ?>">
                                            <div class="caption text-center">
                                                <h4>
                                                    <?php if ($date != "") { ?>
                                                        <div class="mt-4 text-white p-3 br-5" id="demo<?php echo $countervariable; ?>">&nbsp;</div>
                                                    <?php } else { ?>
                                                        <div class="mt-4 text-white p-3 br-5" id="demo<?php echo $countervariable; ?>">Available</div>
                                                    <?php } ?>
                                                </h4>
                                            </div><hr/>
                                            <script>
                                                function calcTime(city, offset) {
                                                    d = new Date();
                                                    utc = d.getTime() + (d.getTimezoneOffset() * 60000);
                                                    nd = new Date(utc + (3600000 * offset));
                                                    return nd;
                                                }
                                                // Set the date we're counting down to
                                                var iddd<?php echo $countervariable; ?> = $("#id<?php echo $countervariable; ?>").val();

                                                var working_from_time<?php echo $countervariable; ?> = $("#working_from_time<?php echo $countervariable; ?>").val();

                                                //console.log(iddd<?php /* echo $countervariable;*/ ?>);
                                                var countDownDate<?php echo $countervariable; ?> = new Date(iddd<?php echo $countervariable; ?>).getTime();

                                                var countDownworkingDate<?php echo $countervariable; ?> = new Date(working_from_time<?php echo $countervariable; ?>).getTime();

                                                // Update the count down every 1 second
                                                var x = setInterval(function () {
                                                    // Get today's date and time
                                                    // var now = new Date().getTime();
                                                    var now = calcTime('Chicago', '-6');
                                                    // Find the distance between now and the count down date
                                                    //aaya change karvano che
                                                    var distance = countDownDate<?php echo $countervariable; ?> - now;
                                                    // Time calculations for days, hours, minutes and seconds
                                                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                                    // console.log(days + "d " + hours + "h " + minutes + "m " + seconds + "s ");
                                                    //  console.log("------------------------");
                                                    // Output the result in an element with id="demo"
                                                    document.getElementById("demo<?php echo $countervariable; ?>").innerHTML = 'Submit in: ' + hours + "h "
                                                        + minutes + "m " + seconds + "s ";
                                                    document.getElementById("demo<?php echo $countervariable; ?>").style.backgroundColor = 'green';
                                                    // If the count down is over, write some text
                                                    if (distance <= 0) {
                                                        // clearInterval(x);
                                                        var workingdistance = now - countDownworkingDate<?php echo $countervariable; ?>;
                                                        var workingdays = Math.floor(workingdistance / (1000 * 60 * 60 * 24));
                                                        var workinghours = Math.floor((workingdistance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                        var workingminutes = Math.floor((workingdistance % (1000 * 60 * 60)) / (1000 * 60));
                                                        var workingseconds = Math.floor((workingdistance % (1000 * 60)) / 1000);

                                                        document.getElementById("demo<?php echo $countervariable; ?>").innerHTML = 'Expired: ' + workingdays + "d " + workinghours + "h "
                                                            + workingminutes + "m " + workingseconds + "s ";
                                                        document.getElementById("demo<?php echo $countervariable; ?>").style.backgroundColor = 'red';
                                                    }
                                                }, 1000);
                                            </script>
                                            <?php
                                            $form_type_name = "";
                                            $part_family_name = "";
                                            $part_number = "";
                                            $part_name = "";
                                            $buttonclass = "218838";
                                            $date = "";
                                            ?>
                                            <?php
                                            $ratecheck = "";
                                        }
                                        ?>
                                        <?php
                                        $countervariable++;
                                        $sql1 = "SELECT * FROM `form_user_data` WHERE `station` = '$station' and `form_type` = 3 order by created_at desc limit 1";
                                        $result1 = $mysqli->query($sql1);
                                        while ($rowc = $result1->fetch_assoc()) {
                                            $form_create_id = $rowc["form_create_id"];
                                            $form_user_data_id = $rowc["form_user_data_id"];
                                            $station = $rowc["station"];
                                            $form_type = $rowc["form_type"];
                                            $part_family = $rowc["part_family"];
                                            $part_number = $rowc["part_number"];

                                            $qur = mysqli_query($db, "SELECT * FROM `form_create` where form_create_id = '$form_create_id'");
                                            $row1 = mysqli_fetch_array($qur);
                                            $estimateduration = $row1["frequency"];
                                            $time = $row1["frequency"];
                                            $t11 = $row1["frequency"];
                                            $color = "";

                                            //retrieve the form type name from the table
                                            $qur0351 = mysqli_query($db, "SELECT * FROM `form_type` where form_type_id = '$form_type'");
                                            $rowc0351 = mysqli_fetch_array($qur0351);
                                            $form_type_name = $rowc0351['form_type_name'];

                                            //retrieve the part family name from the table
                                            $qur0352 = mysqli_query($db, "SELECT * FROM `pm_part_family` where pm_part_family_id = '$part_family' ");
                                            $rowc0352 = mysqli_fetch_array($qur0352);
                                            $part_family_name = $rowc0352['part_family_name'];

                                            //retrieve the part number and part name from the table
                                            $qur0353 = mysqli_query($db, "SELECT * FROM `pm_part_number` where pm_part_number_id = '$part_number'  ");
                                            $rowc0353 = mysqli_fetch_array($qur0353);
                                            $part_number = $rowc0353['part_number'];
                                            $part_name = $rowc0353['part_name'];

                                            $arrteam1 = explode(':', $t11);
                                            $hours = $arrteam1[0];
                                            $minutes = $arrteam1[1];
                                            $hours1 = $hours * 60;
                                            $minutes1 = $minutes + $hours1;
                                            $date = $rowc["created_at"];
                                            $date = strtotime($date);
                                            $date = strtotime("+" . $minutes1 . " minute", $date);
                                            $date = date('Y-m-d H:i:s', $date);
                                            $working_from_time = $rowc["created_at"];
                                            $calcdatet = strtotime($date);
                                            $calccurrdate = strtotime($curdate);
                                            ?>
                                                <h6>Parameter Sheet</h6>
                                                <input type="hidden" id="id<?php echo $countervariable; ?>" value="<?php echo $date; ?>">
                                                <input type="hidden" id="working_from_time<?php echo $countervariable; ?>" value="<?php echo $working_from_time; ?>">
                                                <div class="caption text-center"><!--style="border: 1px solid lightgray;"-->

                                                    <h4 style="text-align: center;padding:5px; color: #FFFFFF"">
                                                    <?php if ($date != "") { ?>
                                                    <div class="mt-4 text-white p-3 br-5" id="demo<?php echo $countervariable; ?>"> </div>
                                                    <?php } else { ?>
                                                        <div class="mt-4 text-white p-3 br-5" id="demo<?php echo $countervariable; ?>">
                                                      Available</div>
                                                    <?php } ?>
                                                    </h4>
                                                <script>
                                                    function calcTime(city, offset) {
                                                        d = new Date();
                                                        utc = d.getTime() + (d.getTimezoneOffset() * 60000);
                                                        nd = new Date(utc + (3600000 * offset));
                                                        return nd;
                                                    }
                                                    // Set the date we're counting down to
                                                    var iddd<?php echo $countervariable; ?> = $("#id<?php echo $countervariable; ?>").val();

                                                    var working_from_time<?php echo $countervariable; ?> = $("#working_from_time<?php echo $countervariable; ?>").val();

                                                    //console.log(iddd<?php /* echo $countervariable;*/ ?>);
                                                    var countDownDate<?php echo $countervariable; ?> = new Date(iddd<?php echo $countervariable; ?>).getTime();

                                                    var countDownworkingDate<?php echo $countervariable; ?> = new Date(working_from_time<?php echo $countervariable; ?>).getTime();

                                                    // Update the count down every 1 second
                                                    var x = setInterval(function () {
                                                        // Get today's date and time
                                                        // var now = new Date().getTime();
                                                        var now = calcTime('Chicago', '-6');
                                                        // Find the distance between now and the count down date
                                                        //aaya change karvano che
                                                        var distance = countDownDate<?php echo $countervariable; ?> - now;
                                                        // Time calculations for days, hours, minutes and seconds
                                                        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                                                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                                                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                                                        // console.log(days + "d " + hours + "h " + minutes + "m " + seconds + "s ");
                                                        //  console.log("------------------------");
                                                        // Output the result in an element with id="demo"
                                                        document.getElementById("demo<?php echo $countervariable; ?>").innerHTML = 'Submit in: ' + hours + "h "
                                                            + minutes + "m " + seconds + "s ";
                                                        document.getElementById("demo<?php echo $countervariable; ?>").style.backgroundColor = 'green';
                                                        // If the count down is over, write some text
                                                        if (distance <= 0) {
                                                            // clearInterval(x);
                                                            var workingdistance = now - countDownworkingDate<?php echo $countervariable; ?>;
                                                            var workingdays = Math.floor(workingdistance / (1000 * 60 * 60 * 24));
                                                            var workinghours = Math.floor((workingdistance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                                            var workingminutes = Math.floor((workingdistance % (1000 * 60 * 60)) / (1000 * 60));
                                                            var workingseconds = Math.floor((workingdistance % (1000 * 60)) / 1000);

                                                            document.getElementById("demo<?php echo $countervariable; ?>").innerHTML = 'Expired: ' + workingdays + "d " + workinghours + "h "
                                                                + workingminutes + "m " + workingseconds + "s ";
                                                            document.getElementById("demo<?php echo $countervariable; ?>").style.backgroundColor = 'red';
                                                        }
                                                    }, 1000);
                                                </script>
                                                <?php
                                                $form_type_name = "";
                                                $part_family_name = "";
                                                $part_number = "";
                                                $part_name = "";
                                                $buttonclass = "218838";
                                                $date = "";
                                                ?>
                                                <?php
                                                $ratecheck = "";
                                            }
                                            ?>
                                        </div>
                                    <?php } ?>
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


    <?php include('../footer.php') ?>
    </body>
    </html>
