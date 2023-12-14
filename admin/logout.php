<?php

//logout
if(isset($_GET['logout']) && $_GET['logout']=='true'){
    $_SESSIOn['login_id'] = "";
    $_SESSION['login_name'] = "";
    $_SESSion['login_permit'] = "";
    session_unset();
    header("Location:../login.php");
}

?>
