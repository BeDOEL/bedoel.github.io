<?php 
// SYNTAKS SESSION
session_start();

// SYNTAKS SESSION
if (!isset($_SESSION["login"])){
    header("Location: guest.php");
    exit;
}

require 'functions.php';
// Cek tombol submit sudah di tekan atau blm
if(isset($_POST["submit"])) {

    // cek berhasil atau tidak menambah data
    if(tambah($_POST) > 0){
        echo "
            <script>
                alert('Data Berhasil Ditambahkan!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data Gagal Ditambahkan!');
            </script>
        ";
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Tambah Data Game</title>
    <style>
        body {
            background-color: #111111;
            padding: 10px;
            font-family: 'Courier New', Courier, monospace;
            color: white;
            text-shadow: 2px 1px 4px black;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Tambah Data Game</h1>
        </div>

        <div class="main">
            <!-- MENAMBAH enctype UNTUK MENGELOLA FILE -->
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="menu">
                        <label for="nama_game">Nama Game</label>
                        <select name="nama_game" id="nama_game">
                            <option id="nama_game" value="PUBG Mobile">PUBG Mobile</option>
                            <option id="nama_game" value="Mobile Legends">Mobile Legends</option>
                        </select>

                        <label for="judul">Judul</label>
                        <input type="text" name="judul" id="judul" required>

                        <label for="nama">Nama</label>
                        <input type="text" name="nama" id="nama" required>

                        <label for="nama_vid">Video</label>
                        <input type="file" name="nama_vid" id="nama_vid" required>

                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" required>

                </div>

                <div class="button">
                        <button type="submit" name="submit">Tambah Data!</button>
                </div>
            </form>
        </div>
    </div>

    <div class="footer">
        <p class="copy">Copyright &copy; 2022 fadlurrahmanfaiq</p>
    </div>
    
</body>
</html>