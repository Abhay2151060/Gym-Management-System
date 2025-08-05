<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Management System</title>
    <link rel="stylesheet" href="css/equipment.css">
</head>

<body>
<?php $page = 'equipment';include 'sidebar.php' ?>
    <div class="main">
        
        <form action="equipment.php" method="post" role="form">
        <h1>EQUIPMENT ENTRY FORM</h1>
            <div class="row">
                <div class="col">
                    <h4>Equipment-Details</h4>
                    <div class="input-box">
                        <label class="control-label">Equipment:</label>
                        <input type="text" name="fullname" placeholder="Equipment Name" required/>
                    </div>
                    <div class="input-box">
                        <label class="control-label">Description:</label>
                        <input type="text" name="description" placeholder="Short Description" required/>
                    </div>
                
                    <div class="input-box">
                        <label class="control-label">Date of purchase :</label>
                        <input type="date" name="dop" required/>
                        <span>Please mention date of registration </span>
                    </div>

                    <div class="input-box">
                        <label class="control-label">Quantity:</label>
                        <input type="number" name="quantity" placeholder="Equipment Quantity" required/>
                    </div>
                </div>
                <div class="cols">
                    <h4>Vendor Details</h4>
                    <div class="input-box">
                        <label class="control-label">Vendor :</label>
                        <input type="text" name="vendor" placeholder="Vendor" required/>
                    </div>
                    <div class="input-box">
                        <label class="control-label">Contact Number</label>
                        <input type="number" id="mask-phone" name="contact" placeholder="9876543210" required/>
                        <span>(999) 999-9999</span>
                    </div>
                    <div class="input-box">
                        <label class="control-label">Address :</label>
                        <input type="text" name="address" placeholder="Address"  required/>
                    </div>

                    <div class="input-box">
                        <label class="control-label">Cost Per Item:</label>
                        <input type="number" name="cost" placeholder="Cost Per Items" required/>
                    </div>
                   
                </div>
            </div>
            <div>
                <button type="submit" class="button" style="--clr:orange">Submit Equipment Details<i class='bx bx-save'></i></button>
            </div>
        </form>
        <?php
        if(isset($_POST['fullname']))
        {
            $fullname=$_POST["fullname"];
            $description=$_POST["description"];
            $dop=$_POST["dop"];
            $quantity=$_POST["quantity"];
            $vendor=$_POST["vendor"];
            $contact=$_POST["contact"];
            $address=$_POST["address"];
            $cost=$_POST["cost"];

            
            $host="localhost";
            $dbusername="root";
            $dbpassword="";
            $dbname="Mustle_Hustle";
         
            $conn=new mysqli($host,$dbusername,$dbpassword,$dbname);
            if(mysqli_connect_error())
            {
                die('connect error('.mysqli_connect_errno().')'.mysqli_connect_error());
            }
            else{
                $sql="INSERT INTO equipment (fullname,description,dop,quantity,vendor,contact,address,cost) values('$fullname','$description','$dop','$quantity','$vendor','$contact','$address','$cost')";
                if ($conn->query($sql)) {
                    // echo"New record is inserted Sucessfully";
                    // header('Location:../dstaff.php');
                    // header('location:staff.php');
                } else {
                        echo "Error : " .$sql . "<br>" .$conn->error;
                }
                    $conn->close();
            }
        }
        ?>
    </div>
    <script type="text/javascript">
  // This function is called from the pop-up menus to transfer to
  // a different page. Ignore if the value returned is a null string:
  function goPage (newURL) {

      // if url is empty, skip the menu dividers and reset the menu selection to default
      if (newURL != "") {
      
          // if url is "-", it is this page -- reset the menu:
          if (newURL == "-" ) {
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