<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FleetLink</title>
  <style>
    body { background-color: white; margin: 0; padding: 0; font-family: sans-serif; }
    .container {
      display: grid;
      grid-template-rows: 1fr;
      place-items: center;
      min-height: 500px;
      margin: 0;
      padding: 0;
    }
    .logo {
      max-width: 50%;
      height: auto;
      max-height: 50%;
      animation: fade-in 1s ease-in-out; /* Fade-in animation */
    }
    @keyframes fade-in {
      from { opacity: 0; }
      to { opacity: 1; }
      animation-timing-function: steps(1, end); /* Trigger animation end event */
    }

    /* Login form styles */
    .login-container {
      /* Styles for login form (as provided in login.blade.php) */
    }
  </style>
</head>
<body>
  <div class="container">
    <img src="{{ asset('image/FleetLink_Logo.png') }}" alt="Your Logo" class="logo">
  </div>

  <div class="login-container" style="display: none;">
    </div>

  <script>

const logo = document.querySelector('.logo');
const loginContainer = document.querySelector('.login-container');

logo.addEventListener('animationend', function() {
  setTimeout(function() {
    loginContainer.style.display = 'block'; // Show login form after animation
    window.location.href = '/login'; // Redirect to login page
  }, 1000);
});

  </script>
</body>
</html>
