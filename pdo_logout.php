<?php
session_start();
session_unset();
session_destroy();
header("Location: pdo_login.php");
exit;
?>
