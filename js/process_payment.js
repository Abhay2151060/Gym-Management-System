document.querySelector(".payment-form").addEventListener("submit", function(event) {
    // Validate credit/debit card number length
    const cardNumber = document.getElementById("credit_debit_card_number").value;
    if (cardNumber.length !== 16) {
        alert("Please enter a valid 16-digit card number.");
        event.preventDefault(); // Prevent form submission
        return false;
    }
    // Additional custom validation for expiration month/year, CVV, etc.
    return true;
});


document.addEventListener('DOMContentLoaded', function() {
    const expMonthInput = document.getElementById('exp_month');

    // Add an event listener for form submission
    const form = document.querySelector('form.payment-form');
    form.addEventListener('submit', function(event) {
        const enteredMonth = parseInt(expMonthInput.value, 10);

        // Check if entered month is between 1 and 12
        if (isNaN(enteredMonth) || enteredMonth < 1 || enteredMonth > 12) {
            alert('Please enter a valid expiration month between 1 and 12.');
            event.preventDefault(); // Prevent form submission
        }
    });
});