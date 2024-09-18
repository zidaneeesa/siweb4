<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom right, #000428, #004e92);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
        }

        .dashboard-card {
            background-color: #1c1c1e;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
            backdrop-filter: blur(5px);
            color: #fff;
        }

        .dashboard-card h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .btn-logout {
            background: linear-gradient(to right, #6a11cb, #2575fc);
            border: none;
            color: #fff;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            margin-top: 1.5rem;
        }

        .btn-logout:hover {
            background: linear-gradient(to right, #2575fc, #6a11cb);
            transform: translateY(-2px);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="dashboard-card">
                    <h1>Selamat Datang, <?= $_SESSION['username']; ?>!</h1>
                    <p class="lead">Anda telah berhasil masuk ke dashboard.</p>
                    <a href="logout.php" class="btn btn-logout">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>