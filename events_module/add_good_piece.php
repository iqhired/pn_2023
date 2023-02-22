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
        <?php echo $sitename; ?> |Add bad piece</title>
    <!-- Global stylesheets -->

    <link href="../assets/css/core.css" rel="stylesheet" type="text/css">


    <!-- /global stylesheets -->
    <!-- Core JS files -->
        <script type="text/javascript" src="../assets/js/libs/jquery-3.6.0.min.js"> </script>
<!--    <script src="--><?php //echo $siteURL; ?><!--assets/js/libs/jquery-3.4.1.min.js"></script>-->
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


<!-----body-------->
<!-----main content----->
<div class="main-content app-content">

        <div class="main-container container-fluid">

    <!---container--->
    <!---breadcrumb--->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Admin Config</a></li>
                <li class="breadcrumb-item active" aria-current="page">Add Good Piece</li>
            </ol>
        </div>
    </div>

    <form action="" id="asset_update" class="form-horizontal" method="post">

        <?php
                            $cell_id = $_GET['cell_id'];
                            $cell_name = $_GET['c_name'];
                            ?>
                            <input type="hidden" name="station_event_id" id="station_event_id" class="form-control"
                                   value="<?php echo $station_event_id; ?>" >
                            <input type="hidden" name="line_id" value="<?php echo $p_line_id; ?>">
                            <input type="hidden" name="pe" value="<?php echo $printenabled; ?>">
                            <input type="hidden" name="time" value="<?php echo time(); ?>">
                            <input type="hidden" name="line_name" value="<?php echo $p_line_name; ?>">
                            <input type="hidden" name="ipe" id="ipe" value="<?php echo $individualenabled; ?>">
                            <input type="hidden" name="cell_id" value="<?php echo $cellID; ?>">
                            <input type="hidden" name="c_name" value="<?php echo $c_name; ?>">
                              <input type="hidden" name="c_station" value="<?php echo $station; ?>">
       
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">Add Good Piece</span>
                        </div>


                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">No of Pieces :</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                     <input type="number" name="good_name" id="good_name" class="form-control" placeholder="Enter Pieces..." value="1" required>
                                </div>
                            </div>
                        </div>
                        <?php if(($idddd != 0) && ($printenabled == 1)){ ?>
                    <iframe height="100" id="resultFrame" style="display: none;" src="./pp.php"></iframe>
                <?php }?>
                         <div class="card-body pt-0">
                                    <button type="submit"  id="submitForm_good" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5 submit_btn">Submit</button>

                                </div> 
                            </div> 
                        </div> 
                    </form>
                </div>
</div>
            </div>

  
</div>

<script>
    $("#submitForm_good").click(function (e) {
        $(':input[type="button"]').prop('disabled', true);
        var data = $("#asset_update").serialize();
        $.ajax({
            type: 'POST',
            url: 'create_good_bad_piece.php',
            async: false,
            data: data,
            success: function (data) {
                console.log('wfe');
                var line_id = this.data.split('&')[1].split("=")[1];
                var pe = this.data.split('&')[2].split("=")[1];
                var ff1 = this.data.split('&')[3].split("=")[1];
                var file1 = '../assets/label_files/' + line_id +'/g_'+ff1;
                var file = '../assets/label_files/' + line_id +'/g_'+ff1;;
                var ipe = document.getElementById("ipe").value;
                if(pe == '1'){
                    if(ipe == '1'){
                        console.log('wfe');
                        document.getElementById("resultFrame").contentWindow.ss(file1);
                    }else{
                        console.log('wfe');
                        document.getElementById("resultFrame").contentWindow.ss(file1);
                    }
                }

            }
        });
        history.replaceState("", "", "<?php echo $scriptName; ?>events_module/good_bad_piece.php?station_event_id=<?php echo $station_event_id; ?>&station=<?php echo $station; ?>&cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>");
    });
    $("#search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".view_gpbp").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

</script>
<script>
    $(document).ready(function () {
        $('.select').select2();
    });


</script>
<script>
    //window.onload = function() {
    //    history.replaceState("", "", "<?php //echo $scriptName; ?>//events_module/add_good_piece.php?station_event_id=<?php //echo $station_event_id; ?>//&cell_id=<?php //echo $cell_id?>//&c_name=<?php //echo $cell_name; ?>//");
    //}
</script>
<?php include ('../footer1.php') ?>

</body>



