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

?>
<!Doctype html>
<html lang="en">
<head>
    <title>Dashboard Menus</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/button.css">

<body>
<section class="ftco-section" id="buttons">
    <div class="container">

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
    $line_name = $rowc["line_name"];

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

    } ?>
     <div class="row mb-4">
            <div class="col-md-12">
                <h2 class="heading-section"><?php echo $line_name;?> - Menu</h2>
            </div>
        </div>
      <?php if ($countervariable % 4 == 0) { ?>
        <div class="row mb-5">
            <div class="col-md-12 mb-3">
                <div class="row">
                    <?php if ($event_status != '0' && $event_status != '') { ?>
                    <div class="col-md-3">
                        <a href="<?php echo $siteURL; ?>events_module/good_bad_piece.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>&station_event_id=<?php echo $station_event_id; ?>">
                        <button type="button" class="btn mb-2 mb-md-0 btn-primary btn-block">Good & Bad Piece </button>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="<?php echo $siteURL; ?>material_tracability/material_tracability.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>&station_event_id=<?php echo $station_event_id; ?>">
                            <button type="button" class="btn mb-2 mb-md-0 btn-primary btn-block">Material Tracability</button>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="<?php echo $siteURL; ?>material_tracability/material_search.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>&station_event_id=<?php echo $station_event_id; ?>">
                            <button type="button" class="btn mb-2 mb-md-0 btn-primary btn-block">View Material Tracability </button>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="<?php echo $siteURL; ?>10x/10x.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>&station_event_id=<?php echo $station_event_id; ?>&f_type=n">
                        <button type="button" class="btn mb-2 mb-md-0 btn-primary btn-block">Submit 10X </button>
                        </a>
                    </div>
                </div>
            </div>
             <div class="col-md-12 mb-3">
                 <div class="row">
                    <div class="col-md-3">
                           <a href="<?php echo $siteURL; ?>10x/10x_search.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>&station_event_id=<?php echo $station_event_id; ?>">
                           <button type="button" class="btn mb-2 mb-md-0 btn-primary btn-block">View 10X </button>
                           </a>
                       </div>
                    <?php } ?>
                    <div class="col-md-3">
                            <a href="<?php echo $siteURL; ?>view_station_status.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>">
                                <button type="button" class="btn mb-2 mb-md-0 btn-primary btn-block">View Station Status </button>
                            </a>
                        </div>
                    <div class="col-md-3">
                            <a href="<?php echo $siteURL; ?>events_module/station_events.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&line=<?php echo $line; ?>&part_family=<?php echo $pf_no; ?>&part_number=<?php echo $p_no; ?>">
                                <button type="button" class="btn mb-2 mb-md-0 btn-primary btn-block">Add / Update Events </button>
                            </a>
                        </div>
                    <?php if (($_SESSION['role_id'] == 'admin') || ($_SESSION['role_id'] == 'super')) { ?>
                        <div class="col-md-3">
                            <a href="<?php echo $siteURL; ?>form_module/form_settings.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>">
                                <button type="button" class="btn mb-2 mb-md-0 btn-primary btn-block">Create Form</button>
                            </a>
                        </div>
                           <?php } ?>
                    <div class="col-md-3">
                        <a href="<?php echo $siteURL; ?>form_module/options.php?station=<?php echo $line; ?>&part_family=<?php echo $pf_no; ?>&part_number=<?php echo $p_no; ?>">
                            <button type="button" class="btn mb-2 mb-md-0 btn-primary btn-block">Submit Form</button>
                        </a>
                    </div>
                 </div>
             </div>
            <div class="col-md-12 mb-3">
                <div class="row">
                    <div class="col-md-3">
                        <a href="<?php echo $siteURL; ?>form_module/form_search.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $rowc["line_id"]; ?>">
                            <button type="button" class="btn mb-2 mb-md-0 btn-primary btn-block">View Form</button>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="<?php echo $siteURL; ?>assignment_module/assign_crew.php?station=<?php echo $line; ?>">
                            <button type="button" class="btn mb-2 mb-md-0 btn-primary btn-block">Assign/Unassign Crew</button>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="<?php echo $siteURL; ?>view_assigned_crew.php?station=<?php echo $line; ?>">
                            <button type="button" class="btn mb-2 mb-md-0 btn-primary btn-block">View Assigned Crew</button>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="<?php echo $siteURL; ?>document_module/view_document.php?station=<?php echo $line; ?>&part=<?php echo $p_no; ?>">
                            <button type="button" class="btn mb-2 mb-md-0 btn-primary btn-block">View Document</button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <div class="row">
                    <?php if($event_type_id == 7) { ?>
                    <div class="col-md-3">
                        <a href="<?php echo $siteURL; ?>view_form_status.php?station=<?php echo $line; ?>">
                            <button type="button" class="btn mb-2 mb-md-0 btn-primary btn-block">Form Submit Dashboard</button>
                        </a>
                    </div>
                    <?php }  else { ?>
                    <?php if (($_SESSION['role_id'] == 'admin') || ($_SESSION['role_id'] == 'super')) { ?>
                    <div class="col-md-3">
                        <a href="<?php echo $siteURL; ?>config_module/line_wise_form_submit_dashboard.php?id=<?php echo $line; ?>">
                            <button type="button" class="btn mb-2 mb-md-0 btn-primary btn-block">Form Submit Dashboard</button>
                        </a>
                    </div>
                    <?php } }?>
                </div>
            </div>
        </div>
       <?php } else { ?>
           <div class="row mb-5">
               <div class="col-md-12 mb-3">
                   <div class="row">
                       <?php if ($event_status != '0' && $event_status != '') { ?>
                           <div class="col-md-3">
                               <a href="<?php echo $siteURL; ?>events_module/good_bad_piece.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>&station_event_id=<?php echo $station_event_id; ?>">
                                   <button type="button" class="btn mb-2 mb-md-0 btn-primary btn-block">Good & Bad Pieces</button>
                               </a>
                           </div>
                           <div class="col-md-3">
                               <a href="<?php echo $siteURL; ?>material_tracability/material_tracability.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>&station_event_id=<?php echo $station_event_id; ?>">
                                   <button type="button" class="btn mb-2 mb-md-0 btn-primary btn-block">Material Tracability</button>
                               </a>
                           </div>
                           <div class="col-md-3">
                               <a href="<?php echo $siteURL; ?>material_tracability/material_search.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>&station_event_id=<?php echo $station_event_id; ?>">
                                   <button type="button" class="btn mb-2 mb-md-0 btn-primary btn-block">View Material Tracability </button>
                               </a>
                           </div>
                           <div class="col-md-3">
                               <a href="<?php echo $siteURL; ?>10x/10x.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>&station_event_id=<?php echo $station_event_id; ?>&f_type=n">
                                   <button type="button" class="btn mb-2 mb-md-0 btn-primary btn-block">Submit 10X </button>
                               </a>
                           </div>
                   </div>
               </div>
               <div class="col-md-12 mb-3">
                   <div class="row">
                           <div class="col-md-3">
                               <a href="<?php echo $siteURL; ?>10x/10x_search.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>&station_event_id=<?php echo $station_event_id; ?>">
                                   <button type="button" class="btn mb-2 mb-md-0 btn-primary btn-block">View 10X </button>
                               </a>
                           </div>
                       <?php } ?>

                       <div class="col-md-3">
                           <a href="<?php echo $siteURL; ?>view_station_status.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>">
                               <button type="button" class="btn mb-2 mb-md-0 btn-primary btn-block">View Station Status </button>
                           </a>
                       </div>
                       <div class="col-md-3">
                           <a href="<?php echo $siteURL; ?>events_module/station_events.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&line=<?php echo $line; ?>&part_family=<?php echo $pf_no; ?>&part_number=<?php echo $p_no; ?>">
                               <button type="button" class="btn mb-2 mb-md-0 btn-primary btn-block">Add / Update Events </button>
                           </a>
                       </div>
                       <?php if (($_SESSION['role_id'] == 'admin') || ($_SESSION['role_id'] == 'super')) { ?>
                           <div class="col-md-3">
                               <a href="<?php echo $siteURL; ?>form_module/form_settings.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $line; ?>">
                                   <button type="button" class="btn mb-2 mb-md-0 btn-primary btn-block">Create Form</button>
                               </a>
                           </div>
                       <?php } ?>
                   </div>
               </div>
               <div class="col-md-12 mb-3">
                   <div class="row">

                       <div class="col-md-3">
                           <a href="<?php echo $siteURL; ?>form_module/options.php?station=<?php echo $line; ?>&part_family=<?php echo $pf_no; ?>&part_number=<?php echo $p_no; ?>">
                               <button type="button" class="btn mb-2 mb-md-0 btn-primary btn-block">Submit Form</button>
                           </a>
                       </div>

                       <div class="col-md-3">
                           <a href="<?php echo $siteURL; ?>form_module/form_search.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>&station=<?php echo $rowc["line_id"]; ?>">
                               <button type="button" class="btn mb-2 mb-md-0 btn-primary btn-block">View Form</button>
                           </a>
                       </div>
                       <div class="col-md-3">
                           <a href="<?php echo $siteURL; ?>assignment_module/assign_crew.php?station=<?php echo $line; ?>">
                               <button type="button" class="btn mb-2 mb-md-0 btn-primary btn-block">Assign/Unassign Crew</button>
                           </a>
                       </div>
                       <div class="col-md-3">
                           <a href="<?php echo $siteURL; ?>view_assigned_crew.php?station=<?php echo $line; ?>">
                               <button type="button" class="btn mb-2 mb-md-0 btn-primary btn-block">View Assigned Crew</button>
                           </a>
                       </div>
                   </div>
               </div>
               <div class="col-md-12 mb-3">
                   <div class="row">
                       <div class="col-md-3">
                           <a href="<?php echo $siteURL; ?>document_module/view_document.php?station=<?php echo $line; ?>&part=<?php echo $p_no; ?>">
                               <button type="button" class="btn mb-2 mb-md-0 btn-primary btn-block">View Document</button>
                           </a>
                       </div>

                       <div class="col-md-3">
                           <a href="<?php echo $siteURL; ?>report_config_module/scan_line_asset.php?cell_id=<?php echo $cellID; ?>&c_name=<?php echo $c_name; ?>">
                               <button type="button" class="btn mb-2 mb-md-0 btn-primary btn-block">Submit Station Assets</button>
                           </a>
                       </div>
                       <?php if($event_type_id == 7) { ?>
                           <div class="col-md-3">
                               <a href="<?php echo $siteURL; ?>view_form_status.php?station=<?php echo $line; ?>">
                                   <button type="button" class="btn mb-2 mb-md-0 btn-primary btn-block">Form Submit Dashboard</button>
                               </a>
                           </div>
                       <?php }  else { ?>
                           <?php if (($_SESSION['role_id'] == 'admin') || ($_SESSION['role_id'] == 'super')) { ?>
                               <div class="col-md-3">
                                   <a href="<?php echo $siteURL; ?>config_module/line_wise_form_submit_dashboard.php?id=<?php echo $line; ?>">
                                       <button type="button" class="btn mb-2 mb-md-0 btn-primary btn-block">Form Submit Dashboard</button>
                                   </a>
                               </div>
                           <?php } }?>
                   </div>
               </div>
           </div>
        <?php   } }
        ?>
    </div>
</section>
</body>
</html>
