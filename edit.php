<?php 
// SYNTAKS SESSION
session_start();

// SYNTAKS SESSION
if (!isset($_SESSION["login"])){
    header("Location: guest.php");
    exit;
}

require 'functions.php';

// ambil data url
$id = $_GET["id"];

// query data gamesmobile bedasarkan id
$game = query("SELECT * FROM lbl_data WHERE id = $id")[0];

// Cek tombol submit sudah di tekan atau blm
if(isset($_POST["submit"])) {


    // cek berhasil atau tidak diubah datanya
    if(edit($_POST) > 0){
        echo "
            <script>
                alert('Data Berhasil Diedit!');
                document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
                alert('Data Gagal Diedit!');
                document.location.href = 'index.php';
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
    <title>Edit Data Game</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="hurufh">Edit Data Game</h1>
        </div>

        <div class="main">
            <!-- MENAMBAH enctype UNTUK MENGELOLA FILE -->
            <form action="" method="POST" enctype="multipart/form-data">
                <div class="menu">
                    <!-- Untuk memberi id tanpa terlihat, untuk fungsi edit -->
                    <input type="hidden" name="id" value="<?= $game["id"]; ?>">

                    <!-- Untuk memberi gambarlama tanpa terlihat, untuk fungsi edit -->
                    <input type="hidden" name="videolama" value="<?= $game["nama_vid"]; ?>">

                    <input type="hidden" name="tanggal" id="tanggal" value="<?= $game["tanggal"]; ?>" class="input">

                    <label for="nama_game">Nama Game</label>
                    <select name="nama_game" id="nama_game">
                        <option id="nama_game" value="<?= $game["nama_game"]; ?>"></option>
                        <option id="nama_game" value="PUBG Mobile">PUBG Mobile</option>
                        <option id="nama_game" value="Mobile Legends">Mobile Legends</option>
                    </select>

                    <label for="judul">Judul</label>
                    <input type="text" name="judul" id="judul" required value="<?= $game["judul"]; ?>" class="input">

                    <label for="nama">Nickname</label>
                    <input type="text" name="nama" id="nama" required value="<?= $game["nama"]; ?>" class="input">

                    <label for="nama_vid">Video</label>
                
                    <video src="vid/<?= $game["nama_vid"] ; ?>" width="300" controls></video>
                    <input type="file" name="nama_vid" id="nama_vid" class="input">
                </div>

                <div class="button">
                    <button type="submit" name="submit" class="input">Edit Data!</button>
                </div>
            </form>
        </div>
    </div>

    <div class="footer">
        <p class="copy">Copyright &copy; 2022 fadlurrahmanfaiq</p>
    </div>
    
</body>
</html>