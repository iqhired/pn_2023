<?php
include("../config.php");
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
//  header('location: ../logout.php');
    exit;
}
//Set the time of the user's last activity
$_SESSION['LAST_ACTIVITY'] = $time;

if (count($_POST) > 0) {
    $line_name = $_POST['line_name'];
    $position_name = $_POST['position_name'];
    $user_name = $_POST['user_name'];
    $ratings = $_POST['ratings'];
//echo "Line Name :- ".$line_name;
//echo "<br/>";
    if ($position_name != "") {
        $cnt = count($position_name);
        for ($i = 0; $i < $cnt;) {
            $p_name = $position_name[$i];
            $l_name = $line_name[$i];
            $r_name = $ratings[$i];
            $query0003 = sprintf("SELECT * FROM  cam_users where users_id = '$user_name' ");
            $qur0003 = mysqli_query($db, $query0003);
            $rowc0003 = mysqli_fetch_array($qur0003);
            $firname = $rowc0003["firstname"];
            $lasname = $rowc0003["lastname"];
            $fullname = $firname . " " . $lasname;
            $query0004 = sprintf("SELECT * FROM  cam_line where line_id = '$l_name' ");
            $qur0004 = mysqli_query($db, $query0004);
            $rowc0004 = mysqli_fetch_array($qur0004);
            $linename = $rowc0004["line_name"];
            $query0005 = sprintf("SELECT * FROM  cam_position where position_id = '$p_name' ");
            $qur0005 = mysqli_query($db, $query0005);
            $rowc0005 = mysqli_fetch_array($qur0005);
            $positionname = $rowc0005["position_name"];
            $query01 = sprintf("SELECT * FROM `cam_user_rating` WHERE `position_id` = '$p_name' AND `line_id` = '$l_name' AND `user_id` = '$user_name'; ");
            $qur01 = mysqli_query($db, $query01);
            $rowc01 = mysqli_fetch_array($qur01);
            $po_1 = $rowc01["position_id"];
            $li_1 = $rowc01["line_id"];
            $use_1 = $rowc01["user_id"];
            if ($po_1 == $p_name && $li_1 == $l_name && $use_1 == $user_name) {
                $message_stauts_class[] = 'alert-danger';
                $import_status_message[] = 'Error: Position :-' . $positionname . ', Line :- ' . $linename . ' , User :- ' . $fullname . ' Relation already Exist...';
            } else {
//mysqli_query($db, "INSERT INTO `data`(`position_name`,`line_name`,`email_from`,`email_to`,`email_msg`,`ratings`) VALUES ('$position_name','$line_name' ,'$from','$to','$message','$ratings' )");
                $sql0 = "INSERT INTO `cam_user_rating`(`position_id`,`line_id`,`user_id`,`ratings`,`created_at`) VALUES ('$p_name','$l_name' ,'$user_name','$r_name','$chicagotime' )";
                $result0 = mysqli_query($db, $sql0);
                if ($result0) {
                    $message_stauts_class[] = 'alert-success';
                    $import_status_message[] = 'Success: Position :-' . $positionname . ', Line :- ' . $linename . ' , User :- ' . $fullname . ' Ratings Relation Created successfully.';
                } else {
                    $message_stauts_class[] = 'alert-danger';
                    $import_status_message[] = 'Error: Please Insert valid data';
                }
            }
            $i++;
        }
    }
    $edit_name = $_POST['edit_position_name'];
    if ($edit_name != "") {
        $id = $_POST['edit_id'];
        $sql00 = "update cam_user_rating set position_id='$_POST[edit_position_name]',line_id='$_POST[edit_line_name]' , user_id='$_POST[edit_user_name]' , ratings='$_POST[edit_ratings]' where user_rating_id ='$id'";
        $result1 = mysqli_query($db, $sql00);
        if ($result1 != "") {
            $message_stauts_class[] = 'alert-success';
            $import_status_message[] = 'User Ratings Relation Updated successfully.';
        } else {
            $message_stauts_class[] = 'alert-danger';
            $import_status_message[] = 'Error: Please Insert valid data';
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
        <?php echo $sitename; ?> | User Rating Configuration</title>
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

    <!-- Main navbar -->
    <?php
    $cust_cam_page_header = "User Station-Pos-Rating";
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
                <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">User Config</a></li>
                <li class="breadcrumb-item active" aria-current="page">User Station-Pos-Rating</li>
            </ol>
        </div>
    </div>


    <form action="" id="user_form" class="form-horizontal" method="post">
        <div class="row-body">
            <div class="col-lg-12 col-md-12">
                <?php
                if (!empty($import_status_message)) {
                    $cnt = count($import_status_message);
                    for ($i = 0; $i < $cnt;) {
                        echo '<div class="alert ' . $message_stauts_class[$i] . '">' . $import_status_message[$i] . '</div>';
                        $i++;
                    }
                }
                ?>
                <div class="card">
                    <div class="card-body">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">CONFIGURE USER RATINGS</span>
                        </div>

                        <div class="pd-30 pd-sm-20">
                            <div class="row ">
                                <div class="col-md-1">
                                    <label class="form-label mg-b-0">Users</label>
                                </div>
                                <div class="col-md-2 mg-t-10 mg-md-t-0">
                                    <select name="user_name" id="user_name" class=" form-control" >
                                        <option value="" selected disabled>--- Select User ---</option>
                                        <?php
                                        $sql1 = "SELECT * FROM `cam_users` where `users_id` != '1' order BY `user_name`";
                                        $result1 = $mysqli->query($sql1);
                                        while ($row1 = $result1->fetch_assoc()) {
                                            echo "<option value='" . $row1['users_id'] . "'$entry>" . $row1['firstname'] . "&nbsp;" . $row1['lastname'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>




                        <div class="pd-30 pd-sm-20">
                            <div class="row ">
                                <div class="col-md-1">
                                    <label class="form-label mg-b-0">Station</label>
                                </div>
                                <div class="col-md-2 mg-t-10 mg-md-t-0">
                                    <select name="line_name[]" id="line_name" class="form-control " data-id='1' >
                                        <option value="" selected disabled>--- Select Station ---</option>
                                        <?php
                                        $sql1 = "SELECT DISTINCT `line_id` FROM `cam_station_pos_rel`";
                                        $result1 = $mysqli->query($sql1);
                                        while ($row1 = $result1->fetch_assoc()) {
                                            $station1 = $row1['line_id'];
                                            $qurtemp = mysqli_query($db, "SELECT * FROM  cam_line where line_id = '$station1' ");
                                            $rowctemp = mysqli_fetch_array($qurtemp);
                                            $station = $rowctemp["line_name"];
                                            echo "<option value='" . $row1['line_id'] . "'$entry>" . $station . "</option>";
                                        }
                                        ?>
                                    </select>

                                </div>



                                <div class="col-md-1"></div>
                                <div class="col-md-1">
                                    <label class="form-label mg-b-0">Position</label>
                                </div>
                                <div class="col-md-2 mg-t-10 mg-md-t-0">
                                    <select name="position_name[]" id="position_name" class=" form-control" >
                                        <option value="" selected disabled>--- Select Position ---</option>

                                    </select>
                                </div>

                                <div class="col-md-1"></div>
                                <div class="col-md-1">
                                    <label class="form-label mg-b-0"> User Rating</label>
                                </div>
                                <div class="col-md-2 mg-t-10 mg-md-t-0">
                                    <select name="ratings[]" id="ratings[]" class="form-control">
                                        <option value="" selected disabled>--- Select Rating ---</option>
                                        <option value="0" >0</option>
                                        <option value="1" >1</option>
                                        <option value="2" >2</option>
                                        <option value="3" >3</option>
                                        <option value="4" >4</option>
                                        <option value="5" >5</option>
                                    </select>                                  </div>
                            </div>
                            <div id="span_product_details"></div>
                            <?php
                            if (!empty($_SESSION['import_status_message'])) {
                                echo '<div class="alert ' . $_SESSION['message_stauts_class'] . '">' . $_SESSION['import_status_message'] . '</div>';
                                $_SESSION['message_stauts_class'] = '';
                                $_SESSION['import_status_message'] = '';
                            }
                            ?>
                        </div>

                        <div class="card-body pt-0">
                            <button type="button" name="add_more" id="add_more" class="btn btn-primary" style="background-color:#1e73be;">Add More Line</button>&nbsp;&nbsp;&nbsp;&nbsp;
                            <button type="submit" class="btn btn-primary" style="background-color:#1e73be;">Create User Rating</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>



    <form action="delete_user_ratings.php" method="post" class="form-horizontal">
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
                                                <th>Position</th>
                                                <th>Line</th>
                                                <th>User</th>
                                                <th>User Ratings</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $query = sprintf("SELECT * FROM  cam_user_rating where is_deleted!='1'");
                                            $qur = mysqli_query($db, $query);
                                            while ($rowc = mysqli_fetch_array($qur)) {
                                                $user_rating_id = $rowc["user_rating_id"];
                                                ?>
                                                <tr>
                                                    <td><label class="ckbox"><input type="checkbox" id="delete_check[]" name="delete_check[]" value="<?php echo $rowc["user_rating_id"]; ?>"><span></span></label></td>
                                                    <td><?php echo ++$counter; ?></td>
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
                                                    <?php
                                                    $un = $rowc['user_id'];
                                                    $qur04 = mysqli_query($db, "SELECT * FROM  cam_users where users_id = '$un' ");
                                                    while ($rowc04 = mysqli_fetch_array($qur04)) {
                                                        $first = $rowc04["firstname"];
                                                        $last = $rowc04["lastname"];
                                                    }
                                                    ?>
                                                    <td><?php echo $first; ?>&nbsp;<?php echo $last; ?></td>
                                                    <td><?php echo $rowc['ratings']; ?></td>
                                                    <td>
                                                        <!--                                                        <button type="button" id="edit" class="btn btn-info btn-xs" data-edit_iid="--><?php //echo $rowc['user_rating_id']; ?><!--" data-ratings="--><?php //echo $rowc['ratings']; ?><!--"  data-position_name="--><?php //echo $rowc['position_id']; ?><!--" data-id="--><?php //echo $rowc['user_rating_id']; ?><!--" data-line_name="--><?php //echo $rowc['line_id']; ?><!--" data-user_name="--><?php //echo $rowc['user_id']; ?><!--" data-toggle="modal" style="background-color:#1e73be;" data-target="#edit_modal_theme_primary">Edit </button>-->
                                                        <a href="edit_user_ratings.php?id=<?php echo $user_rating_id; ?>" class="btn btn-primary"  style="background-color:#1e73be;"> <i class="fa fa-edit"></i></a>

                                                    </td>
                                                </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
    </form>


    <!-- /basic datatable -->
    <!-- /main charts -->
    <!-- edit modal -->
    <div id="edit_modal_theme_primary" class="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h6 class="modal-title">Update User Ratings Configuration</h6>
                </div>
                <form action="" id="user_form" class="form-horizontal" method="post">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label class="col-lg-5 control-label">Station : </label>
                                    <div class="col-lg-7">
                                        <select name="edit_line_name" id="edit_line_name" class="select form-control" data-style="bg-slate" >
                                            <option value="" disabled>--- Select Station ---</option>
                                            <?php
                                            $sql1 = "SELECT DISTINCT `line_id` FROM `cam_station_pos_rel`";
                                            $result1 = $mysqli->query($sql1);
                                            while ($row1 = $result1->fetch_assoc()) {
                                                $station1 = $row1['line_id'];
                                                $qurtemp = mysqli_query($db, "SELECT * FROM  cam_line where line_id = '$station1' ");
                                                $rowctemp = mysqli_fetch_array($qurtemp);
                                                $station = $rowctemp["line_name"];
                                                echo "<option value='" . $row1['line_id'] . "'$entry>" . $station . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label class="col-lg-5 control-label">Position : </label>
                                    <div class="col-lg-7">
                                        <select name="edit_position_name" id="edit_position_name" class="select form-control" data-style="bg-slate" >
                                            <option value="" disabled>--- Select Position ---</option>
                                            <?php
                                            $sql1 = "SELECT * FROM `cam_station_pos_rel`";
                                            $result1 = $mysqli->query($sql1);
                                            while ($row1 = $result1->fetch_assoc()) {
                                                $position1 = $row1['position_id'];
                                                $qurtemp1 = mysqli_query($db, "SELECT position_name FROM  cam_position where position_id = '$position1' ");
                                                $rowctemp1 = mysqli_fetch_array($qurtemp1);
                                                $position = $rowctemp1["position_name"];
                                                echo "<option value='" . $row1['position_id'] . "'$entry>$position</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label class="col-lg-5 control-label">User : </label>
                                    <div class="col-lg-7">
                                        <select name="edit_user_name" id="edit_user_name" class="select form-control" data-style="bg-slate" >
                                            <option value="" disabled>--- Select User ---</option>
                                            <?php
                                            $query = sprintf("SELECT * FROM  cam_user_rating where is_deleted!='1'");
                                            $qur = mysqli_query($db, $query);
                                            while ($res_q = mysqli_fetch_array($qur));
                                            {
                                                $user_id = $res_q['user_id'];
                                            }

                                            $sql1 = "SELECT * FROM `cam_users` where `users_id` != '1'";
                                            $result1 = $mysqli->query($sql1);
                                            while ($row1 = $result1->fetch_assoc()) {
                                                echo "<option value='" . $row1['users_id'] . "'$entry>" . $row1['firstname'] . " " . $row1['lastname'] . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label class="col-lg-5 control-label">User Rating : </label>
                                    <div class="col-lg-7">
                                        <select name="edit_ratings" id="edit_ratings" class="select form-control" data-style="bg-slate" >
                                            <option value="0" >0</option>
                                            <option value="1" >1</option>
                                            <option value="2" >2</option>
                                            <option value="3" >3</option>
                                            <option value="4" >4</option>
                                            <option value="5" >5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="edit_id" id="edit_id" >
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


</div>
</div>
</div>


<script> $(document).on('click', '#delete', function () {
        var element = $(this);
        var del_id = element.attr("data-id");
        var info = 'id=' + del_id;
        $.ajax({type: "POST", url: "ajax_user_ratings_delete.php", data: info, success: function (data) { }});
        $(this).parents("tr").animate({backgroundColor: "#003"}, "slow").animate({opacity: "hide"}, "slow");
    });</script>
<script>
    jQuery(document).ready(function ($) {
        $(document).on('click', '#edit', function () {
            debugger;
            var element = $(this);
            var edit_id = element.attr("data-id");
            var position_name = $(this).data("position_name");
            var line_name = $(this).data("line_name");
            var user_name = $(this).data("user_name");
            var ratings = $(this).data("ratings");
            //var edit_id = $(this).data("edit_iid");
            $("#edit_position_name").val(position_name);
            $("#edit_line_name").val(line_name);
            $("#edit_id").val(edit_id);
            $("#edit_user_name").val(user_name);
            $("#edit_ratings").val(ratings);
            //alert(role);
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

        });
    });
</script>
<script>
    var count = 1;
    $(document).on('click', '#add_more', function () {
        count = count + 1;
        var html = '<div class="row" id="row_id' + count + '"> ';
        html += '<div class="col-md-4">';
        html += '<div class="form-group">';
        html += '<label class="col-lg-3 control-label">Station : </label>';
        html += '<div class="col-lg-9">';
        html += '<select name="line_name[]" id="station_name' + count + '" class="form-control select_st" data-id=' + count + '>';
        html += '<option value="" selected disabled>--- Select Station ---</option>';
        html += '</select>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-3">';
        html += '<div class="form-group">';
        html += '<label class="col-lg-3 control-label">Position : </label>';
        html += '<div class="col-lg-9">';
        html += '<select name="position_name[]" id="position_name' + count + '" class="form-control"  >';
        html += '<option value="" selected disabled>--- Select Position ---</option>';
        html += '</select>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-4">';
        html += '<div class="form-group">';
        html += '<label class="col-lg-3 control-label">User Rating : </label>';
        html += '<div class="col-lg-9">';
        html += '<select name="ratings[]" id="ratings[]" class="form-control"  >';
        html += '<option value="" selected disabled>--- Select Rating ---</option>';
        html += '<option value="0" >0</option>';
        html += '<option value="1" >1</option>';
        html += '<option value="2" >2</option>';
        html += '<option value="3" >3</option>';
        html += '<option value="4" >4</option>';
        html += '<option value="5" >5</option>';
        html += '</select>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '<div class="col-md-1">';
        html += '<button type="button" name="remove_btn" class="btn btn-danger btn-xs remove_btn" id="btn_id' + count + '" data-id="' + count + '">-</button>';
        html += '</div></div>';
        $('#span_product_details').append(html);
        //$.ajax({
        //          url: "retrive_position.php",
        //        dataType: 'Json',
        //      data: {},
        //    success: function(data) {
        //      // $('select[name="item_name[]"]').empty();
        //        // $('#'+select_id).append('<option value="" selected disabled>Select Your Item</option>');
        //$.each(data, function(key, value) {
        //  $('#position_name'+count).append('<option value="'+ key +'">'+ value +'</option>');
        //                });
        //            }
        //        });
        $.ajax({
            url: "retrive_station.php",
            dataType: 'Json',
            data: {},
            success: function (data) {
                // $('select[name="item_name[]"]').empty();
                // $('#'+select_id).append('<option value="" selected disabled>Select Your Item</option>');
                $.each(data, function (key, value) {
                    $('#station_name' + count).append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            }
        });
    });
    $(document).on('change', '.select_st', function () {
        var stateID = $(this).val();
        var dataid = $(this).attr('data-id');
        //alert("You have selected the country - " + stateID);
        $.ajax({
            url: "retrive_position.php",
            dataType: 'Json',
            data: {'campus': stateID},
            success: function (data) {
                $('#position_name' + dataid).empty();
                $('#position_name' + dataid).append('<option value="" selected disabled>--- Select Position ---</option>');
                $.each(data, function (key, value) {
                    $('#position_name' + dataid).append('<option value="' + value.id + '">' + value.name + '</option>');
                });
            }
        });
    });
    $(document).on('click', '.remove_btn', function () {
        var row_no = $(this).attr("data-id");
        $('#row_id' + row_no).remove();
    });
</script>
</div>


<script>
    window.onload = function() {
        history.replaceState("", "", "<?php echo $scriptName; ?>user_module/user_ratings.php");
    }
</script>
<script>
    $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
</script>
<?php include ('../footer1.php') ?>

</body>
