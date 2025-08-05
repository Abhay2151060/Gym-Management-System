<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f8f8;
        }

        .message-container {
            text-align: center;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .message-container h1 {
            color: #4CAF50;
        }

        .message-container p {
            font-size: 16px;
        }
    </style>
</head>

<body>
    <div class="message-container">
        <h1>Payment Successful!</h1>
        <p>Thank you for your payment. A receipt has been generated and downloaded.</p>
    </div>
</body>

</html>



<?php
// Include the database connection file
require_once 'db_connect.php';

// Function to sanitize input data
function sanitizeInput($data)
{
    return htmlspecialchars(stripslashes(trim($data)));
}

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve and sanitize form data
    $duration = sanitizeInput($_POST['duration']);
    $amount = sanitizeInput($_POST['amount']);
    $full_name = sanitizeInput($_POST['full_name']);
    $address = sanitizeInput($_POST['address']);
    $city = sanitizeInput($_POST['city']);
    $zip = sanitizeInput($_POST['zip']);
    $cardholder_name = sanitizeInput($_POST['cardholder_name']);
    $card_number = sanitizeInput($_POST['card_number']);
    $expiry_month = sanitizeInput($_POST['expirymonth']);
    $expiry_year = sanitizeInput($_POST['expiryyear']);
    $cvv = sanitizeInput($_POST['cvv']);

    // Prepare SQL statement
    $sql = "INSERT INTO payment_info (duration, amount, full_name, address, city, zip, cardholder_name, card_number, expiry_month, expiry_year, cvv)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("sdsssssssss", $duration, $amount, $full_name, $address, $city, $zip, $cardholder_name, $card_number, $expiry_month, $expiry_year, $cvv);

        if ($stmt->execute()) {
            echo '<script>
                alert("Payment details have been saved successfully.");
                window.location.href = "membership.html";
            </script>';
        } else {
            echo '<script>
                alert("Error: Could not execute the query: ' . $stmt->error . '");
                window.location.href = "membership.html";
            </script>';
        }

        $stmt->close();
    } else {
        echo '<script>
            alert("Error: Could not prepare the query: ' . $mysqli->error . '");
            window.location.href = "membership.html";
        </script>';
    }

    $mysqli->close();
} else {
    echo '<script>
        alert("Invalid request method.");
        window.location.href = "membership.html";
    </script>';
}