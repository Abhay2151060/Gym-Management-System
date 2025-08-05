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
    $email = sanitizeInput($_POST['email']);
    $address = sanitizeInput($_POST['address']);
    $city = sanitizeInput($_POST['city']);
    $zip = sanitizeInput($_POST['zip']);
    $cardholder_name = sanitizeInput($_POST['cardholder_name']);
    $card_number = sanitizeInput($_POST['card_number']);
    $expiry_month = sanitizeInput($_POST['expirymonth']);
    $expiry_year = sanitizeInput($_POST['expiryyear']);
    $cvv = sanitizeInput($_POST['cvv']);

    // Prepare SQL statement
    $sql = "INSERT INTO payment_info (duration, amount, full_name, email, address, city, zip, cardholder_name, card_number, expiry_month, expiry_year, cvv)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $mysqli->prepare($sql)) {
        $stmt->bind_param("sdssssssssss", $duration, $amount, $full_name, $email, $address, $city, $zip, $cardholder_name, $card_number, $expiry_month, $expiry_year, $cvv);

        if ($stmt->execute()) {
            // HTML content for the PDF
            $bill_content = "
            <style>
                body { font-family: Arial, sans-serif; color: black; }
                .highlight { color: #ff7101; }
                .container { padding: 20px; }
                .bill-table { width: 100%; border-collapse: collapse; }
                .bill-table th, .bill-table td { border: 1px solid #dddd; padding: 8px; }
                .bill-table th { background-color: #ff7101; color: white; }
                .total-row { font-weight: bold; }
                .logo {
                    display: flex;
                    align-items: center;
                    font-size: 2rem;
                    color: #e2e2e2;
                    text-transform: uppercase;
                }
                .logo i {
                    transform: rotate(45deg);
                    font-size: 2rem;
                    color: #ff7101;                   
                }
                .logo span {
                    font-weight: 200;
                    color: #ff7101;
                    margin-left: 5px;
                }
            </style>
            <div class='container'>
                <center>
                <div class='logo'>
                <i class='bx bx-dumbbell'></i>muscle <span>hustle</span>
                </div>
                </center><br>
                <p><strong>Date:</strong> " . date('d-m-Y') . "</p>
                <p><strong>Customer Name:</strong> $full_name</p>
                <p><strong>Contact:</strong> $email</p>
                <table class='bill-table'>
                    <tr>
                        <th>Description</th>
                        <th>Amount</th>
                    </tr>
                    <tr>
                        <td>Membership Duration: $duration</td>
                        <td>₹$amount</td>
                    </tr>
                    <tr class='total-row'>
                        <td>Total Amount</td>
                        <td>₹$amount</td>
                    </tr>
                </table>
                <center>
                <p><strong>Payment Status:</strong> <span style='color: green;''>Successful</span></p>
                <p>Thank you for choosing our gym!</p>
                <p>Contact us: email@example.com | (123) 456-7890</p>
                <p>Address: 123 Gym Street, Fitness City</p>
                </center>
            </div>";

            echo '<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Payment Success</title>
                <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
                <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
            </head>
            <body>
                <div id="bill-content" style="display:none;">
                    ' . $bill_content . '
                </div>
                <script>
                    alert("Payment details have been saved successfully.");
                    const element = document.getElementById("bill-content");
                    const opt = {
                        margin: 1,
                        filename: "payment_details.pdf",
                        image: { type: "jpeg", quality: 0.98 },
                        html2canvas: { scale: 2 },
                        jsPDF: { unit: "in", format: "letter", orientation: "portrait" }
                    };
                    // Make the content visible temporarily
                    element.style.display = "block";
                    html2pdf().from(element).set(opt).save().then(() => {
                        element.style.display = "none";
                        {
                            window.location.href = "membership.html";
                        };
                    });
                </script>
            </body>
            </html>';
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
