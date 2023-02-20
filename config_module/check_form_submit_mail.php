<?php include('../config.php');
$chicagotime = date("Y-m-d H:i:s");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//check the mail sent or not/*** @vck ***/
$sql = "select * from form_frequency_data where email_status is null and DATE_ADD(line_up_time,interval 2 hour)";
$qur = mysqli_query($db,$sql);
while($rowc = mysqli_fetch_array($qur)){
    $line_up_time = $rowc['line_up_time'];
    $station_event_id = $rowc['station_event_id'];
    $arrusrs = explode(',', $rowc['users']);
    //fetch station event id from table/*** @vck ***/
    $query = sprintf("SELECT * FROM  sg_station_event where station_event_id = '$station_event_id'");
    $qur3 = mysqli_query($db, $query);
    $rowc3 = mysqli_fetch_array($qur3);
    $line_id = $rowc3["line_id"];
    $part_family_id = $rowc3["part_family_id"];
    $part_number_id = $rowc3["part_number_id"];
    //fetch station name from table/*** @vck ***/
    $qur = sprintf("SELECT * FROM  cam_line where line_id = '$line_id'");
    $qurr = mysqli_query($db, $qur);
    $rowc3 = mysqli_fetch_array($qurr);
    $line_name = $rowc3["line_name"];
    //fetch part family name from table/*** @vck ***/
    $q2 = sprintf("SELECT * FROM  pm_part_family where pm_part_family_id = '$part_family_id'");
    $q22 = mysqli_query($db, $q2);
    $r2 = mysqli_fetch_array($q22);
    $part_family_name = $r2["part_family_name"];
    //fetch part name and part number from table/*** @vck ***/
    $q3 = sprintf("SELECT * FROM  pm_part_number where pm_part_number_id = '$part_number_id'");
    $q33 = mysqli_query($db, $q3);
    $r3 = mysqli_fetch_array($q33);
    $part_number = $r3["part_number"];
    $part_name = $r3["part_name"];
    //check system is greater than uptime after check 2hours completed/*** @vck ***/
    if($chicagotime >= $line_up_time){
        //after mail send update the mail status to be 1/*** @vck ***/
        $q4 = sprintf("update form_frequency_data set email_status = '1' where station_event_id = '$station_event_id'");
        $q44 = mysqli_query($db, $q4);
        //send an email
    require '../vendor/autoload.php';
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->SMTPAuth = true;
    $mail->Username = EMAIL_USER;
    $mail->Password = EMAIL_PASSWORD;
    $mail->setFrom('admin@plantnavigator.com', 'Admin Plantnavigator');
    $message = '<br/><table rules=\"all\" style=\"border-color: #666;\" border=\"1\" cellpadding=\"10\">';
    $message .= "<tr><td style='background: #eee;padding: 5px 10px ;'><strong>Station : </strong> </td><td>" . $line_name . "</td></tr>";
    $message .= "<tr><td style='background: #eee;padding: 5px 10px ;'><strong>Part Number : </strong> </td><td>" . $part_number . "</td></tr>";
    $message .= "<tr><td style='background: #eee;padding: 5px 10px ;'><strong>Part Name : </strong> </td><td>" . $part_name . "</td></tr>";
    $message .= "<tr><td style='background: #eee;padding: 5px 10px ;'><strong>Part Family : </strong> </td><td>" . $part_family_name . "</td></tr>";
    $message .= "</table>";
    $message .= "<br/>";
    $message1 = "Station line up time". ' : ' . $line_up_time;
    $message2 = '\n'."The station starts already 2 hours and completed still not submit any forms.";
    $signature = "- Plantnavigator Admin";
    $cnt = count($arrusrs);
    $structure = '<html><body>';
    $structure .= "<br/><br/><span style='font-family: 'Source Sans Pro', sans-serif;color:#757575;font-weight:600;' > Hello,</span><br/><br/>";
    $structure .= "<span style='font-family: 'Source Sans Pro', sans-serif;color:#757575;font-weight:600;' > " . $message . "</span><br/> ";
    $structure .= "<span style='font-family: 'Source Sans Pro', sans-serif;color:#757575;font-weight:600;' > " . $message1 . "</span><br/> ";
    $structure .= "<span style='font-family: 'Source Sans Pro', sans-serif;color:#757575;font-weight:600;' > " . $message2 . "</span><br/> ";
    $structure .= "<br/><br/>";
    $structure .= $signature;
    $structure .= "</body></html>";
    for ($i = 0; $i < $cnt;) {
        $u_name = $arrusrs[$i];
        if(!empty($u_name)){
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
    $mail->isHTML(true);
    $mail->Subject = 'Form Notification';
    $mail->Body = $structure;
    if(!$mail->Send()){
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
    else{
        echo "mail sent";
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

?>
