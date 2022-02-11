<?php

session_start();
unset($_SESSION['topf_uid']);
unset($_SESSION['topf_acive']);
unset($_SESSION['topf_uname']);
header('location: ../../login.php');
