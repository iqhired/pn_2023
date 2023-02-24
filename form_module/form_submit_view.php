<?php include("../config.php");
$curdate = date('Y-m-d');
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
if(empty($dateto)){
    $curdate = date('Y-m-d');
    $dateto = $curdate;
}

if(empty($datefrom)){
    $yesdate = date('Y-m-d',strtotime("-1 days"));
    $datefrom = $yesdate;
}
$button = "";
$temp = "";
$_SESSION['date_from'] = "";
$_SESSION['date_to'] = "";
$_SESSION['button'] = "";
$_SESSION['timezone'] = "";
$_SESSION['button_event'] = "";
$_SESSION['event_type'] = "";
$_SESSION['event_category'] = "";
$_SESSION['pf'] = "";

if (count($_POST) > 0) {
    $_SESSION['date_from'] = $_POST['date_from'];
    $_SESSION['date_to'] = $_POST['date_to'];
    $_SESSION['button'] = $_POST['button'];
    $_SESSION['timezone'] = $_POST['timezone'];
    $_SESSION['button_event'] = $_POST['button_event'];
    $_SESSION['event_type'] = $_POST['event_type'];
    $_SESSION['event_category'] = $_POST['event_category'];
    $button_event = $_POST['button_event'];
    $event_type = $_POST['event_type'];
    $event_category = $_POST['event_category'];
    $dateto = $_POST['date_to'];
    $datefrom = $_POST['date_from'];
    $button = $_POST['button'];
    $timezone = $_POST['timezone'];
}
if (count($_POST) > 0) {
    $cus_id = $_POST['cus_id'];
    $pf = $_POST['part_family'];
}

if(empty($dateto)){
    $curdate = date('Y-m-d');
    $dateto = $curdate;
}

if(empty($datefrom)){
    $yesdate = date('Y-m-d',strtotime("-1 days"));
    $datefrom = $yesdate;
}

$wc = '';
if(isset($pf)){
    $_SESSION['pf'] = $pf;
    $wc = $wc . " and form_user_data.part_family = '$pf'";
}

/* If Data Range is selected */
if ($button == "button1") {
    if(isset($datefrom)){
        $wc = $wc . " and DATE_FORMAT(`created_at`,'%Y-%m-%d') >= '$datefrom' ";
    }
    if(isset($dateto)){
        $wc = $wc . " and DATE_FORMAT(`created_at`,'%Y-%m-%d') <= '$dateto' ";
    }
} else if ($button == "button2"){
    /* If Date Period is Selected */
    $curdate = date('Y-m-d');
    if ($timezone == "7") {
        $countdate = date('Y-m-d', strtotime('-7 days'));
    } else if ($timezone == "1") {
        $countdate = date('Y-m-d', strtotime('-1 days'));
    } else if ($timezone == "30") {
        $countdate = date('Y-m-d', strtotime('-30 days'));
    } else if ($timezone == "90") {
        $countdate = date('Y-m-d', strtotime('-90 days'));
    } else if ($timezone == "180") {
        $countdate = date('Y-m-d', strtotime('-180 days'));
    } else if ($timezone == "365") {
        $countdate = date('Y-m-d', strtotime('-365 days'));
    }
    if(isset($countdate)){
        $wc = $wc . " AND DATE_FORMAT(`created_at`,'%Y-%m-%d') >= '$countdate' and DATE_FORMAT(created_at,'%Y-%m-%d') <= '$curdate' ";
    }
} else{
    $wc = $wc . " and DATE_FORMAT(`created_at`,'%Y-%m-%d') >= '$datefrom' and DATE_FORMAT(`created_at`,'%Y-%m-%d') <= '$dateto' ";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo $sitename; ?> |Form Submit View Count</title>
    <!-- Global stylesheets -->

    <link href="../assets/css/core.css" rel="stylesheet" type="text/css">

    <script src="<?php echo $siteURL; ?>assets/js/charts/anychart/anychart-base.min.js"></script>
    <script src="<?php echo $siteURL; ?>assets/js/charts/anychart/anychart-data-adapter.min.js"></script>
    <script src="<?php echo $siteURL; ?>assets/js/charts/anychart/anychart-ui.min.js"></script>
    <script src="<?php echo $siteURL; ?>assets/js/charts/anychart/anychart-exports.min.js"></script>
    <script src="<?php echo $siteURL; ?>assets/js/charts/anychart/anychart-pareto.min.js"></script>
    <script src="<?php echo $siteURL; ?>assets/js/charts/anychart/anychart-circular-gauge.min.js"></script>
    <link href="<?php echo $siteURL; ?>assets/css/anychart/anychart-ui.min.css" rel="stylesheet">
    <link href="<?php echo $siteURL; ?>assets/css/anychart/anychart-font.min.css" rel="stylesheet">

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
    <script>
        window.onload = function () {
            history.replaceState("", "", "<?php echo $scriptName; ?>form_module/form_submit_view.php");
        }
    </script>

    <?php
    if ($button == "button2") {
        ?>
        <script>
            $(function () {
                $('#date_from').prop('disabled', true);
                $('#date_to').prop('disabled', true);
                $('#timezone').prop('disabled', false);
            });
        </script>
    <?php
    } else {
    ?>
        <script>
            $(function () {
                $('#date_from').prop('disabled', false);
                $('#date_to').prop('disabled', false);
                $('#timezone').prop('disabled', true);
            });
        </script>
        <?php
    }
    ?>


    <!-- event -->
    <?php
    if ($button_event == "button4") {
        ?>
        <script>
            $(function () {
                $('#event_type').prop('disabled', true);
                $('#event_category').prop('disabled', false);
            });
        </script>
    <?php
    } else {
    ?>
        <script>
            $(function () {
                $('#event_type').prop('disabled', false);
                $('#event_category').prop('disabled', true);
            });
        </script>
        <?php
    }
    ?>


</head>

<!-- Main navbar -->
<body class="ltr main-body app horizontal">

<?php
$cust_cam_page_header = "Form Submit View Count";
include("../header.php");
include("../admin_menu.php");
?>
<!-- main-content -->
<div class="main-content app-content">
    <div class="main-container container">

        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">First Piece View Dashboard</li>
                </ol>
            </div>
        </div>




        <form action="" id="view_count" class="form-horizontal" method="post">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="">
                            <div class="card-header">
                                <span class="main-content-title mg-b-0 mg-b-lg-1">Form Submit View Count</span><br>
                            </div>

                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs">
                                    <div class="col-md-1.5">
                                        <label class="form-label mg-b-0">Customer</label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <select name="cus_id" id="cus_id" class="form-control form-select select2" data-bs-placeholder="Select Customers">
                                            <option value="" selected disabled>--- Select Customer ---</option>

                                            <?php
                                            $entry = '';
                                            $st_dashboard = $_POST['cus_id'];
                                            $sql11 = "SELECT * FROM `cus_account` ORDER BY `c_name` ASC ";
                                            $result11 = $mysqli->query($sql11);
                                            while ($row11 = $result11->fetch_assoc()) {
                                                if($st_dashboard == $row11['c_id'])
                                                {
                                                    $entry = 'selected';
                                                }
                                                else
                                                {
                                                    $entry = '';

                                                }
                                                echo "<option value='" . $row11['c_id'] . "'$entry>" . $row11['c_name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-md-0.5"></div>
                                    <div class="col-md-1.5">
                                        <label class="form-label mg-b-0">Part Family</label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <select name="part_family" id="part_family" class="form-control form-select select2" data-bs-placeholder="Select Customers">
                                            <option value="" selected disabled>--- Select Part Family ---</option>

                                            <?php
                                            $cus_id = $_POST['cus_id'];
                                            $st_dashboard = $_POST['part_family'];
                                            $sql21 = "SELECT * FROM `part_family_account_relation` where account_id = '$cus_id'";
                                            $result21 = $mysqli->query($sql21);
                                            while ($row21 = $result21->fetch_assoc()) {
                                                $part_family_id = $row21['part_family_id'];
                                                if ($st_dashboard == $row21['part_family_id']) {
                                                    $entry = 'selected';
                                                } else {
                                                    $entry = '';
                                                }
                                                $sqlp = "SELECT pm_part_family_id,part_family_name,station FROM `pm_part_family` where `pm_part_family_id` = '$part_family_id'";
                                                $resultp = $mysqli->query($sqlp);
                                                while($row2 = $resultp->fetch_assoc())
                                                {

                                                    echo "<option value='" . $row2['pm_part_family_id'] . "'$entry>" . $row2['part_family_name'] . "</option>";

                                                }
                                            }
                                            ?>

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs">
                                    <div class="col-md-1.5">
                                        <label class="form-label mg-b-0">Date From</label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input class="form-control fc-datepicker" name="date_from" id="date_from"
                                                   value="<?php echo $datefrom; ?>" placeholder="MM-DD-YYYY" type="text">
                                        </div>
                                    </div>

                                    <div class="col-md-0.5"></div>

                                    <div class="col-md-1.5">
                                        <label class="form-label mg-b-0">Date To</label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input class="form-control fc-datepicker" name="date_to" id="date_to"
                                                   value="<?php echo $datefrom; ?>" placeholder="MM-DD-YYYY" type="text">
                                        </div>                                    </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">

                                <button type="submit" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5 submit_btn">Submit</button>
                                <button type="button" onclick='window.location.reload();' class="btn btn-danger pd-x-30 mg-r-5 mg-t-5 submit_btn" >Reset</button>

                            </div>

                            <form>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div id="lab_container" style="height: 500px; width: 100%;"></div>
                                    </div>
                                    <div class="col-md-4">
                                        <div id="op_container" style="height: 500px; width: 120%;"></div>
                                    </div>
                                </div>
                            </form>
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

                        </div>
                    </div>
                </div>
            </div>
        </form>




    </div>
</div>

<script>
    $('#cus_id').on('change', function (e) {
        $("#view_count").submit();
    });
    /*$('#part_family').on('change', function (e) {
        $("#view_count").submit();
    });*/
    anychart.onDocumentReady(function () {
        var data = $("#view_count").serialize();
        $.ajax({
            type: 'POST',
            url: 'lab_form_count.php',
            // dataType: 'good_bad_piece_fa.php',
            data: data,
            success: function(data1) {
                var data = JSON.parse(data1);
                // console.log(data);
                var d_count = data.posts.map(function (elem) {
                    return elem.d_count;
                });
                var data = [
                    {x: 'Total First Piece Sheet Lab Submitted', value: d_count, fill: '#177b09'},

                ];
                // create pareto chart with data
                var chart = anychart.column(data);
                // set chart title text settings
                // chart.title('Good Pieces & Bad Pieces');
                var title = chart.title();
                title.enabled(true);
//enables HTML tags
                title.useHtml(true);
                title.text(
                    "<br><br>"
                );

                // set measure y axis title
                // chart.yAxis(0).title('Numbers');
                // cumulative percentage y axis title
                // chart.yAxis(1).title(' Percentage');
                // set interval
                // chart.yAxis(1).scale().ticks().interval(10);

                // get pareto column series and set settings
                var column = chart.getSeriesAt(0);

                column.labels().enabled(true).format('{%Value}');
                column.tooltip().format('Value: {%Value}');

                var labels = column.labels();
                labels.fontFamily("Courier");
                labels.fontSize(24);
                labels.fontColor("#125393");
                labels.fontWeight("bold");
                labels.useHtml(false);
                // // background border color
                // column.labels().background().stroke("#663399");
                // column.labels().background().enabled(true).stroke("Green");

                var xLabelsBackground = column.labels().background();
                xLabelsBackground.enabled(true);
                xLabelsBackground.stroke("#cecece");
                xLabelsBackground.cornerType("round");
                xLabelsBackground.corners(5);


                var labels = chart.xAxis().labels();
                labels.fontFamily("Courier");
                labels.fontSize(18);
                labels.fontColor("#125393");
                labels.fontWeight("bold");
                labels.useHtml(false);
                // // background border color
                // column.labels().background().stroke("#663399");
                // column.labels().background().enabled(true).stroke("Green");

                var xLabelsBackground = chart.xAxis().labels().background();
                xLabelsBackground.enabled(true);
                xLabelsBackground.stroke("#cecece");
                xLabelsBackground.cornerType("round");
                xLabelsBackground.corners(5);

                //
                // // get pareto line series and set settings
                // var line = chart.getSeriesAt(1);
                // line
                //     .tooltip()
                //     // .format('Good Pieces: {%CF}% \n Bad Pieces: {%RF}%');
                //     .format('Percent : {%RF}%');
                //
                // // turn on the crosshair and set settings
                // chart.crosshair().enabled(true).xLabel(false);
                // chart.xAxis().labels().rotation(-90);

                // set container id for the chart
                chart.container('lab_container');
                // initiate chart drawing
                chart.draw();
            }
        });
    });
</script>
<script>
    //op
    anychart.onDocumentReady(function () {
        var data = $("#view_count").serialize();
        $.ajax({
            type: 'POST',
            url: 'lab_form_count1.php',
            // dataType: 'good_bad_piece_fa.php',
            data: data,
            success: function(data1) {
                var data = JSON.parse(data1);
                // console.log(data);
                var cd = data.posts.map(function (elem) {
                    return elem.cd;
                });
                var data = [
                    {x: 'Total First Piece Sheet Op Submitted', value: cd, fill: '#177b09'},

                ];
                // create pareto chart with data
                var chart = anychart.column(data);
                // set chart title text settings
                // chart.title('Good Pieces & Bad Pieces');
                var title = chart.title();
                title.enabled(true);
//enables HTML tags
                title.useHtml(true);
                title.text(
                    "<br><br>"
                );

                // set measure y axis title
                // chart.yAxis(0).title('Numbers');
                // cumulative percentage y axis title
                // chart.yAxis(1).title(' Percentage');
                // set interval
                // chart.yAxis(1).scale().ticks().interval(10);

                // get pareto column series and set settings
                var column = chart.getSeriesAt(0);

                column.labels().enabled(true).format('{%Value}');
                column.tooltip().format('Value: {%Value}');

                var labels = column.labels();
                labels.fontFamily("Courier");
                labels.fontSize(24);
                labels.fontColor("#125393");
                labels.fontWeight("bold");
                labels.useHtml(false);
                // // background border color
                // column.labels().background().stroke("#663399");
                // column.labels().background().enabled(true).stroke("Green");

                var xLabelsBackground = column.labels().background();
                xLabelsBackground.enabled(true);
                xLabelsBackground.stroke("#cecece");
                xLabelsBackground.cornerType("round");
                xLabelsBackground.corners(5);


                var labels = chart.xAxis().labels();
                labels.fontFamily("Courier");
                labels.fontSize(18);
                labels.fontColor("#125393");
                labels.fontWeight("bold");
                labels.useHtml(false);
                // // background border color
                // column.labels().background().stroke("#663399");
                // column.labels().background().enabled(true).stroke("Green");

                var xLabelsBackground = chart.xAxis().labels().background();
                xLabelsBackground.enabled(true);
                xLabelsBackground.stroke("#cecece");
                xLabelsBackground.cornerType("round");
                xLabelsBackground.corners(5);

                //
                // // get pareto line series and set settings
                // var line = chart.getSeriesAt(1);
                // line
                //     .tooltip()
                //     // .format('Good Pieces: {%CF}% \n Bad Pieces: {%RF}%');
                //     .format('Percent : {%RF}%');
                //
                // // turn on the crosshair and set settings
                // chart.crosshair().enabled(true).xLabel(false);
                // chart.xAxis().labels().rotation(-90);

                // set container id for the chart
                chart.container('op_container');
                // initiate chart drawing
                chart.draw();
            }
        });
    });
</script>

<!-- /dashboard content -->
<script>
    $(function () {
        $('input:radio').change(function () {
            var abc = $(this).val()
            //  alert(abc);
            if (abc == "button1") {
                $('#date_from').prop('disabled', false);
                $('#date_to').prop('disabled', false);
                $('#timezone').prop('disabled', true);
            } else if (abc == "button2") {
                $('#period').prop('disabled', false);
                $('#timezone').prop('disabled', true);
            } else if (abc == "button3") {
                $('#event_category').prop('disabled', true);
                $('#event_type').prop('disabled', false);
            } else if (abc == "button4") {
                $('#event_type').prop('disabled', true);
                $('#event_category').prop('disabled', false);
            }


        });
    });
</script>
<?php include('../footer1.php') ?>

</body>
</html>


