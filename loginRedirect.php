<?php
session_start();
$_SESSION['error'] = 'You must be logged in to comment';
header('Location: login.php');
exit;
