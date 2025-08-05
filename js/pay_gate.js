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

document.getElementById('cancelButton').addEventListener('click', function() {
    if (confirm("Do you want to cancel the process?")) {
        window.location.href = 'membership.html'; // Redirect to your membership page or another page
    }
});