<?php 
session_start();
require 'functions.php';

    if(isset($_POST["signup"])){

        //code for captach verification
        if ($_POST["vercode"] != $_SESSION["vercode"] OR $_SESSION["vercode"]=='')  {
            echo "<script>alert('Verifikasi Code Salah!');</script>" ;
        }

        else {
            if(registrasi($_POST) > 0){
                echo "<script>
                        alert('Sign Up berhasil!');
                    </script>";
            } else {
                echo mysqli_error($conn);
            }
        }
    }

    if (isset($_POST["signin"])) {
        header("Location: login.php");
        exit;
    }



 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Halaman Registrasi</title>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Registrasi</h1>
        </div>

        <div class="main">
            <form action="" method="POST">
                <div class="menu">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="input" required>

                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="input" required>

                    <label for="password2">Konfirmasi Password</label>
                    <input type="password" name="password2" id="password2" class="input" required>

                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="input" required>

                    <input type="text" class="form-control1" name="vercode" placeholder="Verification Code" maxlength="6" autocomplete="off" required style="width: 225px; height: 26px;" />&nbsp;
                    <img src="captcha.php">
                </div>

                <div class="button">
                    <!-- BUTTON REGISTRASI -->
                    <button type="submit" name="signup">Sign up</button>
                </div>

                <div class="login">
                    <p>
                        Sudah memiliki akun?
                        <a href="login.php">Login Disini!</a>
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