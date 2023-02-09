<?php include("../config.php");
$chicagotime = date("Y-m-d H:i:s");
$temp = "";
checkSession();
$l_id = $_GET['id'];
if(!empty($l_id) && ($l_id > 0)){
    $dir_path = "../assets/label_files/" . $l_id;
    $output = file_get_contents($dir_path.'/'.'f1');
    $output_bad = file_get_contents($dir_path.'/'.'f2');
}
if (count($_POST) > 0) {
//edit
    $edit_name = $_POST['edit_name'];
    $id = $_POST['edit_id'];
    $dir_path = "../assets/label_files/" . $id;
    $content = $_POST['good_file'];
    $file = $dir_path.'/'.'f1' ; // cannot be an online resource
    $Saved_File = fopen($file, 'w');
    fwrite($Saved_File, $content);
    fclose($Saved_File);
    $file1 = $dir_path.'/'.'g_label';
    $g_label_file = fopen($file1,'w');
    fwrite($g_label_file, $content);
    fclose($g_label_file);
    $content_bad = $_POST['bad_file'];
    $file_bad = $dir_path.'/'.'f2' ; // cannot be an online resource
    $Saved_File_bad = fopen($file_bad, 'w');
    fwrite($Saved_File_bad, $content_bad);
    fclose($Saved_File_bad);
    $file_bad1 = $dir_path.'/'.'b_label' ; // cannot be an online resource
    $Saved_File_bad1 = fopen($file_bad1, 'w');
    fwrite($Saved_File_bad1, $content_bad);
    fclose($Saved_File_bad1);

    $output = file_get_contents($dir_path.'/'.'f1');
    $output_bad = file_get_contents($dir_path.'/'.'f2');

    $sql = "update cam_line set line_name='$_POST[edit_name]', priority_order='$_POST[edit_priority_order]' , enabled='$_POST[edit_enabled]'  where line_id='$id'";

    $result1 = mysqli_query($db, $sql);
    if ($result1) {
        $message_stauts_class = 'alert-success';
        $import_status_message = 'Station Updated successfully.';

    } else {
        $message_stauts_class = 'alert-danger';
        $import_status_message = 'Error: Please Insert valid data';
    }
    header('location: line.php');

    if (isset($_FILES['good_file']) && isset($_FILES['bad_file'])) {
        $errors = array();
        $good_name = $_FILES['good_file']['name'];
        $bad_name = $_FILES['bad_file']['name'];
//    $rework_name = $_FILES['rework_file'];
        $good_size = $_FILES['good_file']['size'];
        $bad_size = $_FILES['bad_file']['size'];
//    $rework_size = $_FILES['rework_file']['size'];
        $good_tmp = $_FILES['good_file']['tmp_name'];
        $good_tmp1 = $good_tmp;
        $bad_tmp = $_FILES['bad_file']['tmp_name'];
//    $rework_tmp = $_FILES['rework_file']['tmp_name'];
        $good_type = $_FILES['good_file']['type'];
        $bad_type = $_FILES['bad_file']['type'];
//    $rework_type = $_FILES['rework_file']['type'];


//    $good_ext = strtolower(end(explode('.', $good_name)));
//    $bad_ext = strtolower(end(explode('.', $bad_name)));
        $good_extensions = array("application/octet-stream","doc","docx");
        $bad_extensions = array("application/octet-stream","doc","docx");
//    $rework_extensions = array("doc","docx");
//    if (in_array($good_type, $good_extensions) == false && in_array($bad_type, $bad_extensions) == false ) {
//    $errors[] = "extension not allowed, please choose a doc file.";
//    $message_stauts_class = 'alert-danger';
//    $import_status_message = 'Error: Extension not allowed, please choose a doc file.';
//
//}
//    if ($good_size > 2097152 && $bad_size > 2097152 && $rework_size > 2097152) {
//        $errors[] = 'File size must be excately 2 MB';
//        $message_stauts_class = 'alert-danger';
//        $import_status_message = 'Error: File size must be less than 2 MB';
//    }
        if (empty($errors) == true) {
            $dir_path = "../assets/label_files/" . $_POST['edit_id'];
            if (file_exists($dir_path)) {
                $files = glob("$dir_path/*"); // get all file names
                foreach ($files as $file) { // iterate files
                    if (is_file($file)) {
                        unlink($file); // delete file
                    }
                }
            }else if (!file_exists($dir_path)) {
                mkdir($dir_path, 0777, true);
            }
            move_uploaded_file($good_tmp, $dir_path . '/' . 'g' . "_" . 'label');
            copy($dir_path . '/' . 'g' . "_" . 'label', $dir_path . '/' . 'f1');
//		move_uploaded_file($good_tmp1, $dir_path . '/' . 'f1');
            move_uploaded_file($bad_tmp, $dir_path . '/' . 'b' . "_" . 'label');
            copy($dir_path . '/' . 'b' . "_" . 'label', $dir_path . '/' . 'f2');

            $zpl_id = $_POST['label_line_id'];
            $sql1 = "update cam_line set zpl_file_status = '1',print_label = '1' where line_id ='$zpl_id'";
            $result1 = mysqli_query($db, $sql1);
            //    $sql0 = "INSERT INTO `cam_line`('logo',`line_name`,`priority_order` , `enabled` , `created_at`) VALUES (''$file_name','$name' , '$priority_order' , '$enabled', '$chicagotime')";
            $message_stauts_class = 'alert-success';
            $import_status_message = 'Station Updated successfully.';

//            $message_stauts_class = 'alert-success';
//			$import_status_message = 'Upload Files Successfully';
        }
    }
    header('location: line.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo $sitename; ?> |Edit Station</title>
    <!-- Global stylesheets -->
    <link href="../assets/css/core.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->
    <!-- Core JS files -->
    <!--    <script type="text/javascript" src="../assets/js/libs/jquery-3.6.0.min.js"> </script>-->
    <script src="<?php echo $siteURL; ?>assets/js/libs/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- Theme JS files -->
    <script type="text/javascript" src="../assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="../assets/js/core/libraries/jquery_ui/interactions.min.js"></script>
    <!--    <script type="text/javascript" src="../assets/js/plugins/forms/selects/select2.min.js"></script>-->
    <script type="text/javascript" src="../assets/js/pages/datatables_basic.js"></script>
    <!--    <script type="text/javascript" src="../assets/js/plugins/forms/selects/select2.min.js"></script>-->
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
    <!--    <script src="--><?php //echo $siteURL; ?><!--assets/js/form_js/select2.min.js"></script>-->
    <script type="text/javascript" src="../assets/js/plugins/forms/selects/bootstrap_select.min.js"></script>
    <script type="text/javascript" src="../assets/js/pages/form_bootstrap_select.js"></script>
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
        .breadcrumb-header {
            margin-left: 0;
        }
        @media (min-width: 320px) and (max-width: 480px) {
            .col-md-4 {
                width: 30%;
            }
            .col-md-8.mg-t-5.mg-md-t-0 {
                width: 70%;
            }
            .row-sm {
                margin-left: 26px;
                margin-right: 53px;
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
        }

        @media (min-width: 481px) and (max-width: 768px) {
            .col-md-4 {
                width: 30%;
            }
            .col-md-8.mg-t-5.mg-md-t-0 {
                width: 70%;
            }
            .row-sm {
                margin-left: 26px;
                margin-right: 53px;
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
        }

        @media (min-width: 769px) and (max-width: 1024px) {
            .col-md-4 {
                width: 30%;
            }
            .col-md-8.mg-t-5.mg-md-t-0 {
                width: 70%;
            }
            .row-sm {
                margin-left: 26px;
                margin-right: 53px;
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

        }
        @media (min-width: 482px) and (max-width: 767px) {
            .col-md-4 {
                width: 30%;
            }
            .col-md-8.mg-t-5.mg-md-t-0 {
                width: 70%;
            }
            .row-sm {
                margin-left: 26px;
                margin-right: 53px;
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

        }

    </style>
</head>
<!-- Main navbar -->
<?php
$cust_cam_page_header = " Edit Station Configuration Management";
include("../header.php");
include("../admin_menu.php");
?>

<body class="ltr main-body app sidebar-mini">
<!-- main-content -->
<div class="main-content app-content">
    <!-- container -->
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Admin config</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Station Configuration Management</li>
            </ol>
        </div>
    </div>
    <!-- /breadcrumb -->
    <!-- row -->
    <div class="row row-sm">
        <div class="col-lg-10 col-xl-10 col-md-12 col-sm-12">
            <?php
            if (!empty($import_status_message)) {
                echo '<div class="alert ' . $message_stauts_class . '">' . $import_status_message . '</div>';
            }
            displaySFMessage();
            ?>

        </div>
    </div>
    <form action="" id="" class="form-horizontal" method="post" enctype="multipart/form-data">
        <div class="row row-sm">
            <div class="col-lg-10 col-xl-10 col-md-12 col-sm-12">
                <div class="card  box-shadow-0">
                    <div class="card-header">
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Edit Station Configuration Management</span>
                    </div>
                    <div class="card-body pt-0">
                        <div class="pd-30 pd-sm-20">
                            <?php
                            $edit_id = $_GET['id'];
                            ?>
                            <?php
                            $sql1 = "SELECT * FROM `cam_line` where line_id = '$edit_id' ";
                            $result1 = $mysqli->query($sql1);
                            while ($row1 = $result1->fetch_assoc()) {
                                $line_id = $row1['line_id'];
                                $line_name = $row1['line_name'];
                                $p_order = $row1['priority_order'];
                                $enabled = $row1['enabled'];
                                $zpl_status = $row1['zpl_file_status'];
                                $print_label = $row1['print_label'];
                                $indivisual_label = $row1['indivisual_label'];
                            }
                            ?>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Station:* </label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input type="text" name="edit_name" id="edit_name" class="form-control" value="<?php echo $line_name; ?>" required>
                                    <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $edit_id; ?>">
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Priority Order:* </label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input type="number" name="edit_priority_order" id="edit_priority_order" class="form-control"
                                           value="<?php echo $p_order; ?>" required>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Enabled:* </label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <input type="hidden" name="edit_e" id="edit_e">
                                    <select name="edit_enabled" id="edit_enabled" class="form-control form-select select2" data-placeholder="Select Form Type">
                                        <?php if($enabled == 1){
                                            $selected = "selected";
                                            echo "<option value ='1'  $selected>Yes</option>
                                                   <option value='0'>No</option>";
                                        }
                                        elseif($enabled == 0){
                                            $selected = "selected";
                                            echo "<option value ='1'>Yes</option>
                                                      <option value ='0'$selected>No</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Print label Enabled:* </label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <label class="ckbox"><input type="checkbox" name="print_status" id="print_status" value="<?php echo $line_id; ?>" <?php echo ($print_label == 1 ? 'checked' : '');?>><span></span></label>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Print Individual label :* </label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <label class="ckbox"><input type="checkbox" name="p_label" id="p_label" value="<?php echo $line_id; ?>" <?php echo ($indivisual_label == 1 ? 'checked' : '');?>><span></span></label>
                                </div>
                            </div>
                            <?php if ($zpl_status == '1'){
                            if ($print_label == '1'){ ?>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Good Piece File : </label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <textarea rows="5" name="good_file" id="good_file" class="form-control" required><?php echo $output; ?></textarea>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Bad Piece File : </label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <textarea rows="5" name="bad_file" id="bad_file" class="form-control" required><?php echo $output_bad; ?></textarea>
                                </div>
                            </div>
                            <?php } else if ($print_label == '0') {  ?>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Good Piece File : </label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <textarea rows="5" name="good_file" id="good_file" class="form-control"><?php echo $output; ?></textarea>
                                </div>
                            </div>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Bad Piece File : </label>
                                </div>
                                <div class="col-md-8 mg-t-5 mg-md-t-0">
                                    <textarea rows="5" name="bad_file" id="bad_file" class="form-control"><?php echo $output_bad; ?></textarea>
                                </div>
                            </div>
                            <?php } }?>
                            <div class="row row-xs align-items-center mg-b-20">
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary">Save</button>
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
    window.onload = function() {
        history.replaceState("", "", "<?php echo $scriptName; ?>config_module/edit_line.php?id=<?php echo $edit_id;?>");

    }
</script>
<script>
    $("input#gbpd").click(function () {
        var isChecked = $(this)[0].checked;
        var val = $(this).val();
        var data_1 = "&gbpd=" + val+ "&isChecked=" + isChecked;
        $.ajax({
            type: 'POST',
            url: "GBPD_backend.php",
            data: data_1,
            success: function (response) {

            }
        });

    });

</script>
<script>
    $("input#print_status").click(function () {
        var element = $(this)[0].checked;
        var print_id = $(this).val();
        var info = '&print=' + print_id+"&isChecked=" + element;;
        $.ajax({
            type: "POST",
            url: "print_action.php",
            data: info,
            success: function (data) {

            }
        });

    });
</script>
<script>
    $("input#p_label").click(function () {
        var isChecked = $(this)[0].checked;
        var val = $(this).val();
        var data_1 = "&p_label=" + val+ "&isChecked=" + isChecked;
        $.ajax({
            type: 'POST',
            url: "print_label.php",
            data: data_1,
            success: function (response) {
            }
        });
    });
</script>
<?php include('../footer1.php') ?>
</body>