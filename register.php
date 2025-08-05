<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym Management System</title>
    <link rel="stylesheet" href="css/payment.css">
    <link rel="stylesheet" href="css/details.css">
</head>

<body>
    <?php $page = 'payment';
    include 'sidebar.php' ?>
    <section class="pay-section" id="pay-section">
        <div class="pay-content">
            <h1>Register Details</h1>
            <form id="search" role="search" method="POST" action="register.php">
                <label class="search">
                    <input type="text" type="submit" name="search" placeholder="Search here..." required />
                    <i class='bx bx-search' type='submit'></i>
                </label>
            </form>
            <a href="register.php" class="back">BACK</a>
        </div>
        <?php
        $conn = mysqli_connect("localhost", "root", "", "Mustle_Hustle");

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        if (isset($_GET['search'])) {
            $filterValue = $_GET['search'];

            // Prevent SQL injection using mysqli_real_escape_string
            $filterValue = mysqli_real_escape_string($conn, $filterValue);

            // Construct the SQL query to search for matching records
            $query = "SELECT * FROM payment 
              WHERE full_name LIKE '%$filterValue%' 
              OR email LIKE '%$filterValue%' 
              OR address LIKE '%$filterValue%' 
              OR city LIKE '%$filterValue%' 
              OR state LIKE '%$filterValue%' 
              OR zip_code LIKE '%$filterValue%' 
              OR membership LIKE '%$filterValue%'";

            // Execute the query
            $result = mysqli_query($conn, $query);

            // Check if any rows are returned
            if (mysqli_num_rows($result) > 0) {
                echo "<table class='content-table'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Full Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>City</th>
                        <th>State</th>
                        <th>ZIP Code</th>
                        <th>Membership</th>
                    </tr>
                </thead>
                <tbody>";

                // Output data of each row
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['full_name'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td>" . $row['address'] . "</td>
                    <td>" . $row['city'] . "</td>
                    <td>" . $row['state'] . "</td>
                    <td>" . $row['zip_code'] . "</td>
                    <td>" . $row['membership'] . "</td>
                  </tr>";
                }

                echo "</tbody></table>";
            } else {
                echo "No results found";
            }
        }

        // Close the database connection
        mysqli_close($conn);
        ?>

        <div class='mem-content'>

            <?php
            // Establish connection to the database
            $conn = new mysqli("localhost", "root", "", "Mustle_Hustle");

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // SQL query to select data from the payment table
            $qry = "SELECT * FROM payment_info";
            $result = $conn->query($qry);

            // Start table HTML
            echo "<table class='content-table'>
        <thead>
          <tr>
            <th>Id</th>
            <th>duration</th>
            <th>amount</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>City</th>
            <th>Zip Code</th>
            <th>cardholder_name</th>
            <th>card_number</th>
            <th>Exp. Month</th>
            <th>Exp. Year</th>
            <th>CVV</th>
          </tr>
        </thead>
        <tbody>";

            // Check if there are rows in the result set
            if ($result->num_rows > 0) {
                $cnt = 1;
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                <td><div class='text-center'>" . $cnt . "</div></td>
                <td><div class='text-center'>" . $row['duration'] . "</div></td>
                <td><div class='text-center'>" . $row['amount'] . "</div></td>
                <td><div class='text-center'>" . $row['full_name'] . "</div></td>
                <td><div class='text-center'>" . $row['email'] . "</div></td>
                <td><div class='text-center'>" . $row['address'] . "</div></td>
                <td><div class='text-center'>" . $row['city'] . "</div></td>
                <td><div class='text-center'>" . $row['zip'] . "</div></td>
                <td><div class='text-center'>" . $row['cardholder_name'] . "</div></td>
                <td><div class='text-center'>" . $row['card_number'] . "</div></td>
                <td><div class='text-center'>" . $row['expiry_month'] . "</div></td>
                <td><div class='text-center'>" . $row['expiry_year'] . "</div></td>
                <td><div class='text-center'>" . $row['cvv'] . "</div></td>
              </tr>";
                    $cnt++;
                }
            } else {
                echo "<tr><td colspan='12'>No records found</td></tr>";
            }

            // Close table HTML
            echo "</tbody></table>";

            // Close connection
            $conn->close();
            ?>


            </table>
        </div>
        </div>
    </section>

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