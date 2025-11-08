<?php
include 'db.php';

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$city = $_POST['city'];
$password = $_POST['pass'];

$sql = "INSERT INTO test (name, email, phone, city, password)
        VALUES ('$name', '$email', '$phone', '$city', '$password')";

$result = mysqli_query($con, $sql);

if($result){
    echo " Data submitted successfully! <a href='index.php'>Go back</a>";
} else {
    echo " Query failed: " . mysqli_error($con);
}
?>
