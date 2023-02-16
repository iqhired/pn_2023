<?php include("../config.php");
$chicagotime = date("Y-m-d H:i:s");
$temp = "";
checkSession();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo $sitename; ?> |Defect List</title>
    <!-- Global stylesheets -->
    <link href="../assets/css/core.css" rel="stylesheet" type="text/css">
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
</head>


<body class="ltr main-body app horizontal">
<!-- main-content -->
<!-- Main navbar -->
<?php
$cust_cam_page_header = "Defect List";
include("../header.php");
include("../admin_menu.php");
?>

<div class="main-content app-content">
    <!-- container -->
    <div class="main-container container">
    <!-- breadcrumb -->
            <div class="breadcrumb-header justify-content-between">
                <div class="left-content">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Config</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Defect List</li>
                    </ol>
                </div>
            </div>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <?php if ($temp == "one") { ?>
                <div class="alert alert-success no-border">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                    <span class="text-semibold">Job</span> Created Successfully.
                </div>
            <?php } ?>
            <?php if ($temp == "two") { ?>
                <div class="alert alert-success no-border">
                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span class="sr-only">Close</span></button>
                    <span class="text-semibold">Job</span> Updated Successfully.
                </div>
            <?php } ?>
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
    <form action="" id="create_form" class="form-horizontal" method="post">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">Defect List</span>
                        </div>
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-1.5">
                                    <label class="form-label mg-b-0"> Defect Name </label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter Defect Name" required>
                                </div>
                            </div>
                        </div>
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-1.5">
                                    <label class="form-label mg-b-0">Defects </label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <select class="form-control form-select select2" name="part_number[]" id="part_number" multiple="multiple" data-placeholder="Select Part(s)...">

                                        <?php
                                        //																$sql1 = "SELECT * FROM `pm_part_number` order by part_name ASC";
                                        $sql1 = "SELECT pm_part_number_id ,part_number, part_name , pm_part_family.part_family_name as part_family_name FROM `pm_part_number` inner join pm_part_family on pm_part_number.part_family = pm_part_family.pm_part_family_id where pm_part_number.is_deleted = 0 order by part_name ASC";
                                        $result1 = $mysqli->query($sql1);
                                        //                                            $entry = 'selected';
                                        while ($row1 = $result1->fetch_assoc()) {
                                            echo "<option id='" . $row1['pm_part_number_id'] . "'  value='" . $row1['pm_part_number_id'] . "'  >" . $row1['part_number'] . "  -  " . $row1['part_name'] . "  -  " . $row1['part_family_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary" onclick="submitForm_create('create_defect_list.php')">Create Defect List</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form action="" id="delete_form" method="post" class="form-horizontal">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">

                        <div class="row">
                            <h4 class="card-title">
                                <button type="submit" class="btn btn-danger" onclick="submitForm('delete_defect_list.php')">
                                    <i>
                                        <svg class="table-delete" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9zm7.5-5l-1-1h-5l-1 1H5v2h14V4h-3.5z"></path></svg>
                                    </i>
                                </button>
                            </h4>
                            <div class="col-md-3" style="margin-left: 45rem!important;">
                                <select class="form-control select2" name="choose" id="choose" data-placeholder="Select Action" required>
                                    <option value="" disabled selected>Select Action </option>
                                    <option value="1" >Add to Defect Group </option>
                                    <option value="2" >Remove from Defect Group </option>
                                </select>
                            </div>
                            <div class="col-md-2 group_div" style="display:none">
                                <select class="form-control" name="group_id" id="group_id"   required>
                                    <option value="" disabled selected>Select Defect Group </option>
                                    <?php
                                    $sql1 = "SELECT * FROM `sg_defect_group`";
                                    $result1 = $mysqli->query($sql1);
                                    while ($row1 = $result1->fetch_assoc()) {
                                        echo "<option value='" . $row1['d_group_id'] . "'>" . $row1['d_group_name'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-primary" onclick="submitForm11('../defect_list_option_backend.php')"  style="background-color:#1e73be;">Go</button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <table class="table datatable-basic table-bordered text-nowrap mb-0" id="example2">
                                <thead>
                                <tr>
                                    <th><input type="checkbox" id="checkAll" ></th>
                                    <th class="sno">S.No</th>
                                    <th class="action">Action</th>
                                    <th class="d_name">Defect Name / Group</th>
                                    <th class="p_name">Part Name(s)</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $query = sprintf("SELECT * FROM  sg_defect_group ");
                                $qur = mysqli_query($db, $query);
                                while ($rowc = mysqli_fetch_array($qur)) {
                                    ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" id="delete_check[]" name="delete_check[]" disabled value="<?php echo $rowc["d_group_id"]; ?>">
                                        </td>
                                        <td><?php echo ++$counter; ?></td>
                                        <td>
                                            <a href="defect_group_page.php?id=<?php echo $rowc['d_group_id'];; ?>" class="btn btn-primary"> <i>
                                                    <svg class="table-edit" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-.45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z"></path></svg>
                                                </i></a>
                                        </td>
                                        <td><?php echo $rowc["d_group_name"]; ?></td>
                                        <?php
                                        $part_fam_nm = '';
                                        $pm_part_number_id = $rowc['part_number_id'];
                                        $arr_pm_part_number_ids = null;
                                        $arr_pm_part_number_ids = explode(',', $pm_part_number_id);
                                        array_pop($arr_pm_part_number_ids);
                                        $i=0;
                                        $count = sizeof($arr_pm_part_number_ids);
                                        $array_pnum = null;
                                        foreach ($arr_pm_part_number_ids as $arr_pm_part_number_id) {
                                            if($i==0){
                                                $array_pnum .= "'" .$arr_pm_part_number_id . "'";
                                            }else{
                                                $array_pnum .= "," . "'" .$arr_pm_part_number_id . "'";
                                            }
                                            $i++;

                                        }
                                        $sql22 = "SELECT * FROM  pm_part_number where pm_part_number_id in ($array_pnum) order by part_name ASC";
                                        //                                                $qurtemp = $mysqli->query($sql22);
                                        $qurtemp = mysqli_query($db,$sql22);
                                        $i=0;
                                        $part_nm=null;
                                        while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                                            $part_nm .= $rowctemp["part_name"] . ' ,  ';
                                        }
                                        $part_nm = rtrim($part_nm,' ,  ');
                                        ?>
                                        <td><?php echo $part_nm; ?></td>
                                    </tr>
                                <?php } ?>
                                <?php
                                $query = sprintf("SELECT * FROM  defect_list ");
                                $qur = mysqli_query($db, $query);
                                while ($rowc = mysqli_fetch_array($qur)) {
                                    ?>
                                    <tr>
                                        <td><input type="checkbox" id="delete_check[]" name="delete_check[]" value="<?php echo $rowc["defect_list_id"]; ?>"></td>
                                        <td><?php echo ++$counter; ?></td>
                                        <td>
                                            <a href="defect_list_page.php?id=<?php echo  $rowc['defect_list_id']; ?>" class="btn btn-primary" data-id="<?php echo $rowc['defect_list_id']; ?>">
                                                <i>
                                                    <svg class="table-edit" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-.45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z"></path></svg>
                                                </i>
                                            </a>
                                        </td>
                                        <td><?php echo $rowc["defect_list_name"]; ?></td>
                                        <?php
                                        $part_fam_nm = '';
                                        $pm_part_number_id = $rowc['part_number_id'];
                                        $arr_pm_part_number_ids = null;
                                        $arr_pm_part_number_ids = explode(',', $pm_part_number_id);
                                        array_pop($arr_pm_part_number_ids);
                                        $i=0;
                                        $count = sizeof($arr_pm_part_number_ids);
                                        $array_pnum = null;
                                        foreach ($arr_pm_part_number_ids as $arr_pm_part_number_id) {
                                            if($i==0){
                                                $array_pnum .= "'" .$arr_pm_part_number_id . "'";
                                            }else{
                                                $array_pnum .= "," . "'" .$arr_pm_part_number_id . "'";
                                            }
                                            $i++;

                                        }
                                        $sql22 = "SELECT * FROM  pm_part_number where pm_part_number_id in ($array_pnum) order by part_name ASC";
                                        //                                                $qurtemp = $mysqli->query($sql22);
                                        $qurtemp = mysqli_query($db,$sql22);
                                        $i=0;
                                        $part_nm=null;
                                        while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                                            $part_nm .= $rowctemp["part_name"] . ' ,  ';
                                        }
                                        $part_nm = rtrim($part_nm,' ,  ');
                                        ?>
                                        <td><?php echo $part_nm; ?></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
    </div>

    <script>
        // $("#edit_part_number").select2({
        //     dropdownParent: $("#edit_modal_theme_primary")
        // });
        $(document).on('click', '#delete', function () {
            var element = $(this);
            var del_id = element.attr("data-id");
            var info = 'id=' + del_id;
            $.ajax({type: "POST", url: "ajax_job_title_delete.php", data: info, success: function (data) { }});
            $(this).parents("tr").animate({backgroundColor: "#003"}, "slow").animate({opacity: "hide"}, "slow");
        });</script>
    <script>

        $("#checkAll").click(function () {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        $(".select").select2();
        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
        function submitForm(url) {

            $(':input[type="button"]').prop('disabled', true);
            var data = $("#delete_form").serialize();
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

        function submitForm11(url) {
            $(':input[type="button"]').prop('disabled', true);
            var data = $("#delete_form").serialize();
            $.ajax({
                type: 'POST',
                url: url,
                data: data,
                success: function (data) {
                    // window.location.href = window.location.href + "?aa=Line 1";
                    $(':input[type="button"]').prop('disabled', false);
                    location.reload();
                }
            });
        }



        function submitForm_create(url) {

            $(':input[type="button"]').prop('disabled', true);
            var data = $("#create_form").serialize();
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

<!-- /content area -->

<!-- /page container -->
<script>
    window.onload = function() {
        history.replaceState("", "", "<?php echo $scriptName; ?>config_module/defect_list.php");
    }
</script>
<?php include('../footer1.php') ?>
</body>
