<?php include("../config.php");
$chicagotime = date("Y-m-d H:i:s");
$created_by = $_SESSION['id'];
if (count($_POST) > 0) {
    $gauge_name = $_POST['gauge_name'];
    $gauge_length = $_POST['gauge_length'];
    $gauge_start_date = $_POST['gauge_start_date'];
    $gauge_cal_date = $_POST['gauge_cal_date'];
    $gauge_cal_val = $_POST['gauge_cal_val'];
    $gauge_family = $_POST['gauge_family'];
    $gauge_location = $_POST['gauge_location'];
    $g_start_date = convertYMDToMDY($gauge_start_date);
    $g_cal_date = convertYMDToMDY($gauge_cal_date);
    $g_cal_val = convertYMDToMDY($gauge_cal_val);
    $teams1 = $_POST['teams'];
    $users1 = $_POST['users'];
    foreach ($teams1 as $teams) {
        $array_team .= $teams . ",";
    }
    foreach ($users1 as $users) {
        $array_user .= $users . ",";
    }
    $sqlquery = "INSERT INTO `guage_family_data`(`gauge_name`, `guage_length`, `guage_start_date`, `calibration_date`, `calibration_validity`, `gauge_family`, `location`,`teams`,`users`,`created_by`,`created_at`) VALUES ('$gauge_name','$gauge_length','$g_start_date','$g_cal_date','$g_cal_val','$gauge_family','$gauge_location','$array_team','$array_user','$created_by','$chicagotime')";
    $result = mysqli_query($db, $sqlquery);

    $sql1 = "SELECT guage_id as g_id FROM  guage_family_data ORDER BY `guage_id` DESC LIMIT 1";
    $result1 = mysqli_query($db, $sql1);
    $rowc04 = mysqli_fetch_array($result1);
    $g_trace_id = $rowc04["g_id"];
    $gs = $_SESSION['gauge_timestamp_id'];
    $folderPath =  "../assets/images/gauge_images/".$gs;
    $newfolder = "../assets/images/gauge_images/".$g_trace_id;
    if ($result1) {
        rename( $folderPath, $newfolder) ;
        $sql = "update `gauge_images` SET gauge_id = '$g_trace_id' where gauge_id = '$gs'";
        $result1 = mysqli_query($db, $sql);
        $_SESSION['timestamp_id'] = "";
        $_SESSION['message_stauts_class'] = 'alert-success';
        $_SESSION['import_status_message'] = 'Gauge Created Successfully.';
    } else {
        $_SESSION['message_stauts_class'] = 'alert-danger';
        $_SESSION['import_status_message'] = 'Please retry';
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
        <?php echo $sitename; ?> |Gauge Management</title>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/webcamjs/1.0.25/webcam.min.js"></script>
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

            input[type="file"] {
                display: block;

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
$cust_cam_page_header = "Create Gauge";
include("../header.php");
include("../admin_menu.php");
?>
<body class="ltr main-body app sidebar-mini">
<!-- main-content -->
<div class="main-content app-content">
  <div class="row row-sm">
     <div class="col-lg-10 col-xl-10 col-md-12 col-sm-12">
        <div class="breadcrumb-header justify-content-between">
            <div class="left-content">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Create</a></li>
                    <li class="breadcrumb-item active" aria-current="page">GAUGE MANAGEMENT</li>
                </ol>
            </div>
        </div>
     </div>
    </div>
    <div class="row row-sm">
        <div class="col-lg-10 col-xl-10 col-md-12 col-sm-12">
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
        <form action="" id="" enctype="multipart/form-data" class="form-horizontal" method="post">
            <div class="row row-sm">
                <div class="col-lg-10 col-xl-10 col-md-12 col-sm-12">
                    <div class="card box-shadow-0">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">GUAGE MANAGEMENT</span>
                        </div>
                        <div class="card-body pt-0">
                            <div class="pd-30 pd-sm-20">
                                   <div class="row row-xs align-items-center mg-b-20">
                                       <div class="col-md-4">
                                           <label class="form-label mg-b-0">Gauge Name : </label>
                                       </div>
                                       <div class="col-md-8 mg-t-5 mg-md-t-0">
                                           <input type="text" class="form-control" name="gauge_name" id="gauge_name" placeholder="Enter Gauge Name" required>
                                       </div>
                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="form-label mg-b-0">Gauge Length : </label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <input type="text" class="form-control" name="gauge_length" id="gauge_length" placeholder="Enter Gauge Length" required>
                                        </div>
                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="form-label mg-b-0">Gauge Start Date : </label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input class="form-control fc-datepicker" name="gauge_start_date"  id="gauge_start_date" placeholder="MM-DD-YYYY" type="text" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="form-label mg-b-0">Gauge Calibration Date : </label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input class="form-control fc-datepicker" name="gauge_cal_date" id="gauge_cal_date" placeholder="MM-DD-YYYY" type="text" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="form-label mg-b-0">Gauge Calibration Validity : </label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <div class="input-group">
                                                <div class="input-group-text">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input class="form-control fc-datepicker" name="gauge_cal_val" id="gauge_cal_val" placeholder="MM-DD-YYYY" type="text" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20">
                                        <div class="col-md-4">
                                            <label class="form-label mg-b-0">Images : </label>
                                        </div>
                                        <div class="col-md-8 mg-t-5 mg-md-t-0">
                                            <input id="image-input" type="file" name="image[]" class="form-control" multiple>
                                            <div class="container"></div>
                                        </div>
                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20">
                                      <div class="col-md-4">
                                         <label class="form-label mg-b-0">Gauge Family : </label>
                                      </div>
                                      <div class="col-md-8 mg-t-5 mg-md-t-0">
                                        <select name="gauge_family" id="gauge_family" class="form-control form-select select2" data-placeholder="Select Gauge Family">
                                            <option value="" selected disabled> Select Gauge Family </option>
                                            <?php
                                                $sql1 = "SELECT * FROM `guage_family` ORDER BY `guage_family_name` ASC";
                                                $result1 = $mysqli->query($sql1);
                                                while ($row1 = $result1->fetch_assoc()) {
                                                    echo "<option value='" . $row1['guage_family_id'] . "'  >" . $row1['guage_family_name'] . "</option>";
                                                }
                                                ?>
                                        </select>
                                      </div>
                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20">
                                       <div class="col-md-4">
                                        <label class="form-label mg-b-0">Location : </label>
                                       </div>
                                       <div class="col-md-8 mg-t-5 mg-md-t-0">
                                        <input type="text" class="form-control" name="gauge_location" id="gauge_location" placeholder="Enter Location" required>
                                       </div>
                                    </div>
                                    <div class="row row-xs align-items-center mg-b-20">
                                       <label class="form-label mg-b-0">
                                        * Gauge calibration validity ending before one day notification will send through email to related users and groups.
                                       </label>
                                    </div>
                                   <div class="row row-xs align-items-center mg-b-20">
                                      <div class="col-md-4">
                                          <label class="form-label mg-b-0">To Teams : </label>
                                      </div>
                                      <div class="col-md-7 mg-t-5 mg-md-t-0">
                                          <select class="form-control form-select select2" data-placeholder="Add Teams..." value="<?php echo $rowc["teams"]; ?>" name="teams[]" id="teams" multiple="multiple" >
                                              <?php
                                              $arrteam = explode(',', $rowc["teams"]);
                                              $sql1 = "SELECT DISTINCT(`group_id`) FROM `sg_user_group`";
                                              $result1 = $mysqli->query($sql1);
                                              while ($row1 = $result1->fetch_assoc()) {
                                                  if (in_array($row1['group_id'], $arrteam)) {
                                                      $selected = "selected";
                                                  } else {
                                                      $selected = "";
                                                  }
                                                  $station1 = $row1['group_id'];
                                                  $qurtemp = mysqli_query($db, "SELECT * FROM  sg_group where group_id = '$station1' ");
                                                  $rowctemp = mysqli_fetch_array($qurtemp);
                                                  $groupname = $rowctemp["group_name"];
                                                  echo "<option value='" . $row1['group_id'] . "' $selected>" . $groupname . "</option>";
                                              }
                                              ?>
                                         </select>
                                      </div>
                                       <div class="col-md-1 mg-t-5 mg-md-t-0">
                                           <button type="button" class="btn btn-primary" style="background-color:#1e73be;" onclick="group1()"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                       </div>
                                   </div>
                                  <div class="row row-xs align-items-center mg-b-20">
                                      <div class="col-md-4">
                                          <label class="form-label mg-b-0">To Users : </label>
                                      </div>
                                      <div class="col-md-7 mg-t-5 mg-md-t-0">
                                          <select class="form-control form-select select2" data-placeholder="Add Users ..." name="users[]" id="users"  multiple="multiple" >
                                              <?php
                                              $arrteam1 = explode(',', $rowc["users"]);
                                              $sql1 = "SELECT * FROM `cam_users` WHERE `assigned2` = '0'  and `users_id` != '1' order BY `firstname` ";
                                              $result1 = $mysqli->query($sql1);
                                              while ($row1 = $result1->fetch_assoc()) {
                                                  if (in_array($row1['users_id'], $arrteam1)) {
                                                      $selected = "selected";
                                                  } else {
                                                      $selected = "";
                                                  }
                                                  echo "<option value='" . $row1['users_id'] . "' $selected>" . $row1['firstname'] . "&nbsp;" . $row1['lastname'] . "</option>";
                                              }
                                              ?>
                                          </select>
                                      </div>
                                      <div class="col-md-1 mg-t-5 mg-md-t-0">
                                          <button type="button" class="btn btn-primary" style="background-color:#1e73be;" onclick="group2()"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                      </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-sm">
              <div class="col-lg-10 col-xl-10 col-md-12 col-sm-12">
                <div class="card  box-shadow-0">
                    <div class="card-body pt-0">
                        <button type="submit" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5"  class="btn btn-light submit_btn">Create</button>
                    </div>
                </div>
              </div>
            </div>
        </form>
</div>
<!-- main-content ends-->
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
<script>
    $('#gauge_start_date').datepicker({ dateFormat: 'mm-dd-yy' });
    $('#gauge_cal_date').datepicker({ dateFormat: 'mm-dd-yy' });
    $('#gauge_cal_val').datepicker({ dateFormat: 'mm-dd-yy' });
</script>

<script>
    $("#image-input").on("change", function () {
        var fd = new FormData();
        var files = $('#image-input')[0].files[0];
        fd.append('file', files);
        //  fd.append('a', counter++);
        fd.append('request', 1);

        // AJAX request
        $.ajax({
            url: 'create_delete_gauge_image.php',
            type: 'post',
            data: fd,
            contentType: false,
            processData: false,
            success: function (response) {

                if (response != 0) {
                    var count = $('.container .content_img').length;
                    count = Number(count) + 1;

                    // Show image preview with Delete button
                    $('.container').append("<div class='content_img' id='content_img_" + count + "' ><img src='" + response + "' width='100' height='100'><span class='delete' id='delete_" + count + "'>Delete</span></div>");
                }
            }
        });
    });
    // Remove file
    $('.container').on('click', '.content_img .delete', function () {

        var id = this.id;
        var split_id = id.split('_');
        var num = split_id[1];
        // Get image source
        var imgElement_src = $('#content_img_' + num)[0].children[0].src;
        //var deleteFile = confirm("Do you really want to Delete?");
        console.log(imgElement_src);
        var succ = false;
        // AJAX request
        $.ajax({
            url: 'create_delete_gauge_image.php',
            type: 'post',
            data: {path: imgElement_src, request: 2},
            async: false,
            success: function (response) {
                // Remove <div >
                if (response == 1) {
                    succ = true;
                }
            }, complete: function (data) {
                if (succ) {
                    var id = 'content_img_' + num;
                    // $('#content_img_'+num)[0].remove();
                    var elem = document.getElementById(id);
                    document.getElementById(id).style.display = 'none';
                    var nodes = $(".container")[2].childNodes;
                    for (var i = 0; i < nodes.length; i++) {
                        var node = nodes[i];
                        if (node.id == id) {
                            node.style.display = 'none';
                        }
                    }
                }
            }
        });
    });
</script>
<?php include('../footer1.php') ?>
</body>
</html>