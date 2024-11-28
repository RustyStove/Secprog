<?php
session_start();
require 'config.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Verifikasi kata sandi saat ini
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    $stmt->fetch();
    $stmt->close();

    if (password_verify($current_password, $hashed_password)) {
        // Cek apakah kata sandi baru dan konfirmasi kata sandi cocok
        if ($new_password === $confirm_password) {
            // Cek panjang kata sandi baru
            if (strlen($new_password) >= 8) {
                // Hash kata sandi baru
                $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

                // Update kata sandi baru di database
                $stmt = $conn->prepare("UPDATE users SET password = ? WHERE username = ?");
                $stmt->bind_param("ss", $new_hashed_password, $username);
                $stmt->execute();
                $stmt->close();

                // Redirect ke halaman profil atau halaman lain setelah berhasil
                header("Location: profile.php");
                exit;
            } else {
                $error = "New password must be at least 8 characters long.";
            }
        } else {
            $error = "New password and confirmation do not match.";
        }
    } else {
        $error = "Current password is incorrect!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
    <nav>
        <a href="create_event.php">Create Event</a>
        <a href="logout.php">Logout</a>
        <a href="profile.php">Profile</a>
        <a href="edit_profile.php">Edit Profile</a>
    </nav>
    <div class="container">
        <h1>Change Password</h1>
        <?php if (isset($error)): ?>
            <div class="error-container">
                <p><?php echo htmlspecialchars($error); ?></p>
            </div>
        <?php endif; ?>
        <form method="post" action="">
            <label for="current_password">Current Password:</label>
            <input type="password" name="current_password" required>
            <br>
            <label for="new_password">New Password:</label>
            <input type="password" name="new_password" required>
            <br>
            <label for="confirm_password">Confirm New Password:</label>
            <input type="password" name="confirm_password" required>
            <br>
            <input type="submit" value="Change Password">
        </form>
    </div>
</body>
</html>