<?php include("../config.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $sitename; ?> | First Piece Sheet Dashboard</title>
    <!-- Global stylesheets -->
    <link href="../assets/css/core.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->
    <script src="<?php echo $siteURL; ?>assets/js/charts/anychart/anychart-base.min.js"></script>
    <script src="<?php echo $siteURL; ?>assets/js/charts/anychart/anychart-data-adapter.min.js"></script>
    <script src="<?php echo $siteURL; ?>assets/js/charts/anychart/anychart-ui.min.js"></script>
    <script src="<?php echo $siteURL; ?>assets/js/charts/anychart/anychart-exports.min.js"></script>
    <script src="<?php echo $siteURL; ?>assets/js/charts/anychart/anychart-pareto.min.js"></script>
    <script src="<?php echo $siteURL; ?>assets/js/charts/anychart/anychart-circular-gauge.min.js"></script>
    <link href="<?php echo $siteURL; ?>assets/css/anychart/anychart-ui.min.css" rel="stylesheet">
    <link href="<?php echo $siteURL; ?>assets/css/anychart/anychart-font.min.css" rel="stylesheet">
    <!-- Core JS files -->
    <script type="text/javascript" src="../assets/js/form_js/jquery-min.js"></script>
    <script type="text/javascript" src="../assets/js/libs/jquery-3.6.0.min.js"></script>
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
    <!--    <script src="--><?php //echo $siteURL; ?><!--assets/js/form_js/datepicker.js"></script>-->
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
<?php
$cust_cam_page_header = "First Piece Sheet Dashboard";
include("../header.php");
include("../admin_menu.php");
?>

<!-- main-content -->
<div class="main-content app-content">
    <!-- container -->
    <div class="main-container container">
        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page"> First Piece Sheet Dashboard </li>
                </ol>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <form action="" id="count_view" class="form-horizontal" method="post">
                        <div class="">
                            <div class="card-header">
                                <span class="main-content-title mg-b-0 mg-b-lg-1">First Piece Sheet Dashboard</span>
                            </div>
                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs">
                                    <div class="col-md-1">
                                        <label class="form-label mg-b-0">Customer: </label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <select  name="cus_id" id="cus_id" class="form-control form-select select2"  style="float: left;width: initial;" data-placeholder="Select Customer">
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
                                    <div class="col-md-1"></div>
                                    <div class="col-md-1">
                                        <label class="form-label mg-b-0">Part Family: </label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <select  name="station" id="station" class="form-control form-select select2" style="float: left;width: initial;" data-placeholder="Select Part Family">
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
                            <div class="card-body pt-0">
                                <button type="submit" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5 submit_btn">Submit</button>
                                <button type="button" class="btn btn-danger pd-x-30 mg-r-5 mg-t-5 submit_btn">Reset</button>
                            </div>
                        </div>
                    </form>

                    <form>
                        <div class="row " style="margin: 20px;">
                            <div class="col-md-6">
                                <div class="media">
                                    <div id="lab_container" style="height: 350px; margin-top: 15px ;"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="media">
                                    <div id="op_container" style="height: 350px; margin-top: 15px ;"></div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>



    </div>
</div>
<script>
    $('#cus_id').on('change', function (e) {
        $("#count_view").submit();
    });
    //First Piece Sheet Lab data
    anychart.onDocumentReady(function () {
        //   var data = this.window.location.href.split('?')[1];
        var data = $("#count_view").serialize();
        $.ajax({
            type: 'POST',
            url: 'submit_count.php',
            // dataType: 'good_bad_piece_fa.php',
            data: data,
            success: function (data1) {
                var data = JSON.parse(data1);
                // console.log(data);
                var d_count = data.posts.map(function (elem) {
                    return elem.d_count;
                });
                var w_count = data.posts.map(function (elem) {
                    return elem.w_count;
                });
                var m_count = data.posts.map(function (elem) {
                    return elem.m_count;
                });
                var y_count = data.posts.map(function (elem) {
                    return elem.y_count;
                });
                var data = [
                    {x: 'D', value: d_count, fill: '#177b09'},
                    {x: 'W', value: w_count, fill: '#FF0000'},
                    {x: 'M', value: m_count, fill: '#FFA500'},
                    {x: 'Y', value: y_count, fill: '#2643B9'},

                ];
                // create pareto chart with data
                var chart = anychart.column(data);
                // set chart title text settings
                //chart.title('Good Pieces & Bad Pieces');
                var title = chart.title();
                title.enabled(true);
//enables HTML tags
                title.useHtml(true);
                title.text(
                    "<br>First Piece Sheet Lab Data<br>"
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
    //First Piece Sheet Op data
    anychart.onDocumentReady(function () {
        // var data = this.window.location.href.split('?')[1];
        var data = $("#count_view").serialize();
        $.ajax({
            type: 'POST',
            url: 'submit_count1.php',
            // dataType: 'good_bad_piece_fa.php',
            data: data,
            success: function (data1) {
                var data = JSON.parse(data1);
                // console.log(data);
                var d_count = data.posts.map(function (elem) {
                    return elem.d_count;
                });
                var w_count = data.posts.map(function (elem) {
                    return elem.w_count;
                });
                var m_count = data.posts.map(function (elem) {
                    return elem.m_count;
                });
                var y_count = data.posts.map(function (elem) {
                    return elem.y_count;
                });
                var data = [
                    {x: 'D', value: d_count, fill: '#177b09'},
                    {x: 'W', value: w_count, fill: '#FF0000'},
                    {x: 'M', value: m_count, fill: '#FFA500'},
                    {x: 'Y', value: y_count, fill: '#2643B9'},

                ];
                // create pareto chart with data
                var chart = anychart.column(data);
                // set chart title text settings
                //chart.title('Good Pieces & Bad Pieces');
                var title = chart.title();
                title.enabled(true);
//enables HTML tags
                title.useHtml(true);
                title.text(
                    "<br>First Piece Sheet Op Data<br>"
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

<?php include('../footer1.php') ?>

</body>
