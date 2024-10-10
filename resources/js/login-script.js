document.getElementById('loginForm').addEventListener('submit', async function (event) {
    event.preventDefault(); // Prevent default form submission

    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const errorAlert = document.getElementById('error-alert');
    const loginButton = document.getElementById('loginButton');
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    // Clear previous error messages
    errorAlert.classList.add('hidden');
    errorAlert.innerHTML = '';

    // Disable the login button to prevent multiple submissions
    loginButton.disabled = true;
    loginButton.innerHTML = 'Logging in...';

    try {
        // Send the login request using Fetch API
        const response = await fetch('http://127.0.0.1:8001/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': token // Include the CSRF token in the headers
            },
            body: JSON.stringify({
                email: email,
                password: password
            })
        });

        const data = await response.json();

        if (response.ok) {
            // Save the token in sessionStorage
            sessionStorage.setItem('authToken', data.data.token);
            sessionStorage.setItem('adminId', data.data.admin_id);

            // Redirect to the dashboard
            window.location.href = 'http://127.0.0.1:8001/dashboard';
        } else {
            // If login failed, show an error message
            errorAlert.classList.remove('hidden');
            errorAlert.innerHTML = data.message || 'Login failed. Please try again.';
        }
    } catch (error) {
        // Handle any other errors (like network issues)
        errorAlert.classList.remove('hidden');
        errorAlert.innerHTML = 'An error occurred. Please try again later.';
    } finally {
        // Re-enable the button after the request is done
        loginButton.disabled = false;
        loginButton.innerHTML = 'Login';
    }
});
