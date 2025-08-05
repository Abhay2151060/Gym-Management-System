<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/staff.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Management System</title>
    <link rel="stylesheet" href="../css/staff.css">
</head>

<body>
    <?php $page = 'staff';
    include 'sidebar.php' ?>

</body>
</head>
</html>


<?php

//the isset function to check username is already loged in and stored on the session
if(!isset($_SESSION['user_id'])){
//header('location:../dstaff.php');	
}

if(isset($_GET['id'])){
$id=$_GET['id'];
$host="localhost";
$dbusername="root";
$dbpassword="";
$dbname="Mustle_Hustle";
$con=new mysqli($host,$dbusername,$dbpassword,$dbname);


$qry="delete from staff where user_id=$id";
$result=mysqli_query($con,$qry);

if($result){
    echo"DELETED";
    //header('Location:../dstaff.php');
    echo "<h3>...............DELETED SUCCESSFULLY GO BACK TO <a href='dstaff.php'>STAFF DETAILS</a></h3>";
}else{
    echo"ERROR!!";
}
}
?>