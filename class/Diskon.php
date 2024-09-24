<?php
class Diskon {
    private $totalBayar;
    private $diskon;

    // Konstruktor untuk inisialisasi nilai
    public function __construct($totalBayar, $diskon) {
        $this->totalBayar = $totalBayar;
        $this->diskon = $diskon;
    }

    // Fungsi untuk menghitung total bersih setelah diskon
    public function hitungTotalBersih() {
        $totalDiskon = $this->totalBayar * ($this->diskon / 100);
        $totalBersih = $this->totalBayar - $totalDiskon;
        return $totalBersih;
    }
}

// Proses ketika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $totalBayar = $_POST['totalBayar'];
    $diskon = $_POST['diskon'];

    // Membuat objek dari kelas Diskon
    $payment = new Diskon($totalBayar, $diskon);
    $totalBersih = $payment->hitungTotalBersih();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pembayaran</title>
    <style>
        /* Styling untuk tata letak form */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f4f4f9;
            font-family: 'Arial', sans-serif;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        input[type="number"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        h3 {
            color: #333;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Form Hitung Total Pembayaran</h2>
    <form method="post" action="">
        <label for="totalBayar">Total Bayar:</label>
        <input type="number" id="totalBayar" name="totalBayar" step="0.01" placeholder="Masukkan total bayar" required>

        <label for="diskon">Diskon (%):</label>
        <input type="number" id="diskon" name="diskon" step="0.01" placeholder="Masukkan diskon" required>

        <input type="submit" value="Hitung Total Bersih">
    </form>

    <?php
    // Menampilkan hasil perhitungan jika ada input dari form
    if (isset($totalBersih)) {
        echo "<h3>Total Bersih Pembayaran: Rp " . number_format($totalBersih, 2, ',', '.') . "</h3>";
    }
    ?>
</div>

</body>
</html>
