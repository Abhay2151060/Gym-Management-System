<?php
// payment_gateway.php

// Check if the form was submitted
$duration = isset($_POST['duration']) ? htmlspecialchars($_POST['duration']) : 'N/A';
$amount = isset($_POST['amount']) ? htmlspecialchars($_POST['amount']) : 'N/A';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Gateway</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #ff7101, #ff4e50);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            color: #fff;
        }

        .container {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            width: 100%;
            color: #333;
        }

        .step-indicator {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .step {
            flex: 1;
            padding: 10px;
            background: #ddd;
            color: #333;
            text-align: center;
            border-radius: 5px;
            margin: 0 5px;
        }

        .step.active {
            background: #ff7101;
            color: #fff;
        }

        .form-content {
            display: none;
        }

        .form-content.active {
            display: block;
        }

        .container h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #ff7101;
        }

        .container p {
            font-size: 18px;
            margin-bottom: 20px;
        }

        .container .form-group {
            margin-bottom: 20px;
        }

        .container .form-group input,
        .container .form-group select {
            width: calc(100% - 20px);
            padding: 10px;
            margin: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .container .form-group label {
            display: block;
            font-size: 16px;
            margin-bottom: 5px;
            color: #333;
        }

        .container .expiry-date {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .container .expiry-date select {
            width: calc(50% - 10px);
        }

        .container .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #ff7101;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
            transition: background-color 0.3s ease;
            cursor: pointer;
        }

        .container .button:hover {
            background-color: #ff4e50;
        }

        .container .button-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="step-indicator">
            <div class="step active" id="stepIndicator1">Step 1</div>
            <div class="step" id="stepIndicator2">Step 2</div>
            <div class="step" id="stepIndicator3">Step 3</div>
        </div>

        <div class="form-content active" id="step1">
            <h1>Step 1: Confirmation</h1>
            <p><strong>Duration:</strong> <?php echo $duration; ?></p>
            <p><strong>Amount:</strong> ₹<?php echo $amount; ?></p>
            <div class="button-container">
                <button class="button" id="cancelButton"><i class="fas fa-chevron-left"></i> Back</button>
                <button class="button" id="next1Button">Next <i class="fas fa-chevron-right"></i></button>
            </div>
        </div>

        <div class="form-content" id="step2">
            <h1>Step 2: Billing Address</h1>
            <p><strong>Duration:</strong> <?php echo $duration; ?></p>
            <p><strong>Amount:</strong> ₹<?php echo $amount; ?></p>
            <div class="form-group">
                <label for="full_name">Full Name</label>
                <input type="text" id="full_name" name="full_name" required>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="form-group">
                <label for="city">City</label>
                <input type="text" id="city" name="city" required>
            </div>
            <div class="form-group">
                <label for="zip">ZIP Code</label>
                <input type="text" id="zip" name="zip" required maxlength="10">
            </div>
            <div class="button-container">
                <button class="button" id="prev2Button"><i class="fas fa-chevron-left"></i> Back</button>
                <button class="button" id="next2Button">Next <i class="fas fa-chevron-right"></i></button>
            </div>
        </div>

        <div class="form-content" id="step3">
            <h1>Step 3: Payment</h1>
            <p><strong>Duration:</strong> <?php echo $duration; ?></p>
            <p><strong>Amount:</strong> ₹<?php echo $amount; ?></p>
            <div class="form-group">
                <label for="cardholder_name">Card Holder Name</label>
                <input type="text" id="cardholder_name" name="cardholder_name" required>
            </div>
            <div class="form-group">
                <label for="card_number">Card Number</label>
                <input type="text" id="card_number" name="card_number" placeholder="xxx xxxx xxxx xxxx" required maxlength="19">
            </div>
            <div class="form-group">
                <label for="expiry">Expiry Date</label>
                <div class="expiry-date">
                    <select id="expirymonth" name="expirymonth" required>
                        <?php
                        echo '<option value="">Month</option>';
                        for ($i = 1; $i <= 12; $i++) {
                            $month = str_pad($i, 2, '0', STR_PAD_LEFT);
                            echo "<option value=\"$month\">$month</option>";
                        }
                        ?>
                    </select>
                    <select id="expiryyear" name="expiryyear" required>
                        <?php
                        $current_year = date('Y');
                        echo '<option value="">Year</option>';
                        for ($i = 0; $i < 10; $i++) {
                            $year = $current_year + $i;
                            $short_year = substr($year, -2);
                            echo "<option value=\"$short_year\">$short_year</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" placeholder="123" required maxlength="4">
            </div>
            <div class="button-container">
                <button class="button" id="prev3Button"><i class="fas fa-chevron-left"></i> Back</button>
                <button class="button" id="payButton"><i class="fas fa-credit-card"></i> Pay</button>
            </div>
        </div>
    </div>

    <script>
        // Card number formatting function
        function formatCardNumber(value) {
            return value.replace(/\D/g, '').replace(/(\d{4})(?=\d)/g, '$1 ');
        }

        // Apply formatting to card number input
        document.getElementById('card_number').addEventListener('input', function(e) {
            e.target.value = formatCardNumber(e.target.value);
        });

        // Function to validate Step 2
        function validateStep2() {
            var fullName = document.getElementById('full_name').value.trim();
            var address = document.getElementById('address').value.trim();
            var city = document.getElementById('city').value.trim();
            var zip = document.getElementById('zip').value.trim();

            if (fullName === '' || address === '' || city === '' || zip === '') {
                alert('Please fill in all fields in Step 2.');
                return false;
            }
            return true;
        }

        // Function to validate Step 3
        function validateStep3() {
            var cardHolderName = document.getElementById('cardholder_name').value.trim();
            var cardNumber = document.getElementById('card_number').value.trim();
            var expiryMonth = document.getElementById('expirymonth').value;
            var expiryYear = document.getElementById('expiryyear').value;
            var cvv = document.getElementById('cvv').value.trim();

            if (cardHolderName === '' || cardNumber === '' || expiryMonth === '' || expiryYear === '' || cvv === '') {
                alert('Please fill in all fields in Step 3.');
                return false;
            }
            return true;
        }

        // Navigation handling
        document.getElementById('next1Button').addEventListener('click', function() {
            document.getElementById('step1').classList.remove('active');
            document.getElementById('step2').classList.add('active');
            document.getElementById('stepIndicator1').classList.remove('active');
            document.getElementById('stepIndicator2').classList.add('active');
        });

        document.getElementById('prev2Button').addEventListener('click', function() {
            document.getElementById('step2').classList.remove('active');
            document.getElementById('step1').classList.add('active');
            document.getElementById('stepIndicator2').classList.remove('active');
            document.getElementById('stepIndicator1').classList.add('active');
        });

        document.getElementById('next2Button').addEventListener('click', function() {
            if (validateStep2()) {
                document.getElementById('step2').classList.remove('active');
                document.getElementById('step3').classList.add('active');
                document.getElementById('stepIndicator2').classList.remove('active');
                document.getElementById('stepIndicator3').classList.add('active');
            }
        });

        document.getElementById('prev3Button').addEventListener('click', function() {
            document.getElementById('step3').classList.remove('active');
            document.getElementById('step2').classList.add('active');
            document.getElementById('stepIndicator3').classList.remove('active');
            document.getElementById('stepIndicator2').classList.add('active');
        });

        document.getElementById('payButton').addEventListener('click', function() {
            if (validateStep3()) {
                alert("Payment successful!");
                {
                    window.location.href = 'membership.html'; // Redirect to your membership page or another page
                }
            }
        });

        document.getElementById('cancelButton').addEventListener('click', function() {
            if (confirm("Do you want to cancel the process?")) {
                window.location.href = 'membership.html'; // Redirect to your membership page or another page
            }
        });
    </script>
</body>

</html>