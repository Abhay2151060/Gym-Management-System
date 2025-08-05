<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/equipment.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Management System</title>
    <link rel="stylesheet" href="../css/equipment.css">
</head>

<body>
    <?php $page = 'equipment';
    include 'sidebar.php' ?>

    <?php

    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "Mustle_Hustle";
    @$id = $_GET['id'];
    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
    $qry = "select * from equipment where equip_id='$id'";
    $result = mysqli_query($conn, $qry);
    while ($row = mysqli_fetch_array($result)) {
    ?>
        <div class="main">

            <form action="update-equipment.php" method="post" role="form">
                <h1>UPDATE EQUIPMENT DETAILS</h1>
                <div class="row">
                    <div class="col">
                        <h4>Equipment-Details</h4>
                        <div class="input-box">
                            <label class="control-label">Full Name :</label>
                            <input type="text" name="fullname" placeholder="Equipment Name" value='<?php echo $row['fullname']; ?>' required />
                        </div>
                        <div class="input-box">
                            <label class="control-label">Description :</label>
                            <input type="text" class="input-box" name="description" value='<?php echo $row['description']; ?>' required />
                            <!-- <select name="gender" required="required" id="select">
                            <option value="Male" selected="selected">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select> -->
                        </div>

                        <div class="input-box">
                            <label class="control-label">Date of purchase :</label>
                            <input type="date" class="input-box" name="dop" value='<?php echo $row['dop']; ?>' required />
                            <!-- <select name="designation" required="required" id="select">
                            <option value="Cashier" selected="selected">Cashier</option>
                            <option value="Trainer">Trainer</option>
                            <option value="Cleaning">Cleaning</option>
                            <option value="Manager">Manager</option>
                        </select> -->
                        </div>

                        <div class="input-box">
                            <label class="control-label">Quantity :</label>
                            <input type="number" name="quantity" placeholder="Equipment Quantity" value='<?php echo $row['quantity']; ?>' required />
                        </div>
                    </div>
                    <div class="cols">
                        <h4>Vendor Details</h4>
                        <div class="input-box">
                            <label class="control-label">Vendor :</label>
                            <input type="text" name="vendor" placeholder="vendor" value='<?php echo $row['vendor']; ?>' required />
                        </div>
                        <div class="input-box">
                            <label class="control-label">Contact Number</label>
                            <input type="number" id="mask-phone" name="contact" placeholder="9876543210" value='<?php echo $row['contact']; ?>' required />
                            <span>(999) 999-9999</span>
                        </div>
                        <div class="input-box">
                            <label class="control-label">Address :</label>
                            <input type="text" name="address" placeholder="Address" value='<?php echo $row['address']; ?>' required />
                        </div>

                        <div class="input-box">
                            <label class="control-label">Cost Per Items :</label>
                            <input type="number" name="cost" placeholder="Cost Per Items" value='<?php echo $row['cost']; ?>' required />
                        </div>

                    </div>
                </div>
                <div>
                    <button type="submit" class="button" name="id" value="<?php echo $row['equip_id']; ?>" style="--clr:orange">Submit Staff Details<i class='bx bx-save'></i></button>
                </div>
            </form>
        </div>
    <?php
    }
    ?>
    <script type="text/javascript">
        // This function is called from the pop-up menus to transfer to
        // a different page. Ignore if the value returned is a null string:
        function goPage(newURL) {

            // if url is empty, skip the menu dividers and reset the menu selection to default
            if (newURL != "") {

                // if url is "-", it is this page -- reset the menu:
                if (newURL == "-") {
                    resetMenu();
                }
                // else, send page to designated URL            
                else {
                    document.location.href = newURL;
                }
            }
        }

        // resets the menu selection upon entry to this page:
        function resetMenu() {
            document.gomenu.selector.selectedIndex = 2;
        }
    </script>
</body>
</html>
<?php
if(!isset($_SESSION['equip_id'])){
// header('location:../member.php');	
}
?>

<?php 
        
            if(isset($_POST['fullname'])){
                $fullname = $_POST["fullname"];
                $description = $_POST["description"];
                $dop=$_POST["dop"];
                $quantity=$_POST["quantity"];
                $vendor=$_POST["vendor"];
                $contact=$_POST["contact"];
                $address=$_POST["address"];
                $cost=$_POST["cost"];
                $id = $_POST['id'];

                $host = "localhost";
                $dbusername = "root";
                $dbpassword = "";
                $dbname = "Mustle_Hustle";

         
            $con=new mysqli($host,$dbusername,$dbpassword,$dbname);
       
            $qry = "update equipment set fullname='$fullname',description='$description',dop='$dop',quantity='$quantity', vendor='$vendor',  contact='$contact', address='$address', cost='$cost' where equip_id='$id'";
            $result = mysqli_query($con,$qry); 

            if(!$result){
                echo"ERROR!!";
            }else {

                echo "<h3>...............UPDATED SUCCESSFULLY GO BACK TO <a href='dequipment.php'>EQUIPMENT DETAILS</a></h3>";

            }

            }
?>