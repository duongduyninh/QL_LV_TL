<?php

//logout
if(isset($_GET['logout']) && $_GET['logout']=='true'){
    $_SESSIOn['user_id']="";
    $_SESSION['user_login']="";
    $_SESSion['user_permit']="";
    header("Location:../login.php");
}

?>
