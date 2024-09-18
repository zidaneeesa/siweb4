<?php
include 'db.php';
session_start();

function login($username, $password) {
    global $conn;

    // Ambil data user berdasarkan username
    $sql = "SELECT id, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Verifikasi password
        if (password_verify($password, $row['password'])) {
            // Set session
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $username;
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (login($username, $password)) {
        // Redirect ke halaman beranda
        header('Location: home.php');
        exit;
    } else {
        echo "Login gagal. Username atau password salah.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
    <style>
        /* Custom CSS to center the form */
        .centered-form {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .margin-top{
            margin-top: 180px;
        }

        /* Custom CSS for the side image */
        .side-image {
            /* background-image: url('login.png'); Replace 'your-image-url.jpg' with the actual image URL */
            background-size: cover;
            background-position: center;
            height: 100vh;
        }
    </style>
</head>
<body>
<div class="container">
        <div class="row margin-top">
            <div class="col-md-6 side-image">
                <img src="login.png" class="img-fluid" alt="login-image">
            </div>

            <div class="col-md-6">
                <div class="card custom-card">
                    <div class="card-header">
                        Login
                    </div>
                    <div class="card-body">
                        <form method="POST">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Enter your username">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Enter your password">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                            <div class="form-group mt-4">
                                <div class="text-center">
                                    <span>Don't have an account?</span>
                                    <a href="register.php">Register Here</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>