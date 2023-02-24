<?php
include("../config.php");
$sessionid = $_SESSION["id"];
$chicagotime = date("Y-m-d H:i:s");
$temp = "";
checkSession();

if (count($_POST) > 0) {
    $name = $_POST['group_name'];
    if ($name != "") {
//$group_id = $_POST['group_id'];
        $group_name = $_POST['group_name'];
        $disc = $_POST['disc'];
        $sql12 = "INSERT INTO `sg_defect_group`(`d_group_name`,`description`,`creator_id`,`created_at`) VALUES ('$group_name','$disc','$sessionid','$chicagotime')";
        if ($db->query($sql12) === TRUE) {
            $last_id = $db->insert_id;
            $def_array = $_POST['defect_list'];
            foreach ($def_array as $defect){
                if(isset($defect) && $defect != ''){
                    $sql12 = "INSERT INTO `sg_def_defgroup`(`defect_list_id`,`d_group_id`) VALUES ('$defect','$last_id')";
                    mysqli_query($db, $sql12);
                }
            }
            $_SESSION['message_stauts_class'] = 'alert-success';
            $_SESSION['import_status_message'] = 'Defect Group Created Sucessfully.';
        }else{
            $_SESSION['message_stauts_class'] = 'alert-danger';
            $_SESSION['import_status_message'] = 'Please Try Again.';
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
        <?php echo $sitename; ?> |Group</title>
    <!-- Global stylesheets -->
    <link href="../assets/css/core.css" rel="stylesheet" type="text/css">
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
        .main-content .container, .main-content .container-fluid {
            padding-left: 20px;
            padding-right: 238px;
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

        .dropdown .arrow {

            margin-top: -25px!important;
            width: 1.5rem!important;
        }
        #ic .arrow {
            margin-top: -22px!important;
            width: 1.5rem!important;
        }
    </style>
</head>


<body class="ltr main-body app horizontal">
<!-- Main navbar -->
<?php
$cust_cam_page_header = "Defect Group(s)";
include("../header.php");
include("../admin_menu.php");
?>

<div class="main-content app-content">
    <!-- container -->
    <div class="main-container container">
    <!-- breadcrumb -->
            <div class="breadcrumb-header justify-content-between">
                    <div class="left-content">
                       <ol class="breadcrumb">
                         <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Config</a></li>
                         <li class="breadcrumb-item active" aria-current="page">Defect Group(s)</li>
                       </ol>
                    </div>
            </div>
            <div class="row">
                <div class="col-lg-12 col-md-12">
                   <?php
                      if (!empty($import_status_message)) {
                          echo '<br/><div class="alert ' . $message_stauts_class . '">' . $import_status_message . '</div>';
                      }
                      displaySFMessage();
                   ?>

                </div>
            </div>
    <form action="" id="user_form" class="form-horizontal" method="post">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="">
                        <div class="card-header">
                            <span class="main-content-title mg-b-0 mg-b-lg-1">Defect Group(s)</span>
                        </div>
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-1.5">
                                    <label class="form-label mg-b-0"> Defect Group Name  </label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <input type="text" name="group_name" id="group_name" class="form-control" placeholder="Enter Defect Group Name" required>
                                </div>
                                <div class="col-md-0.5"></div>
                                <div class="col-md-1.5">
                                    <label class="form-label mg-b-0">Defect Group Description  </label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <input type="text" name="disc" id="disc" class="form-control" placeholder="Enter Defect Group Description" required>
                                </div>
                            </div>

                        </div>
                        <div class="pd-30 pd-sm-20">
                            <div class="row row-xs">
                                <div class="col-md-1.5">
                                    <label class="form-label mg-b-0">Defects  </label>
                                </div>
                                <div class="col-md-4 mg-t-10 mg-md-t-0">
                                    <select class="form-control form-select select2" name="defect_list[]" id="defect_list" multiple="multiple">
                                        <?php
                                        $sql1 = "SELECT * FROM `defect_list`";
                                        $result1 = $mysqli->query($sql1);
                                        while ($row1 = $result1->fetch_assoc()) {
                                            echo "<option value='" . $row1['defect_list_id'] . "'>" . $row1['defect_list_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-body pt-0">
                            <button type="submit" class="btn btn-primary pd-x-30 mg-r-5 mg-t-5 submit_btn">Create Defect Group</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form action="delete_defect_group_list.php" method="post" class="form-horizontal">
            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                <button type="submit" class="btn btn-danger">
                                    <i>
                                        <svg class="table-delete" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9zm7.5-5l-1-1h-5l-1 1H5v2h14V4h-3.5z"></path></svg>
                                    </i>
                                </button>
                            </h4>
                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table datatable-basic table-bordered">
                                    <thead>
                                    <tr>
                                        <th><input type="checkbox" id="checkAll" ></th>
                                        <th>S.No</th>
                                        <th>Action</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Defect List</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $query = sprintf("SELECT * FROM  sg_defect_group ");
                                    $qur = mysqli_query($db, $query);
                                    while ($rowc = mysqli_fetch_array($qur)) {
                                        ?>
                                        <tr>
                                            <td><input type="checkbox" id="delete_check[]" name="delete_check[]" value="<?php echo $rowc["d_group_id"]; ?>"></td>
                                            <td><?php echo ++$counter; ?></td>
                                            <td>
                                                <a href="edit_defect_grp.php?id=<?php echo $rowc['d_group_id']; ?>" target="_blank" class="btn btn-primary" data-id="<?php echo $rowc['defect_list_id']; ?>">
                                                    <i>
                                                        <svg class="table-edit" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-.45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z"></path></svg>
                                                    </i>
                                                </a>
                                            </td>
                                            <td class="col2"><?php echo $rowc["d_group_name"]; ?></td>
                                            <?php
                                            $d_gid = $rowc["d_group_id"];
                                            $qurtemp = mysqli_query($db, "SELECT * FROM  sg_defect_group where d_group_id = '$d_gid' ");
                                            while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                                                $station = $rowctemp["d_group_name"];
                                            }
                                            ?>
                                            <td style="padding: 10px 15px;"><?php echo $rowc['description']; ?></td>
                                            <?php
                                            $i=0;
                                            $array_defList = '';
                                            $array_defList_id = '';
                                            $qurtemp = mysqli_query($db, "SELECT dl.defect_list_id as defect_list_id , dl.defect_list_name as defect_list_name FROM sg_defect_group as sdg inner join sg_def_defgroup as sdd on sdg.d_group_id = sdd.d_group_id inner join defect_list as dl on sdd.defect_list_id = dl.defect_list_id where sdg.d_group_id =  '$d_gid' ");
                                            while ($rowctemp = mysqli_fetch_array($qurtemp)) {
                                                if($i==0){
                                                    $array_defList .= $rowctemp['defect_list_name'] ;
                                                    $array_defList_id .= $rowctemp['defect_list_id'] ;
                                                }else{
                                                    $array_defList .= " , "  .$rowctemp['defect_list_name'] ;
                                                    $array_defList_id .= " , "  .$rowctemp['defect_list_id'] ;
                                                }
                                                $i++;

                                            }
                                            ?>
                                            <td><?php echo $array_defList; ?></td>
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
    </div>

</div>

    <script> $(document).on('click', '#delete', function () {
            var element = $(this);
            var del_id = element.attr("data-id");
            var info = 'id=' + del_id;
            $.ajax({type: "POST", url: "ajax_role_delete.php", data: info, success: function (data) { }});
            $(this).parents("tr").animate({backgroundColor: "#003"}, "slow").animate({opacity: "hide"}, "slow");
        });
    </script>
    <script>
        $(document).on('click', '#edit', function () {
            var element = $(this);
            var edit_id = element.attr("data-id");
            var name = $(this).data("name");
            var parent = $(this).data("parent");
            var disc = $(this).data("disc");
            var dl = $(this).data("dl").toString();
            if((null != dl) && ( dl !='')){
                dl = dl.toString();
            }
            // console.log(name);
            $("#edit_name").val(name);
            $("#edit_id").val(edit_id);
            $("#edit_parent").val(parent);
            $("#edit_disc").val(disc);
            //alert(role);

            const sb1 = document.querySelector('#edit_defects');
            // create a new option
            var pnums = null;
            if (dl.indexOf(',') > -1){
                pnums = dl.replaceAll(' ','').split(',');
            }else{
                pnums = dl.replaceAll(' ','')
            }
            var options1 = sb1.options;
            // $("#edit_part_number").val(options);
            $('#edit_modal_theme_primary .select2 .selection .select2-selection--multiple .select2-selection__choice').remove();
            // $('select2-search select2-search--inline').remove();

            for (var i = 0; i < options1.length; i++) {
                if(pnums.includes(options1[i].value)){ // EDITED THIS LINE
                    options1[i].selected="selected";
                    // options1[i].className = ("select2-results__option--highlighted");
                    var opt = document.getElementById(options1[i].value).outerHTML.split(">");
                    // $('#edit_defects').prop('selectedIndex',i);
                    $('#edit_defects #select2-results .select2-results__option').prop('selectedIndex',i);
                    var gg = '<li class="select2-selection__choice" title="' + opt[1].replace('</option','') + '"><span class="select2-selection__choice__remove" role="presentation">×</span>' + opt[1].replace('</option','') + '</li>';
                    $('#edit_modal_theme_primary .select2-selection__rendered').append(gg);
                    // $('.select2-search__field').style.visibility='hidden';
                }
            }

        });
    </script>


<!-- /page container -->

<script>
    window.onload = function () {
        history.replaceState("", "", "<?php echo $scriptName; ?>config_module/defect_group.php");
    }

</script>
<script>
    $("#checkAll").click(function () {
        $('input:checkbox').not(this).prop('checked', this.checked);
    });
    $(".select").select2();
    // $(document).on('select2:open', () => {
    //     document.querySelector('.select2-search__field').focus();
    // });
</script>
    <?php include('../footer1.php') ?>
</body>
