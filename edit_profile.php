<?php
session_start();
require 'config.php';

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];

    // Proses upload foto profil
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['profile_pic']['tmp_name'];
        $fileName = $_FILES['profile_pic']['name'];
        $fileSize = $_FILES['profile_pic']['size'];
        $fileType = $_FILES['profile_pic']['type'];
        $fileNameCmps = explode(".", $fileName);
        $fileExtension = strtolower(end($fileNameCmps));

        // Validasi ekstensi file
        $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
        if (in_array($fileExtension, $allowedfileExtensions)) {
            // Tentukan direktori untuk menyimpan gambar
            $uploadFileDir = './uploads/';
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $dest_path = $uploadFileDir . $newFileName;

            // Pindahkan file ke direktori tujuan
            if(move_uploaded_file($fileTmpPath, $dest_path)) {
                // Update data pengguna di database
                $stmt = $conn->prepare("UPDATE users SET name = ?, profile_pic = ? WHERE username = ?");
                $stmt->bind_param("sss", $name, $dest_path, $username);
                $stmt->execute();
                $stmt->close();
            }
        }
    } else {
        // Update nama jika tidak ada file yang diunggah
        $stmt = $conn->prepare("UPDATE users SET id = ? WHERE username = ?");
        $stmt->bind_param("ss", $name, $username);
        $stmt->execute();
        $stmt->close();
    }

    header("Location: profile.php");
    exit;
}

// Ambil data pengguna untuk ditampilkan di form
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
    <title>Edit Profile</title>
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
    <nav>
        <a href="create_event.php">Create Event</a>
        <a href="logout.php">Logout</a>
        <a href="profile.php">Profile</a>
        <a href="change_password.php">Change Password</a>
 </nav>
    <div class="container">
        <h1>Edit Profile</h1>
        <form method="post" action="" enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            <br>
            <label for="profile_pic">Profile Picture:</label>
            <input type="file" name="profile_pic" accept="image/*">
            <br>
            <input type="submit" value="Update Profile">
        </form>
        <img src="<?php echo htmlspecialchars($profile_pic); ?>" alt="Current Profile Picture" width="100" height="100">
    </div>
</body>
</html>