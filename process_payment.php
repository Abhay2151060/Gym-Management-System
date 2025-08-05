<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Online Payment</title>
    <link rel="stylesheet" href="css\process_pay.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
    <!--link boxiconx file-->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
</head>

<body>
    <header>
        <div class="container">
            <?php
            // Establish database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "Mustle_Hustle";

            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Create payment table if not exists
                $table_creation_sql = "
                CREATE TABLE IF NOT EXISTS payment (
                id INT(11) AUTO_INCREMENT PRIMARY KEY,
                full_name VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                address VARCHAR(255) NOT NULL,
                city VARCHAR(100) NOT NULL,
                state VARCHAR(100) NOT NULL,
                zip_code VARCHAR(20) NOT NULL,
                membership DECIMAL(10,2) NOT NULL,
                credit_debit_card_number VARCHAR(16) NOT NULL,
                exp_month VARCHAR(2) NOT NULL,
                exp_year VARCHAR(4) NOT NULL,
                cvv VARCHAR(4) NOT NULL,
                transaction_date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP)";
                $conn->exec($table_creation_sql);

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Retrieve form data
                    $full_name = $_POST['full_name'];
                    $email = $_POST['email'];
                    $address = $_POST['address'];
                    $city = $_POST['city'];
                    $state = $_POST['state'];
                    $zip_code = $_POST['zip_code'];
                    $membership = $_POST['membership'];
                    $credit_debit_card_number = $_POST['credit_debit_card_number'];
                    $exp_month = $_POST['exp_month'];
                    $exp_year = $_POST['exp_year'];
                    $cvv = $_POST['cvv'];

                    // Prepare SQL statement to insert payment data
                    $insert_sql = "
                    INSERT INTO payment (full_name, email, address, city, state, zip_code, membership,credit_debit_card_number, exp_month, exp_year, cvv)
                    VALUES (:full_name, :email, :address, :city, :state, :zip_code, :membership, :credit_debit_card_number, :exp_month, :exp_year, :cvv)";

                    // Prepare and execute the SQL statement
                    $stmt = $conn->prepare($insert_sql);
                    $stmt->execute([
                        ':full_name' => $full_name,
                        ':email' => $email,
                        ':address' => $address,
                        ':city' => $city,
                        ':state' => $state,
                        ':zip_code' => $zip_code,
                        ':membership' => $membership,
                        ':credit_debit_card_number' => $credit_debit_card_number,
                        ':exp_month' => $exp_month,
                        ':exp_year' => $exp_year,
                        ':cvv' => $cvv
                    ]);

                    // Construct HTML content for PDF with CSS styling
                    $bill_content = "
                    <style>
                        body { color: black; } /* Set text color to black */
                        h1, p { margin: 0; } /* Remove default margins for consistent styling */
                        strong { font-weight: bold; } /* Ensure strong tags are bold */
                        span.highlight { color: #ff7101; } /* Define color for highlighted span */
                    </style>

                    <center><h1>Muscle <span class='highlight'>Hustle</span></h1> </center>
                    <h3>BILLING DETAILS</h3>
                    <br>
                    <p>Full Name: $full_name</p>
                    <p>Email: $email</p>
                    <p>Address: $address, $city, $state, $zip_code</p>
                    <p>Membership: RS.$membership/-</p>
                    <br>
                    <h3>PAYMENT DETAILS</h3>
                    <br>
                    <p>Payment Method: Credit/Debit Card</p>
                    <p>Card Number: " . str_repeat('*', strlen($credit_debit_card_number) - 4) . substr($credit_debit_card_number, -4) . "</p>
                    <p>Expiry Date: $exp_month/$exp_year</p>
                    <p>CVV: ***</p>
                    <p>Transaction Date: " . date('Y-m-d H:i:s') . "</p>";

                    // Provide alert and trigger PDF download
                    echo "<script>
                    alert('Payment successful! Your payment details have been saved.');
                    const opt = {
                        margin: 1,
                        filename: 'payment_details.pdf',
                        image: { type: 'jpeg', quality: 0.98 },
                        html2canvas: { scale: 2 },
                        jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
                    };
                    const content = `$bill_content`;
                    const element = document.createElement('div');
                    element.innerHTML = content;
                    html2pdf().from(element).set(opt).save();
                    setTimeout(() => {
                        window.location.href = 'index.html'; // Redirect after PDF download (optional delay)
                    }, 1000); // Adjust delay as needed
                    </script>";

                    exit;
                }
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
            ?>


            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" class="payment-form">
                <div class="form-section">
                    <h3>BILLING ADDRESS</h3>
                    <div class="input-group">
                        <label for="full_name">Username</label>
                        <input type="text" id="full_name" name="full_name" placeholder="Please enter username" required minlength="2" maxlength="50" />
                    </div>
                    <div class="input-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" placeholder="Enter email" required />
                    </div>
                    <div class="input-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" placeholder="Enter address" required />
                    </div>
                    <div class="input-group">
                        <label for="city">City</label>
                        <input type="text" id="city" name="city" placeholder="Enter city" required />
                    </div>
                    <div class="input-group">
                        <label for="state">State</label>
                        <select id="state" name="state" required>
                            <option value="">--Choose State--</option>
                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                            <option value="Assam">Assam</option>
                            <option value="Bihar">Bihar</option>
                            <option value="Chhattisgarh">Chhattisgarh</option>
                            <option value="Goa">Goa</option>
                            <option value="Gujarat">Gujarat</option>
                            <option value="Haryana">Haryana</option>
                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                            <option value="Jharkhand">Jharkhand</option>
                            <option value="Karnataka">Karnataka</option>
                            <option value="Kerala">Kerala</option>
                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                            <option value="Maharashtra">Maharashtra</option>
                            <option value="Manipur">Manipur</option>
                            <option value="Meghalaya">Meghalaya</option>
                            <option value="Mizoram">Mizoram</option>
                            <option value="Nagaland">Nagaland</option>
                            <option value="Odisha">Odisha</option>
                            <option value="Punjab">Punjab</option>
                            <option value="Rajasthan">Rajasthan</option>
                            <option value="Sikkim">Sikkim</option>
                            <option value="Tamil Nadu">Tamil Nadu</option>
                            <option value="Telangana">Telangana</option>
                            <option value="Tripura">Tripura</option>
                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                            <option value="Uttarakhand">Uttarakhand</option>
                            <option value="West Bengal">West Bengal</option>
                            <!-- Add more states as needed -->
                        </select>
                    </div>
                    <div class="input-group">
                        <label for="zip_code">Zip Code</label>
                        <input type="number" id="zip_code" name="zip_code" placeholder="Zip code" required minlength="5" maxlength="5" />
                    </div>
                    <div class="input-group">
                        <label for="membership">Membership</label>
                        <select id="membership" name="membership" required>
                            <option value="">--Choose Membership--</option>
                            <option value="10000">12 months (RS.10,000/-)</option>
                            <option value="7000">6 months (RS.7,000/-)</option>
                            <option value="3000">3 months (RS.3,000/-)</option>
                            <option value="1500">1 month (RS.1,500/-)</option>


                            <!-- Add your membership options here -->
                        </select>
                    </div>
                </div>

                <div class="form-section">
                    <h3>PAYMENT</h3>
                    <div class="input-group">
                        <label for="credit_debit_card_number">Credit/Debit Card Number</label>
                        <input type="text" id="credit_debit_card_number" name="credit_debit_card_number" placeholder="Enter card number" required minlength="16" maxlength="16" />
                    </div>
                    <div class="input-group">
                        <label for="exp_month">Exp Month</label>
                        <input type="text" id="exp_month" name="exp_month" placeholder="MM" maxlength="2" required />
                    </div>
                    <div class="input-group">
                        <label for="exp_year">Exp Year</label>
                        <select id="exp_year" name="exp_year" required>
                            <option value="">--Choose Year--</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                            <option value="2026">2026</option>
                            <option value="2027">2027</option>
                            <option value="2028">2028</option>
                            <option value="2029">2029</option>
                            <option value="2030">2030</option>
                            <option value="2031">2031</option>
                            <option value="2032">2032</option>
                            <option value="2033">2033</option>
                            <option value="2034">2034</option>
                            <option value="2035">2035</option>
                            <option value="2036">2036</option>
                            <option value="2036">2037</option>
                            <option value="2036">2038</option>
                            <option value="2036">2039</option>
                            <option value="2036">2040</option>
                            <!-- Add more years as needed -->
                        </select>
                    </div>
                    <div class="input-group">
                        <label for="cvv">CVV</label>
                        <input type="text" id="cvv" name="cvv" placeholder="CVV" required minlength="3" maxlength="3" />
                    </div>
                    <center>
                        <input type="submit" name="submit" value="Proceed to Checkout" />
                    </center>
                </div>
            </form>
        </div>
    </header>
    <!--link js file-->
    <script src="js\process_payment.js"></script>
</body>

</html>