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
    $name = $_POST['name'];
    $stations1 = $_POST['stations'];
    foreach ($stations1 as $stations) {
        $array_stations .= $stations . ",";
    }
//create
    if ($name != "") {
        $name = $_POST['name'];
        $color_code = $_POST['color_code'];
        $event_cat = $_POST['event_cat'];
        $sql = "select (MAX(so) + 1) as next_seq_num from event_type";
        $res = mysqli_query($db, $sql);
        $seq = ($res ->fetch_assoc())['next_seq_num'];
//      $next_seq = ‌‌$seq['next_seq_num'];
        $sqlquery = "INSERT INTO `event_type`(`event_type_name`,`stations`,`event_cat_id`,`so`,`color_code`,`created_at`,`updated_at`) VALUES ('$name','$array_stations','$event_cat','$seq','$color_code','$chicagotime','$chicagotime')";
        if (!mysqli_query($db, $sqlquery)) {
            $message_stauts_class = 'alert-danger';
            $import_status_message = 'Error: Event Type with this Name Already Exists';
        } else {
            $temp = "one";
        }
    }
//edit
    $edit_name = $_POST['edit_name'];
    if ($edit_name != "") {
        $id = $_POST['edit_id'];
        $actual_so = $_POST['act_so'];
        $edit_so = $_POST['edit_so'];
        $edit_stations1 = $_POST['edit_stations'];
        foreach ($edit_stations1 as $edit_stations) {
            $array_stations .= $edit_stations . ",";
        }
        $edit_color_code = $_POST['edit_color_code'];
        $edit_event_cat = $_POST['edit_event_cat'];
        $set = '';
        $where = '';
        if( $edit_so != $actual_so){

            if( $actual_so < $edit_so ){
                $set = 'so = so - 1';
                $where = 'so > ' . $actual_so . ' and so <= ' . $edit_so;
            }else{
                $set = 'so = so + 1';
                $where = 'so < ' . $actual_so . ' and so >= ' . $edit_so;
            }
        }
        if($set != '' && $where != ''){
            $sql = 'update event_type set ' .  $set . ' where ' . $where;
            $result1 = mysqli_query($db, $sql);
        }
        $sql = "update event_type set stations = '$array_stations', so = '$edit_so' , event_cat_id='$edit_event_cat' ,event_type_name='$_POST[edit_name]',color_code='$_POST[edit_color_code]',updated_at='$chicagotime' where event_type_id ='$id'";
        $result1 = mysqli_query($db, $sql);
        if ($result1) {
            $temp = "two";
        } else {
            $message_stauts_class = 'alert-danger';
            $import_status_message = 'Error: Event Type with this Name Already Exists';
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
        <?php echo $sitename; ?> |Event Type</title>
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
$cust_cam_page_header = "Event Type";
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
                <li class="breadcrumb-item active" aria-current="page">Event Type</li>
            </ol>
        </div>
    </div>


    <form action="" id="user_form" class="form-horizontal" method="post">
        <div class="row-body">
            <div class="col-lg-12 col-md-12">
                <?php if ($temp == "one") { ?>
                    <div class="alert alert-success no-border">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                                    class="sr-only">Close</span></button>
                        <span class="text-semibold">Event Type</span> Created Successfully.
                    </div>
                <?php } ?>
                <?php if ($temp == "two") { ?>
                    <div class="alert alert-success no-border">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span><span
                                    class="sr-only">Close</span></button>
                        <span class="text-semibold">Event Type</span> Updated Successfully.
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

                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">Event Type</span>
                        </div>

                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Event Type</label>
                                </div>
                                <div class="col-md-3 mg-t-10 mg-md-t-0">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Event Type" required>
                                </div>

                                <div class="col-md-1"></div>
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Select Event Category </label>
                                </div>
                                <div class="col-md-3 mg-t-10 mg-md-t-0">
                                    <select name="event_cat" id="event_cat" class="form-control form-select select2" data-bs-placeholder="">
                                        <option value="" selected disabled>--- Select Event Category ---</option>
                                        <?php
                                        $sql1 = "SELECT * FROM `events_category` where is_deleted != 1";
                                        $result1 = $mysqli->query($sql1);
                                        while ($row1 = $result1->fetch_assoc()) {
                                            echo "<option value='" . $row1['events_cat_id'] . "'$entry>" . $row1['events_cat_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Station</label>
                                </div>
                                <div class="col-md-3 mg-t-10 mg-md-t-0">
                                    <select class="form-control select2" name="stations[]" id="stations[]" value="<?php echo $rowc["stations"]; ?>"  multiple="multiple">
                                        <?php
                                        $sql1 = "SELECT * FROM `cam_users` WHERE `assigned2` = '0'  and `users_id` != '1' order BY `firstname` ";
                                        $result1 = $mysqli->query($sql1);
                                        while ($row1 = $result1->fetch_assoc()) {

                                            echo "<option value='" . $row1['users_id'] . "' $selected>" . $row1['firstname'] . "&nbsp;" . $row1['lastname'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-1"></div>
                                <div class="col-md-2">
                                    <label class="form-label mg-b-0">Select Color Code</label>
                                </div>
                                <div class="col-md-1 mg-t-10 mg-md-t-0">
                                    <input type="color" class="form-control" name="color_code" id="color_code"  value="#ff0000" placeholder="Enter Description" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-1"></div>
                        <div class="col-md-1">
                            <button type="submit" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5 submit_btn">Create</button>
                        </div>
                    </div>
                </div>
    </form>
</div>
</div>

<form action="delete_event_type.php" method="post" class="form-horizontal">
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
                                            <th>Event Category</th>
                                            <th>Event Type</th>
                                            <th>Color Code</th>
                                            <th>Event Sequence </th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $query = sprintf("SELECT * FROM  event_type as et inner join events_category as ec on et.event_cat_id = ec.events_cat_id where et.is_deleted!='1' order by so ASC");
                                        $qur = mysqli_query($db, $query);
                                        $total_rows = $qur->num_rows;
                                        while ($rowc = mysqli_fetch_array($qur)) {
                                            $so = $rowc['so'];
                                            ?>
                                            <tr>
                                                <td><input type="checkbox" id="delete_check[]" name="delete_check[]"
                                                           value="<?php echo $rowc["event_type_id"] . '_' . $so ; ?>">
                                                    <input type="hidden"  id="del_check" name="del_check" value="<?php echo $so; ?>">
                                                    <!--                                    <input type="hidden" hidden name="del_sq[]" id="del_sq[]" value="--><?php //echo $so; ?><!--">-->
                                                </td>
                                                <td><?php echo ++$counter; ?></td>
                                                <td><?php echo $rowc["events_cat_name"]; ?></td>
                                                <td><?php echo $rowc["event_type_name"]; ?></td>
                                                <td><input type="color" id="color_code" name="color_code" value="<?php echo $rowc["color_code"]; ?>"  disabled></td>
                                                <td><?php echo $so; ?></td>
                                                <!--                                        <td>-->
                                                <?php //echo $rowc['updated_at']; ?><!--</td>-->
                                                <td>
                                                    <!--                                        <button type="button" id="edit" class="btn btn-info btn-xs"-->
                                                    <!--                                                data-id="--><?php //echo $rowc['event_type_id']; ?><!--"-->
                                                    <!--                                                data-name="--><?php //echo $rowc['event_type_name']; ?><!--"-->
                                                    <!--                                                data-event-cat="--><?php //echo $rowc['events_cat_id']; ?><!--"-->
                                                    <!--                                                data-color_code="--><?php //echo $rowc['color_code']; ?><!--"-->
                                                    <!--                                                data-so="--><?php //echo $rowc['so']; ?><!--"-->
                                                    <!--                                                data-stations="--><?php //echo $rowc['stations']; ?><!--"-->
                                                    <!--                                                data-count="--><?php //echo $total_rows; ?><!--" data-toggle="modal"-->
                                                    <!--                                                style="background-color:#1e73be;"-->
                                                    <!--                                                data-target="#edit_modal_theme_primary">Edit-->
                                                    <!--                                        </button>-->
                                                    <a href="event_type_page.php?id=<?php echo  $rowc['event_type_id']; ?>" class="btn btn-primary" data-id="<?php echo $rowc['event_type_name']; ?>"  style=""><i class="fa fa-edit"></i></a>

                                                </td>
                                            </tr>
                                        <?php } ?>



                                        </tbody>
                                    </table>
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
</div>
</div>
<script>
    window.onload = function () {
        history.replaceState("", "", "<?php echo $scriptName; ?>config_module/event_type.php");
    }
</script>
<script>
    $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
    function stations_open()
    {
        $("#stations").select2("open");
    }
    function edit_stations_open()
    {
        // $('.select2-search__field').style.visibility='show';
        // $("#edit_stations").select2("open");
        // $('.select2-container select2-container--default select2-container--open .select2-results .select2-results__option').addClass("select2-results__option--highlighted");

    }
</script>
<?php include('../footer.php') ?>
<!--------container------>

</body>
</html>



