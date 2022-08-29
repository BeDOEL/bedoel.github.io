<?php 
session_start();
require 'functions.php';

// CEK COOKIE
// if (isset($_COOKIE["login"])){
//     if ($_COOKIE["login"] == "true"){
//         $_SESSION["login"] = true;
//     }
// }
if(isset($_COOKIE["co"]) && isset($_COOKIE["li"])){
    $co = $_COOKIE["co"];
    $li = $_COOKIE["li"];

    // AMBIL USERNAME BERDASARKAN ID
    $result = mysqli_query($conn, "SELECT username FROM lbl_users WHERE id = $co");
    $row = mysqli_fetch_assoc($result);

    // CEK COOKIE DAN USERNAME
    if ($li === hash("sha256", $row["username"])){
        $_SESSION["login"] = true;
    }

}

if (isset($_SESSION["login"])){
    header("Location: index.php");
    exit;
}



    if(isset($_POST["signin"])) {

        //code for captach verification
        if ($_POST["vercode"] != $_SESSION["vercode"] OR $_SESSION["vercode"]=='')  {
            echo "<script>alert('Verifikasi Code Salah!');</script>" ;
        }
        
        else{
            $username = $_POST["username"];
            $password = $_POST["password"];

            $result = mysqli_query($conn, "SELECT * FROM lbl_users WHERE
                    username = '$username'");

            // CEK USERNAME
            if(mysqli_num_rows($result) === 1){

                // CEK PASSWORD
                $row = mysqli_fetch_assoc($result);
                if (password_verify($password, $row["password"])){
                    // CEK SESSION
                    $_SESSION["login"] = true;

                    // CEK REMEMBER ME
                    if(isset($_POST["remember"])){
                        // BUAT COOKIE
                        setcookie("co", $row["id"], time()+10);
                        // hash "sha256" adalah algorimta, kita bebas menggunkan
                        // algoritma apa saja
                        setcookie("li", hash("sha256", $row["username"]), time()+10);
                    }

                    header("Location: index.php");
                    exit;
                }
            }

            // UNTUK MENAMPILKAN USERNAME / PASSWORD SALAH
            $error = true;
        }

    }

    // if (isset($_POST["signup"])) {
    //     header("Location: registrasi.php");
    //     exit;
    // }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/favicon.jpeg" type="image/jpeg">
    <link rel="stylesheet" href="css/login.css">
    <title>Halaman Login</title>

</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Login</h1>
        </div>

        <div class="salah">
            <!-- MENAMPILKAN USERNAME / PASSWORD SALAH -->
            <?php if (isset($error)) : ?>
                <p>Username / password salah!</p>
            <?php endif; ?>
        </div>

        <div class="main">
            <form method="POST" action="">
                <div class="menu">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="input">

                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="input">

                    <input type="text" class="form-control1" name="vercode" placeholder="Verification Code" maxlength="6" autocomplete="off" required style="width: 225px; height: 26px;" />&nbsp;
                    <img src="captcha.php">
                </div>

                <div class="remember">
                    <!-- MEMBUAT REMEMBER ME (COOKIE) -->
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember" class="me">Remember me</label>
                </div>

                <div class="button">
                    <!-- BUTTON LOGIN -->
                    <button type="submit" name="signin">Sign in</button>
                </div>

                <div class="registrasi">
                    <!-- BUTTON REGISTRASI -->
                    <!-- <button type="submit" name="signup">Sign up</button> -->
                    <p>
                        Masih belum memiliki akun?
                        <a href="registrasi.php">Daftar Disini!</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <div class="footer">
        <p class="copy">Copyright &copy; 2022 fadlurrahmanfaiq</p>
    </div>
</body>
</html>