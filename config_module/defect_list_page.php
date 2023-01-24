<?php include("../config.php");
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
//	header('location: ../logout.php');
    exit;
}
//Set the time of the user's last activity
$_SESSION['LAST_ACTIVITY'] = $time;

$i = $_SESSION["role_id"];
if ($i != "super" && $i != "admin") {
    header('location: ../dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $sitename; ?> | Update Defect List</title>
    <!-- Global stylesheets -->
    <link href="../assets/css/core.css" rel="stylesheet" type="text/css">
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

        .dropdown .arrow {

            margin-top: -25px!important;
            width: 1.5rem!important;
        }
        #ic .arrow {
            margin-top: -22px!important;
            width: 1.5rem!important;
        }
        .row-body {
            display: flex;
            flex-wrap: wrap;
            margin-left: -8.75rem;
            margin-right: 6.25rem;
        }
        th.sno{
            width: 5%
        }
        th.action {
            width: 15%
        }
        th.p_name {
            width: 60%; /* Not necessary, since only 70% width remains */
        }
        th.d_name{
            width: 20%
        }


        @media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px) {
            .form-horizontal {
                width: 100%;
            }
            .select2-selection--multiple .select2-search--inline .select2-search__field{
                padding: 8px 52px!important;
            }
            .select2-selection--multiple:not([class*=bg-]) .select2-search--inline:first-child .select2-search__field {
                margin-left: -45px!important;
            }
        }
    </style>
    <style>
        th.sno{
            width: 5%
        }
        th.action {
            width: 15%
        }
        th.p_name {
            width: 60%; /* Not necessary, since only 70% width remains */
        }
        th.d_name{
            width: 20%
        }

        .select2-container{
            outline: 0;
            position: relative;
            display: inline-block;
            text-align: left;
            font-size: 12px;
        }
        @media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px) {
            label.col-md-2.control-label {
                width: 50%;
            }
            .col-md-10 {
                width: 50%;
                float: right;
            }
            label.col-md-4.control-label {
                width: 50%;
                float: left;
            }
            .col-md-8 {
                width: 50%;
                float: right;
            }
        }
    </style>
</head>
<body class="ltr main-body app sidebar-mini">
<!-- Main navbar -->
<?php $cam_page_header = "Defect List";
include("../header_folder.php");
include("../admin_menu.php");
?>
<div class="main-content app-content">
    <!-- container -->
    <!-- breadcrumb -->
    <div class="row-body">
        <div class="col-lg-12 col-md-12">
            <div class="breadcrumb-header justify-content-between">
                <div class="left-content">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Config</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Defect List</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <?php
    $id = $_GET['id'];
    $defect_list_name = $_GET['name'];
    $part_number_id = $_GET['part_number_id'];
    ?>
    <form action="" id="edit_form" class="form-horizontal" method="post">
        <div class="row-body">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">Defect List</span>
                        </div>
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <?php
                                $query = sprintf("SELECT * FROM `defect_list` where defect_list_id = '$id'");
                                $qur = mysqli_query($db, $query);
                                $rowc = mysqli_fetch_array($qur);
                                ?>
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0"> Defect Name:* </label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <input type="text" name="edit_name" id="edit_name" class="form-control" value="<?php echo $rowc['defect_list_name']; ?>" required>
                                    <input type="hidden" name="def_edit_id" id="def_edit_id" value="<?php echo $id; ?>">
                                    <input type="hidden" name="def_edit_type" id="def_edit_type" value="def">
                                </div>
                            </div>
                        </div>
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Part Name:* </label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <select required name="def_edit_part_number[]" id="def_edit_part_number"  class="form-control select select2"
                                            multiple="multiple">
                                        <!--                                                        <select name="edit_part_number[]" id="edit_part_number" class="form-control" multiple>-->
                                        <?php
                                        $arrteam = explode(',', $rowc["part_number_id"]);
                                        // $sql1 = "SELECT * FROM `pm_part_number` order by part_name ASC";
                                        $sql1 = "SELECT pm_part_number_id ,part_number, part_name , pm_part_family.part_family_name as part_family_name FROM `pm_part_number` inner join pm_part_family on pm_part_number.part_family = pm_part_family.pm_part_family_id order by part_name ASC";
                                        $result1 = $mysqli->query($sql1);
                                        while ($row1 = $result1->fetch_assoc()) {
                                            if (in_array($row1['pm_part_number_id'], $arrteam)) {
                                                $selected = "selected";
                                            } else {
                                                $selected = "";
                                            }
                                            echo "<option id='" . $row1['pm_part_number_id'] . "'  value='" . $row1['pm_part_number_id'] . "' $selected>" . $row1['part_number'] . "  -  " . $row1['part_name'] . "  -  " . $row1['part_family_name'] . "</option>";
                                        }

                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-4">
                                    <button type="submit" onclick="submitForm_edit('edit_defect_list.php')" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
                <script>
                $(document).on('click', '#edit', function () {
                    var element = $(this);
                    var edit_id = element.attr("data-id");
                    var name = $(this).data("name");
                    var type = $(this).data("type");
                    var part_number = $(this).data("part_number");
                    $("#edit_name").val(name);
                    $("#def_edit_id").val(edit_id);
                    $("#def_edit_type").val(type);

                    const sb1 = document.querySelector('#def_edit_part_number');
                    // create a new option
                    var pnums = part_number.split(',');
                    var options1 = sb1.options;
                    // $("#edit_part_number").val(options);
                    $('#edit_modal_theme_primary .select2 .selection .select2-selection--multiple .select2-selection__choice').remove();

                    for (var i = 0; i < options1.length; i++) {
                        if(pnums.includes(options1[i].value)){ // EDITED THIS LINE
                            options1[i].selected="selected";
                            options1[i].className = ("select2-results__option--highlighted");
                            var opt = document.getElementById(options1[i].value).outerHTML.split(">");
                            //  $('#edit_part_number').prop('selectedIndex',i);
                            $('#select2-results .select2-results__option').prop('selectedIndex',i);
                            var gg = '<li class="select2-selection__choice" title="' + opt[1].replace('</option','') + '"><span class="select2-selection__choice__remove" role="presentation">×</span>' + opt[1].replace('</option','') + '</li>';
                            $('#edit_modal_theme_primary .select2-selection__rendered').append(gg);
                            // $('.select2-search__field').style.visibility='hidden';

                        }
                    }


                    //alert(role);
                });

                $("#checkAll").click(function () {
                    $('input:checkbox').not(this).prop('checked', this.checked);
                });
                $(".select").select2();
                $(document).on('select2:open', () => {
                    document.querySelector('.select2-search__field').focus();
                });


                function submitForm_edit(url) {

                    $(':input[type="button"]').prop('disabled', true);
                    var data = $("#edit_form").serialize();
                    var main_url = "<?php echo $url; ?>";
                    $.ajax({
                        type: 'POST',
                        //url: main_url+url,
                        url: url,
                        data: data,
                        success: function (data) {
                            // window.location.href = window.location.href + "?aa=Line 1";
                            $(':input[type="button"]').prop('disabled', false);
                            location.reload();

                        }
                    });
                }


                $('#choose').on('change', function () {
                    var selected_val = this.value;
                    if (selected_val == 1 || selected_val == 2) {
                        $(".group_div").show();
                    } else {
                        $(".group_div").hide();
                    }
                    if (selected_val == 5 ) {
                        $('#delete_form').submit();
                    }
                });
            </script>
        </div>
        <!-- /content area -->

    </div>
    <!-- /main content -->
</div>
<!-- /page content -->
</div>
<!-- /page container -->

            <script>
                window.onload = function() {
                    history.replaceState("", "", "<?php echo $scriptName; ?>config_module/defect_list.php");
                }
            </script>
  <?php include ('../footer.php') ?>
</body>
</html>
