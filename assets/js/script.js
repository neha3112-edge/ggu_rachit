
     // JavaScript to handle accordion toggle
     document.querySelectorAll('.accordion-header').forEach(header => {
        header.addEventListener('click', () => {
            const content = header.nextElementSibling;
            const isOpen = content.style.display === 'block';

            // Close all open accordions
            document.querySelectorAll('.accordion-content').forEach(c => c.style.display = 'none');

            // Toggle the current accordion
            if (!isOpen) {
                content.style.display = 'block';
            }
        });
    });

  //End on scroll popup


  //start on form submittion double query issue 
  const form = document.getElementById('myForm');
  const submitButton = document.querySelector('.sub-btn');
  
  form.addEventListener('submit', function (event) {
      submitButton.disabled = true; 
      submitButton.textContent = 'Processing...'; 
  });



  //country flag 
  document.addEventListener("DOMContentLoaded", function () {
    const phoneInputs = document.querySelectorAll('input[type="tel"]');

    phoneInputs.forEach(input => {
        // Create an error message element
        const errorMessage = document.createElement("span");
        errorMessage.style.color = "red"; 
        errorMessage.style.display = "none";
        input.parentNode.insertBefore(errorMessage, input);

        const iti = window.intlTelInput(input, {
            initialCountry: "in", // Default country: India
            autoPlaceholder: "polite", // Show a placeholder for the format
            separateDialCode: true, // Display country code separately
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/utils.js", // Utilities for validation
        });

        // Validate phone number on input (real-time validation)
        input.addEventListener("input", function () {
            const phoneValue = input.value.trim();
            if (/[a-zA-Z]/.test(phoneValue)) {
                errorMessage.style.display = "block"; // Show error
                errorMessage.textContent = "Please enter a valid phone number (only numbers, no letters).";
                input.value = phoneValue.replace(/[a-zA-Z]/g, '');
            } else {
                errorMessage.style.display = "none";
            }
        });

        input.addEventListener("blur", function () {
            const phoneValue = input.value.trim();
            if (phoneValue) {
                if (!iti.isValidNumber()) {
                    errorMessage.style.display = "block"; // Show error
                    errorMessage.textContent = "Invalid phone number.";
                    input.value = '';
                    input.focus();
                } else {
                    errorMessage.style.display = "none"; // Hide error message if valid number
                    console.log("Valid Number:", iti.getNumber());
                }
            }
        });

        input.closest('form').addEventListener('submit', function (e) {
            const phoneValue = input.value.trim();
            if (!iti.isValidNumber() || /[a-zA-Z]/.test(phoneValue)) {
                e.preventDefault();
                alert("Please enter a valid phone number.");
                input.value = ''; 
                input.focus();
            } else {
                input.value = iti.getNumber();
            }
        });
    });
});