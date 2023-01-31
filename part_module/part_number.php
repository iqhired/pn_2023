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
$assign_by = $_SESSION["id"];

if (count($_POST) > 0) {
    $name = $_POST['part_number'];
    $part_name = $_POST['part_name'];
    $customer_part_number = $_POST['customer_part_number'];
    $station = $_POST['station'];
    $part_family = $_POST['part_family'];
    $npr = $_POST['npr'];
    $through_put = $_POST['through_put'];
    $budget_scrape_rate = $_POST['budget_scrape_rate'];
    $net_weight = $_POST['net_weight'];
    $part_length = $_POST['part_length'];
    $length_range = $_POST['length_range'];
    $notes = $_POST['notes'];
    $color = $_POST['color_code'];
    $created_by = $_POST['created_by'];

    //create

    if ($name != "") {
        $name = $_POST['part_number'];

//logo
//            if (isset($_FILES['image'])) {
        if (isset($_FILES['image'])) {
            $errors = array();
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];
            $file_ext = strtolower(end(explode('.', $file_name)));
            $extensions = array("jpeg", "jpg", "png", "pdf");
            if (in_array($file_ext, $extensions) === false) {
                $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
                $message_stauts_class = 'alert-danger';
                $import_status_message = 'Error: Extension not allowed, please choose a JPEG or PNG file.';
            }
            if ($file_size > 2097152) {
                $errors[] = 'File size must be excately 2 MB';
                $message_stauts_class = 'alert-danger';
                $import_status_message = 'Error: File size must be less than 2 MB';
            }
            if (empty($errors) == true) {
                move_uploaded_file($file_tmp, "../assets/images/part_images/" . $name ."_".time().'_'. $file_name);
                $sql0 = "INSERT INTO `pm_part_number`(`part_images` ,`part_number` ,`part_name` , `customer_part_number`, `station` , `part_family` , `npr` , `through_put` , `budget_scrape_rate` , `net_weight` ,  `part_length`,`length_range`, `notes` ,`color_code`,`created_by`) VALUES ('$file_name','$name','$part_name','$customer_part_number','$station','$part_family','$npr','$through_put','$budget_scrape_rate','$net_weight','$part_length','$length_range','$notes','$color','$assign_by')";
            }
        }
        else
        {
            $sql0 = "INSERT INTO `pm_part_number`(`part_number` ,`part_name` , `customer_part_number`, `station` , `part_family` , `npr` , `through_put` , `budget_scrape_rate` , `net_weight` ,  `part_length`,`length_range`, `notes` ,`color_code`,`created_by`) VALUES ('$name','$part_name','$customer_part_number','$station','$part_family','$npr','$through_put','$budget_scrape_rate','$net_weight','$part_length','$length_range','$notes','$color','$assign_by')";
        }

//logo code over

        if(!isset($sql0)){
            $sql0 = "INSERT INTO `pm_part_number`(`part_number` ,`part_name` , `customer_part_number`, `station` , `part_family` , `npr` , `through_put` , `budget_scrape_rate` , `net_weight` ,  `part_length`,`length_range`, `notes` ,`color_code`,`created_by`) VALUES ('$name','$part_name','$customer_part_number','$station','$part_family','$npr','$through_put','$budget_scrape_rate','$net_weight','$part_length','$length_range','$notes','$color','$assign_by')";
        }
        $result0 = mysqli_query($db, $sql0);
        if ($result0) {
            $message_stauts_class = 'alert-success';
            $import_status_message = 'Part Number Created successfully.';
        } else {
            $message_stauts_class = 'alert-danger';
            $import_status_message = 'Error: Please Insert valid data';
        }
    }

    if ($name != "") {
        $name = $_POST['part_number'];
//logo
//            if (isset($_FILES['image'])) {
        if (isset($_FILES['cs_file'])) {
            $errors = array();
            $file_name = $_FILES['cs_file']['name'];
            $file_size = $_FILES['cs_file']['size'];
            $file_tmp = $_FILES['cs_file']['tmp_name'];
            $file_type = $_FILES['cs_file']['type'];
            $file_ext = strtolower(end(explode('.', $file_name)));
            $extensions = array("jpeg", "jpg", "png", "pdf","JPG","JPEG","PNG");
            if (in_array($file_ext, $extensions) === false) {
                $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
                $message_stauts_class = 'alert-danger';
                $import_status_message = 'Error: Extension not allowed, please choose a JPEG or PNG file.';
            }
            if ($file_size > 2097152) {
                $errors[] = 'File size must be excately 2 MB';
                $message_stauts_class = 'alert-danger';
                $import_status_message = 'Error: File size must be less than 2 MB';
            }
            if (empty($errors) == true) {
              //  gridify($file_tmp, "../assets/images/Cross_sec/" . $name ."_".time().'_'. $file_name);
                gridify("http://localhost/pn/assets/images/Cross_sec/E06263_Tesla_S_Inner_Trim_(P000955854).png", "testing");
            }
        }
        else
        {
            $sql0 = "INSERT INTO `pm_part_number`(`part_number` ,`part_name` , `customer_part_number`, `station` , `part_family` , `npr` , `through_put` , `budget_scrape_rate` , `net_weight` ,  `part_length`,`length_range`, `notes` ,`color_code`,`created_by`) VALUES ('$name','$part_name','$customer_part_number','$station','$part_family','$npr','$through_put','$budget_scrape_rate','$net_weight','$part_length','$length_range','$notes','$color','$assign_by')";
        }

//logo code over

        if(!isset($sql0)){
            $sql0 = "INSERT INTO `pm_part_number`(`part_number` ,`part_name` , `customer_part_number`, `station` , `part_family` , `npr` , `through_put` , `budget_scrape_rate` , `net_weight` ,  `part_length`,`length_range`, `notes` ,`color_code`,`created_by`) VALUES ('$name','$part_name','$customer_part_number','$station','$part_family','$npr','$through_put','$budget_scrape_rate','$net_weight','$part_length','$length_range','$notes','$color','$assign_by')";
        }
        $result0 = mysqli_query($db, $sql0);
        if ($result0) {
            $message_stauts_class = 'alert-success';
            $import_status_message = 'Part Number Created successfully.';
        } else {
            $message_stauts_class = 'alert-danger';
            $import_status_message = 'Error: Please Insert valid data';
        }
    }
    //edit
    $edit_name = $_POST['edit_name'];
    if ($edit_name != "") {
        $id = $_POST['edit_id'];
        $e_part_name = $_POST['edit_part_name'];
        $e_part_number = $_POST['edit_name'];
        $e_cpn = $_POST['edit_customer_part_number'];
        $e_station = $_POST['edit_station'];
        $e_pf = $_POST['edit_part_family'];
        $e_npr = $_POST['edit_npr'];
        $e_throughput = $_POST['edit_through_put'];
        $e_bsr = $_POST['edit_budget_scrape_rate'];
        $e_netweight = $_POST['edit_net_weight'];
        $e_part_length = $_POST['edit_part_length'];
        $e_length_range = $_POST['edit_length_range'];
        $e_notes = $_POST['edit_notes'];
        $e_color = $_POST['edit_color_code'];
        $sql = "update pm_part_number set part_number='$e_part_number',part_name='$e_part_name', customer_part_number='$e_cpn', station='$e_station', part_family='$e_pf', npr='$e_npr', through_put='$e_throughput',budget_scrape_rate='$e_bsr', net_weight='$e_netweight', part_length='$e_part_length',length_range='$e_length_range', notes='$e_notes',color_code='$e_color',created_by='$assign_by' where pm_part_number_id = '$id'";
        $result1 = mysqli_query($db, $sql);

        $query = sprintf("SELECT part_images FROM `pm_part_number` where pm_part_number_id = '$id'");
        $qur = mysqli_query($db, $query);
        $rowc = mysqli_fetch_array($qur);
        if(isset($qur)){
//			$part_images = mysqli_fetch_array($qur)[0];
            $p_ims = $rowc["part_images"];
            $part_images = explode(',', $rowc["part_images"]);
            $edit_pm_imgs = $p_ims;
        }

        if (isset($_FILES['edit_image'])) {
//		if (file_exists($_FILES['edit_image']) || is_uploaded_file($_FILES['edit_image'])) {
            $totalfiles = count($_FILES['edit_image']['name']);
            // Looping over all files
//            $edit_pm_imgs = $_POST['edit_pm_image'];
//            if(null != $edit_pm_imgs && '' != $edit_pm_imgs){
//				$edit_pm_imgs = trim($edit_pm_imgs, "Array,");
//				$sql0 = "update pm_part_number set part_images = '$edit_pm_imgs'   where pm_part_number_id = '$id'";
//				$result11 = mysqli_query($db, $sql0);
//            }else{
//					$sql0 = "update pm_part_number set part_images = ''   where pm_part_number_id = '$id'";
//					$result11 = mysqli_query($db, $sql0);
//			}
            if($totalfiles > 0 && $_FILES['edit_image']['name'][0] !='' && $_FILES['edit_image']['name'][0] != null){
//				$sql0 = "update pm_part_number set part_images = ''   where pm_part_number_id = '$id'";
//				$result11 = mysqli_query($db, $sql0);
                for($i=0;$i<$totalfiles;$i++){
                    $errors = array();
                    $file_name = $_FILES['edit_image']['name'][$i];
                    $file_size = $_FILES['edit_image']['size'][$i];
                    $file_tmp = $_FILES['edit_image']['tmp_name'][$i];
                    $file_type = $_FILES['edit_image']['type'][$i];
                    $file_ext = strtolower(end(explode('.', $file_name)));
                    $extensions = array("jpeg", "jpg", "png", "pdf");
                    if (in_array($file_ext, $extensions) === false) {
                        $errors[] = "extension not allowed, please choose a JPEG or PNG file.";
                        $message_stauts_class = 'alert-danger';
                        $import_status_message = 'Error: Extension not allowed, please choose a JPEG or PNG file.';
                    }
                    if ($file_size > 2097152) {
                        $errors[] = 'File size must be excately 2 MB';
                        $message_stauts_class = 'alert-danger';
                        $import_status_message = 'Error: File size must be less than 2 MB';
                    }
                    if (empty($errors) == true) {
                        $f_name = $e_part_number."_". time() ."_". $file_name;
                        move_uploaded_file($file_tmp, "../assets/images/part_images/" . $f_name);
//					$sql0 = "select part_images from pm_part_number where pm_part_number_id = '$id'";

                        $qurtemp = mysqli_query($db, "select part_images as pim from pm_part_number where pm_part_number_id = '$id'");
                        $pnum = ($qurtemp->fetch_assoc())['pim'];
                        if(isset($pnum)){
                            $part_img = $pnum . ',' . $f_name;
                            $sql0 = "update pm_part_number set part_images = '$part_img'   where pm_part_number_id = '$id'";
                            $result11 = mysqli_query($db, $sql0);
                        }else{
                            $sql0 = "update pm_part_number set part_images = '$f_name'  where pm_part_number_id = '$id'";
                            $result11 = mysqli_query($db, $sql0);
                        }


//				$sql0 = "INSERT INTO `pm_part_number`(`part_images` ,`part_number` ,`part_name` , `customer_part_number`, `station` , `part_family` , `npr` , `through_put` , `budget_scrape_rate` , `net_weight` ,  `part_length`,`length_range`, `notes` ,`created_by`) VALUES ('$file_name','$name','$part_name','$customer_part_number','$station','$part_family','$npr','$through_put','$budget_scrape_rate','$net_weight','$part_length','$length_range','$notes','$assign_by')";
                    }
// Upload files and store in database


                }
            }

        }
        if ($result1) {
            $message_stauts_class = 'alert-success';
            $import_status_message = 'Part Number Updated successfully.';
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
        <?php echo $sitename; ?> |Part Number</title>
    <!-- Global stylesheets -->

    <link href="../assets/css/core.css" rel="stylesheet" type="text/css">


    <!-- /global stylesheets -->
    <!-- Core JS files -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
        .row-body {
            display: flex;
            flex-wrap: wrap;
            margin-left: -8.75rem;
            margin-right: 6.25rem;
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


<body class="ltr main-body app horizontal">
<!-- main-content -->
<?php if (!empty($station)){
    include("../cell-menu.php");
}else{
    include("../header.php");
    include("../admin_menu.php");
}
?>
<div class="main-content app-content">
    <!-- container -->
    <div class="main-container container-fluid">
        <!-- breadcrumb -->
        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Parts</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Part Number</li>
                </ol>

            </div>

        </div>
        <form action="" id="user_form" class="form-horizontal" method="post">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header">
                                <span class="main-content-title mg-b-0 mg-b-lg-1">PART NUMBER</span>
                            </div>
                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs">
                                    <div class="col-md-1.5">
                                        <label class="form-label mg-b-0">Part Number</label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <input type="text" name="part_number" id="part_number" class="form-control"
                                               placeholder="Enter Part Number" required>
                                    </div>
                                    <div class="col-md-0.5"></div>
                                    <div class="col-md-1.5">
                                        <label class="form-label mg-b-0">Part Name</label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <input type="text" name="part_name" id="part_name"
                                               class="form-control" placeholder="Enter Part Name"
                                               required>
                                    </div>

                                </div>
                            </div>
                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs">
                                    <div class="col-md-1.5">
                                        <label class="form-label mg-b-0">CPN </label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <input type="text" name="customer_part_number" id="customer_part_number"
                                               class="form-control" placeholder="Enter Customer Part Number">
                                    </div>
                                    <div class="col-md-0.5"></div>
                                    <div class="col-md-1.5">
                                        <label class="form-label mg-b-0">Part Family</label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <select name="part_family" id="part_family" class="form-control form-select select2"
                                                data-style="bg-slate">
                                            <option value="" selected disabled>--- Select Part Family ---</option>
                                            <?php
                                            $sql1 = "SELECT * FROM `pm_part_family` where is_deleted = 0 ORDER BY `part_family_name` ASC";
                                            $result1 = $mysqli->query($sql1);
                                            //                                            $entry = 'selected';
                                            while ($row1 = $result1->fetch_assoc()) {
                                                echo "<option value='" . $row1['pm_part_family_id'] . "'  >" . $row1['part_family_name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>

                                </div>

                            </div>
                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs">
                                    <div class="col-md-1.5">
                                        <label class="form-label mg-b-0">Station </label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <select name="station" id="station" class="form-control form-select select2" data-style="bg-slate">
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
                                    <div class="col-md-0.5"></div>
                                    <div class="col-md-1.5">
                                        <label class="form-label mg-b-0">NPR/hr</label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <input type="text" name="npr" id="npr" class="form-control"
                                               placeholder="Enter NPR" >
                                    </div>

                                </div>

                            </div>
                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs">
                                    <div class="col-md-1.5">
                                        <label class="form-label mg-b-0">Throughput </label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <input type="text" name="through_put" id="through_put"
                                               placeholder="Enter Throughput" class="form-control">
                                    </div>
                                    <div class="col-md-0.5"></div>
                                    <div class="col-md-1.5">
                                        <label class="form-label mg-b-0">BSR ( % )</label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <input type="text" name="budget_scrape_rate" id="budget_scrape_rate"
                                               class="form-control" placeholder="Enter Budget Scrape Rate" >
                                    </div>

                                </div>

                            </div>
                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs">
                                    <div class="col-md-1.5">
                                        <label class="form-label mg-b-0">Net Weight ( kg ) </label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <input type="text" name="net_weight" id="net_weight" class="form-control"
                                               placeholder="Enter Net Weight" >
                                    </div>
                                    <div class="col-md-0.5"></div>
                                    <div class="col-md-1.5">
                                        <label class="form-label mg-b-0">Length ( mm )</label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <input type="text" name="part_length" id="part_length" class="form-control"
                                               placeholder="Enter Length">
                                    </div>

                                </div>

                            </div>
                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs">
                                    <div class="col-md-1.5">
                                        <label class="form-label mg-b-0">Notes </label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                  <textarea id="notes" name="notes" rows="1" placeholder="Enter Notes..."
                                            class="form-control"></textarea>
                                    </div>
                                    <div class="col-md-0.5"></div>
                                    <div class="col-md-1.5">
                                        <label class="form-label mg-b-0">Select Color Code</label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <input type="color" id="color_code" name="color_code" value="#0000"  required>
                                    </div>

                                </div>

                            </div>
                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs">
                                    <div class="col-md-1.5">
                                        <label class="form-label mg-b-0">File </label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <input type="file" name="image" id="image" class="form-control" multiple="multiple">
                                    </div>
                                    <div class="col-md-0.5"></div>
                                    <div class="col-md-1.5">
                                        <label class="form-label mg-b-0">Cross Section File</label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <input type="file" name="cs_file" id="cs_file" class="form-control">
                                    </div>

                                </div>

                            </div>
                            <div class="card-body pt-0">
                                <button type="submit" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5 submit_btn">Add</button>
                                <button type="clear" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <!-- row  -->
        <form action="" id="update-form" method="post" class="form-horizontal">
            <div class="row">
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
                                    <select class="select form-control" name="station" id="station"   required>
                                        <option value="" disabled selected>Select Station</option>
                                        <?php
                                        $sql1 = "SELECT * FROM `cam_line` ORDER BY `line_name` ASC ";
                                        $result1 = $mysqli->query($sql1);
                                        while ($row1 = $result1->fetch_assoc()) {
                                            echo "<option value='" . $row1['line_id'] . "'$entry>" . $row1['line_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-1">
                                    <button type="button" class="btn btn-primary"  onclick="submitForm11('part_number_option_backend.php')"  style="background-color:#1e73be;">Go</button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table  table-bordered text-nowrap mb-0" id="example2">
                                    <thead>
                                    <tr>
                                        <th>
                                            <label class="ckbox"> <input type="checkbox" id="checkAll"><span></span></label>
                                        </th>
                                        <th class="text-center">Sl. No</th>
                                        <th>Action</th>
                                        <th>Part Number</th>
                                        <th>Part Name</th>
                                        <th>Station</th>
                                        <th>Part Family</th>
                                        <th>Color</th>

                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $query = sprintf("SELECT * FROM  pm_part_number where is_deleted = 0;  ");
                                    $qur = mysqli_query($db, $query);
                                    while ($rowc = mysqli_fetch_array($qur)) {
                                        ?>
                                        <tr>
                                            <td><label class="ckbox"><input type="checkbox" id="delete_check[]" name="delete_check[]"
                                                                            value="<?php echo $rowc["pm_part_number_id"]; ?>"><span></span></label></td>
                                            <td class="text-center"><?php echo ++$counter; ?></td>
                                            <td class="">
                                                <button type="button" id="edit" class="btn btn-success btn-sm br-5 me-2"
                                                        data-id="<?php echo $rowc['pm_part_number_id']; ?>"
                                                        data-name="<?php echo $rowc['part_number']; ?>"
                                                        data-part_name="<?php echo $rowc['part_name']; ?>"
                                                        data-customer_part_number="<?php echo $rowc['customer_part_number']; ?>"
                                                        data-station="<?php echo $rowc['station']; ?>"
                                                        data-part_family="<?php echo $rowc['part_family']; ?>"
                                                        data-npr="<?php echo $rowc['npr']; ?>"
                                                        data-through_put="<?php echo $rowc['through_put']; ?>"
                                                        data-budget_scrape_rate="<?php echo $rowc['budget_scrape_rate']; ?>"
                                                        data-net_weight="<?php echo $rowc['net_weight']; ?>"
                                                        data-part_length="<?php echo $rowc['part_length']; ?>"
                                                        data-length_range="<?php echo $rowc['length_range']; ?>"
                                                        data-color_code="<?php echo $rowc['color_code']; ?>"
                                                        data-part_images="<?php
                                                        if(substr($rowc['part_images'] , 0 , 1)=== ","){
                                                            $str = ltrim($rowc['part_images'], ',');
                                                            echo $str;
                                                        }else{
                                                            echo $rowc['part_images'];
                                                        }
                                                        ?>"
                                                        data-pm_image="<?php
                                                        if(substr($rowc['part_images'] , 0 , 1)=== ","){
                                                            $str = ltrim($rowc['part_images'], ',');
                                                            echo $str;
                                                        }else{
                                                            echo $rowc['part_images'];
                                                        }
                                                        ?>"
                                                        data-notes="<?php echo $rowc['notes']; ?>" data-toggle="modal"
                                                        data-target="#edit_modal_theme_primary">   <i>
                                                        <svg class="table-edit" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-.45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z"></path></svg>
                                                    </i>
                                                </button>
                                            </td>
                                            <td><?php echo $rowc["part_number"]; ?></td>
                                            <td><?php echo $rowc["part_name"]; ?></td>
                                            <?php
                                            $station1 = $rowc['station'];
                                            $qurtemp = mysqli_query($db, "SELECT * FROM  cam_line where line_id  = '$station1' ");
                                            while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                                                $station = $rowctemp["line_name"];
                                            }
                                            ?>
                                            <td><?php echo $station; ?></td>
                                            <?php
                                            $part_family = $rowc['part_family'];
                                            $qurtemp = mysqli_query($db, "SELECT * FROM  pm_part_family where pm_part_family_id  = '$part_family' ");
                                            while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                                                $part_family1 = $rowctemp["part_family_name"];
                                            }
                                            ?>
                                            <td><?php echo $part_family1; ?></td>
                                            <td><input type="color" id="color_code" name="color_code" value="<?php echo $rowc["color_code"]; ?>"  disabled></td>
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

        <!-- edit modal -->
        <div id="edit_modal_theme_primary" class="modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h6 class="modal-title">
                            Update Part Details
                        </h6>
                    </div>
                    <form action="" id="user_form" enctype="multipart/form-data" class="form-horizontal"
                          method="post">
                        <div class="modal-body">

                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="pd-30 pd-sm-20">
                                                <div class="row row-xs">
                                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                                        <label class="form-label mg-b-0">Part Number</label>
                                                    </div>
                                                    <div class="col-md-8 mg-t-10 mg-md-t-0">
                                                        <input type="text" name="edit_name" id="edit_name" class="form-control"
                                                               required>
                                                        <input type="hidden" name="edit_id" id="edit_id">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pd-30 pd-sm-20">
                                                <div class="row row-xs">
                                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                                        <label class="form-label mg-b-0">Part Name</label>
                                                    </div>
                                                    <div class="col-md-8 mg-t-10 mg-md-t-0">
                                                        <input type="text" name="edit_part_name" id="edit_part_name"
                                                               class="form-control"
                                                               required>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="pd-30 pd-sm-20">
                                                <div class="row row-xs">
                                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                                        <label class="form-label mg-b-0">CPN </label>
                                                    </div>
                                                    <div class="col-md-8 mg-t-10 mg-md-t-0">
                                                        <input type="text" name="edit_customer_part_number"
                                                               id="edit_customer_part_number" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="pd-30 pd-sm-20">
                                                    <div class="row row-xs">
                                                        <div class="col-md-4 mg-t-10 mg-md-t-0">
                                                            <label class="form-label mg-b-0">Part Family</label>
                                                        </div>
                                                        <div class="col-md-8 mg-t-10 mg-md-t-0">
                                                            <select name="edit_part_family" id="edit_part_family"
                                                                    class="form-control">
                                                                <option value="" selected disabled>--- Select Part Family ---
                                                                </option>
                                                                <?php
                                                                $sql1 = "SELECT * FROM `pm_part_family` ORDER BY `part_family_name` ASC ";
                                                                $result1 = $mysqli->query($sql1);
                                                                //                                            $entry = 'selected';
                                                                while ($row1 = $result1->fetch_assoc()) {
                                                                    echo "<option value='" . $row1['pm_part_family_id'] . "'  >" . $row1['part_family_name'] . "</option>";
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                            <div class="pd-30 pd-sm-20">
                                                <div class="row row-xs">
                                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                                        <label class="form-label mg-b-0">Station </label>
                                                    </div>
                                                    <div class="col-md-8 mg-t-10 mg-md-t-0">
                                                        <select name="edit_station" id="edit_station" class="form-control">
                                                            <option value="" selected disabled>--- Select Station ---</option>
                                                            <?php
                                                            $sql1 = "SELECT * FROM `cam_line` ORDER BY `line_name` ASC ";
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
                                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                                        <label class="form-label mg-b-0">NPR/hr</label>
                                                    </div>
                                                    <div class="col-md-8 mg-t-10 mg-md-t-0">
                                                        <input type="text" name="edit_npr" id="edit_npr" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pd-30 pd-sm-20">
                                                <div class="row row-xs">
                                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                                        <label class="form-label mg-b-0">Throughput </label>
                                                    </div>
                                                    <div class="col-md-8 mg-t-10 mg-md-t-0">
                                                        <input type="text" name="edit_through_put" id="edit_through_put"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pd-30 pd-sm-20">
                                                <div class="row row-xs">
                                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                                        <label class="form-label mg-b-0">BSR ( % )</label>
                                                    </div>
                                                    <div class="col-md-8 mg-t-10 mg-md-t-0">
                                                        <input type="text" name="edit_budget_scrape_rate"
                                                               id="edit_budget_scrape_rate" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pd-30 pd-sm-20">
                                                <div class="row row-xs">
                                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                                        <label class="form-label mg-b-0"> Net Weight ( kg ) </label>
                                                    </div>
                                                    <div class="col-md-8 mg-t-10 mg-md-t-0">
                                                        <input type="text" name="edit_net_weight" id="edit_net_weight"
                                                               class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pd-30 pd-sm-20">
                                                <div class="row row-xs">
                                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                                        <label class="form-label mg-b-0">Length ( mm )</label>
                                                    </div>
                                                    <div class="col-md-8 mg-t-10 mg-md-t-0">
                                                        <input type="text" name="edit_part_length" id="edit_part_length"
                                                               class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pd-30 pd-sm-20">
                                                <div class="row row-xs">
                                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                                        <label class="form-label mg-b-0">Notes </label>
                                                    </div>
                                                    <div class="col-md-8 mg-t-10 mg-md-t-0">
                                                          <textarea id="edit_notes" name="edit_notes" rows="4"
                                                           placeholder="Enter Notes..." class="form-control"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pd-30 pd-sm-20">
                                                <div class="row row-xs">
                                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                                        <label class="form-label mg-b-0">Select Color Code</label>
                                                    </div>
                                                    <div class="col-md-8 mg-t-10 mg-md-t-0">
                                                        <input type="color" id="edit_color_code" name="edit_color_code" value="<?php echo $color_code ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pd-30 pd-sm-20">
                                                <div class="row row-xs">
                                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                                        <label class="form-label mg-b-0">File </label>
                                                    </div>
                                                    <div class="col-md-8 mg-t-10 mg-md-t-0"  id="pnum_images">
                                                        <input type="text" hidden name="edit_pm_image" id="edit_pm_image">
                                                        <input type="file" name="edit_image[]" id="edit_image" class="form-control" data-ex-files="" multiple="multiple">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="pd-30 pd-sm-20">
                                                <div class="row row-xs">
                                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                                        <label class="form-label mg-b-0">Cross Section File</label>
                                                    </div>
                                                    <div class="col-md-8 mg-t-10 mg-md-t-0">
                                                        <input type="file" name="cs_file" id="cs_file" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--Part Number-->

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /content area -->
<script>
    window.onload = function () {
        history.replaceState("", "", "<?php echo $scriptName; ?>part_module/part_number.php");
    }
</script>
<script>
    $(document).on('click', '#delete', function () {
        var element = $(this);
        var del_id = element.attr("data-id");
        var info = 'id=' + del_id;
        $.ajax({
            type: "POST", url: "ajax_delete.php", data: info, success: function (data) {
            }
        });
        $(this).parents("tr").animate({backgroundColor: "#003"}, "slow").animate({opacity: "hide"}, "slow");
    });
</script>
<script>
    jQuery(document).ready(function ($) {
        $(document).on('click', '#edit', function () {
            var element = $(this);
            var edit_id = element.attr("data-id");
            var name = $(this).data("name");
            var part_name = $(this).data("part_name");
            var customer_part_number = $(this).data("customer_part_number");
            var station = $(this).data("station");
            var part_family = $(this).data("part_family");
            var npr = $(this).data("npr");
            var through_put = $(this).data("through_put");
            var budget_scrape_rate = $(this).data("budget_scrape_rate");
            var net_weight = $(this).data("net_weight");
            var part_length = $(this).data("part_length");
            var length_range = $(this).data("length_range");
            var notes = $(this).data("notes");
            var color = $(this).data("color_code");
            var part_images = $(this).data("part_images");
            var image_path =  "./assets/images/part_images/"
            $("#edit_name").val(name);
            $("#edit_part_name").val(part_name);
            $("#edit_customer_part_number").val(customer_part_number);
            $("#edit_station").val(station);
            $("#edit_part_family").val(part_family);
            $("#edit_npr").val(npr);
            $("#edit_through_put").val(through_put);
            $("#edit_budget_scrape_rate").val(budget_scrape_rate);
            $("#edit_net_weight").val(net_weight);
            $("#edit_part_length").val(part_length);
            $("#edit_length_range").val(length_range);
            $("#edit_notes").val(notes);
            $("#edit_color_code").val(color);
            if(part_images !== null && part_images !== '') {
                $("#edit_p_image").attr("src","../assets/images/part_images/"+part_images);

            }

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

            // Load Part Family
            const sb2 = document.querySelector('#edit_part_family');
            var options1 = sb2.options;
            $('#edit_modal_theme_primary .select2 .selection select2-selection select2-selection--single .select2-selection__choice').remove();
            for (var i = 0; i < options1.length; i++) {
                if(part_family == (options1[i].value)){ // EDITED THIS LINE
                    options1[i].selected="selected";
                    options1[i].className = ("select2-results__option--highlighted");
                    var opt = options1[i].outerHTML.split(">");
                    $('#select2-results .select2-results__option').prop('selectedIndex',i);
                    var gg = '<span class="select2-selection__rendered" id="select2-edit_part_family-container" title="' + opt[1].replace('</option','') + '">' + opt[1].replace('</option','') + '</span>';
                    $("#select2-edit_part_family-container")[0].outerHTML = gg;
                }
            }
            $('.pip').remove();
            if(part_images !== null && part_images !== '') {
                var pm_files = part_images.split(",");
                for (var i = 0; i < pm_files.length; i++) {
                    $("<span class=\"pip\" id=\"" +i+"\" >" +
                        "<img style=\"height:150px;width:150px;\" name=\"edit_image[" +i+"]\" id=\"edit_image_" +i+"\" src=\"" + "../assets/images/part_images/"+ pm_files[i] + "\"/>" +
                        "<br/><span class=\"remove\">Remove image</span>" +
                        "</span>").insertAfter("#edit_image");

                }
                $(".remove").click(function(){
                    var index = $(this).parent(".pip")[0].id;
                    $(this).parent(".pip").remove();

                    pm_files.splice(index, 1);
                    var info = "images="+pm_files.toString()+"&id="+edit_id;
                    // $("#edit_pm_image").val(pm_files.toString());
                    $.ajax({
                        type: "POST", url: "delete_pnum_image.php", data: info, success: function (data) {
                        }
                    });
                });
            }
        });
    });
</script>
<script>
    $("#edit_image").on("change", function(e) {
        var files = e.target.files,
            filesLength = files.length;
        var tot = e.currentTarget.attributes.length;
        var ij = tot - filesLength + 1 ;
        var j =0 ;
        for (var i = ij ; i <= tot; i++) {
            var f = files[j];
            var fileReader = new FileReader();
            fileReader.onload = (function(e) {
                var file = e.target;
                $("<span class=\"pip\" id=\"" +(ij++)+"\" >" +
                    "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + f.name + "\"/>" +
                    "<br/><span class=\"remove\">Remove image</span>" +
                    "</span>").insertAfter("#edit_image");
                $(".remove").click(function(){
                    $(this).parent(".pip").remove();
                });

                // Old code here
                /*$("<img></img>", {
				  class: "imageThumb",
				  src: e.target.result,
				  title: file.name + " | Click to remove"
				}).insertAfter("#files").click(function(){$(this).remove();});*/

            });
            fileReader.readAsDataURL(f);

            // console.log(files);
            j++;
        }
        console.log(files);
    });
    $(".remove").click(function(){
        $(this).parent(".pip").remove();
    });
    $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
    $('#generate').click(function () {
        let r = Math.random().toString(36).substring(7);
        $('#newpass').val(r);
    })

    function submitForm(url) {
        $(':input[type="button"]').prop('disabled', true);
        var data = $("#update-form").serialize();
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

    function submitForm11(url) {
        $(':input[type="button"]').prop('disabled', true);
        var data = $("#update-form").serialize();
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

    function submitForm12(url) {
        $(':input[type="button"]').prop('disabled', true);
        var data = $("#update-form").serialize();
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
