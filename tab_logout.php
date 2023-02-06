<?php
session_start();
$line = $_SESSION['tab_station'] ;
$cell_id = $_SESSION['cell_id'];
if($_SESSION['is_cell_login']){
	$is_cell_login = null;
	unset($_SESSION['is_cell_login']);
	unset($_SESSION['cell_id']);
	unset($_SESSION['tab_station']);
	$redirect = 'Location: tab_login.php?c_id='.$cell_id;
	//// unset all $_SESSION variables
	session_regenerate_id();
	session_unset();
	session_destroy();

}else{
	$redirect = 'Location: tab_login.php?s_id='.$line.'&d_user=tab';
	//// unset all $_SESSION variables
	unset($_SESSION['is_cell_login']);
	unset($_SESSION['cell_id']);
	unset($_SESSION['tab_station']);
	session_regenerate_id();
	session_unset();
	session_destroy();

}
header($redirect);
?>