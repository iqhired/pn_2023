<?php ini_set('display_errors', false);
include("../config.php");
$chicagodate = date("Y-m-d");
$chicagotime = date('m-d-Y', strtotime('-1 days'));
$subject = "Gauge Notification";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require '../vendor/autoload.php';
//if we put this file in to cronjobs it should be run once per a day
$sql2 = "select * from guage_family_data order by guage_id asc";
$result2 = mysqli_query($db, $sql2);
while ($row2 = $result2->fetch_assoc()) {
    $calibration_validity = $row2["calibration_validity"];
    $guage_id = $row2["guage_id"];
    $gauge_name = $row2["gauge_name"];
    $guage_length = $row2["guage_length"];
    $guage_start_date = $row2["guage_start_date"];
    $calibration_date = $row2["calibration_date"];
    $calibration_validity = $row2["calibration_validity"];
    $gauge_family = $row2["gauge_family"];
    $location = $row2["location"];
    $created_by = $row2["created_by"];
    $created_at = $row2["created_at"];
    $sql3 = "SELECT * FROM  guage_family where guage_family_id = '$gauge_family'";
    $result3 = mysqli_query($db, $sql3);
    $rowc3 = mysqli_fetch_array($result3);
    $guage_family_name = $rowc3["guage_family_name"];
    $sql4 = "SELECT * FROM  cam_users where users_id = '$created_by'";
    $result4 = mysqli_query($db, $sql4);
    $rowc4 = mysqli_fetch_array($result4);
    $fullname = $rowc4["firstname"] .''.$rowc4["lastname"];

    $date = date( "Y-m-d", strtotime( "$calibration_validity -1 day" ) );
    if ($chicagodate == $date) {
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->SMTPAuth = true;
        $mail->Username = EMAIL_USER;
        $mail->Password = EMAIL_PASSWORD;
        $mail->setFrom('admin@plantnavigator.com', 'admin@plantnavigator.com');
        $query2 = sprintf("SELECT * FROM guage_family_data where guage_id = '$guage_id'");
        $qur2 = mysqli_query($db, $query2);
        while ($rowc22 = mysqli_fetch_array($qur2)) {
            $group = explode(',', $rowc22["teams"]);
            $arrusrs = explode(',', $rowc22["users"]);
        }
        $message = 'Gauge calibration validity expiring..';
        $message .= '<br/><br/>';
        $message .= 'Please check gauge details below';
        $signature = 'Admin plantnavigator';
        $cnt = count($arrusrs);
        $structure = '<html><body>';
        $structure .= "<br/><br/><span style='font-family: 'Source Sans Pro', sans-serif;color:#757575;font-weight:600;' > Hii team,</span><br/><br/>";
        $structure .= "<span style='font-family: 'Source Sans Pro', sans-serif;color:#757575;font-weight:600;' > " . $message . "</span><br/> ";
        $structure .= "<br/><br/>";
        $structure .= '<br/><table rules="all" style="border-color: #666;" border="1" cellpadding="10">';
        $structure .= "<tr style='background: #eee;'><td><strong>Gauge Name</strong></td><td><strong>Gauge Length</strong></td><td><strong>Gauge Calibration Date</strong></td><td><strong>Gauge Start Date</strong></td><td><strong>Gauge Calibration Validity Date</strong></td><td><strong>Gauge Family</strong></td><td><strong>Location</strong></td><td><strong>Created By</strong></td></tr>";
        $structure .= "<tr><td>" . $gauge_name . "</td><td>" . $guage_length . "</td><td>" . onlydateReadFormat($calibration_date) . "</td><td>" . onlydateReadFormat($guage_start_date) . "</td><td>" . onlydateReadFormat($calibration_validity ) . "</td><td>" . $guage_family_name . "</td><td>" . $location . "</td><td>" . $fullname . "</td></tr>";
        $structure .= "</table>";
        $structure .= "<br/><br/>";
        $structure .= "- " . $signature;
        $structure .= "</body></html>";
        for ($i = 0; $i < $cnt;) {
            $u_name = $arrusrs[$i];
            if (!empty($u_name)) {
                $query0003 = sprintf("SELECT * FROM  cam_users where users_id = '$u_name' ");
                $qur0003 = mysqli_query($db, $query0003);
                $rowc0003 = mysqli_fetch_array($qur0003);
                $email = $rowc0003["email"];
                $lasname = $rowc0003["lastname"];
                $firstname = $rowc0003["firstname"];
                $mail->addAddress($email, $firstname);
            }
            $i++;
        }
        if ($group != "") {
            $grpcnt = count($group);
            for ($i = 0; $i < $grpcnt;) {
                $grp = $group[$i];
                $query = sprintf("SELECT * FROM  sg_user_group where group_id = '$grp' ");
                $qur = mysqli_query($db, $query);
                while ($rowc = mysqli_fetch_array($qur)) {
                    $u_name = $rowc['user_id'];
                    if (!empty($u_name)) {
                        $query0003 = sprintf("SELECT * FROM  cam_users where users_id = '$u_name' ");
                        $qur0003 = mysqli_query($db, $query0003);
                        $rowc0003 = mysqli_fetch_array($qur0003);
                        $email = $rowc0003["email"];
                        $lasname = $rowc0003["lastname"];
                        $firstname = $rowc0003["firstname"];
                        $mail->addAddress($email, $firstname);
                    }
                }
                $i++;
            }
        }
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = $structure;
        if (!$mail->send()) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        } else {

        }
        function save_mail($mail)
        {
            $path = '{imap.gmail.com:993/imap/ssl}[Gmail]/Sent Mail';
            $imapStream = imap_open($path, $mail->Username, $mail->Password);
            $result = imap_append($imapStream, $path, $mail->getSentMIMEMessage());
            imap_close($imapStream);
            return $result;
        }
    }
}