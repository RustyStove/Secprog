<?php
session_start();
require 'config.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];

// Ambil data pengguna dari database
$stmt = $conn->prepare("SELECT id, profile_pic FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($name, $profile_pic);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Profile</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
    <nav>
        <a href="create_event.php">Create Event</a>
        <a href="logout.php">Logout</a>
        <a href="edit_profile.php">Edit Profile</a>
        <a href="change_password.php">Change Password</a>
    </nav>
    <div class="container">
        <h1>User Profile</h1>
        <img src="<?php echo htmlspecialchars($profile_pic); ?>" alt="Profile Picture" width="100" height="100">
        <p><strong>Name:</strong> <?php echo htmlspecialchars($name); ?></p>
    </div>
</body>
</html>