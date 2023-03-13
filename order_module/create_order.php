<?php include("../config.php");
$import_status_message = "";
include("../sup_config.php");
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

//	header('location: ../logout.php');
    exit;
}
$is_tab_login = $_SESSION['is_tab_user'];
$is_cell_login = $_SESSION['is_cell_login'];
//Set the time of the user's last activity
$_SESSION['LAST_ACTIVITY'] = $time;
/*$i = $_SESSION["role_id"];
if ($i != "super" && $i != "admin" && $i != "pn_user" && $_SESSION['is_tab_user'] != 1 && $_SESSION['is_cell_login'] != 1 ) {
    header('location: ../dashboard.php');
}*/
if (count($_POST) > 0) {
    $order_name = $_POST['order_name'];
//create
    if ($order_name != "") {
        $c_id = $_POST['c_id'];
        $order_name = $_POST['order_name'];
        $order_desc = $_POST['order_desc'];
        $created_by = $_SESSION['id'];

        $sql = "INSERT INTO `sup_order`( `c_id`, `order_name`, `order_desc`, `order_status_id`, `order_active`, `created_on`, `created_by`) VALUES ('$c_id','$order_name','$order_desc','1','1','$chicagotime','$created_by')";

        $result1 = mysqli_query($sup_db, $sql);
        if (!$result1) {
            $_SESSION['message_stauts_class'] = 'alert-danger';
            if($_SESSION['import_status_message'] == "")
            {
                $_SESSION['import_status_message'] = 'Error: Order Already Exists';
            }
        } else {
            $_SESSION['message_stauts_class'] = 'alert-success';
            $_SESSION['import_status_message'] = 'Order Created Successfully';
        }
    }

//edit
    $edit_order_status = $_POST['order_status'];
    if ($edit_order_status != "") {
        $id = $_POST['edit_id'];
        if($edit_order_status == 6){
            $sql111 = "update sup_order set order_active = 0,order_status_id='$_POST[order_status]' where order_id='$id'";
            $result111 = mysqli_query($sup_db, $sql111);
            if ($result111) {
                $_SESSION['message_stauts_class'] = 'alert-success';
                $_SESSION['import_status_message'] = 'Order Updated Successfully.';
            } else {
                $_SESSION['message_stauts_class'] = 'alert-danger';
                if($_SESSION['import_status_message'] == "")
                {
                    $_SESSION['import_status_message'] = 'Error: Please Try Again.';
                }
            }

        }else{
//eidt logo
            $sql = "update sup_order set order_status_id='$_POST[order_status]' where order_id='$id'";
            $result1 = mysqli_query($sup_db, $sql);
            if ($result1) {
                $_SESSION['message_stauts_class'] = 'alert-success';
                $_SESSION['import_status_message'] = 'Order Updated Successfully.';
            } else {
                $_SESSION['message_stauts_class'] = 'alert-danger';
                if($_SESSION['import_status_message'] == "")
                {
                    $_SESSION['import_status_message'] = 'Error: Please Try Again.';
                }
            }
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
        <?php echo $sitename; ?> |Supplier</title>
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
<body class="ltr main-body app horizontal">

<?php
$cust_cam_page_header = "Supplier";
include("../header.php");
include("../admin_menu.php");
?>


<div class="main-content horizontal-content">
    <div class="main-container container">

        <!---breadcrumb--->
        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Supplier</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Order</li>
                </ol>
            </div>
        </div>
        <?php
        if (!empty($import_status_message)) {
            echo '<div class="alert ' . $message_stauts_class . '">' . $import_status_message . '</div>';
        }
        displaySFMessage();
        ?>


        <form action="" id="user_form" class="form-horizontal" method="post" enctype="multipart/form-data">

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="">
                            <div class="card-header">
                                <span class="main-content-title mg-b-0 mg-b-lg-1">CREATE ORDER</span>
                            </div>


                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs">
                                    <div class="col-md-1">
                                        <label class="form-label mg-b-0">Supplier Name</label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <select required name="c_id" id="c_id" class="form-control form-select select2"
                                                data-style="bg-slate">
                                            <option value="" selected disabled>--- Select Supplier ---</option>
                                            <?php
                                            $sql1 = "SELECT * FROM `sup_account` ORDER BY `c_name` ASC";
                                            $result1 = $mysqli->query($sql1);
                                            while ($row1 = $result1->fetch_assoc()) {
                                                echo "<option value='" . $row1['c_id'] . "'  >" . $row1['c_name'] . "</option>";
                                            }
                                            ?>
                                        </select>

                                    </div>
                                    <div class="col-md-0.5"></div>
                                    <div class="col-md-1">
                                        <label class="form-label mg-b-0">Order Name</label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <input type="text" name="order_name" id="order_name"
                                               class="form-control" placeholder="Enter Order">
                                    </div>
                                </div>
                            </div>

                            <div class="pd-30 pd-sm-20">
                                <div class="row row-xs">
                                    <div class="col-md-1">
                                        <label class="form-label mg-b-0">Order Description</label>
                                    </div>
                                    <div class="col-md-4 mg-t-10 mg-md-t-0">
                                        <textarea id="order_desc" name="order_desc" rows="3" placeholder="Enter Description..." class="form-control"></textarea>                                </div>
                                </div>
                            </div>
                            <div class="card-body pt-0">
                                <button type="submit" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5 submit_btn">Create Order</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>


        <div class="col-12 col-sm-12">
            <div class="card">

                <div class="card-body pt-0 example1-table">
                    <div class="table-responsive">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table datatable-basic table-bordered text-nowrap mb-0" id="example2">
                                        <thead>
                                        <tr>
                                            <th>Sl. No</th>
                                            <th>Supplier Name</th>
                                            <th>Order Name</th>
                                            <th>Order Description</th>
                                            <th>Order Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $query = sprintf("SELECT * FROM sup_order order by order_status_id asc");
                                        $qur = mysqli_query($sup_db, $query);

                                        while ($rowc = mysqli_fetch_array($qur)) {
                                            ?>
                                            <tr>
                                                <td><?php echo ++$counter; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    $c_id = $rowc["c_id"];
                                                    $query34 = sprintf("SELECT c_name FROM  sup_account where c_id = '$c_id'");
                                                    $qur34 = mysqli_query($sup_db, $query34);
                                                    $rowc34 = mysqli_fetch_array($qur34);
                                                    echo $rowc34["c_name"]; ?>
                                                </td>
                                                <td><?php echo $rowc["order_name"]; ?>
                                                </td>
                                                <td><?php echo $rowc["order_desc"]; ?>
                                                </td>

                                                <td>
                                                    <?php
                                                    $order_status_id = $rowc["order_status_id"];
                                                    $query34 = sprintf("SELECT sup_order_status FROM  sup_order_status where sup_order_status_id = '$order_status_id'");
                                                    $qur34 = mysqli_query($sup_db, $query34);
                                                    $rowc34 = mysqli_fetch_array($qur34);
                                                    echo $rowc34["sup_order_status"]; ?>
                                                </td>

                                                <td>
                                                    <a href="view_order_data.php?id=<?php echo $rowc['order_id']; ?>" class="btn btn-info btn-xs" style="background-color:#1e73be;" target="_blank"><i class="fa fa-eye"></i></a>
                                                    <button type="button" id="edit" class="btn btn-info btn-xs" title="Edit"
                                                            data-id="<?php echo $rowc['order_id']; ?>"
                                                            data-c_id ="<?php echo $rowc['c_id']; ?>"
                                                            data-order_name="<?php echo $rowc['order_name']; ?>"
                                                            data-order_desc="<?php echo $rowc['order_desc']; ?>"
                                                            data-order_status_id ="<?php echo $rowc['order_status_id']; ?>"
                                                            data-toggle="modal" style="background-color:#1e73be;margin-top: 0px!important;"
                                                            data-target="#edit_modal_theme_primary"><i class="fa fa-edit"></i>
                                                    </button>
                                                    <?php if($order_status_id == 1){ ?>
                                                        <button type="button" id="delete" class="btn btn-danger btn-xs" title="Delete" style="margin-top: 0px!important;" data-id="<?php echo $rowc['order_id']; ?>"><i class="fa fa-delete">-</i> </button>
                                                    <?php } else { }?>
                                                </td>
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
        </div>

        <div id="edit_modal_theme_primary" class="modal">
            <div class="modal-dialog" style="width:100%">
                <div class="modal-content">
                    <div class="card-header">
                        <button type="button" style="color: white;font-size: 1.9125rem;" class="close" data-dismiss="modal">&times;</button>
                        <span class="main-content-title mg-b-0 mg-b-lg-1">Update Supplier Order</span>
                    </div>
                    <form action="" id="user_form" enctype="multipart/form-data" class="form-horizontal"
                          method="post">
                        <div class="card-body">
                            <div class="col-lg-12 col-md-12">
                                <div class="pd-30 pd-sm-20">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label mg-b-0">Supplier Name</label>
                                        </div>
                                        <div class="col-md-7 mg-t-10 mg-md-t-0">
                                            <select required name="edit_c_id" id="edit_c_id"
                                                    class="form-control" disabled>
                                                <option value="" selected disabled>--- Select Supplier ---
                                                </option>
                                                <?php
                                                $sql1 = "SELECT * FROM `sup_account` ORDER BY `c_name` ASC";
                                                $result1 = $sup_mysqli->query($sql1);
                                                //                                            $entry = 'selected';
                                                while ($row1 = $result1->fetch_assoc()) {
                                                    echo "<option value='" . $row1['c_id'] . "'  >" . $row1['c_name'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                            <input type="hidden" name="edit_id" id="edit_id">
                                        </div>
                                    </div>
                                </div>

                                <div class="pd-30 pd-sm-20">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label mg-b-0">Order Name</label>
                                        </div>
                                        <div class="col-md-7 mg-t-10 mg-md-t-0">
                                            <input type="text" name="edit_order_name" id="edit_order_name"
                                                   class="form-control" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="pd-30 pd-sm-20">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label mg-b-0">Order Status</label>
                                        </div>
                                        <div class="col-md-7 mg-t-10 mg-md-t-0">
                                            <select required name="order_status" id="order_status"
                                                    class="form-control">
                                                <option value="" selected disabled>--- Select Order Status ---</option>
                                                <?php
                                                $sql11 = mysqli_query($sup_db, "SELECT * FROM `sup_order_status` where sup_sa_os_access = 1 ORDER BY `sup_order_status_id` ASC ");
                                                // $selected = "";
                                                while ($row11 = mysqli_fetch_array($sql11)) {
                                                    if ($row11['sup_order_status_id'] == $order_status_id) {
                                                        $selected = "selected";
                                                    } else {
                                                        $selected = "";
                                                    }
                                                    echo "<option value='" . $row11['sup_order_status_id'] . "'  >" . $row11['sup_order_status'] . "</option>";
                                                }
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="pd-30 pd-sm-20">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label class="form-label mg-b-0">Order Description</label>
                                        </div>
                                        <div class="col-md-7 mg-t-10 mg-md-t-0">
                                           <textarea id="edit_order_desc" name="edit_order_desc" rows="3"
                                                     class="form-control" disabled></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>

                    </form>



                </div>
            </div>
        </div>
        <script>
            $(document).on('click', '#delete', function () {
                var element = $(this);
                var del_id = element.attr("data-id");
                var info = 'id=' + del_id;
                var main_url = "<?php echo $url; ?>";

                $.ajax({
                    type: "POST", url: "order_delete.php", data: info, success: function (data) {

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
                    var c_id = $(this).data("c_id");
                    var order_name = $(this).data("order_name");
                    var order_desc = $(this).data("order_desc");
                    var cust_address = $(this).data("cust_address");

                    $("#edit_c_id").val(c_id);
                    $("#edit_order_name").val(order_name);
                    $("#edit_order_desc").val(order_desc);
                    $("#edit_id").val(edit_id);
                });
            });

        </script>

        <script>
            window.onload = function () {
                history.replaceState("", "", "<?php echo $scriptName; ?>order_module/create_order.php");
            }
        </script>
        <script>
            $("#checkAll").click(function () {
                $('input:checkbox').not(this).prop('checked', this.checked);
            });
        </script>


    </div>
</div>
<?php include('../footer1.php') ?>

</body>

