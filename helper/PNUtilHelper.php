<?php
/**
 * @author Ayesha
 */
/**
 * This methos return the SQL date in readable format
 * @param $datetime
 * @return false|string
 */
function dateReadFormat($datetime) {
	return date("d-M-Y H:i:s" , strtotime($datetime));
}
/**
 * This methos return the SQL date in readable format
 * @param $datetime
 * @return false|string
 */
function onlydateReadFormat($datetime) {
	return date("d-M-Y" , strtotime($datetime));
}
/**
 * This methos return the SQL date in readable format
 * @param $datetime
 * @return false|string
 */
function datemdY($datetime) {
	return date("m-d-Y" , strtotime($datetime));
}

function convertMDYToYMD($date){
	$parts = explode('-',$date);
	$date = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
	return $date;
}
/**
 * This methods returns conversion of  MDY date format to YMD date format
 * @param $date
 * @return false|string
 */
function convertYMDToMDY($date){
    $parts = explode('-',$date);
    $date = $parts[2] . '-' . $parts[0] . '-' . $parts[1];
    return $date;
}

/**
 * This method Draws a grid on the image uploaded and divide the image in yXy grid.
 * @param $image
 * @param $output
 * @param int $xgrid
 * @param int $ygrid
 */
function gridify($image, $output, $xgrid = 3, $ygrid = 3) {
	$imgpath = "$image";
	$ext = pathinfo($image, PATHINFO_EXTENSION);
	if($ext == "jpg" || $ext == "jpeg" || $ext == "JPG" || $ext == "JPEG")
		$img = imagecreatefromjpeg($image);
	elseif($ext == "png" || $ext == "PNG")
		$img = imagecreatefrompng($image);
	elseif($ext == "gif")
		$img = imagecreatefromgif($image);
	else
		echo 'Unsupported file extension';
	$size = getimagesize($imgpath);
	$width = $size[0];
	$height = $size[1];
	$red   = imagecolorallocate($img, 255,   0,   0);

// Number of cells
//	$xgrid = 3;
//	$ygrid = 3;

// Calulate each cell width/height
	$xgridsize = $width / $xgrid;
	$hgridsize = $height / $ygrid;

// Remember col
	$c = 'A';

// Y
	for ($j=0; $j < $ygrid; $j++) {

		// X
		for ($i=0; $i < $xgrid; $i++) {

			// Dynamic x/y coords
			$sy = $hgridsize * $j;
			$sx = $xgridsize * $i;

			// Draw rectangle
			imagerectangle($img, $sx, $sy, $sx + $xgridsize, $sy + $hgridsize, $red);

			// Draw text
			addTextToCell($img, $sx, $xgridsize, $sy + $hgridsize, $hgridsize, $c . ($i + 1));
		}

		// Bumb cols
		$c++;
	}
	// Save output as file
	//site_URL.'assets/images/part_images/cs/' path to store
	$output_name =  'cs_'. $output .'.jpg';
	imagejpeg($img, $output_name);
	imagedestroy($img);
//	shell_exec("open -a Preview '$output_name'");
}

/**
 * This method is used to write the text on the image
 * @param $img
 * @param $cellX
 * @param $cellWidth
 * @param $cellY
 * @param $cellHeight
 * @param $text
 */
function addTextToCell($img, $cellX, $cellWidth, $cellY, $cellHeight, $text) {

	// Calculate text size

	$text_box = imagettfbbox(100, 0, 'Arial', $text);
	$text_width = $text_box[2]-$text_box[0];
	$text_height = $text_box[7]-$text_box[1];
	$font = 'arial.ttf';
	// Calculate x/y position
	$textx = $cellX + ($cellWidth/2) - $text_width;
	$texty = $cellY - ($cellHeight/2) - $text_height;

	// Set color and draw
	$color = imagecolorallocate($img, 255, 0, 0);
//	imagettftext($img, 20, 0, $textx, $texty, $color, 'OpenSans', $text);
	imagestring($img, 2, $textx, $texty, $text, $color);
	// Add the text


}

/**
 * This method is used to check if session has expired
 * and then to redirect to appropriate Login screen
 */
function checkSession(){
	if (!isset($_SESSION['user'])) {
		if ($_SESSION['is_tab_user'] || $_SESSION['is_cell_login']) {
			header('location:'.site_URL.'/tab_logout.php');
		} else {
			header('location:'.site_URL.'/logout.php');
		}
	}

//Set the session duration for 10800 seconds - 3 hours
	$duration = auto_logout_duration;
//Read the request time of the user
	$time = $_SERVER['REQUEST_TIME'];
//Check the user's session exist or not
	if (isset($_SESSION['LAST_ACTIVITY']) && ($time - $_SESSION['LAST_ACTIVITY']) > $duration) {
		//Unset the session variables
		session_unset();
		//Destroy the session
		session_destroy();
		if ($_SESSION['is_tab_user'] || $_SESSION['is_cell_login']) {
			header('location:'.site_URL.'/tab_logout.php');
		} else {
			header('location:'.site_URL.'/logout.php');
		}
		exit;
	}
//Set the time of the user's last activity
	$_SESSION['LAST_ACTIVITY'] = $time;

//	$i = $_SESSION["role_id"];
//	if ($i != "super" && $i != "admin") {
//		header('location: ../dashboard.php');
//	}
}

?>