
<head>

    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="Description" content="Nowa – Laravel Bootstrap 5 Admin & Dashboard Template">
    <meta name="Author" content="Spruko Technologies Private Limited">
    <meta name="Keywords" content="admin dashboard, admin dashboard laravel, admin panel template, blade template, blade template laravel, bootstrap template, dashboard laravel, laravel admin, laravel admin dashboard, laravel admin panel, laravel admin template, laravel bootstrap admin template, laravel bootstrap template, laravel template"/>

    <!-- Title -->
    <title> Nowa – Laravel Bootstrap 5 Admin & Dashboard Template </title>

    <!-- FAVICON -->
    <link rel="icon" href="https://laravel8.spruko.com/nowa/assets/img/brand/favicon.png" type="image/x-icon"/>

    <!-- ICONS CSS -->
    <link href="https://laravel8.spruko.com/nowa/assets/plugins/icons/icons.css" rel="stylesheet">

    <!-- BOOTSTRAP CSS -->
    <link href="https://laravel8.spruko.com/nowa/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- RIGHT-SIDEMENU CSS -->
    <link href="https://laravel8.spruko.com/nowa/assets/plugins/sidebar/sidebar.css" rel="stylesheet">

    <!-- P-SCROLL BAR CSS -->
    <link href="https://laravel8.spruko.com/nowa/assets/plugins/perfect-scrollbar/p-scrollbar.css" rel="stylesheet" />


    <!-- INTERNAL Select2 css -->
    <link href="https://laravel8.spruko.com/nowa/assets/plugins/select2/css/select2.min.css" rel="stylesheet" />

    <!-- INTERNAL Data table css -->
    <link href="https://laravel8.spruko.com/nowa/assets/plugins/datatable/css/dataTables.bootstrap5.css" rel="stylesheet" />
    <link href="https://laravel8.spruko.com/nowa/assets/plugins/datatable/css/buttons.bootstrap5.min.css"  rel="stylesheet">
    <link href="https://laravel8.spruko.com/nowa/assets/plugins/datatable/responsive.bootstrap5.css" rel="stylesheet" />


    <!-- STYLES CSS -->
    <link href="https://laravel8.spruko.com/nowa/assets/css/style.css" rel="stylesheet">
    <link href="https://laravel8.spruko.com/nowa/assets/css/style-dark.css" rel="stylesheet">
    <link href="https://laravel8.spruko.com/nowa/assets/css/style-transparent.css" rel="stylesheet">


    <!-- SKIN-MODES CSS -->
    <link href="https://laravel8.spruko.com/nowa/assets/css/skin-modes.css" rel="stylesheet" />

    <!-- ANIMATION CSS -->
    <link href="https://laravel8.spruko.com/nowa/assets/css/animate.css" rel="stylesheet">

    <!-- SWITCHER CSS -->
    <link href="https://laravel8.spruko.com/nowa/assets/switcher/css/switcher.css" rel="stylesheet"/>
    <link href="https://laravel8.spruko.com/nowa/assets/switcher/demo.css" rel="stylesheet"/>

</head>
       <!-- main-header -->
        <div class="main-header sticky nav nav-item hor-header" style="margin-bottom: -63px;">
            <div class="main-container container">
                <div class="main-header-left ">
                    <div class="responsive-logo">
                        <a href="https://testing.plantnavigator.com/line_status_grp_dashboard.php" class="header-logo">
                            <img src="https://testing.plantnavigator.com/assets/img/site_logo.png" class="mobile-logo logo-1" alt="logo" style="height=60px; width=150px;">
                            <img src="https://testing.plantnavigator.com/assets/img/site_logo.png" class="mobile-logo dark-logo-1" alt="logo" style="height=60px; width=150px;">
                        </a>
                    </div>
                    <div class="app-sidebar__toggle" data-bs-toggle="sidebar">
                        <a class="open-toggle" href="javascript:void(0);"><i class="header-icon fe fe-align-left"></i></a>
                        <a class="close-toggle" href="javascript:void(0);"><i class="header-icon fe fe-x"></i></a>
                    </div>
                    <div class="logo-horizontal">
                        <a href="https://testing.plantnavigator.com/line_status_grp_dashboard.php" class="header-logo">
                            <img src="https://testing.plantnavigator.com/assets/img/site_logo.png" class="mobile-logo logo-1" alt="logo" style="height=60px; width=150px;" >
                            <img src="https://testing.plantnavigator.com/assets/img/site_logo.png" class="mobile-logo dark-logo-1" alt="logo" style="height=60px; width=150px;" >
                        </a>
                    </div>
                </div>
                <div class="main-header-right">
                    <button class="navbar-toggler navresponsive-toggler d-md-none ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon fe fe-more-vertical "></span>
                    </button>
					<?php if(empty($menu_req)){?>
                        <div class="mb-0 navbar navbar-expand-lg navbar-nav-right responsive-navbar navbar-dark p-0">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                            <ul class="nav nav-item header-icons navbar-nav-right ms-auto">
                                <li class="nav-link search-icon d-lg-none d-block">
                                    <form class="navbar-form" role="search">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search">
                                            <span class="input-group-btn">
														<button type="reset" class="btn btn-default">
															<i class="fas fa-times"></i>
														</button>
														<button type="submit" class="btn btn-default nav-link resp-btn">
															<svg xmlns="http://www.w3.org/2000/svg" height="24px" class="header-icon-svgs" viewBox="0 0 24 24" width="24px" fill="#000000"><path d="M0 0h24v24H0V0z" fill="none"></path><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"></path></svg>
														</button>
													</span>
                                        </div>
                                    </form>
                                </li>

                                <li class="dropdown main-profile-menu nav nav-item nav-link ps-lg-2">
                                    <a class="new nav-link profile-user d-flex" href="" data-bs-toggle="dropdown"><img alt="" src="https://laravel8.spruko.com/nowa/assets/img/faces/2.jpg" class=""></a>
                                    <div class="dropdown-menu">
                                        <div class="menu-header-content p-3 border-bottom">
                                            <div class="d-flex wd-100p">
                                                <div class="main-img-user"><img alt="" src="https://laravel8.spruko.com/nowa/assets/img/faces/2.jpg" class=""></div>
                                                <div class="ms-3 my-auto">
                                                    <h6 class="tx-15 font-weight-semibold mb-0">Teri Dactyl</h6><span class="dropdown-title-text subtext op-6  tx-12">Premium Member</span>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="dropdown-item" href="https://laravel8.spruko.com/nowa/profile"><i class="far fa-user-circle"></i>Profile</a>
                                        <a class="dropdown-item" href="https://laravel8.spruko.com/nowa/chat"><i class="far fa-smile"></i> chat</a>
                                        <a class="dropdown-item" href="https://laravel8.spruko.com/nowa/mail-read"><i class="far fa-envelope "></i>Inbox</a>
                                        <a class="dropdown-item" href="https://laravel8.spruko.com/nowa/mail"><i class="far fa-comment-dots"></i>Messages</a>
                                        <a class="dropdown-item" href="https://laravel8.spruko.com/nowa/mail-settings"><i class="far fa-sun"></i>  Settings</a>
                                        <a class="dropdown-item" href="https://laravel8.spruko.com/nowa/signup"><i class="far fa-arrow-alt-circle-left"></i> Sign Out</a>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
					<?php } ?>
                </div>
            </div>
        </div>
        <!-- /main-header -->
<?php if(empty($menu_req)){?>
        <!-- main-sidebar -->
        <div class="sticky" style="margin-bottom: -63px;">
            <aside class="app-sidebar ps horizontal-main">
                <div class="main-sidebar-header active">
                    <a class="header-logo active" href="https://testing.plantnavigator.com/line_status_grp_dashboard.php">
                        <img src="https://testing.plantnavigator.com/assets/img/site_logo.png" class="main-logo  desktop-logo" alt="logo">
                        <img src="https://testing.plantnavigator.com/assets/img/site_logo.png" class="main-logo  desktop-dark" alt="logo">
                        <img src="https://testing.plantnavigator.com/assets/img/site_logo.png" class="main-logo  mobile-logo" alt="logo">
                        <img src="https://testing.plantnavigator.com/assets/img/site_logo.png" class="main-logo  mobile-dark" alt="logo">
                    </a>
                </div>
                <div class="main-sidemenu is-expanded container">
                    <div class="slide-left disabled active d-none" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path></svg></div>
                    <ul class="side-menu open" style="margin-right: 0px; flex-wrap: nowrap; margin-left: 0px;">
                        <li class="side-item side-item-category">Main</li>
                        <li class="slide is-expanded">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M22 7.999a1 1 0 0 0-.516-.874l-9.022-5a1.003 1.003 0 0 0-.968 0l-8.978 4.96a1 1 0 0 0-.003 1.748l9.022 5.04a.995.995 0 0 0 .973.001l8.978-5A1 1 0 0 0 22 7.999zm-9.977 3.855L5.06 7.965l6.917-3.822 6.964 3.859-6.918 3.852z"></path><path d="M20.515 11.126 12 15.856l-8.515-4.73-.971 1.748 9 5a1 1 0 0 0 .971 0l9-5-.97-1.748z"></path><path d="M20.515 15.126 12 19.856l-8.515-4.73-.971 1.748 9 5a1 1 0 0 0 .971 0l9-5-.97-1.748z"></path></svg><span class="side-menu__label">Boards</span><i class="angle fe fe-chevron-right"></i></a>
                            <ul class="slide-menu open">

                                <li class="side-menu__label1"><a href="javascript:void(0);">Pages</a></li>
                                <li class="sub-slide">
                                    <a class="slide-item" data-bs-toggle="sub-slide" href="javascript:void(0);"><span class="sub-side-menu__label">Dashboard</span><i class="sub-angle fe fe-chevron-right"></i></a>
                                    <ul class="sub-slide-menu">
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">Cell Overview</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signup">Crew Status Overview</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signup">First Piece Sheet Dashboard</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signup">First Piece View Dashboard</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signup">Line Utilization Dashboard</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signup">Station Wise Dashboard</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signup">Form Submit Dashboard</a></li>



                                    </ul>
                                </li>
                                <li class="side-menu__label1"><a href="javascript:void(0);">Pages</a></li>
                                <li class="sub-slide">
                                    <a class="slide-item" data-bs-toggle="sub-slide" href="javascript:void(0);"><span class="sub-side-menu__label">Taskboard</span><i class="sub-angle fe fe-chevron-right"></i></a>
                                    <ul class="sub-slide-menu">
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">Taskboard</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signup">Create Taskboard</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">Create/Edit Taskboard</a></li>


                                    </ul>
                                </li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/icons">Good Bad Piece Dashboard</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/icons">Custom Dashboard</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/icons">NPR Dashboard</a></li>


                            </ul>
                        </li>
                        <li class="side-item side-item-category">Forms</li>
                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M20 7h-1.209A4.92 4.92 0 0 0 19 5.5C19 3.57 17.43 2 15.5 2c-1.622 0-2.705 1.482-3.404 3.085C11.407 3.57 10.269 2 8.5 2 6.57 2 5 3.57 5 5.5c0 .596.079 1.089.209 1.5H4c-1.103 0-2 .897-2 2v2c0 1.103.897 2 2 2v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7c1.103 0 2-.897 2-2V9c0-1.103-.897-2-2-2zm-4.5-3c.827 0 1.5.673 1.5 1.5C17 7 16.374 7 16 7h-2.478c.511-1.576 1.253-3 1.978-3zM7 5.5C7 4.673 7.673 4 8.5 4c.888 0 1.714 1.525 2.198 3H8c-.374 0-1 0-1-1.5zM4 9h7v2H4V9zm2 11v-7h5v7H6zm12 0h-5v-7h5v7zm-5-9V9.085L13.017 9H20l.001 2H13z"></path></svg><span class="side-menu__label">Forms</span><i class="angle fe fe-chevron-right"></i></a>
                            <ul class="slide-menu">
                                <li class="side-menu__label1"><a href="javascript:void(0);">Icons</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/icons">Add/Create Form</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/icons2">Edit Form</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/icons3">Submit Form</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/icons4">View Form</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/icons5">Form Rejection Loop</a></li>

                            </ul>
                        </li>

                        <li class="side-item side-item-category">Logs</li>
                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M20 7h-1.209A4.92 4.92 0 0 0 19 5.5C19 3.57 17.43 2 15.5 2c-1.622 0-2.705 1.482-3.404 3.085C11.407 3.57 10.269 2 8.5 2 6.57 2 5 3.57 5 5.5c0 .596.079 1.089.209 1.5H4c-1.103 0-2 .897-2 2v2c0 1.103.897 2 2 2v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7c1.103 0 2-.897 2-2V9c0-1.103-.897-2-2-2zm-4.5-3c.827 0 1.5.673 1.5 1.5C17 7 16.374 7 16 7h-2.478c.511-1.576 1.253-3 1.978-3zM7 5.5C7 4.673 7.673 4 8.5 4c.888 0 1.714 1.525 2.198 3H8c-.374 0-1 0-1-1.5zM4 9h7v2H4V9zm2 11v-7h5v7H6zm12 0h-5v-7h5v7zm-5-9V9.085L13.017 9H20l.001 2H13z"></path></svg><span class="side-menu__label">Logs</span><i class="angle fe fe-chevron-right"></i></a>
                            <ul class="slide-menu">
                                <li class="side-menu__label1"><a href="javascript:void(0);">Icons</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/icons">Crew Assignment Log </a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/icons2">Good Bad Piece Log</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/icons3">10x log</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/icons4">Material Traceability Log</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/icons5">Station Events Log</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/icons6">Station Asset Log</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/icons7">SPC Analytics</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/icons8">Task Crew Log</a></li>

                            </ul>
                        </li>


                        <li class="side-item side-item-category">Admin Config</li>
                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M22 7.999a1 1 0 0 0-.516-.874l-9.022-5a1.003 1.003 0 0 0-.968 0l-8.978 4.96a1 1 0 0 0-.003 1.748l9.022 5.04a.995.995 0 0 0 .973.001l8.978-5A1 1 0 0 0 22 7.999zm-9.977 3.855L5.06 7.965l6.917-3.822 6.964 3.859-6.918 3.852z"></path><path d="M20.515 11.126 12 15.856l-8.515-4.73-.971 1.748 9 5a1 1 0 0 0 .971 0l9-5-.97-1.748z"></path><path d="M20.515 15.126 12 19.856l-8.515-4.73-.971 1.748 9 5a1 1 0 0 0 .971 0l9-5-.97-1.748z"></path></svg><span class="side-menu__label">Admin Config</span><i class="angle fe fe-chevron-right"></i></a>
                            <ul class="slide-menu">
                                <li class="side-menu__label1"><a href="javascript:void(0);">Pages</a></li>
                                <li class="sub-slide">
                                    <a class="slide-item" data-bs-toggle="sub-slide" href="javascript:void(0);"><span class="sub-side-menu__label">Dashboard Config</span><i class="sub-angle fe fe-chevron-right"></i></a>
                                    <ul class="sub-slide-menu">
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">Cell Dashboard</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signup">Create Custom Dashboard</a></li>

                                    </ul>
                                </li>

                                <li class="sub-slide">
                                    <a class="slide-item" data-bs-toggle="sub-slide" href="javascript:void(0);"><span class="sub-side-menu__label">Station & Events Config</span><i class="sub-angle fe fe-chevron-right"></i></a>
                                    <ul class="sub-slide-menu">
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">Station Config</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">Station Asset Config</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signup">Station Position Config</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">Position</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">Event Category </a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">Event Type</a></li>

                                    </ul>
                                </li>


                                <li class="sub-slide">
                                    <a class="slide-item" data-bs-toggle="sub-slide" href="javascript:void(0);"><span class="sub-side-menu__label">Report Config</span><i class="sub-angle fe fe-chevron-right"></i></a>
                                    <ul class="sub-slide-menu">
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">Enable Disable Email Report Config</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">Assignment Mail Config</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">Communicator Config</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">Task Log Config</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">Training Completion Mail Config</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">First Piece Sheet Report Config</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">Daily Efficiency Report Config</a></li>



                                    </ul>
                                </li>

                                <li class="sub-slide">
                                    <a class="slide-item" data-bs-toggle="sub-slide" href="javascript:void(0);"><span class="sub-side-menu__label">User Config</span><i class="sub-angle fe fe-chevron-right"></i></a>
                                    <ul class="sub-slide-menu">
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">Add/Update User</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">Add/Update User Role(s)</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">Custom Dashboard</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">User Station-Pos-Ratings </a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">Restore User</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">User Group</a></li>

                                    </ul>
                                </li>
                                <li class="sub-slide">
                                    <a class="slide-item" data-bs-toggle="sub-slide" href="javascript:void(0);"><span class="sub-side-menu__label">Parts</span><i class="sub-angle fe fe-chevron-right"></i></a>
                                    <ul class="sub-slide-menu">
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">Part Number</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">Part Family</a></li>


                                    </ul>
                                </li>


                                <li class="sub-slide">
                                    <a class="slide-item" data-bs-toggle="sub-slide" href="javascript:void(0);"><span class="sub-side-menu__label">Defects</span><i class="sub-angle fe fe-chevron-right"></i></a>
                                    <ul class="sub-slide-menu">
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">Defect Group</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">Defect List</a></li>
                                    </ul>
                                </li>



                                <li class="sub-slide">
                                    <a class="slide-item" data-bs-toggle="sub-slide" href="javascript:void(0);"><span class="sub-side-menu__label">Document</span><i class="sub-angle fe fe-chevron-right"></i></a>
                                    <ul class="sub-slide-menu">
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">Upload Document</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">Edit Document</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">Document Config</a></li>

                                    </ul>
                                </li>

                                <li class="sub-slide">
                                    <a class="slide-item" data-bs-toggle="sub-slide" href="javascript:void(0);"><span class="sub-side-menu__label">Others</span><i class="sub-angle fe fe-chevron-right"></i></a>
                                    <ul class="sub-slide-menu">
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">Form Type</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">Job Title</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signup">Measurement Unit</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">Shift Location</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">Assets Config</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">Material Tracability</a></li>

                                    </ul>
                                </li>

                            </ul>
                        </li>








                    <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path></svg></div>
                </div>
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></aside>
        </div>
<?php }?>
        <!-- main-sidebar -->
<!-- BACK-TO-TOP -->
<a href="#top" id="back-to-top"><i class="las la-arrow-up"></i></a>

<!-- JQUERY JS -->
<script src="https://laravel8.spruko.com/nowa/assets/plugins/jquery/jquery.min.js"></script>

<!-- BOOTSTRAP JS -->
<script src="https://laravel8.spruko.com/nowa/assets/plugins/bootstrap/js/popper.min.js"></script>
<script src="https://laravel8.spruko.com/nowa/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- IONICONS JS -->
<script src="https://laravel8.spruko.com/nowa/assets/plugins/ionicons/ionicons.js"></script>

<!-- MOMENT JS -->
<script src="https://laravel8.spruko.com/nowa/assets/plugins/moment/moment.js"></script>

<!-- P-SCROLL JS -->
<script src="https://laravel8.spruko.com/nowa/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="https://laravel8.spruko.com/nowa/assets/plugins/perfect-scrollbar/p-scroll.js"></script>

<!-- SIDEBAR JS -->
<script src="https://laravel8.spruko.com/nowa/assets/plugins/side-menu/sidemenu.js"></script>

<!-- STICKY JS -->
<script src="https://laravel8.spruko.com/nowa/assets/js/sticky.js"></script>

<!-- Chart-circle js -->
<script src="https://laravel8.spruko.com/nowa/assets/plugins/circle-progress/circle-progress.min.js"></script>

<!-- RIGHT-SIDEBAR JS -->
<script src="https://laravel8.spruko.com/nowa/assets/plugins/sidebar/sidebar.js"></script>
<script src="https://laravel8.spruko.com/nowa/assets/plugins/sidebar/sidebar-custom.js"></script>


<!-- Internal Chart.Bundle js-->
<script src="https://laravel8.spruko.com/nowa/assets/plugins/chartjs/Chart.bundle.min.js"></script>

<!-- Moment js -->
<script src="https://laravel8.spruko.com/nowa/assets/plugins/raphael/raphael.min.js"></script>

<!-- INTERNAL Apexchart js -->
<script src="https://laravel8.spruko.com/nowa/assets/js/apexcharts.js"></script>

<!--Internal Sparkline js -->
<script src="https://laravel8.spruko.com/nowa/assets/plugins/jquery-sparkline/jquery.sparkline.min.js"></script>

<!--Internal  index js -->
<script src="https://laravel8.spruko.com/nowa/assets/js/index.js"></script>

<!-- Chart-circle js -->
<script src="https://laravel8.spruko.com/nowa/assets/js/chart-circle.js"></script>

<!-- Internal Data tables -->
<script src="https://laravel8.spruko.com/nowa/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="https://laravel8.spruko.com/nowa/assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
<script src="https://laravel8.spruko.com/nowa/assets/plugins/datatable/dataTables.responsive.min.js"></script>
<script src="https://laravel8.spruko.com/nowa/assets/plugins/datatable/responsive.bootstrap5.min.js"></script>

<!-- INTERNAL Select2 js -->
<script src="https://laravel8.spruko.com/nowa/assets/plugins/select2/js/select2.full.min.js"></script>
<script src="https://laravel8.spruko.com/nowa/assets/js/select2.js"></script>


<!-- EVA-ICONS JS -->
<script src="https://laravel8.spruko.com/nowa/assets/plugins/eva-icons/eva-icons.min.js"></script>

<!-- THEME-COLOR JS -->
<script src="https://laravel8.spruko.com/nowa/assets/js/themecolor.js"></script>

<!-- CUSTOM JS -->
<script src="https://laravel8.spruko.com/nowa/assets/js/custom.js"></script>

<!-- exported JS -->
<script src="https://laravel8.spruko.com/nowa/assets/js/exported.js"></script>

<!-- SWITCHER JS -->
<script src="https://laravel8.spruko.com/nowa/assets/switcher/js/switcher.js"></script>
