<?php include ('../config.php');
$chicagotime = date('Y-m-d');
?>
<html>
<head>
    <title>form scheduler date from to date to</title>
</head>
<body>
<form method="post" action="form_item_scheduler_from_date_to_date.php" enctype="multipart/form-data">
    <label for="date_from">Date from :
    <input type="date" id="date_from" name="date_from" value="2022-01-01"> </label><br><br>
    <label for="date_to">Date to :
    <input type="date" id="date_to" name="date_to" value="<?php echo $chicagotime; ?>"></label><br><br>
    <input type="submit" value="Submit" style="background-color: #0a53be;">
</form>
</body>
</html>
