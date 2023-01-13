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

//  header('location: ../logout.php');
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
if (count($_POST) > 0) {
    $teams1 = $_POST['teams'];
    $users1 = $_POST['users'];
    $m_type = $_POST['material_type'];
    $serial = $_POST['serial_status'];
    $material_type = count($_POST['material_type']);
    foreach ($teams1 as $teams) {
        $array_team .= $teams . ",";
    }
    foreach ($users1 as $users) {
        $array_user .= $users . ",";
    }
    if ($material_type > 1) {
        for ($i = 0; $i < $material_type; $i++) {
            if (trim($_POST['material_type'][$i]) != '') {
                if($serial == ""){
                    $sql = "INSERT INTO `material_config`(`teams`,`users`,`material_type`,`serial_num_required`,`created_at`) VALUES
    ('$array_team','$array_user','$m_type[$i]','0','$chicagotime')";
                }else{
                    $sql = "INSERT INTO `material_config`(`teams`,`users`,`material_type`,`serial_num_required`,`created_at`) VALUES
    ('$array_team','$array_user','$m_type[$i]','1','$chicagotime')";
                }
                $result1 = mysqli_query($db, $sql);
                if ($result1) {
                    $message_stauts_class = 'alert-success';
                    $import_status_message = 'Data Saved successfully.';
                } else {
                    $message_stauts_class = 'alert-danger';
                    $import_status_message = 'Error: Please Retry...';
                }
            }
        }
    } else {
        if($serial == ""){
            $sql = "INSERT INTO `material_config`(`teams`,`users`,`material_type`,`serial_num_required`,`created_at`) VALUES
    ('$array_team','$array_user','$m_type[0]','0','$chicagotime')";
        }else{
            $sql = "INSERT INTO `material_config`(`teams`,`users`,`material_type`,`serial_num_required`,`created_at`) VALUES
    ('$array_team','$array_user','$m_type[0]','1','$chicagotime')";
        }
        $result1 = mysqli_query($db, $sql);
        if ($result1) {
            $message_stauts_class = 'alert-success';
            $import_status_message = 'Data Saved successfully.';
        } else {
            $message_stauts_class = 'alert-danger';
            $import_status_message = 'Error: Please Retry...';
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
        <?php echo $sitename; ?> |Material Config</title>
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


<!-- Main navbar -->
<?php
$cust_cam_page_header = "Material Tracability Config";
include("../header.php");
include("../admin_menu.php");
?>

<!-----body-------->
<body class="ltr main-body app sidebar-mini">
<!-----main content----->
<div class="main-content app-content">
    <!---container--->
    <!---breadcrumb--->
    <div class="breadcrumb-header justify-content-between">
        <div class="left-content">
            <ol class="breadcrumb">
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Admin Config</a></li>
                <li class="breadcrumb-item active" aria-current="page">Material Tracability Config</li>
            </ol>
        </div>
    </div>

    <form action="" id="user_form" class="form-horizontal" method="post">
        <div class="row-body">
            <div class="col-lg-12 col-md-12">

                <?php
                if (!empty($import_status_message)) {
                    echo '<div class="alert ' . $message_stauts_class . '">' . $import_status_message . '</div> ';
                }
                ?>
                <?php
                if (!empty($_SESSION['import_status_message'])) {
                    echo '<div class="alert ' . $_SESSION['message_stauts_class'] . '">' . $_SESSION['import_status_message'] . '</div>';
                    $_SESSION['message_stauts_class'] = '';
                    $_SESSION['import_status_message'] = '';
                }
                ?>

                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">Material Traceability</span>
                        </div>

                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">To Teams :</label>
                                </div>
                                <div class="col-md-3 mg-t-10 mg-md-t-0">
                                    <select class="form-control select2" name="teams[]" id="teams" multiple="multiple">
                                        <?php
                                        $sql1 = "SELECT DISTINCT(`group_id`) FROM `sg_user_group`";
                                        $result1 = $mysqli->query($sql1);
                                        while ($row1 = $result1->fetch_assoc()) {

                                            $station1 = $row1['group_id'];
                                            $qurtemp = mysqli_query($db, "SELECT * FROM  sg_group where group_id = '$station1' ");
                                            $rowctemp = mysqli_fetch_array($qurtemp);
                                            $groupname = $rowctemp["group_name"];
                                            echo "<option value='" . $row1['group_id'] . "' $selected>" . $groupname . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>



                                <div class="col-md-1"></div>
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">To Users :</label>
                                </div>

                                <div class="col-md-3 mg-t-10 mg-md-t-0">
                                    <select class="form-control select2" name="users[]" id="users" multiple="multiple">
                                        <?php
                                        $sql1 = "SELECT * FROM `cam_users` WHERE `users_id` != '1' order BY `firstname` ";
                                        $result1 = $mysqli->query($sql1);
                                        while ($row1 = $result1->fetch_assoc()) {

                                            echo "<option value='" . $row1['users_id'] . "' $selected>" . $row1['firstname'] . "&nbsp;" . $row1['lastname'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Material Type</label>
                                </div>
                                <div class="col-md-3 mg-t-10 mg-md-t-0">
                                    <div id="inputFormRow">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" name="material_type[]" id="material_type" placeholder="Enter Material Type" required>
                                        </div>


                                        <div id="newRow"></div>
                                        <button id="addRow" type="button" class="btn btn-primary" style="background-color: #1e73be;"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                    </div>
                                </div>


                                <div class="col-md-1"></div>
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Is Serial Number Required:*</label>
                                </div>
                                <div class="col-md-1 mg-t-10 mg-md-t-0">
                                    <label class="ckbox"><input checked type="checkbox" name="serial_status" id="serial_status"><span></span></label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-1"></div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5 submit_btn">SAVE</button>
                        </div>
                    </div>
                </div>
    </form>
</div>
</div>



<form action="delete_material.php" method="post" class="form-horizontal">
    <div class="row-body">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <button type="submit" class="btn btn-danger  submit_btn" style=""><i class="fa fa-trash-o" style="font-size:20px"></i></button>
                </div>


                <div class="card-body pt-0 example1-table">
                    <div class="table-responsive">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table  table-bordered text-nowrap mb-0" id="example2">
                                        <thead>
                                        <tr>
                                            <th><label class="ckbox"><input type="checkbox" id="checkAll"><span></span></label></th>
                                            <th>Sl. No</th>
                                            <th>Material Teams</th>
                                            <th>Material Users</th>
                                            <th>Material Type</th>
                                            <th>Serial No Required</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $query = sprintf("SELECT * FROM  material_config");
                                        $qur = mysqli_query($db, $query);
                                        while ($rowc = mysqli_fetch_array($qur)) {
                                            ?>
                                            <tr>
                                                <td><input type="checkbox" id="delete_check[]" name="delete_check[]" value="<?php echo $rowc["material_id"]; ?>"></td>
                                                <td><?php echo ++$counter; ?></td>
                                                <td>
                                                    <?php
                                                    $material = $rowc['teams'];
                                                    $arr_material = explode(',', $material);

                                                    // glue them together with ', '
                                                    $materialStr = implode("', '", $arr_material);
                                                    $sql = "SELECT group_name FROM `sg_group` WHERE group_id IN ('$materialStr')";
                                                    $result1 = mysqli_query($db, $sql);
                                                    $line = '';
                                                    $i = 0;
                                                    while ($row =  $result1->fetch_assoc()) {
                                                        if($i == 0){
                                                            $line = $row['group_name'];
                                                        }else{
                                                            $line .= " , " . $row['group_name'];
                                                        }
                                                        $i++;
                                                    }
                                                    echo $line;
                                                    ?></td>
                                                <?php
                                                $nnm = $rowc["users"];
                                                $arr_nnm = explode(',', $nnm);
                                                $materialnnm = implode("', '", $arr_nnm);
                                                $query12 = sprintf("SELECT firstname,lastname FROM  cam_users where users_id IN ('$materialnnm')");

                                                $qur12 =  mysqli_query($db,$query12);
                                                $line1 = '';
                                                $j = 0;
                                                while($rowc12 =  $qur12->fetch_assoc()){
                                                    if($j == 0){
                                                        $firstnm = $rowc12["firstname"];
                                                        $lastnm = $rowc12["lastname"];
                                                        $fulllname = $firstnm." ".$lastnm;
                                                    }else{
                                                        $firstnm = $rowc12["firstname"];
                                                        $lastnm = $rowc12["lastname"];
                                                        $fulllname .= " , " . $firstnm." ".$lastnm;
                                                    }
                                                    $j++;
                                                }
                                                ?>
                                                <td><?php echo $fulllname;?></td>

                                                <td><?php echo $rowc["material_type"]; ?></td>
                                                <td>  <input type='checkbox' id="serial_number" value="<?php echo $rowc["serial_num_required"] ?>" <?php if( $rowc["serial_num_required"] == 1) {echo "checked";}?> style="pointer-events: none !important;"></td>
                                                <td>
                                                    <a href="edit_material_config.php?id=<?php echo $rowc['material_id']; ?>" class="btn btn-primary" data-material_teams="<?php echo  $material; ?>" style="background-color:#1e73be;"><i class="fa fa-edit"></i></a>

                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<script> $(document).on('click', '#delete', function () {
        var element = $(this);
        var del_id = element.attr("data-id");
        var info = 'id=' + del_id;
        $.ajax({type: "POST", url: "ajax_job_title_delete.php", data: info, success: function (data) { }});
        $(this).parents("tr").animate({backgroundColor: "#003"}, "slow").animate({opacity: "hide"}, "slow");
    });</script>
<script type="text/javascript">
    // add row
    $("#addRow").click(function () {
        var html = '';
        html += '<div id="inputFormRow">';
        html += '<div class="input-group mb-3">';
        html += '<input type="text" name="material_type[]" class="form-control m-input" placeholder="Enter Material Type" autocomplete="off">';
        html += '<div class="input-group-append">';
        html += '<button id="removeRow" type="button" class="btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></button>';
        html += '</div>';
        html += '</div>';

        $('#newRow').append(html);
    });

    // remove row
    $(document).on('click', '#removeRow', function () {
        $(this).closest('#inputFormRow').remove();
    });
</script>
<script type="text/javascript">
    // add row
    $("#addRow1").click(function () {
        var html = '';
        html += '<div id="inputFormRow1">';
        html += '<div class="input-group mb-3">';
        html += '<input type="text" name="material_type[]" class="form-control m-input" placeholder="Enter Material Type" autocomplete="off">';
        html += '<div class="input-group-append">';
        html += '<button id="removeRow1" type="button" class="btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></button>';
        html += '</div>';
        html += '</div>';

        $('#newRow1').append(html);
    });

    // remove row
    $(document).on('click', '#removeRow1', function () {
        $(this).closest('#inputFormRow1').remove();
    });
</script>
<script type="text/javascript">
    // add row
    $("#addRow2").click(function () {
        var html = '';
        html += '<div id="inputFormRow2">';
        html += '<div class="input-group mb-3">';
        html += '<input type="text" name="material_type[]" class="form-control m-input" placeholder="Enter Material Type" autocomplete="off">';
        html += '<div class="input-group-append">';
        html += '<button id="removeRow2" type="button" class="btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></button>';
        html += '</div>';
        html += '</div>';

        $('#newRow1').append(html);
    });

    // remove row
    $(document).on('click', '#removeRow2', function () {
        $(this).closest('#inputFormRow2').remove();
    });
</script>
<script>
    $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
    function group1()
    {
        $("#teams").select2("open");
    }
    function group2()
    {
        $("#users").select2("open");
    }
</script>



<!---container--->

<?php include('../footer1.php') ?>
</body>
</html>



