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
    <link rel="stylesheet" href="css\pay_gate.css" />
</head>

<body>
    <form id="paymentForm" action="process_payment-3.php" method="post">
        <div class="container">
            <div class="progress-container">
                <div class="progress-bar">
                    <span id="progressBar" style="width: 33%;"></span>
                </div>
                <div class="progress-indicator">
                    <div class="step-indicator active">1</div>
                    <div class="step-indicator">2</div>
                    <div class="step-indicator">3</div>
                </div>
            </div>

            <div class="form-content active" id="step1">
                <h1>Step 1: Confirmation</h1>
                <p><strong>Duration:</strong> <?php echo $duration; ?></p>
                <p><strong>Amount:</strong> ₹<?php echo $amount; ?></p>
                <input type="hidden" name="duration" value="<?php echo $duration; ?>">
                <input type="hidden" name="amount" value="<?php echo $amount; ?>">
                <div class="button-container">
                    <button class="button" id="cancelButton"><i class="fas fa-chevron-left"></i> Back</button>
                    <button class="button" id="next1Button" type="button">Next <i class="fas fa-chevron-right"></i></button>
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
                    <button class="button" id="prev2Button" type="button"><i class="fas fa-chevron-left"></i> Back</button>
                    <button class="button" id="next2Button" type="button">Next <i class="fas fa-chevron-right"></i></button>
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
                    <button class="button" id="prev3Button" type="button"><i class="fas fa-chevron-left"></i> Back</button>
                    <button class="button" id="payButton" type="submit"><i class="fas fa-credit-card"></i> Pay</button>
                </div>
            </div>
        </div>
    </form>


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

        // Function to update progress bar
        function updateProgress(step) {
            var progressBar = document.getElementById('progressBar');
            var stepIndicators = document.querySelectorAll('.progress-indicator .step-indicator');

            switch (step) {
                case 1:
                    progressBar.style.width = '33%';
                    break;
                case 2:
                    progressBar.style.width = '66%';
                    break;
                case 3:
                    progressBar.style.width = '100%';
                    break;
            }

            stepIndicators.forEach((indicator, index) => {
                if (index < step) {
                    indicator.classList.add('active');
                } else {
                    indicator.classList.remove('active');
                }
            });
        }

        // Navigation handling
        document.getElementById('next1Button').addEventListener('click', function() {
            document.getElementById('step1').classList.remove('active');
            document.getElementById('step2').classList.add('active');
            updateProgress(2);
        });

        document.getElementById('prev2Button').addEventListener('click', function() {
            document.getElementById('step2').classList.remove('active');
            document.getElementById('step1').classList.add('active');
            updateProgress(1);
        });

        document.getElementById('next2Button').addEventListener('click', function() {
            if (validateStep2()) {
                document.getElementById('step2').classList.remove('active');
                document.getElementById('step3').classList.add('active');
                updateProgress(3);
            }
        });

        document.getElementById('prev3Button').addEventListener('click', function() {
            document.getElementById('step3').classList.remove('active');
            document.getElementById('step2').classList.add('active');
            updateProgress(2);
        });

        document.getElementById('payButton').addEventListener('click', function() {
            if (validateStep3()) {
                alert("Payment successful!");
                window.location.href = 'membership.html'; // Redirect to your membership page or another page
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