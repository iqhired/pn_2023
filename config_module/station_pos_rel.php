<?php
include("../config.php");
$temp = "";
$chicagotime = date("Y-m-d H:i:s");
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

if (count($_POST) > 0) {
    $name = $_POST['position_name'];
    $description = $_POST['description'];
//create
    if ($name != "") {
        $position_name = $_POST['position_name'];
        $line_name = $_POST['line_name'];
        $query01 = sprintf("SELECT * FROM `cam_station_pos_rel` WHERE `position_id` = '$position_name' AND `line_id` = '$line_name'; ");
        $qur01 = mysqli_query($db, $query01);
        $rowc01 = mysqli_fetch_array($qur01);
        $po_1 = $rowc01["position_id"];
        $li_1 = $rowc01["line_id"];
        if ($po_1 == $position_name && $li_1 == $line_name) {
            $message_stauts_class = 'alert-danger';
            $import_status_message = 'Error: Data Relation already Exist...';
        } else {
            $cc = $_POST['cc'];
            $to = $_POST['to'];
            $message = $_POST['message'];
            $ratings = $_POST['ratings'];
            $signature = $_POST['signature'];
            $priority_order = $_POST['priority_order'];
//mysqli_query($db, "INSERT INTO `data`(`position_name`,`line_name`,`email_from`,`email_to`,`email_msg`,`ratings`) VALUES ('$position_name','$line_name' ,'$from','$to','$message','$ratings' )");
            $sql0 = "INSERT INTO `cam_station_pos_rel`(`position_id`,`line_id`,`priority_order`,`email_cc`,`email_to`,`email_signature`,`email_msg`,`ratings`,`assigned`,`created_at`) VALUES ('$position_name','$line_name','$priority_order' ,'$cc','$to','$signature','$message','$ratings','0','$chicagotime' )";
            $result0 = mysqli_query($db, $sql0);
            if ($result0) {
                $message_stauts_class = 'alert-success';
                $import_status_message = 'Station Position Relation Created successfully.';
            } else {
                $message_stauts_class = 'alert-danger';
                $import_status_message = 'Error: Please Insert valid data';
            }
        }
    }
//edit
    $edit_name = $_POST['edit_position_name'];
    if ($edit_name != "") {
        $id = $_POST['edit_id'];
        $sql00 = "update cam_station_pos_rel set email_signature='$_POST[edit_signature]',priority_order='$_POST[edit_priority_order]', position_id='$_POST[edit_position_name]',line_id='$_POST[edit_line_name]' , email_cc='$_POST[edit_cc]' , email_to='$_POST[edit_to]', email_msg='$_POST[edit_message]', ratings='$_POST[edit_ratings]' where station_pos_rel_id='$id'";
        $result1 = mysqli_query($db, $sql00);
        if ($result1 != "") {
            $message_stauts_class = 'alert-success';
            $import_status_message = 'Station Position Relation Updated successfully.';
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
        <?php echo $sitename; ?> | Station Position Configuration</title>
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



        table.dataTable thead .sorting:after {
            content: ""!important;
            top: 49%;
        }
        .card-title:before{
            width: 0;

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
$cust_cam_page_header = "Station Position Configuration";
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
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Admin Config</a></li>
                <li class="breadcrumb-item active" aria-current="page">Station Position Configuration</li>
            </ol>

        </div>
    </div>
    <div class="row-body">
        <div class="col-12 col-sm-12">
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
        </div>
    </div>
    <form action="delete_station_pos_rel.php" method="post" class="form-horizontal">
            <div class="row-body">
                <div class="col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                <button type="submit" class="btn btn-danger btn-sm br-5">
                                    <i>
                                        <svg class="table-delete" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9zm7.5-5l-1-1h-5l-1 1H5v2h14V4h-3.5z"></path></svg>
                                    </i>
                                </button>
                                <button style="margin-left: 827px!important;" type="button" data-toggle="modal" class="btn btn-primary"
                                        data-target="#modal_theme_primary1">Create Station
                                    Position Relation
                                </button>
                            </h4>

                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table  table-bordered text-nowrap mb-0" id="example2">
                                    <thead>
                                    <tr>
                                        <th><input type="checkbox" id="checkAll"></th>
                                        <th>Sl. No</th>
                                        <th>Action</th>
                                        <th>Position</th>
                                        <th>Station</th>
                                        <th>Priority Order</th>
                                        <th>Required Rating</th>
                                        <th>Email Configuration</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $query = sprintf("SELECT * FROM  cam_station_pos_rel where is_deleted!='1'");
                                    $qur = mysqli_query($db, $query);
                                    while ($rowc = mysqli_fetch_array($qur)) {
                                        ?>
                                        <tr>
                                            <td><input type="checkbox" id="delete_check[]" name="delete_check[]"
                                                       value="<?php echo $rowc["station_pos_rel_id"]; ?>"></td>
                                            <td><?php echo ++$counter; ?></td>
                                            <td class="">
                                                <button type="button" id="edit" class="btn btn-success btn-sm br-5 me-2"
                                                        data-signature="<?php echo $rowc['email_signature']; ?>"
                                                        data-priority_order="<?php echo $rowc['priority_order']; ?>"
                                                        data-cc="<?php echo $rowc['email_cc']; ?>"
                                                        data-to="<?php echo $rowc['email_to']; ?>"
                                                        data-message="<?php echo $rowc['email_msg']; ?>"
                                                        data-ratings="<?php echo $rowc['ratings']; ?>"
                                                        data-id="<?php echo $rowc['station_pos_rel_id']; ?>"
                                                        data-name="<?php echo $rowc['position_id']; ?>"
                                                        data-line="<?php echo $rowc['line_id']; ?>" data-toggle="modal"
                                                        data-target="#edit_modal_theme_primary">

                                                    <i>
                                                        <svg class="table-edit" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-.45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z"></path></svg>
                                                    </i>
                                                </button>

                                            </td>
                                            <?php
                                            $position1 = $rowc['position_id'];
                                            $qurtemp1 = mysqli_query($db, "SELECT * FROM  cam_position where position_id = '$position1' ");
                                            while ($rowctemp1 = mysqli_fetch_array($qurtemp1)) {
                                                $position = $rowctemp1["position_name"];
                                            }
                                            ?>
                                            <td><?php echo $position; ?></td>
                                            <?php
                                            $station1 = $rowc['line_id'];
                                            $qurtemp = mysqli_query($db, "SELECT * FROM  cam_line where line_id = '$station1' ");
                                            while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                                                $station = $rowctemp["line_name"];
                                            }
                                            ?>
                                            <td><?php echo $station; ?></td>
                                            <td><?php echo $rowc['priority_order']; ?></td>
                                            <td><?php echo $rowc['ratings']; ?></td>
                                            <?php
                                            $configuration = $rowc['email_to'];
                                            if ($configuration != "") {
                                                $answer = "<span class='badge badge-success'>Configured</span>";
                                            } else {
                                                $answer = "<span class='badge badge-danger'>Pending</span>";
                                            }
                                            ?>
                                            <td><?php echo $answer; ?></td>
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
    <!-- /basic datatable -->
    <!-- /main charts -->
    <div id="modal_theme_primary1" class="modal col-lg-12 col-md-12">
        <div class="modal-dialog" style="width: 1180px!important;">
            <div class="modal-content">
                <div class="card-header">
                    <button type="button" style="color: white;font-size: 1.9125rem;" class="close" data-dismiss="modal">&times;</button>
                    <span class="main-content-title mg-b-0 mg-b-lg-1">Configure Station Position Relation</span>
                </div>
                <form action="" id="edit_station_event_form" enctype="multipart/form-data" class="form-horizontal"
                      method="post">
                    <div class="card-body">
                        <div class="col-lg-12 col-md-12">
                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs">
                                    <div class="col-md-4">
                                        <label class="form-label mg-b-0">Station : </label>
                                    </div>
                                        <div class="col-md-8 mg-t-10 mg-md-t-0">
                                             <select name="line_name" id="line_name" class="form-control">
                                                <option value="" selected disabled>Select Station</option>
                                                <?php
                                                 $sql1 = "SELECT * FROM `cam_line` where enabled = 1 order by line_name";
                                                 $result1 = $mysqli->query($sql1);
                                                 while ($row1 = $result1->fetch_assoc()) {
                                                     echo "<option value='" . $row1['line_id'] . "'$entry>" . $row1['line_name'] . "</option>";
                                                 }
                                                 ?>
                                              </select>
                                        </div>
                                    </div>
                                </div>
                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs">
                                    <div class="col-md-4">
                                        <label class="form-label mg-b-0">Position : </label>
                                    </div>
                                    <div class="col-md-8 mg-t-10 mg-md-t-0">
                                        <select name="position_name" id="position_name" class="form-control">
                                            <option value="" selected disabled>Select Position</option>
                                            <?php
                                            $sql1 = "SELECT * FROM `cam_position`";
                                            $result1 = $mysqli->query($sql1);
                                            while ($row1 = $result1->fetch_assoc()) {
                                                echo "<option value='" . $row1['position_id'] . "'$entry>" . $row1['position_name'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs">
                                    <div class="col-md-4">
                                        <label class="form-label mg-b-0">Priority Order : </label>
                                    </div>
                                    <div class="col-md-8 mg-t-10 mg-md-t-0">
                                        <input type="text" name="priority_order" id="priority_order" value="any"
                                               class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs">
                                    <div class="col-md-4">
                                        <label class="form-label mg-b-0">Required Rating : </label>
                                    </div>
                                    <div class="col-md-8 mg-t-10 mg-md-t-0">
                                        <select name="ratings" id="ratings" class="form-control">
                                            <option value="" selected disabled>Select Rating</option>
                                            <option value="0">0</option>
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs">
                                    <div class="col-md-4">
                                        <label class="form-label mg-b-0">Email To : </label>
                                    </div>
                                    <div class="col-md-8 mg-t-10 mg-md-t-0">
                                        <input type="email" name="to" id="to" class="form-control" multiple>
                                    </div>
                                </div>
                            </div>
                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs">
                                    <div class="col-md-4">
                                        <label class="form-label mg-b-0">Email CC : </label>
                                    </div>
                                    <div class="col-md-8 mg-t-10 mg-md-t-0">
                                        <input type="email" name="cc" id="cc" class="form-control" multiple>
                                    </div>
                                </div>
                            </div>
                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs">
                                    <div class="col-md-4">
                                        <label class="form-label mg-b-0">Message : </label>
                                    </div>
                                    <div class="col-md-8 mg-t-10 mg-md-t-0">
                                        <textarea id="message" name="message" rows="4"
                                                  class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs">
                                    <div class="col-md-4">
                                        <label class="form-label mg-b-0">Signature : </label>
                                    </div>
                                    <div class="col-md-8 mg-t-10 mg-md-t-0">
                                        <textarea id="signature" name="signature" rows="2"
                                                  class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>
    <!-- edit modal -->
<div id="edit_modal_theme_primary" class="modal col-lg-12 col-md-12">
    <div class="modal-dialog" style="width: 1180px!important;">
        <div class="modal-content">
            <div class="card-header">
                <button type="button" style="color: white;font-size: 1.9125rem;" class="close" data-dismiss="modal">&times;</button>
                <span class="main-content-title mg-b-0 mg-b-lg-1">Update Station Position Relation</span>
            </div>
            <form action="" id="user_form" enctype="multipart/form-data" class="form-horizontal"
                  method="post">
                <div class="card-body" style="">
                    <div class="col-lg-12 col-md-12">
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Station : </label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <select name="edit_line_name" id="edit_line_name" class="form-control">
                                        <option value="" selected disabled>Select Station</option>
                                        <?php
                                        $sql1 = "SELECT * FROM `cam_line` where enabled = '1'";
                                        $result1 = $mysqli->query($sql1);
                                        while ($row1 = $result1->fetch_assoc()) {
                                            echo "<option value='" . $row1['line_id'] . "'$entry>" . $row1['line_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Position : </label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <select name="edit_position_name" id="edit_position_name"
                                            class="form-control">
                                        <option value="" selected disabled>Select Position</option>
                                        <?php
                                        $sql1 = "SELECT * FROM `cam_position`";
                                        $result1 = $mysqli->query($sql1);
                                        while ($row1 = $result1->fetch_assoc()) {
                                            echo "<option value='" . $row1['position_id'] . "'$entry>" . $row1['position_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Priority Order: </label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <input type="text" name="edit_priority_order" id="edit_priority_order"
                                           class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Required Rating : </label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <select name="edit_ratings" id="edit_ratings" class="form-control">
                                        <option value="0">0</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Email To : </label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <input type="email" name="edit_to" id="edit_to" class="form-control"
                                           multiple>
                                </div>
                            </div>
                        </div>
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Email CC : </label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <input type="email" name="edit_cc" id="edit_cc" class="form-control"
                                           multiple>
                                </div>
                            </div>
                        </div>
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Message : </label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                        <textarea id="edit_message" name="edit_message" class="form-control"
                                                  rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-4">
                                    <label class="form-label mg-b-0">Email Signature : </label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                        <textarea id="edit_signature" name="edit_signature" class="form-control"
                                                  rows="2"></textarea>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="edit_id" id="edit_id">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
        </div>
        </form>
    </div>
</div>
</div>
    <script> $(document).on('click', '#delete', function () {
            var element = $(this);
            var del_id = element.attr("data-id");
            var info = 'id=' + del_id;
            $.ajax(
                {
                    type: "POST",
                    url: "ajax_data_delete.php",
                    data: info,
                    success: function (data) {
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
                var line = $(this).data("line");
                var cc = $(this).data("cc");
                var to = $(this).data("to");
                var message = $(this).data("message");
                var ratings = $(this).data("ratings");
                var priority_order = $(this).data("priority_order");
                var signature = $(this).data("signature");
                $("#edit_position_name").val(name);
                $("#edit_line_name").val(line);
                $("#edit_id").val(edit_id);
                $("#edit_cc").val(cc);
                $("#edit_to").val(to);
                $("#edit_message").val(message);
                $("#edit_ratings").val(ratings);
                $("#edit_signature").val(signature);
                $("#edit_priority_order").val(priority_order);

                // Load Taskboard
                const sb1 = document.querySelector('#edit_ratings');
                var options1 = sb1.options;
                $('#edit_modal_theme_primary .select2 .selection select2-selection select2-selection--single .select2-selection__choice').remove();
                for (var i = 0; i < options1.length; i++) {
                    if(ratings == (options1[i].value)){ // EDITED THIS LINE
                        options1[i].selected="selected";
                        options1[i].className = ("select2-results__option--highlighted");
                        var opt = options1[i].outerHTML.split(">");
                        $('#select2-results .select2-results__option').prop('selectedIndex',i);
                        var gg = '<span class="select2-selection__rendered" id="select2-edit_ratings-container" title="' + opt[1].replace('</option','') + '">' + opt[1].replace('</option','') + '</span>';
                        $("#select2-edit_ratings-container")[0].outerHTML = gg;
                    }
                }
                //alert(role);
            });
        });
    </script>

</div>
<!-- /content area -->

</div>
<!-- /page container -->

<script>
    window.onload = function () {
        history.replaceState("", "", "<?php echo $scriptName; ?>config_module/station_pos_rel.php");
    }
</script>
<script>
    $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>
    <?php include('../footer1.php') ?>

</body>
