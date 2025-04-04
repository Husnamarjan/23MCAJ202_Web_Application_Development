<?php
$name = $email = $password = $confirm_password = "";
$name_err = $email_err = $password_err = $confirm_password_err = "";
$success_message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter your name.";
    } elseif (!preg_match("/^[a-zA-Z ]*$/", $_POST["name"])) {
        $name_err = "Only letters and spaces allowed.";
    } else {
        $name = htmlspecialchars(trim($_POST["name"]));
    }
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email.";
    } elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $email_err = "Invalid email format.";
    } else {
        $email = htmlspecialchars(trim($_POST["email"]));
    }
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must be at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm your password.";
    } elseif ($_POST["password"] !== $_POST["confirm_password"]) {
        $confirm_password_err = "Passwords do not match.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
    }
    if (empty($name_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
        $success_message = "Registration successful!";
        $name = $email = "";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        * { box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 20px; }
        .container { 
            width: 400px; 
            margin: auto; 
            background: white; 
            padding: 20px; 
            border-radius: 10px; 
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); 
            text-align: center;
        }
        h2 { text-align: center; margin-bottom: 10px; }
        .success { color: green; font-size: 16px; font-weight: bold; margin-bottom: 10px; }
        label { font-weight: bold; display: block; margin-top: 10px; text-align: left; }
        input { width: 100%; padding: 8px; margin: 5px 0; border: 1px solid #ccc; border-radius: 5px; display: block; }
        .error { color: red; font-size: 12px; margin-top: 5px; }
        button { width: 100%; padding: 10px; background: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; margin-top: 10px; }
        button:hover { background: #218838; }
    </style>
</head>
<body>

<div class="container">
    <h2>Register</h2>
    <?php if (!empty($success_message)) echo "<p class='success'>$success_message</p>"; ?>

    <form action="" method="post">
        <label>Name:</label>
        <input type="text" name="name" value="<?= !empty($success_message) ? '' : htmlspecialchars($name) ?>">
        <span class="error"><?= $name_err ?></span>

        <label>Email:</label>
        <input type="email" name="email" value="<?= !empty($success_message) ? '' : htmlspecialchars($email) ?>">
        <span class="error"><?= $email_err ?></span>

        <label>Password:</label>
        <input type="password" name="password">
        <span class="error"><?= $password_err ?></span>

        <label>Confirm Password:</label>
        <input type="password" name="confirm_password">
        <span class="error"><?= $confirm_password_err ?></span>

        <button type="submit">Register</button>
    </form>
</div>

</body>
</html>
