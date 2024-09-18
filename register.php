
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
                        Register
                    </div>
                    <div class="card-body">
                    <?php
                        include 'db.php';

                        function register($username, $password) {
                            global $conn;

                            // Cek apakah username sudah ada
                            $sql = "SELECT id FROM users WHERE username = ?";
                            $stmt = $conn->prepare($sql);
                            $stmt->bind_param("s", $username);
                            $stmt->execute();
                            $stmt->store_result();

                            if ($stmt->num_rows > 0) {
                                return "Username sudah digunakan";
                            } else {
                                // Hash password sebelum disimpan
                                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                                
                                // Insert user baru
                                $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
                                $stmt = $conn->prepare($sql);
                                $stmt->bind_param("ss", $username, $hashed_password);
                                
                                if ($stmt->execute()) {
                                    header('Location: login.php');
                                } else {
                                    return "Registrasi gagal";
                                }
                            }
                        }

                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $username = $_POST['username'];
                            $password = $_POST['password'];
                            
                            $message = register($username, $password);
                            echo $message;
                        }
                        ?>
                        <form method="POST">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" name="username" placeholder="Enter your username">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Enter your password">
                            </div>
                            <!-- <div class="form-group">
                                <div class="text-center">
                                    <a href="#">Forgot Password?</a>
                                </div>
                            </div> -->
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                            <div class="form-group mt-4">
                                <div class="text-center">
                                    <span>Have an account?</span>
                                    <a href="login.php">Login Here</a>
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