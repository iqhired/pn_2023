<?php
include("../config.php");
$chicagotime = date("Y-m-d H:i:s");
$temp = "";
//check the user or not
checkSession();

$s_event_id = $_GET['station_event_id'];
$station_event_id = base64_decode(urldecode($s_event_id));
$sqlmain = "SELECT * FROM `sg_station_event` where `station_event_id` = '$station_event_id'";
$resultmain = mysqli_query($db,$sqlmain);
$rowcmain = mysqli_fetch_array($resultmain);
$part_family = $rowcmain['part_family_id'];
$part_number = $rowcmain['part_number_id'];

$sqlnumber = "SELECT * FROM `pm_part_number` where `pm_part_number_id` = '$part_number'";
$resultnumber = mysqli_query($db,$sqlnumber);
$rowcnumber = mysqli_fetch_array($resultnumber);
$pm_part_number = $rowcnumber['part_number'];
$pm_part_name = $rowcnumber['part_name'];

$sqlfamily = "SELECT * FROM `pm_part_family` where `pm_part_family_id` = '$part_family'";
$resultfamily = mysqli_query($db,$sqlfamily);
$rowcfamily = mysqli_fetch_array($resultfamily);
$pm_part_family_name = $rowcfamily['part_family_name'];

$sqlaccount = "SELECT * FROM `part_family_account_relation` where `part_family_id` = '$part_family'";
$resultaccount = mysqli_query($db,$sqlaccount);
$rowcaccount = mysqli_fetch_array($resultaccount);
$account_id = $rowcaccount['account_id'];

$sqlcus = "SELECT * FROM `cus_account` where `c_id` = '$account_id'";
$resultcus =mysqli_query($db,$sqlcus);
$rowccus = mysqli_fetch_array($resultcus);
$cus_name = $rowccus['c_name'];
$logo = $rowccus['logo'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo $sitename; ?> |View Material Traceability</title>
    <!-- Global stylesheets -->
    <link href="../assets/css/core.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="../assets/js/form_js/jquery-min.js"></script>
    <script type="text/javascript" src="../assets/js/libs/jquery-3.6.0.min.js"></script>
    <!-- /global stylesheets -->
    <!-- Core JS files -->
    <!--    <script type="text/javascript" src="../assets/js/libs/jquery-3.6.0.min.js"> </script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- Theme JS files -->
    <script type="text/javascript" src="../assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/forms/selects/bootstrap_select.min.js"></script>
    <script type="text/javascript" src="../assets/js/pages/form_bootstrap_select.js"></script>
    <script type="text/javascript" src="../assets/js/pages/form_layouts.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/ui/ripple.min.js"></script>
    <link href="<?php echo $siteURL; ?>assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $siteURL; ?>assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $siteURL; ?>assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $siteURL; ?>assets/css/colors.css" rel="stylesheet" type="text/css">
    <link href="<?php echo $siteURL; ?>assets/css/style_main.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->
    <!-- Core JS files -->
    <script type="text/javascript" src="<?php echo $siteURL; ?>assets/js/libs/jquery-3.6.0.min.js"> </script>
    <script type="text/javascript" src="<?php echo $siteURL; ?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo $siteURL; ?>assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="<?php echo $siteURL; ?>assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->
    <!-- Theme JS files -->
    <script type="text/javascript" src="<?php echo $siteURL; ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="<?php echo $siteURL; ?>assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
    <script type="text/javascript" src="<?php echo $siteURL; ?>assets/js/plugins/media/fancybox.min.js"></script>
    <script type="text/javascript" src="<?php echo $siteURL; ?>assets/js/pages/datatables_basic.js"></script>
    <script type="text/javascript" src="<?php echo $siteURL; ?>assets/js/pages/form_select2.js"></script>
    <script type="text/javascript" src="<?php echo $siteURL; ?>assets/js/pages/gallery.js"></script>
    <script type="text/javascript" src="<?php echo $siteURL; ?>assets/js/plugins/ui/ripple.min.js"></script>
    <!--Internal  Datetimepicker-slider css -->
    <link href="<?php echo $siteURL; ?>assets/css/form_css/amazeui.datetimepicker.css" rel="stylesheet">
    <link href="<?php echo $siteURL; ?>assets/css/form_css/jquery.simple-dtpicker.css" rel="stylesheet">
    <link href="<?php echo $siteURL; ?>assets/css/form_css/picker.min.css" rel="stylesheet">
    <!--Bootstrap-datepicker css-->
    <link rel="stylesheet" href="<?php echo $siteURL; ?>assets/css/form_css/bootstrap-datepicker.css">
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
		@import url('https://fonts.googleapis.com/css2?family=WindSong&display=swap');

		.signature {

			font-family: 'WindSong', swap;
			font-size: 25px;
			font-weight: 600;
		}

		.form_table_mobile {
			display: none;
		}

		#form_save_btn {
			background-color: #1e73be;
			margin-left: 35px;
			padding: 12px 22px 10px 18px;
			margin-bottom: 10px;
		}

		.pn_none {
			pointer-events: none;
			color: #050505;
		}
		.header {
			overflow: initial;
			background-color: #060818;
			padding: 25px 25px!important;
		}
		.select2-container--default .select2-selection--single .select2-selection__rendered {
			color: #191e3a!important;
			line-height: 20px!important;

		}
		.select2-container--disabled .select2-selection--single:not([class*=bg-]) {
			color: #060818!important;
			border-block-start: none;

		}
		.select2-container--disabled .select2-selection--single:not([class*=bg-]) {
			color: #999;
			border-bottom-style: inset;
		}
		.form-control {
			font-size: 15px;
		}
		@media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px) {
            .col-md-10.mg-t-5.mg-md-t-0{
                max-width: 352px!important;
            }
            .col-md-2{
                max-width: 150px!important;
            }
			.col-lg-2{
				width: 35%!important;
			}
			.content:first-child {
				padding-top: 90px!important;
			}
			.col-md-3 {
				width: 35%;
				float: left;
			}
			.col-md-1 {
				width: 5%;
				float: right;
			}
			.col-md-8.form_col_item {
				float: left;
				width: 100%;
			}
			.col-md-4.form {
				width: 100%;
				float: right;
				margin-top: 10px;
			}

			.form_table_mobile {
				width: 100%;
				background-color: #eee;
				margin-top: 12px;
			}
			.form_row_mobile {
				width: 100%;
				height: auto;
			}
			.col-lg-8.mobile {
				width: 58%;
				float: right;
				padding: 10px 30px 10px 26px;
			}
			label.col-lg-3.control-label.mobile {
				width: 42%;
				float: left;
				padding: 10px 30px 10px 26px;
			}
			.form_table_mobile {
				display: block;
			}
			table.form_table {
				display: none;
			}
			.col-md-1 {
				width: 50%;
				float: right;
			}
			.col-md-2 {
				width: 50%;
				float: left;
			}
			.border-primary {
				border-color: #ffffff;
			}



		}
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
        .breadcrumb-header {
            margin-left: 0;
        }
        @media (min-width: 320px) and (max-width: 480px) {
            .col-md-10.mg-t-5.mg-md-t-0{
                max-width: 352px!important;
            }
            .col-md-2{
                max-width: 150px!important;
            }
            .row-body {

                margin-left: 0rem;
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
        @media (min-width: 614px) and (max-width: 874px) {
            .col-md-10.mg-t-5.mg-md-t-0 {
                max-width: 352px !important;
            }

            .col-md-2 {
                max-width: 150px !important;
            }
        }
        @media (min-width: 481px) and (max-width: 768px) {
            .col-md-10.mg-t-5.mg-md-t-0{
                max-width: 352px!important;
            }
            .col-md-2{
                max-width: 150px!important;
            }
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
            .col-md-10.mg-t-5.mg-md-t-0{
                max-width: 352px!important;
            }
            .col-md-2{
                max-width: 150px!important;
            }
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
        button.remove.btn.btn-sm.btn-danger-light {
            margin-top: -36px;
            margin-bottom: 10px;
            margin-left: 156px;
        }
        .col-lg-3.mg-t-20.mg-lg-t-0.extra_input {
            margin-left: -23px;
            margin-top: 10px;
        }
        .header{
            height: 113px;
        }

	</style>
</head>
<body class="ltr main-body app horizontal">
<!-- Main navbar -->
<?php
$cust_cam_page_header = "View Material Traceability Form";
include("../hp_header.php");
?>
<div class="main-content horizontal-content">
    <!-- container -->
    <!-- breadcrumb -->
    <div class="main-container container">
        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item tx-15"><a href="javascript:void(0);"></a>Material Traceability</li>
                    <li class="breadcrumb-item active" aria-current="page">View Material</li>
                </ol>

            </div>

        </div>
        <?php
        if (!empty($import_status_message)) {
            echo '<br/><div class="alert ' . $message_stauts_class . '">' . $import_status_message . '</div>';
        }
        displaySFMessage();
        ?>
        <form action="" id="form_settings" enctype="multipart/form-data"
              class="form-horizontal" method="post" autocomplete="off">
            <div class="row row-sm">
                <div class="col-lg-10 col-xl-10 col-md-12 col-sm-12">
                    <?php
                    $id = $_GET['id'];
                    $querymain = sprintf("SELECT * FROM `material_tracability` where material_id = '$id' ");
                    $qurmain = mysqli_query($db, $querymain);
                    while ($rowcmain = mysqli_fetch_array($qurmain)) {
                    $formname = $rowcmain['line_no'];
                    ?>
                    <?php
                    $line_no = "SELECT line_id,line_name from cam_line where line_id = '$formname'";
                    $rowline = mysqli_query($db,$line_no);
                    $sqlline = mysqli_fetch_assoc($rowline);
                    $line_number = $sqlline['line_name'];
                    ?>
                    <div class="card-header" style="background:#1F5D96;">
                        <span class="main-content-title mg-b-0 mg-b-lg-1">View Material Traceability - <?php echo $line_number; ?></span>
                    </div>
                    <div class="card  box-shadow-0">
                        <div class="card-body pt-0">
                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs align-items-center mg-b-20">
                                    <input type="hidden" name="name" id="name"
                                           value="<?php echo $rowcmain['station_event_id']; ?>">
                                    <input type="hidden" name="formcreateid" id="formcreateid"
                                           value="<?php echo $rowcmain['customer_account_id']; ?>">
                                    <input type="hidden" name="form_user_data_id" id="form_user_data_id"
                                           value="<?php echo $id; ?>">

                                    <div class="col-md-2">
                                        <label class="form-label mg-b-0">Notes :</label>
                                    </div>
                                    <div class="col-md-10 mg-t-5 mg-md-t-0">
                                        <?php
                                        $notes = $rowcmain["notes"];
                                        ?>
                                        <input type="text" name="notes" class="form-control pn_none" id="notes"
                                               value="<?php echo $notes; ?>" disabled>
                                    </div>
                                </div>
                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-2">
                                        <label class="form-label mg-b-0">Part Family : </label>
                                    </div>
                                    <div class="col-md-10 mg-t-5 mg-md-t-0">

                                        <?php
                                        $part_family_id = $rowcmain['part_family_id'];
                                        $part_family = "SELECT * from pm_part_family where pm_part_family_id = '$part_family_id'";
                                        $rowpart = mysqli_query($db,$part_family);
                                        $sqlpart = mysqli_fetch_assoc($rowpart);
                                        $part_family = $sqlpart['part_family_name'];
                                        ?>
                                        <input type="text" name="part_family" class="form-control" id="part_family"
                                               value="<?php echo $part_family ?>" disabled>
                                    </div>
                                </div>
                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-2">
                                        <label class="form-label mg-b-0">Part Number : </label>
                                    </div>
                                    <div class="col-md-10 mg-t-5 mg-md-t-0">
                                        <?php
                                        $part_no = $rowcmain['part_no'];
                                        $part_num = "SELECT * from pm_part_number where pm_part_number_id = '$part_no'";
                                        $rowpartno = mysqli_query($db,$part_num);
                                        $sqlpartno = mysqli_fetch_assoc($rowpartno);
                                        $part_num_pm = $sqlpartno['part_number'];
                                        ?>
                                        <input type="text" name="part_number" class="form-control" id="part_number"
                                               value="<?php echo $part_num_pm; ?>" disabled>
                                    </div>
                                </div>
                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-2">
                                        <label class="form-label mg-b-0">Part Name : </label>
                                    </div>
                                    <div class="col-md-10 mg-t-5 mg-md-t-0">
                                        <input type="text" name="part_name" class="form-control" id="part_name"
                                               value="<?php echo $rowcmain['part_name']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-2">
                                        <label class="form-label mg-b-0">Material Type : </label>
                                    </div>
                                    <div class="col-md-10 mg-t-5 mg-md-t-0">
                                        <?php
                                        $t_id = $rowcmain['material_type'];
                                        $m_type = "SELECT material_type FROM `material_config` where `material_id` = '$t_id'";
                                        $sql = mysqli_query($db,$m_type);
                                        $sql1 = mysqli_fetch_array($sql);
                                        $material_type = $sql1['material_type'];
                                        ?>
                                        <input type="text" name="material_type" class="form-control" id="material_type"
                                               value="<?php echo $material_type ?>" disabled>
                                    </div>
                                </div>
                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-2">
                                        <label class="form-label mg-b-0">Serial Number : </label>
                                    </div>
                                    <div class="col-md-10 mg-t-5 mg-md-t-0">
                                        <input type="text" name="serial_number" class="form-control" id="serial_number"
                                               value="<?php echo $rowcmain['serial_number']; ?>" disabled>
                                    </div>
                                </div>
                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-2">
                                        <label class="form-label mg-b-0">Material Status : </label>
                                    </div>
                                    <div class="col-md-10 mg-t-5 mg-md-t-0">
                                        <input type="text" name="material_status" class="form-control" id="material_status"
                                               value="<?php echo ($rowcmain['material_status'] == 0)?'fail':'pass'; ?>" disabled>
                                    </div>
                                </div>
                                <?php
                                $m_status = "SELECT material_status FROM `material_tracability` where `material_id` = '$id'";
                                $sql_status = mysqli_query($db,$m_status);
                                $sql1_sta = mysqli_fetch_array($sql_status);
                                $material_status = $sql1_sta['material_status'];
                                if($material_status == 0){ ?>
                                    <div class="row row-xs align-items-center mg-b-20" style="display: none;">
                                        <div class="col-md-2">
                                            <label class="form-label mg-b-0">Reason : </label>
                                        </div>
                                        <div class="col-md-10 mg-t-5 mg-md-t-0">
                                            <input type="text" name="reason" class="form-control" id="material_status"
                                                   value="<?php echo $rowcmain['fail_reason']; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20" style="display: none;">
                                        <div class="col-md-2">
                                            <label class="form-label mg-b-0">Quantity : </label>
                                        </div>
                                        <div class="col-md-10 mg-t-5 mg-md-t-0">
                                            <input type="text" name="quantity" class="form-control" id="quantity"
                                                   value="<?php echo $rowcmain['quantity']; ?>" disabled>
                                        </div>
                                    </div>
                                <?php } elseif($material_status == 1){ ?>
                                    <div class="row row-xs align-items-center mg-b-20" style="display: none;">
                                        <div class="col-md-2">
                                            <label class="form-label mg-b-0">Reason : </label>
                                        </div>
                                        <div class="col-md-10 mg-t-5 mg-md-t-0">
                                            <input type="text" name="reason" class="form-control" id="material_status"
                                                   value="<?php echo $rowcmain['fail_reason']; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20" style="display: none;">
                                        <div class="col-md-2">
                                            <label class="form-label mg-b-0">Quantity : </label>
                                        </div>
                                        <div class="col-md-10 mg-t-5 mg-md-t-0">
                                            <input type="text" name="quantity" class="form-control" id="quantity"
                                                   value="<?php echo $rowcmain['quantity']; ?>" disabled>
                                        </div>
                                    </div>
                                <?php  } ?>
                                <div class="row row-xs align-items-center mg-b-20">
                                    <div class="col-md-2">
                                        <label class="form-label mg-b-0">Submitted Time : </label>
                                    </div>
                                    <div class="col-md-10 mg-t-5 mg-md-t-0">
                                        <?php $create_date = $rowcmain['created_at'];?>
                                        <input type="text" name="createdby" class="form-control" id="createdby"
                                               value="<?php echo dateReadFormat($create_date); ?>" disabled>
                                    </div>
                                </div>
                                <div class="row row-xs align-items-center mg-b-20">
                                    <?php
                                    $query1 = sprintf("SELECT material_id FROM  material_tracability where material_id = '$id'");
                                    $qur1 = mysqli_query($db, $query1);
                                    $rowc1 = mysqli_fetch_array($qur1);
                                    $item_id = $rowc1['material_id'];

                                    $query2 = sprintf("SELECT * FROM  material_images where material_id = '$item_id'");

                                    $qurimage = mysqli_query($db, $query2);
                                    while ($rowcimage = mysqli_fetch_array($qurimage)) {
                                        ?>

                                        <div class="col-lg-3 col-sm-6">
                                            <div class="thumbnail">
                                                <div class="thumb">
                                                    <img src="../assets/images/mt/<?php echo $rowcimage['image_name']; ?>"
                                                         alt="">
                                                    <div class="caption-overflow">
														<span>
														<center>	<a href="../assets/images/mt/<?php echo $rowcimage['image_name']; ?>"
                                                                       data-popup="lightbox" rel="gallery"
                                                                       class="btn border-white text-white btn-flat btn-icon btn-rounded"><i
                                                                        class="icon-plus3"></i></a></center>
														</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
        <script>
            $(".compare_text").keyup(function () {
                var text_id = $(this).attr("id");
                var lower_compare = parseInt($(".lower_compare[data-id='" + text_id + "']").val());
                var upper_compare = parseInt($(".upper_compare[data-id='" + text_id + "']").val());
                var text_val = $(this).val();

                if ($(".compare_text").val().length == 0) {
                    $(this).css("background-color", "white");
                    return false;
                } else {
                    if ($.isNumeric(text_val)) {

                        if (text_val >= lower_compare && text_val <= upper_compare) {
                            $(this).css("background-color", "#abf3ab !important");
                        } else {
                            $(this).attr('style', 'background-color: #ffadad !important');
                        }
                    }
                }

            });

            $("input:radio").click(function () {
                var radio_id = $(this).attr("name");
                var binary_compare = $(".binary_compare[data-id='" + radio_id + "']").val();


                var exact_val = $('input[name="' + radio_id + '"]:checked').val();


                if (exact_val == binary_compare) {
                    $("." + radio_id).css("background-color", "#abf3ab !important");
                } else {
                    $("." + radio_id).css("background-color", "#ffadad !important");
                }


            });

            $("#form_save_btn").click(function (e) {
                //          $(':input[type="button"]').prop('disabled', true);
                var data = $("#form_settings").serialize();
                $.ajax({
                    type: 'POST',
                    url: 'edit_user_form_backend.php',
                    async: false,
                    data: data,
                    success: function (data) {
                        event.preventDefault()
                        $("form :input").prop("disabled", true);
                        window.scrollTo(0, 0);
                    }
                });

                // e.preventDefault();
            });
        </script>
</body>
<?php include('../footer1.php') ?>
</html>