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
//  header('location: ../logout.php');
    exit;
}
//Set the time of the user's last activity
$_SESSION['LAST_ACTIVITY'] = $time;
//if($_SESSION['user'] != "admin"){
//  header('location: dashboard.php');
//}
$i = $_SESSION["role_id"];
if ($i != "super" && $i != "admin") {
    header('location: ../dashboard.php');
 }
$idd = $_GET['users_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo $sitename; ?> |Restore User</title>
    <!-- Global stylesheets -->

    <link href="../assets/css/core.css" rel="stylesheet" type="text/css">


    <!-- /global stylesheets -->

     <link href="../assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
        <link href="../assets/css/components.css" rel="stylesheet" type="text/css">
    
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
$cust_cam_page_header = "Restore Users";
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
                <li class="breadcrumb-item active" aria-current="page">Restore User</li>
            </ol>
        </div>
    </div>


     <form action="delete_users_list.php"  id="update-form" method="post" class="form-horizontal">
    <div class="row-body">
        <div class="col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <button type="submit" class="btn btn-danger submit_btn" style=""><i class="fa fa-trash-o" style="font-size:20px"></i></button>
                </div>


                <div class="card-body pt-0 example1-table">
                    <div class="table-responsive">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                            <div class="row">
                                <div class="col-sm-12">
                                    
                                    <table class="table  table-bordered text-nowrap mb-0" id="example2">
                                        <thead>
                                        <tr>
                                            <th>Sl. No</th>
                                            <th>Name</th>
                                            <th>Group </th>
                                            <th>Role</th>
                                            <th>Trainee</th>
                                            <th>Action</th>

                                        
                                        </tr>
                                        </thead>
                                        <tbody>
                                             <?php
            $query = sprintf("SELECT * FROM  cam_users where role != '1' AND is_deleted !='0' order by `firstname` ;  ");
            $sessiontraiong = $_SESSION['training'];
            if($sessiontraiong == "1")
            {
                $query = sprintf("SELECT * FROM  cam_users where role != '1' and training = '1' AND is_deleted !='1' order by `firstname` ;  ");
                $_SESSION['training'] = "";
            }
            if($ch == '5')
            {
                $query = sprintf("SELECT * FROM  cam_users where pin_flag = '1' and role != '1'  AND is_deleted !='1' order by `firstname` ; ");
            }

            $qur = mysqli_query($db, $query);
            while ($rowc = mysqli_fetch_array($qur)) {
                ?>
                <tr>
                    <td><?php echo ++$counter; ?></td>
                    <td><?php echo $rowc["firstname"]; ?>&nbsp;<?php echo $rowc["lastname"]; ?></td>
                    <?php
                    $position = "";
                    $position1 = $rowc['users_id'];
                    $qurtemp1 = mysqli_query($db, "SELECT * FROM  sg_user_group where user_id = '$position1' ");
                    while ($rowctemp1 = mysqli_fetch_array($qurtemp1)) {
                        $qur1 = mysqli_query($db, "SELECT group_name FROM sg_group where group_id = '$rowctemp1[group_id]' ");
                        $rowc1 = mysqli_fetch_array($qur1);
                        $position .= $rowc1["group_name"] . " , ";
                    }
                    ?>
                    <td><?php echo $position; ?></td>
                    <td><?php
                        $qur1 = mysqli_query($db, "SELECT role_name FROM cam_role where role_id = '$rowc[role]' ");
                        $rowc1 = mysqli_fetch_array($qur1);
                        echo $rowc1["role_name"];
                        ?>
                    </td>
                    <td >
                        <?php
                        $training = $rowc["training"];
                        if ($training == '1') {
                            ?>
                            <label class="checkbox-switchery switchery-xs " style="margin-bottom:16px;" >
                                <input type="checkbox" style="opacity:0;"  class="switchery custom_switch" checked='checked' data-id="<?php echo $rowc['users_id']; ?>" data-available="<?php echo $rowc['training']; ?>" >
                            </label>
                        <?php } else { ?>
                            <label class="checkbox-switchery switchery-xs " style="margin-bottom:16px;" >
                                <input type="checkbox" style="opacity:0;" class="switchery custom_switch" data-id="<?php echo $rowc['users_id']; ?>" data-available="<?php echo $rowc['training']; ?>" data-toggle="modal" data-target="#update_modal_theme_primary">
                            </label>
                            <?php
                        } ?>

                    </td>
                    <td>
                        <a href="restore_user_update.php?user_id=<?php echo $rowc['users_id']; ?>&user_name=<?php echo $rowc['user_name']; ?>" class="btn btn-primary restore_btn" style="background-color:#1e73be;">Restore</a>
                        <!--<button type="button" id="edit" class="btn btn-info btn-xs" data-trainee="<?php /*echo $rowc['training']; */?>"  data-station="<?php /*echo $rowc['training_station']; */?>" data-position="<?php /*echo $rowc['training_position']; */?>"  data-id="<?php /*echo $rowc['users_id']; */?>" data-name="<?php /*echo $rowc['user_name']; */?>"   data-email="<?php /*echo $rowc['email']; */?>" data-phone="<?php /*echo $rowc['mobile']; */?>" data-role="<?php /*echo $rowc['role']; */?>" data-s_q1="<?php /*echo $rowc['s_question1']; */?>" data-s_q2="<?php /*echo $rowc['s_question2']; */?>" data-s_q3="<?php /*echo $rowc['s_question3']; */?>" data-firstname="<?php /*echo $rowc['firstname']; */?>" data-lastname="<?php /*echo $rowc['lastname']; */?>" data-hiring_date="<?php /*echo $rowc['hiring_date']; */?>" data-total_days="<?php /*echo $rowc['total_days']; */?>" data-job_title_description="<?php /*echo $rowc['job_title_description']; */?>" data-shift_location="<?php /*echo $rowc['shift_location']; */?>" data-toggle="modal" style="background-color:#1e73be;" data-target="#edit_modal_theme_primary">Edit </button>-->
                        <!--<a href="restore_user_update.php?user_id=<?php /*echo $rowc['users_id']; */?>&user_name=<?php /*echo $rowc['user_name']; */?>&email=<?php /*echo $rowc['email']; */?>&trainee=<?php /*echo $rowc['training']; */?>&training_station=<?php /*echo $rowc['training_station']; */?>&training_position=<?php /*echo $rowc['training_position']; */?>&mobile=<?php /*echo $rowc['mobile']; */?>&role=<?php /*echo $rowc['role']; */?>&s_question1=<?php /*echo $rowc['s_question1']; */?>&s_question2=<?php /*echo $rowc['s_question2']; */?>&s_question3=<?php /*echo $rowc['s_question3']; */?>&firstname=<?php /*echo $rowc['firstname']; */?>&lastname=<?php /*echo $rowc['lastname']; */?>&hiring_date=<?php /*echo $rowc['hiring_date']; */?>&total_days=<?php /*echo $rowc['total_days']; */?>&job_title_description=<?php /*echo $rowc['job_title_description']; */?>&shift_location=<?php /*echo $rowc['shift_location']; */?>" class="btn btn-primary" style="background-color:#1e73be;" target="_blank" ><i class="fas fa-trash-restore"></i></a>-->
                    </td>
                </tr>
            <?php } ?>
           
                                        </tbody>
                                    </table>



<div id="update_modal_theme_primary" class="modal col-lg-12 col-md-12">
    <div class="modal-dialog" style="width:100%">
        <div class="modal-content">
            <div class="card-header">
                <button type="button" style="color: white;font-size: 1.9125rem;" class="close" data-dismiss="modal">&times;</button>
                <span class="main-content-title mg-b-0 mg-b-lg-1">Update Trainee Info </span>
            </div>


                    <form action="" id="user_form" enctype="multipart/form-data" class="form-horizontal" method="post">
                
                <div class="card-body" style="">
                    <div class="col-lg-12 col-md-12">
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs" id="update_station1">
                            <div class="col-md-4">
                                    <label class="form-label mg-b-0">Training Station:</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                    <select name="update_station" id="update_station" class="form-control" required>
                                                <option value="" selected disabled>--- Select Station ---</option>
                                                <?php
                                                $sql1 = "SELECT * FROM `cam_line` ";
                                                $result1 = $mysqli->query($sql1);
                                                while ($row1 = $result1->fetch_assoc()) {
                                                    echo "<option value='" . $row1['line_id'] . "'$entry>" . $row1['line_name'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        <input type="hidden" name="update_id" id="update_id" >

                                </div>
                            </div>
                        </div>
                    

                     <div class="pd-30 pd-sm-20">
                            <div class="row row-xs" id="update_position1">
                            <div class="col-md-4">
                                    <label class="form-label mg-b-0">Training Position:</label>
                                </div>
                                <div class="col-md-8 mg-t-10 mg-md-t-0">
                                       <select name="update_position" id="update_position" class="form-control" required>
                                                <option value="" selected disabled>--- Select Position ---</option>
                                                <?php
                                                $sql1 = "SELECT * FROM `cam_position` ";
                                                $result1 = $mysqli->query($sql1);
                                                while ($row1 = $result1->fetch_assoc()) {
                                                    echo "<option value='" . $row1['position_id'] . "'$entry>" . $row1['position_name'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            
            <div class="modal-footer"> 
                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-primary">Save</button> </div>
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
</form>
<script>
    $(".restore_btn").click(function () {
        location.reload();
    });
    function filePreview(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imgPreview + img').remove();
                $('#imgPreview').after('<img src="' + e.target.result + '" class="pic-view" width="200" height="150" float="left"/>');
            };
            reader.readAsDataURL(input.files[0]);
            $('.img-preview').show();
        } else {
            $('#imgPreview + img').remove();
            $('.img-preview').hide();
        }
    }
    $("#file").change(function () {
        // Image preview
        filePreview(this);
    });
    $(function () {
        var rotation = 0;
        $("#rright").click(function () {
            rotation = (rotation - 90) % 360;
            $(".pic-view").css({'transform': 'rotate(' + rotation + 'deg)'});
            if (rotation != 0) {
                $(".pic-view").css({'width': '100px', 'height': '132px'});
            } else {
                $(".pic-view").css({'width': '24%', 'height': '132px'});
            }
            $('#rotation').val(rotation);
        });
        $("#rleft").click(function () {
            rotation = (rotation + 90) % 360;
            $(".pic-view").css({'transform': 'rotate(' + rotation + 'deg)'});
            if (rotation != 0) {
                $(".pic-view").css({'width': '100px', 'height': '132px'});
            } else {
                $(".pic-view").css({'width': '24%', 'height': '132px'});
            }
            $('#rotation').val(rotation);
        });
    });
</script>
<!-- /dashboard content -->
<script> $(document).on('click', '#delete', function () {
        var element = $(this);
        var del_id = element.attr("data-id");
        var info = 'id=' + del_id;
        $.ajax({type: "POST", url: "ajax_delete.php", data: info, success: function (data) { }});
        $(this).parents("tr").animate({backgroundColor: "#003"}, "slow").animate({opacity: "hide"}, "slow");
    });</script>
<script>
    jQuery(document).ready(function ($) {
        $(document).on('click', '#edit', function () {
            var element = $(this);
            var edit_id = element.attr("data-id");
            var name = $(this).data("name");
            var email = $(this).data("email");
            var phone = $(this).data("phone");
            var role = $(this).data("role");
            var s_q1 = $(this).data("s_q1");
            var s_q2 = $(this).data("s_q2");
            var s_q3 = $(this).data("s_q3");
            var firstname = $(this).data("firstname");
            var lastname = $(this).data("lastname");
            var hiring_date = $(this).data("hiring_date");
            var total_days = $(this).data("total_days");
            var job_title_description = $(this).data("job_title_description");
            var shift_location = $(this).data("shift_location");
            var station = $(this).data("station");
            var position = $(this).data("position");
            var trainee = $(this).data("trainee");

            if(trainee == "1")
            {

                $('#edit_station_row').show();
                $('#edit_position_row').show();
            }
            else
            {
                $('#edit_station_row').hide();
                $('#edit_position_row').hide();
            }

            $("#edit_name").val(name);
            $("#edit_email").val(email);
            $("#edit_mobile").val(phone);
            $("#edit_id").val(edit_id);
            $("#edit_s_question1").val(s_q1);
            $("#edit_s_question2").val(s_q2);
            $("#edit_s_question3").val(s_q3);
            $("#edit_firstname").val(firstname);
            $("#edit_lastname").val(lastname);
            $("#edit_hiring_date").val(hiring_date);
            $("#edit_total_days").val(total_days);
            $("#edit_job_title_description").val(job_title_description);
            $("#edit_shift_location").val(shift_location);
            $("#edit_station").val(station);
            $("#edit_position").val(position);
            $select = role;
            $('#edit_role [value=' + role + ']').attr('selected', 'true').change();
            //alert($select);
        });
    });
</script>
<script>
    $("body").on('change', '#hiring_date', function () {
        var start = $('#hiring_date').val();
        var end = new Date();
        var startDay = new Date(start);
        var endDay = new Date(end);
        var millisecondsPerDay = 1000 * 60 * 60 * 24;
        var millisBetween = endDay.getTime() - startDay.getTime();
        var days = millisBetween / millisecondsPerDay;
        // Round down.
        var fin = (Math.floor(days));
        //   alert(fin);
        $("#total_days").val(fin);
    });
</script>




</div>
<script>
    window.onload = function() {
        history.replaceState("", "", "<?php echo $scriptName; ?>user_module/restore_user.php");
    }
</script>

<script>
    $(document).ready(function (){
        $('#upload_csv').on('submit',function (e){
            e.preventDefault();
            $.ajax({
                url:"import.php",
                method:"POST",
                data:new FormData(this),
                contentType:false,
                cache:false,
                processData:false,
                success:function (data){
                    // console.log(data);
                    alert('done');

                }
            });
        });
    });
</script>
<script>
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
        if (selected_val == 5 ) {
            $('#update-form').submit();
        }
    });
</script>
<script>
    $(document).on("click", ".custom_switch", function () {
        //      var available_var = '<?php echo $available_var; ?>';
        var update_id = $(this).data("id");
        var available_var = $(this).data("available");
        $("#update_id").val(update_id);

        if(available_var == "1")
        {
            var edit_id = $(this).data("id");
            $.ajax({
                url: "training_available.php",
                type: "post",
                data: {available_var: available_var, edit_id: edit_id},
                success: function (response) {
                    //alert(response);
                    console.log(response);
                    location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
    });

    $(document).on("click", ".custom_switch2", function () {
        //      var available_var = '<?php echo $available_var; ?>';
        var edit_id = $(this).data("id");
        var available_var = $(this).data("available");

        $.ajax({
            url: "training_available.php",
            type: "post",
            data: {available_var: available_var, edit_id: edit_id},
            success: function (response) {
                //alert(response);
                console.log(response);
                location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
            }
        });
    });



    $(document).on("click", ".switch_trainee", function () {
        var abc =    $(this).is(':checked');
        if(abc == true){
            $("#station").prop("required", true);
            $("#position").prop("required", true);

            $("#station_row").show();
            $("#position_row").show();
        }else{

            $("#station").prop("required", false);
            $("#position").prop("required", false);
            $("#station_row").hide();
            $("#position_row").hide();
        }

    });

    $(document).on("click", ".switch_edit_trainee", function () {
        var abc =    $(this).is(':checked');
        if(abc == true){
            $("#edit_station").prop("required", true);
            $("#edit_position").prop("required", true);

            $("#edit_station_row").show();
            $("#edit_position_row").show();
        }else{

            $("#edit_station").prop("required", false);
            $("#edit_position").prop("required", false);
            $("#edit_station_row").hide();
            $("#edit_position_row").hide();
        }

    });
</script>

<?php include ('../footer1.php') ?>
</body>