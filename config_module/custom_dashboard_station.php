<?php include("../config.php");
$chicagotime = date("Y-m-d H:i:s");
$temp = "";
checkSession();
$user_id = $_SESSION["id"];
$chicagotime = date("Y-m-d H:i:s");
//$line = "<b>-</b>";
$line = "";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $sitename; ?>
        | Custom Dashboard</title>
    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet"
          type="text/css">
    <link href="../assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/colors.css" rel="stylesheet" type="text/css">
    <link href="../assets/css/style_main.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->
    <!-- Core JS files -->
    <script type="text/javascript" src="../assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="../assets/js/libs/jquery-3.6.0.min.js"> </script>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->
    <!-- Theme JS files -->
    <script type="text/javascript" src="../assets/js/plugins/tables/datatables/datatables.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/forms/selects/select2.min.js"></script>
    <script type="text/javascript" src="../assets/js/pages/datatables_basic.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/ui/ripple.min.js"> </script>
    <script type="text/javascript" src="../assets/js/plugins/notifications/sweet_alert.min.js"> </script>
    <script type="text/javascript" src="../assets/js/pages/components_modals.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/ui/ripple.min.js"></script>
    <script type="text/javascript" src="../assets/js/plugins/forms/selects/bootstrap_select.min.js"></script>
    <script type="text/javascript" src="../assets/js/pages/form_bootstrap_select.js"></script>
    <script type="text/javascript" src="../assets/js/pages/form_layouts.js"></script>
    <script src="./assets/js/BrowserPrint.js"></script>
    <script src="./assets/js/DevDemo.js"></script>
    <style> .sidebar-default .navigation li > a {
            color: #f5f5f5
        }

        ;
        a:hover {
            background-color: #20a9cc;
        }

        .sidebar-default .navigation li > a:focus, .sidebar-default .navigation li > a:hover {
            background-color: #20a9cc;
        }

        .content-wrapper {
            display: block !important;
            vertical-align: top;
            padding: 20px !important;
        }



        .bg-primary {
            background-color: #606060!important;
        }
        .col-md-3 {
            width: 25%;
            padding-top: 10px;
        }


        .red {
            color: red;
            display: none;
        }
        @media only screen and (max-width: 760px), (min-device-width: 768px) and (max-device-width: 1024px) {
            .col-md-3 {
                width: 100%;
                padding-top: 10px;
            }
        }
    </style>
</head>
<body>
<!-- Main navbar -->
<?php
$cam_page_header = "Good & Bad Pieces";
include("../header_folder.php");
if ($is_tab_login || ($_SESSION["role_id"] == "pn_user")) {
    include("../tab_menu.php");
} else {
    include("../admin_menu.php");
}

?>
<!-- Content area -->
<div class="content">

    <div class="panel panel-flat">

        <div class="panel-heading" style="padding: 50px;">
            <div class="row">
                <div class="search_container"  style="margin-right:10px;">
                    <input id="search" class="search__input"  type="text" placeholder="Search Station" style="margin-left: 15px;padding: 12px 24px;background-color: transparent;transition: transform 250ms ease-in-out;line-height: 18px;color: #000000;font-size: 18px;background-color: transparent; background-repeat: no-repeat;
        background-size: 18px 18px;
        background-position: 95% center;
        border-radius: 50px;
        border: 1px solid #575756;
        transition: all 250ms ease-in-out;
        backface-visibility: hidden;
        transform-style: preserve-3d;
        " >
                </div>
            </div>

            </br>

            <div class="row">
                <?php $query = sprintf("SELECT * FROM sg_cust_dashboard where enabled = 1");
                $qur = mysqli_query($db, $query);
                while ($rowc = mysqli_fetch_array($qur)) {
                    $c_id = $rowc["sg_cust_group_id"];
                    $c_name = $rowc["sg_cust_dash_name"];
                    $enabled = $rowc["enabled"];
                    if ($enabled == 1) { ?>
                        <div class="col-md-3">
                            <a target="_blank" href="<?php echo $siteURL; ?>config_module/sg_cust_dashboard.php?id=<?php echo $c_id ?>">
                                <button type="button" class="btn btn-primary view_gpbp"  style="white-space: normal;background-color:#020d7ce6 !important;width:98% ; padding-top: 1vh; font-size: medium; text-align: center;"><?php echo $c_name ?></button></a>

                        </div>

                    <?php }
                } ?>

            </div>
        </div>

    </div>
    <!-- Basic datatable -->

</div>
<!-- /content area -->

<script>
    $("#search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".view_gpbp").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

</script>


<?php include('../footer.php') ?>

    </body>
    </html>