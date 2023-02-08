<?php include("config.php");
checkSession();
/*$_SESSION['timestamp_id'] = '';
$_SESSION['f_type'] = '';*/
//$timestamp = date('H:i:s');
$message = date("Y-m-d H:i:s");
$is_cust_dash = $_SESSION['is_cust_dash'];
$line_cust_dash = $_SESSION['line_cust_dash'];
$cellID = $_GET['cell_id'];
$c_name = $_GET['c_name'];
$station = $_GET['station'];
$is_tab_login = $_SESSION['is_tab_user'];
$is_cell_login = $_SESSION['is_cell_login'];
$path = '';
$main_menu = '';
$station_menu='';
if(!empty($is_cell_login) && $is_cell_login == 1){
	$path = site_URL. "cell_line_dashboard.php";
	$main_menu = $path;
	$station_menu = site_URL . "tab_float_menu.php?station=".$station;
}else{
	if(!empty($i) && ($is_tab_login != null)){
		$path = site_URL . "line_tab_dashboard.php";
		$main_menu = $path;
		$station_menu = site_URL . "tab_float_menu.php?station=".$station;
	}else{
		$path = site_URL . "line_status_grp_dashboard.php";
		$main_menu = $path;
		$station_menu = site_URL."float_menu.php?cell_id=" .$cellID."&c_name=".$c_name."&station=".$station;
	}
}
?>
<!-- SKIN-MODES CSS -->
<link href="<?php echo $siteURL; ?>assets/css/form_css/skin-modes.css" rel="stylesheet" />

<!-- ANIMATION CSS -->
<link href="<?php echo $siteURL; ?>assets/css/form_css/animate.css" rel="stylesheet">

<!-- SWITCHER CSS -->
<link href="<?php echo $siteURL; ?>assets/css/form_css/switcher.css" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="<?php echo $siteURL; ?>assets/css/menu.css" rel="stylesheet" type="text/css">
<script src="https://kit.fontawesome.com/198f721d64.js" crossorigin="anonymous"></script>

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
    .main-header{
        margin-bottom: 2% !important;
    }
    .logo_img{
        height: 50px;
    }

    .btn-menu{
        color: #fff;
        background-color: #337ab7;
        border-color: #2e6da4;
    }

</style>
<!-- main-header -->
<div class="main-header side-header sticky nav nav-item">
    <div class="main-container container-fluid">
        <a href="<?php echo $path?>" class="logo">
            <img class = "logo_img" src="<?php echo $siteURL; ?>assets/img/site_logo.png" alt="logo">
        </a>
        <div  style="text-align: end;" class="col-lg-5 col-md-5">
<!--            <a href="--><?php //echo $siteURL; ?><!--line_status_grp_dashboard.php" class="btn bg-success text-white"><i class="fa-solid fa-house"></i></a>-->
<!--            <a href="--><?php //echo $siteURL; ?><!--cell_overview_dashboard.php?cell_id=--><?php //echo $cellID; ?><!--&c_name=--><?php //echo $c_name; ?><!--" class="btn bg-success text-white"><i class="fa-solid fa-table-cells-large"></i></a>-->
<!--            <a href="--><?php //echo $siteURL; ?><!--float_menu.php?cell_id=--><?php //echo $cellID; ?><!--&c_name=--><?php //echo $c_name; ?><!--&station=--><?php //echo $station;?><!--" class="btn bg-success text-white"><i class="fa-solid fa-bars"></i></a>-->
            <a href="<?php echo $main_menu; ?>" class="btn btn-menu text-white">Main Home</a>
<!--            <a href="--><?php //echo $siteURL; ?><!--cell_overview_dashboard.php?cell_id=--><?php //echo $cellID; ?><!--&c_name=--><?php //echo $c_name; ?><!--" class="btn bg-success text-white">Cell Dashboard</a>-->
            <a href="<?php echo $station_menu; ?>" class="btn btn-menu text-white">Station Menu</a>

        </div>
    </div>
</div>
<!-- /main-header -->


<!-- main-sidebar -->
<div style="display: none" class="sticky">
    <aside class="app-sidebar ps ps--active-y horizontal-main mobile-menu">

        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"/></svg></div>
            <?php if ($countervariable % 4 == 0) { ?>
            <ul class="side-menu">
                <li class="side-item side-item-category">Main</li>
                <?php if ($event_status != '0' && $event_status != '') { ?>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="<?php echo $siteURL; ?>events_module/good_bad_piece.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>&station_event_id=<?php echo $station_event_id; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M20 17V7c0-2.168-3.663-4-8-4S4 4.832 4 7v10c0 2.168 3.663 4 8 4s8-1.832 8-4zM12 5c3.691 0 5.931 1.507 6 1.994C17.931 7.493 15.691 9 12 9S6.069 7.493 6 7.006C6.069 6.507 8.309 5 12 5zM6 9.607C7.479 10.454 9.637 11 12 11s4.521-.546 6-1.393v2.387c-.069.499-2.309 2.006-6 2.006s-5.931-1.507-6-2V9.607zM6 17v-2.393C7.479 15.454 9.637 16 12 16s4.521-.546 6-1.393v2.387c-.069.499-2.309 2.006-6 2.006s-5.931-1.507-6-2z"/></svg><span class="side-menu__label">Good & Bad Piece</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z"/></svg><span class="side-menu__label">Material Tracability</span><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">Material Tracability</a></li>
                        <li><a class="slide-item" href="<?php echo $siteURL; ?>material_tracability/material_tracability.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>&station_event_id=<?php echo $station_event_id; ?>">Material Tracability</a></li>
                        <li><a class="slide-item" href="<?php echo $siteURL; ?>material_tracability/material_search.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>&station_event_id=<?php echo $station_event_id; ?>">View Material Tracability</a></li>
                    </ul>
                </li>
                <?php } ?>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11-6h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zm-1 6h-4V5h4v4zm-9 4H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6H5v-4h4v4zm8-6c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z"/></svg><span class="side-menu__label">10X</span><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu__label1"><a href="javascript:void(0);">10X</a></li>
                        <li><a class="slide-item" href="<?php echo $siteURL; ?>10x/10x.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>&station_event_id=<?php echo $station_event_id; ?>&f_type=n">Submit 10X</a></li>
                        <li><a class="slide-item" href="<?php echo $siteURL; ?>10x/10x_search.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>&station_event_id=<?php echo $station_event_id; ?>">View 10x</a></li>
                    </ul>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="<?php echo $siteURL; ?>view_station_status.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M20 17V7c0-2.168-3.663-4-8-4S4 4.832 4 7v10c0 2.168 3.663 4 8 4s8-1.832 8-4zM12 5c3.691 0 5.931 1.507 6 1.994C17.931 7.493 15.691 9 12 9S6.069 7.493 6 7.006C6.069 6.507 8.309 5 12 5zM6 9.607C7.479 10.454 9.637 11 12 11s4.521-.546 6-1.393v2.387c-.069.499-2.309 2.006-6 2.006s-5.931-1.507-6-2V9.607zM6 17v-2.393C7.479 15.454 9.637 16 12 16s4.521-.546 6-1.393v2.387c-.069.499-2.309 2.006-6 2.006s-5.931-1.507-6-2z"/></svg><span class="side-menu__label">View Station Status</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="<?php echo $siteURL; ?>events_module/station_events.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>&part_family=<?php echo $pf_no; ?>&part_number=<?php echo $p_no; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M20 17V7c0-2.168-3.663-4-8-4S4 4.832 4 7v10c0 2.168 3.663 4 8 4s8-1.832 8-4zM12 5c3.691 0 5.931 1.507 6 1.994C17.931 7.493 15.691 9 12 9S6.069 7.493 6 7.006C6.069 6.507 8.309 5 12 5zM6 9.607C7.479 10.454 9.637 11 12 11s4.521-.546 6-1.393v2.387c-.069.499-2.309 2.006-6 2.006s-5.931-1.507-6-2V9.607zM6 17v-2.393C7.479 15.454 9.637 16 12 16s4.521-.546 6-1.393v2.387c-.069.499-2.309 2.006-6 2.006s-5.931-1.507-6-2z"/></svg><span class="side-menu__label">Add / Update Events</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M20.995 6.9a.998.998 0 0 0-.548-.795l-8-4a1 1 0 0 0-.895 0l-8 4a1.002 1.002 0 0 0-.547.795c-.011.107-.961 10.767 8.589 15.014a.987.987 0 0 0 .812 0c9.55-4.247 8.6-14.906 8.589-15.014zM12 19.897C5.231 16.625 4.911 9.642 4.966 7.635L12 4.118l7.029 3.515c.037 1.989-.328 9.018-7.029 12.264z"/><path d="m11 12.586-2.293-2.293-1.414 1.414L11 15.414l5.707-5.707-1.414-1.414z"/></svg><span class="side-menu__label">Forms</span><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                    <ul class="slide-menu">
                        <?php if (($_SESSION['role_id'] == 'admin') || ($_SESSION['role_id'] == 'super')) { ?>
                        <li><a class="slide-item" href="<?php echo $siteURL; ?>form_module/form_settings.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>">Create Form</a></li>
                        <?php } ?>
                        <li><a class="slide-item" href="<?php echo $siteURL; ?>form_module/options.php?station=<?php echo $line; ?>&part_family=<?php echo $pf_no; ?>&part_number=<?php echo $p_no; ?>">Submit Form</a></li>
                    </ul>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M20.995 6.9a.998.998 0 0 0-.548-.795l-8-4a1 1 0 0 0-.895 0l-8 4a1.002 1.002 0 0 0-.547.795c-.011.107-.961 10.767 8.589 15.014a.987.987 0 0 0 .812 0c9.55-4.247 8.6-14.906 8.589-15.014zM12 19.897C5.231 16.625 4.911 9.642 4.966 7.635L12 4.118l7.029 3.515c.037 1.989-.328 9.018-7.029 12.264z"/><path d="m11 12.586-2.293-2.293-1.414 1.414L11 15.414l5.707-5.707-1.414-1.414z"/></svg><span class="side-menu__label">Crew</span><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                    <ul class="slide-menu">
                        <li><a class="slide-item" href="<?php echo $siteURL; ?>assignment_module/assign_crew.php?line=<?php echo $line; ?>">Assign / Unassign Crew</a></li>
                        <li><a class="slide-item" href="<?php echo $siteURL; ?>view_assigned_crew.php?station=<?php echo $line; ?>">View Assigned Crew</a></li>
                    </ul>
                </li>
            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"/></svg></div>
            <?php } else { ?>
                <ul class="side-menu">
                    <li class="side-item side-item-category">Main</li>
                    <?php if ($event_status != '0' && $event_status != '') { ?>
                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="<?php echo $siteURL; ?>events_module/good_bad_piece.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>&station_event_id=<?php echo $station_event_id; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M20 17V7c0-2.168-3.663-4-8-4S4 4.832 4 7v10c0 2.168 3.663 4 8 4s8-1.832 8-4zM12 5c3.691 0 5.931 1.507 6 1.994C17.931 7.493 15.691 9 12 9S6.069 7.493 6 7.006C6.069 6.507 8.309 5 12 5zM6 9.607C7.479 10.454 9.637 11 12 11s4.521-.546 6-1.393v2.387c-.069.499-2.309 2.006-6 2.006s-5.931-1.507-6-2V9.607zM6 17v-2.393C7.479 15.454 9.637 16 12 16s4.521-.546 6-1.393v2.387c-.069.499-2.309 2.006-6 2.006s-5.931-1.507-6-2z"/></svg><span class="side-menu__label">Good & Bad Piece</span></a>
                        </li>
                        <li class="slide">
                            <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z"/></svg><span class="side-menu__label">Material Tracability</span><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                            <ul class="slide-menu">
                                <li class="side-menu__label1"><a href="javascript:void(0);">Material Tracability</a></li>
                                <li><a class="slide-item" href="<?php echo $siteURL; ?>material_tracability/material_tracability.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>&station_event_id=<?php echo $station_event_id; ?>">Material Tracability</a></li>
                                <li><a class="slide-item" href="<?php echo $siteURL; ?>material_tracability/material_search.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>&station_event_id=<?php echo $station_event_id; ?>">View Material Tracability</a></li>
                            </ul>
                        </li>
                    <?php } ?>
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11-6h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zm-1 6h-4V5h4v4zm-9 4H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6H5v-4h4v4zm8-6c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z"/></svg><span class="side-menu__label">10X</span><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                        <ul class="slide-menu">
                            <li class="side-menu__label1"><a href="javascript:void(0);">10X</a></li>
                            <li><a class="slide-item" href="<?php echo $siteURL; ?>10x/10x.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>&station_event_id=<?php echo $station_event_id; ?>&f_type=n">Submit 10X</a></li>
                            <li><a class="slide-item" href="<?php echo $siteURL; ?>10x/10x_search.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>&station_event_id=<?php echo $station_event_id; ?>">View 10x</a></li>
                        </ul>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="<?php echo $siteURL; ?>view_station_status.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M20 17V7c0-2.168-3.663-4-8-4S4 4.832 4 7v10c0 2.168 3.663 4 8 4s8-1.832 8-4zM12 5c3.691 0 5.931 1.507 6 1.994C17.931 7.493 15.691 9 12 9S6.069 7.493 6 7.006C6.069 6.507 8.309 5 12 5zM6 9.607C7.479 10.454 9.637 11 12 11s4.521-.546 6-1.393v2.387c-.069.499-2.309 2.006-6 2.006s-5.931-1.507-6-2V9.607zM6 17v-2.393C7.479 15.454 9.637 16 12 16s4.521-.546 6-1.393v2.387c-.069.499-2.309 2.006-6 2.006s-5.931-1.507-6-2z"/></svg><span class="side-menu__label">View Station Status</span><i class="angle fe fe-chevron-right"></i></a>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="<?php echo $siteURL; ?>events_module/station_events.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&line=<?php echo $line; ?>&part_family=<?php echo $pf_no; ?>&part_number=<?php echo $p_no; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M20 17V7c0-2.168-3.663-4-8-4S4 4.832 4 7v10c0 2.168 3.663 4 8 4s8-1.832 8-4zM12 5c3.691 0 5.931 1.507 6 1.994C17.931 7.493 15.691 9 12 9S6.069 7.493 6 7.006C6.069 6.507 8.309 5 12 5zM6 9.607C7.479 10.454 9.637 11 12 11s4.521-.546 6-1.393v2.387c-.069.499-2.309 2.006-6 2.006s-5.931-1.507-6-2V9.607zM6 17v-2.393C7.479 15.454 9.637 16 12 16s4.521-.546 6-1.393v2.387c-.069.499-2.309 2.006-6 2.006s-5.931-1.507-6-2z"/></svg><span class="side-menu__label">Add / Update Events</span><i class="angle fe fe-chevron-right"></i></a>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M20.995 6.9a.998.998 0 0 0-.548-.795l-8-4a1 1 0 0 0-.895 0l-8 4a1.002 1.002 0 0 0-.547.795c-.011.107-.961 10.767 8.589 15.014a.987.987 0 0 0 .812 0c9.55-4.247 8.6-14.906 8.589-15.014zM12 19.897C5.231 16.625 4.911 9.642 4.966 7.635L12 4.118l7.029 3.515c.037 1.989-.328 9.018-7.029 12.264z"/><path d="m11 12.586-2.293-2.293-1.414 1.414L11 15.414l5.707-5.707-1.414-1.414z"/></svg><span class="side-menu__label">Forms</span><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                        <ul class="slide-menu">
                            <?php if (($_SESSION['role_id'] == 'admin') || ($_SESSION['role_id'] == 'super')) { ?>
                                <li><a class="slide-item" href="<?php echo $siteURL; ?>form_module/form_settings.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>">Create Form</a></li>
                            <?php } ?>
                            <li><a class="slide-item" href="<?php echo $siteURL; ?>form_module/options.php?station=<?php echo $line; ?>&part_family=<?php echo $pf_no; ?>&part_number=<?php echo $p_no; ?>">Submit Form</a></li>
                        </ul>
                    </li>
                    <li class="slide">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M20.995 6.9a.998.998 0 0 0-.548-.795l-8-4a1 1 0 0 0-.895 0l-8 4a1.002 1.002 0 0 0-.547.795c-.011.107-.961 10.767 8.589 15.014a.987.987 0 0 0 .812 0c9.55-4.247 8.6-14.906 8.589-15.014zM12 19.897C5.231 16.625 4.911 9.642 4.966 7.635L12 4.118l7.029 3.515c.037 1.989-.328 9.018-7.029 12.264z"/><path d="m11 12.586-2.293-2.293-1.414 1.414L11 15.414l5.707-5.707-1.414-1.414z"/></svg><span class="side-menu__label">Crew</span><i class="fa fa-angle-down" aria-hidden="true"></i></a>
                        <ul class="slide-menu">
                            <li><a class="slide-item" href="<?php echo $siteURL; ?>assignment_module/assign_crew.php?line=<?php echo $line; ?>">Assign / Unassign Crew</a></li>
                            <li><a class="slide-item" href="<?php echo $siteURL; ?>view_assigned_crew.php?station=<?php echo $line; ?>">View Assigned Crew</a></li>
                        </ul>
                    </li>
                </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24"><path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"/></svg></div>
            <?php   }    ?>
        </div>
    </aside>
</div>
<!-- main-sidebar -->

<!-- JQUERY JS -->
<script src="<?php echo $siteURL;?>assets/js/form_js/jquery-min.js"></script>

<!-- BOOTSTRAP JS -->
<script src="<?php echo $siteURL;?>assets/js/form_js/popper-min.js"></script>
<script src="<?php echo $siteURL;?>assets/js/form_js/bootstrap-min.js"></script>


<!-- P-SCROLL JS -->
<script src="<?php echo $siteURL;?>assets/js/form_js/perfect-scrollbar.js"></script>


<!-- SIDEBAR JS -->
<script src="<?php echo $siteURL;?>assets/js/form_js/sidemenu.js"></script>




<!-- CUSTOM JS -->
<script src="<?php echo $siteURL;?>assets/js/form_js/custom.js"></script>