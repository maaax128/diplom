<?php

$adminId = $_POST['admin_id'];
require('connect.php');
$adminDel = $pdo->prepare("DELETE FROM admins WHERE id = '$adminId'");
$adminDel->execute();
header("Location:controlPanel.php");
?>