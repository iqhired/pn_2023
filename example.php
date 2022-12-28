<?php
//export.php'
$pdo = server::connect();
include ('config.php');
$output = '';

$query = "SELECT * FROM 10x_images";
$stmt = $pdo->prepare($query);
//$stmt = mysqli_query($db,$query);
//Execute the statement.
$stmt->execute();
$clients= $stmt->fetchAll();

$output .= '
   <table class="table" bordered="1">  
    <tr>  
        <th>Ονοματεπώνυμο</th>
        <th>Σταθερό Τηλέφωνο</th>
        <th>Email</th>
        <th>Διεύθυνση</th>  

    </tr>
  ';
foreach($clients as $items):
    $output .= "
    <tr>
      <td>".$items['10x_images_id']."</td>
      <td>".$items['image_name']."</td>
      <td>".$items['10x_id']."</td>
      <td>".$items['created_at']."</td>

    </tr>
   ";
endforeach;
$output .= '</table>';
header('Content-Type: application/xls');
header('Default-Charset :   utf-8 ');
header('Content-Disposition: attachment; filename=download.xls');
echo $output;



?>