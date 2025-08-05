<?php

$con = mysqli_connect('localhost:3306', 'root', '', 'Mustle_Hustle');

$firstname = $_POST['firstname'];
$email = $_POST['email'];
$phone = $_POST['pno'];
$query = $_POST['query'];


$sql = "INSERT INTO `ContactUs`(`id`,`firstname`,`email`,`pno`,`query`) VALUES (0,'$firstname','$email','$phone','$query')";
$result = mysqli_query($con, $sql);

if (isset($_POST['submit'])) {

    header('location:contact.html');
}
