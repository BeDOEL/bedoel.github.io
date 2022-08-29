<?php 
// SYNTAKS SESSION
session_start();

// SYNTAKS SESSION
if (!isset($_SESSION["login"])){
    header("Location: login.php");
    exit;
}
// Mengambil function dari file functions.php
require 'functions.php';

// mengurutkan dari data terbaru di atas dan sebaliknya | (ASC) terbarunya di bawah | (DESC) Terbarunya di atas
$games = query("SELECT * FROM gamesmobile ORDER BY id ASC");

// tombol cari sudah ditekan atau blm (proses mencari data)
if(isset($_POST["cari"])){
    $games = cari($_POST["keyword"]);
}

// LANJUTAN TOMBOL LOGOUT
if(isset($_POST["keluar"])) {
    header("Location: logout.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.jpeg" type="image/jpeg">
    <title>Halaman Admin</title>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/script.js"></script>
    <style>
        .logout {
            float: right;
        }
        .loader {
            width: 100px;
            position: absolute;
            top: 76px;
            left: 300px;
            z-index: -1;
            display: none;
        }
        .about {
            float: right
        }
        body {
            background-image: url("img/bgweb.jpeg");
        }
    </style>
</head>
<body>
    <!-- MEMBUAT TOMBOL LOGOUT -->
    <form method="POST" action="">
        <button class="logout" type="submit" name="keluar">Logout</button>
    </form>

    <h1>Daftar Game Android/IOS Terpopuler DiIndonesia</h1>
    <a href="tambah.php">Tambah data Game</a>
    
    <!-- tombol print -->
    | <a href="cetak.php" target="_blank">Cetak</a>

    <br><br>

    <form action="" method="POST">
        <!-- autocomplete="off" agar menghapus history ketikan -->
        <input type="text" name="keyword" size="40" autofocus placeholder="Masukan keyword pencarian..." autocomplete="off" id="keyword">
        <button type="submit" name="cari" id="tombol-cari">Cari Data!</button>
        <img src="img/load.gif" class="loader">
    </form>

    <br>

    <div id="conte">
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Rilis</th>
            <th>Developer</th>
            <th>Download</th>
            <th>OS</th>
            <th>Status</th>
        </tr>
        
        <?php $i = 1 ?>
        <?php foreach($games as $game) : ?>
        <tr>
            <td><?= $i ; ?></td>
            <td>
                <a href="edit.php?id=<?= $game["id"] ; ?>">edit</a> |
                <a href="hapus.php?id=<?= $game["id"] ; ?>" onclick="
                    return confirm('Apakah Anda yakin ingin menghapus?')">hapus</a>
            </td>
            <td><img src="img/<?= $game["gambar"] ; ?>" width="150"></td>
            <td><?= $game["nama"] ; ?></td>
            <td><?= $game["rilis"] ; ?></td>
            <td><?= $game["developer"] ; ?></td>
            <td><?= $game["download"] ; ?></td>
            <td><?= $game["os"] ; ?></td>
            <td><?= $game["status"] ; ?></td>
        </tr>
        <?php $i++; ?>
        <?php endforeach; ?>
    </table>
    </div>


    <a href="https://www.facebook.com/b4du1" target="_blank" class="about">
        <img alt="Menuju Facebook" src="img/fbbg.png" width="50">
    </a> | <a href="https://www.instagram.com/fadlur.rf/" target="_blank" class="about">
        <img alt="Menuju Instagram" src="img/igbg.png" width="50">
    </a> | <a href="https://www.youtube.com/channel/UCe-LwjVrnIv767wp3ccTtuw" target="_blank" class="about">
        <img alt="Menuju Youtube" src="img/ytbg.png" width="85">
    </a> 
    
</body>
</html>