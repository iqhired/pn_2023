<?php include("../config.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
$sessionuser = $_SESSION["fullname"];
$chicagotime = date("Y-m-d H:i:s");
$temp = "";
$message_stauts_class = 'alert-danger';
$import_status_message = 'Error: Assignment Position Relation does not exist';
$assign_crew_log_id = "";
//check user
checkSession();

$low_rate = 0;
if (count($_POST) > 0){

//assign crew delete
    $assign_line = $_POST['assign_line'];
    $position = $_POST['position'];
    $ussser = $_POST['user_name'];
    $assignline = $_POST['assignline'];
    $resource_type = $_POST['resource_type'];
    $random = "AS" . rand(1, 999999);
    if ($position != "") {
        $cnt = count($position);
        for ($i = 0; $i < $cnt;) {
            $p_name = $position[$i];
            $u_name = $ussser[$i];
            $checkvalue = "";
            $resource_type1 = $resource_type[$i];
            if ($u_name != "1") {
                try {
                    //here start transaction
                    mysqli_query($db, "START TRANSACTION");
                    //query to check whether record exist or not
                    $query0006 = sprintf("SELECT * FROM  cam_assign_crew WHERE position_id = '$p_name' and line_id = '$assignline' and resource_type = '$resource_type1' ");
                    $qur0006 = mysqli_query($db, $query0006);
                    $rowc0006 = mysqli_fetch_array($qur0006);
                    $checkvalue = $rowc0006["assign_crew_id"];
                    if ($checkvalue == "") {
                        $query0001 = sprintf("SELECT * FROM  cam_user_rating WHERE position_id = '$p_name' and line_id = '$assignline' and user_id = '$u_name' ");
                        $qur0001 = mysqli_query($db, $query0001);
                        $rowc0001 = mysqli_fetch_array($qur0001);
                        $final_usr_ratings = $rowc0001["ratings"];
                        $query0002 = sprintf("SELECT * FROM  cam_station_pos_rel WHERE position_id = '$p_name' and line_id = '$assignline' ");
                        $qur0002 = mysqli_query($db, $query0002);
                        $rowc0002 = mysqli_fetch_array($qur0002);
                        $final_assign_ratings = $rowc0002["ratings"];
                        $emailmsg = trim($rowc0002["email_msg"]);
                        $emailgreeting = "Hi All,";
                        $emailto = $rowc0002["email_to"];
                        $emailcc = $rowc0002["email_cc"];
                        $signature = $rowc0002["email_signature"];
                        $email_notification = "0";
                        $query0003 = sprintf("SELECT * FROM  cam_users where users_id = '$u_name' ");
                        $qur0003 = mysqli_query($db, $query0003);
                        $rowc0003 = mysqli_fetch_array($qur0003);
                        $firname = $rowc0003["firstname"];
                        $lasname = $rowc0003["lastname"];
                        $query0004 = sprintf("SELECT * FROM  cam_line where line_id = '$assignline' ");
                        $qur0004 = mysqli_query($db, $query0004);
                        $rowc0004 = mysqli_fetch_array($qur0004);
                        $linename = $rowc0004["line_name"];
                        $query0005 = sprintf("SELECT * FROM  cam_position where position_id = '$p_name' ");
                        $qur0005 = mysqli_query($db, $query0005);
                        $rowc0005 = mysqli_fetch_array($qur0005);
                        $positionname = $rowc0005["position_name"];
                        if ($final_usr_ratings < $final_assign_ratings) {
                            //mail code start
                            require '../vendor/autoload.php';
                            $mail = new PHPMailer();
                            $mail->isSMTP();
                            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;
                            $mail->Host = 'smtp.gmail.com';
                            $mail->Port = 587;
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                            $mail->SMTPAuth = true;
                            $mail->Username = EMAIL_USER;
                            $mail->Password = EMAIL_PASSWORD;
                            $mail->setFrom('admin@plantnavigator.com', 'Admin Plantnavigator');
                            // mail code over
                            $message = '<html><body>';
                            $message .= "<br/><br/><span style='font-family: 'Source Sans Pro', sans-serif;color:#757575;font-weight:600;' > " . $emailgreeting . "</span><br/><br/>";
                            $message .= "<span style='font-family: 'Source Sans Pro', sans-serif;color:#757575;font-weight:600;' > " . $emailmsg . "</span><br/> ";
                            $message .= '<br/><table rules="all" style="border-color: #666;" border="1" cellpadding="10">';
                            $message .= "<tr style='background: #eee;'><td><strong>Station : </strong> </td><td>" . $linename . "</td></tr>";
                            $message .= "<tr><td><strong>Position : </strong> </td><td>" . $positionname . "</td></tr>";
                            $message .= "<tr><td><strong>Crew Member : </strong> </td><td>" . $firname . " " . $lasname . "</td></tr>";
                            $message .= "</table>";
                            $message .= "<br/><br/>";
                            $message .= $signature;
                            $message .= "</body></html>";
                            $subject = "Low Rating Warning Mail";
                            $mail->addAddress($emailto, $emailto);
                            $mail->isHTML(true);
                            $mail->Subject = $subject;
                            $mail->Body = $message;
                            if ($low_rate == 1) {
                                if (!$mail->send()) {
                                       echo 'Mailer Error: ' . $mail->ErrorInfo;
                                } else {
                                }
                            }
                            $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail';
                            $imapStream = imap_open($path, $mail->Username, $mail->Password);
                            $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
                            imap_close($imapStream);
                            $sql6 = "INSERT INTO `cam_email_log`(`station_id`, `position_id`, `user_id` , `email_message` , `email_to` , `email_cc` ,`assign_crew_transaction_id`,`created_at` ) VALUES ('$assignline','$p_name','$u_name','$emailmsg' ,'$emailto' ,'$emailcc' ,'$random','$chicagotime')";
                            $result6 = mysqli_query($db, $sql6);
                            $email_notification = "1";
                        }
                        $assign_crew_id01 = "";
                        //check for first assignment
                        $qurlog01 = mysqli_query($db, "SELECT * FROM  cam_assign_crew WHERE line_id = '$assignline'");
                        $rowclog01 = mysqli_fetch_array($qurlog01);
                        $assign_crew_id01 = $rowclog01["assign_crew_id"];
                        if ($assign_crew_id01 == "" || $assign_crew_id01 == NULL) {
                            $sql11 = "INSERT INTO `cam_log`(`position_id`, `line_id`,`user_id` , `assign_crew_transaction_id` , `email_notification` , `flag`, `created_at`, `updated_at` ) VALUES ('$p_name','$assignline','$u_name' ,'$random' ,'$email_notification','1','$chicagotime','$chicagotime')";
                            $result3 = mysqli_query($db, $sql11);
                        }
                        // first assign check over
                        if ($resource_type1 != "") {
                            $sql1 = "INSERT INTO `cam_assign_crew`( `resource_type`, `position_id`, `line_id`,`user_id` , `assign_crew_transaction_id` , `email_notification`, `created_at` ) VALUES ('$resource_type1','$p_name','$assignline','$u_name' ,'$random' ,'$email_notification','$chicagotime')";
                            $result31 = mysqli_query($db, $sql1);
                            if (!$result31) {
                                $_SESSION['message_stauts_class'] = 'alert-danger';
                                $_SESSION['import_status_message'] = 'please try again...';
                            } else {
                                $_SESSION['message_stauts_class'] = 'alert-success';
                                $_SESSION['import_status_message'] = 'Crew Assigned Sucessfully.';
                            }
                        } else {
                            $sql1 = "INSERT INTO `cam_assign_crew`(`position_id`, `line_id`,`user_id` , `assign_crew_transaction_id` , `email_notification`, `created_at` ) VALUES ('$p_name','$assignline','$u_name' ,'$random' ,'$email_notification','$chicagotime')";
                            $result31 = mysqli_query($db, $sql1);
                            if (!$result31) {
                                $_SESSION['message_stauts_class'] = 'alert-danger';
                                $_SESSION['import_status_message'] = 'please try again...';
                            } else {
                                $_SESSION['message_stauts_class'] = 'alert-success';
                                $_SESSION['import_status_message'] = 'Crew Assigned Sucessfully.';
                            }
                        }

                        $queryaa = sprintf("SELECT * FROM  cam_users WHERE users_id = '$u_name'");
                        $quraa = mysqli_query($db, $queryaa);
                        $rowcaa = mysqli_fetch_array($quraa);
                        $ass = $rowcaa["assigned"];
                        if ($ass != 0) {
                            $sqlassign2 = "update cam_users set assigned2 = 1 where users_id='$u_name'";
                            $resultassign2 = mysqli_query($db, $sqlassign2);
                            $qurlog = mysqli_query($db, "SELECT * FROM  cam_assign_crew_log WHERE user_id = '$u_name' and status = '1'");
                            $rowclog = mysqli_fetch_array($qurlog);
                            $assign_crew_log_id = $rowclog["assign_crew_log_id"];
                        } else {
                            $ass++;
                            $sqlassign2 = "update cam_users set assigned = '$ass'  where users_id ='$u_name'";
                            $resultassign2 = mysqli_query($db, $sqlassign2);
                        }
                        if ($resource_type1 != "") {
                            $sql51 = "INSERT INTO `cam_assign_crew_log`(`resource_type`,`position_id`, `station_id`,`user_id` , `assign_crew_transaction_id` , `status` , `email_notification`,`first_assign_log_id`,`total_time`,`last_assigned_by`,`assign_time`,`unassign_time`) VALUES ('$resource_type1','$p_name','$assignline','$u_name' ,'$random' ,'1','$email_notification','$assign_crew_log_id','00:00:00','$sessionuser','$chicagotime','$chicagotime')";
                            $result11 = mysqli_query($db, $sql51);
                        } else {
                            $sql52 = "INSERT INTO `cam_assign_crew_log`(`position_id`, `station_id`,`user_id` , `assign_crew_transaction_id` , `status` , `email_notification`,`first_assign_log_id`,`total_time`,`last_assigned_by`,`assign_time`,`unassign_time`) VALUES ('$p_name','$assignline','$u_name' ,'$random' ,'1','$email_notification','$assign_crew_log_id','00:00:00','$sessionuser','$chicagotime','$chicagotime')";
                            $result12 = mysqli_query($db, $sql52);
                        }
                        if ($resource_type1 == "regular") {
                            $sql5 = "update cam_station_pos_rel set assigned ='1' where position_id	='$p_name' and line_id ='$assignline'  ";
                            $result1 = mysqli_query($db, $sql5);
                            $assign_crew_log_id = "";
                        }
                        //check record exist or not code over here
                    } else {
                        $_SESSION['message_stauts_class'] = 'alert-danger';
                        $_SESSION['import_status_message'] = 'Error: Position is alredy Assigned';
                    }
                    //here committe for success transaction
                    mysqli_query($db, "COMMIT");
                } catch (\Throwable $e) {
                    // An exception has been thrown
                    // We must rollback the transaction
                    mysqli_query($db, "ROLLBACK");
                    $_SESSION['message_stauts_class'] = 'alert-danger';
                    $_SESSION['import_status_message'] = 'Error: Assign Un-Successful. Please Try Again';
                    //  throw $e; // but the error must be handled anyway
                }
            }
            $i++;
        }
    }
    mysqli_close($db);
    $assign_line = $_POST['assignline'];
    $_SESSION['aasignline'] = $_POST['assignline'];
}
?>