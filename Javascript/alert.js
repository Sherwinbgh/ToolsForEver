// Get the form element
const form = document.querySelector('form');

// Add a submit event listener to the form
form.addEventListener('submit', (event) => {
    // Get all the input fields
    const inputs = form.querySelectorAll('input');

    // Check if all the fields are filled
    const allFieldsFilled = Array.from(inputs).every((input) => input.value.trim() !== '');

    // Display a message in the console if all fields are filled
    if (allFieldsFilled) {
        console.log('Alles is gevuld.');
    } else {
        // Prevent the form from submitting if any field is empty
        event.preventDefault();
        // Display an alert to the user
        alert('Vul alles er in.');
    }
});