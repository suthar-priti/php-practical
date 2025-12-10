<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form id="myForm" action="process.php" method="POST" onsubmit="return validateForm()">
    <label>Name:</label>
    <input type="text" id="name" name="name">

    <label>Email:</label>
    <input type="text" id="email" name="email">

    <label>Password:</label>
    <input type="password" id="password" name="password">

    <button type="submit">Submit</button>
</form>

<p id="error" style="color:red;"></p>

    <script>
function validateForm() {
    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value.trim();
    const error = document.getElementById("error");

    // Clear previous error
    error.innerHTML = "";

    if (name === "") {
        error.innerHTML = "Name is required";
        return false;
    }

    // email validation
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
        error.innerHTML = "Enter a valid email";
        return false;
    }

    if (password.length < 6) {
        error.innerHTML = "Password must be at least 6 characters";
        return false;
    }

    return true;  // If everything is correct, form will submit to PHP
}
</script>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($name)) {
        die("Name is required");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email");
    }

    if (strlen($password) < 6) {
        die("Password too short");
    }

    echo "Form submitted successfully!";
}
?>


</body>
</html>