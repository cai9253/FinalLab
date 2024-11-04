<?php
require 'conn.php';
// Fetch logged-in user data from the database
$userId = $_SESSION['id'];
$query = "SELECT username, email FROM tblusers WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $userId);
$stmt->execute();
$stmt->bind_result($username, $email);
$stmt->fetch();
$stmt->close();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="team.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title><?php echo isset($title) ? htmlspecialchars($title) : 'Default Title'; ?></title>
</head>
<body>
<ul class="nav"> 
    <li class="dropdown">
        <a href="javascript:void(0)" class="dropbtn">Profile</a>
        <div class="dropdown-content">
            <a href="#"><?php echo htmlspecialchars($username); ?></a>
            <a href="#"><?php echo htmlspecialchars($email); ?></a>
            <a href="logout.php">Logout</a>
        </div>
    </li>
    <li><a href="team.php">Our Team</a></li>
    <li><a href="Profile.php">View</a></li>
    <li><a href="Create.php">Create</a></li>      
</ul>
