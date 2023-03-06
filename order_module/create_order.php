<?php
$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
{
    header('Location: ./config/403.php');
}
require "../vendor/autoload.php";
use \Firebase\JWT\JWT;
$status = '0';
$message = "";
include("../config.php");
include("../sup_config.php");
$chicagotime = date("Y-m-d H:i:s");
$temp = "";


     if (count($_POST) > 0) {
     $order_name = $_POST['order_name'];
    //create
    if ($order_name != "") {
    $c_id = $_POST['c_id'];
    $order_name = $_POST['order_name'];
    $order_desc = $_POST['order_desc'];
    $order_status_id = $_POST['order_status_id'];
    $order_active = $_POST['order_active'];
    $shipment_details = $_POST['shipment_details'];
    $created_by = $_SESSION['id'];
    $service_url = $rest_api_uri . "supplier/create_order.php";
    $curl = curl_init($service_url);
    $curl_post_data = array(
        'c_id' => $c_id,
        'order_name' => $order_name,
        'order_desc' => $order_desc,
        'order_status_id' => $order_status_id,
        'order_active' => $order_active,
        'shipment_details' => $shipment_details,
        'created_on' => $created_on
    );
    $secretkey = "SupportPassHTSSgmmi";
    $payload = array(
        "author" => "Saargummi to HTS",
        "exp" => time()+1000
    );
    try{
        $jwt = JWT::encode($payload, $secretkey , 'HS256');
    }catch (UnexpectedValueException $e) {
        echo $e->getMessage();
    }
    $headers = array(
        "Accept: application/json",
        "access-token: " . $jwt . '"',
    );
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $curl_post_data);
    $curl_response = curl_exec($curl);
    if ($curl_response === false) {
        $info = curl_getinfo($curl);
        curl_close($curl);
        die('error occured during curl exec. Additioanl info: ' . var_export($info));
    }
    curl_close($curl);
    $decoded = json_decode($curl_response);
    if (isset($decoded->status) && $decoded->status == 'ERROR') {
        die('error occured: ' . $decoded->errormessage);
    }
}
checkSession();
$assign_by = $_SESSION["id"];

//old
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

