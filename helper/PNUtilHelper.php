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
?>