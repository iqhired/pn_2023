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

//	header('location: ../logout.php');
    exit;
}
$is_tab_login = $_SESSION['is_tab_user'];
$is_cell_login = $_SESSION['is_cell_login'];
//Set the time of the user's last activity
$_SESSION['LAST_ACTIVITY'] = $time;
$i = $_SESSION["role_id"];
if ($i != "super" && $i != "admin" && $i != "pn_user" && $_SESSION['is_tab_user'] != 1 && $_SESSION['is_cell_login'] != 1 ) {
    header('location: ../dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo $sitename; ?> |Form Analytics</title>
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
    <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-base.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-data-adapter.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-ui.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-exports.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-pareto.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-circular-gauge.min.js"></script>
    <link href="https://cdn.anychart.com/releases/8.11.0/css/anychart-ui.min.css" type="text/css" rel="stylesheet">
    <link href="https://cdn.anychart.com/releases/8.11.0/fonts/css/anychart-font.min.css" type="text/css" rel="stylesheet">
    <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-core.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-cartesian.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-base.min.js"></script>
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
        .file-image-1 .icons li a {
            height: 30px;
            width: 30px;
        }
        .remove {
            display: block;
            background: #444;
            border: 1px solid black;
            color: white;
            text-align: center;
            cursor: pointer;
        }
        .remove:hover {
            background: white;
            color: black;
        }
        input[type="file"] {
            display: block;
        }
        .imageThumb {
            max-height: 100px;
            border: 2px solid;
            padding: 1px;
            cursor: pointer;
        }
        .pip {
            display: inline-block;
            margin: 10px 10px 0 0;
        }

        button.remove {
            margin-left: 15px;
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
        .red-star {
            color: red;
        }
        #sub_app {
            padding: 20px 40px;
            color: red;
            font-size: initial;
        }


    </style>
</head>
<!-- Main navbar -->
<?php include("../header.php");
if (($is_tab_login || $is_cell_login)) {
    include("../tab_menu.php");
} else {
    include("../admin_menu.php");
}
?>
<body class="ltr main-body app sidebar-mini">
<div class="main-content app-content">
            <div class="breadcrumb-header justify-content-between">
                <div class="left-content">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Logs</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Form Analytics</li>
                    </ol>
                </div>
            </div>
    <form action="" id="line_graph" class="form-horizontal" method="post" autocomplete="off">
        <?php
        $form_create_id = $_GET['id'];
        $date_from = $_GET['date_from'];
        $date_to = $_GET['date_to'];

        $query = "SELECT pm_part_family.part_family_name as part_family_name,pm_part_number.part_number as part_number,pm_part_number.part_name as part_name,cus_account.c_name as c_name,cus_account.logo as logo FROM `form_create` 
          INNER JOIN pm_part_family ON pm_part_family.pm_part_family_id = form_create.`part_family` 
          INNER JOIN pm_part_number ON pm_part_number.pm_part_number_id = form_create.part_number 
          INNER JOIN part_family_account_relation ON part_family_account_relation.part_family_id = form_create.part_family 
          INNER JOIN cus_account ON cus_account.c_id = part_family_account_relation.account_id 
          WHERE form_create.`form_create_id` = '$form_create_id'";

        $result = mysqli_query($db,$query);
        while ($row = mysqli_fetch_array($result)){
            $part_family_name = $row['part_family_name'];
            $part_number = $row['part_number'];
            $part_name = $row['part_name'];
            $logo = $row['logo'];
            $cus_name = $row['c_name'];
        }
        ?>
        <?php
        $query1 = sprintf("SELECT * FROM  form_create where form_create_id = '$form_create_id'");
        $qur1 = mysqli_query($db, $query1);
        $rowc1 = mysqli_fetch_array($qur1);
        $name = $rowc1['name'];
        $item_id = $rowc1['form_create_id'];
        $part_family = $rowc1['part_family'];
        $station = $rowc1['station'];
        $form_type = $rowc1['form_type'];
        $part_number = $rowc1['part_number'];
        ?>
        <div class="row-body row-sm">
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                <div class="card  box-shadow-0">
                    <div class="card-header">
                        <span class="main-content-title mg-b-0 mg-b-lg-1"><?php echo $name; ?></span>
                    </div>
                    <div class="card-body pt-0">
                        <div class="pd-30 pd-sm-20">
                                <div class=" row row-xs align-items-center mg-b-20">
                                    <div class="col-md-2">
                                            <div class="media-left">
                                                <img src="../supplier_logo/<?php if($logo != ""){ echo $logo; }else{ echo "user.png"; } ?>" style=" height: 20vh;width:20vh;margin : 15px 25px 5px 5px;background-color: #ffffff;" class="img-circle" alt="">
                                            </div>
                                    </div>
                                    <div class="col-md-10 mg-t-5 mg-md-t-0">
                                                <input type="hidden" value="<?php echo $form_iitem_id; ?>" name="form_item_id" id="form_item_id">
                                                <input type="hidden" value="<?php echo $date_to; ?>" name="date_to" id="date_to">
                                                <input type="hidden" value="<?php echo $date_from; ?>" name="date_from" id="date_from">
                                                <input type="hidden" value="<?php echo $form_create_id; ?>" name="form_create" id="form_create">
                                                <h5 style="font-size: xx-large;background-color: #009688; color: #ffffff;padding : 5px; text-align: center;" class="text-semibold no-margin"><?php if($cus_name != ""){ echo $cus_name; }else{ echo "Customer Name";} ?> </h5>
                                                <?php
                                                   $qur2 = mysqli_query($db, "SELECT * FROM form_type where form_type_id = '$form_type'");
                                                   $row2 = mysqli_fetch_array($qur2);
                                                   $form_type_name = $row2["form_type_name"];
                                                ?>
                                                <input type="hidden" value="<?php echo $form_type; ?>" name="form_type" id="form_type">
                                                <small style="font-size: x-large;" class="display-block"><b>Form Type :-</b> <?php echo $form_type_name; ?></small><br/>
                                               <?php
                                                   $qur1 = mysqli_query($db, "SELECT * FROM cam_line where line_id = '$station' and enabled = 1");
                                                   $row1 = mysqli_fetch_array($qur1);
                                                   $line_name = $row1["line_name"];
                                               ?>
                                                <input type="hidden" value="<?php echo $station; ?>" name="station" id="station">
                                                <small style="font-size: x-large;" class="display-block"><b>Station :-</b> <?php echo $line_name; ?></small><br/>
                                                <small style="font-size: x-large;margin-top: 15px;" class="display-block"><b>Part Family :-</b> <?php echo $part_family_name; ?></small><br/>
                                                <?php
                                                   $qur3 = mysqli_query($db, "SELECT * FROM pm_part_number where pm_part_number_id = '$part_number'");
                                                   $row3 = mysqli_fetch_array($qur3);
                                                  $part_number = $row3["part_number"];
                                                ?>
                                                <input type="hidden" value="<?php echo $part_number; ?>" name="part_number" id="part_number">
                                                <small style="font-size: x-large;" class="display-block"><b>Part Number :-</b> <?php echo $part_number; ?></small><br/>
                                                <small style="font-size: x-large;" class="display-block"><b>Part Name :-</b> <?php echo $part_name; ?></small><br/>
                                                <input type="hidden" name="name" id="name" value="<?php echo $name; ?>">
                                                <input type="hidden" name="createid" id="createid" value="<?php echo $form_createid; ?>">

                                    </div>
                                </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
            <div class="row-body row-sm">
                <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12">
                    <div class="card  box-shadow-0">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">Form Item Information</span>
                        </div>
                        <div class="card-body pt-0">
                            <div class="pd-30 pd-sm-20">
                                <?php
                                $result = "SELECT form_item_id,form_create_id,item_desc,item_val,created_at,updated_at FROM `form_item` WHERE form_create_id = '$form_create_id' and `item_val` IN ('numeric','binary') ORDER BY form_item_id ASC";
                                $qur = mysqli_query($db,$result);
                                while ($rowc = mysqli_fetch_array($qur)) {
                                    $item_desc = $rowc["item_desc"];
                                    $form_iitem_id = $rowc["form_item_id"];
                                    $item_val = $rowc["item_val"];
                                    if($item_val == "numeric"){
                                        $i_val = '(N)';
                                    }else{
                                        $i_val = '(B)';
                                    }
                                    ?>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-10">
                                            <input type="hidden" value="<?php echo $form_item_id; ?>" name="form_iitem_id" id="form_item_id">
                                            <input type="text" name="item_desc" id="item_desc"  class="form-control pn_none"
                                                   value="<?php echo $i_val.'  '.$item_desc; ?>" disabled>
                                        </div>
                                        <div class="col-md-2 mg-t-5 mg-md-t-0">
                                            <a href="form_trend.php?id=<?php echo $rowc['form_create_id']; ?>&station=<?php echo $rowc1['station']; ?>&form_type=<?php echo $rowc1['form_type']; ?>&part_number=<?php echo $part_number; ?>&date_from=<?php echo $date_from; ?>&date_to=<?php echo $date_to; ?>&item_id=<?php echo $form_iitem_id; ?>" class="btn btn-primary" style="background-color:#1e73be;" target="_blank" ><i class="fa fa-line-chart"></i></a>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </form>
</div>
<script>
    $(function () {
        $('input:radio').change(function () {
            var abc = $(this).val()
            //alert(abc)
            if (abc == "button1")
            {
                $('#date_from').prop('disabled', false);
                $('#date_to').prop('disabled', false);
                $('#timezone').prop('disabled', true);
            }
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $("#btn").bind("click", function () {
            $("#station")[0].selectedIndex = 0;
            $("#part_family")[0].selectedIndex = 0;
            $("#part_number")[0].selectedIndex = 0;
            $("#form_type")[0].selectedIndex = 0;
        });
    });
</script>
<script>
    $(function(){
        var dtToday = new Date();

        var month = dtToday.getMonth() + 1;
        var day = dtToday.getDate();
        var year = dtToday.getFullYear();
        if(month < 10)
            month = '0' + month.toString();
        if(day < 10)
            day = '0' + day.toString();

        var maxDate = year + '-' + month + '-' + day;

        $('#date_to').attr('max', maxDate);
        $('#date_from').attr('max', maxDate);
    });
</script>
<?php include ('../footer.php') ?>
<!--<script>
    window.onload = function () {
        history.replaceState("", "", "<?php /*echo $scriptName; */?>form_module/form_item_data_view.php");
    }
</script>-->
</body>