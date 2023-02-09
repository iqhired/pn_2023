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
$cell_name = $_GET['c_name'];
if (isset($cellID)) {
    $sql = "select stations from `cell_grp` where c_id = '$cellID'";
    $result1 = mysqli_query($db, $sql);
    $ass_line_array = array();
    while ($rowc = mysqli_fetch_array($result1)) {
        $arr_stations = explode(',', $rowc['stations']);
        foreach ($arr_stations as $station) {
            if (isset($station) && $station != '') {
                array_push($ass_line_array, $station);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<!-- Main navbar -->
<body class="ltr main-body app horizontal">
<div>
    <?php
//	$menu_req = 1;
//    $cust_cam_page_header = "Cell Status Dashboard";
    include("admin_menu1.php");

    ?>
    <!-- main-content -->
    <div class="main-content horizontal-content">
        <!-- container -->
        <div class="main-container container">
            <!-- breadcrumb -->
            <div class="breadcrumb-header justify-content-between">
                <div class="left-content">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item tx-15"><a href="javascript:void(0);">PN</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Cell Status Dashboard</li>
                    </ol>
                </div>
            </div>

            <div class="row row-body">
                <?php
                if ($is_cust_dash == 1 && isset($line_cust_dash)){
                    $line_cust_dash_arr = explode(',', $line_cust_dash);
                    $line_rr = '';
                    $i = 0;
                    foreach ($line_cust_dash_arr as $line_cust_dash_item) {
                        if ($i == 0) {
                            $line_rr = "SELECT * FROM  cam_line where enabled = 1 and line_id IN (";
                            $i++;
                            if (isset($line_cust_dash_item) && $line_cust_dash_item != '') {
                                $line_rr .= "'" . $line_cust_dash_item . "'";
                            }
                        } else {
                            if (isset($line_cust_dash_item) && $line_cust_dash_item != '') {
                                $line_rr .= ",'" . $line_cust_dash_item . "'";
                            }
                        }
                    }
                    $line_rr .= ")";
                    $query = $line_rr;
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
//			$buttonclass = "94241c";
                            $buttonclass = $rowc01["color_code"];
                        } else {

                        }

                        if ($countervariable % 4 == 0) {
                            ?>
                            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4" onclick="cellDB('<?php echo $cellID; ?>','<?php echo $cell_name; ?>','<?php echo $line; ?>')">
                                <div class="card custom-card">
                                    <div class="card-header d-flex custom-card-header border-bottom-0 ">
                                        <h5 class="card-title"><?php echo $rowc["line_name"]; ?></h5>
                                        <div class="card-options">
                                            <a href="javascript:void(0);" class="btn btn-sm"><i class="fa fa-bars" aria-hidden="true"></i></a>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <table>
                                            <tr>
                                                <td style="width: 40%;">
                                                    <div class="tr-row">Part Family :</div></td>

                                                <td style="width: 60%;">
                                <span><?php echo $pf_name;
                                    $pf_name = ''; ?> </span>
                                                    <input type="hidden" id="id<?php echo $countervariable; ?>"
                                                           value="<?php echo $time; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 40%;">
                                                    <div class="tr-row">Part Number : </div>
                                                </td>
                                                <td style="width: 60%;"><span><?php echo $p_num;
                                                        $p_num = ''; ?></span></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 40%;">
                                                    <div class="tr-row">Part Name :</div>
                                                </td>
                                                <td style="width: 60%;"><span><?php echo $p_name;
                                                        $p_name = ''; ?></span></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <?php
                                    $variable123 = $time;
                                    if ($variable123 != "") {
                                        //include the timing configuration file
                                        include("timings_config.php");
                                        ?>

                                    <?php } ?>
                                    <div class="card-footer" style="background-color:<?php echo $buttonclass; ?>;color: #fff;">
                                        <?php echo $line_status_text; ?> -
                                        <span id="demo<?php echo $countervariable; ?>">&nbsp;</span><span id="server-load"></span>
                                    </div>
                                </div>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4" onclick="cellDB('<?php echo $cellID; ?>','<?php echo $cell_name; ?>','<?php echo $line; ?>')">
                                <div class="card custom-card">
                                    <div class="card-header d-flex custom-card-header border-bottom-0 ">
                                        <h5 class="card-title"><?php echo $rowc["line_name"]; ?></h5>
                                        <div class="card-options">
                                            <a href="javascript:void(0);" class="btn btn-sm"><i class="fa fa-bars" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <table>
                                            <tr>
                                                <td style="width: 40%;">
                                                    <div class="tr-row">Part Family : </div>
                                                </td>
                                                <td style="width: 60%;">
                                <span><?php echo $pf_name;
                                    $pf_name = ''; ?> </span>
                                                    <input type="hidden" id="id<?php echo $countervariable; ?>"
                                                           value="<?php echo $time; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 40%;">
                                                    <div class="tr-row">Part Number : </div>
                                                </td>
                                                <td style="width: 60%;"><span><?php echo $p_num;  $p_num = ''; ?></span></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 40%;">
                                                    <div>Part Name :</div>
                                                </td>
                                                <td style="width: 60%;"><span><?php echo $p_name;  $p_name = ''; ?></span></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <?php
                                    $variable123 = $time;
                                    if ($variable123 != "") {
                                        //include the timing configuration file
                                        include("timings_config.php");
                                        ?>

                                    <?php } ?>
                                    <div class="card-footer" style="background-color:<?php echo $buttonclass; ?>;color: #fff;">
                                        <?php echo $line_status_text; ?> -
                                        <span id="demo<?php echo $countervariable; ?>">&nbsp;</span><span id="server-load"></span>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                } else {
                    $countervariable = 0;
                    asort($ass_line_array);
                    foreach ($ass_line_array as $line) {
                        $query = sprintf("SELECT line_name FROM  cam_line where line_id = '$line'");
                        $qur = mysqli_query($db, $query);
                        $rowc = mysqli_fetch_array($qur);
                        $event_status = '';
                        $line_status_text = '';
                        $buttonclass = '#000';
                        $p_num = '';
                        $p_name = '';
                        $pf_name = '';
                        $time = '';
                        $countervariable++;
                        $qur01 = mysqli_query($db, "SELECT pn.part_number as p_num, pn.pm_part_number_id as p_no, pn.part_name as p_name , pf.part_family_name as pf_name,pf.pm_part_family_id as pf_no, et.event_type_name as e_name ,et.color_code as color_code , sg_events.modified_on as updated_time ,sg_events.station_event_id as station_event_id , sg_events.event_status as event_status , sg_events.created_on as e_start_time,sg_events.event_type_id as event_type_id FROM sg_station_event as sg_events inner join event_type as et on sg_events.event_type_id=et.event_type_id Inner Join pm_part_family as pf on sg_events.part_family_id = pf.pm_part_family_id inner join pm_part_number as pn on sg_events.part_number_id=pn.pm_part_number_id where sg_events.line_id= '$line' ORDER by sg_events.created_on DESC LIMIT 1");
                        $rowc01 = mysqli_fetch_array($qur01);
                        if ($rowc01 != null) {
                            $event_type_id = $rowc01['event_type_id'];
                            $time = $rowc01['updated_time'];
                            $station_event_id = $rowc01['station_event_id'];
                            $line_status_text = $rowc01['e_name'];
                            $event_status = $rowc01['event_status'];
                            $p_num = $rowc01["p_num"];;
                            $p_no = $rowc01["p_no"];;
                            $p_name = $rowc01["p_name"];;
                            $pf_name = $rowc01["pf_name"];
                            $pf_no = $rowc01["pf_no"];
                            $buttonclass = $rowc01["color_code"];
                        } else {

                        }

                        if ($countervariable % 4 == 0) {
                            ?>
                            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4"onclick="cellDB('<?php echo $cellID; ?>','<?php echo $cell_name; ?>','<?php echo $line; ?>')">
                                <div class="card custom-card">
                                    <div class="card-header d-flex custom-card-header border-bottom-0 ">
                                        <h5 class="card-title"><?php echo $rowc["line_name"]; ?></h5>
                                        <div class="card-options">
                                            <a href="javascript:void(0);" class="btn btn-sm"><i class="fa fa-bars" aria-hidden="true"></i></a>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <table>
                                            <tr>
                                                <td style="width: 40%;">
                                                    <div class="tr-row">Part Family :</div>
                                                </td>
                                                <td style="width: 60%;">
                                <span><?php echo $pf_name;
                                    $pf_name = ''; ?> </span>
                                                    <input type="hidden" id="id<?php echo $countervariable; ?>"
                                                           value="<?php echo $time; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 40%;">
                                                    <div class="tr-row">Part Number :</div>
                                                </td>
                                                <td style="width: 60%;">
                                <span><?php echo $p_num;
                                    $p_num = ''; ?></span></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 40%;">
                                                    <div class="tr-row">Part Name :</div>
                                                </td>
                                                <td style="width: 60%;">
                                <span><?php echo $p_name;
                                    $p_name = ''; ?></span></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <?php
                                    $variable123 = $time;
                                    if ($variable123 != "") {
                                        //include the timing configuration file
                                        include("timings_config.php");
                                        ?>

                                    <?php } ?>
                                    <div class="card-footer" style="background-color:<?php echo $buttonclass; ?>;color: #fff;">
                                        <?php echo $line_status_text; ?> -
                                        <span id="demo<?php echo $countervariable; ?>">&nbsp;</span><span id="server-load"></span>
                                    </div>
                                </div>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4" onclick="cellDB('<?php echo $cellID; ?>','<?php echo $cell_name; ?>','<?php echo $line; ?>')">
                                <div class="card custom-card">
                                    <div class="card-header d-flex custom-card-header border-bottom-0 ">
                                        <h5 class="card-title"><?php echo $rowc["line_name"]; ?></h5>
                                        <div class="card-options">
                                            <a href="javascript:void(0);" class="btn btn-sm"><i class="fa fa-bars" aria-hidden="true"></i></a>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <table>
                                            <tr>
                                                <td style="width: 40%;">
                                                    <div class="tr-row">Part Family :</div>
                                                </td>

                                                <td style="width: 60%;">
                                                    <div  class="tr-row"><?php echo $pf_name;
                                                        $pf_name = ''; ?> </div>
                                                    <input type="hidden" id="id<?php echo $countervariable; ?>"
                                                           value="<?php echo $time; ?>">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width: 40%;">
                                                    <div class="tr-row">Part Number :</div>
                                                </td>
                                                <td style="width: 60%;"><span><?php echo $p_num;
                                                        $p_num = ''; ?></span></td>
                                            </tr>
                                            <tr>
                                                <td style="width: 40%;">
                                                    <div class="tr-row">Part Name :</div>
                                                </td>
                                                <td style="width: 60%;">
                                <span><?php echo $p_name;
                                    $p_name = ''; ?></span></td>
                                            </tr>
                                        </table>
                                    </div>
                                    <?php
                                    $variable123 = $time;
                                    if ($variable123 != "") {
                                        //include the timing configuration file
                                        include("timings_config.php");
                                        ?>

                                    <?php } ?>
                                    <div class="card-footer" style="background-color:<?php echo $buttonclass; ?>;color: #fff;">
                                        <?php echo $line_status_text; ?> -
                                        <span id="demo<?php echo $countervariable; ?>">&nbsp;</span><span id="server-load"></span>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }

                ?>
            </div>
        </div>
    </div>
</div>
<script>
    function cellDB(cell_id,c_name,station) {
        window.open("<?php echo $siteURL . "float_menu.php?cell_id=" ; ?>" + cell_id + "<?php echo "&c_name=" ; ?>" + c_name + "<?php echo "&station=" ; ?>" + station , "_self")
    }

</script>
<?php include("footer1.php");?> <!-- /page container -->

</body>
</html>
