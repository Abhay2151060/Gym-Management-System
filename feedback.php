<?php

$con = mysqli_connect('localhost:3306', 'root', '', 'Mustle_Hustle');

$name = $_POST['name'];
$email = $_POST['email'];
$feedback = $_POST['feedback'];

$que = "INSERT INTO `feedback` (`id`,`name`,`email`,`feedback`) VALUES (0,'$name','$email','$feedback')";

$result = mysqli_query($con, $que);

if (isset($_POST['submit'])) {
    header('location:feedback.html');
}
