<?php

session_start();
unset($_SESSION['medewerkercode']);
unset($_SESSION['uname']);
header('location: index.php');

?>