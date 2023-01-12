<?php include("../config.php");
$chicagotime = date("Y-m-d H:i:s");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo $sitename; ?> | Menu</title>

    <!-- ICONS CSS -->
    <link href="https://laravel8.spruko.com/nowa/assets/plugins/icons/icons.css" rel="stylesheet">

    <!-- BOOTSTRAP CSS -->
    <link href="https://laravel8.spruko.com/nowa/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- RIGHT-SIDEMENU CSS -->
    <link href="https://laravel8.spruko.com/nowa/assets/plugins/sidebar/sidebar.css" rel="stylesheet">

    <!-- P-SCROLL BAR CSS -->
    <link href="https://laravel8.spruko.com/nowa/assets/plugins/perfect-scrollbar/p-scrollbar.css" rel="stylesheet" />


    <!-- INTERNAL Select2 css -->
    <link href="<?php echo $siteURL; ?>assets/css/form_css/select2.min.css" rel="stylesheet" />


    <!-- STYLES CSS -->
    <link href="<?php echo $siteURL; ?>assets/css/form_css/style.css" rel="stylesheet">
    <link href="<?php echo $siteURL; ?>assets/css/form_css/style-dark.css" rel="stylesheet">
    <link href="<?php echo $siteURL; ?>assets/css/form_css/style-transparent.css" rel="stylesheet">


    <!-- SKIN-MODES CSS -->
    <link href="https://laravel8.spruko.com/nowa/assets/css/skin-modes.css" rel="stylesheet" />

    <!-- ANIMATION CSS -->
    <link href="https://laravel8.spruko.com/nowa/assets/css/animate.css" rel="stylesheet">

    <!-- SWITCHER CSS -->
    <link href="https://laravel8.spruko.com/nowa/assets/switcher/css/switcher.css" rel="stylesheet"/>
    <link href="<?php echo $siteURL; ?>assets/js/form_css/demo.css" rel="stylesheet"/>
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
    <link href="<?php echo $siteURL; ?>assets/js/form_css/demo.css" rel="stylesheet"/>
    <!-- anychart documentation -->
    <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-base.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-data-adapter.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-ui.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-exports.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-pareto.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-core.min.js"></script>
    <script src="https://cdn.anychart.com/releases/8.11.0/js/anychart-circular-gauge.min.js"></script>
    <link href="https://cdn.anychart.com/releases/8.11.0/css/anychart-ui.min.css" type="text/css" rel="stylesheet">
    <link href="https://cdn.anychart.com/releases/8.11.0/fonts/css/anychart-font.min.css" type="text/css"
          rel="stylesheet">
    <!-- ICONS CSS -->
    <link href="https://laravel8.spruko.com/nowa/assets/plugins/icons/icons.css" rel="stylesheet">

    <!-- BOOTSTRAP CSS -->
    <link href="https://laravel8.spruko.com/nowa/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- RIGHT-SIDEMENU CSS -->
    <link href="https://laravel8.spruko.com/nowa/assets/plugins/sidebar/sidebar.css" rel="stylesheet">

    <!-- P-SCROLL BAR CSS -->
    <link href="https://laravel8.spruko.com/nowa/assets/plugins/perfect-scrollbar/p-scrollbar.css" rel="stylesheet" />


    <!-- INTERNAL Select2 css -->
    <link href="<?php echo $siteURL; ?>assets/css/form_css/select2.min.css" rel="stylesheet" />


    <!-- STYLES CSS -->
    <link href="<?php echo $siteURL; ?>assets/css/form_css/style.css" rel="stylesheet">
    <link href="<?php echo $siteURL; ?>assets/css/form_css/style-dark.css" rel="stylesheet">
    <link href="<?php echo $siteURL; ?>assets/css/form_css/style-transparent.css" rel="stylesheet">


    <!-- SKIN-MODES CSS -->
    <link href="https://laravel8.spruko.com/nowa/assets/css/skin-modes.css" rel="stylesheet" />

    <!-- ANIMATION CSS -->
    <link href="https://laravel8.spruko.com/nowa/assets/css/animate.css" rel="stylesheet">

    <!-- SWITCHER CSS -->
    <link href="https://laravel8.spruko.com/nowa/assets/switcher/css/switcher.css" rel="stylesheet"/>
    <link href="<?php echo $siteURL; ?>assets/js/form_js/demo.css" rel="stylesheet"/>
    <style>

        .logo-horizontal {
            width: 150px;
        }
        img.mobile-logo.logo-1 {
            width: 150px;
        }
        .breadcrumb-header {sticky
        margin-left: 20px;
        }
        .main-profile-menu .dropdown-menu:before{
            right: 135px;
        }
        .main-profile-menu .dropdown-menu{
            width: 100%;
            position: fixed;
        }
        .nav .nav-item .dropdown-menu{
            top: 60px;
        }
    </style>

</head>

<body class="ltr main-body app horizontal">

<!-- Page -->
<div class="page">

    <div>

        <!-- main-header -->
        <div class="main-header side-header sticky nav nav-item">
            <div class=" main-container container-fluid">
                <div class="main-header-left ">
                    <div class="responsive-logo">
                        <a href="<?php echo $siteURL; ?>line_status_grp_dashboard.php" class="header-logo">
                            <img src="<?php echo $siteURL; ?>assets/img/SGG_logo.png" class="mobile-logo logo-1" alt="logo">
                            <img src="<?php echo $siteURL; ?>assets/img/SGG_logo.png" class="mobile-logo dark-logo-1" alt="logo">
                        </a>
                    </div>

                    <div class="logo-horizontal">
                        <a href="<?php echo $siteURL; ?>line_status_grp_dashboard.php" class="header-logo">
                            <img src="<?php echo $siteURL; ?>assets/img/SGG_logo.png" class="mobile-logo logo-1" alt="logo">
                            <img src="<?php echo $siteURL; ?>assets/img/SGG_logo.png" class="mobile-logo dark-logo-1" alt="logo">
                        </a>
                    </div>
                </div>
                <div class="main-header-right">
                    <button class="navbar-toggler navresponsive-toggler d-md-none ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon fe fe-more-vertical "></span>
                    </button>
                    <div class="mb-0 navbar navbar-expand-lg navbar-nav-right responsive-navbar navbar-dark p-0">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                            <ul class="nav nav-item header-icons navbar-nav-right ms-auto">

                                <li class="dropdown main-profile-menu nav nav-item nav-link ps-lg-2">
                                    <a class="new nav-link profile-user d-flex" href="" data-bs-toggle="dropdown"><i class="fa fa-bars" aria-hidden="true"></i></a>
                                    <div class="dropdown-menu">
                                        <!-- main-sidebar -->
                                        <div class="sticky">
                                            <aside class="app-sidebar">
                                                <div class="main-sidebar-header active">
                                                    <a class="header-logo active" href="<?php echo $siteURL; ?>line_status_grp_dashboard.php">
                                                        <img src="<?php echo $siteURL; ?>assets/img/SGG_logo.png" class="main-logo  desktop-logo" alt="logo">
                                                        <img src="<?php echo $siteURL; ?>assets/img/SGG_logo.png" class="main-logo  desktop-dark" alt="logo">
                                                        <img src="<?php echo $siteURL; ?>assets/img/SGG_logo.png" class="main-logo  mobile-logo" alt="logo">
                                                        <img src="<?php echo $siteURL; ?>assets/img/SGG_logo.png" class="main-logo  mobile-dark" alt="logo">
                                                    </a>
                                                </div>
                                                <div class="main-sidemenu">
                                                    <ul class="side-menu">
                                                        <li>
                                                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z"/></svg><span class="side-menu__label">Good & Bad Piece</span></a>
                                                        </li>
                                                        <li>
                                                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11-6h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zm-1 6h-4V5h4v4zm-9 4H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6H5v-4h4v4zm8-6c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z"/></svg><span class="side-menu__label">Material Tracability</span></a>

                                                        </li>
                                                        <li>
                                                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M20 17V7c0-2.168-3.663-4-8-4S4 4.832 4 7v10c0 2.168 3.663 4 8 4s8-1.832 8-4zM12 5c3.691 0 5.931 1.507 6 1.994C17.931 7.493 15.691 9 12 9S6.069 7.493 6 7.006C6.069 6.507 8.309 5 12 5zM6 9.607C7.479 10.454 9.637 11 12 11s4.521-.546 6-1.393v2.387c-.069.499-2.309 2.006-6 2.006s-5.931-1.507-6-2V9.607zM6 17v-2.393C7.479 15.454 9.637 16 12 16s4.521-.546 6-1.393v2.387c-.069.499-2.309 2.006-6 2.006s-5.931-1.507-6-2z"/></svg><span class="side-menu__label">View Material Tracability</span></a>
                                                        </li>
                                                        <li>
                                                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M20.995 6.9a.998.998 0 0 0-.548-.795l-8-4a1 1 0 0 0-.895 0l-8 4a1.002 1.002 0 0 0-.547.795c-.011.107-.961 10.767 8.589 15.014a.987.987 0 0 0 .812 0c9.55-4.247 8.6-14.906 8.589-15.014zM12 19.897C5.231 16.625 4.911 9.642 4.966 7.635L12 4.118l7.029 3.515c.037 1.989-.328 9.018-7.029 12.264z"/><path d="m11 12.586-2.293-2.293-1.414 1.414L11 15.414l5.707-5.707-1.414-1.414z"/></svg><span class="side-menu__label">Submit 10X</span></a>
                                                        </li>
                                                        <li>
                                                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M22 7.999a1 1 0 0 0-.516-.874l-9.022-5a1.003 1.003 0 0 0-.968 0l-8.978 4.96a1 1 0 0 0-.003 1.748l9.022 5.04a.995.995 0 0 0 .973.001l8.978-5A1 1 0 0 0 22 7.999zm-9.977 3.855L5.06 7.965l6.917-3.822 6.964 3.859-6.918 3.852z"/><path d="M20.515 11.126 12 15.856l-8.515-4.73-.971 1.748 9 5a1 1 0 0 0 .971 0l9-5-.97-1.748z"/><path d="M20.515 15.126 12 19.856l-8.515-4.73-.971 1.748 9 5a1 1 0 0 0 .971 0l9-5-.97-1.748z"/></svg><span class="side-menu__label">View 10X</span></a>
                                                        <li>
                                                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M12 22c4.879 0 9-4.121 9-9s-4.121-9-9-9-9 4.121-9 9 4.121 9 9 9zm0-16c3.794 0 7 3.206 7 7s-3.206 7-7 7-7-3.206-7-7 3.206-7 7-7zm5.284-2.293 1.412-1.416 3.01 3-1.413 1.417zM5.282 2.294 6.7 3.706l-2.99 3-1.417-1.413z"/><path d="M11 9h2v5h-2zm0 6h2v2h-2z"/></svg><span class="side-menu__label">View Station Status</span></a>
                                                        </li>
                                                        <li>
                                                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M20 7h-1.209A4.92 4.92 0 0 0 19 5.5C19 3.57 17.43 2 15.5 2c-1.622 0-2.705 1.482-3.404 3.085C11.407 3.57 10.269 2 8.5 2 6.57 2 5 3.57 5 5.5c0 .596.079 1.089.209 1.5H4c-1.103 0-2 .897-2 2v2c0 1.103.897 2 2 2v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7c1.103 0 2-.897 2-2V9c0-1.103-.897-2-2-2zm-4.5-3c.827 0 1.5.673 1.5 1.5C17 7 16.374 7 16 7h-2.478c.511-1.576 1.253-3 1.978-3zM7 5.5C7 4.673 7.673 4 8.5 4c.888 0 1.714 1.525 2.198 3H8c-.374 0-1 0-1-1.5zM4 9h7v2H4V9zm2 11v-7h5v7H6zm12 0h-5v-7h5v7zm-5-9V9.085L13.017 9H20l.001 2H13z"/></svg><span class="side-menu__label">Add/Update Events</span></a>
                                                        </li>
                                                        <li>
                                                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M20 7h-4V4c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H4c-1.103 0-2 .897-2 2v9a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V9c0-1.103-.897-2-2-2zM4 11h4v8H4v-8zm6-1V4h4v15h-4v-9zm10 9h-4V9h4v10z"/></svg><span class="side-menu__label">Create Form</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </aside>
                                        </div>
                                        <!-- main-sidebar -->
                                        <!-- main-sidebar -->
                                        <div class="sticky">
                                            <aside class="app-sidebar">
                                                <div class="main-sidebar-header active">
                                                    <a class="header-logo active" href="<?php echo $siteURL; ?>line_status_grp_dashboard.php">
                                                        <img src="<?php echo $siteURL; ?>assets/img/SGG_logo.png" class="main-logo  desktop-logo" alt="logo">
                                                        <img src="<?php echo $siteURL; ?>assets/img/SGG_logo.png" class="main-logo  desktop-dark" alt="logo">
                                                        <img src="<?php echo $siteURL; ?>assets/img/SGG_logo.png" class="main-logo  mobile-logo" alt="logo">
                                                        <img src="<?php echo $siteURL; ?>assets/img/SGG_logo.png" class="main-logo  mobile-dark" alt="logo">
                                                    </a>
                                                </div>
                                                <div class="main-sidemenu">
                                                    <ul class="side-menu">
                                                        <li>
                                                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"/></svg><span class="side-menu__label">Assign/Unassign crew</span></a>
                                                        </li>
                                                        <li>
                                                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M19.937 8.68c-.011-.032-.02-.063-.033-.094a.997.997 0 0 0-.196-.293l-6-6a.997.997 0 0 0-.293-.196c-.03-.014-.062-.022-.094-.033a.991.991 0 0 0-.259-.051C13.04 2.011 13.021 2 13 2H6c-1.103 0-2 .897-2 2v16c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2V9c0-.021-.011-.04-.013-.062a.99.99 0 0 0-.05-.258zM16.586 8H14V5.414L16.586 8zM6 20V4h6v5a1 1 0 0 0 1 1h5l.002 10H6z"/></svg><span class="side-menu__label">View Document</span></a>
                                                        </li>
                                                        <li>
                                                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M19 3H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2zm0 2 .001 4H5V5h14zM5 11h8v8H5v-8zm10 8v-8h4.001l.001 8H15z"/></svg><span class="side-menu__label">Submit Station Assets</span></a>
                                                        </li>
                                                        <li>
                                                            <a class="side-menu__item" href="https://laravel8.spruko.com/nowa/widgets"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11 4h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6h-4v-4h4v4zM17 3c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2zM7 13c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z"/></svg><span class="side-menu__label">Form Submit Dashboard</span></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </aside>
                                        </div>
                                        <!-- main-sidebar -->
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- /main-header -->


    </div>

    <!-- main-content -->
    <div class="main-content app-content">

        <!-- container -->
        <div class="main-container container-fluid">


            <!-- breadcrumb -->
            <div class="breadcrumb-header justify-content-between">
                <div class="left-content">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">Events Module</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Good Bad Piece</li>
                    </ol>

                </div>

            </div>
            <!-- /breadcrumb -->

            <!-- row -->
            <div class="row row-body">
                <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                    <div class="card  box-shadow-0">
                        <div class="card-header">
                            <h4 class="card-title mb-1 text-white"><?php if($cus_name != ""){ echo $cus_name; }else{ echo "Customer Name";} ?></h4>
                        </div>
                        <div class="card-body pt-0">
                            <div class="card user-wideget user-wideget-widget widget-user">
                                <div class="widget-user-header br-te-5  br-ts-5  bg-primary">
                                    <h3 class="widget-user-username">Part Family - <?php echo $pm_part_family_name; ?></h3>
                                    <h3 class="widget-user-username">Part Number - <?php echo $pm_part_number; ?></h3>
                                    <h3 class="widget-user-username">Part Name - <?php echo $pm_part_name; ?></h3>
                                </div>
                                <div class="widget-user-image">
                                    <img  src="../supplier_logo/<?php if($logo != ""){ echo $logo; }else{ echo "user.png"; } ?>" class="brround" alt="User Avatar">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-6 col-md-12 col-sm-12">
                    <div class="card  box-shadow-0 ">
                        <div class="card-header">
                            <h4 class="card-title mb-1 text-white">Current Staff Efficiency</h4>
                        </div>
                        <div class="card-body pt-0">
                            <div class="card user-wideget user-wideget-widget widget-user">
                                <div class="widget-user-header br-te-5  br-ts-5  bg-primary">
                                    <h6>Target Pieces - <?php echo $target_eff; ?></h6>
                                    <h6>Actual Pieces - <?php echo $actual_eff; ?></h6>
                                    <h6>Efficiency - <?php echo $eff; ?>%</h6>
                                </div>
                                <div class="widget-user-graph">
                                    <div id="eff_container" class="img-circle"></div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- row -->
            </div>
            <!-- row -->
            <div class="row row-body">
                <?php
                $sql = "select SUM(good_pieces) as good_pieces,SUM(bad_pieces) AS bad_pieces,SUM(rework) as rework from good_bad_pieces_details where station_event_id ='$station_event_id' ";
                $result1 = mysqli_query($db, $sql);
                $rowc = mysqli_fetch_array($result1);
                $gp = $rowc['good_pieces'];
                if(empty($gp)){
                    $g = 0;
                }else{
                    $g = $gp;
                }
                $bp = $rowc['bad_pieces'];
                if(empty($bp)){
                    $b = 0;
                }else{
                    $b = $bp;
                }
                $rwp = $rowc['rework'];
                if(empty($rwp)){
                    $r = 0;
                }else{
                    $r = $rwp;
                }
                $tp = $gp + $bp+ $rwp;
                if(empty($tp)){
                    $t = 0;
                }else{
                    $t = $tp;
                }
                ?>
                <div class="col-lg-6 col-xl-3 col-md-6 col-12">
                    <div class="card bg-primary-gradient text-white ">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mt-0 text-center">
                                        <span class="text-white">Total Pieces</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mt-0 text-center">

                                        <h2 class="text-white mb-0"><?php echo $t ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3 col-md-6 col-12">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mt-0 text-center">
                                        <span class="text-white">Total Good Pieces</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mt-0 text-center">
                                        <h2 class="text-white mb-0"><?php echo $g ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3 col-md-6 col-12">
                    <div class="card bg-danger-gradient text-white">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mt-0 text-center">
                                        <span class="text-white">Total Bad Pieces</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mt-0 text-center">
                                        <h2 class="text-white mb-0"><?php echo $b ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-3 col-md-6 col-12">
                    <div class="card bg-warning-gradient text-white">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="mt-0 text-center">
                                        <span class="text-white">Rework</span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="mt-0 text-center">
                                        <h2 class="text-white mb-0"><?php echo $r ?></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row row-body">
                <div class="col-sm-12 col-md-12">
                    <div class="card custom-card">
                        <div class="card-body pb-0">
                            <div class="input-group mb-2">
                                <input id="search" type="text" class="form-control" placeholder="Searching....." >
                                <span class="input-group-append">
                           <button class="btn ripple btn-primary" type="button" fdprocessedid="jzln6h">Search</button>
                    </span>
                            </div>
                            <div class="input-group mb-2">
                                <a class="form-control btn ripple btn-success" href="<?php echo $siteURL; ?>events_module/add_good_piece.php?station_event_id=<?php echo $station_event_id; ?>">IN-SPEC</a>
                            </div>
                            <div class="text-wrap">
                                <div class="example">
                                    <div class="btn-list">

                                        <?php
                                        $i = 1;
                                        $def_list_arr = array();
                                        $sql1 = "SELECT * FROM `defect_list` ORDER BY `defect_list_name` ASC";
                                        $result1 = $mysqli->query($sql1);
                                        while ($row1 = $result1->fetch_assoc()) {
                                            $pnums = $row1['part_number_id'];
                                            $arr_pnums = explode(',', $pnums);
                                            if (in_array($part_number, $arr_pnums)) {
                                                array_push($def_list_arr, $row1['defect_list_id']);
                                            }
                                        }

                                        $sql1 = "SELECT sdd.defect_list_id as dl_id FROM sg_defect_group as sdg inner join sg_def_defgroup as sdd on sdg.d_group_id = sdd.d_group_id WHERE FIND_IN_SET('$part_number',sdg.part_number_id) > 0";
                                        $result1 = $mysqli->query($sql1);
                                        while ($row1 = $result1->fetch_assoc()) {
                                            array_push($def_list_arr, $row1['dl_id']);
                                        }
                                        $def_list_arr = array_unique($def_list_arr);
                                        $def_lists = implode("', '", $def_list_arr);
                                        $sql1 = "SELECT * FROM `defect_list` where  defect_list_id IN ('$def_lists') ORDER BY `defect_list_name` ASC";
                                        $result1 = $mysqli->query($sql1);
                                        while ($row1 = $result1->fetch_assoc()) {
                                            ?>
                                            <a href="<?php echo $siteURL; ?>events_module/add_bad_piece.php?station_event_id=<?php echo $station_event_id; ?>&defect_list_id=<?php echo $row1['defect_list_id']; ?>" class="btn bg-danger-gradient text-white view_gpbp"><?php echo $row1['defect_list_name']; ?></a>
                                            <?php
                                            if($i == 4)
                                            {
                                                $i = 0;
                                            }

                                            $i++;
                                        }
                                        ?>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row row-body">
                <div class="col-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">
                                <button type="button" class="btn btn-danger btn-sm br-5" onclick="submitForm('delete_form_option.php')">
                                    <i>
                                        <svg class="table-delete" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9zm7.5-5l-1-1h-5l-1 1H5v2h14V4h-3.5z"></path></svg>
                                    </i>
                                </button></h4>
                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table  table-bordered text-nowrap mb-0" id="example2">
                                    <thead>
                                    <tr>
                                        <th><label class="ckbox"><input type="checkbox" id="checkAll" ><span></span></label></th>
                                        <th class="text-center">S.No</th>
                                        <th>Good Pieces</th>
                                        <th>Defect Name</th>
                                        <th>Bad Pieces</th>
                                        <th>Re-Work</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $station_event_id = $_GET['station_event_id'];
                                    $query = sprintf("SELECT gbpd.bad_pieces_id as bad_pieces_id , gbpd.good_pieces as good_pieces, gbpd.defect_name as defect_name, gbpd.bad_pieces as bad_pieces ,gbpd.rework as rework FROM good_bad_pieces_details as gbpd where gbpd.station_event_id  = '$station_event_id' order by gbpd.bad_pieces_id DESC");
                                    $qur = mysqli_query($db, $query);
                                    while ($rowc = mysqli_fetch_array($qur)) {
                                        $bad_pieces_id = $rowc['bad_pieces_id'];
                                        $good_pieces = $rowc['good_pieces'];
                                        $bad_pieces = $rowc['bad_pieces'];
                                        $rework = $rowc['rework'];
                                        $style = "";

                                        ?>
                                        <tr>
                                            <td class="text-center"><label class="ckbox"><input type="checkbox" id="delete_check[]" name="delete_check[]" value="<?php echo $rowc["bad_pieces_id"]; ?>"><span></span></label></td>
                                            <td><?php echo ++$counter; ?></td>
                                            <td><?php if($rowc['good_pieces'] != ""){echo $rowc['good_pieces']; }else{ echo $line; } ?></td>
                                            <td><?php $un = $rowc['defect_name']; if($un != ""){ echo $un; }else{ echo $line; } ?></td>
                                            <td><?php if($rowc['bad_pieces'] != ""){echo $rowc['bad_pieces'];}else{ echo $line; } ?></td>
                                            <td><?php if($rowc['rework'] != ""){echo $rowc['rework']; }else{ echo $line; } ?></td>
                                            <?php
                                            $qur04 = mysqli_query($db, "SELECT * FROM good_bad_pieces_details where station_event_id= '$station_event_id' ORDER BY `bad_pieces_id` DESC LIMIT 1");
                                            $rowc04 = mysqli_fetch_array($qur04);
                                            $bad_trace_id = $rowc04["bad_pieces_id"];

                                            $query1 = sprintf("SELECT bad_piece_id,good_image_name FROM  good_piece_images where bad_piece_id = '$bad_trace_id'");
                                            $qur1 = mysqli_query($db, $query1);
                                            $rowc1 = mysqli_fetch_array($qur1);
                                            $item_id = $rowc1['bad_piece_id'];
                                            $image_name = $rowc1['good_image_name'];

                                            ?>
                                            <?php
                                            if($rowc['good_pieces'] != ""){ ?>
                                                <td><span class="badge badge-success">Good Pieces</span></td>
                                            <?php }
                                            if($rowc['bad_pieces'] != ""){ ?>
                                                <td><span class="badge badge-danger">Bad Pieces</span></td>
                                            <?php }
                                            if($rowc['rework'] != ""){ ?>
                                                <td><span class="badge badge-primary">Rework Pieces</span></td>
                                            <?php } ?>

                                            <td class="">
                                                <?php   if($rowc['good_pieces'] != ""){ ?>
                                                    <a  href="<?php echo $siteURL; ?>events_module/edit_good_piece.php?station_event_id=<?php echo $station_event_id; ?>&bad_pieces_id=<?php echo $bad_pieces_id;?>" data-id="<?php echo $rowc['good_bad_pieces_id']; ?>" data-gbid="<?php echo $rowc['bad_pieces_id']; ?>" data-seid="<?php echo $station_event_id; ?>" data-good_pieces="<?php echo $rowc['good_pieces']; ?>"
                                                        data-defect_name="<?php echo $rowc['defect_name']; ?>" data-bad_pieces="<?php echo $rowc['bad_pieces']; ?>" data-re_work="<?php echo $rowc['rework']; ?>" data-image="<?php echo $item_id; ?>"
                                                        data-image_name="<?php echo $image_name; ?>" class="btn btn-success btn-sm br-5 me-2" id="edit">
                                                        <i>
                                                            <svg class="table-edit" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-.45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z"></path></svg>
                                                        </i>
                                                    </a>
                                                <?php } elseif($rowc['bad_pieces'] != ""){?>
                                                    <a href="<?php echo $siteURL; ?>events_module/edit_bad_piece.php?station_event_id=<?php echo $station_event_id; ?>&bad_pieces_id=<?php echo $bad_pieces_id;?>" data-id="<?php echo $rowc['good_bad_pieces_id']; ?>" data-gbid="<?php echo $rowc['bad_pieces_id']; ?>" data-seid="<?php echo $station_event_id; ?>" data-good_pieces="<?php echo $rowc['good_pieces']; ?>"
                                                       data-defect_name="<?php echo $rowc['defect_name']; ?>" data-bad_pieces="<?php echo $rowc['bad_pieces']; ?>" data-re_work="<?php echo $rowc['rework']; ?>" data-image="<?php echo $item_id; ?>"
                                                       data-image_name="<?php echo $image_name; ?>" class="btn btn-success btn-sm br-5 me-2" id="edit">
                                                        <i>
                                                            <svg class="table-edit" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-.45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z"></path></svg>
                                                        </i>
                                                    </a>
                                                    <?php if($rowc['bad_pieces'] != "")  { ?>
                                                        <a href="<?php echo $siteURL; ?>events_module/view_bad_piece.php?station_event_id=<?php echo $station_event_id; ?>&bad_pieces_id=<?php echo $bad_pieces_id;?>" data-id="<?php echo $rowc['good_bad_pieces_id']; ?>" data-gbid="<?php echo $rowc['bad_pieces_id']; ?>" data-seid="<?php echo $station_event_id; ?>" data-good_pieces="<?php echo $rowc['good_pieces']; ?>"
                                                           data-defect_name="<?php echo $rowc['defect_name']; ?>" data-bad_pieces="<?php echo $rowc['bad_pieces']; ?>" data-re_work="<?php echo $rowc['rework']; ?>" data-image="<?php echo $item_id; ?>" class="btn btn-success btn-sm br-5 me-2" id="edit">
                                                            <i class="fa fa-eye" style="padding: 4px;font-size: 14px;margin-left: -3px;"></i>
                                                        </a> <?php }else{ echo $line; } ?>
                                                <?php } else{ ?>
                                                    <a href="<?php echo $siteURL; ?>events_module/rework_piece.php?station_event_id=<?php echo $station_event_id; ?>&bad_pieces_id=<?php echo $bad_pieces_id;?>" data-id="<?php echo $rowc['good_bad_pieces_id']; ?>" data-gbid="<?php echo $rowc['bad_pieces_id']; ?>" data-seid="<?php echo $station_event_id; ?>" data-good_pieces="<?php echo $rowc['good_pieces']; ?>"
                                                       data-defect_name="<?php echo $rowc['defect_name']; ?>" data-bad_pieces="<?php echo $rowc['bad_pieces']; ?>" data-re_work="<?php echo $rowc['rework']; ?>" data-image="<?php echo $item_id; ?>"
                                                       data-image_name="<?php echo $image_name; ?>" class="btn btn-success btn-sm br-5 me-2" id="edit">
                                                        <i>
                                                            <svg class="table-edit" xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM5.92 19H5v-.92l9.06-9.06.92.92L5.92 19zM20.71 5.63l-2.34-2.34c-.2-.2-.45-.29-.71-.29s-.51.1-.7.29l-1.83 1.83 3.75 3.75 1.83-1.83c.39-.39.39-1.02 0-1.41z"></path></svg>
                                                        </i>
                                                    </a>
                                                <?php } ?>
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
        <!-- Container closed -->
    </div>
    <!-- main-content closed -->



    <!-- Footer opened -->
    <?php include('../footer1.php') ?>

    <!-- Footer closed -->

</div>
<!-- End Page -->

<script>
    //Efficiency
    anychart.onDocumentReady(function () {
        var data = this.window.location.href.split('?')[1];
        $.ajax({
            type: 'POST',
            url: 'gbp_eff.php',
            // dataType: 'good_bad_piece_fa.php',
            data: data,
            success: function (data1) {
                var data = JSON.parse(data1);
                // console.log(data);
                var target_eff = data.posts.map(function (elem) {
                    return elem.target_eff;
                });
                // console.log(goodpiece);
                // var avg_npr = data.posts.map(function (elem) {
                //     return elem.avg_npr;
                // });
                var actual_eff = data.posts.map(function (elem) {
                    return elem.actual_eff;
                });

                var eff = data.posts.map(function (elem) {
                    return elem.eff;
                });
                // var range1 = avg_npr;
                var range1 = actual_eff;
                var range2 = target_eff;
                var range3 = eff;

                var fill3 = '#009900 0.8';
                var fill2 = '#B31B1B 0.8';
                var fill1 = '#B31B1B 0.8';

                var maxr3 =  parseFloat(range2) + parseFloat(range2 * .2)


                if((actual_eff >= target_eff)){
                    range1 = target_eff;
                    // range2 = avg_npr;
                    range2 = actual_eff;
                    fill1 = '#009900 0.8';
                    fill2 = '#009900 0.8';
                    fill3 = '#B31B1B 0.8';
                    maxr3 =  parseFloat(target_eff) + parseFloat(target_eff * .2)
                }

                var gauge = anychart.gauges.circular();
                gauge
                    .fill('#fff')
                    .stroke(null)
                    .padding(50)
                    .margin(0)
                    .startAngle(270)
                    .sweepAngle(180);

                gauge
                    .axis()
                    .labels()
                    .padding(5)
                    .fontSize(15)
                    .position('outside')
                    .format('{%Value}');

                gauge.data([actual_eff]);
                gauge
                    .axis()
                    .scale()
                    .minimum(0)
                    .maximum(maxr3)
                    .ticks({ interval: 1 })
                    .minorTicks({ interval: 1 });

                gauge
                    .axis()
                    .fill('#545f69')
                    .width(1)
                    .ticks({ type: 'line', fill: 'white', length: 2 });

                gauge.title(
                    /* '<div style=\'color:#333; font-size: 20px;\'> <span style="color:#009900; font-size: 22px;"><strong> ' +target_eff+' </strong><l/span></div>' +
                     '<br/><br/><div style=\'color:#333; font-size: 20px;\'> <span style="color:#009900; font-size: 22px;"><strong> ' +actual_eff+' </strong></span></div><br/><br/>' +
                     '<div style=\'color:#333; font-size: 20px;\'> <span style="color:#009900; font-size: 22px;"><strong> ' +eff+' </strong>%</span></div><br/><br/>'*/
                );

                gauge
                    .title()
                    .useHtml(true)
                    .padding(0)
                    .fontColor('#212121')
                    .hAlign('center')
                    .margin([0, 0, 10, 0]);

                gauge
                    .needle()
                    .stroke('2 #545f69')
                    .startRadius('5%')
                    .endRadius('90%')
                    .startWidth('0.1%')
                    .endWidth('0.1%')
                    .middleWidth('0.1%');

                gauge.cap().radius('3%').enabled(true).fill('#545f69');

                gauge.range(0, {
                    from: 0,
                    to: range1,
                    position: 'inside',
                    fill: fill1,
                    startSize: 50,
                    endSize: 50,
                    radius: 98
                });

                gauge.range(1, {
                    from: range1,
                    to: range2,
                    position: 'inside',
                    fill: fill2,
                    startSize: 50,
                    endSize: 50,
                    radius: 98
                });

                gauge.range(2, {
                    from: range2,
                    to: (maxr3),
                    position: 'inside',
                    fill: '#009900 0.8',
                    startSize: 50,
                    endSize: 50,
                    radius: 98

                });

                gauge
                    .label(1)
                    .text('')
                    .fontColor('#212121')
                    .fontSize(20)
                    .offsetY('68%')
                    .offsetX(25)
                    .anchor('center');
                gauge
                    .label(2)
                    .text('')
                    .fontColor('#212121')
                    .fontSize(20)
                    .offsetY('68%')
                    .offsetX(90)
                    .anchor('center');

                gauge
                    .label(3)
                    .text('')
                    .fontColor('#212121')
                    .fontSize(20)
                    .offsetY('68%')
                    .offsetX(155)
                    .anchor('center');


                // set container id for the chart
                gauge.container('eff_container');
                // initiate chart drawing
                gauge.draw();
            }
        });
    });
</script>
<script> $(document).on('click', '#add_gp', function () {
        var element = $(this);
        var del_id = element.attr("data-id");
        var info = 'station_event_id=' + <?php echo $station_event_id; ?>;
        var url = window.location.origin + "/events_module/add_good_piece.php?" + info;
        window.close();
        window.open(url,"_blank");

    });</script>

<script>
    $("#submitForm_good").click(function (e) {

        // function submitForm_good(url) {

        $(':input[type="button"]').prop('disabled', true);
        var data = $("#good_form").serialize();
        //var main_url = "<?php //echo $url; ?>//";
        $.ajax({
            type: 'POST',
            url: 'create_good_bad_piece.php',
            data: data,
            // dataType: "json",
            // context: this,
            async: false,
            success: function (data) {
                // window.location.href = window.location.href + "?aa=Line 1";
                // $(':input[type="button"]').prop('disabled', false);
                var line_id = this.data.split('&')[1].split("=")[1];
                var pe = this.data.split('&')[2].split("=")[1];
                var ff1 = this.data.split('&')[3].split("=")[1];
                var file1 = '../assets/label_files/' + line_id +'/g_'+ff1;
                var file = '../assets/label_files/' + line_id +'/g_'+ff1;;
                var ipe = document.getElementById("ipe").value;
                if(pe == '1'){
                    if(ipe == '1'){
                        var i;
                        var nogp = document.getElementById("good_name").value;
                        //alert('no of good pieces are' +nogp);
                        //for(var i = 1; i <= nogp; i++) {
                        document.getElementById("resultFrame").contentWindow.ss(file1);
                        // alert('no of good pieces are' +nogp);
                        //}
                        // document.getElementById("resultFrame").contentWindow.ss(file , nogp);
                    }else{
                        document.getElementById("resultFrame").contentWindow.ss(file1);
                    }
                }
                //var ipe = this.data.split('&')[2].split("=")[1];
                // location.reload();
            }
        });

    });

    $("#submitForm_bad").click(function (e) {

        // function submitForm_good(url) {

        $(':input[type="button"]').prop('disabled', true);
        var data = $("#bad_form").serialize();
        //var main_url = "<?php //echo $url; ?>//";
        $.ajax({
            type: 'POST',
            url: 'create_good_bad_piece.php',
            data: data,
            // dataType: "json",
            // context: this,
            async: false,
            success: function (data) {
                // window.location.href = window.location.href + "?aa=Line 1";
                // $(':input[type="button"]').prop('disabled', false);
                var line_id = this.data.split('&')[1].split("=")[1];
                var pe = this.data.split('&')[2].split("=")[1];
                var ff2 = this.data.split('&')[3].split("=")[1];
                var deftype = this.data.split('&')[6].split("=")[1];
                var file2 = '../assets/label_files/' + line_id +'/b_'+ff2;
                if((pe == '1') && (deftype != 'bad_piece')){
                    document.getElementById("resultFrame").contentWindow.ss(file2);
                }

                // location.reload();
            }
        });

    });

    $("#search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $(".view_gpbp").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

</script>
<script>
    $(document).on('click', '#view', function () {
        var element = $(this);
        //var edit_id = element.attr("data-id");
        var buttonid = $(this).data("buttonid");
        $("#add_defect_name").val($(this).data("defect_name"));
    });
    $(document).on('click', '#edit', function () {
        var element = $(this);
        var edit_id = element.attr("data-id");
        var edit_gbid = element.attr("data-gbid");
        var edit_seid = element.attr("data-seid");
        var editgood_name = $(this).data("good_pieces");
        var editdefect_name = $(this).data("defect_name");
        var editbad_name = $(this).data("bad_pieces");
        var editre_work = $(this).data("re_work");
        var edit_image = $(this).data("data-image");
        $("#editgood_name").val(editgood_name);
        $("#editdefect_name").val(editdefect_name);
        $("#editbad_name").val(editbad_name);
        $("#editre_work").val(editre_work);
        $("#editimage").val(edit_image);
        $("#edit_id").val(edit_id);
        $("#edit_gbid").val(edit_gbid);
        $("#edit_seid").val(edit_seid);

        if(editgood_name != "")
        {
            // $("#badpiece").hide();
            // $("#badpiece1").hide();
            // $("#badpiece2").hide();
            // $("#goodpiece").show();

            window.location = "<?php echo $siteURL; ?>events_module/edit_good_piece.php?station_event_id=<?php echo $station_event_id; ?>&bad_pieces_id=<?php echo $bad_pieces_id;?>";


        }else if(editbad_name != ""){
            // $("#badpiece").show();
            // $("#badpiece1").show();
            // $("#badpiece2").hide();
            // $("#goodpiece").hide();
            window.location = "<?php echo $siteURL; ?>events_module/edit_bad_piece.php?station_event_id=<?php echo $station_event_id; ?>";

        }
        //else if(editre_work != "")
        //{
        //    // $("#badpiece").show();
        //    // $("#badpiece1").hide();
        //    // $("#badpiece2").show();
        //    //
        //    // $("#goodpiece").hide();
        //    window.location = "<?php //echo $siteURL; ?>//events_module/add_bad_piece.php?station_event_id=<?php //echo $station_event_id; ?>//";
        //
        //}
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

    $('#choose').on('change', function () {
        var selected_val = this.value;
        if (selected_val == 1 || selected_val == 2) {
            $(".group_div").show();
        } else {
            $(".group_div").hide();
        }
    });


</script>
<script>


    function submitForm_edit(url) {

        $(':input[type="button"]').prop('disabled', true);
        var data = $("#edit_form").serialize();
        var main_url = "<?php echo $url; ?>";
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
</script>
<script>
    window.onload = function() {
        history.replaceState("", "", "<?php echo $scriptName; ?>events_module/good_bad_piece.php?station_event_id=<?php echo $station_event_id; ?>");
    }
</script>
<script>
    // Upload

    $("#file").on("change", function () {
        var fd = new FormData();
        var files = $('#file')[0].files[0];
        fd.append('file', files);
        fd.append('request', 1);

        // AJAX request
        $.ajax({
            url: 'add_delete_good_bad_piece_image.php',
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
        var succ = false;
        // AJAX request
        $.ajax({
            url: 'add_delete_good_bad_piece_image.php',
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
<script>

    $("#file-input").on("change", function(e) {
        var files = e.target.files,
            filesLength = files.length;
        for (var i = 0; i < filesLength; i++) {
            var f = files[i]
            var fileReader = new FileReader();
            fileReader.onload = (function(e) {
                var file = e.target;
                $("<span class=\"pip\">" +
                    "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                    "<br/><span class=\"remove\">Remove image</span>" +
                    "</span>").insertAfter("#file-input");
                $(".remove").click(function(){
                    $(this).parent(".pip").remove();
                });

            });
            fileReader.readAsDataURL(f);
        }
    });

    function previewImages() {
        $("#preview").html(" ");
        var preview = document.querySelector('#preview');

        if (this.files) {
            [].forEach.call(this.files, readAndPreview);
        }

        function readAndPreview(file) {

            // Make sure `file.name` matches our extensions criteria
            if (!/\.(jpe?g|png|gif)$/i.test(file.name)) {
                return alert(file.name + " is not an image");
            } // else...

            var reader = new FileReader();

            reader.addEventListener("load", function() {
                var image = new Image();
                image.height = 100;
                image.title  = file.name;
                image.src    = this.result;
                preview.appendChild(image);
            });

            reader.readAsDataURL(file);

        }

    }

    document.querySelector('#file-input').addEventListener("change", previewImages);
</script>

<!-- JQUERY JS -->
<script src="https://laravel8.spruko.com/nowa/assets/plugins/jquery/jquery.min.js"></script>

<!-- BOOTSTRAP JS -->
<script src="https://laravel8.spruko.com/nowa/assets/plugins/bootstrap/js/popper.min.js"></script>
<script src="https://laravel8.spruko.com/nowa/assets/plugins/bootstrap/js/bootstrap.min.js"></script>


<!-- P-SCROLL JS -->
<script src="<?php echo $siteURL;?>assets/js/form_js/perfect-scrollbar.js"></script>


<!-- SIDEBAR JS -->
<script src="https://laravel8.spruko.com/nowa/assets/plugins/side-menu/sidemenu.js"></script>


<!--Internal  index js -->
<script src="https://laravel8.spruko.com/nowa/assets/js/index.js"></script>


<!-- CUSTOM JS -->
<script src="https://laravel8.spruko.com/nowa/assets/js/custom.js"></script>

</body>
</html>
