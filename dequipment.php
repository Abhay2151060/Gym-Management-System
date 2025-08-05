<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Management System</title>
    <link rel="stylesheet" href="css/details.css">
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <?php $page='dequipment'; include 'sidebar.php'?>
    <div class='mem-section'>
          <div class='mem-title'>
            <h2>Equipment Table</h2>
            <form id="search" role="search" method="POST" action="dequipment.php">
              <label class="search">
              <input type="text" type="submit" name="search" placeholder="Search here..." required/>
              <i class='bx bx-search' type='submit'></i>
              </label>
            </form>
            <a href="dequipment.php" class="back">BACK</a>
          </div>
          <div class='mem-content'>
	  
	  <?php
          $conn=mysqli_connect("localhost","root","","Mustle_Hustle");
          @$search=$_POST['search'];
          $qry="select * from equipment where fullname like '%$search%' or equip_id like '%$search%'";
          $cnt = 1;
          $result=mysqli_query($conn,$qry);

          if (mysqli_num_rows($result)==0){

              echo"<div class='error_ex'>
              <h1>403</h1>
              <h3>Opps, Results Not Found!!</h3>
              <p>It seems like there's no such record available in our database.</p>
              <a class='btn btn-danger btn-big'  href='dstaff.php'>Go Back</a> </div>'";
          }else{
    echo"<table class='content-table'>
              <thead>
                <tr>
                  <th>#</th>
                  <th>Equipment Name</th>
                  <th>Description</th>
                  <th>D.O.P</th>
                  <th>Quantity Id</th>
                  <th>Vendor</th>
                  <th>Contact</th>
                  <th>Address</th>
                  <th>Cost</th>
                  <th>Actions</th>
                  
                </tr>
              </thead>";

    while ($row=mysqli_fetch_array($result)) {
        echo"<tbody> 
               
                <td><div class='text-center'>".$cnt."</div></td>
                <td><div class='text-center'>".$row['fullname']."</div></td>               
                <td><div class='text-center'>".$row['description']."</div></td>
                <td><div class='text-center'>".$row['dop']."</div></td>
                <td><div class='text-center'>".$row['quantity']."</div></td>
                <td><div class='text-center'>".$row['vendor']."</div></td>                
                <td><div class='text-center'>".$row['contact']."</div></td>
                <td><div class='text-center'>".$row['address']."</div></td>
                <td><div class='text-center'>".$row['cost']."</div></td>
                <td><div class='text-center'><a href='update-equipment.php?id=".$row['equip_id']."'><i class='bx bxs-edit-alt' style='color:#28b779'></i> Edit |</a> <a href='delete-equipment.php?id=".$row['equip_id']."' style='color:#F66;'><i class='bx bxs-trash'></i> Remove</a></div></td>
              </tbody>";
        $cnt++;
    }
}
            ?>

            </table>
        </div>
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