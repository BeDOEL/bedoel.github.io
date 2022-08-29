<?php 
// SYNTAKS SESSION
session_start();

// SYNTAKS SESSION
if (!isset($_SESSION["login"])){
    header("Location: guest.php");
    exit;
}
// Mengambil function dari file functions.php
require 'functions.php';

// mengurutkan dari data terbaru di atas dan sebaliknya | (ASC) terbarunya di bawah | (DESC) Terbarunya di atas
$games = query("SELECT * FROM lbl_data");

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
    <title>Halaman Admin</title>
    <link rel="icon" href="img/favicon.jpeg" type="image/jpeg">
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/script.js"></script>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="main-background">
    <!-- MEMBUAT TOMBOL LOGOUT -->

    <div class="awal">
        <div class="header">
            <h1 class="judulweb">Selamat Datang di Website Montage</h1>
        </div>

        <div class="search">
            <form action="" method="POST">
                <!-- autocomplete="off" agar menghapus history ketikan -->
                <input type="text" name="keyword" size="40" autofocus placeholder="Masukan keyword pencarian..." autocomplete="off" id="keyword">
                <button type="submit" name="cari" id="tombol-cari">Cari Data!</button>
            </form>
        </div>
        
        <div class="conte-content cf">
            <div id="conte" class="content-left">
                    <?php $i = 1 ?>
                    <?php foreach($games as $game) : ?>
                    <div class="sub-content cf">
                        <ul>
                            <div class="sub-content-judul">
                                <nav class="nav-edithapus cf">
                                        <a href="edit.php?id=<?= $game["id"] ; ?>" class="linked">edit</a>
                                        <a href="hapus.php?id=<?= $game["id"] ; ?>" onclick="
                                                return confirm('Apakah Anda yakin ingin menghapus?')" class="linked">hapus</a>
                                </nav>
                                <div class="bar-judul">
                                    <h2 class="sub-judul"><?= $game["judul"] ; ?></h2>
                                </div>
                            </div>
                            <div class="sub-content-content">
                                <video src="vid/<?= $game["nama_vid"] ; ?>" width="300" class="video" controls></video>
                                <li class="huruf"><span class="space"> Nickname </span> : <?= $game["nama"] ; ?></li>
                                <li class="huruf"><span class="space"> Tanggal </span> : <?= $game["tanggal"] ; ?></li>
                            </div>
                        </ul>
                    </div>
                    <?php $i++; ?>
                    <?php endforeach; ?>
            </div>

            <div class="content-right cf">
                <div class="navigasi">
                    <ul>
                        <li>
                            <a href="index.php" class="ataslengkung">Home</a>
                        </li>
                        <li>
                            <a href="tambah.php" class="hello" class="marginatas">Tambah data Game</a>
                        </li>
                        <li>
                            <a href="logout.php">Logout</a>
                        </li>
                    </ul>
                </div>
                <div class="contecredit">
                    <div class="fbcss cf">
                        <a href="https://www.facebook.com/b4du1" target="_blank">
                            <img alt="Menuju Facebook" src="css/img/fbicon.png" width="100">
                            <p class="linked">@Fadlur</p>
                        </a>
                    </div>
                    <div class="igcss">
                        <a href="https://www.instagram.com/fadlur.rf/" target="_blank">
                            <img alt="Menuju Instagram" src="css/img/igicon.png" width="100">
                            <p>@fadlur.rf</p>
                        </a>
                    </div>
                    <div class="ytcss">
                        <a href="https://www.youtube.com/channel/UCe-LwjVrnIv767wp3ccTtuw" target="_blank" class="about">
                            <img alt="Menuju Youtube" src="css/img/ytbg.png" width="225">
                        </a>
                    </div>
                </div>
            </div>
            
        </div>

        <div class="footer">
            <p class="copy">Copyright &copy; 2022 fadlurrahmanfaiq</p>
        </div>
    </div>
</body>
</html>