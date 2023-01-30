<?php include("config.php");
if (!isset($_SESSION['user'])) {
	header('location: logout.php');
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
	exit;
}
//Set the time of the user's last activity
$_SESSION['LAST_ACTIVITY'] = $time;
$_SESSION['timestamp_id'] = '';
$_SESSION['f_type'] = '';
$timestamp = date('H:i:s');
$message = date("Y-m-d H:i:s");
$is_cust_dash = $_SESSION['is_cust_dash'];
$line_cust_dash = $_SESSION['line_cust_dash'];
$cellID = $_GET['cell_id'];
$c_name = $_GET['c_name'];
$station = $_GET['station'];
$path = '';
if(!empty($is_cell_login) && $is_cell_login == 1){
	$path = $siteURL. "cell_line_dashboard.php";
}else{
	if(!empty($i) && ($is_tab_login != null)){
		$path = "../line_tab_dashboard.php";
	}else{
		$path = $siteURL . "line_status_grp_dashboard.php";
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

	.logo_img{
		height: 50px;
	}
	.logo{
		margin-bottom: 20px !important;
	}

</style>
<!-- main-header -->
<div class="main-header side-header sticky nav nav-item">
	<div class="main-container container-fluid">
		<a href="<?php echo $path?>" class="logo">
			<img class = "logo_img" src="<?php echo $siteURL; ?>assets/img/site_logo.png" alt="logo">
		</a>
		<div class="main-header-left ">
			<div class="app-sidebar__toggle" data-bs-toggle="sidebar">
				<a class="open-toggle" href="javascript:void(0);"><i class="fa fa-bars" aria-hidden="true"></i></a>
				<a class="close-toggle" href="javascript:void(0);"><i class="fa fa-bars" aria-hidden="true"></i></a>
			</div>
			<div class="logo-horizontal">
				<a href="<?php echo $siteURL; ?>line_status_grp_dashboard.php" class="header-logo">
					<img src="<?php echo $siteURL; ?>assets/img/Site_logo.png" class="mobile-logo logo-1" alt="logo">
					<img src="<?php echo $siteURL; ?>assets/img/Site_logo.png" class="mobile-logo dark-logo-1" alt="logo">
				</a>
			</div>
		</div>
		<div class="main-header-right">
			<button class="navbar-toggler navresponsive-toggler d-md-none ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
			</button>

			<div class="mb-0 navbar navbar-expand-lg navbar-nav-right responsive-navbar navbar-dark p-0">
				<div class="collapse navbar-collapse" id="navbarSupportedContent-4">
					<ul class="nav nav-item header-icons navbar-nav-right ms-auto">

						<li class="dropdown main-profile-menu nav nav-item nav-link ps-lg-2">
							<a class="new nav-link profile-user d-flex" href="" data-bs-toggle="dropdown"><i class="fa fa-bars" aria-hidden="true"></i></a>
							<div class="dropdown-menu">
								<?php
								$query = "select * from cam_line where line_id = '$station'";
								$qur = mysqli_query($db, $query);
								$countervariable = 0;

								while ($rowc = mysqli_fetch_array($qur)) {
									$event_status = '';
									$line_status_text = '';
									$buttonclass = '#000';
									$p_num = '';
									$p_name = '';
									$pf_name = '';
									$time = '';
									$countervariable++;
									$line = $rowc["line_id"];

									//$qur01 = mysqli_query($db, "SELECT created_on as start_time , modified_on as updated_time FROM  sg_station_event where line_id = '$line' and event_status = 1 order BY created_on DESC LIMIT 1");
									$qur01 = mysqli_query($db, "SELECT pn.part_number as p_num, pn.part_name as p_name , pf.part_family_name as pf_name,pf.pm_part_family_id as pf_no, et.event_type_name as e_name ,et.color_code as color_code , sg_events.modified_on as updated_time ,sg_events.station_event_id as station_event_id , sg_events.event_status as event_status , sg_events.created_on as e_start_time,sg_events.event_type_id as event_type_id FROM sg_station_event as sg_events inner join event_type as et on sg_events.event_type_id=et.event_type_id Inner Join pm_part_family as pf on sg_events.part_family_id = pf.pm_part_family_id inner join pm_part_number as pn on sg_events.part_number_id=pn.pm_part_number_id where sg_events.line_id= '$line' ORDER by sg_events.created_on DESC LIMIT 1");
									$rowc01 = mysqli_fetch_array($qur01);
									if ($rowc01 != null) {
										$event_type_id = $rowc01['event_type_id'];
										$time = $rowc01['updated_time'];
										$station_event_id = $rowc01['station_event_id'];
										$line_status_text = $rowc01['e_name'];
										$event_status = $rowc01['event_status'];
										$p_num = $rowc01["p_num"];
										$p_no = $rowc01["p_no"];;
										$p_name = $rowc01["p_name"];
										$pf_name = $rowc01["pf_name"];
										$pf_no = $rowc01["pf_no"];
										$buttonclass = $rowc01["color_code"];
									} else {

									}
									if ($countervariable % 4 == 0) { ?>
										<!-- main-sidebar -->
										<div class="sticky">
											<aside class="app-sidebar">
												<div class="main-sidebar-header active">
													<a class="header-logo active" href="<?php echo $siteURL; ?>line_status_grp_dashboard.php">
														<img src="<?php echo $siteURL; ?>assets/img/Site_logo.png" class="main-logo  desktop-logo" alt="logo">
														<img src="<?php echo $siteURL; ?>assets/img/Site_logo.png" class="main-logo  desktop-dark" alt="logo">
														<img src="<?php echo $siteURL; ?>assets/img/Site_logo.png" class="main-logo  mobile-logo" alt="logo">
														<img src="<?php echo $siteURL; ?>assets/img/Site_logo.png" class="main-logo  mobile-dark" alt="logo">
													</a>
												</div>
												<div class="main-sidemenu">
													<ul class="side-menu">
														<?php if ($event_status != '0' && $event_status != '') { ?>
															<li>
																<a class="side-menu__item" data-bs-toggle="slide" href="<?php echo $siteURL; ?>events_module/good_bad_piece.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>&station_event_id=<?php echo $station_event_id; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z"/></svg><span class="side-menu__label">Good & Bad Piece</span></a>
															</li>
															<li>
																<a class="side-menu__item" data-bs-toggle="slide" href="<?php echo $siteURL; ?>material_tracability/material_tracability.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>&station_event_id=<?php echo $station_event_id; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11-6h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zm-1 6h-4V5h4v4zm-9 4H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6H5v-4h4v4zm8-6c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z"/></svg><span class="side-menu__label">Material Tracability</span></a>

															</li>
															<li>
																<a class="side-menu__item" data-bs-toggle="slide" href="<?php echo $siteURL; ?>material_tracability/material_search.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>&station_event_id=<?php echo $station_event_id; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M20 17V7c0-2.168-3.663-4-8-4S4 4.832 4 7v10c0 2.168 3.663 4 8 4s8-1.832 8-4zM12 5c3.691 0 5.931 1.507 6 1.994C17.931 7.493 15.691 9 12 9S6.069 7.493 6 7.006C6.069 6.507 8.309 5 12 5zM6 9.607C7.479 10.454 9.637 11 12 11s4.521-.546 6-1.393v2.387c-.069.499-2.309 2.006-6 2.006s-5.931-1.507-6-2V9.607zM6 17v-2.393C7.479 15.454 9.637 16 12 16s4.521-.546 6-1.393v2.387c-.069.499-2.309 2.006-6 2.006s-5.931-1.507-6-2z"/></svg><span class="side-menu__label">View Material Tracability</span></a>
															</li>
															<li>
																<a class="side-menu__item" data-bs-toggle="slide" href="<?php echo $siteURL; ?>10x/10x.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>&station_event_id=<?php echo $station_event_id; ?>&f_type=n"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M20.995 6.9a.998.998 0 0 0-.548-.795l-8-4a1 1 0 0 0-.895 0l-8 4a1.002 1.002 0 0 0-.547.795c-.011.107-.961 10.767 8.589 15.014a.987.987 0 0 0 .812 0c9.55-4.247 8.6-14.906 8.589-15.014zM12 19.897C5.231 16.625 4.911 9.642 4.966 7.635L12 4.118l7.029 3.515c.037 1.989-.328 9.018-7.029 12.264z"/><path d="m11 12.586-2.293-2.293-1.414 1.414L11 15.414l5.707-5.707-1.414-1.414z"/></svg><span class="side-menu__label">Submit 10X</span></a>
															</li>
															<li>
																<a class="side-menu__item" data-bs-toggle="slide" href="<?php echo $siteURL; ?>10x/10x_search.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>&station_event_id=<?php echo $station_event_id; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M22 7.999a1 1 0 0 0-.516-.874l-9.022-5a1.003 1.003 0 0 0-.968 0l-8.978 4.96a1 1 0 0 0-.003 1.748l9.022 5.04a.995.995 0 0 0 .973.001l8.978-5A1 1 0 0 0 22 7.999zm-9.977 3.855L5.06 7.965l6.917-3.822 6.964 3.859-6.918 3.852z"/><path d="M20.515 11.126 12 15.856l-8.515-4.73-.971 1.748 9 5a1 1 0 0 0 .971 0l9-5-.97-1.748z"/><path d="M20.515 15.126 12 19.856l-8.515-4.73-.971 1.748 9 5a1 1 0 0 0 .971 0l9-5-.97-1.748z"/></svg><span class="side-menu__label">View 10X</span></a>
															</li>
														<?php } ?>
														<li>
															<a class="side-menu__item" data-bs-toggle="slide" href="<?php echo $siteURL; ?>view_station_status.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M12 22c4.879 0 9-4.121 9-9s-4.121-9-9-9-9 4.121-9 9 4.121 9 9 9zm0-16c3.794 0 7 3.206 7 7s-3.206 7-7 7-7-3.206-7-7 3.206-7 7-7zm5.284-2.293 1.412-1.416 3.01 3-1.413 1.417zM5.282 2.294 6.7 3.706l-2.99 3-1.417-1.413z"/><path d="M11 9h2v5h-2zm0 6h2v2h-2z"/></svg><span class="side-menu__label">View Station Status</span></a>
														</li>
														<li>
															<a class="side-menu__item" data-bs-toggle="slide" href="<?php echo $siteURL; ?>events_module/station_events.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&line=<?php echo $line; ?>&part_family=<?php echo $pf_no; ?>&part_number=<?php echo $p_no; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M20 7h-1.209A4.92 4.92 0 0 0 19 5.5C19 3.57 17.43 2 15.5 2c-1.622 0-2.705 1.482-3.404 3.085C11.407 3.57 10.269 2 8.5 2 6.57 2 5 3.57 5 5.5c0 .596.079 1.089.209 1.5H4c-1.103 0-2 .897-2 2v2c0 1.103.897 2 2 2v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7c1.103 0 2-.897 2-2V9c0-1.103-.897-2-2-2zm-4.5-3c.827 0 1.5.673 1.5 1.5C17 7 16.374 7 16 7h-2.478c.511-1.576 1.253-3 1.978-3zM7 5.5C7 4.673 7.673 4 8.5 4c.888 0 1.714 1.525 2.198 3H8c-.374 0-1 0-1-1.5zM4 9h7v2H4V9zm2 11v-7h5v7H6zm12 0h-5v-7h5v7zm-5-9V9.085L13.017 9H20l.001 2H13z"/></svg><span class="side-menu__label">Add/Update Events</span></a>
														</li>

													</ul>
												</div>
											</aside>
										</div>
										<div class="sticky">
											<aside class="app-sidebar">
												<div class="main-sidemenu">
													<ul class="side-menu">
														<?php if (($_SESSION['role_id'] == 'admin') || ($_SESSION['role_id'] == 'super')) { ?>
															<li>
																<a class="side-menu__item" data-bs-toggle="slide" href="<?php echo $siteURL; ?>form_module/form_settings.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M20 7h-4V4c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H4c-1.103 0-2 .897-2 2v9a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V9c0-1.103-.897-2-2-2zM4 11h4v8H4v-8zm6-1V4h4v15h-4v-9zm10 9h-4V9h4v10z"/></svg><span class="side-menu__label">Create Form</span></a>
															</li>
														<?php } ?>
														<li>
															<a class="side-menu__item" data-bs-toggle="slide" href="<?php echo $siteURL; ?>form_module/options.php?station=<?php echo $line; ?>&part_family=<?php echo $pf_no; ?>&part_number=<?php echo $p_no; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"/></svg><span class="side-menu__label">Submit Form</span></a>
														</li>
														<li>
															<a class="side-menu__item" data-bs-toggle="slide" href="<?php echo $siteURL; ?>assignment_module/assign_crew.php?station=<?php echo $line; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"/></svg><span class="side-menu__label">Assign/Unassign crew</span></a>
														</li>
														<li>
															<a class="side-menu__item" data-bs-toggle="slide" href="<?php echo $siteURL; ?>view_assigned_crew.php?station=<?php echo $line; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M19.937 8.68c-.011-.032-.02-.063-.033-.094a.997.997 0 0 0-.196-.293l-6-6a.997.997 0 0 0-.293-.196c-.03-.014-.062-.022-.094-.033a.991.991 0 0 0-.259-.051C13.04 2.011 13.021 2 13 2H6c-1.103 0-2 .897-2 2v16c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2V9c0-.021-.011-.04-.013-.062a.99.99 0 0 0-.05-.258zM16.586 8H14V5.414L16.586 8zM6 20V4h6v5a1 1 0 0 0 1 1h5l.002 10H6z"/></svg><span class="side-menu__label">View Assigned Crew</span></a>
														</li>
														<li>
															<a class="side-menu__item" data-bs-toggle="slide" href="<?php echo $siteURL; ?>document_module/view_document.php?station=<?php echo $line; ?>&part=<?php echo $p_no; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M19.937 8.68c-.011-.032-.02-.063-.033-.094a.997.997 0 0 0-.196-.293l-6-6a.997.997 0 0 0-.293-.196c-.03-.014-.062-.022-.094-.033a.991.991 0 0 0-.259-.051C13.04 2.011 13.021 2 13 2H6c-1.103 0-2 .897-2 2v16c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2V9c0-.021-.011-.04-.013-.062a.99.99 0 0 0-.05-.258zM16.586 8H14V5.414L16.586 8zM6 20V4h6v5a1 1 0 0 0 1 1h5l.002 10H6z"/></svg><span class="side-menu__label">View Document</span></a>
														</li>
														<li>
															<a class="side-menu__item" data-bs-toggle="slide" href="<?php echo $siteURL; ?>report_config_module/scan_line_asset.php"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M19 3H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2zm0 2 .001 4H5V5h14zM5 11h8v8H5v-8zm10 8v-8h4.001l.001 8H15z"/></svg><span class="side-menu__label">Submit Station Assets</span></a>
														</li>
														<?php if($event_type_id == 7) { ?>
															<li>
																<a class="side-menu__item" href="<?php echo $siteURL; ?>view_form_status.php?station=<?php echo $line; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11 4h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6h-4v-4h4v4zM17 3c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2zM7 13c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z"/></svg><span class="side-menu__label">Form Submit Dashboard</span></a>
															</li>
														<?php }  else { ?>
															<?php if (($_SESSION['role_id'] == 'admin') || ($_SESSION['role_id'] == 'super')) { ?>
																<li>
																	<a class="side-menu__item" href="config_module/line_wise_form_submit_dashboard.php?id=<?php echo $line; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11 4h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6h-4v-4h4v4zM17 3c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2zM7 13c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z"/></svg><span class="side-menu__label">Form Submit Dashboard</span></a>
																</li>
															<?php } }?>
													</ul>
												</div>
											</aside>
										</div>
										<!-- main-sidebar -->
									<?php } else { ?>
										<!-- main-sidebar -->
										<div class="sticky">
											<aside class="app-sidebar">
												<div class="main-sidebar-header active">
													<a class="header-logo active" href="<?php echo $siteURL; ?>line_status_grp_dashboard.php">
														<img src="<?php echo $siteURL; ?>assets/img/Site_logo.png" class="main-logo  desktop-logo" alt="logo">
														<img src="<?php echo $siteURL; ?>assets/img/Site_logo.png" class="main-logo  desktop-dark" alt="logo">
														<img src="<?php echo $siteURL; ?>assets/img/Site_logo.png" class="main-logo  mobile-logo" alt="logo">
														<img src="<?php echo $siteURL; ?>assets/img/Site_logo.png" class="main-logo  mobile-dark" alt="logo">
													</a>
												</div>
												<div class="main-sidemenu">
													<ul class="side-menu">
														<?php if ($event_status != '0' && $event_status != '') { ?>
															<li>
																<a class="side-menu__item" data-bs-toggle="slide" href="<?php echo $siteURL; ?>events_module/good_bad_piece.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>&station_event_id=<?php echo $station_event_id; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M3 13h1v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7h1a1 1 0 0 0 .707-1.707l-9-9a.999.999 0 0 0-1.414 0l-9 9A1 1 0 0 0 3 13zm7 7v-5h4v5h-4zm2-15.586 6 6V15l.001 5H16v-5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H6v-9.586l6-6z"/></svg><span class="side-menu__label">Good & Bad Piece</span></a>
															</li>
															<li>
																<a class="side-menu__item" data-bs-toggle="slide" href="<?php echo $siteURL; ?>material_tracability/material_tracability.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>&station_event_id=<?php echo $station_event_id; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11-6h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zm-1 6h-4V5h4v4zm-9 4H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6H5v-4h4v4zm8-6c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z"/></svg><span class="side-menu__label">Material Tracability</span></a>

															</li>
															<li>
																<a class="side-menu__item" data-bs-toggle="slide" href="<?php echo $siteURL; ?>material_tracability/material_search.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>&station_event_id=<?php echo $station_event_id; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M20 17V7c0-2.168-3.663-4-8-4S4 4.832 4 7v10c0 2.168 3.663 4 8 4s8-1.832 8-4zM12 5c3.691 0 5.931 1.507 6 1.994C17.931 7.493 15.691 9 12 9S6.069 7.493 6 7.006C6.069 6.507 8.309 5 12 5zM6 9.607C7.479 10.454 9.637 11 12 11s4.521-.546 6-1.393v2.387c-.069.499-2.309 2.006-6 2.006s-5.931-1.507-6-2V9.607zM6 17v-2.393C7.479 15.454 9.637 16 12 16s4.521-.546 6-1.393v2.387c-.069.499-2.309 2.006-6 2.006s-5.931-1.507-6-2z"/></svg><span class="side-menu__label">View Material Tracability</span></a>
															</li>
															<li>
																<a class="side-menu__item" data-bs-toggle="slide" href="<?php echo $siteURL; ?>10x/10x.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>&station_event_id=<?php echo $station_event_id; ?>&f_type=n"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M20.995 6.9a.998.998 0 0 0-.548-.795l-8-4a1 1 0 0 0-.895 0l-8 4a1.002 1.002 0 0 0-.547.795c-.011.107-.961 10.767 8.589 15.014a.987.987 0 0 0 .812 0c9.55-4.247 8.6-14.906 8.589-15.014zM12 19.897C5.231 16.625 4.911 9.642 4.966 7.635L12 4.118l7.029 3.515c.037 1.989-.328 9.018-7.029 12.264z"/><path d="m11 12.586-2.293-2.293-1.414 1.414L11 15.414l5.707-5.707-1.414-1.414z"/></svg><span class="side-menu__label">Submit 10X</span></a>
															</li>
															<li>
																<a class="side-menu__item" data-bs-toggle="slide" href="<?php echo $siteURL; ?>10x/10x_search.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>&station_event_id=<?php echo $station_event_id; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M22 7.999a1 1 0 0 0-.516-.874l-9.022-5a1.003 1.003 0 0 0-.968 0l-8.978 4.96a1 1 0 0 0-.003 1.748l9.022 5.04a.995.995 0 0 0 .973.001l8.978-5A1 1 0 0 0 22 7.999zm-9.977 3.855L5.06 7.965l6.917-3.822 6.964 3.859-6.918 3.852z"/><path d="M20.515 11.126 12 15.856l-8.515-4.73-.971 1.748 9 5a1 1 0 0 0 .971 0l9-5-.97-1.748z"/><path d="M20.515 15.126 12 19.856l-8.515-4.73-.971 1.748 9 5a1 1 0 0 0 .971 0l9-5-.97-1.748z"/></svg><span class="side-menu__label">View 10X</span></a>
															</li>
														<?php } ?>
														<li>
															<a class="side-menu__item" data-bs-toggle="slide" href="<?php echo $siteURL; ?>view_station_status.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $rowc["line_id"]; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M12 22c4.879 0 9-4.121 9-9s-4.121-9-9-9-9 4.121-9 9 4.121 9 9 9zm0-16c3.794 0 7 3.206 7 7s-3.206 7-7 7-7-3.206-7-7 3.206-7 7-7zm5.284-2.293 1.412-1.416 3.01 3-1.413 1.417zM5.282 2.294 6.7 3.706l-2.99 3-1.417-1.413z"/><path d="M11 9h2v5h-2zm0 6h2v2h-2z"/></svg><span class="side-menu__label">View Station Status</span></a>
														</li>


													</ul>
												</div>
											</aside>
										</div>
										<div class="sticky">
											<aside class="app-sidebar">
												<div class="main-sidemenu">
													<ul class="side-menu">
														<li>
															<a class="side-menu__item" data-bs-toggle="slide" href="<?php echo $siteURL; ?>events_module/station_events.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $rowc["line_id"]; ?>&part_family=<?php echo $pf_no; ?>&part_number=<?php echo $p_no; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M20 7h-1.209A4.92 4.92 0 0 0 19 5.5C19 3.57 17.43 2 15.5 2c-1.622 0-2.705 1.482-3.404 3.085C11.407 3.57 10.269 2 8.5 2 6.57 2 5 3.57 5 5.5c0 .596.079 1.089.209 1.5H4c-1.103 0-2 .897-2 2v2c0 1.103.897 2 2 2v7c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2v-7c1.103 0 2-.897 2-2V9c0-1.103-.897-2-2-2zm-4.5-3c.827 0 1.5.673 1.5 1.5C17 7 16.374 7 16 7h-2.478c.511-1.576 1.253-3 1.978-3zM7 5.5C7 4.673 7.673 4 8.5 4c.888 0 1.714 1.525 2.198 3H8c-.374 0-1 0-1-1.5zM4 9h7v2H4V9zm2 11v-7h5v7H6zm12 0h-5v-7h5v7zm-5-9V9.085L13.017 9H20l.001 2H13z"/></svg><span class="side-menu__label">Add/Update Events</span></a>
														</li>
														<?php if (($_SESSION['role_id'] == 'admin') || ($_SESSION['role_id'] == 'super')) { ?>
															<li>
																<a class="side-menu__item" data-bs-toggle="slide" href="<?php echo $siteURL; ?>form_module/form_settings.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $rowc["line_id"]; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M20 7h-4V4c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v5H4c-1.103 0-2 .897-2 2v9a1 1 0 0 0 1 1h18a1 1 0 0 0 1-1V9c0-1.103-.897-2-2-2zM4 11h4v8H4v-8zm6-1V4h4v15h-4v-9zm10 9h-4V9h4v10z"/></svg><span class="side-menu__label">Create Form</span></a>
															</li>
														<?php } ?>

														<li>
															<a class="side-menu__item" data-bs-toggle="slide" href="<?php echo $siteURL; ?>form_module/options.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $rowc["line_id"]; ?>&part_family=<?php echo $pf_no; ?>&part_number=<?php echo $p_no; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M19.937 8.68c-.011-.032-.02-.063-.033-.094a.997.997 0 0 0-.196-.293l-6-6a.997.997 0 0 0-.293-.196c-.03-.014-.062-.022-.094-.033a.991.991 0 0 0-.259-.051C13.04 2.011 13.021 2 13 2H6c-1.103 0-2 .897-2 2v16c0 1.103.897 2 2 2h12c1.103 0 2-.897 2-2V9c0-.021-.011-.04-.013-.062a.99.99 0 0 0-.05-.258zM16.586 8H14V5.414L16.586 8zM6 20V4h6v5a1 1 0 0 0 1 1h5l.002 10H6z"/></svg><span class="side-menu__label">Submit Form</span></a>
														</li>
														<li>
															<a class="side-menu__item" data-bs-toggle="slide" href="<?php echo $siteURL; ?>form_module/form_search.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $rowc["line_id"]; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M4 6h16v2H4zm0 5h16v2H4zm0 5h16v2H4z"/></svg><span class="side-menu__label">View Form</span></a>
														</li>
														<li>
															<a class="side-menu__item" href="<?php echo $siteURL; ?>assignment_module/assign_crew.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $rowc["line_id"]; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11 4h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6h-4v-4h4v4zM17 3c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2zM7 13c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z"/></svg><span class="side-menu__label">Assign / Unassign Crew</span></a>
														</li>
														<li>
															<a class="side-menu__item" href="<?php echo $siteURL; ?>view_assigned_crew.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $rowc["line_id"]; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11 4h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6h-4v-4h4v4zM17 3c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2zM7 13c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z"/></svg><span class="side-menu__label">View Assigned Crew</span></a>
														</li>

													</ul>
												</div>
											</aside>
										</div>
										<div class="sticky">
											<aside class="app-sidebar">
												<div class="main-sidemenu">
													<ul class="side-menu">
														<li>
															<a class="side-menu__item" href="<?php echo $siteURL; ?>document_module/view_document.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>&part=<?php echo $p_no; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11 4h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6h-4v-4h4v4zM17 3c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2zM7 13c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z"/></svg><span class="side-menu__label"> View Document</span></a>
														</li>
														<li>
															<a class="side-menu__item" href="<?php echo $siteURL; ?>report_config_module/scan_line_asset.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11 4h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6h-4v-4h4v4zM17 3c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2zM7 13c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z"/></svg><span class="side-menu__label">Submit Station Assets</span></a>
														</li>

														<?php if($event_type_id == 7) { ?>
															<li>
																<a class="side-menu__item" href="<?php echo $siteURL; ?>view_form_status.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11 4h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6h-4v-4h4v4zM17 3c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2zM7 13c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z"/></svg><span class="side-menu__label">Form Submit Dashboard</span></a>
															</li>
														<?php }  else { ?>
															<?php if (($_SESSION['role_id'] == 'admin') || ($_SESSION['role_id'] == 'super')) { ?>
																<li>
																	<a class="side-menu__item" href="<?php echo $siteURL; ?>config_module/line_wise_form_submit_dashboard.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&id=<?php echo $line; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M10 3H4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4a1 1 0 0 0-1-1zM9 9H5V5h4v4zm11 4h-6a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-6a1 1 0 0 0-1-1zm-1 6h-4v-4h4v4zM17 3c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2zM7 13c-2.206 0-4 1.794-4 4s1.794 4 4 4 4-1.794 4-4-1.794-4-4-4zm0 6c-1.103 0-2-.897-2-2s.897-2 2-2 2 .897 2 2-.897 2-2 2z"/></svg><span class="side-menu__label">Form Submit Dashboard</span></a>
																</li>
															<?php } }?>
													</ul>
												</div>
											</aside>
										</div>
										<!-- main-sidebar -->
									<?php   }
								}
								?>
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
						<a class="side-menu__item" data-bs-toggle="slide" href="<?php echo $siteURL; ?>events_module/station_events.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&line=<?php echo $line; ?>&part_family=<?php echo $pf_no; ?>&part_number=<?php echo $p_no; ?>"><svg xmlns="http://www.w3.org/2000/svg"  class="side-menu__icon" width="24" height="24" viewBox="0 0 24 24"><path d="M20 17V7c0-2.168-3.663-4-8-4S4 4.832 4 7v10c0 2.168 3.663 4 8 4s8-1.832 8-4zM12 5c3.691 0 5.931 1.507 6 1.994C17.931 7.493 15.691 9 12 9S6.069 7.493 6 7.006C6.069 6.507 8.309 5 12 5zM6 9.607C7.479 10.454 9.637 11 12 11s4.521-.546 6-1.393v2.387c-.069.499-2.309 2.006-6 2.006s-5.931-1.507-6-2V9.607zM6 17v-2.393C7.479 15.454 9.637 16 12 16s4.521-.546 6-1.393v2.387c-.069.499-2.309 2.006-6 2.006s-5.931-1.507-6-2z"/></svg><span class="side-menu__label">Add / Update Events</span></a>
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