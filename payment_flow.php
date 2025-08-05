<?php
// Initialize variables
$duration = isset($_POST['duration']) ? $_POST['duration'] : (isset($_GET['duration']) ? $_GET['duration'] : 'N/A');
$amount = isset($_POST['amount']) ? $_POST['amount'] : (isset($_GET['amount']) ? $_GET['amount'] : 'N/A');
$step = isset($_POST['step']) ? $_POST['step'] : (isset($_GET['step']) ? $_GET['step'] : 'billing');

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($step === 'payment') {
        // Handle payment processing logic here
        // For example, you might want to store payment information in a database
        echo "Processing payment...";
        exit;
    } elseif ($step === 'billing') {
        // Move to the payment step
        $step = 'payment';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $step === 'billing' ? 'Billing Address' : 'Payment Gateway'; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/payment_flow.css" />
    <style>
        .hidden {
            display: none;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        .button-container {
            margin-top: 20px;
        }

        .button {
            padding: 10px 20px;
            background: #ff7101;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
        }
    </style>
</head>

<body>
    <div class="container" id="billing-section" style="<?php echo $step === 'billing' ? '' : 'display:none;'; ?>">
        <h1>Billing Address</h1>
        <p><strong>Duration:</strong> <?php echo htmlspecialchars($duration); ?></p>
        <p><strong>Amount:</strong> ₹<?php echo htmlspecialchars($amount); ?>/-</p>
        <form method="POST" action="payment_flow.php">
            <input type="hidden" name="step" value="payment">
            <div class="form-group">
                <input type="text" id="name" name="name" placeholder="Name" required>
            </div>
            <div class="form-group">
                <input type="text" id="address" name="address" placeholder="Address" required>
            </div>
            <div class="form-group">
                <input type="text" id="city" name="city" placeholder="City" required>
            </div>
            <div class="form-group">
                <input type="text" id="state" name="state" placeholder="State" required>
            </div>
            <div class="form-group">
                <input type="text" id="zip" name="zip" placeholder="Zip Code" pattern="\d{6}" title="Zip Code must be 6 digits" required>
            </div>
            <input type="hidden" name="duration" value="<?php echo htmlspecialchars($duration); ?>">
            <input type="hidden" name="amount" value="<?php echo htmlspecialchars($amount); ?>">
            <div class="button-container">
                <button type="submit" class="button">Proceed to Payment</button>
            </div>
        </form>
    </div>

    <div class="container hidden" id="payment-section" style="<?php echo $step === 'payment' ? '' : 'display:none;'; ?>">
        <div class="animation">
            <i class="fas fa-credit-card"></i>
        </div>
        <h1>Payment Gateway</h1>
        <p><strong>Duration:</strong> <?php echo htmlspecialchars($duration); ?></p>
        <p><strong>Amount:</strong> ₹<?php echo htmlspecialchars($amount); ?>/-</p>
        <form method="POST" action="payment_flow.php">
            <input type="hidden" name="step" value="payment">
            <input type="hidden" name="duration" value="<?php echo htmlspecialchars($duration); ?>">
            <input type="hidden" name="amount" value="<?php echo htmlspecialchars($amount); ?>">
            <div class="form-group">
                <input type="text" name="card_number" id="card_number" placeholder="Card Number" required minlength="19" maxlength="19">
            </div>

            <label for="expiry_date">Expiry Date</label>
            <div class="form-group expiry-date">
                <select name="expiry_month" id="expiry_month" required>
                    <option value="" disabled selected>MM</option>
                    <?php
                    for ($i = 1; $i <= 12; $i++) {
                        $month = str_pad($i, 2, '0', STR_PAD_LEFT);
                        echo "<option value=\"$month\">$month</option>";
                    }
                    ?>
                </select>
                <select name="expiry_year" id="expiry_year" required>
                    <option value="" disabled selected>YY</option>
                    <?php
                    $current_year = date('Y');
                    for ($i = 0; $i < 10; $i++) {
                        $year = $current_year + $i;
                        $short_year = substr($year, -2);
                        echo "<option value=\"$short_year\">$short_year</option>";
                    }
                    ?>
                </select>
            </div>
            <div class="form-group">
                <input type="text" name="cvv" placeholder="CVV" maxlength="3" title="CVV must be 3 digits" required>
            </div>
            <div class="form-group">
                <input type="text" name="cardholder_name" placeholder="Cardholder Name" required>
            </div>
            <div class="button-container">
                <button type="button" class="button" onclick="showBillingSection()">Back</button>
                <button type="submit" class="button">Submit Payment</button>
            </div>
        </form>
    </div>

    <script>
        function showBillingSection() {
            document.getElementById('billing-section').style.display = 'block';
            document.getElementById('payment-section').style.display = 'none';
        }

        function showPaymentSection() {
            document.getElementById('billing-section').style.display = 'none';
            document.getElementById('payment-section').style.display = 'block';
        }
    </script>
</body>

</html>