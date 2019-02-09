<?php
$sthAdmins = $pdo->prepare('SELECT * FROM admins');
$sthAdmins->execute();
$resultAdmins = $sthAdmins->fetchAll(PDO::FETCH_ASSOC);
?>

