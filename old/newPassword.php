<?php
session_start();
$adminId = $_SESSION['admin_id'];
$newPass = $_POST['password'];
require('connect.php');
$newPassword = $pdo->prepare("UPDATE admins SET password = '$newPass' WHERE id = '$adminId'");
$newPassword->execute();
header("Location:controlPanel.php");
?>