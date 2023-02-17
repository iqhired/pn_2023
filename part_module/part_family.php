<?php
include("../config.php");
//include("../sup_config.php");
$chicagotime = date("Y-m-d H:i:s");
$temp = "";
checkSession();
$assign_by = $_SESSION["id"];

if (count($_POST) > 0) {
    $name = $_POST['name'];
    $priority_order = $_POST['priority_order'];
//create
    if ($name != "") {
        $name = $_POST['name'];
        $station = $_POST['station'];
        $notes = $_POST['notes'];
        $sql0 = "INSERT INTO `pm_part_family`(`part_family_name`, `station`,`notes`,`created_by`) VALUES ('$name', '$station','$notes','$assign_by')";
        $result0 = mysqli_query($db, $sql0);
        if ($result0) {
            $message_stauts_class = 'alert-success';
            $import_status_message = 'Part Family Created successfully.';
        } else {
            $message_stauts_class = 'alert-danger';
            $import_status_message = 'Error: Please Insert valid data';
        }
    }
//edit
    $edit_name = $_POST['edit_name'];
    if ($edit_name != "") {
        $id = $_POST['edit_id'];
        $sql = "update pm_part_family set part_family_name ='$_POST[edit_name]' , station ='$_POST[edit_station]' , notes ='$_POST[edit_notes]' where pm_part_family_id ='$id'";
        $result1 = mysqli_query($db, $sql);
        if ($result1) {
            $message_stauts_class = 'alert-success';
            $import_status_message = 'Part Family Updated successfully.';
        } else {
            $message_stauts_class = 'alert-danger';
            $import_status_message = 'Error: Please Insert valid data';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo $sitename; ?> |Part Family</title>
    <!-- Global stylesheets -->

    <link href="../assets/css/core.css" rel="stylesheet" type="text/css">


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
        .col-md-1\.5 {
            width: 12%;
        }
        .col-md-0\.5 {
            width: 4%;
        }
        .card-title {
            margin-bottom: 0;
            margin-left: 15px;
        }
        @media (min-width: 482px) and (max-width: 767px)
            .main-content.horizontal-content {
                margin-top: 0px;
            }


    </style>
</head>


<!-- Main navbar -->
<body class="ltr main-body app horizontal">

<?php
$cust_cam_page_header = "Part Family";
include("../header.php");
include("../admin_menu.php");
?>

<!-----main content----->
<div class="main-content app-content">
    <div class="main-container container">

    <!---container--->
    <!---breadcrumb--->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Parts</a></li>
                <li class="breadcrumb-item active" aria-current="page">Part Family</li>
            </ol>
        </div>
    </div>


    <form action="" id="user_form" class="form-horizontal" method="post">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">PART FAMILY</span>
                        </div>

                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-1.5">
                                    <label class="form-label mg-b-0">Name</label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Part Family" required>
                                </div>


                                <div class="col-md-1"></div>
                                <div class="col-md-1.5">
                                    <label class="form-label mg-b-0">Station</label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <select class="form-control select2" name="station" id="station" >
                                        <option value="" selected disabled></option>
                                        <?php
                                        $sql1 = "SELECT * FROM `cam_line` ORDER BY `line_name` ASC";
                                        $result1 = $mysqli->query($sql1);
                                        //                                            $entry = 'selected';
                                        while ($row1 = $result1->fetch_assoc()) {
                                            echo "<option value='" . $row1['line_id'] . "'  >" . $row1['line_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>




                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-1.5">
                                    <label class="form-label mg-b-0">Image</label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>


                                <div class="col-md-1"></div>
                                <div class="col-md-1.5">
                                    <label class="form-label mg-b-0">Notes</label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                     <textarea id="notes" name="notes" rows="4" placeholder="Enter Notes..."
                                               class="form-control"></textarea>
                                </div>
                            </div>
                        </div>


                        <div class="card-body pt-0">
                            <button type="submit" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5 submit_btn">ADD</button>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
<form action="delete_part_family.php" method="post" class="form-horizontal">
    <div class="row-body">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <h4 class="card-title">
                            <button type="submit" class="btn btn-danger" onclick="submitForm('delete_part_number.php')">
                                <i>
                                    <svg class="table-delete" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9zm7.5-5l-1-1h-5l-1 1H5v2h14V4h-3.5z"></path></svg>
                                </i>
                            </button>
                        </h4>
                    <div class="col-md-3">
                        <select class="form-control select2" name="choose" id="choose" data-placeholder="Select Action" required>
                            <option value="" disabled selected>Select Action</option>
                            <option value="1">Add to Station</option>
                        </select>
                    </div>
                    <div class="col-md-2 group_div" style="display:none">
                        <select class="form-control select2" name="accnt"  id="accnt"  required>
                            <option value="" disabled selected>Select Account </option>
                            <?php
                            $sql1 = "SELECT * FROM  cus_account ORDER BY `c_name` ASC";
                            $result1 = $mysqli->query($sql1);
                            //                                            $entry = 'selected';
                            while ($row1 = $result1->fetch_assoc()) {
                                echo "<option value='" . $row1['c_id'] . "'  >" . $row1['c_name'] . "</option>";
                            }
                            ?>

                        </select>
                    </div>
                    <div class="col-md-1">
                        <button type="button" class="btn btn-primary"  onclick="submitForm11('part_number_option_backend.php')"  style="background-color:#1e73be;">Go</button>
                    </div>
                </div>
                </div>

                <div class="card-body pt-0 example1-table">
                    <div class="table-responsive">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">

                                    <table class="table datatable-basic table-bordered text-nowrap mb-0" id="example2">
                                        <thead>
                                        <tr>
                                            <th><label class="ckbox"><input type="checkbox" id="checkAll"><span></span></label></th>
                                            <th>Sl. No</th>
                                            <th>Action</th>
                                            <th>Name</th>
                                            <th>Station</th>
                                            <th>Notes</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $query = sprintf("SELECT * FROM  pm_part_family where is_deleted = 0");
                                        $qur = mysqli_query($db, $query);
                                        while ($rowc = mysqli_fetch_array($qur)) {
                                            ?>
                                            <tr>
                                                <td><label class="ckbox"><input type="checkbox" id="delete_check[]" name="delete_check[]"
                                                                                value="<?php echo $rowc["pm_part_family_id"]; ?>"><span></span></label></td>
                                                <td><?php echo ++$counter; ?></td>

                                                <td>
                                                    <button type="button" id="edit" class="btn btn-primary btn-xs"
                                                            data-id="<?php echo $rowc['pm_part_family_id']; ?>"
                                                            data-name="<?php echo $rowc['part_family_name']; ?>"
                                                            data-station="<?php echo $rowc['station']; ?>"
                                                            data-notes="<?php echo $rowc['notes']; ?>" data-toggle="modal"
                                                            style=""
                                                            data-target="#edit_modal_theme_primary"><i class="fa fa-edit"></i>
                                                    </button>
                                                    <!--   &nbsp; <button type="button" id="delete" class="btn btn-danger btn-xs" data-id="<?php echo $rowc['position_id']; ?>">Delete </button>
                                                    -->
                                                </td>
                                                <td><?php echo $rowc["part_family_name"]; ?></td>
                                                <?php
                                                $station1 = $rowc['station'];
                                                $qurtemp = mysqli_query($db, "SELECT * FROM  cam_line where line_id  = '$station1' ");
                                                while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                                                    $station = $rowctemp["line_name"];
                                                }
                                                ?>
                                                <td><?php echo $station; ?></td>

                                                <td><?php echo $rowc["notes"]; ?></td>

                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

</form>

<!-- edit modal -->

<div id="edit_modal_theme_primary" class="modal col-lg-12 col-md-12">
    <div class="modal-dialog" style="width:100%">
        <div class="modal-content">

            <div class="card-header">
                <button type="button" style="color: white;font-size: 1.9125rem;" class="close" data-dismiss="modal">&times;</button>
                <span class="main-content-title mg-b-0 mg-b-lg-1">Update Part Family</span>
            </div>



            <form action="" id="user_form" enctype="multipart/form-data" class="form-horizontal"
                  method="post">
                <div class="card-body" style="">
                    <div class="col-lg-12 col-md-12">

                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">

                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Name:</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <input type="text" name="edit_name" id="edit_name" class="form-control" required>
                                    <input type="hidden" name="edit_id" id="edit_id">
                                </div>
                            </div>

                        </div>


                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">

                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Station</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <select name="edit_station" id="edit_station" class="form-control">
                                        <option value="" selected disabled>--- Select Station ---</option>
                                        <?php
                                        $sql1 = "SELECT * FROM `cam_line` ORDER BY `line_name` ASC";
                                        $result1 = $mysqli->query($sql1);
                                        //                                            $entry = 'selected';
                                        while ($row1 = $result1->fetch_assoc()) {
                                            echo "<option value='" . $row1['line_id'] . "'  >" . $row1['line_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                        </div>


                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">

                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">File</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <input type="file" name="edit_file" id="edit_file" class="form-control">
                                </div>
                            </div>

                        </div>


                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">

                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Notes</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                     <textarea id="edit_notes" name="edit_notes" rows="4"
                                               placeholder="Enter Notes..." class=" form-control"></textarea>
                                </div>
                            </div>

                        </div>


                        <div class="modal-footer">
                            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">SAVE</button>
                        </div>
            </form>
        </div>
    </div>

</div>
</div>
</div>
<script> $(document).on('click', '#delete', function () {
        var element = $(this);
        var del_id = element.attr("data-id");
        var info = 'id=' + del_id;
        $.ajax({
            type: "POST", url: "ajax_position_delete.php", data: info, success: function (data) {
            }
        });
        $(this).parents("tr").animate({backgroundColor: "#003"}, "slow").animate({opacity: "hide"}, "slow");
    });</script>
<script>
    jQuery(document).ready(function ($) {
        $(document).on('click', '#edit', function () {
            var element = $(this);
            var edit_id = element.attr("data-id");
            var name = $(this).data("name");
            var station = $(this).data("station");
            var notes = $(this).data("notes");
            $("#edit_name").val(name);
            $("#edit_station").val(station);
            $("#edit_notes").val(notes);
            $("#edit_id").val(edit_id);

            // Load Taskboard
            const sb1 = document.querySelector('#edit_station');
            var options1 = sb1.options;
            $('#edit_modal_theme_primary .select2 .selection select2-selection select2-selection--single .select2-selection__choice').remove();
            for (var i = 0; i < options1.length; i++) {
                if(station == (options1[i].value)){ // EDITED THIS LINE
                    options1[i].selected="selected";
                    options1[i].className = ("select2-results__option--highlighted");
                    var opt = options1[i].outerHTML.split(">");
                    $('#select2-results .select2-results__option').prop('selectedIndex',i);
                    var gg = '<span class="select2-selection__rendered" id="select2-edit_station-container" title="' + opt[1].replace('</option','') + '">' + opt[1].replace('</option','') + '</span>';
                    $("#select2-edit_station-container")[0].outerHTML = gg;
                }
            }
            //alert(role);
        });
    });
</script>
<script>
    window.onload = function () {
        history.replaceState("", "", "<?php echo $scriptName; ?>part_module/part_family.php");
    }
</script>
<script>
    $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
    function submitFormdelete(url) {
        $(':input[type="button"]').prop('disabled', true);
        var data = $("#delete-form").serialize();
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
    function submitFormgo(url) {
        $(':input[type="button"]').prop('disabled', true);
        var data = $("#delete-form").serialize();
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
    $('#choose').on('change', function () {
        var selected_val = this.value;
        if (selected_val == 1 || selected_val == 2) {
            $(".group_div").show();
        } else {
            $(".group_div").hide();
        }
    });
</script>
<?php include('../footer1.php') ?>
</body>
</html>


