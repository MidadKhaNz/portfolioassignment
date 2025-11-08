<?php
include 'db.php';
header("Content-Type: application/json");

$sql = "SELECT * FROM test";
$res = mysqli_query($con, $sql);

$data = [];
while($row = mysqli_fetch_assoc($res)){
    $data[] = $row;
}

echo json_encode($data);
?>
