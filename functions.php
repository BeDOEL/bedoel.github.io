<?php
// Membuat function
$conn = mysqli_connect("localhost", "root", "", "montage");

// variabel yang ada di dalam function berbeda dari variabel
// yang ada pada luar function
function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
}


function tambah($data){
    // Ambil data dari tiap elemen dalam form
    global $conn;
    $nama_game = htmlspecialchars($data["nama_game"]);
    $judul = htmlspecialchars($data["judul"]);
    $nama = htmlspecialchars($data["nama"]);
    $tanggal = htmlspecialchars($data["tanggal"]);
    
    $nama_vid = upload();
    if (!$nama_vid) {
        return false;
    }

    // query insert data
    $query = "INSERT INTO lbl_data
                VALUES
                ('', '$nama_game', '$judul', '$nama', '$nama_vid',
                '$tanggal')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function hapus($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM lbl_data WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function edit($data){
    global $conn;
    $id = $data["id"];
    $nama_game = htmlspecialchars($data["nama_game"]);
    $judul = htmlspecialchars($data["judul"]);
    $nama = htmlspecialchars($data["nama"]);
    $tanggal = htmlspecialchars($data["tanggal"]);

    $videolama = htmlspecialchars($data["videolama"]);

    // CEK APAKAH USER PILIH GAMBAR BARU ATAU TIDAK
    if($_FILES["nama_vid"]["error"] === 4){
        $nama_vid = $videolama;
    } else {
        $nama_vid = upload();
    }

    // query update data
    $query = "UPDATE lbl_data SET
                nama_game = '$nama_game',
                judul = '$judul',
                nama = '$nama',
                nama_vid = '$nama_vid',
                tanggal = '$tanggal'
             WHERE id = $id
                ";
    
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function cari($keyword){
    // MENGGUNAKAN (LIKE) AGAR DATANYA BISA DI CARI NAMA YG MIRIP
    // MENGGUNAKAN (%) AGAR MENCARI KATA SETELAHNYA
    $query = "SELECT * FROM gamesmobile
                WHERE
                nama LIKE '%$keyword%' OR
                rilis LIKE '%$keyword%' OR
                developer LIKE '%$keyword%' OR
                download LIKE '%$keyword%' OR
                os LIKE '%$keyword%' OR
                status LIKE '%$keyword%' OR
                gambar LIKE '%$keyword%'
                ";
    
    // mengambil function query di atas
    return query($query);

}

function upload(){
    $namafile = $_FILES["nama_vid"]["name"];
    $error = $_FILES["nama_vid"]["error"];
    $tmpName = $_FILES["nama_vid"]["tmp_name"];

    // CEK ADA GAMBAR YG DI UPLOAD ATAU TIDAK
    if($error === 4){
        echo "<script>
            alert('PILIH VIDEO TERLEBIH DAHULU!');
            </script>";
        return false;
    }

    // CEK APAKAH YANG DI UPLOAD ADALAH GAMBAR
    $ekstensivideofix = ["mp4"];
    $ekstensivideo = explode(".", $namafile);
    // strtolower UNTUK MEMAKSI TULIAS (JPG) MENJADI HURUF KECIL SEMUA!
    $ekstensivideo = strtolower(end($ekstensivideo));

    // MENGECEK APAKAH FILE INI (JPG) ATAU BUKAN
    if (!in_array($ekstensivideo, $ekstensivideofix)){
        echo "<script>
            alert('FILE YANG ANDA UPLOAD BUKAN VIDEO!');
            </script>";
        return false;
    }

    // CEK UKURAN GAMBAR TERLALU BESAR
    // if($ukuranfile > 1048576){
    //     echo "<script>
    //         alert('UKURAN GAMBAR TERLALU BESAR!');
    //         </script>";
    //     return false;
    // }

    // LOLOS PENGECEKAN, SIAP DIUPLOAD
    // MEMBUAT NAMA FILE BARU
    $namafilebaru = uniqid();
    // HARUS ADA TITIK SEBELOM SAMA DENGAN(=)
    $namafilebaru .= ".";
    $namafilebaru .= "$ekstensivideo";
    move_uploaded_file($tmpName, "vid/" . $namafilebaru);

    return $namafilebaru;

}

function registrasi($data){
    global $conn;
    // stripslashes MENGHILANGKAN KARAKTER TERTENTU
    // strtolower MENGUBAH HURUF MENJADI KECIL SEMUA
    $username = strtolower(stripslashes($data["username"]));
    // UNTUK MEMUNGKINKAN USER MASUKAN PASSWORD ADA TANDA KUTIPNYA
    $password = mysqli_real_escape_string($conn, $data["password"]);
    $password2 = mysqli_real_escape_string($conn, $data["password2"]);
    $email = $data["email"];

    // CEK USERNAME SUDAH TERDAFTAR ATAU BELUM
    $result = mysqli_query($conn, "SELECT username FROM lbl_users
            WHERE username = '$username'");

    if (mysqli_fetch_assoc($result)){
        echo "<script>
                alert('Username sudah terdaftar!');
            </script>";
            return false;
    }

    // CEK EMAIL SUDAH TERDAFTAR ATAU BELOM
    $cekemail = mysqli_query($conn, "SELECT email FROM lbl_users
            WHERE email = '$email'");

    if (mysqli_fetch_assoc($cekemail)){
        echo "<script>
                alert('Email sudah terdaftar!');
            </script>";
            return false;
    }

    // CEK KONFIRMASI PASSWORD  
    if ($password !== $password2){
        echo "<script>
                alert('Konfirmasi password tidak sesuai!');
            </script>";
        return false;
    }

    // ENKRIPSI PASSWORD (NOTE: Jangan pernah make md5)
    $password = password_hash($password, PASSWORD_DEFAULT);

    // TAMBAH USER BARU KE DATABASE
    $query = "INSERT INTO lbl_users VALUES
                ('', '$username', '$password', '$email')";

    mysqli_query($conn, $query);

    // MENGAHASILKAN ANGKA 1 JIKA BERHASIL
    // MENGHASILKAN ANGKA -1 JIKA GAGAL
    return mysqli_affected_rows($conn);

}

?>