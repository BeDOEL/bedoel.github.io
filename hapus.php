<?php 
// SYNTAKS SESSION
session_start();

// SYNTAKS SESSION
if (!isset($_SESSION["login"])){
    header("Location: guest.php");
    exit;
}

require 'functions.php';

$id = $_GET["id"];

if (hapus($id)>0){
    echo "
    <script>
        alert('Data Berhasil Dihapus!');
        document.location.href = 'index.php';
    </script>
    ";
} else {
    echo "
        <script>
            alert('Data Gagal Dihapus!');
        </script>
    ";
}

?>