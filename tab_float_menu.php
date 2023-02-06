<?php include("config.php");
if (!isset($_SESSION['user'])) {
    header('location: logout.php');
}
$timestamp = date('H:i:s');
$message = date("Y-m-d H:i:s");
$cell_id = $_SESSION['cell_id'];
$station = $_GET['station'];
$_SESSION['line_cust_dash'] =0;
$role = $_SESSION['role_id'];
$is_admin = (($role != null) && (isset($role)) && ($role == 'admin'))?1:0;
?>
<!Doctype html>
<html lang="en">
<head>
    <title>Dashboard Menus</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="<?php echo $siteURL; ?>assets/css/gfont.css" rel="stylesheet">
    <link href="<?php echo $siteURL; ?>assets/css/form_css/style.css" rel="stylesheet">
    <link href="<?php echo $siteURL; ?>assets/css/form_css/style-dark.css" rel="stylesheet">
    <link href="<?php echo $siteURL; ?>assets/css/form_css/style-transparent.css" rel="stylesheet">
    <script src="<?php echo $siteURL; ?>assets/js/fawesomekit.js" crossorigin="anonymous"></script>
    <style>
        a.btn.bg-success.text-white.view_gpbp {
            height: 60px;
            width: 196px;
            font-weight: 400!important;
        }
        .example{
            text-align: center !important;
        }
        .view_gpbp{
            font-size: medium;
        }
        .btn-list>.btn, .btn-list>.dropdown {
            margin-bottom: 1rem;
        }
        .main-content.horizontal-content {
            margin-top: 30px !important;
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
            .col-md-4 {
                width: 30%;
            }
            .col-md-8.mg-t-5.mg-md-t-0 {
                width: 70%;
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
            .row-body {

                margin-left:-15rem;
                margin-right: 0rem;
            }
            .col-md-4 {
                width: 30%;
            }
            .col-md-8.mg-t-5.mg-md-t-0 {
                width: 70%;
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
    </style>
</head>
<body class="ltr main-body app horizontal">
<!-- main-content -->
<div class="main-content horizontal-content">


    <!-- container -->
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">


            </div>

        </div>
        <?php
            $query = sprintf("select * from cam_line where line_id = '$station'");
            $qur = mysqli_query($db, $query);
            $rowc = mysqli_fetch_array($qur);
            if($rowc != null){
                $time = $rowc['updated_time'];
                $station_event_id = $rowc['station_event_id'];
                $line_status_text = $rowc['e_name'];
                $event_status = $rowc['event_status'];
                $p_num = $rowc["p_num"];;
                $p_name = $rowc["p_name"];;
                $pf_name = $rowc["pf_name"];;
                $line_name = $rowc["line_name"];;
                $buttonclass = $rowc["color_code"];
            }else{

            } ?>
        <div class="row">
            <div style="float: left;margin-left: 5%;margin-bottom: 2%;" class="col-lg-6 col-md-6">
                <h2><?php echo $line_name;?> - Station Menu</h2>
            </div>
            <div style="text-align: end;" class="col-lg-5 col-md-5">
            <a href="<?php echo $siteURL; ?>line_tab_dashboard.php" class="btn bg-success text-white">Main Home</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card custom-card">
                    <div class="card-body pb-0">
                        <div class="input-group mb-2">
                            <input id="search" type="text" class="form-control" placeholder="Searching....." >
                            <span class="input-group-append">
                           <button class="btn ripple btn-primary" type="button" fdprocessedid="jzln6h">Search</button>
                          </span>
                        </div>
                        <div class="text-wrap">
                            <div class="example">
                                <?php if ($countervariable % 4 == 0) { ?>
                                    <div class="btn-list">
                                        <?php if ($event_status != '0' && $event_status != '') { ?>
                                            <a href="<?php echo $siteURL; ?>events_module/good_bad_piece.php?station_event_id=<?php echo $station_event_id; ?>" class="btn bg-success text-white view_gpbp">Good & Bad Piece</a>
                                            <?php } ?>
                                        <a href="<?php echo $siteURL; ?>view_station_status.php?station=<?php echo $rowc["line_id"]; ?>" class="btn bg-success text-white view_gpbp">View Station</a>

                                        <a href="<?php echo $siteURL; ?>events_module/station_events.php?station=<?php echo $rowc["line_id"]; ?>" class="btn bg-success text-white view_gpbp">Add/Update Events</a>


                                        <?php if($is_admin == 1){ ?>
                                        <a href="<?php echo $siteURL; ?>form_module/form_settings.php?station=<?php echo $rowc["line_id"]; ?>" class="btn bg-success text-white view_gpbp">Create Form</a>
                                        <?php }  ?>
                                        <a href="<?php echo $siteURL; ?>form_module/options.php?station=<?php echo $rowc["line_id"]; ?>" class="btn bg-success text-white view_gpbp">Submit Form</a>

                                    </div>
                                <?php } else { ?>
                                    <div class="btn-list">
                                        <?php if ($event_status != '0' && $event_status != '') { ?>
                                            <a href="<?php echo $siteURL; ?>events_module/good_bad_piece.php?station_event_id=<?php echo $station_event_id; ?>" class="btn bg-success text-white view_gpbp">Good & Bad Piece</a>
                                        <?php } ?>
                                        <a href="<?php echo $siteURL; ?>view_station_status.php?station=<?php echo $rowc["line_id"]; ?>" class="btn bg-success text-white view_gpbp">View Station</a>

                                        <a href="<?php echo $siteURL; ?>events_module/station_events.php?station=<?php echo $rowc["line_id"]; ?>" class="btn bg-success text-white view_gpbp">Add/Update Events</a>


                                        <?php if($is_admin == 1){ ?>
                                            <a href="<?php echo $siteURL; ?>form_module/form_settings.php?station=<?php echo $rowc["line_id"]; ?>" class="btn bg-success text-white view_gpbp">Create Form</a>
                                        <?php }  ?>
                                        <a href="<?php echo $siteURL; ?>form_module/options.php?station=<?php echo $rowc["line_id"]; ?>" class="btn bg-success text-white view_gpbp">Submit Form</a>

                                    </div>
                                <?php   }

                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Footer opened -->
<?php include('footer1.php') ?>

<!-- Footer closed -->
<!-- JQUERY JS -->
<script src="<?php echo $siteURL;?>assets/js/form_js/jquery-min.js"></script>
<script>

    $("#search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".view_gpbp").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
</script>
</body>
</html>
