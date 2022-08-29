<?php 

    session_start();
    $_SESSION = [];
    session_unset();
    session_destroy();

    setcookie("co", "", time()-9999999);
    setcookie("li", "", time()-9999999);

    header("Location: guest.php");
    exit;

?>