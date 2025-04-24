<?php
require 'pdo_db.php';

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$_GET['id']]);
}

header("Location: pdo_dashboard.php");
exit;
?>
