<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FleetLink</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .header {
            background-color: lightblue;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            width: 97%;
            border-radius: 20px;

            margin-top: -170px; /* Stick to the top */
        }

        /* .logo {
            width: 50px;
            height: auto;
            margin-right: 10px;
        } */

        .header-button {
            background-color: blue;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            text-align: center;
            margin-top: 70px; /* Adjusted margin-top value to leave space for the fixed header */
        }

        button {
            background-color: blue;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            width: 100px;
        }

        button:hover {
            background-color: lightblue;
        }

        input,
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <div class="header">
    <img src="{{ asset('images/FleetLink_Logo.png') }}" alt="Logo" style="width: 100px; height: 50px;">
        <button class="header-button" onclick="alert('Header Button Clicked!')">Back</button>
    </div>
    <div class="container">
        <h2>Send SMS</h2>
        <form action="/send-sms" method="post">
            @csrf
            <label for="to">Recipient's Number:</label>
            <input type="text" name="to" required>
            <br>
            <label for="message">Message:</label>
            <textarea name="message" required></textarea>
            <br>
            <button type="submit">Send SMS</button>
        </form>
    </div>
</body>

</html>
