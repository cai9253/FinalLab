<?php
require 'conn.php';


if (isset($_POST["submit"])) {
    $usernameemail = $_POST["usernameemail"];
    $password = $_POST["password"];

    // Prepare and bind the query to check for the user by username or email
    $query = $conn->prepare("SELECT * FROM tblusers WHERE username = ? OR email = ?");
    $query->bind_param("ss", $usernameemail, $usernameemail);
    $query->execute();
    $result = $query->get_result();

    // Fetch user data
    if ($row = $result->fetch_assoc()) {
        // Verify the password
        if (password_verify($password, $row['pass'])) {
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["user_id"];
            header("Location: create.php");
            exit;
        } else {
            echo "<script> alert('Wrong Password'); </script>";
        }
    } else {
        echo "<script> alert('User Not Registered'); </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
    <link rel="stylesheet" href="team.css">
</head>
<body>
    <div class="login-container">
        <div class="form-container">
            <h2>Login</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <input type="text" name="usernameemail" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit" name="submit" class="submitbtn">Login</button>
            </form>
            <p>Don't have an account? <a href="signup.php">Sign up here</a>.</p>
        </div>
    </div>
</body>
</html>
