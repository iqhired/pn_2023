
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
                        <a href="https://laravel8.spruko.com/nowa/index" class="header-logo">
                            <img src="https://laravel8.spruko.com/nowa/assets/img/brand/logo.png" class="mobile-logo logo-1" alt="logo">
                            <img src="https://laravel8.spruko.com/nowa/assets/img/brand/logo-white.png" class="mobile-logo dark-logo-1" alt="logo">
                        </a>
                    </div>
                    <div class="app-sidebar__toggle" data-bs-toggle="sidebar">
                        <a class="open-toggle" href="javascript:void(0);"><i class="header-icon fe fe-align-left"></i></a>
                        <a class="close-toggle" href="javascript:void(0);"><i class="header-icon fe fe-x"></i></a>
                    </div>
                    <div class="logo-horizontal">
                        <a href="https://laravel8.spruko.com/nowa/index" class="header-logo">
                            <img src="https://laravel8.spruko.com/nowa/assets/img/brand/logo.png" class="mobile-logo logo-1" alt="logo">
                            <img src="https://laravel8.spruko.com/nowa/assets/img/brand/logo-white.png" class="mobile-logo dark-logo-1" alt="logo">
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

                </div>
            </div>
        </div>
        <!-- /main-header -->

        <!-- main-sidebar -->
        <div class="sticky" style="margin-bottom: -63px;">
            <aside class="app-sidebar ps horizontal-main">
                <div class="main-sidebar-header active">
                    <a class="header-logo active" href="https://laravel8.spruko.com/nowa/index">
                        <img src="https://laravel8.spruko.com/nowa/assets/img/brand/logo.png" class="main-logo  desktop-logo" alt="logo">
                        <img src="https://laravel8.spruko.com/nowa/assets/img/brand/logo-white.png" class="main-logo  desktop-dark" alt="logo">
                        <img src="https://laravel8.spruko.com/nowa/assets/img/brand/favicon.png" class="main-logo  mobile-logo" alt="logo">
                        <img src="https://laravel8.spruko.com/nowa/assets/img/brand/favicon-white.png" class="main-logo  mobile-dark" alt="logo">
                    </a>
                </div>
                <div class="main-sidemenu is-expanded container">
                    <div class="slide-left disabled active d-none" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path></svg></div>
                    <ul class="side-menu open" style="margin-right: 0px; flex-wrap: nowrap; margin-left: 0px;">
                        <li class="side-item side-item-category">Main</li>
                        <li class="slide is-expanded">
                            <a class="side-menu__item active is-expanded" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z"></path></svg><span class="side-menu__label">Dashboards</span><i class="angle fe fe-chevron-right"></i></a>
                            <ul class="slide-menu open">
                                <li class="side-menu__label1"><a href="javascript:void(0);">Dashboards</a></li>
                                <li class="is-expanded"><a class="slide-item active" href="https://laravel8.spruko.com/nowa/index">Dashboard-1</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/index1">Dashboard-2</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/index2">Dashboard-3</a></li>
                            </ul>
                        </li>
                        <li class="side-item side-item-category">WEB APPS</li>
                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11-6h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zm-1 6h-4V5h4v4zm-9 4H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6H5v-4h4v4zm8-6c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z"></path></svg><span class="side-menu__label">Apps</span><i class="angle fe fe-chevron-right"></i></a>
                            <ul class="slide-menu">
                                <li class="side-menu__label1"><a href="javascript:void(0);">Apps</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/cards">Cards</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/draggablecards">Darggablecards</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/rangeslider">Range-slider</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/calendar">Calendar</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/contacts">Contacts</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/image-compare">Image-compare</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/notification">Notification</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/widget-notification">Widget-notification</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/treeview">Treeview</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/file-manager">File-manager</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/file-manager1">File-manager1</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/file-details">File-details</a></li>
                            </ul>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M20 17V7c0-2.168-3.663-4-8-4S4 4.832 4 7v10c0 2.168 3.663 4 8 4s8-1.832 8-4zM12 5c3.691 0 5.931 1.507 6 1.994C17.931 7.493 15.691 9 12 9S6.069 7.493 6 7.006C6.069 6.507 8.309 5 12 5zM6 9.607C7.479 10.454 9.637 11 12 11s4.521-.546 6-1.393v2.387c-.069.499-2.309 2.006-6 2.006s-5.931-1.507-6-2V9.607zM6 17v-2.393C7.479 15.454 9.637 16 12 16s4.521-.546 6-1.393v2.387c-.069.499-2.309 2.006-6 2.006s-5.931-1.507-6-2z"></path></svg><span class="side-menu__label">Elements</span><i class="angle fe fe-chevron-right"></i></a>
                            <ul class="slide-menu">
                                <li class="side-menu__label1"><a href="javascript:void(0);">Elements</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/alerts">Alerts</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/avatar">Avatar</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/breadcrumbs">Breadcrumbs</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/buttons">Buttons</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/badge">Badge</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/dropdown">Dropdown</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/thumbnails">Thumbnails</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/list-group">List Group</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/navigation">Navigation</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/images">Images</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/pagination">Pagination</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/popover">Popover</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/progress">Progress</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/spinners">Spinners</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/media-object">Media Object</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/typography">Typography</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/tooltip">Tooltip</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/toast">Toast</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/tags">Tags</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/tabs">Tabs</a></li>
                            </ul>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M20.995 6.9a.998.998 0 0 0-.548-.795l-8-4a1 1 0 0 0-.895 0l-8 4a1.002 1.002 0 0 0-.547.795c-.011.107-.961 10.767 8.589 15.014a.987.987 0 0 0 .812 0c9.55-4.247 8.6-14.906 8.589-15.014zM12 19.897C5.231 16.625 4.911 9.642 4.966 7.635L12 4.118l7.029 3.515c.037 1.989-.328 9.018-7.029 12.264z"></path><path d="m11 12.586-2.293-2.293-1.414 1.414L11 15.414l5.707-5.707-1.414-1.414z"></path></svg><span class="side-menu__label">Advanced UI</span><i class="angle fe fe-chevron-right"></i></a>
                            <ul class="slide-menu">
                                <li class="side-menu__label1"><a href="javascript:void(0);">Advanced UI</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/accordion">Accordion</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/carousel">Carousel</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/collapse">Collapse</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/modals">Modals</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/timeline">Timeline</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/sweet-alert">Sweet Alert</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/rating">Ratings</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/counters">Counters</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/search">Search</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/userlist">Userlist</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/blog">Blog</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/blog-details">Blog-details</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/edit-post">Edit-post</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/file-attached-tags">File Attachments</a></li>
                            </ul>
                        </li>
                        <li class="side-item side-item-category">Pages</li>
                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M22 7.999a1 1 0 0 0-.516-.874l-9.022-5a1.003 1.003 0 0 0-.968 0l-8.978 4.96a1 1 0 0 0-.003 1.748l9.022 5.04a.995.995 0 0 0 .973.001l8.978-5A1 1 0 0 0 22 7.999zm-9.977 3.855L5.06 7.965l6.917-3.822 6.964 3.859-6.918 3.852z"></path><path d="M20.515 11.126 12 15.856l-8.515-4.73-.971 1.748 9 5a1 1 0 0 0 .971 0l9-5-.97-1.748z"></path><path d="M20.515 15.126 12 19.856l-8.515-4.73-.971 1.748 9 5a1 1 0 0 0 .971 0l9-5-.97-1.748z"></path></svg><span class="side-menu__label">Pages</span><i class="angle fe fe-chevron-right"></i></a>
                            <ul class="slide-menu">
                                <li class="side-menu__label1"><a href="javascript:void(0);">Pages</a></li>
                                <li class="sub-slide">
                                    <a class="slide-item" data-bs-toggle="sub-slide" href="javascript:void(0);"><span class="sub-side-menu__label">Authentication</span><i class="sub-angle fe fe-chevron-right"></i></a>
                                    <ul class="sub-slide-menu">
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signin">Sign In</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/signup">Sign Up</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/forgot">Forgot Password</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/reset">Reset Password</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/lockscreen">Lockscreen</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/underconstruction">UnderConstruction</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/error404">404 Error</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/error500">500 Error</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/error501">501 Error</a></li>
                                    </ul>
                                </li>
                                <li class="sub-slide">
                                    <a class="slide-item" data-bs-toggle="sub-slide" href="javascript:void(0);"><span class="sub-side-menu__label">Switcher</span><i class="sub-angle fe fe-chevron-right"></i></a>
                                    <ul class="sub-slide-menu">

                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/switcherpage">Switcherpage</a></li>
                                    </ul>
                                </li>
                                <li class="sub-slide">
                                    <a class="slide-item" data-bs-toggle="sub-slide" href="javascript:void(0);"><span class="sub-side-menu__label">Ecommerce</span><i class="sub-angle fe fe-chevron-right"></i></a>
                                    <ul class="sub-slide-menu">
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/shop">Shop</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/product-details">Product-Details</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/product-cart">Cart</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/check-out">Check-out</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/wish-list">Wish-list</a></li>
                                    </ul>
                                </li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/profile">Profile</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/profile-notifications">Notifications-list</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/aboutus">About us</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/settings">Settings</a></li>
                                <li class="sub-slide">
                                    <a class="slide-item" data-bs-toggle="sub-slide" href="javascript:void(0);"><span class="sub-side-menu__label">Mail</span><i class="sub-angle fe fe-chevron-right"></i></a>
                                    <ul class="sub-slide-menu">
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/mail">Mail</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/mail-compose">Mail Compose</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/mail-read">Read-mail</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/mail-settings">mail-settings</a></li>
                                        <li><a class="sub-side-menu__item" href="https://laravel8.spruko.com/nowa/chat">Chat</a></li>
                                    </ul>
                                </li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/invoice">Invoice</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/pricing">Pricing</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/gallery">Gallery</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/todotask">Todotask</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/faq">Faqs</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/emptypage">Empty Page</a></li>
                            </ul>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M12 22c4.879 0 9-4.121 9-9s-4.121-9-9-9-9 4.121-9 9 4.121 9 9 9zm0-16c3.794 0 7 3.206 7 7s-3.206 7-7 7-7-3.206-7-7 3.206-7 7-7zm5.284-2.293 1.412-1.416 3.01 3-1.413 1.417zM5.282 2.294 6.7 3.706l-2.99 3-1.417-1.413z"></path><path d="M11 9h2v5h-2zm0 6h2v2h-2z"></path></svg><span class="side-menu__label">Utilities</span><i class="angle fe fe-chevron-right"></i></a>
                            <ul class="slide-menu">
                                <li class="side-menu__label1"><a href="javascript:void(0);">Utilities</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/background">Background</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/border">Border</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/display">Display</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/flex">Flex</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/height">Height</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/margin">Margin</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/padding">Padding</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/position">Position</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/width">Width</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/extras">Extras</a></li>
                            </ul>
                        </li>
                        <li class="side-item side-item-category">General</li>
                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M20 7h-1.209A4.92 4.92 0 0 0 19 5.5C19 3.57 17.43 2 15.5 2c-1.622 0-2.705 1.482-3.404 3.085C11.407 3.57 10.269 2 8.5 2 6.57 2 5 3.57 5 5.5c0 .596.079 1.089.209 1.5H4c-1.103 0-2 .897-2 2v2c0 1.103.897 2 2 2v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7c1.103 0 2-.897 2-2V9c0-1.103-.897-2-2-2zm-4.5-3c.827 0 1.5.673 1.5 1.5C17 7 16.374 7 16 7h-2.478c.511-1.576 1.253-3 1.978-3zM7 5.5C7 4.673 7.673 4 8.5 4c.888 0 1.714 1.525 2.198 3H8c-.374 0-1 0-1-1.5zM4 9h7v2H4V9zm2 11v-7h5v7H6zm12 0h-5v-7h5v7zm-5-9V9.085L13.017 9H20l.001 2H13z"></path></svg><span class="side-menu__label">Icons</span><i class="angle fe fe-chevron-right"></i></a>
                            <ul class="slide-menu">
                                <li class="side-menu__label1"><a href="javascript:void(0);">Icons</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/icons">Font Awesome </a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/icons2">Material Design Icons</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/icons3">Simple Line Icons</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/icons4">Feather Icons</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/icons5">Ionic Icons</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/icons6">Flag Icons</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/icons7">Pe7 Icons</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/icons8">Themify Icons</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/icons9">Typicons Icons</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/icons10">Weather Icons</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/icons11">Material Icons</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/icons12">Bootstrap Icons</a></li>
                            </ul>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M20 7h-4V4c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H4c-1.103 0-2 .897-2 2v9a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V9c0-1.103-.897-2-2-2zM4 11h4v8H4v-8zm6-1V4h4v15h-4v-9zm10 9h-4V9h4v10z"></path></svg><span class="side-menu__label">Charts</span><i class="angle fe fe-chevron-right"></i></a>
                            <ul class="slide-menu">
                                <li class="side-menu__label1"><a href="javascript:void(0);">Charts</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/chart-morris">Morris Charts</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/chart-flot">Flot Charts</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/chart-chartjs">ChartJS</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/chart-echart">Echart</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/chart-sparkline">Sparkline</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/chart-peity">Chart-peity</a></li>
                            </ul>
                        </li>
                        <li class="side-item side-item-category">MULTI LEVEL</li>
                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"></path></svg><span class="side-menu__label">Menu-levels</span><i class="angle fe fe-chevron-right"></i></a>
                            <ul class="slide-menu">
                                <li class="side-menu__label1"><a href="javascript:void(0);">Menu-Levels</a></li>
                                <li><a class="slide-item" href="javascript:void(0);">Level-1</a></li>
                                <li class="sub-slide">
                                    <a class="slide-item" data-bs-toggle="sub-slide" href="javascript:void(0);"><span class="sub-side-menu__label">Level-2</span><i class="sub-angle fe fe-chevron-down me-4"></i></a>
                                    <ul class="sub-slide-menu">
                                        <li><a class="sub-side-menu__item" href="javascript:void(0);">Level-2.1</a></li>
                                        <li><a class="sub-side-menu__item" href="javascript:void(0);">Level-2.2</a></li>
                                        <li class="sub-slide2">
                                            <a class="sub-side-menu__item" data-bs-toggle="sub-slide2" href="javascript:void(0);"><span class="sub-side-menu__label">Level-2.3</span><i class="sub-angle2 fe fe-chevron-down"></i></a>
                                            <ul class="sub-slide-menu1">
                                                <li><a class="sub-slide-item2" href="javascript:void(0);">Level-2.3.1</a></li>
                                                <li><a class="sub-slide-item2" href="javascript:void(0);">Level-2.3.2</a></li>
                                                <li><a class="sub-slide-item2" href="javascript:void(0);">Level-2.3.3</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="side-item side-item-category">COMPONENTS</li>
                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M19.937 8.68c-.011-.032-.02-.063-.033-.094a.997.997 0 0 0-.196-.293l-6-6a.997.997 0 0 0-.293-.196c-.03-.014-.062-.022-.094-.033a.991.991 0 0 0-.259-.051C13.04 2.011 13.021 2 13 2H6c-1.103 0-2 .897-2 2v16c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2V9c0-.021-.011-.04-.013-.062a.99.99 0 0 0-.05-.258zM16.586 8H14V5.414L16.586 8zM6 20V4h6v5a1 1 0 0 0 1 1h5l.002 10H6z"></path></svg><span class="side-menu__label">Forms</span><i class="angle fe fe-chevron-right"></i></a>
                            <ul class="slide-menu">
                                <li class="side-menu__label1"><a href="javascript:void(0);">Forms</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/form-elements">Form Elements</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/form-advanced">Advanced Forms</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/form-layouts">Form Layouts</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/form-validation">Form Validation</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/form-wizards">Form Wizards</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/form-editor">Form Editor</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/form-sizes">Form-element-sizes</a></li>
                            </ul>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M19 3H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2zm0 2 .001 4H5V5h14zM5 11h8v8H5v-8zm10 8v-8h4.001l.001 8H15z"></path></svg><span class="side-menu__label">Tables</span><i class="angle fe fe-chevron-right"></i></a>
                            <ul class="slide-menu">
                                <li class="side-menu__label1"><a href="javascript:void(0);">Tables</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/table-basic">Basic Tables</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/table-data">Data Tables</a></li>
                            </ul>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" href="https://laravel8.spruko.com/nowa/widgets"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11 4h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6h-4v-4h4v4zM17 3c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2zM7 13c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z"></path></svg><span class="side-menu__label">Widgets</span></a>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg" class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M2.002 9.63c-.023.411.207.794.581.966l7.504 3.442 3.442 7.503c.164.356.52.583.909.583l.057-.002a1 1 0 0 0 .894-.686l5.595-17.032c.117-.358.023-.753-.243-1.02s-.66-.358-1.02-.243L2.688 8.736a1 1 0 0 0-.686.894zm16.464-3.971-4.182 12.73-2.534-5.522a.998.998 0 0 0-.492-.492L5.734 9.841l12.732-4.182z"></path></svg><span class="side-menu__label">Maps</span><i class="angle fe fe-chevron-right"></i></a>
                            <ul class="slide-menu">
                                <li class="side-menu__label1"><a href="javascript:void(0);">Maps</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/map-leaflet">Leaflet Maps</a></li>
                                <li><a class="slide-item" href="https://laravel8.spruko.com/nowa/map-vector">Vector Maps</a></li>
                            </ul>
                        </li>
                    </ul>
                    <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path></svg></div>
                </div>
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;"><div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div></div><div class="ps__rail-y" style="top: 0px; right: 0px;"><div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div></div></aside>
        </div>
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
