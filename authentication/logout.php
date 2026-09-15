<?php
session_start();
unset($_SESSION['STUDENT_ACCOUNT']);
session_regenerate_id();
header('location: lap4_authentication_challenge.php');