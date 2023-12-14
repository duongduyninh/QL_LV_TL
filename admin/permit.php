<?php 
if ($_SESSION['login_permit']!=3)
{
    header('Location:../login.php');
}
    

?>