<?php
session_start();

// Periksa apakah pengguna sudah login atau belum
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Jika tidak, arahkan kembali ke halaman login
    header("Location: login.php");
    exit;
}

require 'connect.php';

$email = $_SESSION['email'];
$query = "SELECT * FROM user WHERE email = '$email'";
$result = mysqli_query($konek, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $username = $row['username'];
    $telp = $row['telp'];
    $password = $row['password'];
} else {
    echo "Error: " . mysqli_error($konek);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #fff;
        }
        .navbar {
            background-color: #333;
            color: white;
            width: 100%;
            text-align: center;
            padding: 15px 0;
            font-size: 20px;
        }
        .container {
            background-color: #333;
            padding: 20px;
            border: 2px solid white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .profil {
            text-align: center;
        }
        .profil h2 {
            margin-bottom: 20px;
            color: white;
        }
        .profil div {
            margin-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .profil label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: white;
        }
        .profil p {
            background-color: #f9f9f9;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin: 0;
            flex-grow: 1;
        }
        .profil button {
            margin-left: 10px;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .profil button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        Profile
    </nav>
    <div class="container">
        <div class="profil">
            <h2>Selamat datang, <?php echo htmlspecialchars($username); ?>!</h2>
            <div class="label">
                <label for="Email">Email</label>
                <p><?php echo htmlspecialchars($email); ?></p>
            </div>
            <div class="label">
                <label for="Telepon">Telepon</label>
                <p><?php echo htmlspecialchars($telp); ?></p>
            </div>
            <div class="label">
                <label for="Password">Password</label>
                <p><?php echo htmlspecialchars($password); ?></p>
                <form action="update.php" method="post">
                    <button type="submit">Edit</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
